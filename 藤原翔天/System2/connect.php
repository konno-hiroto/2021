<!DOCTYPE html>
<html>
<head>   
    <title>PHP</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    //include 'error.php';
        class connect{
            public $db;
            //コンストラクタ
            function __construct(){
                try{
                    $this->db = new PDO('mysql:host=localhost;dbname=yoiteam;charset=utf8','yoiteam','admin');
                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    $error = new OriginalException($e);
                    $error->printMessage($e);
                }
            }
            //デストラクタ
            function __destruct(){
                $db = null;
            }
        }
    ?>
</body>
</html>
