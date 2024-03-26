<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $max = $post['max']; 

    for($i=0;$i<$max;$i++) {
        $pieces[] = $post['pieces'.$i];
    }

    $_SESSION['pieces'] = $pieces;

    header('Location:cafe_cartlook.php');
    exit();
  
?>