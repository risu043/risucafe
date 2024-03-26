<?php

session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['login'])==false){
          echo '<p>ログインしていません。</p>';
          echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
          exit();
        }


if(isset($_POST['show'])){
    if(isset($_POST['staffcode']) == false){
        header('Location: staff_ng.php');
        exit();
    }
    $staff_code = $_POST['staffcode'];
    header('Location: staff_show.php?staffcode='.$staff_code);
    exit();
}

if(isset($_POST['add'])){
    header('Location: staff_add.php');
    exit();
}

if(isset($_POST['edit'])){
    if(isset($_POST['staffcode']) == false){
        header('Location: staff_ng.php');
        exit();
    }
    $staff_code = $_POST['staffcode'];
    header('Location: staff_edit.php?staffcode='.$staff_code);
    exit();
}

if(isset($_POST['delete'])){
    if(isset($_POST['staffcode']) == false){
        header('Location: staff_ng.php');
        exit();
    }
    $staff_code = $_POST['staffcode'];
    header('Location: staff_delete.php?staffcode='.$staff_code);
    exit();
}
?>