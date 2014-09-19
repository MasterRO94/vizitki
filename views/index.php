<?php defined('VIZITKI') or die('Access denied'); ?>

<?php require_once 'blocks/head.php' ?>
        <meta name="description" content="Нужна визитка онлайн? У нас можно заказать, сделать (создать) креативные визитки и шаблоны онлайн недорого. Печать, изготовление, образцы визиток на любой вкус." />
        <meta name="keywords" content="Визитка, печать визиток, изготовление визиток, визитки шаблоны, креативные визитки, образцы визиток, сделать визитку, создать визитку, сделать визитку онлайн, заказать визитки, шаблон визитки" />
        <title><?= TITLE ?></title>

        <?php
            if($editor) require_once 'blocks/editorResources.php';
        ?>

    </head>

    <body>

        <div class="wrapper">

            <?php require_once 'blocks/header.php' ?>

            <section class="container">

                <?php include($view.'.php'); ?>

            </section>

            <?php require_once 'blocks/footer.php' ?>

        </div>

    </body>
</html>