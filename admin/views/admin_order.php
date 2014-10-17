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
                    <p class="wishes"><strong>Пожелания:</strong> <?=$order['wishes']?></p>

                    <?php if($paper): ?>
                        <p class="paper_type"><strong>Тип бумаги:</strong> <?=$paper['title']?> <?=($paper['price'] > 0) ? '(+'.$paper['price'] * $order['kolvo'].' грн)' : '' ?></p>
                        <?php $paper_check = true; endif; ?>

                    <?php if($extra): ?>
                        <p class="extra"><strong>Дополнительные услуги:</strong>

                        </p>
                        <?php $extra_check = true; endif; ?>

                    <?php if($order['layout']): ?>

                        <?php $j=1; foreach($layouts as $layout): ?>
                            <div class="layout">
                                <?php if($layout['type'] == 'psd'): ?>
                                    <figure>
                                        <img src="<?=ASSET?>/images/psd.png" alt="layout-<?=$j?>"/>
                                    </figure>
                                    <a href="<?=PATH.'/'.$layout['src']?>" class="saveLayout">Сохраниить шаблон</a>
                                <?php elseif($layout['type'] == 'tiff' || $layout['type'] == 'tif'): ?>
                                    <figure>
                                        <img src="<?=ASSET?>/images/tiff.png" alt="layout-<?=$j?>"/>
                                    </figure>
                                    <a href="<?=PATH.'/'.$layout['src']?>" class="saveLayout">Сохраниить шаблон</a>
                                <?php else: ?>
                                    <figure>
                                        <img src="<?=PATH.'/'.$layout['src']?>" alt="layout-<?=$j?>"/>
                                    </figure>
                                    <a href="#" data-name="<?=uniqid()?>" class="saveLayout">Сохраниить шаблон</a>
                                <?php endif; ?>
                                <p><strong>Тип:</strong> <?=$layout['type']?></p>
                                <p><strong>Размер:</strong> <?=$layout['size']?></p>
                            </div>
                        <?php $j++; endforeach; ?>
                    <?php else: ?>
                        <p class="order_info_img">
                            <img src="<?=$order['image_face']?>" alt="<?=$order['type'].'-'.$order['id']?>"/>
                        </p>
                        <p class="preview"><a href="javascript:void(0);" class="saveImage" data-name="<?php $name = uniqid(); echo $name;?>">Сохранить шаблон</a></p>
                        <?php if($order['image_back'] != NULL): ?>
                            <p class="order_info_img">
                                <img src="<?=$order['image_back']?>" alt="<?=$order['type'].'-'.$order['id']?>"/>
                            </p>
                            <p class="preview"><a href="javascript:void(0);" class="saveImage" data-name="<?php $name = uniqid(); echo $name;?>">Сохранить шаблон</a></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="forCanvas"></div>
                </td>
                <td><?=$order['kolvo']?> * <?=$tiraj['price']?> <?php if($paper_check && $paper['price'] > 0) echo ' + '.$order['kolvo'].' * '.$paper['price'] ?> <?php if($extra_check) echo ' + '.'' ?> = <?=$order['totalSum']?></td>
                <td><?=$order['kolvo']. ' по '. $tiraj['count']?> = <?=($tiraj['count'] * $order['kolvo'])?> штук</td>
                <td><?=$order['totalSum']?> грн</td>
                <td>
                    <p><a id="delete_order" data-order="<?=$order['id']?>" href="#">Удалить</a></p>
                </td>
            </tr>
            </tbody>
        </table>
        <select name="order_status" id="order_satus">
            <option value="Новый" <?php if($order['status'] == 'Новый') echo 'selected'; ?> >Новый</option>
            <option value="В работе" <?php if($order['status'] == 'В работе') echo 'selected'; ?>>В работе</option>
            <option value="Проведенный" <?php if($order['status'] == 'Проведенный') echo 'selected'; ?>>Проведенный</option>
        </select>
        <input type="hidden" name="order_id" value="<?=$order['id']?>"/>
        <input type="submit" name="edit_order" value="Сохранить"/>
        </form>
        <?php else: ?>
            <div class="error"><?=$_SESSION['admin']['error']?></div>
        <?php endif; ?>
    <?php else: ?>
        <h4>Такого товара не существует!</h4>
    <?php endif; ?>
</section>

<section id="delete_order_window">
    <div class="w_header">
        <h3>Удаление заказа</h3>
        <p id="close">X</p>
    </div>
    <div class="w_body">
        <p>Вы уверены, что хотите удалить заказ <span></span>?</p>
        <form action="<?=PATH.ADMIN?>delete-order" method="post">
            <input type="hidden" name="id" value="<?=$order['id']?>"/>
            <input type="submit" name="del_order" class="yes" value="Да, удалить">
            <button id="no">Отмена</button>
        </form>
    </div>
</section>