<?php 
     require_once("includes/connection2.php");
     
     mysqli_query($conn, "DELETE FROM `product` WHERE `product`.`id` = $_POST[delId]");
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
<p><a href="main.php"> Елемент успішно видалено </a></p>