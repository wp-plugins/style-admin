jQuery(document).ready(function() {
 
	jQuery('#admin_login_logo_button').click(function() {
		formfield = jQuery('#admin_login_logo').attr('id');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

        jQuery('#admin_menu_logo_button').click(function() {
                formfield = jQuery('#admin_menu_logo').attr('id');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                return false;
        });
 
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+formfield).val(imgurl);
		tb_remove();
	}

});
