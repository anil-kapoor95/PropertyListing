<?php
/**
 * Theme 11 - Login / Create an Account page.
 * One card with a Login / Create an Account switch. Form ids, field names, validation attributes and the captcha
 * are the same as in the default template (the shared pjListings.js validation keeps working).
 */
mt_srand();
$index = mt_rand(1, 9999);
include_once dirname(__FILE__) . '/elements/icons.php';
$allow_reg = ($tpl['option_arr']['o_allow_add_property'] == 'Yes');
$open_reg = $allow_reg && (isset($tpl['err']) || isset($_GET['status']) || isset($_POST['register']) || (isset($_GET['tab']) && $_GET['tab'] == 'register'));
$wid = 'pjWrapperPropertyListing_' . $index;
?>
<div id="<?php echo $wid; ?>" class="t11-wrap t11-account">
	<div class="container-fluid pjPplContainer">
		<?php include_once dirname(dirname(__FILE__)) . '/elements/header.php';?>
		<div class="t11-acc-stage">
			<div class="t11-acc-card">
				<div class="t11-acc-avatar"><?php echo t11_icon('user', 't11-i'); ?></div>
				<?php
				if ($allow_reg)
				{
					?>
					<div class="t11-acc-seg" role="tablist">
						<button type="button" role="tab" class="t11-acc-tab<?php echo $open_reg ? '' : ' on'; ?>" data-t11-tab="login"><?php echo t11_icon('login'); ?><span><?php __('front_layout1_login');?></span></button>
						<button type="button" role="tab" class="t11-acc-tab<?php echo $open_reg ? ' on' : ''; ?>" data-t11-tab="register"><?php echo t11_icon('userplus'); ?><span><?php __('front_layout1_create_account');?></span></button>
					</div>
					<?php
				}
				?>

				<form class="pjPplFormAcc t11-acc-form<?php echo $open_reg ? '' : ' on'; ?>" data-t11-pane="login" action="<?php echo PJ_INSTALL_URL;?>index.php?controller=pjAdmin&amp;action=pjActionLogin" method="post" target="_blank" id="frmPLLogin" name="frmPLLogin">
					<input type="hidden" name="login_user" value="1" />
					<?php if (isset($_GET['iframe'])) { ?><input type="hidden" name="iframe" value="" /><?php } ?>
					<h2 class="t11-acc-title pjPplFormAccTitle"><?php __('front_layout1_login_to_account');?></h2>
					<p class="t11-acc-sub"><?php __('front_layout1_login_text');?></p>

					<div class="form-group t11-field">
						<?php echo t11_icon('mail', 't11-i t11-fi'); ?>
						<input type="text" name="login_email" class="form-control required email" placeholder="<?php __('front_layout1_email');?>" data-err="<?php __('front_layout1_email_required');?>" data-email="<?php __('front_layout1_email_invalid');?>"/>
					</div>
					<div class="form-group t11-field">
						<?php echo t11_icon('lock', 't11-i t11-fi'); ?>
						<input type="password" name="login_password" class="form-control required" placeholder="<?php __('front_layout1_password');?>" data-err="<?php __('front_layout1_password_required');?>"/>
						<button type="button" class="t11-eye" aria-label="<?php echo pjSanitize::html(t11_label('t11_show_password', 'Show password')); ?>"><?php echo t11_icon('eye'); ?></button>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-default t11-acc-btn"><?php __('front_layout1_login');?></button>
					</div>
					<a class="t11-acc-link" href="?controller=pjListings&amp;action=pjActionForgot"><?php __('front_layout1_forgot_password');?></a>
					<?php if ($allow_reg) { ?>
						<p class="t11-acc-switch"><?php echo pjSanitize::html(t11_label('t11_no_account', 'No account yet?')); ?> <a href="#" data-t11-go="register"><?php __('front_layout1_create_account');?></a></p>
					<?php } ?>
				</form>

				<?php
				if ($allow_reg)
				{
					?>
					<form class="pjPplFormAcc t11-acc-form<?php echo $open_reg ? ' on' : ''; ?>" data-t11-pane="register" action="?controller=pjListings&amp;action=pjActionAccount" method="post" id="frmPLRegister" name="frmPLRegister">
						<input type="hidden" name="register" value="1" />
						<h2 class="t11-acc-title pjPplFormAccTitle"><?php __('front_layout1_create_account');?></h2>
						<p class="t11-acc-sub"><?php __('front_layout1_account_text');?></p>
						<?php
						if (isset($tpl['err']))
						{
							$register_err = __('register_err', true);
							?><div class="form-group"><div class="alert alert-danger" role="alert"><?php echo $register_err[$tpl['err']];?></div></div><?php
						}
						if (isset($_GET['status']))
						{
							$register_statuses = __('register_statuses', true);
							?><div class="form-group"><div class="alert alert-success" role="alert"><?php echo $register_statuses[$_GET['status']];?></div></div><?php
						}
						?>
						<div class="form-group t11-field">
							<?php echo t11_icon('user', 't11-i t11-fi'); ?>
							<input type="text" name="name" class="form-control required" placeholder="<?php __('front_layout1_name');?>" data-err="<?php __('front_layout1_name_required');?>" value="<?php echo isset($_POST['name']) ? htmlspecialchars(stripslashes($_POST['name'])) : null;?>"/>
						</div>
						<div class="form-group t11-field">
							<?php echo t11_icon('mail', 't11-i t11-fi'); ?>
							<input type="text" name="email" class="form-control required email" placeholder="<?php __('front_layout1_email');?>" data-folder="<?php echo PJ_INSTALL_FOLDER;?>" data-exist="<?php __('front_email_exists');?>" data-err="<?php __('front_layout1_email_required');?>" data-email="<?php __('front_layout1_email_invalid');?>" value="<?php echo isset($_POST['email']) ? htmlspecialchars(stripslashes($_POST['email'])) : null;?>"/>
						</div>
						<div class="t11-acc-two">
							<div class="form-group t11-field">
								<?php echo t11_icon('lock', 't11-i t11-fi'); ?>
								<input type="password" name="password" class="form-control required" placeholder="<?php __('front_layout1_password');?>" data-err="<?php __('front_layout1_password_required');?>"/>
							</div>
							<div class="form-group t11-field">
								<?php echo t11_icon('lock', 't11-i t11-fi'); ?>
								<input type="password" name="reenter_password" class="form-control required" placeholder="<?php __('front_layout1_reenter_password');?>" data-err="<?php __('front_layout1_reenter_password_required');?>" data-match="<?php __('front_layout1_password_match');?>"/>
							</div>
						</div>
						<div class="t11-acc-two">
							<div class="form-group t11-field">
								<?php echo t11_icon('phone', 't11-i t11-fi'); ?>
								<input type="text" name="phone" class="form-control" placeholder="<?php __('front_layout1_phone');?>" value="<?php echo isset($_POST['phone']) ? htmlspecialchars(stripslashes($_POST['phone'])) : null;?>"/>
							</div>
							<div class="form-group t11-field">
								<?php echo t11_icon('print', 't11-i t11-fi'); ?>
								<input type="text" name="fax" class="form-control" placeholder="<?php __('front_layout1_fax');?>" value="<?php echo isset($_POST['fax']) ? htmlspecialchars(stripslashes($_POST['fax'])) : null;?>"/>
							</div>
						</div>
						<div class="form-group t11-cap">
							<div class="t11-field">
								<?php echo t11_icon('shield', 't11-i t11-fi'); ?>
								<input type="text" id="pjPlCaptchaField" name="captcha" class="form-control ppCaptchaField required" placeholder="<?php __('front_layout1_captcha');?>" maxlength="6" autocomplete="off" data-folder="<?php echo PJ_INSTALL_FOLDER;?>" data-err="<?php __('front_layout1_captcha_required');?>" data-captcha="<?php __('front_layout1_captcha_incorrect');?>"/>
							</div>
							<div class="t11-capimg"><img id="pjPlCaptchaImage" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="Captcha"/></div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-block btn-default t11-acc-btn"><?php __('front_layout1_send');?></button>
						</div>
						<p class="t11-acc-switch"><?php echo pjSanitize::html(t11_label('t11_have_account', 'Already have an account?')); ?> <a href="#" data-t11-go="login"><?php __('front_layout1_login');?></a></p>
					</form>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php include_once dirname(dirname(__FILE__)) . '/elements/loadjs.php';?>
<?php include dirname(__FILE__) . '/elements/colors.php'; ?>
<script type="text/javascript">
(function () {
	var root = document.getElementById("<?php echo $wid; ?>");
	if (!root) { return; }
	function show(name) {
		var i, panes = root.querySelectorAll("[data-t11-pane]"), tabs = root.querySelectorAll("[data-t11-tab]");
		for (i = 0; i < panes.length; i++) { panes[i].className = panes[i].className.replace(/\s*\bon\b/g, "") + (panes[i].getAttribute("data-t11-pane") === name ? " on" : ""); }
		for (i = 0; i < tabs.length; i++) { tabs[i].className = tabs[i].className.replace(/\s*\bon\b/g, "") + (tabs[i].getAttribute("data-t11-tab") === name ? " on" : ""); tabs[i].setAttribute("aria-selected", tabs[i].getAttribute("data-t11-tab") === name ? "true" : "false"); }
	}
	root.addEventListener("click", function (e) {
		var t = e.target, el;
		while (t && t !== root) {
			if (t.getAttribute && t.getAttribute("data-t11-tab")) { show(t.getAttribute("data-t11-tab")); return; }
			if (t.getAttribute && t.getAttribute("data-t11-go")) { e.preventDefault(); show(t.getAttribute("data-t11-go")); return; }
			if (t.className && /\bt11-eye\b/.test(t.className)) {
				el = t.parentNode.querySelector("input");
				if (el) { el.type = (el.type === "password") ? "text" : "password"; t.className = (el.type === "text") ? t.className + " on" : t.className.replace(/\s*\bon\b/g, ""); }
				return;
			}
			t = t.parentNode;
		}
	});
})();
</script>
