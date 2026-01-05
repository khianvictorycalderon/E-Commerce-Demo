<?php
    session_start();
    require_once("../phps/db.php"); // include your transactionalMySQLQuery()

    // If already logged in → redirect to products
    if (isset($_SESSION["user_id"])) {
        header("Location: /products/");
        exit();
    }

    // Server-side form submission handling
    $errors = [];
    $success = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Capture POST variables
        $first_name = trim($_POST["first_name"] ?? "");
        $last_name  = trim($_POST["last_name"] ?? "");
        $birth_date = trim($_POST["birth_date"] ?? "");
        $username   = trim($_POST["username"] ?? "");
        $password   = trim($_POST["password"] ?? "");
        $confirm_password = trim($_POST["confirm_password"] ?? "");

        // Basic server-side validation
        if (!$first_name) $errors[] = "First name is required.";
        if (!$last_name)  $errors[] = "Last name is required.";
        if (!$birth_date) $errors[] = "Birth date is required.";
        if (!$username)   $errors[] = "Username is required.";
        if (!$password)   $errors[] = "Password is required.";
        if ($password !== $confirm_password) $errors[] = "Passwords do not match.";

        if (empty($errors)) {
            // --- Auto-create table if not exists ---
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    birth_date DATE NOT NULL,
                    username VARCHAR(50) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
            ";
            $tableResult = transactionalMySQLQuery($createTableQuery);
            if (is_string($tableResult)) {
                $errors[] = "DB Error: " . $tableResult;
            } else {
                // --- Insert new user ---
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO users (first_name, last_name, birth_date, username, password) VALUES (?, ?, ?, ?, ?)";
                $insertResult = transactionalMySQLQuery($insertQuery, [$first_name, $last_name, $birth_date, $username, $hashed_password]);

                if ($insertResult === true) {
                    $success = true;
                } else {
                    $errors[] = "DB Error: " . $insertResult;
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
        <title>Register Account</title>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600">

        <div class="navbar"></div>

        <div class="min-h-screen flex items-center justify-center px-4 pt-24 pb-10">

            <section class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-xl border border-white/40 p-6 sm:p-8 space-y-6">

                <!-- Header -->
                <div class="text-center space-y-1">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Create your Account</h1>
                    <p class="text-gray-500 text-sm">Sign up to start shopping</p>
                </div>

                <!-- Error Messages -->
                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm space-y-1">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="POST" action="" class="space-y-5" id="registerForm">

                    <div>
                        <label class="block text-sm font-medium mb-1">First Name</label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="John"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Last Name</label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="Doe"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Birth Date</label>
                        <input type="date" name="birth_date" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input type="text" name="username" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="johndoe123"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="••••••••"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="••••••••"
                        />
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-semibold tracking-wide transition"
                    >
                        Register
                    </button>

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
        // Client-side password confirmation
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', (e) => {
            const password = form.password.value;
            const confirm = form.confirm_password.value;
            if (password !== confirm) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
        </script>

    </body>
</html>