<?php
    session_start();
    if(isset($_POST['food'])){
        $_SESSION['food'] = $_POST['food'];
    }
    if(isset($_SESSION['food'])){
        echo '你喜欢吃:'.$_SESSION['food'];
    }
?>

<form action = "test.php" method="post">
    <input name ="food">
    <input type="submit">
</form>