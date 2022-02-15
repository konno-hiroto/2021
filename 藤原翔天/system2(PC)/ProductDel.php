<!doctype html>
<html>
    <head>
        <title>ユーザー削除</title>
        <meta charset="utf-8">
    </head>
    <body>
    <form action="Product.php" method="post">
        <?php
        session_start();
            $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


            $id = $_GET['id'];
            $stmt = $db->query('select * from Menu where Mid=' . $id);
            $result = $stmt->fetch(PDO::FETCH_NUM);

            print "<input type='submit' name='proDelCan' value='キャンセル'>";
            print "ログイン者名:".$_SESSION['Username'];
            print "<br>";
            print "<h1>商品削除画面</h1><br>";
            print "<hr>";
            print "本当に商品「" . $result[2] . "」を削除しますか？";

            print "<br>";

            print "<input type='submit' name='yes' value='はい'>";
            print "<input type='submit' name='no' value='いいえ'>";
        ?>
        
        <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>