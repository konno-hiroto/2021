<!doctype html>
<html>
    <head>
        <title>ユーザー削除</title>
        <meta charset="utf-8">
    </head>
    <body>
    <form action="User.php" method="post">
        <?php
            $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


            $id = $_GET['id'];
            $stmt = $db->query('select * from Users where Userid=' . $id);
            $result = $stmt->fetch(PDO::FETCH_NUM);

            print "<input type='button' name='User.php' value='キャンセル'>";
            print "ログイン者名:";
            print "<br>";
            print "<h1>ユーザー削除画面</h1><br>";
            print "<hr>";
            print "本当にユーザー「" . $result[1] . "」を削除しますか？";

            print "<br>";

            print "<input type='submit' name='yes' value='はい'>";
            print "<input type='submit' name='no' value='いいえ'>";
        ?>
        
        <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>