<?php 

//Include admin
include dirname( __FILE__ ) .'/custom-facebook-feed-admin.php';
include dirname( __FILE__ ) .'/cff_autolink.php';

//[custom-facebook-feed]
add_shortcode('custom-facebook-feed', 'display_cff');
function display_cff( $feed_options ) {
    $data_att_html = cff_get_shortcode_data_attribute_html( $feed_options );

    //If an access token is set in the shortcode then set "use own access token" to be enabled
    if( isset($feed_options['accesstoken']) ) $feed_options['ownaccesstoken'] = 'on';

    $feed_options = cff_get_processed_options( $feed_options );
    $json_data_arr = cff_get_json_data( $feed_options, null, $data_att_html );

    isset($json_data_arr) ? $next_urls_arr_safe = cff_get_next_url_parts( $json_data_arr ) : $next_urls_arr_safe = '';
    $html = cff_get_post_set_html( $feed_options, $json_data_arr, 'false' );


    //Create the prev URLs array to add to the button
    $prev_urls_arr_safe = '{';
    if ( !empty($json_data_arr) ) {
        //Loop through $json_data_arr and create a JSON string of the prev URLs to return and use in the pag button    
        foreach ( $json_data_arr as $page_id => $json_data ) {
            if(isset($json_data->api_url)){
                $prev_url = $json_data->api_url;

                //Hide the Access Tokens in the URLs
                $url_queries = parse_url($prev_url, PHP_URL_QUERY);
                parse_str($url_queries, $output);

                //If the URL is encoded then encode the Access Token so that it matches when searching
                if (strpos($prev_url, '%7C') !== false) {
                    $replace_token = urlencode( $output['access_token'] );
                } else {
                    $replace_token = $output['access_token'];
                }

                //Hide the token in the URL
                $safe_prev_url = str_replace($replace_token,"x_cff_hide_token_x",$prev_url);

                //Add it to the JSON string to be returned
                $prev_urls_arr_safe .= '&quot;'.$page_id.'&quot;: &quot;'.$safe_prev_url.'&quot;, ';
            }
        }
    }
    $prev_urls_arr_safe .= '}';
    //If the array ends in a comma then remove the comma
    if( substr($prev_urls_arr_safe, -3) == ', }' ) $prev_urls_arr_safe = str_replace(", }", "}", $prev_urls_arr_safe);


    //***FEED CONTAINER HTML (header, likebox, load more, etc)***//
    //Width
    $cff_feed_width = $feed_options[ 'width' ];
    if ( is_numeric(substr($cff_feed_width, -1, 1)) ) $cff_feed_width = $cff_feed_width . 'px';
    //Set to be 100% width on mobile?
    $cff_feed_width_resp = $feed_options[ 'widthresp' ];
    ( $cff_feed_width_resp == 'on' || $cff_feed_width_resp == 'true' || $cff_feed_width_resp == true ) ? $cff_feed_width_resp = true : $cff_feed_width_resp = false;
    if( $feed_options[ 'widthresp' ] == 'false' ) $cff_feed_width_resp = false;

    //Height
    $cff_feed_height = $feed_options[ 'height' ];
    if ( is_numeric(substr($cff_feed_height, -1, 1)) ) $cff_feed_height = $cff_feed_height . 'px';
    //Padding
    $cff_feed_padding = $feed_options[ 'padding' ];
    if ( is_numeric(substr($cff_feed_padding, -1, 1)) ) $cff_feed_padding = $cff_feed_padding . 'px';
    //Bg color
    $cff_bg_color = $feed_options[ 'bgcolor' ];

    //Page or Group
    $cff_is_group = false;
    $cff_page_type = $feed_options[ 'pagetype' ];
    if ($cff_page_type == 'group') $cff_is_group = true;

    //Include string
    $cff_includes = $feed_options[ 'include' ];
    $cff_show_media = false;
    if ( stripos($cff_includes, 'media') !== false ) $cff_show_media = true;

    //Lightbox
    $cff_disable_lightbox = $feed_options['disablelightbox'];
    ( $cff_disable_lightbox == 'on' || $cff_disable_lightbox == 'true' || $cff_disable_lightbox == true ) ? $cff_disable_lightbox = true : $cff_disable_lightbox = false;
    if( $feed_options[ 'disablelightbox' ] == 'false' ) $cff_disable_lightbox = false;

    
    $cff_multifeed_active = $feed_options[ 'multifeedactive' ];
    $cff_featured_post_active = $feed_options[ 'featuredpostactive' ];
    $cff_album_active = $feed_options[ 'albumactive' ];
    $cff_masonry_columns_active = false; //Deprecated
    $cff_carousel_active = $feed_options[ 'carouselactive' ];
    $cff_reviews_active = $feed_options[ 'reviewsactive' ];

    $cff_album_id = $feed_options['album'];
    ( $cff_album_active && !empty($cff_album_id) ) ? $cff_album_embed = true : $cff_album_embed = false;

    ( $feed_options['reviewsmethod'] == 'all' ) ? $show_all_reviews = true : $show_all_reviews = false;

    //Post types
    $cff_types = $feed_options['type'];
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    $cff_show_albums_type = false;
    $cff_reviews = false;
    if ( stripos($cff_types, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_types, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_types, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_types, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_types, 'album') !== false ) $cff_show_albums_type = true;
    if ( stripos($cff_types, 'status') !== false ) $cff_show_status_type = true;
    if ( stripos($cff_types, 'review') !== false && $cff_reviews_active ) $cff_reviews = true;

    //Events only
    $cff_events_source = $feed_options[ 'eventsource' ];
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';
    $cff_event_offset = $feed_options[ 'eventoffset' ];
    if ( empty($cff_event_offset) || !isset($cff_event_offset) ) $cff_event_offset = '6';
    ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_albums_type) ? $cff_events_only = true : $cff_events_only = false;

    //Albums only
    $cff_albums_source = $feed_options[ 'albumsource' ];
    ( ($cff_show_albums_type && $cff_albums_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) ? $cff_albums_only = true : $cff_albums_only = false;

    //Photos only
    $cff_photos_source = $feed_options[ 'photosource' ];
    ( ($cff_show_photos_type && $cff_photos_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_event_type && !$cff_show_status_type && !$cff_show_albums_type) ? $cff_photos_only = true : $cff_photos_only = false;

    //Videos only
    $cff_videos_source = $feed_options[ 'videosource' ];
    ( ($cff_show_video_type && $cff_videos_source == 'videospage') && !$cff_show_albums_type && !$cff_show_links_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) ? $cff_videos_only = true : $cff_videos_only = false;
    
    //If it's a featured post then it isn't a dedicated feed type
    if( $cff_featured_post_active && !empty($feed_options['featuredpost']) ){
        $cff_albums_only = false;
        $cff_photos_only = false;
        $cff_videos_only = false;
    }

    //Post layout
    $cff_preset_layout = $feed_options[ 'layout' ];
    //Default is thumbnail layout
    $cff_thumb_layout = false;
    $cff_half_layout = false;
    $cff_full_layout = true;
    if (($cff_preset_layout == 'thumb' || empty($cff_preset_layout)) && $cff_show_media) {
        $cff_thumb_layout = true;
    } else if ($cff_preset_layout == 'half'  && $cff_show_media) {
        $cff_half_layout = true;
    } else {
        $cff_full_layout = true;
    }

    //Masonry
    $masonry = $feed_options['masonry'];
    //Or if new options set to more than 1 column then enable masonry
    if( intval($feed_options['cols']) > 1 ) $masonry = true;

    //Disable masonry for grid feeds
    if( $cff_albums_only || $cff_photos_only || $cff_videos_only ) $masonry = false;

    $js_only = isset( $feed_options['colsjs'] ) ? $feed_options['colsjs'] : false;
    if( $js_only === 'false' ) $js_only = false;

    // Masonry and Carousel feeds are incompatible so we check to see if carousel is active
    // and set Masonry to false if it is
    if( $cff_carousel_active && ( $feed_options['carousel'] === 'on' || $feed_options['carousel'] === "true" || $feed_options['carousel'] === true ) ) {
        $masonry = false;
    }
    if( $masonry || $masonry == 'true' ) {
        $feed_options['headeroutside'] = true;

        // Carousel feeds are incompatible with the columns setting for the main plugin
        $feed_options['columnscompatible'] = false;
    }

    $masonry_opaque_comments = false;
    $masonry_classes = '';
    if( isset($masonry) ) {
        if( $masonry === 'on' || $masonry === true || $masonry === 'true' ) {
            $cols = $feed_options['cols'];
            $colsmobile = $feed_options['colsmobile'];

            if( ( empty($cols) || !isset($cols) ) && isset($feed_options['masonrycols']) ) $cols = $feed_options['masonrycols'];
            if( ( empty($colsmobile) || !isset($colsmobile) ) && isset($feed_options['masonrycolsmobile']) ) $colsmobile = $feed_options['masonrycolsmobile'];

            $masonry_classes .= 'cff-masonry';

            if( $feed_options['cols'] != 3 ) {
                $masonry_classes .= sprintf( ' masonry-%s-desktop', $cols );
            }
            if( $colsmobile == 2 ) {
                $masonry_classes .= ' masonry-2-mobile';
            }
            if( ! $js_only ) {
                $masonry_classes .= ' cff-masonry-css';
            } else {
                $masonry_classes .= ' cff-masonry-js';
            }

            //Is there a bg color set on either the post or the comments box?
            if( ( $feed_options['poststyle'] == 'boxed' && strlen($feed_options['postbgcolor']) > 2 ) || strlen($feed_options['socialbgcolor']) > 2 ){
                $masonry_opaque_comments = true;
                $masonry_classes .= ' cff-opaque-comments';
            }
        }
    }

    //Set like box variable
    //If there are more than one page id then use the first one
    $like_box_page_id = explode(",", str_replace(' ', '', $feed_options['id']) );
    $cff_like_box_position = $feed_options[ 'likeboxpos' ];
    $cff_like_box_outside = $feed_options[ 'likeboxoutside' ];
    $cff_likebox_bg_color = $feed_options[ 'likeboxcolor' ];
    $cff_like_box_text_color = $feed_options[ 'likeboxtextcolor' ];
    $cff_like_box_colorscheme = 'light';
    if ($cff_like_box_text_color == 'white') $cff_like_box_colorscheme = 'dark';

    $cff_likebox_width = $feed_options[ 'likeboxwidth' ];
    if ( is_numeric(substr($cff_likebox_width, -1, 1)) ) $cff_likebox_width = $cff_likebox_width;
    if ( !isset($cff_likebox_width) || empty($cff_likebox_width) || $cff_likebox_width == '' ) $cff_likebox_width = '';
    //If set to 100% then set to be widest width
    if( $cff_likebox_width == '100%' ) $cff_likebox_width = 500;
    //Remove percentage symbol if included as must be an absolute number
    $cff_likebox_width = str_replace("%", "", $cff_likebox_width);

    $cff_like_box_faces = $feed_options[ 'likeboxfaces' ];
    ( $cff_like_box_faces == 'on' || $cff_like_box_faces == 'true' || $cff_like_box_faces == true ) ? $cff_like_box_faces = 'true' : $cff_like_box_faces = 'false';
    if( $feed_options[ 'likeboxfaces' ] === 'false' ) $cff_like_box_faces = 'false';

    $cff_like_box_border = $feed_options[ 'likeboxborder' ];
    if ($cff_like_box_border) {
        $cff_like_box_border = 'true';
    } else {
        $cff_like_box_border = 'false';
    }

    $cff_like_box_cover = $feed_options[ 'likeboxcover' ];
    ( $cff_like_box_cover == 'on' || $cff_like_box_cover == 'true' || $cff_like_box_cover == true ) ? $cff_like_box_cover = 'false' : $cff_like_box_cover = 'true';
    if( $feed_options[ 'likeboxcover' ] === 'false' ) $cff_like_box_cover = 'true';

    $cff_like_box_small_header = $feed_options[ 'likeboxsmallheader' ];
    if ($cff_like_box_small_header) {
        $cff_like_box_small_header = 'true';
    } else {
        $cff_like_box_small_header = 'false';
    }
    $cff_like_box_hide_cta = $feed_options[ 'likeboxhidebtn' ];
    if ($cff_like_box_hide_cta) {
        $cff_like_box_hide_cta = 'true';
    } else {
        $cff_like_box_hide_cta = 'false';
    }

    $cff_locale = $feed_options[ 'locale' ];
    if ( empty($cff_locale) || !isset($cff_locale) || $cff_locale == '' ) $cff_locale = 'en_US';

    $cff_facebook_link_text = $feed_options[ 'facebooklinktext' ];

    //Like Box HTML
    $like_box = '<';
    //If the Like Box is at the top then change the element from a div so that it doesn't interfere with the "nth-of-type" used for grids in CSS
    ($cff_like_box_position == 'top') ? $like_box .= 'section' : $like_box .= 'div';
    $like_box .= ' class="cff-likebox';

    if ($cff_like_box_outside) $like_box .= ' cff-outside';
    $like_box .= ($cff_like_box_position == 'top') ? ' cff-top' : ' cff-bottom';
    $like_box .= '" >';

    //Calculate the like box height
    $cff_likebox_height = 135;
    if( $cff_like_box_small_header == 'true' ) $cff_likebox_height = 75;
    if( $cff_like_box_faces == 'true' ) $cff_likebox_height = 219;
    if( $cff_like_box_small_header == 'true' && $cff_like_box_faces == 'true' ) $cff_likebox_height = 159;

    //Src is set in JS now so can be dynamic based on screen size as 'adapt_container_width' doesn't work in iframe
    $like_box .= '<iframe src="" data-likebox-id="'.$like_box_page_id[0].'" data-likebox-width="'.$cff_likebox_width.'" data-likebox-header="'.$cff_like_box_small_header.'" data-hide-cover="'.$cff_like_box_cover.'" data-hide-cta="'.$cff_like_box_hide_cta.'" data-likebox-faces="'.$cff_like_box_faces.'" height="'.$cff_likebox_height.'px" data-height="'.$cff_likebox_height.'" data-locale="'.$cff_locale.'" style="border:none;overflow:hidden" scrolling="no" allowTransparency="true" allow="encrypted-media" class="fb_iframe_widget" title="Facebook Like Box widget"></iframe>';

    $like_box .= '</';
    ($cff_like_box_position == 'top') ? $like_box .= 'section' : $like_box .= 'div';
    $like_box .= '>';

    //Don't show like box if it's a group
    if($cff_is_group) $like_box = '';

    //Text limits
    $title_limit = $feed_options['textlength'];
    if (!isset($title_limit)) $title_limit = 9999;

    //LOAD MORE BUTTON
    $cff_load_more = $feed_options['loadmore'];
    ($cff_load_more || $cff_load_more == 'true' || $cff_load_more == 'on') ? $cff_load_more = true : $cff_load_more = false;
    if( $feed_options[ 'loadmore' ] === 'false' ) $cff_load_more = false;


    //Button styles
    $cff_load_more_bg = $feed_options['buttoncolor'];
    $cff_load_more_bg_hover = $feed_options['buttonhovercolor'];
    $cff_load_more_text_color = $feed_options['buttontextcolor'];
    $cff_load_more_text = stripslashes( $feed_options['buttontext'] );
    if( empty($cff_load_more_text) ) $cff_load_more_text = 'Load more';
    $cff_no_more_posts_text = $feed_options['nomoretext'];

    $cff_load_more_styles = '';
    if( ( !empty($cff_load_more_bg) && $cff_load_more_bg !== '#' ) || (!empty($cff_load_more_text_color) && $cff_load_more_text_color !== '#') ) $cff_load_more_styles = 'style="';
        if ( !empty($cff_load_more_bg) && $cff_load_more_bg !== '#' ) $cff_load_more_styles .= 'background-color: #' . str_replace('#', '', $cff_load_more_bg) . '; ';
        if ( !empty($cff_load_more_text_color) && $cff_load_more_text_color !== '#' ) $cff_load_more_styles .= 'color: #' . str_replace('#', '', $cff_load_more_text_color) . '; ';
    if( ( !empty($cff_load_more_bg) && $cff_load_more_bg !== '#' ) || (!empty($cff_load_more_text_color) && $cff_load_more_text_color !== '#') ) $cff_load_more_styles .= '"';


    //HEADER
    $cff_show_header = $feed_options['showheader'];
    ($cff_show_header == 'true' || $cff_show_header == 'on') ? $cff_show_header = true : $cff_show_header = false;

    //Get feed header settings
    $cff_header_outside = $feed_options['headeroutside'];
    ($cff_header_outside == 'true' || $cff_header_outside == 'on') ? $cff_header_outside = true : $cff_header_outside = false;
    $cff_header_text = stripslashes( $feed_options['headertext'] );

    $cff_header_icon = $feed_options['headericon'];
    $cff_header_icon_color = $feed_options['headericoncolor'];
    $cff_header_icon_size = $feed_options['headericonsize'];
    $cff_header_bg_color = $feed_options['headerbg'];
    $cff_header_padding = $feed_options['headerpadding'];
    if ( is_numeric(substr($cff_header_padding, -1, 1)) ) $cff_header_padding = $cff_header_padding . 'px';

    $cff_header_text_size = $feed_options['headertextsize'];
    $cff_header_text_weight = $feed_options['headertextweight'];
    $cff_header_text_color = $feed_options['headertextcolor'];

    //Compile feed header styles
    $cff_header_styles = '';
    if( ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) || !empty($cff_header_padding) || ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) || ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) || (!empty($cff_header_text_color) && $cff_header_text_color !== '#') ) $cff_header_styles = 'style="';
        if ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) $cff_header_styles .= 'background-color: #' . str_replace('#', '', $cff_header_bg_color) . '; ';
        if ( !empty($cff_header_padding) ) $cff_header_styles .= 'padding: ' . $cff_header_padding . '; ';
        if ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) $cff_header_styles .= 'font-size: ' . $cff_header_text_size . 'px; ';
        if ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) $cff_header_styles .= 'font-weight: ' . $cff_header_text_weight . '; ';
        if ( !empty($cff_header_text_color) && $cff_header_text_color !== '#' ) $cff_header_styles .= 'color: #' . str_replace('#', '', $cff_header_text_color) . '; ';
    if( ( !empty($cff_header_bg_color) && $cff_header_bg_color !== '#' ) || !empty($cff_header_padding) || ( !empty($cff_header_text_size) && $cff_header_text_size != 'inherit' ) || ( !empty($cff_header_text_weight) && $cff_header_text_weight != 'inherit' ) || (!empty($cff_header_text_color) && $cff_header_text_color !== '#') ) $cff_header_styles .= '"';

    $cff_header = '<h3 class="cff-header';
    if ($cff_header_outside) $cff_header .= ' cff-outside';
    $cff_header .= '" ' . $cff_header_styles . '>';
    $cff_header .= '<span class="fa fab fa-' . $cff_header_icon . '" aria-hidden="true"';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size)) $cff_header .= ' style="';
    if(!empty($cff_header_icon_color)) $cff_header .= 'color: #' . str_replace('#', '', $cff_header_icon_color) . ';';
    if(!empty($cff_header_icon_size)) $cff_header .= ' font-size: ' . $cff_header_icon_size . 'px;';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size))$cff_header .= '"';
    $cff_header .= '></span>';
    $cff_header .= '<span class="cff-header-text" style="height: '.$cff_header_icon_size.'px;">' . $cff_header_text . '</span>';
    $cff_header .= '</h3>';

    //Narrow styles
    $cff_enable_narrow = $feed_options['enablenarrow'];
    ($cff_enable_narrow == 'true' || $cff_enable_narrow == 'on') ? $cff_enable_narrow = true : $cff_enable_narrow = false;

    $cff_class = $feed_options['class'];

    //Is it a restricted page?
    $cff_restricted_page = $feed_options['restrictedpage'];
    ($cff_restricted_page == 'true' || $cff_restricted_page == 'on') ? $cff_restricted_page = true : $cff_restricted_page = false;

    //Compile feed styles
    $cff_feed_styles = '';
    if ( !empty($cff_feed_width) || !empty($cff_feed_height) || !empty($cff_feed_padding) || (!empty($cff_bg_color) && $cff_bg_color != '#') ) $cff_feed_styles .= 'style="';
    if ( !empty($cff_feed_width) ) $cff_feed_styles .= 'width:' . $cff_feed_width . '; ';
    if ( !empty($cff_feed_height) ) $cff_feed_styles .= 'height:' . $cff_feed_height . '; ';
    if ( !empty($cff_feed_padding) ) $cff_feed_styles .= 'padding:' . $cff_feed_padding . '; ';
    if ( !empty($cff_bg_color) && $cff_bg_color != '#' ) $cff_feed_styles .= 'background-color:#' . str_replace('#', '', $cff_bg_color) . '; ';
    if ( !empty($cff_feed_width) || !empty($cff_feed_height) || !empty($cff_feed_padding) || (!empty($cff_bg_color) && $cff_bg_color != '#') )$cff_feed_styles .= '"';

    //The main wrapper, only outputted once
    $cff_content = '';

    //Add the page header to the outside of the top of feed
    if ($cff_show_header && $cff_header_outside) $cff_content .= $cff_header;

    //Like Box
    $cff_includes = $feed_options[ 'include' ];
    $cff_excludes = $feed_options[ 'exclude' ];
    $cff_show_like_box = false;
    if ( stripos($cff_includes, 'like') !== false ) $cff_show_like_box = true;
    if ( stripos($cff_excludes, 'like') !== false ) $cff_show_like_box = false;

    //Add like box to the outside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Create CFF container HTML
    $cff_content .= '<div class="cff-wrapper">';
    $cff_content .= '<div id="cff" ';
    if( !empty($title_limit) ) $cff_content .= 'data-char="'.$title_limit.'" ';
    $cff_content .= 'class="cff ';
    if( !empty($cff_class) ) $cff_content .= $cff_class . ' ';

    // Hook for adding classes to the #cff element
    $classes = '';
    $classes .= apply_filters( 'cff_feed_class', $classes, $feed_options ).' ';
    $cff_content .= $masonry_classes;
    $cff_content .= $classes;

    if ( !empty($cff_feed_height) ) $cff_content .= 'cff-fixed-height ';
    if ( $cff_thumb_layout ) $cff_content .= 'cff-thumb-layout ';
    if ( $cff_half_layout ) $cff_content .= 'cff-half-layout ';
    if ( !$cff_enable_narrow ) $cff_content .= 'cff-disable-narrow ';
    if ( $cff_feed_width_resp ) $cff_content .= 'cff-width-resp ';
    if ( !$cff_albums_only && !$cff_photos_only && !$cff_videos_only && !$cff_events_only && !$cff_album_embed ) $cff_content .= 'cff-timeline-feed ';
    if ( $cff_albums_only || $cff_photos_only || $cff_videos_only || $cff_album_embed ) $cff_content .= 'cff-album-items-feed ';
    if ( $cff_load_more ) $cff_content .= 'cff-pag ';
    if ( $cff_is_group ) $cff_content .= 'cff-group ';
    if ( $show_all_reviews ) $cff_content .= 'cff-all-reviews ';

    $cff_no_svgs = $feed_options['disablesvgs'];
    if ( $cff_no_svgs ) $cff_content .= 'cff-no-svgs ';
    $cff_content .= 'cff-nojs ';

    //Lightbox extension
    if ( $cff_disable_lightbox && ($feed_options['lightbox'] == 'true' || $feed_options['lightbox'] == 'on') ) $cff_content .= ' cff-lightbox';
    if ( !$cff_disable_lightbox ) $cff_content .= ' cff-lb';
    $cff_content .= '" ' . $cff_feed_styles;
    $cff_content .= ' data-fb-text="'.stripslashes(__( $cff_facebook_link_text, 'custom-facebook-feed' ) ).'"';
    $cff_content .= ' data-offset="'.$feed_options['offset'].'"';

    //Timeline pagination method
    $cff_timeline_pag = $feed_options['timelinepag'];
    if( $cff_timeline_pag == 'paging' ) $cff_content .= ' data-timeline-pag="true"';

    //Using own token - pass to connect.php
    if( $feed_options['ownaccesstoken'] ) $cff_content .= ' data-own-token="true"';

    //Grid pagination method
    $cff_grid_pag = $feed_options['gridpag'];

    //If it's set to auto then decide the method in the PHP using the vars above
    if( $cff_grid_pag == 'auto' ){
        //Set to cursor initially
        $cff_grid_pag = 'cursor';
        //If there's a filter being used, it's a multifeed, or the limit is set to be higher than the num, then use the offset method instead
        if( !empty($feed_options[ 'filter' ]) || !empty($feed_options[ 'exfilter' ]) || ( $cff_multifeed_active && strpos($feed_options['id'], ',') !== false ) || ( intval($feed_options[ 'limit' ]) > intval($feed_options[ 'num' ]) ) ) $cff_grid_pag = 'offset';
    }
    $cff_content .= ' data-grid-pag="'.$cff_grid_pag.'"';
    if( $cff_restricted_page ) $cff_content .= ' data-restricted="true"';

    //Lightbox comments
    $cff_lightbox_comments = true;
    if( $feed_options[ 'lightboxcomments' ] === 'false' || $feed_options['lightboxcomments'] == false ) $cff_lightbox_comments = false;

    //Disable lightbox comments if it's a dedicated feed type
    if( ( $cff_events_only && $cff_events_source == 'eventspage' ) || $cff_albums_only || $cff_photos_only || $cff_videos_only) $cff_lightbox_comments = false;

    //Add data attr for lightbox comments
    $cff_content .= ( $cff_lightbox_comments && !$cff_album_embed ) ? ' data-lb-comments="true"' : ' data-lb-comments="false"';

    //If the number of posts isn't set then set the pagination number to be 25
    $pag_num = $feed_options['num'];
    if( (!isset($pag_num) || empty($pag_num) || $pag_num == '') && $pag_num != '0' ) $pag_num = 25;
    $cff_content .= ' data-pag-num="'.$pag_num.'"';

    //Add the absolute path to the container to be used in the connect.php file for group albums
    if($cff_albums_only && $cff_albums_source == 'photospage' && $cff_is_group) $cff_content .= ' data-group="true" ';

    // $cff_content .= apply_filters('cff_data_atts',$cff_content,$feed_options).' ';
    $cff_carousel_active = $feed_options['carouselactive'];
    $cff_is_carousel = false;
    if( $cff_carousel_active ){
        if( function_exists('cff_carousel_data_atts') ){
            $cff_content .= cff_carousel_data_atts( $feed_options );
            $cff_is_carousel = true;
        }
    }


    ( $feed_options['featuredpostactive'] && !empty($feed_options['featuredpost']) ) ? $cff_featured_post = true : $cff_featured_post = false;
    //If the Featured Post is enabled then disable the load more button
    if( $cff_featured_post ) $cff_load_more = false;

    //Add the shortcode data for pagination
    $cff_content .= ' data-cff-shortcode="'. $data_att_html .'"';

    $cff_content .= '>';

    $cff_content .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="cff-screenreader" role="img" aria-labelledby="metaSVGid metaSVGdesc"><title id="metaSVGid">Comments Box SVG icons</title><desc id="metaSVGdesc">Used for the like, share, comment, and reaction icons</desc><defs><linearGradient id="angryGrad" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#f9ae9e" /><stop offset="70%" stop-color="#ffe7a4" /></linearGradient><linearGradient id="likeGrad"><stop offset="25%" stop-color="rgba(0,0,0,0.05)" /><stop offset="26%" stop-color="rgba(255,255,255,0.7)" /></linearGradient><linearGradient id="likeGradHover"><stop offset="25%" stop-color="#a3caff" /><stop offset="26%" stop-color="#fff" /></linearGradient><linearGradient id="likeGradDark"><stop offset="25%" stop-color="rgba(255,255,255,0.5)" /><stop offset="26%" stop-color="rgba(255,255,255,0.7)" /></linearGradient></defs></svg>';

    //Add the page header to the inside of the top of feed
    if ($cff_show_header && !$cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the inside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;



    //****INSERT THE POSTS*****//
    $cff_content .= '<div class="cff-posts-wrap">';
    $cff_content .= $html;
    $cff_content .= '</div>';

    //Don't show the load more button or credit link if there's an error
    (strpos($html, 'cff-error-msg') !== false) ? $cff_is_error = true : $cff_is_error = false;
    if( !$cff_is_error ){

        //If the load more is enabled and the number of posts is not set to be zero then show the load more button
        if( $cff_load_more && $pag_num > 0 ){
            //Load More button
            $cff_content .= '<input type="hidden" class="cff-pag-url" data-cff-pag-url="'.$next_urls_arr_safe.'" data-cff-prev-url="'.$prev_urls_arr_safe.'" val="">';
            $cff_content .= '<a href="javascript:void(0);" id="cff-load-more" class="cff-load-more" '.$cff_load_more_styles.' data-cff-bg="'.$cff_load_more_bg.'" data-cff-hover="'.$cff_load_more_bg_hover.'" data-no-more="'.$cff_no_more_posts_text.'"><span>'.$cff_load_more_text.'</span></a>';
        }

        //Add the Like Box inside
        if ($cff_like_box_position == 'bottom' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
        /* Credit link */
        $cff_show_credit = $feed_options['credit'];
        ($cff_show_credit == 'true' || $cff_show_credit == 'on') ? $cff_show_credit = true : $cff_show_credit = false;

        $cff_posttext_link_color = str_replace('#', '', $feed_options['textlinkcolor'] );

        $cff_posttext_link_color_html = '';
        if( isset($cff_posttext_link_color) && !empty($cff_posttext_link_color) && $cff_posttext_link_color != '#' ) $cff_posttext_link_color_html = 'style="color: #'.$cff_posttext_link_color.'"';

        if($cff_show_credit) $cff_content .= '<p class="cff-credit"><a href="https://smashballoon.com/custom-facebook-feed/" target="_blank" '.$cff_posttext_link_color_html.' title="Smash Balloon Custom Facebook Feed WordPress Plugin"><span class="cff-credit-logo"></span>The Custom Facebook Feed plugin</a></p>';

    } // !$cff_is_error


    //End the feed
    $cff_content .= '</div>';
    $cff_content .= '<div class="cff-clear"></div>';
    //Add the Like Box outside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //If the feed is loaded via Ajax then put the scripts into the shortcode itself
    $ajax_theme = $feed_options['ajax'];
    ( $ajax_theme == 'on' || $ajax_theme == 'true' || $ajax_theme == true ) ? $ajax_theme = true : $ajax_theme = false;
    if( $feed_options[ 'ajax' ] == 'false' ) $ajax_theme = false;
    if ($ajax_theme) {
        //Minify files?
        $options = get_option('cff_style_settings');
        isset($options[ 'cff_minify' ]) ? $cff_minify = $options[ 'cff_minify' ] : $cff_minify = '';
        $cff_minify ? $cff_min = '.min' : $cff_min = '';

        $url = plugins_url();
        $path = urlencode(ABSPATH);
        $cff_link_hashtags = $feed_options['linkhashtags'];
        $cff_title_link = $feed_options['textlink'];
        ($cff_link_hashtags == 'true' || $cff_link_hashtags == 'on') ? $cff_link_hashtags = 'true' : $cff_link_hashtags = 'false';
        if($cff_title_link == 'true' || $cff_title_link == 'on') $cff_link_hashtags = 'false';
        $cff_content .= '<script type="text/javascript">var cffsiteurl = "' . $url . '", cfflinkhashtags = "' . $cff_link_hashtags . '";</script>';
        $cff_content .= '<script type="text/javascript" src="' . plugins_url( '/js/cff-scripts'.$cff_min.'.js?ver='.CFFVER , __FILE__ ) . '"></script>';
    }
    $cff_content .= '</div>';

    if( isset( $cff_posttext_link_color ) && !empty( $cff_posttext_link_color ) ) $cff_content .= '<style>#cff .cff-post-text a{ color: #'.$cff_posttext_link_color.'; }</style>';

    //Hook to perform actions before returning $cff_content
    do_action( 'cff_before_return_content', $feed_options );
    
    return $cff_content;

}

// formats the shortcode arguments into a json string that gets outputted into the html on the page later
// inside a data attribute
function cff_get_shortcode_data_attribute_html( $feed_options ) {

    //If an access token is set in the shortcode then set "use own access token" to be enabled
    if( isset($feed_options['accesstoken']) ){
    	//Add an encryption string to protect token
    	if ( strpos($feed_options['accesstoken'], ',') !== false ) {
    		//If there are multiple tokens then just add the string after the colon to avoid having to de/reconstruct the array
	        $feed_options['accesstoken'] = str_replace(":", ":02Sb981f26534g75h091287a46p5l63", $feed_options['accesstoken']);
    	} else {
    		//Add an encryption string to protect token
	        $feed_options['accesstoken'] = substr_replace($feed_options['accesstoken'], '02Sb981f26534g75h091287a46p5l63', 25, 0);
    	}
    	$feed_options['ownaccesstoken'] = 'on';
    }

    if( !empty($feed_options) ){
        $json_data = '{';
        $i = 0;
        $len = count($feed_options);
        foreach( $feed_options as $key => $value ) {
            if ($i == $len - 1) {
                $json_data .= '&quot;'.$key.'&quot;: &quot;'.$value.'&quot;';
            } else {
                $json_data .= '&quot;'.$key.'&quot;: &quot;'.$value.'&quot;, ';
            }
            $i++;
        }
        $json_data .= '}';
        return $json_data;
    }

}

// this is where the shortcode arguments would be processed along with the default
// options and options in the database to create the final options to be used in the feed
function cff_get_processed_options( $feed_options ) {

    //Which extensions are active?
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $cff_ext_options = get_option('cff_extensions_status');

    //Set extensions in extensions plugin all to false by default
    $cff_ext_multifeed_active_check = false;
    $cff_ext_date_range_active_check = false;
    $cff_ext_featured_post_active_check = false;
    $cff_ext_album_active_check = false;
    $cff_ext_masonry_columns_active_check = false;
    $cff_ext_carousel_active_check = false;
    $cff_extensions_reviews_active = false;

    if (WPW_SL_ITEM_NAME == 'Custom Facebook Feed WordPress Plugin Smash'){
        //Set page variables
        if( isset($cff_ext_options[ 'cff_extensions_multifeed_active' ]) ) $cff_ext_multifeed_active_check = $cff_ext_options[ 'cff_extensions_multifeed_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_date_range_active' ]) ) $cff_ext_date_range_active_check = $cff_ext_options[ 'cff_extensions_date_range_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_featured_post_active' ]) ) $cff_ext_featured_post_active_check = $cff_ext_options[ 'cff_extensions_featured_post_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_album_active' ]) ) $cff_ext_album_active_check = $cff_ext_options[ 'cff_extensions_album_active' ];
        $cff_ext_masonry_columns_active_check = ''; //Deprecated
        if( isset($cff_ext_options[ 'cff_extensions_carousel_active' ]) ) $cff_ext_carousel_active_check = $cff_ext_options[ 'cff_extensions_carousel_active' ];
        if( isset($cff_ext_options[ 'cff_extensions_reviews_active' ]) ) $cff_extensions_reviews_active = $cff_ext_options[ 'cff_extensions_reviews_active' ];
    }

    ( is_plugin_active( 'cff-multifeed/cff-multifeed.php' ) || $cff_ext_multifeed_active_check ) ? $cff_ext_multifeed_active = true : $cff_ext_multifeed_active = false;
    ( is_plugin_active( 'cff-date-range/cff-date-range.php' ) || $cff_ext_date_range_active_check ) ? $cff_ext_date_active = true : $cff_ext_date_active = false;
    ( is_plugin_active( 'cff-featured-post/cff-featured-post.php' ) || $cff_ext_featured_post_active_check ) ? $cff_featured_post_active = true : $cff_featured_post_active = false;
    ( is_plugin_active( 'cff-album/cff-album.php' ) || $cff_ext_album_active_check ) ? $cff_album_active = true : $cff_album_active = false;
    $cff_masonry_columns_active = '';  //Deprecated
    ( is_plugin_active( 'cff-carousel/cff-carousel.php' ) || $cff_ext_carousel_active_check ) ? $cff_carousel_active = true : $cff_carousel_active = false;
    ( is_plugin_active( 'cff-reviews/cff-reviews.php' ) || $cff_extensions_reviews_active ) ? $cff_reviews_active = true : $cff_reviews_active = false;

    //Style options
    $options = get_option('cff_style_settings');
    //Create the types string to set as shortcode default
    $type_string = '';
    if($options[ 'cff_show_links_type' ]) $type_string .= 'links,';
    if($options[ 'cff_show_event_type' ]) $type_string .= 'events,';
    if($options[ 'cff_show_video_type' ]) $type_string .= 'videos,';
    if($options[ 'cff_show_photos_type' ]) $type_string .= 'photos,';
    //If the album option hasn't been set yet in the $options array (ie. plugin has been updated but the option hasn't been saved) then set albums to display by default
    if( !isset($options[ 'cff_show_albums_type' ]) ) $options[ 'cff_show_albums_type' ] = true;
    if($options[ 'cff_show_albums_type' ]) $type_string .= 'albums,';
    if($options[ 'cff_show_status_type' ]) $type_string .= 'statuses,';

    //Create the includes string to set as shortcode default
    $include_string = '';
    if($options[ 'cff_show_author' ]) $include_string .= 'author,';
    if($options[ 'cff_show_text' ]) $include_string .= 'text,';
    if($options[ 'cff_show_desc' ]) $include_string .= 'desc,';
    if($options[ 'cff_show_shared_links' ]) $include_string .= 'sharedlinks,';
    if($options[ 'cff_show_date' ]) $include_string .= 'date,';
    if($options[ 'cff_show_media' ]) $include_string .= 'media,';
    if($options[ 'cff_show_event_title' ]) $include_string .= 'eventtitle,';
    if($options[ 'cff_show_event_details' ]) $include_string .= 'eventdetails,';
    if($options[ 'cff_show_meta' ]) $include_string .= 'social,';
    if($options[ 'cff_show_link' ]) $include_string .= 'link,';
    if($options[ 'cff_show_like_box' ]) $include_string .= 'likebox,';

    //Reviews rated string
    $cff_reviews_string = '';
    if( isset($options[ 'cff_reviews_rated_5' ]) && isset($options[ 'cff_reviews_rated_4' ]) && isset($options[ 'cff_reviews_rated_3' ]) && isset($options[ 'cff_reviews_rated_2' ]) && isset($options[ 'cff_reviews_rated_1' ]) ){
        if($options[ 'cff_reviews_rated_5' ]) $cff_reviews_string .= '5,';
        if($options[ 'cff_reviews_rated_4' ]) $cff_reviews_string .= '4,';
        if($options[ 'cff_reviews_rated_3' ]) $cff_reviews_string .= '3,';
        if($options[ 'cff_reviews_rated_2' ]) $cff_reviews_string .= '2,';
        if($options[ 'cff_reviews_rated_1' ]) $cff_reviews_string .= '1';
    }

    //Get masonry extension options if available
    $cff_masonry_options = get_option('cff_masonry_options');

    //Pass in shortcode attrbutes, include filter for extensions
    $feed_options = shortcode_atts(
    array(
        'accesstoken' => trim(get_option('cff_access_token')),
        'ownaccesstoken' => true,
        'pagetoken' => get_option('cff_page_access_token'),
        'id' => get_option('cff_page_id'),
        'pagetype' => get_option('cff_page_type'),
        'num' => get_option('cff_num_show'),
        'limit' => get_option('cff_post_limit'),
        'others' => '',
        'showpostsby' => get_option('cff_show_others'),
        'cachetype' => get_option('cff_caching_type'),
        'cachetime' => get_option('cff_cache_time'),
        'cacheunit' => get_option('cff_cache_time_unit'),
        'locale' => get_option('cff_locale'),
        'ajax' => get_option('cff_ajax'),
        'offset' => '',

        //General
        'width' => isset($options[ 'cff_feed_width' ]) ? $options[ 'cff_feed_width' ] : '',
        'widthresp' => isset($options[ 'cff_feed_width_resp' ]) ? $options[ 'cff_feed_width_resp' ] : '',        
        'height' => isset($options[ 'cff_feed_height' ]) ? $options[ 'cff_feed_height' ] : '',
        'padding' => isset($options[ 'cff_feed_padding' ]) ? $options[ 'cff_feed_padding' ] : '',
        'bgcolor' => isset($options[ 'cff_bg_color' ]) ? $options[ 'cff_bg_color' ] : '',
        'showauthor' => '',
        'showauthornew' => isset($options[ 'cff_show_author' ]) ? $options[ 'cff_show_author' ] : '',
        'class' => isset($options[ 'cff_class' ]) ? $options[ 'cff_class' ] : '',
        'type' => $type_string,
        //Events only
        'eventsource' => isset($options[ 'cff_events_source' ]) ? $options[ 'cff_events_source' ] : '',
        'eventoffset' => isset($options[ 'cff_event_offset' ]) ? $options[ 'cff_event_offset' ] : '',
        'eventimage' => isset($options[ 'cff_event_image_size' ]) ? $options[ 'cff_event_image_size' ] : '',
        'pastevents' => 'false',
        //Albums only
        'albumsource' => isset($options[ 'cff_albums_source' ]) ? $options[ 'cff_albums_source' ] : '',
        'showalbumtitle' => isset($options[ 'cff_show_album_title' ]) ? $options[ 'cff_show_album_title' ] : '',
        'showalbumnum' => isset($options[ 'cff_show_album_number' ]) ? $options[ 'cff_show_album_number' ] : '',
        'albumcols' => isset($options[ 'cff_album_cols' ]) ? $options[ 'cff_album_cols' ] : '',
        //Photos only
        'photosource' => isset($options[ 'cff_photos_source' ]) ? $options[ 'cff_photos_source' ] : '',
        'photocols' => isset($options[ 'cff_photos_cols' ]) ? $options[ 'cff_photos_cols' ] : '',
        //Videos only
        'videosource' => isset($options[ 'cff_videos_source' ]) ? $options[ 'cff_videos_source' ] : '',
        'showvideoname' => isset($options[ 'cff_show_video_name' ]) ? $options[ 'cff_show_video_name' ] : '',
        'showvideodesc' => isset($options[ 'cff_show_video_desc' ]) ? $options[ 'cff_show_video_desc' ] : '',
        'videocols' => isset($options[ 'cff_video_cols' ]) ? $options[ 'cff_video_cols' ] : '',
        'playlist' => '',

        //Lightbox
        'disablelightbox' => isset($options[ 'cff_disable_lightbox' ]) ? $options[ 'cff_disable_lightbox' ] : '',

        //Filters
        'filter' => isset($options[ 'cff_filter_string' ]) ? trim($options[ 'cff_filter_string' ]) : '',
        'exfilter' => isset($options[ 'cff_exclude_string' ]) ? $options[ 'cff_exclude_string' ] : '',

        //Post Layout
        'layout' => isset($options[ 'cff_preset_layout' ]) ? $options[ 'cff_preset_layout' ] : '',
        'enablenarrow' => isset($options[ 'cff_enable_narrow' ]) ? $options[ 'cff_enable_narrow' ] : '',
        'oneimage' => isset($options[ 'cff_one_image' ]) ? $options[ 'cff_one_image' ] : '',

        'mediaposition' => isset($options[ 'cff_media_position' ]) ? $options[ 'cff_media_position' ] : '',
        'include' => $include_string,
        'exclude' => '',

        //Masonry
        'masonry' => isset($cff_masonry_options[ 'cff_masonry_enabled' ]) ? $cff_masonry_options[ 'cff_masonry_enabled' ] : '',
        'masonrycols' => isset($cff_masonry_options[ 'cff_masonry_desktop_col' ]) ? $cff_masonry_options[ 'cff_masonry_desktop_col' ] : '',
        'masonrycolsmobile' => isset($cff_masonry_options[ 'cff_masonry_mobile_col' ]) ? $cff_masonry_options[ 'cff_masonry_mobile_col' ] : '',
        'masonryjs' => true,

        //New masonry options
        'cols' => isset($options[ 'cff_masonry_desktop_col' ]) ? $options[ 'cff_masonry_desktop_col' ] : '',
        'colsmobile' => isset($options[ 'cff_masonry_mobile_col' ]) ? $options[ 'cff_masonry_mobile_col' ] : '',
        'colsjs' => true,

        //Post Style
        'poststyle' => isset($options[ 'cff_post_style' ]) ? $options[ 'cff_post_style' ] : '',
        'postbgcolor' => isset($options[ 'cff_post_bg_color' ]) ? $options[ 'cff_post_bg_color' ] : '',
        'postcorners' => isset($options[ 'cff_post_rounded' ]) ? $options[ 'cff_post_rounded' ] : '',
        'boxshadow' => isset($options[ 'cff_box_shadow' ]) ? $options[ 'cff_box_shadow' ] : '',

        //Typography
        'textformat' => isset($options[ 'cff_title_format' ]) ? $options[ 'cff_title_format' ] : '',
        'textsize' => isset($options[ 'cff_title_size' ]) ? $options[ 'cff_title_size' ] : '',
        'textweight' => isset($options[ 'cff_title_weight' ]) ? $options[ 'cff_title_weight' ] : '',
        'textcolor' => isset($options[ 'cff_title_color' ]) ? $options[ 'cff_title_color' ] : '',
        'textlinkcolor' => isset($options[ 'cff_posttext_link_color' ]) ? $options[ 'cff_posttext_link_color' ] : '',
        'textlink' => isset($options[ 'cff_title_link' ]) ? $options[ 'cff_title_link' ] : '',
        'posttags' => isset($options[ 'cff_post_tags' ]) ? $options[ 'cff_post_tags' ] : '',
        'linkhashtags' => isset($options[ 'cff_link_hashtags' ]) ? $options[ 'cff_link_hashtags' ] : '',
        'lightboxcomments' => isset($options[ 'cff_lightbox_comments' ]) ? $options[ 'cff_lightbox_comments' ] : true,

        //Author
        'authorsize' => isset($options[ 'cff_author_size' ]) ? $options[ 'cff_author_size' ] : '',
        'authorcolor' => isset($options[ 'cff_author_color' ]) ? $options[ 'cff_author_color' ] : '',

        //Description
        'descsize' => isset($options[ 'cff_body_size' ]) ? $options[ 'cff_body_size' ] : '',
        'descweight' => isset($options[ 'cff_body_weight' ]) ? $options[ 'cff_body_weight' ] : '',
        'desccolor' => isset($options[ 'cff_body_color' ]) ? $options[ 'cff_body_color' ] : '',
        'linktitleformat' => isset($options[ 'cff_link_title_format' ]) ? $options[ 'cff_link_title_format' ] : '',
        'linktitlesize' => isset($options[ 'cff_link_title_size' ]) ? $options[ 'cff_link_title_size' ] : '',
        'linkdescsize' => isset($options[ 'cff_link_desc_size' ]) ? $options[ 'cff_link_desc_size' ] : '',
        'linkurlsize' => isset($options[ 'cff_link_url_size' ]) ? $options[ 'cff_link_url_size' ] : '',
        'linkdesccolor' => isset($options[ 'cff_link_desc_color' ]) ? $options[ 'cff_link_desc_color' ] : '',
        'linktitlecolor' => isset($options[ 'cff_link_title_color' ]) ? $options[ 'cff_link_title_color' ] : '',
        'linkurlcolor' => isset($options[ 'cff_link_url_color' ]) ? $options[ 'cff_link_url_color' ] : '',
        'linkbgcolor' => isset($options[ 'cff_link_bg_color' ]) ? $options[ 'cff_link_bg_color' ] : '',
        'linkbordercolor' => isset($options[ 'cff_link_border_color' ]) ? $options[ 'cff_link_border_color' ] : '',
        'disablelinkbox' => isset($options[ 'cff_disable_link_box' ]) ? $options[ 'cff_disable_link_box' ] : '',


        //Event title
        'eventtitleformat' => isset($options[ 'cff_event_title_format' ]) ? $options[ 'cff_event_title_format' ] : '',
        'eventtitlesize' => isset($options[ 'cff_event_title_size' ]) ? $options[ 'cff_event_title_size' ] : '',
        'eventtitleweight' => isset($options[ 'cff_event_title_weight' ]) ? $options[ 'cff_event_title_weight' ] : '',
        'eventtitlecolor' => isset($options[ 'cff_event_title_color' ]) ? $options[ 'cff_event_title_color' ] : '',
        'eventtitlelink' => isset($options[ 'cff_event_title_link' ]) ? $options[ 'cff_event_title_link' ] : '',
        //Event date
        'eventdatesize' => isset($options[ 'cff_event_date_size' ]) ? $options[ 'cff_event_date_size' ] : '',
        'eventdateweight' => isset($options[ 'cff_event_date_weight' ]) ? $options[ 'cff_event_date_weight' ] : '',
        'eventdatecolor' => isset($options[ 'cff_event_date_color' ]) ? $options[ 'cff_event_date_color' ] : '',
        'eventdatepos' => isset($options[ 'cff_event_date_position' ]) ? $options[ 'cff_event_date_position' ] : '',
        'eventdateformat' => isset($options[ 'cff_event_date_formatting' ]) ? $options[ 'cff_event_date_formatting' ] : '',
        'eventdatecustom' => isset($options[ 'cff_event_date_custom' ]) ? $options[ 'cff_event_date_custom' ] : '',
        //Event details
        'eventdetailssize' => isset($options[ 'cff_event_details_size' ]) ? $options[ 'cff_event_details_size' ] : '',
        'eventdetailsweight' => isset($options[ 'cff_event_details_weight' ]) ? $options[ 'cff_event_details_weight' ] : '',
        'eventdetailscolor' => isset($options[ 'cff_event_details_color' ]) ? $options[ 'cff_event_details_color' ] : '',
        'eventlinkcolor' => isset($options[ 'cff_event_link_color' ]) ? $options[ 'cff_event_link_color' ] : '',        

        //Date
        'datepos' => isset($options[ 'cff_date_position' ]) ? $options[ 'cff_date_position' ] : '',
        'datesize' => isset($options[ 'cff_date_size' ]) ? $options[ 'cff_date_size' ] : '',
        'dateweight' => isset($options[ 'cff_date_weight' ]) ? $options[ 'cff_date_weight' ] : '',
        'datecolor' => isset($options[ 'cff_date_color' ]) ? $options[ 'cff_date_color' ] : '',
        'dateformat' => isset($options[ 'cff_date_formatting' ]) ? $options[ 'cff_date_formatting' ] : '',
        'datecustom' => isset($options[ 'cff_date_custom' ]) ? $options[ 'cff_date_custom' ] : '',
        'timezone' => isset($options[ 'cff_timezone' ]) ? $options[ 'cff_timezone' ] : 'America/Chicago',
        'beforedate' => isset($options[ 'cff_date_before' ]) ? $options[ 'cff_date_before' ] : '',
        'afterdate' => isset($options[ 'cff_date_after' ]) ? $options[ 'cff_date_after' ] : '',

        //Link to Facebook
        'linksize' => isset($options[ 'cff_link_size' ]) ? $options[ 'cff_link_size' ] : '',
        'linkweight' => isset($options[ 'cff_link_weight' ]) ? $options[ 'cff_link_weight' ] : '',
        'linkcolor' => isset($options[ 'cff_link_color' ]) ? $options[ 'cff_link_color' ] : '',
        'viewlinktext' => isset($options[ 'cff_view_link_text' ]) ? $options[ 'cff_view_link_text' ] : '',
        'linktotimeline' => isset($options[ 'cff_link_to_timeline' ]) ? $options[ 'cff_link_to_timeline' ] : '',

        //Load more button
        'buttoncolor' => isset($options[ 'cff_load_more_bg' ]) ? $options[ 'cff_load_more_bg' ] : '',
        'buttonhovercolor' => isset($options[ 'cff_load_more_bg_hover' ]) ? $options[ 'cff_load_more_bg_hover' ] : '',
        'buttontextcolor' => isset($options[ 'cff_load_more_text_color' ]) ? $options[ 'cff_load_more_text_color' ] : '',
        'buttontext' => isset($options[ 'cff_load_more_text' ]) ? $options[ 'cff_load_more_text' ] : '',
        'nomoretext' => isset($options[ 'cff_no_more_posts_text' ]) ? $options[ 'cff_no_more_posts_text' ] : '',

        //Social
        'iconstyle' => isset($options[ 'cff_icon_style' ]) ? $options[ 'cff_icon_style' ] : '',
        'socialtextcolor' => isset($options[ 'cff_meta_text_color' ]) ? $options[ 'cff_meta_text_color' ] : '',
        'socialbgcolor' => isset($options[ 'cff_meta_bg_color' ]) ? $options[ 'cff_meta_bg_color' ] : '',
        'sociallinkcolor' => isset($options[ 'cff_meta_link_color' ]) ? $options[ 'cff_meta_link_color' ] : '',
        'expandcomments' => isset($options[ 'cff_expand_comments' ]) ? $options[ 'cff_expand_comments' ] : '',
        'commentsnum' => isset($options[ 'cff_comments_num' ]) ? $options[ 'cff_comments_num' ] : '',
        'hidecommentimages' => isset($options[ 'cff_hide_comment_avatars' ]) ? $options[ 'cff_hide_comment_avatars' ] : '',

        //Misc
        'textlength' => get_option('cff_title_length'),
        'desclength' => get_option('cff_body_length'),
        'likeboxpos' => isset($options[ 'cff_like_box_position' ]) ? $options[ 'cff_like_box_position' ] : '',
        'likeboxoutside' => isset($options[ 'cff_like_box_outside' ]) ? $options[ 'cff_like_box_outside' ] : '',
        'likeboxcolor' => isset($options[ 'cff_likebox_bg_color' ]) ? $options[ 'cff_likebox_bg_color' ] : '',
        'likeboxtextcolor' => isset($options[ 'cff_like_box_text_color' ]) ? $options[ 'cff_like_box_text_color' ] : '',
        'likeboxwidth' => isset($options[ 'cff_likebox_width' ]) ? $options[ 'cff_likebox_width' ] : '',
        'likeboxfaces' => isset($options[ 'cff_like_box_faces' ]) ? $options[ 'cff_like_box_faces' ] : '',
        'likeboxborder' => isset($options[ 'cff_like_box_border' ]) ? $options[ 'cff_like_box_border' ] : '',
        'likeboxcover' => isset($options[ 'cff_like_box_cover' ]) ? $options[ 'cff_like_box_cover' ] : '',
        'likeboxsmallheader' => isset($options[ 'cff_like_box_small_header' ]) ? $options[ 'cff_like_box_small_header' ] : '',
        'likeboxhidebtn' => isset($options[ 'cff_like_box_hide_cta' ]) ? $options[ 'cff_like_box_hide_cta' ] : '',

        'credit' => isset($options[ 'cff_show_credit' ]) ? $options[ 'cff_show_credit' ] : '',
        'textissue' => isset($options[ 'cff_format_issue' ]) ? $options[ 'cff_format_issue' ] : '',
        'disablesvgs' => isset($options[ 'cff_disable_svgs' ]) ? $options[ 'cff_disable_svgs' ] : '',
        'restrictedpage' => isset($options[ 'cff_restricted_page' ]) ? $options[ 'cff_restricted_page' ] : '',
        'nofollow' => 'true',
        'timelinepag' => isset($options[ 'cff_timeline_pag' ]) ? $options[ 'cff_timeline_pag' ] : '',
        'gridpag' => isset($options[ 'cff_grid_pag' ]) ? $options[ 'cff_grid_pag' ] : '',


        //Page Header
        'showheader' => isset($options[ 'cff_show_header' ]) ? $options[ 'cff_show_header' ] : '',
        'headeroutside' => isset($options[ 'cff_header_outside' ]) ? $options[ 'cff_header_outside' ] : '',
        'headertext' => isset($options[ 'cff_header_text' ]) ? $options[ 'cff_header_text' ] : '',
        'headerbg' => isset($options[ 'cff_header_bg_color' ]) ? $options[ 'cff_header_bg_color' ] : '',
        'headerpadding' => isset($options[ 'cff_header_padding' ]) ? $options[ 'cff_header_padding' ] : '',
        'headertextsize' => isset($options[ 'cff_header_text_size' ]) ? $options[ 'cff_header_text_size' ] : '',
        'headertextweight' => isset($options[ 'cff_header_text_weight' ]) ? $options[ 'cff_header_text_weight' ] : '',
        'headertextcolor' => isset($options[ 'cff_header_text_color' ]) ? $options[ 'cff_header_text_color' ] : '',
        'headericon' => isset($options[ 'cff_header_icon' ]) ? $options[ 'cff_header_icon' ] : '',
        'headericoncolor' => isset($options[ 'cff_header_icon_color' ]) ? $options[ 'cff_header_icon_color' ] : '',
        'headericonsize' => isset($options[ 'cff_header_icon_size' ]) ? $options[ 'cff_header_icon_size' ] : '',

        //Load More button
        'loadmore' => get_option('cff_load_more'),

        //Misc
        'fulllinkimages' => isset($options[ 'cff_full_link_images' ]) ? $options[ 'cff_full_link_images' ] : '',
        'postimagesize' => isset($options[ 'cff_image_size' ]) ? $options[ 'cff_image_size' ] : '',
        'videoheight' => isset($options[ 'cff_video_height' ]) ? $options[ 'cff_video_height' ] : '',
        'videoaction' => isset($options[ 'cff_video_action' ]) ? $options[ 'cff_video_action' ] : '',
        'videoplayer' => isset($options[ 'cff_video_player' ]) ? $options[ 'cff_video_player' ] : '',
        'sepcolor' => isset($options[ 'cff_sep_color' ]) ? $options[ 'cff_sep_color' ] : '',
        'sepsize' => isset($options[ 'cff_sep_size' ]) ? $options[ 'cff_sep_size' ] : '',

        //Translate
        'seemoretext' => isset( $options[ 'cff_see_more_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_see_more_text' ] ) ) : '',
        'seelesstext' => isset( $options[ 'cff_see_less_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_see_less_text' ] ) ) : '',
        'photostext' => isset( $options[ 'cff_translate_photos_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_photos_text' ] ) ) : '',
        'facebooklinktext' => isset( $options[ 'cff_facebook_link_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_facebook_link_text' ] ) ) : '',
        'sharelinktext' => isset( $options[ 'cff_facebook_share_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_facebook_share_text' ] ) ) : '',
        'showfacebooklink' => isset($options[ 'cff_show_facebook_link' ]) ? $options[ 'cff_show_facebook_link' ] : '',
        'showsharelink' => isset($options[ 'cff_show_facebook_share' ]) ? $options[ 'cff_show_facebook_share' ] : '',
        'buyticketstext' => isset($options[ 'cff_buy_tickets_text' ]) ? $options[ 'cff_buy_tickets_text' ] : '',

        'maptext' => isset( $options[ 'cff_map_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_map_text' ] ) ) : '',
        'interestedtext' => isset( $options[ 'cff_interested_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_interested_text' ] ) ) : '',
        'goingtext' => isset( $options[ 'cff_going_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_going_text' ] ) ) : '',

        'previouscommentstext' => isset( $options[ 'cff_translate_view_previous_comments_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_view_previous_comments_text' ] ) ) : '',
        'commentonfacebooktext' => isset( $options[ 'cff_translate_comment_on_facebook_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_comment_on_facebook_text' ] ) ) : '',
        'likesthistext' => isset( $options[ 'cff_translate_likes_this_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_likes_this_text' ] ) ) : '',
        'likethistext' => isset( $options[ 'cff_translate_like_this_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_like_this_text' ] ) ) : '',
        'reactedtothistext' => isset( $options[ 'cff_translate_reacted_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_reacted_text' ] ) ) : '',
        'andtext' => isset( $options[ 'cff_translate_and_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_and_text' ] ) ) : '',
        'othertext' => isset( $options[ 'cff_translate_other_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_other_text' ] ) ) : '',
        'otherstext' => isset( $options[ 'cff_translate_others_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_others_text' ] ) ) : '',
        'noeventstext' => isset( $options[ 'cff_no_events_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_no_events_text' ] ) ) : '',
        'replytext' => isset( $options[ 'cff_translate_reply_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_reply_text' ] ) ) : '',
        'repliestext' => isset( $options[ 'cff_translate_replies_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_replies_text' ] ) ) : '',

        'learnmoretext' => isset( $options[ 'cff_translate_learn_more_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_learn_more_text' ] ) ) : '',
        'shopnowtext' => isset( $options[ 'cff_translate_shop_now_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_shop_now_text' ] ) ) : '',
        'messagepage' => isset( $options[ 'cff_translate_message_page_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_message_page_text' ] ) ) : '',
        'getdirections' => isset( $options[ 'cff_translate_get_directions_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_get_directions_text' ] ) ) : '',

        'secondtext' => isset( $options[ 'cff_translate_second' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_second' ] ) ) : 'second',
        'secondstext' => isset( $options[ 'cff_translate_seconds' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_seconds' ] ) ) : 'seconds',
        'minutetext' => isset( $options[ 'cff_translate_minute' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_minute' ] ) ) : 'minute',
        'minutestext' => isset( $options[ 'cff_translate_minutes' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_minutes' ] ) ) : 'minutes',
        'hourtext' => isset( $options[ 'cff_translate_hour' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_hour' ] ) ) : 'hour',
        'hourstext' => isset( $options[ 'cff_translate_hours' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_hours' ] ) ) : 'hours',
        'daytext' => isset( $options[ 'cff_translate_day' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_day' ] ) ) : 'day',
        'daystext' => isset( $options[ 'cff_translate_days' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_days' ] ) ) : 'days',
        'weektext' => isset( $options[ 'cff_translate_week' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_week' ] ) ) : 'week',
        'weekstext' => isset( $options[ 'cff_translate_weeks' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_weeks' ] ) ) : 'weeks',
        'monthtext' => isset( $options[ 'cff_translate_month' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_month' ] ) ) : 'month',
        'monthstext' => isset( $options[ 'cff_translate_months' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_months' ] ) ) : 'months',
        'yeartext' => isset( $options[ 'cff_translate_year' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_year' ] ) ) : 'year',
        'yearstext' => isset( $options[ 'cff_translate_years' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_years' ] ) ) : 'years',
        'agotext' => isset( $options[ 'cff_translate_ago' ] ) ? stripslashes( esc_attr( $options[ 'cff_translate_ago' ] ) ) : 'ago',

        //Active extensions
        'multifeedactive' => $cff_ext_multifeed_active,
        'daterangeactive' => $cff_ext_date_active,
        'featuredpostactive' => $cff_featured_post_active,
        'albumactive' => $cff_album_active,
        'masonryactive' => false, //Deprecated
        'carouselactive' => $cff_carousel_active,
        'reviewsactive' => $cff_reviews_active,

        //Extension settings
        'from' => get_option( 'cff_date_from' ),
        'until' => get_option( 'cff_date_until' ),
        'featuredpost' => get_option( 'cff_featured_post_id' ),
        'album' => '',
        'lightbox' => get_option('cff_lightbox'),
        //Reviews
        'reviewsrated' => $cff_reviews_string,
        'starsize' => isset($options[ 'cff_star_size' ]) ? $options[ 'cff_star_size' ] : '',
        'hidenegative' => isset( $options[ 'cff_reviews_hide_negative' ] ) ? stripslashes( esc_attr( $options[ 'cff_reviews_hide_negative' ] ) ) : '',
        'reviewslinktext' => isset( $options[ 'cff_reviews_link_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_reviews_link_text' ] ) ) : '',
        'reviewshidenotext' => isset( $options[ 'cff_reviews_no_text' ] ) ? stripslashes( esc_attr( $options[ 'cff_reviews_no_text' ] ) ) : '',
        'reviewsmethod' => isset( $options[ 'cff_reviews_method' ] ) ? stripslashes( esc_attr( $options[ 'cff_reviews_method' ] ) ) : ''

    ), $feed_options, 'custom_facebook_feed' );


	//If multiple Access Tokens are being used then split them up into an associative array
	$access_token = $feed_options['accesstoken'];
    if ( $cff_ext_multifeed_active && strpos($access_token, ':') !== false ) {

    	//Define the array
    	$access_token_multiple = array();

    	function splitToken($at_piece, $access_token_multiple){
	    	$access_token_split = explode(":", $at_piece);
	    	$token_only = trim($access_token_split[1]);

	    	if (strpos($token_only, '02Sb981f26534g75h091287a46p5l63') !== false) {
		        $token_only = str_replace("02Sb981f26534g75h091287a46p5l63","",$token_only);
		    }

	    	$access_token_multiple[ trim($access_token_split[0]) ] = $token_only;
	    	return $access_token_multiple;
	    }

    	//If there are multiple tokens then split them up
    	if( strpos($access_token, ',') !== false ){
    		$access_token_pieces = explode(",", $access_token);
	    	foreach ( $access_token_pieces as $at_piece ) {
		    	$access_token_multiple = splitToken($at_piece, $access_token_multiple);
		    }
    	} else {
    	//Otherwise just create a 1 item array
    		$access_token_multiple = splitToken($access_token);
    	}
    	//Save the token back into the settings array
	    $feed_options['accesstoken'] = $access_token_multiple;

    } else {
    	//Replace the encryption string in the Access Token
	    if (strpos($feed_options['accesstoken'], '02Sb981f26534g75h091287a46p5l63') !== false) {
	        $feed_options['accesstoken'] = str_replace("02Sb981f26534g75h091287a46p5l63","",$feed_options['accesstoken']);
	    }
    }


    //Fix the Page ID if they use the full URL
    //If user pastes their full URL into the Page ID field then strip it out
    $page_id = $feed_options['id'];
    $cff_facebook_string = 'facebook.com';
    ( stripos($page_id, $cff_facebook_string) !== false) ? $cff_page_id_url_check = true : $cff_page_id_url_check = false;
    if ( $cff_page_id_url_check === true ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }
    //If the Page ID contains a query string at the end then remove it
    if ( stripos( $page_id, '?') !== false ) $page_id = substr($page_id, 0, strrpos($page_id, '?'));

    //Always remove slash from end of Page ID
    $page_id = preg_replace('{/$}', '', $page_id);

    //Update the page ID in the feed options array for use everywhere
    $feed_options['id'] = $page_id;


    //If it's a date range feed then disable the pastevents setting as it causes an issue
    if( !empty($feed_options['from']) || !empty($feed_options['until']) ){
        $feed_options['pastevents'] = 'false';
    }

    //If the reviews api method is set to be 'auto' then change it based on whether the user is filtering the posts
    $cff_reviews_no_text = $feed_options[ 'reviewshidenotext' ];
    ( $cff_reviews_no_text == 'on' || $cff_reviews_no_text == 'true' || $cff_reviews_no_text == true ) ? $cff_reviews_no_text = true : $cff_reviews_no_text = false;
    if( $feed_options[ 'reviewshidenotext' ] == 'false' ) $cff_reviews_no_text = false;

    if( $feed_options['reviewsmethod'] == 'auto' && ( $cff_reviews_no_text || substr_count($feed_options[ 'reviewsrated' ], ',') < 4 ) ) $feed_options['reviewsmethod'] = 'all';

    return $feed_options;
}

// this where you could take the feed options to get the feed data for the first set
// of posts or, if the $before and $after parameters are set, get the next set of posts
function cff_get_json_data( $feed_options, $next_urls_arr_safe = null, $data_att_html ) {

    //Define vars
    $access_token = $feed_options['accesstoken'];
    //If the 'Enter my own Access Token' box is unchecked then don't use the user's access token, even if there's one in the field
    $feed_options['ownaccesstoken'] ? $cff_show_access_token = true : $cff_show_access_token = true;
    //Reviews Access Token
    $page_access_token = $feed_options['pagetoken'];
    $cff_show_access_token = true;
    $page_id = trim( $feed_options['id'] );
    $show_posts = $feed_options['num'];
    $cff_post_limit = $feed_options['limit'];
    $cff_page_type = $feed_options[ 'pagetype' ];
    $show_others = $feed_options['others'];
    $show_posts_by = $feed_options['showpostsby'];
    $cff_caching_type = $feed_options['cachetype'];
    $cff_cache_time = $feed_options['cachetime'];
    $cff_cache_time_unit = $feed_options['cacheunit'];
    $cff_locale = $feed_options['locale'];
    //Post types
    $cff_types = $feed_options['type'];
    $cff_events_source = $feed_options[ 'eventsource' ];
    $cff_event_offset = $feed_options[ 'eventoffset' ];
    $cff_albums_source = $feed_options[ 'albumsource' ];
    $cff_photos_source = $feed_options[ 'photosource' ];
    $cff_videos_source = $feed_options[ 'videosource' ];
    //Past events
    $cff_past_events = $feed_options['pastevents'];
    //Active extensions
    $cff_ext_multifeed_active = $feed_options[ 'multifeedactive' ];
    $cff_ext_date_active = $feed_options[ 'daterangeactive' ];
    $cff_featured_post_active = $feed_options[ 'featuredpostactive' ];
    $cff_album_active = $feed_options[ 'albumactive' ];
    $cff_masonry_columns_active = false; //Deprecated
    $cff_carousel_active = $feed_options[ 'carouselactive' ];
    $cff_reviews_active = $feed_options[ 'reviewsactive' ];
    //Extension settings
    $cff_album_id = $feed_options['album'];
    $cff_featured_post_id = $feed_options['featuredpost'];

    //Get show posts attribute. If not set then default to 25
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;

    //Set the page type
    $cff_is_group = false;
    if ($cff_page_type == 'group') $cff_is_group = true;

    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    $cff_show_albums_type = false;
    $cff_reviews = false;
    if ( stripos($cff_types, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_types, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_types, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_types, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_types, 'album') !== false ) $cff_show_albums_type = true;
    if ( stripos($cff_types, 'status') !== false ) $cff_show_status_type = true;
    if ( stripos($cff_types, 'review') !== false && $cff_reviews_active ) $cff_reviews = true;

    //Events only
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';
    if ( empty($cff_event_offset) || !isset($cff_event_offset) ) $cff_event_offset = '6';
    ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_albums_type) ? $cff_events_only = true : $cff_events_only = false;

    //Albums only
    ($cff_show_albums_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) ? $cff_albums_only = true : $cff_albums_only = false;

    //Photos only
    ( ($cff_show_photos_type && $cff_photos_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_event_type && !$cff_show_status_type && !$cff_show_albums_type) ? $cff_photos_only = true : $cff_photos_only = false;
    if( $cff_featured_post_active && !empty($cff_featured_post_id) ) $cff_photos_only = false;

    //Videos only
    ( ($cff_show_video_type && $cff_videos_source == 'videospage') && !$cff_show_albums_type && !$cff_show_links_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) ? $cff_videos_only = true : $cff_videos_only = false;
    if( $cff_featured_post_active && !empty($cff_featured_post_id) ) $cff_videos_only = false;

    //Is it SSL?
    $cff_ssl = '';
    if (is_ssl()) $cff_ssl = '&return_ssl_resources=true';

    //Use posts? or feed?
    $graph_query = 'posts';
    $cff_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if ($show_others) {
        //Show posts by everyone
        if ( $show_others == 'on' || $show_others == 'true' || $show_others == true || $cff_is_group ) $graph_query = 'feed';
        //Only show posts by me
        if ( $show_others == 'false' ) $graph_query = 'posts';
    } else {
    //Else use the settings page option or the 'showpostsby' shortcode option
        //Only show posts by me
        if ( $show_posts_by == 'me' ) $graph_query = 'posts';
        //Show posts by everyone
        if ( $show_posts_by == 'others' || $cff_is_group ) $graph_query = 'feed';
        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$cff_is_group ) {
            $graph_query = 'visitor_posts';
            $cff_show_only_others = true;
        }
    }

    //Calculate the cache time in seconds
    if($cff_cache_time_unit == 'minutes') $cff_cache_time_unit = 60;
    if($cff_cache_time_unit == 'hour' || $cff_cache_time_unit == 'hours') $cff_cache_time_unit = 60*60;
    if($cff_cache_time_unit == 'days') $cff_cache_time_unit = 60*60*24;
    $cache_seconds = $cff_cache_time * $cff_cache_time_unit;


    //********************************************//
    //*****************GET POSTS******************//
    //********************************************//

    $FBdata_arr = array(); //Use an array to store the data for each page ID (for multifeed)

    //Multifeed extension
    ( $cff_ext_multifeed_active ) ? $page_ids = cff_multifeed_ids($page_id) : $page_ids = array($page_id);

    //If it's an album embed then only use one ID otherwise it loops through and embeds the same album items multiple times
    if( !empty($cff_album_id) ) $page_ids = array($page_ids[0]);

    //If the limit isn't set then set it to be 7 more than the number of posts defined
    if ( isset($cff_post_limit) && $cff_post_limit !== '' ) {
        $cff_post_limit = $cff_post_limit;
    } else {
        if( intval($show_posts) >= 50 ) $cff_post_limit = intval(intval($show_posts) + 7);
        if( intval($show_posts) < 50 ) $cff_post_limit = intval(intval($show_posts) + 5);
        if( intval($show_posts) < 25  ) $cff_post_limit = intval(intval($show_posts) + 4);
        if( intval($show_posts) < 10  ) $cff_post_limit = intval(intval($show_posts) + 3);
        if( intval($show_posts) < 6  ) $cff_post_limit = intval(intval($show_posts) + 2);
        if( intval($show_posts) < 2  ) $cff_post_limit = intval(intval($show_posts) + 1);

        //If using multifeed then set the limit dynamically based on the number of pages if it isn't set
        if( $cff_ext_multifeed_active && count($page_ids) > 1 ){
            $cff_post_limit = ( ceil(intval($show_posts) / count($page_ids)) ) + 1;
        }
    }
    if( $cff_post_limit >= 100 ) $cff_post_limit = 100;

    //If the number of posts is set to zero then don't show any and set limit to one
    if ( ($show_posts == '0' || $show_posts == 0) && $show_posts !== ''){
        $show_posts = 0;
        $cff_post_limit = 1;
    }

    //If the timeline pagination method is set to use the API paging method then set the limit to be the number of posts displayed so that posts aren't skipped when loading more
    if( $feed_options['timelinepag'] == 'paging' ) $cff_post_limit = $show_posts;

    //If multiple Access Tokens are being used then split them up into an associative array
    $cff_multiple_tokens = false;
    if ( $cff_ext_multifeed_active && is_array($access_token) ){
    	$cff_multiple_tokens = true;
    	$access_token_multiple = $access_token;
    }
    
    //Loop through page IDs
    foreach ( $page_ids as $page_id ) {

    	if( $cff_multiple_tokens ) $access_token = $access_token_multiple[$page_id];

        //********************************************//
        //********CREATE THE API REQUEST URL**********//
        //********************************************//

        //These need to go here so that they're in the correct format for each ID looped through in multifeed. Otherwise they get converted to unix below and don't work for the second ID.
        $cff_date_from = $feed_options['from'];
        $cff_date_until = $feed_options['until'];

        //EVENTS ONLY
        if ($cff_events_only && $cff_events_source == 'eventspage'){

            //Can be used to display group events passed their start time. Default is 6 hours.
            $cff_event_offset_time = '-' . $cff_event_offset . ' hours';
            $curtimeplus = strtotime($cff_event_offset_time, time());

            //Start time string
            $cff_start_time_string = '';
            $cff_get_upcoming_events = "&time_filter=upcoming";

            //Date range extension
            if ( $cff_ext_date_active && ( !empty($cff_date_from) || !empty($cff_date_until) ) ) {

                ( !empty($cff_date_from) ) ? $cff_date_from = strtotime($cff_date_from) : $cff_date_from = $curtimeplus;
                ( !empty($cff_date_until) ) ? $cff_date_until = strtotime($cff_date_until) : $cff_date_until = $curtimeplus;

                $cff_start_time_string = cff_ext_date($cff_date_from, $cff_date_until);
                //If it's a date range then don't just query upcoming events, query all of them
                $cff_get_upcoming_events = '';

            }

            //Events URL
            $cff_events_json_url = "https://graph.facebook.com/v3.2/".$page_id."/events/?fields=id,name,attending_count,cover,start_time,end_time,event_times,timezone,place,description,ticket_uri,interested_count".$cff_start_time_string.$cff_get_upcoming_events."&limit=200&access_token=" . $access_token . "&format=json-strings" . $cff_ssl;

            //Past events
            ( $cff_past_events !== 'false' && $cff_past_events != false ) ? $cff_past_events = true : $cff_past_events = false;

            //If the limit isn't set then set it to be the number of posts defined
            if ( isset($feed_options['limit']) && $feed_options['limit'] !== '' ) {
                $cff_post_limit = $cff_post_limit;
            } else {
                $cff_post_limit = intval($show_posts);
            }
            if( $cff_post_limit >= 100 ) $cff_post_limit = 100;

            //Get past events. Limit must be set high to get all past events and be able to show the newest ones first
            if($cff_past_events) $cff_events_json_url = 'https://graph.facebook.com/v3.2/'.$page_id.'/events?fields=name,id,attending_count,description,start_time,end_time,timezone,place,ticket_uri,cover,interested_count&limit='.$cff_post_limit.'&time_filter=past&access_token='.$access_token;

            //Group events
            if($cff_is_group && !$cff_past_events) $cff_events_json_url = 'https://graph.facebook.com/v3.2/' . $page_id . '/events?fields=name,id,description,start_time,end_time,event_times,timezone,ticket_uri,place,cover,attending_count,interested_count&limit=200&since='.$curtimeplus.'&access_token=' . $access_token;

            //Featured Post extension
            if( $cff_featured_post_active && !empty($cff_featured_post_id) ) $cff_events_json_url = cff_featured_event_id( trim( $cff_featured_post_id ), $access_token );

            //Assign it here so that it's returned at the end of the function
            $cff_posts_json_url = $cff_events_json_url;

        } //END EVENTS ONLY

        //ALL POSTS
        if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

            //Create date range using the Date Range extension
            ( $cff_ext_date_active ) ? $cff_date_range = cff_ext_date(strtotime( $cff_date_from ), strtotime( $cff_date_until )) : $cff_date_range = '';

            $cff_posts_json_url = 'https://graph.facebook.com/v3.3/' . $page_id . '/' . $graph_query . '?fields=id,from{picture,id,name,link},message,message_tags,story,story_tags,picture,full_picture,status_type,created_time,backdated_time,attachments{title,description,media_type,unshimmed_url,target{id},multi_share_end_card,media{source,image},subattachments},shares,comments.summary(true){message,created_time},likes.summary(true).limit(0),call_to_action&access_token=' . $access_token . '&limit=' . $cff_post_limit . '&locale=' . $cff_locale . $cff_ssl . $cff_date_range;

            //If the feed is not a timeline feed then set the post limit to be the same as the number of posts being shown as we don't need a buffer
            if ( $cff_reviews || $cff_videos_only || $cff_photos_only || ($cff_albums_only && $cff_albums_source == 'photospage') || $cff_featured_post_active && !empty($cff_featured_post_id) || $cff_album_active && !empty($cff_album_id) ){

                //If the limit isn't set then set it to be the number of posts defined
                if ( isset($feed_options['limit']) && $feed_options['limit'] !== '' ) {
                    $cff_post_limit = $cff_post_limit;
                } else {
                    $cff_post_limit = intval($show_posts);
                }
                if( $cff_post_limit >= 100 ) $cff_post_limit = 100;

                //If it's a grid feed with the pag method set to be cursor then force the limit to be the same as the number of posts
                if( $feed_options['gridpag'] == 'cursor') $cff_post_limit = $show_posts;
            }

            //REVIEWS
            if ( $cff_reviews ){
                ( $feed_options['reviewsmethod'] == 'all' ) ? $show_all_reviews = true : $show_all_reviews = false;
                if( $show_all_reviews == true ) $cff_post_limit = '300';
                $cff_posts_json_url = cff_reviews_url( $page_id, $page_access_token, $cff_post_limit, $cff_locale, $cff_date_range );
            }


            $cff_video_playlist = $feed_options['playlist'];
            $videos_id = $page_id;
            if( $cff_video_playlist == true ) $videos_id = $cff_video_playlist;

            //VIDEOS ONLY
            if($cff_videos_only){
                $cff_posts_json_url = 'https://graph.facebook.com/v3.2/'.$videos_id.'/videos/?access_token='.$access_token.'&fields=source,created_time,title,description,embed_html,format{picture}&locale='.$cff_locale . $cff_date_range . '&limit=' . $cff_post_limit;
            }

            //PHOTOS ONLY
            if($cff_photos_only){
                //Photo only feeds only work for pages since Facebook deprecated FQL
                $cff_posts_json_url = 'https://graph.facebook.com/'.$page_id.'/photos?type=uploaded&fields=id,created_time,link,picture,images{width,source},name&limit='.$cff_post_limit.'&access_token='.$access_token.$cff_date_range;
            }

            //ALBUMS ONLY
            if($cff_albums_only && $cff_albums_source == 'photospage'){
                $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/albums?fields=id,name,description,link,cover_photo{source,id},count,created_time,updated_time&access_token=' . $access_token . '&limit=' . $cff_post_limit. '&locale=' . $cff_locale . $cff_date_range;

                if($cff_is_group) $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/albums?fields=created_time,name,count,cover_photo,link,modified,id&access_token=' . $access_token . '&limit=' . $cff_post_limit. '&locale=' . $cff_locale . $cff_date_range;
            }

            //Featured Post extension
            if ( $cff_featured_post_active && !empty($cff_featured_post_id) ) $cff_posts_json_url = cff_featured_post_id( trim( $cff_featured_post_id ), $access_token );

            //ALBUM EMBED
            if( $cff_album_active && !empty($cff_album_id) ) {
                //Get the JSON back from the Album extension
                $cff_posts_json_url = cff_album_id( trim( $cff_album_id ), $access_token, $cff_post_limit, $cff_date_range );
            }

        } //END ALL POSTS


        //********************************************//
        //*********CREATE THE TRANSIENT NAME**********//
        //********************************************//
            
        //EVENTS ONLY
        if ($cff_events_only && $cff_events_source == 'eventspage'){

            $events_trans_items_arr = array(
                'page_id' => $page_id,
                'post_limit' => substr($cff_post_limit, 0, 3),
                'page_type' => $cff_page_type
            );

            $trans_arr_item_count = 1;
            // $cff_ext_date_active = true;
            if($cff_ext_date_active){
                $events_trans_items_arr['from'] = $cff_date_from;
                $events_trans_items_arr['until'] = $cff_date_until;
                // $events_trans_items_arr['from'] = '1234567890';
                // $events_trans_items_arr['until'] = '0987654321';
                $trans_arr_item_count = $trans_arr_item_count+2;
            }
            if( $cff_featured_post_active && !empty($cff_featured_post_id) ){
                $events_trans_items_arr['featured_post'] = $cff_featured_post_id;
                $trans_arr_item_count++;
            }
            if($cff_past_events) $events_trans_items_arr['past_events'] = $cff_past_events;

            $arr_item_max_length = floor( 32/$trans_arr_item_count ); //Max length of 45 accounting for the 'cff_ej_' prefix and other options below
            $arr_item_max_length_half = floor($arr_item_max_length/2);

            $transient_name = 'cff_ej_';
            foreach ($events_trans_items_arr as $key => $value) {
                if($value !== false){
                    if( $key == 'page_id' || $key == 'featured_post' || $key == 'from' || $key == 'until' ){
                    $transient_name .= substr($value, 0, $arr_item_max_length_half) . substr($value, $arr_item_max_length_half*-1);  //-10
                }
                    if( $key == 'post_limit' ) $transient_name .= substr($value, 0, 3);
                    if( $key == 'page_type' || $key == 'past_events' ) $transient_name .= substr($value, 0, 1);
                }
            }
            //Make sure it's not more than 45 chars
            $transient_name = substr($transient_name, 0, 45);

        } //END EVENTS ONLY

        //ALL POSTS
        if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

            //If it's a playlist then use the playlist ID instead of the Page ID
            $page_id_caching = $page_id;
            if( $feed_options['playlist'] ){
                $page_id_caching = $feed_options['playlist'];
            }

            $trans_items_arr = array(
                'page_id' => $page_id_caching,
                'post_limit' => substr($cff_post_limit, 0, 3),
                'show_posts_by' => substr($show_posts_by, 0, 2),
                'locale' => $cff_locale
            );

            $trans_arr_item_count = 1;
            if($cff_ext_date_active){
                $trans_items_arr['from'] = $cff_date_from;
                $trans_items_arr['until'] = $cff_date_until;
                $trans_arr_item_count = $trans_arr_item_count+2;
            }
            if( $cff_featured_post_active && !empty($cff_featured_post_id) ){
                $trans_items_arr['featured_post'] = $cff_featured_post_id;
                $trans_arr_item_count++;
            }
            if($cff_albums_only) $trans_items_arr['albums_source'] = $cff_albums_source;
            $trans_items_arr['albums_only'] = intval($cff_albums_only);
            $trans_items_arr['photos_only'] = intval($cff_photos_only);
            $trans_items_arr['videos_only'] = intval($cff_videos_only);
            $trans_items_arr['reviews'] = intval($cff_reviews);

            $arr_item_max_length = floor( 28/$trans_arr_item_count ); //40 minus the 12 needed for the other 7 values shown below equals 28
            $arr_item_max_length_half = floor($arr_item_max_length/2);

            $transient_name = 'cff_';
            foreach ($trans_items_arr as $key => $value) {
                if($value !== false){
                    if( $key == 'page_id' || $key == 'featured_post' || $key == 'from' || $key == 'until' ) $transient_name .= substr($value, 0, $arr_item_max_length_half) . substr($value, $arr_item_max_length_half*-1);  //-10
                    if( $key == 'locale' ) $transient_name .= substr($value, 0, 2);
                    if( $key == 'post_limit' || $key == 'show_posts_by' ) $transient_name .= substr($value, 0, 3);
                    if( $key == 'albums_only' || $key == 'photos_only' || $key == 'videos_only' || $key == 'albums_source' || $key == 'reviews' ) $transient_name .= substr($value, 0, 1);
                }
            }
            //Make sure it's not more than 45 chars
            $transient_name = substr($transient_name, 0, 45);

            //ALBUM EMBED
            if( $cff_album_active && !empty($cff_album_id) ) {
                $transient_name = 'cff_album_' . $cff_album_id . '_' . $cff_post_limit;
                $transient_name = substr($transient_name, 0, 45);
            }

        } //END ALL POSTS



        //Are there more posts to get for this ID?
        $cff_more_posts = true;

        //If the cron caching is enabled then set the caching time to be long so that it doesn't expire before rechecked in the cron function
        if( $cff_caching_type == 'background' ) $cache_seconds = 7 * DAY_IN_SECONDS;

        //Get next set of posts
        if( !is_null( $next_urls_arr_safe ) ) {

            //Get the corresponding next URL from the array of next URLs by using the page_id
            if( !empty($next_urls_arr_safe) ){
                if( isset($next_urls_arr_safe[$page_id]) ){
                    $next_url_safe = $next_urls_arr_safe[$page_id];
                } else {
                    $next_url_safe = '';
                    $cff_more_posts = false;
                }
            } else {
                $next_url_safe = '';
            }

            //There are more posts to get for this ID
            if( $cff_more_posts ){

                //If it's a reviews feed then use the reviews token
                ( $cff_reviews ) ? $feed_token = $feed_options['pagetoken'] : $feed_token = $access_token;

                //Replace the Access Token placeholder with the actual token
                $cff_api_url = str_replace("x_cff_hide_token_x",$feed_token,$next_url_safe);

                //Get the "until" param from the URL to use in the transient name so that it's unique
                $url_bits = parse_url($cff_api_url, PHP_URL_QUERY);
                parse_str($url_bits, $url_bits_arr);

                //Use a unique string in the transient name so that it's saved in a separate unique transient
                if( isset($url_bits_arr['until']) ){
                    $cff_unique_string = $url_bits_arr['until'];
                } else if ( isset($url_bits_arr['after']) ) {
                    $cff_unique_string = $url_bits_arr['after'];
                } else if ( isset($url_bits_arr['offset']) ) {
                    $cff_unique_string = $url_bits_arr['offset']; //As this is used with multifeed photo-only feeds with pagination then it doesn't work too well as those feeds are shuffled and so the offset changes. It's still sometimes right, but not all the time as it's partially random.
                } else {
                    $cff_unique_string = '';
                }
                    
                //Check the cache and/or make an API request
                $posts_json = cff_get_set_cache($cff_api_url, $transient_name . '_' . $cff_unique_string, $cff_cache_time, $cache_seconds, $data_att_html, $cff_show_access_token, $access_token);

                $FBdata = json_decode($posts_json);
            }

        //Get first set of posts
        } else {

            //EVENTS ONLY
            if ($cff_events_only && $cff_events_source == 'eventspage'){

                $events_json = cff_get_set_cache($cff_events_json_url, $transient_name, $cff_cache_time, $cache_seconds, $data_att_html, $cff_show_access_token, $access_token);

                //Interpret data with JSON
                //Convert id integer to a string otherwise json_decode returns it as a float
                $events_json = preg_replace('/"id":(\d+)/', '"id":"$1"', $events_json);
                //If it's a Featured Post event then wrap it in a "data" object so that it's parsed the same way as regular events in the loop below
                if( $cff_featured_post_active && !empty($cff_featured_post_id) ) $events_json = '{"data": ['.$events_json.'] }';
                $FBdata = json_decode($events_json);

            } //End events URL formation

            //ALL POSTS
            if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

                $posts_json = cff_get_set_cache($cff_posts_json_url, $transient_name, $cff_cache_time, $cache_seconds, $data_att_html, $cff_show_access_token, $access_token);

                //ALBUM EMBED
                if( $cff_album_active && !empty($cff_album_id) ) $album_json = $posts_json;

                //Interpret data with JSON
                $FBdata = json_decode($posts_json);

                //ALBUM EMBED
                if( $cff_album_active && !empty($cff_album_id) ) $FBdata = json_decode($album_json);

            } // End ALL POSTS

        } // End get more posts


        if( $cff_more_posts ){
            //Add the data to the array to be returned and parsed into HTML
            $FBdata_arr[$page_id] = $FBdata;
        } else {
            //Add something to the array for the ID if there's no posts to prevent any PHP notices
            $FBdata_arr[$page_id] = 'no_more_posts';
        }

        //Add the API URL to the json array so that we can grab it and add to the button if needed
        if( isset($FBdata_arr[$page_id]) ){
            if( !isset($FBdata_arr[$page_id]->api_url) && $FBdata_arr[$page_id] != 'no_more_posts' ){
                //Replace the actual token with the Access Token placeholder
                $cff_api_url = str_replace($access_token,"x_cff_hide_token_x",$cff_posts_json_url);
                //Add it to the json array
                $FBdata_arr[$page_id]->api_url = $cff_api_url;
            }
        }

    } //End page_id loop
    
    //Return array of JSON data for each page ID
    return $FBdata_arr;
}

// this function breaks up the "next" url from the json data into an array of parts to load into
// the html to be retrieved on click and pieced back together
function cff_get_next_url_parts( $json_data_arr ) {

    $next_urls_arr_safe = '{';

    if ( !empty($json_data_arr) ) {

        //Loop through $json_data_arr and create a JSON string of the next URLs to return and use in the pag button    
        foreach ( $json_data_arr as $page_id => $json_data ) {

            if(isset($json_data->paging->next)){

                $next_url = $json_data->paging->next;

                //Hide the Access Tokens in the URLs
                $url_queries = parse_url($next_url, PHP_URL_QUERY);
                parse_str($url_queries, $output);

                //If the URL is encoded then encode the Access Token so that it matches when searching
                if (strpos($next_url, '%7C') !== false) {
                    $replace_token = urlencode( $output['access_token'] );
                } else {
                    $replace_token = $output['access_token'];
                }

                //Hide the token in the URL
                $safe_url = str_replace($replace_token,"x_cff_hide_token_x",$next_url);

                //Add it to the JSON string to be returned
                $next_urls_arr_safe .= '&quot;'.$page_id.'&quot;: &quot;'.$safe_url.'&quot;, ';
            }

        }

    }

    $next_urls_arr_safe .= '}';

    //If the array ends in a comma then remove the comma
    if( substr($next_urls_arr_safe, -3) == ', }' ) $next_urls_arr_safe = str_replace(", }", "}", $next_urls_arr_safe);

    return $next_urls_arr_safe;

}

// this function is where the json data from the Facebook API and the feed options
// come together to generate all of the html needed to output the feed on the page
function cff_get_post_set_html( $feed_options, $json_data_arr ) {

    //Active extensions
    $cff_ext_multifeed_active = $feed_options[ 'multifeedactive' ];
    $cff_ext_date_active = $feed_options[ 'daterangeactive' ];
    $cff_featured_post_active = $feed_options[ 'featuredpostactive' ];
    $cff_album_active = $feed_options[ 'albumactive' ];
    $cff_masonry_columns_active = false; //Deprecated
    $cff_carousel_active = $feed_options[ 'carouselactive' ];
    $cff_reviews_active = $feed_options[ 'reviewsactive' ];

    /********** GENERAL **********/
    $cff_page_type = $feed_options[ 'pagetype' ];
    $cff_is_group = false;
    if ($cff_page_type == 'group') $cff_is_group = true;

    $cff_show_author = $feed_options[ 'showauthornew' ];
    $cff_cache_time = $feed_options[ 'cachetime' ];
    $cff_locale = $feed_options[ 'locale' ];
    if ( empty($cff_locale) || !isset($cff_locale) || $cff_locale == '' ) $cff_locale = 'en_US';

    $cff_cache_time_unit = $feed_options[ 'cacheunit' ];

    //Don't allow cache time to be zero - set to 1 minute instead to minimize API requests
    if(!isset($cff_cache_time) || $cff_cache_time == '0' || (intval($cff_cache_time) < 15 && $cff_cache_time_unit == 'minutes' ) ){
        $cff_cache_time = 15;
        $cff_cache_time_unit = 'minutes';
    }
    if($cff_cache_time == 'nocaching') $cff_cache_time = 0;

    
    //Open links in new window?
    $target = 'target="_blank"';
    /********** POST TYPES **********/
    $cff_types = $feed_options[ 'type' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    $cff_show_albums_type = false;
    $cff_reviews = false;
    if ( stripos($cff_types, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_types, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_types, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_types, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_types, 'album') !== false ) $cff_show_albums_type = true;
    if ( stripos($cff_types, 'status') !== false ) $cff_show_status_type = true;
    if ( stripos($cff_types, 'review') !== false && $cff_reviews_active ) $cff_reviews = true;

    //Only events
    $cff_events_source = $feed_options[ 'eventsource' ];
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';

    $cff_event_offset = $feed_options[ 'eventoffset' ];
    if ( empty($cff_event_offset) || !isset($cff_event_offset) ) $cff_event_offset = '6';

    $cff_events_only = false;
    if ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_albums_type) $cff_events_only = true;

    //Past events
    ( $feed_options['pastevents'] !== 'false' ) ? $cff_past_events = true : $cff_past_events = false;
    
    //ALBUMS ONLY
    $cff_albums_source = $feed_options[ 'albumsource' ];
    $cff_show_album_title = $feed_options[ 'showalbumtitle' ];
    ( $cff_show_album_title == 'on' || $cff_show_album_title == 'true' || $cff_show_album_title == true ) ? $cff_show_album_title = true : $cff_show_album_title = false;
    if( $feed_options[ 'showalbumtitle' ] == 'false' ) $cff_show_album_title = false;

    $cff_show_album_number = $feed_options[ 'showalbumnum' ];
    ( $cff_show_album_number == 'on' || $cff_show_album_number == 'true' || $cff_show_album_number == true ) ? $cff_show_album_number = true : $cff_show_album_number = false;
    if( $feed_options[ 'showalbumnum' ] == 'false' ) $cff_show_album_number = false;

    $cff_album_cols = $feed_options['albumcols'];

    $cff_albums_only = false;
    if ( ($cff_show_albums_type && $cff_albums_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) $cff_albums_only = true;

    //PHOTOS ONLY
    $cff_photos_source = $feed_options[ 'photosource' ];
    isset($feed_options['photocols']) ? $cff_photos_cols = $feed_options['photocols'] : $cff_photos_cols = '1';

    $cff_photos_only = false;
    if ( ($cff_show_photos_type && $cff_photos_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_event_type && !$cff_show_status_type && !$cff_show_albums_type) $cff_photos_only = true;
    if( $cff_featured_post_active && !empty($feed_options['featuredpost']) ) $cff_photos_only = false;


    //VIDEOS ONLY
    $cff_videos_source = $feed_options[ 'videosource' ];

    $cff_show_video_name = $feed_options[ 'showvideoname' ];
    ( $cff_show_video_name == 'on' || $cff_show_video_name == 'true' || $cff_show_video_name == true ) ? $cff_show_video_name = true : $cff_show_video_name = false;
    if( $feed_options[ 'showvideoname' ] == 'false' ) $cff_show_video_name = false;

    $cff_show_video_desc = $feed_options[ 'showvideodesc' ];
    ( $cff_show_video_desc == 'on' || $cff_show_video_desc == 'true' || $cff_show_video_desc == true ) ? $cff_show_video_desc = true : $cff_show_video_desc = false;
    if( $feed_options[ 'showvideodesc' ] == 'false' ) $cff_show_video_desc = false;

    $cff_video_cols = $feed_options['videocols'];

    $cff_videos_only = false;
    if ( ($cff_show_video_type && $cff_videos_source == 'videospage') && !$cff_show_albums_type && !$cff_show_links_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) $cff_videos_only = true;
    if( $cff_featured_post_active && !empty($feed_options['featuredpost']) ) $cff_videos_only = false;

    /********** LAYOUT **********/
    //Include string
    $cff_includes = $feed_options[ 'include' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $cff_show_author = false;
    $cff_show_text = false;
    $cff_show_desc = false;
    $cff_show_shared_links = false;
    $cff_show_date = false;
    $cff_show_media = false;
    $cff_show_event_title = false;
    $cff_show_event_details = false;
    $cff_show_meta = false;
    $cff_show_link = false;
    $cff_show_like_box = false;
    if ( stripos($cff_includes, 'author') !== false ) $cff_show_author = true;
    if ( stripos($cff_includes, 'text') !== false ) $cff_show_text = true;
    if ( stripos($cff_includes, 'desc') !== false ) $cff_show_desc = true;
    if ( stripos($cff_includes, 'sharedlink') !== false ) $cff_show_shared_links = true;
    if ( stripos($cff_includes, 'date') !== false ) $cff_show_date = true;
    if ( stripos($cff_includes, 'media') !== false ) $cff_show_media = true;
    if ( stripos($cff_includes, 'eventtitle') !== false ) $cff_show_event_title = true;
    if ( stripos($cff_includes, 'eventdetail') !== false ) $cff_show_event_details = true;
    if ( stripos($cff_includes, 'social') !== false ) $cff_show_meta = true;
    if ( stripos($cff_includes, ',link') !== false ) $cff_show_link = true; //comma used to separate it from 'sharedlinks' - which also contains 'link' string
    if ( stripos($cff_includes, 'like') !== false ) $cff_show_like_box = true;

    //Exclude string
    $cff_excludes = $feed_options[ 'exclude' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    if ( stripos($cff_excludes, 'author') !== false ) $cff_show_author = false;
    if ( stripos($cff_excludes, 'text') !== false ) $cff_show_text = false;
    if ( stripos($cff_excludes, 'desc') !== false ) $cff_show_desc = false;
    if ( stripos($cff_excludes, 'sharedlink') !== false ) $cff_show_shared_links = false;
    if ( stripos($cff_excludes, 'date') !== false ) $cff_show_date = false;
    if ( stripos($cff_excludes, 'media') !== false ) $cff_show_media = false;
    if ( stripos($cff_excludes, 'eventtitle') !== false ) $cff_show_event_title = false;
    if ( stripos($cff_excludes, 'eventdetail') !== false ) $cff_show_event_details = false;
    if ( stripos($cff_excludes, 'social') !== false ) $cff_show_meta = false;
    if ( stripos($cff_excludes, ',link') !== false ) $cff_show_link = false; //comma used to separate it from 'sharedlinks' - which also contains 'link' string
    if ( stripos($cff_excludes, 'like') !== false ) $cff_show_like_box = false;

    $cff_preset_layout = $feed_options[ 'layout' ];
    //Default is thumbnail layout
    $cff_thumb_layout = false;
    $cff_half_layout = false;
    $cff_full_layout = true;
    if (($cff_preset_layout == 'thumb' || empty($cff_preset_layout)) && $cff_show_media) {
        $cff_thumb_layout = true;
    } else if ($cff_preset_layout == 'half'  && $cff_show_media) {
        $cff_half_layout = true;
    } else {
        $cff_full_layout = true;
    }

    //Get the media position
    $cff_media_position = $feed_options['mediaposition'];
    if ( $cff_thumb_layout || $cff_half_layout) $cff_media_position = 'below';

    //If the old shortcode option 'showauthor' is being used then apply it
    $cff_show_author_old = $feed_options[ 'showauthor' ];
    if( $cff_show_author_old == 'false' ) $cff_show_author = false;
    if( $cff_show_author_old == 'true' ) $cff_show_author = true;


    //LIGHTBOX
    $cff_disable_lightbox = $feed_options['disablelightbox'];
    ( $cff_disable_lightbox == 'on' || $cff_disable_lightbox == 'true' || $cff_disable_lightbox == true ) ? $cff_disable_lightbox = true : $cff_disable_lightbox = false;
    if( $feed_options[ 'disablelightbox' ] == 'false' ) $cff_disable_lightbox = false;
    
    /********** META **********/
    $cff_icon_style = 'cff-' . $feed_options[ 'iconstyle' ];
    $cff_meta_text_color = $feed_options[ 'socialtextcolor' ];
    $cff_meta_bg_color = $feed_options[ 'socialbgcolor' ];

    $cff_expand_comments = $feed_options['expandcomments'];
    ( $cff_expand_comments == 'on' || $cff_expand_comments == 'true' || $cff_expand_comments == true ) ? $cff_expand_comments = true : $cff_expand_comments = false;
    if( $feed_options[ 'expandcomments' ] == 'false' ) $cff_expand_comments = false;
    
    !isset( $feed_options['commentsnum'] ) ? $cff_comments_num = '4' : $cff_comments_num = $feed_options['commentsnum'];

    $cff_hide_comment_avatars = $feed_options['hidecommentimages'];

    ( $cff_hide_comment_avatars == 'on' || $cff_hide_comment_avatars == 'true' || $cff_hide_comment_avatars == true ) ? $cff_hide_comment_avatars = true : $cff_hide_comment_avatars = false;
    if( $feed_options[ 'hidecommentimages' ] == 'false' ) $cff_hide_comment_avatars = false;


    $cff_meta_styles = '';
    if ( !empty($cff_meta_text_color) || ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) ) $cff_meta_styles = 'style="';
    if ( !empty($cff_meta_text_color) ) $cff_meta_styles .= 'color:#' . str_replace('#', '', $cff_meta_text_color) . ';';
    if ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) $cff_meta_styles .= 'background-color:#' . str_replace('#', '', $cff_meta_bg_color) . ';';
    if ( !empty($cff_meta_text_color) || ( !empty($cff_meta_bg_color) && $cff_meta_bg_color !== '#' ) ) $cff_meta_styles .= '"';

    $cff_meta_link_color = '#' . str_replace('#', '', $feed_options['sociallinkcolor']);

    /********** TYPOGRAPHY **********/
    //See More text
    $cff_see_more_text = $feed_options[ 'seemoretext' ];
    $cff_see_less_text = $feed_options[ 'seelesstext' ];
    //See Less text
    //Title
    $cff_title_format = $feed_options[ 'textformat' ];
    if (empty($cff_title_format)) $cff_title_format = 'p';
    $cff_title_size = $feed_options[ 'textsize' ];
    $cff_title_weight = $feed_options[ 'textweight' ];
    $cff_title_color = $feed_options[ 'textcolor' ];


    $cff_title_styles = '';
    if( ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) || ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) || ( !empty($cff_title_color) && $cff_title_color !== '#' ) ) $cff_title_styles = 'style="';
        if ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) $cff_title_styles .=  'font-size:' . $cff_title_size . 'px; ';
        if ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) $cff_title_styles .= 'font-weight:' . $cff_title_weight . '; ';
        if ( !empty($cff_title_color) && $cff_title_color !== '#' ) $cff_title_styles .= 'color:#' . str_replace('#', '', $cff_title_color) . ';';
    if( ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) || ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) || ( !empty($cff_title_color) && $cff_title_color !== '#' ) ) $cff_title_styles .= '"';


    $cff_title_link = $feed_options[ 'textlink' ];
    //Text link color
    $cff_posttext_link_color = str_replace('#', '', $feed_options['textlinkcolor'] );

    ( $cff_title_link == 'on' || $cff_title_link == 'true' || $cff_title_link == true ) ? $cff_title_link = true : $cff_title_link = false;
    if( $feed_options[ 'textlink' ] == 'false' ) $cff_title_link = false;

    //Author
    $cff_author_size = $feed_options[ 'authorsize' ];
    $cff_author_color = $feed_options[ 'authorcolor' ];

    $cff_author_styles = '';
    if( ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) || ( !empty($cff_author_color) && $cff_author_color !== '#' ) ) $cff_author_styles = 'style="';
        if ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) $cff_author_styles .=  'font-size:' . $cff_author_size . 'px; ';
        if ( !empty($cff_author_color) && $cff_author_color !== '#' ) $cff_author_styles .= 'color:#' . str_replace('#', '', $cff_author_color) . ';';
    if( ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) || ( !empty($cff_author_color) && $cff_author_color !== '#' ) ) $cff_author_styles .= '"';

    //Description
    $cff_body_size = $feed_options[ 'descsize' ];
    $cff_body_weight = $feed_options[ 'descweight' ];
    $cff_body_color = $feed_options[ 'desccolor' ];

    $cff_body_styles = '';
    if( ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) || ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) || ( !empty($cff_body_color) && $cff_body_color !== '#' ) ) $cff_body_styles = 'style="';
        if ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) $cff_body_styles .=  'font-size:' . $cff_body_size . 'px; ';
        if ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) $cff_body_styles .= 'font-weight:' . $cff_body_weight . '; ';
        if ( !empty($cff_body_color) && $cff_body_color !== '#' ) $cff_body_styles .= 'color:#' . str_replace('#', '', $cff_body_color) . ';';
    if( ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) || ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) || ( !empty($cff_body_color) && $cff_body_color !== '#' ) ) $cff_body_styles .= '"';

    //Shared link title
    $cff_link_title_format = $feed_options[ 'linktitleformat' ];
    if (empty($cff_link_title_format)) $cff_link_title_format = 'p';
    $cff_link_title_size = $feed_options[ 'linktitlesize' ];
    $cff_link_title_color = str_replace('#', '', $feed_options[ 'linktitlecolor' ]);

    $cff_link_title_styles = '';
    if ( !empty($cff_link_title_size) && $cff_link_title_size != 'inherit' ) $cff_link_title_styles =  'style="font-size:' . $cff_link_title_size . 'px;"';

    //Shared link description
    $cff_link_desc_size = $feed_options[ 'linkdescsize' ];
    $cff_link_desc_color = $feed_options[ 'linkdesccolor' ];

    //Shared link URL
    $cff_link_url_size = $feed_options[ 'linkurlsize' ];
    $cff_link_url_color = $feed_options[ 'linkurlcolor' ];

    //Shared link box
    $cff_link_bg_color = $feed_options[ 'linkbgcolor' ];
    $cff_link_border_color = $feed_options[ 'linkbordercolor' ];
    $cff_disable_link_box = $feed_options['disablelinkbox'];
    ($cff_disable_link_box == 'true' || $cff_disable_link_box == 'on') ? $cff_disable_link_box = true : $cff_disable_link_box = false;

    $cff_full_link_images = $feed_options['fulllinkimages'];
    ($cff_full_link_images == 'true' || $cff_full_link_images == 'on') ? $cff_full_link_images = true : $cff_full_link_images = false;

    $cff_image_size = $feed_options['postimagesize'];
    
    $cff_link_box_styles = '';
    if( !empty($cff_link_border_color) || (!empty($cff_link_bg_color) && $cff_link_bg_color !== '#') ) $cff_link_box_styles = 'style="';
        if ( !empty($cff_link_border_color) ) $cff_link_box_styles .=  'border: 1px solid #' . str_replace('#', '', $cff_link_border_color) . '; ';
        if ( !empty($cff_link_bg_color) && $cff_link_bg_color !== '#' ) $cff_link_box_styles .= 'background-color: #' . str_replace('#', '', $cff_link_bg_color) . ';';
    if( !empty($cff_link_border_color) || (!empty($cff_link_bg_color) && $cff_link_bg_color !== '#') ) $cff_link_box_styles .= '"';


    //Event Title
    $cff_event_title_format = $feed_options[ 'eventtitleformat' ];
    if (empty($cff_event_title_format)) $cff_event_title_format = 'p';
    $cff_event_title_size = $feed_options[ 'eventtitlesize' ];
    $cff_event_title_weight = $feed_options[ 'eventtitleweight' ];
    $cff_event_title_color = $feed_options[ 'eventtitlecolor' ];


    $cff_event_title_styles = '';
    if( ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) || ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) || ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) ) $cff_event_title_styles = 'style="';
        if ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) $cff_event_title_styles .=  'font-size:' . $cff_event_title_size . 'px; ';
        if ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) $cff_event_title_styles .= 'font-weight:' . $cff_event_title_weight . '; ';
        if ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) $cff_event_title_styles .= 'color:#' . str_replace('#', '', $cff_event_title_color) . ';';
    if( ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) || ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) || ( !empty($cff_event_title_color) && $cff_event_title_color !== '#' ) ) $cff_event_title_styles .= '"';


    $cff_event_title_link = $feed_options[ 'eventtitlelink' ];
    ( $cff_event_title_link == 'on' || $cff_event_title_link == 'true' || $cff_event_title_link == true ) ? $cff_event_title_link = true : $cff_event_title_link = false;
    if( $feed_options[ 'eventtitlelink' ] == 'false' ) $cff_event_title_link = false;

    //Event Date
    $cff_event_date_size = $feed_options[ 'eventdatesize' ];
    $cff_event_date_weight = $feed_options[ 'eventdateweight' ];
    $cff_event_date_color = $feed_options[ 'eventdatecolor' ];
    $cff_event_date_position = $feed_options[ 'eventdatepos' ];
    $cff_event_date_formatting = $feed_options[ 'eventdateformat' ];
    $cff_event_date_custom = $feed_options[ 'eventdatecustom' ];

    $cff_event_date_styles = '';
    if( ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) || ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) || ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) ) $cff_event_date_styles = 'style="';
        if ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) $cff_event_date_styles .=  'font-size:' . $cff_event_date_size . 'px; ';
        if ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) $cff_event_date_styles .= 'font-weight:' . $cff_event_date_weight . '; ';
        if ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) $cff_event_date_styles .= 'color:#' . str_replace('#', '', $cff_event_date_color) . ';';
    if( ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) || ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) || ( !empty($cff_event_date_color) && $cff_event_date_color !== '#' ) ) $cff_event_date_styles .= '"';


    //Event Details
    $cff_event_details_size = $feed_options[ 'eventdetailssize' ];
    $cff_event_details_weight = $feed_options[ 'eventdetailsweight' ];
    $cff_event_details_color = $feed_options[ 'eventdetailscolor' ];
    $cff_event_link_color = str_replace('#', '', $feed_options[ 'eventlinkcolor' ]);

    $cff_event_details_styles = '';
    if( ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) || ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) || ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) ) $cff_event_details_styles = 'style="';
        if ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) $cff_event_details_styles .=  'font-size:' . $cff_event_details_size . 'px; ';
        if ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) $cff_event_details_styles .= 'font-weight:' . $cff_event_details_weight . '; ';
        if ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) $cff_event_details_styles .= 'color:#' . str_replace('#', '', $cff_event_details_color) . ';';
    if( ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) || ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) || ( !empty($cff_event_details_color) && $cff_event_details_color !== '#' ) ) $cff_event_details_styles .= '"';

    //No Upcoming Events text
    $cff_no_events_text = $feed_options['noeventstext'];
    if (!isset($cff_no_events_text) || empty($cff_no_events_text)) $cff_no_events_text = 'No upcoming events';

    //Date
    $cff_date_position = $feed_options[ 'datepos' ];
    if (!isset($cff_date_position)) $cff_date_position = 'below';
    $cff_date_size = $feed_options[ 'datesize' ];
    $cff_date_weight = $feed_options[ 'dateweight' ];
    $cff_date_color = $feed_options[ 'datecolor' ];

    $cff_date_styles = '';
    if( ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) || ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) || ( !empty($cff_date_color) && $cff_date_color !== '#' ) ) $cff_date_styles = 'style="';
        if ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) $cff_date_styles .=  'font-size:' . $cff_date_size . 'px; ';
        if ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) $cff_date_styles .= 'font-weight:' . $cff_date_weight . '; ';
        if ( !empty($cff_date_color) && $cff_date_color !== '#' ) $cff_date_styles .= 'color:#' . str_replace('#', '', $cff_date_color) . ';';
    if( ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) || ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) || ( !empty($cff_date_color) && $cff_date_color !== '#' ) ) $cff_date_styles .= '"';    

    $cff_date_before = isset( $feed_options[ 'beforedate' ] ) ? stripslashes( esc_attr( $feed_options[ 'beforedate' ] ) ) : '';
    $cff_date_after = isset( $feed_options[ 'afterdate' ] ) ? stripslashes( esc_attr( $feed_options[ 'afterdate' ] ) ) : '';

    //Set user's timezone based on setting
    $cff_timezone = $feed_options['timezone'];
    $cff_orig_timezone = date_default_timezone_get();
    date_default_timezone_set($cff_timezone);

    //Posted ago strings
    $cff_date_translate_strings = array(
        'cff_translate_second' => $feed_options['secondtext'],
        'cff_translate_second' => $feed_options['secondtext'],
        'cff_translate_seconds' => $feed_options['secondstext'],
        'cff_translate_minute' => $feed_options['minutetext'],
        'cff_translate_minutes' => $feed_options['minutestext'],
        'cff_translate_hour' => $feed_options['hourtext'],
        'cff_translate_hours' => $feed_options['hourstext'],
        'cff_translate_day' => $feed_options['daytext'],
        'cff_translate_days' => $feed_options['daystext'],
        'cff_translate_week' => $feed_options['weektext'],
        'cff_translate_weeks' => $feed_options['weekstext'],
        'cff_translate_month' => $feed_options['monthtext'],
        'cff_translate_months' => $feed_options['monthstext'],
        'cff_translate_year' => $feed_options['yeartext'],
        'cff_translate_years' => $feed_options['yearstext'],
        'cff_translate_ago' => $feed_options['agotext']
    );

    //Link to Facebook
    $cff_link_size = $feed_options[ 'linksize' ];
    $cff_link_weight = $feed_options[ 'linkweight' ];
    $cff_link_color = $feed_options[ 'linkcolor' ];

    $cff_link_styles = '';
    if( ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) || ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) || ( !empty($cff_link_color) && $cff_link_color !== '#' ) ) $cff_link_styles = 'style="';
        if ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) $cff_link_styles .=  'font-size:' . $cff_link_size . 'px; ';
        if ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) $cff_link_styles .= 'font-weight:' . $cff_link_weight . '; ';
        if ( !empty($cff_link_color) && $cff_link_color !== '#' ) $cff_link_styles .= 'color:#' . str_replace('#', '', $cff_link_color) . ';';
    if( ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) || ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) || ( !empty($cff_link_color) && $cff_link_color !== '#' ) ) $cff_link_styles .= '"';

    $cff_facebook_link_text = $feed_options[ 'facebooklinktext' ];
    $cff_facebook_share_text = $feed_options[ 'sharelinktext' ];
    if ($cff_facebook_share_text == '') $cff_facebook_share_text = 'Share';


    //Show Facebook link
    $cff_show_facebook_link = $feed_options[ 'showfacebooklink' ];
    ( $cff_show_facebook_link == 'on' || $cff_show_facebook_link == 'true' || $cff_show_facebook_link == true ) ? $cff_show_facebook_link = true : $cff_show_facebook_link = false;
    if( $feed_options[ 'showfacebooklink' ] === 'false' ) $cff_show_facebook_link = false;


    //Show Share link
    $cff_show_facebook_share = $feed_options[ 'showsharelink' ];
    ( $cff_show_facebook_share == 'on' || $cff_show_facebook_share == 'true' || $cff_show_facebook_share == true ) ? $cff_show_facebook_share = true : $cff_show_facebook_share = false;
    if( $feed_options[ 'showsharelink' ] === 'false' ) $cff_show_facebook_share = false;

    $cff_view_link_text = $feed_options[ 'viewlinktext' ];
    $cff_link_to_timeline = $feed_options[ 'linktotimeline' ];
    
    /********** MISC **********/

    //Photos translate text
    $cff_translate_photos_text = $feed_options['photostext'];
    if (!isset($cff_translate_photos_text) || empty($cff_translate_photos_text)) $cff_translate_photos_text = 'photos';

    //Is it a restricted page?
    $cff_restricted_page = $feed_options['restrictedpage'];
    ($cff_restricted_page == 'true' || $cff_restricted_page == 'on') ? $cff_restricted_page = true : $cff_restricted_page = false;

    //Video
    $cff_video_height = $feed_options[ 'videoheight' ];
    $cff_video_action = $feed_options[ 'videoaction' ];

    //Post Style settings
    $cff_post_style = $feed_options['poststyle'];

    $cff_post_bg_color = str_replace('#', '', $feed_options['postbgcolor']);
    $cff_post_rounded = $feed_options['postcorners'];
    ( ($cff_post_bg_color !== '#' && $cff_post_bg_color !== '') && $cff_post_style != 'regular' ) ? $cff_post_bg_color_check = true : $cff_post_bg_color_check = false;

    $cff_box_shadow = $feed_options['boxshadow'];
    ( ($cff_box_shadow == 'true' || $cff_box_shadow == 'on') && $cff_post_style == 'boxed' ) ? $cff_box_shadow = true : $cff_box_shadow = false;

    //Separating Line
    $cff_sep_color = $feed_options[ 'sepcolor' ];
    if (empty($cff_sep_color)) $cff_sep_color = 'ddd';
    $cff_sep_size = $feed_options[ 'sepsize' ];
    $cff_sep_size_check = true;
    //If empty then set a 0px border
    if ( empty($cff_sep_size) || $cff_sep_size == '' ) {
        $cff_sep_size = 0;
        //Need to set a color otherwise the CSS is invalid
        $cff_sep_color = 'fff';
        $cff_sep_size_check = false;
    }
    ($cff_sep_color !== '#' && $cff_sep_color !== '') ? $cff_sep_color_check = true : $cff_sep_color_check = false;

    //CFF item styles
    $cff_item_styles = '';
    if( $cff_post_style == 'boxed' || $cff_post_bg_color_check ){
        $cff_item_styles = 'style="';
        if($cff_post_bg_color_check) $cff_item_styles .= 'background-color: #' . $cff_post_bg_color . '; ';
        if( isset($cff_post_rounded) && $cff_post_rounded !== '0' && !empty($cff_post_rounded) ) $cff_item_styles .= '-webkit-border-radius: ' . $cff_post_rounded . 'px; -moz-border-radius: ' . $cff_post_rounded . 'px; border-radius: ' . $cff_post_rounded . 'px; ';
        $cff_item_styles .= '"';
    }
    if( $cff_post_style == 'regular' && ($cff_sep_color_check || $cff_sep_size_check) ){
        $cff_item_styles .= 'style="border-bottom: ' . $cff_sep_size . 'px solid #' . str_replace('#', '', $cff_sep_color) . ';"';
    }
   
    //Text limits
    $title_limit = $feed_options['textlength'];
    if (!isset($title_limit)) $title_limit = 9999;
    $body_limit = $feed_options['desclength'];


    //Assign the Access Token
    $access_token = $feed_options['accesstoken'];
    
    //If the 'Enter my own Access Token' box is unchecked then don't use the user's access token, even if there's one in the field
    $feed_options['ownaccesstoken'] ? $cff_show_access_token = true : $cff_show_access_token = false;

    //Page ID
    $page_id = trim( $feed_options['id'] );

    //If user pastes their full URL into the Page ID field then strip it out
    $cff_facebook_string = 'facebook.com';
    ( stripos($page_id, $cff_facebook_string) !== false) ? $cff_page_id_url_check = true : $cff_page_id_url_check = false;
    
    if ( $cff_page_id_url_check === true ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }

    //If the Page ID contains a query string at the end then remove it
    if ( stripos( $page_id, '?') !== false ) $page_id = substr($page_id, 0, strrpos($page_id, '?'));


    //Get show posts attribute. If not set then default to 25
    $show_posts = $feed_options['num'];
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;

    //If it's the last batch of album-items then display them all and then hide them in JS as we don't make any further API requests
    // if( $last_album_batch == 'true' ) $show_posts = 999;

    //Check whether a Page ID has been defined
    if ( $page_id == '' && ( current_user_can('editor') || current_user_can('administrator') ) ) {
        echo "<span id='cff-no-id'>Please enter the Page ID of the Facebook feed you'd like to display. You can do this in either the Custom Facebook Feed plugin settings or in the shortcode itself. For example [custom-facebook-feed id=YOUR_PAGE_ID_HERE].</span><br /><br />";
        return false;
    }

    //Use posts? or feed?
    $show_others = $feed_options['others'];
    $show_posts_by = $feed_options['showpostsby'];
    $graph_query = 'posts';
    $cff_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if (!$show_others) {
        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$cff_is_group ) {
            $cff_show_only_others = true;
        }
    }

    //Misc Settings
    $cff_nofollow = $feed_options['nofollow'];
    ( $cff_nofollow == 'on' || $cff_nofollow == 'true' || $cff_nofollow == true ) ? $cff_nofollow = true : $cff_nofollow = false;
    if( $feed_options[ 'nofollow' ] == 'false' ) $cff_nofollow = false;
    ( $cff_nofollow ) ? $cff_nofollow = ' rel="nofollow"' : $cff_nofollow = '';
    
    //If the number of posts is set to zero then don't show any and set limit to one
    if ( ($feed_options['num'] == '0' || $feed_options['num'] == 0) && $feed_options['num'] !== ''){
        $show_posts = 0;
        $cff_post_limit = 1;
    }


    //Set the cache time (for timeline events)
    //Calculate the cache time in seconds
    if($cff_cache_time_unit == 'minutes') $cff_cache_time_unit = 60;
    if($cff_cache_time_unit == 'hours') $cff_cache_time_unit = 60*60;
    if($cff_cache_time_unit == 'days') $cff_cache_time_unit = 60*60*24;
    $cache_seconds = $cff_cache_time * $cff_cache_time_unit;

    //Extension settings
    $cff_album_id = $feed_options['album'];
    ( $feed_options['reviewsmethod'] == 'all' ) ? $show_all_reviews = true : $show_all_reviews = false;

    //***START POSTS HTML***
    $cff_content = "";

    //Limit var
    $i = 0;

    //Multifeed extension
    ( $cff_ext_multifeed_active ) ? $page_ids = cff_multifeed_ids($page_id) : $page_ids = array($page_id);

    //If multiple Access Tokens are being used then split them up into an associative array
    $cff_multiple_tokens = false;
    if ( $cff_ext_multifeed_active && is_array($access_token) ){
    	$cff_multiple_tokens = true;
    	$access_token_multiple = $access_token;
    }    	

    //Define array for post items
    $cff_posts_array = array();

    //If it's an album embed then only use one ID otherwise it loops through and embeds the same album items multiple times
    if( !empty($cff_album_id) ) $page_ids = array($page_ids[0]);

    //LOOP THROUGH PAGE IDs
    foreach ( $page_ids as $page_id ) {

    	//If using multiple Page Access Tokens then grab the right one for this ID
    	if( $cff_multiple_tokens ) $access_token = $access_token_multiple[$page_id];

        //Set the JSON data to be the JSON data that corresponds to the page_id in the multifeed JSON data array
        $json_data = $json_data_arr[$page_id];
    
        //EVENTS ONLY
        if ($cff_events_only && $cff_events_source == 'eventspage'){

            //If there is no event data then show a message
            if( empty($json_data->data) ){

                //Check whether it's group events
                // if($cff_is_group){
                //     $cff_content .= '<div class="cff-error-msg">';
                //     $cff_content .= '<p><b>Unable to display Facebook Group events</b></p>';
                //     $cff_content .= '<div id="cff-error-reason"><i>This message is only visible to admins:</i><br />Due to recent changes in the Facebook API it is unfortunately no longer possible to display posts from Facebook Groups. Please see <a href="https://smashballoon.com/facebook-api-changes-april-4-2018/" target="_blank">this page</a> for more information.</div>';
                //     $cff_content .= '</div>'; //End .cff-error-msg and #cff-error-reason

                //     //Only display errors to admins
                //     if( current_user_can( 'manage_options' ) ){
                //         $cff_content .= '<style>#cff .cff-error-msg{ display: block !important; }</style>';
                //     }

                //     return $cff_content;
                // }

            } else {

                //EVENTS LOOP
                foreach ($json_data->data as $event )
                {
                    //Only create posts for the amount of posts specified
                    // if ( $i == $show_posts ) break;
                    $i++;
                    isset($event->id) ? $id = $event->id : $id = '';
                    //Object ID
                    ( !empty($event->object_id) ) ? $object_id = $event->object_id : $object_id = '';

                    isset($event->name) ? $event_name = $event->name : $event_name = '';
                    isset($event->attending_count) ? $attending_count = $event->attending_count : $attending_count = '';

                    //Picture source
                    $cff_no_event_img = false;
                    if( isset($event->cover) ){
                        $pic_big = $event->cover->source;
                    } else {
                        $cff_no_event_img = true;
                        $pic_big = plugins_url( '/img/event-image.png' , __FILE__ );
                        $pic_big_lightbox = plugins_url( '/img/event-image-cover.png' , __FILE__ );
                    }
                    ( $feed_options['eventimage'] == 'cropped' ) ? $crop_event_pic = true : $crop_event_pic = false;

                    isset($event->start_time) ? $start_time = $event->start_time : $start_time = '';
                    isset($event->end_time) ? $end_time = $event->end_time : $end_time = '';
                    isset($event->timezone) ? $timezone = $event->timezone : $timezone = '';

                    //Venue
                    isset($event->place->location->latitude) ? $venue_latitude = $event->place->location->latitude : $venue_latitude = '';
                    isset($event->place->location->longitude) ? $venue_longitude = $event->place->location->longitude : $venue_longitude = '';
                    isset($event->place->location->city) ? $venue_city = $event->place->location->city : $venue_city = '';
                    isset($event->place->location->state) ? $venue_state = $event->place->location->state : $venue_state = '';
                    isset($event->place->location->country ) ? $venue_country = htmlentities($event->place->location->country, ENT_QUOTES, 'UTF-8') : $venue_country = '';
                    isset($event->place->id) ? $venue_id = $event->place->id : $venue_id = '';
                    $venue_link = 'https://facebook.com/' . $venue_id;
                    isset($event->place->location->street) ? $venue_street = $event->place->location->street : $venue_street = '';
                    isset($event->place->location->zip) ? $venue_zip = $event->place->location->zip : $venue_zip = '';
                    isset($event->place->name) ? $location = $event->place->name : $location = '';

                    isset($event->description) ? $description = $event->description : $description = '';
                    $event_link = 'https://facebook.com/events/' . $id;
                    isset($event->ticket_uri) ? $ticket_uri = htmlentities($event->ticket_uri, ENT_QUOTES, 'UTF-8') : $ticket_uri = '';

                    //Interested in/going
                    isset($event->interested_count) ? $interested_count = $event->interested_count : $interested_count = '';
                    isset($event->attending_count) ? $attending_count = $event->attending_count : $attending_count = '';

                    $cff_buy_tickets_text = $feed_options['buyticketstext'];

                    //Event date
                    $event_time = $start_time;

                    //If timezone migration is enabled then remove last 5 characters
                    if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);

                    //Event title
                    $cff_event_title = '';
                    $cff_event_title .= '<' . $cff_event_title_format . ' class="cff-event-title" ' . $cff_event_title_styles . '>';
                    if ($cff_event_title_link) $cff_event_title .= '<a href="'.$event_link.'" '.$target.$cff_nofollow.'>';
                    $cff_event_title .= $event_name;
                    if ($cff_event_title_link) $cff_event_title .= '</a>';
                    $cff_event_title .= '</' . $cff_event_title_format . '>';


                    //Get the filter string
                    $cff_filter_string = $feed_options[ 'filter' ];
                    //Create a string from the event title, location and address to use in the filter check below
                    $cff_event_address_string = $cff_event_title . $location . $venue_street . $venue_city . $venue_state . $venue_zip;

                    $cff_show_post = true;
                    if ( $cff_filter_string != '' ){
                        //Explode it into multiples
                        $cff_filter_strings_array = explode(',', $cff_filter_string);
                        //Hide the post if both the post text and description don't contain the string
                        $string_in_address = true;
                        $string_in_desc = true;
                        if ( cff_stripos_arr_filter($cff_event_address_string, $cff_filter_strings_array) === false ) $string_in_address = false;
                        if ( cff_stripos_arr_filter($description, $cff_filter_strings_array) === false ) $string_in_desc = false;

                        if( $string_in_address == false && $string_in_desc == false ) $cff_show_post = false;
                    }

                    $cff_exclude_string = $feed_options[ 'exfilter' ];
                    if ( $cff_exclude_string != '' ){
                        //Explode it into multiples
                        $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                        //Hide the post if both the post text and description don't contain the string
                        $string_in_address = false;
                        $string_in_desc = false;

                        if ( cff_stripos_arr_filter($cff_event_address_string, $cff_exclude_strings_array) !== false ) $string_in_address = true;
                        if ( cff_stripos_arr_filter($description, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                        if( $string_in_address == true || $string_in_desc == true ) $cff_show_post = false;
                    }

                    //Encode these after the filtering is done
                    $event_name = htmlentities($event_name, ENT_QUOTES, 'UTF-8');
                    $location = htmlentities($location, ENT_QUOTES, 'UTF-8');
                    $venue_street = htmlentities($venue_street, ENT_QUOTES, 'UTF-8');
                    $venue_city = htmlentities($venue_city, ENT_QUOTES, 'UTF-8');
                    $venue_state = htmlentities($venue_state, ENT_QUOTES, 'UTF-8');
                    $venue_zip = htmlentities($venue_zip, ENT_QUOTES, 'UTF-8');
                    $description = htmlentities($description, ENT_QUOTES, 'UTF-8');

                    //Recurring events time
                    $cur_time = strtotime(date('Y-m-d'));
                    $cff_multiple_date_count = 0;
                    $event_time_item_id = '';
                    if( isset($event->event_times) ){

                        //Set time diff to be really high initially so the time difference comparison will be less than it
                        $event_time_diff = 99999999999;
                        $event_time_arr = array();

                        foreach ( $event->event_times as $event_time_item){
                            $event_item_time = strtotime($event_time_item->start_time);

                            if( $event_item_time > $cur_time ){
                                //Find smallest diff between start_time and current time
                                if( abs( $event_item_time - $cur_time ) < $event_time_diff ){
                                    $event_time_diff = abs( $event_item_time - $cur_time );

                                    //Use the start and end times from this "event_times" item
                                    $event_time = $event_time_item->start_time;
                                    if( isset($event_time_item->end_time) ) $end_time = $event_time_item->end_time;
                                }
                                $cff_multiple_date_count++;

                                //Create a custom array from the event times so I can sort them and loop through below
                                $event_time_arr = cff_array_push_assoc(
                                    $event_time_arr,
                                    $event_item_time,
                                    array(
                                        'id' => $event_time_item->id,
                                        'end_time' => $event_time_item->end_time
                                    )
                                );
                            } //End if

                        } //End for loop

                        //Convert to unix
                        $event_time = strtotime($event_time);

                        //-1 to account for date already being displayed
                        $cff_multiple_date_count--;

                        //Sort the array by date so they're shown chronologically
                        ksort($event_time_arr);
                    } else {
                        $event_time = strtotime($event_time);
                    }

                    //If timezone migration is enabled then remove last 5 characters from end time
                    if ( strlen($end_time) == 24 ) $end_time = substr($end_time, 0, -5);

                    //Create the event date HTML
                    $cff_event_date = '';
                    if (!empty($event_time)){
                        $cff_event_date = '<p class="cff-date"><span class="cff-start-date" '.$cff_event_date_styles.'>' . cff_eventdate($event_time, $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                        if( isset($event->end_time) ) $cff_event_date .= '<span class="cff-end-date" '.$cff_event_date_styles.'> - ' . cff_eventdate(strtotime($end_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                        if( $cff_multiple_date_count > 0 ) $cff_event_date .= '<a href="javascript:void(0);" class="cff-more-dates">+'.$cff_multiple_date_count.'</a>';

                        //Include the additional dates if there are some
                        if( $cff_multiple_date_count > 0 ){
                            $cff_event_date .= '<span class="cff-multiple-dates">';
                            
                            foreach ( $event_time_arr as $event_time_unix => $event_time_item){
                                //Don't include the date which is used as the main event date so it's not repeated
                                if( $event_time != $event_time_unix ){
                                    //Create the HTML for the additional dates to display below
                                    $cff_event_date .= '<span class="cff-multiple-date" id="cff_'.$event_time_item['id'].'"><span class="cff-start-date">' . cff_eventdate($event_time_unix, $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                                    if( isset($event_time_item['end_time']) ) $cff_event_date .= '<span class="cff-end-date"> - ' . cff_eventdate(strtotime($event_time_item['end_time']), $cff_event_date_formatting, $cff_event_date_custom) . '</span>';
                                    $cff_event_date .= '</span>';
                                }
                            }
                            $cff_event_date .= '</span>';
                        }
                        $cff_event_date .= '</p>';
                    }


                    //***************************//
                    //***CREATE THE EVENT HTML***//
                    //***************************//
                    $cff_post_item = '<div class="cff-item cff-event author-'. cff_to_slug($page_id);
                    if( !$cff_past_events ) $cff_post_item .= ' cff-upcoming-event';
                    if ($cff_post_bg_color_check || $cff_post_style == "boxed") $cff_post_item .= ' cff-box';
                    $cff_post_item .= ' cff-new';
                    if( $event_time < $cur_time ) $cff_post_item .= ' cff-past';
                    if( $cff_box_shadow ) $cff_post_item .= ' cff-shadow';
                    $cff_post_item .= '"';
                    $cff_post_item .= ' data-cff-timestamp="';
                    if( isset($event->start_time) ) $cff_post_item .= strtotime($event->start_time);
                    $cff_post_item .= '"';
                    $cff_post_item .= ' id="cff_'. $id .'" ' . $cff_item_styles.'>';
                    //Picture
                    if($cff_show_media){

                        //Fix Photon (Jetpack) issue
                        $cff_picture_querystring = '';
                        if (parse_url($pic_big, PHP_URL_QUERY)){
                            $picture_url_parts = parse_url($pic_big);
                            $cff_picture_querystring = $picture_url_parts['query'];
                        }

                        //Remove any quotes from event name to use in the image alt tag
                        $event_name = str_replace('"', "", $event_name);
                        $event_name = str_replace("'", "", $event_name);
                        //Alt text
                        isset( $event_name ) ? $cff_alt_text = strip_tags($event_name) : $cff_alt_text = $cff_facebook_link_text;

                        $cff_post_item .= '<div class="cff-media-wrap">';
                        $cff_post_item .= '<a class="cff-photo nofancybox';
                        if( $crop_event_pic ) $cff_post_item .= ' cff-crop';
                        $cff_post_item .= '" href="'.$event_link.'" '.$target.$cff_nofollow.'><img src="'. $pic_big .'" alt="'.$cff_alt_text.'" data-querystring="'.$cff_picture_querystring.'" ';
                        if( $cff_no_event_img ) $cff_post_item .= 'data-cff-no-event-img-large="'.$pic_big_lightbox.'"';
                        $cff_post_item .= ' /></a></div>';
                    }
                    //Start text wrapper
                    if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '<div class="cff-details">';
                        //show event date above title
                        if ($cff_show_date && $cff_event_date_position == 'above') $cff_post_item .= $cff_event_date;
                        //Show event title
                        if ($cff_show_event_title && !empty($event_name)) $cff_post_item .= $cff_event_title;
                        //show event date below title
                        if ($cff_show_date && $cff_event_date_position !== 'above') $cff_post_item .= $cff_event_date;
                        //Show event details
                        if ($cff_show_event_details){
                            if (!empty($location)) $cff_post_item .= '<p class="cff-location" ' . $cff_event_details_styles . '>';

                            $cff_event_link_color_html = '';
                            if( isset($cff_event_link_color) && !empty($cff_event_link_color) && $cff_event_link_color != '#' ) $cff_event_link_color_html = 'style="color: #'.$cff_event_link_color.'"';

                            if (!empty($venue_id)) $cff_post_item .= '<a href="'. $venue_link .'" '.$target.$cff_nofollow.' '.$cff_event_link_color_html.'>';
                            if (!empty($location)) $cff_post_item .= '<b class="cff-event-place">' . $location . '</b>';
                            if (!empty($venue_id)) $cff_post_item .= '</a>';
                            if (!empty($venue_street)) $cff_post_item .= '<span class="cff-event-street">' . $venue_street . '</span>';
                            if (!empty($venue_city)) $cff_post_item .= '<span class="cff-event-city">' . $venue_city . ',</span>';
                            if (!empty($venue_state)) $cff_post_item .= '<span class="cff-event-state"> ' . $venue_state . '</span>';
                            if (!empty($venue_zip)) $cff_post_item .= '<span class="cff-event-zip">' . $venue_zip . '</span>';
                            $cff_map_text = $feed_options[ 'maptext' ];

                            //Create the map link
                            if( isset($event->place->location) ){
                                $map_url = 'https://maps.google.com/maps?q=' . $venue_latitude . ',+' . $venue_longitude;
                            //If an address is used instead of a "place" then check whether it contains a number and is over a certain length. If it does, then it's likely a real address and so we can use it in the map link
                            } else if( 1 === preg_match('~[0-9]~', $location) && strlen($location) > 10 ) {
                                $map_url = 'https://maps.google.com/maps?q=' . $location;
                            } else {
                                $map_url = '';
                            }

                            //Map link
                            $cff_event_link_color_html = '';
                            if( isset($cff_event_link_color) && !empty($cff_event_link_color) && $cff_event_link_color != '#' ) $cff_event_link_color_html = 'style="color: #'.$cff_event_link_color.'"';

                            if (!empty($map_url)) $cff_post_item .= ' <a href="'.$map_url.'" '.$target.$cff_nofollow.' '.$cff_event_link_color_html.' class="cff-event-map-link">'.stripslashes(__( $cff_map_text, 'custom-facebook-feed' ) ).'</a>';

                            if (!empty($location)) $cff_post_item .= '</p>';
                            if (!empty($description)){
                                
                                $cff_post_item .= '<p class="cff-desc" ';

                                //Set the char limit on the element
                                if (!empty($title_limit)) {
                                    if (strlen($description) > $title_limit) $cff_post_item .= 'data-char="'. $title_limit .'" ';
                                }

                                //Used to fix the content formatting issue caused by some themes
                                $cff_format_issue = $feed_options['textissue'];
                                ($cff_format_issue == 'true' || $cff_format_issue == 'on') ? $cff_format_issue = true : $cff_format_issue = false;
                                $cff_linebreak_el = '<br />';
                                if( $cff_format_issue ) $cff_linebreak_el = '<img class="cff-linebreak" />';
                                
                                //Replace line breaks in text (needed for IE8 and to prevent lost line breaks in HTML minification)
                                $description = preg_replace("/\r\n|\r|\n/",$cff_linebreak_el, $description);

                                $description = cff_autolink($description, $link_color=$cff_event_link_color);
                                $cff_description_tagged = cff_desc_tags($description);

                                $cff_post_item .= $cff_event_details_styles . '><span class="cff-desc-text">' . $cff_description_tagged . '</span>';

                                //Add the See More and See Less links if needed
                                if (!empty($title_limit)) {
                                    $cff_posttext_link_color_html = '';
                                    if( isset($cff_posttext_link_color) && !empty($cff_posttext_link_color) && $cff_posttext_link_color != '#' ) $cff_posttext_link_color_html = 'style="color: #'.$cff_posttext_link_color.'"';
                                    if (strlen($description) > $title_limit) $cff_post_item .= '<span class="cff-expand">... <a href="#" '.$cff_posttext_link_color_html.'><span class="cff-more">' . stripslashes(__( $cff_see_more_text, 'custom-facebook-feed' ) ) . '</span><span class="cff-less">' . stripslashes(__( $cff_see_less_text, 'custom-facebook-feed' ) ) . '</span></a></span>';
                                }

                                $cff_post_item .= '</p>';

                            }

                            //Interested in/going
                            $cff_interested_text = $feed_options[ 'interestedtext' ];
                            $cff_going_text = $feed_options[ 'goingtext' ];
                            if( empty($cff_interested_text) || $cff_interested_text == '' ) $cff_interested_text = 'interested';
                            if( empty($cff_going_text) || $cff_going_text == '' ) $cff_going_text = 'going';
                            isset($interested_count) ? $interested_count_num = intval($interested_count) : $interested_count_num = 0;
                            isset($attending_count) ? $attending_count_num = intval($attending_count) : $attending_count_num = 0;
                            if( $interested_count_num > 0 || $attending_count_num > 0 ){
                                $cff_post_item .= '<div class="cff-event-meta">';
                                if( $interested_count_num > 0 ) $cff_post_item .= $interested_count . ' ' . stripslashes(__( $cff_interested_text, 'custom-facebook-feed' ) );
                                if( $interested_count_num > 0 && $attending_count_num > 0 ) $cff_post_item .= ' &nbsp;&middot;&nbsp; ';
                                if( $attending_count_num > 0 ) $cff_post_item .= $attending_count . ' ' . stripslashes(__( $cff_going_text, 'custom-facebook-feed' ) );
                                $cff_post_item .= '</div>';
                            }

                        }
                    //End details
                    if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '</div>';
                    $cff_post_item .= '<div class="cff-meta-wrap">';

                    $cff_post_item .= '<div class="cff-post-links">';


                    //Social media sharing URLs
                    $cff_share_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($event_link);
                    $cff_share_twitter = 'https://twitter.com/intent/tweet?text=' . urlencode($event_link);
                    $cff_share_google = 'https://plus.google.com/share?url=' . urlencode($event_link);
                    $cff_share_linkedin = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($event_link) . '&amp;title=' . rawurlencode( strip_tags($cff_event_title) . ' - ' . strip_tags($cff_event_date) );
                    $cff_share_email = 'mailto:?subject=Facebook&amp;body=' . urlencode($event_link) . '%20-%20' . rawurlencode( strip_tags($cff_event_title) . ' - ' . strip_tags($cff_event_date) );

                        //Buy tickets link
                        if($ticket_uri !== '') $cff_post_item .= '<a href="' . $ticket_uri . '" target="_blank" ' . $cff_link_styles . '>'.stripslashes(__( $cff_buy_tickets_text, 'custom-facebook-feed' ) ).'</a><span class="cff-dot" ' . $cff_link_styles . '>&middot;</span>';

                        //View on Facebook link
                        if($cff_show_facebook_link) $cff_post_item .= '<a class="cff-viewpost" href="' . $event_link . '" ' . $target . $cff_nofollow.' ' . $cff_link_styles . '>'.$cff_facebook_link_text.'</a>';

                        //Share link
                        if($cff_show_facebook_share){
                            $cff_post_item .= '<div class="cff-share-container">';
                            
                            if($cff_show_facebook_link) $cff_post_item .= '<span class="cff-dot" ' . $cff_link_styles . '>&middot;</span>';

                            $cff_post_item .= '<a class="cff-share-link" href="javascript:void(0);" title="' . $cff_facebook_share_text . '" ' . $cff_link_styles . '>' . $cff_facebook_share_text . '</a>';
                            $cff_post_item .= "<p class='cff-share-tooltip'><a href='".$cff_share_facebook."' target='_blank' class='cff-facebook-icon'><span class='fa fab fa-facebook-square' aria-hidden='true'></span><span class='cff-screenreader'>Share on Facebook</span></a><a href='".$cff_share_twitter."' target='_blank' class='cff-twitter-icon'><span class='fa fab fa-twitter' aria-hidden='true'></span><span class='cff-screenreader'>Share on Twitter</span></a><a href='".$cff_share_linkedin."' target='_blank' class='cff-linkedin-icon'><span class='fa fab fa-linkedin' aria-hidden='true'></span><span class='cff-screenreader'>Share on Linked In</span></a><a href='".$cff_share_email."' target='_blank' class='cff-email-icon'><span class='fa fa-envelope' aria-hidden='true'></span><span class='cff-screenreader'>Share by Email</span></a><span class='fa fa-play fa-rotate-90' aria-hidden='true'></span></p></div>";
                        }
                        
                        $cff_post_item .= '</div>'; 

                    $cff_post_item .= '</div></div>';

                    //Change the seconds value of the event_time unix value so that if more than 1 event has the same start time then it doesn't get replaced in the posts array
                    $event_time = substr( $event_time , 0, -1) . rand(1, 9);

                    //PUSH TO ARRAY if the post should be shown
                    if( $cff_show_post !== false ) $cff_posts_array = cff_array_push_assoc($cff_posts_array, $event_time, $cff_post_item);

                } // End the loop

            } // End empty() check

            //Sort all of the events by all page IDs to show the most recent upcoming events first
            if(!$cff_past_events) ksort($cff_posts_array);
            if($cff_past_events) krsort($cff_posts_array);

        } //End EVENTS ONLY
        

        //ALL POSTS
        if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){
            
            //Interpret data with JSON
            $FBdata = $json_data;

            //Show notice that
            if( ($cff_photos_only && empty($cff_album_id)) && $cff_is_group && current_user_can( 'manage_options' ) ){

                    global $current_user;
                        $user_id = $current_user->ID;

                    // Use this to show notice again
                    // delete_user_meta($user_id, 'cff_group_photos_notice_dismiss');

                    /* Check that the user hasn't already clicked to ignore the message */
                    if ( ! get_user_meta($user_id, 'cff_group_photos_notice_dismiss') ) {

                        $cff_content .= "<section class='cff-error-msg'>";
                        $cff_content .= "<p><b>This message is only visible to admins:</b><br />Facebook deprecated version 2.0 of their API in August 2016, which unfortunately means that Facebook no longer supports displaying photo grid feeds from Facebook Groups. Please see <a href='https://smashballoon.com/can-i-display-photos-from-a-facebook-group/' target='_blank'>here</a> for more information. We apologize for any inconvenience.</p>";
                        $cff_content .= "<a class='cff_notice_dismiss' href='" .esc_url( add_query_arg( 'cff_group_photos_notice_dismiss', '0' ) ). "'><span class='fa fa-times-circle' aria-hidden='true'></span></a></section>";

                        //Only display errors to admins
                        if( current_user_can( 'manage_options' ) ){
                            $cff_content .= '<style>#cff .cff-error-msg{ display: block !important; }</style>';
                        }

                    }
                
            }

            //If there's no data then show a pretty error message
            if( ( empty($FBdata->data) && empty($FBdata->videos) ) && (!$cff_featured_post_active || empty($feed_options['featuredpost'])) && !$cff_ext_multifeed_active ) {


                    //Group photos deprecated with API v2.0
                    if( ($cff_photos_only && empty($cff_album_id)) && $cff_is_group ){

                        $cff_content .= "<p><span class='fa fab fa-facebook-square' aria-hidden='true' style='color: #3b5998; padding-right: 5px;'></span><a href='https://www.facebook.com/groups/".$page_id."/photos' target='_blank'>View photos on Facebook</a>";

                    } else {

                        $cff_content .= "<div class='cff-error-msg'>";
                        $cff_content .= '<p><b>This message is only visible to admins:</b><br />Unable to display Facebook posts</p>';
                        $cff_content .= '<div id="cff-error-reason">';

                        if( isset($FBdata->error->message) ) $cff_content .= '<b>Error:</b> ' . $FBdata->error->message;
                        if( isset($FBdata->error->type) ) $cff_content .= '<br /><b>Type:</b> ' . $FBdata->error->type;
                        if( isset($FBdata->error->code) ) $cff_content .= '<br /><b>Code:</b> ' . $FBdata->error->code;
                        if( isset($FBdata->error->error_subcode) ) $cff_content .= '<br />Subcode: ' . $FBdata->error->error_subcode;

                        if( isset($FBdata->error_msg) ) $cff_content .= '<b>Error:/<b> ' . $FBdata->error_msg;
                        if( isset($FBdata->error_code) ) $cff_content .= '<br /><b>Code:</b> ' . $FBdata->error_code;
                        
                        if($FBdata == null) $cff_content .= '<b>Error:</b> Server configuration issue';

                        if( empty($FBdata->error) && empty($FBdata->error_msg) && $FBdata !== null ){
                            if( $feed_options['limit'] == '0' ){
                                $cff_content .= "<b>Error:</b> Post limit setting is set to 0. Please increase the Post Limit setting on the plugin's Settings page.";
                            } else {
                                $cff_content .= '<b>Error:</b> No posts available for this Facebook ID';
                            }
                        }

                        $cff_content .= '<br /><a href="https://smashballoon.com/custom-facebook-feed/docs/errors/" target="_blank">Click here to Troubleshoot</a>.';

                        $cff_content .= '</div>'; //End #cff-error-reason
                        $cff_content .= "</div>"; //End .cff-error-msg
                        
                        //Only display errors to admins
                        if( current_user_can( 'manage_options' ) ){
                            $cff_content .= '<style>#cff .cff-error-msg{ display: block !important; }</style>';
                        }

                        if($cff_is_group){
                            $cff_content .= "<p><span class='fa fab fa-facebook-square' aria-hidden='true' style='color: #3b5998; padding-right: 5px;'></span><a href='https://www.facebook.com/groups/".$page_id."' target='_blank'>Join us on Facebook</a>";
                        }                      

                    }

                return $cff_content;
            }


            //***STARTS POSTS LOOP***
            $fbdata_string = '';

           	$is_featured_post = false;
            //If the Featured Post extension is active then adjust the loop as there is no 'data'
            if($cff_featured_post_active && !empty($feed_options['featuredpost'])){
                if( isset($FBdata) && !empty($FBdata) ) $fbdata_string = $FBdata;
            	$is_featured_post = true;
            } else {
                
                if( $cff_videos_only && isset($FBdata->videos) ){
                    //Videos only
                    $fbdata_string = $FBdata->videos->data;
                } else {
                    //All other posts
                    if( isset($FBdata->data) ) $fbdata_string = $FBdata->data;
                }                
            }

            $numeric_page_id = '';
            if( !empty($fbdata_string) && !$is_featured_post ){
                if ( ($cff_show_only_others || $show_posts_by == 'others') && count($fbdata_string) > 0 && !$cff_reviews ) {
                    //Get the numeric ID of the page so can compare it to the author of each post
                    $first_post_id = explode("_", $fbdata_string[0]->id);
                    $numeric_page_id = $first_post_id[0];
                }
            }

            if($fbdata_string){

                foreach ($fbdata_string as $news)
                {

                    if ($cff_featured_post_active && !empty($feed_options['featuredpost'])) $news = $FBdata;

                    $cff_post_item = '';

                    //Explode News and Page ID's into 2 values
                    $PostID = '';
                    if( isset($news->id) ){
                        $cff_post_id = $news->id;
                        $PostID = explode("_", $cff_post_id);
                    }
                    if( isset($PostID[0]) ) $orig_post_id = $PostID[0];
                    if( isset($PostID[1]) ) $orig_post_id .= '_' . $PostID[1];

                    //Check if it's an album embed
                    $cff_album_id = $feed_options['album'];
                    ( $cff_album_active && !empty($cff_album_id) ) ? $cff_album_embed = true : $cff_album_embed = false;


                    //Reassign variable changes from API v3.3 update if it's a timeline feed
                    // if( strlen($feed_options[ 'type' ]) > 10 ){
                    if( !$cff_albums_only && !$cff_photos_only && !$cff_videos_only && !$cff_events_only & !$cff_album_embed && !$cff_reviews ){

                        //If the type field is still set then it's still pulling from the existing cache as the new fields aren't being returned
                        if( !isset($news->type) ){

                            $news->type = '';
                            $news->link = '';
                            $news->description = '';
                            $news->name = '';
                            $news->caption = '';
                            $news->source = '';
                            $news->object_id = '';
                            if( isset($news->attachments->data[0]->media_type) ) $news->type = $news->attachments->data[0]->media_type;
                            if( isset($news->attachments->data[0]->unshimmed_url) ) $news->link = $news->attachments->data[0]->unshimmed_url;
                            if( isset($news->attachments->data[0]->description) ) $news->description = $news->attachments->data[0]->description;
                            if( isset($news->attachments->data[0]->target->id) ) $news->object_id = $news->attachments->data[0]->target->id;
                            if( isset($news->attachments->data[0]->media->source) ) $news->source = $news->attachments->data[0]->media->source;
                            if( isset($news->attachments->data[0]->title) ){
                                $news->name = $news->attachments->data[0]->title;
                                $news->caption = $news->attachments->data[0]->title;
                            }

                        }

                    }

                    //Object ID
                    ( !empty($news->object_id) ) ? $object_id = $news->object_id : $object_id = '';

                    //Check the post type
                    $cff_post_type = 'status';
                    if( isset($news->type) ) $cff_post_type = $news->type;
                    if( isset($news->attachments->data[0]->media_type) ) $cff_post_type = $news->attachments->data[0]->media_type;

                    if ($cff_post_type == 'link') {
                        isset($news->story) ? $story = htmlentities($news->story, ENT_QUOTES, 'UTF-8') : $story = '';
                        //Check whether it's an event
                        $event_link_check = "facebook.com/events/";
                        //Make sure URL doesn't include 'permalink' as that indicates someone else sharing a post from within an event (eg: https://www.facebook.com/events/617323338414282/permalink/617324268414189/) and the event ID is then not retrieved properly from the event URL as it's formatted like so: facebook.com/events/EVENT_ID/permalink/POST_ID
                        if( isset($news->link) ){
                            $event_link_check = stripos($news->link, $event_link_check);
                            $event_link_check_2 = stripos($news->link, "permalink/");
                            if ( $event_link_check && !$event_link_check_2 ) $cff_post_type = 'event';
                        }
                    }

                    //Set the post link
                    isset($news->link) ? $link = htmlspecialchars($news->link) : $link = '';

                    //If there's no link provided then link to the individual post
                    if (empty($news->link)) {
                        //Link to individual post
                        if( isset($PostID[1]) ) $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                    }

                    //If it's an event then check whether the URL contains facebook.com
                    if(isset($news->link)){
                        if( stripos($news->link, "events/") && $cff_post_type == 'event' ){
                            //Facebook changed the event link from absolute to relative, and so if the link isn't absolute then add facebook.com to front
                            ( stripos($link, 'facebook.com') ) ? $link = $link : $link = 'https://facebook.com' . $link;
                        }
                    }

                    //Is it an album?
                    $cff_album = false;
                    $num_photos = 0;

                    //The album check has to be done this way as checking for attachments/subattachments doesn't work as the posts which have the wrong posts IDs (the album ID instead of the post ID - see Facebook bug report) don't have any post attachments in the API even though they do on Facebook. (Changed in v3.9.1 to use subattachments rather than number in post).
                    if( !isset($news->type) ) $news->type = '';
                    if( isset($news->status_type) ){

                        if( $news->type == 'album' ){

                            //If it's an "added_photos" post or if it's a photo post with subattachments (eg: a shared post which has multiple photos)
                            if( $news->status_type == 'added_photos' || $news->type == 'album' || ($news->type == 'photo' && isset( $news->attachments->data[0]->subattachments )) ){

                                //If it's a group post with attachments, or if the story doesn't contain a number but it has subattachments (eg: a shared post which has multiple photos)
                                if ( isset( $news->attachments->data[0]->subattachments ) ) {

                                    //... and the link is to an album then it most likely has photo attachments
                                    if (strpos($link,'photos/a.') !== false || $news->type == 'album'){
                                        $albumLinkArr1 = explode('photos/a.', $link);
                                        if( isset($albumLinkArr1[1]) ){
                                            //If it contains a dot then use that
                                            if (strpos($albumLinkArr1[1], '.') !== false){
                                                $albumLinkArr2 = explode('.', $albumLinkArr1[1]);
                                            }
                                            //Some posts use this format: album_id/post_id/?type=3 so check for this to get the post ID
                                            //Eg: https://www.facebook.com/352519381830075/photos/a.365472027201477/580676195681058/?type=3
                                            if (strpos($albumLinkArr1[1], '/') !== false){
                                                $albumLinkArr2 = explode('/', $albumLinkArr1[1]);
                                                if( count($albumLinkArr2) > 1 ){
                                                    if( is_numeric( intval($albumLinkArr2[1]) ) ) array_shift($albumLinkArr2);
                                                }
                                            }
                                        }

                                        //If it has an album link then set the post type to be album
                                        if( isset($albumLinkArr1[1]) || $news->type == 'album' ){

                                            $cff_album = true;

                                            //If the post has subattachments then don't change the post ID to the album ID. If it doesn't then change it to the album ID so that we can at least show the photos from the album
                                            if( !isset($news->attachments) ){
                                                //Change the Post ID to be to the post about adding photos to the album
                                                $cff_post_id = $PostID[0] . '_' . $albumLinkArr2[0];
                                            }

                                            //Link to the album instead of the photo
                                            $album_link = str_replace('photo.php?','media/set/?',$link);
                                            $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                                            //If the album link is a new format then link it to the post
                                            $album_link_check = 'media/set/?';
                                            if( stripos($album_link, $album_link_check) !== true ) $album_link = $link;

                                        }
                                    }
                                }
                            }

                        }

                    }


                    //Should we show this post or not?
                    $cff_show_post = false;

                    switch ($cff_post_type) {
                        case 'link':
                            if ( $cff_show_links_type ) $cff_show_post = true;
                            break;
                        case 'event':
                            if ( $cff_show_event_type ) $cff_show_post = true;
                            break;
                        case 'video':
                             if ( $cff_show_video_type ) $cff_show_post = true;
                            break;
                        case 'swf':
                             if ( $cff_show_video_type ) $cff_show_post = true;
                            break;
                        case 'photo':
                        case 'album':
                             if ( $cff_show_photos_type && !$cff_album ) $cff_show_post = true;
                             if ( $cff_show_albums_type && $cff_album ) $cff_show_post = true;
                            break;
                        case 'offer':
                            //Show offer posts if links are shown
                             if ( $cff_show_links_type ) $cff_show_post = true;
                            break;
                        case 'music':
                            //Show music posts if statuses are shown
                             if ( $cff_show_status_type ) $cff_show_post = true;
                            break;
                        default:
                            //Check whether it's a status (author comment or like)
                            if ( $cff_show_status_type && ( !empty($news->message) || isset($news->call_to_action->type) ) ){
                                //Only show the post if it has post text or a call to action button (eg: job posting)
                                $cff_show_post = true;
                            }
                            break;
                    }
                    //Featured Post extension
                    if( $cff_featured_post_active && !empty($feed_options['featuredpost']) ) {
                        //Always show the post if using the Featured Post extension
                        $cff_show_post = true;

                        if( $cff_show_links_type ) $cff_post_type = 'link';
                        if( $cff_show_event_type ) $cff_post_type = 'event';
                        if( $cff_show_video_type ) $cff_post_type = 'video';
                        if( $cff_show_photos_type ) $cff_post_type = 'photo';
                        if( $cff_show_albums_type ) $cff_post_type = 'album';
                        if( $cff_show_status_type ) $cff_post_type = 'status';

                        //If it's a status then use full-width layout by default
                        if($cff_post_type == 'status') {
                            $cff_thumb_layout = false;
                            $cff_half_layout = false;
                        }
                    }

                    //Only show posts containing specified string
                    //Get post text
                    $post_text = '';
                    if (!empty($news->story)) $post_text = $news->story;
                    if (!empty($news->message)) $post_text = $news->message;
                    if (!empty($news->name) && empty($news->story) && empty($news->message)) $post_text = $news->name;

                    //Get description text
                    if( isset($news->description) ){
                        $description_text = $news->description;
                    } else {
                        isset( $news->caption ) ? $description_text = $news->caption : $description_text = '';
                    }

                    //Get the filter string
                    $cff_filter_string = $feed_options[ 'filter' ];

                    if ( $cff_filter_string != '' ){
                        //Explode it into multiples
                        $cff_filter_strings_array = explode(',', $cff_filter_string);
                        //Hide the post if both the post text and description don't contain the string
                        $string_in_post_text = true;
                        $string_in_desc = true;

                        $cff_text_to_be_filtered = '';
                        (!empty($news->story)) ? $cff_text_to_be_filtered = $news->story . ' ' . $post_text : $cff_text_to_be_filtered = $post_text;
                        (!empty($news->name)) ? $cff_text_to_be_filtered .= ' ' . $news->name : false;

                        if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_filter_strings_array) === false ) $string_in_post_text = false;
                        if ( cff_stripos_arr_filter($description_text, $cff_filter_strings_array) === false ) $string_in_desc = false;

                        if( $string_in_post_text == false && $string_in_desc == false ) $cff_show_post = false;
                    }

                    $cff_exclude_string = $feed_options[ 'exfilter' ];
                    if ( $cff_exclude_string != '' ){
                        //Explode it into multiples
                        $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                        //Hide the post if both the post text and description don't contain the string
                        $string_in_post_text = false;
                        $string_in_desc = false;

                        $cff_text_to_be_filtered = '';
                        (!empty($news->story)) ? $cff_text_to_be_filtered = $news->story . ' ' . $post_text : $cff_text_to_be_filtered = $post_text;
                        (!empty($news->name)) ? $cff_text_to_be_filtered .= ' ' . $news->name : false;

                        if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_exclude_strings_array) !== false ) $string_in_post_text = true;
                        if ( cff_stripos_arr_filter($description_text, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                        if( $string_in_post_text == true || $string_in_desc == true ) $cff_show_post = false;
                    }

                    //Encode after the filtering is done to prevent special characters not working in the filtering
                    $post_text = htmlentities($post_text, ENT_QUOTES, 'UTF-8');
                    $description_text = htmlentities($description_text, ENT_QUOTES, 'UTF-8');


                    //Is it a duplicate post?
                    if (!isset($prev_post_message)) $prev_post_message = '';
                    if (!isset($prev_post_link)) $prev_post_link = '';
                    if (!isset($prev_post_description)) $prev_post_description = '';
                    isset($news->message) ? $pm = $news->message : $pm = '';
                    isset($news->link) ? $pl = $news->link : $pl = '';
                    isset($news->description) ? $pd = $news->description : $pd = '';

                    if ( ($prev_post_message == $pm) && ($prev_post_link == $pl) && ($prev_post_description == $pd) && !isset($news->call_to_action->type) ) $cff_show_post = false;

                    //ALBUMS ONLY
                    if($cff_albums_only && $cff_albums_source == 'photospage') $cff_show_post = true;

                    //ALBUM EMBED
                    if( $cff_album_active && !empty($cff_album_id) ) $cff_show_post = true;

                    //PHOTOS ONLY
                    if($cff_photos_only) $cff_show_post = true;

                    //VIDEOS ONLY
                    if($cff_videos_only) $cff_show_post = true;

                    //REVIEWS
                    if($cff_reviews) $cff_show_post = true;

                    //Check post type and display post if selected
                    if ( $cff_show_post ) {
                        //If it isn't then create the post

                        $cff_offset_show_post = true;
                        //Offset. If the post index ($i) is less than the offset then don't show the post
                        if( intval($i) < intval($feed_options['offset']) ){
                            $cff_offset_show_post = false;
                            $i++;
                        }

                        //If there's an offset then show the post until it's set to false above. This has been moved here so that the offset works correctly when only displaying specific post types, as previously it only worked accurately when all posts were shown
                        if($cff_offset_show_post){

                            if( !$cff_ext_multifeed_active && !$show_all_reviews ){
                                //Only create posts for the amount of posts specified
                                if( intval($feed_options['offset']) > 0 ){
                                    //If offset is being used then stop after showing the number of posts + the offset
                                    if ( $i == (intval($show_posts) + intval($feed_options['offset'])) ) break;
                                } else {
                                    //Else just stop after the number of posts to be displayed is reached, unless it's albums only or photos only
                                    if( ($cff_albums_only && $cff_albums_source == 'photospage') || ( $cff_photos_only && empty($cff_album_id) ) || $cff_videos_only ){
                                        //Keep going
                                    } else {
                                        if ( $i == $show_posts ) break;
                                    }
                                    
                                }
                            }
                            $i++;

                            
                            //********************************//
                            //***COMPILE SECTION VARIABLES***//
                            //********************************//
                            //Change image size based on layout
                            if (!empty($news->picture) && !empty($news->object_id)) {
                                $picture = 'https://graph.facebook.com/'.$object_id.'/picture?type=normal&amp;width=9999&amp;height=9999';
                            }

                            //DATE
                            $cff_date_formatting = $feed_options[ 'dateformat' ];
                            $cff_date_custom = $feed_options[ 'datecustom' ];

                            isset($news->created_time) ? $post_time = $news->created_time : $post_time = '';
                            if( isset($news->backdated_time) ) $post_time = $news->backdated_time; //If the post is backdated then use that as the date instead



                            $cff_post_date = cff_getdate(strtotime($post_time), $cff_date_formatting, $cff_date_custom, $cff_date_translate_strings);
                            $cff_date = '<p class="cff-date';
                            if( $cff_date_position == 'below' || ($cff_date_position == 'author' && !$cff_show_author) ) $cff_date .= ' cff-date-below';
                            $cff_date .= '" '.$cff_date_styles.'>'. $cff_date_before . ' ' . $cff_post_date . ' ' . $cff_date_after;
                            $cff_date .= '</p>';

                            //Page name and date for lightbox sidebar
                            if( isset($news->from->name) ){
                                $cff_author_name = htmlentities($news->from->name, ENT_QUOTES, 'UTF-8');
                                $cff_author_name = str_replace('"', "", $cff_author_name);
                            } else {
                                $cff_author_name = '';
                            }
                            $cff_post_date = str_replace('"', "", $cff_post_date);
                            $cff_lightbox_sidebar_atts = ' data-cff-page-name="'.$cff_author_name.'" data-cff-post-time="'.$cff_post_date.'"';

                            //Only run if NOT only showing photos from the photos page, or albums, or an album embed
                            if( !$cff_photos_only && !$cff_videos_only && !($cff_albums_only && $cff_albums_source == 'photospage') && empty($cff_album_id) && !$cff_reviews ){

                                //Story/post text vars
                                $post_text = '';
                                $cff_post_text_type = '';
                                $cff_story_raw = '';
                                $cff_message_raw = '';
                                $cff_name_raw = '';
                                $text_tags = '';
                                $post_text_story = '';
                                $post_text_message = '';

                                //STORY TAGS
                                $cff_post_tags = $feed_options[ 'posttags' ];

                                //Use the story
                                if (!empty($news->story)) {
                                    $cff_story_raw = $news->story;
                                    $post_text_story .= htmlspecialchars($cff_story_raw);
                                    $cff_post_text_type = 'story';


                                    //Add message and story tags if there are any and the post text is the message or the story
                                    if( $cff_post_tags && isset($news->story_tags) && !$cff_title_link){
                                        
                                        $text_tags = $news->story_tags;

                                        //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                                        $cff_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;', '&gt;&gt;');

                                        //Use the text replace method if contains chars above. Also, to fix a weird Greek language issues when there are more than 3 story tags.
                                        if( cff_stripos_arr($post_text_story, $cff_html_check_array) !== false || ($cff_locale == 'el_GR' && count($news->story_tags) > 3) ) {

                                            //Loop through the tags
                                            foreach($text_tags as $message_tag ) {

                                                ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                                $tag_name = $message_tag->name;
                                                $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '">' . $message_tag->name . '</a>';

                                                $post_text_story = str_replace($tag_name, $tag_link, $post_text_story);
                                            }

                                        } else {

                                            //If it doesn't contain HTMl tags then use the offset to replace message tags
                                            $message_tags_arr = array();

                                            $tag = 0;
                                            foreach($text_tags as $message_tag ) {
                                                $tag++;
                                                ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                                isset($message_tag->type) ? $tag_type = $message_tag->type : $tag_type = '';

                                                $message_tags_arr = cff_array_push_assoc(
                                                    $message_tags_arr,
                                                    $tag,
                                                    array(
                                                        'id' => $message_tag->id,
                                                        'name' => $message_tag->name,
                                                        'type' => isset($message_tag->type) ? $message_tag->type : '',
                                                        'offset' => $message_tag->offset,
                                                        'length' => $message_tag->length
                                                    )
                                                );
                                                
                                            }

                                            //Keep track of the offsets so that if two tags have the same offset then only one is used. Need this as API 2.5 update changed the story_tag JSON format. A duplicate offset usually means '__ was with __ and 3 others'. We don't want to link the '3 others' part.
                                            $cff_story_tag_offsets = '';
                                            $cff_story_duplicate_offset = '';

                                            //Check if there are any duplicate offsets. If so, assign to the cff_story_duplicate_offset var.
                                            for($tag = count($message_tags_arr); $tag >= 1; $tag--) {
                                                $c = (string)$message_tags_arr[$tag]['offset'];
                                                if( strpos( $cff_story_tag_offsets, $c ) !== false && $c !== '0' ){
                                                    $cff_story_duplicate_offset = $c;
                                                } else {
                                                    $cff_story_tag_offsets .= $c . ',';  
                                                }
                                                                                          
                                            }

                                            for($tag = count($message_tags_arr); $tag >= 1; $tag--) {

                                                //If the name is blank (aka the story tag doesn't work properly) then don't use it
                                                if( $message_tags_arr[$tag]['name'] !== '' ) {

                                                    //If it's an event tag or it has the same offset as another tag then don't display it
                                                    if( $message_tags_arr[$tag]['type'] == 'event' || $message_tags_arr[$tag]['offset'] == $cff_story_duplicate_offset || $message_tags_arr[$tag]['type'] == 'page' ){
                                                        //Don't use the story tag in this case otherwise it changes '__ created an event' to '__ created an Name Of Event'
                                                        //Don't use the story tag if it's a page as it causes an issue when sharing a page: Smash Balloon Dev shared a Smash Balloon.
                                                    } else {
                                                        $b = '<a href="https://facebook.com/' . $message_tags_arr[$tag]['id'] . '" target="_blank">' . $message_tags_arr[$tag]['name'] . '</a>';
                                                        $c = $message_tags_arr[$tag]['offset'];
                                                        $d = $message_tags_arr[$tag]['length'];
                                                        $post_text_story = cff_mb_substr_replace( $post_text_story, $b, $c, $d);
                                                    }

                                                }

                                            }
                                            

                                        } // end if/else


                                    } //END STORY TAGS


                                }


                                //POST AUTHOR
                                $cff_author = '';
                                if( isset($news->from->id) ){

                                    $cff_author .= '<div class="cff-author">';

                                    //Check if the author from ID exists, as sometimes it doesn't
                                    isset($news->from->id) ? $cff_from_id = $news->from->id : $cff_from_id = '';
                                    
                                    $cff_author_link_atts = 'href="https://facebook.com/' . $cff_from_id . '" '.$target.$cff_nofollow.' '.$cff_author_styles;

                                    //Link to the post if it's a visitor post as profile link no longer available
                                    $cff_author_link_el = 'a';
                                    $cff_author_link_atts = ' href="https://facebook.com/' . $cff_from_id . '" '.$target.$cff_nofollow.' '.$cff_author_styles;

                                    //If no link is available then change to span
                                    if( !isset($news->from->link) ){
                                        $cff_author_link_el = 'span';
                                        $cff_author_link_atts = '';
                                    }

                                    //Remove the first occurence of the author name from the story
                                    if( !empty($cff_author_name) ){
                                        $cff_author_name_pos = strpos($post_text_story, $cff_author_name);
                                        if ($cff_author_name_pos !== false) {
                                            $post_text_story = substr_replace($post_text_story, '', $cff_author_name_pos, strlen($cff_author_name));
                                        }
                                    }
                                    
                                    //Author text
                                    $cff_author .= '<div class="cff-author-text">';
                                    if($cff_show_date && $cff_date_position !== 'above' && $cff_date_position !== 'below'){
                                        $cff_author .= '<p class="cff-page-name cff-author-date" '.$cff_author_styles.'><'.$cff_author_link_el.$cff_author_link_atts.'>'.$cff_author_name.'</'.$cff_author_link_el.'><span class="cff-story"> '.$post_text_story.'</span></p>';
                                        $cff_author .= $cff_date;
                                    } else {
                                        $cff_author .= '<span class="cff-page-name"><'.$cff_author_link_el.$cff_author_link_atts.'>'.$cff_author_name.'</'.$cff_author_link_el.'><span class="cff-story"> '.$post_text_story.'</span></span>';
                                    }

                                    $cff_author .= '</div>';

                                    //Author image
                                    isset($news->from->picture->data->url) ? $cff_author_src = $news->from->picture->data->url : $cff_author_src = '';

                                    $cff_author .= '<div class="cff-author-img"><'.$cff_author_link_el.$cff_author_link_atts.'><img src="'.$cff_author_src.'" title="'.$cff_author_name.'" alt="'.$cff_author_name.'" width=40 height=40 onerror="this.style.display=\'none\'"></'.$cff_author_link_el.'></div>';

                                    $cff_author .= '</div>'; //End .cff-author

                                } else {

                                    $cff_author .= '<div class="cff-author cff-no-author-info">';
                                                    
                                    //Author text
                                    $cff_author .= '<div class="cff-author-text">';
                                    if($cff_show_date && $cff_date_position !== 'above' && $cff_date_position !== 'below'){
                                        if( !empty($post_text_story) ) $cff_author .= '<p class="cff-page-name cff-author-date"><span class="cff-story"> '.$post_text_story.'</span></p>';
                                        $cff_author .= $cff_date;
                                    } else {
                                        if( !empty($post_text_story) ) $cff_author .= '<span class="cff-page-name"><span class="cff-story"> '.$post_text_story.'</span></span>';
                                    }
                                    $cff_author .= '</div>';

                                    //Author image
                                    $cff_author .= '<div class="cff-author-img"></div>';
                                    $cff_author .= '</div>'; //End .cff-author

                                }


                                //POST TEXT
                                $cff_post_text = '<' . $cff_title_format . ' class="cff-post-text" ' . $cff_title_styles . '>';
                                
                                //Get the actual post text
                                //Which content should we use?
                                //Use the message
                                if (!empty($news->message)) {
                                    $cff_message_raw = $news->message;
                                    
                                    $post_text_message = htmlspecialchars($cff_message_raw);
                                    $cff_post_text_type = 'message';

                                    //MESSAGE TAGS
                                    //Add message and story tags if there are any and the post text is the message or the story
                                    if( $cff_post_tags && isset($news->message_tags) && !$cff_title_link){
                                        
                                        $text_tags = $news->message_tags;

                                        //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                                        $cff_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;', '&gt;&gt;', '&gt;');

                                        //always use the text replace method
                                        if( cff_stripos_arr($post_text_message, $cff_html_check_array) !== false ) {
                                            //Loop through the tags
                                            foreach($text_tags as $message_tag ) {

                                                ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                                $tag_name = $message_tag->name;
                                                $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '">' . $message_tag->name . '</a>';

                                                $post_text_message = str_replace($tag_name, $tag_link, $post_text_message);
                                            }

                                        } else {
                                        //If it doesn't contain HTMl tags then use the offset to replace message tags
                                            $message_tags_arr = array();

                                            $tag = 0;
                                            foreach($text_tags as $message_tag ) {

                                                $tag++;

                                                ( isset($message_tag->id) ) ? $message_tag = $message_tag : $message_tag = $message_tag[0];

                                                $message_tags_arr = cff_array_push_assoc(
                                                    $message_tags_arr,
                                                    $tag,
                                                    array(
                                                        'id' => $message_tag->id,
                                                        'name' => $message_tag->name,
                                                        'type' => isset($message_tag->type) ? $message_tag->type : '',
                                                        'offset' => $message_tag->offset,
                                                        'length' => $message_tag->length
                                                    )
                                                );
                                            }

                                            //Keep track of the offsets so that if two tags have the same offset then only one is used. Need this as API 2.5 update changed the story_tag JSON format.
                                            $cff_msg_tag_offsets = '';
                                            $cff_msg_duplicate_offset = '';

                                            //Check if there are any duplicate offsets. If so, assign to the cff_duplicate_offset var.
                                            for($tag = count($message_tags_arr); $tag >= 1; $tag--) {
                                                $c = (string)$message_tags_arr[$tag]['offset'];
                                                if( strpos( $cff_msg_tag_offsets, $c ) !== false && $c !== '0' ){
                                                    $cff_msg_duplicate_offset = $c;
                                                } else {
                                                    $cff_msg_tag_offsets .= $c . ',';  
                                                }
                                            }

                                            for($tag = count($message_tags_arr); $tag >= 1; $tag--) {

                                                //If the name is blank (aka the story tag doesn't work properly) then don't use it
                                                if( $message_tags_arr[$tag]['name'] !== '' ) {

                                                    if( $message_tags_arr[$tag]['offset'] == $cff_msg_duplicate_offset ){
                                                        //If it has the same offset as another tag then don't display it
                                                    } else {
                                                        $b = '<a href="https://facebook.com/' . $message_tags_arr[$tag]['id'] . '">' . $message_tags_arr[$tag]['name'] . '</a>';
                                                        $c = $message_tags_arr[$tag]['offset'];
                                                        $d = $message_tags_arr[$tag]['length'];
                                                        $post_text_message = cff_mb_substr_replace( $post_text_message, $b, $c, $d);
                                                    }

                                                }

                                            }   

                                        } // end if/else

                                    } //END MESSAGE TAGS

                                }


                                //Check to see whether it's an embedded video so that we can show the name above the post text if necessary
                                $cff_soundcloud = false;
                                $cff_spotify = false;
                                $cff_is_video_embed = false;
                                if ($cff_post_type == 'video' || $cff_post_type == 'music' || $cff_post_type == 'link'){
                                    if( isset($news->source) && !empty($news->source) ){
                                        $url = $news->source;
                                    } else if ( isset($news->link) ) {
                                        $url = $news->link;
                                    } else {
                                        $url = '';
                                    }
                                    //Embeddable video strings
                                    $youtube = 'youtube';
                                    $youtu = 'youtu';
                                    $vimeo = 'vimeo';
                                    $youtubeembed = 'youtube.com/embed';
                                    $soundcloud = 'soundcloud.com';
                                    $spotify = 'spotify.com';
                                    $swf = '.swf';
                                    //Check whether it's a youtube video
                                    $youtube = stripos($url, $youtube);
                                    $youtu = stripos($url, $youtu);
                                    $youtubeembed = stripos($url, $youtubeembed);
                                    //Check whether it's a SoundCloud embed
                                    $soundcloudembed = stripos($url, $soundcloud);
                                    //Check whether it's a SoundCloud embed
                                    $spotifyembed = stripos($url, $spotify);
                                    //Check whether it's a youtube video
                                    if($youtube || $youtu || $youtubeembed || (stripos($url, $vimeo) !== false)) {
                                        $cff_is_video_embed = true;
                                    }
                                    //If it's soundcloud then add it into the shared link box at the bottom of the post
                                    if( $soundcloudembed ) $cff_soundcloud = true;
                                    if( $spotifyembed ) $cff_spotify = true;

                                    $cff_video_name = '';
                                    //If the name exists and it's a non-embedded video then show the name at the top of the post text
                                    if( $cff_post_type == 'video' && isset($news->name) && !$cff_is_video_embed ){

                                        $cff_posttext_link_color_html = '';
                                        if( isset($cff_posttext_link_color) && !empty($cff_posttext_link_color) && $cff_posttext_link_color != '#' ) $cff_posttext_link_color_html = 'style="color: #'.$cff_posttext_link_color.'"';
                                        if (!$cff_title_link) $cff_video_name .= '<a href="'.$link.'" '.$target.$cff_nofollow.' '.$cff_posttext_link_color_html.'>';
                                        $cff_video_name .= htmlspecialchars($news->name);
                                        if (!$cff_title_link) $cff_video_name .= '</a>';
                                        $cff_video_name .= '<br />';

                                        //Only show the video name if there's no post text
                                        if( empty($post_text_message) || $post_text_message == '' || strlen($post_text_message) < 1 ){

                                            //If there's no description then show the video name above the post text, otherwise we'll show it below
                                            if( empty($cff_description) || $cff_description == '' ) $post_text = $cff_video_name;

                                        }
                                    }
                                }

                                //Add the story and message together
                                $post_text = '';

                                //DESCRIPTION
                                $cff_description = '';
                                if ( !empty($news->description) || !empty($news->caption) ) {
                                    $description_text = '';

                                    if ( !empty($news->description) ) {
                                        $description_text = $news->description;
                                    }

                                    //If the description is the same as the post text then don't show it
                                    if( $description_text ==  $cff_story_raw || $description_text ==  $cff_message_raw || $description_text ==  $cff_name_raw ){
                                        $cff_description = '';
                                    } else {
                                        //Add links and create HTML
                                        $cff_description .= '<span class="cff-post-desc" '.$cff_body_styles.'>';

                                        if ($cff_title_link) {
                                            $cff_description_tagged = cff_wrap_span( $description_text );
                                        } else {
                                            $cff_description_text = cff_autolink( $description_text, $link_color=$cff_posttext_link_color );
                                            $cff_description_tagged = cff_desc_tags($cff_description_text);
                                        }
                                        $cff_description .= $cff_description_tagged;
                                        $cff_description .= ' </span>';
                                    }
                                    
                                    if( $cff_post_type == 'event' || $cff_is_video_embed || $cff_soundcloud || $cff_spotify ) $cff_description = '';
                                }

                                //Add the message
                                if($cff_show_text) $post_text .= $post_text_message;

                                //If it's a shared video post then add the video name after the post text above the video description so it's all one chunk
                                if ($news->type == 'video'){
                                    if( !empty($cff_description) && $cff_description != '' ){
                                        if( (!empty($post_text) && $post_text != '') && !empty($cff_video_name) ) $post_text .= '<br /><br />';
                                        $post_text .= $cff_video_name;
                                    }
                                }


                                //Use the name
                                if (!empty($news->name) && empty($news->story) && empty($news->message)) {
                                    $cff_name_raw = $news->name;
                                    $post_text = htmlspecialchars($cff_name_raw);
                                    $cff_post_text_type = 'name';
                                }

                                //OFFER TEXT
                                if ($cff_post_type == 'offer'){
                                    isset($news->story) ? $post_text = htmlspecialchars($news->story) . '<br /><br />' : $post_text = '';
                                    $post_text .= htmlspecialchars($news->name);
                                    $cff_post_text_type = 'story';
                                }

                                //Add the description
                                if( $cff_show_desc && $cff_post_type != 'offer' && $cff_post_type != 'link' ) $post_text .= $cff_description;

                                //Change the linebreak element if the text issue setting is enabled
                                $cff_format_issue = $feed_options['textissue'];
                                ($cff_format_issue == 'true' || $cff_format_issue == 'on') ? $cff_format_issue = true : $cff_format_issue = false;

                                $cff_linebreak_el = '<br />';
                                if( $cff_format_issue ) $cff_linebreak_el = '<img class="cff-linebreak" />';


                                //EVENT
                                $cff_event_has_cover_photo = false;
                                $cff_event = '';

                                if ($cff_show_event_title || $cff_show_event_details) {
                                    //Check for media
                                    if ($cff_post_type == 'event') {

                                        //Get the event id from the event URL. eg: http://www.facebook.com/events/123451234512345/
                                        $event_url = parse_url($link);
                                        $url_parts = explode('/', $event_url['path']);
                                        //Get the id from the parts
                                        $eventID = $url_parts[count($url_parts)-2];
                                        
                                        //Facebook changed the event link from absolute to relative, and so if the link isn't absolute then add facebook.com to front
                                        ( stripos($link, 'facebook.com') ) ? $link = $link : $link = 'https://facebook.com' . $link;

                                        //Is it SSL?
                                        $cff_ssl = '';
                                        if (is_ssl()) $cff_ssl = '&return_ssl_resources=true';

                                        //Get the contents of the event
                                        $event_json_url = 'https://graph.facebook.com/v3.3/'.$eventID.'?fields=cover,place,name,owner,start_time,timezone,id,comments.summary(true){message,created_time}&access_token=' . $access_token . $cff_ssl;
                                        
                                        // Get any existing copy of our transient data
                                        $transient_name = 'cff_tle_' . $eventID;
                                        $transient_name = substr($transient_name, 0, 45);

                                        if ( false === ( $event_json = get_transient( $transient_name ) ) || $event_json === null ) {
                                            //Get the contents of the Facebook page
                                            $event_json = cff_fetchUrl($event_json_url);
                                            //Cache the JSON for 180 days as the timeline event info probably isn't going to change
                                            set_transient( $transient_name, $event_json, 60 * 60 * 24 * 180 );
                                        } else {
                                            $event_json = get_transient( $transient_name );
                                            //If we can't find the transient then fall back to just getting the json from the api
                                            if ($event_json == false) $event_json = cff_fetchUrl($event_json_url);
                                        }

                                        //Interpret data with JSON
                                        $event_object = json_decode($event_json);
                                        //Picture
                                        if( isset($event_object->cover) ){
                                            $cff_timeline_event_image = $event_object->cover->source;
                                            $cff_event_has_cover_photo = true;
                                        } else {
                                            $cff_timeline_event_image = false;
                                        }

                                        $cff_timeline_event_photo = '';
                                        if($cff_show_media && $cff_timeline_event_image){

                                            //Fix Photon (Jetpack) issue
                                            $cff_picture_querystring = '';
                                            if (parse_url($cff_timeline_event_image, PHP_URL_QUERY)){
                                                $picture_url_parts = parse_url($cff_timeline_event_image);
                                                $cff_picture_querystring = $picture_url_parts['query'];
                                            }

                                            //Remove any quotes from event name to use in the image alt tag
                                            (!empty($event_object->name)) ? $cff_event_title = $event_object->name : $cff_event_title = '';
                                            $cff_event_title = str_replace('"', "", $cff_event_title);
                                            $cff_event_title = str_replace("'", "", $cff_event_title);

                                            //Alt text
                                            isset( $cff_event_title ) ? $cff_alt_text = strip_tags($cff_event_title) : $cff_alt_text = $cff_facebook_link_text;

                                            $cff_timeline_event_photo .= '<div class="cff-media-wrap">';
                                            $cff_timeline_event_photo .= '<a title="'.$cff_facebook_link_text.'" class="cff-event-thumb';
                                            if($cff_event_has_cover_photo) $cff_timeline_event_photo .= ' cff-has-cover';
                                            $cff_timeline_event_photo .= ' nofancybox" href="'.$link.'" '.$target.$cff_nofollow.$cff_lightbox_sidebar_atts.'><img src="'.$cff_timeline_event_image.'" alt="'.$cff_alt_text.'" data-querystring="'.$cff_picture_querystring.'" /></a>';
                                            $cff_timeline_event_photo .= '</div>';
                                        }

                                        //Event date
                                        isset($event_object->start_time)? $event_time = $event_object->start_time : $event_time = '';
                                        isset($event_object->end_time) ? $event_end_time = ' - <span class="cff-end-date">' . cff_eventdate(strtotime($event_object->end_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>' : $event_end_time = '';
                                        //If timezone migration is enabled then remove last 5 characters
                                        if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
                                        $cff_event_date = '';
                                        if (!empty($event_time)) $cff_event_date = '<span class="cff-date" '.$cff_event_date_styles.'><span class="cff-start-date">' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . '</span>' . $event_end_time.'</span>';

                                        //EVENT
                                        //Display the event details
                                        $cff_event .= '<span class="cff-details';
                                        if($cff_event_has_cover_photo) $cff_event .= ' cff-has-cover';
                                        $cff_event .= '">';
                                        //show event date above title
                                        if ($cff_event_date_position == 'above') $cff_event .= $cff_event_date;
                                        //Show event title
                                        if ($cff_show_event_title && !empty($event_object->name)) {
                                            $cff_event .= '<span class="cff-timeline-event-title" ' . $cff_event_title_styles . '>';
                                            if ($cff_event_title_link) $cff_event .= '<a href="'.$link.'" '.$target.$cff_nofollow.'>';
                                            $cff_event .= $event_object->name;
                                            if ($cff_event_title_link) $cff_event .= '</a>';
                                            $cff_event .= '</span>';
                                        }
                                        //show event date below title
                                        if ($cff_event_date_position !== 'above') $cff_event .= $cff_event_date;
                                        //Show event details
                                        if ($cff_show_event_details){
                                            //Location
                                            if (!empty($event_object->place->name)) $cff_event .= '<span class="cff-where" ' . $cff_event_details_styles . '>' . $event_object->place->name . '</span>';
                                            //Description
                                            if (!empty($news->message)){

                                                $description_safe = htmlentities($news->message, ENT_QUOTES, 'UTF-8');
                                                $description = cff_autolink($description_safe, $link_color=$cff_event_link_color);
                                                $cff_description_tagged = cff_desc_tags($description);

                                                //If the post test and the event description are the same then don't show the post text otherwise it's shown twice
                                            	if( $post_text == $cff_description_tagged ) $post_text = '';

                                                $cff_event .= '<span class="cff-info" ' . $cff_event_details_styles . '>' . $cff_description_tagged . '</span>';

                                            }
                                        }
                                        $cff_event .= '</span>';

                                        //Add event to post text so it can be included in the char count
                                        if( !empty($post_text) && $post_text != '' ) $post_text .= $cff_linebreak_el.$cff_linebreak_el;
                                        $post_text .= $cff_event;
                                        
                                    }
                                    
                                }


                                //Create note
                                if ($cff_post_type == 'note') {

                                    // Get any existing copy of our transient data
                                    $transient_name = 'cff_tle_' . $cff_post_id;
                                    $transient_name = substr($transient_name, 0, 45);

                                    if ( false !== ( $cff_note_json = get_transient( $transient_name ) ) ) {
                                        $cff_note_json = get_transient( $transient_name );

                                        //Interpret data with JSON
                                        $cff_note_obj = json_decode($cff_note_json);
                                        $cff_note_object = $cff_note_obj->attachments->data[0];
                                        isset($cff_note_object->title) ? $cff_note_title = htmlentities($cff_note_object->title, ENT_QUOTES, 'UTF-8') : $cff_note_title = '';
                                        isset($cff_note_object->description) ? $cff_note_description = htmlentities($cff_note_object->description, ENT_QUOTES, 'UTF-8') : $cff_note_description = '';
                                        isset($cff_note_object->url) ? $cff_note_link = $cff_note_object->url : $cff_note_link = '';
                                        isset( $cff_note_object->media->image->src ) ? $cff_note_media_src = $cff_note_object->media->image->src : $cff_note_media_src = false;
                                    } else {
                                        $attachment_data = '';
                                        if(isset($news->attachments->data[0])){
                                            $attachment_data = $news->attachments->data[0];
                                            isset($attachment_data->title) ? $cff_note_title = htmlentities($attachment_data->title, ENT_QUOTES, 'UTF-8') : $cff_note_title = '';
                                            isset($attachment_data->description) ? $cff_note_description = htmlentities($attachment_data->description, ENT_QUOTES, 'UTF-8') : $cff_note_description = '';
                                            isset($attachment_data->unshimmed_url) ? $cff_note_link = $attachment_data->unshimmed_url : $cff_note_link = '';
                                            isset($attachment_data->media->image->src) ? $cff_note_media_src = $attachment_data->media->image->src : $cff_note_media_src = '';
                                        }
                                    }

                                    //Picture
                                    $cff_note_picture_html = '';
                                    if($cff_note_media_src && $cff_show_media){

                                        //Fix Photon (Jetpack) issue
                                        $cff_picture_querystring = '';
                                        if (parse_url($cff_note_media_src, PHP_URL_QUERY)){
                                            $picture_url_parts = parse_url($cff_note_media_src);
                                            $cff_picture_querystring = $picture_url_parts['query'];
                                        }

                                        //Remove any quotes from note name to use in the image alt tag
                                        $cff_note_title = str_replace('"', "", $cff_note_title);
                                        $cff_note_title = str_replace("'", "", $cff_note_title);

                                        //Alt text
                                        isset( $cff_note_title ) ? $cff_alt_text = strip_tags($cff_note_title) : $cff_alt_text = $cff_facebook_link_text;

                                        $cff_note_picture_html .= '<div class="cff-media-wrap">';
                                        $cff_note_picture_html .= '<a title="'.$cff_facebook_link_text.'" class="cff-event-thumb';
                                        if($cff_note_media_src) $cff_note_picture_html .= ' cff-has-cover';
                                        $cff_note_picture_html .= ' nofancybox" href="'.$link.'" '.$target.$cff_nofollow.$cff_lightbox_sidebar_atts.'><img src="'.$cff_note_media_src.'" alt="'.$cff_alt_text.'" data-querystring="'.$cff_picture_querystring.'" /></a>';
                                        $cff_note_picture_html .= '</div>';
                                    }


                                    //Note details
                                    $cff_note = '<span class="cff-details">';
                                    $cff_note = '<span class="cff-note-title">'.$cff_note_title.'</span>';
                                    $cff_note .= $cff_note_description;
                                    $cff_note .= '</span>';

                                    //Notes don't include any post text and so just replace the post text with the note content
                                    $post_text = $cff_note;
                                }


                                //Start HTML for post text
                                $cff_post_text .= '<span class="cff-text" data-color="'.$cff_posttext_link_color.'">';
                                if ( $cff_title_link && !empty($post_text) ){
                                    //Link to the Facebook post if it's a link or a video;
                                    ($cff_post_type == 'link' || $cff_post_type == 'video') ? $text_link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1] : $text_link = $link;

                                    $cff_post_text .= '<a class="cff-post-text-link" '.$cff_title_styles.' href="'.$text_link.'" '.$target.$cff_nofollow.'>';
                                }
                                
                                //Replace line breaks in text (needed for IE8 and to prevent lost line breaks in HTML minification)
                                $post_text = preg_replace("/\r\n|\r|\n/",$cff_linebreak_el, $post_text);


                                //If the text is wrapped in a link then don't hyperlink any text within
                                if ($cff_title_link) {
                                    //Remove links from text
                                    $result = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $post_text);
                                    //Wrap links in a span so we can break the text if it's too long
                                    $cff_post_text .= cff_wrap_span( $result ) . ' ';
                                } else {
                                    //Don't use htmlspecialchars for post_text as it's added above so that it doesn't mess up the message_tag offsets
                                    $cff_post_text .= cff_autolink( $post_text ) . ' ';
                                }
                                
                                if ( $cff_title_link && !empty($post_text) ) $cff_post_text .= '</a>';
                                $cff_post_text .= '</span>';
                                //'See More' link
                                $cff_posttext_link_color_html = '';
                                if( isset($cff_posttext_link_color) && !empty($cff_posttext_link_color) && $cff_posttext_link_color != '#' ) $cff_posttext_link_color_html = 'style="color: #'.$cff_posttext_link_color.'"';
                                $cff_post_text .= '<span class="cff-expand">... <a href="#" '.$cff_posttext_link_color_html.'><span class="cff-more">' . stripslashes(__( $cff_see_more_text, 'custom-facebook-feed' ) ) . '</span><span class="cff-less">' . stripslashes(__( $cff_see_less_text, 'custom-facebook-feed' ) ) . '</span></a></span>';
                                $cff_post_text .= '</' . $cff_title_format . '>';


                                //Add a call to action button if included
                                if( isset($news->call_to_action->value->link) && !empty($news->call_to_action->value->link) ){

                                    $cff_cta_link = $news->call_to_action->value->link;

                                    //If it starts with a slash then it's a relative link so prefix it with facebook.com
                                    if( $cff_cta_link[0] == '/' ){
                                        $cff_cta_link = 'https://facebook.com' . $cff_cta_link;
                                    } else {
                                        //If it doesn't start with 'http' then add it otherwise the link doesn't work. Don't do this if it's a tel num.
                                        if (strpos($cff_cta_link, 'http') === false && strpos($cff_cta_link, 'tel:') === false) $cff_cta_link = 'http://' . $cff_cta_link;
                                    }

                                    $cff_button_type = $news->call_to_action->type;

                                    switch ($cff_button_type) {
                                        case 'GET_DIRECTIONS':
                                            $cff_translate_get_directions_text = $feed_options['getdirections'];
                                            if (!isset($cff_translate_get_directions_text) || empty($cff_translate_get_directions_text)) $cff_translate_get_directions_text = 'Get Directions';
                                            $cff_cta_button_text = $cff_translate_get_directions_text;

                                            //Check for fbgeo link
                                            if(strpos($cff_cta_link, 'fbgeo://') !== false){
                                                $cff_cta_link_pieces = explode('"', $cff_cta_link);
                                                $cff_cta_link = 'https://wego.here.com/directions/mix/'.$cff_cta_link_pieces[1];
                                            }
                                            break;
                                        case 'SHOP_NOW':
                                            $cff_translate_shop_now_text = $feed_options['shopnowtext'];
                                            if (!isset($cff_translate_shop_now_text) || empty($cff_translate_shop_now_text)) $cff_translate_shop_now_text = 'Shop Now';
                                            $cff_cta_button_text = $cff_translate_shop_now_text;
                                            break;
                                        case 'MESSAGE_PAGE':
                                            $cff_translate_message_page_text = $feed_options['messagepage'];
                                            if (!isset($cff_translate_message_page_text) || empty($cff_translate_message_page_text)) $cff_translate_message_page_text = 'Message Page';
                                            $cff_cta_button_text = $cff_translate_message_page_text;
                                            break;
                                        case 'LEARN_MORE':
                                            $cff_translate_learn_more_text = $feed_options['learnmoretext'];
                                            if (!isset($cff_translate_learn_more_text) || empty($cff_translate_learn_more_text)) $cff_translate_learn_more_text = 'Learn More';
                                            $cff_cta_button_text = $cff_translate_learn_more_text;
                                            break;
                                        default:
                                           $cff_cta_button_text = ucwords(strtolower( str_replace('_',' ',$cff_button_type) ) );
                                    }

                                    isset($news->call_to_action->value->app_link) ? $cff_app_link = $news->call_to_action->value->app_link : $cff_app_link = '';
                                    $cff_post_text .= '<p class="cff-cta-link" '.$cff_title_styles.'><a href="'.$cff_cta_link.'" target="_blank" data-app-link="'.$cff_app_link.'" '.$cff_posttext_link_color_html.'>'.$cff_cta_button_text.'</a></p>';
                                }


                                //LINK
                                $cff_shared_link = '';
                                //Display shared link
                                if ($cff_post_type == 'link' || $cff_soundcloud || $cff_spotify) {

                                    if( $cff_soundcloud ){
                                        //Put this here so that is also hidden when hiding shared links in the Post Layout settings
                                        if($cff_soundcloud) $cff_shared_link .= '<iframe class="cff-soundcloud" width="100%" height="100" scrolling="no" title="Music player" frameborder="no" src="https://w.soundcloud.com/player/?url=' . $news->link . '&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>';
                                    } else if( $cff_spotify ) {

                                        $spotify_url_arr = array_slice(explode('/', $url), -1);
                                        $spotify_id = $spotify_url_arr[0];
                                        $spotify_type = 'track';

                                        if( strpos($url,'show') !== false ) $spotify_type = 'show';
                                        if( strpos($url,'playlist') !== false ) $spotify_type = 'playlist';
                                        if( strpos($url,'album') !== false ) $spotify_type = 'album';
                                        if( strpos($url,'artist') !== false ) $spotify_type = 'artist';

                                        //Put this here so that is also hidden when hiding shared links in the Post Layout settings
                                        if($cff_spotify) $cff_shared_link .= '<iframe class="cff-spotify" src="https://open.spotify.com/embed/'.$spotify_type.'/'.$spotify_id.'" width="100%" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
                                    } else {

                                        $cff_shared_link .= '<div class="cff-shared-link';
                                        if($cff_disable_link_box) $cff_shared_link .= ' cff-no-styles';

                                        if($cff_full_link_images) $cff_shared_link .= ' cff-full-size';

                                        $cff_shared_link .= '" ';

                                        if(!$cff_disable_link_box) $cff_shared_link .= $cff_link_box_styles;
                                        $cff_shared_link .= '>';
                                        $cff_link_image = '';

                                        if ( isset($news->picture) || isset($news->attachments->data[0]->media->image) ){

                                            if (!empty($news->picture)) {
                                                $picture = $news->picture;

                                                /*If the image doesn't have a _b version then the URL looks like this:
                                                http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                                So check for this kind of string below and don't replace _s. with _b.
                                                */
                                                $bigjpg = '_s.jpg?';
                                                $bigpng = '_s.png?';
                                                $biggif = '_s.gif?';
                                                $bigbmp = '_s.bmp?';
                                                $bigtjpg = '_t.jpg?';
                                                $bigtpng = '_t.png?';
                                                $bigtgif = '_t.gif?';
                                                $bigtbmp = '_t.bmp?';
                                                $imagecheck1 = stripos($picture, $bigjpg);
                                                $imagecheck2 = stripos($picture, $bigpng);
                                                $imagecheck3 = stripos($picture, $biggif);
                                                $imagecheck4 = stripos($picture, $bigbmp);
                                                $imagecheck5 = stripos($picture, $bigtjpg);
                                                $imagecheck6 = stripos($picture, $bigtpng);
                                                $imagecheck7 = stripos($picture, $bigtgif);
                                                $imagecheck8 = stripos($picture, $bigtbmp);

                                                if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                                    //Show larger image
                                                    $picture = str_replace('_s.','_b.',$picture);
                                                    $picture = str_replace('_q.','_b.',$picture);
                                                    $picture = str_replace('_t.','_b.',$picture);
                                                }

                                                ( isset($news->full_picture) && !empty($news->full_picture) ) ? $full_picture = $news->full_picture : $full_picture = $picture;

                                                //Set the link image to be the full-size image
                                                if($cff_full_link_images) $picture = $full_picture;

                                                //Check whether the image is a 1x1 placeholder
                                                $cff_link_image = true;
                                                $cff_one_x_one = '1x1.';
                                                if( stripos($news->picture, $cff_one_x_one) == true || empty($news->picture) ) $cff_link_image = false;
                                            }

                                            //Uses the square cropped version from the post attachment rather than the full size image
                                            if( isset($news->attachments->data[0]->media->image) ){
                                                $picture = $full_picture = $news->attachments->data[0]->media->image->src;
                                                $cff_link_image = true;
                                            }

                                            //If there's a picture accompanying the link then display it
                                            if ($cff_link_image && $cff_show_media) {


                                                if( $cff_full_link_images && isset($news->multi_share_end_card) ){

                                                    if( $news->multi_share_end_card == true && isset( $news->attachments ) ){

                                                        $cff_shared_link .= '<div class="cff-link-slider">';
                                                        $cff_shared_link .= '<a href="#" class="cff-slider-next"><span class="fa fa-chevron-right" aria-hidden="true"></span></a>
                                                        <a href="#" class="cff-slider-prev"><span class="fa fa-chevron-left" aria-hidden="true"></span></a>';
                                                        $cff_shared_link .= '<a href="'.$link.'" target="_blank" class="cff-link-slider-slides">';

                                                        //Loop through attachments
                                                        foreach ($news->attachments->data[0]->subattachments->data as $attachment_item ) {
                                                            $cff_shared_link .= '<div class="cff-link-slider-item">';
                                                            $cff_shared_link .= '<img src="' . $attachment_item->media->image->src . '" alt="Link image" />';
                                                            $cff_shared_link .= '</div>';
                                                        }
                                                        //Put default image at end
                                                        $cff_shared_link .= '<div class="cff-link-slider-item cff-final-item">';
                                                        $cff_shared_link .= '<img src="' . $full_picture . '" alt="Link image" />';
                                                        $cff_shared_link .= '</div>';

                                                        $cff_shared_link .= '</a>'; //End .cff-link-slider-slides
                                                        $cff_shared_link .= '</div>'; //End .cff-link-slider

                                                    }

                                                } else {
                                                    $cff_shared_link .= '<a class="cff-link" href="'.$link.'" '.$target.$cff_nofollow.' data-full="'.$full_picture.'">';
                                                    $cff_shared_link .= '<img src="'. $picture .'" alt="Link thumbnail" />';
                                                    $cff_shared_link .= '</a>';
                                                }

                                            }
                                        }

                                        //Display link name and description
                                        // if (!empty($news->description)) {
                                        $cff_shared_link .= '<div class="cff-text-link ';
                                        if (!$cff_link_image) $cff_shared_link .= 'cff-no-image';
                                        //The link title:
                                        $cff_link_title_color_html = '';
                                        if( isset($cff_link_title_color) && !empty($cff_link_title_color) && $cff_link_title_color != '#' ) $cff_link_title_color_html = 'style="color: #'.$cff_link_title_color.'"';

                                        if( isset($news->name) ) $cff_shared_link .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.$cff_nofollow.' '.$cff_link_title_color_html.'>'. htmlentities($news->name, ENT_QUOTES, 'UTF-8') . '</a></'.$cff_link_title_format.'>';
                                        //The link source:
                                        (!empty($news->caption)) ? $cff_link_caption = htmlentities($news->caption, ENT_QUOTES, 'UTF-8') : $cff_link_caption = '';

                                        //Shared link styles
                                        $cff_link_url_color_html = '';
                                        $cff_link_url_size_html = '';
                                        if( isset($cff_link_url_color) && !empty($cff_link_url_color) && $cff_link_url_color != '#' ) $cff_link_url_color_html = 'color: #'.str_replace('#', '', $cff_link_url_color).';';
                                        if( $cff_link_url_size != 'inherit' && !empty($cff_link_url_size) ) $cff_link_url_size_html = 'font-size:'.$cff_link_url_size.'px;';

                                        $cff_link_styles_html = '';
                                        if( strlen($cff_link_url_color_html) > 1 || strlen($cff_link_url_size_html) > 1 ) $cff_link_styles_html = 'style="';
                                        if( strlen($cff_link_url_color_html) > 1 ) $cff_link_styles_html .= $cff_link_url_color_html;
                                        if( strlen($cff_link_url_size_html) > 1 ) $cff_link_styles_html .= $cff_link_url_size_html;
                                        if( strlen($cff_link_url_color_html) > 1 || strlen($cff_link_url_size_html) > 1 ) $cff_link_styles_html .= '"';

                                        // if(!empty($cff_link_caption)) $cff_shared_link .= '<p class="cff-link-caption" '.$cff_link_styles_html.'>'.$cff_link_caption.'</p>';
                                        if ($cff_show_desc) {
                                            //Truncate desc
                                            if (!empty($body_limit)) {
                                                if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                                            }

                                            //Shared link desc styles
                                            $cff_link_desc_color_html = '';
                                            $cff_link_desc_size_html = '';
                                            if( isset($cff_link_desc_color) && !empty($cff_link_desc_color) && $cff_link_desc_color != '#' ) $cff_link_desc_color_html = 'color: #'.str_replace('#', '', $cff_link_desc_color).';';
                                            if( $cff_link_desc_size != 'inherit' && !empty($cff_link_desc_size) ) $cff_link_desc_size_html = 'font-size:'.$cff_link_desc_size.'px;';

                                            $cff_link_desc_styles_html = '';
                                            if( strlen($cff_link_desc_color_html) > 1 || strlen($cff_link_desc_size_html) > 1 ) $cff_link_desc_styles_html = 'style="';
                                            if( strlen($cff_link_desc_color_html) > 1 ) $cff_link_desc_styles_html .= $cff_link_desc_color_html;
                                            if( strlen($cff_link_desc_size_html) > 1 ) $cff_link_desc_styles_html .= $cff_link_desc_size_html;
                                            if( strlen($cff_link_desc_color_html) > 1 || strlen($cff_link_desc_size_html) > 1 ) $cff_link_desc_styles_html .= '"';

                                            //Add links and create HTML
                                            $cff_link_description = '<span class="cff-post-desc" '.$cff_link_desc_styles_html.'>';
                                            if ($cff_title_link) {
                                                $cff_link_description .= cff_wrap_span( $description_text );
                                            } else {
                                                $description_text = cff_autolink( $description_text, $link_color=$cff_posttext_link_color );
                                                //Replace line breaks with <br> tags
                                                $cff_link_description .= nl2br($description_text);
                                            }
                                            $cff_link_description .= ' </span>';


                                            if( $description_text != $cff_link_caption ) $cff_shared_link .= $cff_link_description;
                                        }

                                        $cff_shared_link .= '</div>';
                                        // }

                                        $cff_shared_link .= '</div>';

                                    } //End soundcloud check

                                }


                                //MEDIA
                                $cff_media = '';
                                //If it's a photo or a Featured post which is an image
                                if ($news->type == 'photo' || $news->type == 'album' || $news->type == 'offer' || ( $cff_featured_post_active && !empty($feed_options['featuredpost']) && isset($news->images) ) ) {
                                    if ($cff_post_type == 'offer' && !empty($news->picture)){
                                        $picture = $news->picture;
                                        /*If the image doesn't have a _b version then the URL looks like this:
                                        http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                        So check for this kind of string below and don't replace _s. with _b.
                                        */
                                        $bigjpg = '_s.jpg?';
                                        $bigpng = '_s.png?';
                                        $biggif = '_s.gif?';
                                        $bigbmp = '_s.bmp?'; 
                                        $bigtjpg = '_t.jpg?';
                                        $bigtpng = '_t.png?';
                                        $bigtgif = '_t.gif?';
                                        $bigtbmp = '_t.bmp?';
                                        $imagecheck1 = stripos($picture, $bigjpg);
                                        $imagecheck2 = stripos($picture, $bigpng);
                                        $imagecheck3 = stripos($picture, $biggif);
                                        $imagecheck4 = stripos($picture, $bigbmp);
                                        $imagecheck5 = stripos($picture, $bigtjpg);
                                        $imagecheck6 = stripos($picture, $bigtpng);
                                        $imagecheck7 = stripos($picture, $bigtgif);
                                        $imagecheck8 = stripos($picture, $bigtbmp);

                                        if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                            //Show larger image
                                            $picture = str_replace('_s.','_b.',$picture);
                                            $picture = str_replace('_q.','_b.',$picture);
                                            $picture = str_replace('_t.','_b.',$picture);
                                        }
                                    }

                                    //If the full_picture option is available then use that instead of the object ID method
                                    if( isset($news->full_picture) ) $picture = $news->full_picture;
                                    
                                    //Use the small image size if set
                                    if( $cff_image_size == 'small' && isset($news->picture) ) $picture = $news->picture;

                                    //If $news->picture field is empty then try the attachment instead
                                    if( empty($news->picture) && isset($news->attachments->data[0]->media_type) ){
                                        if( isset($news->attachments->data[0]->media->image->src) ){
                                            $picture = $news->attachments->data[0]->media->image->src;
                                        }
                                    }

                                    if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                                    $link_text = $cff_facebook_link_text;

                                    //Disable/enable multi-photo layout
                                    $cff_multi_img_layout = true;
                                    $cff_one_image = $feed_options['oneimage'];
                                    ($cff_one_image == 'true' || $cff_one_image == 'on') ? $cff_one_image = true : $cff_one_image = false;
                                    if( $cff_one_image ) $cff_multi_img_layout = false;

                                    //Are there multiple photos to display?
                                    $cff_img_count = 1;
                                    $cff_portrait = false;
                                    $cff_img_attachments_html = '';
                                    $cff_main_img_width = 1200; //Set max-width as 1200px as default and then override with value below
                                    $cff_main_img_height = 1;

                                    if( $cff_multi_img_layout ){

                                        if( $cff_album && isset( $news->attachments->data[0]->subattachments ) ){

                                            //Total number of attachments
                                            $cff_attachment_total  = count($news->attachments->data[0]->subattachments->data);
                                            $cff_attachment_total_display = $cff_attachment_total - 3;
                                            if( $cff_attachment_total >= 12 ) $cff_attachment_total_display = ''; //If there's more than 12 then we can't display the number as we can only count up to 12 subattachments in the posts API.

                                            //Loop through attachments
                                            $cff_img_attachments = '';
                                            $a = 0;
                                            foreach ($news->attachments->data[0]->subattachments->data as $attachment_item ) {

                                                //Check whether it's a product attachment
                                                $is_product_attachment = false;
                                                if( isset($attachment_item->type) ){
                                                    if (strpos($attachment_item->type, 'product') !== false) {
                                                        $is_product_attachment = true;
                                                        //If there's only one attachment and it's a product then it's not an album
                                                        if( $cff_attachment_total < 2 ) $cff_album = false;
                                                    }
                                                }

                                                if( !$is_product_attachment ){
                                                    $attachment_src = $attachment_item->media->image->src;
                                                    //Check dimensions of main image
                                                    if( $a == 0 ){
                                                        $cff_main_img_width = $attachment_item->media->image->width;
                                                        $cff_main_img_height = $attachment_item->media->image->height;
                                                        if( $cff_main_img_height > $cff_main_img_width ) $cff_portrait = true;
                                                    }
                                                    //Create HTML for attachments
                                                    if( $a > 0 && $a < 4 ){
                                                        $cff_img_attachments .= '<span class="cff-img-wrap cff-crop">';

                                                        if($cff_img_count == 3) $cff_img_attachments .= '<span class="cff-more-attachments"><span>+'.$cff_attachment_total_display.'</span></span>';

                                                        $cff_img_attachments .= '<img src="'.$attachment_src.'" alt="Image attachment" class="cff-multi-image" /></span>';
                                                        $cff_img_count++;
                                                    }
                                                    $a++;
                                                }
                                                
                                            }

                                            if( $cff_img_count > 2 ) $cff_img_attachments_html = '<span class="cff-img-attachments">';
                                            $cff_img_attachments_html .= $cff_img_attachments;
                                            if( $cff_img_count > 2 ) $cff_img_attachments_html .= '</span>';
                                        }
                                    }


                                    $cff_media = '<div class="cff-media-wrap">';
                                    $cff_media .= '<a class="cff-photo';
                                    if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                                    if( $cff_img_count > 1 ) $cff_media .= ' cff-multiple cff-img-layout-'.$cff_img_count;
                                    if( $cff_portrait ) $cff_media .= ' cff-portrait';
                                    $cff_media .= ' nofancybox" ';
                                    if( $cff_img_count > 1 ) $cff_media .= 'style="max-width: '.$cff_main_img_width.'px;" ';
                                    $cff_media .= $cff_lightbox_sidebar_atts.' href="';

                                    //If it's an album then link the photo to the album
                                    if ($cff_album) {
                                        $link = $album_link;
                                    }

                                    //If it's a shared post then change the link to use the Post ID so that it links to the shared post and not the original post that's being shared
                                    if( isset($news->status_type) ){
                                        if( $news->status_type == 'shared_story' ) $link = "https://www.facebook.com/" . $cff_post_id;
                                    }

                                    $cff_media .= $link.'" '.$target.$cff_nofollow.'>';

                                    //Remove any quotes from message
                                    $cff_message_raw = str_replace('"', "", $cff_message_raw);
                                    $cff_message_raw = str_replace("'", "", $cff_message_raw);

                                    //Alt text
                                    isset( $cff_message_raw ) ? $cff_alt_text = strip_tags($cff_message_raw) : $cff_alt_text = $cff_facebook_link_text;

                                    if($cff_album) $cff_media .= '<span class="cff-album-icon"></span>';

                                    //Fix Photon (Jetpack) issue
                                    $cff_picture_querystring = '';
                                    if (parse_url($picture, PHP_URL_QUERY)){
                                        $picture_url_parts = parse_url($picture);
                                        $cff_picture_querystring = $picture_url_parts['query'];
                                    }

                                    if( $cff_img_count > 1 ) $cff_media .= '<span class="cff-img-wrap cff-main-image cff-crop">';
                                    $cff_media .= '<img src="'. $picture .'" alt="'.$cff_alt_text.'" data-querystring="'.$cff_picture_querystring.'" data-ratio="'.round($cff_main_img_width/$cff_main_img_height,3).'" class="cff-multi-image" />';
                                    if( $cff_img_count > 1 ) $cff_media .= '</span>';
                                    $cff_media .= $cff_img_attachments_html;
                                    $cff_media .= '</a>';
                                    $cff_media .= '</div>';
                                }
                                if ($news->type == 'swf') {

                                    if (!empty($news->picture)) {
                                        $picture = $news->picture;

                                        /*If the image doesn't have a _b version then the URL looks like this:
                                        http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                        So check for this kind of string below and don't replace _s. with _b.
                                        */
                                        $bigjpg = '_s.jpg?';
                                        $bigpng = '_s.png?';
                                        $biggif = '_s.gif?';
                                        $bigbmp = '_s.bmp?';
                                        $bigtjpg = '_t.jpg?';
                                        $bigtpng = '_t.png?';
                                        $bigtgif = '_t.gif?';
                                        $bigtbmp = '_t.bmp?';
                                        $imagecheck1 = stripos($picture, $bigjpg);
                                        $imagecheck2 = stripos($picture, $bigpng);
                                        $imagecheck3 = stripos($picture, $biggif);
                                        $imagecheck4 = stripos($picture, $bigbmp);
                                        $imagecheck5 = stripos($picture, $bigtjpg);
                                        $imagecheck6 = stripos($picture, $bigtpng);
                                        $imagecheck7 = stripos($picture, $bigtgif);
                                        $imagecheck8 = stripos($picture, $bigtbmp);

                                        if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                            //Show larger image
                                            $picture = str_replace('_s.','_b.',$picture);
                                            $picture = str_replace('_q.','_b.',$picture);
                                            $picture = str_replace('_t.','_b.',$picture);
                                        }
                                    }

                                    $cff_swf_url = 'https://www.facebook.com/permalink.php?story_fbid='.$PostID["1"].'&amp;id='.$PostID['0'];
                                    $cff_media = '<a href="'.$cff_swf_url.'" class="cff-photo nofancybox';
                                    if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                                    $cff_media .= '" ' . $target . $cff_nofollow.$cff_lightbox_sidebar_atts.'><img src="' . $picture . '" /></a>';
                                }

                                if ($news->type == 'video' && !$cff_soundcloud && !$cff_spotify) {

                                    if( !isset($picture) ) $picture = '';

                                    if (!empty($news->picture)) {
                                        $picture = $news->picture;

                                        // $object_id = $news->object_id;
                                        // $picture = 'https://graph.facebook.com/'.$object_id.'/picture?type=normal&width=9999&height=9999';

                                        /*If the image doesn't have a _b version then the URL looks like this:
                                        http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                        So check for this kind of string below and don't replace _s. with _b.
                                        */
                                        $bigjpg = '_s.jpg?';
                                        $bigpng = '_s.png?';
                                        $biggif = '_s.gif?';
                                        $bigbmp = '_s.bmp?';
                                        $bigtjpg = '_t.jpg?';
                                        $bigtpng = '_t.png?';
                                        $bigtgif = '_t.gif?';
                                        $bigtbmp = '_t.bmp?';
                                        $imagecheck1 = stripos($picture, $bigjpg);
                                        $imagecheck2 = stripos($picture, $bigpng);
                                        $imagecheck3 = stripos($picture, $biggif);
                                        $imagecheck4 = stripos($picture, $bigbmp);
                                        $imagecheck5 = stripos($picture, $bigtjpg);
                                        $imagecheck6 = stripos($picture, $bigtpng);
                                        $imagecheck7 = stripos($picture, $bigtgif);
                                        $imagecheck8 = stripos($picture, $bigtbmp);

                                        if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                            //Show larger image
                                            $picture = str_replace('_s.','_b.',$picture);
                                            $picture = str_replace('_q.','_b.',$picture);
                                            $picture = str_replace('_t.','_b.',$picture);
                                        }
                                    }

                                    //If $news->picture field is empty then try the attachment instead
                                    if( empty($news->picture) && isset($news->attachments->data[0]->media_type) ){
                                        if( isset($news->attachments->data[0]->media->image->src) ){
                                            $picture = $news->attachments->data[0]->media->image->src;
                                        }
                                    }

                                    //Type of player to use
                                    $cff_video_player = $feed_options[ 'videoplayer' ];

                                    // url of video
                                    if( isset($news->source) ){
                                        $url = $news->source;
                                    } else {
                                        $url = '';
                                        //If the source field isn't available in the API then use the Facebook Video Player instead which doesn't require that field
                                        $cff_video_player = 'facebook';
                                    }
                                    
                                    //Check whether it's a youtube video
                                    if($youtube || $youtu || $youtubeembed) {
                                        //Get the unique video id from the url by matching the pattern
                                        if ($youtube || $youtubeembed) {
                                            if (preg_match("/v=([^&]+)/i", $url, $matches)) {
                                                $id = $matches[1];
                                            }   elseif(preg_match("/\/v\/([^&]+)/i", $url, $matches)) {
                                                $id = $matches[1];
                                            }   elseif(preg_match("/\/embed\/([^&]+)/i", $url, $matches)) {
                                                $id = $matches[1];
                                            }
                                        } elseif ($youtu) {
                                            $youtu_url_arr = array_slice(explode('/', $url), -1);
                                            $id = $youtu_url_arr[0];
                                        }
                                        if( strrpos($id, '?') ) $id = substr($id, 0, strrpos($id, '?'));
                                        // this is your template for generating embed codes
                                        $code = '<iframe class="youtube-player" type="text/html" src="https://www.youtube.com/embed/{id}" allowfullscreen title="YouTube video"></iframe>';
                                        // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                        $code = str_replace('{id}', $id, $code);

                                        $cff_media_video = '<div class="cff-iframe-wrap" data-poster="'.$picture.'" '.$cff_lightbox_sidebar_atts;
                                        if(!empty($cff_video_height)) $cff_media_video .= 'style="height: '. $cff_video_height . '"';
                                        $cff_media_video .= '>';

                                        if($cff_video_action == 'facebook') $cff_media_video .= '<a href="https://facebook.com/'.$cff_post_id.'" target="_blank" class="cff-media-overlay"></a>';

                                        //Add image as it's needed for lightbox ordering for embedded iframe videos
                                        $cff_media_video .= '<img src="'.$picture.'" alt="Video image" class="cff-iframe-img" />';

                                        $cff_media_video .= $code . '</div>';

                                    //Check whether it's a vimeo
                                    } else if(stripos($url, $vimeo) !== false) {
                                        if (isset($news->source)) {

                                            $clip_id = '';
                                            //http://vimeo.com/moogaloop.swf?clip_id=101557016&autoplay=1
                                            $query = parse_url($news->source, PHP_URL_QUERY);
                                            parse_str($query, $params);
                                            if(isset($params['clip_id'])) $clip_id = $params['clip_id'];

                                            //https://player.vimeo.com/video/116446625?autoplay=1
                                            if( !isset($clip_id) || $clip_id == '' ){
                                                $vimeo_url = strtok($news->source,'?');
                                                $vimeo_url_arr = array_slice(explode('/', $vimeo_url), -1);
                                                $clip_id = $vimeo_url_arr[0];
                                            }

                                            $cff_media_video = '<div class="cff-iframe-wrap" data-poster="'.$picture.'" '.$cff_lightbox_sidebar_atts;
                                            if(!empty($cff_video_height)) $cff_media_video .= 'style="height: '. $cff_video_height . '"';
                                            $cff_media_video .= '>';

                                            if($cff_video_action == 'facebook') $cff_media_video .= '<a href="https://facebook.com/'.$cff_post_id.'" target="_blank" class="cff-media-overlay"></a>';

                                            //Add image as it's needed for lightbox ordering
                                            $cff_media_video .= '<img src="'.$picture.'" alt="Video image" class="cff-iframe-img" />';

                                            $cff_media_video .= '<iframe src="https://player.vimeo.com/video/'.$clip_id.'" webkitAllowFullScreen mozallowfullscreen allowFullScreen title="Vimeo video"></iframe></div>';
                                        }

                                    //Else use a video player
                                    } else {
                                        //Show play button over video thumbnail
                                        isset($news->source) ? $vid_link = $news->source : $vid_link = '';
                                        //Check whether the video source contains an mp4, as the HTML5 video player can't play any other type
                                        $cff_mp4_check = stripos($vid_link, '.mp4');
                                        //Check whether it's a live video. When live the source format is https://www.facebook.com/video/playback/playlist.m3u8?v=1201515613297938
                                        $cff_live_video = stripos($vid_link, '/video/playback/playlist');
                                        ( $cff_live_video ) ? $cff_live_video = 'true' : $cff_live_video = 'false';

                                        if ($cff_video_action == 'facebook' && $cff_disable_lightbox) $vid_link = $link;

                                        //Title & alt text
                                        isset( $news->name ) ? $vid_title = htmlentities($news->name, ENT_QUOTES, 'UTF-8') : $vid_title = $cff_facebook_link_text;

                                        if (empty($picture)) {
                                            $cff_is_video_embed = true;
                                            $cff_media_video = '<a class="cff-playbtn-solo" title="' . $vid_title . '" href="' . $vid_link . '" target="_blank"><span class="fa fa-play cff-playbtn no-poster" aria-hidden="true"></span></a>';
                                        }

                                        ( isset($news->full_picture) && !empty($news->full_picture) ) ? $poster = $news->full_picture : $poster = $picture;

                                        //Check to see whether it's a swf file and if it is then load it into an iframe in the lightbox
                                        (stripos($url, $swf) !== false) ? $swf_file = true : $swf_file = false;

                                        //Fix Photon (Jetpack) issue
                                        $cff_picture_querystring = '';
                                        if (parse_url($poster, PHP_URL_QUERY)){
                                            $picture_url_parts = parse_url($poster);
                                            $cff_picture_querystring = $picture_url_parts['query'];
                                        }


                                        //Disable/enable multi-photo layout
                                        $cff_multi_img_layout = true;
                                        $cff_one_image = $feed_options['oneimage'];
                                        ($cff_one_image == 'true' || $cff_one_image == 'on') ? $cff_one_image = true : $cff_one_image = false;
                                        if( $cff_one_image ) $cff_multi_img_layout = false;

                                        //Are there multiple photos to display?
                                        $cff_img_count = 1;
                                        $cff_portrait = false;
                                        $cff_img_attachments_html = '';
                                        $cff_main_img_width = 1200; //Set max-width as 1200px as default and then override with value below
                                        $cff_main_img_height = 1;

                                        if( $cff_multi_img_layout ){
                                            if( isset( $news->attachments->data[0]->subattachments ) ){

                                                //Total number of attachments
                                                $cff_attachment_total  = count($news->attachments->data[0]->subattachments->data);
                                                $cff_attachment_total_display = $cff_attachment_total - 3;
                                                if( $cff_attachment_total >= 12 ) $cff_attachment_total_display = '';

                                                //Loop through attachments
                                                $cff_img_attachments = '';
                                                $a = 0;
                                                foreach ($news->attachments->data[0]->subattachments->data as $attachment_item ) {

                                                    //Check whether it's a product attachment
                                                    $is_product_attachment = false;
                                                    if( isset($attachment_item->type) ){
                                                        if (strpos($attachment_item->type, 'product') !== false) {
                                                            $is_product_attachment = true;
                                                            //If there's only one attachment and it's a product then it's not an album
                                                            if( $cff_attachment_total < 2 ) $cff_album = false;
                                                        }
                                                    }

                                                    if( !$is_product_attachment ){

                                                        $attachment_src = $attachment_item->media->image->src;
                                                        //Check dimensions of main image
                                                        if( $a == 0 ){
                                                            $cff_main_img_width = $attachment_item->media->image->width;
                                                            $cff_main_img_height = $attachment_item->media->image->height;
                                                            if( $cff_main_img_height > $cff_main_img_width ) $cff_portrait = true;
                                                        }
                                                        //Create HTML for attachments
                                                        if( $a > 0 && $a < 4 ){
                                                            $cff_img_attachments .= '<span class="cff-img-wrap cff-crop">';

                                                            if( $cff_disable_lightbox ) $cff_img_attachments .= "<a href='https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1] ."' ".$target.$cff_nofollow." style='width:100%; float:left; clear: both; z-index: 1; position: relative;'>";

                                                            if($cff_img_count == 3) $cff_img_attachments .= '<span class="cff-more-attachments"><span>+'.$cff_attachment_total_display.'</span></span>';

                                                            if( $cff_disable_lightbox ) $cff_img_attachments .= '</a>';

                                                            $cff_img_attachments .= '<img src="'.$attachment_src.'" alt="Image attachment" /></span>';
                                                            $cff_img_count++;
                                                        }
                                                        $a++;

                                                    }

                                                }

                                                if( $cff_img_count > 2 ) $cff_img_attachments_html = '<span class="cff-img-attachments">';
                                                $cff_img_attachments_html .= $cff_img_attachments;
                                                if( $cff_img_count > 2 ) $cff_img_attachments_html .= '</span>';
                                            }
                                        }


                                        //If the video action is file then add the HTML5 video tags
                                        $cff_media_video = '';
                                        $cff_media_video .= '<div class="cff-html5-video';
                                        if( $cff_img_count > 1 ) $cff_media_video .= ' cff-multiple cff-img-layout-'.$cff_img_count;
                                        if( $cff_portrait ) $cff_media_video .= ' cff-portrait';
                                        if( $swf_file ) $cff_media_video .= ' cff-swf';
                                        $cff_media_video .= '"'.$cff_lightbox_sidebar_atts . ' data-cff-video-link="'.$link.'" data-cff-video-player="'.$cff_video_player.'" data-cff-live="'.$cff_live_video.'">';

                                        if( $cff_img_count > 1 ){
                                            $cff_media_video .= '<span class="cff-img-wrap cff-main-image';

                                            if( $cff_video_action !== 'facebook' && $cff_mp4_check && $cff_disable_lightbox ){
                                                //Don't crop the video so we can play it directly in the feed
                                            } else {
                                                //Else crop it
                                                $cff_media_video .= ' cff-crop';
                                            }

                                            $cff_media_video .= '">';
                                        }

                                        $poster_img = $poster;
                                        //Use the small image size if set
                                        if( $cff_image_size == 'small' && isset($news->picture) ) $poster_img = $news->picture;

                                        //Include the VIDEO element
                                        //Fallback video link
                                        $cff_vid_link = '<a title="' . $vid_title . '" class="cff-vidLink" href="' . $link . '" '.$target.$cff_nofollow.'><span class="fa fa-play cff-playbtn" aria-hidden="true"></span><img class="cff-poster" src="' . $poster_img . '" alt="' . $vid_title . '" data-querystring="'.$cff_picture_querystring.'" data-ratio="'.round($cff_main_img_width/$cff_main_img_height,3).'" /></a>';


                                        //If lightbox enabled
                                        if( !$cff_disable_lightbox ){

                                            //Add image and play button
                                            $cff_media_video .= '<a href="https://facebook.com/'.$cff_post_id.'" class="cff-html5-play"><span class="fa fa-play cff-playbtn" aria-hidden="true"></span><span class="cff-screenreader">Play</span></a>';
                                            $cff_media_video .= '<img class="cff-poster" src="' . $poster_img . '" data-cff-full-img="'.$poster.'" alt="' . $vid_title . '" data-querystring="'.$cff_picture_querystring.'" data-cff-video="'.$vid_link.'" style="float: left;" data-ratio="'.round($cff_main_img_width/$cff_main_img_height,3).'" />';

                                        } else { // Lightbox disabled

                                            //Link to Facebook post
                                            if( $cff_video_action == 'facebook' ){

                                                $cff_media_video .= $cff_vid_link;

                                            } else { //Play in feed

                                                //Use HTML5 player
                                                if( isset( $news->source ) && $cff_mp4_check && $cff_video_player == 'standard' ){

                                                    $cff_media_video .= '<a href="https://facebook.com/'.$cff_post_id.'" class="cff-html5-play"><span class="fa fa-play cff-playbtn" aria-hidden="true"></span></a>';
                                                    //If pagination is enabled then display the poster image over the video element as in Chrome there's a video flicker when loading more posts
                                                    if( $feed_options['loadmore'] ) $cff_media_video .= '<img class="cff-poster" src="' . $poster_img . '" alt="' . $vid_title . '" data-querystring="'.$cff_picture_querystring.'" style="position: absolute; top: 0; left: 0; z-index: 7;" data-ratio="'.round($cff_main_img_width/$cff_main_img_height,3).'" />';
                                                    $cff_media_video .= '<video src="'.$vid_link.'" poster="'.$poster_img.'" preload="none" >';
                                                    $cff_media_video .= $cff_vid_link;
                                                    $cff_media_video .= '</video>';

                                                } else { //Use Facebook Video Player

                                                    $cff_media_video .= '<div class="cff-vidLink cff-video-player">';
                                                    $cff_media_video .= '<div class="fb-video" data-href="'.$link.'" data-show-text="false" fb-xfbml-state="rendered"><iframe src="https://www.facebook.com/v2.3/plugins/video.php?href='.$link.'" title="Facebook video player"></iframe></div>';
                                                    $cff_media_video .= '<img class="cff-poster" src="' . $poster_img . '" alt="' . $vid_title . '" />';
                                                    $cff_media_video .= '</div>';

                                                }

                                            }

                                        }

                                        //Link to the Facebook post if it's a link or a video
                                        if($cff_post_type == 'link' || $cff_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                                        if( $cff_img_count > 1 ) $cff_media_video .= '</span>';
                                        if( $cff_disable_lightbox && $cff_img_count < 2 ) $cff_media_video .= "<a href='https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1] ."' ".$target.$cff_nofollow." style='width:100%; float:left; clear: both; z-index: 1; position: relative;'>";
                                        $cff_media_video .= $cff_img_attachments_html;
                                        if( $cff_disable_lightbox && $cff_img_count < 2 ) $cff_media_video .= '</a>';
                                        $cff_media_video .= '</div>';

                                    }
                                    //Add video to HTML
                                    $cff_media = $cff_media_video;


                                    //Add the name to the description if it's a video embed
                                    if($cff_is_video_embed) {
                                        $cff_description = '<div class="cff-desc-wrap ';
                                        if (empty($picture)) $cff_description .= 'cff-no-image';

                                        $cff_link_title_color_html = '';
                                        if( isset($cff_link_title_color) && !empty($cff_link_title_color) && $cff_link_title_color != '#' ) $cff_link_title_color_html = 'style="color: #'.$cff_link_title_color.'"';

                                        $cff_description .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.$cff_nofollow.' '.$cff_link_title_color_html.'>'. htmlentities($news->name, ENT_QUOTES, 'UTF-8') . '</a></'.$cff_link_title_format.'>';

                                        if (!empty($body_limit)) {
                                            if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                                        }

                                        $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>';
                                        if ($cff_title_link) {
                                            $cff_description_tagged = cff_wrap_span( $description_text );
                                        } else {
                                            $cff_description_text = cff_autolink( $description_text, $link_color=$cff_posttext_link_color );
                                            $cff_description_tagged = cff_desc_tags($cff_description_text);
                                        }
                                        $cff_description .= $cff_description_tagged;
                                        $cff_description .= ' </span></p></div>';

                                    }
                                }

                                //META
                                //how many comments are there?
                                $comment_count = 0;
                                $comment_count_display = '0';

                                //Save the original $news object to a variable so can use it after the comments section
                                $news_event = $news;
                                //If it's a timeline event then switch to the event_object variable which contains the comments
                                if( $cff_post_type == 'event' && isset($event_object) ) $news = $event_object;

                                if (!empty($news->comments->data)) {
                                    isset($news->comments->summary->total_count) ? $comment_count = intval($news->comments->summary->total_count) : $comment_count = 0;
                                    $comment_count_display = $comment_count;
                                }

                                $cff_like_svg = '<svg role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M496.656 285.683C506.583 272.809 512 256 512 235.468c-.001-37.674-32.073-72.571-72.727-72.571h-70.15c8.72-17.368 20.695-38.911 20.695-69.817C389.819 34.672 366.518 0 306.91 0c-29.995 0-41.126 37.918-46.829 67.228-3.407 17.511-6.626 34.052-16.525 43.951C219.986 134.75 184 192 162.382 203.625c-2.189.922-4.986 1.648-8.032 2.223C148.577 197.484 138.931 192 128 192H32c-17.673 0-32 14.327-32 32v256c0 17.673 14.327 32 32 32h96c17.673 0 32-14.327 32-32v-8.74c32.495 0 100.687 40.747 177.455 40.726 5.505.003 37.65.03 41.013 0 59.282.014 92.255-35.887 90.335-89.793 15.127-17.727 22.539-43.337 18.225-67.105 12.456-19.526 15.126-47.07 9.628-69.405zM32 480V224h96v256H32zm424.017-203.648C472 288 472 336 450.41 347.017c13.522 22.76 1.352 53.216-15.015 61.996 8.293 52.54-18.961 70.606-57.212 70.974-3.312.03-37.247 0-40.727 0-72.929 0-134.742-40.727-177.455-40.727V235.625c37.708 0 72.305-67.939 106.183-101.818 30.545-30.545 20.363-81.454 40.727-101.817 50.909 0 50.909 35.517 50.909 61.091 0 42.189-30.545 61.09-30.545 101.817h111.999c22.73 0 40.627 20.364 40.727 40.727.099 20.363-8.001 36.375-23.984 40.727zM104 432c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg>'.'<svg class="cff-svg-bg" role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z"></path></svg>';
                                $cff_share_svg ='<svg role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M564.907 196.35L388.91 12.366C364.216-13.45 320 3.746 320 40.016v88.154C154.548 130.155 0 160.103 0 331.19c0 94.98 55.84 150.231 89.13 174.571 24.233 17.722 58.021-4.992 49.68-34.51C100.937 336.887 165.575 321.972 320 320.16V408c0 36.239 44.19 53.494 68.91 27.65l175.998-184c14.79-15.47 14.79-39.83-.001-55.3zm-23.127 33.18l-176 184c-4.933 5.16-13.78 1.73-13.78-5.53V288c-171.396 0-295.313 9.707-243.98 191.7C72 453.36 32 405.59 32 331.19 32 171.18 194.886 160 352 160V40c0-7.262 8.851-10.69 13.78-5.53l176 184a7.978 7.978 0 0 1 0 11.06z"></path></svg>'.'<svg class="cff-svg-bg" role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M503.691 189.836L327.687 37.851C312.281 24.546 288 35.347 288 56.015v80.053C127.371 137.907 0 170.1 0 322.326c0 61.441 39.581 122.309 83.333 154.132 13.653 9.931 33.111-2.533 28.077-18.631C66.066 312.814 132.917 274.316 288 272.085V360c0 20.7 24.3 31.453 39.687 18.164l176.004-152c11.071-9.562 11.086-26.753 0-36.328z"></path></svg>';
                                $cff_comment_svg = '<svg role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm32 352c0 17.6-14.4 32-32 32H293.3l-8.5 6.4L192 460v-76H64c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h384c17.6 0 32 14.4 32 32v288z"></path></svg>'.'<svg class="cff-svg-bg" role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 9.8 11.2 15.5 19.1 9.7L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64z"></path></svg>';

                                //Start comments HTML
                                $cff_meta_total = '<div class="cff-meta-wrap">';

                                //If lightbox comments are enabled but regular comments aren't then enable regular comments and enable using CSS
                                //Lightbox comments
                                $cff_lightbox_comments = true;
                                if( $feed_options[ 'lightboxcomments' ] === 'false' || $feed_options['lightboxcomments'] == false ) $cff_lightbox_comments = false;

                                //Disable lightbox comments if it's a dedicated feed type
                                if( ( $cff_events_only && $cff_events_source == 'eventspage' ) || $cff_albums_only || $cff_photos_only || $cff_videos_only) $cff_lightbox_comments = false;
                                //Include string for meta
                                $cff_includes = $feed_options[ 'include' ];
                                $cff_show_meta = false;
                                if ( stripos($cff_includes, 'social') !== false ) $cff_show_meta = true;
                                //Exclude string for meta
                                $cff_excludes = $feed_options[ 'exclude' ];
                                if ( stripos($cff_excludes, 'social') !== false ) $cff_show_meta = false;

                                //Create the likes, shares, comments box
                                if( $cff_show_meta || $cff_lightbox_comments ){

                                    //Check for likes
                                    $cff_meta = '<div class="cff-view-comments-wrap">';
                                    $cff_meta .= '<a href="javaScript:void(0);" class="cff-view-comments';
                                    if($cff_lightbox_comments && !$cff_show_meta) $cff_meta .= ' cff-hide-comments';
                                    $cff_meta .= '" ' . $cff_meta_styles . ' id="'.$orig_post_id.'"><ul class="cff-meta ';
                                    $cff_meta .= $cff_icon_style;
                                    $cff_meta .= '"><li class="cff-likes"><span class="cff-icon cff-like"><span class="cff-screenreader">Likes:</span>';
                                    $cff_meta .= $cff_like_svg;
                                    $cff_meta .= '</span> <span class="cff-count">';
                                    
                                    //How many likes are there?
                                    isset( $news->likes->summary->total_count ) ? $like_count = $news->likes->summary->total_count : $like_count = 0;

                                    if( $cff_post_type == 'event' ){
                                        isset( $news_event->likes->summary->total_count ) ? $like_count = $news_event->likes->summary->total_count : $like_count = 0;
                                    }

                                    //If there is no likes then display zero
                                    if ($like_count == 0) {
                                        $cff_meta .= '0';
                                    } else {
                                        $cff_meta .= $like_count;
                                    }

                                    //Check for shares
                                    $cff_meta .= '</span></li><li class="cff-shares"><span class="cff-icon cff-share"><span class="cff-screenreader">Shares:</span>';
                                    $cff_meta .= $cff_share_svg;
                                    $cff_meta .= '</span> <span class="cff-count">';
                                    if (empty($news->shares->count)) { $cff_meta .= '0'; }
                                        else { $cff_meta .= $news->shares->count; }
                                    //Check for comments
                                    $cff_meta .= '</span></li><li class="cff-comments"><span class="cff-icon cff-comment"><span class="cff-screenreader">Comments:</span>';
                                    $cff_meta .= $cff_comment_svg;
                                    $cff_meta .= '</span> <span class="cff-count">';
                                    //How many comments are there?
                                    $cff_meta .= $comment_count_display;
                                    $cff_meta .= '</span></li></ul></a>';
                                    $cff_meta .= '</div>';

                                } //End creating the likes, shares, comments box

                                //Display the link to the Facebook post or external link
                                $cff_link = '';
                                //Default link
                                $cff_viewpost_class = 'cff-viewpost-facebook';
                                if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                                $link_text = $cff_facebook_link_text;

                                //Link to the Facebook post if it's a link or a video
                                if($cff_post_type == 'link' || $cff_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                                //If Featured Post extension then change the $link var based on whether a full or half post ID is used
                                if ($cff_featured_post_active && !empty($feed_options['featuredpost'])) {
                                    
                                    //If the post type is a link or a video (other link types have the link included in the JSON)
                                    if($cff_post_type == 'link' || $cff_post_type == 'video'){

                                        if ( stripos($cff_post_id, '_') !== false ) {
                                            //If using the full post ID with an underscore then create the link like this:
                                            $link = "https://www.facebook.com/" . $PostID[0] . "/posts/" . $PostID[1];
                                        } else {
                                            //If just using the short ID then create the link like this:
                                            $link = "https://www.facebook.com/" . $cff_post_id;
                                        }
                                    }

                                }

                                //Social media sharing URLs
                                $cff_share_facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($link);
                                $cff_share_twitter = 'https://twitter.com/intent/tweet?text=' . urlencode($link);
                                $cff_share_google = 'https://plus.google.com/share?url=' . urlencode($link);
                                $cff_share_linkedin = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($link) . '&amp;title=' . rawurlencode( strip_tags($cff_post_text) );
                                $cff_share_email = 'mailto:?subject=Facebook&amp;body=' . urlencode($link) . '%20-%20' . rawurlencode( strip_tags($cff_post_text) );

                                //If it's a shared post then change the link to use the Post ID so that it links to the shared post and not the original post that's being shared
                                if( isset($news->status_type) ){
                                    if( $news->status_type == 'shared_story' ) $link = "https://www.facebook.com/" . $cff_post_id;
                                }
                                //If there's an object_id then use that as it's more reliable for posts by other people
                                if( !empty($news->object_id) ){
                                    $link = "https://www.facebook.com/" . $news->object_id;
                                }

                                //If it's an offer post then change the text
                                if ($cff_post_type == 'offer') $link_text = 'View Offer';

                                //Create post action links HTML
                                $cff_link = '';
                                if($cff_show_facebook_link || $cff_show_facebook_share){
                                    $cff_link .= '<div class="cff-post-links">';

                                    //If link isn't to Facebook post then use the Post ID instead to create a link
                                    if ( stripos($link, 'facebook.com') === false ) {
                                        $link = "https://www.facebook.com/" . $news->id;
                                    }

                                    //View on Facebook link
                                    if($cff_show_facebook_link) $cff_link .= '<a class="' . $cff_viewpost_class . '" href="' . $link . '" title="' . $link_text . '" ' . $target . $cff_nofollow.' ' . $cff_link_styles . '>' . $link_text . '</a>';

                                    //Share link
                                    if($cff_show_facebook_share){
                                        $cff_link .= '<div class="cff-share-container">';
                                        //Only show separating dot if both links are enabled
                                        if($cff_show_facebook_link) $cff_link .= '<span class="cff-dot" ' . $cff_link_styles . '>&middot;</span>';
                                        $cff_link .= '<a class="cff-share-link" href="javascript:void(0);" title="' . $cff_facebook_share_text . '" ' . $cff_link_styles . '>' . $cff_facebook_share_text . '</a>';
                                        $cff_link .= "<p class='cff-share-tooltip'><a href='".$cff_share_facebook."' target='_blank' class='cff-facebook-icon'><span class='fa fab fa-facebook-square' aria-hidden='true'></span><span class='cff-screenreader'>Share on Facebook</span></a><a href='".$cff_share_twitter."' target='_blank' class='cff-twitter-icon'><span class='fa fab fa-twitter' aria-hidden='true'></span><span class='cff-screenreader'>Share on Twitter</span></a><a href='".$cff_share_linkedin."' target='_blank' class='cff-linkedin-icon'><span class='fa fab fa-linkedin' aria-hidden='true'></span><span class='cff-screenreader'>Share on Linked In</span></a><a href='".$cff_share_email."' target='_blank' class='cff-email-icon'><span class='fa fa-envelope' aria-hidden='true'></span><span class='cff-screenreader'>Share by Email</span></a><span class='fa fa-play fa-rotate-90' aria-hidden='true'></span></p></div>";
                                    }
                                    
                                    $cff_link .= '</div>'; 
                                }
                                
                                //If lightbox comments are enabled then enable comments (they're hidden using a style tag added to the cff-meta element)
                                if($cff_lightbox_comments) $cff_show_meta = true;

                                //Compile the meta and link if included
                                if ($cff_show_link) $cff_meta_total .= $cff_link;
                                if ($cff_show_meta) $cff_meta_total .= $cff_meta;
                                $cff_meta_total .= '</div>';
                                $cff_comments = '';

                                //Get custom text strings
                                $cff_translate_view_previous_comments_text = $feed_options['previouscommentstext'];
                                $cff_translate_comment_on_facebook_text = $feed_options['commentonfacebooktext'];
                                $cff_translate_likes_this_text = $feed_options['likesthistext'];
                                $cff_translate_like_this_text = $feed_options['likethistext'];
                                $cff_translate_reacted_text = $feed_options['reactedtothistext'];
                                $cff_translate_and_text = $feed_options['andtext'];
                                $cff_translate_other_text = $feed_options['othertext'];
                                $cff_translate_others_text = $feed_options['otherstext'];
                                $cff_translate_reply_text = $feed_options['replytext'];
                                $cff_translate_replies_text = $feed_options['repliestext'];
                                

                                if (!isset($cff_translate_view_previous_comments_text) || empty($cff_translate_view_previous_comments_text)) $cff_translate_view_previous_comments_text = 'View previous comments';
                                if (!isset($cff_translate_comment_on_facebook_text) || empty($cff_translate_comment_on_facebook_text)) $cff_translate_comment_on_facebook_text = 'Comment on Facebook';
                                if (!isset($cff_translate_likes_this_text) || empty($cff_translate_likes_this_text)) $cff_translate_likes_this_text = 'likes this';
                                if (!isset($cff_translate_like_this_text) || empty($cff_translate_like_this_text)) $cff_translate_like_this_text = 'like this';
                                if (!isset($cff_translate_reacted_text) || empty($cff_translate_reacted_text)) $cff_translate_reacted_text = 'reacted to this';
                                if (!isset($cff_translate_and_text) || empty($cff_translate_and_text)) $cff_translate_and_text = 'and';
                                if (!isset($cff_translate_other_text) || empty($cff_translate_other_text)) $cff_translate_other_text = 'other';
                                if (!isset($cff_translate_others_text) || empty($cff_translate_others_text)) $cff_translate_others_text = 'others';
                                if (!isset($cff_translate_reply_text) || empty($cff_translate_reply_text)) $cff_translate_reply_text = 'Reply';
                                if (!isset($cff_translate_replies_text) || empty($cff_translate_replies_text)) $cff_translate_replies_text = 'Replies';

                                //Create the comments box
                                if( $cff_show_meta || $cff_lightbox_comments ){

                                    $cff_comments .= '<div class="cff-comments-box ' . $cff_icon_style;
                                    if( $comment_count === 0 || $cff_comments_num === 0 ) $cff_comments .= ' cff-no-comments';

                                    //If it's a shared post then add a class so I can use this in the query.php request, as it uses the post_id to get likes for shared posts
                                    if( isset($news->status_type) ){
                                        if( $news->status_type == 'shared_story' ) $cff_comments .= ' cff-shared-story';
                                    }

                                    $cff_comments .= '"';
                                    $cff_comments .= ' data-cff-like-text="'.$cff_translate_like_this_text.'" data-cff-likes-text="'.$cff_translate_likes_this_text.'"  data-cff-reacted-text="'.$cff_translate_reacted_text.'" data-cff-and-text="'.$cff_translate_and_text.'" data-cff-other-text="'.$cff_translate_other_text.'" data-cff-others-text="'.$cff_translate_others_text.'" data-cff-reply-text="'.$cff_translate_reply_text.'" data-cff-replies-text="'.$cff_translate_replies_text.'"';

                                    //Expand comments box initially
                                    if( $cff_expand_comments ) $cff_comments .= ' style="display: block;"';
                                    //Number of comments to show initially
                                    $cff_comments .= ' data-num="' . $cff_comments_num . '"';
                                    $cff_comments .= ' data-cff-meta-link-color="' . $cff_meta_link_color . '"';
                                    $cff_comments .= ' data-cff-hide-avatars="' . $cff_hide_comment_avatars . '"';
                                    $cff_comments .= ' data-cff-expand-comments="' . $cff_expand_comments . '"';
                                    $cff_comments .= ' data-cff-post-tags="' . $cff_post_tags . '"';
                                    $cff_comments .= '>';


                                    //If it's a timeline event then change the $news object to be the original news object before it was changed to get the event comment count above
                                    if( $cff_post_type == 'event' ) $news = $news_event;
                                    
                                    //Get the likes
                                    //If there are likes and it's not an events only feed then add the likes section to the top of the comments box to be populated in JS
                                    if ( $like_count > 0 && ( $cff_events_only && $cff_events_source == 'eventspage' ) == false ){
                                        $cff_comments .= '<p class="cff-comment-likes cff-likes" ' . $cff_meta_styles . '></p>';
                                    }

                                    //If it's a timeline event then change the $news object to be the event object to get the event comment count above
                                    if( $cff_post_type == 'event' && isset($event_object) ) $news = $event_object;

                                    //Comment on Facebook link
                                    $cff_comments .= '<p class="cff-comments cff-comment-on-facebook" ' . $cff_meta_styles . '><a href="'.$link.'" '.$target.$cff_nofollow.' style="color:'.$cff_meta_link_color.'"><span class="cff-icon">'.$cff_comment_svg.'</span>'.$cff_translate_comment_on_facebook_text.'</a></p>';

                                    $cff_comments .= '<div class="cff-comments-wrap" ' . $cff_meta_styles . '>';

                                    //Display just the comments text
                                    if (!empty($news->comments->data)){
                                        //Give the comment an index so we know which one it is
                                        $comment_index = 0;

                                        //Loop through comments
                                        foreach ($news->comments->data as $comment_item ) {
                                            $comment = htmlentities($comment_item->message, ENT_QUOTES, 'UTF-8');

                                            //Create comments. These are replaced using JS.
                                            $cff_comments .= '<div class="cff-comment" id="cff_'.$comment_item->id.'" data-cff-comment-date="'.cff_timeSince(strtotime($comment_item->created_time), $cff_date_translate_strings) . ' ' . str_replace('"', '&quot;', $cff_date_after).'">';
                                            $cff_comments .= '<p ' . $cff_meta_styles . '>' . cff_autolink( $comment, $link_color=str_replace('#', '', $feed_options['sociallinkcolor']) ) . '</p>';
                                            $cff_comments .= '</div>'; //End .cff-comment

                                            $comment_index++;
                                        }
                                        
                                    }

                                    //Show more comments


                                    $cff_elipsis_svg = '<svg role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 150 320 200"><path d="M192 256c0 17.7-14.3 32-32 32s-32-14.3-32-32 14.3-32 32-32 32 14.3 32 32zm88-32c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm-240 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32z"></path></svg>';
                                    $cff_translate_view_previous_comments_text = $cff_elipsis_svg . '<span class="cff-screenreader">View more comments</span>';

                                    if ( $comment_count > $cff_comments_num ) $cff_comments .= '<p class="cff-comments cff-show-more-comments" ' . $cff_meta_styles . '><a class="cff-show-more-comments-a" href="javascript:void(0);" style="color:'.$cff_meta_link_color.'">'.$cff_translate_view_previous_comments_text.'</a></p>';

                                    $cff_comments .= '</div>';
                                    
                                    $cff_comments .= '</div>';
                                    
                                    //Compile comments if meta is included
                                    if ($cff_show_meta) $cff_meta_total .= $cff_comments;

                                } // End creating the comments box

                                //If it's an event then set the $news object back to the original posts data rather than the new event data object used to get the comments for the event
                                if( $cff_post_type == 'event' ) $news = $news_event;

                                //Calculate the z-index value so masonry comments won't overlap when opened
                                $zindex = intval($show_posts)+10 - $i;
                                //Converts negative values to be 1
                                $zindex = max($zindex, 1);

                                //CFF item styles
                                $cff_item_styles = '';
                                if( $cff_post_style == 'boxed' || $cff_post_bg_color_check ){
                                    $cff_item_styles = 'style="';
                                    $cff_item_styles .= 'z-index: '.$zindex.';';
                                    if($cff_post_bg_color_check) $cff_item_styles .= 'background-color: #' . $cff_post_bg_color . '; ';
                                    if( isset($cff_post_rounded) && $cff_post_rounded !== '0' && !empty($cff_post_rounded) ) $cff_item_styles .= '-webkit-border-radius: ' . $cff_post_rounded . 'px; -moz-border-radius: ' . $cff_post_rounded . 'px; border-radius: ' . $cff_post_rounded . 'px; ';
                                    $cff_item_styles .= '"';
                                }
                                if( $cff_post_style == 'regular' && ($cff_sep_color_check || $cff_sep_size_check) ){
                                    $cff_item_styles .= 'style="border-bottom: ' . $cff_sep_size . 'px solid #' . str_replace('#', '', $cff_sep_color) . '; z-index: '.$zindex.';"';
                                }

                                //**************************//
                                //***CREATE THE POST HTML***//
                                //**************************//

                                //Start the container
                                $cff_post_item .= '<div class="cff-item ';
                                $cff_post_type_class = ' cff-status-post';
                                if ($cff_post_type == 'link') $cff_post_type_class = 'cff-link-item';
                                if ($cff_post_type == 'event') $cff_post_type_class = 'cff-timeline-event';
                                if ($cff_post_type == 'photo' || $cff_post_type == 'album') $cff_post_type_class = 'cff-photo-post';
                                if ($cff_post_type == 'video' && !$cff_soundcloud) $cff_post_item .= 'cff-video-post';
                                if ($cff_soundcloud || $cff_spotify || $cff_post_type == 'music') $cff_post_item .= 'cff-audio-post ';
                                if ($cff_is_video_embed) $cff_post_item .= ' cff-embedded-video';
                                if ($cff_post_type == 'swf') $cff_post_type_class = 'cff-swf-post';
                                if ($cff_post_type == 'offer') $cff_post_type_class = 'cff-offer-post';
                                $cff_post_item .= $cff_post_type_class;

                                if ($cff_album) $cff_post_item .= ' cff-album';
                                if ($cff_post_bg_color_check || $cff_post_style == "boxed") $cff_post_item .= ' cff-box';
                                if( $cff_box_shadow ) $cff_post_item .= ' cff-shadow';
                                $cff_post_item .= ' author-';
                                if(isset($news->from->name)) $cff_post_item .= cff_to_slug($news->from->name);
                                $cff_post_item .= ' cff-' . $page_id;
                                $cff_post_item .= ' cff-new';
                                $cff_post_item .= '" id="cff_'. $cff_post_id .'"';
                    			$cff_post_item .= ' data-page-id="'.$page_id.'"';
                                $cff_post_item .= ' data-cff-timestamp="';
                                if( isset($news->created_time) ) $cff_post_item .= strtotime($news->created_time);
                                $cff_post_item .= '"';
                                $cff_post_item .= ' data-object-id="'.$object_id.'"';
                                if( isset($news->from->id) ) $cff_post_item .= ' data-cff-from="'.$news->from->id.'"';
                                $cff_post_item .= ' ' . $cff_item_styles . '>';

                                //POST AUTHOR
                                $cff_is_video_embed = false;
                                if($cff_is_video_embed){
                                    if($cff_show_author) $cff_post_item .= $cff_author;
                                    //DATE ABOVE
                                    if ($cff_show_date && $cff_date_position == 'above') $cff_post_item .= $cff_date;
                                    //If embedded video then show post text above the wrapper
                                    if($cff_show_text) $cff_post_item .= $cff_post_text;
                                    
                                    $cff_post_item .= '<div class="cff-embed-wrap">';
                                }


                                //Start text wrapper
                                if ( ($cff_thumb_layout || $cff_half_layout) && (!empty($news->picture) || ($cff_post_type == 'event' && $cff_event_has_cover_photo) || ($news->type == 'note' && $cff_note_media_src) ) ){
                                    $cff_post_item .= '<div class="cff-text-wrapper">';
                                }
                                    
                                    //POST AUTHOR
                                    if($cff_show_author && !$cff_is_video_embed) $cff_post_item .= $cff_author;
                                    //MEDIA
                                    if($cff_show_media && $cff_media_position == 'above'){
                                        if( $cff_post_type == 'event' ) $cff_media = $cff_timeline_event_photo;
                                        if( $news->type == 'note' ) $cff_media = $cff_note_picture_html;
                                        $cff_post_item .= $cff_media;
                                    }
                                    //DATE ABOVE
                                    if ($cff_show_date && $cff_date_position == 'above' && !$cff_is_video_embed) $cff_post_item .= $cff_date;
                                    //POST TEXT
                                    if( ($cff_show_text || $cff_show_desc) && !$cff_is_video_embed) $cff_post_item .= $cff_post_text;
                                    //LINK
                                    if($cff_show_shared_links) $cff_post_item .= $cff_shared_link;
                                    //DATE BELOW
                                    if ( (!$cff_show_author && $cff_date_position == 'author') || $cff_show_date && $cff_date_position == 'below' && !$cff_is_video_embed && ($cff_thumb_layout || $cff_half_layout) ) {
                                        if($cff_show_date && $cff_post_type !== 'event') $cff_post_item .= $cff_date;
                                    }

                                //End text wrapper
                                if ( ($cff_thumb_layout || $cff_half_layout) && (!empty($news->picture) || ($cff_post_type == 'event' && $cff_event_has_cover_photo) || ($news->type == 'note' && $cff_note_media_src) ) ){
                                    $cff_post_item .= '</div>';
                                }
                                
                                
                                //MEDIA
                                if($cff_show_media && $cff_media_position !== 'above') {
                                    if( $cff_post_type == 'event' ) $cff_media = $cff_timeline_event_photo;
                                    if( $news->type == 'note' ) $cff_media = $cff_note_picture_html;
                                    $cff_post_item .= $cff_media;
                                    if($cff_is_video_embed) $cff_post_item .= '</div>';
                                }
                                //DATE BELOW
                                if ($cff_show_date && $cff_date_position == 'below' && ( (!$cff_thumb_layout && !$cff_half_layout) || $cff_is_video_embed) ) $cff_post_item .= $cff_date;
                                if($cff_show_date && $cff_post_type == 'event' && ($cff_date_position == 'below' || ($cff_date_position == 'author' && !$cff_show_author) ) ){
                                    $cff_post_item .= $cff_date;
                                }
                                //META
                                if($cff_show_meta || $cff_show_link) $cff_post_item .= $cff_meta_total;
                                //End the post item
                                $cff_post_item .= '</div>';
                                // $cff_post_item .= '<div class="cff-clear"></div>';

                            } // End !$cff_photos_only || albums only || album embed

                            //REVIEWS
                            if($cff_reviews){
                                $cff_post_item = cff_ext_reviews($news, '', $feed_options, $page_id, $target, $cff_nofollow, $cff_author_styles, $cff_show_date, $cff_date_position, $cff_title_format, $cff_title_styles, $cff_posttext_link_color, $cff_see_more_text, $cff_date, $cff_title_link, $cff_see_less_text, $cff_show_facebook_link, $cff_post_bg_color_check, $post_time, $cff_item_styles, $cff_show_author, $cff_show_link, $cff_post_type, $link, $cff_link_styles, $cff_show_text, $cff_show_post, $cff_filter_string, $cff_exclude_string, $feed_options['pagetoken']);
                            }


                            //ALBUMS ONLY
                            if( ($cff_albums_only && $cff_albums_source == 'photospage') && empty($cff_album_id) ){

                                isset($news->link) ? $cff_album_link = $news->link : $cff_album_link = '';
                                isset($news->name) ? $cff_album_name = $news->name : $cff_album_name = '';
                                isset($news->description) ? $cff_album_description = $news->description : $cff_album_description = '';

                                $cff_show_post = true;
                                //Get the filter string
                                $cff_filter_string = $feed_options[ 'filter' ];

                                if ( $cff_filter_string != '' ){
                                    //Explode it into multiples
                                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                                    
                                    $cff_text_to_be_filtered = $cff_album_name . ' ' . $cff_album_description;

                                    if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_filter_strings_array) === false ) $cff_show_post = false;
                                }


                                $cff_exclude_string = $feed_options[ 'exfilter' ];
                                if ( $cff_exclude_string != '' ){
                                    //Explode it into multiples
                                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                    
                                    $cff_text_to_be_filtered = $cff_album_name . ' ' . $cff_album_description;

                                    if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                                }

                                //Encode text after filtering is done
                                $cff_album_name = htmlentities($cff_album_name, ENT_QUOTES, 'UTF-8');
                                $cff_album_description = htmlentities($cff_album_description, ENT_QUOTES, 'UTF-8');

                                if( $cff_show_post ){

                                    $cff_cover_photos_available = true;
                                    $album_full_picture = '';
                                    $thumb = '';

                                    //ALBUMS ONLY
                                    if($cff_is_group){ //Groups need to use token in the request:
                                        if( isset($news->cover_photo->id) ){
                                            $thumb = 'https://graph.facebook.com/' . $news->cover_photo->id . '/picture?access_token='.$access_token;
                                        } else {
                                            $thumb = '';
                                            $cff_cover_photos_available = false;
                                        }
                                    } else {
                                        if( isset($news->cover_photo) ){

                                            if( isset($news->cover_photo->source) ){
                                                $thumb = $news->cover_photo->source;
                                            } else if( isset($news->cover_photo->id) ){
                                                $thumb = 'https://graph.facebook.com/' . $news->cover_photo->id . '/picture';
                                            } else {
                                                $thumb = '';
                                                $cff_cover_photos_available = false;
                                            }

                                        }
                                    }


                                    isset($news->count) ? $cff_album_count = $news->count : $cff_album_count = '';

                                    //Cover photos aren't available for group albums unless using a User Access Token
                                    $cff_post_item = '<div class="cff-album-item cff-albums-only cff-col-';
                                    $cff_post_item .= $cff_album_cols;
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= ' cff-new" ';
                    				$cff_post_item .= ' data-page-id="'.$page_id.'"';
                                    $cff_post_item .= ' data-cff-timestamp="';
                                    if( isset($news->created_time) ) $cff_post_item .= strtotime($news->created_time);
                                    $cff_post_item .= '"';
                                    $cff_post_item .= 'id="cff_'. $news->id .'">';

                                    //Fix Photon (Jetpack) issue
                                    $cff_picture_querystring = '';
                                    if (parse_url($thumb, PHP_URL_QUERY)){
                                        $picture_url_parts = parse_url($thumb);
                                        $cff_picture_querystring = $picture_url_parts['query'];
                                    }

                                    if( $cff_cover_photos_available ) $cff_post_item .= '<a href="' . $cff_album_link . '" class="cff-album-cover nofancybox" '.$target.$cff_nofollow.'><img src="'.$thumb.'" alt="' . $cff_album_name . '" data-querystring="'.$cff_picture_querystring.'"data-cff-full-img="'.$album_full_picture.'" /></a>';
                                    if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '<div class="cff-album-info">';
                                    if($cff_show_album_title) $cff_post_item .= '<h4><a href="' . $cff_album_link . '" '.$target.$cff_nofollow.'>' . $cff_album_name . '</a></h4>';
                                    if( $cff_show_album_number && isset($news->count) ) $cff_post_item .= '<p>' . $cff_album_count . ' '. $cff_translate_photos_text . '</p>';
                                    if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '</div>';
                                    $cff_post_item .= '</div>';

                                    //Group albums use 'created' instead of 'created_time' like other posts
                                    if($cff_is_group){
                                        ( isset($news->created) ) ? $post_time = $news->created : $post_time = $news->created_time;
                                    } else {
                                        //By default albums aren't ordered by date as we use the native order of the API (which is based on when a photo was last added to an album) but for multifeed we need to use the date to order them and so set it to be the updated_time so that when we order the array then it's more accurate as they're more likely to be based on when a photo was added than the created_time
                                        if( $cff_ext_multifeed_active && count($page_ids) > 1 ){
                                            ( isset($news->updated_time) ) ? $post_time = $news->updated_time : $post_time = $news->created_time;
                                        }
                                        
                                        //If there's no photos in the album then don't show it
                                        if( !isset($news->cover_photo) ){
                                            $cff_post_item = '<p class="cff-empty-album';
                                            if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                            $cff_post_item .= '"></p>';
                                        }
                                    }

                                }

                                //If the album item is filtered out then set it to be an empty album item so that it doesn't affect the offset pagination
                                if( empty($cff_post_item) ){
                                    $cff_post_item = '<p class="cff-empty-album';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '"></p>';
                                }
                                
                            }

                            //ALBUM EMBED
                            if( $cff_album_active && !empty($cff_album_id) ){

                                isset($news->name) ? $cff_album_desc = $news->name : $cff_album_desc = '';

                                $cff_show_post = true;
                                //Get the filter string
                                $cff_filter_string = $feed_options[ 'filter' ];

                                if ( $cff_filter_string != '' ){
                                    //Explode it into multiples
                                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                                    //Hide the post if both the post text and description don't contain the string
                                    $string_in_post_text = true;
                                    $string_in_desc = true;
                                    if ( cff_stripos_arr_filter($cff_album_desc, $cff_filter_strings_array) === false ) $cff_show_post = false;
                                }

                                $cff_exclude_string = $feed_options[ 'exfilter' ];
                                if ( $cff_exclude_string != '' ){
                                    //Explode it into multiples
                                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                    //Hide the post if both the post text and description don't contain the string
                                    $string_in_post_text = false;
                                    $string_in_desc = false;
                                    if ( cff_stripos_arr_filter($cff_album_desc, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                                }

                                //Encode text after filtering
                                $cff_album_desc = htmlentities($cff_album_desc, ENT_QUOTES, 'UTF-8');

                                //Escape quotes
                                $cff_album_desc = str_replace( '"', '&quot;', $cff_album_desc );

                                if( $cff_show_post ){
                                    $cff_post_item = '<div class="cff-album-item cff-col-';
                                    $cff_post_item .= $cff_album_cols;
                                    

                                    //Fix Photon (Jetpack) issue
                                    $cff_picture_querystring = '';
                                    if (parse_url($news->source, PHP_URL_QUERY)){
                                        $picture_url_parts = parse_url($news->source);
                                        $cff_picture_querystring = $picture_url_parts['query'];
                                    }

                                    //Add the full size image source to an attr so can be added to the lightbox link
                                    ( isset($news->images) ) ? $cff_full_size_image = $news->images[0]->source : $cff_full_size_image = '';

                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= ' cff-new';
                                    $cff_post_item .= '" id="cff_'. $news->id .'"';
                                    $cff_post_item .= ' data-cff-timestamp="';
                                    if( isset($news->created_time) ) $cff_post_item .= strtotime($news->created_time);
                                    $cff_post_item .= '"';
                                    $cff_post_item .= ' data-object-id="'.$object_id.'"';
                                    $cff_post_item .= ' data-cff-full-size="'.$cff_full_size_image.'">';
                                    $cff_post_item .= '<a href="https://facebook.com/'.$news->id.'" class="cff-album-cover nofancybox" '.$target.$cff_nofollow.'><img src="'. $news->source .'" alt="'.$cff_album_desc.'" data-querystring="'.$cff_picture_querystring.'" /></a>';
                                    $cff_post_item .= '</div>';
                                    $post_time = $i;
                                }

                                //If the album item is filtered out then set it to be an empty album item so that it doesn't affect the offset pagination
                                if( empty($cff_post_item) ){
                                    $cff_post_item = '<p class="cff-empty-album';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '"></p>';
                                }
                            }


                            //VIDEOS ONLY
                            if($cff_videos_only && empty($cff_album_id)){
                                $cff_post_item = '';

                                isset($news->description) ? $description_text = $news->description : $description_text = '';
                                isset($news->title) ? $video_name = $news->title : $video_name = '';

                                $cff_filter_string = $feed_options[ 'filter' ];
                                $cff_show_post = true;

                                if ( $cff_filter_string != '' ){
                                    //Explode it into multiples
                                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                                    
                                    $cff_text_to_be_filtered = $video_name . ' ' . $description_text;

                                    if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_filter_strings_array) === false ) $cff_show_post = false;
                                }

                                $cff_exclude_string = $feed_options[ 'exfilter' ];
                                if ( $cff_exclude_string != '' ){
                                    //Explode it into multiples
                                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                    
                                    $cff_text_to_be_filtered = $video_name . ' ' . $description_text;

                                    if ( cff_stripos_arr_filter($cff_text_to_be_filtered, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                                }

                                //Check to see if a duplicate video with the same source exists. If so, then exclude it as it's likely not meant to be included.
                                if( isset($news->source) ){
                                    if( $i > 1 ){ //No need to check the first video
                                        //If the source matches that of the video before then exclude it
                                        if( $news->source == $json_data->data[$i-2]->source ){
                                            $cff_show_post = false;
                                        }
                                    }
                                }

                                //Encode text after filtering
                                $description_text = htmlentities($description_text, ENT_QUOTES, 'UTF-8');
                                $video_name = htmlentities($video_name, ENT_QUOTES, 'UTF-8');

                                if( $cff_show_post ){

                                    foreach ($news->format as $value) {
                                        //If there's a large image then use it
                                        if( isset( $value->picture ) ){
                                            $poster = $value->picture;
                                        //Otherwise use the small one
                                        } else if( isset( $news->picture ) ) {
                                            $poster = $news->picture;
                                        } else {
                                            $poster = '';
                                        }
                                    }

                                    $poster_alt = $video_name;
                                    if( !empty($video_name) && !empty($description_text) ) $poster_alt .= ' - ';
                                    $poster_alt .= $description_text;

                                    //Fix Photon (Jetpack) issue
                                    $cff_picture_querystring = '';
                                    if (parse_url($poster, PHP_URL_QUERY)){
                                        $picture_url_parts = parse_url($poster);
                                        $cff_picture_querystring = $picture_url_parts['query'];
                                    }

                                    $cff_post_item .= '<div class="cff-album-item cff-video cff-col-' . $cff_video_cols . ' cff-new';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '" id="cff_' . $news->id . '" data-object-id="'.$object_id.'"';
                                    $cff_post_item .= ' data-cff-timestamp="';
                                    if( isset($news->created_time) ) $cff_post_item .= strtotime($news->created_time);
                                    $cff_post_item .= '"';
                                    $cff_video_player = $feed_options[ 'videoplayer' ];

                                    //If there's no videos source then switch to the Facebook Video Player
                                    if( !isset($news->source) ) $cff_video_player = 'facebook';

                                    $cff_post_item .= ' data-cff-video-link="https://www.facebook.com/smashballoondev/videos/'.$news->id.'" data-cff-video-player="'.$cff_video_player.'"';
                                    $cff_post_item .= '>';

                                    isset($news->source) ? $cff_vid_source = $news->source : $cff_vid_source = '';

                                    $cff_post_item .= '<a href="https://facebook.com/' . $news->id . '" class="cff-album-cover cff-video" ' . $target . $cff_nofollow . ' id="' . $news->id . '" data-source="' . $cff_vid_source . '"><span class="fa fa-play cff-playbtn" aria-hidden="true"></span><img src="' . $poster . '" alt="' . $poster_alt . '" data-querystring="'.$cff_picture_querystring.'" /></a>';

                                    if($cff_show_video_name) $cff_post_item .= '<div class="cff-album-info">';
                                        if( $cff_show_video_name && !empty($video_name) ) $cff_post_item .= '<h4><a href="https://facebook.com/' . $news->id . '" '.$target.$cff_nofollow.'>' . $video_name . '</a></h4>';
                                        
                                        if($cff_show_video_desc){
                                            $cff_post_item .= '<p>' . substr($description_text, 0, 50);
                                            if( strlen($description_text) > 50 ) $cff_post_item .= '...';
                                            $cff_post_item .= '</p>';
                                        }

                                    if($cff_show_video_name) $cff_post_item .= '</div>';

                                    $cff_post_item .= '</div>';
                                    $post_time = $i;
                                }

                                //If the album item is filtered out then set it to be an empty album item so that it doesn't affect the offset pagination
                                if( empty($cff_post_item) ){
                                    $cff_post_item = '<p class="cff-empty-album';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '"></p>';
                                }

                            }


                            //PHOTOS ONLY
                            if($cff_photos_only && empty($cff_album_id)){

                                //Get the caption
                                !empty($news->name) ? $cff_caption = $news->name : $cff_caption = ' ';
                                $id = $news->id;
                                $picture = $news->picture;

                                $cff_filter_string = $feed_options[ 'filter' ];
                                $cff_show_post = true;

                                if ( $cff_filter_string != '' ){
                                    //Explode it into multiples
                                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                                    //Hide the post if both the post text and description don't contain the string
                                    $string_in_post_text = true;
                                    $string_in_desc = true;
                                    if ( cff_stripos_arr_filter($cff_caption, $cff_filter_strings_array) === false ) $cff_show_post = false;
                                }

                                $cff_exclude_string = $feed_options[ 'exfilter' ];
                                if ( $cff_exclude_string != '' ){
                                    //Explode it into multiples
                                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                                    //Hide the post if both the post text and description don't contain the string
                                    $string_in_post_text = false;
                                    $string_in_desc = false;
                                    if ( cff_stripos_arr_filter($cff_caption, $cff_exclude_strings_array) !== false ) $cff_show_post = false;
                                }

                                //Encode text after filtering
                                $cff_caption = htmlentities($cff_caption, ENT_QUOTES, 'UTF-8');

                                $cff_post_item = '';

                                if( $cff_show_post ){

                                    //Get full size image
                                    if (!empty($picture)) $picture = 'https://graph.facebook.com/'.$id.'/picture?type=normal&width=9999&height=9999';
                                    if (!empty($picture) && isset($news->images)) $full_picture = $news->images[0]->source;

                                    //Loop through images array to find the right size
                                    $image_to_use = $picture;
                                    foreach ( $news->images as $image ) {
                                        if( $image->width > 500 && $image->width < 900 ){
                                            $image_to_use = $image->source;
                                        }
                                    }

                                    //Fix Photon (Jetpack) issue
                                    $cff_picture_querystring = '';
                                    if (parse_url($image_to_use, PHP_URL_QUERY)){
                                        $picture_url_parts = parse_url($image_to_use);
                                        $cff_picture_querystring = $picture_url_parts['query'];
                                    }


                                    $cff_post_item .= '<div class="cff-album-item cff-col-'.$cff_photos_cols.' cff-new';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '" id="cff_'. $id .'" data-cff-full-size="'.$full_picture.'"';
                                    $cff_post_item .= ' data-cff-timestamp="';
                                    if( isset($news->created_time) ) $cff_post_item .= strtotime($news->created_time);
                                    $cff_post_item .= '">';

                                    $cff_post_item .= '<a href="'.$news->link.'" class="cff-album-cover nofancybox" '.$target.$cff_nofollow.'><img src="'. $image_to_use .'" alt="'.$cff_caption.'" data-querystring="'.$cff_picture_querystring.'" /></a>';
                                    $cff_post_item .= '</div>';
                                }

                                //If the album item is filtered out then set it to be an empty album item so that it doesn't affect the offset pagination
                                if( empty($cff_post_item) ){
                                    $cff_post_item = '<p class="cff-empty-album';
                                    if( isset($page_id) ) $cff_post_item .= ' cff-' . $page_id;
                                    $cff_post_item .= '"></p>';
                                }

                                //Have to use $i instead of the post_time otherwise if a photo is added at the same time then as another then it replaces it in the array. We shuffle the array below if it's multifeed.
                                $cff_posts_array = cff_array_push_assoc($cff_posts_array, $i, $cff_post_item);


                            } else {
                                //PUSH POSTS TO ARRAY

                                //If it's a page or a multifeed (always need to order posts by date in multifeeds) then use post date to order them
                                if( $cff_ext_multifeed_active && count($page_ids) > 1 ){
                                    $cff_posts_array = cff_array_push_assoc($cff_posts_array, $post_time, $cff_post_item);
                                } else {
                                //If it's a group then respect the order in the Facebook API (based on activity)
                                    $cff_posts_array = cff_array_push_assoc($cff_posts_array, $i, $cff_post_item);
                                }

                            }

                        } // End offset
                        
                    } // End post type check

                    if (isset($news->message)) $prev_post_message = $news->message;
                    if (isset($news->link))  $prev_post_link = $news->link;
                    if (isset($news->description))  $prev_post_description = $news->description;
                } // End the loop

            } // End if($json_data) check
            
            if( $cff_photos_only && empty($cff_album_id)){
                //PHOTOS ONLY
                //If it's a multifeed photo feed then shuffle the images together as can't order them by date as if two photos have the same date then one isn't shown
                if($cff_ext_multifeed_active && count($page_ids) > 1) shuffle($cff_posts_array);

            } else if( $cff_album_active && !empty($cff_album_id) || $cff_videos_only || $cff_albums_only ) {
                //Don't sort array. Display posts in their native order, unless multifeed is enabled then we need to sort by date.
                if($cff_ext_multifeed_active && count($page_ids) > 1) krsort($cff_posts_array);
            } else {
                //Sort the array in reverse order (newest first)
                if( $cff_ext_multifeed_active && count($page_ids) > 1 ){
                    krsort($cff_posts_array);
                } else {
                    ksort($cff_posts_array);
                }
            }

        } // End ALL POSTS

    } // END PAGE_IDS LOOP

    if ($cff_events_only && $cff_events_source == 'eventspage'){
        //EVENTS ONLY OFFSET - Use offset to remove items from the array which shouldn't be shown
        if( !empty($feed_options['offset']) ) $cff_posts_array = array_slice($cff_posts_array, intval($feed_options['offset']));

        //If no events then add notice
        if ( empty($cff_posts_array) ) $cff_posts_array = cff_array_push_assoc($cff_posts_array, 1, '<p class="cff-no-events">'.stripslashes(__( $cff_no_events_text, 'custom-facebook-feed' ) ).'</p>');
    }

    $cff_load_more = $feed_options['loadmore'];
    ($cff_load_more || $cff_load_more == 'true' || $cff_load_more == 'on') ? $cff_load_more = true : $cff_load_more = false;
    if( $feed_options[ 'loadmore' ] === 'false' ) $cff_load_more = false;

    //Output the posts array
    if($cff_photos_only && empty($cff_album_id)){
        //PHOTOS ONLY
        $p = 0;
        foreach ($cff_posts_array as $post ) {
            if ( $p == $show_posts ) break;
            $cff_content .= $post;
            $p++;
        }
    //If it's an events feed and pagination is enabled then render all the events to the page so pagination can be done in JS
    } else if( $cff_load_more && ( ($cff_events_only && $cff_events_source == 'eventspage') || ( $cff_reviews && $show_all_reviews ) ) ){
        foreach ($cff_posts_array as $post ) {
            $cff_content .= $post;
        }
    } else {
        $p = 0;
        foreach ($cff_posts_array as $post ) {

            //For album items. If it's an empty album post then don't include it in the count and show another post instead.
            if( strpos($post, 'cff-empty-album') !== false ) $p--;

            if ( $p == $show_posts ) break;
            $cff_content .= $post;
            $p++;
        }
    }

    //Reset the timezone
    date_default_timezone_set( $cff_orig_timezone );

    //Return our feed HTML to display
    return $cff_content;

}


