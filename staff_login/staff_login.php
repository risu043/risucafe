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
        <h2 class="sub-title">スタッフログイン</h2>
        <form method="post" action="staff_login_check.php">
          <div class="input-area">
            <label for="code">スタッフコード</label>
            <input type="text" id="code" name="code" />
          </div>
          <div class="input-area">
            <label for="pass">パスワード</label>
            <input type="password" id="pass" name="pass" />
          </div>
          <input class="button" type="submit" value="ログイン" />
        </form>
      </div>
    </main>
  </body>
</html>