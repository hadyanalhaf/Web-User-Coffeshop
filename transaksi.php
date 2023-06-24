<?php

    include('config.php');

    $sql = "INSERT INTO `penjualan`(`transaction_id`, `transaction_date`, `transaction_time`, `customer_id`, `product_id`, `quantity`, `total_spend`) 
    VALUES 
    ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    $query = mysqli_query($con,$sql);

?>