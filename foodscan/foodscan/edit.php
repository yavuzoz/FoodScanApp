<?php include 'inc/header.php'; ?>
<?php include 'inc/auth.php'; ?>
<?php

if (isset($_GET['prod_id'])) {

    $prod_id = escape($_GET['prod_id']);
    $prod_ = $db->Fetch("*", "prod", "prod_id='$prod_id'", '');

    if (empty($prod_)) {
        die("<center>Product not found !</center>");
    }

}

?>
<main>
    <form action="_save.php" method="post">
        <input type="hidden" name="prod_noti" value="n">
        <?php if ($prod_) : ?>
            <input type="hidden" name="prod_id" value="<?= $prod_['prod_id'] ?>">
        <?php endif; ?>
        <div class="j-qrcode" style="display:none;">
            <div id="qr-reader" style="width:100%"></div>
            <div id="qr-reader-results"></div>
        </div>
        <div class="p-1">
            <div class="border border-2 border-dark rounded" style="display: flex;justify-content: center;padding: 10px;">
                <img class="img-fluid j-prod-img" src="<?= $prod_['prod_img_url'] ?? 'https://placehold.co/600x400' ?>">
                <input type="hidden" name="prod_img_url" class="j-prod-img-url" value="<?= $prod_['prod_img_url'] ?? 'https://placehold.co/600x400' ?>">
            </div>
            <button type="button" class="btn btn-outline-primary w-100 mt-1 j-qrcode-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                </svg>
                Tap To Scan Barcode
            </button>

            <div class="m-auto mt-3" style="max-width: 90%">
                <h5 class="pb-2 border-bottom border-2">Product Detail</h5>
                <div class="mb-3">
                    <label for="barcode" class="form-label fw-bolder">Barcode</label>
                    <input type="text" name="prod_barcode" class="form-control j-prod-barcode" id="barcode" placeholder="Product Barcode" value="<?= $prod_['prod_barcode'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label fw-bolder">Product Name</label>
                    <input type="text" name="prod_name" class="form-control j-prod-name" id="name" placeholder="Product Name" value="<?= $prod_['prod_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label fw-bolder">Expiration date</label>
                    <input type="text" name="prod_date" class="form-control j-datepicker" id="date" placeholder="Product Expiration Date" value="<?= $prod_['prod_date'] ?>" required
                           autocomplete="off">
                </div>
                <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Save</button>
                <?php if ($prod_['prod_id']) : ?>
                    <a href="_delete.php?prod_id=<?= $prod_['prod_id'] ?>" class="btn btn-danger w-100 py-2 mb-2">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script>

    $(function () {
        $(".j-datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
        });

        $('.j-qrcode-btn').on('click', function () {
            $('.j-qrcode').toggle();
            var lastResult, countResults = 0;
            var barcode = null;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    barcode = decodedText;
                    $('#qr-reader-results').text("Barcode : " + barcode);
                    $('.j-prod-barcode').val(barcode);
                    const apiUrl = 'https://world.openfoodfacts.org/api/v0/product/' + barcode + '.json';
                    showLoading()
                    fetch(apiUrl)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 1) {
                                const product = data.product;
                                $('.j-prod-name').val(product.product_name);
                                if (product.image_url) {
                                    $('.j-prod-img').attr('src', product.image_url);
                                    $('.j-prod-img-url').val(product.image_url);
                                }
                                $('.j-qrcode').hide();
                            } else {
                                alert('Product NotFound');
                            }
                        })
                        .catch(error => {
                            hideLoading();
                            alert('Error occurred during API request:' + error);
                        }).finally(() => {
                        hideLoading();
                    });
                }
            }

            function showLoading() {
                document.getElementById('loadingOverlay').style.display = 'block';
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').style.display = 'none';
            }

            const formatsToSupport = [
                Html5QrcodeSupportedFormats.CODE_39,
                Html5QrcodeSupportedFormats.CODE_93,
                Html5QrcodeSupportedFormats.CODE_128,
                Html5QrcodeSupportedFormats.ITF,
                Html5QrcodeSupportedFormats.EAN_13,
                Html5QrcodeSupportedFormats.EAN_8,
                Html5QrcodeSupportedFormats.UPC_A,
                Html5QrcodeSupportedFormats.UPC_E,
                Html5QrcodeSupportedFormats.RSS_EXPANDED,
            ];


            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: {width: 250, height: 100},
                    formatsToSupport: formatsToSupport
                });
            html5QrcodeScanner.render(onScanSuccess);
        })
    })


</script>
<?php include 'inc/footer-menu.php'; ?>
<?php include 'inc/footer.php'; ?>
