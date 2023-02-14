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
                <button type="button" class="btn btn-primary me-2">Save</button>
                <a href="/scandiweb-test/add-product" type="button" class="btn btn-warning">Cancel</a>
            </div>
        </div>
    </header>
    <div class="container">
        <form method="post" id="product_form" class="needs-validation" novalidate>
            <fieldset>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="sku" class="col-form-label">SKU</label>
                    </div>
                    <div class="col-sm-auto position-relative">
                        <input required type="text" id="sku" name="sku" class="form-control" value="">
                        <div id="spinner" class="spinner-border text-primary position-absolute d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div id="skuFeedback" class="invalid-feedback">
                            Please choose a SKU.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 g-3 align-items-center">
                    <div class="col-sm-2 col-lg-1">
                        <label for="name" class="col-form-label">Name</label>
                    </div>
                    <div class="col-sm-auto">
                        <input required type="text" id="name" name="name" value="" class="form-control">
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
                        <input required type="number" step=".01" min=".01" id="price" name="price" value="" class="form-control">
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
                    </select>
                    <div class="invalid-feedback">
                        Please pick a product type.
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>