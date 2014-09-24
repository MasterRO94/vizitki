<?php defined('VIZITKI') or die('Access denied'); ?>

<section class="homepage">
    <?php require_once 'blocks/bigButtonsMenu.php' ?>

    <div class="slider">
        SLIDER
    </div>

    <section class="services">
        <h3>Услуги</h3>
        <?php foreach($services as $service): ?>
            <div class="service_block inlineBlock">
                <img src="<?=VIZITKAIMG?><?=($service['image'] ? 'services/'.$service['image'] : 'no_image.jpg')?>" alt="<?=$service['title']?>"/>
                <div class="service_info">
                    <a href="<?=PATH?>/catalog/<?=$service['alias']?>" class="service_info_top">
                        <h5><?=$service['title']."\n"?><?=$service['size']?></h5>
                        <?php if($service['price1']): ?>
                            <div class="service_price">
                                <div>
                                    <p><?=$service['count1']?></p>
                                    <p><?=$service['price1']?></p>
                                </div>
                                <?php if($service['price1']): ?>
                                    <div>
                                        <p><?=$service['count2']?></p>
                                        <p><?=$service['price2']?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="service_info_bot">
                        <a rel="nofollow" href="<?=PATH?>/catalog/upload_layout/<?=$service['alias']?>">Загрузите свой макет</a>
                        <a rel="nofollow" href="<?=PATH?>/catalog/order_design/<?=$service['alias']?>">Закажите дизайн</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="page_text">
        <?=$page['text']?>
    </section>

</section>