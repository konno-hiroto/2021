<?php //ユーザー管理画面
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
    echo("管理者 ");
}else if($user->getStatus()=="common"){
    //一般ユーザーの処理を記述
    echo("一般ユーザー");
    //管理者でないのでモード切替画面に戻る
    header("Location: mode.php", true, 301);
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

            .radio{
                position:relative;
                width: 50px;
                height: 50px;
            }

        </style>
    </head>

     
    

    <body>

        <?php
            $error="";
            //入力されていない項目があります
            //"パスワード再入力に異なる文字列が入力されています。"
            
            //登録ボタンが押されているか
            if( isset($_POST['add']) ){
                if( empty($_POST['userName'])||empty($_POST['pass'])||empty($_POST['passConf']) ) {
                    $error = "入力されていない項目があります。";
                }else if($_POST['pass']!=$_POST['passConf']){
                    $error="パスワード再入力に異なる文字列が入力されています。";
                }else{
                    //テキストボックス入力成功時管理者か一般どっち登録か判断
                    if($_POST['status']=="common" ){
                        //一般ユーザーを登録
                        $db->userAdd($_POST['userName'],$_POST['pass'],'common');
                        echo('<script>alert( "一般ユーザー登録成功" )</script>');
                        echo("<script>window.location.href = 'userManagement.php';</script>");
                    }else if($_POST['status']=="root"){
                        //管理者を登録
                        $db->userAdd($_POST['userName'],$_POST['pass'],'root');
                        echo('<script>alert( "管理者ユーザー登録成功" )</script>');
                        echo("<script>window.location.href = 'userManagement.php';</script>");
                        
                        //header("Location: userManagement.php", true, 301);
                    }else{
                        $error="なんらかのエラー";
                    }
                }
            }
        ?>
        <div class="head">
            <h1 class="title">ユーザー登録画面</h1>
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
                echo("一般ユーザー");
                //管理者でないのでモード切替画面に戻る
            }
            echo($user->getName());
            ?></div>
        </div>
        

        
        <form method="POST" action="userAdd.php">
            <p class="text">一般ユーザー</p>
            <input type="radio" name="status" value="common" checked="checked" class="radio">
            <p class="text" class="text">管理者ユーザー</p>
            <input type="radio" name="status" value="root" class="radio">
            <p class="text" class="text">ユーザー名</p>
            <input type="text" name="userName" value="" class="textBox">
            <p class="text" class="text">パスワード</p>
            <input type="text" name="pass" value="" class="textBox">
            <p class="text" class="text">パスワード再入力</p>
            <input type="text" name="passConf" value="" class="textBox">
            <p class="error" class="textBox"><?php echo($error); ?></p>
            <input type="submit" name="add" value="登録" class="nomalBtn">
        </form>
        
    </body>
</html>