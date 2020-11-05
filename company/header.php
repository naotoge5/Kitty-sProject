<<<<<<< HEAD

=======
<?php
include('../assets/functions.php');
if (!isset($_SESSION['id'])) {
    header('Location:authentication/login.php');
} else if (isset($_POST["logout"])) {
    session_destroy();
    header("Location:authentication/login.php");
}
?>
<header>
    <form method="POST" action="">
        <input type="submit" value="ログアウト" name="logout">
    </form>
</header>
>>>>>>> main

