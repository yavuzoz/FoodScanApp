<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<h1>Tarayıcı Bildirim Testi</h1>
<button id="notify-btn">Bildirim Gönder</button>

<script>
    $(document).ready(function() {
        $("#notify-btn").click(function() {
            // Bildirim gönderme fonksiyonu
            if (!("Notification" in window)) {
                alert("Tarayıcınız bildirimleri desteklemiyor.");
            } else if (Notification.permission === "granted") {
                var notification = new Notification("Merhaba! Bu bir bildirimdir.");
            } else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(function (permission) {
                    if (permission === "granted") {
                        var notification = new Notification("Merhaba! İzin verildi, bu bir bildirimdir.");
                    }
                });
            }
        });
    });
</script>
</body>
</html>