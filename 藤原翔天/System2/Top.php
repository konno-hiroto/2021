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
        }else if(isset($_POST['Orderh'])){
            header("location:Orderh.php");
        }else{
            $product = $_POST['product'];
            $num = $_POST['num'];
            $_SESSION['cart'][$product] = $num;
        }
    }
    $cart = array();
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
?>
<!DOCTYPE html>
<html>
<head>   
    <title>Top画面</title>
    <meta charset="utf-8">
    <style>
        body{
            width:1500px;           
        }
        .items{
            width: calc(1170px / 3 - 30px);
            height:150px;
            margin: 5px 2px;
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
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 30px 0;
        }
        footer #kaikei,#call,#Orderh,#login{
            width: 20%;
            height: 100px; 
            color:blue;
            font-size: 50px;
        }
    </style>
    <script>
    </script>
</head>
<body>
    <script>
    </script>
    <div class="contents">
    <?php
    try{
    require_once "connect.php";
    include 'error.php';
    $dbconnect = new connect();
    $stmt = $dbconnect->db->query('SELECT * FROM Genre');
    $stmt->execute();
    while($data = $stmt->fetch(PDO::FETCH_NUM)){
        echo "<a href='Genre.php?Gid=$data[0]'>";
        echo "<div class='items'>";
        echo "<img src='串鳥メニュー画像/".$data[2]."'>";
        echo "</div>";
        echo "</a>";
    }
    $db = null;
    if(isset($_POST['Login'])){
        header("location:Login.php");
    }
    }catch(Exception $e){
        throw new OriginalException($e);
    }
    ?>
    </div>
    <div class="cart">
        <a href="cart.php">
            <div>カートを見る</div>
        </a>
        <div>
            <table border="1" solid;>
                <tr><th>商品</th><th>個数</th></tr>
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
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <form method="post">
    <footer>
        <input type="submit" id="Orderh" name="Orderh" value="注文履歴">
        <input type="submit" id="kaikei" name="kaikei" value="会計">
        <input type="submit" id="call" name="call" value="呼び出し">
        <input type="submit" id="login" name="Login" value="ログイン">
    </footer>
    </form>
</body>
</html>