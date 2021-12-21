<?php //商品削除画面
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

if( isset($_POST['on']) ){
    //削除処理を実行
    $db->userDelete($_POST['id']);
    echo('<script>alert( "ユーザーを削除しました" )</script>');
    echo("<script>window.location.href = 'userManagement.php';</script>");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>ユーザー登録</title>
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

        </style>
    </head>
    <body>

        <?php

        ?>

        <div class="head">
            <h1 class="title">ユーザー削除画面</h1>
            <form method="POST" action="userManagement.php">
                <input type="submit" value="キャンセル" class="canBtn"><br>
            </form>
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
                //echo("一般ユーザー");
                //管理者でないのでモード切替画面に戻る
            }
            echo($user->getName());
            ?></div>
        </div>
        <p class="text">本当にユーザー:<?php echo($_POST['name']) ?>を削除してもよろしいですか?</p>

        <form method="POST" action="userDeleteConfirm.php">
            <input type="hidden" name="id" value="<?php echo($_POST['id']) ?>">
            <input type="hidden" name="name" value="<?php echo($_POST['name']) ?>">
            <input type="submit" value="削除確定" name="on" class="nomalBtn">
        </form>
    </body>
</html>