// this is the php function called by the ajax fired on the "load more" click.
// It processes the raw $_POST data and uses it in the same functions as before
// but with new data from a dynamically selected json file.
function cff_get_new_posts(){

    //Get posted values from the ajax request
    $shortcode_data = json_decode( str_replace( '\"', '"', $_POST['shortcode_data'] ), true ); // necessary to unescape quotes
    isset($_POST['pag_url']) ? $next_urls_arr_safe = json_decode( str_replace( '\"', '"', $_POST['pag_url'] ), true ) : $next_urls_arr_safe = '';
    // isset($_POST['last_album_batch']) ? $last_album_batch = $_POST['last_album_batch'] : $last_album_batch = 'false';

    //Store the previous pag URL so that we can use it on the button for album items
    $prev_pag_url = json_encode( $next_urls_arr_safe );
    $prev_pag_url = str_replace( '"', '&quot;', $prev_pag_url);

    //Run the functions to get more posts
    $feed_options = cff_get_processed_options( $shortcode_data );
    $json_data_arr = cff_get_json_data( $feed_options, $next_urls_arr_safe, $shortcode_data );
    isset($json_data_arr) ? $next_urls_arr_safe = cff_get_next_url_parts( $json_data_arr ) : $next_urls_arr_safe = '';
    $html = cff_get_post_set_html( $feed_options, $json_data_arr );

    echo $html;
    // hidden input field added each time with the new "next url" information
    echo '<input class="cff-pag-url" type="hidden" data-cff-pag-url="'.$next_urls_arr_safe.'" data-cff-prev-url="'.$prev_pag_url.'" val="">';

    die();
}
add_action( 'wp_ajax_nopriv_cff_get_new_posts', 'cff_get_new_posts' );
add_action( 'wp_ajax_cff_get_new_posts', 'cff_get_new_posts' );


