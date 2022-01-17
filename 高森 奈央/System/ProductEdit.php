<!doctype html>
<html>
    <head>
        <title>編集画面</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="Product.php" method="post">
            <?php

            try{
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $id = $_GET['id'];
                $stmt = $db->query('select * from menu where Mid=' . $id);
                $result = $stmt->fetch(PDO::FETCH_NUM);


                print "<input type='button' name='can' value='キャンセル'>";
                print "ログイン者名:";
                print "<br>";

                print "<h1>編集画面</h1>";
                print "<hr>";
                print "編集対象:" . $result[2];
                print "<br><input type='submit' name='del' value='削除'>";
                print "<br><br>";
                print "変更後の商品名<br>";
                print "<input type='text' name='name' value='$result[2]' /><br><br>";
                print "変更後の値段<br>";
                print "<input type='text' name='pay' value='$result[3]'/><br><br>";
                print "現在の在庫数:" . $result[4] . "<br>";

                if($id == 1){
                    print "在庫増やす数:<input type='number' name='zaiko' value=0 min='0' max='200'>";
                } else {
                    print "在庫増やす数:<input type='number' name='zaiko' value=0 min='0' max='100'>";
                }
                

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