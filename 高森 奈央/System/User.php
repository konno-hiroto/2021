<!doctype html>
<html>
    <head>
        <title>練習</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="" method="post">
        <?php
            try {
                $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
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

                if(isset($_POST['new'])){
                    header('Location:UserReg.php');
                }

                if(isset($_POST['ins'])){
                    $name = $_POST['Username'];
                    $pass = $_POST['pass'];
                    $level = $_POST['level'];
                    $stmt = $db->query("insert into users (Username, pass, alevel) values('" . $name . "', '" . $pass . "', '" . $level . "')");
                }

                if(isset($_POST['userCan'])){
                    header('Location:'); //1の管理者画面のphp
                }

                if(isset($_POST['userRegCan'])){
                    header('Location:User.php');
                }

                if(isset($_POST['userEdiCan'])){
                    header('Location:user.php');    
                }

                if(isset($_POST['userDelCan'])){
                    header('Location:User.php');
                }



                //$Login = $_POST['login'];
                print "<input type='button' name='cancel' value='キャンセル'>";
                print "ログイン者名:" /*. $Login */;

                print "<br>";
                print "<h1>ユーザー管理画面</h1>";
                print "<hr><br>";
                print "<input type='submit' name='new' value='新規登録'><br>";


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
                print "</div></div>";

            } catch(Exception $e){
                print $e;
            }

        ?>
        </form>
    </body>
</html>