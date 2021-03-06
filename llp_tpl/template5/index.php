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
        <!-- Style.css  -->
        <?php 
		//wp_head();
		include llp_PATH . '/llp_tpl/llp_imp_js_css.php'; ?>
    </head>
    <body>
        <?php
        if (is_user_logged_in()) {
            if ($do == 'create' || $do == 'edit') {
                include llp_PATH . '/llp_tpl/customized_bar.php';
            }
        }
		$llp_bg_1 = get_post_meta($post->ID, 'llp_bg_1', true);
		$llp_tpl4_form = get_post_meta($post->ID, 'llp_tpl4_form', true);
		$atform = $llp_tpl4_form;
        $llp_logo_1 = get_post_meta($post->ID, 'llp_logo_1', true);
        if (empty($llp_logo_1)) {
            $llp_logo_1 = llp_URL . '/llp_tpl/' . $get_llp_tpl->tmp_file . '/images/logo.png';
        }
        $llp_logo_1_image_link = get_post_meta($post->ID, 'llp_logo_1_image_link', true);
        if (empty($llp_logo_1_image_link)) {
            $llp_logo_1_image_link = 'http://google.com';
        }
        $llp_heading_1 = get_post_meta($post->ID, 'llp_heading_1', true);
        if (empty($llp_heading_1)) {
            $llp_heading_1 = 'Turn Up Your Speakers and WATCH';
        }
        $llp_heading_2 = get_post_meta($post->ID, 'llp_heading_2', true);
        if (empty($llp_heading_2)) {
            $llp_heading_2 = 'This FREE PRESENTATION Below';
        }
        $llp_iframe_1 = get_post_meta($post->ID, 'llp_iframe_1', true);
        if (empty($llp_iframe_1)) {
            $llp_iframe_1 = '<iframe width="750" height="414" src="http://www.youtube.com/embed/moSFlvxnbgk?wmode=opaque" frameborder="0" allowfullscreen></iframe>';
        }
        $llp_button_1 = get_post_meta($post->ID, 'llp_button_1', true);
        if (empty($llp_button_1)) {
            $llp_button_1 = 'Click Here To Place Your Order';
        }
        $llp_button_1_link_a = get_post_meta($post->ID, 'llp_button_1_link_a', true);
        if (empty($llp_button_1_link_a)) {
            $llp_button_1_link_a = 'http://google.com';
        }
        $llp_button_1_link_a_open = get_post_meta($post->ID, 'llp_button_1_link_a_open', true);
        if (empty($llp_button_1_link_a_open)) {
            if ($llp_button_1_link_a_open == '1') {
                $llp_button_1_link_a_open = '1';
            } else {
                $llp_button_1_link_a_open = '0';
            }
        }
        if ($llp_button_1_link_a_open == 1) {
            $llp_button_1_link_a_open = '_blank';
        } else {
            $llp_button_1_link_a_open = '';
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
        <a id="llp_bg_1" href="javascript:void(0);" data-heading="Update Background" data-id="6" data-edit="true" data-type='bgimage' data-default='<img src="<?php echo $llp_bg_1; ?>" border="0" alt="">' data-wp_custom_field='llp_bg_1' class="dspblk llp_btn">Change Background Image<img alt="" src="<?php echo $llp_bg_1; ?>"></a>
        <?php
			}
		}
		?>
        <header>
            <div class="headmain">
                <div id="logo">
                    <a id="llp_logo_1" data-heading="Logo" data-image-link="<?php echo $llp_logo_1_image_link; ?>" data-id="5" data-edit="true" data-type='image' data-default='<img src="<?php echo $llp_logo_1; ?>" border="0" alt="logo">' data-wp_custom_field='llp_logo_1' href="<?php echo $llp_logo_1_image_link; ?>"><img src="<?php echo $llp_logo_1; ?>" border="0" alt="logo"></a>
                </div>
            </div>
        </header>
        <div id="wrap">
            <div id="content">
                <div class="video-course">
                    <h1><img src="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/images/red-circle.png" border="0" class="circleleft"> <span id="llp_heading_1" data-heading="Heading 1" data-id="1" data-edit="true" data-type='text' data-default='<?php echo $llp_heading_1; ?>' data-wp_custom_field='llp_heading_1'><?php echo $llp_heading_1; ?></span> <img src="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/images/red-circle.png" border="0" class="circleright"></h1>
                    <h1><img src="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/images/red-arrowL.png" border="0" class="circleleft"> <span id="llp_heading_2" data-heading="Heading 2" data-id="2" data-edit="true" data-type='text' data-default='<?php echo $llp_heading_2; ?>' data-wp_custom_field='llp_heading_2'><?php echo $llp_heading_2; ?></span> <img src="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/images/red-arrowR.png" border="0" class="circleright"></h1>
                    <section id="vid-frame">
                        <div id="llp_iframe_1" class="video-container" data-heading="Intro Video" data-id="3" data-edit="true" data-type='iframe' data-default='<?php echo $llp_iframe_1; ?>' data-wp_custom_field='llp_iframe_1'><?php echo $llp_iframe_1; ?></div>
                    </section>
                    <div id="lb-fade-box" style="display: block; opacity: 1;"><a id="llp_button_1" data-heading="Button" data-id="4" data-edit="true" data-type='link' data-default='<?php echo $llp_button_1; ?>' data-wp_custom_field='llp_button_1' data-link='<?php echo $llp_button_1_link_a; ?>' data-target='1' href="<?php echo $llp_button_1_link_a; ?>" class="yellow-btn llp_box" <?php if ($llp_button_1_link_a_open != "") { ?>target="_blank"<?php } ?>><?php echo $llp_button_1; ?></a></div>
                    <div id="inline1" style="width:400px;display: none;">
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
                                    <button type="submit" class="btn yellow-btn"><?php echo $atform['_optthemes_optinformsubmit']; ?></button>
                                </form>
                            <?php } else { ?>
                                <form action="#" method="post" onsubmit="" target="_top">
                                    <input placeholder="Enter a Valid Email Here..." onfocus="this.placeholder = 'Enter a Valid Email Here...'" title="Enter a Valid Email Here..." value="" type="email" id="email" data-lb-inputemail="true"><button type="submit" class="btn yellow-btn">Get Instant Access</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
        </footer>
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