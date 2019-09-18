<?php 

function cff_menu() {
    add_menu_page(
        '',
        'Facebook Feed',
        'manage_options',
        'cff-top',
        'cff_settings_page'
    );
    add_submenu_page(
        'cff-top',
        'Settings',
        'Settings',
        'manage_options',
        'cff-top',
        'cff_settings_page'
    );
}
add_action('admin_menu', 'cff_menu');
//Add styling page
function cff_styling_menu() {
    add_submenu_page(
        'cff-top',
        'Customize',
        'Customize',
        'manage_options',
        'cff-style',
        'cff_style_page'
    );
}
add_action('admin_menu', 'cff_styling_menu');

// Add Extensions page
function cff_extensions_menu() {
    add_submenu_page(
        'cff-top',
        'Extensions',
        'Extensions',
        'manage_options',
        'cff-extensions',
        'cff_extensions_page'
    );
}
add_action('admin_menu', 'cff_extensions_menu');



//Add Welcome page
add_action('admin_menu', 'cff_welcome_menu');
function cff_welcome_menu() {
    add_submenu_page(
        'cff-top',
        "What's New?",
        "What's New?",
        'manage_options',
        'cff-welcome-new',
        'cff_welcome_screen_new_content'
    );
    add_submenu_page(
        'cff-top',
        'Getting Started',
        'Getting Started',
        'manage_options',
        'cff-welcome-started',
        'cff_welcome_screen_started_content'
    );
}
function cff_welcome_screen_new_content() { ?>
    <div class="wrap about-wrap cff-welcome">
        <?php cff_welcome_header(); ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=cff-welcome-new" class="nav-tab nav-tab-active"><?php _e("What's New?"); ?></a>
            <a href="?page=cff-welcome-started" class="nav-tab"><?php _e('Getting Started'); ?></a>
        </h2>

        <p class="about-description"><?php _e("Let's take a look at what's new in version 3.9"); ?></p>

        <div class="changelog">
            <h3><?php _e("Facebook Groups"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-groups.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("Facebook Groups are making their long-awaited return to the plugin! You can now display timeline posts, events, videos, and albums from groups that you've added our app to."); ?></p>
                    <h4><?php _e("Directions"); ?></h4>
                    <p><?php _e("Just click the 'Log in and get my Access Token' button on the plugin's Settings page and select 'Facebook Group'. Follow the prompts to connect your Group and display your feed."); ?></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <h3><?php _e("Spotify Embeds"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-spotify.jpg' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("Like sharing music? The plugin now supports Spotify player embeds and will automatically create a player inside your post when you share a Spotify link."); ?></p>
                </div>
            </div>
        </div>

        <p class="about-description">Here are some other features that were recently added:</p>

        <div class="changelog">
            <h3><?php _e("Redesigned Icons"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-icons.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("We've redesigned the icons in the plugin to be more colorful, more versatile, and all around more awesome!"); ?></p>
                    <p><?php _e("Icons are now SVGs which also allow them to appear much sharper on retina displays. To switch back to the old icons just use the following setting:"); ?> <i>Customize > Misc > Misc Settings > Disable SVG icons.</i></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <h3><?php _e("Multi-image Shared Links"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-link-slider.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("Do your links have multiple images? We've got your back. The plugin now supports Facebook's multi-image shared link cards and will display them in a scrollable slideshow right in your feed."); ?></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <h3><?php _e("Boxed Post Style"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-boxed.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("Let's face it. Boxes are cool. Now you can display your posts in boxes till your heart's content by using the new 'Boxed' option we've added to the Post Style settings."); ?></p>
                    <h4><?php _e("Directions"); ?></h4>
                    <p><?php _e("This new setting can be found at: <i>Customize > Style Posts > Post Item</i>. Select the 'Boxed' option to reveal the associated settings, which now also includes a 'box shadow' setting."); ?></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <h3><?php _e("Lightbox Customization Settings"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-lightbox-customize.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("Perhaps the only thing cooler than our lightbox is our lightbox in your own custom colors! With our new lightbox color settings you can add a splash of color, go inverted, or just experiment to see what suits your site. We've even added a new custom scrollbar for Webkit browsers."); ?></p>
                    <h4><?php _e("Directions"); ?></h4>
                    <p><?php _e("The Lightbox settings can be found at: <i>Customize > General > Lightbox.</i>"); ?></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <h3><?php _e("Support for Video Playlists"); ?></h3>
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-video-playlists.png' , __FILE__ ) ?>">
                </div>
                
                <div class="cff-feature-section-content">
                    <p><?php _e("The plugin now also supports video playlists, allowing you to separate out your videos into separate feeds."); ?></p>
                    <h4><?php _e("Directions"); ?></h4>
                    <p><?php _e("To display a playlist simply add the playlist ID to the shortcode, like so: <code>[custom-facebook-feed type=videos playlist='1234567890']</code>. If a video is in a playlist then the playlist ID can be found in the video URL, after the <code>vl.</code>&nbsp; Eg: .../videos/vl.<b>1234567890</b>/."); ?></p>
                </div>
            </div>
        </div>

        <p class="cff-footnote">
            <i class="fa fa-heart"></i>Your friends @ <a href="https://smashballoon.com/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Smash Balloon</a>

            <?php $disable_welcome = get_user_meta(get_current_user_id(), 'cff_disable_welcome', true);
            if ( empty($disable_welcome)) : ?>
                <a class="cff-redirect-disable" href="admin.php?page=cff-top&cff_disable_welcome=0"><?php _e( "Don't show this page again", 'custom-facebook-feed' ); ?></a>
            <?php endif; ?>

        </p>

    </div>
<?php }
function cff_welcome_screen_started_content() { ?>
    <div class="wrap about-wrap cff-welcome">
        <?php cff_welcome_header(); ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=cff-welcome-new" class="nav-tab"><?php _e("What's New?"); ?></a>
            <a href="?page=cff-welcome-started" class="nav-tab nav-tab-active"><?php _e('Getting Started'); ?></a>
        </h2>

        <p class="about-description"><?php _e("Your first time using the plugin? Let's help you get started..."); ?></p>

        <div class="cff-123">
            <div class="changelog">
                <div class="feature-section">
                    <div class="cff-feature-section-media">
                        <img src="<?php echo plugins_url( 'img/welcome-license.png' , __FILE__ ) ?>">
                    </div>
                    
                    <div class="cff-feature-section-content">
                        <h3><span class="cff-big-text">1</span><?php _e("Activate Your License Key"); ?></h3>
                        <p><?php _e("In order to receive updates for the plugin you'll need to activate your license key by entering it "); ?><a href="admin.php?page=cff-top&amp;tab=license" target="_blank"><?php _e("here."); ?></a></p>
                    </div>
                </div>
            </div>

            <div class="changelog">
                <div class="feature-section">
                    <div class="cff-feature-section-media">
                        <img src="<?php echo plugins_url( 'img/welcome-login-button.png' , __FILE__ ) ?>">
                    </div>
                    <div class="cff-feature-section-content">
                        <h3><span class="cff-big-text">2</span><?php _e("Log into Facebook"); ?></h3>
                        <p><?php _e("We've made configuring your feed super simple. Just log into your Facebook account using the <b>Log in and get my Access Token</b> button on the plugin's "); ?><a href="admin.php?page=cff-top" target="_blank"><?php _e("Settings page"); ?></a> <?php _e(" and authorize the plugin to connect your account."); ?></p>
                    </div>
                </div>
            </div>

            <div class="changelog">
                <div class="feature-section">
                    <div class="cff-feature-section-media">
                        <img src="<?php echo plugins_url( 'img/welcome-shortcode.png' , __FILE__ ) ?>">
                    </div>
                    <div class="cff-feature-section-content">
                        <h3><span class="cff-big-text">3</span><?php _e("Display Your Feed"); ?></h3>
                        <p><?php _e("To display your feed simply copy and paste the <nobr><code>[custom-facebook-feed]</code></nobr> shortcode wherever you want the feed to show up; any page, post, or widget. It really is that simple!");?></p>

                        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; Need more help? See our <a href="admin.php?page=cff-top&amp;tab=support" target="_blank">Support Section</a>.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="changelog">
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-multiple.png' , __FILE__ ) ?>">
                </div>
                <div class="cff-feature-section-content">
                    <h3><?php _e("Multiple Feeds"); ?></h3>
                    <p><?php _e("You can display as many feeds on your site as you'd like. Just use our handy "); ?><a href="https://smashballoon.com/custom-facebook-feed/docs/shortcodes/" target="_blank"><?php _e("shortcode options");?></a> <?php _e("to customize each one as needed.");?></p>

                    <p><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; <a href="https://smashballoon.com/display-posts-multiple-facebook-pages/" target="_blank">More help</a></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <img src="<?php echo plugins_url( 'img/welcome-customize.png' , __FILE__ ) ?>">
                </div>
                <div class="cff-feature-section-content">
                    <h3><?php _e("Customize Your Feed"); ?></h3>
                    <p><?php _e("There are countless ways to customize your Facebook feed.");?></p>

                    <h4><?php _e("Feed Types"); ?></h4>
                    <p><?php _e("Display feeds from different parts of your Facebook page. From your main timeline, to your Photos page, Events page, and more."); ?></p>
                    <p><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; <?php _e("Find out more:"); ?> <a href="https://smashballoon.com/custom-facebook-feed/docs/displaying-facebook-events-using-wordpress-plugin/" target="_blank"><?php _e("Events"); ?></a>, <a href="https://smashballoon.com/custom-facebook-feed/docs/displaying-facebook-photos-using-the-wordpress-plugin/" target="_blank"><?php _e("Photos"); ?></a>, <a href="https://smashballoon.com/custom-facebook-feed/docs/displaying-facebook-albums-using-the-wordpress-plugin/" target="_blank"><?php _e("Albums"); ?></a>, <a href="https://smashballoon.com/custom-facebook-feed/docs/displaying-facebook-videos-using-the-wordpress-plugin/" target="_blank"><?php _e("Videos"); ?></a>.
                    </p>

                    <h4><?php _e("Styling options"); ?></h4>
                    <p><?php _e("Choose layouts, which parts of your posts to show or hide, and style each individual part."); ?> <a href="admin.php?page=cff-style"><?php _e("Go to the Customize page"); ?></a>.</p>

                    <h4><?php _e("Advanced Customizations"); ?></h4>
                    <p><?php _e("You can achieve some pretty advanced customizations using the plugin. Here's some examples:"); ?></p>
                    <p><i class="fa fa-file-text-o" aria-hidden="true"></i> <a href="https://smashballoon.com/filtering-your-facebook-posts/" target="_blank"><?php _e("Filtering posts by word"); ?></a> &nbsp;&middot;&nbsp; <i class="fa fa-file-text-o" aria-hidden="true"></i> <a href="https://smashballoon.com/cff-how-does-the-plugin-handle-text-and-language-translation/" target="_blank"><?php _e("Translating text"); ?></a> &nbsp;&middot;&nbsp; <i class="fa fa-file-text-o" aria-hidden="true"></i> <a href="https://smashballoon.com/category/custom-facebook-feed/customizations/snippets/?cat=18" target="_blank"><?php _e("Code Snippets"); ?></a>
                    </p>

                    <h4><?php _e("Extensions"); ?></h4>
                    <p><?php _e("Need even more features? Check out our <a href='admin.php?page=cff-extensions'>library of extensions</a>."); ?></p>
                </div>
            </div>
        </div>

        <div class="changelog">
            <div class="feature-section">
                <div class="cff-feature-section-media">
                    <a href='admin.php?page=cff-top&amp;tab=support'><img src="<?php echo plugins_url( 'img/welcome-support.png' , __FILE__ ) ?>"></a>
                </div>
                <div class="cff-feature-section-content">
                    <h3><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e("Need some more help?"); ?></h3>
                    <p><?php _e("Check out our <a href='admin.php?page=cff-top&amp;tab=support'>Support Section</a> which includes helpful links, a tutorial video, and more.");?></p>
                </div>
            </div>
        </div>

        <p class="cff-footnote"><i class="fa fa-heart"></i>Your friends @ <a href="https://smashballoon.com/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Smash Balloon</a></p>

    </div>
<?php }
function cff_welcome_header(){ ?>
    <?php
    //Set an option that shows that the welcome page has been seen
    update_option( 'cff_welcome_seen', true );

    add_user_meta(get_current_user_id(), 'cff_seen_welcome_'.CFFWELCOME_VER, 'true', true);

    ?>
    <div id="cff-header">
        <a href="admin.php?page=cff-top" class="cff-welcome-close"><i class="fa fa-times"></i></a>
        <a href="https://smashballoon.com/?utm_source=plugin-pro&utm_campaign=cff" class="cff-welcome-image" title="Your friends at Smash Balloon" target="_blank">
            <img src="<?php echo plugins_url( 'img/balloon.png' , __FILE__ ) ?>" alt="Custom Facebook Feed Pro">
        </a>
        <h1><?php _e("Welcome to Custom Facebook Feed Pro"); ?></h1>
        <p class="about-text">
            <?php _e("Thanks for installing <b>Version ".CFFVER."</b> of the Custom Facebook Feed Pro plugin! Use the tabs below to see what's new or to get started using the plugin."); ?>
        </p>
    </div>
<?php }

add_action( 'admin_init', 'cff_welcome_screen_do_activation_redirect' );
function cff_welcome_screen_do_activation_redirect() {

    // Check whether a 30-second transient has been set by the activation function. If it has then potentially redirect to the Getting Started page.
    if ( get_transient( '_cff_activation_redirect' ) ){

        // Delete the redirect transient
        delete_transient( '_cff_activation_redirect' );

        // Bail if activating from network, or bulk
        if ( is_network_admin() || isset( $_GET['activate-multi'] ) )
            return;
        
        $cff_ver = get_option( 'cff_ver' );
        if ( ! $cff_ver ) {
            update_option( 'cff_ver', CFFVER );

            $disable_welcome = get_user_meta(get_current_user_id(), 'cff_disable_welcome', true);
            if ( empty( $disable_welcome ) ) wp_safe_redirect( admin_url( 'admin.php?page=cff-welcome-started' ) );

            exit;
        }
    } else {

        if ( isset($_GET['page']) && ('cff-top' == $_GET['page'] || 'cff-style' == $_GET['page']) && !get_user_meta(get_current_user_id(), 'cff_seen_welcome_'.CFFWELCOME_VER) )  {
            update_option( 'cff_ver', CFFVER );

            $disable_welcome = get_user_meta(get_current_user_id(), 'cff_disable_welcome', true);
            if ( empty( $disable_welcome ) ) wp_safe_redirect( admin_url( 'admin.php?page=cff-welcome-new' ) );

            exit;
        }

    }

}


function cff_register_option() {
    // creates our settings in the options table
    register_setting('cff_license', 'cff_license_key', 'cff_sanitize_license' );

    //Add hook to allow extensions to register their license setting
    do_action('cff_register_setting_license');
}
add_action('admin_init', 'cff_register_option');


function cff_sanitize_license( $new ) {
    $old = get_option( 'cff_license_key' );
    if( $old && $old != $new ) {
        delete_option( 'cff_license_status' ); // new license has been entered, so must reactivate
    }
    return $new;
}
function cff_activate_license() {
    // listen for our activate button to be clicked
    if( isset( $_POST['cff_license_activate'] ) ) {

        // run a quick security check 
        if( ! check_admin_referer( 'cff_nonce', 'cff_nonce' ) )   
            return; // get out if we didn't click the Activate button
        // retrieve the license from the database
        $cff_license = trim( get_option( 'cff_license_key' ) );
            
        // data to send in our API request
        $cff_api_params = array( 
            'edd_action'=> 'activate_license', 
            'license'   => $cff_license, 
            'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
        );
        
        // Call the custom API.
        $cff_response = wp_remote_get( add_query_arg( $cff_api_params, WPW_SL_STORE_URL ), array( 'timeout' => 60, 'sslverify' => false ) );
        // make sure the response came back okay
        if ( is_wp_error( $cff_response ) )
            return false;
        // decode the license data
        $cff_license_data = json_decode( wp_remote_retrieve_body( $cff_response ) );

        //store the license data in an option
        update_option( 'cff_license_data', $cff_license_data );
        
        // $license_data->license will be either "active" or "inactive"
        update_option( 'cff_license_status', $cff_license_data->license );
    }

}
add_action('admin_init', 'cff_activate_license');
function cff_deactivate_license() {
    // listen for our activate button to be clicked
    if( isset( $_POST['cff_license_deactivate'] ) ) {
        // run a quick security check 
        if( ! check_admin_referer( 'cff_nonce', 'cff_nonce' ) )   
            return; // get out if we didn't click the Activate button
        // retrieve the license from the database
        $cff_license = trim( get_option( 'cff_license_key' ) );
            
        // data to send in our API request
        $cff_api_params = array( 
            'edd_action'=> 'deactivate_license', 
            'license'   => $cff_license, 
            'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
        );
        
        // Call the custom API.
        $cff_response = wp_remote_get( add_query_arg( $cff_api_params, WPW_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
        // make sure the response came back okay
        if ( is_wp_error( $cff_response ) )
            return false;
        // decode the license data
        $cff_license_data = json_decode( wp_remote_retrieve_body( $cff_response ) );
        
        // $license_data->license will be either "deactivated" or "failed"
        if( $cff_license_data->license == 'deactivated' )
            delete_option( 'cff_license_status' );
    }
}
add_action('admin_init', 'cff_deactivate_license');




//Create Extensions Page
function cff_extensions_page() { 

    ( is_plugin_active( 'cff-extensions/cff-extensions.php' ) ) ? $cff_ext = true : $cff_ext = false;

    //Declare variables for fields
    $cff_ext_hidden_field_name = 'cff_ext_hidden';

    //Save in an array
    $cff_ext_options = get_option('cff_extensions_status');

    //Set extensions in extensions plugin all to false by default
    $cff_extensions_multifeed_active = false;
    $cff_extensions_date_range_active = false;
    $cff_extensions_featured_post_active = false;
    $cff_extensions_album_active = false;
    $cff_extensions_lightbox_active = false;
    $cff_extensions_masonry_columns_active = false;
    $cff_extensions_carousel_active = false;
    $cff_extensions_reviews_active = false;

    if (WPW_SL_ITEM_NAME == 'Custom Facebook Feed WordPress Plugin Smash'){
        //Set page variables
        if( isset($cff_ext_options[ 'cff_extensions_multifeed_active' ]) ) $cff_extensions_multifeed_active = $cff_ext_options[ 'cff_extensions_multifeed_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_date_range_active' ]) ) $cff_extensions_date_range_active = $cff_ext_options[ 'cff_extensions_date_range_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_featured_post_active' ]) ) $cff_extensions_featured_post_active = $cff_ext_options[ 'cff_extensions_featured_post_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_album_active' ]) ) $cff_extensions_album_active = $cff_ext_options[ 'cff_extensions_album_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_lightbox_active' ]) ) $cff_extensions_lightbox_active = $cff_ext_options[ 'cff_extensions_lightbox_active' ];
        $cff_extensions_masonry_columns_active = ''; //Deprecated
        if( isset($cff_ext_options[ 'cff_extensions_carousel_active' ]) ) $cff_extensions_carousel_active = $cff_ext_options[ 'cff_extensions_carousel_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_reviews_active' ]) ) $cff_extensions_reviews_active = $cff_ext_options[ 'cff_extensions_reviews_active' ];
    }

    if( isset($_POST[ $cff_ext_hidden_field_name ]) && $_POST[ $cff_ext_hidden_field_name ] == 'Y' ) {
        
        //Update the settings
        isset( $_POST[ 'cff_extensions_multifeed_active' ] ) ? $cff_extensions_multifeed_active = $_POST[ 'cff_extensions_multifeed_active' ] : $cff_extensions_multifeed_active = '';
        isset( $_POST[ 'cff_extensions_date_range_active' ] ) ? $cff_extensions_date_range_active = $_POST[ 'cff_extensions_date_range_active' ] : $cff_extensions_date_range_active = '';
        isset( $_POST[ 'cff_extensions_featured_post_active' ] ) ? $cff_extensions_featured_post_active = $_POST[ 'cff_extensions_featured_post_active' ] : $cff_extensions_featured_post_active = '';
        isset( $_POST[ 'cff_extensions_album_active' ] ) ? $cff_extensions_album_active = $_POST[ 'cff_extensions_album_active' ] : $cff_extensions_album_active = '';
        isset( $_POST[ 'cff_extensions_lightbox_active' ] ) ? $cff_extensions_lightbox_active = $_POST[ 'cff_extensions_lightbox_active' ] : $cff_extensions_lightbox_active = '';
        $cff_extensions_masonry_columns_active = '';
        isset( $_POST[ 'cff_extensions_carousel_active' ] ) ? $cff_extensions_carousel_active = $_POST[ 'cff_extensions_carousel_active' ] : $cff_extensions_carousel_active = '';
        isset( $_POST[ 'cff_extensions_reviews_active' ] ) ? $cff_extensions_reviews_active = $_POST[ 'cff_extensions_reviews_active' ] : $cff_extensions_reviews_active = '';

        
        $cff_ext_options[ 'cff_extensions_multifeed_active' ] = $cff_extensions_multifeed_active;
        $cff_ext_options[ 'cff_extensions_date_range_active' ] = $cff_extensions_date_range_active;
        $cff_ext_options[ 'cff_extensions_featured_post_active' ] = $cff_extensions_featured_post_active;
        $cff_ext_options[ 'cff_extensions_album_active' ] = $cff_extensions_album_active;
        $cff_ext_options[ 'cff_extensions_lightbox_active' ] = $cff_extensions_lightbox_active;
        $cff_ext_options[ 'cff_extensions_masonry_columns_active' ] = '';
        $cff_ext_options[ 'cff_extensions_carousel_active' ] = $cff_extensions_carousel_active;
        $cff_ext_options[ 'cff_extensions_reviews_active' ] = $cff_extensions_reviews_active;


        //Save the array
        update_option( 'cff_extensions_status', $cff_ext_options );

        // Put an settings updated message on the screen 
        ?>
        <div class="updated"><p><strong><?php _e('Settings saved.', 'custom-facebook-feed' ); ?></strong></p></div>
    
    <?php } ?>

    <div id="cff-admin" class="wrap">
    
        <div id="header">
            <h2><?php _e('Extensions'); ?></h2>
        </div>

        <?php cff_expiration_notice(); ?>

        <p><?php _e('The following extensions can be used to extend the functionality of the Custom Facebook Feed Pro plugin.'); ?></p>

        <form name="form-ext" id="form-ext" method="post" action="">
        <input type="hidden" name="<?php echo $cff_ext_hidden_field_name; ?>" value="Y">

            <div class="cff-extension">
                <h3>Multifeed</h3>
                <p class="cff-desc">Adds the ability to aggregate posts from multiple Facebook pages or groups into one single feed.</p>
                <div class="cff-ext-status <?php if($cff_extensions_multifeed_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 1.5.0</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_multifeed_active" type="checkbox" id="cff_extensions_multifeed_active" <?php if($cff_extensions_multifeed_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-multifeed/cff-multifeed.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/multifeed/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <div class="cff-extension">
                <h3>Date Range</h3>
                <p class="cff-desc">Adds the ability to display posts from a specific date range.</p>
                <div class="cff-ext-status <?php if($cff_extensions_date_range_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 1.5.0</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_date_range_active" type="checkbox" id="cff_extensions_date_range_active" <?php if($cff_extensions_date_range_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-date-range/cff-date-range.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/date-range/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <div class="cff-extension">
                <h3>Featured Post</h3>
                <p class="cff-desc">Adds the ability to display a specific post or event based on its ID.</p>
                <div class="cff-ext-status <?php if($cff_extensions_featured_post_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 1.5.0</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_featured_post_active" type="checkbox" id="cff_extensions_featured_post_active" <?php if($cff_extensions_featured_post_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-featured-post/cff-featured-post.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/featured-post/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <div class="cff-extension">
                <h3>Album</h3>
                <p class="cff-desc">Adds the ability to embed a specific Facebook album and display its photos.</p>
                <div class="cff-ext-status <?php if($cff_extensions_album_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 1.9.1</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_album_active" type="checkbox" id="cff_extensions_album_active" <?php if($cff_extensions_album_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-album/cff-album.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/album/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <div class="cff-extension">
                <h3>Carousel</h3>
                <p class="cff-desc">Adds the ability to create sliding carousels out of your Facebook content.</p>
                <div class="cff-ext-status <?php if($cff_extensions_carousel_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 2.6</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_carousel_active" type="checkbox" id="cff_extensions_carousel_active" <?php if($cff_extensions_carousel_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-carousel/cff-carousel.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/carousel/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <div class="cff-extension">
                <h3>Reviews</h3>
                <p class="cff-desc">Adds the ability to display reviews from your Facebook page.</p>
                <div class="cff-ext-status <?php if($cff_extensions_reviews_active == true) echo 'cff-active'; ?>">
                    <p class="cff-requires">Requires Custom Facebook Feed Pro - 2.6.6</p>
                    <?php if ( $cff_ext ) { ?>
                        <div class="cff-activate">
                            <label>Activate</label>
                            <input name="cff_extensions_reviews_active" type="checkbox" id="cff_extensions_reviews_active" <?php if($cff_extensions_reviews_active == true) echo "checked"; ?> />
                        </div>
                    <?php } else if( is_plugin_active( 'cff-reviews/cff-reviews.php' ) ) { ?>
                        <div class="cff-activated">
                            <label>Activated</label>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                    <?php } else { ?>
                        <a class="button" href="http://smashballoon.com/extensions/reviews/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Get this Extension</a>
                    <?php } ?>
                </div>
            </div>

            <footer>
                <?php if ( $cff_ext ) submit_button(); ?>
            </footer>

        </form>

        <div style="float: left; clear: both;">
            <h2 class="cff-other-plugins-header"><span></span><?php _e('More Smash Balloon Plugins'); ?></h2>
            <p><?php _e("We're more than just a Facebook plugin! Check out our other plugins below."); ?></p>
        </div>

        <div class="cff-other-plugin">
            <h3><i class="fa fa-instagram" aria-hidden="true"></i>&nbsp; Instagram Feed</h3>
            <p><?php _e("Responsive, customizable Instagram?? Heck yeah! We've poured our hearts and souls into creating the most beautifully simple yet highly powerful Instagram plugin known to man."); ?></p>
            <p><i class="fa fa-download" aria-hidden="true"></i>&nbsp; <?php _e("Download"); ?>: <a href="https://wordpress.org/plugins/instagram-feed/" target="_blank">Free</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="https://smashballoon.com/instagram-feed/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Pro</a></p>
        </div>

        <div class="cff-other-plugin">
            <h3><i class="fa fa-twitter" aria-hidden="true"></i>&nbsp; Custom Twitter Feeds</h3>
            <p><?php _e("Got Tweets? Get the Custom Twitter Feeds plugin! The most flexible, customizable, and feature-packed Twitter feed WordPress plugin in the whole wide world. Twitter feeds for days!"); ?></p>
            <p><i class="fa fa-download" aria-hidden="true"></i>&nbsp; <?php _e("Download"); ?>: <a href="https://wordpress.org/plugins/custom-twitter-feeds/" target="_blank">Free</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="https://smashballoon.com/custom-twitter-feeds/?utm_source=plugin-pro&utm_campaign=cff" target="_blank">Pro</a></p>
        </div>

    </div>

    <?php
}


//Create Settings page
function cff_settings_page() {

    $cff_welcome_seen = get_option( 'cff_welcome_seen' );
    if( $cff_welcome_seen == false ){ ?>
        <p class="cff-page-loading"><?php _e("Loading..."); ?></p>
        <script>window.location = "<?php echo admin_url( 'admin.php?page=cff-welcome-new' ); ?>";</script>
    <?php }

    //Timezone
    $defaults = array(
        'cff_timezone' => 'America/Chicago',
        'cff_load_more' => true
    );
    $options = wp_parse_args(get_option('cff_style_settings'), $defaults);
    $cff_timezone = $options[ 'cff_timezone' ];

    //Which extensions are active?
    //Is individual extension active || is Smash License extensions bundle active?
    $cff_ext_options = get_option('cff_extensions_status');

    //Set extensions in extensions plugin all to false by default
    $cff_extensions_multifeed_active = false;
    $cff_extensions_date_range_active = false;
    $cff_extensions_featured_post_active = false;
    $cff_extensions_album_active = false;
    $cff_extensions_lightbox_active = false;
    $cff_extensions_masonry_columns_active = false;
    $cff_extensions_carousel_active = false;
    $cff_extensions_reviews_active = false;


    if (WPW_SL_ITEM_NAME == 'Custom Facebook Feed WordPress Plugin Smash'){
        //Set page variables
        if( isset($cff_ext_options[ 'cff_extensions_multifeed_active' ]) ) $cff_extensions_multifeed_active = $cff_ext_options[ 'cff_extensions_multifeed_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_date_range_active' ]) ) $cff_extensions_date_range_active = $cff_ext_options[ 'cff_extensions_date_range_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_featured_post_active' ]) ) $cff_extensions_featured_post_active = $cff_ext_options[ 'cff_extensions_featured_post_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_album_active' ]) ) $cff_extensions_album_active = $cff_ext_options[ 'cff_extensions_album_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_lightbox_active' ]) ) $cff_extensions_lightbox_active = $cff_ext_options[ 'cff_extensions_lightbox_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_masonry_columns_active' ]) ) $cff_extensions_masonry_columns_active = $cff_ext_options[ 'cff_extensions_masonry_columns_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_carousel_active' ]) ) $cff_extensions_carousel_active = $cff_ext_options[ 'cff_extensions_carousel_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_reviews_active' ]) ) $cff_extensions_reviews_active = $cff_ext_options[ 'cff_extensions_reviews_active' ];
    }

    ( is_plugin_active( 'cff-multifeed/cff-multifeed.php' ) || $cff_extensions_multifeed_active ) ? $cff_ext_multifeed_active = true : $cff_ext_multifeed_active = false;
    ( is_plugin_active( 'cff-date-range/cff-date-range.php' ) || $cff_extensions_date_range_active ) ? $cff_ext_date_active = true : $cff_ext_date_active = false;
    ( is_plugin_active( 'cff-featured-post/cff-featured-post.php' ) || $cff_extensions_featured_post_active ) ? $cff_featured_post_active = true : $cff_featured_post_active = false;
    ( is_plugin_active( 'cff-album/cff-album.php' ) || $cff_extensions_album_active ) ? $cff_album_active = true : $cff_album_active = false;
    ( is_plugin_active( 'cff-lightbox/cff-lightbox.php' ) || $cff_extensions_lightbox_active ) ? $cff_lightbox_active = true : $cff_lightbox_active = false;
    $cff_masonry_columns_active = false; //Deprecated
    ( is_plugin_active( 'cff-carousel/cff-carousel.php' ) || $cff_extensions_carousel_active ) ? $cff_carousel_active = true : $cff_carousel_active = false;
    ( is_plugin_active( 'cff-reviews/cff-reviews.php' ) || $cff_extensions_reviews_active ) ? $cff_reviews_active = true : $cff_reviews_active = false;

    //Declare variables for fields
    $hidden_field_name      = 'cff_submit_hidden';
    $show_access_token      = 'cff_show_access_token';
    $access_token           = 'cff_access_token';
    $page_access_token      = 'cff_page_access_token';
    $page_id                = 'cff_page_id';
    $cff_page_type          = 'cff_page_type';
    $num_show               = 'cff_num_show';
    $cff_load_more          = 'cff_load_more';
    $cff_post_limit         = 'cff_post_limit';
    $cff_show_others        = 'cff_show_others';
    $cff_cache_time         = 'cff_cache_time';
    $cff_cache_time_unit    = 'cff_cache_time_unit';
    $cff_locale             = 'cff_locale';
    $cff_cache_cron_time    = 'cff_cache_cron_time';
    $cff_cache_cron_am_pm   = 'cff_cache_cron_am_pm';
    $cff_cache_cron_interval = 'cff_cache_cron_interval';
    $cff_caching_type       = 'cff_caching_type';

    //Extensions
    $cff_date_from          = 'cff_date_from';
    $cff_date_until         = 'cff_date_until';
    $cff_featured_post_id   = 'cff_featured_post_id';
    $cff_lightbox           = 'cff_lightbox';

    // Read in existing option value from database
    $show_access_token_val = true;
    $access_token_val = get_option( $access_token );
    $page_access_token_val = get_option( $page_access_token );
    $page_id_val = get_option( $page_id );
    $cff_page_type_val = get_option( $cff_page_type );
    $num_show_val = get_option( $num_show, '5' );
    $cff_load_more_val = get_option( $cff_load_more, true );
    $cff_post_limit_val = get_option( $cff_post_limit );
    $cff_show_others_val = get_option( $cff_show_others );
    $cff_cache_time_val = get_option( $cff_cache_time, '1' );
    $cff_cache_time_unit_val = get_option( $cff_cache_time_unit, 'hours' );
    $cff_locale_val = get_option( $cff_locale, 'en_US' );
    $cff_cache_cron_time_val = get_option( $cff_cache_cron_time, '1' );
    $cff_cache_cron_am_pm_val = get_option( $cff_cache_cron_am_pm, 'am' );
    $cff_cache_cron_interval_val = get_option( $cff_cache_cron_interval, '12hours' );
    $cff_caching_type_val = get_option( $cff_caching_type, 'page' );

    //Extensions
    $cff_date_from_val = get_option( $cff_date_from );
    $cff_date_until_val = get_option( $cff_date_until );
    $cff_featured_post_id_val = get_option( $cff_featured_post_id );
    $cff_lightbox_val = get_option( $cff_lightbox );

    // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        isset( $_POST[ $show_access_token ] ) ? $show_access_token_val = true : $show_access_token_val = true;
        isset( $_POST[ $access_token ] ) ? $access_token_val = $_POST[ $access_token ] : $access_token_val = '';
        isset( $_POST[ $page_access_token ] ) ? $page_access_token_val = $_POST[ $page_access_token ] : $page_access_token_val = '';
        isset( $_POST[ $page_id ] ) ? $page_id_val = $_POST[ $page_id ] : $page_id_val = '';
        isset( $_POST[ $cff_page_type ] ) ? $cff_page_type_val = $_POST[ $cff_page_type ] : $cff_page_type_val = '';
        isset( $_POST[ $num_show ] ) ? $num_show_val = $_POST[ $num_show ] : $num_show_val = '';
        isset( $_POST[ $cff_load_more ] ) ? $cff_load_more_val = $_POST[ $cff_load_more ] : $cff_load_more_val = '';
        isset( $_POST[ $cff_post_limit ] ) ? $cff_post_limit_val = $_POST[ $cff_post_limit ] : $cff_post_limit_val = '';
        isset( $_POST[ $cff_show_others ] ) ? $cff_show_others_val = $_POST[ $cff_show_others ] : $cff_show_others_val = '';
        isset( $_POST[ $cff_cache_time ] ) ? $cff_cache_time_val = $_POST[ $cff_cache_time ] : $cff_cache_time_val = '';
        isset( $_POST[ $cff_cache_time_unit ] ) ? $cff_cache_time_unit_val = $_POST[ $cff_cache_time_unit ] : $cff_cache_time_unit_val = '';
        isset( $_POST[ $cff_locale ] ) ? $cff_locale_val = $_POST[ $cff_locale ] : $cff_locale_val = '';
        if (isset($_POST[ 'cff_timezone' ]) ) $cff_timezone = $_POST[ 'cff_timezone' ];
        isset( $_POST[ $cff_cache_cron_time ] ) ? $cff_cache_cron_time_val = $_POST[ $cff_cache_cron_time ] : $cff_cache_cron_time_val = '';
        isset( $_POST[ $cff_cache_cron_am_pm ] ) ? $cff_cache_cron_am_pm_val = $_POST[ $cff_cache_cron_am_pm ] : $cff_cache_cron_am_pm_val = '';
        isset( $_POST[ $cff_cache_cron_interval ] ) ? $cff_cache_cron_interval_val = $_POST[ $cff_cache_cron_interval ] : $cff_cache_cron_interval_val = '';
        if (isset($_POST[ 'cff_caching_type' ]) ) $cff_caching_type_val = $_POST[ 'cff_caching_type' ];

        //Extensions
        isset( $_POST[ $cff_date_from ] ) ? $cff_date_from_val = $_POST[ $cff_date_from ] : $cff_date_from_val = '';
        isset( $_POST[ $cff_date_until ] ) ? $cff_date_until_val = $_POST[ $cff_date_until ] : $cff_date_until_val = '';
        isset( $_POST[ $cff_featured_post_id ] ) ? $cff_featured_post_id_val = $_POST[ $cff_featured_post_id ] : $cff_featured_post_id_val = '';
        isset( $_POST[ $cff_lightbox ] ) ? $cff_lightbox_val = $_POST[ $cff_lightbox ] : $cff_lightbox_val = '';

        // Save the posted value in the database
        update_option( $show_access_token, true );
        update_option( $access_token, $access_token_val );
        update_option( $page_access_token, $page_access_token_val );
        update_option( $page_id, $page_id_val );
        update_option( $cff_page_type, $cff_page_type_val );
        update_option( $num_show, $num_show_val );
        update_option( $cff_load_more, $cff_load_more_val );
        update_option( $cff_post_limit, $cff_post_limit_val );
        update_option( $cff_show_others, $cff_show_others_val );
        update_option( $cff_cache_time, $cff_cache_time_val );
        update_option( $cff_cache_time_unit, $cff_cache_time_unit_val );
        update_option( $cff_locale, $cff_locale_val );
        update_option( $cff_cache_cron_time, $cff_cache_cron_time_val );
        update_option( $cff_cache_cron_am_pm, $cff_cache_cron_am_pm_val );
        update_option( $cff_cache_cron_interval, $cff_cache_cron_interval_val );
        update_option( $cff_caching_type, $cff_caching_type_val );

        $options[ 'cff_timezone' ] = $cff_timezone;
        $options[ 'cff_load_more' ] = $cff_load_more;
        update_option( 'cff_style_settings', $options );

        //Extensions
        update_option( $cff_date_from, $cff_date_from_val );
        update_option( $cff_date_until, $cff_date_until_val );
        update_option( $cff_featured_post_id, $cff_featured_post_id_val );
        update_option( $cff_lightbox, $cff_lightbox_val );

        //Delete ALL transients
        cff_delete_cache();


        //Get $cff_cron
        $options = get_option('cff_style_settings');
        isset( $options[ 'cff_cron' ] ) ? $cff_cron = $options[ 'cff_cron' ] : $cff_cron = false;

        //Clear the existing cron event
        wp_clear_scheduled_hook('cff_cache_cron');

        //Schedule the cron event if enabled
        if( $cff_caching_type_val == "background" ){

            //Remove the 'force cache to clear' cron job so that it doesn't interfere with this cron
            wp_clear_scheduled_hook('cff_cron_job');

            switch ($cff_cache_cron_interval_val) {
                case "30mins":
                    // $cff_cron_schedule = '30mins';
                    $cff_cron_schedule = 'hourly'; //Temporarily increase 30 mins to be 1 hour
                    break;
                case "1hour":
                    $cff_cron_schedule = 'hourly';
                    break;
                case "12hours":
                    $cff_cron_schedule = 'twicedaily';
                    break;
                default:
                    $cff_cron_schedule = 'daily';
            }

            //If the 30mins or 1hour are selected then use the current time and set it to start at the next 30mins/hour
            $cff_cache_cron_time_unix = strtotime( $cff_cache_cron_time_val . $cff_cache_cron_am_pm_val . ' ' . $cff_timezone );
            if( $cff_cache_cron_interval_val == '30mins' || $cff_cache_cron_interval_val == '1hour' ) $cff_cache_cron_time_unix = time();

            wp_schedule_event($cff_cache_cron_time_unix, $cff_cron_schedule, 'cff_cache_cron');

        //If the caching is set to page and the "force cache to clear" setting is enabled then re set the cron job, as it's cleared when switching to background cache
        } else if( $cff_caching_type_val == "page" && $cff_cron == "yes" ){

            //Clear the existing cron event
            wp_clear_scheduled_hook('cff_cron_job');

            $cff_cache_time = get_option( 'cff_cache_time' );
            $cff_cache_time_unit = get_option( 'cff_cache_time_unit' );

            //Set the event schedule based on what the caching time is set to
            $cff_cron_schedule = 'hourly';
            if( $cff_cache_time_unit == 'hours' && $cff_cache_time > 5 ) $cff_cron_schedule = 'twicedaily';
            if( $cff_cache_time_unit == 'days' ) $cff_cron_schedule = 'daily';

            wp_schedule_event(time(), $cff_cron_schedule, 'cff_cron_job');

        }


    // Put an settings updated message on the screen 
    ?>
    <div class="updated"><p><strong><?php _e('Settings saved.', 'custom-facebook-feed' ); ?></strong></p></div>
    <?php } ?>
 
    <div id="cff-admin" class="wrap">
        <div id="header">
            <h2><?php _e('Custom Facebook Feed Settings'); ?></h2>
        </div>

        <?php cff_expiration_notice(); ?>

        <?php
        $cff_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'configuration';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=cff-top&amp;tab=configuration" class="nav-tab <?php echo $cff_active_tab == 'configuration' ? 'nav-tab-active' : ''; ?>"><?php _e('Configuration'); ?></a>
            <a href="?page=cff-style" class="nav-tab"><?php _e('Customize'); ?></a>
            <a href="?page=cff-top&amp;tab=license" class="nav-tab <?php echo $cff_active_tab == 'license' ? 'nav-tab-active' : ''; ?>"><?php _e('License'); ?></a>
            <a href="?page=cff-top&amp;tab=support" class="nav-tab <?php echo $cff_active_tab == 'support' ? 'nav-tab-active' : ''; ?>"><?php _e('Support'); ?></a>
        </h2>

        <?php if( $cff_active_tab == 'configuration' ) { //Start Configuration tab ?>

        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <br />
            <h3><?php _e('Configuration'); ?></h3>

            <div id="cff_fb_login_modal">
                <div class="cff_modal_box">

                    <p>Log into your Facebook account using the button below and approve the plugin to connect your account.</p>


                    <div class="cff-login-options">
                        <label for="cff_login_type">Would you like to display a Facebook Page or Group?</label>
                        <select id="cff_login_type">
                            <option value="page">Facebook Page</option>
                            <option value="group">Facebook Group</option>
                        </select>

                        <p>
                            <a href="javascript:void(0);" id="cff_admin_cancel_btn" class="cff-admin-cancel-btn">Cancel</a>

                            <?php
                            $admin_url_state = admin_url('admin.php?page=cff-top');
                            //If the admin_url isn't returned correctly then use a fallback
                            if( $admin_url_state == '/wp-admin/admin.php?page=cff-top' || $admin_url_state == '/wp-admin/admin.php?page=cff-top&tab=configuration' ){
                                $admin_url_state = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            }
                            ?>
                            <a href="https://api.smashballoon.com/facebook-login.php?state=<?php echo $admin_url_state; ?>" class="cff_admin_btn" id="cff_page_app"><i class="fa fa-facebook-square"></i> <?php _e( 'Continue', 'custom-facebook-feed' ); ?></a>

                            <a href="https://api.smashballoon.com/facebook-group-login.php?state=<?php echo $admin_url_state; ?>" class="cff_admin_btn" id="cff_group_app"><i class="fa fa-facebook-square"></i> <?php _e( 'Continue', 'custom-facebook-feed' ); ?></a>

                        </p>
                    </div>

                    <p style="font-size: 11px; margin-top: 25px;"><b>Please note:</b> this does not give us permission to manage your Facebook pages or groups, it simply allows the plugin to see a list that you manage and retrieve an Access Token.</p>

                </div>
            </div>

            <a href="JavaScript:void(0);" class="cff_admin_btn" id="cff_fb_login"><i class="fa fa-facebook-square"></i> <?php _e( 'Log in and get my Access Token', 'custom-facebook-feed' ); ?></a>

            <?php
            if( isset($_GET['access_token']) && isset($_GET['final_response']) ){

                if( $_GET['final_response'] == 'true' ){

                    $access_token = $_GET['access_token'];
                    $cff_is_groups = false;
                    $pages_data_arr = '';
                    $groups_data_arr = '';

                    if( isset($_GET['group']) ){
                        //Get Groups

                        $cff_is_groups = true;
                        $groups_data_arr = '';

                        //Extend the user token by making a call to /me/accounts. User must be an admin of a page for this to work as won't work if the response is empty.
                        $url = 'https://graph.facebook.com/me/accounts?limit=500&access_token='.$access_token;

                        $accounts_data = cff_fetchUrl($url);
                        $accounts_data_arr = json_decode($accounts_data);
                        $cff_token_expiration = 'never';
                        if( empty($accounts_data_arr->data) ){
                            $cff_token_expiration = '60 days';
                        }

                        //Get User ID
                        $user_url = 'https://graph.facebook.com/me?fields=id&access_token='.$access_token;
                        $user_id_data = cff_fetchUrl($user_url);

                        if( !empty($user_id_data) ){
                            $user_id_data_arr = json_decode($user_id_data);
                            $user_id = $user_id_data_arr->id;

                            //Get groups they're admin of
                            $groups_admin_url = 'https://graph.facebook.com/'.$user_id.'/groups?admin_only=true&fields=name,id,picture&access_token='.$access_token;
                            $groups_admin_data = cff_fetchUrl($groups_admin_url);
                            $groups_admin_data_arr = json_decode($groups_admin_data);

                            //Get member groups
                            $groups_url = 'https://graph.facebook.com/'.$user_id.'/groups?admin_only=false&fields=name,id,picture&access_token='.$access_token;
                            $groups_data = cff_fetchUrl($groups_url);
                            $groups_data_arr = json_decode($groups_data);

                            // $pages_data_arr = $groups_data_arr;
                        }
                    } else {
                        //Get Pages

                        $url = 'https://graph.facebook.com/me/accounts?limit=500&access_token='.$access_token;
                        $pages_data = cff_fetchUrl($url);
                        $pages_data_arr = json_decode($pages_data);

                        if( empty($pages_data_arr->data) ){
                        //If they don't manage any pages then just use the user token instead
                        ?>
                            <script type='text/javascript'>
                            jQuery(document).ready(function($) {
                                $('#cff_access_token').val('<?php echo $access_token ?>').addClass('cff-success');
                                //Check the own access token setting so it reveals token field
                                if( $('#cff_show_access_token:checked').length < 1 ){
                                    $("#cff_show_access_token").trigger("change").prop( "checked", true );
                                }
                            });
                            </script>
                        <?php
                        }

                    }


                    if( !empty($pages_data_arr->data) || $cff_is_groups ){
                    //Show the pages they manage
                        echo '<div id="cff_fb_login_modal" class="cff_modal_tokens cffnomodal">';
                        echo '<div class="cff_modal_box">';
                        echo '<div class="cff-managed-pages">';

                        if( $cff_is_groups ){
                            //GROUPS

                            if( empty($groups_data_arr->data) && empty($groups_admin_data_arr->data) ){
                                echo '<h3>No Groups Returned</h3>';
                                echo "<p>Facebook has not returned any groups for your user. It is only possible to display a feed from a group which you are either an admin or a member. Please note, if you are not an admin of the group then it is required that an admin add our app in the group settings in order to display a feed.</p><p>Please either create or join a Facebook group and then follow the directions when connecting your account on this page.</p>";
                                echo '<a href="JavaScript:void(0);" class="button button-primary" id="cff-close-modal-primary-button">Close</a>';
                            } else {

                                echo '<div class="cff-groups-list">';
                                    echo '<p style="margin-top: 0;"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 15px; margin: 0 8px 0 2px;"></i>Select a Facebook group below to get an Access Token.</p>';

                                    echo '<div class="cff-pages-wrap">';
                                    //Admin groups
                                    foreach ( $groups_admin_data_arr->data as $page => $group_data ) {
                                        echo '<div class="cff-managed-page cff-group-admin';
                                        if( $group_data->id == $page_id_val ) echo ' cff-page-selected';
                                        echo '" data-token="'.$access_token.'" data-page-id="'.$group_data->id.'" id="cff_'.$group_data->id.'">';
                                        echo '<p>';
                                        if( isset( $group_data->picture->data->url ) ) echo '<img class="cff-page-avatar" border="0" height="50" width="50" src="'.$group_data->picture->data->url.'">';
                                        echo '<b class="cff-page-info-name">'.$group_data->name.'</b><span class="cff-page-info">(Group ID: '.$group_data->id.')</span></p>';
                                        echo '<div class="cff-group-admin-icon"><i class="fa fa-user" aria-hidden="true"></i> Admin</div>';
                                        echo '</div>';
                                    }
                                    //Member groups
                                    foreach ( $groups_data_arr->data as $page => $group_data ) {
                                        echo '<div class="cff-managed-page';
                                        if( $group_data->id == $page_id_val ) echo ' cff-page-selected';
                                        echo '" data-token="'.$access_token.'" data-page-id="'.$group_data->id.'" id="cff_'.$group_data->id.'">';
                                        echo '<p>';
                                        if( isset( $group_data->picture->data->url ) ) echo '<img class="cff-page-avatar" border="0" height="50" width="50" src="'.$group_data->picture->data->url.'">';
                                        echo '<b class="cff-page-info-name">'.$group_data->name.'</b><span class="cff-page-info">(Group ID: '.$group_data->id.')</span></p>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                    echo '<a href="JavaScript:void(0);" class="button button-primary cff-group-btn" id="cff-insert-token" disabled="disabled">Use token for this Group</a>';
                                    if( $cff_token_expiration == "60 days" ) echo '<div id="cff_token_expiration_note" class="cff-error"><b>Important:</b> This token will expire in 60 days.<br /><a href="https://smashballoon.com/extending-a-group-access-token-so-it-never-expires/" target="_blank">Extend token so it never expires</a></div>';
                                echo '</div>';

                                echo '<div id="cff-group-installation">';
                                    echo '<h3>Important</h3>';

                                    echo '<div id="cff-group-admin-directions">';
                                        echo '<p>To display a feed from your group you need to add our app in your Facebook group settings:</p>';
                                        echo '<ul>';
                                        echo '<li><b>1)</b> Go to your group settings page by clicking <a id="cff-group-edit" href="https://www.facebook.com/groups/" target="_blank">here<i class="fa fa-external-link" aria-hidden="true" style="font-size: 13px; position: relative; top: 2px; margin-left: 5px;"></i></a></li>';
                                        echo '<li><b>2)</b> In the "Apps" section click "Add Apps".</li>';
                                        echo '<li><b>3)</b> Search for "Smash Balloon" and select our app (<a id="cff-group-app-tooltip">screenshot</a>).<img id="cff-group-app-screenshot" src="'. plugins_url( "img/group-app.png" , __FILE__ ) .'" alt="Thumbnail Layout" /></li>';
                                        echo '<li><b>4</b>) Click "Add".</li>';
                                        echo '</ul>';

                                        echo '<p style="margin-bottom: 10px;">You can now use the plugin to display a feed from your group.</p>';
                                    echo '</div>';

                                    echo '<div id="cff-group-member-directions">';
                                        echo '<p>To display a feed from this group an admin needs to first add our app in the group settings. Please ask an admin to follow the directions <a href="https://smashballoon.com/adding-our-app-to-a-facebook-group/" target="_blank">here</a> to add our app.</p>';
                                        echo '<p>Once this is done you will then be able to display a feed from this group.</p>';
                                    echo '</div>';

                                    echo '<a href="JavaScript:void(0);" class="button button-primary" id="cff-close-modal-primary-button">Done</a>';
                                    echo '<a href="https://smashballoon.com/display-facebook-group-feed/" target="_blank" class="button button-secondary"><i class="fa fa-life-ring"></i> Help</a>';
                                echo '</div>';

                            }

                        } else {
                            //PAGES

                            echo '<p style="margin-top: 0;"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 15px; margin: 0 8px 0 2px;"></i>Select a Facebook page below to get an Access Token.</p>';
                            echo '<p class="cff-tokens-note">Note: This Access Token will allow you to display posts from <b style="font-weight: 900;">any</b> public Facebook page, not just the one selected.</p>';

                            echo '<div class="cff-pages-wrap">';
                            foreach ( $pages_data_arr->data as $page => $page_data ) {
                                echo '<div class="cff-managed-page ';
                                if( $page_data->id == $page_id_val ) echo 'cff-page-selected';
                                echo '" data-token="'.$page_data->access_token.'" data-page-id="'.$page_data->id.'">';
                                echo '<p><img class="cff-page-avatar" border="0" height="50" width="50" src="https://graph.facebook.com/'.$page_data->id.'/picture"><b class="cff-page-info-name">'.$page_data->name.'</b><span class="cff-page-info">(Page ID: '.$page_data->id.')</span></p>';
                                echo '</div>';
                            }
                            echo '</div>';

                            $cff_use_token_text = 'Use token for this page';
                            if( $cff_reviews_active ) $cff_use_token_text = 'Use for Regular Feeds';
                            echo '<a href="JavaScript:void(0);" id="cff-insert-token" class="button button-primary" disabled="disabled">'.$cff_use_token_text.'</a>';

                            if( $cff_reviews_active ){
                                echo '<a href="JavaScript:void(0);" class="button button-secondary cff-insert-reviews-token" disabled="disabled">Use for Reviews Feed</a>';
                                echo '<a href="JavaScript:void(0);" class="button button-secondary cff-insert-both-tokens" disabled="disabled">Use for both</a>';
                            }

                        }

                        echo '</div>';
                        echo '<a href="JavaScript:void(0);" class="cff-modal-close"><i class="fa fa-times"></i></a>';
                        echo '</div>';
                        echo '</div>';

                        echo '<a href="JavaScript:void(0);" class="cff_admin_btn" id="cff_fb_show_tokens"><i class="fa fa-th-list" aria-hidden="true" style="font-size: 14px; margin-right: 8px;"></i>';
                        $cff_is_groups ? _e( "Show Available Groups", "custom-facebook-feed" ) : _e( "Show Available Pages", "custom-facebook-feed" );
                        echo '</a>';

                    }

                }
            }
            ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row">
                            <label>
                            <?php if ( $cff_ext_multifeed_active ){ ?>
                            <?php _e('Facebook IDs'); ?><br /><i style="color: #666; font-size: 11px;"><?php _e('Separate multiple IDs with commas</i>'); ?></label><code class="cff_shortcode"> id
                        Eg: id="nba,cnn,nfl"</code></th>
                            <?php } else { ?>
                            <?php _e('Facebook ID<br /><i style="font-weight: normal; font-size: 12px;">ID of your Facebook Page or Group</i>'); ?></label><code class="cff_shortcode"> id
                        Eg: id="YOUR_PAGE_OR_GROUP_ID"</code></th>
                            <?php } ?>
                        <td>

                            <?php if ( $cff_ext_multifeed_active ){ ?>
                            <textarea name="cff_page_id" id="cff_page_id" style="width: 390px;" rows="3" /><?php esc_attr_e( $page_id_val ); ?></textarea>
                            <?php } else { ?>
                            <input name="cff_page_id" id="cff_page_id" type="text" value="<?php esc_attr_e( $page_id_val ); ?>" size="45" />
                            <?php } ?>

                            &nbsp;<a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What's my Facebook ID?"); ?></a>
                            <br /><i style="color: #666; font-size: 11px;"><?php _e("Eg: 1234567890 or smashballoon"); ?></i>
                            <div class="cff-tooltip cff-more-info">
                                <ul>
                                    <li><?php _e('<b>Facebook Page</b><br />
                                        You can find the ID of your Facebook <b>Page</b> from the URL. In each URL format, the ID is highlighted below:<br /><br />
                                    URL Format 1: <code>https://www.facebook.com/<span class="cff-highlight">your_page_name</span></code>
                                    <br />
                                    URL Format 2: <code>https://www.facebook.com/your_page_name-<span class="cff-highlight">1234567890</span></code>
                                    <br />
                                    URL Format 3: <code>https://www.facebook.com/pages/your_page_name/<span class="cff-highlight">1234567890</span></code>
                                    '); ?>
                                    </li>
                                    <li><?php _e('<b>Facebook Group</b><br />You can find the ID of your Facebook <b>Group</b> from the URL, like so: <code>https://www.facebook.com/groups/<span class="cff-highlight">1234567890</span></code>'); ?></li>
                                    <!-- <li><?php _e('To test that your ID is correct, you can copy and paste it into our <a href="http://smashballoondemo.com/" target="_blank">Pro demo</a>.'); ?></li> -->
                                </ul>
                            </div>
                        </td>
                    </tr>
                    
                    <?php //if ( $cff_featured_post_active ) echo cff_featured_post_options($cff_featured_post_id_val); ?>

                    <tr valign="top">
                        <th scope="row" style="padding-bottom: 10px;"><label><?php _e('Facebook Access Token'); ?></label><code class="cff_shortcode"> accesstoken
                        Eg: accesstoken="ACCESS_TOKEN"</code>
                        <br /><i style="font-weight: normal; font-size: 12px; color: red;"><?php _e('Required'); ?></i></th>
                        <td>
                            <textarea name="cff_access_token" id="cff_access_token" style="min-width: 60%;"><?php esc_attr_e( $access_token_val ); ?></textarea><br /><a class="cff-tooltip-link" style="margin-left: 2px;" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("In order to connect to Facebook and get a feed, you need to use an Access Token. To get one, simply use the blue button above to log into your Facebook account. You will then receive a token that will be used to connect to Facebook's API. If you already have an Access Token then you can enter it here.", 'custom-facebook-feed'); ?></p>

                            <div class="cff-notice cff-profile-error cff-access-token">
                                <?php _e("<p>This doesn't appear to be an Access Token. To obtain an Access Token click the 'Log in and get my Access Token' button above.</p>"); ?>
                            </div>
                        </td>
                    </tr>

                    <?php if ( $cff_reviews_active ) echo cff_ext_reviews_token($page_access_token_val); ?>

                </tbody>
            </table>
            <hr />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('Settings'); ?></h3>
                    <tr valign="top" class="cff-page-type">
                        <th scope="row"><label><?php _e('Is it a page or group?'); ?></label><code class="cff_shortcode"> pagetype
                        Eg: pagetype=group</code></th>
                        <td>
                            <select name="cff_page_type" id="cff_page_type" style="width: 100px;">
                                <option value="page" <?php if($cff_page_type_val == "page") echo 'selected="selected"' ?> ><?php _e('Page'); ?></option>
                                <option value="group" <?php if($cff_page_type_val == "group") echo 'selected="selected"' ?> ><?php _e('Group'); ?></option>
                                <option value="profile" <?php if($cff_page_type_val == "profile") echo 'selected="selected"' ?> ><?php _e('Profile'); ?></option>
                            </select>
                            <div class="cff-notice cff-profile-error cff-page-type">
                                <?php _e("<p>Due to Facebook's privacy policy you're not able to display posts from a personal profile, only from a public Facebook Page.</p><p>If you're using a profile to represent a business, organization, product, public figure or the like, then Facebook recommends <a href='http://www.facebook.com/help/175644189234902/' target='_blank'>converting your profile to a page</a>. There are many advantages to using pages over profiles, and once you've converted then the plugin will be able to successfully retrieve and display all of your posts.</p>", 'custom-facebook-feed'); ?>
                            </div>
                        </td>
                    </tr>

                    <tr valign="top" class="cff-page-options">
                        <th scope="row"><label><?php _e('Show posts on my page by:'); ?></label><code class="cff_shortcode"> showpostsby
                        Eg: showpostsby=others</code></th>
                        <td>

                            <select name="cff_show_others" id="cff_show_others" style="width: 250px;">
                                <option value="me" <?php if($cff_show_others_val == 'me') echo 'selected="selected"' ?> ><?php _e('Only the page owner (me)'); ?></option>
                                <option value="others" <?php if($cff_show_others_val == 'others') echo 'selected="selected"' ?> ><?php _e('Page owner + other people'); ?></option>
                                <option value="onlyothers" <?php if($cff_show_others_val == 'onlyothers') echo 'selected="selected"' ?> ><?php _e('Only other people'); ?></option>
                            </select>

                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info">Applies to Facebook Pages only, not Groups.</p>
                        </td>
                    </tr>

                    <?php if ( $cff_ext_date_active ) echo cff_ext_date_options($cff_date_from_val, $cff_date_until_val); ?>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Number of posts to display'); ?></label><code class="cff_shortcode"> num
                        Eg: num=5</code></th>
                        <td>
                            <input name="cff_num_show" type="text" value="<?php esc_attr_e( $num_show_val ); ?>" size="4" />
                            <i style="color: #666; font-size: 11px;">Max 100</i> <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("Why aren't this many posts showing up?"); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("It's possible that some posts are being filtered out by the plugin. Try manually changing the 'API post limit' option below to be 10-15 higher than the amount of posts you want to display."); ?></p>
                            <div style="margin: 8px 0 0 1px; font-size: 12px;" class="cff-load-more-setting">
                                <input type="checkbox" name="cff_load_more" id="cff_load_more" <?php if($cff_load_more_val == true) echo 'checked="checked"' ?> />&nbsp;<label><?php _e('Display "Load More" button'); ?></label><code class="cff_shortcode"> loadmore
                        Eg: loadmore=true</code>
                                <!-- <span style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('<a href="?page=cff-style&tab=typography#loadmore">Customize button</a>'); ?></span> -->
                            </div>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label>
                            <?php if ( $cff_ext_multifeed_active ){ ?>
                                <?php _e('Number of posts to show from each Facebook ID'); ?>
                            <?php } else { ?>
                                <?php _e('Facebook API post limit'); ?>
                            <?php } ?>
                        </label><code class="cff_shortcode"> limit
                        Eg: limit=10</code><!-- <br /><i style="font-weight: normal; font-size: 12px;"><?php _e('Multifeed only'); ?></i> --></th>
                        <td>
                            <?php if ( !$cff_ext_multifeed_active ){ ?>
                                <select name="cff_limit_setting" id="cff_limit_setting" style="width: 90px;">
                                    <option value="auto" selected="selected"><?php _e('Auto'); ?></option>
                                    <option value="manual"><?php _e('Manual'); ?></option>
                                </select>
                            <?php } ?>
                            <div id="cff_limit_manual_settings" <?php if ( $cff_ext_multifeed_active ){ echo 'class="cff-multifeed-active"'; } ?>>
                                <input name="cff_post_limit" id="cff_post_limit" type="text" value="<?php esc_attr_e( $cff_post_limit_val ); ?>" size="4" />
                                <?php if ( $cff_ext_multifeed_active ){ ?>
                                    <i style="color: #666; font-size: 11px;">Eg. 2</i>
                                <?php } else { ?>
                                    <i style="color: #666; font-size: 11px;">Eg. 10. Max 100.</i>
                                <?php } ?>
                            </div>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("The 'limit' is the number of posts retrieved from the Facebook API. Most users won't need to manually adjust this setting as by default the plugin automatically retrieves a few more posts from the Facebook API than you need, as some posts may be filtered out.<br /><br />

                                <b>Auto</b><br />
                                Allow the plugin to automatically decide how many posts to retrieve from Facebook's API.<br /><br />

                                <b>Manual</b><br />
                                Manually set how many posts to retrieve from Facebook's API.<br /><b>Note:</b> If you choose to retrieve a high number of posts then it will take longer for Facebook to return the posts when the plugin checks for new ones.
                                <br /><br />

                                <b>Multifeed extension</b><br />If you're using the Multifeed extension then the post limit is the number of posts you retrieve from each Facebook page. For example, you have 3 Facebook pages and set the limit to be 5 then 15 posts in total will be retrievd from Facebook - 5 for each page."); ?></p>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Check for new posts'); ?></th>
                        <td>

                                <div class="cff-row">
                                    <input type="radio" name="cff_caching_type" id="cff_caching_type_page" value="page" <?php if($cff_caching_type_val == "page") echo "checked"; ?> />
                                    <label class="cff_radio_label" for="cff_caching_type_page"><?php _e('When the page loads'); ?></label>
                                    <a class="cff-tooltip-link" href="JavaScript:void(0);" style="position: relative; top: 2px;"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                    <p class="cff-tooltip cff-more-info"><?php _e("Your Facebook posts and comments data is temporarily cached by the plugin in your WordPress database. There are two ways that you can set the plugin to check for new data:<br /><br />
                                        <b>1. When the page loads</b><br />Selecting this option means that when the cache expires then the plugin will check Facebook for new posts the next time that the feed is loaded. You can choose how long this data should be cached for. If you set the time to 60 minutes then the plugin will clear the cached data after that length of time, and the next time the page is viewed it will check for new data. <b>Tip:</b> If you're experiencing an issue with the plugin not updating automatically then try enabling the setting labeled <b>'Force cache to clear on interval'</b> which is located on the 'Misc' tab on the 'Customize' page.
                                        <br /><br />
                                        <b>2. In the background</b><br />Selecting this option means that the plugin will check for new data in the background so that the feed is updated behind the scenes. You can select at what time and how often the plugin should check for new data using the settings below. <b>Please note</b> that the plugin will initially check for data from Facebook when the page first loads, but then after that will check in the background on the schedule selected - unless the cache is cleared."); ?></p>
                                </div>
                                <div class="cff-row cff-caching-page-options">
                                    <?php _e('Every: '); ?>
                                    <input name="cff_cache_time" type="text" value="<?php esc_attr_e( $cff_cache_time_val ); ?>" size="4" />
                                    <select name="cff_cache_time_unit" style="width: 120px;">
                                        <option value="minutes" <?php if($cff_cache_time_unit_val == "minutes") echo 'selected="selected"' ?> ><?php _e('Minutes'); ?></option>
                                        <option value="hours" <?php if($cff_cache_time_unit_val == "hours") echo 'selected="selected"' ?> ><?php _e('Hours'); ?></option>
                                        <option value="days" <?php if($cff_cache_time_unit_val == "days") echo 'selected="selected"' ?> ><?php _e('Days'); ?></option>
                                    </select>
                                </div>

                                <div class="cff-row">
                                    <input type="radio" name="cff_caching_type" id="cff_caching_type_cron" value="background" <?php if($cff_caching_type_val == "background") echo "checked"; ?> />
                                    <label class="cff_radio_label" for="cff_caching_type_cron"><?php _e('In the background'); ?></label>
                                </div>
                                <div class="cff-row cff-caching-cron-options">
                                    
                                    <select name="cff_cache_cron_interval" id="cff_cache_cron_interval">
                                        <option value="30mins" <?php if($cff_cache_cron_interval_val == "30mins") echo 'selected="selected"' ?> ><?php _e('Every 30 minutes'); ?></option>
                                        <option value="1hour" <?php if($cff_cache_cron_interval_val == "1hour") echo 'selected="selected"' ?> ><?php _e('Every hour'); ?></option>
                                        <option value="12hours" <?php if($cff_cache_cron_interval_val == "12hours") echo 'selected="selected"' ?> ><?php _e('Every 12 hours'); ?></option>
                                        <option value="24hours" <?php if($cff_cache_cron_interval_val == "24hours") echo 'selected="selected"' ?> ><?php _e('Every 24 hours'); ?></option>
                                    </select>

                                    <div id="cff-caching-time-settings">
                                        <?php _e('at '); ?>

                                        <select name="cff_cache_cron_time" style="width: 80px">
                                            <option value="1" <?php if($cff_cache_cron_time_val == "1") echo 'selected="selected"' ?> ><?php _e('1:00'); ?></option>
                                            <option value="2" <?php if($cff_cache_cron_time_val == "2") echo 'selected="selected"' ?> ><?php _e('2:00'); ?></option>
                                            <option value="3" <?php if($cff_cache_cron_time_val == "3") echo 'selected="selected"' ?> ><?php _e('3:00'); ?></option>
                                            <option value="4" <?php if($cff_cache_cron_time_val == "4") echo 'selected="selected"' ?> ><?php _e('4:00'); ?></option>
                                            <option value="5" <?php if($cff_cache_cron_time_val == "5") echo 'selected="selected"' ?> ><?php _e('5:00'); ?></option>
                                            <option value="6" <?php if($cff_cache_cron_time_val == "6") echo 'selected="selected"' ?> ><?php _e('6:00'); ?></option>
                                            <option value="7" <?php if($cff_cache_cron_time_val == "7") echo 'selected="selected"' ?> ><?php _e('7:00'); ?></option>
                                            <option value="8" <?php if($cff_cache_cron_time_val == "8") echo 'selected="selected"' ?> ><?php _e('8:00'); ?></option>
                                            <option value="9" <?php if($cff_cache_cron_time_val == "9") echo 'selected="selected"' ?> ><?php _e('9:00'); ?></option>
                                            <option value="10" <?php if($cff_cache_cron_time_val == "10") echo 'selected="selected"' ?> ><?php _e('10:00'); ?></option>
                                            <option value="11" <?php if($cff_cache_cron_time_val == "11") echo 'selected="selected"' ?> ><?php _e('11:00'); ?></option>
                                            <option value="12" <?php if($cff_cache_cron_time_val == "12") echo 'selected="selected"' ?> ><?php _e('12:00'); ?></option>
                                        </select>

                                        <select name="cff_cache_cron_am_pm" style="width: 50px">
                                            <option value="am" <?php if($cff_cache_cron_am_pm_val == "am") echo 'selected="selected"' ?> ><?php _e('AM'); ?></option>
                                            <option value="pm" <?php if($cff_cache_cron_am_pm_val == "pm") echo 'selected="selected"' ?> ><?php _e('PM'); ?></option>
                                        </select>
                                    </div>

                                    <?php
                                    if ( wp_next_scheduled( 'cff_cache_cron' ) ) {
                                        //Get the timezone
                                        $cff_orig_timezone = date_default_timezone_get();
                                        $options = get_option('cff_style_settings');
                                        date_default_timezone_set( $options[ 'cff_timezone' ] );

                                        $schedule = wp_get_schedule( 'cff_cache_cron' );
                                        if( $schedule == '30mins' ) $schedule = 'every 30 minutes';
                                        if( $schedule == 'twicedaily' ) $schedule = 'every 12 hours';
                                        $cff_next_cron_event = wp_next_scheduled( 'cff_cache_cron' );
                                        echo '<p class="cff-caching-sched-notice"><span><b>Next check: ' . date('g:i a', $cff_next_cron_event) . ' (' . $schedule . ')</b> - Note: Saving the settings on this page will clear the cache and reset this schedule</span></p>';

                                        //Reset the timezone
                                        date_default_timezone_set( $cff_orig_timezone );
                                    } else {
                                        _e('<p style="font-size: 11px; color: #666;">Nothing currently scheduled</p>');
                                    }
                                    ?>

                                </div>

                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Localization'); ?></label><code class="cff_shortcode"> locale
                        Eg: locale=es_ES</code></th>
                        <td>
                            <select name="cff_locale">
                                <option value="af_ZA" <?php if($cff_locale_val == "af_ZA") echo 'selected="selected"' ?> ><?php _e('Afrikaans'); ?></option>
                                <option value="ar_AR" <?php if($cff_locale_val == "ar_AR") echo 'selected="selected"' ?> ><?php _e('Arabic'); ?></option>
                                <option value="az_AZ" <?php if($cff_locale_val == "az_AZ") echo 'selected="selected"' ?> ><?php _e('Azerbaijani'); ?></option>
                                <option value="be_BY" <?php if($cff_locale_val == "be_BY") echo 'selected="selected"' ?> ><?php _e('Belarusian'); ?></option>
                                <option value="bg_BG" <?php if($cff_locale_val == "bg_BG") echo 'selected="selected"' ?> ><?php _e('Bulgarian'); ?></option>
                                <option value="bn_IN" <?php if($cff_locale_val == "bn_IN") echo 'selected="selected"' ?> ><?php _e('Bengali'); ?></option>
                                <option value="bs_BA" <?php if($cff_locale_val == "bs_BA") echo 'selected="selected"' ?> ><?php _e('Bosnian'); ?></option>
                                <option value="ca_ES" <?php if($cff_locale_val == "ca_ES") echo 'selected="selected"' ?> ><?php _e('Catalan'); ?></option>
                                <option value="cs_CZ" <?php if($cff_locale_val == "cs_CZ") echo 'selected="selected"' ?> ><?php _e('Czech'); ?></option>
                                <option value="cy_GB" <?php if($cff_locale_val == "cy_GB") echo 'selected="selected"' ?> ><?php _e('Welsh'); ?></option>
                                <option value="da_DK" <?php if($cff_locale_val == "da_DK") echo 'selected="selected"' ?> ><?php _e('Danish'); ?></option>
                                <option value="de_DE" <?php if($cff_locale_val == "de_DE") echo 'selected="selected"' ?> ><?php _e('German'); ?></option>
                                <option value="el_GR" <?php if($cff_locale_val == "el_GR") echo 'selected="selected"' ?> ><?php _e('Greek'); ?></option>
                                <option value="en_GB" <?php if($cff_locale_val == "en_GB") echo 'selected="selected"' ?> ><?php _e('English (UK)'); ?></option>
                                <option value="en_PI" <?php if($cff_locale_val == "en_PI") echo 'selected="selected"' ?> ><?php _e('English (Pirate)'); ?></option>
                                <option value="en_US" <?php if($cff_locale_val == "en_US") echo 'selected="selected"' ?> ><?php _e('English (US)'); ?></option>
                                <option value="eo_EO" <?php if($cff_locale_val == "eo_EO") echo 'selected="selected"' ?> ><?php _e('Esperanto'); ?></option>
                                <option value="es_ES" <?php if($cff_locale_val == "es_ES") echo 'selected="selected"' ?> ><?php _e('Spanish (Spain)'); ?></option>
                                <option value="es_LA" <?php if($cff_locale_val == "es_LA") echo 'selected="selected"' ?> ><?php _e('Spanish'); ?></option>
                                <option value="et_EE" <?php if($cff_locale_val == "et_EE") echo 'selected="selected"' ?> ><?php _e('Estonian'); ?></option>
                                <option value="eu_ES" <?php if($cff_locale_val == "eu_ES") echo 'selected="selected"' ?> ><?php _e('Basque'); ?></option>
                                <option value="fa_IR" <?php if($cff_locale_val == "fa_IR") echo 'selected="selected"' ?> ><?php _e('Persian'); ?></option>
                                <option value="fb_LT" <?php if($cff_locale_val == "fb_LT") echo 'selected="selected"' ?> ><?php _e('Leet Speak'); ?></option>
                                <option value="fi_FI" <?php if($cff_locale_val == "fi_FI") echo 'selected="selected"' ?> ><?php _e('Finnish'); ?></option>
                                <option value="fo_FO" <?php if($cff_locale_val == "fo_FO") echo 'selected="selected"' ?> ><?php _e('Faroese'); ?></option>
                                <option value="fr_CA" <?php if($cff_locale_val == "fr_CA") echo 'selected="selected"' ?> ><?php _e('French (Canada)'); ?></option>
                                <option value="fr_FR" <?php if($cff_locale_val == "fr_FR") echo 'selected="selected"' ?> ><?php _e('French (France)'); ?></option>
                                <option value="fy_NL" <?php if($cff_locale_val == "fy_NL") echo 'selected="selected"' ?> ><?php _e('Frisian'); ?></option>
                                <option value="ga_IE" <?php if($cff_locale_val == "ga_IE") echo 'selected="selected"' ?> ><?php _e('Irish'); ?></option>
                                <option value="gl_ES" <?php if($cff_locale_val == "gl_ES") echo 'selected="selected"' ?> ><?php _e('Galician'); ?></option>
                                <option value="he_IL" <?php if($cff_locale_val == "he_IL") echo 'selected="selected"' ?> ><?php _e('Hebrew'); ?></option>
                                <option value="hi_IN" <?php if($cff_locale_val == "hi_IN") echo 'selected="selected"' ?> ><?php _e('Hindi'); ?></option>
                                <option value="hr_HR" <?php if($cff_locale_val == "hr_HR") echo 'selected="selected"' ?> ><?php _e('Croatian'); ?></option>
                                <option value="hu_HU" <?php if($cff_locale_val == "hu_HU") echo 'selected="selected"' ?> ><?php _e('Hungarian'); ?></option>
                                <option value="hy_AM" <?php if($cff_locale_val == "hy_AM") echo 'selected="selected"' ?> ><?php _e('Armenian'); ?></option>
                                <option value="id_ID" <?php if($cff_locale_val == "id_ID") echo 'selected="selected"' ?> ><?php _e('Indonesian'); ?></option>
                                <option value="is_IS" <?php if($cff_locale_val == "is_IS") echo 'selected="selected"' ?> ><?php _e('Icelandic'); ?></option>
                                <option value="it_IT" <?php if($cff_locale_val == "it_IT") echo 'selected="selected"' ?> ><?php _e('Italian'); ?></option>
                                <option value="ja_JP" <?php if($cff_locale_val == "ja_JP") echo 'selected="selected"' ?> ><?php _e('Japanese'); ?></option>
                                <option value="ka_GE" <?php if($cff_locale_val == "ka_GE") echo 'selected="selected"' ?> ><?php _e('Georgian'); ?></option>
                                <option value="km_KH" <?php if($cff_locale_val == "km_KH") echo 'selected="selected"' ?> ><?php _e('Khmer'); ?></option>
                                <option value="ko_KR" <?php if($cff_locale_val == "ko_KR") echo 'selected="selected"' ?> ><?php _e('Korean'); ?></option>
                                <option value="ku_TR" <?php if($cff_locale_val == "ku_TR") echo 'selected="selected"' ?> ><?php _e('Kurdish'); ?></option>
                                <option value="la_VA" <?php if($cff_locale_val == "la_VA") echo 'selected="selected"' ?> ><?php _e('Latin'); ?></option>
                                <option value="lt_LT" <?php if($cff_locale_val == "lt_LT") echo 'selected="selected"' ?> ><?php _e('Lithuanian'); ?></option>
                                <option value="lv_LV" <?php if($cff_locale_val == "lv_LV") echo 'selected="selected"' ?> ><?php _e('Latvian'); ?></option>
                                <option value="mk_MK" <?php if($cff_locale_val == "mk_MK") echo 'selected="selected"' ?> ><?php _e('Macedonian'); ?></option>
                                <option value="ml_IN" <?php if($cff_locale_val == "ml_IN") echo 'selected="selected"' ?> ><?php _e('Malayalam'); ?></option>
                                <option value="ms_MY" <?php if($cff_locale_val == "ms_MY") echo 'selected="selected"' ?> ><?php _e('Malay'); ?></option>
                                <option value="nb_NO" <?php if($cff_locale_val == "nb_NO") echo 'selected="selected"' ?> ><?php _e('Norwegian (bokmal)'); ?></option>
                                <option value="ne_NP" <?php if($cff_locale_val == "ne_NP") echo 'selected="selected"' ?> ><?php _e('Nepali'); ?></option>
                                <option value="nl_NL" <?php if($cff_locale_val == "nl_NL") echo 'selected="selected"' ?> ><?php _e('Dutch'); ?></option>
                                <option value="nn_NO" <?php if($cff_locale_val == "nn_NO") echo 'selected="selected"' ?> ><?php _e('Norwegian (nynorsk)'); ?></option>
                                <option value="pa_IN" <?php if($cff_locale_val == "pa_IN") echo 'selected="selected"' ?> ><?php _e('Punjabi'); ?></option>
                                <option value="pl_PL" <?php if($cff_locale_val == "pl_PL") echo 'selected="selected"' ?> ><?php _e('Polish'); ?></option>
                                <option value="ps_AF" <?php if($cff_locale_val == "ps_AF") echo 'selected="selected"' ?> ><?php _e('Pashto'); ?></option>
                                <option value="pt_BR" <?php if($cff_locale_val == "pt_BR") echo 'selected="selected"' ?> ><?php _e('Portuguese (Brazil)'); ?></option>
                                <option value="pt_PT" <?php if($cff_locale_val == "pt_PT") echo 'selected="selected"' ?> ><?php _e('Portuguese (Portugal)'); ?></option>
                                <option value="ro_RO" <?php if($cff_locale_val == "ro_RO") echo 'selected="selected"' ?> ><?php _e('Romanian'); ?></option>
                                <option value="ru_RU" <?php if($cff_locale_val == "ru_RU") echo 'selected="selected"' ?> ><?php _e('Russian'); ?></option>
                                <option value="sk_SK" <?php if($cff_locale_val == "sk_SK") echo 'selected="selected"' ?> ><?php _e('Slovak'); ?></option>
                                <option value="sl_SI" <?php if($cff_locale_val == "sl_SI") echo 'selected="selected"' ?> ><?php _e('Slovenian'); ?></option>
                                <option value="sq_AL" <?php if($cff_locale_val == "sq_AL") echo 'selected="selected"' ?> ><?php _e('Albanian'); ?></option>
                                <option value="sr_RS" <?php if($cff_locale_val == "sr_RS") echo 'selected="selected"' ?> ><?php _e('Serbian'); ?></option>
                                <option value="sv_SE" <?php if($cff_locale_val == "sv_SE") echo 'selected="selected"' ?> ><?php _e('Swedish'); ?></option>
                                <option value="sw_KE" <?php if($cff_locale_val == "sw_KE") echo 'selected="selected"' ?> ><?php _e('Swahili'); ?></option>
                                <option value="ta_IN" <?php if($cff_locale_val == "ta_IN") echo 'selected="selected"' ?> ><?php _e('Tamil'); ?></option>
                                <option value="te_IN" <?php if($cff_locale_val == "te_IN") echo 'selected="selected"' ?> ><?php _e('Telugu'); ?></option>
                                <option value="th_TH" <?php if($cff_locale_val == "th_TH") echo 'selected="selected"' ?> ><?php _e('Thai'); ?></option>
                                <option value="tl_PH" <?php if($cff_locale_val == "tl_PH") echo 'selected="selected"' ?> ><?php _e('Filipino'); ?></option>
                                <option value="tr_TR" <?php if($cff_locale_val == "tr_TR") echo 'selected="selected"' ?> ><?php _e('Turkish'); ?></option>
                                <option value="uk_UA" <?php if($cff_locale_val == "uk_UA") echo 'selected="selected"' ?> ><?php _e('Ukrainian'); ?></option>
                                <option value="vi_VN" <?php if($cff_locale_val == "vi_VN") echo 'selected="selected"' ?> ><?php _e('Vietnamese'); ?></option>
                                <option value="zh_CN" <?php if($cff_locale_val == "zh_CN") echo 'selected="selected"' ?> ><?php _e('Simplified Chinese (China)'); ?></option>
                                <option value="zh_HK" <?php if($cff_locale_val == "zh_HK") echo 'selected="selected"' ?> ><?php _e('Traditional Chinese (Hong Kong)'); ?></option>
                                <option value="zh_TW" <?php if($cff_locale_val == "zh_TW") echo 'selected="selected"' ?> ><?php _e('Traditional Chinese (Taiwan)'); ?></option>
                            </select>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This translates some of the text sent by Facebook, specifically, the descriptive post text (eg: Smash Balloon created an event) and the text in the 'Like Box' widget. To find out how to translate the other text in the plugin see <a href='https://smashballoon.com/cff-how-does-the-plugin-handle-text-and-language-translation/' target='_blank'>this FAQ</a>."); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="cff_timezone" class="bump-left"><?php _e('Timezone'); ?></label><code class="cff_shortcode"> timezone
                        Eg: timezone="America/New_York"
                        <a href="http://php.net/manual/en/timezones.php" target="_blank">See full list</a></code></th>
                            <td>
                                <select name="cff_timezone" style="width: 300px;">
                                    <option value="Pacific/Midway" <?php if($cff_timezone == "Pacific/Midway") echo 'selected="selected"' ?> ><?php _e('(GMT-11:00) Midway Island, Samoa'); ?></option>
                                    <option value="America/Adak" <?php if($cff_timezone == "America/Adak") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii-Aleutian'); ?></option>
                                    <option value="Etc/GMT+10" <?php if($cff_timezone == "Etc/GMT+10") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii'); ?></option>
                                    <option value="Pacific/Marquesas" <?php if($cff_timezone == "Pacific/Marquesas") echo 'selected="selected"' ?> ><?php _e('(GMT-09:30) Marquesas Islands'); ?></option>
                                    <option value="Pacific/Gambier" <?php if($cff_timezone == "Pacific/Gambier") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Gambier Islands'); ?></option>
                                    <option value="America/Anchorage" <?php if($cff_timezone == "America/Anchorage") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Alaska'); ?></option>
                                    <option value="America/Ensenada" <?php if($cff_timezone == "America/Ensenada") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Tijuana, Baja California'); ?></option>
                                    <option value="Etc/GMT+8" <?php if($cff_timezone == "Etc/GMT+8") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pitcairn Islands'); ?></option>
                                    <option value="America/Los_Angeles" <?php if($cff_timezone == "America/Los_Angeles") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pacific Time (US & Canada)'); ?></option>
                                    <option value="America/Denver" <?php if($cff_timezone == "America/Denver") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Mountain Time (US & Canada)'); ?></option>
                                    <option value="America/Chihuahua" <?php if($cff_timezone == "America/Chihuahua") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Chihuahua, La Paz, Mazatlan'); ?></option>
                                    <option value="America/Dawson_Creek" <?php if($cff_timezone == "America/Dawson_Creek") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Arizona'); ?></option>
                                    <option value="America/Belize" <?php if($cff_timezone == "America/Belize") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Saskatchewan, Central America'); ?></option>
                                    <option value="America/Cancun" <?php if($cff_timezone == "America/Cancun") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Guadalajara, Mexico City, Monterrey'); ?></option>
                                    <option value="Chile/EasterIsland" <?php if($cff_timezone == "Chile/EasterIsland") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Easter Island'); ?></option>
                                    <option value="America/Chicago" <?php if($cff_timezone == "America/Chicago") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Central Time (US & Canada)'); ?></option>
                                    <option value="America/New_York" <?php if($cff_timezone == "America/New_York") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Eastern Time (US & Canada)'); ?></option>
                                    <option value="America/Havana" <?php if($cff_timezone == "America/Havana") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Cuba'); ?></option>
                                    <option value="America/Bogota" <?php if($cff_timezone == "America/Bogota") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Bogota, Lima, Quito, Rio Branco'); ?></option>
                                    <option value="America/Caracas" <?php if($cff_timezone == "America/Caracas") echo 'selected="selected"' ?> ><?php _e('(GMT-04:30) Caracas'); ?></option>
                                    <option value="America/Santiago" <?php if($cff_timezone == "America/Santiago") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Santiago'); ?></option>
                                    <option value="America/La_Paz" <?php if($cff_timezone == "America/La_Paz") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) La Paz'); ?></option>
                                    <option value="Atlantic/Stanley" <?php if($cff_timezone == "Atlantic/Stanley") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Faukland Islands'); ?></option>
                                    <option value="America/Campo_Grande" <?php if($cff_timezone == "America/Campo_Grande") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Brazil'); ?></option>
                                    <option value="America/Goose_Bay" <?php if($cff_timezone == "America/Goose_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Goose Bay)'); ?></option>
                                    <option value="America/Glace_Bay" <?php if($cff_timezone == "America/Glace_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Canada)'); ?></option>
                                    <option value="America/St_Johns" <?php if($cff_timezone == "America/St_Johns") echo 'selected="selected"' ?> ><?php _e('(GMT-03:30) Newfoundland'); ?></option>
                                    <option value="America/Araguaina" <?php if($cff_timezone == "America/Araguaina") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) UTC-3'); ?></option>
                                    <option value="America/Montevideo" <?php if($cff_timezone == "America/Montevideo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Montevideo'); ?></option>
                                    <option value="America/Miquelon" <?php if($cff_timezone == "America/Miquelon") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Miquelon, St. Pierre'); ?></option>
                                    <option value="America/Godthab" <?php if($cff_timezone == "America/Godthab") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Greenland'); ?></option>
                                    <option value="America/Argentina/Buenos_Aires" <?php if($cff_timezone == "America/Argentina/Buenos_Aires") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Buenos Aires'); ?></option>
                                    <option value="America/Sao_Paulo" <?php if($cff_timezone == "America/Sao_Paulo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Brasilia'); ?></option>
                                    <option value="America/Noronha" <?php if($cff_timezone == "America/Noronha") echo 'selected="selected"' ?> ><?php _e('(GMT-02:00) Mid-Atlantic'); ?></option>
                                    <option value="Atlantic/Cape_Verde" <?php if($cff_timezone == "Atlantic/Cape_Verde") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Cape Verde Is.'); ?></option>
                                    <option value="Atlantic/Azores" <?php if($cff_timezone == "Atlantic/Azores") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Azores'); ?></option>
                                    <option value="Europe/Belfast" <?php if($cff_timezone == "Europe/Belfast") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Belfast'); ?></option>
                                    <option value="Europe/Dublin" <?php if($cff_timezone == "Europe/Dublin") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Dublin'); ?></option>
                                    <option value="Europe/Lisbon" <?php if($cff_timezone == "Europe/Lisbon") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Lisbon'); ?></option>
                                    <option value="Europe/London" <?php if($cff_timezone == "Europe/London") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : London'); ?></option>
                                    <option value="Africa/Abidjan" <?php if($cff_timezone == "Africa/Abidjan") echo 'selected="selected"' ?> ><?php _e('(GMT) Monrovia, Reykjavik'); ?></option>
                                    <option value="Europe/Amsterdam" <?php if($cff_timezone == "Europe/Amsterdam") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna'); ?></option>
                                    <option value="Europe/Belgrade" <?php if($cff_timezone == "Europe/Belgrade") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague'); ?></option>
                                    <option value="Europe/Brussels" <?php if($cff_timezone == "Europe/Brussels") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Brussels, Copenhagen, Madrid, Paris'); ?></option>
                                    <option value="Africa/Algiers" <?php if($cff_timezone == "Africa/Algiers") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) West Central Africa'); ?></option>
                                    <option value="Africa/Windhoek" <?php if($cff_timezone == "Africa/Windhoek") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Windhoek'); ?></option>
                                    <option value="Asia/Beirut" <?php if($cff_timezone == "Asia/Beirut") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Beirut'); ?></option>
                                    <option value="Africa/Cairo" <?php if($cff_timezone == "Africa/Cairo") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Cairo'); ?></option>
                                    <option value="Asia/Gaza" <?php if($cff_timezone == "Asia/Gaza") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Gaza'); ?></option>
                                    <option value="Africa/Blantyre" <?php if($cff_timezone == "Africa/Blantyre") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Harare, Pretoria'); ?></option>
                                    <option value="Asia/Jerusalem" <?php if($cff_timezone == "Asia/Jerusalem") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Jerusalem'); ?></option>
                                    <option value="Europe/Helsinki" <?php if($cff_timezone == "Europe/Helsinki") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Helsinki'); ?></option>
                                    <option value="Europe/Minsk" <?php if($cff_timezone == "Europe/Minsk") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Minsk'); ?></option>
                                    <option value="Asia/Damascus" <?php if($cff_timezone == "Asia/Damascus") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Syria'); ?></option>
                                    <option value="Europe/Moscow" <?php if($cff_timezone == "Europe/Moscow") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Moscow, St. Petersburg, Volgograd'); ?></option>
                                    <option value="Africa/Addis_Ababa" <?php if($cff_timezone == "Africa/Addis_Ababa") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Nairobi'); ?></option>
                                    <option value="Asia/Tehran" <?php if($cff_timezone == "Asia/Tehran") echo 'selected="selected"' ?> ><?php _e('(GMT+03:30) Tehran'); ?></option>
                                    <option value="Asia/Dubai" <?php if($cff_timezone == "Asia/Dubai") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Abu Dhabi, Muscat'); ?></option>
                                    <option value="Asia/Yerevan" <?php if($cff_timezone == "Asia/Yerevan") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Yerevan'); ?></option>
                                    <option value="Asia/Kabul" <?php if($cff_timezone == "Asia/Kabul") echo 'selected="selected"' ?> ><?php _e('(GMT+04:30) Kabul'); ?></option>
                                    <option value="Asia/Yekaterinburg" <?php if($cff_timezone == "Asia/Yekaterinburg") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Ekaterinburg'); ?></option>
                                    <option value="Asia/Tashkent" <?php if($cff_timezone == "Asia/Tashkent") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Tashkent'); ?></option>
                                    <option value="Asia/Kolkata" <?php if($cff_timezone == "Asia/Kolkata") echo 'selected="selected"' ?> ><?php _e('(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi'); ?></option>
                                    <option value="Asia/Katmandu" <?php if($cff_timezone == "Asia/Katmandu") echo 'selected="selected"' ?> ><?php _e('(GMT+05:45) Kathmandu'); ?></option>
                                    <option value="Asia/Dhaka" <?php if($cff_timezone == "Asia/Dhaka") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Astana, Dhaka'); ?></option>
                                    <option value="Asia/Novosibirsk" <?php if($cff_timezone == "Asia/Novosibirsk") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Novosibirsk'); ?></option>
                                    <option value="Asia/Rangoon" <?php if($cff_timezone == "Asia/Rangoon") echo 'selected="selected"' ?> ><?php _e('(GMT+06:30) Yangon (Rangoon)'); ?></option>
                                    <option value="Asia/Bangkok" <?php if($cff_timezone == "Asia/Bangkok") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Bangkok, Hanoi, Jakarta'); ?></option>
                                    <option value="Asia/Krasnoyarsk" <?php if($cff_timezone == "Asia/Krasnoyarsk") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Krasnoyarsk'); ?></option>
                                    <option value="Asia/Hong_Kong" <?php if($cff_timezone == "Asia/Hong_Kong") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi'); ?></option>
                                    <option value="Asia/Irkutsk" <?php if($cff_timezone == "Asia/Irkutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Irkutsk, Ulaan Bataar'); ?></option>
                                    <option value="Australia/Perth" <?php if($cff_timezone == "Australia/Perth") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Perth'); ?></option>
                                    <option value="Australia/Eucla" <?php if($cff_timezone == "Australia/Eucla") echo 'selected="selected"' ?> ><?php _e('(GMT+08:45) Eucla'); ?></option>
                                    <option value="Asia/Tokyo" <?php if($cff_timezone == "Asia/Tokyo") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Osaka, Sapporo, Tokyo'); ?></option>
                                    <option value="Asia/Seoul" <?php if($cff_timezone == "Asia/Seoul") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Seoul'); ?></option>
                                    <option value="Asia/Yakutsk" <?php if($cff_timezone == "Asia/Yakutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Yakutsk'); ?></option>
                                    <option value="Australia/Adelaide" <?php if($cff_timezone == "Australia/Adelaide") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Adelaide'); ?></option>
                                    <option value="Australia/Darwin" <?php if($cff_timezone == "Australia/Darwin") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Darwin'); ?></option>
                                    <option value="Australia/Brisbane" <?php if($cff_timezone == "Australia/Brisbane") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Brisbane'); ?></option>
                                    <option value="Australia/Hobart" <?php if($cff_timezone == "Australia/Hobart") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Sydney'); ?></option>
                                    <option value="Asia/Vladivostok" <?php if($cff_timezone == "Asia/Vladivostok") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Vladivostok'); ?></option>
                                    <option value="Australia/Lord_Howe" <?php if($cff_timezone == "Australia/Lord_Howe") echo 'selected="selected"' ?> ><?php _e('(GMT+10:30) Lord Howe Island'); ?></option>
                                    <option value="Etc/GMT-11" <?php if($cff_timezone == "Etc/GMT-11") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Solomon Is., New Caledonia'); ?></option>
                                    <option value="Asia/Magadan" <?php if($cff_timezone == "Asia/Magadan") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Magadan'); ?></option>
                                    <option value="Pacific/Norfolk" <?php if($cff_timezone == "Pacific/Norfolk") echo 'selected="selected"' ?> ><?php _e('(GMT+11:30) Norfolk Island'); ?></option>
                                    <option value="Asia/Anadyr" <?php if($cff_timezone == "Asia/Anadyr") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Anadyr, Kamchatka'); ?></option>
                                    <option value="Pacific/Auckland" <?php if($cff_timezone == "Pacific/Auckland") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Auckland, Wellington'); ?></option>
                                    <option value="Etc/GMT-12" <?php if($cff_timezone == "Etc/GMT-12") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Fiji, Kamchatka, Marshall Is.'); ?></option>
                                    <option value="Pacific/Chatham" <?php if($cff_timezone == "Pacific/Chatham") echo 'selected="selected"' ?> ><?php _e('(GMT+12:45) Chatham Islands'); ?></option>
                                    <option value="Pacific/Tongatapu" <?php if($cff_timezone == "Pacific/Tongatapu") echo 'selected="selected"' ?> ><?php _e('(GMT+13:00) Nuku\'alofa'); ?></option>
                                    <option value="Pacific/Kiritimati" <?php if($cff_timezone == "Pacific/Kiritimati") echo 'selected="selected"' ?> ><?php _e('(GMT+14:00) Kiritimati'); ?></option>
                                </select>
                            </td>
                        </tr>

                    <?php if ( $cff_lightbox_active ) echo cff_lightbox_options($cff_lightbox_val); ?>

                </tbody>
            </table>

            <div class="cff-save-settings-btn">
                <?php submit_button('Save Settings & Clear Cache'); ?>

                <!-- &nbsp; <input type="checkbox" checked="checked" />&nbsp;<?php _e('Clear feed cache'); ?> -->

                <a class="cff-tooltip-link" href="JavaScript:void(0);">Why is the cache cleared?</a>

                <p class="cff-tooltip cff-more-info"><?php _e("As the settings on this page directly affect the request made to Facebook to get data, then when these settings are changed the plugin cache is cleared in order for the plugin to check Facebook for data again using these new settings. The plugin will check Facebook for data the next time the page that the feed is on is loaded."); ?></p>
            </div>
        </form>



        <div class="cff_quickstart">
            <h3><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; Display your feed</h3>
            <p>Copy and paste this shortcode directly into the page, post or widget where you'd like to display the feed:        <input type="text" value="[custom-facebook-feed]" size="22" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p>
            <p>Find out how to display <a href="https://smashballoon.com/using-shortcode-options-customize-facebook-feeds/" target="_blank"><b>multiple feeds</b></a>.</p>
        </div>

        <hr />

        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="https://smashballoon.com/custom-facebook-feed/docs/wordpress" target="_blank">setup directions</a>'); ?></p>
        <p class="ctf-footnote dashicons-before dashicons-admin-plugins"> Check out our free plugins for <a href="https://wordpress.org/plugins/instagram-feed/" target="_blank">Instagram</a> and <a href="https://wordpress.org/plugins/custom-twitter-feeds/" target="_blank">Twitter</a>.</p>

        <hr />
        <h3><?php _e('Like the plugin? Help spread the word!'); ?></h3>

        <button id="cff-admin-show-share-links" class="button secondary" style="margin-bottom: 1px;"><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;&nbsp;Share the plugin</button> <div id="cff-admin-share-links"></div>


    <?php } //End config tab ?>

    <?php if( $cff_active_tab == 'license' ) { //Start License tab ?>

    <?php 
    $cff_license = trim( get_option( 'cff_license_key' ) );
    $cff_status  = get_option( 'cff_license_status' );
    ?>

        <form method="post" action="options.php">
    
            <?php
            settings_fields('cff_license');
             ?>

            <?php
            // data to send in our API request
            $cff_api_params = array( 
                'edd_action'=> 'check_license', 
                'license'   => $cff_license, 
                'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
            );
            
            // Call the custom API.
            $cff_response = wp_remote_get( add_query_arg( $cff_api_params, WPW_SL_STORE_URL ), array( 'timeout' => 60, 'sslverify' => false ) );
            // $cff_response = wp_remote_get( add_query_arg( $cff_api_params, 'http://asjkfhafkjlhawklhklj.com' ), array( 'timeout' => 60, 'sslverify' => false ) );

            // decode the license data
            $cff_license_data = (array) json_decode( wp_remote_retrieve_body( $cff_response ) );

            //Store license data in db unless the data comes back empty as wasn't able to connect to our website to get it
            if( !empty($cff_license_data) ) update_option( 'cff_license_data', $cff_license_data );

            ?>

            <br />
            <table class="form-table">
                <tbody>
                    <tr valign="top">   
                        <th scope="row" valign="top"><?php _e('Custom Facebook Feed Pro'); ?></th>
                        <td>
                            <input id="cff_license_key" name="cff_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $cff_license ); ?>" />
                            <?php if( false !== $cff_license ) { ?>
                                <?php if( $cff_status !== false && $cff_status == 'valid' ) { ?>
                                    <?php wp_nonce_field( 'cff_nonce', 'cff_nonce' ); ?>
                                    <input type="submit" class="button-secondary" name="cff_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                    
                                    <?php if($cff_license_data['license'] == 'expired'){ ?>
                                        <span style="color:red;"><?php _e('Expired'); ?></span>
                                    <?php } else { ?>
                                        <span style="color:green;"><?php _e('Active'); ?></span>
                                    <?php } ?>

                                <?php } else {
                                    wp_nonce_field( 'cff_nonce', 'cff_nonce' ); ?>
                                    <input type="submit" class="button-secondary" name="cff_license_activate" value="<?php _e('Activate License'); ?>"/>
                                    
                                    <?php if($cff_license_data['license'] == 'expired'){ ?>
                                        <span style="color:red;"><?php _e('Expired'); ?></span>
                                    <?php } else { ?>
                                        <span style="color:red;"><?php _e('Inactive'); ?></span>
                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                            <br />
                            <i style="color: #666; font-size: 11px;"><?php _e('The license key you received when purchasing the plugin.'); ?></i>
                            <?php global $cff_download_id; ?>
                            <p style="font-size: 13px;"><a href='https://smashballoon.com/checkout/?edd_license_key=<?php echo trim($cff_license) ?>&amp;download_id=<?php echo $cff_download_id ?>&utm_source=plugin-pro&utm_campaign=cff' target='_blank'><?php _e("Renew your license"); ?></a>&nbsp;&nbsp;&nbsp;&middot;<a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("Upgrade your license"); ?></a>
                            </p>
                            
                            <div class="cff-tooltip cff-more-info">
                                <?php _e("<p>You can upgrade your license in two ways:</p>
                                <p>&bull;&nbsp; Log into <a href='https://smashballoon.com/account/?utm_source=plugin-pro&utm_campaign=cff' target='_blank'>your Account</a> and click on the 'Upgrade my License' tab<br />
                                &bull;&nbsp; <a href='https://smashballoon.com/contact/?utm_source=plugin-pro&utm_campaign=cff' target='_blank'>Contact us directly</a></p>"); ?>
                            </div>
                        </td>
                    </tr>

                    <?php do_action('cff_admin_license'); ?>

                </tbody>
            </table>

            <p style="margin: 20px 0 0 0; height: 35px;">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes" style="margin-right: 10px;">
            <button name="cff-test-license" id="cff-test-license-btn" class="button button-secondary">Test Connection</button>
            </p>

            <div id="cff-test-license-connection" style="display: none;">
                <?php
                if( isset( $cff_license_data['item_name']) ){
                    echo '<p class="cff-success" style="display: inline-block; padding: 10px 15px; border-radius: 5px; margin: 0;"><i class="fa fa-check"></i> &nbsp;Connection Successful</p>';
                } else {

                    //Blocked by firewall
                    // if( isset($cff_response['body']) ){
                    //     if (strpos( strval($cff_response['body']), '<title>Your access to this site has been limited</title>') !== false) {
                    //         $cff_response = 'Your IP address is being blocked by the firewall at smashballoon.com. Please contact support for assistance.';
                    //     }
                    // }

                    echo '<div class="cff-test-license-error">';
                        highlight_string( var_export($cff_response, true) );
                        echo '<br />';
                        highlight_string( var_export($cff_license_data, true) );
                    echo '</div>';
                }
                ?>
            </div>
            <script type="text/javascript">
            jQuery('#cff-test-license-btn').on('click', function(e){
                e.preventDefault();
                jQuery('#cff-test-license-connection').toggle();
            });
            </script>
        
        </form>

    <?php } ?>

    <?php if( $cff_active_tab == 'support' ) { //Start Support tab ?>

        <div class="cff_support">

            <br />
            <h3 style="padding-bottom: 10px;">Need help?</h3>

            <p>
                <span class="cff-support-title"><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <a href="https://smashballoon.com/custom-facebook-feed/docs/wordpress/" target="_blank"><?php _e('Setup Directions'); ?></a></span>
                <?php _e('A step-by-step guide on how to setup and use the plugin.'); ?>
            </p>

            <p>
                <span class="cff-support-title"><i class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp; <a href="https://www.youtube.com/watch?v=oHEcCW-8NJU" target="_blank" id="cff-play-support-video"><?php _e('Watch a Video'); ?></a></span>
                <?php _e('How to setup, use, and customize the plugin.'); ?>

                <iframe id="cff-support-video" src="//www.youtube.com/embed/oHEcCW-8NJU?theme=light&amp;showinfo=0&amp;controls=2" width="960" height="540" frameborder="0" allowfullscreen="allowfullscreen" title="YouTube video"></iframe>
            </p>

            <p>
                <span class="cff-support-title"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp; <a href="https://smashballoon.com/custom-facebook-feed/faq/" target="_blank"><?php _e('FAQs and Docs'); ?></a></span>
                <?php _e('View our expansive library of FAQs and documentation to help solve your problem as quickly as possible.'); ?>
            </p>

            <div class="cff-support-faqs">

                <ul class="cff-faq-col-1">
                <li><b>FAQs</b></li>
                <li>&bull;&nbsp; <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/faq/?cat=18" target="_blank">General Questions</a>'); ?></li>
                <li>&bull;&nbsp; <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/getting-started/?cat=18" target="_blank">Getting Started</a>'); ?></li>
                <li>&bull;&nbsp; <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/troubleshooting/?cat=18" target="_blank">Common Issues</a>'); ?></li>
                <li style="margin-top: 8px; font-size: 12px;"><a href="https://smashballoon.com/custom-facebook-feed/faq/" target="_blank">See all<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>

                <ul>
                <li><b>Documentation</b></li>
                <li>&bull;&nbsp; <?php _e('<a href="http://smashballoon.com/custom-facebook-feed/docs/wordpress/" target="_blank">Installation and Configuration</a>'); ?></li>
                <li>&bull;&nbsp; <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/customizations/?cat=18" target="_blank">Customize your Feed</a>'); ?></li>
                <li>&bull;&nbsp; <?php _e('<a href=https://smashballoon.com/category/custom-facebook-feed/customizations/snippets/?cat=18" target="_blank">Custom CSS and JavaScript Snippets</a>'); ?></li>
                <li style="margin-top: 8px; font-size: 12px;"><a href="https://smashballoon.com/custom-facebook-feed/docs/" target="_blank">See all<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <p>
                <span class="cff-support-title"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; <a href="admin.php?page=cff-welcome-new"><?php _e('Welcome Page'); ?></a></span>
                <?php _e("View the plugin welcome page to see what's new in the latest update."); ?>
            </p>

            <p>
                <span class="cff-support-title"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; <a href="http://smashballoon.com/custom-facebook-feed/support/" target="_blank"><?php _e('Request Support'); ?></a></span>
                <?php _e('Still need help? Submit a ticket and one of our support experts will get back to you as soon as possible.<br /><b>Important:</b> Please include your <b>System Info</b> below with all support requests.'); ?>
            </p>

        </div>

        <hr />

        <h3><?php _e('System Info &nbsp; <i style="color: #666; font-size: 11px; font-weight: normal;">Click the text below to select all</i>'); ?></h3>

        <?php
        $cff_use_own_token = get_option( 'cff_show_access_token' );
        $access_token = get_option( $access_token );
        if ( $access_token == '' || empty($access_token) || ( !isset($cff_use_own_token) || empty($cff_use_own_token) ) ) $access_token = '393872077427061|ghfVBzNUFnMdFLAGlJbWAOVOelI';

        //Get the Page ID to use in the API call
        $api_page_id = get_option( trim($page_id) );
        $multifeed_system_info_notice = '';
        //If multifeed just use the first ID
        if( $cff_ext_multifeed_active && strpos($api_page_id, ',') !== false ){
            $cff_ids_arr = explode(',', trim($api_page_id));
            $api_page_id = $cff_ids_arr[0];
            $multifeed_system_info_notice = "## Multifeed Extension in use. Testing first ID only ##\n";
        }

        ?>
        <?php
        if( empty($api_page_id) || !isset($api_page_id) ) $api_page_id = 'wordpress';
        $posts_json = cff_fetchUrl("https://graph.facebook.com/".$api_page_id."/feed?access_token=". trim($access_token) ."&limit=1");
        ?>

        <textarea readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)." style="width: 70%; height: 500px; white-space: pre-wrap; font-family: Menlo,Monaco,monospace; word-wrap: break-word;">
## SITE/SERVER INFO: ##
Plugin Version:           <?php echo WPW_SL_ITEM_NAME . "\n"; ?>
Site URL:                 <?php echo site_url() . "\n"; ?>
Home URL:                 <?php echo home_url() . "\n"; ?>
WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>
PHP Version:              <?php echo PHP_VERSION . "\n"; ?>
Web Server Info:          <?php echo $_SERVER['SERVER_SOFTWARE'] . "\n"; ?>
PHP allow_url_fopen:      <?php echo ini_get( 'allow_url_fopen' ) ? "Yes" . "\n" : "No" . "\n"; ?>
PHP cURL:                 <?php echo is_callable('curl_init') ? "Yes" . "\n" : "No" . "\n"; ?>
JSON:                     <?php echo function_exists("json_decode") ? "Yes" . "\n" : "No" . "\n" ?>
SSL Stream:               <?php echo in_array('https', stream_get_wrappers()) ? "Yes" . "\n" : "No" . "\n" //extension=php_openssl.dll in php.ini ?>

## ACTIVE PLUGINS: ##
<?php
$plugins = get_plugins();
$active_plugins = get_option( 'active_plugins', array() );

foreach ( $plugins as $plugin_path => $plugin ) {
    // If the plugin isn't active, don't show it.
    if ( ! in_array( $plugin_path, $active_plugins ) )
        continue;

    echo $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
}
?>

## PLUGIN SETTINGS: ##
-----------------------------
## CONFIGURATION: ##
Page ID:                <?php echo get_option( 'cff_page_id' ) ."\n"; ?>
Use own Access Token:   <?php echo get_option( 'cff_show_access_token' ) ."\n"; ?>
Access Token:           <?php echo chunk_split( get_option( 'cff_access_token' ), 100 ); ?>
Show Posts by:          <?php echo get_option( 'cff_show_others' ) ."\n"; ?>
Number of Posts:        <?php echo get_option( 'cff_num_show' ) ."\n"; ?>
Post Limit:             <?php echo get_option( 'cff_post_limit' ) ."\n"; ?>
Page Type:              <?php echo get_option( 'cff_page_type' ) ."\n"; ?>
Caching Type:           <?php echo get_option( 'cff_caching_type' ) ."\n"; ?>
Cache Time:             <?php echo get_option( 'cff_cache_time' ) ."\n"; ?>
Cache Unit:             <?php echo get_option( 'cff_cache_time_unit' ) ."\n"; ?>
Background cache:       <?php echo get_option( 'cff_cache_cron_time' ) . get_option( 'cff_cache_cron_am_pm' ) . " (". get_option( 'cff_cache_cron_interval' ) . ")" ."\n"; ?>
Next background check:  <?php if ( wp_next_scheduled( 'cff_cache_cron' ) ) {
                                //Get the timezone
                                $cff_orig_timezone = date_default_timezone_get();
                                $options = get_option('cff_style_settings');
                                date_default_timezone_set( $options[ 'cff_timezone' ] );
                                $schedule = wp_get_schedule( 'cff_cache_cron' );
                                if( $schedule == '30mins' ) $schedule = 'every ' . $schedule;
                                $cff_next_cron_event = wp_next_scheduled( 'cff_cache_cron' );
                                echo date('g:i a', $cff_next_cron_event) . ' (' . $schedule . ')';
                                //Reset the timezone
                                date_default_timezone_set( $cff_orig_timezone );
                            } else {
                                echo 'Nothing currently scheduled';
                            }
                            echo "\n";
                        ?>
Locale:                 <?php echo get_option( 'cff_locale' ) ."\n"; ?>
Timezone:               <?php $options = get_option( 'cff_style_settings', array() );
                        
                        if( isset( $options[ 'cff_timezone' ] ) ) echo $options[ 'cff_timezone' ] ."\n"; ?>

<?php if( isset( $options[ 'cff_feed_width' ] ) ) { ?>
## CUSTOMIZE: ##
Feed Width => <?php echo $options[ 'cff_feed_width' ] ."\n"; ?>
Responsive => <?php echo $options[ 'cff_feed_width_resp' ] ."\n"; ?>
Feed Height => <?php echo $options[ 'cff_feed_height' ] ."\n"; ?>
Feed Padding => <?php echo $options[ 'cff_feed_padding' ] ."\n"; ?>
Feed BG Color => <?php echo $options[ 'cff_bg_color' ] ."\n"; ?>
CSS Class => <?php echo $options[ 'cff_class' ] ."\n"; ?>
Feed Columns => <?php echo $options['cff_masonry_desktop_col'] ."\n"; ?>
Mobile Columns => <?php echo $options['cff_masonry_mobile_col'] ."\n"; ?>

## POST TYPES: ##
Statuses => <?php echo $options[ 'cff_show_status_type' ] ."\n"; ?>
Events => <?php echo $options[ 'cff_show_event_type' ] ."\n"; ?>
Photos => <?php echo $options[ 'cff_show_photos_type' ] ."\n"; ?>
Videos => <?php echo $options[ 'cff_show_video_type' ] ."\n"; ?>
Album => <?php echo $options[ 'cff_show_albums_type' ] ."\n"; ?>
Links => <?php echo $options[ 'cff_show_links_type' ] ."\n"; ?>

## HEADER: ##
Show Header => <?php echo $options[ 'cff_show_header' ] ."\n"; ?>
Text => <?php echo $options[ 'cff_header_text' ] ."\n"; ?>
Header Outside => <?php echo $options[ 'cff_header_outside' ] ."\n"; ?>
Background Color => <?php echo $options[ 'cff_header_bg_color' ] ."\n"; ?>
Padding => <?php echo $options[ 'cff_header_padding' ] ."\n"; ?>
Text Size => <?php echo $options[ 'cff_header_text_size' ] ."\n"; ?>
Text Weight => <?php echo $options[ 'cff_header_text_weight' ] ."\n"; ?>
Text Color => <?php echo $options[ 'cff_header_text_color' ] ."\n"; ?>
Icon => <?php echo $options[ 'cff_header_icon' ] ."\n"; ?>
Icon Color => <?php echo $options[ 'cff_header_icon_color' ] ."\n"; ?>
Icon Size => <?php echo $options[ 'cff_header_icon_size' ] ."\n"; ?>

## LIKE BOX: ##
Position => <?php echo $options[ 'cff_like_box_position' ] ."\n"; ?>
Display Outside => <?php echo $options[ 'cff_like_box_outside' ] ."\n"; ?>
Show Fans => <?php echo $options[ 'cff_like_box_faces' ] ."\n"; ?>
Cover Photo => <?php echo $options[ 'cff_like_box_cover' ] ."\n"; ?>
Small Header => <?php echo $options[ 'cff_like_box_small_header' ] ."\n"; ?>
Hide CTA => <?php echo $options[ 'cff_like_box_hide_cta' ] ."\n"; ?>
Custom Width => <?php echo $options[ 'cff_likebox_width' ] ."\n"; ?>

## LOAD MORE: ##
Show Load More => <?php echo $options[ 'cff_load_more' ] ."\n"; ?>
Background Color => <?php echo $options[ 'cff_load_more_bg' ] ."\n"; ?>
Text Color => <?php echo $options[ 'cff_load_more_text_color' ] ."\n"; ?>
Hover Color => <?php echo $options[ 'cff_load_more_bg_hover' ] ."\n"; ?>
Text => <?php echo $options[ 'cff_load_more_text' ] ."\n"; ?>
Show Comments => <?php echo $options['cff_lightbox_comments'] ."\n"; ?>

## LIGHTBOX: ##
Disable Lightbox => <?php echo $options['cff_disable_lightbox'] ."\n"; ?>
Background Color => <?php echo $options['cff_lightbox_bg_color'] ."\n"; ?>
Text Color => <?php echo $options['cff_lightbox_text_color'] ."\n"; ?>
Link Color => <?php echo $options['cff_lightbox_link_color'] ."\n"; ?>

## FILTER CONTENT: ##
Filter => <?php echo $options[ 'cff_filter_string' ] ."\n"; ?>
Exclude => <?php echo $options[ 'cff_exclude_string' ] ."\n"; ?>

## POST LAYOUT: ##
Layout => <?php echo $options[ 'cff_preset_layout' ] ."\n"; ?>
Narrow Layout => <?php echo $options[ 'cff_enable_narrow' ] ."\n"; ?>
One Image => <?php echo $options[ 'cff_one_image' ] ."\n"; ?>

## SHOW/HIDE: ##
Show => <?php if( $options[ 'cff_show_author' ] ) echo 'Author, ';
if( $options[ 'cff_show_text' ] ) echo 'Post Text, ';
if( $options[ 'cff_show_desc' ] ) echo 'Description, ';
if( $options[ 'cff_show_shared_links' ] ) echo 'Shared Links, ';
if( $options[ 'cff_show_date' ] ) echo 'Date, ';
if( $options[ 'cff_show_media' ] ) echo 'Photos/Videos, ';
if( $options[ 'cff_show_event_title' ] ) echo 'Event Title, ';
if( $options[ 'cff_show_event_details' ] ) echo 'Event Details, ';
if( $options[ 'cff_show_meta' ] ) echo 'Comments Box, ';
if( $options[ 'cff_show_link' ] ) echo 'Post Link';
echo "\n"; ?>
Hide => <?php if( !$options[ 'cff_show_author' ] ) echo 'Author, ';
if( !$options[ 'cff_show_text' ] ) echo 'Post Text, ';
if( !$options[ 'cff_show_desc' ] ) echo 'Description, ';
if( !$options[ 'cff_show_shared_links' ] ) echo 'Shared Links, ';
if( !$options[ 'cff_show_date' ] ) echo 'Date, ';
if( !$options[ 'cff_show_media' ] ) echo 'Photos/Videos, ';
if( !$options[ 'cff_show_event_title' ] ) echo 'Event Title, ';
if( !$options[ 'cff_show_event_details' ] ) echo 'Event Details, ';
if( !$options[ 'cff_show_meta' ] ) echo 'Comments Box, ';
if( !$options[ 'cff_show_link' ] ) echo 'Post Link';
echo "\n"; ?>

## STYLE POSTS: ##
Post Style => <?php echo $options[ 'cff_post_style' ] ."\n"; ?>
Background Color => <?php echo $options[ 'cff_post_bg_color' ] ."\n"; ?>
Rounded => <?php echo $options[ 'cff_post_rounded' ] ."\n"; ?>
Seperator Color => <?php echo $options[ 'cff_sep_color' ] ."\n"; ?>
Seperator Size => <?php echo $options[ 'cff_sep_size' ] ."\n"; ?>
Box Shadow => <?php echo $options[ 'cff_box_shadow' ] ."\n"; ?>

## POST AUTHOR: ##
Text Size => <?php echo $options[ 'cff_author_size' ] ."\n"; ?>
Text Color => <?php echo $options[ 'cff_author_color' ] ."\n"; ?>

## POST TEXT: ##
Text Length => <?php echo get_option('cff_title_length') ."\n"; ?>
Text Format => <?php echo $options['cff_title_format'] ."\n"; ?>
Text Size => <?php echo $options['cff_title_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_title_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_title_color'] ."\n"; ?>
Link Color => <?php echo $options['cff_link_color'] ."\n"; ?>
Link Text To Facebook => <?php echo $options['cff_link_to_timeline'] ."\n"; ?>
Link Post Tags => <?php echo $options['cff_post_tags'] ."\n"; ?>
Link Hashags => <?php echo $options['cff_link_hashtags'] ."\n"; ?>

## SHARED POST DESCRIPTION: ##
Text Size => <?php echo $options['cff_body_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_body_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_body_color'] ."\n"; ?>

## POST DATE: ##
Position => <?php echo $options['cff_date_position'] ."\n"; ?>
Text Size => <?php echo $options['cff_date_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_date_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_date_color'] ."\n"; ?>
Date Formatting => <?php echo $options['cff_date_formatting'] ."\n"; ?>
Timezone => <?php echo $options['cff_timezone'] ."\n"; ?>
Custom Format => <?php echo $options['cff_date_custom'] ."\n"; ?>
Text Before Date => <?php echo $options['cff_date_before'] ."\n"; ?>
Text After Date => <?php echo $options['cff_date_after'] ."\n"; ?>

## SHARED LINK BOXES: ##
Link Box BG Color => <?php echo $options['cff_link_bg_color'] ."\n"; ?>
Link Box Border Color => <?php echo $options['cff_link_border_color'] ."\n"; ?>
Remove Background/Border => <?php echo $options['cff_disable_link_box'] ."\n"; ?>
Link Title Format => <?php echo $options['cff_link_title_format'] ."\n"; ?>
Link Title Color => <?php echo $options['cff_link_title_color'] ."\n"; ?>
Link Title Size => <?php echo $options['cff_link_title_size'] ."\n"; ?>
Link URL Size => <?php echo $options['cff_link_url_size'] ."\n"; ?>
Link URL Color => <?php echo $options['cff_link_url_color'] ."\n"; ?>
Link Description Size => <?php echo $options['cff_link_desc_size'] ."\n"; ?>
Link Description Color => <?php echo $options['cff_link_desc_color'] ."\n"; ?>
Max Length => <?php echo get_option('cff_body_length') ."\n"; ?>

## EVENT TITLE: ##
Format => <?php echo $options['cff_event_title_format'] ."\n"; ?>
Text Size => <?php echo $options['cff_event_title_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_event_title_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_event_title_color'] ."\n"; ?>
Link To Facebook => <?php echo $options['cff_event_title_link'] ."\n"; ?>

## EVENT DATE: ##
Text Size => <?php echo $options['cff_event_date_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_event_date_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_event_date_color'] ."\n"; ?>
Date Position => <?php echo $options['cff_event_date_position'] ."\n"; ?>
Date Formatting => <?php echo $options['cff_event_date_formatting'] ."\n"; ?>
Custom Format => <?php echo $options['cff_event_date_custom'] ."\n"; ?>

## EVENT DETAILS: ##
Text Size => <?php echo $options['cff_event_details_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_event_details_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_event_details_color'] ."\n"; ?>
Link Color => <?php echo $options['cff_event_link_color'] ."\n"; ?>
Buy Tickets Text => <?php echo $options['cff_buy_tickets_text'] ."\n"; ?>

## LIKES, SHARES AND COMMENTS BOX: ##
Icon Style => <?php echo $options['cff_icon_style'] ."\n"; ?>
Text Color => <?php echo $options['cff_meta_text_color'] ."\n"; ?>
Link Color => <?php echo $options['cff_meta_link_color'] ."\n"; ?>
BG Color => <?php echo $options['cff_meta_bg_color'] ."\n"; ?>
Expand Comments Initially => <?php echo $options['cff_expand_comments'] ."\n"; ?>
Number Of Comments => <?php echo $options['cff_comments_num'] ."\n"; ?>
Hide Comments Avatar => <?php echo $options['cff_hide_comment_avatars'] ."\n"; ?>
Show Comments In Likebox => <?php echo $options['cff_lightbox_comments'] ."\n"; ?>

## POST ACTION LINKS: ##
Text Size => <?php echo $options['cff_link_size'] ."\n"; ?>
Text Weight => <?php echo $options['cff_link_weight'] ."\n"; ?>
Text Color => <?php echo $options['cff_link_color'] ."\n"; ?>
View on Facebook Text => <?php echo $options['cff_facebook_link_text'] ."\n"; ?>
Share Text => <?php echo $options['cff_facebook_share_text'] ."\n"; ?>
Show View on Facebook Text  => <?php echo $options['cff_show_facebook_link'] ."\n"; ?>
Show Share Text  => <?php echo $options['cff_show_facebook_share'] ."\n"; ?>

## CUSTOM CSS/JS: ##
Custom CSS => <?php echo $options['cff_custom_css'] ."\n"; ?>
Custom JavaScript => <?php echo $options['cff_custom_js'] ."\n"; ?>

## MISC - MEDIA: ##
Full-Size Shared Link Images => <?php echo $options['cff_full_link_images'] ."\n"; ?>
Post Image Size => <?php echo $options['cff_image_size'] ."\n"; ?>
Play Video Action => <?php echo $options['cff_video_action'] ."\n"; ?>

## MISC - MISC SETTINGS: ##
Credit Link => <?php echo $options['cff_show_credit'] ."\n"; ?>
Preserve Settings => <?php echo get_option('cff_preserve_settings') ."\n"; ?>
Loading via AJAX => <?php echo get_option('cff_ajax') ."\n"; ?>
Fix Text Shortening => <?php echo $options['cff_format_issue'] ."\n"; ?>
Disable SVG icons => <?php echo $options['cff_disable_svgs'] ."\n"; ?>
Restricted Page => <?php echo $options['cff_restricted_page'] ."\n"; ?>
Timeline Pagination Method => <?php echo $options['cff_timeline_pag'] ."\n"; ?>
Grid Pagination Method => <?php echo $options['cff_grid_pag'] ."\n"; ?>
Force Cache To Clear => <?php echo $options['cff_cron'] ."\n"; ?>
Request Method => <?php echo $options['cff_request_method'] ."\n"; ?>
Icon Font Source Method => <?php echo $options['cff_font_source'] ."\n"; ?>
Minify CSS/JS => <?php echo $options['cff_minify'] ."\n"; ?>
Disable AJAX Caching => <?php echo $options['cff_disable_ajax_cache'] ."\n"; ?>

## CUSTOM TEXT/TRANSLATE: ##
Modified text strings:
<?php if($options['cff_see_more_text'] != 'See More'){ ?>See More => <?php echo $options['cff_see_more_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_see_less_text'] != 'See Less'){ ?>See Less => <?php echo $options['cff_see_less_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_map_text'] != 'Map'){ ?>Map => <?php echo $options['cff_map_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_no_events_text'] != 'No upcoming events'){ ?>No Upcoming Events => <?php echo $options['cff_no_events_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_interested_text'] != 'interested'){ ?>Interested => <?php echo $options['cff_interested_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_going_text'] != 'going'){ ?>Going => <?php echo $options['cff_going_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_buy_tickets_text'] != 'Buy Tickets'){ ?>Buy Tickets => <?php echo $options['cff_buy_tickets_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_facebook_link_text'] != 'View on Facebook'){ ?>View on Facebook => <?php echo $options['cff_facebook_link_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_facebook_share_text'] != 'Share'){ ?>Share => <?php echo $options['cff_facebook_share_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_load_more_text'] != 'Load more'){ ?>Load More => <?php echo $options['cff_load_more_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_no_more_posts_text'] != 'No more posts'){ ?>No More Posts => <?php echo $options['cff_no_more_posts_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_view_previous_comments_text'] != 'View more comments'){ ?>View More Comments => <?php echo $options['cff_translate_view_previous_comments_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_comment_on_facebook_text'] != 'Comment on Facebook'){ ?>Comment on Facebook => <?php echo $options['cff_translate_comment_on_facebook_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_photos_text'] != 'photos'){ ?>Photos => <?php echo $options['cff_translate_photos_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_like_this_text'] != 'like this'){ ?>Like This => <?php echo $options['cff_translate_like_this_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_likes_this_text'] != 'likes this'){ ?>Likes This => <?php echo $options['cff_translate_likes_this_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_reacted_text'] != 'reacted to this'){ ?>Reacted To This => <?php echo $options['cff_translate_reacted_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_and_text'] != 'and'){ ?>and => <?php echo $options['cff_translate_and_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_other_text'] != 'other'){ ?>Other => <?php echo $options['cff_translate_other_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_others_text'] != 'others'){ ?>Others => <?php echo $options['cff_translate_others_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_reply_text'] != 'Reply'){ ?>Reply => <?php echo $options['cff_translate_reply_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_replies_text'] != 'Replies'){ ?>Replies => <?php echo $options['cff_translate_replies_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_learn_more_text'] != 'Learn More'){ ?>Learn More => <?php echo $options['cff_translate_learn_more_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_shop_now_text'] != 'Shop Now'){ ?>Shop Now => <?php echo $options['cff_translate_shop_now_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_message_page_text'] != 'Message Page'){ ?>Message Page => <?php echo $options['cff_translate_message_page_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_get_directions_text'] != 'Get Directions'){ ?>Get Directions => <?php echo $options['cff_translate_get_directions_text'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_second'] != 'second'){ ?>Second => <?php echo $options['cff_translate_second'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_seconds'] != 'seconds'){ ?>Seconds => <?php echo $options['cff_translate_seconds'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_minute'] != 'minute'){ ?>Minute => <?php echo $options['cff_translate_minute'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_minutes'] != 'minutes'){ ?>Minutes => <?php echo $options['cff_translate_minutes'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_hour'] != 'hour'){ ?>Hour => <?php echo $options['cff_translate_hour'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_hours'] != 'hours'){ ?>Hours => <?php echo $options['cff_translate_hours'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_day'] != 'day'){ ?>Day => <?php echo $options['cff_translate_day'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_days'] != 'days'){ ?>Days => <?php echo $options['cff_translate_days'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_week'] != 'week'){ ?>Week => <?php echo $options['cff_translate_week'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_weeks'] != 'weeks'){ ?>Weeks => <?php echo $options['cff_translate_weeks'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_month'] != 'month'){ ?>Month => <?php echo $options['cff_translate_month'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_months'] != 'months'){ ?>Months => <?php echo $options['cff_translate_months'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_year'] != 'year'){ ?>Year => <?php echo $options['cff_translate_year'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_years'] != 'years'){ ?>Years => <?php echo $options['cff_translate_years'] ."\n"; ?><?php } ?>
<?php if($options['cff_translate_ago'] != 'ago'){ ?>Ago => <?php echo $options['cff_translate_ago'] ."\n"; ?><?php } ?>
<?php } else {
echo "\n"."## CUSTOMIZE ##"."\n";
echo '-----------------------------'."\n";
echo "Customize Settings not saved."."\n";
echo '-----------------------------'."\n";
} ?>

## EXTENSIONS: ##
<?php if (WPW_SL_ITEM_NAME == 'Custom Facebook Feed WordPress Plugin Smash'){
    echo "'Extensions' Plugin Installed - Active extensions:" . "\n";
    foreach ( get_option('cff_extensions_status') as $key => $value ) {
        if( $value == 'on' ){
            if( $key == 'cff_extensions_multifeed_active' ) echo 'Multifeed, ';
            if( $key == 'cff_extensions_date_range_active' ) echo 'Date Range, ';
            if( $key == 'cff_extensions_featured_post_active' ) echo 'Featured Post, ';
            if( $key == 'cff_extensions_album_active' ) echo 'Album, ';
            if( $key == 'cff_extensions_masonry_columns_active' ) echo 'Masonry, ';
            if( $key == 'cff_extensions_carousel_active' ) echo 'Carousel, ';
            if( $key == 'cff_extensions_reviews_active' ) echo 'Reviews, ';
        }
    }
    echo "\n\n";
}
?>
<?php if($cff_ext_date_active){
    echo "Date Range Extension:" ."\n";
    echo "Date Range From:              ". get_option( 'cff_date_from' ) ."\n";
    echo "Date Range Until:             ". get_option( 'cff_date_until' ) ."\n\n";
} ?>
<?php if($cff_carousel_active){
    $cff_carousel_options = get_option('cff_carousel_options');
    echo "Carousel Extension:" ."\n";
    echo "Set Carousel as Default:      ". $cff_carousel_options['cff_carousel_enabled'] ."\n";
    echo "Height of Carousel:           ". $cff_carousel_options['cff_carousel_height'] ."\n";
    echo "Carousel Desktop Columns:     ". $cff_carousel_options['cff_carousel_desktop_cols'] ."\n";
    echo "Carousel Mobile Columns:      ". $cff_carousel_options['cff_carousel_mobile_cols'] ."\n";
    echo "Navigation Arrows Style:      ". $cff_carousel_options['cff_carousel_navigation'] ."\n";
    echo "Show Pagination:              ". $cff_carousel_options['cff_carousel_pagination'] ."\n";
    echo "Enable Autoplay:              ". $cff_carousel_options['cff_carousel_autoplay'] ."\n";
    echo "Interval Time:                ". $cff_carousel_options['cff_carousel_interval'] ."\n\n";
} ?>
<?php if($cff_masonry_columns_active){
    $cff_masonry_options = get_option('cff_masonry_options');
    echo "Masonry Columns Extension:" ."\n";
    echo "Set Masonry as Default:       ". $cff_masonry_options['cff_masonry_enabled'] ."\n";
    echo "Desktop Columns:              ". $cff_masonry_options['cff_masonry_desktop_col'] ."\n";
    echo "Mobile Columns:               ". $cff_masonry_options['cff_masonry_mobile_col'] ."\n";
    echo "Use JS Version Only:          ". $cff_masonry_options['cff_masonry_js_only'] ."\n\n";
} ?>
<?php if($cff_reviews_active){
    echo "Reviews  Extension:" ."\n";
    $cff_reviews_string = '';
    if($options[ 'cff_reviews_rated_5' ]) $cff_reviews_string .= '5,';
    if($options[ 'cff_reviews_rated_4' ]) $cff_reviews_string .= '4,';
    if($options[ 'cff_reviews_rated_3' ]) $cff_reviews_string .= '3,';
    if($options[ 'cff_reviews_rated_2' ]) $cff_reviews_string .= '2,';
    if($options[ 'cff_reviews_rated_1' ]) $cff_reviews_string .= '1';
    echo "Reviews Access Token:         ". chunk_split( $page_access_token_val, 100 ) ."\n";
    echo "Show reviews rated:           ". $cff_reviews_string ."\n";
    echo "Star icon size:               ". $options['cff_star_size'] ."\n";
    echo "Hide negative recommendations:". $options['cff_reviews_hide_negative'] . "\n";
    echo "'View all Reviews' Text:      ". $options['cff_reviews_link_text'] ."\n";
    echo "Hide reviews with no text:    ". $options['cff_reviews_no_text'] ."\n";
    echo "API retrieval Method:         ". $options['cff_reviews_method'] ."\n";
} ?>

## FACEBOOK API RESPONSE: ##
<?php echo $multifeed_system_info_notice; ?>
<?php 
$api_response_json = json_decode($posts_json);
if( isset( $api_response_json->error ) ) echo $posts_json;
if( isset( $api_response_json->data ) ){
    $posts_json_split = explode(',"paging":{', $posts_json);
    echo $posts_json_split[0];
}
?>
        </textarea>

<div class="cff_quickstart">
    <h3><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; Display your feed</h3>
    <p>Copy and paste this shortcode directly into the page, post or widget where you'd like to display the feed:        <input type="text" value="[custom-facebook-feed]" size="22" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p>
    <p>Find out how to display <a href="https://smashballoon.com/using-shortcode-options-customize-facebook-feeds/" target="_blank"><b>multiple feeds</b></a>.</p>
</div>

<hr />        

    <?php } ?>

        
<?php 
} //End Settings_Page 
//Create Style page
function cff_style_page() {
    //Declare variables for fields
    $style_hidden_field_name                = 'cff_style_submit_hidden';
    $style_general_hidden_field_name        = 'cff_style_general_submit_hidden';
    $style_post_layout_hidden_field_name    = 'cff_style_post_layout_submit_hidden';
    $style_typography_hidden_field_name     = 'cff_style_typography_submit_hidden';
    $style_misc_hidden_field_name           = 'cff_style_misc_submit_hidden';
    $style_custom_text_hidden_field_name    = 'cff_style_custom_text_submit_hidden';
    $defaults = array(
        //Post types
        'cff_show_links_type'       => true,
        'cff_show_event_type'       => true,
        'cff_show_video_type'       => true,
        'cff_show_photos_type'      => true,
        'cff_show_status_type'      => true,
        'cff_show_albums_type'      => true,
        //Events only
        'cff_events_source'         => 'eventspage',
        'cff_event_offset'          => '6',
        'cff_event_image_size'      => 'full',
        //Albums only
        'cff_albums_source'         => 'photospage',
        'cff_show_album_title'      => true,
        'cff_show_album_number'     => true,
        'cff_album_cols'            => '4',
        //Photos only
        'cff_photos_source'         => 'photospage',
        'cff_photos_cols'           => '4',
        //Videos only
        'cff_videos_source'         => 'videospage',
        'cff_show_video_name'       => true,
        'cff_show_video_desc'       => true,
        'cff_video_cols'            => '4',

        //Lightbox
        'cff_disable_lightbox'      => false,
        'cff_lightbox_bg_color'     => '',
        'cff_lightbox_text_color'   => '',
        'cff_lightbox_link_color'   => '',

        //Filter
        'cff_filter_string'         => '',
        'cff_exclude_string'        => '',

        //Reviews
        'cff_reviews_rated_5'       => true,
        'cff_reviews_rated_4'       => true,
        'cff_reviews_rated_3'       => true,
        'cff_reviews_rated_2'       => true,
        'cff_reviews_rated_1'       => true,
        'cff_star_size'             => '12',
        'cff_reviews_link_text'     => 'View all Reviews',
        'cff_reviews_no_text'       => false,
        'cff_reviews_method'        => 'auto',
        'cff_reviews_hide_negative' => true,

        //Layout
        'cff_preset_layout'         => 'thumb',
        'cff_media_position'        => 'below',
        //Include
        'cff_show_text'             => true,
        'cff_show_desc'             => true,
        'cff_show_shared_links'     => true,
        'cff_show_date'             => true,
        'cff_show_media'            => true,
        'cff_show_event_title'      => true,
        'cff_show_event_details'    => true,
        'cff_show_meta'             => true,
        'cff_show_link'             => true,
        'cff_show_like_box'         => true,
        //Masonry
        'cff_masonry_enabled'       => false,
        'cff_masonry_desktop_col'   => 1,
        'cff_masonry_mobile_col'    => 1,

        //Post Styple
        'cff_post_style'            => '',
        'cff_post_bg_color'         => '',
        'cff_post_rounded'          => '0',
        'cff_box_shadow'            => false,
        //Typography
        'cff_title_format'          => 'p',
        'cff_title_size'            => 'inherit',
        'cff_title_weight'          => 'inherit',
        'cff_title_color'           => '',
        'cff_posttext_link_color'   => '',
        'cff_body_size'             => '12',
        'cff_body_weight'           => 'inherit',
        'cff_body_color'            => '',
        'cff_link_title_format'     => 'p',
        'cff_full_link_images'      => true,
        'cff_image_size'            => 'large',
        'cff_link_title_size'       => 'inherit',
        'cff_link_url_size'         => '12',
        'cff_link_desc_size'        => 'inherit',
        'cff_link_desc_color'       => '',
        'cff_link_title_color'      => '',
        'cff_link_url_color'        => '',
        'cff_link_bg_color'         => '',
        'cff_link_border_color'     => '',
        'cff_disable_link_box'      => '',

        //Event title
        'cff_event_title_format'    => 'p',
        'cff_event_title_size'      => 'inherit',
        'cff_event_title_weight'    => 'bold',
        'cff_event_title_color'     => '',
        //Event date
        'cff_event_date_size'       => 'inherit',
        'cff_event_date_weight'     => 'inherit',
        'cff_event_date_color'      => '',
        'cff_event_date_position'   => 'below',
        'cff_event_date_formatting' => '14',
        'cff_event_date_custom'     => '',
        //Event details
        'cff_event_details_size'    => 'inherit',
        'cff_event_details_weight'  => 'inherit',
        'cff_event_details_color'   => '',
        'cff_event_link_color'      => '',
        
        //Date
        'cff_date_position'         => 'author',
        'cff_date_size'             => 'inherit',
        'cff_date_weight'           => 'inherit',
        'cff_date_color'            => '',
        'cff_date_formatting'       => '1',
        'cff_date_custom'           => '',
        'cff_date_before'           => '',
        'cff_date_after'            => '',
        'cff_timezone'              => 'America/Chicago',

        //Link to Facebook
        'cff_link_size'             => 'inherit',
        'cff_link_weight'           => 'inherit',
        'cff_link_color'            => '',
        'cff_view_link_text'        => 'View Link',
        'cff_link_to_timeline'      => false,

        //Load more button
        // 'cff_load_more'             => true,
        'cff_load_more_bg'          => '',
        'cff_load_more_text_color'  => '',
        'cff_load_more_bg_hover'    => '',
        'cff_load_more_text'        => 'Load more',
        'cff_no_more_posts_text'    => 'No more posts',

        //Meta
        'cff_icon_style'            => 'light',
        'cff_meta_text_color'       => '',
        'cff_meta_link_color'       => '',
        'cff_meta_bg_color'         => '',
        'cff_expand_comments'       => false,
        'cff_comments_num'          => '4',
        'cff_nocomments_text'       => 'No comments yet',
        'cff_hide_comments'         => '',
        'cff_hide_comment_avatars'  => false,
        'cff_lightbox_comments'     => true,
        //Misc
        'cff_feed_width'            => '100%',
        'cff_feed_width_resp'       => false,
        'cff_feed_height'           => '',
        'cff_feed_padding'          => '',
        'cff_like_box_position'     => 'bottom',
        'cff_like_box_outside'      => false,
        'cff_likebox_width'         => '',
        'cff_likebox_height'        => '',
        'cff_like_box_faces'        => false,
        'cff_like_box_border'       => false,
        'cff_like_box_cover'        => true,
        'cff_like_box_small_header' => false,
        'cff_like_box_hide_cta'     => false,

        //Misc Settings
        'cff_enable_narrow'         => true,
        'cff_one_image'             => false,

        'cff_bg_color'              => '',
        'cff_likebox_bg_color'      => '',
        'cff_like_box_text_color'   => 'blue',
        'cff_video_height'          => '',
        'cff_show_author'           => true,
        'cff_class'                 => '',
        'cff_app_id'                => '',
        'cff_show_credit'           => '',
        'cff_format_issue'          => false,
        'cff_disable_svgs'          => false,
        'cff_restricted_page'       => false,
        'cff_font_source'           => 'cdn',
        'cff_disable_ajax_cache'    => false,
        'cff_minify'                => false,
        'cff_request_method'        => 'auto',
        'cff_cron'                  => 'unset',
        'cff_timeline_pag'          => 'date',
        'cff_grid_pag'              => 'auto',

        //Feed Header
        'cff_show_header'           => '',
        'cff_header_outside'        => false,
        'cff_header_text'           => 'Facebook Posts',
        'cff_header_bg_color'       => '',
        'cff_header_padding'        => '',
        'cff_header_text_size'      => '',
        'cff_header_text_weight'    => '',
        'cff_header_text_color'     => '',
        'cff_header_icon'           => '',
        'cff_header_icon_color'     => '',
        'cff_header_icon_size'      => '28',

        //Author
        'cff_author_size'           => 'inherit',
        'cff_author_color'          => '',

        //New
        'cff_custom_css'            => '',
        'cff_custom_js'             => '',
        'cff_title_link'            => false,
        'cff_post_tags'             => true,
        'cff_link_hashtags'         => true,
        'cff_event_title_link'      => true,
        'cff_video_action'          => 'post',
        'cff_video_player'          => 'facebook',
        'cff_sep_color'             => '',
        'cff_sep_size'              => '1',

        //Translate - general
        'cff_see_more_text'         => 'See More',
        'cff_see_less_text'         => 'See Less',
        'cff_map_text'              => 'Map',
        'cff_no_events_text'        => 'No upcoming events',
        'cff_facebook_link_text'    => 'View on Facebook',
        'cff_facebook_share_text'   => 'Share',
        'cff_show_facebook_link'    => true,
        'cff_show_facebook_share'   => true,
        'cff_buy_tickets_text'      => 'Buy Tickets',
        'cff_interested_text'       => 'interested',
        'cff_going_text'            => 'going',

        //Translate - social
        'cff_translate_view_previous_comments_text'     => 'View more comments',
        'cff_translate_comment_on_facebook_text'        => 'Comment on Facebook',
        'cff_translate_photos_text'                     => 'photos',
        'cff_translate_likes_this_text'                 => 'likes this',
        'cff_translate_like_this_text'                  => 'like this',
        'cff_translate_reacted_text'                    => 'reacted to this',
        'cff_translate_and_text'                        => 'and',
        'cff_translate_other_text'                      => 'other',
        'cff_translate_others_text'                     => 'others',
        'cff_translate_reply_text'                      => 'Reply',
        'cff_translate_replies_text'                    => 'Replies',

        'cff_translate_learn_more_text' => 'Learn More',
        'cff_translate_shop_now_text'   => 'Shop Now',
        'cff_translate_message_page_text' => 'Message Page',
        'cff_translate_get_directions_text' => 'Get Directions',

        //Translate - date
        'cff_translate_second'      => 'second',
        'cff_translate_seconds'     => 'seconds',
        'cff_translate_minute'      => 'minute',
        'cff_translate_minutes'     => 'minutes',
        'cff_translate_hour'        => 'hour',
        'cff_translate_hours'       => 'hours',
        'cff_translate_day'         => 'day',
        'cff_translate_days'        => 'days',
        'cff_translate_week'        => 'week',
        'cff_translate_weeks'       => 'weeks',
        'cff_translate_month'       => 'month',
        'cff_translate_months'      => 'months',
        'cff_translate_year'        => 'year',
        'cff_translate_years'       => 'years',
        'cff_translate_ago'         => 'ago',
    );
    //Save layout option in an array
    $options = wp_parse_args(get_option('cff_style_settings'), $defaults);
    add_option( 'cff_style_settings', $options );

    //Which extensions are active?
    $cff_ext_options = get_option('cff_extensions_status');
    $cff_extensions_reviews_active = false;
    $cff_extensions_masonry_columns_active = false;
    if (WPW_SL_ITEM_NAME == 'Custom Facebook Feed WordPress Plugin Smash'){
        if( isset($cff_ext_options[ 'cff_extensions_reviews_active' ]) ) $cff_extensions_reviews_active = $cff_ext_options[ 'cff_extensions_reviews_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_masonry_columns_active' ]) ) $cff_extensions_masonry_columns_active = $cff_ext_options[ 'cff_extensions_masonry_columns_active' ];
    }
    ( is_plugin_active( 'cff-reviews/cff-reviews.php' ) || $cff_extensions_reviews_active ) ? $cff_reviews_active = true : $cff_reviews_active = false;

    //Masonry extension deprecated
    if ( is_plugin_active( 'cff-masonry/cff-masonry.php' ) || $cff_extensions_masonry_columns_active ){
        $cff_masonry_options = get_option( 'cff_masonry_options' );

        //If the masonry extension is active then get it's settings and apply them to the plugin settings
        if( isset($cff_masonry_options['cff_masonry_enabled']) ) $options['cff_masonry_enabled'] = $cff_masonry_options['cff_masonry_enabled'];
        if( isset($cff_masonry_options['cff_masonry_desktop_col']) ) $options['cff_masonry_desktop_col'] = $cff_masonry_options['cff_masonry_desktop_col'];
        if( isset($cff_masonry_options['cff_masonry_mobile_col']) ) $options['cff_masonry_mobile_col'] = $cff_masonry_options['cff_masonry_mobile_col'];
        update_option( 'cff_style_settings', $options );

        //Delete the masonry extension options
        delete_option( 'cff_masonry_options' );

        //Remove masonry extension settings fields from admin
        remove_action( 'cff_post_layout_add_settings_area', 'cff_ext_masonry_options' );
        remove_action( 'cff_extension_post_layout_options_update', 'cff_ext_masonry_options_update' );

        //Display a message in place of the existing settings that they've moved
        function cff_masonry_ext_settings_notice() { ?>
            <hr />
            <h3><?php _e( 'Masonry Columns' ); ?></h3>
            <p>These settings have been replaced by the <b>"Feed Columns"</b> setting under the <a href='?page=cff-style&tab=general'>"General" tab</a>.</p>
        <?php }
        add_action( 'cff_post_layout_add_settings_area', 'cff_masonry_ext_settings_notice' );

    }

    
    //Set the page variables
    //Post types
    $cff_show_links_type = $options[ 'cff_show_links_type' ];
    $cff_show_event_type = $options[ 'cff_show_event_type' ];
    $cff_show_video_type = $options[ 'cff_show_video_type' ];
    $cff_show_photos_type = $options[ 'cff_show_photos_type' ];
    $cff_show_status_type = $options[ 'cff_show_status_type' ];
    $cff_show_albums_type = $options[ 'cff_show_albums_type' ];

    $cff_events_source = $options[ 'cff_events_source' ];
    $cff_event_offset = $options[ 'cff_event_offset' ];
    $cff_event_image_size = $options[ 'cff_event_image_size' ];

    $cff_albums_source = $options[ 'cff_albums_source' ];
    $cff_show_album_title = $options[ 'cff_show_album_title' ];
    $cff_show_album_number = $options[ 'cff_show_album_number' ];
    $cff_album_cols = $options[ 'cff_album_cols' ];

    $cff_photos_source = $options[ 'cff_photos_source' ];
    $cff_photos_cols = $options[ 'cff_photos_cols' ];

    $cff_videos_source = $options[ 'cff_videos_source' ];
    $cff_show_video_name = $options[ 'cff_show_video_name' ];
    $cff_show_video_desc = $options[ 'cff_show_video_desc' ];
    $cff_video_cols = $options[ 'cff_video_cols' ];

    //Lightbox
    $cff_disable_lightbox = $options[ 'cff_disable_lightbox' ];
    $cff_lightbox_bg_color = $options[ 'cff_lightbox_bg_color' ];
    $cff_lightbox_text_color = $options[ 'cff_lightbox_text_color' ];
    $cff_lightbox_link_color = $options[ 'cff_lightbox_link_color' ];

    //Filter
    $cff_filter_string = $options[ 'cff_filter_string' ];
    $cff_exclude_string = $options[ 'cff_exclude_string' ];

    //Reviews
    $cff_reviews_rated_5 = $options[ 'cff_reviews_rated_5' ];
    $cff_reviews_rated_4 = $options[ 'cff_reviews_rated_4' ];
    $cff_reviews_rated_3 = $options[ 'cff_reviews_rated_3' ];
    $cff_reviews_rated_2 = $options[ 'cff_reviews_rated_2' ];
    $cff_reviews_rated_1 = $options[ 'cff_reviews_rated_1' ];
    $cff_star_size = $options[ 'cff_star_size' ];
    $cff_reviews_link_text = $options[ 'cff_reviews_link_text' ];
    $cff_reviews_no_text = $options[ 'cff_reviews_no_text' ];
    $cff_reviews_method = $options[ 'cff_reviews_method' ];
    $cff_reviews_hide_negative = $options[ 'cff_reviews_hide_negative' ];

    //Layout
    $cff_preset_layout = $options[ 'cff_preset_layout' ];
    $cff_media_position = $options[ 'cff_media_position' ];
    //Include
    $cff_show_text = $options[ 'cff_show_text' ];
    $cff_show_desc = $options[ 'cff_show_desc' ];
    $cff_show_shared_links = $options[ 'cff_show_shared_links' ];
    $cff_show_date = $options[ 'cff_show_date' ];
    $cff_show_media = $options[ 'cff_show_media' ];
    $cff_show_event_title = $options[ 'cff_show_event_title' ];
    $cff_show_event_details = $options[ 'cff_show_event_details' ];
    $cff_show_meta = $options[ 'cff_show_meta' ];
    $cff_show_link = $options[ 'cff_show_link' ];
    $cff_show_like_box = $options[ 'cff_show_like_box' ];

    //Masonry
    $cff_masonry_enabled = $options[ 'cff_masonry_enabled' ];
    $cff_masonry_desktop_col = $options[ 'cff_masonry_desktop_col' ];
    $cff_masonry_mobile_col = $options[ 'cff_masonry_mobile_col' ];

    //Post Style
    $cff_post_style = $options[ 'cff_post_style' ];
    $cff_post_bg_color = $options[ 'cff_post_bg_color' ];
    $cff_post_rounded = $options[ 'cff_post_rounded' ];
    $cff_box_shadow = $options[ 'cff_box_shadow' ];

    //Typography
    $cff_title_format = $options[ 'cff_title_format' ];
    $cff_title_size = $options[ 'cff_title_size' ];
    $cff_title_weight = $options[ 'cff_title_weight' ];
    $cff_title_color = $options[ 'cff_title_color' ];
    $cff_posttext_link_color = $options[ 'cff_posttext_link_color' ];
    $cff_body_size = $options[ 'cff_body_size' ];
    $cff_body_weight = $options[ 'cff_body_weight' ];
    $cff_body_color = $options[ 'cff_body_color' ];
    $cff_link_title_format = $options[ 'cff_link_title_format' ];
    $cff_full_link_images = $options[ 'cff_full_link_images' ];
    $cff_image_size = $options[ 'cff_image_size' ];
    $cff_link_title_size = $options[ 'cff_link_title_size' ];
    $cff_link_url_size = $options[ 'cff_link_url_size' ];
    $cff_link_desc_size = $options[ 'cff_link_desc_size' ];
    $cff_link_desc_color = $options[ 'cff_link_desc_color' ];
    $cff_link_title_color = $options[ 'cff_link_title_color' ];
    $cff_link_url_color = $options[ 'cff_link_url_color' ];
    $cff_link_bg_color = $options[ 'cff_link_bg_color' ];
    $cff_link_border_color = $options[ 'cff_link_border_color' ];
    $cff_disable_link_box = $options[ 'cff_disable_link_box' ];

    //Event title
    $cff_event_title_format = $options[ 'cff_event_title_format' ];
    $cff_event_title_size = $options[ 'cff_event_title_size' ];
    $cff_event_title_weight = $options[ 'cff_event_title_weight' ];
    $cff_event_title_color = $options[ 'cff_event_title_color' ];
    //Event date
    $cff_event_date_size = $options[ 'cff_event_date_size' ];
    $cff_event_date_weight = $options[ 'cff_event_date_weight' ];
    $cff_event_date_color = $options[ 'cff_event_date_color' ];
    $cff_event_date_position = $options[ 'cff_event_date_position' ];
    $cff_event_date_formatting = $options[ 'cff_event_date_formatting' ];
    $cff_event_date_custom = $options[ 'cff_event_date_custom' ];
    //Event details
    $cff_event_details_size = $options[ 'cff_event_details_size' ];
    $cff_event_details_weight = $options[ 'cff_event_details_weight' ];
    $cff_event_details_color = $options[ 'cff_event_details_color' ];
    $cff_event_link_color = $options[ 'cff_event_link_color' ];

    //Date
    $cff_date_position = $options[ 'cff_date_position' ];
    $cff_date_size = $options[ 'cff_date_size' ];
    $cff_date_weight = $options[ 'cff_date_weight' ];
    $cff_date_color = $options[ 'cff_date_color' ];
    $cff_date_formatting = $options[ 'cff_date_formatting' ];
    $cff_date_custom = $options[ 'cff_date_custom' ];
    $cff_date_before = $options[ 'cff_date_before' ];
    $cff_date_after = $options[ 'cff_date_after' ];
    $cff_timezone = $options[ 'cff_timezone' ];

    //Translate
    $cff_see_more_text = $options[ 'cff_see_more_text' ];
    $cff_see_less_text = $options[ 'cff_see_less_text' ];
    $cff_map_text = $options[ 'cff_map_text' ];
    $cff_no_events_text = $options[ 'cff_no_events_text' ];
    $cff_facebook_link_text = $options[ 'cff_facebook_link_text' ];
    $cff_facebook_share_text = $options[ 'cff_facebook_share_text' ];
    $cff_show_facebook_link = $options[ 'cff_show_facebook_link' ];
    $cff_show_facebook_share = $options[ 'cff_show_facebook_share' ];
    $cff_buy_tickets_text = $options[ 'cff_buy_tickets_text' ];
    $cff_interested_text = $options[ 'cff_interested_text' ];
    $cff_going_text = $options[ 'cff_going_text' ];

    //Social translate
    $cff_translate_view_previous_comments_text = $options[ 'cff_translate_view_previous_comments_text' ];
    $cff_translate_comment_on_facebook_text = $options[ 'cff_translate_comment_on_facebook_text' ];
    $cff_translate_photos_text = $options[ 'cff_translate_photos_text' ];
    $cff_translate_likes_this_text = $options[ 'cff_translate_likes_this_text' ];
    $cff_translate_like_this_text = $options[ 'cff_translate_like_this_text' ];
    $cff_translate_reacted_text = $options[ 'cff_translate_reacted_text' ];
    $cff_translate_and_text = $options[ 'cff_translate_and_text' ];
    $cff_translate_other_text = $options[ 'cff_translate_other_text' ];
    $cff_translate_others_text = $options[ 'cff_translate_others_text' ];
    $cff_translate_reply_text = $options[ 'cff_translate_reply_text' ];
    $cff_translate_replies_text = $options[ 'cff_translate_replies_text' ];

    $cff_translate_learn_more_text = $options[ 'cff_translate_learn_more_text' ];
    $cff_translate_shop_now_text = $options[ 'cff_translate_shop_now_text' ];
    $cff_translate_message_page_text = $options[ 'cff_translate_message_page_text' ];
    $cff_translate_get_directions_text = $options[ 'cff_translate_get_directions_text' ];

    //Date translate
    $cff_translate_second = $options[ 'cff_translate_second' ];
    $cff_translate_seconds = $options[ 'cff_translate_seconds' ];
    $cff_translate_minute = $options[ 'cff_translate_minute' ];
    $cff_translate_minutes = $options[ 'cff_translate_minutes' ];
    $cff_translate_hour = $options[ 'cff_translate_hour' ];
    $cff_translate_hours = $options[ 'cff_translate_hours' ];
    $cff_translate_day = $options[ 'cff_translate_day' ];
    $cff_translate_days = $options[ 'cff_translate_days' ];
    $cff_translate_week = $options[ 'cff_translate_week' ];
    $cff_translate_weeks = $options[ 'cff_translate_weeks' ];
    $cff_translate_month = $options[ 'cff_translate_month' ];
    $cff_translate_months = $options[ 'cff_translate_months' ];
    $cff_translate_year = $options[ 'cff_translate_year' ];
    $cff_translate_years = $options[ 'cff_translate_years' ];
    $cff_translate_ago = $options[ 'cff_translate_ago' ];

    //View on Facebook link
    $cff_link_size = $options[ 'cff_link_size' ];
    $cff_link_weight = $options[ 'cff_link_weight' ];
    $cff_link_color = $options[ 'cff_link_color' ];
    $cff_view_link_text = $options[ 'cff_view_link_text' ];
    $cff_link_to_timeline = $options[ 'cff_link_to_timeline' ];

    //Load more button
    $cff_load_more = get_option( 'cff_load_more' );
    $cff_load_more_bg = $options[ 'cff_load_more_bg' ];
    $cff_load_more_text_color = $options[ 'cff_load_more_text_color' ];
    $cff_load_more_bg_hover = $options[ 'cff_load_more_bg_hover' ];
    $cff_load_more_text = $options[ 'cff_load_more_text' ];
    $cff_no_more_posts_text = $options[ 'cff_no_more_posts_text' ];

    //Meta
    $cff_icon_style = $options[ 'cff_icon_style' ];
    $cff_meta_text_color = $options[ 'cff_meta_text_color' ];
    $cff_meta_link_color = $options[ 'cff_meta_link_color' ];
    $cff_meta_bg_color = $options[ 'cff_meta_bg_color' ];
    $cff_expand_comments = $options[ 'cff_expand_comments' ];
    $cff_comments_num = $options[ 'cff_comments_num' ];
    $cff_nocomments_text = $options[ 'cff_nocomments_text' ];
    $cff_hide_comments = $options[ 'cff_hide_comments' ];
    $cff_hide_comment_avatars = $options[ 'cff_hide_comment_avatars' ];
    $cff_lightbox_comments = $options[ 'cff_lightbox_comments' ];

    //Misc
    $cff_feed_width = $options[ 'cff_feed_width' ];
    $cff_feed_width_resp = $options[ 'cff_feed_width_resp' ]; 
    $cff_feed_height = $options[ 'cff_feed_height' ];
    $cff_feed_padding = $options[ 'cff_feed_padding' ];
    $cff_like_box_position = $options[ 'cff_like_box_position' ];
    $cff_like_box_outside = $options[ 'cff_like_box_outside' ];
    $cff_likebox_width = $options[ 'cff_likebox_width' ];
    $cff_likebox_height = $options[ 'cff_likebox_height' ];
    $cff_like_box_faces = $options[ 'cff_like_box_faces' ];
    $cff_like_box_border = $options[ 'cff_like_box_border' ];
    $cff_like_box_cover = $options[ 'cff_like_box_cover' ];
    $cff_like_box_small_header = $options[ 'cff_like_box_small_header' ];
    $cff_like_box_hide_cta = $options[ 'cff_like_box_hide_cta' ];

    //Misc Settings
    $cff_enable_narrow = $options[ 'cff_enable_narrow' ];
    $cff_one_image = $options[ 'cff_one_image' ];

    $cff_show_media = $options[ 'cff_show_media' ];
    $cff_bg_color = $options[ 'cff_bg_color' ];
    $cff_likebox_bg_color = $options[ 'cff_likebox_bg_color' ];
    $cff_like_box_text_color = $options[ 'cff_like_box_text_color' ];
    $cff_video_height = $options[ 'cff_video_height' ];
    $cff_show_author = $options[ 'cff_show_author' ];
    $cff_class = $options[ 'cff_class' ];
    $cff_app_id = $options[ 'cff_app_id' ];
    $cff_show_credit = $options[ 'cff_show_credit' ];
    $cff_format_issue = $options[ 'cff_format_issue' ];
    $cff_disable_svgs = $options[ 'cff_disable_svgs' ];
    $cff_restricted_page = $options[ 'cff_restricted_page' ];
    $cff_font_source = $options[ 'cff_font_source' ];
    $cff_disable_ajax_cache = $options[ 'cff_disable_ajax_cache' ];
    $cff_minify = $options[ 'cff_minify' ];
    $cff_preserve_settings   = 'cff_preserve_settings';
    $cff_preserve_settings_val = get_option( $cff_preserve_settings );
    $cff_request_method = $options[ 'cff_request_method' ];
    $cff_cron = $options[ 'cff_cron' ];
    $cff_timeline_pag = $options[ 'cff_timeline_pag' ];
    $cff_grid_pag = $options[ 'cff_grid_pag' ];

    //Page Header
    $cff_show_header = $options[ 'cff_show_header' ];
    $cff_header_outside = $options[ 'cff_header_outside' ];
    $cff_header_text = $options[ 'cff_header_text' ];
    $cff_header_bg_color = $options[ 'cff_header_bg_color' ];
    $cff_header_padding = $options[ 'cff_header_padding' ];
    $cff_header_text_size = $options[ 'cff_header_text_size' ];
    $cff_header_text_weight = $options[ 'cff_header_text_weight' ];
    $cff_header_text_color = $options[ 'cff_header_text_color' ];
    $cff_header_icon = $options[ 'cff_header_icon' ];
    $cff_header_icon_color = $options[ 'cff_header_icon_color' ];
    $cff_header_icon_size = $options[ 'cff_header_icon_size' ];

    //Author
    $cff_author_size = $options[ 'cff_author_size' ];
    $cff_author_color = $options[ 'cff_author_color' ];

    //New
    $cff_custom_css = $options[ 'cff_custom_css' ];
    $cff_custom_js = $options[ 'cff_custom_js' ];

    $cff_title_link = $options[ 'cff_title_link' ];
    $cff_post_tags = $options[ 'cff_post_tags' ];
    $cff_link_hashtags = $options[ 'cff_link_hashtags' ];
    $cff_event_title_link = $options[ 'cff_event_title_link' ];
    $cff_video_action = $options[ 'cff_video_action' ];
    $cff_video_player = $options[ 'cff_video_player' ];
    $cff_sep_color = $options[ 'cff_sep_color' ];
    $cff_sep_size = $options[ 'cff_sep_size' ];
	
	// Texts lengths
	$cff_title_length   = 'cff_title_length';
    $cff_body_length    = 'cff_body_length';
    // Read in existing option value from database
    $cff_title_length_val = get_option( $cff_title_length, '400' );
    $cff_body_length_val = get_option( $cff_body_length, '200' );

    //Ajax
    $cff_ajax = 'cff_ajax';
    $cff_ajax_val = get_option( $cff_ajax );

    // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
    if( isset($_POST[ $style_hidden_field_name ]) && $_POST[ $style_hidden_field_name ] == 'Y' ) {
        //Update the General options
        if( isset($_POST[ $style_general_hidden_field_name ]) && $_POST[ $style_general_hidden_field_name ] == 'Y' ) {
            //General
            if (isset($_POST[ 'cff_feed_width' ]) ) $cff_feed_width = $_POST[ 'cff_feed_width' ];
            (isset($_POST[ 'cff_feed_width_resp' ]) ) ? $cff_feed_width_resp = $_POST[ 'cff_feed_width_resp' ] : $cff_feed_width_resp = '';
            if (isset($_POST[ 'cff_feed_height' ]) ) $cff_feed_height = $_POST[ 'cff_feed_height' ];
            if (isset($_POST[ 'cff_feed_padding' ]) ) $cff_feed_padding = $_POST[ 'cff_feed_padding' ];
            if (isset($_POST[ 'cff_bg_color' ]) ) $cff_bg_color = $_POST[ 'cff_bg_color' ];
            if (isset($_POST[ 'cff_class' ]) ) $cff_class = $_POST[ 'cff_class' ];

            //Masonry
            (isset($_POST[ 'cff_masonry_enabled' ]) ) ? $cff_masonry_enabled = $_POST[ 'cff_masonry_enabled' ] : $cff_masonry_enabled = '';
            if (isset($_POST[ 'cff_masonry_desktop_col' ])) $cff_masonry_desktop_col = $_POST[ 'cff_masonry_desktop_col' ];
            if (isset($_POST[ 'cff_masonry_mobile_col' ])) $cff_masonry_mobile_col = $_POST[ 'cff_masonry_mobile_col' ];

            //Post types
            isset($_POST[ 'cff_show_status_type' ]) ? $cff_show_status_type = $_POST[ 'cff_show_status_type' ] : $cff_show_status_type = '';
            isset($_POST[ 'cff_show_event_type' ]) ? $cff_show_event_type = $_POST[ 'cff_show_event_type' ] : $cff_show_event_type = '';
            isset($_POST[ 'cff_show_photos_type' ]) ? $cff_show_photos_type = $_POST[ 'cff_show_photos_type' ] : $cff_show_photos_type = '';
            isset($_POST[ 'cff_show_video_type' ]) ? $cff_show_video_type = $_POST[ 'cff_show_video_type' ] : $cff_show_video_type = '';
            isset($_POST[ 'cff_show_links_type' ]) ? $cff_show_links_type = $_POST[ 'cff_show_links_type' ] : $cff_show_links_type = '';
            isset($_POST[ 'cff_show_albums_type' ]) ? $cff_show_albums_type = $_POST[ 'cff_show_albums_type' ] : $cff_show_albums_type = '';

            if (isset($_POST[ 'cff_events_source' ]) ) $cff_events_source = $_POST[ 'cff_events_source' ];
            if (isset($_POST[ 'cff_event_offset' ]) ) $cff_event_offset = $_POST[ 'cff_event_offset' ];
            if (isset($_POST[ 'cff_event_image_size' ]) ) $cff_event_image_size = $_POST[ 'cff_event_image_size' ];

            if (isset($_POST[ 'cff_albums_source' ]) ) $cff_albums_source = $_POST[ 'cff_albums_source' ];
            (isset($_POST[ 'cff_show_album_title' ]) ) ? $cff_show_album_title = $_POST[ 'cff_show_album_title' ] : $cff_show_album_title = '';
            (isset($_POST[ 'cff_show_album_number' ]) ) ? $cff_show_album_number = $_POST[ 'cff_show_album_number' ] : $cff_show_album_number = '';
            if (isset($_POST[ 'cff_album_cols' ]) ) $cff_album_cols = $_POST[ 'cff_album_cols' ];

            if (isset($_POST[ 'cff_photos_source' ]) ) $cff_photos_source = $_POST[ 'cff_photos_source' ];
            if (isset($_POST[ 'cff_photos_cols' ]) ) $cff_photos_cols = $_POST[ 'cff_photos_cols' ];

            if (isset($_POST[ 'cff_videos_source' ]) ) $cff_videos_source = $_POST[ 'cff_videos_source' ];
            (isset($_POST[ 'cff_show_video_name' ]) ) ? $cff_show_video_name = $_POST[ 'cff_show_video_name' ] : $cff_show_video_name = '';
            (isset($_POST[ 'cff_show_video_desc' ]) ) ? $cff_show_video_desc = $_POST[ 'cff_show_video_desc' ] : $cff_show_video_desc = '';
            if (isset($_POST[ 'cff_video_cols' ]) ) $cff_video_cols = $_POST[ 'cff_video_cols' ];

            //Page Header
            (isset($_POST[ 'cff_show_header' ])) ? $cff_show_header = $_POST[ 'cff_show_header' ] : $cff_show_header = '';
            (isset($_POST[ 'cff_header_outside' ])) ? $cff_header_outside = $_POST[ 'cff_header_outside' ] : $cff_header_outside = '';
            if (isset($_POST[ 'cff_header_text' ])) $cff_header_text = $_POST[ 'cff_header_text' ];
            if (isset($_POST[ 'cff_header_bg_color' ])) $cff_header_bg_color = $_POST[ 'cff_header_bg_color' ];
            if (isset($_POST[ 'cff_header_padding' ])) $cff_header_padding = $_POST[ 'cff_header_padding' ];
            if (isset($_POST[ 'cff_header_text_size' ])) $cff_header_text_size = $_POST[ 'cff_header_text_size' ];
            if (isset($_POST[ 'cff_header_text_weight' ])) $cff_header_text_weight = $_POST[ 'cff_header_text_weight' ];
            if (isset($_POST[ 'cff_header_text_color' ])) $cff_header_text_color = $_POST[ 'cff_header_text_color' ];
            if (isset($_POST[ 'cff_header_icon' ])) $cff_header_icon = $_POST[ 'cff_header_icon' ];
            if (isset($_POST[ 'cff_header_icon_color' ])) $cff_header_icon_color = $_POST[ 'cff_header_icon_color' ];
            if (isset($_POST[ 'cff_header_icon_size' ])) $cff_header_icon_size = $_POST[ 'cff_header_icon_size' ];

            //Like Box
            (isset($_POST[ 'cff_show_like_box' ])) ? $cff_show_like_box = $_POST[ 'cff_show_like_box' ] : $cff_show_like_box = '';
            if (isset($_POST[ 'cff_like_box_position' ])) $cff_like_box_position = $_POST[ 'cff_like_box_position' ];
            (isset($_POST[ 'cff_like_box_outside' ])) ? $cff_like_box_outside = $_POST[ 'cff_like_box_outside' ] : $cff_like_box_outside = '';
            if (isset($_POST[ 'cff_likebox_bg_color' ])) $cff_likebox_bg_color = $_POST[ 'cff_likebox_bg_color' ];
            if (isset($_POST[ 'cff_like_box_text_color' ])) $cff_like_box_text_color = $_POST[ 'cff_like_box_text_color' ];
            if (isset($_POST[ 'cff_likebox_width' ])) $cff_likebox_width = $_POST[ 'cff_likebox_width' ];
            if (isset($_POST[ 'cff_likebox_height' ])) $cff_likebox_height = $_POST[ 'cff_likebox_height' ];
            (isset($_POST[ 'cff_like_box_faces' ])) ? $cff_like_box_faces = $_POST[ 'cff_like_box_faces' ] : $cff_like_box_faces = '';
            (isset($_POST[ 'cff_like_box_border' ])) ? $cff_like_box_border = $_POST[ 'cff_like_box_border' ] : $cff_like_box_border = '';
            (isset($_POST[ 'cff_like_box_cover' ])) ? $cff_like_box_cover = $_POST[ 'cff_like_box_cover' ] : $cff_like_box_cover = '';
            (isset($_POST[ 'cff_like_box_small_header' ])) ? $cff_like_box_small_header = $_POST[ 'cff_like_box_small_header' ] : $cff_like_box_small_header = '';
            (isset($_POST[ 'cff_like_box_hide_cta' ])) ? $cff_like_box_hide_cta = $_POST[ 'cff_like_box_hide_cta' ] : $cff_like_box_hide_cta = '';

            //Filter
            if (isset($_POST[ 'cff_filter_string' ]) ) $cff_filter_string = $_POST[ 'cff_filter_string' ];
            if (isset($_POST[ 'cff_exclude_string' ]) ) $cff_exclude_string = $_POST[ 'cff_exclude_string' ];

            //Load more button
            (isset($_POST[ 'cff_load_more' ])) ? $cff_load_more = $_POST[ 'cff_load_more' ] : $cff_load_more = '';
            if (isset($_POST[ 'cff_load_more_bg' ]) ) $cff_load_more_bg = $_POST[ 'cff_load_more_bg' ];
            if (isset($_POST[ 'cff_load_more_text_color' ]) ) $cff_load_more_text_color = $_POST[ 'cff_load_more_text_color' ];
            if (isset($_POST[ 'cff_load_more_bg_hover' ]) ) $cff_load_more_bg_hover = $_POST[ 'cff_load_more_bg_hover' ];
            if (isset($_POST[ 'cff_load_more_text' ]) ) $cff_load_more_text = $_POST[ 'cff_load_more_text' ];

            //Lightbox
            (isset($_POST[ 'cff_disable_lightbox' ]) ) ? $cff_disable_lightbox = $_POST[ 'cff_disable_lightbox' ] : $cff_disable_lightbox = '';
            if (isset($_POST[ 'cff_lightbox_bg_color' ]) ) $cff_lightbox_bg_color = $_POST[ 'cff_lightbox_bg_color' ];
            if (isset($_POST[ 'cff_lightbox_text_color' ]) ) $cff_lightbox_text_color = $_POST[ 'cff_lightbox_text_color' ];
            if (isset($_POST[ 'cff_lightbox_link_color' ]) ) $cff_lightbox_link_color = $_POST[ 'cff_lightbox_link_color' ];
            (isset($_POST[ 'cff_lightbox_comments' ])) ? $cff_lightbox_comments = $_POST[ 'cff_lightbox_comments' ] : $cff_lightbox_comments = '';

            //Reviews
            isset($_POST[ 'cff_reviews_rated_5' ]) ? $cff_reviews_rated_5 = $_POST[ 'cff_reviews_rated_5' ] : $cff_reviews_rated_5 = '';
            isset($_POST[ 'cff_reviews_rated_4' ]) ? $cff_reviews_rated_4 = $_POST[ 'cff_reviews_rated_4' ] : $cff_reviews_rated_4 = '';
            isset($_POST[ 'cff_reviews_rated_3' ]) ? $cff_reviews_rated_3 = $_POST[ 'cff_reviews_rated_3' ] : $cff_reviews_rated_3 = '';
            isset($_POST[ 'cff_reviews_rated_2' ]) ? $cff_reviews_rated_2 = $_POST[ 'cff_reviews_rated_2' ] : $cff_reviews_rated_2 = '';
            isset($_POST[ 'cff_reviews_rated_1' ]) ? $cff_reviews_rated_1 = $_POST[ 'cff_reviews_rated_1' ] : $cff_reviews_rated_1 = '';
            if (isset($_POST[ 'cff_star_size' ])) $cff_star_size = $_POST[ 'cff_star_size' ];
            if (isset($_POST[ 'cff_reviews_link_text' ]) ) $cff_reviews_link_text = $_POST[ 'cff_reviews_link_text' ];
            isset($_POST[ 'cff_reviews_no_text' ]) ? $cff_reviews_no_text = $_POST[ 'cff_reviews_no_text' ] : $cff_reviews_no_text = '';
            isset($_POST[ 'cff_reviews_hide_negative' ]) ? $cff_reviews_hide_negative = $_POST[ 'cff_reviews_hide_negative' ] : $cff_reviews_hide_negative = '';
            if (isset($_POST[ 'cff_reviews_method' ])) $cff_reviews_method = $_POST[ 'cff_reviews_method' ];

            //General
            $options[ 'cff_feed_width' ] = $cff_feed_width;
            $options[ 'cff_feed_width_resp' ] = $cff_feed_width_resp;
            $options[ 'cff_feed_height' ] = $cff_feed_height;
            $options[ 'cff_feed_padding' ] = $cff_feed_padding;
            $options[ 'cff_bg_color' ] = $cff_bg_color;
            $options[ 'cff_class' ] = $cff_class;

            //Masonry
            $options[ 'cff_masonry_enabled' ] = $cff_masonry_enabled;
            $options[ 'cff_masonry_desktop_col' ] = $cff_masonry_desktop_col;
            $options[ 'cff_masonry_mobile_col' ] = $cff_masonry_mobile_col;

            //Post types
            $options[ 'cff_show_links_type' ] = $cff_show_links_type;
            $options[ 'cff_show_event_type' ] = $cff_show_event_type;
            $options[ 'cff_show_video_type' ] = $cff_show_video_type;
            $options[ 'cff_show_photos_type' ] = $cff_show_photos_type;
            $options[ 'cff_show_status_type' ] = $cff_show_status_type;
            $options[ 'cff_show_albums_type' ] = $cff_show_albums_type;

            $options[ 'cff_events_source' ] = $cff_events_source;
            $options[ 'cff_event_offset' ] = $cff_event_offset;
            $options[ 'cff_event_image_size' ] = $cff_event_image_size;

            $options[ 'cff_albums_source' ] = $cff_albums_source;
            $options[ 'cff_show_album_title' ] = $cff_show_album_title;
            $options[ 'cff_show_album_number' ] = $cff_show_album_number;
            $options[ 'cff_album_cols' ] = $cff_album_cols;

            $options[ 'cff_photos_source' ] = $cff_photos_source;
            $options[ 'cff_photos_cols' ] = $cff_photos_cols;

            $options[ 'cff_videos_source' ] = $cff_videos_source;
            $options[ 'cff_show_video_name' ] = $cff_show_video_name;
            $options[ 'cff_show_video_desc' ] = $cff_show_video_desc;
            $options[ 'cff_video_cols' ] = $cff_video_cols;

            //Page Header
            $options[ 'cff_show_header' ] = $cff_show_header;
            $options[ 'cff_header_outside' ] = $cff_header_outside;
            $options[ 'cff_header_text' ] = $cff_header_text;
            $options[ 'cff_header_bg_color' ] = $cff_header_bg_color;
            $options[ 'cff_header_padding' ] = $cff_header_padding;
            $options[ 'cff_header_text_size' ] = $cff_header_text_size;
            $options[ 'cff_header_text_weight' ] = $cff_header_text_weight;
            $options[ 'cff_header_text_color' ] = $cff_header_text_color;
            $options[ 'cff_header_icon' ] = $cff_header_icon;
            $options[ 'cff_header_icon_color' ] = $cff_header_icon_color;
            $options[ 'cff_header_icon_size' ] = $cff_header_icon_size;

            //Like Box
            $options[ 'cff_show_like_box' ] = $cff_show_like_box;
            $options[ 'cff_like_box_position' ] = $cff_like_box_position;
            $options[ 'cff_like_box_outside' ] = $cff_like_box_outside;
            $options[ 'cff_likebox_bg_color' ] = $cff_likebox_bg_color;
            $options[ 'cff_like_box_text_color' ] = $cff_like_box_text_color;
            $options[ 'cff_likebox_width' ] = $cff_likebox_width;
            $options[ 'cff_likebox_height' ] = $cff_likebox_height;
            $options[ 'cff_like_box_faces' ] = $cff_like_box_faces;
            $options[ 'cff_like_box_border' ] = $cff_like_box_border;
            $options[ 'cff_like_box_cover' ] = $cff_like_box_cover;
            $options[ 'cff_like_box_small_header' ] = $cff_like_box_small_header;
            $options[ 'cff_like_box_hide_cta' ] = $cff_like_box_hide_cta;

            //Load more button
            update_option( 'cff_load_more', $cff_load_more );

            $options[ 'cff_load_more_bg' ] = $cff_load_more_bg;
            $options[ 'cff_load_more_text_color' ] = $cff_load_more_text_color;
            $options[ 'cff_load_more_bg_hover' ] = $cff_load_more_bg_hover;
            $options[ 'cff_load_more_text' ] = $cff_load_more_text;

            //Lightbox
            $options[ 'cff_disable_lightbox' ] = $cff_disable_lightbox;
            $options[ 'cff_lightbox_bg_color' ] = $cff_lightbox_bg_color;
            $options[ 'cff_lightbox_text_color' ] = $cff_lightbox_text_color;
            $options[ 'cff_lightbox_link_color' ] = $cff_lightbox_link_color;
            $options[ 'cff_lightbox_comments' ] = $cff_lightbox_comments;

            //Filter
            $options[ 'cff_filter_string' ] = $cff_filter_string;
            $options[ 'cff_exclude_string' ] = $cff_exclude_string;

            //Reviews
            $options[ 'cff_reviews_rated_5' ] = $cff_reviews_rated_5;
            $options[ 'cff_reviews_rated_4' ] = $cff_reviews_rated_4;
            $options[ 'cff_reviews_rated_3' ] = $cff_reviews_rated_3;
            $options[ 'cff_reviews_rated_2' ] = $cff_reviews_rated_2;
            $options[ 'cff_reviews_rated_1' ] = $cff_reviews_rated_1;
            $options[ 'cff_star_size' ] = $cff_star_size;
            $options[ 'cff_reviews_link_text' ] = $cff_reviews_link_text;
            $options[ 'cff_reviews_no_text' ] = $cff_reviews_no_text;
            $options[ 'cff_reviews_hide_negative' ] = $cff_reviews_hide_negative;
            $options[ 'cff_reviews_method' ] = $cff_reviews_method;
        }
        //Update the Post Layout options
        if( isset($_POST[ $style_post_layout_hidden_field_name ]) && $_POST[ $style_post_layout_hidden_field_name ] == 'Y' ) {
            //Layout
            if (isset($_POST[ 'cff_preset_layout' ]) ) $cff_preset_layout = $_POST[ 'cff_preset_layout' ];
            //Misc Settings
            if (isset($_POST[ 'cff_media_position' ]) ) $cff_media_position = $_POST[ 'cff_media_position' ];
            (isset($_POST[ 'cff_enable_narrow' ]) ) ? $cff_enable_narrow = $_POST[ 'cff_enable_narrow' ] : $cff_enable_narrow = '';
            (isset($_POST[ 'cff_one_image' ]) ) ? $cff_one_image = $_POST[ 'cff_one_image' ] : $cff_one_image = '';

            //Include
            (isset($_POST[ 'cff_show_author' ]) ) ? $cff_show_author = $_POST[ 'cff_show_author' ] : $cff_show_author = '';
            (isset($_POST[ 'cff_show_text' ]) ) ? $cff_show_text = $_POST[ 'cff_show_text' ] : $cff_show_text = '';
            (isset($_POST[ 'cff_show_desc' ]) ) ? $cff_show_desc = $_POST[ 'cff_show_desc' ] : $cff_show_desc = '';
            (isset($_POST[ 'cff_show_shared_links' ]) ) ? $cff_show_shared_links = $_POST[ 'cff_show_shared_links' ] : $cff_show_shared_links = '';
            (isset($_POST[ 'cff_show_date' ]) ) ? $cff_show_date = $_POST[ 'cff_show_date' ] : $cff_show_date = '';
            (isset($_POST[ 'cff_show_media' ]) ) ? $cff_show_media = $_POST[ 'cff_show_media' ] : $cff_show_media = '';
            (isset($_POST[ 'cff_show_event_title' ]) ) ? $cff_show_event_title = $_POST[ 'cff_show_event_title' ] : $cff_show_event_title = '';
            (isset($_POST[ 'cff_show_event_details' ]) ) ? $cff_show_event_details = $_POST[ 'cff_show_event_details' ] : $cff_show_event_details = '';
            (isset($_POST[ 'cff_show_meta' ]) ) ? $cff_show_meta = $_POST[ 'cff_show_meta' ] : $cff_show_meta = '';
            (isset($_POST[ 'cff_show_link' ]) ) ? $cff_show_link = $_POST[ 'cff_show_link' ] : $cff_show_link = '';

            //Layout
            $options[ 'cff_preset_layout' ] = $cff_preset_layout;
            //Misc Settings
            $options[ 'cff_media_position' ] = $cff_media_position;
            $options[ 'cff_enable_narrow' ] = $cff_enable_narrow;
            $options[ 'cff_one_image' ] = $cff_one_image;

            //Include
            $options[ 'cff_show_author' ] = $cff_show_author;
            $options[ 'cff_show_text' ] = $cff_show_text;
            $options[ 'cff_show_desc' ] = $cff_show_desc;
            $options[ 'cff_show_shared_links' ] = $cff_show_shared_links;
            $options[ 'cff_show_date' ] = $cff_show_date;
            $options[ 'cff_show_media' ] = $cff_show_media;
            $options[ 'cff_show_event_title' ] = $cff_show_event_title;
            $options[ 'cff_show_event_details' ] = $cff_show_event_details;
            $options[ 'cff_show_meta' ] = $cff_show_meta;
            $options[ 'cff_show_link' ] = $cff_show_link;

            // Hook for updating extensions
            do_action( 'cff_extension_post_layout_options_update', $_POST );
        }
        //Update the Typography options
        if( isset($_POST[ $style_typography_hidden_field_name ]) && $_POST[ $style_typography_hidden_field_name ] == 'Y' ) {
            //Character limits
            if (isset($_POST[ 'cff_title_length' ]) ) $cff_title_length_val = $_POST[ $cff_title_length ];
            if (isset($_POST[ 'cff_body_length' ]) ) $cff_body_length_val = $_POST[ $cff_body_length ];

            //Post Style
            if (isset($_POST[ 'cff_post_style' ]) ) $cff_post_style = $_POST[ 'cff_post_style' ];
            (isset($_POST[ 'cff_post_bg_color' ]) ) ? $cff_post_bg_color = $_POST[ 'cff_post_bg_color' ] : $cff_post_bg_color = '';
            (isset($_POST[ 'cff_post_rounded' ]) ) ? $cff_post_rounded = $_POST[ 'cff_post_rounded' ] : $cff_post_rounded = '';
            if (isset($_POST[ 'cff_sep_color' ])) $cff_sep_color = $_POST[ 'cff_sep_color' ];
            if (isset($_POST[ 'cff_sep_size' ])) $cff_sep_size = $_POST[ 'cff_sep_size' ];
            (isset($_POST[ 'cff_box_shadow' ]) ) ? $cff_box_shadow = $_POST[ 'cff_box_shadow' ] : $cff_box_shadow = '';

            //Author
            if (isset($_POST[ 'cff_author_size' ])) $cff_author_size = $_POST[ 'cff_author_size' ];
            if (isset($_POST[ 'cff_author_color' ])) $cff_author_color = $_POST[ 'cff_author_color' ];

            //Typography
            if (isset($_POST[ 'cff_title_format' ]) ) $cff_title_format = $_POST[ 'cff_title_format' ];
            if (isset($_POST[ 'cff_title_size' ]) ) $cff_title_size = $_POST[ 'cff_title_size' ];
            if (isset($_POST[ 'cff_title_weight' ]) ) $cff_title_weight = $_POST[ 'cff_title_weight' ];
            if (isset($_POST[ 'cff_title_color' ]) ) $cff_title_color = $_POST[ 'cff_title_color' ];
            if (isset($_POST[ 'cff_posttext_link_color' ]) ) $cff_posttext_link_color = $_POST[ 'cff_posttext_link_color' ];
            (isset($_POST[ 'cff_title_link' ]) ) ? $cff_title_link = $_POST[ 'cff_title_link' ] : $cff_title_link = '';
            (isset($_POST[ 'cff_post_tags' ]) ) ? $cff_post_tags = $_POST[ 'cff_post_tags' ] : $cff_post_tags = '';
            (isset($_POST[ 'cff_link_hashtags' ]) ) ? $cff_link_hashtags = $_POST[ 'cff_link_hashtags' ] : $cff_link_hashtags = '';
            $cff_body_size = $_POST[ 'cff_body_size' ];
            if (isset($_POST[ 'cff_body_weight' ]) ) $cff_body_weight = $_POST[ 'cff_body_weight' ];
            if (isset($_POST[ 'cff_body_color' ]) ) $cff_body_color = $_POST[ 'cff_body_color' ];
            if (isset($_POST[ 'cff_link_title_format' ]) ) $cff_link_title_format = $_POST[ 'cff_link_title_format' ];
            if (isset($_POST[ 'cff_link_title_size' ]) ) $cff_link_title_size = $_POST[ 'cff_link_title_size' ];
            if (isset($_POST[ 'cff_link_url_size' ]) ) $cff_link_url_size = $_POST[ 'cff_link_url_size' ];
            if (isset($_POST[ 'cff_link_desc_size' ]) ) $cff_link_desc_size = $_POST[ 'cff_link_desc_size' ];
            if (isset($_POST[ 'cff_link_desc_color' ]) ) $cff_link_desc_color = $_POST[ 'cff_link_desc_color' ];
            if (isset($_POST[ 'cff_link_title_color' ]) ) $cff_link_title_color = $_POST[ 'cff_link_title_color' ];
            if (isset($_POST[ 'cff_link_url_color' ]) ) $cff_link_url_color = $_POST[ 'cff_link_url_color' ];
            if (isset($_POST[ 'cff_link_bg_color' ]) ) $cff_link_bg_color = $_POST[ 'cff_link_bg_color' ];
            if (isset($_POST[ 'cff_link_border_color' ]) ) $cff_link_border_color = $_POST[ 'cff_link_border_color' ];
            (isset($_POST[ 'cff_disable_link_box' ])) ? $cff_disable_link_box = $_POST[ 'cff_disable_link_box' ] : $cff_disable_link_box = '';

            //Event title
            if (isset($_POST[ 'cff_event_title_format' ]) ) $cff_event_title_format = $_POST[ 'cff_event_title_format' ];
            if (isset($_POST[ 'cff_event_title_size' ]) ) $cff_event_title_size = $_POST[ 'cff_event_title_size' ];
            if (isset($_POST[ 'cff_event_title_weight' ]) ) $cff_event_title_weight = $_POST[ 'cff_event_title_weight' ];
            if (isset($_POST[ 'cff_event_title_color' ]) ) $cff_event_title_color = $_POST[ 'cff_event_title_color' ];
            (isset($_POST[ 'cff_event_title_link' ]) ) ? $cff_event_title_link = $_POST[ 'cff_event_title_link' ] : $cff_event_title_link = '';
            //Event date
            if (isset($_POST[ 'cff_event_date_size' ]) ) $cff_event_date_size = $_POST[ 'cff_event_date_size' ];
            if (isset($_POST[ 'cff_event_date_weight' ]) ) $cff_event_date_weight = $_POST[ 'cff_event_date_weight' ];
            if (isset($_POST[ 'cff_event_date_color' ]) ) $cff_event_date_color = $_POST[ 'cff_event_date_color' ];
            if (isset($_POST[ 'cff_event_date_position' ]) ) $cff_event_date_position = $_POST[ 'cff_event_date_position' ];
            if (isset($_POST[ 'cff_event_date_formatting' ]) ) $cff_event_date_formatting = $_POST[ 'cff_event_date_formatting' ];
            if (isset($_POST[ 'cff_event_date_custom' ]) ) $cff_event_date_custom = $_POST[ 'cff_event_date_custom' ];
            //Event details
            if (isset($_POST[ 'cff_event_details_size' ]) ) $cff_event_details_size = $_POST[ 'cff_event_details_size' ];
            if (isset($_POST[ 'cff_event_details_weight' ]) ) $cff_event_details_weight = $_POST[ 'cff_event_details_weight' ];
            if (isset($_POST[ 'cff_event_details_color' ]) ) $cff_event_details_color = $_POST[ 'cff_event_details_color' ];
            if (isset($_POST[ 'cff_event_link_color' ]) ) $cff_event_link_color = $_POST[ 'cff_event_link_color' ];

            //Date
            if (isset($_POST[ 'cff_date_position' ]) ) $cff_date_position = $_POST[ 'cff_date_position' ];
            if (isset($_POST[ 'cff_date_size' ]) ) $cff_date_size = $_POST[ 'cff_date_size' ];
            if (isset($_POST[ 'cff_date_weight' ]) ) $cff_date_weight = $_POST[ 'cff_date_weight' ];
            if (isset($_POST[ 'cff_date_color' ]) ) $cff_date_color = $_POST[ 'cff_date_color' ];
            if (isset($_POST[ 'cff_date_formatting' ]) ) $cff_date_formatting = $_POST[ 'cff_date_formatting' ];
            if (isset($_POST[ 'cff_date_custom' ]) ) $cff_date_custom = $_POST[ 'cff_date_custom' ];
            if (isset($_POST[ 'cff_date_before' ]) ) $cff_date_before = $_POST[ 'cff_date_before' ];
            if (isset($_POST[ 'cff_date_after' ]) ) $cff_date_after = $_POST[ 'cff_date_after' ];
            if (isset($_POST[ 'cff_timezone' ]) ) $cff_timezone = $_POST[ 'cff_timezone' ];

            //Meta
            if (isset($_POST[ 'cff_icon_style' ])) $cff_icon_style = $_POST[ 'cff_icon_style' ];
            if (isset($_POST[ 'cff_meta_text_color' ])) $cff_meta_text_color = $_POST[ 'cff_meta_text_color' ];
            if (isset($_POST[ 'cff_meta_bg_color' ])) $cff_meta_bg_color = $_POST[ 'cff_meta_bg_color' ];
            if (isset($_POST[ 'cff_nocomments_text' ])) $cff_nocomments_text = $_POST[ 'cff_nocomments_text' ];
            if (isset($_POST[ 'cff_hide_comments' ])) $cff_hide_comments = $_POST[ 'cff_hide_comments' ];
            if (isset($_POST[ 'cff_comments_num' ])) $cff_comments_num = $_POST[ 'cff_comments_num' ];
            if (isset($_POST[ 'cff_meta_link_color' ])) $cff_meta_link_color = $_POST[ 'cff_meta_link_color' ];
            (isset($_POST[ 'cff_expand_comments' ])) ? $cff_expand_comments = $_POST[ 'cff_expand_comments' ] : $cff_expand_comments = '';
            (isset($_POST[ 'cff_hide_comment_avatars' ])) ? $cff_hide_comment_avatars = $_POST[ 'cff_hide_comment_avatars' ] : $cff_hide_comment_avatars = '';
            (isset($_POST[ 'cff_lightbox_comments' ])) ? $cff_lightbox_comments = $_POST[ 'cff_lightbox_comments' ] : $cff_lightbox_comments = '';

            //View on Facebook link
            if (isset($_POST[ 'cff_link_size' ]) ) $cff_link_size = $_POST[ 'cff_link_size' ];
            if (isset($_POST[ 'cff_link_weight' ]) ) $cff_link_weight = $_POST[ 'cff_link_weight' ];
            if (isset($_POST[ 'cff_link_color' ]) ) $cff_link_color = $_POST[ 'cff_link_color' ];
            if (isset($_POST[ 'cff_facebook_link_text' ]) ) $cff_facebook_link_text = $_POST[ 'cff_facebook_link_text' ];
            if (isset($_POST[ 'cff_facebook_share_text' ]) ) $cff_facebook_share_text = $_POST[ 'cff_facebook_share_text' ];
            (isset($_POST[ 'cff_show_facebook_link' ]) ) ? $cff_show_facebook_link = $_POST[ 'cff_show_facebook_link' ] : $cff_show_facebook_link = '';
            (isset($_POST[ 'cff_show_facebook_share' ]) ) ? $cff_show_facebook_share = $_POST[ 'cff_show_facebook_share' ] : $cff_show_facebook_share = '';
            if (isset($_POST[ 'cff_view_link_text' ]) ) $cff_view_link_text = $_POST[ 'cff_view_link_text' ];
            if (isset($_POST[ 'cff_link_to_timeline' ]) ) $cff_link_to_timeline = $_POST[ 'cff_link_to_timeline' ];
            if (isset($_POST[ 'cff_buy_tickets_text' ]) ) $cff_buy_tickets_text = $_POST[ 'cff_buy_tickets_text' ];

            //Character limits
            update_option( $cff_title_length, $cff_title_length_val );
            update_option( $cff_body_length, $cff_body_length_val );
            
            //Author
            $options[ 'cff_author_size' ] = $cff_author_size;
            $options[ 'cff_author_color' ] = $cff_author_color;

            //Post Style
            $options[ 'cff_post_style' ] = $cff_post_style;
            $options[ 'cff_post_bg_color' ] = $cff_post_bg_color;
            $options[ 'cff_post_rounded' ] = $cff_post_rounded;
            $options[ 'cff_sep_color' ] = $cff_sep_color;
            $options[ 'cff_sep_size' ] = $cff_sep_size;
            $options[ 'cff_box_shadow' ] = $cff_box_shadow;

            //Typography
            $options[ 'cff_title_format' ] = $cff_title_format;
            $options[ 'cff_title_size' ] = $cff_title_size;
            $options[ 'cff_title_weight' ] = $cff_title_weight;
            $options[ 'cff_title_color' ] = $cff_title_color;
            $options[ 'cff_posttext_link_color' ] = $cff_posttext_link_color;
            $options[ 'cff_title_link' ] = $cff_title_link;
            $options[ 'cff_post_tags' ] = $cff_post_tags;
            $options[ 'cff_link_hashtags' ] = $cff_link_hashtags;
            $options[ 'cff_body_size' ] = $cff_body_size;
            $options[ 'cff_body_weight' ] = $cff_body_weight;
            $options[ 'cff_body_color' ] = $cff_body_color;
            $options[ 'cff_link_title_format' ] = $cff_link_title_format;
            $options[ 'cff_link_title_size' ] = $cff_link_title_size;
            $options[ 'cff_link_url_size' ] = $cff_link_url_size;
            $options[ 'cff_link_desc_size' ] = $cff_link_desc_size;
            $options[ 'cff_link_desc_color' ] = $cff_link_desc_color;
            $options[ 'cff_link_title_color' ] = $cff_link_title_color;
            $options[ 'cff_link_url_color' ] = $cff_link_url_color;
            $options[ 'cff_link_bg_color' ] = $cff_link_bg_color;
            $options[ 'cff_link_border_color' ] = $cff_link_border_color;
            $options[ 'cff_disable_link_box' ] = $cff_disable_link_box;

            //Event title
            $options[ 'cff_event_title_format' ] = $cff_event_title_format;
            $options[ 'cff_event_title_size' ] = $cff_event_title_size;
            $options[ 'cff_event_title_weight' ] = $cff_event_title_weight;
            $options[ 'cff_event_title_color' ] = $cff_event_title_color;
            $options[ 'cff_event_title_link' ] = $cff_event_title_link;
            //Event date
            $options[ 'cff_event_date_size' ] = $cff_event_date_size;
            $options[ 'cff_event_date_weight' ] = $cff_event_date_weight;
            $options[ 'cff_event_date_color' ] = $cff_event_date_color;
            $options[ 'cff_event_date_position' ] = $cff_event_date_position;
            $options[ 'cff_event_date_formatting' ] = $cff_event_date_formatting;
            $options[ 'cff_event_date_custom' ] = $cff_event_date_custom;
            //Event details
            $options[ 'cff_event_details_size' ] = $cff_event_details_size;
            $options[ 'cff_event_details_weight' ] = $cff_event_details_weight;
            $options[ 'cff_event_details_color' ] = $cff_event_details_color;
            $options[ 'cff_event_link_color' ] = $cff_event_link_color;

            //Date
            $options[ 'cff_date_position' ] = $cff_date_position;
            $options[ 'cff_date_size' ] = $cff_date_size;
            $options[ 'cff_date_weight' ] = $cff_date_weight;
            $options[ 'cff_date_color' ] = $cff_date_color;
            $options[ 'cff_date_formatting' ] = $cff_date_formatting;
            $options[ 'cff_date_custom' ] = $cff_date_custom;
            $options[ 'cff_date_before' ] = $cff_date_before;
            $options[ 'cff_date_after' ] = $cff_date_after;
            $options[ 'cff_timezone' ] = $cff_timezone;

            //Meta
            $options[ 'cff_icon_style' ] = $cff_icon_style;
            $options[ 'cff_meta_text_color' ] = $cff_meta_text_color;
            $options[ 'cff_meta_link_color' ] = $cff_meta_link_color;
            $options[ 'cff_meta_bg_color' ] = $cff_meta_bg_color;
            $options[ 'cff_expand_comments' ] = $cff_expand_comments;
            $options[ 'cff_comments_num' ] = $cff_comments_num;
            $options[ 'cff_nocomments_text' ] = $cff_nocomments_text;
            $options[ 'cff_hide_comments' ] = $cff_hide_comments;
            $options[ 'cff_hide_comment_avatars' ] = $cff_hide_comment_avatars;
            $options[ 'cff_lightbox_comments' ] = $cff_lightbox_comments;

            //View on Facebook link
            $options[ 'cff_link_size' ] = $cff_link_size;
            $options[ 'cff_link_weight' ] = $cff_link_weight;
            $options[ 'cff_link_color' ] = $cff_link_color;
            $options[ 'cff_view_link_text' ] = $cff_view_link_text;
            $options[ 'cff_link_to_timeline' ] = $cff_link_to_timeline;
            $options[ 'cff_facebook_link_text' ] = $cff_facebook_link_text;
            $options[ 'cff_facebook_share_text' ] = $cff_facebook_share_text;
            $options[ 'cff_show_facebook_link' ] = $cff_show_facebook_link;
            $options[ 'cff_show_facebook_share' ] = $cff_show_facebook_share;
            $options[ 'cff_buy_tickets_text' ] = $cff_buy_tickets_text;

        }
        //Update the Misc options
        if( isset($_POST[ $style_misc_hidden_field_name ]) && $_POST[ $style_misc_hidden_field_name ] == 'Y' ) {
            
            //Custom CSS
            if (isset($_POST[ 'cff_custom_css' ])) $cff_custom_css = $_POST[ 'cff_custom_css' ];
            if (isset($_POST[ 'cff_custom_js' ])) $cff_custom_js = $_POST[ 'cff_custom_js' ];

            //Misc
            (isset($_POST[ 'cff_full_link_images' ])) ? $cff_full_link_images = $_POST[ 'cff_full_link_images' ] : $cff_full_link_images = '';
            if (isset($_POST[ 'cff_image_size' ])) $cff_image_size = $_POST[ 'cff_image_size' ];
            if (isset($_POST[ 'cff_video_height' ])) $cff_video_height = $_POST[ 'cff_video_height' ];
            if (isset($_POST[ 'cff_video_action' ])) $cff_video_action = $_POST[ 'cff_video_action' ];
            if (isset($_POST[ 'cff_video_player' ])) $cff_video_player = $_POST[ 'cff_video_player' ];

            (isset($_POST[ $cff_ajax ])) ? $cff_ajax_val = $_POST[ 'cff_ajax' ] : $cff_ajax_val = '';
            if (isset($_POST[ 'cff_app_id' ])) $cff_app_id = $_POST[ 'cff_app_id' ];
            (isset($_POST[ 'cff_show_credit' ])) ? $cff_show_credit = $_POST[ 'cff_show_credit' ] : $cff_show_credit = '';
            (isset($_POST[ 'cff_format_issue' ])) ? $cff_format_issue = $_POST[ 'cff_format_issue' ] : $cff_format_issue = '';
            (isset($_POST[ 'cff_disable_svgs' ])) ? $cff_disable_svgs = $_POST[ 'cff_disable_svgs' ] : $cff_disable_svgs = '';
            (isset($_POST[ 'cff_restricted_page' ])) ? $cff_restricted_page = $_POST[ 'cff_restricted_page' ] : $cff_restricted_page = '';
            if (isset($_POST[ 'cff_font_source' ])) $cff_font_source = $_POST[ 'cff_font_source' ];
            if (isset($_POST[ 'cff_request_method' ])) $cff_request_method = $_POST[ 'cff_request_method' ];
            if (isset($_POST[ 'cff_cron' ])) $cff_cron = $_POST[ 'cff_cron' ];
            if (isset($_POST[ 'cff_timeline_pag' ])) $cff_timeline_pag = $_POST[ 'cff_timeline_pag' ];
            if (isset($_POST[ 'cff_grid_pag' ])) $cff_grid_pag = $_POST[ 'cff_grid_pag' ];

            (isset($_POST[ 'cff_disable_ajax_cache' ])) ? $cff_disable_ajax_cache = $_POST[ 'cff_disable_ajax_cache' ] : $cff_disable_ajax_cache = '';
            (isset($_POST[ 'cff_minify' ])) ? $cff_minify = $_POST[ 'cff_minify' ] : $cff_minify = '';
            (isset($_POST[ $cff_preserve_settings ])) ? $cff_preserve_settings_val = $_POST[ 'cff_preserve_settings' ] : $cff_preserve_settings_val = '';
        
            //Custom CSS
            $options[ 'cff_custom_css' ] = $cff_custom_css;
            $options[ 'cff_custom_js' ] = $cff_custom_js;

            //Misc
            $options[ 'cff_full_link_images' ] = $cff_full_link_images;
            $options[ 'cff_image_size' ] = $cff_image_size;
            $options[ 'cff_video_height' ] = $cff_video_height;
            $options[ 'cff_video_action' ] = $cff_video_action;
            $options[ 'cff_video_player' ] = $cff_video_player;

            update_option( $cff_ajax, $cff_ajax_val );
            $options[ 'cff_app_id' ] = $cff_app_id;
            $options[ 'cff_show_credit' ] = $cff_show_credit;
            $options[ 'cff_format_issue' ] = $cff_format_issue;
            $options[ 'cff_disable_svgs' ] = $cff_disable_svgs;
            $options[ 'cff_restricted_page' ] = $cff_restricted_page;
            $options[ 'cff_font_source' ] = $cff_font_source;
            $options[ 'cff_request_method' ] = $cff_request_method;
            $options[ 'cff_cron' ] = $cff_cron;
            $options[ 'cff_timeline_pag' ] = $cff_timeline_pag;
            $options[ 'cff_grid_pag' ] = $cff_grid_pag;

            $options[ 'cff_disable_ajax_cache' ] = $cff_disable_ajax_cache;
            $options[ 'cff_minify' ] = $cff_minify;
            update_option( $cff_preserve_settings, $cff_preserve_settings_val );


            //Get the caching type from the settings page
            $cff_caching_type = get_option('cff_caching_type');
            //If the cron is set to no or the caching type is set to cron then remove this cron event
            if( $cff_cron == 'no' || $cff_caching_type == 'background' ) wp_clear_scheduled_hook('cff_cron_job');

            //Run cron when Misc settings are saved
            if( $cff_cron == 'yes' && $cff_caching_type != 'background' ){
                //Clear the existing cron event
                wp_clear_scheduled_hook('cff_cron_job');

                $cff_cache_time = get_option( 'cff_cache_time' );
                $cff_cache_time_unit = get_option( 'cff_cache_time_unit' );

                //Set the event schedule based on what the caching time is set to
                $cff_cron_schedule = 'hourly';
                if( $cff_cache_time_unit == 'hours' && $cff_cache_time > 5 ) $cff_cron_schedule = 'twicedaily';
                if( $cff_cache_time_unit == 'days' ) $cff_cron_schedule = 'daily';

                wp_schedule_event(time(), $cff_cron_schedule, 'cff_cron_job');
            }


        }
        //Update the Custom Text / Translate options
        if( isset($_POST[ $style_custom_text_hidden_field_name ]) && $_POST[ $style_custom_text_hidden_field_name ] == 'Y' ) {

            //Translate
            if (isset($_POST[ 'cff_see_more_text' ])) $cff_see_more_text = $_POST[ 'cff_see_more_text' ];
            if (isset($_POST[ 'cff_see_less_text' ])) $cff_see_less_text = $_POST[ 'cff_see_less_text' ];
            if (isset($_POST[ 'cff_facebook_link_text' ])) $cff_facebook_link_text = $_POST[ 'cff_facebook_link_text' ];
            if (isset($_POST[ 'cff_facebook_share_text' ])) $cff_facebook_share_text = $_POST[ 'cff_facebook_share_text' ];
            if (isset($_POST[ 'cff_map_text' ])) $cff_map_text = $_POST[ 'cff_map_text' ];
            if (isset($_POST[ 'cff_no_events_text' ])) $cff_no_events_text = $_POST[ 'cff_no_events_text' ];
            if (isset($_POST[ 'cff_buy_tickets_text' ])) $cff_buy_tickets_text = $_POST[ 'cff_buy_tickets_text' ];
            if (isset($_POST[ 'cff_interested_text' ])) $cff_interested_text = $_POST[ 'cff_interested_text' ];
            if (isset($_POST[ 'cff_going_text' ])) $cff_going_text = $_POST[ 'cff_going_text' ];

            //Load more
            if (isset($_POST[ 'cff_load_more_text' ])) $cff_load_more_text = $_POST[ 'cff_load_more_text' ];
            if (isset($_POST[ 'cff_no_more_posts_text' ])) $cff_no_more_posts_text = $_POST[ 'cff_no_more_posts_text' ];

            //Social translate
            if (isset($_POST[ 'cff_translate_view_previous_comments_text' ])) $cff_translate_view_previous_comments_text = $_POST[ 'cff_translate_view_previous_comments_text' ];
            if (isset($_POST[ 'cff_translate_comment_on_facebook_text' ])) $cff_translate_comment_on_facebook_text = $_POST[ 'cff_translate_comment_on_facebook_text' ];
            if (isset($_POST[ 'cff_translate_photos_text' ])) $cff_translate_photos_text = $_POST[ 'cff_translate_photos_text' ];
            if (isset($_POST[ 'cff_translate_likes_this_text' ])) $cff_translate_likes_this_text = $_POST[ 'cff_translate_likes_this_text' ];
            if (isset($_POST[ 'cff_translate_like_this_text' ])) $cff_translate_like_this_text = $_POST[ 'cff_translate_like_this_text' ];
            if (isset($_POST[ 'cff_translate_reacted_text' ])) $cff_translate_reacted_text = $_POST[ 'cff_translate_reacted_text' ];
            if (isset($_POST[ 'cff_translate_and_text' ])) $cff_translate_and_text = $_POST[ 'cff_translate_and_text' ];
            if (isset($_POST[ 'cff_translate_other_text' ])) $cff_translate_other_text = $_POST[ 'cff_translate_other_text' ];
            if (isset($_POST[ 'cff_translate_others_text' ])) $cff_translate_others_text = $_POST[ 'cff_translate_others_text' ];
            if (isset($_POST[ 'cff_translate_reply_text' ])) $cff_translate_reply_text = $_POST[ 'cff_translate_reply_text' ];
            if (isset($_POST[ 'cff_translate_replies_text' ])) $cff_translate_replies_text = $_POST[ 'cff_translate_replies_text' ];

            if (isset($_POST[ 'cff_translate_learn_more_text' ])) $cff_translate_learn_more_text = sanitize_text_field( $_POST[ 'cff_translate_learn_more_text' ] );
            if (isset($_POST[ 'cff_translate_shop_now_text' ])) $cff_translate_shop_now_text = sanitize_text_field( $_POST[ 'cff_translate_shop_now_text' ] );
            if (isset($_POST[ 'cff_translate_message_page_text' ])) $cff_translate_message_page_text = sanitize_text_field( $_POST[ 'cff_translate_message_page_text' ] );
            if (isset($_POST[ 'cff_translate_get_directions_text' ])) $cff_translate_get_directions_text = sanitize_text_field( $_POST[ 'cff_translate_get_directions_text' ] );

            //Date translate
            if (isset($_POST[ 'cff_translate_second' ])) $cff_translate_second = $_POST[ 'cff_translate_second' ];
            if (isset($_POST[ 'cff_translate_seconds' ])) $cff_translate_seconds = $_POST[ 'cff_translate_seconds' ];
            if (isset($_POST[ 'cff_translate_minute' ])) $cff_translate_minute = $_POST[ 'cff_translate_minute' ];
            if (isset($_POST[ 'cff_translate_minutes' ])) $cff_translate_minutes = $_POST[ 'cff_translate_minutes' ];
            if (isset($_POST[ 'cff_translate_hour' ])) $cff_translate_hour = $_POST[ 'cff_translate_hour' ];
            if (isset($_POST[ 'cff_translate_hours' ])) $cff_translate_hours = $_POST[ 'cff_translate_hours' ];
            if (isset($_POST[ 'cff_translate_day' ])) $cff_translate_day = $_POST[ 'cff_translate_day' ];
            if (isset($_POST[ 'cff_translate_days' ])) $cff_translate_days = $_POST[ 'cff_translate_days' ];
            if (isset($_POST[ 'cff_translate_week' ])) $cff_translate_week = $_POST[ 'cff_translate_week' ];
            if (isset($_POST[ 'cff_translate_weeks' ])) $cff_translate_weeks = $_POST[ 'cff_translate_weeks' ];
            if (isset($_POST[ 'cff_translate_month' ])) $cff_translate_month = $_POST[ 'cff_translate_month' ];
            if (isset($_POST[ 'cff_translate_months' ])) $cff_translate_months = $_POST[ 'cff_translate_months' ];
            if (isset($_POST[ 'cff_translate_year' ])) $cff_translate_year = $_POST[ 'cff_translate_year' ];
            if (isset($_POST[ 'cff_translate_years' ])) $cff_translate_years = $_POST[ 'cff_translate_years' ];
            if (isset($_POST[ 'cff_translate_ago' ])) $cff_translate_ago = $_POST[ 'cff_translate_ago' ];

            //Translate
            $options[ 'cff_see_more_text' ] = $cff_see_more_text;
            $options[ 'cff_see_less_text' ] = $cff_see_less_text;
            $options[ 'cff_map_text' ] = $cff_map_text;
            $options[ 'cff_no_events_text' ] = $cff_no_events_text;
            $options[ 'cff_interested_text' ] = $cff_interested_text;
            $options[ 'cff_going_text' ] = $cff_going_text;

            $options[ 'cff_facebook_link_text' ] = $cff_facebook_link_text;
            $options[ 'cff_facebook_share_text' ] = $cff_facebook_share_text;

            //Load more
            $options[ 'cff_load_more_text' ] = $cff_load_more_text;
            $options[ 'cff_no_more_posts_text' ] = $cff_no_more_posts_text;

            //Social translate
            $options[ 'cff_translate_view_previous_comments_text' ] = $cff_translate_view_previous_comments_text;
            $options[ 'cff_translate_comment_on_facebook_text' ] = $cff_translate_comment_on_facebook_text;
            $options[ 'cff_translate_photos_text' ] = $cff_translate_photos_text;
            $options[ 'cff_translate_likes_this_text' ] = $cff_translate_likes_this_text;
            $options[ 'cff_translate_like_this_text' ] = $cff_translate_like_this_text;
            $options[ 'cff_translate_reacted_text' ] = $cff_translate_reacted_text;
            $options[ 'cff_translate_and_text' ] = $cff_translate_and_text;
            $options[ 'cff_translate_other_text' ] = $cff_translate_other_text;
            $options[ 'cff_translate_others_text' ] = $cff_translate_others_text;
            $options[ 'cff_translate_reply_text' ] = $cff_translate_reply_text;
            $options[ 'cff_translate_replies_text' ] = $cff_translate_replies_text;
            $options[ 'cff_buy_tickets_text' ] = $cff_buy_tickets_text;

            $options[ 'cff_translate_learn_more_text' ] = $cff_translate_learn_more_text;
            $options[ 'cff_translate_shop_now_text' ] = $cff_translate_shop_now_text;
            $options[ 'cff_translate_message_page_text' ] = $cff_translate_message_page_text;
            $options[ 'cff_translate_get_directions_text' ] = $cff_translate_get_directions_text;

            //Date translate
            $options[ 'cff_translate_second' ] = $cff_translate_second;
            $options[ 'cff_translate_seconds' ] = $cff_translate_seconds;
            $options[ 'cff_translate_minute' ] = $cff_translate_minute;
            $options[ 'cff_translate_minutes' ] = $cff_translate_minutes;
            $options[ 'cff_translate_hour' ] = $cff_translate_hour;
            $options[ 'cff_translate_hours' ] = $cff_translate_hours;
            $options[ 'cff_translate_day' ] = $cff_translate_day;
            $options[ 'cff_translate_days' ] = $cff_translate_days;
            $options[ 'cff_translate_week' ] = $cff_translate_week;
            $options[ 'cff_translate_weeks' ] = $cff_translate_weeks;
            $options[ 'cff_translate_month' ] = $cff_translate_month;
            $options[ 'cff_translate_months' ] = $cff_translate_months;
            $options[ 'cff_translate_year' ] = $cff_translate_year;
            $options[ 'cff_translate_years' ] = $cff_translate_years;
            $options[ 'cff_translate_ago' ] = $cff_translate_ago;

        }
        //Update the array
        update_option( 'cff_style_settings', $options );
        // Put an settings updated message on the screen 
    ?>
    <div class="updated"><p><strong><?php _e('Settings saved.', 'custom-facebook-feed' ); ?></strong></p></div>
    <?php } ?> 
 
    <div id="cff-admin" class="wrap">
        <div id="header">
            <h2><?php _e('Custom Facebook Feed Settings'); ?></h2>
        </div>

        <?php cff_expiration_notice(); ?>

        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $style_hidden_field_name; ?>" value="Y">
            <?php
            $cff_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
            ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=cff-top&amp;tab=configuration" class="nav-tab <?php echo $cff_active_tab == 'configuration' ? 'nav-tab-active' : ''; ?>"><?php _e('Configuration'); ?></a>
                <a href="?page=cff-style" class="nav-tab nav-tab-active"><?php _e('Customize'); ?></a>
                <a href="?page=cff-top&amp;tab=license" class="nav-tab <?php echo $cff_active_tab == 'license' ? 'nav-tab-active' : ''; ?>"><?php _e('License'); ?></a>
                <a href="?page=cff-top&amp;tab=support" class="nav-tab <?php echo $cff_active_tab == 'support' ? 'nav-tab-active' : ''; ?>"><?php _e('Support'); ?></a>
            </h2>

            <h2 class="nav-tab-wrapper cff-subtabs">
                <a href="?page=cff-style&amp;tab=general" class="nav-tab <?php echo $cff_active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General'); ?></a>
                <a href="?page=cff-style&amp;tab=post_layout" class="nav-tab <?php echo $cff_active_tab == 'post_layout' ? 'nav-tab-active' : ''; ?>"><?php _e('Post Layout'); ?></a>
                <a href="?page=cff-style&amp;tab=typography" class="nav-tab <?php echo $cff_active_tab == 'typography' ? 'nav-tab-active' : ''; ?>"><?php _e('Style Posts'); ?></a>
                <a href="?page=cff-style&amp;tab=misc" class="nav-tab <?php echo $cff_active_tab == 'misc' ? 'nav-tab-active' : ''; ?>"><?php _e('Misc'); ?></a>
                <a href="?page=cff-style&amp;tab=custom_text" class="nav-tab <?php echo $cff_active_tab == 'custom_text' ? 'nav-tab-active' : ''; ?>"><?php _e('Custom Text / Translate'); ?></a>
            </h2>
            <?php if( $cff_active_tab == 'general' ) { //Start General tab ?>

            <p class="cff_contents_links" id="general">
                <span>Jump to: </span>
                <a href="#general">General</a>
                <a href="#types">Post Types</a>
                <a href="#header">Header</a>
                <a href="#likebox">Like Box</a>
                <a href="#loadmore">"Load More" button</a>
                <a href="#lightbox">Lightbox</a>
                <a href="#filter">Filter Content by String</a>
            </p>

            <input type="hidden" name="<?php echo $style_general_hidden_field_name; ?>" value="Y">
            <br />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('General'); ?></h3>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Width'); ?></label><code class="cff_shortcode"> width
                        Eg: width=500px</code></th>
                        <td>
                            <input name="cff_feed_width" id="cff_feed_width" type="text" value="<?php esc_attr_e( $cff_feed_width ); ?>" size="6" />
                            <i style="color: #666; font-size: 11px;">Eg. 100% or 500px</i>
                            <div id="cff_width_options">
                                <input name="cff_feed_width_resp" type="checkbox" id="cff_feed_width_resp" <?php if($cff_feed_width_resp == true) echo "checked"; ?> /><label for="cff_feed_width_resp"><?php _e('Set to be 100% width on mobile?'); ?></label>
                                <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                                <p class="cff-tooltip cff-more-info"><?php _e("If you set a width on the feed then this will be used on mobile as well as desktop. Check this setting to set the feed width to be 100% on mobile so that it is responsive."); ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Height'); ?></label><code class="cff_shortcode"> height
                        Eg: height=500px</code></th>
                        <td>
                            <input name="cff_feed_height" type="text" value="<?php esc_attr_e( $cff_feed_height ); ?>" size="6" />
                            <i style="color: #666; font-size: 11px;">Eg. 500px</i>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                <p class="cff-tooltip cff-more-info"><?php _e("Use this to set a fixed height on the feed. If the feed exceeds this height then a scroll bar will be used. Leave it empty to set no maximum height."); ?></p>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e(''); ?></i></span>
                        </td>
                    </tr>
                        <th class="bump-left" scope="row"><label><?php _e('Feed Padding'); ?></label><code class="cff_shortcode"> padding
                        Eg: padding=20px</code></th>
                        <td>
                            <input name="cff_feed_padding" type="text" value="<?php esc_attr_e( $cff_feed_padding ); ?>" size="6" />
                            <i style="color: #666; font-size: 11px;">Eg. 20px or 2%</i>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This is the amount of padding/spacing that goes around the feed. This is particularly useful if you intend to set a background color on the feed."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Background Color'); ?></label><code class="cff_shortcode"> bgcolor
                        Eg: bgcolor=FF0000</code></th>
                        <td>
                            <input name="cff_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_bg_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Add CSS class to feed'); ?></label><code class="cff_shortcode"> class
                        Eg: class=myfeed</code></th>
                        <td>
                            <input name="cff_class" type="text" id="cff_class" value="<?php esc_attr_e( $cff_class ); ?>" size="25" />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("You can add your own CSS classes to the feed here. To add multiple classes separate each with a space, Eg. classone classtwo classthree"); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th class="bump-left" scope="row"><label for="cff_masonry_desktop_col">Feed Columns</label><code class="cff_shortcode"> cols
                                Eg: cols=3</code></th>
                        <td class="cff-short">
                            <select name="cff_masonry_desktop_col" id="cff_masonry_desktop_col">
                                <option value="1" <?php if( $cff_masonry_desktop_col == 1 ) { echo 'selected'; } ?>>1</option>
                                <option value="2" <?php if( $cff_masonry_desktop_col == 2 ) { echo 'selected'; } ?>>2</option>
                                <option value="3" <?php if( $cff_masonry_desktop_col == 3 ) { echo 'selected'; } ?>>3</option>
                                <option value="4" <?php if( $cff_masonry_desktop_col == 4 ) { echo 'selected'; } ?>>4</option>
                                <option value="5" <?php if( $cff_masonry_desktop_col == 5 ) { echo 'selected'; } ?>>5</option>
                                <option value="6" <?php if( $cff_masonry_desktop_col == 6 ) { echo 'selected'; } ?>>6</option>
                            </select>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;">Does not apply to "grid" feed layouts</i><a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This setting does not apply to feeds which already use a grid layout, such as photo, album, and video feeds. To control the number of columns in those feeds use the settings displayed below when selecting only one of those feed types, or use the associated shortcode setting: <code>photocols</code>, <code>albumcols</code>, <code>videocols</code>."); ?></p>
                        
                            <br />
                            <div class="cff-mobile-col-settings" <?php if( intval($cff_masonry_desktop_col) > 1 ) echo 'style="display:block;"' ?>>
                                <div class="cff-row">
                                    <label title="Click for shortcode option">Mobile Columns:</label><code class="cff_shortcode"> colsmobile
                                    Eg: colsmobile=2</code>
                                    <select name="cff_masonry_mobile_col" id="cff_masonry_mobile_col">
                                        <option value="1" <?php if( $cff_masonry_mobile_col == 1 ) { echo 'selected'; } ?>>1</option>
                                        <option value="2" <?php if( $cff_masonry_mobile_col == 2 ) { echo 'selected'; } ?>>2</option>
                                    </select>
                                </div>
                            </div>

                        </td>
                    </tr>

                    <tr id="types"></tr> <!-- Quick link -->
                </tbody>
            </table>
            
            <?php submit_button(); ?>

            <hr />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('Post Types'); ?></h3>
                    <tr valign="top" id="post-types">
                        <th class="bump-left" scope="row"><label><?php _e('Only show these types of posts:'); ?></label><code class="cff_shortcode"> type
                        Eg: type="events,status,links"

                        Options: events, links, photos, videos, status, albums</code></th>
                        <td>
                            <div>
                                <input name="cff_show_status_type" type="checkbox" id="cff_show_status_type" class="cff-post-type" <?php if($cff_show_status_type == true) echo "checked"; ?> />
                                <label for="cff_show_status_type"><?php _e('Statuses'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_event_type" id="cff_show_event_type" class="cff-post-type" <?php if($cff_show_event_type == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_event_type"><?php _e('Events'); ?></label>

                                <div class="cff-events-only-options cff-more-info cff-post-type-options">

                                    <table class="form-table">
                                        <tbody>
                                            <tr valign="top">
                                                <th class="bump-left" scope="row"><label><?php _e('Event Source'); ?></label><code class="cff_shortcode"> eventsource
                                                Eg: eventsource=eventspage</code></th>
                                                <td>
                                                    <select name="cff_events_source" id="cff_events_source">
                                                        <option value="eventspage" <?php if($cff_events_source == "eventspage") echo 'selected="selected"' ?> ><?php _e('Events page'); ?></option>
                                                        <option value="timeline" <?php if($cff_events_source == "timeline") echo 'selected="selected"' ?> ><?php _e('Timeline'); ?></option>
                                                    </select>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What's the difference?"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e("<p>This determines where your events are pulled from on your Facebook page; your Events page or your Timeline.</p><p><b>Events page</b><br />Events displayed from your Events page are in chronological order and have more information available for each event. See an example of this <a href='http://smashballoondemo.com/events/' target='_blank'>here</a>. Only upcoming events are shown in this feed, but you can display a separate feed of past events by using the shortcode: <code>[custom-facebook-feed type=events pastevents=true]</code></p>
                                                    <p><b>Timeline</b><br />Events displayed from your timeline are shown in the order that they were created and posted to your timeline. Both upcoming and past events are able to be shown in the same feed using this method.</p>
                                                    <p>If you're not sure which to choose then choose <b>Events page</b>.</p>"); ?></div>
                                                </td>
                                            </tr>

                                            <tr valign="top" class="cff-events-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Event Offset'); ?></label><code class="cff_shortcode"> eventoffset
                                                Eg: eventoffset=168</code></th>
                                                <td>
                                                    <input name="cff_event_offset" type="text" id="cff_event_offset" value="<?php esc_attr_e( $cff_event_offset ); ?>" size="5" />
                                                    <i style="color: #666; font-size: 11px;"><?php _e('Number of hours to display events for after their start time has passed'); ?></i>
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-events-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Image Size'); ?></label><code class="cff_shortcode"> eventimage
                                                Eg: eventimage=full</code></th>
                                                <td>
                                                    <select name="cff_event_image_size">
                                                        <option value="full" <?php if($cff_event_image_size == "full") echo 'selected="selected"' ?> ><?php _e('Full event image'); ?></option>
                                                        <option value="cropped" <?php if($cff_event_image_size == "cropped") echo 'selected="selected"' ?> ><?php _e('Square cropped'); ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-events-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Display Past Events'); ?></label><code class="cff_shortcode"> pastevents
                                                Eg: pastevents=full</code></th>
                                                <td>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);" style="margin-left: 0; display: inline-block; margin-top: 6px;"><?php _e("How to display past events"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e('<p>Due to the way past and future events need to be ordered differently, the past events feed is displayed separately to an upcoming events feed. To display a feed of past events from your Facebook Events page just use the following shortcode:<br /><code>[custom-facebook-feed type=events pastevents=true]</code></p><p style="padding-top: 5px"><b>Please note,</b> that after adding the shortcode option you may need to clear the plugin cache by clicking "Save Changes" on the plugin\'s main settings page so that the plugin checks Facebook for the past events.</p>'); ?></div>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2"><p><i style="color: #666; font-size: 11px; margin: 10px 0; display:block;"><?php _e('<b>Please note</b> that these options are only available if Events is the only post type selected.'); ?></i></p></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div><!-- end #cff-events-page-options -->

                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_photos_type" id="cff_show_photos_type" class="cff-post-type" <?php if($cff_show_photos_type == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_photos_type"><?php _e('Photos'); ?></label>

                                <div class="cff-photos-only-options cff-more-info cff-post-type-options">

                                    <table class="form-table">
                                        <tbody>
                                            <tr valign="top">
                                                <th class="bump-left" scope="row"><label><?php _e('Photo Source'); ?></label><code class="cff_shortcode"> photosource
                                                Eg: photosource=photospage</code></th>
                                                <td>
                                                    <select name="cff_photos_source" id="cff_photos_source">
                                                        <option value="timeline" <?php if($cff_photos_source == "timeline") echo 'selected="selected"' ?> ><?php _e('Timeline'); ?></option>
                                                        <option value="photospage" <?php if($cff_photos_source == "photospage") echo 'selected="selected"' ?> ><?php _e('Photos page'); ?></option>
                                                    </select>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What's the difference?"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e("<p>This determines where your photos are pulled from on your Facebook page; your Photos page or your Timeline.</p><p><b>Photos page</b><br />Photos are pulled in from your Facebook Photos page and displayed in a grid, just like on Facebook. See an example of this <a href='http://smashballoondemo.com/photos/' target='_blank'>here</a>.</p>
                                                    <p><b>Timeline</b><br />This displays photo posts from your Facebook timeline that contain a single photo (if it has multiple photos it's an 'album' post). The photo posts will be displayed in the order that they were posted and will include the other post information, such as date, text, comments, etc.</p>"); ?></div>
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-photo-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Number of Columns'); ?></label><code class="cff_shortcode"> photocols
                                                Eg: photocols=3</code></th>
                                                <td>
                                                    <select name="cff_photos_cols" style="width: 50px;">
                                                        <option value="1" <?php if($cff_photos_cols == "1") echo 'selected="selected"' ?> ><?php _e('1'); ?></option>
                                                        <option value="2" <?php if($cff_photos_cols == "2") echo 'selected="selected"' ?> ><?php _e('2'); ?></option>
                                                        <option value="3" <?php if($cff_photos_cols == "3") echo 'selected="selected"' ?> ><?php _e('3'); ?></option>
                                                        <option value="4" <?php if($cff_photos_cols == "4") echo 'selected="selected"' ?> ><?php _e('4'); ?></option>
                                                        <option value="5" <?php if($cff_photos_cols == "5") echo 'selected="selected"' ?> ><?php _e('5'); ?></option>
                                                        <option value="6" <?php if($cff_photos_cols == "6") echo 'selected="selected"' ?> ><?php _e('6'); ?></option>
                                                        <option value="7" <?php if($cff_photos_cols == "7") echo 'selected="selected"' ?> ><?php _e('7'); ?></option>
                                                        <option value="8" <?php if($cff_photos_cols == "8") echo 'selected="selected"' ?> ><?php _e('8'); ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2"><p><i style="color: #666; font-size: 11px; margin: 10px 0; display:block;"><?php _e('<b>Please note</b> that these options are only available if Photos is the only post type selected.'); ?></i></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_video_type" id="cff_show_video_type" class="cff-post-type" <?php if($cff_show_video_type == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_video_type"><?php _e('Videos'); ?></label>

                                <div class="cff-videos-only-options cff-more-info cff-post-type-options">

                                    <table class="form-table">
                                        <tbody>
                                            <tr valign="top">
                                                <th class="bump-left" scope="row"><label><?php _e('Video Source'); ?></label><code class="cff_shortcode"> videosource
                                                Eg: videosource=videospage</code></th>
                                                <td>
                                                    <select name="cff_videos_source" id="cff_videos_source">
                                                        <option value="videospage" <?php if($cff_videos_source == "videospage") echo 'selected="selected"' ?> ><?php _e('Videos page'); ?></option>
                                                        <option value="timeline" <?php if($cff_videos_source == "timeline") echo 'selected="selected"' ?> ><?php _e('Timeline'); ?></option>
                                                    </select>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What's the difference?"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e("<p>This determines where your videos are pulled from on your Facebook page; your Videos page or your Timeline.</p><p><b>Videos page</b><br />Videos are pulled in from your Facebook Videos page and displayed in a grid, just like on Facebook. See an example of this <a href='http://smashballoondemo.com/videos/' target='_blank'>here</a>.</p>
                                                    <p><b>Timeline</b><br />This displays posts from your Facebook timeline that contain videos. The video posts will be displayed in the order that they were posted and will include the other post information, such as date, text, comments, etc.</p>"); ?></div>
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-video-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Show Video Name'); ?></label><code class="cff_shortcode"> showvideoname
                                                Eg: showvideoname=true</code></th>
                                                <td>
                                                    <input type="checkbox" name="cff_show_video_name" id="cff_show_video_name" <?php if($cff_show_video_name == true) echo 'checked="checked"' ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-video-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Show Description'); ?></label><code class="cff_shortcode"> showvideodesc
                                                Eg: showvideodesc=true</code></th>
                                                <td>
                                                    <input type="checkbox" name="cff_show_video_desc" id="cff_show_video_desc" <?php if($cff_show_video_desc == true) echo 'checked="checked"' ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-video-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Number of columns'); ?></label><code class="cff_shortcode"> showvideodesc
                                                Eg: showvideodesc=true</code></th>
                                                <td>
                                                    <select name="cff_video_cols" style="width: 50px;">
                                                        <option value="1" <?php if($cff_video_cols == "1") echo 'selected="selected"' ?> ><?php _e('1'); ?></option>
                                                        <option value="2" <?php if($cff_video_cols == "2") echo 'selected="selected"' ?> ><?php _e('2'); ?></option>
                                                        <option value="3" <?php if($cff_video_cols == "3") echo 'selected="selected"' ?> ><?php _e('3'); ?></option>
                                                        <option value="4" <?php if($cff_video_cols == "4") echo 'selected="selected"' ?> ><?php _e('4'); ?></option>
                                                        <option value="5" <?php if($cff_video_cols == "5") echo 'selected="selected"' ?> ><?php _e('5'); ?></option>
                                                        <option value="6" <?php if($cff_video_cols == "6") echo 'selected="selected"' ?> ><?php _e('6'); ?></option>
                                                        <option value="7" <?php if($cff_video_cols == "7") echo 'selected="selected"' ?> ><?php _e('7'); ?></option>
                                                        <option value="8" <?php if($cff_video_cols == "8") echo 'selected="selected"' ?> ><?php _e('8'); ?></option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr valign="top" class="cff-video-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Display Playlist'); ?></label><code class="cff_shortcode"> pastevents
                                                Eg: pastevents=full</code></th>
                                                <td>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);" style="margin-left: 0; display: inline-block; margin-top: 6px;"><?php _e("How to display a video playlist"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e('<p>To display a playlist simply add the playlist ID to the shortcode, like so: <code>[custom-facebook-feed type=videos playlist="1234567890"]</code></p><p style="padding-top: 5px"><b>Please note,</b> the post type must be set to be "videos" either here on the settings page or in the shortcode, using <code>type=videos</code>. The playlist ID can be found in the video URL after the "vl.", eg: <code>.../videos/vl.1234567890/</code> </p>'); ?></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"><p><i style="color: #666; font-size: 11px; margin: 10px 0; display:block;"><?php _e('<b>Please note</b> that these options are only available if Videos is the only post type selected.'); ?></i></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>

                            </div>

                            <div>
                                <input type="checkbox" name="cff_show_links_type" id="cff_show_links_type" class="cff-post-type" <?php if($cff_show_links_type == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_links_type"><?php _e('Links'); ?></label>
                            </div>

                            <div>
                                <input type="checkbox" name="cff_show_albums_type" id="cff_show_albums_type" class="cff-post-type" <?php if($cff_show_albums_type == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_albums_type"><?php _e('Albums'); ?></label>

                                <div class="cff-albums-only-options cff-more-info cff-post-type-options">

                                    <table class="form-table">
                                        <tbody>
                                            <tr valign="top">
                                                <th class="bump-left" scope="row"><label><?php _e('Album Source'); ?></label><code class="cff_shortcode"> albumsource
                                                Eg: albumsource=photospage</code></th>
                                                <td>
                                                    <select name="cff_albums_source" id="cff_albums_source">
                                                        <option value="photospage" <?php if($cff_albums_source == "photospage") echo 'selected="selected"' ?> ><?php _e('Photos page'); ?></option>
                                                        <option value="timeline" <?php if($cff_albums_source == "timeline") echo 'selected="selected"' ?> ><?php _e('Timeline'); ?></option>
                                                    </select>
                                                    <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What's the difference?"); ?></a>
                                                    <div class="cff-tooltip cff-more-info"><?php _e("<p>This determines where your albums are pulled from on your Facebook page; your Photos/Albums page or your Timeline.</p><p><b>Photos page</b><br />Albums are pulled in from your Facebook Photos page and displayed in a grid, just like on Facebook. See an example of this <a href='http://smashballoondemo.com/albums/' target='_blank'>here</a>.</p>
                                                    <p><b>Timeline</b><br />This displays posts from your Facebook timeline that are sharing an album, adding photos to an album, or contain more than one photo in them. The album posts will be displayed in the order that they were posted and will include the other post information, such as date, text, comments, etc.</p>"); ?></div>
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-album-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Show Album Title'); ?></label><code class="cff_shortcode"> showalbumtitle
                                                Eg: showalbumtitle=true</code></th>
                                                <td>
                                                    <input type="checkbox" name="cff_show_album_title" id="cff_show_album_title" <?php if($cff_show_album_title == true) echo 'checked="checked"' ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-album-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Show Number of Photos'); ?></label><code class="cff_shortcode"> showalbumnum
                                                Eg: showalbumnum=true</code></th>
                                                <td>
                                                    <input type="checkbox" name="cff_show_album_number" id="cff_show_album_number" <?php if($cff_show_album_number == true) echo 'checked="checked"' ?> />
                                                </td>
                                            </tr>
                                            <tr valign="top" class="cff-album-source-options">
                                                <th class="bump-left" scope="row"><label><?php _e('Number of Columns'); ?></label><code class="cff_shortcode"> albumcols
                                                Eg: albumcols=3</code></th>
                                                <td>
                                                    <select name="cff_album_cols" style="width: 50px;">
                                                        <option value="1" <?php if($cff_album_cols == "1") echo 'selected="selected"' ?> ><?php _e('1'); ?></option>
                                                        <option value="2" <?php if($cff_album_cols == "2") echo 'selected="selected"' ?> ><?php _e('2'); ?></option>
                                                        <option value="3" <?php if($cff_album_cols == "3") echo 'selected="selected"' ?> ><?php _e('3'); ?></option>
                                                        <option value="4" <?php if($cff_album_cols == "4") echo 'selected="selected"' ?> ><?php _e('4'); ?></option>
                                                        <option value="5" <?php if($cff_album_cols == "5") echo 'selected="selected"' ?> ><?php _e('5'); ?></option>
                                                        <option value="6" <?php if($cff_album_cols == "6") echo 'selected="selected"' ?> ><?php _e('6'); ?></option>
                                                        <option value="7" <?php if($cff_album_cols == "7") echo 'selected="selected"' ?> ><?php _e('7'); ?></option>
                                                        <option value="8" <?php if($cff_album_cols == "8") echo 'selected="selected"' ?> ><?php _e('8'); ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><i style="color: #666; font-size: 11px; margin: 10px 0; display:block;"><?php _e('<b>Please note</b> that these options are only available if Albums is the only post type selected.'); ?></i></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>


                            </div>
                        </td>
                    </tr>
                    <tr id="header"></tr> <!-- Quick link -->
                </tbody>
            </table>

            <?php //Reviews options ?>
            <?php
            if ( $cff_reviews_active ){
                echo cff_ext_reviews_options($cff_reviews_rated_5, $cff_reviews_rated_4, $cff_reviews_rated_3, $cff_reviews_rated_2, $cff_reviews_rated_1,  $cff_star_size, $cff_reviews_link_text, $cff_reviews_no_text, $cff_reviews_method, $cff_reviews_hide_negative);
            }
            ?>

            <hr />

            <table class="form-table">
                <tbody>
                    <h3><?php _e('Header'); ?></h3>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show Feed Header'); ?></label><code class="cff_shortcode"> showheader
                        Eg: showheader=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_header" id="cff_show_header" <?php if($cff_show_header == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What is the header?'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("The header allows you to display text and an icon at the top of your feed. Use the button below to reveal customization settings for the text, style, and layout of the header."); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit cff-expand-button">
                <a href="javascript:void(0);" class="button">Show Customization Options</a>
            </p>
            <table class="form-table cff-expandable-options">
                <tbody>
                    </tr>
                        <th class="bump-left" scope="row"><label><?php _e('Header Text'); ?></label><code class="cff_shortcode"> headertext
            Eg: headertext='Facebook Feed'</code></th>
                        <td>
                            <input name="cff_header_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_header_text ) ); ?>" size="30" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Display outside the scrollable area'); ?></label><code class="cff_shortcode"> headeroutside
            Eg: headeroutside=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_header_outside" id="cff_header_outside" <?php if($cff_header_outside == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This positions the Header outside of the feed container. It is useful if your feed has a vertical scrollbar as it places it outside of the scrollable area and fixes it at the top."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Background Color'); ?></label><code class="cff_shortcode"> headerbg
            Eg: headerbg=DDD</code></th>
                        <td>
                            <input name="cff_header_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_bg_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    </tr>
                        <th class="bump-left" scope="row"><label><?php _e('Padding/Spacing'); ?></label><code class="cff_shortcode"> headerpadding
            Eg: headerpadding=20px</code></th>
                        <td>
                            <input name="cff_header_padding" type="text" value="<?php esc_attr_e( $cff_header_padding ); ?>" size="6" />
                            <i style="color: #666; font-size: 11px;">Eg. 20px</i>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Text Size'); ?></label><code class="cff_shortcode"> headertextsize
            Eg: headertextsize=28</code></th>
                        <td>
                            <select name="cff_header_text_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_header_text_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_header_text_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_header_text_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_header_text_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_header_text_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_header_text_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_header_text_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_header_text_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_header_text_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_header_text_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_header_text_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_header_text_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_header_text_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_header_text_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_header_text_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_header_text_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_header_text_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> headertextweight
            Eg: headertextweight=bold</code></th>
                        <td>
                            <select name="cff_header_text_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_header_text_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_header_text_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_header_text_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Text Color'); ?></label><code class="cff_shortcode"> headertextcolor
            Eg: headertextcolor=333</code></th>
                        <td>
                            <input name="cff_header_text_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_text_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Icon Type'); ?></label><code class="cff_shortcode"> headericon
            Eg: headericon=facebook</code></th>
                        <td>
                            <select name="cff_header_icon" id="cff-header-icon">
                                <option value="facebook-square" <?php if($cff_header_icon == "facebook-square") echo 'selected="selected"' ?> >Facebook 1</option>
                                <option value="facebook" <?php if($cff_header_icon == "facebook") echo 'selected="selected"' ?> >Facebook 2</option>
                                <option value="calendar" <?php if($cff_header_icon == "calendar") echo 'selected="selected"' ?> >Events 1</option>
                                <option value="calendar-o" <?php if($cff_header_icon == "calendar-o") echo 'selected="selected"' ?> >Events 2</option>
                                <option value="picture-o" <?php if($cff_header_icon == "picture-o") echo 'selected="selected"' ?> >Photos</option>
                                <option value="users" <?php if($cff_header_icon == "users") echo 'selected="selected"' ?> >People</option>
                                <option value="thumbs-o-up" <?php if($cff_header_icon == "thumbs-o-up") echo 'selected="selected"' ?> >Thumbs Up 1</option>
                                <option value="thumbs-up" <?php if($cff_header_icon == "thumbs-up") echo 'selected="selected"' ?> >Thumbs Up 2</option>
                                <option value="comment-o" <?php if($cff_header_icon == "comment-o") echo 'selected="selected"' ?> >Speech Bubble 1</option>
                                <option value="comment" <?php if($cff_header_icon == "comment") echo 'selected="selected"' ?> >Speech Bubble 2</option>
                                <option value="ticket" <?php if($cff_header_icon == "ticket") echo 'selected="selected"' ?> >Ticket</option>
                                <option value="list-alt" <?php if($cff_header_icon == "list-alt") echo 'selected="selected"' ?> >News List</option>
                                <option value="file" <?php if($cff_header_icon == "file") echo 'selected="selected"' ?> >File 1</option>
                                <option value="file-o" <?php if($cff_header_icon == "file-o") echo 'selected="selected"' ?> >File 2</option>
                                <option value="file-text" <?php if($cff_header_icon == "file-text") echo 'selected="selected"' ?> >File 3</option>
                                <option value="file-text-o" <?php if($cff_header_icon == "file-text-o") echo 'selected="selected"' ?> >File 4</option>
                                <option value="youtube-play" <?php if($cff_header_icon == "youtube-play") echo 'selected="selected"' ?> >Video</option>
                                <option value="youtube" <?php if($cff_header_icon == "youtube") echo 'selected="selected"' ?> >YouTube</option>
                                <option value="vimeo-square" <?php if($cff_header_icon == "vimeo-square") echo 'selected="selected"' ?> >Vimeo</option>
                            </select>

                            <i id="cff-header-icon-example" class="fa fa-facebook-square"></i>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Icon Color'); ?></label><code class="cff_shortcode"> headericoncolor
            Eg: headericoncolor=FFF</code></th>
                        <td>
                            <input name="cff_header_icon_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_icon_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left" scope="row"><label><?php _e('Icon Size'); ?></label><code class="cff_shortcode"> headericonsize
            Eg: headericonsize=28</code></th>
                        <td>
                            <select name="cff_header_icon_size" id="cff-header-icon-size" style="width: 80px;">
                                <option value="10" <?php if($cff_header_icon_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_header_icon_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_header_icon_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_header_icon_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_header_icon_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_header_icon_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_header_icon_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_header_icon_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_header_icon_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_header_icon_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_header_icon_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_header_icon_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_header_icon_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_header_icon_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_header_icon_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_header_icon_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr id="likebox" />

            <h3><?php _e('Like Box / Page Plugin'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show the Like Box'); ?></label><code class="cff_shortcode"> include  exclude
                        Eg: include/exclude=likebox</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_like_box" id="cff_show_like_box" <?php if($cff_show_like_box == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What is the Like Box?'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("The Like Box is an official Facebook widget that we include at the bottom or top of the feed. It contains information about your Facebook Page and allows users to 'like' it directly on your site. Use the button below to reveal customization settings for the Like Box."); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit cff-expand-button">
                <a href="javascript:void(0);" class="button">Show Customization Options</a>
            </p>
            <table class="form-table cff-expandable-options">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Position'); ?></label><code class="cff_shortcode"> likeboxpos
                        Eg: likeboxpos=top</code></th>
                        <td>
                            <select name="cff_like_box_position">
                                <option value="bottom" <?php if($cff_like_box_position == "bottom") echo 'selected="selected"' ?> ><?php _e('Bottom of feed'); ?></option>
                                <option value="top" <?php if($cff_like_box_position == "top") echo 'selected="selected"' ?> ><?php _e('Top of feed'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Display outside the scrollable area'); ?></label><code class="cff_shortcode"> likeboxoutside
                        Eg: likeboxoutside=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_outside" id="cff_like_box_outside" <?php if($cff_like_box_outside == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This positions the Like Box widget outside of the feed container. It is useful if your feed has a vertical scrollbar as it places it outside of the scrollable area and fixes it at the top or bottom."); ?></p>
                        </td>
                    </tr>
                
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show faces of fans'); ?></label><code class="cff_shortcode"> likeboxfaces
                        Eg: likeboxfaces=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_faces" id="cff_like_box_faces" <?php if($cff_like_box_faces == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This will display thumbnail photos within the Like Box of some of the people who like your page."); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Include the Cover Photo'); ?></label><code class="cff_shortcode"> likeboxcover
                        Eg: likeboxcover=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_cover" id="cff_like_box_cover" <?php if($cff_like_box_cover == true) echo 'checked="checked"' ?> />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Use a small header'); ?></label><code class="cff_shortcode"> likeboxsmallheader
                        Eg: likeboxsmallheader=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_small_header" id="cff_like_box_small_header" <?php if($cff_like_box_small_header == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("This will display a shorter version of the Like Box with a slimmer cover photo and less information."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Hide custom call to action button'); ?></label><code class="cff_shortcode"> likeboxhidebtn
                        Eg: likeboxhidebtn=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_hide_cta" id="cff_like_box_hide_cta" <?php if($cff_like_box_hide_cta == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If you have a custom 'Call To Action' button for your Facebook Page then this will hide it and display the default Like Box button."); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th class="bump-left" for="cff_likebox_width" scope="row"><label><?php _e('Custom Like Box Width'); ?></label><code class="cff_shortcode"> likeboxwidth
                        Eg: likeboxwidth=500</code></th>
                        <td>
                            <input name="cff_likebox_width" type="text" value="<?php esc_attr_e( $cff_likebox_width ); ?>" size="3" /><span class="cff-pixel-label">px</span>
                            <span><i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Default: 340, Min: 180, Max: 500'); ?></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr id="loadmore" />

            <h3><?php _e('"Load More" button'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show "Load More" Button'); ?></label><code class="cff_shortcode"> loadmore
                        Eg: loadmore=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_load_more" id="cff_load_more" <?php if($cff_load_more == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("The Load More button is added to the bottom of your feed and allows you to dynamically load more posts into your feed. Use the button below to reveal customization settings for the button."); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit cff-expand-button">
                <a href="javascript:void(0);" class="button">Show Customization Options</a>
            </p>
            <table class="form-table cff-expandable-options">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Button Background Color'); ?></label><code class="cff_shortcode"> buttoncolor
                            Eg: buttoncolor=8224e3</code></th>
                        <td>
                            <input name="cff_load_more_bg" type="text" value="<?php esc_attr_e( $cff_load_more_bg ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Button Hover Color'); ?></label><code class="cff_shortcode"> buttonhovercolor
                            Eg: buttonhovercolor=333333</code></th>
                        <td>
                            <input name="cff_load_more_bg_hover" type="text" value="<?php esc_attr_e( $cff_load_more_bg_hover ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Button Text Color'); ?></label><code class="cff_shortcode"> buttontextcolor
                            Eg: buttontextcolor=eeee22</code></th>
                        <td>
                            <input name="cff_load_more_text_color" type="text" value="<?php esc_attr_e( $cff_load_more_text_color ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Button Text'); ?></label><code class="cff_shortcode"> buttontext
                            Eg: buttontext="Show more.."</code></th>
                        <td>
                            <input name="cff_load_more_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_load_more_text ) ); ?>" size="30" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr id="lightbox" />

            <h3><?php _e('Lightbox'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Disable Popup Lightbox'); ?></label><code class="cff_shortcode"> disablelightbox
                        Eg: disablelightbox=true</code></th>
                        <td>
                            <input name="cff_disable_lightbox" type="checkbox" id="cff_disable_lightbox" <?php if($cff_disable_lightbox == true) echo "checked"; ?> />
                            <label for="cff_disable_lightbox"><?php _e('Disable'); ?></label>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit cff-expand-button">
                <a href="javascript:void(0);" class="button">Show Customization Options</a>
            </p>
            <table class="form-table cff-expandable-options">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Background Color'); ?></label></th>
                        <td>
                            <input name="cff_lightbox_bg_color" type="text" value="<?php esc_attr_e( $cff_lightbox_bg_color ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Text Color'); ?></label></th>
                        <td>
                            <input name="cff_lightbox_text_color" type="text" value="<?php esc_attr_e( $cff_lightbox_text_color ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Link Color'); ?></label></th>
                        <td>
                            <input name="cff_lightbox_link_color" type="text" value="<?php esc_attr_e( $cff_lightbox_link_color ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show Comments in Lightbox'); ?></label><code class="cff_shortcode"> lightboxcomments
                        Eg: lightboxcomments=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_lightbox_comments" id="cff_lightbox_comments" <?php if($cff_lightbox_comments == true) echo 'checked="checked"' ?> />
                            <span><i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('For timeline posts only'); ?></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr id="filter" />

            <table class="form-table">
                <tbody>
                    <h3><?php _e('Filter Content by String'); ?></h3>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Only show posts containing:'); ?></label><code class="cff_shortcode"> filter
                        Eg: filter='#wordpress,#events'</code></th>
                        <td>
                            <input name="cff_filter_string" type="text" value="<?php esc_attr_e( $cff_filter_string ); ?>" size="25" />
                            <i style="color: #666; font-size: 11px;">Eg. #smash, balloon </i>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("You can use this setting to only display posts containing these text strings. Separate multiple strings using commas. If only a few posts, or none at all, are displayed then you may need to increase the plugin's 'Post Limit' settings. See <a href='https://smashballoon.com/filtering-your-facebook-posts/' target='_blank'>this FAQ</a> to learn more about how filtering works."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e("Don't show posts containing:"); ?></label><code class="cff_shortcode"> exfilter
                        Eg: filter='#hide'</code></th>
                        <td>
                            <input name="cff_exclude_string" type="text" value="<?php esc_attr_e( $cff_exclude_string ); ?>" size="25" />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("You can use this setting to remove any posts containing these text strings. Separate multiple strings using commas."); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>


            <?php submit_button(); ?>


            <?php } //End General tab ?>
            <?php if( $cff_active_tab == 'post_layout' ) { //Start Post Layout tab ?>

            <p class="cff_contents_links" id="layout">
                <span>Jump to: </span>
                <a href="#layout">Post Layout</a>
                <a href="#showhide">Show/Hide</a>
            </p>

            <input type="hidden" name="<?php echo $style_post_layout_hidden_field_name; ?>" value="Y">
            <br />
            <h3><label><?php _e('Post Layout'); ?></label><code class="cff_shortcode"> layout
                        Eg: layout=thumb  layout=half  layout=full</code></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <td>
                            <p><?php _e("Choose a layout from the 3 below."); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="cff-layouts">
                    <div class="cff-layout cff-thumb <?php if($cff_preset_layout == "thumb") echo "cff-layout-selected"; ?>">
                        <h3><input type="radio" name="cff_preset_layout" id="cff_preset_layout" value="thumb" <?php if($cff_preset_layout == "thumb") echo "checked"; ?> />&nbsp;<?php _e('Thumbnail'); ?></h3>
                            <img src="<?php echo plugins_url( 'img/layout-thumb.png' , __FILE__ ) ?>" alt="Thumbnail Layout" />
                            
                    </div>
                    <div class="cff-layout cff-half <?php if($cff_preset_layout == "half") echo "cff-layout-selected"; ?>">
                        <h3><input type="radio" name="cff_preset_layout" id="cff_preset_layout" value="half" <?php if($cff_preset_layout == "half") echo "checked"; ?> />&nbsp;<?php _e('Half-width'); ?></h3>
                            <img src="<?php echo plugins_url( 'img/layout-half.png' , __FILE__ ) ?>" alt="Half Width Layout" />
                            
                    </div>
                    <div class="cff-layout cff-full <?php if($cff_preset_layout == "full") echo "cff-layout-selected"; ?>">
                        <h3><input type="radio" name="cff_preset_layout" id="cff_preset_layout" value="full" <?php if($cff_preset_layout == "full") echo "checked"; ?> />&nbsp;<?php _e('Full-width'); ?></h3>
                            <img src="<?php echo plugins_url( 'img/layout-full.png' , __FILE__ ) ?>" alt="Full Width Layout" />
                            
                    </div>
                </div>

                <table class="form-table">
                    <tbody>
                        <tr class="cff-media-position">
                            <th><label for="cff_media_position" class="bump-left"><?php _e('Photo/Video Position'); ?></label><code class="cff_shortcode"> mediaposition
                        Eg: mediaposition=above</code></th>
                            <td>
                                <select name="cff_media_position">
                                    <option value="below" <?php if($cff_media_position == "below") echo 'selected="selected"' ?> >Below Text</option>
                                    <option value="above" <?php if($cff_media_position == "above") echo 'selected="selected"' ?> >Above Text</option>
                                </select>
                                <i style="color: #666; font-size: 11px; margin-left: 5px;">Only applies to Full-width layout</i>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="cff_enable_narrow" class="bump-left"><?php _e('Always use the Full-width layout when posts are narrow'); ?></label><code class="cff_shortcode"> enablenarrow
                        Eg: enablenarrow=false</code></th>
                            <td>
                                <input name="cff_enable_narrow" type="checkbox" id="cff_enable_narrow" <?php if($cff_enable_narrow == true) echo "checked"; ?> />
                                <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                <p class="cff-tooltip cff-more-info"><?php _e("When displaying posts in either narrow columns or on a mobile device the plugin will automatically default to using the 'Full-width' layout as it's better suited to narrow sizes."); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="cff_one_image" class="bump-left"><?php _e('Only show one image per post'); ?></label><code class="cff_shortcode"> oneimage
                        Eg: oneimage=true</code></th>
                            <td>
                                <input name="cff_one_image" type="checkbox" id="cff_one_image" <?php if($cff_one_image == true) echo "checked"; ?> />
                                <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                <p class="cff-tooltip cff-more-info"><?php _e("If a Facebook post contains more than photo then enabling this setting means that only the first photo in the post is displayed."); ?></p>
                            </td>
                        </tr>

                        <tr id="showhide"><!-- Quick link --></tr>
                    </tbody>
                </table>

                <?php submit_button(); ?>

                <hr />
                <h3><?php _e('Show/Hide'); ?></h3>
                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Include the following in posts: <i style="font-size: 11px;">(when applicable)</i>'); ?></label><code class="cff_shortcode"> include  exclude
                        Eg: include=text,date,likebox
                        Eg: exclude=likebox

                        Options: author, text, desc, sharedlinks, date, media, eventtitle, eventdetails, social, link, likebox</code></th>
                        <td class="cff_show_hide_settings">
                            <div>
                                <input name="cff_show_author" type="checkbox" id="cff_show_author" <?php if($cff_show_author == true) echo "checked"; ?> />
                                <label for="cff_show_author">
                                    <b><?php _e('Author Name and Avatar'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The author name and avatar image that's shown at the top of each timeline post"); ?></p>
                                </label>

                            </div>
                            <div>
                                <input name="cff_show_text" type="checkbox" id="cff_show_text" <?php if($cff_show_text == true) echo "checked"; ?> />
                                <label for="cff_show_text">
                                    <b><?php _e('Post Text'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The main text of the Facebook post"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_desc" id="cff_show_desc" <?php if($cff_show_desc == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_desc">
                                    <b><?php _e('Description Text'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The description text associated with shared photos, videos, or links"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_shared_links" id="cff_show_shared_links" <?php if($cff_show_shared_links == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_shared_links">
                                    <b><?php _e('Shared Link Box'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The link info box that's created when a link is shared in a Facebook post"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_date" id="cff_show_date" <?php if($cff_show_date == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_date">
                                    <b><?php _e('Date'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The date of the post"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_media" id="cff_show_media" <?php if($cff_show_media == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_media">
                                    <b><?php _e('Photos and Videos'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("Any photos or videos in your posts"); ?></p>
                                </label>
                            </div>
                            
                            <div>
                                <input type="checkbox" name="cff_show_event_title" id="cff_show_event_title" <?php if($cff_show_event_title == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_event_title">
                                    <b><?php _e('Event Title'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The title of an event"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_event_details" id="cff_show_event_details" <?php if($cff_show_event_details == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_event_details">
                                    <b><?php _e('Event Details'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The information associated with an event"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_meta" id="cff_show_meta" <?php if($cff_show_meta == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_meta">
                                    <b><?php _e('Like, Shares, and Comments'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e("The comments box displayed at the bottom of each timeline post"); ?></p>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_link" id="cff_show_link" <?php if($cff_show_link == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_link">
                                    <b><?php _e('Post Action Links'); ?></b>
                                    <p class="cff-show-hide-desc"><?php _e('The "View on Facebook" and "Share" links at the bottom of each post'); ?></p>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr id="poststyle"><!-- Quick link --></tr>
                </tbody>
            </table>

            <?php do_action('cff_post_layout_add_settings_area'); // Hook for adding options to post layout tab ?>
            
            <?php submit_button(); ?>
            <?php } //End Post Layout tab ?>
            <?php if( $cff_active_tab == 'typography' ) { //Start Typography tab ?>

            <p class="cff_contents_links" id="postitem">
                <span>Jump to: </span>
                <a href="#postitem">Post Item</a>
                <a href="#author">Post Author</a>
                <a href="#text">Post Text</a>
                <a href="#description">Shared Post Description</a>
                <a href="#date">Post Date</a>
                <a href="#links">Shared Link Boxes</a>
                <a href="#eventtitle">Event Title</a>
                <a href="#eventdate">Event Date</a>
                <a href="#eventdetails">Event Details</a>
                <a href="#comments">Comments Box</a>
                <a href="#action">Post Action Links</a>
            </p>

            <input type="hidden" name="<?php echo $style_typography_hidden_field_name; ?>" value="Y">
            <br />
                
            <h3><?php _e('Post Item'); ?></h3>
            <table class="form-table">
                <tbody>
                <tr>
                    <th class="bump-left" scope="row"><label><?php _e('Post Style'); ?></label><code class="cff_shortcode"> poststyle
                        Eg: poststyle=regular/boxed</code></th>
                        <td>
                            <?php
                            //If a post style isn't set (eg on initial update) then set it to be regular unless a bgcolor is set
                            if( $cff_post_style == '' || empty($cff_post_style) ){
                                $cff_post_style = 'regular';
                                if( strlen($cff_post_bg_color) > 1 ) $cff_post_style = 'boxed';
                            }
                            ?>
                            <div class="cff-layouts">
                                <div class="cff-post-style cff-layout <?php if($cff_post_style == "regular") echo "cff-layout-selected"; ?>">
                                    <h3><input type="radio" name="cff_post_style" id="cff_post_style" class="cff_post_style" value="regular" <?php if($cff_post_style == "regular") echo "checked"; ?> />&nbsp;<?php _e('Regular'); ?></h3>
                                    <img src="<?php echo plugins_url( 'img/layout-half-small.png' , __FILE__ ) ?>" alt="Regular Post Style" />
                                    <img src="<?php echo plugins_url( 'img/layout-half-small.png' , __FILE__ ) ?>" alt="Regular Post Style" />
                                </div>

                                <div class="cff-post-style cff-boxed cff-layout <?php if($cff_post_style == "boxed") echo "cff-layout-selected"; ?>">
                                    <h3><input type="radio" name="cff_post_style" id="cff_post_style" class="cff_post_style" value="boxed" <?php if($cff_post_style == "boxed") echo "checked"; ?> />&nbsp;<?php _e('Boxed'); ?></h3>
                                    <img src="<?php echo plugins_url( 'img/layout-half-small.png' , __FILE__ ) ?>" alt="Box Post Style" style="margin-top: -2px;" />
                                    <img src="<?php echo plugins_url( 'img/layout-half-small.png' , __FILE__ ) ?>" alt="Box Post Style" style="margin-top: 2px;" />
                                </div>

                                <div class="cff-post-style-settings cff-regular">
                                    
                                    <div class="cff-row">
                                        <label><?php _e('Separating Line Color'); ?></label><code class="cff_shortcode"> sepcolor
                                        Eg: sepcolor=CFCFCF</code>
                                        <br />
                                        <input name="cff_sep_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_sep_color) ); ?>" class="cff-colorpicker" />
                                    </div>
                                     <div class="cff-row">
                                        <label><?php _e('Separating Line Thickness'); ?></label><code class="cff_shortcode"> sepsize
                                        Eg: sepsize=3</code>
                                        <br />
                                        <input name="cff_sep_size" type="text" value="<?php esc_attr_e( $cff_sep_size ); ?>" size="1" /><span class="cff-pixel-label">px</span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Leave empty to hide'); ?></i>
                                    </div>
                                </div>

                                <div class="cff-post-style-settings cff-boxed">
                                    <div class="cff-row">
                                        <label><?php _e('Background Color'); ?></label><code class="cff_shortcode"> postbgcolor
                                        Eg: postbgcolor=ff0000</code>
                                        <br />
                                        <input name="cff_post_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_post_bg_color) ); ?>" class="cff-colorpicker" />
                                    </div>
                                    <div class="cff-row">
                                        <label><?php _e('Rounded Corner Size'); ?></label><code class="cff_shortcode"> postcorners
                                        Eg: postcorners=10</code>
                                        <br />
                                        <input name="cff_post_rounded" type="text" value="<?php esc_attr_e( $cff_post_rounded ); ?>" size="3" /><span class="cff-pixel-label">px</span> <span><i style="color: #666; font-size: 11px; margin-left: 5px;">Eg. 5</i></span>
                                    </div>
                                     <div class="cff-row">
                                        <label><?php _e('Box Shadow'); ?></label><code class="cff_shortcode"> boxshadow
                                        Eg: boxshadow=true</code>
                                        <br />
                                        <input type="checkbox" name="cff_box_shadow" id="cff_box_shadow" <?php if($cff_box_shadow == true) echo 'checked="checked"' ?> /> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Adds a subtle shadow around the post'); ?></i>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr />

            <h3 id="author"><?php _e('Post Author'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_author_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> authorsize
            Eg: authorsize=20</code></th>
                        <td>
                            <select name="cff_author_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_author_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_author_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_author_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_author_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_author_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_author_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_author_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_author_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_author_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_author_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_author_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_author_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_author_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_author_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_author_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_author_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_author_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_author_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> authorcolor
            Eg: authorcolor=ff0000</code></th>
                        <td>
                            <input name="cff_author_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_author_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr id="text"><!-- Quick link --></tr>
                </tbody>
            </table>

            <div style="margin-top: -15px;">
                <?php submit_button(); ?>
            </div>

            <hr />

            <h3><?php _e('Post Text'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label class="bump-left"><?php _e('Maximum Post Text Length'); ?></label><code class="cff_shortcode"> textlength
            Eg: textlength=200</code></th>
                        <td>
                            <input name="cff_title_length" type="text" value="<?php esc_attr_e( $cff_title_length_val ); ?>" size="4" /><span class="cff-pixel-label"><?php _e('Characters'); ?></span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Eg. 200'); ?></i>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If the post text exceeds this length then a 'See More' link will be added. Leave empty to set no maximum length."); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_title_format" class="bump-left"><?php _e('Format'); ?></label><code class="cff_shortcode"> textformat
            Eg: textformat=h4</code></th>
                        <td>
                            <select name="cff_title_format" class="cff-text-size-setting">
                                <option value="p" <?php if($cff_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                <option value="h3" <?php if($cff_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                <option value="h4" <?php if($cff_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                <option value="h5" <?php if($cff_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                <option value="h6" <?php if($cff_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_title_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> textsize
            Eg: textsize=12</code></th>
                        <td>
                            <select name="cff_title_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_title_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_title_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> textweight
            Eg: textweight=bold</code></th>
                        <td>
                            <select name="cff_title_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_title_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_title_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_title_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_title_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> textcolor
            Eg: textcolor=333</code></th>
                        <td>
                            <input name="cff_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_title_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_posttext_link_color" class="bump-left"><?php _e('Link Color'); ?></label><code class="cff_shortcode"> textlinkcolor
            Eg: textlinkcolor=E69100</code></th>
                        <td>
                            <input name="cff_posttext_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_posttext_link_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_title_link" class="bump-left"><?php _e('Link Text to Facebook Post'); ?></label><code class="cff_shortcode"> textlink
            Eg: textlink=true</code></th>
                        <td><input type="checkbox" name="cff_title_link" id="cff_title_link" <?php if($cff_title_link == true) echo 'checked="checked"' ?> /></td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_post_tags" class="bump-left"><?php _e('Link Post Tags'); ?></label><code class="cff_shortcode"> posttags
            Eg: posttags=false</code></th>
                        <td>
                            <input type="checkbox" name="cff_post_tags" id="cff_post_tags" <?php if($cff_post_tags == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What are Post Tags?'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("When you tag another Facebook page or user in your post using the @ symbol it creates a post tag, which is a link to either that Facebook page or user profile."); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_link_hashtags" class="bump-left"><?php _e('Link Hashtags'); ?></label><code class="cff_shortcode"> linkhashtags
            Eg: linkhashtags=false</code></th>
                        <td>
                            <input type="checkbox" name="cff_link_hashtags" id="cff_link_hashtags" <?php if($cff_link_hashtags == true) echo 'checked="checked"' ?> />
                        </td>
                    </tr>
                    <tr id="description"><!-- Quick link --></tr>
                </tbody>
            </table>

            <hr />

            <h3><?php _e('Shared Post Description'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_body_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> descsize
            Eg: descsize=11</code></th>
                        <td>
                            <select name="cff_body_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_body_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_body_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_body_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_body_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_body_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_body_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_body_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_body_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_body_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_body_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_body_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_body_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_body_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_body_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_body_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_body_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_body_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_body_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> descweight
            Eg: descweight=bold</code></th>
                        <td>
                            <select name="cff_body_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_body_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_body_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_body_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_body_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> desccolor
            Eg: desccolor=9F9F9F</code></th>
                        
                        <td>
                            <input name="cff_body_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_body_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr id="date"><!-- Quick link --></tr>
                </tbody>
            </table>

            <div style="margin-top: -15px;">
                <?php submit_button(); ?>
            </div>
            <hr />

            <h3><?php _e('Post Date'); ?></h3>
            <table class="form-table">
                <tbody>
                <tr>
                    <th class="bump-left"><label for="cff_date_position" class="bump-left"><?php _e('Position'); ?></label><code class="cff_shortcode"> datepos
            Eg: datepos=below</code></th>
                    <td>
                        <select name="cff_date_position" style="width: 300px;">
                            <option value="author" <?php if($cff_date_position == "author") echo 'selected="selected"' ?> >Immediately under the post author</option>
                            <option value="above" <?php if($cff_date_position == "above") echo 'selected="selected"' ?> >At the top of the post</option>
                            <option value="below" <?php if($cff_date_position == "below") echo 'selected="selected"' ?> >At the bottom of the post</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left"><label for="cff_date_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> datesize
            Eg: datesize=14</code></th>
                    <td>
                        <select name="cff_date_size" class="cff-text-size-setting">
                            <option value="inherit" <?php if($cff_date_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                            <option value="10" <?php if($cff_date_size == "10") echo 'selected="selected"' ?> >10px</option>
                            <option value="11" <?php if($cff_date_size == "11") echo 'selected="selected"' ?> >11px</option>
                            <option value="12" <?php if($cff_date_size == "12") echo 'selected="selected"' ?> >12px</option>
                            <option value="13" <?php if($cff_date_size == "13") echo 'selected="selected"' ?> >13px</option>
                            <option value="14" <?php if($cff_date_size == "14") echo 'selected="selected"' ?> >14px</option>
                            <option value="16" <?php if($cff_date_size == "16") echo 'selected="selected"' ?> >16px</option>
                            <option value="18" <?php if($cff_date_size == "18") echo 'selected="selected"' ?> >18px</option>
                            <option value="20" <?php if($cff_date_size == "20") echo 'selected="selected"' ?> >20px</option>
                            <option value="24" <?php if($cff_date_size == "24") echo 'selected="selected"' ?> >24px</option>
                            <option value="28" <?php if($cff_date_size == "28") echo 'selected="selected"' ?> >28px</option>
                            <option value="32" <?php if($cff_date_size == "32") echo 'selected="selected"' ?> >32px</option>
                            <option value="36" <?php if($cff_date_size == "36") echo 'selected="selected"' ?> >36px</option>
                            <option value="42" <?php if($cff_date_size == "42") echo 'selected="selected"' ?> >42px</option>
                            <option value="48" <?php if($cff_date_size == "48") echo 'selected="selected"' ?> >48px</option>
                            <option value="54" <?php if($cff_date_size == "54") echo 'selected="selected"' ?> >54px</option>
                            <option value="60" <?php if($cff_date_size == "60") echo 'selected="selected"' ?> >60px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left"><label for="cff_date_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> dateweight
            Eg: dateweight=normal</code></th>
                    <td>
                        <select name="cff_date_weight" class="cff-text-size-setting">
                            <option value="inherit" <?php if($cff_date_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                            <option value="normal" <?php if($cff_date_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                            <option value="bold" <?php if($cff_date_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left"><label for="cff_date_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> datecolor
            Eg: datecolor=EAD114</code></th>
                    <td>
                        <input name="cff_date_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_date_color) ); ?>" class="cff-colorpicker" />
                    </td>
                </tr>
                        
                <tr>
                    <th class="bump-left"><label for="cff_date_formatting" class="bump-left"><?php _e('Date Formatting'); ?></label><code class="cff_shortcode"> dateformat
            Eg: dateformat=3</code></th>
                    <td>
                        <select name="cff_date_formatting" style="width: 300px;">
                            <?php $original = strtotime('2016-07-25T17:30:00+0000'); ?>
                            <option value="1" <?php if($cff_date_formatting == "1") echo 'selected="selected"' ?> ><?php _e('2 days ago'); ?></option>
                            <option value="2" <?php if($cff_date_formatting == "2") echo 'selected="selected"' ?> ><?php echo date('F jS, g:i a', $original); ?></option>
                            <option value="3" <?php if($cff_date_formatting == "3") echo 'selected="selected"' ?> ><?php echo date('F jS', $original); ?></option>
                            <option value="4" <?php if($cff_date_formatting == "4") echo 'selected="selected"' ?> ><?php echo date('D F jS', $original); ?></option>
                            <option value="5" <?php if($cff_date_formatting == "5") echo 'selected="selected"' ?> ><?php echo date('l F jS', $original); ?></option>
                            <option value="6" <?php if($cff_date_formatting == "6") echo 'selected="selected"' ?> ><?php echo date('D M jS, Y', $original); ?></option>
                            <option value="7" <?php if($cff_date_formatting == "7") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y', $original); ?></option>
                            <option value="8" <?php if($cff_date_formatting == "8") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y - g:i a', $original); ?></option>
                            <option value="9" <?php if($cff_date_formatting == "9") echo 'selected="selected"' ?> ><?php echo date("l M jS, 'y", $original); ?></option>
                            <option value="10" <?php if($cff_date_formatting == "10") echo 'selected="selected"' ?> ><?php echo date('m.d.y', $original); ?></option>
                            <option value="18" <?php if($cff_date_formatting == "18") echo 'selected="selected"' ?> ><?php echo date('m.d.y - G:i', $original); ?></option>
                            <option value="11" <?php if($cff_date_formatting == "11") echo 'selected="selected"' ?> ><?php echo date('m/d/y', $original); ?></option>
                            <option value="12" <?php if($cff_date_formatting == "12") echo 'selected="selected"' ?> ><?php echo date('d.m.y', $original); ?></option>
                            <option value="19" <?php if($cff_date_formatting == "19") echo 'selected="selected"' ?> ><?php echo date('d.m.y - G:i', $original); ?></option>
                            <option value="13" <?php if($cff_date_formatting == "13") echo 'selected="selected"' ?> ><?php echo date('d/m/y', $original); ?></option>

                            <option value="14" <?php if($cff_date_formatting == "14") echo 'selected="selected"' ?> ><?php echo date('d-m-Y, G:i', $original); ?></option>
                            <option value="15" <?php if($cff_date_formatting == "15") echo 'selected="selected"' ?> ><?php echo date('jS F Y, G:i', $original); ?></option>
                            <option value="16" <?php if($cff_date_formatting == "16") echo 'selected="selected"' ?> ><?php echo date('d M Y, G:i', $original); ?></option>
                            <option value="17" <?php if($cff_date_formatting == "17") echo 'selected="selected"' ?> ><?php echo date('l jS F Y, G:i', $original); ?></option>
                        </select>
                </tr>

                <tr>
                    <th class="bump-left"><label for="cff_timezone" class="bump-left"><?php _e('Timezone'); ?></label></th>
                    <td>
                        <select name="cff_timezone" style="width: 300px;">
                            <option value="Pacific/Midway" <?php if($cff_timezone == "Pacific/Midway") echo 'selected="selected"' ?> ><?php _e('(GMT-11:00) Midway Island, Samoa'); ?></option>
                            <option value="America/Adak" <?php if($cff_timezone == "America/Adak") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii-Aleutian'); ?></option>
                            <option value="Etc/GMT+10" <?php if($cff_timezone == "Etc/GMT+10") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii'); ?></option>
                            <option value="Pacific/Marquesas" <?php if($cff_timezone == "Pacific/Marquesas") echo 'selected="selected"' ?> ><?php _e('(GMT-09:30) Marquesas Islands'); ?></option>
                            <option value="Pacific/Gambier" <?php if($cff_timezone == "Pacific/Gambier") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Gambier Islands'); ?></option>
                            <option value="America/Anchorage" <?php if($cff_timezone == "America/Anchorage") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Alaska'); ?></option>
                            <option value="America/Ensenada" <?php if($cff_timezone == "America/Ensenada") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Tijuana, Baja California'); ?></option>
                            <option value="Etc/GMT+8" <?php if($cff_timezone == "Etc/GMT+8") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pitcairn Islands'); ?></option>
                            <option value="America/Los_Angeles" <?php if($cff_timezone == "America/Los_Angeles") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pacific Time (US & Canada)'); ?></option>
                            <option value="America/Denver" <?php if($cff_timezone == "America/Denver") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Mountain Time (US & Canada)'); ?></option>
                            <option value="America/Chihuahua" <?php if($cff_timezone == "America/Chihuahua") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Chihuahua, La Paz, Mazatlan'); ?></option>
                            <option value="America/Dawson_Creek" <?php if($cff_timezone == "America/Dawson_Creek") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Arizona'); ?></option>
                            <option value="America/Belize" <?php if($cff_timezone == "America/Belize") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Saskatchewan, Central America'); ?></option>
                            <option value="America/Cancun" <?php if($cff_timezone == "America/Cancun") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Guadalajara, Mexico City, Monterrey'); ?></option>
                            <option value="Chile/EasterIsland" <?php if($cff_timezone == "Chile/EasterIsland") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Easter Island'); ?></option>
                            <option value="America/Chicago" <?php if($cff_timezone == "America/Chicago") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Central Time (US & Canada)'); ?></option>
                            <option value="America/New_York" <?php if($cff_timezone == "America/New_York") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Eastern Time (US & Canada)'); ?></option>
                            <option value="America/Havana" <?php if($cff_timezone == "America/Havana") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Cuba'); ?></option>
                            <option value="America/Bogota" <?php if($cff_timezone == "America/Bogota") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Bogota, Lima, Quito, Rio Branco'); ?></option>
                            <option value="America/Caracas" <?php if($cff_timezone == "America/Caracas") echo 'selected="selected"' ?> ><?php _e('(GMT-04:30) Caracas'); ?></option>
                            <option value="America/Santiago" <?php if($cff_timezone == "America/Santiago") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Santiago'); ?></option>
                            <option value="America/La_Paz" <?php if($cff_timezone == "America/La_Paz") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) La Paz'); ?></option>
                            <option value="Atlantic/Stanley" <?php if($cff_timezone == "Atlantic/Stanley") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Faukland Islands'); ?></option>
                            <option value="America/Campo_Grande" <?php if($cff_timezone == "America/Campo_Grande") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Brazil'); ?></option>
                            <option value="America/Goose_Bay" <?php if($cff_timezone == "America/Goose_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Goose Bay)'); ?></option>
                            <option value="America/Glace_Bay" <?php if($cff_timezone == "America/Glace_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Canada)'); ?></option>
                            <option value="America/St_Johns" <?php if($cff_timezone == "America/St_Johns") echo 'selected="selected"' ?> ><?php _e('(GMT-03:30) Newfoundland'); ?></option>
                            <option value="America/Araguaina" <?php if($cff_timezone == "America/Araguaina") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) UTC-3'); ?></option>
                            <option value="America/Montevideo" <?php if($cff_timezone == "America/Montevideo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Montevideo'); ?></option>
                            <option value="America/Miquelon" <?php if($cff_timezone == "America/Miquelon") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Miquelon, St. Pierre'); ?></option>
                            <option value="America/Godthab" <?php if($cff_timezone == "America/Godthab") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Greenland'); ?></option>
                            <option value="America/Argentina/Buenos_Aires" <?php if($cff_timezone == "America/Argentina/Buenos_Aires") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Buenos Aires'); ?></option>
                            <option value="America/Sao_Paulo" <?php if($cff_timezone == "America/Sao_Paulo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Brasilia'); ?></option>
                            <option value="America/Noronha" <?php if($cff_timezone == "America/Noronha") echo 'selected="selected"' ?> ><?php _e('(GMT-02:00) Mid-Atlantic'); ?></option>
                            <option value="Atlantic/Cape_Verde" <?php if($cff_timezone == "Atlantic/Cape_Verde") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Cape Verde Is.'); ?></option>
                            <option value="Atlantic/Azores" <?php if($cff_timezone == "Atlantic/Azores") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Azores'); ?></option>
                            <option value="Europe/Belfast" <?php if($cff_timezone == "Europe/Belfast") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Belfast'); ?></option>
                            <option value="Europe/Dublin" <?php if($cff_timezone == "Europe/Dublin") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Dublin'); ?></option>
                            <option value="Europe/Lisbon" <?php if($cff_timezone == "Europe/Lisbon") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Lisbon'); ?></option>
                            <option value="Europe/London" <?php if($cff_timezone == "Europe/London") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : London'); ?></option>
                            <option value="Africa/Abidjan" <?php if($cff_timezone == "Africa/Abidjan") echo 'selected="selected"' ?> ><?php _e('(GMT) Monrovia, Reykjavik'); ?></option>
                            <option value="Europe/Amsterdam" <?php if($cff_timezone == "Europe/Amsterdam") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna'); ?></option>
                            <option value="Europe/Belgrade" <?php if($cff_timezone == "Europe/Belgrade") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague'); ?></option>
                            <option value="Europe/Brussels" <?php if($cff_timezone == "Europe/Brussels") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Brussels, Copenhagen, Madrid, Paris'); ?></option>
                            <option value="Africa/Algiers" <?php if($cff_timezone == "Africa/Algiers") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) West Central Africa'); ?></option>
                            <option value="Africa/Windhoek" <?php if($cff_timezone == "Africa/Windhoek") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Windhoek'); ?></option>
                            <option value="Asia/Beirut" <?php if($cff_timezone == "Asia/Beirut") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Beirut'); ?></option>
                            <option value="Africa/Cairo" <?php if($cff_timezone == "Africa/Cairo") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Cairo'); ?></option>
                            <option value="Asia/Gaza" <?php if($cff_timezone == "Asia/Gaza") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Gaza'); ?></option>
                            <option value="Africa/Blantyre" <?php if($cff_timezone == "Africa/Blantyre") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Harare, Pretoria'); ?></option>
                            <option value="Asia/Jerusalem" <?php if($cff_timezone == "Asia/Jerusalem") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Jerusalem'); ?></option>
                            <option value="Europe/Helsinki" <?php if($cff_timezone == "Europe/Helsinki") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Helsinki'); ?></option>
                            <option value="Europe/Minsk" <?php if($cff_timezone == "Europe/Minsk") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Minsk'); ?></option>
                            <option value="Asia/Damascus" <?php if($cff_timezone == "Asia/Damascus") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Syria'); ?></option>
                            <option value="Europe/Moscow" <?php if($cff_timezone == "Europe/Moscow") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Moscow, St. Petersburg, Volgograd'); ?></option>
                            <option value="Africa/Addis_Ababa" <?php if($cff_timezone == "Africa/Addis_Ababa") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Nairobi'); ?></option>
                            <option value="Asia/Tehran" <?php if($cff_timezone == "Asia/Tehran") echo 'selected="selected"' ?> ><?php _e('(GMT+03:30) Tehran'); ?></option>
                            <option value="Asia/Dubai" <?php if($cff_timezone == "Asia/Dubai") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Abu Dhabi, Muscat'); ?></option>
                            <option value="Asia/Yerevan" <?php if($cff_timezone == "Asia/Yerevan") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Yerevan'); ?></option>
                            <option value="Asia/Kabul" <?php if($cff_timezone == "Asia/Kabul") echo 'selected="selected"' ?> ><?php _e('(GMT+04:30) Kabul'); ?></option>
                            <option value="Asia/Yekaterinburg" <?php if($cff_timezone == "Asia/Yekaterinburg") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Ekaterinburg'); ?></option>
                            <option value="Asia/Tashkent" <?php if($cff_timezone == "Asia/Tashkent") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Tashkent'); ?></option>
                            <option value="Asia/Kolkata" <?php if($cff_timezone == "Asia/Kolkata") echo 'selected="selected"' ?> ><?php _e('(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi'); ?></option>
                            <option value="Asia/Katmandu" <?php if($cff_timezone == "Asia/Katmandu") echo 'selected="selected"' ?> ><?php _e('(GMT+05:45) Kathmandu'); ?></option>
                            <option value="Asia/Dhaka" <?php if($cff_timezone == "Asia/Dhaka") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Astana, Dhaka'); ?></option>
                            <option value="Asia/Novosibirsk" <?php if($cff_timezone == "Asia/Novosibirsk") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Novosibirsk'); ?></option>
                            <option value="Asia/Rangoon" <?php if($cff_timezone == "Asia/Rangoon") echo 'selected="selected"' ?> ><?php _e('(GMT+06:30) Yangon (Rangoon)'); ?></option>
                            <option value="Asia/Bangkok" <?php if($cff_timezone == "Asia/Bangkok") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Bangkok, Hanoi, Jakarta'); ?></option>
                            <option value="Asia/Krasnoyarsk" <?php if($cff_timezone == "Asia/Krasnoyarsk") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Krasnoyarsk'); ?></option>
                            <option value="Asia/Hong_Kong" <?php if($cff_timezone == "Asia/Hong_Kong") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi'); ?></option>
                            <option value="Asia/Irkutsk" <?php if($cff_timezone == "Asia/Irkutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Irkutsk, Ulaan Bataar'); ?></option>
                            <option value="Australia/Perth" <?php if($cff_timezone == "Australia/Perth") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Perth'); ?></option>
                            <option value="Australia/Eucla" <?php if($cff_timezone == "Australia/Eucla") echo 'selected="selected"' ?> ><?php _e('(GMT+08:45) Eucla'); ?></option>
                            <option value="Asia/Tokyo" <?php if($cff_timezone == "Asia/Tokyo") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Osaka, Sapporo, Tokyo'); ?></option>
                            <option value="Asia/Seoul" <?php if($cff_timezone == "Asia/Seoul") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Seoul'); ?></option>
                            <option value="Asia/Yakutsk" <?php if($cff_timezone == "Asia/Yakutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Yakutsk'); ?></option>
                            <option value="Australia/Adelaide" <?php if($cff_timezone == "Australia/Adelaide") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Adelaide'); ?></option>
                            <option value="Australia/Darwin" <?php if($cff_timezone == "Australia/Darwin") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Darwin'); ?></option>
                            <option value="Australia/Brisbane" <?php if($cff_timezone == "Australia/Brisbane") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Brisbane'); ?></option>
                            <option value="Australia/Hobart" <?php if($cff_timezone == "Australia/Hobart") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Hobart'); ?></option>
                            <option value="Asia/Vladivostok" <?php if($cff_timezone == "Asia/Vladivostok") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Vladivostok'); ?></option>
                            <option value="Australia/Lord_Howe" <?php if($cff_timezone == "Australia/Lord_Howe") echo 'selected="selected"' ?> ><?php _e('(GMT+10:30) Lord Howe Island'); ?></option>
                            <option value="Etc/GMT-11" <?php if($cff_timezone == "Etc/GMT-11") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Solomon Is., New Caledonia'); ?></option>
                            <option value="Asia/Magadan" <?php if($cff_timezone == "Asia/Magadan") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Magadan'); ?></option>
                            <option value="Pacific/Norfolk" <?php if($cff_timezone == "Pacific/Norfolk") echo 'selected="selected"' ?> ><?php _e('(GMT+11:30) Norfolk Island'); ?></option>
                            <option value="Asia/Anadyr" <?php if($cff_timezone == "Asia/Anadyr") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Anadyr, Kamchatka'); ?></option>
                            <option value="Pacific/Auckland" <?php if($cff_timezone == "Pacific/Auckland") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Auckland, Wellington'); ?></option>
                            <option value="Etc/GMT-12" <?php if($cff_timezone == "Etc/GMT-12") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Fiji, Kamchatka, Marshall Is.'); ?></option>
                            <option value="Pacific/Chatham" <?php if($cff_timezone == "Pacific/Chatham") echo 'selected="selected"' ?> ><?php _e('(GMT+12:45) Chatham Islands'); ?></option>
                            <option value="Pacific/Tongatapu" <?php if($cff_timezone == "Pacific/Tongatapu") echo 'selected="selected"' ?> ><?php _e('(GMT+13:00) Nuku\'alofa'); ?></option>
                            <option value="Pacific/Kiritimati" <?php if($cff_timezone == "Pacific/Kiritimati") echo 'selected="selected"' ?> ><?php _e('(GMT+14:00) Kiritimati'); ?></option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th class="bump-left"><label for="cff_date_custom" class="bump-left"><?php _e('Custom Format'); ?></label><code class="cff_shortcode"> datecustom
            Eg: datecustom='D M jS, Y'</code></th>
                    <td>
                        <input name="cff_date_custom" type="text" value="<?php esc_attr_e( $cff_date_custom ); ?>" size="10" placeholder="Eg. F j, Y" />
                        <a href="http://smashballoon.com/custom-facebook-feed/docs/date/" class="cff-external-link" target="_blank"><?php _e('Examples'); ?></a>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left"><label for="cff_date_before" class="bump-left"><?php _e('Text Before Date'); ?></label><code class="cff_shortcode"> beforedate
            Eg: beforedate='Posted'</code></th>
                    <td>
                        <input name="cff_date_before" type="text" value="<?php esc_attr_e( $cff_date_before ); ?>" size="20" placeholder="Eg. Posted" />
                        <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <p class="cff-tooltip cff-more-info"><?php _e('You can add custom text here to display immediately <b>before</b> the date text'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left"><label for="cff_date_after" class="bump-left"><?php _e('Text After Date'); ?></label><code class="cff_shortcode"> afterdate
            Eg: afterdate='Ago'</code></th>
                    <td>
                        <input name="cff_date_after" type="text" value="<?php esc_attr_e( $cff_date_after ); ?>" size="20" placeholder="Eg. by ___" />
                        <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                        <p class="cff-tooltip cff-more-info"><?php _e('You can add custom text here to display immediately <b>after</b> the date text'); ?></p>
                    </td>
                </tr>
                <tr id="links"><!-- Quick link --></tr>
                </tbody>
            </table>

            <hr />


            <h3><?php _e('Shared Link Boxes'); ?></h3>
            <table class="form-table">
                <tbody>

                    <tr class="cff-settings-row-header"><th>Box Style</th></tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_bg_color" class="bump-left"><?php _e('Link Box Background Color'); ?></label><code class="cff_shortcode"> linkbgcolor
            Eg: linkbgcolor='EEE'</code></th>
                        <td>
                            <input name="cff_link_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_bg_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_link_border_color" class="bump-left"><?php _e('Link Box Border Color'); ?></label><code class="cff_shortcode"> linkbordercolor
            Eg: linkbordercolor='CCC'</code></th>
                        <td>
                            <input name="cff_link_border_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_border_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_disable_link_box" class="bump-left"><?php _e('Remove Background/Border'); ?></label><code class="cff_shortcode"> disablelinkbox
            Eg: disablelinkbox=true</code></th>
                        <td><input type="checkbox" name="cff_disable_link_box" id="cff_disable_link_box" <?php if($cff_disable_link_box == true) echo 'checked="checked"' ?> /></td>
                    </tr>

                    <tr class="cff-settings-row-header"><th>Link Title</th></tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_title_format" class="bump-left"><?php _e('Link Title Format'); ?></label><code class="cff_shortcode"> linktitleformat
            Eg: linktitleformat='h3'</code></th>
                        <td>
                            <select name="cff_link_title_format" class="cff-text-size-setting">
                                <option value="p" <?php if($cff_link_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                <option value="h3" <?php if($cff_link_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                <option value="h4" <?php if($cff_link_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                <option value="h5" <?php if($cff_link_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                <option value="h6" <?php if($cff_link_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_title_size" class="bump-left"><?php _e('Link Title Size'); ?></label><code class="cff_shortcode"> linktitlesize
            Eg: linktitlesize='18'</code></th>
                        <td>
                            <select name="cff_link_title_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_link_title_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_link_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_link_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_link_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_link_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_link_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_link_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_link_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_link_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_link_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_link_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_link_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_link_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_link_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_link_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_link_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_link_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_title_color" class="bump-left"><?php _e('Link Title Color'); ?></label><code class="cff_shortcode"> linktitlecolor
            Eg: linktitlecolor='ff0000'</code></th>
                        <td>
                            <input name="cff_link_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_title_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>

                    <tr class="cff-settings-row-header"><th>Link URL</th></tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_url_size" class="bump-left"><?php _e('Link URL Size'); ?></label><code class="cff_shortcode"> linkurlsize
            Eg: linkurlsize='12'</code></th>
                        <td>
                            <select name="cff_link_url_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_link_url_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_link_url_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_link_url_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_link_url_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_link_url_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_link_url_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_link_url_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_link_url_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_link_url_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_link_url_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_link_url_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_link_url_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_link_url_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_link_url_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_link_url_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_link_url_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_link_url_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_url_color" class="bump-left"><?php _e('Link URL Color'); ?></label><code class="cff_shortcode"> linkurlcolor
            Eg: linkurlcolor='999999'</code></th>
                        <td>
                            <input name="cff_link_url_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_url_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>

                    <tr class="cff-settings-row-header"><th>Link Description</th></tr>

                    <tr>
                        <th class="bump-left"><label for="cff_link_desc_size" class="bump-left"><?php _e('Link Description Size'); ?></label><code class="cff_shortcode"> linkdescsize
            Eg: linkdescsize='14'</code></th>
                        <td>
                            <select name="cff_link_desc_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_link_desc_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_link_desc_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_link_desc_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_link_desc_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_link_desc_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_link_desc_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_link_desc_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_link_desc_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_link_desc_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_link_desc_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_link_desc_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_link_desc_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_link_desc_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_link_desc_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_link_desc_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_link_desc_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_link_desc_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_link_desc_color" class="bump-left"><?php _e('Link Description Color'); ?></label><code class="cff_shortcode"> linkdesccolor
            Eg: linkdesccolor='ff0000'</code></th>
                        <td>
                            <input name="cff_link_desc_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_desc_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>

                    <tr valign="top">
                        <th class="bump-left" scope="row"><label class="bump-left"><?php _e('Maximum Link Description Length'); ?></label><code class="cff_shortcode"> desclength
            Eg: desclength=150</code></th>
                        <td>
                            <input name="cff_body_length" type="text" value="<?php esc_attr_e( $cff_body_length_val ); ?>" size="4" /><span class="cff-pixel-label"><?php _e('Characters'); ?></span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Eg. 200'); ?></i>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If the link description text exceeds this length then it will be truncated with an ellipsis. Leave empty to set no maximum length."); ?></p>
                        </td>
                    </tr>
                    <tr id="eventtitle"><!-- Quick link --></tr>
                </tbody>
            </table>

            <div style="margin-top: -15px;">
                <?php submit_button(); ?>
            </div>
            <hr />

            <h3><?php _e('Event Title'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_event_title_format" class="bump-left"><?php _e('Format'); ?></label><code class="cff_shortcode"> eventtitleformat
                Eg: eventtitleformat=h5</code></th>
                        <td>
                            <select name="cff_event_title_format" class="cff-text-size-setting">
                                <option value="p" <?php if($cff_event_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                <option value="h3" <?php if($cff_event_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                <option value="h4" <?php if($cff_event_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                <option value="h5" <?php if($cff_event_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                <option value="h6" <?php if($cff_event_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="bump-left"><label for="cff_event_title_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> eventtitlesize
                Eg: eventtitlesize=12</code></th>
                        <td>
                            <select name="cff_event_title_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_title_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_event_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_event_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_event_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_event_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_event_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_event_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_event_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_event_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_event_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_event_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_event_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_event_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_event_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_event_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_event_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_event_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_title_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> eventtitleweight
                Eg: eventtitleweight=bold</code></th>
                        <td>
                            <select name="cff_event_title_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_title_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_event_title_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_event_title_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_title_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> eventtitlecolor
                Eg: eventtitlecolor=666</code></th>
                        <td>
                            <input name="cff_event_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_title_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_title_link" class="bump-left"><?php _e('Link Title to Event on Facebook'); ?></label><code class="cff_shortcode"> eventtitlelink
                Eg: eventtitlelink=true</code></th>
                        <td><input type="checkbox" name="cff_event_title_link" id="cff_event_title_link" <?php if($cff_event_title_link == true) echo 'checked="checked"' ?> /></td>
                    </tr>
                    <tr id="eventdate"><!-- Quick link --></tr>
                </tbody>
            </table>
            <hr />
            
            <h3><?php _e('Event Date'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_event_date_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> eventdatesize
                Eg: eventdatesize=18</code></th>
                        <td>
                            <select name="cff_event_date_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_date_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_event_date_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_event_date_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_event_date_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_event_date_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_event_date_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_event_date_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_event_date_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_event_date_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_event_date_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_event_date_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_event_date_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_event_date_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_event_date_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_event_date_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_event_date_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_event_date_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_date_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> eventdateweight
                Eg: eventdateweight=bold</code></th>
                        <td>
                            <select name="cff_event_date_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_date_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_event_date_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_event_date_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_date_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> eventdatecolor
                Eg: eventdatecolor=EB6A00</code></th>
                        <td>
                            <input name="cff_event_date_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_date_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label class="bump-left"><?php _e('Date Position'); ?></label><code class="cff_shortcode"> eventdatepos
                Eg: eventdatepos=below</code></th>
                        <td>
                            <select name="cff_event_date_position">
                                <option value="below" <?php if($cff_event_date_position == "below") echo 'selected="selected"' ?> ><?php _e('Below event title'); ?></option>
                                <option value="above" <?php if($cff_event_date_position == "above") echo 'selected="selected"' ?> ><?php _e('Above event title'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_date_formatting" class="bump-left"><?php _e('Event Date Formatting'); ?></label><code class="cff_shortcode"> eventdateformat
                Eg: eventdateformat=12</code></th>
                        <td>
                            <select name="cff_event_date_formatting" style="width: 280px;">
                                <?php $original = strtotime('2016-07-25T17:30:00+0000'); ?>
                                <option value="14" <?php if($cff_event_date_formatting == "14") echo 'selected="selected"' ?> ><?php echo date('M j, g:ia', $original); ?></option>
                                <option value="15" <?php if($cff_event_date_formatting == "15") echo 'selected="selected"' ?> ><?php echo date('M j, G:i', $original); ?></option>
                                <option value="1" <?php if($cff_event_date_formatting == "1") echo 'selected="selected"' ?> ><?php echo date('F j, Y, g:ia', $original); ?></option>
                                <option value="2" <?php if($cff_event_date_formatting == "2") echo 'selected="selected"' ?> ><?php echo date('F jS, g:ia', $original); ?></option>
                                <option value="3" <?php if($cff_event_date_formatting == "3") echo 'selected="selected"' ?> ><?php echo date('g:ia - F jS', $original); ?></option>
                                <option value="4" <?php if($cff_event_date_formatting == "4") echo 'selected="selected"' ?> ><?php echo date('g:ia, F jS', $original); ?></option>
                                <option value="5" <?php if($cff_event_date_formatting == "5") echo 'selected="selected"' ?> ><?php echo date('l F jS - g:ia', $original); ?></option>
                                <option value="6" <?php if($cff_event_date_formatting == "6") echo 'selected="selected"' ?> ><?php echo date('D M jS, Y, g:iA', $original); ?></option>
                                <option value="7" <?php if($cff_event_date_formatting == "7") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y, g:iA', $original); ?></option>
                                <option value="8" <?php if($cff_event_date_formatting == "8") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y - g:ia', $original); ?></option>
                                <option value="9" <?php if($cff_event_date_formatting == "9") echo 'selected="selected"' ?> ><?php echo date("l M jS, 'y", $original); ?></option>
                                <option value="10" <?php if($cff_event_date_formatting == "10") echo 'selected="selected"' ?> ><?php echo date('m.d.y - g:iA', $original); ?></option>
                                <option value="20" <?php if($cff_event_date_formatting == "20") echo 'selected="selected"' ?> ><?php echo date('m.d.y - G:i', $original); ?></option>
                                <option value="11" <?php if($cff_event_date_formatting == "11") echo 'selected="selected"' ?> ><?php echo date('m/d/y, g:ia', $original); ?></option>
                                <option value="12" <?php if($cff_event_date_formatting == "12") echo 'selected="selected"' ?> ><?php echo date('d.m.y - g:iA', $original); ?></option>
                                <option value="21" <?php if($cff_event_date_formatting == "21") echo 'selected="selected"' ?> ><?php echo date('d.m.y - G:i', $original); ?></option>
                                <option value="13" <?php if($cff_event_date_formatting == "13") echo 'selected="selected"' ?> ><?php echo date('d/m/y, g:ia', $original); ?></option>

                                <option value="16" <?php if($cff_event_date_formatting == "16") echo 'selected="selected"' ?> ><?php echo date('d-m-Y, G:i', $original); ?></option>
                                <option value="17" <?php if($cff_event_date_formatting == "17") echo 'selected="selected"' ?> ><?php echo date('jS F Y, G:i', $original); ?></option>
                                <option value="18" <?php if($cff_event_date_formatting == "18") echo 'selected="selected"' ?> ><?php echo date('d M Y, G:i', $original); ?></option>
                                <option value="19" <?php if($cff_event_date_formatting == "19") echo 'selected="selected"' ?> ><?php echo date('l jS F Y, G:i', $original); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_date_custom" class="bump-left"><?php _e('Custom Event Date Format'); ?></label><code class="cff_shortcode"> eventdatecustom
                Eg: eventdatecustom='D M jS, Y'</code></th>
                        <td>
                            <input name="cff_event_date_custom" type="text" value="<?php _e($cff_event_date_custom); ?>" size="10" placeholder="Eg. F j, Y - g:ia" />
                            <a href="http://smashballoon.com/custom-facebook-feed/docs/date/" class="cff-external-link" target="_blank"><?php _e('Examples'); ?></a>
                        </td>
                    </tr>
                    <tr id="eventdetails"><!-- Quick link --></tr>
                </tbody>
            </table>
            <hr />

            <h3><?php _e('Event Details'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_event_details_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> eventdetailssize
                Eg: eventdetailssize=13</code></th>
                        <td>
                            <select name="cff_event_details_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_details_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_event_details_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_event_details_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_event_details_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_event_details_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_event_details_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_event_details_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_event_details_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_event_details_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_event_details_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_event_details_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_event_details_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_event_details_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_event_details_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_event_details_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_event_details_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_event_details_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_details_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> eventdetailsweight
                Eg: eventdetailsweight=bold</code></th>
                        <td>
                            <select name="cff_event_details_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_event_details_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_event_details_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_event_details_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_details_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> eventdetailscolor
                Eg: eventdetailscolor=FFF000</code></th>
                        <td>
                            <input name="cff_event_details_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_details_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_event_link_color" class="bump-left"><?php _e('Link Color'); ?></label><code class="cff_shortcode"> eventlinkcolor
                Eg: eventlinkcolor=333</code></th>
                        <td>
                            <input name="cff_event_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_link_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_buy_tickets_text" class="bump-left"><?php _e('"Buy Tickets" Text'); ?></label><code class="cff_shortcode"> buyticketstext
                Eg: buyticketstext="Get tickets"</code></th>
                        <td>
                            <input name="cff_buy_tickets_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_buy_tickets_text ) ); ?>" size="25" />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('When you configure the plugin to display events from your Facebook Events page then the plugin will display the "Buy Tickets" link when applicable. Use this setting to customize the "Buy Tickets" text.'); ?></p>
                        </td>
                    </tr>
                    <tr id="comments"><!-- Quick link --></tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
            <hr />

            <h3><?php _e('Likes, Shares and Comments Box'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Icon Style'); ?></label><code class="cff_shortcode"> iconstyle
                        Eg: iconstyle=dark</code></th>
                        <td>
                            <select name="cff_icon_style" style="width: 250px;">
                                <option value="light" <?php if($cff_icon_style == "light") echo 'selected="selected"' ?> ><?php _e('Light (for light backgrounds)'); ?></option>
                                <option value="dark" <?php if($cff_icon_style == "dark") echo 'selected="selected"' ?> ><?php _e('Dark (for dark backgrounds)'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Text Color'); ?></label><code class="cff_shortcode"> socialtextcolor
                        Eg: socialtextcolor=FFF</code></th>
                        <td>
                            <input name="cff_meta_text_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_meta_text_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Link Color'); ?></label><code class="cff_shortcode"> sociallinkcolor
                        Eg: sociallinkcolor=FFF</code></th>
                        <td>
                            <input name="cff_meta_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_meta_link_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Background Color'); ?></label><code class="cff_shortcode"> socialbgcolor
                        Eg: socialbgcolor=111</code></th>
                        <td>
                            <input name="cff_meta_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_meta_bg_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Expand Comments Box Initially'); ?></label><code class="cff_shortcode"> expandcomments
                        Eg: expandcomments=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_expand_comments" id="cff_expand_comments" <?php if($cff_expand_comments == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('Checking this box will automatically expand the comments box beneath each post. Unchecking this box will mean that users will need to click the number of comments below each post in order to expand the comments box.'); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" for="cff_comments_num" scope="row"><label><?php _e('Number of Comments to Show Initially'); ?></label><code class="cff_shortcode"> commentsnum
                        Eg: commentsnum=1</code></th>
                        <td>
                            <input name="cff_comments_num" type="text" value="<?php esc_attr_e( $cff_comments_num ); ?>" size="2" />
                            <span><i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('25 max'); ?></i></span>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('The number of comments to show initially when the comments box is expanded.'); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Hide Comment Avatars'); ?></label><code class="cff_shortcode"> hidecommentimages
                        Eg: hidecommentimages=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_hide_comment_avatars" id="cff_hide_comment_avatars" <?php if($cff_hide_comment_avatars == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("Why aren't avatars being displayed?"); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("Due to a recent Facebook API change, comment names and avatars can now only be displayed if you're using a 'Page' Access Token. See <a href='https://smashballoon.com/displaying-comment-names-avatars/' target='_blank'>this FAQ</a> for more information."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show Comments in Lightbox'); ?></label><code class="cff_shortcode"> lightboxcomments
                        Eg: lightboxcomments=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_lightbox_comments" id="cff_lightbox_comments" <?php if($cff_lightbox_comments == true) echo 'checked="checked"' ?> />
                            <span><i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('For timeline posts only'); ?></i></span>
                        </td>
                    </tr>
                    <tr id="action"><!-- Quick link --></tr>
                </tbody>
            </table>

            <hr />

            <h3><?php _e('Post Action Links'); ?></span> <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What are these?'); ?></a>
            <p class="cff-tooltip cff-more-info"><?php _e('Post action links refer to the "View on Facebook" and "Share" links at the bottom of each post'); ?></p></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label for="cff_link_size" class="bump-left"><?php _e('Text Size'); ?></label><code class="cff_shortcode"> linksize
                Eg: linksize=13</code></th>
                        <td>
                            <select name="cff_link_size" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_link_size == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="10" <?php if($cff_link_size == "10") echo 'selected="selected"' ?> >10px</option>
                                <option value="11" <?php if($cff_link_size == "11") echo 'selected="selected"' ?> >11px</option>
                                <option value="12" <?php if($cff_link_size == "12") echo 'selected="selected"' ?> >12px</option>
                                <option value="13" <?php if($cff_link_size == "13") echo 'selected="selected"' ?> >13px</option>
                                <option value="14" <?php if($cff_link_size == "14") echo 'selected="selected"' ?> >14px</option>
                                <option value="16" <?php if($cff_link_size == "16") echo 'selected="selected"' ?> >16px</option>
                                <option value="18" <?php if($cff_link_size == "18") echo 'selected="selected"' ?> >18px</option>
                                <option value="20" <?php if($cff_link_size == "20") echo 'selected="selected"' ?> >20px</option>
                                <option value="24" <?php if($cff_link_size == "24") echo 'selected="selected"' ?> >24px</option>
                                <option value="28" <?php if($cff_link_size == "28") echo 'selected="selected"' ?> >28px</option>
                                <option value="32" <?php if($cff_link_size == "32") echo 'selected="selected"' ?> >32px</option>
                                <option value="36" <?php if($cff_link_size == "36") echo 'selected="selected"' ?> >36px</option>
                                <option value="42" <?php if($cff_link_size == "42") echo 'selected="selected"' ?> >42px</option>
                                <option value="48" <?php if($cff_link_size == "48") echo 'selected="selected"' ?> >48px</option>
                                <option value="54" <?php if($cff_link_size == "54") echo 'selected="selected"' ?> >54px</option>
                                <option value="60" <?php if($cff_link_size == "60") echo 'selected="selected"' ?> >60px</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_weight" class="bump-left"><?php _e('Text Weight'); ?></label><code class="cff_shortcode"> linkweight
                Eg: linkweight=bold</code></th>
                        <td>
                            <select name="cff_link_weight" class="cff-text-size-setting">
                                <option value="inherit" <?php if($cff_link_weight == "inherit") echo 'selected="selected"' ?> >Inherit from theme</option>
                                <option value="normal" <?php if($cff_link_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                <option value="bold" <?php if($cff_link_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_link_color" class="bump-left"><?php _e('Text Color'); ?></label><code class="cff_shortcode"> linkcolor
                Eg: linkcolor=E01B5D</code></th>
                        <td>
                            <input name="cff_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_color) ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_facebook_link_text" class="bump-left"><?php _e('"View on Facebook" Text'); ?></label><code class="cff_shortcode"> facebooklinktext
                Eg: facebooklinktext='Read more...'</code></th>
                        <td>
                            <input name="cff_facebook_link_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_link_text ) ); ?>" size="25" />
                        </td>
                    </tr>

                     <tr>
                        <th class="bump-left"><label for="cff_facebook_share_text" class="bump-left"><?php _e('"Share" Text'); ?></label><code class="cff_shortcode"> sharelinktext
                Eg: sharelinktext='Share this post'</code></th>
                        <td>
                            <input name="cff_facebook_share_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_share_text ) ); ?>" size="25" />
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_show_facebook_link" class="bump-left"><?php _e('Show "View on Facebook" link'); ?></label><code class="cff_shortcode"> showfacebooklink
                Eg: showfacebooklink=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_facebook_link" id="cff_show_facebook_link" <?php if($cff_show_facebook_link == true) echo 'checked="checked"' ?> />
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_show_facebook_share" class="bump-left"><?php _e('Show "Share" link'); ?></label><code class="cff_shortcode"> showsharelink
                Eg: showsharelink=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_facebook_share" id="cff_show_facebook_share" <?php if($cff_show_facebook_share == true) echo 'checked="checked"' ?> />
                        </td>
                    </tr>
                    <tr id="loadmore"><!-- Quick link --></tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
            
            <?php } //End Typography tab ?>
            <?php if( $cff_active_tab == 'misc' ) { //Start Misc tab ?>

            <p class="cff_contents_links" id="comments">
                <span>Jump to: </span>
                <a href="#css">Custom CSS</a>
                <a href="#js">Custom JavaScript</a>
                <a href="#media">Media</a>
                <a href="#misc">Misc Settings</a>
            </p>

            <input type="hidden" name="<?php echo $style_misc_hidden_field_name; ?>" value="Y">
            <br />

            <span id="css"><!-- Quick link --></span>
            <hr />
            <h3><?php _e('Custom CSS'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top"><!-- Quick link -->
                        <td style="padding-top: 0;">
                            <p style="padding-bottom: 10px;"><?php _e('Enter your own custom CSS in the box below'); ?></p>
                            <textarea name="cff_custom_css" id="cff_custom_css" style="width: 70%;" rows="7"><?php esc_attr_e( stripslashes($cff_custom_css) ); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3 id="js"><?php _e('Custom JavaScript'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <td style="padding-top: 0;">
                            <p style="padding-bottom: 10px;"><?php _e('Enter your own custom JavaScript/jQuery in the box below'); ?></p>
                            <textarea name="cff_custom_js" id="cff_custom_js" style="width: 70%;" rows="7"><?php esc_attr_e( stripslashes($cff_custom_js) ); ?></textarea>
                        </td>
                    </tr>
                    <tr id="media"><!-- Quick link --></tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
            <hr />
            <h3><?php _e('Media'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Use full-size shared link images'); ?></label><code class="cff_shortcode"> fulllinkimages
                    Eg: fulllinkimages=false</code></th>
                        <td>
                            <input type="checkbox" name="cff_full_link_images" id="cff_full_link_images" <?php if($cff_full_link_images == true) echo 'checked="checked"' ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("By default the shared link boxes in your posts use the same layout selected on the 'Post Layout' page. In order to do this, the plugin will use the larger versions of the link images, which can sometimes be very large. You can disable this by unchecking this setting to force all shared links to use the smaller image thumbnails instead, which will be displayed in a thumbnail layout, regardless of the layout set for the other posts in the feed."); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Post image size'); ?></label><code class="cff_shortcode"> postimagesize
                    Eg: postimagesize=small/large</code></th>
                        <td>
                            <select name="cff_image_size" style="width: 200px;">
                                <option value="small" <?php if($cff_image_size == "small") echo 'selected="selected"' ?> ><?php _e('Small (130px wide)'); ?></option>
                                <option value="large" <?php if($cff_image_size == "large") echo 'selected="selected"' ?> ><?php _e('Large (720px wide)'); ?></option>
                            </select>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("Facebook only provides two image sizes for posts; 130px or 720px. By default, the plugin uses the 720px image size but this can be changed here. This is only recommended if you are displaying images at a small size in your feed, such as in the Thumbnail layout, or in a narrow column/sidebar, in order to prevent image pixelation. Please note that this only applies to regular timeline feeds and not to other feed types."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Play video action'); ?></label><code class="cff_shortcode"> videoaction
                        Eg: videoaction=facebook</code></th>
                        <td>
                            <select name="cff_video_action" style="width: 280px;">
                                <option value="post" <?php if($cff_video_action == "post") echo 'selected="selected"' ?> ><?php _e('Play videos directly in the feed'); ?></option>
                                <!-- Link to the video either on Facebook or whatever the source is: -->
                                <option value="facebook" <?php if($cff_video_action == "facebook") echo 'selected="selected"' ?> ><?php _e('Link to the video on Facebook'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr id="misc"><!-- Quick link --></tr>
                </tbody>
            </table>

            <hr />
            <h3><?php _e('Misc Settings'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Display credit link"); ?></label><code class="cff_shortcode"> credit
                        Eg: credit=true</code></th>
                        <td>
                            <input name="cff_show_credit" type="checkbox" id="cff_show_credit" <?php if($cff_show_credit == true) echo "checked"; ?> />
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Display a link at the bottom of the feed to the Smash Balloon website. Thank you! :)'); ?></i>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Preserve settings when plugin is removed"); ?></label></th>
                        <td>
                            <input name="cff_preserve_settings" type="checkbox" id="cff_preserve_settings" <?php if($cff_preserve_settings_val == true) echo "checked"; ?> />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('When removing the plugin your settings are automatically deleted from your database. Checking this box will prevent any settings from being deleted. This means that you can uninstall and reinstall the plugin without losing your settings.'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Is your theme loading the feed via Ajax?'); ?></label><code class="cff_shortcode"> ajax
                        Eg: ajax=true</code></th>
                        <td>
                            <input name="cff_ajax" type="checkbox" id="cff_ajax" <?php if($cff_ajax_val == true) echo "checked"; ?> />
                            <label for="cff_ajax"><?php _e('Yes'); ?></label>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('<i class="fa fa-question-circle" aria-hidden="true"></i>'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('Some modern WordPress themes use Ajax to load content into the page after it has loaded. If your theme uses Ajax to load the Custom Facebook Feed content into the page then check this box. If you are not sure then please check with the theme author.'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Is Facebook Page restricted?'); ?></label><code class="cff_shortcode"> restricedpage
                        Eg: restricedpage=true</code></th>
                        <td>
                            <input name="cff_restricted_page" type="checkbox" id="cff_restricted_page" <?php if($cff_restricted_page == true) echo "checked"; ?> />
                            <label for="cff_ajax"><?php _e('Yes'); ?></label>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('<i class="fa fa-question-circle" aria-hidden="true"></i>'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('If you want to display your Facebook feed on your website then ideally your Facebook page should not have any age or location restrictions on it as that restricts the plugin from being able to fully access the content. If it is not possible for you to remove all restrictions then you can enable this setting.'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Fix text shortening issue'); ?></label><code class="cff_shortcode"> textissue
                        Eg: textissue=true</code></th>
                        <td>
                            <input name="cff_format_issue" type="checkbox" id="cff_format_issue" <?php if($cff_format_issue == true) echo "checked"; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Disable SVG icons'); ?></label></th>
                        <td>
                            <input name="cff_disable_svgs" type="checkbox" id="cff_disable_svgs" <?php if($cff_disable_svgs == true) echo "checked"; ?> />

                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('<i class="fa fa-question-circle" aria-hidden="true"></i>'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("Checking this setting will disable the SVG icons used in the comments box below each post and use the old icon images instead."); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_timeline_pag" class="bump-left"><?php _e("Timeline pagination method"); ?></label></th>
                        <td>
                            <select name="cff_timeline_pag">
                                <option value="date" <?php if($cff_timeline_pag == "date") echo 'selected="selected"' ?> ><?php _e('Date'); ?></option>
                                <option value="paging" <?php if($cff_timeline_pag == "paging") echo 'selected="selected"' ?> ><?php _e('API Paging'); ?></option>
                            </select>

                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('<i class="fa fa-question-circle" aria-hidden="true"></i>'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("Whether to use the date/time of the last post or the API Paging URL to paginate to the next batch of posts. This should only be changed if advised by a member of the support team."); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_grid_pag" class="bump-left"><?php _e("Grid pagination method"); ?></label></th>
                        <td>
                            <select name="cff_grid_pag">
                                <option value="auto" <?php if($cff_grid_pag == "auto") echo 'selected="selected"' ?> ><?php _e('Auto'); ?></option>
                                <option value="cursor" <?php if($cff_grid_pag == "cursor") echo 'selected="selected"' ?> ><?php _e('Cursor'); ?></option>
                                <option value="offset" <?php if($cff_grid_pag == "offset") echo 'selected="selected"' ?> ><?php _e('Offset'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left">
                            <label for="cff_cron" class="bump-left"><?php _e("Force cache to clear on interval"); ?></label>
                        </th>
                        <td>
                            <select name="cff_cron">
                                <option value="unset" <?php if($cff_cron == "unset") echo 'selected="selected"' ?> ><?php _e(' - '); ?></option>
                                <option value="yes" <?php if($cff_cron == "yes") echo 'selected="selected"' ?> ><?php _e('Yes'); ?></option>
                                <option value="no" <?php if($cff_cron == "no") echo 'selected="selected"' ?> ><?php _e('No'); ?></option>
                            </select>

                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('<i class="fa fa-question-circle" aria-hidden="true"></i>'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If you're experiencing an issue with the plugin not auto-updating then you can set this to 'Yes' to run a scheduled event behind the scenes which forces the plugin cache to clear on a regular basis and retrieve new data from Facebook. This will also force the caches of the following caching plugins to be cleared too: WP Super Cache, W3 Total Cache, and WP Fastest Cache."); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_request_method" class="bump-left"><?php _e("Request method"); ?></label></th>
                        <td>
                            <select name="cff_request_method">
                                <option value="auto" <?php if($cff_request_method == "auto") echo 'selected="selected"' ?> ><?php _e('Auto'); ?></option>
                                <option value="1" <?php if($cff_request_method == "1") echo 'selected="selected"' ?> ><?php _e('cURL'); ?></option>
                                <option value="2" <?php if($cff_request_method == "2") echo 'selected="selected"' ?> ><?php _e('file_get_contents'); ?></option>
                                <option value="3" <?php if($cff_request_method == "3") echo 'selected="selected"' ?> ><?php _e("WP_Http"); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label for="cff_font_source" class="bump-left"><?php _e("Icon font source"); ?></label></th>
                        <td>
                            <select name="cff_font_source">
                                <option value="cdn" <?php if($cff_font_source == "cdn") echo 'selected="selected"' ?> ><?php _e('CDN'); ?></option>
                                <option value="local" <?php if($cff_font_source == "local") echo 'selected="selected"' ?> ><?php _e('Local copy'); ?></option>
                                <option value="none" <?php if($cff_font_source == "none") echo 'selected="selected"' ?> ><?php _e("Don't load"); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Minify CSS and JavaScript files"); ?></label></th>
                        <td>
                            <input name="cff_minify" type="checkbox" id="cff_minify" <?php if($cff_minify == true) echo "checked"; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Disable Ajax caching"); ?></label></th>
                        <td>
                            <input name="cff_disable_ajax_cache" type="checkbox" id="cff_disable_ajax_cache" <?php if($cff_disable_ajax_cache == true) echo "checked"; ?> />
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Not recommended'); ?></i>
                        </td>
                    </tr>

                </tbody>
            </table>


            <?php submit_button(); ?>
            <?php } //End Misc tab ?>


            <?php if( $cff_active_tab == 'custom_text' ) { //Start Custom Text tab ?>

            <p class="cff_contents_links">
                <span>Jump to: </span>
                <a href="#text">Post Text</a>
                <a href="#events">Events</a>
                <a href="#action">Post Action Links</a>
                <a href="#loadmore">"Load More" button</a>
                <a href="#comments">Likes, Shares and Comments</a>
                <a href="#date">Date</a>
            </p>

            <input type="hidden" name="<?php echo $style_custom_text_hidden_field_name; ?>" value="Y">
            <br />
            <h3><?php _e('Custom Text / Translate'); ?></h3>
            <p><?php _e('Enter custom text for the words below, or translate it into the language you would like to use.'); ?></p>
            <table class="form-table cff-translate-table" style="width: 100%; max-width: 940px;">
                <tbody>

                    <thead id="text">
                        <tr>
                            <th><?php _e('Original Text'); ?></th>
                            <th><?php _e('Custom Text / Translation'); ?></th>
                            <th><?php _e('Context'); ?></th>
                        </tr>
                    </thead>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Post Text'); ?></th></tr>
                    <tr>
                        <td><label for="cff_see_more_text" class="bump-left"><?php _e('See More'); ?></label></td>
                        <td><input name="cff_see_more_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_see_more_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used when truncating the post text'); ?></td>
                    </tr>

                    <tr id="events"><!-- Quick link -->
                        <td><label for="cff_see_less_text" class="bump-left"><?php _e('See Less'); ?></label></td>
                        <td><input name="cff_see_less_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_see_less_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used when truncating the post text'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Events'); ?></th></tr>
                    <tr>
                        <td><label for="cff_map_text" class="bump-left"><?php _e('Map'); ?></label></td>
                        <td><input name="cff_map_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_map_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Added after the address of an event'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_no_events_text" class="bump-left"><?php _e('No upcoming events'); ?></label></td>
                        <td><input name="cff_no_events_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_no_events_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Shown when there are no upcoming events to display'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_interested_text" class="bump-left"><?php _e('interested'); ?></label></td>
                        <td><input name="cff_interested_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_interested_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for the number of people interested in an event'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_going_text" class="bump-left"><?php _e('going'); ?></label></td>
                        <td><input name="cff_going_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_going_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for the number of people going to an event'); ?></td>
                    </tr>

                    <tr id="action"><!-- Quick link -->
                        <td><label for="cff_buy_tickets_text" class="bump-left"><?php _e('Buy Tickets'); ?></label></td>
                        <td><input name="cff_buy_tickets_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_buy_tickets_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Shown when there is a link to buy event tickets'); ?></td>
                    </tr>
                    
                    <tr class="cff-table-header"><th colspan="3"><?php _e('Post Action Links'); ?></th></tr>
                    <tr>
                        <td><label for="cff_facebook_link_text" class="bump-left"><?php _e('View on Facebook'); ?></label></td>
                        <td><input name="cff_facebook_link_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_link_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for the link to the post on Facebook'); ?></td>
                    </tr>
                    <tr id="loadmore"><!-- Quick link -->
                        <td><label for="cff_facebook_share_text" class="bump-left"><?php _e('Share'); ?></label></td>
                        <td><input name="cff_facebook_share_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_share_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for sharing the Facebook post via Social Media'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('"Load More" Button'); ?></th></tr>
                    <tr><!-- Quick link -->
                        <td><label for="cff_load_more_text" class="bump-left"><?php _e('Load More'); ?></label></td>
                        <td><input name="cff_load_more_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_load_more_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used in the button that loads more posts'); ?></td>
                    </tr>
                    <tr id="comments"><!-- Quick link -->
                        <td><label for="cff_no_more_posts_text" class="bump-left"><?php _e('No more posts'); ?></label></td>
                        <td><input name="cff_no_more_posts_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_no_more_posts_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used when there are no more posts to load'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Likes, Shares and Comments'); ?></th></tr>
                    <tr>
                        <td><label for="cff_translate_view_previous_comments_text" class="bump-left"><?php _e('View more comments'); ?></label></td>
                        <td><input name="cff_translate_view_previous_comments_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_view_previous_comments_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used in the comments section (when applicable)'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_comment_on_facebook_text" class="bump-left"><?php _e('Comment on Facebook'); ?></label></td>
                        <td><input name="cff_translate_comment_on_facebook_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_comment_on_facebook_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used at the bottom of the comments section'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_photos_text" class="bump-left"><?php _e('photos'); ?></label></td>
                        <td><input name="cff_translate_photos_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_photos_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Added to the end of an album name. Eg. (6 photos)'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_like_this_text" class="bump-left"><?php _e('like this'); ?></label></td>
                        <td><input name="cff_translate_like_this_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_like_this_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __ and __ like this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_likes_this_text" class="bump-left"><?php _e('likes this'); ?></label></td>
                        <td><input name="cff_translate_likes_this_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_likes_this_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __ likes this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_reacted_text" class="bump-left"><?php _e('reacted to this'); ?></label></td>
                        <td><input name="cff_translate_reacted_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_reacted_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __ reacted to this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_and_text" class="bump-left"><?php _e('and'); ?></label></td>
                        <td><input name="cff_translate_and_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_and_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __ and __ like this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_other_text" class="bump-left"><?php _e('other'); ?></label></td>
                        <td><input name="cff_translate_other_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_other_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __, __ and 1 other like this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_others_text" class="bump-left"><?php _e('others'); ?></label></td>
                        <td><input name="cff_translate_others_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_others_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. __, __ and 10 others like this'); ?></td>
                    </tr>

                    <tr>
                        <td><label for="cff_translate_reply_text" class="bump-left"><?php _e('reply'); ?></label></td>
                        <td><input name="cff_translate_reply_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_reply_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. 1 reply'); ?></td>
                    </tr>
                    <tr id="date"><!-- Quick link -->
                        <td><label for="cff_translate_replies_text" class="bump-left"><?php _e('replies'); ?></label></td>
                        <td><input name="cff_translate_replies_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_replies_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Eg. 5 replies'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Call-to-action Buttons', 'custom-facebook-feed'); ?></th></tr>
                    <tr>
                        <td><label for="cff_translate_learn_more_text" class="bump-left"><?php _e('Learn More', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_learn_more_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_learn_more_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e("Used for the 'Learn More' button", 'custom-facebook-feed'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_translate_shop_now_text" class="bump-left"><?php _e('Shop Now', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_shop_now_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_shop_now_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e("Used for the 'Shop Now' button", 'custom-facebook-feed'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_translate_message_page_text" class="bump-left"><?php _e('Message Page', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_message_page_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_message_page_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e("Used for the 'Message Page' button", 'custom-facebook-feed'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_translate_get_directions_text" class="bump-left"><?php _e('Get Directions', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_get_directions_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_get_directions_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e("Used for the 'Get Directions' button", 'custom-facebook-feed'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Date'); ?></th></tr>
                    <tr>
                        <td><label for="cff_photos_text" class="bump-left"><?php _e('"Posted _ hours ago" text'); ?></label></td>
                        <td class="cff-translate-date">

                            <label for="cff_translate_second"><?php _e("second"); ?></label>
                            <input name="cff_translate_second" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_second ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_seconds"><?php _e("seconds"); ?></label>
                            <input name="cff_translate_seconds" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_seconds ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_minute"><?php _e("minute"); ?></label>
                            <input name="cff_translate_minute" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_minute ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_minutes"><?php _e("minutes"); ?></label>
                            <input name="cff_translate_minutes" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_minutes ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_hour"><?php _e("hour"); ?></label>
                            <input name="cff_translate_hour" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_hour ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_hours"><?php _e("hours"); ?></label>
                            <input name="cff_translate_hours" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_hours ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_day"><?php _e("day"); ?></label>
                            <input name="cff_translate_day" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_day ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_days"><?php _e("days"); ?></label>
                            <input name="cff_translate_days" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_days ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_week"><?php _e("week"); ?></label>
                            <input name="cff_translate_week" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_week ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_weeks"><?php _e("weeks"); ?></label>
                            <input name="cff_translate_weeks" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_weeks ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_month"><?php _e("month"); ?></label>
                            <input name="cff_translate_month" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_month ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_months"><?php _e("months"); ?></label>
                            <input name="cff_translate_months" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_months ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_year"><?php _e("year"); ?></label>
                            <input name="cff_translate_year" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_year ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_years"><?php _e("years"); ?></label>
                            <input name="cff_translate_years" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_years ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_ago"><?php _e("ago"); ?></label>
                            <input name="cff_translate_ago" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_ago ) ); ?>" size="20" />
                        </td>
                        <td class="cff-context"><?php _e('Used to translate the "_ days ago" date text'); ?></td>
                    </tr>

                </tbody>
            </table>
            
            <?php submit_button(); ?>
            <?php } //End Post Layout tab ?>


        </form>


        <hr />
        <h3><?php _e('Like the plugin? Help spread the word!'); ?></h3>

        <button id="cff-admin-show-share-links" class="button secondary" style="margin-bottom: 1px;"><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;&nbsp;Share the plugin</button> <div id="cff-admin-share-links"></div>

<?php 
} //End Style_Page
//Enqueue admin styles
function cff_admin_style() {
        wp_register_style( 'cff_custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'css/cff-admin-style.css', false, CFFVER );
        wp_enqueue_style( 'cff_custom_wp_admin_css' );
        wp_enqueue_style( 'cff-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'cff_admin_style' );
//Enqueue admin scripts
function cff_admin_scripts() {
    //Declare color-picker as a dependency
    wp_enqueue_script( 'cff_admin_script', plugin_dir_url( __FILE__ ) . 'js/cff-admin-scripts.js', array( 'wp-color-picker' ), CFFVER );
    if( !wp_script_is('jquery-ui-draggable') ) { 
        wp_enqueue_script(
            array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-draggable'
            )
        );
    }
    wp_enqueue_script(
        array(
        'hoverIntent'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'cff_admin_scripts' );


function cff_expiration_notice(){

    //If the user is re-checking the license key then use the API below to recheck it
    ( isset( $_GET['cffchecklicense'] ) ) ? $cff_check_license = true : $cff_check_license = false;

    // delete_option( 'cff_license_data' );
    $cff_license = trim( get_option( 'cff_license_key' ) );

    // delete_option( 'cff_license_key' );
    // delete_option( 'cff_license_status' );

    //If there's no license key then don't do anything
    if( empty($cff_license) || !isset($cff_license) && !$cff_check_license ) return;

    //Is there already license data in the db?
    if( get_option( 'cff_license_data' ) && !$cff_check_license ){
        //Yes
        //Get license data from the db and convert the object to an array
        $cff_license_data = (array) get_option( 'cff_license_data' );
    } else {
        //No
        // data to send in our API request
        $cff_api_params = array( 
            'edd_action'=> 'check_license', 
            'license'   => $cff_license, 
            'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
        );
        
        // Call the custom API.
        $cff_response = wp_remote_get( add_query_arg( $cff_api_params, WPW_SL_STORE_URL ), array( 'timeout' => 60, 'sslverify' => false ) );

        // decode the license data
        $cff_license_data = (array) json_decode( wp_remote_retrieve_body( $cff_response ) );

        //Store license data in db
        update_option( 'cff_license_data', $cff_license_data );
    }


    //Number of days until license expires
    if( isset( $cff_license_data['expires'] ) ){
        $cff_date1 = $cff_license_data['expires'];
    } else {
        //If there's no expiry date then the license isn't valid so set it to be expired
        $cff_date1 = '2017-01-01 23:59:59';
        $cff_license_data["customer_name"] = '';
    }


    if( $cff_date1 == 'lifetime' ) $cff_date1 = '2036-12-31 23:59:59';
    $cff_date2 = date('Y-m-d');
    $cff_interval = round(abs(strtotime($cff_date2)-strtotime($cff_date1))/86400);

    //Is license expired?
    ( $cff_interval == 0 || strtotime($cff_date1) < strtotime($cff_date2) ) ? $cff_license_expired = true : $cff_license_expired = false;

    //If expired date is returned as 1970 (or any other 20th century year) then it means that the correct expired date was not returned and so don't show the renewal notice
    if( $cff_date1[0] == '1' ) $cff_license_expired = false;

    //If there's no expired date then don't show the expired notification
    if( empty($cff_date1) || !isset($cff_date1) ) $cff_license_expired = false;

    //Is license missing - ie. on very first check
    if( isset($cff_license_data['error']) ){
        if( $cff_license_data['error'] == 'missing' ) $cff_license_expired = false;
    }

    //If license expires in less than 30 days and it isn't currently expired then show the expire countdown instead of the expiration notice
    if($cff_interval < 30 && !$cff_license_expired){
        $cff_expire_countdown = true;
    } else {
        $cff_expire_countdown = false;
    }

    global $cff_download_id;

    //Is the license expired?
    if( ($cff_license_expired || $cff_expire_countdown) || $cff_check_license ) {

        //If they've already dismissed the countdown notice then don't show it here
        global $current_user;
        $user_id = $current_user->ID;
        if( $cff_expire_countdown && get_user_meta($user_id, 'cff_ignore_notice') ) return;


        $cff_license_activation_error = false;
        if( $cff_license_data["success"] == false ) $cff_license_activation_error = true;
        
        //If expire countdown then add the countdown class to the notice box
        if($cff_expire_countdown){
            $cff_expired_box_classes = "cff-license-expired cff-license-countdown";
            $cff_expired_box_msg = "<b>Important:</b> Your Custom Facebook Feed Pro license key expires in " . $cff_interval . " days.";
        } else if( $cff_license_activation_error ){
            $cff_expired_box_classes = "cff-license-expired";
            $cff_expired_box_msg = "<b>Issue activating license.</b> Please ensure that you entered your license key correctly. If you continue to have an issue please see <a href='https://smashballoon.com/my-license-key-wont-activate/' target='_blank'>here</a>.";
        } else {
            $cff_expired_box_classes = "cff-license-expired";
            $cff_expired_box_msg = "<b>Important:</b> Your Custom Facebook Feed Pro license key has expired. You are no longer receiving updates.";
        }

        //Create the re-check link using the existing query string in the URL
        $cff_url = '?' . $_SERVER["QUERY_STRING"];
        //Determine the separator
        ( !empty($cff_url) && $cff_url != '' ) ? $separator = '&' : $separator = '';
        //Add the param to check license if it doesn't already exist in URL
        if( strpos($cff_url, 'cffchecklicense') === false ) $cff_url .= $separator . "cffchecklicense=true";
        
        //Create the notice message
        if( !$cff_license_activation_error ) $cff_expired_box_msg .= " &nbsp;<a href='https://smashballoon.com/checkout/?edd_license_key=".$cff_license."&download_id=".$cff_download_id."' target='_blank'>Renew License</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href='javascript:void(0);' id='cff-why-renew-show' onclick='cffShowReasons()'>Why renew?</a><a href='javascript:void(0);' id='cff-why-renew-hide' onclick='cffHideReasons()' style='display: none;'>Hide text</a> <a href='".$cff_url."' class='cff-button'>Re-check License</a></p>
            <div id='cff-why-renew' style='display: none;'>
                <h4>Customer Support</h4>
                <p>Without a valid license key you will no longer be able to receive updates or support for the Custom Facebook Feed plugin. A renewed license key grants you access to our top-notch, quick and effective support for another full year.</p>

                <h4>Maintenance Upates</h4>
                <p>With both WordPress and the Facebook API being updated on a regular basis we stay on top of the latest changes and provide frequent updates to keep pace.</p>

                <h4>New Feature Updates</h4>
                <p>We're continually adding new features to the plugin, based on both customer suggestions and our own ideas for ways to make it better, more useful, more customizable, more robust and just more awesome! Renew your license to prevent from missing out on any of the new features added in the future.</p>
            </div>";

        if( $cff_check_license && !$cff_license_expired && !$cff_expire_countdown ){
            $cff_expired_box_classes = "cff-license-expired cff-license-valid";
            $cff_expired_box_msg = "Thanks ".$cff_license_data["customer_name"].", your Custom Facebook Feed Pro license key is valid.";
        }

        _e("
        <div class='".$cff_expired_box_classes."'>");
            if( $cff_expire_countdown ) _e("<a style='float:right; color: #dd3d36; text-decoration: none;' href='" .esc_url( add_query_arg( 'cff_nag_ignore', '0' ) ). "'>Dismiss</a>");
            _e("<p>".$cff_expired_box_msg." 
        </div>
        <script type='text/javascript'>
        function cffShowReasons() {
            document.getElementById('cff-why-renew').style.display = 'block';
            document.getElementById('cff-why-renew-show').style.display = 'none';
            document.getElementById('cff-why-renew-hide').style.display = 'inline';
        }
        function cffHideReasons() {
            document.getElementById('cff-why-renew').style.display = 'none';
            document.getElementById('cff-why-renew-show').style.display = 'inline';
            document.getElementById('cff-why-renew-hide').style.display = 'none';
        }
        </script>
        ");
    }

}


/* Display a license expired notice that can be dismissed */
add_action('admin_notices', 'cff_renew_license_notice');
function cff_renew_license_notice() {

    //Only display notice to admins
    if( !current_user_can( 'manage_options' ) ) return;

    //Show this notice on every page apart from the Custom Facebook Feed settings pages
    isset($_GET['page'])? $cff_check_page = $_GET['page'] : $cff_check_page = '';
    if ( $cff_check_page !== 'cff-top' && $cff_check_page !== 'cff-style' && $cff_check_page !== 'cff-style' ) {

        //If the user is re-checking the license key then use the API below to recheck it
        ( isset( $_GET['cffchecklicense'] ) ) ? $cff_check_license = true : $cff_check_license = false;

        $cff_license = trim( get_option( 'cff_license_key' ) );

        global $current_user;
        $user_id = $current_user->ID;

        // Use this to show notice again
        // delete_user_meta($user_id, 'cff_ignore_notice');

        /* Check that the license exists and the user hasn't already clicked to ignore the message */
        if( empty($cff_license) || !isset($cff_license) || get_user_meta($user_id, 'cff_ignore_notice') && !$cff_check_license ) return;

        //Is there already license data in the db?
        if( get_option( 'cff_license_data' ) && !$cff_check_license ){
            //Yes
            //Get license data from the db and convert the object to an array
            $cff_license_data = (array) get_option( 'cff_license_data' );
        } else {
            //No
            // data to send in our API request
            $cff_api_params = array( 
                'edd_action'=> 'check_license', 
                'license'   => $cff_license, 
                'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
            );
            
            // Call the custom API.
            $cff_response = wp_remote_get( add_query_arg( $cff_api_params, WPW_SL_STORE_URL ), array( 'timeout' => 60, 'sslverify' => false ) );

            // decode the license data
            $cff_license_data = (array) json_decode( wp_remote_retrieve_body( $cff_response ) );

            //Store license data in db
            update_option( 'cff_license_data', $cff_license_data );
        }

        //Number of days until license expires
        isset($cff_license_data['expires']) ? $cff_date1 = $cff_license_data['expires'] : $cff_date1 = '2036-12-31 23:59:59';
        
        if( $cff_date1 == 'lifetime' ) $cff_date1 = '2036-12-31 23:59:59';
        $cff_date2 = date('Y-m-d');
        $cff_interval = round(abs(strtotime($cff_date2)-strtotime($cff_date1))/86400);

        //Is license expired?
        ( $cff_interval == 0 || strtotime($cff_date1) < strtotime($cff_date2) ) ? $cff_license_expired = true : $cff_license_expired = false;

        //If expired date is returned as 1970 (or any other 20th century year) then it means that the correct expired date was not returned and so don't show the renewal notice
        if( $cff_date1[0] == '1' ) $cff_license_expired = false;

        //If there's no expired date then don't show the expired notification
        if( empty($cff_date1) || !isset($cff_date1) ) $cff_license_expired = false;

        //Is license missing - ie. on very first check
        if( isset($cff_license_data['error']) ){
            if( $cff_license_data['error'] == 'missing' ) $cff_license_expired = false;
        }

        //If license expires in less than 30 days and it isn't currently expired then show the expire countdown instead of the expiration notice
        if($cff_interval < 30 && !$cff_license_expired){
            $cff_expire_countdown = true;
        } else {
            $cff_expire_countdown = false;
        }


        //Is the license expired?
        if( ($cff_license_expired || $cff_expire_countdown) || $cff_check_license ) {

            global $cff_download_id;
            
            //If expire countdown then add the countdown class to the notice box
            if($cff_expire_countdown){
                $cff_expired_box_classes = "cff-license-expired cff-license-countdown";
                $cff_expired_box_msg = "<b>Important:</b> your Custom Facebook Feed Pro license key expires in " . $cff_interval . " days.";
            } else {
                $cff_expired_box_classes = "cff-license-expired";
                $cff_expired_box_msg = "<b>Important:</b> Your Custom Facebook Feed Pro license key has expired. You are no longer receiving updates.";
            }

            //Create the re-check link using the existing query string in the URL
            $cff_url = '?' . $_SERVER["QUERY_STRING"];
            //Determine the separator
            ( !empty($cff_url) && $cff_url != '' ) ? $separator = '&' : $separator = '';
            //Add the param to check license if it doesn't already exist in URL
            if( strpos($cff_url, 'cffchecklicense') === false ) $cff_url .= $separator . "cffchecklicense=true";
            
            //Create the notice message
            $cff_expired_box_msg .= " &nbsp;<a href='https://smashballoon.com/checkout/?edd_license_key=".$cff_license."&download_id=".$cff_download_id."' target='_blank'>Renew License</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href='javascript:void(0);' id='cff-why-renew-show' onclick='cffShowReasons()'>Why renew?</a><a href='javascript:void(0);' id='cff-why-renew-hide' onclick='cffHideReasons()' style='display: none;'>Hide text</a> <a href='".$cff_url."' class='cff-button'>Re-check License</a></p>
                <div id='cff-why-renew' style='display: none;'>
                    <h4>Customer Support</h4>
                    <p>Without a valid license key you will no longer be able to receive updates or support for the Custom Facebook Feed plugin. A renewed license key grants you access to our top-notch, quick and effective support for another full year.</p>

                    <h4>Maintenance Upates</h4>
                    <p>With both WordPress and the Facebook API being updated on a regular basis we stay on top of the latest changes and provide frequent updates to keep pace.</p>

                    <h4>New Feature Updates</h4>
                    <p>We're continually adding new features to the plugin, based on both customer suggestions and our own ideas for ways to make it better, more useful, more customizable, more robust and just more awesome! Renew your license to prevent from missing out on any of the new features added in the future.</p>
                </div>";

            if( $cff_check_license && !$cff_license_expired && !$cff_expire_countdown ){
                $cff_expired_box_classes = "cff-license-expired cff-license-valid";
                $cff_expired_box_msg = "Thanks ".$cff_license_data["customer_name"].", your Custom Facebook Feed Pro license key is valid.";
            }

            _e("
            <div class='".$cff_expired_box_classes."'>
                <a style='float:right; color: #dd3d36; text-decoration: none;' href='" .esc_url( add_query_arg( 'cff_nag_ignore', '0' ) ). "'>Dismiss</a>
                <p>".$cff_expired_box_msg." 
            </div>
            <script type='text/javascript'>
            function cffShowReasons() {
                document.getElementById('cff-why-renew').style.display = 'block';
                document.getElementById('cff-why-renew-show').style.display = 'none';
                document.getElementById('cff-why-renew-hide').style.display = 'inline';
            }
            function cffHideReasons() {
                document.getElementById('cff-why-renew').style.display = 'none';
                document.getElementById('cff-why-renew-show').style.display = 'inline';
                document.getElementById('cff-why-renew-hide').style.display = 'none';
            }
            </script>
            ");
        }

    } //End page/tab check

}
add_action('admin_init', 'cff_nag_ignore');
function cff_nag_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cff_nag_ignore']) && '0' == $_GET['cff_nag_ignore'] ) {
             add_user_meta($user_id, 'cff_ignore_notice', 'true', true);
    }
}


/* Display a notice regarding updating App Tokens, which can be dismissed */
add_action('admin_notices', 'cff_app_token_notice');
function cff_app_token_notice() {

        $cff_at = get_option( 'cff_access_token' );
        $using_app_token = false;
        if( strpos($cff_at,'|') !== false ) $using_app_token = true;

        global $current_user;
        $user_id = $current_user->ID;

        // Use this to show notice again
        // delete_user_meta($user_id, 'cff_ignore_token_notice');

        /* Check whether it's an app token or if the user hasn't already clicked to ignore the message */
        if( get_user_meta($user_id, 'cff_ignore_token_notice') || !$using_app_token ) return;

        _e("
        <div class='cff-license-expired'>
            <a style='float:right; color: #dd3d36; text-decoration: none;' href='" .esc_url( add_query_arg( 'cff_nag_token_ignore', '0' ) ). "'>Dismiss</a>
            <p style='min-height: 40px;'><img src='" . plugins_url( 'img/balloon.png' , __FILE__ ) . "' style='float: left; width: 40px; height: 40px; margin-right: 15px; border-radius: 5px; box-shadow: 0 0 1px 0 #BA7B7B;'> Due to upcoming Facebook API changes it is now required that you use your own Facebook Access Token in the Custom Facebook Feed plugin, either through our Facebook App or through your own approved App. Please use the Facebook login button on the plugin <a href='admin.php?page=cff-top' target='_blank'>settings page</a> to obtain your own Access Token and avoid any disruptions in your feed(s).</p> 
        </div>
        ");
}
add_action('admin_init', 'cff_nag_token_ignore');
function cff_nag_token_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cff_nag_token_ignore']) && '0' == $_GET['cff_nag_token_ignore'] ) {
             add_user_meta($user_id, 'cff_ignore_token_notice', 'true', true);
    }
}


// Add a Settings link to the plugin on the Plugins page
$cff_plugin_file = 'custom-facebook-feed-pro/custom-facebook-feed.php';
add_filter( "plugin_action_links_{$cff_plugin_file}", 'cff_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function cff_add_settings_link( $links, $file ) {
    $cff_settings_link = '<a href="' . admin_url( 'admin.php?page=cff-top' ) . '">' . __( 'Settings', 'cff-top' ) . '</a>';
    array_unshift( $links, $cff_settings_link );
 
    return $links;
}

//Delete cache
function cff_delete_cache(){
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_ej\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_tle\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_album\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_timeout\_cff\_%')
        " );

    //Clear cache of major caching plugins
    if(isset($GLOBALS['wp_fastest_cache']) && method_exists($GLOBALS['wp_fastest_cache'], 'deleteCache')){
        $GLOBALS['wp_fastest_cache']->deleteCache();
    }
    //WP Super Cache
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
    //W3 Total Cache
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
    }
    if (function_exists('sg_cachepress_purge_cache')) {
        sg_cachepress_purge_cache();
    }

}

//Cron job to clear transients
add_action('cff_cron_job', 'cff_cron_clear_cache');
function cff_cron_clear_cache() {
    //Delete all transients unless it's using background caching
    if( get_option('cff_caching_type') != 'background' ) cff_delete_cache();
}

//Add custom cron schedule
add_filter( 'cron_schedules', 'cff_cron_custom_interval' );
function cff_cron_custom_interval( $schedules ) {
    $schedules['30mins'] = array(
        'interval' => 30*60,
        'display' => __( 'Every 30 minutes' )
    );
    return $schedules;
}


//Cron job to get_set_cache
add_action('cff_cache_cron', 'cff_cache_cron_function');
function cff_cache_cron_function() {

    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $cff_transients_raw = $wpdb->get_results( "
        SELECT `option_name` AS `name`, `option_value` AS `value`
        FROM  $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_%')
        ORDER BY `option_name`
        " );
    $cff_transients = array();
    // write_log($cff_transients_raw);

    // cff_delete_cache(); Don't clear the cache here as it should just replace it below

    //Loop through the transients
    foreach ( $cff_transients_raw as $result ) {

        //Remove _transient_ prefix from the transient name as it's added automatically when the transient is set
        $result_name = $result->name;
        $prefix = '_transient_';
        if (substr($result_name, 0, strlen($prefix)) == $prefix) $result_name = substr($result_name, strlen($prefix));

        //Don't re set the meta transients as they can be fetched on page load
        if ( 0 !== strpos( $result_name, 'cff_meta' ) && substr( $result_name, 0, 8 ) !== "cff_tle_" ) {

            $result_value = maybe_unserialize( $result->value );

            //Create an array of the transients
            $cff_transients[ $result_name ] = $result_value;

            //Get the API URL from the JSON array
            $existing_data = json_decode($result_value);
            $cff_posts_json_url = $existing_data->api_url;

            //Get the contents of the Facebook page
            $new_posts_json = cff_fetchUrl($cff_posts_json_url);
            $FBdata = json_decode($new_posts_json);

            //Check whether the JSON is wrapped in a "data" property as if it doesn't then it's a featured post
            $prefix_data = '{"data":';
            (substr($new_posts_json, 0, strlen($prefix_data)) == $prefix_data) ? $cff_featured_post = false : $cff_featured_post = true;

            //Add API URL to beginning of JSON array
            $prefix = '{';
            if (substr($new_posts_json, 0, strlen($prefix)) == $prefix) $new_posts_json = substr($new_posts_json, strlen($prefix));
            $new_posts_json = '{"api_url":"'.$cff_posts_json_url.'", ' . $new_posts_json;

            //If it's a featured post then it doesn't contain 'data'
            ( $cff_featured_post ) ? $FBdata = $FBdata : $FBdata = $FBdata->data;

            if( !empty($FBdata) ) {
                //Cache the JSON
                set_transient( $result_name, $new_posts_json, 7 * DAY_IN_SECONDS );
            }
            

        } else {

            //Delete the meta transients so they can be re set when the pages loads
            delete_transient( $result_name );
            $wpdb->query( "
            DELETE
            FROM $table_name
            WHERE `option_name` LIKE ('%\_transient\_cff\_meta\_%')
            " );
        }
        
    } // End foreach

    //Clear cache of major caching plugins
    if(isset($GLOBALS['wp_fastest_cache']) && method_exists($GLOBALS['wp_fastest_cache'], 'deleteCache')){
        $GLOBALS['wp_fastest_cache']->deleteCache();
    }
    //WP Super Cache
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
    //W3 Total Cache
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
    }

}

add_action('admin_init', 'cff_disable_welcome');
function cff_disable_welcome() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cff_disable_welcome']) && '0' == $_GET['cff_disable_welcome'] ) {
             add_user_meta($user_id, 'cff_disable_welcome', 'true', true);
    }
}

//Add this to functions.php to log entries to debug.log file (wp-content > debug.log)
//http://www.websightdesigns.com/wiki/WordPress_Development
/*
if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}
*/

?>