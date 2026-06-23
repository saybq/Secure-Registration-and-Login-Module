<?php
require_once __DIR__ . '/dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($password)) {
            echo "<script>
                    alert('Missing Credentials');
                    window.location.href = 'register.php';
                </script>";
            exit();
    } else {

        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {

            echo "<script>
                    alert('Email must be UNIQUE!');
                    window.location.href = 'register.php';
                </script>";
            exit();

        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );

            if ($stmt->execute([$name, $email, $hashedPassword])) {

                 echo "<script>
                        alert('Registration successful!');
                        window.location.href = 'login.php';
                    </script>";
                exit();

            } else {

                $message = "Something went wrong. Please try again.";
                $messageColor = "red";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-10">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-5">
        <div class="mb-4">
            <button 
                type="button" 
                onclick="history.back()"
                class="text-gray-400 font-medium hover:text-gray-600 flex items-center"
            >
                <span class="mr-2">&larr;</span> Back
            </button>
        </div>

        <h4 class="text-center text-2xl font-semibold mb-6">Create Account</h4>

        <form action="" method="POST"> <!--../../controllers/register.php-->


            <div class="mb-4">
                <label class="block mb-1 font-medium">Full Name</label>
                <input type="text" name="name" placeholder="John Beluga Doe Jr." required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

            
            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" placeholder="midterm@project.com" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

           
            <div class="mb-4">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password"  placeholder=".............." required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

            <button 
                type="submit" 
                class="w-full mt-4 bg-black text-white py-2 rounded-lg hover:opacity-80 transition">
                Register
            </button>

        </form>

        <p class="text-center mt-4 text-sm">
            Already have an account?
            <a href="index.php" class="text-blue-600 hover:underline">Login here</a>
        </p>

    </div>

    

</body>
</html>
