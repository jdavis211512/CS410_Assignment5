<html>
<?php
//ini_set('display_errors',1);
//ini_set("display_startup_errors",1);
//error_reporting(E_ALL);
//?>
<head>
    <?php
    function search($searchTerm){
        $url = 'https://itunes.apple.com/search?term=searchTerm=' . urlencode($searchTerm);
        $result = file_get_contents($url);
        if($result !== false){
            return json_decode($result,true);
        }
        return false;
    }
    ?>
</head>
<body>
<form name="form" action="" method="post">
    <input type="text" name="search"><br>
    <input type="submit"><br>
</form>
</body>
</html>
<?php
    if(!empty($_POST['search'])){
        $result = search($_POST['search']);
        var_dump($result);
    }
?>