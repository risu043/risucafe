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

$product_code = $_GET['productcode'];

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLを使ってコードを追加
$sql = 'SELECT name,price,image FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $product_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $rec['name'];
$product_price = $rec['price'];
$product_image_name_old = $rec['image'];

// データベースを閉じる
$dbh = null;

if($product_image_name_old == ''){
  $show_image = '';
} else {
  $show_image = '<img src="../images/'.$product_image_name_old.'">';
}

}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}



?>

      <h2 class="sub-title">商品修正</h2>
      <p>商品コード：<?php echo $product_code; ?></p>
      <form method="post" action="product_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php echo $product_code; ?>">
            <input type="hidden" name="image_name_old" value="<?php echo $product_image_name_old; ?>">
            <div class="input-area">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" value="<?php echo $product_name; ?>">
            </div>
            <div class="input-area">
                <label for="price">価格</label>
                <input type="text" id="price" name="price" value="<?php echo $product_price; ?>">
            </div>
            <?php echo $show_image; ?>
            <div class="input-area">
                <label for="image">画像</label>
                <input type="file" id="image" name="image">
            </div>
            <input type="button" class="button" onclick="history.back()" value="戻る">
            <input type="submit" class="button" value="OK">
      </form>

      </div>
    </main>
  </body>
</html>