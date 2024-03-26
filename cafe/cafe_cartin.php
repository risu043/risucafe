<?php

session_start();
        session_regenerate_id(true);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charaset="UTF-8" />
    <title>りすさんカフェ</title>
    <meta name="description" content="りすさんカフェ" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <!-- favicon -->
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <!-- CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/destyle.css@1.0.5/destyle.css"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <header>
      <div class="container">
        <h1 class="title">りすさんカフェ</h1>
        <nav>
<?php
if(isset($_SESSION['member_login'])==false){
    echo '<li>ようこそゲスト様</li>';
    echo '<li><a href="member_login.php">ログイン</a></li>';
  } else {
      echo '<li>'.$_SESSION['member_name'].'様</li>';
      echo '<li><a href="member_logout.php">ログアウト</a></li>';
  }
?>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">

<?php

try
{

$product_code = $_GET['productcode'];

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $pieces = $_SESSION['pieces'];
}

$cart[] = $product_code;
$pieces[] = 1;
$_SESSION['cart'] = $cart;
$_SESSION['pieces'] = $pieces;

}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}



?>

      <p>カートに追加しました。</p>
      <div class="button-wrapper">
        <a class="button-secondary" href="cafe_list.php">メニューに戻る</a>
      </div>
      </div>
    </main>
  </body>
</html>