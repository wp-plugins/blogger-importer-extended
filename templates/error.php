<div class="wrap">
    <h2><?php echo BIECore::NAME; ?></h2>
    <div class="error-div error">
        <p><?php _e("The uploads directory is not writable by WordPress, so BIE can't import images.<br>You must fix this issue before proceed, this could be helpful:", BIECore::SLUG); ?> <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a></p>
	    <p><a class="button button-primary" href=""><?php _e('Done, check again!', BIECore::SLUG); ?></a></p>
    </div>
</div>