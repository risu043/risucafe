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
        <h2 class="sub-title">商品追加</h2>
        <form method="post" action="product_add_check.php" enctype="multipart/form-data">
            <div class="input-area">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="input-area">
                <label for="price">価格</label>
                <input type="text" id="price" name="price">
            </div>
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