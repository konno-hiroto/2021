<?php
try{
    require_once "connect.php";
    include 'error.php';
    $dbconnect = new connect();
    session_start();
    if(isset($_POST['login'])){
        $_SESSION['pass'] = $_POST['pass'];
        $stmt = $dbconnect->db->prepare('SELECT * FROM Users where pass= :pass');
        $stmt->bindParam(':pass', $_SESSION['pass']);
        $stmt->execute();
        $result = $stmt->fetch();
            if(strcmp($result['pass'],$_SESSION['pass']) == 0){
                if(strcmp($_SESSION['pass'],"") == 0){
                    $mes =  "パスワードが入力されていません";
                }else{
                    $_SESSION['Username'] = $result['Username'];
                    $_SESSION['alevel'] = $result['alevel'];
                    header("location:Management.php");
                }
            }else{
                $mes = "パスワードが一致しません";
            }
            $db = null;
    }
    }catch(Exception $e){
        throw new OriginalException($e);
    }
?>
<!DOCTYPE html>
<html>
<head>   
    <title>ログイン画面</title>
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
        #f1{
            text-align:center;
            font-size: 30px;
        }
        #f1 h2{
            font-size:30px;
        }
        input{
            font-size: 100%;
            margin:10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>ログイン画面</h1>
    </header>
    <form action="" method="post" id="f1">
        <h2>パスワードを入力してください</h2>
        pass:<input type="password" style="width: 300px; height: 50px;" name="pass"><br>
        <?php
        if(isset($_POST['login'])){
            echo $mes."<br>";
        }           
        ?>
        <input type="submit" value="ログイン" name="login">
    </form>
</body>
</html>