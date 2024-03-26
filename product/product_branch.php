<?php

session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['login'])==false){
          echo '<p>ログインしていません。</p>';
          echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
          exit();
        }


if(isset($_POST['show'])){
    if(isset($_POST['productcode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $product_code = $_POST['productcode'];
    header('Location: product_show.php?productcode='.$product_code);
    exit();
}

if(isset($_POST['add'])){
    header('Location: product_add.php');
    exit();
}

if(isset($_POST['edit'])){
    if(isset($_POST['productcode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $product_code = $_POST['productcode'];
    header('Location: product_edit.php?productcode='.$product_code);
    exit();
}

if(isset($_POST['delete'])){
    if(isset($_POST['productcode']) == false){
        header('Location: product_ng.php');
        exit();
    }
    $product_code = $_POST['productcode'];
    header('Location: product_delete.php?productcode='.$product_code);
    exit();
}
?>