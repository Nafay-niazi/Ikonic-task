<?php
$api_url = 'https://api.kanye.rest/';
$response = wp_remote_get($api_url);
if (!is_wp_error($response)) {
    $quote = json_decode(wp_remote_retrieve_body($response), true);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kanye West Quotes</title>
</head>
<body>
    <h1>Kanye West Quotes</h1>
    <ul>
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <li><?php echo $quote['quote']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
