<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<div id="footer" class="muted">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>&copy; 2013 ·
                    <a href="http://www.teachnova.com">TEACHNOVA</a>
            </div>
        </div>
    </div>
</div>
<div class="footer-separator"></div>
<div id="webmap"></div>
<div id="modalPrivacy" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="modalPrivacyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="modalPrivacyLabel"><?php echo $this->get_string('title_privacy_policy'); ?></h3>
            </div>
            <div class="modal-body">
                <?php $this->print_string('content_privacy_policy'); ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->print_string('btn_close'); ?></button>
            </div>
        </div>
    </div>
</div>
