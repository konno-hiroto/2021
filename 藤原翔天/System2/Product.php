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
                weight:100px;
                padding:10px;
                background-color:#FF0000;
                border:1px solid #333;
                color:#FFFFFF;
            }
            .sub {
                weight:100px;
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
        <form action="" method="post">
            <?php
                session_start();
                if(isset($_SESSION['Username'])){
                    try{
                        $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
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
    
                        if(isset($_POST['ins'])){
                            $janr = $_POST['janr'];
                            if($janr == 0){
                                header('Location:ProductReg.php');
                            } else{
                                $proName = $_POST['proName'];
                                $proPri = $_POST['proPri'];
                                $ima = $_POST['ima'];
                                $stmt = $db->query("insert into Menu (Gid, Mname, price, stock, Mimg) values('" . $janr . "', '" . $proName . "', '" . $proPri . "', 0, '" . $ima . "')");
                            }
                        } //中身なかったらリダイレクトして追加画面に戻してもいいかも
    
                        if(isset($_POST['new'])){
                            header('Location:ProductReg.php');
                        }
    
                        if(isset($_POST['yes'])){
                            $id = $_POST['id'];
                            $stmt = $db->query("delete from Menu where Mid=" . $id . ";");
                        }
    
                        if(isset($_POST['del'])){
                            $id = $_POST['id'];
                            header('Location:ProductDel.php?id=' . $id);
                        }
    
                        if(isset($_POST['proCan'])){
                            header('Location:Management.php'); // 1の管理者画面のphp
                        }
    
                        if(isset($_POST['proRegCan'])){
                            header('Location:Product.php');
                        }
    
                        if(isset($_POST['proEdiCan'])){
                            header('Location:Product.php');
                        }
    
                        if(isset($_POST['proDelCan'])){
                            header('Location:Product.php');
                        }
    
                        print "<input type='submit' name='proCan' class='Can' value='キャンセル'><br>";
                        print "ログイン者名:" . $_SESSION['Username'];
    
                        print "<br>";
                        print "<h1>商品管理画面</h1>";
                        print "<hr><br>";
                        print "<input type='submit' name='new' class='sub' value='新規登録'><br>";
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
                }else{
                    header("location:Login.php");
                }
                
            ?>
        </form>
    </body>
</html>