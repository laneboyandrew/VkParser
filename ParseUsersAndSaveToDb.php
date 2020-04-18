<?php
$servername = "127.0.0.1";
$username = "root";
$port = "3306";
$password = "34343434";
$dbname = "VkParser";
$community = 'aesthetics_moment';
$token = '1c2aec175673bca08623417923aefd110acdb5cca0dbe7fa41dba91584e55ab24a7850e61f3f760b17338';

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully ";
    $values = range(1,10000);

    foreach ($values as $value){
        $sqlInsert = "INSERT INTO User (`vk_id`) VALUES ($value)";
        if($value <= 10000)  {
            $conn->query($sqlInsert);
        }
    }
} catch (Exception $e) {
    "хуй";
}
//    $sqlInsert = "INSERT INTO User `vk_id` = $value";


