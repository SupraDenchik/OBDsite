<?php 
 require_once("includes/connection2.php");
?>
<style>
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
<table border="1" >
    <?php
        echo "<tr><td>"."id"."</td><td>"."продукт"."</td><td>"."ціна"."</td><td>"."склад"."</td><td>"."фірма"."</td></tr>";

        $result = mysqli_query($conn, "SELECT * FROM `product` ");
        $firms = mysqli_query($conn, "SELECT * FROM `firm` WHERE `firm`.`id` IN (SELECT `firm_id` FROM `store` WHERE `store`.`id`IN(SELECT`product`.`store_id`FROM `product`WHERE `product`.`id`=1))");

        while ($r1=mysqli_fetch_assoc($result)) 
        {
            echo "<tr><td>"."$r1[id]"."</td><td>"."$r1[name]"."</td><td>"."$r1[price]₴"."</td><td>"."$r1[store_id]"."</td>";

            $firms = mysqli_query($conn, "SELECT * FROM `firm` WHERE `firm`.`id` IN (SELECT `firm_id` FROM `store` WHERE `store`.`id`IN(SELECT `product`.`store_id`FROM `product`WHERE `product`.`id`=$r1[id]))");

            $firm = mysqli_fetch_assoc($firms);
            echo "<td>". "$firm[FirmName]"." </td><tr></tr>";
        }
    ?>
</table>

<form action="Del.php" method="POST">номер продукту
    <select name="delId">
        <?php
            $result=mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id`"); 

            while ($r1=mysqli_fetch_assoc($result))
            {
                echo"<option >"."$r1[id]"."</option>";
            }
         ?>
    </select>
    <br><input name="del" type="submit" value="видалити"/>
</form>
    <p><a href="main.php"> назад </a></p>
