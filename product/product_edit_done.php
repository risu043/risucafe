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

    $product_code = $_POST['code'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_image_name_old = $_POST['image_name_old'];
    $product_image_name = $_POST['image_name'];
    
    $product_code = htmlspecialchars($product_code, ENT_QUOTES, 'UTF-8');
    $product_name = htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8');
    $product_price = htmlspecialchars($product_price, ENT_QUOTES, 'UTF-8');

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLを使ってコードを追加
$sql = 'UPDATE mst_product SET name=?,price=?,image=? WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $product_name;
$data[] = $product_price;
$data[] = $product_image_name;
$data[] = $product_code;
$stmt->execute($data);// 値をバインドし、SQLを実行

// データベースを閉じる
$dbh = null;

if($product_image_name_old != $product_image_name) {
    // 古い画像を削除
    if($product_image_name_old != '') {
      unlink('../images/'.$product_image_name_old);
    }
}


// ブラウザに表示する
echo '修正しました<br>';
}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>

<a class="button" href="product_list.php">戻る</a>

      </div>
    </main>
  </body>
</html>