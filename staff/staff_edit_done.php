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
    $staff_code = $_POST['code'];
    $staff_name = $_POST['name'];
    $staff_pass = $_POST['pass'];
    
    $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');
    $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
    $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQLを使ってコードを追加
$sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $staff_name;
$data[] = $staff_pass;
$data[] = $staff_code;
$stmt->execute($data);

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

<p>修正しました。</p>
<a class="button" href="staff_list.php">戻る</a>

      </div>
    </main>
  </body>
</html>