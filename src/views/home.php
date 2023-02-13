<?php foreach ($products as $i => $product) : ?>
    <?= $product['sku'] ?>
    <?= $product['name'] ?>
    $<?= $product['price'] ?> 
    <?= $product['value'] ?>
<?php endforeach ?>