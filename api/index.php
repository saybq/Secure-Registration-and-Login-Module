<?php
session_start();
require_once __DIR__ . '/dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {

        echo "<script>alert('Please fill in all fields.');</script>";

    } else {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {


            $_SESSION["user"] = [
                "id" => $user["id"],
                "name" => $user["name"],
                "email" => $user["email"]
            ];

            header("Location: dashboard.php");
            exit();

        } else {

            echo "<script>alert('Invalid email or password.');</script>";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-sm bg-white shadow-lg rounded-xl p-8">
        
        <h4 class="text-center text-2xl font-semibold mb-6">Login</h4>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600 text-sm mb-3 text-center">
                Incorrect username or password.
            </p>
        <?php endif; ?>

        <form action="" method="POST"> 
            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Email</label>
               <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="login@gmail.com" 
                    required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                >
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="..............." 
                    required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                >
            </div>

            <button 
                type="submit" 
                class="w-full mt-4 bg-black text-white py-2 rounded-lg hover:opacity-80 transition"
            >
                Login
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Don't have an account? 
            <a href="register.php" class="text-blue-600 hover:underline">Register here</a>
        </p>

    </div>

</body>
</html>



