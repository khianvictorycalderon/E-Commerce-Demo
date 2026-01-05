<?php
session_start();
require_once("../phps/db.php");
require_once("../phps/tables.php"); // All table schemas

// Redirect if logged in
if (isset($_SESSION["user_id"])) {
    header("Location: /products/");
    exit();
}

// Server-side form submission
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name  = trim($_POST["last_name"] ?? "");
    $birth_date = trim($_POST["birth_date"] ?? "");
    $username   = trim($_POST["username"] ?? "");
    $password   = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    // --- Back-end Validation ---
    // First name validation: required, letters + spaces only
    if (!$first_name) {
        $errors[] = "First name is required.";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $first_name)) {
        $errors[] = "First name can only contain letters and spaces.";
    }

    // Last name validation: required, letters + spaces only
    if (!$last_name) {
        $errors[] = "Last name is required.";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $last_name)) {
        $errors[] = "Last name can only contain letters and spaces.";
    }

    if (!$birth_date) {
        $errors[] = "Birth date is required.";
    } else {
        $age = (int)date('Y') - (int)date('Y', strtotime($birth_date));
        if ($age < 12) {
            $errors[] = "You must be at least 12 years old to register.";
        }
    }

    if (!$username) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username must be at least 4 characters long.";
    }

    if (!$password) {
        $errors[] = "Password is required.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/', $password)) {
        $errors[] = "Password must be at least 8 characters and include 1 uppercase, 1 lowercase, and 1 special character.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors → insert user
    if (empty($errors)) {
        $tableResult = transactionalMySQLQuery($userTableQuery);
        if (is_string($tableResult)) {
            $errors[] = "DB Error: " . $tableResult;
        } else {
            // Check if username exists
            $existing = transactionalMySQLQuery(
                "SELECT id FROM users WHERE username = ?",
                [$username]
            );

            if (is_string($existing)) {
                $errors[] = "DB Error: " . $existing;
            } elseif (!empty($existing)) {
                $errors[] = "Username already taken.";
            }

            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Ensure UUID is unique
                do {
                    $user_id = generate_uuid_v4_manual();
                    $existing_id = transactionalMySQLQuery(
                        "SELECT id FROM users WHERE id = ?",
                        [$user_id]
                    );
                } while (!empty($existing_id));

                $insertResult = transactionalMySQLQuery(
                    "INSERT INTO users (id, first_name, last_name, birth_date, username, password) VALUES (?, ?, ?, ?, ?, ?)",
                    [$user_id, $first_name, $last_name, $birth_date, $username, $hashed_password]
                );

                if ($insertResult === true) {
                    $success = true;
                } else {
                    $errors[] = "DB Error: " . $insertResult;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Forces the browser to load the latest version of this website -->
        <meta http-equiv='cache-control' content='no-cache'> 
        <meta http-equiv='expires' content='0'> 
        <meta http-equiv='pragma' content='no-cache'>

        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
        <title>Register Account</title>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600">
        <div class="navbar"></div>

        <div class="min-h-screen flex items-center justify-center px-4 pt-24 pb-10">
            <section class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-xl border border-white/40 p-6 sm:p-8 space-y-6">
                <div class="text-center space-y-1">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Create your Account</h1>
                    <p class="text-gray-500 text-sm">Sign up to start shopping</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm space-y-1">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-5" id="registerForm">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-medium mb-1">First Name</label>
                        <input 
                            type="text" 
                            name="first_name" 
                            required 
                            pattern="[A-Za-z ]+" 
                            title="First name can only contain letters and spaces."
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="John"
                        />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Last Name</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            required 
                            pattern="[A-Za-z ]+" 
                            title="Last name can only contain letters and spaces."
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="Doe"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Birth Date</label>
                        <input type="date" name="birth_date" required max="<?= date('Y-m-d', strtotime('-12 years')) ?>"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"/>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input type="text" name="username" required minlength="4"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition" placeholder="johndoe123"/>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                            title="Min 8 characters, 1 uppercase, 1 lowercase, 1 special character"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition" placeholder="••••••••"/>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition" placeholder="••••••••"/>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-semibold tracking-wide transition">Register</button>

                    <?php if ($success): ?>
                        <div class="bg-green-100 text-green-700 p-3 rounded-lg text-sm">
                            Registration successful! You can now <a href="/login" class="text-blue-600 underline">login</a>.
                        </div>
                    <?php endif; ?>

                    <p class="text-center text-gray-500 text-sm mt-2">
                        Already have an account? 
                        <a href="/login" class="text-blue-600 hover:text-blue-500 font-medium transition">Login</a>
                    </p>
                </form>
            </section>
        </div>

        <div class="footer"></div>

        <script>
        // Front-end JS Validation
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', (e) => {
            const password = form.password.value;
            const confirm = form.confirm_password.value;
            const birth_date = new Date(form.birth_date.value);
            const today = new Date();
            const age = today.getFullYear() - birth_date.getFullYear();

            if (password !== confirm) {
                e.preventDefault();
                alert("Passwords do not match!");
                return;
            }

            if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}/.test(password)) {
                e.preventDefault();
                alert("Password must be at least 8 characters and include 1 uppercase, 1 lowercase, 1 special character.");
                return;
            }

            if (age < 12) {
                e.preventDefault();
                alert("You must be at least 12 years old to register.");
                return;
            }
        });
        </script>
    </body>
</html>