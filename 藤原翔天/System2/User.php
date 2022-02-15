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
                weight:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .New {
                weight:100px;
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
        session_start();
        if(isset($_SESSION['Username'])){
            try {
                $this->db = new PDO('mysql:host=localhost;dbname=yoiteam;charset=utf8','yoiteam','admin');
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

                if(isset($_POST['cancel'])){
                    header('Location:Management.php'); //1の管理者画面のphp
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
                print "<input type='submit' name='cancel' class='Can' value='キャンセル'>";
                print "ログイン者名:" . $_SESSION['Username'];

                print "<br>";
                print "<h1>ユーザー管理画面</h1>";
                print "<hr><br>";
                print "<div>";
                print "<input type='submit' name='new' class='New' value='新規登録'><br>";

                print "<div>";
                print "管理者ユーザー";
                print "</div>";
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

                print "<div>";
                print "一般ユーザー";
                print "</div>";
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
        }else{
            header("location:Login.php");
        }
        ?>
        </form>
    </body>
</html>