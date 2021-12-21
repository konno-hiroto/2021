<?php //商品追加画面
    ob_start();
    session_start();
    require_once('../class/LoginUser.php');
    require_once('../database/Register.php');
    require_once('../database/Management.php');

$db = new Management();

//ログイン状態でないならモード切替画面に遷移
if(!isset($_SESSION['user'])){
    //echo("ユーザーインスタンスは存在しません");
    //モード切り替え画面に遷移
    header("Location: mode.php", true, 301);
}else{
    //ページの表示をおこなうためアンシリアライズ化
    $user = unserialize($_SESSION['user']);
}
//ログイン状態なら管理者か一般ユーザーか確認
if($user->getStatus()=="root"){
    //管理者ユーザーの処理を記述
    //echo("管理者 ");
}else if($user->getStatus()=="common"){
    //一般ユーザーの処理を記述
    //echo("一般ユーザー");
    //管理者でないのでモード切替画面に戻る
    header("Location: mode.php", true, 301);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>商品登録</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/main.css">
        <style>
            .proBtn{
                position:absolute;
                width: 200px;
                height: 100px;
                font-size: 30px;
                top:400px;
                left:250px;
                color:#000080;
            }
            .userBtn{
                position:absolute;
                width: 200px;
                height: 100px;
                font-size: 30px;
                top:400px;
                left:530px;
                color:#000080;
            }
            .saleBtn{
                position:absolute;
                width: 200px;
                height: 100px;
                font-size: 30px;
                top:400px;
                left:800px;
                color:#000080;
            }

            .text{
                position:relative;
                font-size: 50px;
                color:#000080;
            }

            

            .textBox{
                position:relative;
                height: 60px;
                font-size: 50px;
                color:#000080;
                text-align: center;
            }

            .nomalBtn{
                position:relative;
                height: 60px;
                font-size: 40px;
                color:#000080;
            }

            .error{
                position:relative;
                width: 800px;
                font-size: 25px;
                
                color:#F00;
            }

            .radio{
                position:relative;
                width: 50px;
                height: 50px;
            }

        </style>
    </head>

    
<body>

    <?php
    $error = "";

    if(isset($_POST['add'])){
    //     echo("受け取った");
        //成功時の処理
        $filename = $_FILES['img']['name'];
        //一時保存されたファイルのパスとファイルを取得
        $filedata = $_FILES['img']['tmp_name'];
        //ファイルを保存するフォルダ名
        $storeDir = 'flavor/';

        if(empty($_POST['flavorName']) || empty($filename)){
            $error = "入力されてない項目があります";
        }else{
            //成功時の処理
            $db->addFlavor($_POST['flavorName'],$filename);
            //画像をディレクトリにアップロード
            move_uploaded_file($filedata,$storeDir.$filename);
            echo('<script>alert( "フレーバー登録成功" )</script>');
            echo("<script>window.location.href = 'productManagement.php';</script>");
        }
    }
    
    ?>

    <div class="head">
        <h1 class="title">商品登録画面</h1>
        <form method="POST" action="productManagement.php">
            <input type="submit" value="キャンセル" class="canBtn"><br>
        </form>
        <form method="POST" action="mode.php">
            <!-- <input type="submit" value="ログアウト" class="loutBtn"><br> -->
        </form>
        <form method="POST" action="order.php">
            <!-- <input type="submit" value="モード切替" class="modeBtn"> -->
        </form>
        <div class="userN">
            <?php
            if($user->getStatus()=="root"){
                //管理者ユーザーの処理を記述
                echo("管理者 ");
            }else if($user->getStatus()=="common"){
                //一般ユーザーの処理を記述
                echo("一般ユーザー");
                //管理者でないのでモード切替画面に戻る
            }
            echo($user->getName());
            ?></div>
    </div>
    

    <form action="productAdd.php" method="POST" enctype="multipart/form-data">
    <p class="text">フレーバー名</p>
    <input type="text" name="flavorName" class="nomalBtn">
    <p class="text">画像を設定</p>
    <input type="file" name="img" accept="image/*" class="nomalBtn">
    <br><br>
    <p class="error"><?php echo($error); ?></p>
    <input type="submit" value="商品を登録" name="add" class="textBox">
    </form>
    

</body>