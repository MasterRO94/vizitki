<div class="footerMenu">
    <ul>
        <?php foreach($footerMenu as $link): ?>
            <li><a href="<?=PATH.$link['url']?>" <?=$link['attr']?> ><?=htmlspecialchars($link['title'])?></a></li>
        <?php endforeach; ?>
    </ul>
</div>