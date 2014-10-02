<?php defined('VIZITKI') or die('Access denied'); ?>

</head>

    <body>

    <?php
       include 'header.php';
    ?>

    <section id="orders">

        <table>
            <thead>
                <tr>
                    <th>№ Заказа</th>
                    <th>Заказчик</th>
                    <th>Сумма заказа</th>
                    <th>Дата заказа</th>
                    <th>Дата проведения</th>
                    <th>Статус</th>
                    <th>Операции</th>
                </tr>
            </thead>
            <tbody>
                <?php if($orders): ?>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><a href="#"><?= $users[$order['user_id']] ?></a></td>
                        <td><?= $order['totalSum'] ?> грн</td>
                        <td><?= $order['created_at'] ?></td>
                        <td><?= $order['updated_at'] ?></td>
                        <td><?=$order['status']?></td>
                        <td><p><a href="<?=PATH.ADMIN?>order/<?=$order['id']?>">Редактировать</a></p><p><a href="#">Удалить</a></p></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Заказов пока нет!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>



    </section>