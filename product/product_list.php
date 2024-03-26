<?php

session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['login'])==false){
          echo '<p>ログインしていません。</p>';
          echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
          exit();
        }

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
          <li>こんにちは、<?php echo $_SESSION['staff_name']; ?>さん</li>
          <li><a href="../staff_login/staff_logout.php">ログアウト</a></li>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">

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
$sql = 'SELECT code,name,price FROM mst_product WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

// データベースを閉じる
$dbh = null;

// ブラウザに表示する
echo '<h2 class="sub-title">商品一覧</h2>';
echo '<form method="post" action="product_branch.php">';
while(true){
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false){
        break;
    }
    echo '<input type="radio" name="productcode" value="'.$rec['code'].'">';
    echo $rec['name'].'：';
    echo $rec['price'].'円';
    echo '<br>';
}
echo '<input type="submit" name="show" class="button" value="参照">';
echo '<input type="submit" name="add" class="button" value="追加">';
echo '<input type="submit" name="edit" class="button" value="修正">';
echo '<input type="submit" name="delete" class="button" value="削除">';
echo '</form>';
}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>

      <div class="button-wrapper"><a class="button-secondary" href="../staff_login/staff_top.php">トップメニューへ</a></div>
      </div>
    </main>
  </body>
</html>