<html>
<head>
    <title>Test</title>
    <?php wp_head(); ?>
</head>
<body>
    <div class="header">
        <div class="primary">
            <?php wp_nav_menu( array( 'theme_location' => 'primary')); ?>
        </div>
        <div class="secondary">
            <?php wp_nav_menu( array( 'theme_location' => 'secondary')); ?>
        </div>
    </div>