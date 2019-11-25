<?php
ini_set('display_errors',1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
?>

<html>
<head>
    <?php include_once 'db.php';
    session_start();



    if(empty($_SESSION['userid'])){
        header("location: login.php");
    }

    ?>
</head>
<form action="" method="post">
        <?php
        $userid = $_SESSION['userid'];
        $query= "SELECT * from tblOrder where Userid =:userid";
        $sql = $conn->prepare($query);
        $sql->bindValue('userid',$userid);
        $sql->execute();
        $result = $sql->fetchAll();
        if(!empty($result)){
            echo "<select name='dropdown'>";
        foreach($result as $row){
            $order = $row['OrderNumber'];
            $productid = $row['Productid'];
            echo "<option value='" . $order ."'". (($order==$_POST['dropdown']) ?"selected":"") .">" . $order . "</option>";
        }echo "</select>";
        }else{echo "no orders available";}
        ?>
    </select><br><br>
    <input type="submit" value="calculate">
</form>

<?php
$new_query = "Select Quantity, Productid  from tblOrder where OrderNumber =:ordernumber";
$found = $conn->prepare($new_query);
$found->bindValue('ordernumber',$_POST['dropdown']);
$found->execute();
$order_info = $found->fetch(PDO::FETCH_ASSOC);
$quantity = $order_info['Quantity'];
$product_query = "Select UnitCost from Product where Productid =:productid";
$product_sql = $conn->prepare($product_query);
$product_sql->bindValue('productid',$order_info['Productid']);
$product_sql->execute();
$product_array = $product_sql->fetch(PDO::FETCH_ASSOC);
$price = $product_array['UnitCost'];
echo $price * $quantity;

?>
</html>