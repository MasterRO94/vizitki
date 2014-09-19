<section class="mainMenu">
    <nav class="navigation">
        <ul>
        <?php foreach($mainMenu as $link): ?>
            <li><a href="<?=PATH.$link['url']?>" <?=$link['attr']?> ><?=htmlspecialchars($link['title'])?></a></li>
        <?php endforeach; ?>
        </ul>
    </nav>
</section><!-- .main_menu -->