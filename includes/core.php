<?php

    class BIECore extends BIETemplate
    {
        const SLUG = 'blogger-importer-extended';
        const NAME = 'Blogger Importer Extended';
        const ID = 'bie_id';

        private $client;
        private $bootstrap;

        public function __construct($bootstrap)
        {
            $this->client = new BIEClient();
            $this->bootstrap = $bootstrap;
        }

        static public function install()
        {
            if(!self::blog()) {
                add_option(self::ID, md5(uniqid(rand(), true)));
            }
        }

        public static function blog()
        {
            return get_option(self::ID);
        }

        public function load()
        {
            add_action('plugins_loaded', array($this, 'internationalize'));
            add_action('admin_init', array($this, 'register'));
            add_action('wp_ajax_bie_import', array($this, 'import'));
            add_action('wp_ajax_bie_status', array($this, 'status'));
            add_action('wp_ajax_bie_authors', array($this, 'authors'));
            add_action('wp_ajax_bie_unlock', array($this, 'unlock'));
            add_action('wp_ajax_bie_reset', array($this, 'reset'));

            add_filter('plugin_action_links_' . plugin_basename($this->bootstrap), array($this, 'links'));
        }

        public function internationalize()
        {
            load_plugin_textdomain(self::SLUG, false, basename(BIE_DIR) . '/languages');
        }

        public function register()
        {
            register_importer(self::SLUG, self::NAME, __('Import your Blogger blog to WordPress.', self::SLUG), array($this, 'run'));
        }

        public function links($links)
        {
            $links[] = '<a href="' . admin_url('admin.php?import=' . self::SLUG) . '">' . __('Start!', self::SLUG) . '</a>';
            
            return $links;
        }

        public function run()
        {
            if($this->writable()) {
                try {
                    if(!$this->client->ready()) {
                        throw new ClientInvalidSession();
                    }

                    $blogs = $this->client->call('blogs');
                    $statuses = $this->statuses($blogs);
                    $users = get_users(array(
                        'fields' => array('id', 'user_login'),
                    ));

                    $this->render('blogs', array(
                        'blogs' => $blogs,
                        'statuses' => $statuses,
                        'users' => $users,
                    ));
                } catch(ClientInvalidSession $_) {
                    $redirect = admin_url('admin.php?import=' . self::SLUG);

                    if($this->client->ready()) {
                        $response = $this->client->call('reset', array(
                            'redirect' => $redirect,
                        ));

                        if(property_exists($response, 'status') && $response->status == 'done') {
                            $this->client->reset();
                        }
                    }

                    $response = $this->client->call('init', array(
                        'redirect' => $redirect,
                    ));

                    $this->render('authorize', array(
                        'url' => $response->url,
                    ));
                }
            } else {
                $this->render('error');
            }
        }

        private function statuses($blogs)
        {
            $statuses = array();

            if(property_exists($blogs, 'items')) {
                foreach($blogs->items as $blog) {
                    $status = get_option(BIEImporter::STATUS_PREFIX . $blog->id);

                    if($status) {
                        $statuses[$blog->id] = $status;
                    }
                }
            }

            return $statuses;
        }

        private function writable()
        {
            $upload = wp_upload_dir();

            return empty($upload['error']);
        }

        public function import()
        {
            $defaults = array(
                'convert_formatting' => false,
                'preserve_slugs' => false,
            );

            $choices = array_key_exists('options', $_POST) ? $_POST['options'] : array();
            $options = array_merge($defaults, $choices);

            $importer = new BIEImporter($_POST['blog_id']);
            $status = $importer->import($options);

            die(json_encode($status));
        }

        public function status()
        {
            $importer = new BIEImporter($_POST['blog_id']);
            $status = $importer->status();

            die(json_encode($status));
        }

        public function authors()
        {
            global $wpdb;

            foreach($_POST['authors'] as $author) {
                if($author['wordpress_login']) {
                    $user_id = wp_insert_user(array(
                        'user_login' => $author['wordpress_login'],
                    ));
                } else {
                    $user_id = $author['wordpress_id'];
                }

                $user = get_user_by('id', $user_id);
                
                $wpdb->query($wpdb->prepare("
                       UPDATE `$wpdb->posts` `p`
                    LEFT JOIN `$wpdb->postmeta` `m`
                           ON `p`.`ID` = `m`.`post_id`
                          SET `p`.`post_author` = %d
                        WHERE `m`.`meta_key` = '" . BIEImporter::PREFIX . "author'
                          AND `m`.`meta_value` = %s", $user_id, $author['blogger_id']));

                $wpdb->query($wpdb->prepare("
                       UPDATE `$wpdb->comments` `c`
                    LEFT JOIN `$wpdb->commentmeta` `m`
                           ON `c`.`comment_ID` = `m`.`comment_id`
                          SET `c`.`user_id` = %d,
                              `c`.`comment_author` = %s
                        WHERE `m`.`meta_key` = '" . BIEImporter::PREFIX . "author'
                          AND `m`.`meta_value` = %s", $user_id, $user->data->display_name, $author['blogger_id']));
            }

            die();
        }

        public function unlock()
        {
            $importer = new BIEImporter($_POST['blog_id']);
            $importer->unlock();

            die();
        }

        public function reset()
        {
            $this->client->reset();

            die();
        }
    }

