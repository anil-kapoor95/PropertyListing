var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		"use strict";
		var dialog = ($.fn.dialog !== undefined),
			$dialogDeletePeriod = $("#dialogDeletePeriod"),
			$frmUpdateOptions = $("#frmUpdateOptions"),
			$frmUpdatePreview = $("#frmUpdatePreview"),
			validate = ($.fn.validate !== undefined),
			tipsy = ($.fn.tipsy !== undefined),
			tabs = ($.fn.tabs !== undefined),
			$tabs = $("#tabs"),
			$seo_tabs = $("#seo_tabs"),
			tOpt = {
				select: function (event, ui) {
					$(":input[name='tab_id']").val(ui.panel.id);
				}
			},
			seo_tOpt = {
				select: function (event, ui) {
					$(":input[name='seo_tab_id']").val(ui.panel.id);
				}
			};
		if (tipsy) {
			$(".center-langbar-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				className: "tipsy-listing-center"
			});
			$(".listing-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				gravity: "nw",
				className: "tipsy-listing"
			});
		}
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs(tOpt);
		}
		if ($seo_tabs.length > 0 && tabs) {
			$seo_tabs.tabs(seo_tOpt);
		}
		$(".field-int").spinner({
			min: 0
		});
		
		if ($frmUpdateOptions.length > 0 && validate) {
			$.validator.addMethod('positiveNumber',
				function (value) 
				{ 
		        	return Number(value) > 0;
				}
			);
			$frmUpdateOptions.validate({
				messages:{
					"value-int-o_items_per_page":{
						required: myLabel.field_required,
						digits: myLabel.digits_only,
						positiveNumber: myLabel.positive_number
					},
					"value-int-o_featured_items_per_page":{
						required: myLabel.field_required,
						digits: myLabel.digits_only,
						positiveNumber: myLabel.positive_number
					}
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: ""
			});
		}
		if ($frmUpdatePreview.length > 0 && validate) {
			
			$.validator.addMethod('positiveNumber',
				function (value) 
				{ 
		        	return Number(value) > 0;
				}
			);
			$frmUpdatePreview.validate({
				messages:{
					"value-int-o_items_per_page":{
						required: myLabel.field_required,
						digits: myLabel.digits_only,
						positiveNumber: myLabel.positive_number
					},
					"value-int-o_featured_items_per_page":{
						required: myLabel.field_required,
						digits: myLabel.digits_only,
						positiveNumber: myLabel.positive_number
					}
				},
				errorPlacement: function (error, element) {
					if(element.attr('name') == 'value-int-o_featured_items_per_page')
					{
						error.insertAfter(element.parent().parent());
					}else{
						error.insertAfter(element.parent());
					}
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		$("#content").on("focusin", ".textarea_install", function (e) {
			$(this).select();
		}).on("change", "select[name='value-enum-o_send_email']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'mail|smtp::mail':
				$(".boxSmtp").hide();
				break;
			case 'mail|smtp::smtp':
				$(".boxSmtp").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_allow_paypal']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'Yes|No::No':
				$(".boxPaypal").hide();
				break;
			case 'Yes|No::Yes':
				$(".boxPaypal").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_allow_stripe']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'Yes|No::No':
				$(".boxStripe").hide();
				break;
			case 'Yes|No::Yes':
				$(".boxStripe").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_allow_authorize']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'Yes|No::No':
				$(".boxAuthorize").hide();
				break;
			case 'Yes|No::Yes':
				$(".boxAuthorize").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_allow_bank']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'Yes|No::No':
				$(".boxBankAccount").hide();
				break;
			case 'Yes|No::Yes':
				$(".boxBankAccount").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_email_request']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerRequest").hide();
				break;
			case '0|1::1':
				$(".boxOwnerRequest").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_email_registration']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerRegistration").hide();
				break;
			case '0|1::1':
				$(".boxOwnerRegistration").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_email_submission']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerSubmission").hide();
				break;
			case '0|1::1':
				$(".boxOwnerSubmission").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_admin_email_request']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxAdminRequest").hide();
				break;
			case '0|1::1':
				$(".boxAdminRequest").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_admin_email_registration']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxAdminRegistration").hide();
				break;
			case '0|1::1':
				$(".boxAdminRegistration").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_admin_email_submission']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxAdminSubmission").hide();
				break;
			case '0|1::1':
				$(".boxAdminSubmission").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_sms_request']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerSMSRequest").hide();
				break;
			case '0|1::1':
				$(".boxOwnerSMSRequest").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_sms_registration']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerSMSRegistration").hide();
				break;
			case '0|1::1':
				$(".boxOwnerSMSRegistration").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_sms_submission']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxOwnerSMSSubmission").hide();
				break;
			case '0|1::1':
				$(".boxOwnerSMSSubmission").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_admin_sms_registration']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxAdminSMSRegistration").hide();
				break;
			case '0|1::1':
				$(".boxAdminSMSRegistration").show();
				break;
			}
		}).on("change", "select[name='value-enum-o_admin_sms_submission']", function (e) {
			switch ($("option:selected", this).val()) {
			case '0|1::0':
				$(".boxAdminSMSSubmission").hide();
				break;
			case '0|1::1':
				$(".boxAdminSMSSubmission").show();
				break;
			}
		}).on("click", ".btnAddPeriod", function () {
			var $c = $("#tblPeriodClone tbody").clone(),
			r = $c.html().replace(/\{INDEX\}/g, 'new_' + Math.ceil(Math.random() * 99999));
			$(this).closest("form").find("table").find("tbody").append(r);
		}).on("click", ".btnDeletePeriod", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			if ($dialogDeletePeriod.length > 0 && dialog) {
				$dialogDeletePeriod.data("link", $(this)).dialog("open");
			}
			return false;
		}).on("click", ".btnRemovePeriod", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $tr = $(this).closest("tr");
			$tr.css("backgroundColor", "#FFB4B4").fadeOut("slow", function () {
				$tr.remove();
			});			
			return false;
		}).on("change", "#plTheme", function (e) {
			var $this = $(this);
			updatePreview('o_layout');
		}).on("change keyup paste spinstop", "#plItemPerPage", function (e) {
			if($(this).valid())
			{
				var $this = $(this);
				delay(function(){
					updatePreview('o_items_per_page');
			    }, 1000 );
			}
		}).on("click", ".pj-use-theme", function (e) {
			var theme = $(this).attr('data-theme');
			$('.pj-loader').css('display', 'block');
			$.ajax({
				type: "GET",
				async: false,
				url: 'index.php?controller=pjAdminOptions&action=pjActionUpdateTheme&theme=' + theme,
				success: function (data) {
					if (String(theme) === '11' || $('#pjT11Panel').length > 0) {
						// the Theme 11 colour panel is shown only while Theme 11 is active
						window.location.reload();
						return;
					}
					$('.theme-holder').html(data);
					$('.pj-loader').css('display', 'none');
				}
			});
		}).on("change", "input[name='bootstrap_site']", function (e) {
			if($(this).is(':checked'))
			{
				$('#install_code').hide();
				$('#install_code_bootstrap').show();
			}else{
				$('#install_code').show();
				$('#install_code_bootstrap').hide();
			}
		});
		var delay = (function(){
			var timer = 0;
			return function(callback, ms){
				clearTimeout (timer);
				timer = setTimeout(callback, ms);
			};
		})();
		function updatePreview(key)
		{
			$frmUpdatePreview.find("input[name='key']").val(key);
			$.post("index.php?controller=pjAdminOptions&action=pjActionUpdatePreview", $frmUpdatePreview.serialize()).done(function (data) {
				if (data.code !== undefined && data.code == 200) {
					console.log(data.code);
				}
			});
		}
		if ($dialogDeletePeriod.length > 0 && dialog) {
			var buttons = {};
			buttons[myLabel.btn_delete] = function () {
				var $this = $(this),
					$link = $this.data("link"),
					$tr = $link.closest("tr"),
					id = $link.data("id");
				
				$.post("index.php?controller=pjAdminOptions&action=pjActionDeletePeriod", {
					"id": id
				}).done(function (data) {
					if (data.code === undefined) {
						return;
					}
					switch (data.code) {
						case 200:
							$tr.css("backgroundColor", "#FFB4B4").fadeOut("slow", function () {
								$tr.remove();
								$this.dialog("close");
							});
							break;
					}
				});
			};
			buttons[myLabel.btn_cancel] = function () {
				$(this).dialog("close");
			};
			$dialogDeletePeriod.dialog({
				modal: true,
				autoOpen: false,
				resizable: false,
				draggable: false,
				buttons: buttons,
				width: 350
			});
		}

		// ===== Email Settings: test connection, send test email, form check =====
		if ($('#frmEmailSettings').length > 0) {
			var L = window.pjEmailLabels || {};
			var lbl = function (key, def) {
				return (L && typeof L[key] === 'string' && L[key] !== '') ? L[key] : def;
			};
			var enumVal = function (v) {
				if (typeof v !== 'string') { return ''; }
				var i = v.indexOf('::');
				return i >= 0 ? v.substring(i + 2) : v;
			};
			var EMAIL_RE = /^[^@\s]+@[^@\s]+\.[^@\s]+$/,
				AJAX_TIMEOUT = 25000,
				baseUrl = window.location.pathname,
				dialogAvailable = ($.fn.dialog !== undefined),
				$emailTestDialog = $('#emailTestDialog'),
				$frmEmail = $('#frmEmailSettings');
			
			var paint = function ($box, kind, text) {
				if (!$box || $box.length === 0) { return; }
				var bg = '#eef', color = '#333', border = '#ccd';
				if (kind === 'success') { bg = '#e6f4ea'; color = '#1e7e34'; border = '#bfe3c9'; }
				else if (kind === 'error') { bg = '#fdecea'; color = '#b02a37'; border = '#f5c2c7'; }
				else if (kind === 'loading') { bg = '#eef2ff'; color = '#3b4a6b'; border = '#c9d4f0'; }
				$box.css({'background': bg, 'color': color, 'border': '1px solid ' + border}).html(text).show();
			};
			var showTestResult = function (kind, text) { paint($('#emailTestResult'), kind, text); };
			var collectEmailSettings = function () {
				var send = enumVal($('select[name="value-enum-o_send_email"]').val());
				var data = {
					send_email: send,
					from_email: $.trim($('input[name="value-string-o_email_address"]').val() || ''),
					from_name:  $.trim($('input[name="value-string-o_from_name"]').val() || '')
				};
				if (send === 'smtp') {
					data.smtp_host   = $.trim($('input[name="value-string-o_smtp_host"]').val() || '');
					data.smtp_port   = $.trim($('input[name="value-int-o_smtp_port"]').val() || '');
					data.smtp_secure = enumVal($('select[name="value-enum-o_smtp_secure"]').val());
					data.smtp_auth   = enumVal($('select[name="value-enum-o_smtp_auth"]').val());
					data.smtp_user   = $.trim($('input[name="value-string-o_smtp_user"]').val() || '');
					data.smtp_pass   = $('input[name="value-string-o_smtp_pass"]').val() || '';
				}
				return data;
			};
			var postTest = function (action, data, $box, $btn, loadingText, failText) {
				paint($box, 'loading', loadingText);
				if ($btn) { $btn.prop('disabled', true); }
				return $.ajax({
					type: 'POST',
					url: baseUrl + '?controller=pjAdminOptions&action=' + action,
					data: data,
					dataType: 'json',
					timeout: AJAX_TIMEOUT
				}).done(function (resp) {
					if (resp && resp.status === 'OK') { paint($box, 'success', resp.text); }
					else { paint($box, 'error', (resp && resp.text) ? resp.text : failText); }
				}).fail(function (xhr, textStatus) {
					paint($box, 'error', (textStatus === 'timeout') ? failText : lbl('unexpected', 'An unexpected error occurred.'));
				}).always(function () {
					if ($btn) { $btn.prop('disabled', false); }
				});
			};
			var doSendTestEmail = function (email, $msg) {
				email = $.trim(email || '');
				if (!email) { paint($msg, 'error', lbl('enterEmail', 'Please enter an email address.')); return; }
				if (!EMAIL_RE.test(email)) { paint($msg, 'error', lbl('validEmail', 'Please enter a valid email address.')); return; }
				var data = collectEmailSettings();
				data.email = email;
				postTest('pjActionAjaxSend', data, $msg, null,
					lbl('sending', 'Sending test email, please wait...'),
					lbl('sendFail', 'The test email could not be sent.'));
			};
			
			if ($emailTestDialog.length > 0 && dialogAvailable) {
				$emailTestDialog.dialog({
					modal: true, autoOpen: false, resizable: false, draggable: false, width: 480,
					buttons: [
						{text: lbl('cancel', 'Cancel'), click: function () { $(this).dialog('close'); }},
						{text: lbl('sendEmail', 'Send Email'), click: function () { doSendTestEmail($('#emailTestModalEmail').val(), $('#emailTestModalMsg')); }}
					]
				});
			}
			
			// SMTP host + port are required when SMTP is selected; sender must look like an email address
			$frmEmail.on('submit', function (e) {
				var data = collectEmailSettings();
				if (data.send_email === 'smtp' && (!data.smtp_host || !data.smtp_port || parseInt(data.smtp_port, 10) <= 0)) {
					e.preventDefault();
					showTestResult('error', lbl('enterHost', 'Please enter the SMTP host and port first.'));
					return false;
				}
				if (data.from_email && !EMAIL_RE.test(data.from_email)) {
					e.preventDefault();
					showTestResult('error', lbl('validEmail', 'Please enter a valid email address.'));
					return false;
				}
				return true;
			});
			
			$("#content")
				.on("click", "#btnTestConnection", function (e) {
					e.preventDefault();
					var data = collectEmailSettings();
					if (!data.smtp_host || !data.smtp_port) {
						showTestResult('error', lbl('enterHost', 'Please enter the SMTP host and port first.'));
						return;
					}
					postTest('pjActionAjaxSmtp', {
						smtp_host: data.smtp_host, smtp_port: data.smtp_port,
						smtp_secure: data.smtp_secure, smtp_auth: data.smtp_auth,
						smtp_user: data.smtp_user, smtp_pass: data.smtp_pass
					}, $('#emailTestResult'), $(this),
					lbl('testing', 'Testing SMTP connection, please wait...'),
					lbl('connFail', 'Connection failed. Please check your SMTP settings.'));
				})
				.on("click", "#btnSendTestEmail", function (e) {
					e.preventDefault();
					var data = collectEmailSettings();
					if (data.send_email === 'smtp' && (!data.smtp_host || !data.smtp_port)) {
						showTestResult('error', lbl('enterHost', 'Please enter the SMTP host and port first.'));
						return;
					}
					if ($emailTestDialog.length > 0 && dialogAvailable) {
						$('#emailTestModalMsg').hide().empty();
						$('#emailTestModalEmail').val(data.from_email || '');
						$emailTestDialog.dialog('open');
						$('#emailTestModalEmail').focus();
					} else {
						var email = window.prompt(lbl('promptEmail', 'Enter the email address to send the test email to:'), data.from_email || '');
						if (email !== null) { doSendTestEmail(email, $('#emailTestResult')); }
					}
				});
		}
	});
})(jQuery_1_8_2);