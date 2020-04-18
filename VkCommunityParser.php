<?php

$servername = "127.0.0.1";
$username = "root";
$port = "3306";
$password = "34343434";
$dbname = "VkParser";
$community = 'mudakoff';
#В качестве токена используется service key от моего приложения вк
$token = '99312c2f99312c2f99312c2f1f995cdbc59993199312c2fc4fa932d2d2e8f8d6279394f';


try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully ";
    $sql = "SELECT (`vk_id`) FROM User";

    $userIds = $conn->query($sql);
    foreach ($userIds as $userId) {
        $id = $userId[0];
        $sqlSuccesInsert = "UPDATE User SET `is_member` = 1 WHERE `vk_id` = $id";
        $sqlFailInsert = "UPDATE User SET `is_member` = 2 WHERE `vk_id` = $id";
        $answer = json_decode(file_get_contents(
            "http://api.vk.com/method/groups.isMember?&group_id=$community&user_id=$id&access_token=$token&v=5.68"));
        print_r($answer);
        if ($answer->response == 1) {
            $conn->query($sqlSuccesInsert);
        } else {
            $conn->query($sqlFailInsert);
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
