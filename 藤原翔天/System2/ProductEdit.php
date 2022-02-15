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
            .Can {
                weight:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .Del {
                weight:100px;
                padding:10px;
                background-color:#777777;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .sub {
                weight:100px;
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
                session_start();
                $this->db = new PDO('mysql:host=localhost;dbname=yoiteam;charset=utf8','yoiteam','admin');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $id = $_GET['id'];
                $stmt = $db->query('select * from menu where Mid=' . $id);
                $result = $stmt->fetch(PDO::FETCH_NUM);


                print "<input type='submit' name='can' class='Can' value='キャンセル'>";
                print "ログイン者名:".$_SESSION['Username'];
                print "<br>";

                print "<h1>編集画面</h1>";
                print "<hr>";
                print "編集対象:" . $result[2];
                print "<br><input type='submit' name='del' class='Del' value='削除'>";
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
            <input type="submit" name="up" class="sub" value="編集確定">
            <input type="hidden" name="id" value="<?php print $id ?>">
        </form>
    </body>
</html>