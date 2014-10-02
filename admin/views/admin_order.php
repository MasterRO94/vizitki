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
                    <?=$order['type']?>, <br/> <p class="order_info_img"><img src="<?=$order['image_face']?>" alt="<?=$order['type'].'-'.$order['id']?>"/></p>
                    <p><a href="javascript:void(0);" class="saveImage" data-name="<?php $name = uniqid(); echo $name;?>">Сохранить шаблон</a></p>
                    <div class="forCanvas"></div>
                </td>
                <td><?=$order['totalSum']?></td>
                <td><?=$order['count']?></td>
                <td><?=$order['totalSum']?> грн</td>
                <td>
                    <p><a href="<?=PATH.ADMIN?>edit-order/<?=$order['id']?>">Редактировать</a></p>
                    <p><a href="#">Удалить</a></p>
                </td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>
    </section>