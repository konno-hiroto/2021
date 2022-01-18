<!doctype html>
<html>
    <head>
        <title>編集画面</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="User.php" method="post">
            <?php

            try{
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $id = $_GET['id'];
                $stmt = $db->query('select * from Users where Userid=' . $id);
                $result = $stmt->fetch(PDO::FETCH_NUM);


                print "<input type='button' name='can' value='キャンセル'>";
                print "ログイン者名:";
                print "<br>";

                print "<h1>ユーザー編集画面</h1>";
                print "<hr>";
                print "編集対象:" . $result[1];
                print "<input type='submit' name='del' value='削除'>";
                print "<br><br>";
                print "変更後のユーザーネーム<br>";
                print "<input type='text' name='Username' value='$result[1]' required/><br><br>";
                print "変更後のパスワード<br>";
                print "<input type='text' name='pass' value='$result[3]' required/><br>";
                

                

            } catch (Exception $e){
                print $e;
            }
            
            ?>
            <br><br>
            <input type="submit" name="up" value="編集確定">
            <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>