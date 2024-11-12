<?php include 'inc/header.php'; ?>
<?php include 'inc/auth.php'; ?>

<?php

$prod_list_ = $db->FetchAll("*", "prod", "prod_user_id=" . $user['id'], "prod_date ASC");

if ($prod_list_) {
    $expired_ = [];
    $noti_ = [];
    foreach ($prod_list_ as $prod_) {
        if ($prod_['prod_noti'] == 'n') {
            if (getDateType($prod_['prod_date']) == 'expired') {
                $noti_[$prod_['prod_id']] = [
                    'title' => 'Expired Product',
                    'body' => $prod_['prod_name'] . " has expired.",
                    'icon' => url . '/icon.png',
                ];
            }
            if (getDateType($prod_['prod_date']) == 'almost') {
                $noti_[$prod_['prod_id']] = [
                    'title' => 'Almost Product',
                    'body' => 'There are 3 days left for the ' . $prod_['prod_name'] . ' product to expire.',
                    'icon' => url . '/icon.png'
                ];
            }

            $update = $db->Update("prod", postToUpdateQ([
                'prod_id' => $prod_['prod_id'],
                'prod_noti' => 'y'
            ]), "prod_id='" . $prod_['prod_id'] . "'");
        }
    }
}
?>
<main class="p-1 container">
    <h5 class="pb-2 border-bottom border-2 my-2">Product Detail</h5>
    <div>
        <div class="btn-group w-100 gap-1 mb-2">
            <button type="button" class="btn btn-danger">Expired</button>
            <button type="button" class="btn btn-warning">Almost</button>
            <button type="button" class="btn btn-success">Consume</button>
        </div>
        <?php foreach ($prod_list_ as $prod_) : ?>
            <div class="d-flex gap-2 align-items-center border border-1 rounded-2 mb-2 <?= dateColor($prod_['prod_date']) ?>">
                <div style="width: 25%;text-align: center;background: #fff;">
                    <img src="<?= $prod_['prod_img_url'] ?>" class="img-fluid object-fit-contain" style="height: 75px;">
                </div>
                <div style="width: 65%;">
                    <div class="fw-semibold"><?= $prod_['prod_name'] ?></div>
                    <div><?= $prod_['prod_date'] ?></div>
                </div>
                <div class="border-start border-1 d-flex text-decoration-none justify-content-center align-items-center" style="width: 10%;">
                    <a href="edit.php?prod_id=<?= $prod_['prod_id'] ?>" style="height: 100%;" class="link-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (!$prod_list_): ?>
            <div class="px-4 py-5 text-center bg-secondary-subtle" style="min-height: 100vh">
                <h1 class="display-5 fw-bold text-body-emphasis">Not Found Products</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">
                        You can register your products here and sort them by expiration date.
                        Click to add a product.
                    </p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="edit.php" class="btn btn-primary btn-lg px-4 gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
                            </svg>
                            Add Product
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
<script>
    var notifications = <?= json_encode($noti_) ?>;

   

    // Bildirimleri göstermek ve ses çalmak
    function showNotifications() {
        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    sendNotifications();
                } else {
                    alert("Bildirimlere izin vermeniz gerekiyor.");
                }
            });
        } else {
            sendNotifications();
        }
    }

    // Bildirim gönderme işlemi
    function sendNotifications() {
      $.each(notifications, function (index, notificationData) {
                var notification = new Notification(notificationData.title, {
                    body: notificationData.body,
                    icon: notificationData.icon
                });
                // Bildirim geldiğinde ses çal
               
            });
    }

    // Sayfa ile etkileşimi yakalamak için olayları dinleyin
    $(document).on('click scroll', function () {
     
    });

    // Bildirimleri simüle etmek için örnek bir zamanlayıcı
    setTimeout(function () {
        showNotifications();
    }, 5000); // 5 saniye sonra bildirim göster

</script>
<?php include 'inc/footer-menu.php'; ?>
<?php include 'inc/footer.php'; ?>
