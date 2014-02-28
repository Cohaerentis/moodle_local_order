<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');

    $price = local_order::_cost_show($this->config->order_cost, $this->config->order_currency);
?>
<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><a href="<?php echo $this->uri; ?>" class="home">
                    <?php $this->print_string('lbl_signup'); ?>:
                    <span class="title"><?php echo $this->config->title; ?></span></a></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if (!empty($this->config->banner_img)) : ?>
                <div class="banner">
                    <?php if (!empty($this->config->banner_url)) : ?>
                    <a href="<?php echo $this->config->banner_url;?>" title="<?php echo $this->config->banner_alt; ?>">
                    <?php endif; ?>
                        <img src="<?php echo $this->config->banner_img; ?>" alt="<?php echo $this->config->banner_alt; ?>">
                    <?php if (!empty($this->config->banner_url)) : ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="well">
                <?php if (!empty($this->render->_content)) $this->render_view($this->render->_content); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="page_description"><?php echo $this->config->description; ?></div>
                <div class="page_dates_price">
                    <h3><?php $this->print_string('lbl_dates_and_prices'); ?></h3>
                    <table class="table table-condensed">
                        <tr>
                            <td class="date_last_call_label"><?php $this->print_string('lbl_date_last_call'); ?></td>
                            <td class="data date_last_call_data"><?php echo userdate($this->config->date_last_call, '%d/%m/%Y', 99, false); ?></td>
                        </tr>
                        <tr>
                            <td class="date_start_label"><?php $this->print_string('lbl_date_start'); ?></td>
                            <td class="data date_start_data"><?php echo userdate($this->config->date_start, '%d/%m/%Y', 99, false); ?></td>
                        </tr>
                        <tr>
                            <td class="date_end_label"><?php $this->print_string('lbl_date_end'); ?></td>
                            <td class="data date_end_data"><?php echo userdate($this->config->date_end, '%d/%m/%Y', 99, false); ?></td>
                        </tr>
                        <tr>
                            <td class="time_label"><?php $this->print_string('lbl_time'); ?></td>
                            <td class="data time_data"><?php echo $this->config->time; ?></td>
                        </tr>
                        <tr>
                            <td class="price_label"><?php $this->print_string('lbl_price'); ?></td>
                            <td class="data price_data"><?php echo $price; ?></td>
                        </tr>
                    </table>
                </div>
                <div class = "page_more_info">
                    <h3><?php $this->print_string('lbl_more_info'); ?></h3>
                    <table class="table table-condensed effect4">
                        <?php if (!empty($this->config->call_url) || !empty($this->config->call_pdf)) : ?>
                        <tr>
                            <td class="call_label"><?php $this->print_string('lbl_call'); ?></td>
                            <td class="call_data">
                                <?php if (!empty($this->config->call_url)) : ?>
                                <a class="call_on_web" href="<?php echo $this->config->call_url; ?>">Ver en la web</a>
                                <?php endif; ?>
                                <?php if (!empty($this->config->call_pdf)) : ?>
                                <a class="call_download" href="<?php echo $this->config->call_pdf; ?>" target="_blank">
                                    <img src="<?php echo $this->theme->baseurl; ?>/images/pdf-icon.png" alt="" class="img16"/> Descargar en PDF
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="contact_label"><?php $this->print_string('lbl_contact'); ?></td>
                            <td class="contact_data"><a href="mailto:<?php echo $this->config->contact_email; ?>"><?php echo $this->config->contact_email; ?></a></td>
                        </tr>
                    </table>
                </div>
                <div class="page_footnotes">
                    <p><span class="label label-info"><?php $this->print_string('lbl_notes'); ?></span></p>
                    <ol class="muted">
                        <li><?php $this->print_string('lbl_note1', $this->config->contact_email); ?></li>
                        <li><?php $this->print_string('lbl_note2'); ?></li>
                        <li><?php $this->print_string('lbl_note3'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>