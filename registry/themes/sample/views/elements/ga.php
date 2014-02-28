<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php if (!empty($this->theme->config->ga_id)) : ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '$this->theme->config->ga_id']);
    <?php if (!empty($this->theme->config->ga_domain)) : ?>
        _gaq.push(['_setDomainName', '<?php echo $this->theme->config->ga_domain; ?>']);
    <?php endif; ?>
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
<?php endif; ?>
