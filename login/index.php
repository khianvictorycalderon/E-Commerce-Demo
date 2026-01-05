<?php
    session_start();
    require_once("../phps/db.php"); // include your transactionalMySQLQuery()
    require_once("../phps/tables.php") // All table schemas so it is unified

    // If already logged in → redirect to products
    if (isset($_SESSION["user_id"])) {
        header("Location: /products/");
        exit();
    }

    // --- Auto-create users table if it doesn't exist ---
    $tableResult = transactionalMySQLQuery($userTableQuery);
    if (is_string($tableResult)) {
        die("DB Error: " . $tableResult);
    }

    // Handle login submission
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST["username"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if (!$username) $errors[] = "Username is required.";
        if (!$password) $errors[] = "Password is required.";

        if (empty($errors)) {
            $user = transactionalMySQLQuery(
                "SELECT * FROM users WHERE username = ?",
                [$username]
            );

            if (is_string($user)) {
                $errors[] = "DB Error: " . $user;
            } elseif (empty($user)) {
                $errors[] = "Invalid username or password.";
            } else {
                $user = $user[0];
                if (password_verify($password, $user["password"])) {
                    // Success → set session
                    $_SESSION["user_id"] = $user["id"];
                    header("Location: /products/");
                    exit();
                } else {
                    $errors[] = "Invalid username or password.";
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
        <title>Login your Account</title>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600">
        
        <div class="navbar"></div>

        <div class="min-h-screen flex items-center justify-center px-4 pt-16 pb-10">

            <section class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-xl border border-white/40 p-6 sm:p-8 space-y-6">

                <!-- Header -->
                <div class="text-center space-y-1">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                        Welcome back
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Sign in to continue shopping
                    </p>
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
                <form method="POST" action="" class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input
                            type="text"
                            name="username"
                            required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="johndoe123"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-300 border focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                            placeholder="••••••••"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-semibold tracking-wide transition"
                    >
                        Login
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-gray-500 text-sm mt-2">
                        No account? 
                        <a href="/register" class="text-blue-600 hover:text-blue-500 font-medium transition">
                            Register
                        </a>
                    </p>

                </form>

                <p class="text-center text-gray-500 text-xs">
                    Demo authentication — simple, secure, and minimal.
                </p>

            </section>

        </div>

        <div class="footer"></div>

    </body>
</html>
