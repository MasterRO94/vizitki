<?php defined('VIZITKI') or die('Access denied'); ?>

</head>

<body>

<?php
    include 'header.php';
?>

<section id="orders"  class="list">

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
                <tr id="order-<?=$order['id']?>">
                    <td><?= $order['id'] ?></td>
                    <td><a href="#"><?= $users[$order['user_id']] ?></a></td>
                    <td><?= $order['totalSum'] ?> грн</td>
                    <td><?= $order['created_at'] ?></td>
                    <td><?= $order['updated_at'] ?></td>
                    <td><?=$order['status']?></td>
                    <td><p><a href="<?=PATH.ADMIN?>order/<?=$order['id']?>">Просмотр/Редактировать</a></p><p><a class="delete_order" data-order="<?=$order['id']?>" href="#">Удалить</a></p></td>
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

<section id="delete_order_window">
    <div class="w_header">
        <h3>Удаление заказа</h3>
        <p id="close">X</p>
    </div>
    <div class="w_body">
        <p>Вы уверены, что хотите удалить заказ <strong></strong>?</p>
        <button id="yes">Да, удалить</button>
        <button id="no">Отмена</button>
    </div>
</section>