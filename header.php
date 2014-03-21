<!DOCTYPE html>
<html>
<head>
  <title><?php echo is_community() ? 'Daxko Community' : wp_title('|', true, 'right'); ?></title>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
  <?php if (!is_community()): ?>
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
  <?php endif; ?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/daxko.css"/>
</head>
<body <?php if(!is_community()) { echo body_class(); } ?>>
<div class="navbar navbar-fixed-top">
  <div class="container">
    <a target="_parent" class="logo" href="http://daxko.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/css/daxkologo.png" alt="daxko - all together, better"/></a>
    <?php build_menu() ?>
  </div>
</div>
<?php if (!is_community()): ?>
<div id="page" class="hfeed site">
  <div id="main" class="site-main">
<?php endif; ?>