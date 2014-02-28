<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Abstract class representing registry page.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();    ///  It must be included after moodle config.php

require_once($CFG->dirroot . '/local/order/lib.php');

define('LOCAL_ORDER_RP_INTERNAL', 'LocalOrderRegistryPage');
define('LOCAL_ORDER_RP_DIRROOT',  LOCAL_ORDER_DIRROOT . '/' . LOCAL_ORDER_RP_BASE);
define('LOCAL_ORDER_RP_WWWROOT',  LOCAL_ORDER_WWWROOT . '/' . LOCAL_ORDER_RP_BASE);

define('LOCAL_ORDER_RP_DEFAULT_URL',            '');
define('LOCAL_ORDER_RP_DEFAULT_MAILDISPLAY',    2);
define('LOCAL_ORDER_RP_DEFAULT_TIMEZONE',       '99'); // 99 for server time, -5.0 for UTC-5
define('LOCAL_ORDER_RP_DEFAULT_TITLE',          'LandingPage Template - Teachnova');
define('LOCAL_ORDER_RP_DEFAULT_KEYWORDS',       'landing page, moodle, teachnova, template, pagina de aterrizaje, plantilla');
define('LOCAL_ORDER_RP_DEFAULT_AUTHOR',         'Teachnova');
define('LOCAL_ORDER_RP_DEFAULT_DESCRIPTION',    'This is a landing page template. Powered by Teachnova');

abstract class local_order_rp {
    const DB_TABLE                  = 'local_order_registry';

    const STATUS_DISABLED           = 0;
    const STATUS_ENABLED            = 1;

    /** @var strings Language strings */
    protected $strings = array();

    /** @var render Render configuration */
    protected $render = null;

    /** @var layout Layout : default, error, ... */
    protected $layout = 'default';

    /** @var uri Request URI */
    public $uri = '/';

    /** @var entry DB entry values */
    public $entry = null;

    /** @var config Decoded configuration, from $entry->metadata */
    public $config = null;

    /** @var theme Theme associated */
    public $theme = null;

    /** @var cohort Cohort associated */
    public $cohort = null;

    /**
     * Constructor
     *
     * @param string $entry DB entry for this page registry
     * @param string $config Configuration
     * @param string $theme Theme associated
     */
    function __construct($entry, $config, $theme, $cohort) {
        $this->entry  = $entry;
        $this->config = $config;
        $this->theme  = $theme;
        $this->cohort = $cohort;
        $this->render = new StdClass();
    }

    /**
     * Abstract function
     * EMAILS : Sending emails to user or admin
     *
     * @return bool True if ok, False if error
     */
    public function user_signup_confirm_send($user, $password = null) { return true; }
    public function user_signup_confirm_resend($user) { return true; }
    public function user_notify_signup_send($user) { return true; }
    public function user_rempasswd_send($user) { return true; }
    public function admin_notify_signup_send($user) {return true; }
    public function admin_notify_confirmed_send($user) {return true; }

    /**
     * Abstract function
     * LOG : User signup log
     *
     * @return void
     */
    public function log_signup($user) { return; }

    /**
     * Abstract function
     * MAILCHIMP : User data to mailchimp merge vars mapping
     *
     * @return array Merge vars with user data assigned
     */
    public function mailchimp_mapping($user) { return array(); }

    /**
     * Abstract functions
     * CONFIG : Get configuration values
     *
     * @return mixed
     */
    public function user_confirm_enabled()              { return false; }
    public function user_confirm_hide_pass()            { return true; }
    public function user_notify_signup_enabled()        { return false; }
    public function user_notify_pending_enabled()       { return false; }
    public function user_notify_validate_enabled()      { return false; }
    public function user_notify_cancel_enabled()        { return false; }
    public function admin_notify_signup_enabled()       { return false; }
    public function admin_notify_confirmed_enabled()    { return false; }
    public function admin_notify_pending_enabled()      { return false; }
    public function admin_notify_validate_enabled()     { return false; }
    public function admin_notify_cancel_enabled()       { return false; }
    public function signup_log_enabled()                { return false; }
    public function mailchimp_enabled()                 { return false; }
    public function mailchimp_apikey_get()              { return ''; }
    public function mailchimp_list_get()                { return ''; }
    public function order_currency_get()                { return ''; }
    public function order_cost_get()                    { return 0; }
    public function order_name_get()                    { return ''; }
    public function order_description_get()             { return ''; }
    public function order_prefix_get()                  { return ''; }

