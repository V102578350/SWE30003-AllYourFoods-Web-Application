<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Your Healthy Foods | Home</title>
    <?php include('assets/php/parts/meta.php'); ?>
</head>
<body>
    <main>
        <?php include('assets/php/parts/header.php'); ?>
        <?php include('assets/php/parts/hero.php'); ?>

        <div class="shell">
            <div class="section">
                <div class="section-head" data-aos="fade-down" data-aos-duration="750">
                    <h1>Our Range</h1>
                    <p>Explore the "All Your Healthy Foods" Online Store range and begin adding our amazing products to your cart! Don't forget to login or register an account with us.</p>
                </div>
                <div class="product-container">
                    <?php 
                        // Load Products
                        global $database;

                        $products_result = $database->executeQuery("SELECT * FROM `products`");


                        while($row = $products_result->fetch_assoc()) {
                            include 'assets/php/parts/product/tile.php';
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('assets/php/parts/popups/login-popup.php'); ?>
    <?php include('assets/php/parts/popups/register-popup.php'); ?>
</body>
<?php include('assets/php/parts/footer-scripts.php'); ?>
</html>