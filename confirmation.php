<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Your Healthy Foods | Order ID #<?= $_GET['orderId']; ?></title>
    <?php include('assets/php/parts/meta.php'); ?>
</head>
<body>
    <main>
        <?php include('assets/php/parts/header.php'); ?>
        <?php include('assets/php/parts/hero.php'); ?>

        <div class="shell">
            <div class="section">

                <?php 
                    // Get Order Details by ID
                    global $database;

                    $sql = "SELECT * FROM orders WHERE id = " . $_GET['orderId'] . " LIMIT 1";
                    $orderResult = $database->executeQuery($sql);
                    $orderData = $orderResult->fetch_assoc();

                    if(!empty($orderData)) {
                        $orderUserID = $orderData['user_id'];
                        $orderItems = json_decode($orderData['order_items'], true);
                        $orderTotalCost = $orderData['total_cost'];
                        $orderDate = $orderData['order_date'];
                    }
                ?>

                <div class="section-head" data-aos="fade-down" data-aos-duration="750">
                    <h1>Order Details</h1>
                    <p>Order ID: #<?= $_GET['orderId']; ?></p>
                    <p>User ID: #<?= $orderUserID; ?></p>
                    <p>Date: <?= $orderDate; ?></p>
                </div>


                <div class="cart" data-aos="fade-down" data-aos-duration="750">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orderItems as $item): ?>
                            <tr>
                                <td><?= $item['name']; ?></td>
                                <td>$<?= number_format($item['price'], 2); ?></td>
                                <td><?= $item['qty']; ?></td>
                                <td>$<?= number_format($item['price'] * $item['qty'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="cart-total">
                        <p><strong>Tax: </strong> $<?= number_format($orderTotalCost / 10, 2); ?></p>
                        <p><strong>Total Cost: </strong> $<?= number_format($orderTotalCost, 2); ?></p>
                    </div>
                    <a class="btn" href="profile">My Profile</a>
                    <a class="btn" href="index">Browse Products</a>
                </div>
            </div>   
        </div>
    </main>
    <?php include('assets/php/parts/popups/login-popup.php'); ?>
    <?php include('assets/php/parts/popups/register-popup.php'); ?>
</body>
<?php include('assets/php/parts/footer-scripts.php'); ?>
</html>