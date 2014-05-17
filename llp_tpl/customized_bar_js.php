<script src="<?php echo llp_URL; ?>/llp_tpl/js/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function() {
<?php if ($do == 'create') { ?>
            $("#pgid").val('');
<?php } ?>
<?php if ($do == 'edit') { ?>
            $("#pgid").val('<?php echo $post->ID; ?>');
<?php } ?>

        jQuery('#codehtmlbtn').click(change_selects);
        function str_replace(search, replace, subject, count) {
            var i = 0, j = 0, temp = '', repl = '', sl = 0, fl = 0,
                    f = [].concat(search),
                    r = [].concat(replace),
                    s = subject,
                    ra = r instanceof Array, sa = s instanceof Array;
            s = [].concat(s);
            if (count) {
                this.window[count] = 0;
            }
            for (i = 0, sl = s.length; i < sl; i++) {
                if (s[i] === '') {
                    continue;
                }
                for (j = 0, fl = f.length; j < fl; j++) {
                    temp = s[i] + '';
                    repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
                    s[i] = (temp).split(f[j]).join(repl);
                    if (count && s[i] !== temp) {
                        this.window[count] += (temp.length - s[i].length) / f[j].length;
                    }
                }
            }
            return sa ? s : s[0];
        }
        function change_selects() {
            var tags = ['a', 'iframe', 'frame', 'frameset', 'script'], reg, val = jQuery('#_optthemes_webformcodehtml').val(),
                    hdn = jQuery('#popup_domination_hdn_div2'), formurl = jQuery('#_optthemes_optinformurl'), hiddenfields = jQuery('#_optthemes_webformhiddenhtml');
            formurl.val('');
            if (jQuery.trim(val) == '')
                return false;
            jQuery('#popup_domination_hdn_div').html('');
            jQuery('#popup_domination_hdn_div2').html('');
            /*var tmp = jQuery(val);
             tmp.find('a,iframe,frame,frameset,script,img').remove();
             tmp.find('input[type="image"]').attr('src','');*/
            for (var i = 0; i < 5; i++) {
                reg = new RegExp('<' + tags[i] + '([^<>+]*[^\/])>.*?</' + tags[i] + '>', "gi");
                val = val.replace(reg, '');
                reg = new RegExp('<' + tags[i] + '([^<>+]*)>', "gi");
                val = val.replace(reg, '');
            }
            var tmpval;
            try {
                tmpval = decodeURIComponent(val);
            } catch (err) {
                tmpval = val;
            }
            hdn.append(tmpval);
            /*alert(hdn.html());*/
            var num = 0;
            var name_selected = '';
            var email_selected = '';
            var sffields_c = jQuery('.sffields_c');
			var other_fields_c = jQuery('.other_fields_c');
            sffields_c.html('');
			other_fields_c.html('');
            jQuery('*', hdn).each(function() {
                var fieldtype = jQuery(this).attr('type');
                var name = jQuery(this).attr('name');
                if (fieldtype != "") {
                    if (fieldtype == 'date' || fieldtype == 'datetime' || fieldtype == 'datetime-local' || fieldtype == 'email' || fieldtype == 'month' || fieldtype == 'number' || fieldtype == 'password' || fieldtype == 'search' || fieldtype == 'tel' || fieldtype == 'text' || fieldtype == 'time' || fieldtype == 'url' || fieldtype == 'week') {
                        //console.log(name);
                        sffields_c.append('<br/><div class="form-field form-required optinbelow"><strong class="data_link">Field Label</strong><input type="text" class="optinbelow textfield" name="optintext[' + name + ']" value="' + name + '"/></div><div class="form-field form-required optinbelow"><input type="checkbox" name="optincheck[' + name + ']" value="yes" style="margin-left:3%;margin-right:3%;width: auto; height: 21px; vertical-align: middle;">Show?</div><input type="hidden" name="optintype[' + name + ']" value="' + fieldtype + '"/>');
                    }
                }
                num++;
            });
            jQuery(':input[type=hidden]', hdn).each(function() {
                jQuery('#popup_domination_hdn_div').append(jQuery('<input type="hidden" name="' + jQuery(this).attr('name') + '" />').val(jQuery(this).val()));
            });
			other_fields_c.append('<div class="other_fields_c"><p></p><div class="form-field form-required formurl optinbelow"><strong class="data_link">Form URL</strong><input type="text" class="formurl optinbelow textfield" name="_optthemes_optinformurl" id="_optthemes_optinformurl" value=""></div><p></p><p></p><div class="form-field form-required formurl optinbelow"><strong class="data_link">Hidden Fields</strong><textarea name="_optthemes_webformhiddenhtml" id="_optthemes_webformhiddenhtml" columns="30" rows="3" class="textarea"></textarea></div><p></p><p></p><div class="form-field form-required formurl optinbelow"><strong class="data_link">Submit Label</strong><input type="text" class="formurl optinbelow textfield" name="_optthemes_optinformsubmit" id="_optthemes_optinformsubmit" value=""></div><p></p></div>');
            var hidden_f = jQuery('#popup_domination_hdn_div').html();
			formurl = jQuery('#_optthemes_optinformurl');
			hiddenfields = jQuery('#_optthemes_webformhiddenhtml');
            formurl.val(jQuery('form', hdn).attr('action'));
            hidden_f = str_replace("&lt;", "<", hidden_f);
            hidden_f = str_replace("&gt;", ">", hidden_f);
            hiddenfields.val(hidden_f);
            //alert(tmpval);
            hdn.html('');
        };

        function llp_response(apply, text) {
            var llp_response = $(".llp_response .llp_response_text");
			llp_response.html(text).parent().addClass(apply).show();
            $('html').animate({scrollTop: 0}, 'slow');
        }

        $('.llp_response_close').click(function() {
            $(".llp_response").hide();
        });
        $("#llp_save_create_page").click(function() {
            data = 'llp_create_page=' + $("#llp_create_page").val() + '&llp_tpl_id=<?php echo $llp_tpl_id; ?>&do=llp_create_page&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            if ($("#llp_create_page").val() == "") {
                llp_response('llp_error', 'Please enter page title');
                return false;
            }
            $.post('<?php echo home_url(); ?>/wp-admin/admin-ajax.php', data, function(response) {
                console.log(response);
                if ($.isNumeric(response)) {
                    if (response == 0) {
                        llp_response('llp_error', 'There is some issue while creating page please try again.');
                    } else {
                        llp_response('llp_success', 'Page created successfully.');
                        $('.cstmz').show();
                        $('#pgid').val(response);
                        $('.crp').remove();
                    }
                }
            });
        });

        var customized_bar_heading = $('#customized_bar_heading');
        var dataIdc = $('#dataIdc');
        var dataCSF = $('#dataCSF');
        var llp_img_c = $(".img_c");
		var llp_bgimg_c = $(".bgimg_c");
        var llp_image_link_a_editor = $('#llp_image_link_a_editor');
        var llp_link_a_editor = $('#llp_link_a_editor');
        var llp_link_target_editor = $('#llp_link_target_editor');
        var data_type_link = $('.data_type_link');
        var data_type_image = $('.data_type_image');
		var data_type_bgimage = $('.data_type_bgimage');
        var data_type_form = $('.data_type_form');
        var llp_data_menu = $('.llp_data_menu');
        var data_type_menu = $('.data_type_menu');
        var llp_reset = $("#llp_reset");
        var llp_save = $("#llp_save");

        if ($("#pgid").val() == "") {
            llp_response('llp_error', '<<---- Please enter page name on your left before customizing the page');
        }
		
		$('#use_as_link_label').click(function(){
			$('#use_as_link').trigger('click');
		});
		$('#use_as_optin_form_label').click(function(){
			$('#use_as_optin_form').trigger('click');
		});
		
		$('#use_as_link').click(function(){
			var dataId = dataIdc.val();
			$('#use_as_optin_form').removeAttr('checked');
			$('#use_as_link').attr('checked','checked');
			$('.use_as_link_options').show();
			llp_link_a_editor.val('');
			$("*").find("[data-id='" + dataId + "']").attr('href', '');
		});
		$('#use_as_optin_form').click(function(){
			var dataId = dataIdc.val();
			$('#use_as_link').removeAttr('checked');
			$('#use_as_optin_form').attr('checked','checked');
			$('.use_as_link_options').hide();
			llp_link_a_editor.val('#inline1');
			$("*").find("[data-id='" + dataId + "']").attr('href', llp_link_a_editor.val());
		});

        $('*').click(function() {
            var _this = $(this);
            var dataEdit = _this.attr('data-edit');
            var dataLink = _this.attr('data-link');
            var dataReplaceLeft = _this.attr('data-replace-left');
            var dataReplaceRight = _this.attr('data-replace-right');
            var dataImageLink = _this.attr('data-image-link');
            var dataTarget = _this.attr('data-target');
            var dataHeading = _this.attr('data-heading');
            var dataIdValue = _this.attr('data-id');
            var dataType = _this.attr('data-type');
            var dataDefault = _this.attr('data-default');
            var dataCurrentMenu = _this.attr('data-current-menu');
            var dataWpCustomField = _this.attr('data-wp_custom_field');

            if (dataReplaceLeft == null || dataReplaceLeft == "undefined" || dataReplaceLeft == "") {
                dataReplaceLeft = '';
            }
            if (dataReplaceRight == null || dataReplaceRight == "undefined" || dataReplaceRight == "") {
                dataReplaceRight = '';
            }

            if ($("#pgid").val() == "") {
                if (dataEdit == 'true') {
                    llp_response('llp_error', '<<---- Please enter page name on your left before customizing the page');
                    return false;
                }
            } else if (dataEdit == 'true') {
                $('.cstmz').show();
                if (dataType == 'form') {

                } else if (dataType == 'menu') {

                } else if (dataType == 'image') {
                    var data = _this.children('img').attr('src');
                    llp_img_c.attr('src', data);
                    llp_image_link_a_editor.val(_this.attr('href'));
                } else if (dataType == 'bgimage') {
                    var data = _this.children('img').attr('src');
                    llp_bgimg_c.attr('src', data);
                } else {
                    var data = _this.html();
                }
                customized_bar_heading.html(dataHeading);

                dataIdc.val(dataIdValue);
                dataCSF.val(dataWpCustomField);

                var dataId = dataIdc.val();
                var dataWpcsf = dataCSF.val();

                var llp_custom_editor = $("#llp_" + dataType + "_editor");

                if (dataType == 'editor') {
                    tinymce.init({
                        menubar: false,
                        selector: ".cstm_editor",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime media nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
                    });

                    $("#prv").click(function() {
                        $("*").find("[data-id='" + dataId + "']").html(tinyMCE.get('llp_custom_editor').getContent());
                    });
                }

                $('.edtr').hide().removeClass('actvEdtr');
                data_type_link.hide();
                data_type_image.hide();
				data_type_bgimage.hide();
                data_type_menu.hide();
                data_type_form.hide();

                if (dataType == 'form') {
                    data_type_form.show();
                } else if (dataType == 'menu') {
                    data_type_menu.show();
                    $('#llp_data_menu').val(dataCurrentMenu);
                } else if (dataReplaceLeft != "" && dataReplaceRight != "") {
                    llp_custom_editor.show().val(data.replace(dataReplaceLeft, '').replace(dataReplaceRight, '')).addClass('actvEdtr');
                } else if (dataReplaceLeft != "") {
                    llp_custom_editor.show().val(data.replace(dataReplaceLeft, '')).addClass('actvEdtr');
                } else if (dataReplaceRight != "") {
                    llp_custom_editor.show().val(data.replace(dataReplaceRight, '')).addClass('actvEdtr');
                } else {
                    llp_custom_editor.show().val(data).addClass('actvEdtr');
                }

                if (dataLink){
                    if (dataType == 'link') {
                        data_type_link.show();
                        llp_link_a_editor.val(_this.attr('href'));
						if(_this.attr('href')=='#inline1'){
							$('.use_as_link_options').hide();
							$('#use_as_link').removeAttr('checked');
							$('#use_as_optin_form').trigger('click');
						}
                        llp_link_a_editor.keyup(function() {
                            var dataId = dataIdc.val();
                            $("*").find("[data-id='" + dataId + "']").attr('href', llp_link_a_editor.val());
                        });
                        llp_link_target_editor.change(function() {
                            var dataId = dataIdc.val();
                            if (llp_link_target_editor.val() == '0') {
                                $("*").find("[data-id='" + dataId + "']").removeAttr('target');
                            }
                            if (llp_link_target_editor.val() == '1') {
                                $("*").find("[data-id='" + dataId + "']").attr('target', '_blank');
                            }
                        });
                    }
                }
                if (dataType == 'image') {
                    data_type_image.show();
                    llp_image_link_a_editor.keyup(function() {
                        var dataId = dataIdc.val();
                        $("*").find("[data-id='" + dataId + "']").attr('href', llp_image_link_a_editor.val());
                    });
                }
				if (dataType == 'bgimage') {
                    data_type_bgimage.show();
                }
                llp_custom_editor.keyup(function() {
                    var dataId = dataIdc.val();
                    if (dataType == 'image') {
                        llp_img_c.attr('src', llp_custom_editor.val());
                        $("*").find("[data-id='" + dataId + "']").children('img').attr('src', llp_custom_editor.val());
                    } else if (dataType == 'bgimage') {
                        llp_bgimg_c.attr('src', llp_custom_editor.val());
                        $("*").find("[data-id='" + dataId + "']").children('img').attr('src', llp_custom_editor.val());
						$("body").css({
							'background-image':'url("'+llp_custom_editor.val()+'")',
							'-webkit-background-size':'cover',
							'-moz-background-size':'cover',
							'background-size':'cover'
						});
                    } else {
                        if (dataReplaceLeft != "" && dataReplaceRight != "") {
                            $("*").find("[data-id='" + dataId + "']").html(dataReplaceLeft + llp_custom_editor.val() + dataReplaceRight);
                        } else if (dataReplaceLeft != "") {
                            $("*").find("[data-id='" + dataId + "']").html(dataReplaceLeft + llp_custom_editor.val());
                        } else if (dataReplaceRight != "") {
                            $("*").find("[data-id='" + dataId + "']").html(llp_custom_editor.val() + dataReplaceRight);
                        } else {
                            $("*").find("[data-id='" + dataId + "']").html(llp_custom_editor.val());
                        }
                    }
                });

                llp_save.show();

                if (dataType != 'editor') {
                    if (dataType == 'form') {
                        llp_reset.hide();
                    } else {
                        llp_reset.show();
                    }
                }

            }
        });
		llp_reset.click(function() {
			var dataId = dataIdc.val();
			var _this = $("*").find("[data-id='" + dataId + "']");
            var dataEdit = _this.attr('data-edit');
            var dataLink = _this.attr('data-link');
            var dataReplaceLeft = _this.attr('data-replace-left');
            var dataReplaceRight = _this.attr('data-replace-right');
            var dataImageLink = _this.attr('data-image-link');
            var dataTarget = _this.attr('data-target');
            var dataHeading = _this.attr('data-heading');
            var dataIdValue = _this.attr('data-id');
            var dataType = _this.attr('data-type');
            var dataDefault = _this.attr('data-default');
            var dataCurrentMenu = _this.attr('data-current-menu');
            var dataWpCustomField = _this.attr('data-wp_custom_field');
			var dataWpcsf = dataCSF.val();
			var llp_custom_editor = $("#llp_" + dataType + "_editor");
			
			if (dataType == 'menu') {
				$('#llp_data_menu').val(dataDefault);
				var clonemenu = jQuery("div[data-menu='" + dataDefault + "']").html();
				$('#' + dataWpcsf + '').html(clonemenu);
			} else if (dataType == 'image') {
				$("*").find("[data-id='" + dataId + "']").html(dataDefault);
				llp_img_c.attr('src', $('#' + dataWpcsf + '').children('img').attr('src'));
				llp_custom_editor.val($('#' + dataWpcsf + '').children('img').attr('src'));
				llp_image_link_a_editor.val(dataImageLink);
				$("*").find("[data-id='" + dataId + "']").attr('href', llp_image_link_a_editor.val());
			} else if (dataType == 'bgimage') {
				$("*").find("[data-id='" + dataId + "']").html('Change Background Image'+dataDefault);
				llp_bgimg_c.attr('src', $('#' + dataWpcsf + '').children('img').attr('src'));
				llp_custom_editor.val($('#' + dataWpcsf + '').children('img').attr('src'));
				$("body").css({
					'background-image':'url("'+$('#' + dataWpcsf + '').children('img').attr('src')+'")',
					'-webkit-background-size':'cover',
					'-moz-background-size':'cover',
					'background-size':'cover'
				});
			} else {
				llp_custom_editor.val(dataDefault);
				if (dataReplaceLeft != "" && typeof(dataReplaceLeft) != "undefined" && dataReplaceRight != "" && typeof(dataReplaceRight) != "undefined") {
					console.log(dataType);
					$("*").find("[data-id='" + dataId + "']").html(dataReplaceLeft + dataDefault + dataReplaceRight);
				} else if (dataReplaceLeft != "" && typeof(dataReplaceLeft) != "undefined") {
					$("*").find("[data-id='" + dataId + "']").html(dataReplaceLeft + dataDefault);
				} else if (dataReplaceRight != "" && typeof(dataReplaceRight) != "undefined") {
					$("*").find("[data-id='" + dataId + "']").html(dataDefault + dataReplaceRight);
				} else {
					$("*").find("[data-id='" + dataId + "']").html(dataDefault);
				}
			}
			
			if (dataLink) {
				if (dataType == 'link') {
					llp_link_a_editor.val(dataLink);
					if(dataLink=='#inline1'){
						$('.use_as_link_options').hide();
						$('#use_as_link').removeAttr('checked');
						$('#use_as_optin_form').trigger('click');
					}
					$("*").find("[data-id='" + dataId + "']").attr('href', llp_link_a_editor.val());
					if (dataTarget == '0') {
						llp_link_target_editor.val('0');
						$("*").find("[data-id='" + dataId + "']").removeAttr('target');
					}
					if (dataTarget == '1') {
						llp_link_target_editor.val('1');
						$("*").find("[data-id='" + dataId + "']").attr('target', '_blank');
					}
				}
			}
			return false;
		});
        $("#llp_save").click(function() {
            var dataPGid = $('#pgid').val();
            var dataWpcsf = dataCSF.val();
            var dataLink = $('#' + dataWpcsf + '').attr('data-link');
            var dataType = $('#' + dataWpcsf + '').attr('data-type');

            var actvEdtrValue = '';
            var actvEdtr = $(".actvEdtr").val();
            actvEdtrValue = actvEdtr;
            if (dataType == 'image') {
                if (llp_image_link_a_editor.val() == "") {
                    image_link_a = 'null';
                } else {
                    image_link_a = llp_image_link_a_editor.val();
                }
                data = 'llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&llp_metavalue=' + actvEdtrValue + '&llp_image_link=' + image_link_a + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            } else if (dataType == 'bgimage') {
                data = 'llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&llp_metavalue=' + actvEdtrValue + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            } else if (dataType == 'form') {
                data = $('#atform_c').serialize() + '&llp_data_type=form&llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            } else if (dataType == 'menu') {
                var actvEdtr = $("#llp_data_menu").val();
                $('#' + dataWpcsf + '').attr('data-current-menu', actvEdtr);
                actvEdtrValue = actvEdtr;
                data = 'llp_data_type=' + dataType + '&llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&llp_metavalue=' + actvEdtrValue + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            } else if (dataType == 'link') {
                if (llp_link_a_editor.val() == "") {
                    link_a = 'null';
                } else {
                    link_a = llp_link_a_editor.val();
                }
                var link_a_open = llp_link_target_editor.val();

                data = 'llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&llp_metavalue=' + actvEdtrValue + '&llp_link_a=' + link_a + '&llp_link_a_open=' + link_a_open + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            } else {
                data = 'llp_id=' + dataPGid + '&llp_metafield=' + dataWpcsf + '&llp_metavalue=' + actvEdtrValue + '&do=llp_save_meta&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>';
            }
            $.post('<?php echo home_url(); ?>/wp-admin/admin-ajax.php', data, function(response) {
                if (response != "") {
                    llp_response('llp_success', 'Changes saved.');
                    if (response == 'refresh') {
                        $('html, body').animate({scrollTop: 0}, 'slow', function() {
                            $(".llp_response .llp_response_text").html('Changes saved.').parent().addClass('llp_success').show();
                            location.reload();
                        });
                    }
                }
            });
        });
        $('.m_c_customized a').click(function() {
			if($(this).attr('href')=='#inline1'){
				return true;	
			} else {
            	return false;
			}
        });
        $('.m_c_customized form').click(function() {
            return false;
        });
        $('#uploadImage').submit(function() {
            var form = new FormData(jQuery(this)[0]);
            jQuery.ajax({
                url: '<?php echo home_url(); ?>/wp-admin/admin-ajax.php?do=llp_upload_image&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>',
                type: 'POST',
                dataType: "json",
                success: function(result) {
                    if (result["pass"] != "") {
                        var dataId = dataIdc.val();
                        var llp_custom_editor = $('#llp_image_editor');
                        llp_custom_editor.val(result["pass"]);
                        llp_img_c.attr('src', llp_custom_editor.val());
                        $("*").find("[data-id='" + dataId + "']").children('img').attr('src', llp_custom_editor.val());
                    } else if (result["error"] != "") {
                        llp_response('llp_error', result["error"]);
                    }
                },
                data: form,
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        });
		$('#uploadbgImage').submit(function() {
            var form = new FormData(jQuery(this)[0]);
            jQuery.ajax({
                url: '<?php echo home_url(); ?>/wp-admin/admin-ajax.php?do=llp_upload_image&action=update_llp_options&llp_nonce=<?php echo $nonce; ?>',
                type: 'POST',
                dataType: "json",
                success: function(result) {
                    if (result["pass"] != "") {
                        var dataId = dataIdc.val();
                        var llp_custom_editor = $('#llp_bgimage_editor');
                        llp_custom_editor.val(result["pass"]);
                        llp_bgimg_c.attr('src', llp_custom_editor.val());
                        $("*").find("[data-id='" + dataId + "']").children('img').attr('src', llp_custom_editor.val());
						$("body").css('background-image','url("'+llp_custom_editor.val()+'")');
                    } else if (result["error"] != "") {
                        llp_response('llp_error', result["error"]);
                    }
                },
                data: form,
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        });
        $('#llp_data_menu').change(function() {
            var dataWpcsf = dataCSF.val();
            _this = jQuery(this);
            $('#' + dataWpcsf + '').attr('data-current-menu', _this.val());
            var clonemenu = jQuery("div[data-menu='" + _this.val() + "']").html();
            $('#' + dataWpcsf + '').html(clonemenu);
        });
    });
</script>