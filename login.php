<html>
<head>
    <?php include "db.php";
    if(!empty($_POST))
    {
        if(!empty($_POST['login']))
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $query = "select Password, Userid from User where Username=:username";
            $sql = $conn->prepare($query);
            $sql->bindValue("username", $username);
            $sql->execute();
            $user = $sql->fetchAll();
            if(empty($user))
            {
                $error[] = "Username and password do not match";
            }
            else
            {
                if($user[0]['Password'] == sha1($password))
                {
                    $_SESSION['userid'] = $user[0]['Userid'];
                    header('Location: orders.php');
                }
                else
                {
                    $error[] = "Username and password do not match";
                }
            }
        }
    }


    ?>

</head>
<body>
<form action="" method="post">
    Username: <input type="text" name="username"/><br><br>
    Password: <input type="password" name="password"/><br><br>
    <input type="submit" name="login" value="Login"/><br><br>
    <span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
</form>
</body>
</html>

</html>