//***********************************//
//*********CACHING FUNCTION**********//
//***********************************//

function cff_get_set_cache($cff_posts_json_url, $transient_name, $cff_cache_time, $cache_seconds, $data_att_html, $cff_show_access_token, $access_token) {

    if( $cff_show_access_token && strlen($access_token) > 130 ){
        //If using a Page Access Token then set caching time to be minimum of 1 minutes
        if( $cache_seconds < 60 || !isset($cache_seconds) ) $cache_seconds = 60;
    } else {
        //Set caching time to be minimum of 30 minutes
        if( $cache_seconds < 1800 || !isset($cache_seconds) ) $cache_seconds = 1800;

        //Temporarily increase default caching time to be 3 hours
        if( $cache_seconds == 3600 ) $cache_seconds = 10800;
    }

    //Don't use caching if the cache time is set to zero
    if ($cff_cache_time != 0){

        // Get any existing copy of our transient data
        if ( false === ( $posts_json = get_transient( $transient_name ) ) || $posts_json === null ) {
            //Get the contents of the Facebook page
            $posts_json = cff_fetchUrl($cff_posts_json_url);
            
            //Check whether any data is returned from the API. If it isn't then don't cache the error response and instead keep checking the API on every page load until data is returned.
            $FBdata = json_decode($posts_json);

            //Check whether the JSON is wrapped in a "data" property as if it doesn't then it's a featured post
            $prefix_data = '{"data":';
            (substr($posts_json, 0, strlen($prefix_data)) == $prefix_data) ? $cff_featured_post = false : $cff_featured_post = true;

            //Add API URL to beginning of JSON array
            $prefix = '{';
            if (substr($posts_json, 0, strlen($prefix)) == $prefix) $posts_json = substr($posts_json, strlen($prefix));
            
            //Encode and replace quotes so can be stored as a string
            $data_att_html = str_replace( '"', '&quot;', json_encode($data_att_html) );
            $posts_json = '{"api_url":"'.$cff_posts_json_url.'", "shortcode_options":"'.$data_att_html.'", ' . $posts_json;

            //If it's a featured post then it doesn't contain 'data'
            ( $cff_featured_post ) ? $FBdata = $FBdata : $FBdata = $FBdata->data;

            if( !empty($FBdata) ) {

                //If it's a rate limit error then don't cache the response so another token can be used
                if (strpos($posts_json, '"error":{"message":"(#4) Application request limit reached",') == false && strpos($posts_json, 'Error validating application. Application has been deleted.') == false) {
                    //Cache the JSON
                    set_transient( $transient_name, $posts_json, $cache_seconds );
                }

            }
        } else {
            $posts_json = get_transient( $transient_name );
            //If we can't find the transient then fall back to just getting the json from the api
            if ($posts_json == false) $posts_json = cff_fetchUrl($cff_posts_json_url);
        }
    } else {
        $posts_json = cff_fetchUrl($cff_posts_json_url);
    }

    return $posts_json;

} //End cff_get_set_cache


