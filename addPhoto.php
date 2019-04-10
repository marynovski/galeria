<?php
    require_once('Photo.php');
    session_start();

    $photo_data = $_FILES['photo'];
    $photo = new Photo($photo_data['type'], $photo_data['tmp_name'], $photo_data['error'], $photo_data['size']);
    $photo->save($_POST['name'].'_'.$_POST['surname'], '000000');
    header('Location: gallery.php');
