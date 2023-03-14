<div class="container mt-3">
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Product Add</span>
            </a>
            <div class="col-md-3 text-end">
                <button onclick="saveProduct()" id="submit"  class="btn btn-primary me-2" type="submit">Save</button>
                <a href="/scandiweb-test/" type="button" class="btn btn-warning" type="submit">Cancel</a>
            </div>
        </div>
    </header>
    <?php if (!empty($errors)) : ?>
        <div class="container mb-5 alert alert-danger">
            <h5>Data didn't pass the server-side validation!</h5>
            <ul class="m-0">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div id="errors" class="container mb-5 alert alert-danger d-none">
    </div>
    <div class="container">
        <form method="post" id="product_form">
            <fieldset>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="sku" class="col-form-label">SKU</label>
                    </div>
                    <div class="col-sm-auto position-relative">
                        <input placeholder="EX: UGCYS7856" onfocusout="checkSKU()" type="text" id="sku" name="sku" class="form-control" value="<?= $product->data['sku'] ?? '' ?>">
                        <div id="skuFeedback" class="invalid-feedback">
                            Please choose not duplicated SKU.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="name" class="col-form-label">Name</label>
                    </div>
                    <div class="col-sm-auto">
                        <input placeholder="EX: Table" required type="text" id="name" name="name" value="<?= $product->data['name'] ?? '' ?>" class="form-control">
                        <div class="invalid-feedback">
                            Please choose a name.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="price" class="col-form-label">Price ($)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input placeholder="EX: 500" required type="number" step=".01" min=".01" id="price" name="price" value="<?= $product->data['price'] ?? '' ?>" class="form-control">
                        <div class="invalid-feedback">
                            Please set a valid price.
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-5 g-3 align-items-center">
                <div class="col-sm-2 col-lg-1">
                    <label for="productType">Product Type</label>
                </div>
                <div class="col-sm-auto">
                    <select required id="productType" name="type" class="form-select">
                        <option value="">Type Switcher</option>
                        <?php foreach ($product::$types ?? '' as $value) : ?>
                            <option <?php if($product->data['type'] == $value) echo 'selected' ?> value="<?= $value ?>"><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        Please pick a product type.
                    </div>
                </div>
            </div>

            <div id="DVD" class="inv">
                <div class="row mb-1">
                    <legend>Provide size</legend>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="size" class="col-form-label">Size (MB)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input placeholder="Size in MB" type="number" step="1" min="1" id="size" name="size" value="<?= $product->data['size'] ?? '' ?>" class="form-control">
                        <div class="invalid-feedback">
                            Please set a valid size.
                        </div>
                    </div>
                </div>
            </div>
            <div id="Book" class="inv">
                <div class="row mb-1">
                    <legend>Provide weight</legend> 
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="weight" class="col-form-label">Weight (KG)</label>
                    </div>
                    <div class="col-sm-auto">
                        <input placeholder="Weight in KG" type="number" step="1" min="1" id="weight" value="<?= $product->data['weight'] ?? '' ?>" name="weight" class="form-control">
                        <div class="invalid-feedback">
                            Please set a valid weight.
                        </div>
                    </div>
                </div>
            </div>
            <div id="Furniture" class="inv">
                <div class="row mb-1">
                    <legend>Provide dimensions</legend>
                </div>
                <div class="row mb-3 g-3 input-group">
                    <div class="col-sm-2 col-lg-4">
                        <label for="size" class="col-form-label">Height (CM) x Width (CM) x Length (CM)</label>
                    </div>
                    <input placeholder="Height in CM" type="number" step="1" min="1" id="height" name="height" class="form-control" value="<?= $product->data['height'] ?? '' ?>">
                    <input placeholder="Width in CM" type="number" step="1" min="1" id="width" name="width" class="form-control" value="<?= $product->data['width'] ?? '' ?>">
                    <input placeholder="Length in CM" type="number" step="1" min="1" id="length" name="length" class="form-control" value="<?= $product->data['length'] ?? '' ?>">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    <?php if(!empty($product->data['type'])){ ?>
        'use strict';
        var vis = document.querySelector('.vis'),
            target = document.getElementById('<?=$product->data['type']?>');
        if (vis !== null) {
            vis.className = 'inv';
        }
        if (target !== null) {
            target.className = 'vis';
        }
    <?php } ?>
    document.getElementById('productType').addEventListener('change', function() {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script>