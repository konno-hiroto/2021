<?php 
    session_start();
    if(isset($_POST['toUser'])){
        if($_SESSION['alevel']==1){
            header("location:User.php");
        }else{
            $mes = "＊管理者のみのアクセス";
        }
    }
    if(isset($_POST['logout'])){
        unset($_SESSION['Username']);
        unset($_SESSION['Pass']);
        unset($_SESSION['Userid']);
        unset($_SESSION['alevel']);
        header("location:Login.php");
    }

?>
<!DOCTYPE html>
<html>
<head>   
    <title>管理者画面</title>
    <meta charset="utf-8">
    <style>
        header{
            text-align:center;
            width:100%;
            height:150px;
            margin:50px 0px;
            font-size: 20px;
            border-bottom:1px solid;
        }
        header h1{
            font-size:30px;
        }
        header p{
            margin-left:60%;
        }
        #contents{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 100%;
            margin: 0px 0;
            padding: 0px 0px;
        }
        #items{
            width: calc(100% / 2 - 50px);
            margin-bottom: 15px;
            padding: 10px 10px;
            text-align: center;
            font-size: 30px;
        }
        #su{
            width:500px;
            height:200px;
        }
    </style>
</head>
<body>
    <header>
        <form action="" method="post">
        <input type="submit" value="ログアウト" name="logout">
        </form>
        <p><?php echo "ログイン者 : ".$_SESSION['Username'];?></p>
        <h1>管理者画面</h1>
        <?php if(isset($_POST['toUser'])){echo $mes;}?>
    </header>
    <form action="" method="post">
        <div id="contents">
            <div id="items">
                <input type="submit" id="su" value="ユーザー管理画面" name="toUser">
            </div>
            <div id="items">
                <input type="submit" id="su" value="在庫管理画面" name="toStock">                
            </div>
            <div id="items">
                <input type="submit" id="su" value="商品管理画面" name="toGoods">    
            </div>
            <div id="items">
                <input type="submit" id="su" value="売上一覧" name="toBenifit">
            </div>
        </div>
    </form>
</body>
</html>