//***FUNCTIONS***
function cff_cache_meta() {
    global $wpdb;

    $cff_cache_time = get_option('cff_cache_time');
    $cff_cache_time_unit = get_option('cff_cache_time_unit');

    //Don't allow cache time to be zero - set to 1 minute instead to minimize API requests
    if(!isset($cff_cache_time) || $cff_cache_time == '0' || (intval($cff_cache_time) < 15 && $cff_cache_time_unit == 'minutes' ) ){
        $cff_cache_time = 15;
        $cff_cache_time_unit = 'minutes';
    }

    //Calculate the cache time in seconds
    if($cff_cache_time_unit == 'minutes') $cff_cache_time_unit = 60;
    if($cff_cache_time_unit == 'hour' || $cff_cache_time_unit == 'hours') $cff_cache_time_unit = 60*60;
    if($cff_cache_time_unit == 'days') $cff_cache_time_unit = 60*60*24;
    $cache_seconds = $cff_cache_time * $cff_cache_time_unit;

    //Temporarily increase default caching time to be 3 hours
    if( $cache_seconds == 3600 ) $cache_seconds = 10800;

    //Extra check to make sure caching isn't set to be less than 2 hours
    if( $cache_seconds < 7200 || !isset($cache_seconds) ) $cache_seconds = 7200;

    if($cff_cache_time == 'nocaching') $cache_seconds = 0;

    $transient_name = 'cff_meta';
    isset($_POST['metadata']) ? $meta_data = $_POST['metadata'] : $meta_data = '';


    //Add the new data to the existing data and cache it all
    if ( false === get_transient( $transient_name ) ) {
        //If there's no existing data to add to then just cache the new data sent from the API
        $new_data = $meta_data;
    } else {
        //Get the existing data from the DB
        $existing_data = get_transient( $transient_name );

        //Trim the ending bracket from the existing data array
        $existing_data = preg_replace('/%7D$/', '', $existing_data);

        //Trim the start of the new data array to be added
        $prefix = "%7B";
        if (substr($meta_data, 0, strlen($prefix)) == $prefix) {
            $meta_data = substr($meta_data, strlen($prefix));
        }

        //Add the two arrays together with a commas in between
        $new_data = $existing_data . ',' . $meta_data;
    }

    set_transient( $transient_name, $new_data, $cache_seconds );
}
add_action('wp_ajax_cache_meta', 'cff_cache_meta');
add_action('wp_ajax_nopriv_cache_meta', 'cff_cache_meta');


