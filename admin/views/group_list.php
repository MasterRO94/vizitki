<?php defined('VIZITKI') or die('Access denied'); ?>

</head>

<body>

<?php
    include 'header.php';
?>

<section id="groups" class="list">
    <h2>Группы товаров</h2>
    <table>
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Опубликован</th>
            <th>Обложка</th>
            <th>Операции</th>
        </tr>
        </thead>
        <tbody>
        <?php if($groups): ?>
            <?php foreach($groups as $group): ?>
                <tr id="order-<?=$group['id']?>">
                    <td><?= $group['title'] ?></td>
                    <td><?=($group['is_active'] == 1)? '<span class="yes">Да</span>' : '<span class="yes">Да</span>'?></td>
                    <td class="preview"><img src="<?=($group['image'] != null ? PATH.'/uploads/services/'.$group['image'] : PATH.'/uploads/no_image.jpg') ?>" alt="<?= $group['alias'] ?>"/></td>
                    <td><p><a href="<?=PATH.ADMIN?>catalog/group/<?=$group['id']?>">Просмотр/Редактировать</a></p><p><a class="delete_order" data-order="<?=$group['id']?>" href="#">Удалить</a></p></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Групп товаров пока нет!</td>
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