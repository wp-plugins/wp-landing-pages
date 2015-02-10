<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title><?php wp_title(); ?></title>
        <meta charset="utf-8">
        <meta content="width=device-width" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,200,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic&amp;subset=latin,latin-ext" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <!-- Style.css  -->
        <link rel="stylesheet" href="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/style.css" type="text/css" media="screen">
        <!-- Style.css  -->
        <?php //wp_head();
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
            $llp_tpl4_topline = get_post_meta($post->ID, 'llp_tpl4_topline', true);
            $llp_tpl4_headline = get_post_meta($post->ID, 'llp_tpl4_headline', true);
            $llp_tpl4_disclaimer = get_post_meta($post->ID, 'llp_tpl4_disclaimer', true);
            $llp_tpl4_form = get_post_meta($post->ID, 'llp_tpl4_form', true);
            $atform = $llp_tpl4_form;
            if (empty($llp_tpl4_topline)) {
                $llp_tpl4_topline = 'Read This Report Now...';
            }
            if (empty($llp_tpl4_headline)) {
                $llp_tpl4_headline = '"Free Report Reveals... The 5 Dead Simple Ways To Quickly XYZ Guaranteed"';
            }
            if (empty($llp_tpl4_disclaimer)) {
                $llp_tpl4_disclaimer = 'Your Information is 100% Secure And Will Never Be Shared With Anyone.';
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
        <a id="llp_bg_1" href="javascript:void(0);" data-heading="Update Background" data-id="4" data-edit="true" data-type='bgimage' data-default='<img src="<?php echo $llp_bg_1; ?>" border="0" alt="">' data-wp_custom_field='llp_bg_1' class="dspblk llp_btn">Change Background Image<img alt="" src="<?php echo $llp_bg_1; ?>"></a>
        <?php
			}
		}
		?>
        <div class="main-container">
            <div class="main wrapper clearfix">
                <p style="display:block;" id="llp_tpl4_topline" data-heading="Top Line" data-id="1" data-edit="true" data-type='text' data-default='<?php echo $llp_tpl4_topline; ?>' data-wp_custom_field='llp_tpl4_topline' class="dspblk subheadline"><?php echo $llp_tpl4_topline; ?></p>
                <p id="llp_tpl4_headline" data-heading="Top Line" data-id="2" data-edit="true" data-type='text' data-default='<?php echo $llp_tpl4_headline; ?>' data-wp_custom_field='llp_tpl4_headline' class="dspblk headline"><?php echo $llp_tpl4_headline; ?></p>
                <div class="form" id="llp_tpl4_form" data-heading="Optin Form" data-id="1" data-edit="true" data-type='form' data-wp_custom_field='llp_tpl4_form'>
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
                            <button type="submit" class="btn"><?php echo $atform['_optthemes_optinformsubmit']; ?></button>
                        </form>
                    <?php } else { ?>
                        <form></form>
                        <form action="#" method="post" onsubmit="" target="_top">
                            <input placeholder="Enter a Valid Email Here..." onfocus="this.placeholder = 'Enter a Valid Email Here...'" title="Enter a Valid Email Here..." value="" type="email" id="email" data-lb-inputemail="true"><button type="submit" class="btn">Get Instant Access</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <footer><div class="wrapper clearfix">
                <p class="privacy"><img src="<?php echo llp_URL; ?>/llp_tpl/<?php echo $get_llp_tpl->tmp_file; ?>/images/lock.png" alt="">
                    <span id="llp_tpl4_disclaimer" data-heading="Disclaimer" data-id="3" data-edit="true" data-type='text' data-default='<?php echo $llp_tpl4_disclaimer; ?>' data-wp_custom_field='llp_tpl4_disclaimer' class="dspblk"><?php echo $llp_tpl4_disclaimer; ?></span></p>
            </div>
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