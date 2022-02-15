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
    if(isset($_POST['back'])){
        header("Location:Top.php");
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
        .back{
            margin-top:10px;
            font-size:20px;
        }
    </style>
</head>
<body>
    <div class="main">
    <table border="1" solid;>
        <tr><th colspan="3" align="center"><p>注文履歴</p></th></tr>
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
        <input type="submit" value="戻る" class="back" name="back">
    </form>
</body>
</html>