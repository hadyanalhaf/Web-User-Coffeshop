<?php
session_start();

include('config.php');

if (isset($_POST['add_to_cart'])) {

    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "product_id");

        if (!in_array($_GET['product_id'], $session_array_id)) {
            $session_array = array(
                'product_id' => $_GET['product_id'],
                "product_name" => $_POST['product_name'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity']
            );
            $_SESSION['cart'][] = $session_array;
        }
    } else {
        $session_array = array(
            'product_id' => $_GET['product_id'],
            "product_name" => $_POST['product_name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity']
        );
        $_SESSION['cart'][] = $session_array;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brain Coffee</title>

    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- nav section start -->
    <?php
    include('navbar.php');
    ?>
    <!-- nav section end -->

    <div class="offcanvas offcanvas-start" style="width: 30%;" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h1 class="pb-3">item selected</h1>
            <?php
            if (!empty($_SESSION['cart'])) {
            ?>
                <table class="text-center" border="1">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($_SESSION['cart'] as $cart => $val) {
                        $subtotal = $val['price'] * $val['quantity'];
                    ?>
                        <tr>
                            <td><?php echo $no++; ?>.</td>
                            <td><?php echo $val['product_name']; ?></td>
                            <td><?php echo $val['price']; ?></td>
                            <td><?php echo $val['quantity']; ?></td>
                            <td><?php echo $subtotal; ?></td>
                        </tr>
                    <?php
                        $grandtotal += $subtotal;
                    }
                    if (isset($_GET['action'])) {
                            unset($_SESSION['cart']);
                    }
                    ?>
                    <tr>
                        <th colspan="4">Grand Total</th>
                        <th><?php echo $grandtotal ?></th>
                        <th>
                            <a href="index.php?action=clearall">
                                <button class="btn btn-dark btn-block">Clear all</button>
                            </a>
                        </th>
                    </tr>
                </table>
                <div class="pt-4">
                    <a href="transaksi.php" class="btn btn-dark" style="width: 22rem;">Pay</a>
                </div>
                
            <?php
            } else {
                echo "Cart is empty";
            }
            ?>
        </div>
    </div>

    <!-- layout section start -->
    <?php
    include('layout.php');
    ?>
    <!-- layout section end -->

    <!-- espresso based section start -->
    <div class="container text-center pt-5">
        <div class="col-sm-12 pb-3 pt-3 text-center">
            <h1 class="fw-bold">Espresso Based</h1>
        </div>
        <div class="row align-items-center text-center flex-nowrap overflow-auto">
            <?php
            while ($row = mysqli_fetch_array($product_id)) {
            ?>
                <div class="col-sm-3 g-2">
                    <div class="card">
                        <form method="post" action="index.php?product_id=<?= $row['product_id'] ?>">
                            <img src="img/<?php echo $row['foto'];?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['product_name']; ?></h5>
                                <p class="card-text"><?= $row['product_description']; ?></p>
                                <h6 class="card-title">Rp <?= $row['price']; ?></h6>
                                <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
                                <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                <div class="pb-3">
                                    <input type="number" name="quantity" value="1" class="form-control text-center">
                                </div>
                                <input type="submit" class="btn btn-dark w-100" name="add_to_cart" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- espresso based section end -->

    <!-- non coffee section start -->
    <div class="container text-center pt-5">
        <div class="col-sm-12 pb-3 pt-5 text-center">
            <h1 class="fw-bold">Signature Non Coffee</h1>
        </div>
        <div class="row align-items-center text-center flex-nowrap overflow-auto">
            <?php
            while ($row = mysqli_fetch_array($product_id1)) {
            ?>
                <div class="col-sm-3 g-2">
                    <div class="card">
                        <form method="post" action="index.php?product_id=<?= $row['product_id'] ?>">
                            <img src="img/<?php echo $row['foto'];?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['product_name']; ?></h5>
                                <p class="card-text"><?= $row['product_description']; ?></p>
                                <h6 class="card-title">Rp <?= $row['price']; ?></h6>
                                <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
                                <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                <div class="pb-3">
                                    <input type="number" name="quantity" value="1" class="form-control text-center">
                                </div>
                                <input type="submit" class="btn btn-dark w-100" name="add_to_cart" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- non coffee section end -->

    <!-- mixology section start -->
    <div class="container text-center pt-5">
        <div class="col-sm-12 pb-3 pt-5 text-center">
            <h1 class="fw-bold">Mixology</h1>
        </div>
        <div class="row align-items-center text-center flex-nowrap overflow-auto">
            <?php
            while ($row = mysqli_fetch_array($product_id2)) {
            ?>
                <div class="col-sm-3 g-2">
                    <div class="card">
                        <form method="post" action="index.php?product_id=<?= $row['product_id'] ?>">
                            <img src="img/<?php echo $row['foto'];?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['product_name']; ?></h5>
                                <p class="card-text"><?= $row['product_description']; ?></p>
                                <h6 class="card-title">Rp <?= $row['price']; ?></h6>
                                <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
                                <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                <div class="pb-3">
                                    <input type="number" name="quantity" value="1" class="form-control text-center">
                                </div>
                                <input type="submit" class="btn btn-dark w-100" name="add_to_cart" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- mixology section end -->

    <!-- snack section start -->
    <div class="container text-center pt-5">
        <div class="col-sm-12 pb-3 pt-5 text-center">
            <h1 class="fw-bold">Snack</h1>
        </div>
        <div class="row align-items-center text-center flex-nowrap overflow-auto">
            <?php
            while ($row = mysqli_fetch_array($product_id3)) {
            ?>
                <div class="col-sm-3 g-2">
                    <div class="card">
                        <form method="post" action="index.php?product_id=<?= $row['product_id'] ?>">
                            <img src="img/<?php echo $row['foto'];?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['product_name']; ?></h5>
                                <p class="card-text"><?= $row['product_description']; ?></p>
                                <h6 class="card-title">Rp <?= $row['price']; ?></h6>
                                <input type="hidden" name="product_name" value="<?= $row['product_name'] ?>">
                                <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                <div class="pb-3">
                                    <input type="number" name="quantity" value="1" class="form-control text-center">
                                </div>
                                <input type="submit" class="btn btn-dark w-100" name="add_to_cart" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- snack section end -->

    <?php
    include('footer.php');
    ?>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>