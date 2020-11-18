<?php
if (!isset($_SESSION['id'])) {
    header('Location:authentication/login.php');
} else if (isset($_POST["logout"])) {
    unset($_SESSION['id']);
    $_SESSION['notice'] = 'ログアウトしました';
    header("Location:authentication/login.php");
}
?>

<header>
    <form method="POST" action="">
        <input type="submit" value="ログアウト" name="logout">
    </form>
</header>