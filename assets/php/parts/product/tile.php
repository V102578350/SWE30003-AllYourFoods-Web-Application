<?php 
    global $product_factory, $current_user;
    $product = $product_factory->create(
        $row['id'],
        $row['name'],
        $row['category'],
        json_decode($row['attributes'], true),
        $row['price'],
        $row['stock'],
        $row['disabled']
    );
?>

<div class="product" id="product-<?= $product->getID(); ?>" data-aos="fade-up" data-aos-duration="750">
    <div class="product-image">
        <img src="assets/images/placeholder-image.webp" alt="<?= $product->getName(); ?>">
    </div>

    <div class="product-info">
        <h4><?= $product->getName(); ?></h4>
        <h5>$<?= number_format($product->getPrice(), 2); ?></h5>
        <p><?= ucwords(implode(', ', $product->getDetails())); ?></p>
    </div>

    <div class="product-inputs" data-product-id="<?= $product->getID(); ?>">
        <div class="input-container">
            <label for="product-qty-<?= $product->getID(); ?>">Quantity:</label>
            <input type="number" value="1" step="1" name="product-qty-<?= $product->getID(); ?>" id="product-qty-<?= $product->getID(); ?>">
        </div>
        <button class="btn js-add-item-cart<?= $current_user !== null ? ' logged-in' : "" ?>">Add to cart</button>
    </div>
</div>