<html>
<head>
    <?php include 'db.php';
    session_start();
    if(!isset($_SESSION["loggedin"])|| $_SESSION['loggedin']!==true){
        header("location: login.php");
    }

    ?>
</head>
<
</html>