<?php

session_start();
        $_SESSION = array();
        if(isset($_COOKIE[session_name()])==true) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();

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
      </div>
    </header>
    <main>
      <div class="container">
        <p>ログアウトしました。</p>
        <div class="button-wrapper">
          <a class="button-secondary" href="staff_login.php">ログイン画面へ</a>
        </div>
      </div>
    </main>
  </body>
</html>