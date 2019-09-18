jQuery(document).ready(function($) {

	//Tooltips
	jQuery('#cff-admin .cff-tooltip-link').click(function(){
		jQuery(this).closest('tr, h3, div').find('.cff-tooltip').slideToggle();
	});

	//Toggle Access Token field
	if( jQuery('#cff_show_access_token').is(':checked') ) jQuery('.cff-access-token-hidden').show();
	jQuery('#cff_show_access_token').change(function(){
		jQuery('.cff-access-token-hidden').fadeToggle();
	});

	//Check Access Token length
	jQuery("#cff_access_token").change(function() {

		var cff_token_string = jQuery('#cff_access_token').val(),
			cff_token_check = cff_token_string.indexOf('|');

  		if ( (cff_token_check == -1) && (cff_token_string.length < 50) && (cff_token_string.length !== 0) ) {
  			jQuery('.cff-profile-error.cff-access-token').fadeIn();
  		} else {
  			jQuery('.cff-profile-error.cff-access-token').fadeOut();
  		}

	});

	//Is this a page, group or profile?
	var cff_page_type = jQuery('.cff-page-type select').val(),
		$cff_page_type_options = jQuery('.cff-page-options'),
		$cff_profile_error = jQuery('.cff-profile-error.cff-page-type');

	//Should we show anything initially?
	if(cff_page_type !== 'page') $cff_page_type_options.hide();
	if(cff_page_type == 'profile') $cff_profile_error.show();

	//When page type is changed show the relevant item
	jQuery('.cff-page-type').change(function(){
		cff_page_type = jQuery('.cff-page-type select').val();

		if( cff_page_type !== 'page' ) {
			$cff_page_type_options.fadeOut();
			if( cff_page_type == 'profile' ) {
					$cff_profile_error.show();
				} else if( cff_page_type == 'group' ) {
					$cff_profile_error.hide();
				} else {
					$cff_profile_error.hide();
				}
			
		} else {
			$cff_page_type_options.fadeIn();
			$cff_profile_error.hide();
		}
	});


	//PHOTOS ONLY
	//When 'Display photos from your Photos page' is checked then show the options
	var cff_photo_source = jQuery('#cff_photos_source').val();

	//Should we show anything initially?
	if(cff_photo_source == 'timeline') jQuery('.cff-photo-source-options').hide();

	jQuery('#cff_photos_source').change(function(){
		cff_photo_source = jQuery(this).val();

		if( cff_photo_source == 'photospage' ) {
			jQuery('.cff-photo-source-options').show();
		} else {
			jQuery('.cff-photo-source-options').hide();
		}
	});

	//ALBUMS ONLY
	//When 'Dispay albums from your Photos page' is checked then show the options
	var cff_album_source = jQuery('#cff_albums_source').val();

	//Should we show anything initially?
	if(cff_album_source == 'timeline') jQuery('.cff-album-source-options').hide();

	jQuery('#cff_albums_source').change(function(){
		cff_album_source = jQuery(this).val();

		if( cff_album_source == 'photospage' ) {
			jQuery('.cff-album-source-options').slideDown();
		} else {
			jQuery('.cff-album-source-options').slideUp();
		}
	});

	//VIDEOS ONLY
	//When 'Dispay videos from your Videos page' is checked then show the options
	var cff_video_source = jQuery('#cff_videos_source').val();

	//Should we show anything initially?
	if(cff_video_source == 'timeline') jQuery('.cff-video-source-options').hide();

	jQuery('#cff_videos_source').change(function(){
		cff_video_source = jQuery(this).val();

		if( cff_video_source == 'videospage' ) {
			jQuery('.cff-video-source-options').show();
		} else {
			jQuery('.cff-video-source-options').hide();
		}
	});

	//EVENTS ONLY
	var cff_event_source = jQuery('#cff_events_source').val();

	//Should we show anything initially?
	if(cff_event_source == 'timeline') jQuery('.cff-events-source-options').hide();

	jQuery('#cff_events_source').change(function(){
		cff_event_source = jQuery(this).val();

		if( cff_event_source == 'eventspage' ) {
			jQuery('.cff-events-source-options').show();
		} else {
			jQuery('.cff-events-source-options').hide();
		}
	});


	//Show narrow option when Full-width layout is selected
	function toggleMediaOptions(){
		if( $('.cff-full').hasClass('cff-layout-selected') ){
			$('.cff-media-position').show();
		} else {
			$('.cff-media-position').hide();
		}
	}
	toggleMediaOptions();



	//Choose events source
	var $cff_events_only_options = jQuery('.cff-events-only-options'),
		checked = jQuery("#post-types input.cff-post-type:checkbox:checked");
	
	//Hide page source option initially
	$cff_events_only_options.hide();

	//Show if only events are checked
	if (checked.length === 1 && checked[0].id === 'cff_show_event_type') {
		$cff_events_only_options.slideDown();
	}


	//Albums only
	var $cff_albums_only_options = jQuery('.cff-albums-only-options');
	
	//Hide page source option initially
	$cff_albums_only_options.hide();

	//Show if only events are checked
	if (checked.length === 1 && checked[0].id === 'cff_show_albums_type') {
		$cff_albums_only_options.slideDown();
	}


	//Photos only
	var $cff_photos_only_options = jQuery('.cff-photos-only-options');
	
	//Hide page source option initially
	$cff_photos_only_options.hide();

	//Show if only events are checked
	if (checked.length === 1 && checked[0].id === 'cff_show_photos_type') {
		$cff_photos_only_options.slideDown();
	}


	//Videos only
	var $cff_videos_only_options = jQuery('.cff-videos-only-options');
	
	//Hide page source option initially
	$cff_videos_only_options.hide();

	//Show if only videos are checked
	if (checked.length === 1 && checked[0].id === 'cff_show_video_type') {
		$cff_videos_only_options.slideDown();
	}


	//On change check which post type is checked
	jQuery("#post-types").change(function() {
		var checked = jQuery("#post-types input.cff-post-type:checkbox:checked");

		if (checked.length === 1 && checked[0].id === 'cff_show_event_type') {
	        $cff_events_only_options.slideDown();
	    } else if (checked.length === 1 && checked[0].id === 'cff_show_albums_type') {
	        $cff_albums_only_options.slideDown();
	    } else if (checked.length === 1 && checked[0].id === 'cff_show_photos_type') {
	        $cff_photos_only_options.slideDown();
	    } else if (checked.length === 1 && checked[0].id === 'cff_show_video_type') {
	        $cff_videos_only_options.slideDown();
	    } else {
	        $cff_events_only_options.slideUp();
	        $cff_albums_only_options.slideUp();
	        $cff_photos_only_options.slideUp();
	        $cff_videos_only_options.slideUp();
	    }
	});


	//Header icon
	//Icon type
	//Check the saved icon type on page load and display it
	jQuery('#cff-header-icon-example').removeClass().addClass('fa fa-' + jQuery('#cff-header-icon').val() );
	//Change the header icon when selected from the list
	jQuery('#cff-header-icon').change(function() {
	    var $self = jQuery(this);

	    jQuery('#cff-header-icon-example').removeClass().addClass('fa fa-' + $self.val() );
	});

	//Test Facebook API connection button
	jQuery('#cff-api-test').click(function(e){
		e.preventDefault();
		//Show the JSON
		jQuery('#cff-api-test-result textarea').css('display', 'block');
	});


	//If 'Others only' is selected then show a note
	var $cffOthersOnly = jQuery('#cff-others-only');

	if ( jQuery("#cff_show_others option:selected").val() == 'onlyothers' ) $cffOthersOnly.show();
	
	jQuery("#cff_show_others").change(function() {
		if ( jQuery("#cff_show_others option:selected").val() == 'onlyothers' ) {
			$cffOthersOnly.show();
		} else {
			$cffOthersOnly.hide();
		}
	});

	//Selecting a post layout
	jQuery('.cff-layout').click(function(){
        var $self = jQuery(this);
        $self.addClass('cff-layout-selected').find('#cff_preset_layout').attr('checked', 'checked');
        $self.siblings().removeClass('cff-layout-selected');
        toggleMediaOptions();
    });

    //Selecting a post style
	jQuery('.cff-post-style').click(function(){
        var $self = jQuery(this);
        $('.cff_post_style').trigger('change');
        $self.addClass('cff-layout-selected').find('#cff_post_style').attr('checked', 'checked');
        $self.siblings().removeClass('cff-layout-selected');
    });
    function cffChangePostStyleSettings() {
        setTimeout(function(){
            jQuery('.cff-post-style-settings').hide();
            jQuery('.cff-post-style-settings.cff-'+jQuery('.cff_post_style:checked').val()).show();
        }, 1);
    }
    cffChangePostStyleSettings();
    jQuery('.cff_post_style').change(cffChangePostStyleSettings);

    //Add the color picker
	if( jQuery('.cff-colorpicker').length > 0 ) jQuery('.cff-colorpicker').wpColorPicker();


	//Mobile width
	var cff_feed_width = jQuery('#cff-admin #cff_feed_width').val(),
			$cff_width_options = jQuery('#cff-admin #cff_width_options');

	if (typeof cff_feed_width !== 'undefined') {
		//Show initially if a width is set
		if(cff_feed_width.length > 1 && cff_feed_width !== '100%') $cff_width_options.show();

		jQuery('#cff_feed_width').change(function(){
			cff_feed_width = jQuery(this).val();

			if( cff_feed_width.length < 2 || cff_feed_width == '100%' ) {
				$cff_width_options.slideUp(200);			
			} else {
				$cff_width_options.slideDown(200);
			}
		});
	}

	//Scroll to hash for quick links
  jQuery('#cff-admin a').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : this.hash.slice(1);
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });

  //Shortcode tooltips
  jQuery('#cff-admin label').click(function(){
  	var $el = jQuery(this);
    var $cff_shortcode = $el.siblings('.cff_shortcode');
    if($cff_shortcode.is(':visible')){
      $el.siblings('.cff_shortcode').css('display','none');
    } else {
      $el.siblings('.cff_shortcode').css('display','block');
    }  
  });
  jQuery('#cff-admin th').hover(function(){
    if( jQuery(this).find('.cff_shortcode').length > 0 ){
      jQuery(this).find('label').append('<code class="cff_shortcode_symbol">[]</code>');
    }
  }, function(){
    jQuery(this).find('.cff_shortcode_symbol').remove();
  });
  jQuery('#cff-admin label').hover(function(){
    if( jQuery(this).siblings('.cff_shortcode').length > 0 ){
      jQuery(this).attr('title', 'Click for shortcode option');
    }
   }, function(){});


  //Caching options
	if( jQuery('#cff_caching_type_page').is(':checked') ) {
		jQuery('.cff-caching-cron-options').hide();
	} else {
		jQuery('.cff-caching-page-options').hide();
	}

	$('input[type=radio][name=cff_caching_type]').change(function() {
      if (this.value == 'page') {
      	jQuery('.cff-caching-cron-options').slideUp();
      	jQuery('.cff-caching-page-options').slideDown();
      }
      else if (this.value == 'background') {
      	jQuery('.cff-caching-page-options').slideUp();
      	jQuery('.cff-caching-cron-options').slideDown();
      }
  });


  //Should we show the caching time settings?
	var cff_cache_cron_interval = jQuery('#cff_cache_cron_interval').val(),
			$cff_caching_time_settings = jQuery('#cff-caching-time-settings');

	//Should we show anything initially?
	if(cff_cache_cron_interval == '30mins' || cff_cache_cron_interval == '1hour') $cff_caching_time_settings.hide();

	jQuery('#cff_cache_cron_interval').change(function(){
		cff_cache_cron_interval = jQuery('#cff_cache_cron_interval').val();

		if(cff_cache_cron_interval == '30mins' || cff_cache_cron_interval == '1hour'){
			$cff_caching_time_settings.hide();
		} else {
			$cff_caching_time_settings.show();
		}
	});


	//Post limit manual setting
	var cff_limit_setting = jQuery('#cff_limit_setting').val(),
			cff_post_limit = jQuery('#cff_post_limit').val(),
			$cff_limit_manual_settings = jQuery('#cff_limit_manual_settings');
	if( typeof cff_post_limit === 'undefined' ) cff_post_limit = '';

	//Should we show anything initially?
	if(cff_limit_setting == 'auto') $cff_limit_manual_settings.hide();
	if(cff_post_limit.length > 0){
		$cff_limit_manual_settings.show();
		jQuery('#cff_limit_setting').val('manual');
	}

	jQuery('#cff_limit_setting').change(function(){
		cff_limit_setting = jQuery('#cff_limit_setting').val();

		if(cff_limit_setting == 'auto'){
			$cff_limit_manual_settings.hide();
			jQuery('#cff_post_limit').val('');
		} else {
			$cff_limit_manual_settings.show();
		}
	});


	//Open/close the expandable option sections
	jQuery('.cff-expandable-options').hide();
	jQuery('.cff-expand-button a').on('click', function(e){
		e.preventDefault();
		var $self = jQuery(this);
		$self.parent().next('.cff-expandable-options').toggle();
		if( $self.text().indexOf('Show') !== -1 ){
			$self.text( $self.text().replace('Show', 'Hide') );
		} else {
			$self.text( $self.text().replace('Hide', 'Show') );
		}
	});


	//Support tab show video
	jQuery('#cff-play-support-video').on('click', function(e){
		e.preventDefault();
		jQuery('#cff-support-video').show().attr('src', jQuery('#cff-support-video').attr('src')+'&amp;autoplay=1' );
	});

	//Facebook login
	$('#cff_fb_login').on('click', function(){
		$('#cff_fb_login_modal').show();
	});
	$('#cff_admin_cancel_btn').on('click', function(){
		$('#cff_fb_login_modal').hide();
	});
	$('.cff-modal-close, #cff-close-modal-primary-button').on('click', function(){
		$('.cff_modal_tokens').hide();
	});
	$('#cff_fb_show_tokens').on('click', function(){
		$('.cff_modal_tokens, .cff-groups-list').show();
		$('#cff-group-installation').hide();
	});

	//Select a page for token
	$('.cff-managed-page').on('click', function(){
		$('#cff-insert-token, .cff-insert-reviews-token, .cff-insert-both-tokens').removeAttr('disabled');

		$('#cff_token_expiration_note').show();

		$(this).siblings().removeClass('cff-page-selected');
		$(this).addClass('cff-page-selected');
	});

	//Insert Page Access Token
	$('#cff-insert-token').on('click', function(){
		$('#cff_access_token').val( $('.cff-page-selected').attr('data-token') ).addClass('cff-success');
		if( $('#cff_page_id').val().trim() == '' ) $('#cff_page_id').val( $('.cff-page-selected').attr('data-page-id') );

		if( $(this).hasClass('cff-group-btn') ){
			$('.cff-groups-list').hide();
			$('#cff-group-installation').show();

			//Show directions for either group admin or member
			if( $('.cff-page-selected').hasClass('cff-group-admin') ){
				$('#cff-group-admin-directions').show();
				$('#cff-group-member-directions').hide();
			} else {
				$('#cff-group-admin-directions').hide();
				$('#cff-group-member-directions').show();
			}

			//Change page type to be group
			$('#cff_page_type').val('group');
			$('.cff-page-options').hide();

			//Dynamically create group edit link
			var cffGroupEditLink = 'https://facebook.com/groups/'+$('.cff-page-selected').attr('data-page-id')+'/edit';
			$('#cff-group-installation #cff-group-edit').attr('href', cffGroupEditLink);
		} else {
			$('.cff_modal_tokens').hide();
		}

		location.hash = "cffnomodal";
	});

	//Show the modal by default, but hide if the "cffnomodal" class is added to prevent it showing after saving settings
	if( location.hash !== '#cffnomodal' ){
		$('.cff_modal_tokens').removeClass('cffnomodal');
	}

	//Insert Reviews Token
	$('.cff-insert-reviews-token, .cff-insert-both-tokens').on('click', function(){
		if( $(this).hasClass('cff-insert-both-tokens') ){
			$('#cff_access_token').val( $('.cff-page-selected').attr('data-token') ).addClass('cff-success');
		}
		$('#cff_page_access_token').val( $('.cff-page-selected').attr('data-token') ).addClass('cff-success');
		$('.cff_modal_tokens').hide();
	});

	//Switch Page/Group app button in modal
	jQuery("#cff_login_type").change(function() {
		if ( jQuery("#cff_login_type option:selected").val() == 'group' ) {
			jQuery('#cff_page_app').hide();
			jQuery('#cff_group_app').css('display', 'inline-block');
		} else {
			jQuery('#cff_page_app').css('display', 'inline-block');
			jQuery('#cff_group_app').hide();
		}
	});

    //Load the admin share widgets
    $('#cff-admin-show-share-links').on('click', function(){
    	$(this).fadeOut();
        if( $('#cff-admin-share-links iframe').length == 0 ) $('#cff-admin-share-links').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://smashballoon.com/custom-facebook-feed/" data-text="Display your Facebook posts on your site your way using the Custom Facebook Feed WordPress plugin!" data-via="smashballoon" data-dnt="true">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script> <style type="text/css"> #twitter-widget-0{float: left; width: 82px !important;}.IN-widget{margin-right: 20px;}</style> <div id="fb-root" style="display: none;"></div><script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.src="//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0"; fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script> <div class="fb-like" data-href="https://smashballoon.com/custom-facebook-feed/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="display: block; float: left; margin-right: 5px;"></div><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US </script> <script type="IN/Share" data-url="https://smashballoon.com/custom-facebook-feed/"></script></div>');

        setTimeout(function(){
        	$('#cff-admin-share-links').addClass('cff-show');
        }, 500);
    });

    //Show/hide mobile column setting
    var cff_masonry_desktop_col = jQuery('#cff_masonry_desktop_col').val(),
		$cff_mobile_col_settings = jQuery('.cff-mobile-col-settings');
	if( typeof cff_post_limit === 'undefined' ) cff_masonry_desktop_col = '1';

	//Should we show anything initially?
	if( cff_masonry_desktop_col == '1' ) $cff_mobile_col_settings.hide();
	if( parseInt(cff_masonry_desktop_col) > 1 ){
		$cff_mobile_col_settings.show();
	}

	jQuery('#cff_masonry_desktop_col').change(function(){
		cff_cols_num = parseInt( jQuery('#cff_masonry_desktop_col').val() );

		if(cff_cols_num > 1){
			$cff_mobile_col_settings.slideDown(200);
		} else {
			$cff_mobile_col_settings.slideUp(200);
		}
	});

	//Group app setup screenshot
	jQuery('#cff-group-app-tooltip').hover(function(){
	    jQuery('#cff-group-app-screenshot').fadeIn(100);
	}, function(){
		jQuery('#cff-group-app-screenshot').fadeOut(100);
	});

	//Remove any duplicate groups
	jQuery('.cff-group-admin').each(function(){
		jQuery('.cff-groups-list #' + jQuery(this).attr('id') ).eq(1).hide();
	});

});