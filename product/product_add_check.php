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

$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_image = $_FILES['image'];

$product_name = htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8');
$product_price = htmlspecialchars($product_price, ENT_QUOTES, 'UTF-8');

if($product_name == '') {
    echo '商品名が入力されていません<br>';
} else {
    echo '商品名：';
    echo $product_name;
    echo '<br>';
}

// もし商品価格が半角数字でなければ、というチェック
if(!preg_match('/^[0-9]+$/', $product_price)) {
    echo '価格を半角数字で入力してください<br>';
} else {
    echo '価格：';
    echo $product_price;
    echo '円<br>';
}

// 画像の有無をチェック
if($product_image['size']>0) {
  // 画像のサイズをチェック
  if($product_image['size'] > 1000000) {
    echo '画像が大きすぎます。';
  } else {
    // 仮の名前でアップロードされた画像を、元のファイル名に戻してimagesフォルダに移動する
    move_uploaded_file($product_image['tmp_name'], '../images/'.$product_image['name']);
    echo '<img src="../images/'.$product_image['name'].'">';
  }
}

if($product_name == '' || !preg_match('/^[0-9]+$/', $product_price) || $product_image['size']>1000000) {
    echo '<form>';
    echo '<input type="button" class="button" onclick="history.back()" value="戻る">';
    echo '</form>';
} else {
    // md5で方式でパスワードを暗号化する
    echo '<p>上記の商品を追加します。</p>';
    echo '<form method="post" action="product_add_done.php">';
    echo '<input type="hidden" name="name" value="'.$product_name.'">';
    echo '<input type="hidden" name="price" value="'.$product_price.'">';
    echo '<input type="hidden" name="image_name" value="'.$product_image['name'].'">';
    echo '<input type="button" class="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" class="button" value="OK">';
    echo '</form>';
}

?>

      </div>
    </main>
  </body>
</html>