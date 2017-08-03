=== Auto Load Page Template ===
Contributors: kanakogi
Donate link: http://www.amazon.co.jp/registry/wishlist/2TUGZOYJW8T4T/?_encoding=UTF8&camp=247&creative=7399&linkCode=ur2&tag=wpccc-22
Tags: : page, pages,theme, themes
Requires at least: 3.0 or higher
Tested up to: 4.4.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
If this plug-in is enabled, and there is a file on the same theme level as the static page URL level, then that theme file will automatically be loaded as the template file.

Example
For the static page URL: "http://example.com/foo/bar/"
Theme directory: "/wp-content/themes/mytheme/foo/bar/index.php"
will be loaded as the template file if it exists.

*If enabled themes have a parent-child relationship, then the file for the child theme will be loaded with precedence.


== Installation ==
1. Upload the entire `auto-load-page-template` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.


== Changelog ==
**1.1.0 - 6 Feb 2016**  
New Feature. Can save a target html to content.
ex) $auto_load_page_template->push_post('.content');

**1.0.0 - 3 October 2015**  
Initial release.