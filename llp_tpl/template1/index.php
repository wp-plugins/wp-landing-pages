<!DOCTYPE html>
<html lang="en">
    <head>
    <title><?php wp_title(); ?></title>
	    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
        <!-- Style.css  -->
        <link rel="stylesheet" href="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/style.css" type="text/css" media="screen">
        <?php //wp_head();
		include llp_PATH . '/llp_tpl/llp_imp_js_css.php'; ?>
        </head>
        <!-- Style.css  -->
        
        <body>
        <?php
        if (is_user_logged_in()) {
            if ($do == 'create' || $do == 'edit') {
                include llp_PATH . '/llp_tpl/customized_bar.php';
            }
        }
		$llp_bg_1 = get_post_meta($post->ID, 'llp_bg_1', true);
        $llp_tpl2_headline = get_post_meta($post->ID, 'llp_tpl2_headline', true);
        $llp_tpl2_eml_txt = get_post_meta($post->ID, 'llp_tpl2_eml_txt', true);
        $llp_tpl2_disclaimer = get_post_meta($post->ID, 'llp_tpl2_disclaimer', true);
		$llp_tpl4_form = get_post_meta($post->ID, 'llp_tpl4_form', true);
        $atform = $llp_tpl4_form;
		
		if (empty($llp_bg_1)) {
            $llp_bg_1 = llp_URL . '/llp_tpl/' . $get_llp_tpl->tmp_file . '/images/bg.png';
        }
        if (empty($llp_tpl2_headline)) {
            $llp_tpl2_headline = '"Free Report Reveals . . . The 5 Simple Steps Anybody Can Take To Easily XYZ"';
        }
        if (empty($llp_tpl2_eml_txt)) {
            $llp_tpl2_eml_txt = 'Enter your email address to get this free report';
        }
        if (empty($llp_tpl2_disclaimer)) {
            $llp_tpl2_disclaimer = 'Your information will *never* be shared or sold to a 3rd party.';
        }
        $llp_button_1 = get_post_meta($post->ID, 'llp_button_1', true);
        if (empty($llp_button_1)) {
            $llp_button_1 = 'Download The Report';
        }
        $llp_button_1_link_a = get_post_meta($post->ID, 'llp_button_1_link_a', true);
        if (empty($llp_button_1_link_a)) {
            $llp_button_1_link_a = 'http://google.com';
        }
        $llp_button_1_link_a_open = get_post_meta($post->ID, 'llp_button_1_link_a_open', true);
        if (empty($llp_button_1_link_a_open)) {
            if ($llp_button_1_link_a_open == '1') {
                $llp_button_1_link_a_open = '_blank';
            } else {
                $llp_button_1_link_a_open = '';
            }
        }
        ?>
        <style>
            body {
				<?php if (!empty($llp_bg_1)){ ?>
                background-image:url("<?php echo $llp_bg_1; ?>");
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
				<?php } ?>
            }
			#llp_bg_1 img {
				height:100px;
				width:100%;
				display:none;
			}
        </style>
        <?php
		if (is_user_logged_in()) {
            if ($do == 'create' || $do == 'edit') {
		?>
        <a id="llp_bg_1" href="javascript:void(0);" data-heading="Update Background" data-id="1" data-edit="true" data-type='bgimage' data-default='<img src="<?php echo $llp_bg_1; ?>" border="0" alt="">' data-wp_custom_field='llp_bg_1' class="dspblk llp_btn">Change Background Image<img alt="" src="<?php echo $llp_bg_1; ?>"></a>
        <?php
			}
		}
		?>
        <section id="wrapper">
            <section class="content-box type2">
                <h1 class="lead-logo" id="logo"> </h1>
                <section class="blackbox">
                    <h3><span id="llp_tpl2_headline" data-heading="Main Headline" data-id="2" data-edit="true" data-type='text' data-default='"Free Report Reveals . . . The 5 Simple Steps Anybody Can Take To Easily XYZ"' data-wp_custom_field='llp_tpl2_headline' class="dspblk"><?php echo $llp_tpl2_headline; ?></span></h3>
                    <p><span id="llp_tpl2_eml_txt" data-heading="Email Text" data-id="3" data-edit="true" data-type='text' data-default='Enter your email address to get this free report' data-wp_custom_field='llp_tpl2_eml_txt' class="dspblk"><?php echo $llp_tpl2_eml_txt; ?></span></p>
                    <a id="llp_button_1" data-heading="Button" data-id="4" data-edit="true" data-type='link' data-default='<?php echo $llp_button_1; ?>' data-wp_custom_field='llp_button_1' data-link='<?php echo $llp_button_1_link_a; ?>' data-target='1' href="<?php echo $llp_button_1_link_a; ?>" class="blue-btn llp_box" <?php if ($llp_button_1_link_a_open != "") { ?>target="_blank"<?php } ?>><?php echo $llp_button_1; ?></a>
                    
                    <div id="inline1" style="max-width:400px;display: none;">
                        <div class="form" id="llp_tpl4_form" data-heading="Optin Form" data-id="6" data-edit="true" data-type='form' data-wp_custom_field='llp_tpl4_form'>
							<?php if ($llp_tpl4_form) { ?>
                                <form action="<?php echo $atform['_optthemes_optinformurl']; ?>" method="post">
                                    <?php
                                    if ($atform['optintext']) {
                                        foreach ($atform['optintext'] as $atform_fields => $key) {
                                            if ($atform['optincheck'][$atform_fields] == 'yes') {
                                                ?>                                
                                                <input placeholder="<?php echo $key; ?>" onfocus="this.placeholder = '<?php echo $key; ?>'" title="<?php echo $key; ?>" value="" name="<?php echo $atform_fields; ?>" type="<?php echo $atform['optintype'][$atform_fields]; ?>">
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                    <?php echo $atform['_optthemes_webformhiddenhtml']; ?>
                                    <button type="submit" class="btn blue-btn"><?php echo $atform['_optthemes_optinformsubmit']; ?></button>
                                </form>
                            <?php } else { ?>
                                <form></form>
                                <form action="#" method="post" onsubmit="" target="_top">
                                    <input placeholder="Enter a Valid Email Here..." onfocus="this.placeholder = 'Enter a Valid Email Here...'" title="Enter a Valid Email Here..." value="" type="email" id="email" data-lb-inputemail="true"><button type="submit" class="btn blue-btn">Get Instant Access</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <p><span id="llp_tpl2_disclaimer" data-heading="Disclaimer" data-id="5" data-edit="true" data-type='text' data-default='Your information will *never* be shared or sold to a 3rd party.' data-wp_custom_field='llp_tpl2_disclaimer' class="dspblk"><?php echo $llp_tpl2_disclaimer; ?></span></p>
                </section>
            </section>
        </section>
        <?php
        if (is_user_logged_in()) {
            if ($do == 'create' || $do == 'edit') {
                ?>
            </div>
            <?php
        }
    }
    ?>
</body>
</html>