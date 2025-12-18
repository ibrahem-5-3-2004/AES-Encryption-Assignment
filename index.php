<?php
// إعدادات التشفير - AES-256-CBC
$method = "AES-256-CBC";
$key = "12345678901234567890123456789012"; 
$iv = "1234567890123456"; 

$output = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = $_POST['user_text'];

    if (isset($_POST['encrypt'])) {
        // عملية التشفير
        $output = openssl_encrypt($userInput, $method, $key, 0, $iv);
        $message = "Encrypted Text (Base64):";
    } 
    elseif (isset($_POST['decrypt'])) {
        // عملية فك التشفير
        $output = openssl_decrypt($userInput, $method, $key, 0, $iv);
        $message = "Decrypted Plaintext:";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AES Assignment</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 50px; text-align: center; }
        .box { background: white; padding: 20px; display: inline-block; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        textarea { width: 400px; height: 100px; display: block; margin: 10px auto; }
        .btns { margin-top: 10px; }
        .res { margin-top: 20px; background: #eee; padding: 10px; border: 1px solid #ccc; max-width: 400px; word-wrap: break-word; }
    </style>
</head>
<body>

<div class="box">
    <h2>AES Encryption Tool</h2>
    <form method="post">
        <textarea name="user_text" required><?php echo isset($_POST['user_text']) ? $_POST['user_text'] : ''; ?></textarea>
        <div class="btns">
            <input type="submit" name="encrypt" value="Encrypt (تشفير)">
            <input type="submit" name="decrypt" value="Decrypt (فك تشفير)">
        </div>
    </form>

    <?php if ($output !== ""): ?>
        <div class="res">
            <strong><?php echo $message; ?></strong>
            <p><?php echo $output; ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
