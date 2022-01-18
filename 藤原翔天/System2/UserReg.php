<!doctype html>
<html>
    <head>
        <title>新規ユーザー追加</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="User.php" method="post">
        <?php 
            print "<input type='button' name='cacReg' value='キャンセル'>";
            print "ログイン者名:";
            print "<h1>ユーザー登録画面</h1>";
            print "<hr>";

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

            print "<input type='submit' name='ins' value='確定'>";

        ?>
    </body>
</html>