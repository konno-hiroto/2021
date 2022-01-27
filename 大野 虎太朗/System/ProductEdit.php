<!doctype html>
<html>
    <head>
        <title>編集画面</title>
        <meta charset="utf-8">
        <style>
            body {
                background:url(haikei2.jpg);
            }
             h1 {
                color:#ff0000;
                font-size:3em;
                text-align:center;
            }
            h2 {
                text-align:right;
            }
            div {
                text-align:center;
                font-size:25px;
            }
            .can {
                wigth:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .del {
                wigth:100px;
                padding:10px;
                background-color:#777777;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .sub {
                wigth:100px;
                padding:10px;
                background-color:#0000FF;
                border:1px solid #333;
                color:#FFFFFF;
            }
        </style>
    </head>
    <body>
        <form action="Product.php" method="post">
            <?php

            try{
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $id = $_GET['id'];
                $stmt = $db->query('select * from menu where Mid=' . $id);
                $result = $stmt->fetch(PDO::FETCH_NUM);


                print "<input type='button' name='can' class='can' value='キャンセル'>";
                print "<h2>ログイン者名:</h2>";
                print "<br>";

                print "<h1>編集画面</h1>";
                print "<hr>";
                print "<div>";
                print "編集対象:" . $result[2];
                print "<br><input type='submit' name='del' class='del' value='削除'>";
                print "<br><br>";
                print "変更後の商品名<br>";
                print "<input type='text' name='name' value='$result[2]' /><br><br>";
                print "変更後の値段<br>";
                print "<input type='text' name='pay' value='$result[3]'/><br><br>";
                print "現在の在庫数:" . $result[4] . "<br>";
                print "在庫増やす数:<input type='number' name='zaiko' value=0 min='0' max='100'>";
                print "</div>";
                

            } catch (Exception $e){
                print $e;
            }
            
            ?>
            <br><br>
            <div><input type="submit" name="up" class="sub" value="編集確定"></div>
            <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>