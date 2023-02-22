function saveProduct() {
    // Get the value of the input field with id="sku"
    const sku = document.getElementById("sku").value.trim();
    const name = document.getElementById("name").value.trim();
    const price = Number(document.getElementById("price").value);
    const productType = document.getElementById("productType").value;
    const size = document.getElementById("size").value.trim();
    const weight = document.getElementById("weight").value.trim();
    const height = document.getElementById("height").value.trim();
    const width = document.getElementById("width").value.trim();
    const length = document.getElementById("length").value.trim();
    const ulSection = document.getElementById("proList");
    if (ulSection) ulSection.remove();
    const textArray = Array();
    if (sku == "") {
        textArray.push("SKU is Required");
    } else {

    }
    if (name == "") {
        textArray.push("Name is Required");
    }
    if (price == 0) {
        textArray.push("Price is Required and not 0");
    }
    if (productType == "") {
        textArray.push("Product Type is Required");
    } else {
        switch (productType) {
            case "DVD":
                if (size == "") {
                    textArray.push("Size is Required");
                }
                break;
            case "Book":
                if (weight == "") {
                    textArray.push("Weight is Required");
                }
                break;
            case "Furniture":
                if (height == "") {
                    textArray.push("Height is Required");
                }
                if (width == "") {
                    textArray.push("Width is Required");
                }
                if (length == "") {
                    textArray.push("Length is Required");
                }
                break;
        }
    }
    if (textArray.length > 0) {
        var ul = document.createElement('ul');
        ul.setAttribute('id', 'proList');
        document.getElementById('errors').appendChild(ul);
        textArray.forEach(renderProductList);

        function renderProductList(element, index, arr) {
            var li = document.createElement('li');
            li.setAttribute('class', 'item');
            ul.appendChild(li);
            li.innerHTML = li.innerHTML + element;
        }
        document.getElementById('errors').classList.remove('d-none');
    } else {
        document.getElementById('errors').classList.add('d-none');
        $('#submit').removeAttr('onclick');
        $('#submit').attr('form', 'product_form');
        $("#submit").click();
    }
}

function checkSKU() {
    const sku = document.getElementById("sku").value.trim();
    if (sku.length >= 1) {
        $.ajax({
            type: 'post',
            url: "/scandiweb-test/get-sku",
            data: {
                sku: sku,
            },
            success: function (data) {
                if (data == false) {
                    document.getElementById('skuFeedback').classList.add('invalid-feedback');
                    document.getElementById("submit").disabled = false;
                } else {
                    document.getElementById("submit").disabled = true;
                    document.getElementById('skuFeedback').classList.remove('invalid-feedback');
                }

            }
        });
    }
}