<!doctype html>
<html>
    <head>
        <title>商品管理</title>
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
            .content{
                display:flex;
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
                background-color:#777777;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .cen {
                text-align:center;
            }
        </style>
    </head>
    <body>
        <form action="" method=post>
            <?php
                $Login = "test";
                try{
                    $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                    if(isset($_POST['up'])){
                        $name = $_POST['name'];
                        $pay = $_POST['pay'];
                        $zaiko = $_POST['zaiko'];
                        $id = $_POST['id'];

                        $lastPay = 0;
                        $stmt = $db->query('select * from menu where Mid =' . $id);
                        $result = $stmt->fetch(PDO::FETCH_NUM);
                        $newZaiko = $result[4] + $zaiko;
                        
                        $stmt = $db->query("update menu set Mname='" . $name . "', price='" . $pay . "', stock='" . $newZaiko . "' where Mid=" . $id . ";");
    
                    }

                        
                    print "<input type='button' name='calcel' class='Can' value='キャンセル'>";
                    print "<h2>ログイン者名:</h2>" . $Login;

                    print "<br>";
                    print "<h1>商品管理画面</h1>";
                    print "<hr><br>";
                    print "<div class='cen'><input type='submit' name='new' class='sub' value='新規登録'></div><br>";
                    print "<div class='content'>";


                    
                    print "<div class='content_item'>";
                    $stmt = $db->query('select * from menu');
                    print "<table border='1'>";
                    print "<tr><th colspan='3'>串</th></th></tr>";
                    print "<tr><th>商品名</th><th>値段</th><th>在庫数</th></tr>";
                    while($result = $stmt->fetch(PDO::FETCH_NUM)){
                        if($result[1] == 1){
                            print "<tr><td>";
                            print "<a href='ProductEdit.php?id=" . $result[0] . "'>" . $result[2] . "</a></td>";
                            print "<td>" . $result[3] . "</td>";
                            print "<td>" . $result[4] ."</td>";
                        }
                    }
                    print "</table>";
                    print "</div>";
                    

                    print "<div class='content_item'>";
                    $stmt = $db->query('select * from menu');
                    print "<table border='1'>";
                    print "<tr><th colspan='3'>サイドメニュー</th></th></tr>";
                    print "<tr><th>商品名</th><th>値段</th><th>在庫数</th></tr>";
                    while($result = $stmt->fetch(PDO::FETCH_NUM)){
                        if($result[1] == 2){
                            print "<tr><td>";
                            print "<a href='ProductEdit.php?id=" . $result[0] . "'>" . $result[2] . "</a></td>";
                            print "<td>" . $result[3] . "</td>";
                            print "<td>" . $result[4] ."</td>";
                        }
                    }
                    print "</table>";
                    print "</div>";


                    print "<div class='content_item'>";
                    $stmt = $db->query('select * from menu');
                    print "<table border='1'>";
                    print "<tr><th colspan='3'>お酒</th></th></tr>";
                    print "<tr><th>商品名</th><th>値段</th><th>在庫数</th></tr>";
                    while($result = $stmt->fetch(PDO::FETCH_NUM)){
                        if($result[1] == 3){
                            print "<tr><td>";
                            print "<a href='ProductEdit.php?id=" . $result[0] . "'>" . $result[2] . "</a></td>";
                            print "<td>" . $result[3] . "</td>";
                            print "<td>" . $result[4] ."</td>";
                        }
                    }
                    print "</table>";
                    print "</div>";


                    print "<div class='content_item'>";
                    $stmt = $db->query('select * from menu');
                    print "<table border='1'>";
                    print "<tr><th colspan='3'>ソフトドリンク</th></th></tr>";
                    print "<tr><th>商品名</th><th>値段</th><th>在庫数</th></tr>";
                    while($result = $stmt->fetch(PDO::FETCH_NUM)){
                        if($result[1] == 4){
                            print "<tr><td>";
                            print "<a href='ProductEdit.php?id=" . $result[0] . "'>" . $result[2] . "</a></td>";
                            print "<td>" . $result[3] . "</td>";
                            print "<td>" . $result[4] ."</td>";
                        }
                    }
                    print "</table>";
                    print "</div>";

                    print "</div>";
                    
                } catch (Exception $e){
                    print $e;
                }
            ?>
        </form>
    </body>
</html>