<div id="looxBody">
    <form action="options.php" method="post" id="pmwOptionsForm">
        <?php settings_fields( 'nvm_options_settings_group' ); ?>
        <?php do_settings_sections( 'nvm_options_settings_group' ); ?>
        <?php
        settings_errors();
        ?>
        <div id="looxBox">
            <header>
                <div class="save_pmw_options hide-if-no-js">
                    <?php submit_button( __( 'Save Changes' ) ) ?>
                    <p class="save_message"></p>
                    <i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                </div>
                <h2><?php _e( 'Settings' ) ?></h2>
            </header>
            <div id="looxWrapper">
                <input type="hidden" class="nvm-options-request" value="<?php echo site_url(); ?>/api/admin/options/save?nonce=<?php echo wp_create_nonce( 'nvm-options-request-nonce' ) ?>">
                <?php include NVM_DIR_PATH . '/inc/nvm-opt.php'; ?>
            </div>
            <footer>
                <div class="save_pmw_options hide-if-no-js">
                    <?php submit_button( __( 'Save Changes' ) ) ?>
                    <p class="save_message"></p>
                    <i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                </div>
            </footer>
        </div>
    </form>
</div>
