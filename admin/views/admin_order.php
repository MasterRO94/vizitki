<?php defined('VIZITKI') or die('Access denied'); ?>

    <script type="text/javascript" src="<?=PATH.ADMIN.VIEW?>js/html2canvas.js"></script>
    <script type="text/javascript" src="<?=PATH.ADMIN.VIEW?>js/canvas2image.js"></script>
    <script type="text/javascript" src="<?=PATH.ADMIN.VIEW?>js/canvas-toBlob.js"></script>
    <script type="text/javascript" src="<?=PATH.ADMIN.VIEW?>js/FileSaver.js"></script>

</head>

    <body>

    <?php
        include 'header.php';
    ?>
    <section id="order">
    <?php if($order): ?>
        <h2>Заказ №<?=$order['id']?></h2>
        <form action="" method="post">
    <?php if(!isset($_SESSION['admin']['error'])): ?>
        <h3>Данные о пользователе</h3>
        <table>
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Адрес</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $user['fio'] ?></td>
                <td><?= $user['phone'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['address'] ?></td>
            </tr>
            </tbody>
        </table>

        <h3>Данные о товаре</h3>
        <table>
            <thead>
            <tr>
                <th>Заказ</th>
                <th>Стоимость</th>
                <th>Количество</th>
                <th>К оплате</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="order_info">
                    <p class="general"><?=$order['type']?>, <?=($tiraj['count'] * $order['kolvo'])?> штук <?=($order['type_sides'] == 1 ? '(односторонние)' : '(двусторонние)')?> (<?=($tiraj['price'] * $order['kolvo'])?> грн)</p>
                    <p class="wishes"><strong>Пожелания:</strong>  <?=$order['wishes']?></p>

                    <?php if($paper): ?>
                    <p class="paper_type"><strong>Тип бумаги:</strong> <?=$paper['title']?> <?=($paper['price'] > 0) ? '(+'.$paper['price'] * $order['kolvo'].' грн)' : '' ?></p>
                    <?php $paper_check = true; endif; ?>

                    <?php if($extra): ?>
                        <p class="extra"><strong>Дополнительные услуги:</strong>

                        </p>
                    <?php $extra_check = true; endif; ?>

                    <p class="order_info_img"><img src="<?=$order['image_face']?>" alt="<?=$order['type'].'-'.$order['id']?>"/></p>
                    <p class="preview"><a href="javascript:void(0);" class="saveImage" data-name="<?php $name = uniqid(); echo $name;?>">Сохранить шаблон</a></p>
                    <div class="forCanvas"></div>
                </td>
                <td><?=$order['kolvo']?> * <?=$tiraj['price']?> <?php if($paper_check && $paper['price'] > 0) echo ' + '.$order['kolvo'].' * '.$paper['price'] ?>  <?php if($extra_check) echo ' + '.'' ?>  = <?=$order['totalSum']?></td>
                <td><?=$order['kolvo']. ' по '. $tiraj['count']?> = <?=($tiraj['count'] * $order['kolvo'])?> штук</td>
                <td><?=$order['totalSum']?> грн</td>
                <td>
<!--                    <p><a href="<?/*=PATH.ADMIN*/?>edit-order/<?/*=$order['id']*/?>">Редактировать</a></p>-->
                    <p><a href="#">Удалить</a></p>
                </td>
            </tr>
            </tbody>
        </table>
            <select name="order_status" id="order_satus">
                <option value="Новый" <?php if($order['status'] == 'Новый') echo 'selected' ?> >Новый</option>
                <option value="В работе" <?php if($order['status'] == 'В работе') echo 'selected' ?>>В работе</option>
                <option value="Проведенный" <?php if($order['status'] == 'Проведенный') echo 'selected' ?>>Проведенный</option>
            </select>
            <input type="hidden" name="order_id" value="<?=$order['id']?>"/>
            <input type="submit" name="edit_order" value="Сохранить"/>
            </form>
    <?php else: ?>
        <div class="error"><?=$_SESSION['admin']['error']?></div>
    <?php endif; ?>
    <?php endif; ?>
    </section>