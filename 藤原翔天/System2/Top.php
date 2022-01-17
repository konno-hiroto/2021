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
        footer #kaikei,#call,#Amenu,#Bmenu,#login{
            width: 30%;
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
        echo "<a href='Menu.php?Gid=$data[0]'>";
        echo "<div class='items'>";
        echo "<p>aaaaa</p>";
        echo "<img src='img/".$data[2]."'>";
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
    <div>
        <div>
            <input type="button" id="cartOrder" value="カート発注">
        </div>
        <div>
            <tr><th>商品名</th><th>個数</th><th></th></tr>
    <?php
    /*try{
        require_once "connect.php";
        include 'error.php';
        $dbconnect = new connect();
        $stmt = $dbconnect->db->query('SELECT * FROM Genre');
        $stmt->execute();
        while($data = $stmt->fetch(PDO::FETCH_NUM)){
            //echo "<a href='Menu.php?id=$data[0]'>";
            echo "<div class='items'>";
            echo "<p>$data[1]</p>";
            echo "<img src='img/".$data[2]."'>";
            echo "</div>";
            //echo "</a>";
        }
        $db = null;
       }catch(Exception $e){
            throw new OriginalException($e);
       }*/    
    ?>
        </div>
    </div>
    <form method="post">
    <footer>
        <input type="submit" id="kaikei" name="kaikei" value="会計">
        <input type="submit" id="call" value="呼び出し">
        <input type="submit" id="login" name="Login" value="ログイン">
    </footer>
    </form>
</body>
</html>