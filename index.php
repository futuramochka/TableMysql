<!DOCTYPE html>
<html>
    <head>
        <title>
            Тестовое задание
        </title>
        <meta charset='utf-8'>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            require_once('config.php');
            $countLastPosts = 4;
            $countOffset = 0;
            //$connect->createTable();
        ?>
        <!--<form class="form">-->
        <div class="form">
            <select class="form__selectOptions" name="selectColumn">
                <option value="localname">Название</option>
                <option value="quantity">Количество</option>
                <option value="locallength">Расстояние</option>
            </select>
            <select class = "form__selectOperators" name="selectEqual">
                <option value="=">=</option>
                <option value="LIKE">*</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select>
            <input class="form__text" type="text" name="text" id="text-field">
            <button class="form__send" type="button">Найти</button>
        </div>
        <!--</form>-->
        <section class="table__wrap">
            <table class="table">
                <thead class="table__head">
                    <tr class="table__row">
                        <th class="table__column">ID</th>
                        <th class="table__column">Название</th>
                        <th class="table__column">Количество</th>
                        <th class="table__column">Расстояние</th>
                        <th class="table__column">Дата</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                <?php
                    $productsArray = $connect->getProducts($countLastPosts,$countOffset);
                    foreach($productsArray as $value){?>
                        <tr class="table__row"><?php
                        foreach($value as $key=>$val){?>
                            <td class="table__column"><?php echo $val ?></td><?php
                        }?>
                        </tr><?php
                    }
                ?>
                </tbody>
            </table>
        </section>
        <section class="table__pagination pagination"><?php
            $countProducts = $connect->getCountProducts();
            $countPage = $countProducts[0]['count(id)'] / $countLastPosts;?>
            <ul class="pagination__list"><?php
                for($i = 0; $i < $countPage; $i++ ){?>
                    <li class="pagination__item">
                        <a class="pagination__link"><?php echo $i+1; ?></a>
                    </li><?php
                }?>
            </ul>
        </section>
            <?php 
            $connect->CloseConnectDB();
            unset($connect);
        ?>
        <script src="script.js"></script>
    </body>
</html>
