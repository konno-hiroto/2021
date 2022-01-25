<!doctype html>
<html>
    <head>
        <title>新規商品追加</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="Product.php" method="post">
        <?php 

            print "<input type='submit' name='cacReg' value='キャンセル'>";
        ?></form><form><?php
            print "ログイン者名:";
            print "<h1>新規商品登録画面</h1>";
            print "<hr>";

            print "<select name='janr'>";
            print "<option value='0' selected='selected'>ジャンルを選択してください</option>";
            print "<option value='1'>串</option>";
            print "<option value='2'>サイドメニュー</option>";
            print "<option value='3'>お酒</option>";
            print "<option value='4'>ソフトドリンク</option>";
            print "</select><br><br>";

            print "商品名<br>";
            print "<input type='text' name='proName' required><br><br>";

            print "値段<br>";
            print "<input type='number' name='proPri' min='0' value=0 required><br><br>";

            print "商品画像名を入力してください※拡張子も込み<br>";
            print "<input type='text' name='ima' required><br><br>";

            print "<input type='submit' name='ins' value='確定'>";

        ?>
    </body>
</html>