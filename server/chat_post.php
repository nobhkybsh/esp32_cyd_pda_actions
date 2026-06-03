<?php
$message = $_GET['message'] ?? '';
$nickname = $_GET['nickname'] ?? '';
$messages_data = file_get_contents("chat_data.txt");
$messages = explode("\n", $messages_data);

if(strlen($message) == 0) {
        echo "Message required\n";
        die();
}
if(strlen($message) > 80) {
        echo "Message too long\n";
        die();
}

if(strlen($nickname) == 0) {
        echo "Nickname required\n";
        die();
}
if(strlen($nickname) > 80) {
        echo "Nickname too long\n";
        die();
}

// Remove old messages until
while(count($messages) > 32) {
        array_pop($messages);
}

$timestamp_message = date("H:i") . " " . $nickname . ": " . $message;
array_unshift($messages, $timestamp_message);

file_put_contents("chat_data.txt", implode("\n", $messages));

echo "ok";
