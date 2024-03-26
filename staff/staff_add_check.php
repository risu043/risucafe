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

require_once('../common/common.php');

$post = sanitize($_POST);
$staff_name = $post['name'];
$staff_pass = $post['pass'];
$staff_pass2 = $post['pass2'];

if($staff_name == '') {
    echo 'スタッフ名が入力されていません<br>';
} else {
    echo 'スタッフ名：';
    echo $staff_name;
    echo '<br>';
}

if($staff_pass == '') {
    echo 'パスワードが入力されていません<br>';
}

if($staff_pass != $staff_pass2) {
    echo 'パスワードが一致しません<br>';
}

if($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2) {
    echo '<form>';
    echo '<input type="button" class="button" onclick="history.back()" value="戻る">';
    echo '</form>';
} else {
    // md5で方式でパスワードを暗号化する
    $staff_pass = md5($staff_pass);
    echo '<form method="post" action="staff_add_done.php">';
    echo '<input type="hidden" name="name" value="'.$staff_name.'">';
    echo '<input type="hidden" name="pass" value="'.$staff_pass.'">';
    echo '<input type="button" class="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" class="button" value="OK">';
    echo '</form>';
}

?>

      </div>
    </main>
  </body>
</html>