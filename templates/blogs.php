<style>
    #blogs .blog { cursor: pointer; }
    #blogs .blog .settings { display: none; background: #fff; border-radius: 5px; border-radius: 5px; }
    #blogs .blog .settings button { float: right; }
    #blogs .media-item .original { padding-left: 5px; }
    #blogs .media-item:first-child { background: none; color: #666; }
    #blogs .blog .original img { height: 16px; margin: -3px 10px 0 0; vertical-align: middle; }
    #blogs .blog .original span { padding-left: 15px; color: #999; }
    #blogs .blog .progress { background: #bbb; box-shadow: inset 0 1px 2px rgba(0,0,0,.2); -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.2); }
    #blogs .blog .wp-filter { margin-top: 2px; margin-bottom: 2px; padding-top: 12px; padding-bottom: 12px; border-radius: 5px; border-radius: 5px; }
    #blogs .blog .details { display: none; }
    #blogs .blog .details .media-item:last-child { box-shadow: none; -webkit-box-shadow: none; }
    #blogs .blog .details .dashicons-editor-help { position: absolute; margin: 1px 0 0 1px; color: #fff; }
    #blogs .blog .authors { display: none; }
    #blogs .blog .authors .loader { display: none; vertical-align: middle; margin: -4px 0 0 8px; }
    #blogs .blog .authors .skip { margin: 4px 0 0 10px; position: absolute; }
    #blogs .blog .done { display: none; height: 200px; }
    #blogs .blog .done p { padding-top: 5px; }
    #blogs .blog .done h3 { margin: 10px 0 0 0; }
    #blogs .blog .done form { height: 180px; text-align: center; }
    #blogs .blog .done .smiley { float: left; margin-top: 8px; }
    #blogs .blog .done .smiley h2 { color: #555; text-align: center; padding-right: 0; }
    #blogs .blog .done .dashicons-smiley { width: 100px; height: 100px; font-size: 100px; }
    #blogs .blog.active { background: #222; color: #ccc; border-radius: 5px; border-radius: 5px; }
    #blogs .blog.active:hover { background: #222; color: #ccc; }
    #blogs .blog.active .original span { color: #666; }
    #blogs .blog:hover { background: #f6f6f6; }
    #restart { display: none; margin-top: 15px; }
    #restart .dashicons-backup { float: left; font-size: 40px; width: 40px; height: 40px; margin: 8px 8px 0 0; color: #666; }
    #reset { float: right; margin-top: 10px; }
