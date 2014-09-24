<?php defined('VIZITKI') or die('Access denied'); ?>

<section class="templates_group">
    <?php require_once 'blocks/bigButtonsMenu.php' ?>

    <section class="services">
        <h1>Редактируйте шаблон Визитки</h1>

            <div class="templates">
                <?php foreach($group_templates as $tpl): ?>
                <div class="servicesBlock_group">
                    <a class="servicesInfoTop_group" href="<?=PATH?>/catalog/edit-template-vizitki/<?=$tpl['alias']?>">
                        <img alt="<?=$tpl['name']?>" src="
                            <?=($tpl['image'] ? PATH.'/uploads/group_templates/'.$tpl['image'] : PATH.'/uploads/no_image.jpg')?>
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