function cff_get_meta() {
    global $wpdb;

    $cached_data = get_transient('cff_meta');

    print $cached_data;

    die();
}
add_action('wp_ajax_get_meta', 'cff_get_meta');
add_action('wp_ajax_nopriv_get_meta', 'cff_get_meta');


function cff_mb_substr_replace($string, $replacement, $start, $length=NULL) {
    if (is_array($string)) {
        $num = count($string);
        // $replacement
        $replacement = is_array($replacement) ? array_slice($replacement, 0, $num) : array_pad(array($replacement), $num, $replacement);
        // $start
        if (is_array($start)) {
            $start = array_slice($start, 0, $num);
            foreach ($start as $key => $value)
                $start[$key] = is_int($value) ? $value : 0;
        }
        else {
            $start = array_pad(array($start), $num, $start);
        }
        // $length
        if (!isset($length)) {
            $length = array_fill(0, $num, 0);
        }
        elseif (is_array($length)) {
            $length = array_slice($length, 0, $num);
            foreach ($length as $key => $value)
                $length[$key] = isset($value) ? (is_int($value) ? $value : $num) : 0;
        }
        else {
            $length = array_pad(array($length), $num, $length);
        }
        // Recursive call
        return array_map(__FUNCTION__, $string, $replacement, $start, $length);
    }
    preg_match_all('/./us', (string)$string, $smatches);
    preg_match_all('/./us', (string)$replacement, $rmatches);
    if ($length === NULL) $length = mb_strlen($string);
    array_splice($smatches[0], $start, $length, $rmatches[0]);
    return join($smatches[0]);
}

