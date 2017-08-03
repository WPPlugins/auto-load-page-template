<?php
/*
Plugin Name: Auto Load Page Template
Plugin URI: http://www.kigurumi.asia
Description: If this plug-in is enabled, and there is a file on the same theme level as the static page URL level, then that theme file will automatically be loaded as the template file.
Author: Nakashima Masahiro
Version: 1.1.0
Author URI: http://www.kigurumi.asia
License: GPLv2 or later
Text Domain: alt
Domain Path: /languages/
 */
define('ALPT_VERSION', '1.1.0');
define('ALPT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ALPT_PLUGIN_NAME', trim(dirname(ALPT_PLUGIN_BASENAME), '/'));
define('ALPT_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));
define('ALPT_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

class Auto_Load_Page_Template
{
    protected $textdomain = 'ALPT';

    public function __construct()
    {
        //固定ページの読み込むテンプレートを変更
        add_filter('page_template', array($this, 'get_page_template'));
    }

    /**
     * 固定ページテンプレートをロードする
     */
    public function get_page_template($template)
    {
        global $wp_query;
        global $post;

        if ($wp_query->is_page == 1) {
            //パスを作成
            $home_url      = get_home_url();
            $permalink     = get_permalink($post->ID);
            $template_path = str_replace($home_url, "", $permalink);

            //子テーマ
            $child_template_path = get_stylesheet_directory() . $template_path . 'index.php';
            //親テーマ
            $parent_template_path = get_template_directory() . $template_path . 'index.php';

            //テンプレートファイルがあるかどうかを子テーマを優先して調べる
            if (file_exists($child_template_path)) {
                $template = $child_template_path;
            } elseif (file_exists($parent_template_path)) {
                $template = $parent_template_path;
            }
        }
        return $template;
    }

    /**
     * 指定したhtmlを本文に保存する
     */
    public function push_post($attr)
    {
        include_once ALPT_PLUGIN_DIR . '/libs/simple_html_dom.php';

        // 固定ページのHTMLを取得
        $template = $this->get_page_template(false);
        if ($template) {
            $html = file_get_html($template);
            // 属性のテキストを取得
            $result = '';
            foreach ($html->find($attr) as $data) {
                $result .= $data;
            }

            //データを本文に保存する
            global $post;
            $post = array(
                'ID'           => $post->ID,
                'post_content' => $result,
            );
            wp_update_post($post);

            return $result;
        }

        return false;
    }

}
global $auto_load_page_template;
$auto_load_page_template = new Auto_Load_Page_Template();
