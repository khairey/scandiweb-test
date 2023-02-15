<div class="container mt-3">
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Product List</span>
            </a>
            <div class="col-md-3 text-end">
                <form action="/scandiweb-test/delete-products" method="post" id="delete-form" class="d-inline-block">
                    <button for="delete-form" id="delete-product-btn" class="btn btn-danger me-2" type="submit">MASS DELETE</button>
                </form>

                <a href="/scandiweb-test/add-product" type="button" class="btn btn-dark">ADD</a>
            </div>
        </div>
    </header>
    <div class="row">
        <?php foreach ($products as $i => $product) : ?>
            <div class="col-sm-3 mb-4 text-center">
                <div class="card h-100">
                    <input form="delete-form" class="form-check-input mt-2 ms-3" type="checkbox" name="<?= $product['sku'] ?>">
                    <div class="card-body ">
                        <h5 class="card-title"><?= $product['sku'] ?></h5>
                        <h6 class="card-title"><?= $product['name'] ?></h6>
                        <h6 class="card-text">$<?= $product['price'] ?></h6>
                        <p class="card-title"><?= $product['value'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>