//Get JSON object of feed data
function cff_fetchUrl($url){

    //Style options
    $options = get_option('cff_style_settings');
    isset( $options['cff_request_method'] ) ? $cff_request_method = $options['cff_request_method'] : $cff_request_method = 'auto';

    if($cff_request_method == '1'){
        //Use cURL
        if(is_callable('curl_init')){
            $ch = curl_init();
            // Use global proxy settings
            if (defined('WP_PROXY_HOST')) {
              curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
            }
            if (defined('WP_PROXY_PORT')) {
              curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
            }
            if (defined('WP_PROXY_USERNAME')){
              $auth = WP_PROXY_USERNAME;
              if (defined('WP_PROXY_PASSWORD')){
                $auth .= ':' . WP_PROXY_PASSWORD;
              }
              curl_setopt($ch, CURLOPT_PROXYUSERPWD, $auth);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            $feedData = curl_exec($ch);
            curl_close($ch);
        }
    } else if($cff_request_method == '2') {
        //Use file_get_contents
        if ( (ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) && in_array('https', stream_get_wrappers()) ){
            $feedData = @file_get_contents($url);
        }
    } else if($cff_request_method == '3'){
        //Use the WP HTTP API
        $request = new WP_Http;
        $response = $request->request($url, array('timeout' => 60, 'sslverify' => false));
        if( is_wp_error( $response ) ) {
            //Don't display an error, just use the Server config Error Reference message
            $FBdata = null;
        } else {
            $feedData = wp_remote_retrieve_body($response);
        }
    } else {
        //Auto detect
        if(is_callable('curl_init')){
            $ch = curl_init();
            // Use global proxy settings
            if (defined('WP_PROXY_HOST')) {
              curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
            }
            if (defined('WP_PROXY_PORT')) {
              curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
            }
            if (defined('WP_PROXY_USERNAME')){
              $auth = WP_PROXY_USERNAME;
              if (defined('WP_PROXY_PASSWORD')){
                $auth .= ':' . WP_PROXY_PASSWORD;
              }
              curl_setopt($ch, CURLOPT_PROXYUSERPWD, $auth);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            $feedData = curl_exec($ch);
            curl_close($ch);
        } elseif ( (ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) && in_array('https', stream_get_wrappers()) ) {
            $feedData = @file_get_contents($url);
        } else {
            $request = new WP_Http;
            $response = $request->request($url, array('timeout' => 60, 'sslverify' => false));
            if( is_wp_error( $response ) ) {
                $FBdata = null;
            } else {
                $feedData = wp_remote_retrieve_body($response);
            }
        }
    }
    
    return $feedData;
}

//Make links into span instead when the post text is made clickable
function cff_wrap_span($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'cff_wrap_span_callback', $text);
}
function cff_wrap_span_callback($matches) {
    $max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        if(isset($parts['scheme']) && isset($parts['host'])) $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    return "<span class='cff-break-word'>$url_short</span>";
}

//Link @[] or \u0040[Page ID:274:Page Name] post tagging format
function cff_desc_tags($description){
    preg_match_all( "/@\[(.*?)\]/", $description, $cff_tag_matches );
    $replace_strings_arr = array();
    foreach ( $cff_tag_matches[1] as $cff_tag_match ) {
        $cff_tag_parts = explode( ':', $cff_tag_match );
        $replace_strings_arr[] = '<a href="https://facebook.com/'.$cff_tag_parts[0].'">'.$cff_tag_parts[2].'</a>';
    }
    $cff_tag_iterator = 0;
    $cff_description_tagged = '';
    $cff_text_split = preg_split( "/@\[(.*?)\]/" , $description );
    foreach ( $cff_text_split as $cff_desc_split ) {
        if ( $cff_tag_iterator < count( $replace_strings_arr ) ) {
            $cff_description_tagged .= $cff_desc_split . $replace_strings_arr[ $cff_tag_iterator ];
        } else {
            $cff_description_tagged .= $cff_desc_split;
        }
        $cff_tag_iterator++;
    }

    return $cff_description_tagged;
}

//2013-04-28T21:06:56+0000
//Time stamp function - used for posts
function cff_getdate($original, $date_format, $custom_date, $cff_date_translate_strings) {

    switch ($date_format) {
        
        case '2':
            $print = date_i18n('F jS, g:i a', $original);
            break;
        case '3':
            $print = date_i18n('F jS', $original);
            break;
        case '4':
            $print = date_i18n('D F jS', $original);
            break;
        case '5':
            $print = date_i18n('l F jS', $original);
            break;
        case '6':
            $print = date_i18n('D M jS, Y', $original);
            break;
        case '7':
            $print = date_i18n('l F jS, Y', $original);
            break;
        case '8':
            $print = date_i18n('l F jS, Y - g:i a', $original);
            break;
        case '9':
            $print = date_i18n("l M jS, 'y", $original);
            break;
        case '10':
            $print = date_i18n('m.d.y', $original);
            break;
        case '11':
            $print = date_i18n('m/d/y', $original);
            break;
        case '12':
            $print = date_i18n('d.m.y', $original);
            break;
        case '13':
            $print = date_i18n('d/m/y', $original);
            break;
        case '14':
            $print = date_i18n('d-m-Y, G:i', $original);
            break;
        case '15':
            $print = date_i18n('jS F Y, G:i', $original);
            break;
        case '16':
            $print = date_i18n('d M Y, G:i', $original);
            break;
        case '17':
            $print = date_i18n('l jS F Y, G:i', $original);
            break;
        case '18':
            $print = date_i18n('m.d.y - G:i', $original);
            break;
        case '19':
            $print = date_i18n('d.m.y - G:i', $original);
            break;
        default:

            $cff_second = $cff_date_translate_strings['cff_translate_second'];
            $cff_seconds = $cff_date_translate_strings['cff_translate_seconds'];
            $cff_minute = $cff_date_translate_strings['cff_translate_minute'];
            $cff_minutes = $cff_date_translate_strings['cff_translate_minutes'];
            $cff_hour = $cff_date_translate_strings['cff_translate_hour'];
            $cff_hours = $cff_date_translate_strings['cff_translate_hours'];
            $cff_day = $cff_date_translate_strings['cff_translate_day'];
            $cff_days = $cff_date_translate_strings['cff_translate_days'];
            $cff_week = $cff_date_translate_strings['cff_translate_week'];
            $cff_weeks = $cff_date_translate_strings['cff_translate_weeks'];
            $cff_month = $cff_date_translate_strings['cff_translate_month'];
            $cff_months = $cff_date_translate_strings['cff_translate_months'];
            $cff_year = $cff_date_translate_strings['cff_translate_years'];
            $cff_years = $cff_date_translate_strings['cff_translate_years'];
            $cff_ago = $cff_date_translate_strings['cff_translate_ago'];

            
            $periods = array($cff_second, $cff_minute, $cff_hour, $cff_day, $cff_week, $cff_month, $cff_year, "decade");
            $periods_plural = array($cff_seconds, $cff_minutes, $cff_hours, $cff_days, $cff_weeks, $cff_months, $cff_years, "decade");

            $lengths = array("60","60","24","7","4.35","12","10");
            $now = time();
            
            // is it future date or past date
            if($now > $original) {    
                $difference = $now - $original;
                $tense = $cff_ago;
            } else {
                $difference = $original - $now;
                $tense = $cff_ago;
            }
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j] = $periods_plural[$j];
            }
            $print = "$difference $periods[$j] {$tense}";
            break;
        
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }
    return $print;
}
function cff_eventdate($original, $date_format, $custom_date) {

    switch ($date_format) {
        
        case '2':
            $print = date_i18n('<k>F jS, </k>g:ia', $original);
            break;
        case '3':
            $print = date_i18n('g:ia<k> - F jS</k>', $original);
            break;
        case '4':
            $print = date_i18n('g:ia<k>, F jS</k>', $original);
            break;
        case '5':
            $print = date_i18n('<k>l F jS - </k> g:ia', $original);
            break;
        case '6':
            $print = date_i18n('<k>D M jS, Y, </k>g:iA', $original);
            break;
        case '7':
            $print = date_i18n('<k>l F jS, Y, </k>g:iA', $original);
            break;
        case '8':
            $print = date_i18n('<k>l F jS, Y - </k>g:ia', $original);
            break;
        case '9':
            $print = date_i18n("<k>l M jS, 'y</k>", $original);
            break;
        case '10':
            $print = date_i18n('<k>m.d.y - </k>g:iA', $original);
            break;
        case '11':
            $print = date_i18n('<k>m/d/y, </k>g:ia', $original);
            break;
        case '12':
            $print = date_i18n('<k>d.m.y - </k>g:iA', $original);
            break;
        case '13':
            $print = date_i18n('<k>d/m/y, </k>g:ia', $original);
            break;
        case '14':
            $print = date_i18n('<k>M j, </k>g:ia', $original);
            break;
        case '15':
            $print = date_i18n('<k>M j, </k>G:i', $original);
            break;
        case '16':
            $print = date_i18n('<k>d-m-Y, </k>G:i', $original);
            break;
        case '17':
            $print = date_i18n('<k>jS F Y, </k>G:i', $original);
            break;
        case '18':
            $print = date_i18n('<k>d M Y, </k>G:i', $original);
            break;
        case '19':
            $print = date_i18n('<k>l jS F Y, </k>G:i', $original);
            break;
        case '20':
            $print = date_i18n('<k>m.d.y - </k>G:i', $original);
            break;
        case '21':
            $print = date_i18n('<k>d.m.y - </k>G:i', $original);
            break;
        default:
            $print = date_i18n('<k>F j, Y, </k>g:ia', $original);
            break;
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }

    return $print;
}
//Time stamp function - used for comments
function cff_timesince($original, $cff_date_translate_strings) {

    $cff_second = $cff_date_translate_strings['cff_translate_second'];
    $cff_seconds = $cff_date_translate_strings['cff_translate_seconds'];
    $cff_minute = $cff_date_translate_strings['cff_translate_minute'];
    $cff_minutes = $cff_date_translate_strings['cff_translate_minutes'];
    $cff_hour = $cff_date_translate_strings['cff_translate_hour'];
    $cff_hours = $cff_date_translate_strings['cff_translate_hours'];
    $cff_day = $cff_date_translate_strings['cff_translate_day'];
    $cff_days = $cff_date_translate_strings['cff_translate_days'];
    $cff_week = $cff_date_translate_strings['cff_translate_week'];
    $cff_weeks = $cff_date_translate_strings['cff_translate_weeks'];
    $cff_month = $cff_date_translate_strings['cff_translate_month'];
    $cff_months = $cff_date_translate_strings['cff_translate_months'];
    $cff_year = $cff_date_translate_strings['cff_translate_years'];
    $cff_years = $cff_date_translate_strings['cff_translate_years'];
    $cff_ago = $cff_date_translate_strings['cff_translate_ago'];

    
    $periods = array($cff_second, $cff_minute, $cff_hour, $cff_day, $cff_week, $cff_month, $cff_year, "decade");
    $periods_plural = array($cff_seconds, $cff_minutes, $cff_hours, $cff_days, $cff_weeks, $cff_months, $cff_years, "decade");

    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    
    // is it future date or past date
    if($now > $original) {    
        $difference = $now - $original;
        $tense = $cff_ago;;
    } else {
        $difference = $original - $now;
        $tense = $cff_ago;
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j] = $periods_plural[$j];
    }
    return "$difference $periods[$j] {$tense}";
            
}
//Use custom stripos function if it's not available (only available in PHP 5+)
if(!is_callable('stripos')){
    function stripos($haystack, $needle){
        return strpos($haystack, stristr( $haystack, $needle ));
    }
}
function cff_stripos_arr_filter($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);

    foreach($needle as $word) {

        $word = trim($word);
        if( empty($word) ) return false;
        $regex = '/'.$word.'\b/u'; //The u at the end converts to UTF-8 and so matches foreign chars

        //Escape parentheses
        if (strpos($word, '(') !== false || strpos($word, ')') !== false) {
            $word = str_replace("(", "\\(", $word);
            $word = str_replace(")", "\\)", $word);
            $regex = '/'.$word.'/';
        }

        //Escape double hashtags
        if ( strpos($word, '##') !== false) {
            $word = str_replace("##", "\\##", $word);
            $regex = '/'.$word.'/';
        }

        preg_match($regex, $haystack, $match, PREG_OFFSET_CAPTURE);

        if( isset($match[0]) ){
            $pos = $match[0][1];
            return $pos;
        }
    }
    return false;
}
function cff_stripos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, ltrim($what) ))!==false) return $pos;
    }
    return false;
}

