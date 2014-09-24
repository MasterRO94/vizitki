<?php defined('VIZITKI') or die('Access denied'); ?>

<section class="templates">
    <?php require_once 'blocks/bigButtonsMenu.php' ?>

    <section class="services">
        <h1>Редактируйте шаблон Визитки</h1>

        <div class="templates">
            <?php foreach($templates as $tpl): ?>
                <div class="servicesBlock_group">
                    <a class="servicesInfoTop_group" href="<?=PATH?>/catalog/edit-template-vizitki/<?=$alias?>/<?=$tpl['id']?>">
                        <img alt="<?=$tpl['name']?>" src="
                            <?=($tpl['preview'] ? PATH.'/uploads/templates/'.$tpl['preview'] : PATH.'/uploads/no_image.jpg')?>
                        "/>
                        <div class="servicesInfo_group">
                            <div class="like-h5"><?=$tpl['name']?></div>
                        </div><!-- .servicesInfo -->
                    </a><!-- .servicesInfoTop -->
                </div>
            <?php endforeach; ?>
        </div>

    </section>
    <section class="page_text">
        <?=$page['text']?>
    </section>

</section>