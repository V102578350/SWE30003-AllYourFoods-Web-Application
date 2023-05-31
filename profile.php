<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Your Healthy Foods | Profile</title>
    <?php include('assets/php/parts/meta.php'); ?>
</head>

<body>
    <main>
        <?php include('assets/php/parts/header.php'); ?>
        <?php include('assets/php/parts/hero.php'); ?>

        <div class="shell">
            <div class="section">
                <div class="section-head" data-aos="fade-down" data-aos-duration="750">
                    <h1>Profile</h1>
                    <p>View your personal details and order history!</p>
                </div>

                <div class="section-profile" data-aos="fade-down" data-aos-duration="750">
                    <div class="user-details">
                        <div class="user-image">
                            <img src="assets/images/icons/icon-profile.svg" alt="Profile">
                        </div>
                        <div class="user-info">
                            <?php
                            global $current_user, $database;

                            // Get Current User's Orders

                            $userCurrentOrdersResult = $database->executeQuery("SELECT * FROM orders WHERE user_id = " . $current_user->id . " ORDER BY order_date DESC");

                            $orders = [];

                            while($row = $userCurrentOrdersResult->fetch_assoc()){
                                $orders[] = $row;
                            }
                            ?>
                            <ul>
                                <li>Name: <?= $current_user->firstname . " " . $current_user->lastname; ?></li>
                                <li>Email: <?= $current_user->email ?></li>
                                <li>Username: <?= $current_user->username; ?></li>
                                <li>Address: <?= $current_user->address; ?></li>
                                <li>Status: <?= $current_user->status == 0 ? "Customer" : "Staff"; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="section-orders" data-aos="fade-down" data-aos-duration="750">
                    <h2>My Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total Cost</th>
                                <th>View Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $item): $total_value += $item['price'] * $item['qty']; ?>
                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= $item['order_date'] ?></td>
                                <td>$<?= number_format($item['total_cost'], 2); ?></td>
                                <td>
                                    <a class="btn" href="/confirmation?orderId=<?= $item['id']; ?>">View Order</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php include('assets/php/parts/popups/login-popup.php'); ?>
    <?php include('assets/php/parts/popups/register-popup.php'); ?>
</body>
<?php include('assets/php/parts/footer-scripts.php'); ?>

</html>