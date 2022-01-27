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
                wigth:100px;
                padding:10px;
                background-color:#FF0000;
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
            print "<input type='button' name='cacReg' class='Can' value='キャンセル'>";
            print "<h2>ログイン者名:</h2>";
            print "<h1>ユーザー登録画面</h1>";
            print "<hr>";

            print "<div>";
            print "管理者:";
            print "<input type='radio' name='level' value='1'>";

            print "一般:";
            print "<input type='radio' name='level' value='2'><br><br>";

            print "ユーザー名<br>";
            print "<input type='text' name='Username'><br>";

            print "パスワード<br>";
            print "<input type='text' name='pass'><br>";

            print "パスワード確認<br>";
            print "<input type='text' name='passCheck'><br><br>";

            print "<input type='submit' name='ins' class='sub' value='確定'>";
            print "</div>";

        ?>
    </body>
</html>