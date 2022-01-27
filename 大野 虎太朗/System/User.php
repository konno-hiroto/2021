<!doctype html>
<html>
    <head>
        <title>練習</title>
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
            table {
                margin-left: auto;
                margin-right: auto;
            }
            div {
                text-align:center;
            }
            .Can {
                wigth:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .New {
                wigth:100px;
                padding:10px;
                background-color:#777777;
                border:1px solid #333;
                color:#FFFFFF;
            }
        </style>
    </head>
    <body>
        <form action="" method="post">
        <?php
            try {
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                if(isset($_POST['up'])){
                    $Username = $_POST['Username'];
                    $pass = $_POST['pass'];
                    $id = $_POST['id'];
                    $stmt = $db->query("update Users set Username='" . $Username . "', pass='" . $pass . "' where Userid=" . $id . ";");
                    //print "Username:" . $Username . ",pass:" . $pass . ",id:" . $id;

                }
                
                if(isset($_POST['del'])){
                    $id = $_POST['id'];
                    header('Location:UserDel.php?id=' . $id);
                }

                if(isset($_POST['yes'])){
                    $id = $_POST['id'];
                    $stmt = $db->query("delete from Users where Userid=" . $id . ";");
                }

                //$Login = $_POST['login'];
                print "<input type='button' name='cancel' class='Can' value='キャンセル'>";
                print "<h2>ログイン者名:</h2>" /*. $Login */;

                print "<br>";
                print "<h1>ユーザー管理画面</h1>";
                print "<hr><br>";
                print "<div><input type='button' name='new' class='New' value='新規登録'></div><br>";

                print "<div>";
                print "管理者ユーザー";
                $stmt = $db->query('select * from Users');

                print "<table border=1>";
                print "<tr><th>UserID</th><th>UserName</th></tr>";
                while($result = $stmt->fetch(PDO::FETCH_NUM)){
                    if($result[2] == 1){
                        print "<tr><td>" . $result[0] . "</td><td>";
                        print "<a href='UserEdit.php?id=" . $result[0] . "'>";
                        print $result[1] . "</a></td></tr>";
                    }
                }
                print "</table>";
                print "</div>";

                print "<div>";
                print "一般ユーザー";
                $stmt = $db->query('select * from Users');

                print "<table border=1>";
                print "<tr><th>UserID</th><th>UserName</th></tr>";
                while($result = $stmt->fetch(PDO::FETCH_NUM)){
                    if($result[2] == 2){
                        print "<tr><td>" . $result[0] . "</td><td>";
                        print "<a href='UserEdit.php?id=" . $result[0] . "'>";
                        print $result[1] . "</a></td></tr>";
                    }
                }
                print "</table>";
                print "</div>";

            } catch(Exception $e){
                print $e;
            }

        ?>
        </form>
    </body>
</html>