<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include 'assets/php/classes/DatabaseConnector.php';
include 'assets/php/classes/Authentication.php';
include 'assets/php/classes/Order.php';
include 'assets/php/classes/ProductFactory.php';

global $database, $current_user, $product_factory;

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$authentication = new Authentication($database);
$order = new Order($database);
$product_factory = new ProductFactory();

$current_user = $authentication->getCurrentUser();
?>

<header class="header">
    <a class="header-title-section" href="index">
        <img src="assets\images\icons\icon-business.png" alt="All Your Health">
        <div class="header-title-section-text">
            <h4>All Your Healthy Foods</h2>
            <h5>Online Grocery Needs</h5>
        </div>
    </a>

    <div class="header-user-section">
        <?php if($current_user == null) : ?>
            <button class="btn btn-green js-login-popup">Sign in</button>
            <button class="btn btn-green js-register-popup">Register</button>
        <?php else: ?>
            <div class="user-container">
                <div class="user-info">
                    <h4><?= $current_user->firstname; ?> <?= $current_user->lastname; ?></h4>

                    <ul>
                        <li><?= $current_user->status == 0 ? "Customer" : "Staff"; ?> </li>
                        <li><a href="profile">My Profile</a></li>
                        <li><a class="logout" href="#">Sign Out</a></li>
                    </ul>
                </div>

                <div class="user-icon-links">
                    <a href="profile">
                        <img class="profile-icon" src="assets/images/icons/icon-profile.svg" alt="Profile">
                    </a>

                    <a href="cart" class="cart-link js-cart-item-count" data-item-count="0">
                        <img class="cart-icon" src="assets/images/icons/icon-cart.svg" alt="Cart">
                    </a>
                </div>
            </div>

        <?php endif; ?>
    </div>
</header>