<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['Login'])){
            header("location:Login.php");
        }else if(isset($_POST['kaikei'])){
            header("location:kaikei.php");
        }else if(isset($_POST['call'])){
            $alert = "<script type='text/javascript'>alert('ただいま店員が来ますので、少々お待ちください');</script>";
            echo $alert;
        }else if(isset($_POST['toTop'])){
            header("location:top.php");
        }else if(isset($_POST['toCart'])){
            if(isset($_SESSION['cart'])){
                header("location:Cart.php");
            }else{
                $mes = "カートの中身が入っていません";
            }
        }else{
            $product = $_POST['product'];
            $num = $_POST['num'];
            $price = $_POST['price'];
            $_SESSION['cart'][$product] = $num;
            $_SESSION['price'][$product] = $price;
        }
    }
    $cart = array();
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $price = array();
    if (isset($_SESSION['price'])) {
        $price = $_SESSION['price'];
    }
?>
<!DOCTYPE html>
<html>
<head>   
    <title>ジャンル別メニュー</title>
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
        #toTop,#kaikei,#call,#Login{
            width: 20%;
            height: 100px; 
            color:blue;
            font-size: 50px;
        }
        #tableC{
            width:250px;
        }
        #toCart{
            width:250px;
        }
    </style>
</head>
<body>
    <div class="main">
    <div class="contents">
    <?php
        try{
            require_once "connect.php";
            include 'error.php';
            $dbconnect = new connect();
            //ジャンル一覧を表示
            $stmt = $dbconnect->db->query('SELECT * FROM Genre');
            $stmt->execute();
            while($data = $stmt->fetch(PDO::FETCH_NUM)){
                echo "<a href='Genre.php?Gid=$data[0]'>";
                echo "<div class='items'>";
                echo "$data[1]";
                echo "</div>";
                echo "</a>";
            }
            $db = null;
            //
            echo "</div>";
            echo "<div class='cart'>";
            if(isset($_POST['toCart'])){
                if(isset($_SESSION['cart']) === false){
                    echo $mes;
                }
            }
            echo "<form action='' method='post'>";
            echo "<input type='submit' name='toCart' id='toCart' value='カートへ'>";
            echo "</form>";    
            echo "<div>";
            echo '<table border="1" solid; id="tableC">';
            echo "<tr><th>商品</th><th>個数</th></tr>";
            ?>
            <?php foreach($cart as $key => $var):?>
            <?php
            $dbconnect = new connect();
            $stmt = $dbconnect->db->query('SELECT * FROM Menu');
            $stmt->execute();
            while($data = $stmt->fetch(PDO::FETCH_NUM)){
                if ($key == $data[2]) {
                    echo "<tr>";
                    echo "<td>$data[2]</td>";
                    echo "<td>";
                    echo $var;
                    echo "個</td>";
                    echo "</tr>";
                }
            }
            ?>
            <?php endforeach;?>
            <?php
            echo "</table>";
            echo "</div>";
            echo "</div>";
            //
            echo "<div class='contentsA'>";
            if(isset($_GET['Gid'])){
                $stmt = $dbconnect->db->prepare('SELECT * FROM Menu WHERE Gid=:id');
                $stmt->bindValue( ':id', $_GET['Gid'], PDO::PARAM_INT);
                $stmt->execute();
                while($data = $stmt->fetch(PDO::FETCH_NUM)){
                    echo "<form method='post'>";
                    echo "<div class='menu'>";
                    echo "<img src='串鳥メニュー画像/".$data[5]."'>";
                    echo "$data[2]<br>";
                    if($data[1] == 1){
                        $p = $data[3]*2;
                        echo "($p"."円)<br>";
                    }else{
                        echo "($data[3]円)<br>";
                    }
                    echo "<select name='num'>";
                    if($data[4] > 4){
                        for($i = 1; $i < 6; $i++){
                            echo "<option value='".$i."'>$i</option>";
                        }
                    }else if($data[4] == 0){
                        echo "<option value=''>0</option>";
                    }else{
                        for($i = 1; $i <= $data[4]; $i++){
                            echo "<option value='".$i."'>$i</option>";
                        }
                    }
                    echo "</select>";
                    echo "<input type='hidden' name='Menuid' value='".$data[0]."'>";
                    echo "<input type='hidden' name='product' value='".$data[2]."'>";
                    echo "<input type='hidden' name='price' value='".$data[3]."'>";
                    if(isset($cart[$data[2]])===true){
                        echo "<p>追加済</p>";
                    }else if($data[4] == 0){
                        echo "<p>売り切れ</p>";
                    }else{
                        echo "<input type='submit' value='カートに追加'>";
                    }
                    echo "</div>";
                    echo "</form>";
                }
                echo "</div>";
            }
            }catch(Exception $e){
                throw new OriginalException($e);
            }
    ?>
    </div>
    <form method="post">
    <footer>
        <input type="submit" id="toTop" name="toTop" value="TOP画面">
        <input type="submit" id="kaikei" name="kaikei" value="会計">
        <input type="submit" id="call" name="call" value="呼び出し">
        <input type="submit" id="Login" name="Login" value="ログイン">
    </footer>
    </form>
</body>
</html>