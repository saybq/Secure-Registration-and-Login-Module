<?php
session_start();


if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">

        <!-- Profile Circle -->
        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-3xl font-bold text-gray-700">
                <?php echo strtoupper(substr($user["name"], 0, 1)); ?>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mt-4">
            Welcome!
        </h2>

        <div class="mt-6 space-y-4">

            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="font-semibold"><?php echo htmlspecialchars($user["name"]); ?></p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold"><?php echo htmlspecialchars($user["email"]); ?></p>
            </div>

        </div>

        <a href="logout.php"
           class="block mt-8 bg-red-500 text-white text-center py-2 rounded-lg hover:bg-red-600 transition">
            Logout
        </a>

    </div>

</body>
</html>