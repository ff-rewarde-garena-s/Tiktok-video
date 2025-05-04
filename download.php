<?php
function cleanUrl($url) {
    return htmlspecialchars(strip_tags(trim($url)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    $tiktokUrl = urlencode(cleanUrl($_POST['url']));
    $snaptikUrl = "https://snaptik.app/abc2.php";
    $postFields = "url=" . $tiktokUrl;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $snaptikUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_REFERER, "https://snaptik.app/");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");

    $response = curl_exec($ch);
    curl_close($ch);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Download Result | TikTok Video Downloader</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f0f0;
                text-align: center;
                padding: 30px;
            }
            .box {
                background: white;
                padding: 30px;
                max-width: 600px;
                margin: auto;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            a.button {
                display: inline-block;
                margin: 10px;
                padding: 10px 20px;
                background: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>Download Links:</h2>
            <?php
            if (preg_match_all('/https:\/\/cdn\.snaptik\.app\/file\/[^"]+/', $response, $matches)) {
                foreach ($matches[0] as $link) {
                    echo "<a class='button' href='$link' target='_blank'>Download Now</a><br/>";
                }
            } else {
                echo "<p>No download links found. Please check the TikTok link.</p>";
            }
            ?>
            <br><br>
            <a href="index.html" class="button" style="background:#555;">Go Back</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "<p>Invalid request.</p>";
}
?>


