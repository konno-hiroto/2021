<!doctype html>
<html>
    <head>
        <title>新規ユーザー追加</title>
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
                background-color:#0000FF;
                border:1px solid #333;
                color:#FFFFFF;
            }
        </style>
    </head>
    <body>
        <?php
            session_start();
            if(isset($_POST['userRegCan'])){
                header("location:User.php");
            }
            print "<form method='post'>";
            print "<input type='submit' name='userRegCan' class='Can' value='キャンセル'>";
            print "</form>";
            print "ログイン者名:".$_SESSION['Username'];
            print "<h1>ユーザー登録画面</h1>";
            print "<hr>";
            print '<form action="User.php" method="post">';

            print "管理者:";
            print "<input type='radio' name='level' value='1' required>";

            print "一般:";
            print "<input type='radio' name='level' value='2'><br><br>";

            print "ユーザー名<br>";
            print "<input type='text' name='Username' required><br>";

            print "パスワード<br>";
            print "<input type='text' name='pass' required><br>";
            print "<input type='submit' name='ins' class='sub' value='確定'>";

        ?>
        </form>
    </body>
</html>