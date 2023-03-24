<?php
require_once('config/dbf.php');
// $cusid='MIVIDUOPODSF60';
$query = "SELECT * from products where product_tags LIKE '%MIVIDUOPODSF60%'";
// $query = rtrim($query, " AN");
// $query2 ="SELECT * from orders where id=(select id from order_items)";


$result = mysqli_query($con,$query);
// $result2= mysqli_query($con,$query2);
while($row = mysqli_fetch_assoc($result))
{
    echo $row['id'];
}
echo 10;
?>
