<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php

    $favicon = false;
    $faviconfile = "{$this->theme->path}/images/favicon.ico";
    $faviconurl = "{$this->theme->baseurl}/images/favicon.ico";
    if (file_exists($faviconfile)) $favicon = true;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->render_current_lang();?>">
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->render_title();?></title>
    <?php echo $this->render_css_files();?>
    <?php if (!empty($favicon)) : ?>
    <link rel="shortcut icon" href="<?php echo $faviconurl;?>">
    <?php endif; ?>
    <?php echo $this->render_view('elements/ga');?>
</head>
<body>
<?php
    $this->render_view('header');
    // Render content
    // if (!empty($this->render->_content)) $this->render_view($this->render->_content);
    $this->render_view('common');
    $this->render_view('footer');

    echo $this->render_js_files();
?>
</body>
</html>