</style>
<div class="wrap">
    <button id="reset" class="button"><?php _e('Remove authorization', BIECore::SLUG); ?></button>
    <h2><?php echo BIECore::NAME; ?></h2>
    <?php if(count($blogs->items)): ?>
        <div id="restart" class="error-div error">
            <span class="dashicons dashicons-backup"></span>
            <p><?php _e("<b>The importer has stopped unexpectedly!</b><br>But&hellip; don't worry! It will restart automatically in <span id=\"timeout\">-</span> seconds.", BIECore::SLUG); ?></p>
        </div>
        <div id="blogs" class="media-upload-form">
            <div class="media-item">
                <div class="filename original"><?php _e('Select a blog', BIECore::SLUG); ?></div>
            </div>
            <?php foreach($blogs->items as $blog): ?>
                <div class="blog media-item" data-id="<?php echo $blog->id; ?>">
                    <div class="filename original">
                        <img src="<?php echo $blog->url; ?>favicon.ico">
                        <?php echo $blog->name; ?>
                        <span><?php echo substr($blog->url, 7, -1); ?></span>
                    </div>
                    <form class="settings wp-filter">
                        <button class="button button-primary"><?php if(array_key_exists($blog->id, $statuses)): ?><?php _e('Continue', BIECore::SLUG); ?><?php else: ?><?php _e('Start Import', BIECore::SLUG); ?><?php endif; ?></button>
                        <fieldset><label><input name="options[convert_formatting]" type="checkbox" value="1" <?php if(!array_key_exists($blog->id, $statuses) || $statuses[$blog->id]['options']['convert_formatting']): ?>checked<?php endif; ?> <?php if(array_key_exists($blog->id, $statuses)): ?>disabled<?php endif; ?>> <?php _e('Convert formatting', BIECore::SLUG); ?></label></fieldset>
                        <fieldset><label><input name="options[preserve_slugs]" type="checkbox" value="1" <?php if(!array_key_exists($blog->id, $statuses) || $statuses[$blog->id]['options']['preserve_slugs']): ?>checked<?php endif; ?> <?php if(array_key_exists($blog->id, $statuses)): ?>disabled<?php endif; ?>> <?php _e('Preserve slugs', BIECore::SLUG); ?></label></fieldset>
                    </form>
                    <div class="details wp-filter">
                        <div class="posts media-item">
                            <div class="progress">
                                <div class="percent"><span class="imported">0</span> / <span class="total"><?php echo $blog->posts->totalItems; ?></span></div>
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <div class="filename original">Posts</div>
                        </div>
                        <div class="pages media-item">
                            <div class="progress">
                                <div class="percent"><span class="imported">0</span> / <span class="total"><?php echo $blog->pages->totalItems; ?></span></div>
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <div class="filename original">Pages</div>
                        </div>
                        <div class="comments media-item">
                            <div class="progress">
                                <div class="percent"><span class="imported">0</span> / <span class="total">?</span></div>
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <div class="filename original">Comments</div>
                        </div>
                        <div class="images media-item">
                            <div class="progress">
                                <div class="percent"><span class="imported">0</span> / <span class="total">?</span></div>
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <div class="filename original">Images</div>
                        </div>
                        <div class="links media-item">
                            <div class="progress">
                                <div class="percent"><span class="imported">0</span> / <span class="total">?</span></div>
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <div class="filename original">Links</div>
                        </div>
                    </div>
                    <form class="authors wp-filter">
                        <h3><?php _e('Nearly there!', BIECore::SLUG); ?></h3>
                        <p><?php _e('Now, you need to assign the Blogger authors to the WordPress users:', BIECore::SLUG); ?></p>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                    <th><?php _e('Select an existing user', BIECore::SLUG); ?></th>
                                    <th></th>
                                    <th><?php _e('Create a new one', BIECore::SLUG); ?></th>
                                </tr>
                            </thead>
                            <tbody class="users"></tbody>
                        </table>
                        <p class="submt">
                            <button class="button button-primary"><?php _e('Assign authors', BIECore::SLUG); ?></button>
                            <img class="loader" src="<?php echo admin_url('images/loading.gif'); ?>">
                            <a class="skip" href="#"><?php _e('Skip', BIECore::SLUG); ?></a>
                        </p>
                    </form>
                    <div class="done wp-filter">
                        <div class="smiley">
                            <div class="dashicons dashicons dashicons-smiley"></div>
                            <h2><?php _e('All done!', BIECore::SLUG); ?></h2>
                        </div>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <h3><?php _e("Hey!", BIECore::SLUG); ?></h3>
                            <p><?php _e("If this plugin was useful to you, consider the hypothesis of a donation.<br><b>You'd be a great help!</b>", BIECore::SLUG); ?></p>
                            <input type="hidden" name="cmd" value="_donations">
                            <input type="hidden" name="business" value="me@yurifarina.com">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="<?php echo BIECore::NAME; ?>">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="currency_code" value="EUR">
                            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <i><?php _e('You have no blogs', BIECore::SLUG); ?></i>
    <?php endif; ?>
