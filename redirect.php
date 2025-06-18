<?php
    if (isset($_SESSION['username'])) {
        header("Location: ../pages/index.php");
    } else {
        header("Location: ../login.php");
    }
    exit();
?>