//Push to assoc array
function cff_array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
}
//Push to assoc array
function cff_array_push_assoc_photos($array, $key, $value, $post_time){
    $array[$key]['post'] = $value;
    $array[$key]['post_time'] = $post_time;

    return $array;
}
//Convert string to slug
function cff_to_slug($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


//Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'cff_add_my_stylesheet' );
function cff_add_my_stylesheet() {

    //Minify files?
    $options = get_option('cff_style_settings');
    isset($options[ 'cff_minify' ]) ? $cff_minify = $options[ 'cff_minify' ] : $cff_minify = '';
    $cff_minify ? $cff_min = '.min' : $cff_min = '';

    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'cff', plugins_url('css/cff-style'.$cff_min.'.css', __FILE__), array(), CFFVER );
    wp_enqueue_style( 'cff' );

    $options = get_option('cff_style_settings');
    
    if( !isset( $options[ 'cff_font_source' ] ) ){
        wp_enqueue_style( 'sb-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array() );
    } else {

        if( $options[ 'cff_font_source' ] == 'none' ){
            //Do nothing
        } else if( $options[ 'cff_font_source' ] == 'local' ){
            wp_enqueue_style( 'sb-font-awesome', plugins_url('css/font-awesome.min.css', __FILE__), array() );
        } else {
            wp_enqueue_style( 'sb-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array() );
        }

    }

    //Remove masonry extension CSS
    wp_dequeue_style( 'cff_masonry_css' );
}
//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'cff_scripts_method' );
function cff_scripts_method() {

    //Minify files?
    $options = get_option('cff_style_settings');
    isset($options[ 'cff_minify' ]) ? $cff_minify = $options[ 'cff_minify' ] : $cff_minify = '';
    $cff_minify ? $cff_min = '.min' : $cff_min = '';

    //Register the script to make it available
    wp_register_script( 'cffscripts', plugins_url( '/js/cff-scripts'.$cff_min.'.js' , __FILE__ ), array('jquery'), CFFVER, true );

    //Enqueue it to load it onto the page
    wp_enqueue_script('cffscripts');

    //Remove masonry extension JS
    wp_dequeue_script( 'cff_masonry_js' );
}

//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

add_action( 'wp_head', 'cff_custom_css' );
function cff_custom_css() {
    $options = get_option('cff_style_settings');
    isset($options[ 'cff_custom_css' ]) ? $cff_custom_css = $options[ 'cff_custom_css' ] : $cff_custom_css = '';
    if( !empty($cff_custom_css) ){
        echo '<!-- Custom Facebook Feed Custom CSS -->';
        echo "\r\n";
        echo '<style type="text/css">';
        echo "\r\n";
        echo stripslashes($cff_custom_css);
        echo "\r\n";
        echo '</style>';
        echo "\r\n";
    }

    //Lightbox CSS
    isset($options[ 'cff_lightbox_bg_color' ]) ? $cff_lightbox_bg_color = $options[ 'cff_lightbox_bg_color' ] : $cff_lightbox_bg_color = '';
    isset($options[ 'cff_lightbox_text_color' ]) ? $cff_lightbox_text_color = $options[ 'cff_lightbox_text_color' ] : $cff_lightbox_text_color = '';
    isset($options[ 'cff_lightbox_link_color' ]) ? $cff_lightbox_link_color = $options[ 'cff_lightbox_link_color' ] : $cff_lightbox_link_color = '';
    if( !empty($cff_lightbox_bg_color) || !empty($cff_lightbox_text_color) || !empty($cff_lightbox_link_color) ){
        echo '<!-- CFF Lightbox CSS -->';
        echo "\r\n";
        echo '<style type="text/css">';
        echo "\r\n";
        if( !empty($cff_lightbox_bg_color) ) echo '#cff-lightbox-wrapper .cff-lightbox-sidebar, .cff-lightbox-dataContainer, .cff-lightbox-wrapper.cff-enable-lb-comments .cff-lightbox-sidebar::-webkit-scrollbar-track{ background-color: ' . $cff_lightbox_bg_color . '; } .cff-lightbox-wrapper.cff-enable-lb-comments .cff-lightbox-sidebar::-webkit-scrollbar-thumb{ border: 3px solid ' . $cff_lightbox_bg_color . '; border-left: none; background-color: rgba(255,255,255,0.8); } ';
        if( !empty($cff_lightbox_text_color) ) echo '#cff-lightbox-wrapper .cff-lightbox-sidebar, #cff-lightbox-wrapper .cff-lightbox-caption, #cff-lightbox-wrapper .cff-author .cff-date{ color: ' . $cff_lightbox_text_color . '; }';
        if( !empty($cff_lightbox_link_color) ) echo '#cff-lightbox-wrapper .cff-lightbox-sidebar a, .cff-lightbox-dataContainer a{ color: ' . $cff_lightbox_link_color . ' !important; }';
        if( !empty($cff_lightbox_link_color) ) echo "\r\n";
        echo '</style>';
        echo "\r\n";
    }

    //Link hashtags?
    isset($options[ 'cff_link_hashtags' ]) ? $cff_link_hashtags = $options[ 'cff_link_hashtags' ] : $cff_link_hashtags = '';
    isset($options[ 'cff_title_link' ]) ? $cff_title_link = $options[ 'cff_title_link' ] : $cff_title_link = '';
    ($cff_link_hashtags == 'true' || $cff_link_hashtags == 'on') ? $cff_link_hashtags = 'true' : $cff_link_hashtags = 'false';
    if($cff_title_link == 'true' || $cff_title_link == 'on') $cff_link_hashtags = 'false';

    //Ajax caching?
    //Does the transient exist?
    ( false === ( $cff_cached_meta = get_transient( 'cff_meta' ) ) ) ? $cff_cached_meta = true : $cff_cached_meta = false;
    //Is the user disabling ajax caching?
    isset($options[ 'cff_disable_ajax_cache' ]) ? $cff_disable_ajax_cache = $options[ 'cff_disable_ajax_cache' ] : $cff_disable_ajax_cache = '';
    if( $cff_disable_ajax_cache ) $cff_cached_meta = false;

    echo '<!-- Custom Facebook Feed JS vars -->';
    echo "\r\n";
    echo '<script type="text/javascript">';
    echo "\r\n";
    echo 'var cffsiteurl = "' . plugins_url() . '";';
    echo "\r\n";
    echo 'var cffajaxurl = "' . admin_url('admin-ajax.php') . '";';
    echo "\r\n";
    echo ( $cff_cached_meta ) ? 'var cffmetatrans = "false";' : 'var cffmetatrans = "true";';
    echo "\r\n";
    if( $cff_disable_ajax_cache ) echo 'var cffdisablecommentcaching = "true";';
    echo "\r\n";
    echo 'var cfflinkhashtags = "' . $cff_link_hashtags . '";';
    echo "\r\n";
    echo '</script>';
    echo "\r\n";
}

add_action( 'wp_footer', 'cff_js' );
function cff_js() {
    $options = get_option('cff_style_settings');
    isset($options[ 'cff_custom_js' ]) ? $cff_custom_js = $options[ 'cff_custom_js' ] : $cff_custom_js = '';

    //Replace "cff-item" with "cff-new" so that it only runs on new items loaded into the feed
    $cff_custom_js = str_replace(".cff-item", ".cff-new", $cff_custom_js);

    if( !empty($cff_custom_js) ){
        echo '<!-- Custom Facebook Feed JS -->';
        echo "\r\n";
        echo '<script type="text/javascript">';
        echo "\r\n";
        echo "function cff_custom_js($){";
        echo "\r\n";
        echo "var $ = jQuery;";
        echo "\r\n";
        echo stripslashes($cff_custom_js);
        echo "\r\n";
        echo "}";
        echo "\r\n";
        echo "cff_custom_js($);";
        echo "\r\n";
        echo '</script>';
        echo "\r\n";
    }
}

add_action('init', 'cff_group_photos_notice_dismiss');
function cff_group_photos_notice_dismiss() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cff_group_photos_notice_dismiss']) && '0' == $_GET['cff_group_photos_notice_dismiss'] ) {
             add_user_meta($user_id, 'cff_group_photos_notice_dismiss', 'true', true);
    }
}

//Remove masonry extension
remove_filter( 'shortcode_atts_custom_facebook_feed', 'cff_masonry_filter_custom_facebook_feed_shortcode', 10 );
remove_filter( 'cff_feed_class', 'cff_masonry_add_class', 10 );

?>