=== Style Admin ===
Contributors: fuzzguard
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=G8SPGAVH8RTBU
tags: style, admin, administration, CSS, custom, dashboard, login, free, Formatting
Requires at least: 3.8
Tested up to: 4.0
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Want to style your Admin login pages for your clients in their corporate colors?  Sick of the default wordpress wp-admin login page?  Then this plugin maybe for you.  It allows you to style the Wordpress Admin Panel login page that comes default with every wordpress installation.

You can do the following:

	* Upload and set your own logo for the Admin Panel login page
	* Upload and set your own logo for the Admin Panel Menu (This replaces the DASHBOARD menu option)
	* Set the background color of the Admin Panel login page
        * Set the background colour of the Username/Password boxes.
        * Set the background colour of the 'Log in' button
        * Set the background color of the Login Box.
	* Set the color of the footer text.
	* Set the colour of the text in the Login box.
	* Set the colour of the 'Log in' text on the 'Log in' button 
	* Set to have CSS rounded corners on your login box and the 'Log in' button

Usually this require's modification of CSS code to have the changes stick.  This can lead to changes being overwritten on theme updates.  This plugin is simple and allows you to easily change the options between your custom choices and the default ones that are set for your theme.

== Installation ==

1. Upload the `plugin` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Appearance > Style Admin
1. Upload or set URL of logo to use on the Login Page and the Admin Panel Menu.  To reset to default just remove the text from the input box and click 'Save'
1. Click "Custom" radio button on the color you would like to change.  Then click the "Select Color" box to bring up the Color picker.
1. If you would like the CSS Rounded corners on the login box and the 'Log In' button select "Yes" to rounded corners on login box.
1. Click 'Save Changes' to save your changed options.

== Frequently Asked Questions ==

= Why is my image showing up too large for the Admin Login page Logo or Admin Panel menu Logo? =

This can occur when your image is larger than the size of 300x80.  Please adjust the height or width of your image to fit these dimensions.

= Why is my image not centered?/Why is my image not showing up? =

This is usually caused by conflicts with another plugin or with the theme.  I do not have control over the plugins you install or the theme you use.  This can be solved by deactivating the offending plugins/using a different theme.

= The login box and 'Log In' button on the Admin login page are not showing up with rounded corners! =

This is caused by an old browser version.  I suggest you update your browser or use a different browser.  Wrong browser versions will cause problems with all sorts of web-based applications, not just my plugin.

== Screenshots ==

1. View of the top of the 'Style Admin' options page
2. View of the bottom of the 'Style Admin' options page
3. Shows the Color Picker while expanded.
4. A CUSTOM stylised Admin Panel login page, using 'Style Admin' plugin.
5. A CUSTOM logo added to the Admin Panel menu.
6. Christmas styled Admin Panel login page, using 'Style Admin' plugin.

== Changelog ==

= 1.1 =
* Fixed $SA_CSS_Arr so it recognises if no variable is returned

= 1.0 =
* Gold release
