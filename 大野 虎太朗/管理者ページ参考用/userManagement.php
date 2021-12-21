
<?php 
    ob_start();
    session_start();
    require_once('../class/LoginUser.php');
    require_once('../database/Register.php');
    require_once('../database/Management.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ユーザー管理</title>
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

    <?php 
    //管理者ホーム画面

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
        //echo("管理者");
    }else if($user->getStatus()=="common"){
        //一般ユーザーの処理を記述
        //echo("一般ユーザー");
        //管理者でないのでモード切替画面に戻る
        header("Location: mode.php", true, 301);
    }
    
    //masLoginで作ったuser
    //echo($user->getName());
    
    ?>

    <body>
        <div class="head">
            <h1 class="title">ユーザー管理画面</h1>
            <form method="POST" action="masHome.php">
                <input type="submit" value="キャンセル" class="canBtn"><br>
            </form>
            <form method="POST" action="mode.php">
                <input type="submit" value="ログアウト" class="loutBtn"><br>
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
        <!-- 新規ユーザー登録ボタン -->
        <form method="POST" action="userAdd.php">
            <input type="submit" value="新規ユーザー登録" class="nomalBtn">
        </form>
        <!-- 管理者ユーザーを一括表示 -->
        <form method="post" name="formId" action="userEdit.php">

        <p class="text">管理者ユーザー</p>
        <table border="2" >
            <tr> <th class="text">ユーザーID</th> <th class="text">ユーザー名</th> </tr>
            
            <?php
            $db = new Management();
            //$db->masIdAndName3();
            
            ?>
            <?php $db->rootIdAndName(); ?>
        </table>

        <br>

        <p class="text">一般ユーザー</p>
        <table border="2">
        <tr> <th class="text">ユーザーID</th> <th class="text">ユーザー名</th> </tr>
        <?php  $db->commonIdAndName(); ?>
        </table>
        
        </form>
        
        


        

        
        


    </body>
</html>