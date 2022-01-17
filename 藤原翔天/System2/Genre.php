<!DOCTYPE html>
<html>
<head>   
    <title>PHP</title>
    <meta charset="utf-8">
</head>
<style>
    #d{
            width: calc(100% / 3 - 30px);
            margin-bottom: 30px;
            padding: 50px 10px;
            text-align: center;
            background-color: coral;
            font-size: 30px;
        }
        .contents{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 100%;
            margin: 30px 0;
            padding: 120px 0px;
        }
        /*body{
            height:1000px;
        }*/
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 30px 0;
        }
        footer #kaikei,#call,#Amenu,#Bmenu{
            width: 20%;
            height: 100px; 
            color:blue;
            font-size: 50px;
        }
        header{
            position:fixed;
            width: 100%;
            text-align: center;
            height: 112px;
            margin-top: 0;
        }
        header button{
            width: 15%;
            height: 80px; 
            color:blue;
            font-size: 30px;
        }
</style>
<body>
    <?php
        try{
            require_once "connect.php";
            include 'error.php';
        
            $dbconnect = new connect();
            /*if(isset($_POST["delete"])){
                //$ya_id="";
                if(isset($_POST["ya_id"])){
                    $ya_id=$_POST["ya_id"];
                    $stmt = $dbconnect->db->prepare('DELETE FROM user1 WHERE id = :id');
                    $stmt->bindValue(':id', $ya_id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }*/
            $stmt = $dbconnect->db->query('SELECT * FROM Genre');
            $stmt->execute();
            echo "<header>";
            while($data = $stmt->fetch(PDO::FETCH_NUM)){
                echo "<input type='button' id=''G'.$data[0]' value='$data[1]'>";
            }
            echo "</header>";
            $db = null;
           }catch(Exception $e){
                throw new OriginalException($e);
           }

    ?>
    <footer>
        <input type="button" id="kaikei" value="会計">
        <input type="button" id="call" value="呼び出し">
        <input type="button" id="Amenu" value="前のメニューへ">
        <input type="button" id="Bmenu" value="次のメニューへ">
    </footer>
</body>
</html>