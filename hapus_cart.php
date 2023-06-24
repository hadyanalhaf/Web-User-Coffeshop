<?php
    include('config.php');

    $id=$_GET['product_id'];

    unset($_SESSION['cart'][$id]);

    header('location:index.php')

?>