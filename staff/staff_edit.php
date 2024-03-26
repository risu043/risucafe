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

$staff_code = $_GET['staffcode'];

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLを使ってコードを追加
$sql = 'SELECT name FROM mst_staff WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $staff_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$staff_name = $rec['name'];

// データベースを閉じる
$dbh = null;

}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}



?>

      <h2 class="sub-title">スタッフ修正</h2>
      <p>スタッフコード：<?php echo $staff_code; ?></p>
      <form method="post" action="staff_edit_check.php">
            <input type="hidden" name="code" value="<?php echo $staff_code; ?>">
            <div class="input-area">
                <label for="name">スタッフ名</label>
                <input type="text" id="name" name="name" value="<?php echo $staff_name; ?>">
            </div>
            <div class="input-area">
                <label for="pass">パスワードを入力してください</label>
                <input type="password" id="pass" name="pass">
            </div>
            <div class="input-area">
                <label for="pass2">パスワードを入力してください</label>
                <input type="password" id="pass2" name="pass2">
            </div>
            <input type="button" class="button" onclick="history.back()" value="戻る">
            <input type="submit" class="button" value="OK">
      </form>

      </div>
    </main>
  </body>
</html>