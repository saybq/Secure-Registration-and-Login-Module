<?php
session_start();
session_unset();
session_destroy();

echo "<script>
        alert('Logged out Succesful!');
        window.location.href = 'login.php';
    </script>";
exit;