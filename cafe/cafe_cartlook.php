<?php

session_start();
        session_regenerate_id(true);

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
<?php
if(isset($_SESSION['member_login'])==false){
    echo '<li>ようこそゲスト様</li>';
    echo '<li><a href="member_login.php">ログイン</a></li>';
  } else {
      echo '<li>'.$_SESSION['member_name'].'様</li>';
      echo '<li><a href="member_logout.php">ログアウト</a></li>';
  }
?>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">

<?php

try
{

$cart = $_SESSION['cart'];
$pieces = $_SESSION['pieces'];
// var_dump($_SESSION['pieces']);
$max = count($cart);

// データベースに接続
$dsn = 'mysql:dbname=risucafe;host=localhost;charaset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val) {
    $sql = 'SELECT code,name,price,image FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $val;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_name[] = $rec['name'];
    $product_price[] = $rec['price'];
    if($rec['image']==''){
        $product_image[]='';
    } else {
        $product_image[] = '<img src="../images/'.$rec['image'].'">';
    }
}

$dbh = null;

}

// 接続に失敗した場合、PDOException例外がスローされます。
catch(Exception $e)
{
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}



?>

      <h2 class="sub-title">注文内容</h2>
      
        <form method="post" action="pieces_change.php">
<?php for($i=0;$i<$max;$i++){ ?>
      
        <div>
            <p><?php echo $product_name[$i]; ?></p>
            <?php echo $product_image[$i]; ?>
            <p><?php echo $product_price[$i].'円'; ?></p>
            <!-- <div class="input-area">
                <input type="text" name="pieces<?php echo $i; ?>" value="<?php echo $pieces[$i]; ?>">
            </div> -->
            <!-- <p><?php echo $product_price[$i]*$pieces[$i].'円'; ?></p> -->
        
        </div>

<?php } ?>

            <input type="hidden" class="button" name="max" value="<?php echo $max; ?>">
            <!-- <input type="submit" class="button" value="数量変更"> -->
            <input type="button" class="button" onclick="history.back()" value="戻る">
      </form>

      </div>
    </main>
  </body>
</html>