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
        body{
            width:1500px;
        }
        .items{
            width: calc(1170px / 4 - 30px);
            height:100px;
            margin: 0px 2px;
            padding: 10px 10px;
            position:relative;
            border: 1px solid;
        }
        .items img{
            object-fit: cover;
            position:absolute;
            width:100%;
            height:100%;
            top:0;
            left:0;
        }
        .contents{
            display: flex;
            flex-wrap: wrap;
            width: 78%;
            margin: 0px 0;
            padding: 0px 0px;
        }
        .menu{
            width: calc(1170px / 3 - 30px);
            height:150px;
            margin: 0px 2px;
            padding: 10px 10px;
            position:relative;
            border: 1px solid;
        }
        .menu img{
            position:absolute;
            top :0;
            right :0;
            width:60%;
            height:100%
        }
        .contentsA{
            display: flex;
            flex-wrap: wrap;
            width: 78%;
            margin: 0px 0;
            padding: 0px 0px;
        }
        .main{
            display: flex;
            flex-wrap: wrap;
        }
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 30px 0;
        }
        footer #kaikei,#call,#Amenu,#Bmenu,#login{
            width: 30%;
            height: 100px; 
            color:blue;
            font-size: 50px;
        }
    </style>
</head>
<body>
    <div class="main">
    <?php
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
    ?>
    </div>
</body>
</html>