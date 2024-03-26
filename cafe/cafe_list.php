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
      <h2 class="sub-title-center">Menu</h2>
      <div class="menu-wrapper">

<?php

try
{

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLを使ってコードを追加
$sql = 'SELECT code,name,price,image FROM mst_product WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

// データベースを閉じる
$dbh = null;

// ブラウザに表示する
while(true){
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false){
        break;
    }
    echo '<a href="cafe_product.php?productcode='.$rec['code'].'">';
    echo '<img src="../images/'.$rec['image'].'">';
    echo '<p>'.$rec['name'].'：';
    echo $rec['price'].'円</p>';
    echo '</a>';
}
}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>
      <a class="button-secondary" href="cafe_cartlook.php">注文内容をみる</a>
      </div>
      </div>
    </main>
  </body>
</html>