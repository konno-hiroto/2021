
<!DOCTYPE html>
<html>
<head>   
    <title>エラー</title>
    <meta charset="utf-8">
    <style>
    span{
        font-size:50px;
        color:red;
    }
    </style>
</head>
<body>
<?php
class OriginalException extends Exception{
    function __construct(Exception $e){
        
    }
    function printMessage(Exception $e){
        $code = $e->getCode();
        $msg="err";
        //getMessageだとエラーの内容
        if($code == "1045"){
            $msg = 'データベース接続エラー';
        }
        if($code == "42S02"){
            $msg = 'SQLエラー';
        }
        if($code == "2002"){
            $msg = 'データベースが起動されていません';
        }

        switch(get_class($e)){
            case 'PDOException':
                exit('<span style="font-size: 50px">'.$msg.': <br>'.$e->getMessage().'</span>');
                break;
            case 'Exception':
                exit('エラー : <br><span style="font-size: 150%">'.$e->getMessage().'</span>');
                break;
            default:
                echo '予想外のエラーが起きました。';
        }
    }
}
?>
</body>
</html>