<?php include_once dirname(__FILE__) . '/icons.php'; include dirname(__FILE__) . '/colors.php'; ?>
<nav class="t11-nav pjPplHeading" role="navigation">
	<div class="t11-brand"><?php echo t11_icon('home', 't11-i t11-i-brand'); ?></div>
	<ul class="t11-tabs nav nav-tabs">
		<?php
		if ($tpl['option_arr']['o_seo_url'] == 'No')
		{
			$all_url = $_SERVER['SCRIPT_NAME'] . '?controller=pjListings&amp;action=pjActionProperties';
		} else {
			$all_url = $_SERVER['PHP_SELF'];
		}
		?>
		<li<?php echo $_GET['action'] == 'pjActionProperties' || $_GET['action'] == 'pjActionPreview' ? ' class="active pjPplBtnActive"' : null;?>><a href="<?php echo $all_url; ?>"><?php __('front_layout1_all');?></a></li>
		<li<?php echo $_GET['action'] == 'pjActionMap' ? ' class="active pjPplBtnActive"' : null;?>><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjListings&amp;action=pjActionMap"><?php __('front_layout1_map');?></a></li>
	</ul>
	<div class="t11-nav-right">
		<?php
		if (isset($tpl['locale_arr']) && count($tpl['locale_arr']) > 1)
		{
			$locale_id = $controller->pjActionGetLocale();
			$selected_lang = '';
			$selected_flag = '';
			foreach ($tpl['locale_arr'] as $locale)
			{
				if ($locale_id == $locale['id'])
				{
					$selected_lang = $locale['language_iso'];
					$lang_iso = explode("-", $selected_lang);
					if (isset($lang_iso[1])) { $selected_lang = $lang_iso[1]; }
					if (!empty($locale['flag']) && is_file(PJ_INSTALL_PATH . $locale['flag']))
					{
						$selected_flag = PJ_INSTALL_FOLDER . $locale['flag'];
					} elseif (!empty($locale['file']) && is_file(PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $locale['file'])) {
						$selected_flag = PJ_INSTALL_FOLDER . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $locale['file'];
					}
				}
			}
			?>
			<div class="dropdown pjPplLanguage">
				<button class="btn btn-default dropdown-toggle pjPplBtnNav" type="button" id="dropdownMenu1" data-pj-toggle="dropdown" aria-expanded="true">
					<img src="<?php echo $selected_flag; ?>" alt="">
					<span class="title"><?php echo $selected_lang;?>&nbsp;<span class="caret"></span></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
					<?php
					foreach ($tpl['locale_arr'] as $locale)
					{
						$flag = '';
						if (!empty($locale['flag']) && is_file(PJ_INSTALL_PATH . $locale['flag']))
						{
							$flag = PJ_INSTALL_FOLDER . $locale['flag'];
						} elseif (!empty($locale['file']) && is_file(PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $locale['file'])) {
							$flag = PJ_INSTALL_FOLDER . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $locale['file'];
						}
						?>
						<li role="presentation">
							<a role="menuitem" tabindex="-1" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?controller=pjListings&amp;action=pjActionSetLocale&amp;locale=<?php echo $locale['id']; ?><?php echo isset($_GET['iframe']) ? '&amp;iframe' : NULL; ?>">
								<img src="<?php echo $flag; ?>" alt="">
								<span class="title"><?php echo pjSanitize::html($locale['name']); ?></span>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
			<?php
		}
		?>
		<button class="btn btn-link pjPplBtnAcc t11-login" type="button" onclick="window.location='<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjListings&amp;action=pjActionAccount';"><?php echo t11_icon('user'); ?><span><?php $tpl['option_arr']['o_allow_add_property'] == 'Yes'? __('front_layout1_menu_login') : __('front_menu_login');?></span></button>
	</div>
</nav>
