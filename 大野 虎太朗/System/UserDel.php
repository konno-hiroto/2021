<!doctype html>
<html>
    <head>
        <title>ユーザー削除</title>
        <meta charset="utf-8">
        <style>
             body {
                background:url(haikei2.jpg);
            }
            h1 {
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
            .Can {
                wigth:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .sub {
                wigth:100px;
                padding:10px;
                margin-right: 100px;
                border:1px solid #333;
            }
            .sub2 {
                wigth:100px;
                padding:10px;
                margin-right: 100px;
                border:1px solid #333;
            }
        </style>
    </head>
    <body>
    <form action="User.php" method="post">
        <?php
            $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id = $_GET['id'];
            $stmt = $db->query('select * from Users where Userid=' . $id);
            $result = $stmt->fetch(PDO::FETCH_NUM);
            
            print "<input type='button' name='cans' class='Can' value='キャンセル'>";
            print "<h2>ログイン者名:</h2>";
            print "<br>";
            print "<h1>ユーザー削除画面</h1><br>";
            print "<hr>";
            print "<div>";
            print "本当にユーザー「" . $result[1] . "」を削除しますか？";

            print "<br>";

            print "<input type='submit' name='yes' class='sub' value='はい'>";
            print "<input type='submit' name='no' class='sub2' value='いいえ'>";
            print "</div>";
        ?>
        
        <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>