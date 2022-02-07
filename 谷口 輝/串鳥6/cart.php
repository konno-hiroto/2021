<?php
    session_start();
    $cart = array();
    $price = array();
    //セッションcartがある場合$cartに
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    //セッションpriceがある場合$priceに
    if(isset($_SESSION['price'])){
        $price = $_SESSION['price'];
    }
    // POSTで受け取った場合
    if(isset($_POST['fs'])){
        $product = $_POST['product'];
        $kind = $_POST['kind'];
        if ($kind === 'change') {    
            $num = $_POST['num'];
            $_SESSION['cart'][$product] = $num;
        } else if ($kind === 'delete') {
            unset($_SESSION['cart'][$product]);
            unset($_SESSION['price'][$product]);
        }
    }
    //戻るボタンが押された時
    if(isset($_POST['back'])){
        header("location:Top.php");
    } 
    //確定ボタンが押された時
    if(isset($_POST['commit'])){
        if(isset($_SESSION['cart'])){
            $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($cart as $key => $var){
                $stmt = $db->query('SELECT * FROM Menu');
                $stmt->execute();
                $count = count($cart);
                $today = date("Y-m-d");
                while($data = $stmt->fetch(PDO::FETCH_NUM)){
                    //keyと商品名が一致したとき
                    if ($key == $data[2]) {
                        try{
                        $sql = 'INSERT INTO OrderList(DATE, Mid,Kosuu,Total) VALUES (:DATE, :Mid,:Kosuu,:Total)';
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':DATE', $today,PDO::PARAM_STR);
                        $stmt->bindValue(':Mid',$data[0] , PDO::PARAM_STR);
                        $stmt->bindValue(':Kosuu', $_SESSION['cart'][$key], PDO::PARAM_INT);
                        $stmt->bindValue(':Total', $_SESSION['cart'][$key]*$_SESSION['price'][$key] , PDO::PARAM_INT);
                        $stmt->execute();
                        if($data[0] == 1){
                            $M = $data[4] - ($_SESSION['cart'][$key]*2);
                        }else{
                            $M = $data[4] - $_SESSION['cart'][$key];
                        }
                        $stmt = $db->prepare('UPDATE Menu set stock=:stock where Mid=:Mid');
                        $stmt->bindValue( ':Mid', $data[0], PDO::PARAM_INT);
                        $stmt->bindValue( ':stock', $M,PDO::PARAM_INT);  
                        $stmt->execute();
                        //exit();
                        //cartxがある時
                        if(isset($_SESSION['cartx'])){
                            $_SESSION['cartx'] = $_SESSION['cartx'].'/'.$_SESSION['cart'][$key];
                        }
                        //cartxがない時
                        else{
                            $_SESSION['cartx'] = $_SESSION['cart'][$key];
                        }
                        //pricexがある時
                        if(isset($_SESSION['pricex'])){
                            $_SESSION['pricex'] = $_SESSION['pricex'].'/'.$_SESSION['price'][$key];
                        }
                        //pricexがない時
                        else{
                            $_SESSION['pricex'] = $_SESSION['price'][$key];
                        }
                        //goodsがある時
                        if(isset($_SESSION['goods'])){
                            $_SESSION['goods'] = $_SESSION['goods'].'/'.$data[2];
                        }
                        //goodsがない時
                        else{
                            $_SESSION['goods'] = $data[2];
                        }
                        //商品番号がある時
                        if(isset($_SESSION['SH'])){
                            $_SESSION['SH'] = $_SESSION['SH'].'/'.$data[0];
                        }
                        //商品番号がない時
                        else{
                            $_SESSION['SH'] = $data[0];
                        }
                        //ジャンル番号がある時
                        if(isset($_SESSION['Gnum'])){
                            $_SESSION['Gnum'] = $_SESSION['Gnum'].'/'.$data[1];
                        }
                        //ジャンル番号がない時
                        else{
                            $_SESSION['Gnum'] = $data[1];
                        }
                        //stockがある時
                        if(isset($_SESSION['stock'])){
                            $_SESSION['stock'] = $_SESSION['stock'].'/'.$data[4];
                        }
                        //stockがない時
                        else{
                            $_SESSION['stock'] = $data[4];
                        }
                    }catch(PDOException $e){
                        print ("データベースに接続できませんでした".$e->getMessage());
                    }catch(Exception $e){
                        print ("予期せぬエラーです".$e->getMessage());
                    }
                    }else{
                        continue;
                    }
                }
            }
        //配列cart,priceを削除後Kakutei.phpへ
        unset($_SESSION['cart']);
        unset($_SESSION['price']);
        header("location:Kakutei.php");
    }else{
        echo "カートの中身が入っていません";
    }
}
        
    $total = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カート</title>
<style>
    table{
        text-align:center;
        width:500px;
        height:300px;
    }
    body{
        text-align:center;
    }
    .contents{
        position:relative;
    }
    .b{
        position:absolute;
        top: 50%;
        right: 25%;
    }
    .b input{
        width:90px;
        height:90px;
        font-size:20px;
        margin-bottom:10px;
    }
</style>
</head>
<body>
<div class="main">
    <div class="contents">
<table border="1" solid; align="center">
    <tr>
        <th>商品</th><th colspan="2">個数</th><th>変更ボタン</th><th>削除ボタン</th>
    </tr>
    <?php foreach($cart as $key => $var): ?>
    <tr>
        <td>
        <?php
        try{
            $count = count($cart);
            $db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','admin');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->query('SELECT * FROM Menu');
            $stmt->execute();
            for($i=0; $i<$count; $i++){
                while($data = $stmt->fetch(PDO::FETCH_NUM)){
                    if ($key == $data[2]) {
                        echo $data[2];
                    }
                }
            }
        }catch(PDOException $e){
            print ("データベースに接続できませんでした".$e->getMessage());
        }catch(Exception $e){
            print ("予期せぬエラーです".$e->getMessage());
        }
        ?>
        </td>
        <td><?php echo $var ?>個</td>
        <!- 変更ボタン ->
        <form action="" method="post">
            <td>
                <select name="num">
                    <?php for($i = 1; $i <6; $i++):?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </td>
            <td>
                <input type="hidden" name="kind" value="change">
                <input type="hidden" name="product" value="<?php echo $key ?>">
                <input type="submit" name="fs" value="変更">
            </td>
        </form>

        <!- 削除ボタン ->
        <form action="" method="post">
            <td>
                <input type="hidden" name="kind" value="delete">
                <input type="hidden" name="product" value="<?php echo $key ?>">
                <input type="submit" name="fs" value="削除">
            </td>
        </form>
    </tr>
    <?php endforeach; ?>
    </div>
</table>
<form action="" method="post">
<div class="b">
    <div>
        <input type="submit" name="back" value="戻る">
    </div>
    <div>
        <input type="submit" name="commit" value="確定">
    </div>
</div>
</form>
</div>
</body>
</html>