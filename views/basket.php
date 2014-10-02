<div id="basket" class="basket_wrapper">
    <h1 class="title">Оформление заказа</h1>
    <div class="breadcrumbs">
        <span><a href="/">Главная</a></span> <span> <span>Оформление заказа</span>
    </div>
    <?php if($msg = getSession('success')): ?>
        <div class="success"><?=$msg?></div>
        <?php unset($_SESSION['success']); ?>
    <?php else: ?>
        <?php if($basket = getSession('basket')): ?>
            <table id="basket_goods">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Заказ</th>
                        <th>&nbsp;</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                <?php //print_arr($basket); ?>
                    <?php $i=1; $totalSum=0; foreach($basket as $item): ?>
                        <tr>
                            <td><a href="<?=PATH.'/basket/delete/'.($i-1)?>">del</a></td>
                            <td><img style="max-width: 100px; max-height: 60px" src="<?=$item['image_face']?>" alt="<?=$item['type']?>"/></td>
                            <td>
                                <?=$item['type']?>,
                                количество <?=$item['count']?> штук
                                <?php if($item['type_sides']==1) echo '(односторонние)'; else if($item['type_sides']==2) echo '(двусторонние)'; ?>
                                <p><strong>Дополнительно:</strong></p>
                                <?php if($item['dop_uslugi'] != null): ?>
                                    <ul>
                                        <?php
                                            $extras = explode(',',$item['dop_uslugi']);
                                            foreach($extras as $extra): ?>
                                                <li><?=$extra?></li>
                                        <?php endforeach; ?>
                                    </ul>

                                <?php endif; ?>
                                <?php if(isset($item['paper_type'])): ?>
                                    <p><strong>Бумага:</strong></p>
                                    <p class="paper_type"><?=$item['paper_type']['title']?> (+<?=$item['paper_type']['price']?>грн)</p>
                                <?php endif; ?>
                            </td>
                            <td><input type="text" id="kolvo-<?=$i?>" value="<?=$item['kolvo']?>" /></td>
                            <td><?=$item['totalSum']?></td>
                        </tr>
                    <?php $i++; $totalSum += $item['totalSum']; endforeach; ?>
                </tbody>
            </table>
            <p class="totalSum">
                <strong>ИТОГО: <?=$totalSum?></strong>
            </p>


            <section class="saveOrder">
                <form action="<?=PATH?>/save/order" method="post" name="saveOrder">
                    <?php if(!getSession('USER')): ?>
                    <div class="links">
                        <ul id="tabs">
                            <li><a href="#">Новый покупатель</a></li>
                            <li><a href="#">Я уже зарегестрированн</a></li>
                        </ul>
                    </div>

                    <div class="row">
                        <label class="label">ФИО</label>
                        <div class="controls">
                            <input data-error="" type="text" name="USER[name]" value="" />
                            <div class="help">Введите ваше имя, фамилию и отчество</div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="label">Телефон</label>
                        <div class="controls">
                            <input data-error="" type="text" name="USER[phone]" value=""  />
                            <div class="help">Введите ваше телефон</div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="label">E-Mail</label>
                        <div class="controls">
                            <input data-error="" name="USER[email]" type="email" value="" class="valid email" />
                            <div class="help">Введите ваш email</div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="label">Адрес доставки</label>
                        <div class="controls">
                            <input data-error="" name="USER[address]" type="text" value="" class="valid" />
                            <div class="help">Введите ваш адрес доставки</div>
                        </div>
                    </div>

                    <input type="text" name="make_order" style="display: none;" />

                    <div class="row" style="display: none;">
                        <label class="label">С шаблоном визитки согласен</label>
                        <div class="controls">
                            <input data-error="" type="text" value="1" id="agree" class="valid digits"/>
                            <div class="help">Введите ваше телефон</div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                            <input type="submit" class="submit" value="Оформить заказ" />
                    </div>
                </form>
            </section>

        <?php else: ?>
            <p class="empty_basket">
                Корзина пуста!
            </p>
        <?php endif; ?>
    <?php endif; ?>
</div>