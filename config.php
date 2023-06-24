<?php
    $con = mysqli_connect('localhost','root');
    mysqli_select_db($con,'braincoffee');
    
    $sql = "
        SELECT * FROM product  WHERE product_category='Coffee';
    ";
    $product_id = $con->query($sql);

    $sql1 = "
        SELECT * FROM product WHERE product_category='Non-Coffee';
    ";
    $product_id1 = $con->query($sql1);

    $sql2 = "
        SELECT * FROM product WHERE product_category='Mixology';
    ";
    $product_id2 = $con->query($sql2);

    $sql3 = "
        SELECT * FROM product WHERE product_category='Snack';
    ";
    $product_id3 = $con->query($sql3);

?>