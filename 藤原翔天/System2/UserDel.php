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
                weight:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .sub {
                weight:100px;
                padding:10px;
                margin-right: 100px;
                border:1px solid #333;
            }
            .sub2 {
                weight:100px;
                padding:10px;
                margin-right: 100px;
                border:1px solid #333;
            }
        </style>
    </head>
    <body>
    <form action="User.php" method="post">
        <?php
        session_start();
        $this->db = new PDO('mysql:host=localhost;dbname=yoiteam;charset=utf8','yoiteam','admin');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


            $id = $_GET['id'];
            $stmt = $db->query('select * from Users where Userid=' . $id);
            $result = $stmt->fetch(PDO::FETCH_NUM);
            print "<input type='submit' class='Can' name='User.php' value='キャンセル'>";
            print "ログイン者名:".$_SESSION['Username'];
            print "<br>";
            print "<h1>ユーザー削除画面</h1><br>";
            print "<hr>";
            print "本当にユーザー「" . $result[1] . "」を削除しますか？";

            print "<br>";

            print "<input type='submit' class='sub' name='yes' value='はい'>";
            print "<input type='submit' class='sub2' name='no' value='いいえ'>";
        ?>
        
        <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>