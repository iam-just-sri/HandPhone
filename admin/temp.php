<?php
require_once('config/dbf.php');
$query = "SELECT * from order_items where customer_id=16";
// $query2 ="SELECT * from orders where id=(select id from order_items)";


$result = mysqli_query($con,$query);
// $result2= mysqli_query($con,$query2);
?>
<table class="table table-invoice table-bordered">
							<tr style="color: #73737b; font-weight: bold;">
								<td style="width: 5%" class="text-center">Order Id</td>
                                <td style="width: 12%" class="text-center">Order Date</td>
								<td style="width: 12%"class="text-center"> Product Name </td>
								<td style="width: 8%" class="text-center"> Total </td>
								<td style="width: 8%" class="text-center"> Payment Method </td>
								<td style="width: 9%" class="text-center"> Transaction Status </td>
                                <td style="width: 9%" class="text-center"> Order Status </td>
							</tr>
							<tbody class="text-center">
							<tr>
                                <?php
                                    
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                ?>
                                    <td><?php echo $row['id']; ?> </td>
                                    <td>
                                        <?php
                                        $newo1 = $row['id'];
                                        $query3 = "SELECT * from orders where orders.id=$newo1";
                                        $result3 = mysqli_query($con,$query3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        echo $row3['order_date'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $newo = $row['product_id'];
                                            $query2 = "SELECT * from products where products.id=$newo";
                                            $result2 = mysqli_query($con,$query2);
                                            $row2 = mysqli_fetch_assoc($result2);

                                            echo $row2['product_name'];
                                        ?> 
                                    </td>
                                    <td>
                                        <?php  
                                        

                                        echo '₹ '.$row3['grand_total'];
                                        ?> 
                                    </td>
                                    <td>
                                        <?php  
                                       
                                        echo $row3['payment_method'];
                                        ?> 
                                    </td>
                                    <td>
                                        <?php  
                                        
                                        echo $row3['transaction_status'];
                                        ?> 
                                    </td>
                                    <td>
                                        <?php  
                                        
                                        echo $row3['order_item_status'];
                                        ?> 
                                    </td>
                            </tr>

                                <?php
                                    }
                            
                                ?>
								
                            </tbody>
                            <tfoot>
							<tr>
								<td colspan="8" class="clearfix">
									<div class="float-right">
										<a href="dashboard.php" class="btn btn-outline-success">Back to Dashboard</a>
									</div>
								</td>
							</tr>                    
						</tfoot>
</table>
