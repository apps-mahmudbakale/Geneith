<?php
$db = mysqli_connect('localhost', 'mahmudbakale', 'root', 'store');
 $search_keyword = $_GET['search_keyword'];


 $query = mysqli_query($db,"SELECT * FROM station_products INNER JOIN products ON station_products.product_id = products.id WHERE products.name LIKE '%$search_keyword%' AND station_products.quantity > 0");?>
 <ul class="nav flex-column">
<?php while($row = mysqli_fetch_array($query)){
 ?>
     
       <li class="nav-item">
         <a href="" class="nav-link">
           <strong><?php echo $row['name']; ?></strong>
           <span class="float-right badge bg-primary">&#8358; <?php echo number_format($row['selling_price'],2) ?></span>
         </a>
       </li>
     
 <?php }?>
 </ul>