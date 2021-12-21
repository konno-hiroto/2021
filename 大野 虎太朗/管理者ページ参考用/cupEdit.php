<?php //商品編集画面
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
        <title>カップ編集</title>
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
        $error = "";
        //id他データを同ページに飛んでも保持する処理
        if(!isset($_POST['edit'])){
            $id = $_POST['cupData'];
            $name = $db->catchCupName($_POST['cupData']);
            $display = $db->catchCupDisplays($_POST['cupData']);
            $back = $db->catchCupStock($_POST['cupData']);
            $price = $db->catchCupPrice($_POST['cupData']);
            // echo("あああああ");
            // echo($id);
            
        }else{
            $id = $_POST['id'];
            $name = $_POST['name'];
            $display = $_POST['display'];
            $back = $_POST['back'];
            $price = $_POST['price'];
        }

        //編集確定ボタン押下処理
        if(isset($_POST['edit'] )){
            //入力されていない項目があります
            //在庫数に数値以外を入力することはできません
            //店頭在庫数は30以上に設定することはできません
            if(empty($_POST['price']) ||empty($_POST['display']) || empty($_POST['back'])){
                $error = "入力されてない項目があります";
            }else if(!is_numeric($_POST['price']) ||!is_numeric($_POST['display']) || !is_numeric($_POST['back'])){
                $error = "入力欄には数値以外入力できません";
            }else if($_POST['display']>30){
                $error = "店頭在庫数は30以上に設定することはできません";
            }else{
                //成功時処理
                $db->updateCup($id,$display,$back,$price);
                echo('<script>alert( "編集を確定しました" )</script>');
                echo("<script>window.location.href = 'productManagement.php';</script>");
            }

        }

    ?>
    
    <body>
        <div class="head">
            <h1 class="title">カップ編集画面</h1>
            <form method="POST" action="productManagement.php">
                <input type="submit" value="キャンセル" class="canBtn"><br>
            </form>
            <form method="POST" action="mode.php">
                <!-- <input type="submit" value="ログアウト" class="loutBtn"><br> -->
            </form>
            <form method="POST" action="order.php">
                <!-- <input type="submit" value="モード切替" class="modeBtn"> -->
            </form>
        </div>

        <p class="text"><?php echo($name); ?></p>

        
        
        <form method="POST" action="cupEdit.php">
        <input type="hidden" name="id" value="<?php echo($id) ?>">
        <input type="hidden" name="name" value="<?php echo($name) ?>">
        <input type="hidden" name="display" value="<?php echo($display) ?>">
        <input type="hidden" name="back" value="<?php echo($back) ?>">
        <input type="hidden" name="price" value="<?php echo($price) ?>">
        
        <p class="text">価格</p>
        <input type="text" class="textBox" name="price" value="<?php echo($price); ?>" >
        <p class="text">店頭在庫数</p>
        <input type="text" class="textBox" name="display" value="<?php echo($display); ?>" >
        <p class="text">店頭裏在庫数</p>
        <input type="text" class="textBox" name="back" value="<?php echo($back); ?>" >
        <br>
        <p class="error"><?php echo($error); ?></p>
        <br>
        <input type="submit" class="nomalBtn" name=edit value="編集を確定">
        </form>


    </body>
</html>