</div>
<script>
    (function($) {
        $(document).ready(function() {

            var running = false;
            var users = <?php echo json_encode($users); ?>;
            var default_delay = 180;
            var minimum_delay = 60;

            var import_completed = true;
            var import_interval = undefined;

            var status_completed = true;
            var status_interval = undefined;

            var cycle_import = function(blog_id, options) {
                import_interval = setInterval(function() {
                    if(!import_completed) {
                        return;
                    }
                    import_completed = false;
                    $.ajax({
                        url: '<?php echo admin_url("admin-ajax.php"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: options + '&action=bie_import&blog_id=' + blog_id,
                        success: function(status) {
                            if(status.running) {
                                var delay = status.slower_request ? status.slower_request * 2 : default_delay;
                                pause_import(blog_id, options, delay);
                            } else {
                                update_progress(status);

                                if(status.resource == 'done') {
                                    clearInterval(import_interval);
                                    clearInterval(status_interval);

                                    var $users = $('#blogs .blog.active .users');

                                    for(var author_id in status.authors) {
                                        var id = $users.find('.user').length;
                                        
                                        $users.append('' +
                                            '<tr class="user">' +
                                            '    <td><label>' + status.authors[author_id] + '</label><input type="hidden" name="authors[' + id + '][blogger_id]" value="' + author_id + '"></td>' +
                                            '    <td><span class="dashicons dashicons-arrow-right"></span></td>' +
                                            '    <td align="center"><select name="authors[' + id + '][wordpress_id]"></select></td>' +
                                            '    <td><em>or</em></td>' +
                                            '    <td align="center"><input type="text" name="authors[' + id + '][wordpress_login]" placeholder="username"></td>' +
                                            '    ' + (!id ? '<td valign="top" width="25%"><em><?php echo addslashes(__("<b>Note:</b> if a new user is created, a new password will be randomly generated, manually changing the new user’s details will be necessary.", BIECore::SLUG)); ?></em></td>' : '') +
                                            '</tr>' +
                                        '');

                                        for(var u in users) {
                                            $users.find('.user:last-child select').append('<option value="' + users[u].id + '">' + users[u].user_login + '</option>');
                                        }
                                    }
                                    
                                    $users.find('tr:first-child td:last-child').attr('rowspan', $users.find('tr').length);

                                    $('#reset').prop('disabled', false);
                                    $('#blogs .blog.active .details').slideUp(function() {
                                        $('#blogs .blog.active .authors').slideDown();
                                    });
                                    running = false;
                                } else {
                                    import_completed = true;
                                }
                            }
                        },
                        error: function() {
                            pause_import(blog_id, options, default_delay);
                        }
                    });
                }, 1000);
            };

            var cycle_status = function(blog_id) {
                status_interval = setInterval(function() {
                    if(!status_completed) {
                        return;
                    }
                    status_completed = false;
                    $.ajax({
                        url: '<?php echo admin_url("admin-ajax.php"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'bie_status',
                            blog_id: blog_id
                        },
                        success: function(status) {
                            update_progress(status);
                            status_completed = true;
                        }
                    });
                }, 3000);
            };

            var pause_import = function(blog_id, options, delay) {
                clearInterval(import_interval);
                var timeout_interval = undefined;
                var $timeout = $('#timeout');
                var $restart = $('#restart');
                if(delay < minimum_delay) {
                    delay = minimum_delay;
                }
                $timeout.text(delay);
                $restart.fadeIn(function() {
                    timeout_interval = setInterval(function() {
                        var timeout = parseInt($timeout.text());
                        if(!timeout) {
                            clearInterval(timeout_interval);
                            $.ajax({
                                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                                type: 'POST',
                                data: {
                                    action: 'bie_unlock',
                                    blog_id: blog_id
                                },
                                complete: function() {
                                    $restart.fadeOut(function() {
                                        import_completed = true;
                                        cycle_import(blog_id, options);
                                    });
                                }
                            });
                        } else {
                            $timeout.text(--timeout);
                        }
                    }, 1000);
                });
            };

            var update_progress = function(status) {
                var $blog = $('#blogs .blog.active');

                $blog.find('.posts .imported').text(status.posts_imported);
                $blog.find('.posts .bar').css('width', parseInt(parseInt($blog.find('.posts .imported').text()) * 100 / parseInt($blog.find('.posts .total').text())) + '%');
                $blog.find('.pages .imported').text(status.pages_imported);
                $blog.find('.pages .bar').css('width', parseInt(parseInt($blog.find('.pages .imported').text()) * 100 / parseInt($blog.find('.pages .total').text())) + '%');
                $blog.find('.comments .total').text(status.comments_total);
                $blog.find('.comments .imported').text(status.comments_imported);
                $blog.find('.comments .bar').css('width', parseInt(parseInt($blog.find('.comments .imported').text()) * 100 / parseInt($blog.find('.comments .total').text())) + '%');
                $blog.find('.images .total').text(status.images_total);
                $blog.find('.images .imported').text(status.images_imported);
                $blog.find('.images .bar').css('width', parseInt(parseInt($blog.find('.images .imported').text()) * 100 / parseInt($blog.find('.images .total').text())) + '%');
                $blog.find('.links .total').text(status.links_total);
                $blog.find('.links .imported').text(status.links_imported);
                $blog.find('.links .bar').css('width', parseInt(parseInt($blog.find('.links .imported').text()) * 100 / parseInt($blog.find('.links .total').text())) + '%');

                if(status.posts_imported > parseInt($blog.find('.posts .total').text())) {
                    $blog.find('.posts .total').text(status.posts_imported);
                }
                if(status.pages_imported > parseInt($blog.find('.pages .total').text())) {
                    $blog.find('.pages .total').text(status.pages_imported);
                }
                if(status.comments_imported > parseInt($blog.find('.comments .total').text())) {
                    $blog.find('.comments .total').text(status.comments_imported);
                }
                if(status.images_imported > parseInt($blog.find('.images .total').text())) {
                    $blog.find('.images .total').text(status.images_imported);
                }
                if(status.links_imported > parseInt($blog.find('.links .total').text())) {
                    $blog.find('.links .total').text(status.links_imported);
                }
            };

            $('#blogs .blog').on('click', function(event) {
                if($(this).hasClass('active')) {
                    return;
                }
                var $item = $(this);
                var $siblings = $item.siblings('.blog');
                $item.addClass('active');
                $siblings.removeClass('active');
                $item.stop().animate({opacity: 1});
                $siblings.stop().animate({opacity: 0.25});
                $item.find('.settings').stop().slideDown();
                $siblings.find('.settings').stop().slideUp();
            });

            $('#blogs .blog .settings').on('submit', function(event) {
                event.preventDefault();
                running = true;
                var $form = $(this);
                var $item = $(this).parents('.blog');
                var $siblings = $item.siblings('.media-item');
                $siblings.slideUp();
                $item.find('.settings').slideUp(function() {
                    $item.find('.details').slideDown(function() {
                        $('#reset').prop('disabled', true);
                        cycle_import($item.data('id'), $form.serialize());
                        cycle_status($item.data('id'));
                    });
                });
            });

            $('#blogs .blog .authors').on('submit', function(event) {
                event.preventDefault();
                var $item = $(this).parents('.blog');
                var $form = $(this);
                var form_data = $form.serialize();
                $form.find('button,select,input').prop('disabled', true);
                $form.find('.skip').fadeOut('fast', function() {
                    $form.find('.loader').fadeIn('fast', function() {
                        $.ajax({
                            url: '<?php echo admin_url("admin-ajax.php"); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: form_data + '&action=bie_authors&blog_id=' + $item.data('id'),
                            success: function() {
                                $('#blogs .blog.active .authors').slideUp(function() {
                                    $('#blogs .blog.active .done').slideDown();
                                });
                            }
                        });
                    });
                });
            });

            $('#blogs .blog .authors .skip').on('click', function(event) {
                event.preventDefault();
                $('#blogs .blog.active .authors').slideUp(function() {
                    $('#blogs .blog.active .done').slideDown();
                });
            });

            $('#reset').on('click', function() {
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'bie_reset'
                    },
                    success: function() {
                        window.location.reload();
                    }
                });
            });

            $(window).bind('beforeunload', function() {
                if(running) {
                    return "<?php echo addslashes(__('The import isn\'t over yet, if you proceed will stop.', BIECore::SLUG)); ?>";
                }
            });

        });
    })(jQuery);
</script>