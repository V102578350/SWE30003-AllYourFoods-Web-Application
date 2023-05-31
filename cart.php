<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Your Healthy Foods | Cart</title>
    <?php include('assets/php/parts/meta.php'); ?>
</head>

<body>
    <main>
        <?php include('assets/php/parts/header.php'); ?>
        <?php include('assets/php/parts/hero.php'); ?>

        <div class="shell">
            <div class="section">
                <div class="section-head" data-aos="fade-down" data-aos-duration="750">
                    <h1>Cart</h1>
                    <p>View the products in your cart and confirm your order! Make sure you haven't missed anything you might need.</p>
                </div>

                <div class="cart" data-aos="fade-down" data-aos-duration="750">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th width="40"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $items = $order->getCartItemsDetails();
                                $totalValue = 0;
                            ?>

                            <?php foreach($items['items'] as $item): $totalValue += $item['price'] * $item['qty']; ?>
                            <tr>
                                <td><?= $item['name']; ?></td>
                                <td>$<?= number_format($item['price'], 2); ?></td>
                                <td><?= $item['qty']; ?></td>
                                <td>$<?= number_format($item['price'] * $item['qty'], 2); ?></td>
                                <td><a class="btn js-remove-cart-item" data-item-qty="<?= $item['qty'] ?>" data-item-id="<?= $item['id'] ?>" href="#">Remove</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="cart-total">
                        <p><strong>Tax: </strong> $<?= number_format($totalValue / 10, 2); ?></p>
                        <p><strong>Total Cost: </strong> $<?= number_format($totalValue, 2); ?></p>
                    </div>
                    <a class="btn" href="index">Browse Products</a>
                    <button class="js-checkout-cart btn">Checkout</button>
                </div>

            </div>
        </div>
    </main>
    <?php include('assets/php/parts/popups/login-popup.php'); ?>
    <?php include('assets/php/parts/popups/register-popup.php'); ?>
</body>
<?php include('assets/php/parts/footer-scripts.php'); ?>

</html>