<?php
    session_start();
    /*$cartx = array();
    $pricex = array();
    $good = array();*/
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
    <?php
    /*
    $count = count($cartx);
    $total = 0;
    for($i=0; $i<$count; $i++){
        $total = $total + $pricex[$i]*$cartx[$i];
        if($i == 0){
            echo $goods[$i]." ".$pricex[$i]."×".$cartx[$i]." ";
        }else if($i%5 == 0){
            echo $goods[$i]." ".$pricex[$i]."×".$cartx[$i]."<br>";
        }else{
            echo $goods[$i]." ".$pricex[$i]."×".$cartx[$i]." ";
        } 
    }
    echo $total."円";
    */
    ?>
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
    <form>
        <input type="submit" value="戻る" name="back">
        <input type="submit" value="清算" name="seisan">
    </form>
</body>
</html>