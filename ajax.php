<?php
    require_once("config.php");
    header("Content-Type: application/json; charset=UTF-8");
    if(isset($_POST["x"])){
        $objAnswer = json_decode($_POST["x"], false);
        foreach($objAnswer as $index=>$item){
            switch($index){
                case "valueName" : $name = $item;
                case "valueOperator" : $equal = $item;
                case "valueText" : $text = $item;
            }
        }
        $resultQuery = $connect->getFilterProducts($name,$equal,$text);
        if($resultQuery){
            foreach($resultQuery as $val){?>
                <tr class="table__row"><?php
                foreach($val as $key=>$value){?>
                    <td class="table__column"><?php echo $value ?></td><?php
                }?>
                </tr><?php
            }
        }else{
            echo "<h2>Результат не найден, попробуйте ещё раз...</h2>";
        }
    }
    if(isset($_POST["p"])){
        $objAnswerPagin = json_decode($_POST["p"], false);
        foreach($objAnswerPagin as $index=>$item){
            switch($index){
                case "Limit" : $limit = $item;
                case "Offset" : $offset = $item;
            }
        }
        $resultQueryPagination = $connect->getProducts($limit,$offset);
        if($resultQueryPagination){
            foreach($resultQueryPagination as $val){?>
                <tr class="table__row"><?php
                foreach($val as $key=>$value){?>
                    <td class="table__column"><?php echo $value ?></td><?php
                }?>
                </tr><?php
            }
        }else{
            echo "<h2>Результат не найден, попробуйте ещё раз...</h2>";
        }
    }

    $connect->CloseConnectDB();
    unset($connect);
?>