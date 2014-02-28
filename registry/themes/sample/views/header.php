<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    global $USER;

    if (isloggedin()) {
        $profileurl = new moodle_url('/user/view.php', array('id' => $USER->id) );
        $profileimg = new moodle_url('/user/pix.php', array('file' => "/{$USER->id}/f1.jpg") );
        $fullname = fullname($USER);
        $logouturl = new moodle_url($this->uri, array('action' => $this::ACTION_LOGOUT) );
    }

    $logo = false;
    $logo_file = "{$this->theme->path}/images/{$this->theme->config->logo}";
    if (file_exists($logo_file)) {
        $logo = "{$this->theme->baseurl}/images/{$this->theme->config->logo}";
    }

    $logo_teachnova = false;
    $logo_teachnova_file = "{$this->theme->path}/images/{$this->theme->config->logo_teachnova}";
    if (file_exists($logo_teachnova_file)) {
        $logo_teachnova = "{$this->theme->baseurl}/images/{$this->theme->config->logo_teachnova}";
    }

    $siteurl = new moodle_url('/');

?>
<div class="navbar navbar-sample" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    <?php if (!empty($logo)) : ?>
        <a class="logo logo navbar-brand" href="<?php echo $this->theme->config->url; ?>" target="_blank">
            <img src="<?php echo $logo; ?>" alt="" />
        </a>
    <?php endif; ?>
    <?php if (!empty($logo_teachnova)) : ?>
        <a class="logo logo-teachnova navbar-brand" href="<?php echo $this->theme->config->url_teachnova; ?>" target="_blank">
            <img src="<?php echo $logo_teachnova; ?>" alt="TEACHNOVA" />
        </a>
    <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php if (!empty($this->render->showlogin)) : ?>
            <?php if (isloggedin()) : ?>
                <div class="login_info">
                    <a href="<?php echo $profileurl; ?>">
                        <img class="avatar" src="<?php echo $profileimg; ?>"
                             title="<?php echo $fullname; ?>"
                             alt="<?php echo $fullname; ?>" />
                        <?php echo $fullname; ?>
                    </a>
                    (<a href="<?php echo $logouturl; ?>"><?php $this->print_string('btn_logout'); ?></a>)
                </div>
            <?php else : ?>
                <form class="navbar-form navbar-right" method="post" action="<?php echo $this->uri; ?>">
                    <fieldset>
                        <p class="navbar-text"><?php $this->print_string('if_you_are_already_student'); ?></p>
                        <div class="form-group">
                            <input type="text" class="input-sm form-control" name="username" maxlength="<?php echo $this->maxlength['username']; ?>" placeholder="<?php $this->print_string('placeholder_username'); ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="input-sm form-control" name="password" maxlength="<?php echo $this->maxlength['password']; ?>" placeholder="<?php $this->print_string('placeholder_password'); ?>">
                        </div>
                        <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
                        <input type="hidden" value="<?php echo $this::ACTION_LOGIN; ?>" name="action">
                        <input type="hidden" value="1" name="_qf__local_order_rp_login_form">
                        <button type="submit" class="btn btn-sm navbar-btn"><?php $this->print_string('btn_login'); ?></button>
                    </fieldset>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>
