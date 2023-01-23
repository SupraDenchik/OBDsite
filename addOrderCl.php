<?php 
 require_once("includes/connection2.php"); 
 session_start();
?>
<!DOCTYPE html>
 <html>
 <head>
    <title>AptekaRomashka</title>
    <style>
    body
   input
        {
            margin: 15px;
            background-color: #7FFF00;
            order-color: #00f;
            font-size: 20px;
        }
        body
        {
            background-color: #FAF0E6;
            color: #0b00da;
            font-size: 20px;
        }
        select
        {
            margin: 15px;
            background-color: #7FFF00;
            order-color: #00f;
            font-size: 20px;
        }
    table
    {
        border-color: #000000;
        color: #0b00da;
        font-size: 20px;
        font-style: italic;

    }

    </style>

 </head>
 <body>
    <table border="1" >
        <?php
            echo "<tr><td>"."id"."</td><td>"."продукт"."</td><td>"."ціна"."</td><td>"."фірма"."</td></tr>";

            $result = mysqli_query($conn, "SELECT * FROM `product` ");
            $firms = mysqli_query($conn, "SELECT * FROM `firm` WHERE `firm`.`id` IN (SELECT `firm_id` FROM `store` WHERE `store`.`id`IN(SELECT`product`.`store_id`FROM `product`WHERE `product`.`id`=1))");

            while ($r1=mysqli_fetch_assoc($result)) 
            {
                echo "<tr><td>"."$r1[id]"."</td><td>"."$r1[name]"."</td><td>"."$r1[price]₴"."</td>";

                $firms = mysqli_query($conn, "SELECT * FROM `firm` WHERE `firm`.`id` IN (SELECT `firm_id` FROM `store` WHERE `store`.`id`IN(SELECT `product`.`store_id`FROM `product`WHERE `product`.`id`=$r1[id]))");

                $firm = mysqli_fetch_assoc($firms);
                echo "<td>". "$firm[FirmName]"." </td><tr></tr>";
            }
        ?>
    </table>

    <form action="addOrderCl.php" method="POST"> номер продукту
        <select name="prodId">
            <?php
                $result=mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id`"); 

                while ($r1=mysqli_fetch_assoc($result))
                {
                    echo"<option >"."$r1[id]"."</option>";
                }
             ?>
        </select>
        <br><input name="addOr" type="submit" value="в корзину"/>
    </form>
        <?php 
        if (isset($_POST['addOr'])) 
        {
            mysqli_query($conn, "INSERT INTO `order` (`id`, `client_id`) VALUES (NULL, $_SESSION[cl_id])");

            $GLOBALS['Orderid']=mysqli_query($conn, "SELECT MAX(`order`.`id`) FROM `order` WHERE `order`.`client_id`=$_SESSION[cl_id];");
        
            $GLOBALS['Orderid'] = mysqli_fetch_array($GLOBALS['Orderid'])[0];

            $prodold=mysqli_query($conn, "SELECT * FROM product WHERE product.id= $_POST[prodId];");
            $prodold=mysqli_fetch_assoc($prodold);
            mysqli_query($conn, "INSERT INTO product (`id`, `name`, `price`, `order_id`, `store_id`) VALUES (NULL, '$prodold[name]', $prodold[price], $GLOBALS[Orderid], $prodold[store_id])");
            header("Location: cabinet.php");
        }
     ?>
     <p><a href="cabinet.php">назад</a></p>

    
</body>