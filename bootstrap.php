<?php

    /*
        Plugin Name: Blogger Importer Extended
        Plugin URI: http://wordpress.org/plugins/blogger-importer-extended/
        Description: Migrates your Blogger blog to WordPress.
        Author: Yuri Farina
        Version: 1.3
        Author URI: http://www.yurifarina.com/
        Text Domain: blogger-importer-extended
    */

    define('BIE_DIR', dirname(__FILE__));

    require(BIE_DIR . '/includes/template.php');
    require(BIE_DIR . '/includes/importer.php');
    require(BIE_DIR . '/includes/client.php');
    require(BIE_DIR . '/includes/core.php');

    register_activation_hook(__FILE__, array('BIECore', 'install'));

    $bie_core = new BIECore(__FILE__);
    $bie_core->load();

