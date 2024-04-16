<?php

    $host = 'localhost'; // Хост базы данных
    $username = 'root'; // Имя пользователя базы данных
    $password = ''; // Пароль базы данных
    $dbname = 'hashtag sorter'; // Имя вашей базы данных
    $connect = new mysqli($host, $username, $password, $dbname);


    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if(isset($data['fieldId'])){
        $fieldId = $data['fieldId'];
        // Далее обрабатываете $fieldId по вашим нуждам
    } else {
        // обработка случая, если fieldId отсутствует в данных
    }

    $sql = "SELECT h.id, h.hash_name FROM hashtags h INNER JOIN hash_connect hc ON h.id = hc.hash_id WHERE hc.field_id = '$fieldId'";
    $res = mysqli_query($connect, $sql);

    $selectedHashtags = array();
    while ($row = $res->fetch_assoc()) {
        $selectedHashtags[] = $row;
    }

    echo json_encode($selectedHashtags);    

?>
