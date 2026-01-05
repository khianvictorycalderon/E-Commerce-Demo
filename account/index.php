<?php
session_start();
require_once("../phps/db.php"); // transactionalMySQLQuery()

// If not logged in → redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}

$user_id = $_SESSION["user_id"];
$errors = [];
$success_info = false;
$success_password = false;
$success_delete = false;

// Fetch current user info
$userData = transactionalMySQLQuery("SELECT * FROM users WHERE id = ?", [$user_id]);
if (is_string($userData) || empty($userData)) {
    die("Error fetching user data: " . (is_string($userData) ? $userData : "User not found"));
}
$user = $userData[0];

// --- Update Info ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_info"])) {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name  = trim($_POST["last_name"] ?? "");
    $birth_date = trim($_POST["birth_date"] ?? "");

    if (!$first_name) $errors[] = "First name is required.";
    if (!$last_name)  $errors[] = "Last name is required.";
    if (!$birth_date) $errors[] = "Birth date is required.";

    if (empty($errors)) {
        $updateResult = transactionalMySQLQuery(
            "UPDATE users SET first_name = ?, last_name = ?, birth_date = ? WHERE id = ?",
            [$first_name, $last_name, $birth_date, $user_id]
        );

        if ($updateResult === true) {
            $success_info = true;
            // Refresh user data
            $user = transactionalMySQLQuery("SELECT * FROM users WHERE id = ?", [$user_id])[0];
        } else {
            $errors[] = "DB Error: " . $updateResult;
        }
    }
}

// --- Update Password ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_password"])) {
    $old_password = trim($_POST["old_password"] ?? "");
    $new_password = trim($_POST["new_password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    if (!$old_password || !$new_password || !$confirm_password) {
        $errors[] = "All password fields are required.";
    } elseif (!password_verify($old_password, $user["password"])) {
        $errors[] = "Old password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $errors[] = "New passwords do not match.";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $passResult = transactionalMySQLQuery(
            "UPDATE users SET password = ? WHERE id = ?",
            [$hashed, $user_id]
        );

        if ($passResult === true) {
            $success_password = true;
        } else {
            $errors[] = "DB Error: " . $passResult;
        }
    }
}

// --- Delete Account ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_account"])) {
    $del_password = trim($_POST["delete_password"] ?? "");

    if (!$del_password) {
        $errors[] = "Password is required for account deletion.";
    } elseif (!password_verify($del_password, $user["password"])) {
        $errors[] = "Password is incorrect.";
    } else {
        $deleteResult = transactionalMySQLQuery("DELETE FROM users WHERE id = ?", [$user_id]);
        if ($deleteResult === true) {
            session_destroy();
            header("Location: /login/");
            exit();
        } else {
            $errors[] = "DB Error: " . $deleteResult;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Settings</title>
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
    </head>
    <body class="bg-gray-50 min-h-screen">

        <div class="logged-navbar"></div>

        <main class="container mx-auto px-4 pt-32 pb-16 space-y-16">

            <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Account Settings</h1>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm space-y-1 max-w-2xl mx-auto">
                    <?php foreach ($errors as $e): ?>
                        <p><?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Update Info Section -->
            <section class="bg-white rounded-2xl shadow p-6 max-w-2xl mx-auto space-y-4">
                <h2 class="text-xl font-semibold text-blue-600">Update Information</h2>
                <?php if($success_info): ?>
                    <div class="bg-green-100 text-green-700 p-2 rounded text-sm">Information updated successfully!</div>
                <?php endif; ?>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="update_info">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username (cannot change)</label>
                        <input type="text" class="w-full px-4 py-2 rounded-xl border border-gray-300 bg-gray-100 cursor-not-allowed" value="<?= htmlspecialchars($user['username']) ?>" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" class="w-full px-4 py-2 rounded-xl border border-gray-300" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" class="w-full px-4 py-2 rounded-xl border border-gray-300" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                        <input type="date" name="birth_date" class="w-full px-4 py-2 rounded-xl border border-gray-300" value="<?= htmlspecialchars($user['birth_date']) ?>" required>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl transition">Update Info</button>
                </form>
            </section>

            <!-- Update Password Section -->
            <section class="bg-white rounded-2xl shadow p-6 max-w-2xl mx-auto space-y-4">
                <h2 class="text-xl font-semibold text-blue-600">Update Password</h2>
                <?php if($success_password): ?>
                    <div class="bg-green-100 text-green-700 p-2 rounded text-sm">Password updated successfully!</div>
                <?php endif; ?>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="update_password">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Old Password</label>
                        <input type="password" name="old_password" class="w-full px-4 py-2 rounded-xl border border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="new_password" class="w-full px-4 py-2 rounded-xl border border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="w-full px-4 py-2 rounded-xl border border-gray-300" required>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl transition">Update Password</button>
                </form>
            </section>

            <!-- Delete Account Section -->
            <section class="bg-white rounded-2xl shadow p-6 max-w-2xl mx-auto space-y-4">
                <h2 class="text-xl font-semibold text-blue-600">Delete Account</h2>
                <p class="text-sm text-gray-600">Enter your password to permanently delete your account. This action cannot be undone.</p>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="delete_account">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="delete_password" class="w-full px-4 py-2 rounded-xl border border-gray-300" required>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-red-600 hover:bg-red-500 text-white font-semibold rounded-xl transition">Delete Account</button>
                </form>
            </section>

        </main>

        <div class="footer"></div>

    </body>
</html>