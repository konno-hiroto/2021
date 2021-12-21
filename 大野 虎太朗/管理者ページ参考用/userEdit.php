<?php //商品編集画面
    ob_start();
    session_start();
    require_once('../class/LoginUser.php');
    require_once('../database/Register.php');
    require_once('../database/Management.php');

$db = new Management();



//起動時処理
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
    echo("一般ユーザー ");
    //管理者でないのでモード切替画面に戻る
    header("Location: mode.php", true, 301);
}


$error="";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ユーザー編集</title>
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
        <div class="head">
            <h1 class="title">ユーザー編集画面</h1>
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

        
        <?php
        //まずは確定で編集しているnameが確実に入るように設定

        if( isset($_POST['che']) ){
            $name = $_POST['che'];
            $id = $_POST['id'];
            if( empty($_POST['name'])||empty($_POST['pass'])||empty($_POST['passConf']) ) {
                $error = "入力されていない項目があります。";
            }else if($_POST['pass']!=$_POST['passConf']){
                $error="パスワード再入力に異なる文字列が入力されています。";
            }else{
                    //成功したら始める
                    $error = "登録成功";
                    $db->chengeName($id,$_POST['name']);
                    $db->chengePass($id,$_POST['pass']);
                    echo('<form method="POST" action="masHome.php">');
                    echo('<input type="submit" name="" value="ホーム画面に戻る">');
                    echo('</form>');
                    echo('<script>alert( "編集を確定しました" )</script>');
                    echo("<script>window.location.href = 'userManagement.php';</script>");
            }
        }
        else{
            $error="";
            $name = $db->catchName();
            $id = $db->catchId();
        }
        ?>
        <p class="text"><?php echo($name); ?></p>
        <form method="POST" action="userDeleteConfirm.php">
            <input type="hidden" name="name" value="<?php echo($name) ?>">
            <input type="hidden" name="id" value="<?php echo($id) ?>">
            <input type="submit" value="ユーザーを削除" class="nomalBtn">
        </form>
        
        <form method="POST" action="userEdit.php">
            <p class="text" >変更後ユーザー名</p>
            <input type="text" name="name" value="<?php echo($name); ?>" class="textBox" >
            <input type="hidden" name="che" value="<?php echo($name) ?>">
            <input type="hidden" name="id" value="<?php echo($id) ?>">
            <p class="text">変更後パスワード</p>
            <input type="text" name="pass" class="textBox">
            <p class="text">パスワード再入力</p>
            <input type="text" name="passConf" class="textBox">
            <br>
            <p class="error"><?php echo($error) ?></p>
            <input type="submit" name="" value="編集を確定" class="nomalBtn">
        </form>
    </body>
</html>