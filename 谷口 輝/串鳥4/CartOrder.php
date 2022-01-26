<!doctype html>
<html>
    <head>
        <title>注文画面</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            class testClass{
                public $list = array(1 => "串1", 2 => "串2");
            }
            

            //$test = new testClass;
            $list = array(1 => "串1",2 => "串1",1 => "串1",3 => "串1");
            
            print "<table border=1>";
            print "<tr><th>商品名</th><th>個数</th></tr>";
            foreach($list as $key => $name){
                print "<tr><td>$key</td><td>$name</td>";
                print "</tr>";
            }
        ?>
    </body>
</html>