<?php

$db = require('db.php');
$connect = mysqli_connect($db['host'], $db['username'], $db['password'], $db['database']);
if (mysqli_connect_errno()) print_r(mysqli_connect_error());

if (!isset($_GET['p'])) $_GET['p'] = 'hashs';



if(isset($_POST['add-channel'])){
    $sql = "INSERT INTO `channels`(
        `name`, `description`, `fav`) 
        VALUES (  
            '".htmlspecialchars($_POST['name'])."',
            '".htmlspecialchars($_POST['description'])."',
            '".$_POST['fav']."'
        )";
    mysqli_query($connect, $sql);
}

if(isset($_POST['add-post'])){
    $post_description = $_POST['description'];
    $selected_channel = $_POST['channel'];

    // Поиск хэштега
    $hash_pattern = '/#([^\s#]+)/u';
    if (preg_match($hash_pattern, $post_description, $matches)) {
        $hashtag = $matches[1];
    }
    
    // Запись хэштега в соответствующую таблица
    $sql = "INSERT INTO `hashtags` (`hash_name`) VALUES ('".htmlspecialchars($hashtag)."')";
    mysqli_query($connect, $sql);

    $hashtag_id = mysqli_insert_id($connect);

    // Получение id канала
    $sql = "SELECT id FROM channels WHERE name = '$selected_channel'";
    $res = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($res);
    $channel_id = $row['id'];

    mysqli_free_result($res);

    // Получение fav канала
    $sql = "SELECT fav FROM channels WHERE name = '$selected_channel'";
    $res = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($res);
    $fav = $row['fav'];

    mysqli_free_result($res);

    // Отправление данных в БД
    $sql = "INSERT INTO `posts`(
        `hash_id`, `channel_id`, `description`, `save`) 
        VALUES (  
            '".htmlspecialchars($hashtag_id)."',
            '".htmlspecialchars($channel_id)."',
            '".htmlspecialchars($_POST['description'])."',
            '".htmlspecialchars($fav)."'
        )";
    mysqli_query($connect, $sql);
}

if(isset($_POST['add-field'])) {
    $sql = "INSERT INTO `field`(
        `field_name`, `description`) 
        VALUES (
            '".htmlspecialchars($_POST['field-name'])."',
            '".htmlspecialchars($_POST['description'])."'
        )";
    mysqli_query($connect, $sql);

    $field_id = $connect->insert_id;

    // Получение id хэштегов, которые были отправлены через форму
    $hashtags = $_POST['hashtags'];

    $hash_ids = [];
    foreach ($hashtags as $hashtag) {
        $sql = "SELECT id FROM `hashtags` WHERE hash_name = '$hashtag'";
        $res = mysqli_query($connect, $sql);
        if ($row = $res->fetch_assoc()) {
            $hash_ids[] = $row['id'];
        }
    }

    // Добавление связей в таблицу hash_connect
    foreach ($hash_ids as $hash_id) {
        $sql = "INSERT INTO `hash_connect` (`hash_id`, `field_id`) VALUES (
                '".htmlspecialchars($hash_id)."',
                '".htmlspecialchars($field_id)."'
            )";
        mysqli_query($connect, $sql);
    }
}

if(isset($_POST['update-field'])) {
    $field_id = $_POST['field_id'];

    $sql = "DELETE FROM `hash_connect` WHERE `field_id` = '$field_id'";
    mysqli_query($connect, $sql);

    $hashtags = $_POST['hashtags'];

    $hash_ids = [];
    foreach ($hashtags as $hashtag) {
        $sql = "SELECT id FROM `hashtags` WHERE hash_name = '$hashtag'";
        $res = mysqli_query($connect, $sql);
        if ($row = $res->fetch_assoc()) {
            $hash_ids[] = $row['id'];
        }
    }

    foreach ($hash_ids as $hash_id) {
        $sql = "INSERT INTO `hash_connect` (`hash_id`, `field_id`) VALUES (
                '".htmlspecialchars($hash_id)."',
                '".htmlspecialchars($field_id)."'
            )";
        mysqli_query($connect, $sql);
    }
}




require('header.php');
if(isset($_GET['p']) && 
            ($_GET['p'] == 'hashs' || $_GET['p'] == 'posts' || 
            $_GET['p'] == 'channels' || $_GET['p'] == 'fields')) 
            include($_GET['p'].'.php');
require('footer.html');