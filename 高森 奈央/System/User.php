<!doctype html>
<html>
    <head>
        <title>練習</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            try {
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                //$Login = $_POST['login'];
                print "<input type='button' name='cancel' value='キャンセル'>";
                print "ログイン者名:" /*. $Login */;

                print "<br>";
                print "<h1>ユーザー管理画面</h1>";
                print "<hr><br>";
                print "<input type='button' name='new' value='新規登録'>";
                print "<input type='button' name='del' value='削除'><br>";


                print "管理者ユーザー";
                $stmt = $db->query('select * from Users');

                print "<table border=1>";
                print "<tr><th>UserID</th><th>UserName</th></tr>";
                while($result = $stmt->fetch(PDO::FETCH_NUM)){
                    if($result[2] == 1){
                        print "<tr><td>" . $result[0] . "</td><td>" . $result[1] . "</td></tr>";
                    }
                }
                print "</table>";


                print "一般ユーザー";
                $stmt = $db->query('select * from Users');

                print "<table border=1>";
                print "<tr><th>UserID</th><th>UserName</th></tr>";
                while($result = $stmt->fetch(PDO::FETCH_NUM)){
                    if($result[2] == 2){
                        print "<tr><td>" . $result[0] . "</td><td>" . $result[1] . "</td></tr>";
                    }
                }
                print "</table>";

            } catch(Exception $e){
                print $e;
            }

        ?>
    </body>
</html>