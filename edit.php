<?php 
 require_once("includes/connection2.php");
  if(empty( $_POST['nameprod'])||empty($_POST['price']))
{
            header("Location: poba3.php");
            die();
}
 mysqli_query($conn, "UPDATE `product` SET `name` = '$_POST[nameprod]', `price` = $_POST[price], `order_id` = $_POST[order_id], `store_id` = $_POST[stock_id] WHERE `product`.`id` = $_POST[delId];");
?>
<style>
    body
    {
        background-color: #FAF0E6;
    }
    a
    {
        color: #0b00da;
        font-size: 40px;
    }
    a:hover
    {
        color: #45aaff;
    }
</style>
<p><a href="main.php"> Елемент успішно відредаговано </a></p>