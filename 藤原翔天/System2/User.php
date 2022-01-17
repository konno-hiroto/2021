<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>   
    <title>ユーザー管理画面</title>
    <meta charset="utf-8">
    <style>
        header{
            text-align:center;
            width:100%;
            height:150px;
            margin:50px 0px;
            font-size: 30px;
            border-bottom:1px solid;
        }
        header h1{
            font-size:30px;
        }
        header p{
            margin-left:60%;
        }
    </style>
</head>
<body>
<header>
    <p>ログイン者 : <?php echo $_SESSION['Username'];?></p>
    <h1>ユーザー管理画面</h1>
</header>
    <form action="" method="post">
        <input type="submit" id="reg" value="新規登録"><br>
        <h3>管理者</h3>
        <table border="1" solid;>
            <tr><th>ユーザーID</th><th>ユーザーネーム</th></tr>
<?php
   try{
    require_once "connect.php";
    include 'error.php';
    $dbconnect = new connect();
    $stmt = $dbconnect->db->query('SELECT * FROM Users where alevel=1');
    $stmt->execute();
    while($data = $stmt->fetch(PDO::FETCH_NUM)){
        echo "<tr>";
        echo "<td><a href='updateUser1.php?id=$data[0]'>$data[0]</a></td>";
        echo "<td>$data[1]</td>";
        echo "</tr>";
    }
    $db = null;
   }catch(Exception $e){
        throw new OriginalException($e);
   }
?>
        </table>
        <h3>一般ユーザー</h3>
<?php
   try{
    require_once "connect.php";
    include 'error.php';
    $dbconnect = new connect();
    $stmt = $dbconnect->db->query('SELECT * FROM suer where alevel=2');
    $stmt->execute();
    while($data = $stmt->fetch(PDO::FETCH_NUM)){
        echo "<tr>";
        echo "<td><a href='updateUser1.php?id=$data[0]'>$data[0]</a></td>";
        echo "<td>$data[1]</td>";
        echo "</tr>";
    }
    $db = null;
   }catch(Exception $e){
        throw new OriginalException($e);
   }
?>
    </form>
</body>
</html>