    /**
     * Process a request
     *
     * @param string $uri Request URI
     * @return void
     */
    public function request_process() {
        global $PAGE;

        $action_default = (!empty($this->defaults['action'])) ? $this->defaults['action'] : '';
        $action = optional_param('action', $action_default, PARAM_NOTAGS);

        $redirecturl = new moodle_url($this->uri);

        // Set context to page, mandatory in Moodle
        $PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));

        // Special check in order to not print moodle error when obsolete sesskey
        $this->confirm_sesskey();

        $action_method = "action_{$action}";

        if (!method_exists($this, $action_method)) {
            redirect($redirecturl, $this->get_string('error_unknown_action'));
        }

        // Call controller
        $this->$action_method();

        // Render selected layout
        if (!$this->render_layout($this->layout)) {
            redirect($redirecturl, get_string('error_layout_not_found', 'local_order'));
        }

    }

    /**
     * Return current language from theme available list
     *
     * @return $string Language ISO code
     */
    public function render_current_lang() {
        global $SESSION;

        $current = current_language();

        // Select language from available list
        if (is_array($this->theme->config->lang) &&
            !empty($this->theme->config->lang)) {
            if (!in_array($current, $this->theme->config->lang)) {
                // Current language is not available,
                // Force first in available list
                $SESSION->lang = $this->theme->config->lang[0];
                return $SESSION->lang;
            }

        } else if (is_string($this->theme->config->lang) &&
                   !empty($this->theme->config->lang)) {
            // Force theme language
            $SESSION->lang = $this->theme->config->lang;
            return $SESSION->lang;
        }

        // Language is available or no theme language defined
        return $current;
    }

    /**
     * HTML code to include CSS files from theme config
     *
     * @return $string HTML
     */
    public function render_css_files() {
        $css = '';
        $urls = array();
        $files = array();

        // Read external CSS first
        if (!empty($this->theme->config->css_external)) {
            if (is_array($this->theme->config->css_external)) {
                $urls = $this->theme->config->css_external;
            } else {
                $urls[] = $this->theme->config->css_external;
            }
        }

        // Read internal CSS after
        if (!empty($this->theme->config->css)) {
            if (is_array($this->theme->config->css)) {
                $files = $this->theme->config->css;
            } else {
                $files[] = $this->theme->config->css;
            }
        }

        if (!empty($urls)) {
            foreach ($urls as $url) {
               $css .= '<link rel="stylesheet" href="' . $url . '" />' . "\n";
            }
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                $path = "{$this->theme->path}/css/{$file}.css";
                $url  = "{$this->theme->baseurl}/css/{$file}.css";
                if (file_exists($path)) {
                    $css .= '<link rel="stylesheet" href="' . $url . '" />' . "\n";
                }
            }
        }

        return $css;
    }

    /**
     * HTML code to include JS files from theme config
     *
     * @return $string HTML
     */
    public function render_js_files() {
        $js = '';
        $urls = array();
        $files = array();

        // Read external JS first
        if (!empty($this->theme->config->js_external)) {
            if (is_array($this->theme->config->js_external)) {
                $urls = $this->theme->config->js_external;
            } else {
                $urls[] = $this->theme->config->js_external;
            }
        }

        // Read internal JS after
        if (!empty($this->theme->config->js)) {
            if (is_array($this->theme->config->js)) {
                $files = $this->theme->config->js;
            } else {
                $files[] = $this->theme->config->js;
            }
        }

        if (!empty($urls)) {
            foreach ($urls as $url) {
               $js .= '<script type="text/javascript" src="' . $url . '"></script>' . "\n";
            }
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                $path = "{$this->theme->path}/js/{$file}.js";
                $url  = "{$this->theme->baseurl}/js/{$file}.js";
                if (file_exists($path)) {
                    $js .= '<script type="text/javascript" src="' . $url . '"></script>' . "\n";
                }
            }
        }

        return $js;
    }

    /**
     * Return additional text for required fields
     *
     * @return string HTML
     */
    public function render_field_required($field, $text = '*') {
        $html = '';
        $configfield = "field_{$field}";

        $required = false;
        if      ($field == 'email')      $required = true;
        else if (in_array($field, $this->signup_fixed_fields)) $required = true;
        else if (!empty($this->theme->config->$configfield->required)) $required = true;

        if ($required) $html = "<sup>$text</sup>";
        return $html;
    }

    /**
     * Return if field is enabled
     *
     * @return bool True if field is enabled
     */
    public function render_field_enabled($field) {
        $enabled = false;
        $configfield = "field_{$field}";

        if      ($field == 'email')    $enabled = true;
        else if (in_array($field, $this->signup_fixed_fields)) $enabled = true;
        else if (!empty($this->theme->config->$configfield->enabled)) $enabled = true;

        return $enabled;
    }

    /**
     * Return page title from theme config
     *
     * @return string Page title
     */
    public function render_title() {
        $title = '';
        if (!empty($this->theme->config->title_prefix)) $title = $this->theme->config->title_prefix;
        if (!empty($this->render->_title)) {
            if (!empty($title)) $title .= ' - ';
            $title .= $this->render->_title;
        }
        return $title;
    }

    /**
     * HTML code from a view
     *
     * @return $string HTML
     */
    public function render_view($view, $extra = null) {
        if (!empty($view)) {
            $view_file = "{$this->theme->path}/views/{$view}.php";
            if (file_exists($view_file)) {
                $this->render->_extra = $extra;
                include($view_file);
            }
        }
    }

    /**
     * HTML code from a content view
     *
     * @return $string HTML
     */
    public function render_layout($layout = 'default', $return = false) {
        $buffer = false;
        ob_start();

        $layout_file = "{$this->theme->path}/layouts/{$layout}.php";
        if (file_exists($layout_file)) {
            include_once($layout_file);
            $buffer = ob_get_contents();
        }

        @ob_end_clean();
        if ($return) return $buffer;
        if ($buffer !== false) echo $buffer;
        return ($buffer !== false);
    }

    public function enable() {
        if ($this->entry->status != self::STATUS_ENABLED) {
            $this->entry->status = self::STATUS_ENABLED;
            $this->update();
        }
        return true;
    }

    public function disable() {
        if ($this->entry->status != self::STATUS_DISABLED) {
            $this->entry->status = self::STATUS_DISABLED;
            $this->update();
        }
        return true;
    }

    public function delete() {
        global $DB;

        if (!empty($this->entry->id)) {
            $DB->delete_records(self::DB_TABLE, array('id' => $this->entry->id));
            return true;
        }
        return false;
    }

    public function save() {
        global $DB;

        if (empty($this->entry->id)) {
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            $this->entry->id = $DB->insert_record(self::DB_TABLE, $this->entry, true);
            if (!empty($this->entry->id)) {
                return true;
            }
        } else {
            return $this->update();
        }
        return false;
    }

    public function update() {
        global $DB;

        if (!empty($this->entry->id)) {
            $this->entry->modifydate = time();
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            return $DB->update_record(self::DB_TABLE, $this->entry);
        } else {
            return $this->save();
        }
        return true;
    }

    public static function create($cohortid, $theme, $slug, $metadata) {
        if (empty($cohortid) || empty($theme) || empty($slug)) return false;

        // 1. Create registry page
        $entry              = new stdClass();
        $entry->cohortid    = $cohortid;
        $entry->theme       = $theme;
        $entry->slug        = $slug;
        $entry->metadata    = $metadata;
        $entry->status      = self::STATUS_DISABLED;

        // 2. Construct object (and check theme and cohortid)
        $rp = self::get_by_entry($entry);
        if (empty($rp)) return false;

        // 3. Save registry page in DB
        if (!$rp->save()) return false;

        return $rp;
    }

    private static function get_by_entry($entry) {
        // Use $CFG global variable in theme files
        // not only in this function
        // Notice that this function include theme lib file
        global $DB, $CFG;

        $config = null;
        $theme  = null;
        $cohort = null;
        if (!empty($entry)) {
            $cohort = $DB->get_record('cohort', array('id' => $entry->cohortid));
            if (empty($cohort)) return false;

            $themeconfig = local_order_rp::theme_config_load($entry->theme);
            if (empty($themeconfig)) return false;

            $theme = new stdClass();
            $theme->name = $entry->theme;
            $theme->config = $themeconfig;
            $theme->path = LOCAL_ORDER_RP_DIRROOT . "/themes/{$entry->theme}";
            $theme->baseurl = LOCAL_ORDER_RP_WWWROOT . "/themes/{$entry->theme}";

            $libfile = "{$theme->path}/lib.php";
            $classname = "local_order_rp_{$entry->theme}";
            if (file_exists($libfile)) {
                require_once($libfile);
                if (!empty($entry->metadata)) $config = json_decode($entry->metadata);
                return new $classname($entry, $config, $theme, $cohort);
            }
        }

        return false;
    }

    /**
     * Check if slug is already in use
     *
     * @param string $slug Registry page slug
     * @return bool
     */
    public static function slug_exists($slug) {
        global $DB;

        $entry = $DB->get_record(self::DB_TABLE, array('slug' => $slug));
        return (empty($entry)) ? false : true;
    }

    /**
     * Look for registry page by slug
     *
     * @param string $slug Registry page slug
     * @return object Registry page
     */
    public static function get_by_slug($slug) {
        global $DB;

        $entry = $DB->get_record(self::DB_TABLE, array('slug' => $slug, 'status' => 1));
        return self::get_by_entry($entry);
    }

    /**
     * Look for registry page by registryid
     *
     * @param string $registryid Registry page ID
     * @return object Registry page
     */
    public static function get_by_id($registryid) {
        global $DB;

        $entry = $DB->get_record(self::DB_TABLE, array('id' => $registryid));
        return self::get_by_entry($entry);
    }

    /**
     * Look for registry page by uri or full URL
     *
     * First part of path is considered base and the rest is slug
     * Example : http://www.example.org/registry/customer/my-sample-page
     *      base = registry
     *      slug = customer/my-sample-page
     *
     * @param string $uri URI or full URL
     * @return object Registry page
     */
    public static function get_by_uri($uri) {
        $rp = false;
        $slug = '';

        $parsed = parse_url($uri);
        if (!empty($parsed['path'])) {
            $path = preg_replace('#^/' . LOCAL_ORDER_RP_URIBASE . '#', '', $parsed['path']);
            $path = trim($path, '/');
            $parts = preg_split('#[/]+#', $path);
            $slug = implode('/', $parts);
        }

        if (!empty($slug)) {
            // Search for registry page by slug
            $rp = local_order_rp::get_by_slug($slug);
            if (!empty($rp)) {
                $rp->uri = '/' . LOCAL_ORDER_RP_URIBASE . '/' . $slug;
            } else {
                // wrlog("local_order_rp::get_by_uri : Registry page not found - '$uri'");
            }
        }

        return $rp;
    }

    /**
     * Search promotional by its code
     *
     * @return object
     */
    public function promotional_get_by_code($code) {
        $code = preg_replace('/[\-+=][0-9]+/i', '', trim($code));
        if (!empty($this->config->order_promotionals)) {
            foreach ($this->config->order_promotionals as $promotional) {
                if (!empty($promotional->code) && ($promotional->code == $code)) {
                    return $promotional;
                }
            }
        }
        return false;
    }

    /**
     * Search penalty by paymode
     *
     * @return object
     */
    public function penalty_get_by_paymode($paymode) {
        if (!empty($this->theme->config->paymode_penalties)) {
            foreach ($this->theme->config->paymode_penalties as $penalty) {
                if (!empty($penalty->paymode) && ($penalty->paymode == $paymode))
                    return $penalty;
            }
        }
        return false;
    }

    /**
     * Check sesskey is valid, only if present
     *
     * Redirect to Moodle root URL if not valid
     *
     * @return void
     */
    protected function confirm_sesskey() {
        $redirecturl = new moodle_url($this->uri);

        if (!empty($_POST['sesskey']) || !empty($_GET['sesskey'])) {
            if (!confirm_sesskey()) {
                redirect($redirecturl, $this->get_string('error_bad_sesskey'));
            }
        }
    }

    /**
     * Print a theme localized string
     *
     * @param string $identifier String identifier
     * @param mixed $a Dinamic string parameters (string, array or object)
     * @param string $lang Language ISO code
     * @return object Registry page
     */
    public function print_string($identifier, $a = NULL, $lang = false) {
        echo $this->get_string($identifier, $a, $lang);
    }

    /**
     * Get a theme localized string
     *
     * @param string $identifier String identifier
     * @param mixed $a Dinamic string parameters (string, array or object)
     * @param string $lang Language ISO code
     * @return object Registry page
     */
    public function get_string($identifier, $a = NULL, $lang = false) {

        $identifier = clean_param($identifier, PARAM_STRINGID);
        if (empty($identifier)) {
            throw new coding_exception('Invalid string identifier. The identifier cannot be empty. Please fix your get_string() call.');
        }

        // Get current language if not defined
        if (empty($lang)) $lang = current_language();

        // Check if we have already load this language in static cache
        if (empty($this->strings[$lang])) {
            // Load strings for this language
            $this->strings[$lang] = $this->get_strings($lang);
        }

        $string = null;

        // Look for this identifier in static cache
        if (!empty($this->strings[$lang]) && array_key_exists($identifier, $this->strings[$lang])) {
            // Found in selected language
            $string = $this->strings[$lang][$identifier];
        } else {
            if (empty($this->strings['en'])) {
                // Load strings for this language
                $this->strings['en'] = $this->get_strings('en');
            }
            if (!empty($this->strings['en']) && array_key_exists($identifier, $this->strings['en'])) {
                // Found in default language
                $string = $this->strings['en'][$identifier];
            }
        }

        if ($string === null) {
            // Identifier not found
            return "[[ $identifier ]]";
        }

        // Identifier found, now parse {$a} parameter
        if ($a !== null) {
            // Process array's and objects (except lang_strings)
            if (is_array($a) or (is_object($a) && !($a instanceof lang_string))) {
                $a = (array)$a;
                $search = array();
                $replace = array();
                foreach ($a as $key => $value) {
                    if (is_int($key)) {
                        // we do not support numeric keys - sorry!
                        continue;
                    }
                    if (is_array($value) or (is_object($value) && !($value instanceof lang_string))) {
                        // we support just string or lang_string as value
                        continue;
                    }
                    $search[]  = '{$a->' . $key . '}';
                    $replace[] = (string) $value;
                }
                if ($search) {
                    $string = str_replace($search, $replace, $string);
                }
            } else {
                $string = str_replace('{$a}', (string) $a, $string);
            }
        }

        // Identifier found and {$a} parsed
        return $string;
    }

    /**
     * Get theme all localized strings for one language
     *
     * @param string $lang Language ISO code
     * @return object Registry page
     */
    private function get_strings($lang) {
        $rp_string = false;

        $lang_file = LOCAL_ORDER_RP_DIRROOT . "/themes/{$this->theme->name}/lang/{$lang}/local_order_{$this->theme->name}.php";
        if (file_exists($lang_file)) {
            $rp_string = array();
            $rp_string['__loaded'] = '';
            include($lang_file);
        }

        return $rp_string;
    }

    /**
     * Decode theme JSON config string
     *
     * Theme JSON config file allows comments (PHP style),
     * so this function erases commments before parse JSON
     * with PHP json_decode() native function
     *
     * @param string $config_json Theme JSON string
     * @return object Theme configuration
     */
    private static function theme_config_decode($config_json) {
        // Erase comments
        $json = $config_json;
        // $json = preg_replace('%(?<!")#.*(?<!",)$%m', '', $json);
        $json = preg_replace('%^[ ]*#.*$%m', '', $json);
        $json = preg_replace('%(,|"|\{|\[)[ ]*#.*$%m', '$1', $json);
        // $json = preg_replace('%(?<![":])//.*(?<!",)$%m', '', $json);
        $json = preg_replace('%^[ ]*//.*$%m', '', $json);
        $json = preg_replace('%(,|"|\{|\[)[ ]*//.*$%m', '$1', $json);
        $json = preg_replace('%/\*.*\*/%m', '', $json);

        // Decode JSON
        $config = json_decode($json);
        return $config;
    }

    /**
     * Look for theme by folder name
     *
     * Read theme configuration from themes folders 'local/order/themes'
     *
     * @param string $theme Theme folder name
     * @return object Theme configuration
     */
    private static function theme_config_load($theme) {
        $config = false;

        $cfgfile = LOCAL_ORDER_RP_DIRROOT . "/themes/{$theme}/config.json";
        if (file_exists($cfgfile)) {
            $json = file_get_contents($cfgfile);
            $config = local_order_rp::theme_config_decode($json);
        }

        return $config;
    }

    private static function theme_name_is_valid($name) {
        return (bool) preg_match('/^[a-z](?:[a-z0-9_](?!__))*[a-z0-9]$/', $name);
    }

    public static function theme_list() {
        $themes = array();
        $basedir = LOCAL_ORDER_RP_DIRROOT . '/themes';

        if (is_dir($basedir)) {
            $items = new DirectoryIterator($basedir);
            foreach ($items as $item) {
                if ($item->isDot() or !$item->isDir()) {
                    continue;
                }
                $name = $item->getFilename();

                if (!self::theme_name_is_valid($name)) {
                    // Better ignore theme with problematic names here.
                    continue;
                }
                $themes[$name] = $name;
                unset($item);
            }
            unset($items);
        }

        return $themes;
    }

}








