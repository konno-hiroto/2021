<?php
    session_start();
    $cartx = array();
    $pricex = array();
    $good = array();
    //セッションcartxがある場合$cartxに
    if (isset($_SESSION['cartx'])) {
        $cartx = explode("/",$_SESSION['cartx']);
    }
    //セッションpricexがある場合$pricexに
    if(isset($_SESSION['pricex'])){
        $pricex = explode("/",$_SESSION['pricex']);
    }
    //セッションgoodがある場合$goodに
    if(isset($_SESSION['goods'])){
        $goods = explode("/",$_SESSION['goods']);
    }
    //セッションSHがある場合$SHに
    if(isset($_SESSION['SH'])){
        $SH = explode("/",$_SESSION['SH']);
    }
    //セッションstockがある場合$SHに
    if(isset($_SESSION['stock'])){
        $stock = explode("/",$_SESSION['stock']);
    }
    //セッションGnumがある場合$Gnumに
    if(isset($_SESSION['Gnum'])){
        $Gnum = explode("/",$_SESSION['Gnum']);
    }
    if(isset($_POST['seisan'])){
        $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $count = count($cartx);
            $today = date("Y-m-d");
            for($i=0; $i<$count; $i++){
                $sql = 'INSERT INTO OrderList(DATE, Mid,Kosuu,Total) VALUES (:DATE, :Mid,:Kosuu,:Total)';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':DATE', $today,PDO::PARAM_STR);
                $stmt->bindValue(':Mid', $SH[$i], PDO::PARAM_STR);
                $stmt->bindValue(':Kosuu', $cartx[$i], PDO::PARAM_INT);
                $stmt->bindValue(':Total', $cartx[$i]*$pricex[$i], PDO::PARAM_INT);
                $stmt->execute();
                if($Gnum[$i] == 1){
                    $M = $stock[$i] - ($cartx[$i]*2);
                }else{
                    $M = $stock[$i] - $cartx[$i];
                }
                $stmt = $db->prepare('UPDATE Menu set stock=:stock where Mid=:Mid');
                $stmt->bindValue( ':Mid', $SH[$i], PDO::PARAM_INT);
                $stmt->bindValue( ':stock', $M,PDO::PARAM_INT);  
                $stmt->execute();
            }
            header("Location:delete2.php");
            exit();
        }catch(PDOException $e){
            print ("データベースに接続できませんでした".$e->getMessage());
        }catch(Exception $e){
            print ("予期せぬエラーです".$e->getMessage());
        }
    }
?>
<!DOCTYPE html>
<html>
<head>   
    <title>会計</title>
    <meta charset="utf-8">
    <style>
        .main{
            text-align: center;
            margin:auto;
        }
        table{
            text-align: center;
            margin-left:auto;
            margin-right:auto;
            font-size:20px;
            width:40%;
        }
        .last{
            background-color:yellow;
        }
    </style>
</head>
<body>
    <div class="main">
    <table border="1" solid;>
        <tr><th colspan="3" align="center"><p>注文一覧</p></th></tr>
        <tr><td>商品名</td><td>個数</td><td>値段</td></tr>
        <?php
            $count = count($cartx);
            $total = 0;
            $Tnum = 0;
            for($i=0; $i<$count; $i++){
                $total = $total + ($pricex[$i]*$cartx[$i]);
                $Tnum = $Tnum + $cartx[$i];
                echo "<tr><td>$goods[$i]</td><td>$cartx[$i]個</td><td>$pricex[$i]円</td></tr>";
            }
            echo "<tr class='last'><td>合計</td><td>$Tnum"."個</td><td>$total"."円</td></tr>";
        ?>
    </table>
    <form action="" method="post">
        <input type="submit" value="戻る" name="back">
        <input type="submit" value="清算" name="seisan">
    </form>
</body>
</html>