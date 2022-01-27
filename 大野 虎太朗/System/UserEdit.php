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
            .text {
                width:200px;
                height:30px;
            }
            .Can {
                wigth:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .Del {
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
        <form action="User.php" method="post">
            <?php

            try{
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $id = $_GET['id'];
                $stmt = $db->query('select * from Users where Userid=' . $id);
                $result = $stmt->fetch(PDO::FETCH_NUM);

                
                print "<input type='button' name='can' class='Can' value='キャンセル'>";
                print "<h2>ログイン者名:</h2>";
                print "<br>";

                print "<h1>ユーザー編集画面</h1>";
                print "<hr>";
                print "<div>";
                print "編集対象:" . $result[1];
                print "<input type='submit' name='del' class='Del' value='削除'>";
                print "<br><br>";
                print "変更後のユーザーネーム<br>";
                print "<input type='text' name='Username' class='text' value='$result[1]' /><br><br>";
                print "変更後のパスワード<br>";
                print "<input type='text' name='pass' class='text' value='$result[3]'/><br>";
                
                print "パスワード確認<br>";
                print "<input type='text' name='passCheck' class='text'><br>";
                print "</div>";
                

            } catch (Exception $e){
                print $e;
            }
            
            ?>
            <br><br>
            <div>
            <input type="submit" name="up" class="sub" value="編集確定">
            <input type="hidden" name="id" value="<?php print $id ?>">
            </div>
        </form>
    </body>
</html>