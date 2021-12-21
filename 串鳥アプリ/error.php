<?php
class OriginalException extends Exception{
    function __construct(Exception $e){
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
                exit($msg.': <br>'.$e->getMessage());
                break;
            case 'Exception':
                exit('エラー : <br>'. $e->getMessage());
                break;
            default:
                echo '予想外のエラーが起きました。';
        }
    }
}
?>