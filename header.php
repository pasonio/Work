<html>
<head>
    <title>Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="header">
    <div class="primary">
        <?php wp_nav_menu( array( 'theme_location' => 'primary')); ?>
    </div>
    <div class="secondary">
        <?php wp_nav_menu( array( 'theme_location' => 'secondary')); ?>
    </div>
</div>
