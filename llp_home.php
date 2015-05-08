<h1>WP Leads - <?php _e( 'Home', 'wp-realestate' ); ?></h1>

<?php
_e( '<p><strong>NOTE</strong>: <em>If you do all the settings correctly and still see 404 page not found errors, please go to your <a href="options-permalink.php">wp-admin &gt; settings &gt; permalinks</a> and simply press the save button. It will reset your permalinks and make the plugins links active. Pressing the save button does not need to change the actual permalinks configuration.</em></p>
<p>Thank you for choosing WP Real Estate plugin. I hope you will like the plugin and enjoy using it. If you have any support or your feedback, please feel free to send an email to <a href="mailto:hozyali@gmail.com">hozyali@gmail.com.</a></p>
<h3>Quick Tutorial</h3>
<ul style="list-style: disc inside none;">
  <li>To create new landing page, go to WP Leads &gt; Templates. Click Use this template button under any template you like</li>
  <li>Next page will open. On your left side, enter page name first and submit. This will save the page in your Wordpress site. You can then customize the page</li>
  <li>If you wish to edit an existing created template/page. Go to your WP-Admin &gt; Pages. Click on the page title which you created from WP Leads. and then click the Edit Template Button above the editor box</li>
</ul>', 'wp-realestate' );
?>
<h3><?php _e( 'Stay Updated and get more customized features directly to your inbox', 'wp-realestate' );?></h3>
<p>
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="http://etechy101.us8.list-manage.com/subscribe/post?u=0feea2b1671b773d914b338e6&amp;id=8ca20a276b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<?php _e( '<strong>I promise, you will not get a single spam</strong>. Leave your email below', 'wp-realestate' );?>
<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php _e( 'email address', 'wp-realestate' ); ?>" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_b8210f8523d1e31f37518d48e_155e3516fe" value=""></div>
	<div class="clear"><input type="submit" value="<?php _e( 'Join', 'wp-realestate' ); ?>" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>
<?php
#echo md5('3109275'); 
define("ENCRYPTION_KEY", "!@#$%^&*");
$string = "3109275";
/* echo $encrypted = encrypt($string, ENCRYPTION_KEY);
  echo "<br />";
  echo $decrypted = decrypt($encrypted, ENCRYPTION_KEY);
 */

/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}
?>