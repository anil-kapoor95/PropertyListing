<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	$titles = __('error_titles', true);
	$bodies = __('error_bodies', true);
	if (isset($_GET['err']) && isset($titles[$_GET['err']]))
	{
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	?>
	<?php pjUtil::printNotice(__('infoThemeTitle', true), __('infoThemeDesc', true), false, false); ?>
	<div class="theme-holder pj-loader-outer">
		<?php include PJ_VIEWS_PATH . 'pjAdminOptions/elements/theme.php'; ?>
	</div>
	<div class="clear_both"></div>
	<?php
	$option_arr = $tpl['option_arr'];
	if (isset($option_arr['o_theme']) && $option_arr['o_theme'] === 'theme11')
	{
		$theme11_color_groups = array(
			0 => array(
				'o_theme11_header' => '#12304d',
				'o_theme11_page'   => '#f2f4f7',
				'o_theme11_card'   => '#ffffff'
			),
			1 => array(
				'o_theme11_text_heading' => '#0f2a43',
				'o_theme11_text_body'    => '#5a6a7a',
				'o_theme11_text_accent'  => '#a06a10'
			),
			2 => array(
				'o_theme11_button'       => '#1b4a73',
				'o_theme11_button_hover' => '#12365a'
			),
			3 => array(
				'o_theme11_list_active'   => '#d9a441',
				'o_theme11_list_inactive' => '#dbe3ec'
			)
		);
		/* English fallbacks, used only until the Theme 11 SQL has been run. Every label comes from the script's own
		   translatable fields (keys t11_*), so it can be edited / translated from the admin label editor. */
		$theme11_text = array(
				't11_legend' => 'Theme 11 colours',
				't11_quick_palettes' => 'Quick palettes',
				't11_tab_general' => 'General',
				't11_tab_fonts' => 'Fonts',
				't11_tab_buttons' => 'Buttons',
				't11_tab_list' => 'Highlights',
				't11_lbl_header' => 'Top bar / header colour',
				't11_lbl_page' => 'Page background',
				't11_lbl_card' => 'Card background',
				't11_lbl_text_heading' => 'Heading text colour',
				't11_lbl_text_body' => 'Body text colour',
				't11_lbl_text_accent' => 'Accent text colour (prices, links)',
				't11_lbl_button' => 'Button colour',
				't11_lbl_button_hover' => 'Button hover colour',
				't11_lbl_list_active' => 'Highlight colour',
				't11_lbl_list_inactive' => 'Soft / inactive colour',
				't11_hint_header' => 'Navigation bar, search button, icons',
				't11_hint_page' => 'Behind the whole listing widget',
				't11_hint_card' => 'Property cards, search box, panels',
				't11_hint_text_heading' => 'Titles and property names',
				't11_hint_text_body' => 'Descriptions, addresses and labels',
				't11_hint_text_accent' => 'Links and highlighted text',
				't11_hint_button' => 'Main buttons (white text)',
				't11_hint_button_hover' => 'When the mouse is over a button',
				't11_hint_list_active' => 'Active tab underline, brand badge, selected items',
				't11_hint_list_inactive' => 'Input borders, image placeholders, soft backgrounds',
				't11_click_to_change' => 'click to change',
				't11_btn_save' => 'Save colours',
				't11_btn_reset' => 'Reset to default',
				't11_note' => 'Picking a quick palette or changing a colour only previews it here. Press “Save colours” to apply it to the listing pages. The readability badge shows text contrast (4.5 or higher is good).',
				't11_live_preview' => 'Live preview',
				't11_live_preview_badge' => 'updates as you edit',
				't11_read_good' => 'Good',
				't11_read_low' => 'Low',
				't11_read_poor' => 'Poor',
				't11_read_title' => 'Readability (WCAG): 4.5 or higher is good',
				't11_sample_1' => 'Modern Family Villa',
				't11_sample_2' => 'Sunny City Apartment',
				't11_pal_navy' => 'Harbor Navy (default)',
				't11_pal_emerald' => 'Emerald Estate',
				't11_pal_graphite' => 'Graphite Night',
				't11_pal_plum' => 'Plum & Rose Gold',
				't11_pal_teal' => 'Ocean Teal',
				't11_pal_terracotta' => 'Terracotta Brick',
				't11_pal_indigo' => 'Royal Indigo',
				't11_pal_slate' => 'Slate & Amber',
		);
		$t11 = function ($key) use ($theme11_text) {
			$v = __($key, true);
			return ($v !== null && $v !== false && $v !== '' && $v !== $key) ? $v : (isset($theme11_text[$key]) ? $theme11_text[$key] : $key);
		};
		$t11w = function ($key, $fallback) {
			$v = __($key, true);
			return (is_string($v) && $v !== '' && $v !== $key) ? $v : $fallback;
		};
		$t11_types = __('front_types', true);
		$t11_type_sale = is_array($t11_types) && isset($t11_types['sale']) ? $t11_types['sale'] : 'For Sale';
		$t11_type_rent = is_array($t11_types) && isset($t11_types['rent']) ? $t11_types['rent'] : 'For Rent';
		$t11_pal_keys = array('t11_pal_navy','t11_pal_emerald','t11_pal_graphite','t11_pal_plum','t11_pal_teal','t11_pal_terracotta','t11_pal_indigo','t11_pal_slate');
		$t11_pal_vals = array(
				array('#12304d', '#f2f4f7', '#ffffff', '#0f2a43', '#5a6a7a', '#a06a10', '#1b4a73', '#12365a', '#d9a441', '#dbe3ec'),
				array('#0f4a3a', '#f1f4ef', '#ffffff', '#12302a', '#54675f', '#946212', '#1e6b54', '#165643', '#e2b560', '#dde8e1'),
				array('#0b0f14', '#11161c', '#1a212a', '#f1f4f8', '#a6b1bd', '#f0b429', '#3b82c4', '#2f6aa3', '#f0b429', '#2a3440'),
				array('#3a1f4d', '#f6f1f6', '#ffffff', '#2d1740', '#6a5a75', '#a45a3c', '#6b3a8a', '#552d73', '#e0a98c', '#e8dcec'),
				array('#0b4f5c', '#eff5f5', '#ffffff', '#0c3640', '#53707a', '#a8661a', '#0e6b7c', '#0a5664', '#e6c27a', '#d5e6e8'),
				array('#7a2e1d', '#f7f1ea', '#fffdf9', '#3b1a12', '#7a5f52', '#a8431f', '#9c3a22', '#812e19', '#e2a65b', '#ecdccc'),
				array('#23267a', '#f0f1fa', '#ffffff', '#1a1c4f', '#5b5f8c', '#3d46b8', '#2f36b0', '#232a8c', '#c6e24a', '#dcdef3'),
				array('#2f3a45', '#f3f3f1', '#ffffff', '#222b33', '#64707a', '#b45309', '#b45309', '#92400e', '#f2b13b', '#e2e4e6'),
		);
		$t11_palettes = array();
		foreach ($t11_pal_keys as $t11_n => $t11_k) { $t11_palettes[] = array($t11($t11_k), $t11_pal_vals[$t11_n]); }
		$t11_js_text = array('good' => $t11('t11_read_good'), 'low' => $t11('t11_read_low'), 'poor' => $t11('t11_read_poor'), 'title' => $t11('t11_read_title'));
		$t11_tab_keys = array('t11_tab_general','t11_tab_fonts','t11_tab_buttons','t11_tab_list');
		?>
		<fieldset class="fieldset white" id="pjT11Panel">
			<legend><?php echo pjSanitize::html($t11('t11_legend')); ?></legend>
			<style>
			#pjT11Panel .t11-grid{display:flex;gap:20px;align-items:flex-start;flex-wrap:wrap;padding:14px 4px 6px}
				#pjT11Panel .t11-main{flex:1 1 360px;min-width:0}
				#pjT11Panel .t11-side{flex:0 0 290px;max-width:100%;position:sticky;top:12px}
				#pjT11Panel .t11-lab{font-size:11.5px;text-transform:uppercase;letter-spacing:.06em;color:#7a8088;font-weight:bold;margin:0 0 8px}
				#pjT11Panel .t11-pres{display:grid;grid-template-columns:repeat(auto-fill,minmax(104px,1fr));gap:9px;margin-bottom:20px}
				#pjT11Panel .t11-pt{border:2px solid #e2e5e7;border-radius:11px;padding:7px;background:#fff;cursor:pointer;text-align:left;font:inherit;display:block;width:100%}
				#pjT11Panel .t11-pt:hover{border-color:#b9c4cc}
				#pjT11Panel .t11-pt.on{border-color:#17375e;box-shadow:0 0 0 3px rgba(23,55,94,.12)}
				#pjT11Panel .t11-strip{display:flex;height:30px;border-radius:7px;overflow:hidden;border:1px solid rgba(0,0,0,.08)}
				#pjT11Panel .t11-strip i{flex:1;display:block}
				#pjT11Panel .t11-pt b{display:block;font-size:12px;margin-top:6px;color:#2b3036}
				#pjT11Panel .t11-tabs{display:flex;gap:4px;border-bottom:2px solid #e3e6e8;margin:0 0 14px}
				#pjT11Panel .t11-tabs button{border:0;background:none;padding:9px 14px;font:bold 13px Arial,sans-serif;color:#7a8088;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px}
				#pjT11Panel .t11-tabs button.on{color:#17375e;border-color:#17375e}
				#pjT11Panel .t11-tiles{display:none;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px}
				#pjT11Panel .t11-tiles.on{display:grid}
				#pjT11Panel .t11-tile{border:1px solid #e3e6e8;border-radius:12px;padding:10px;background:#fff}
				#pjT11Panel .t11-big{display:block;height:64px;border-radius:9px;border:1px solid rgba(0,0,0,.12);position:relative;cursor:pointer;margin-bottom:9px;overflow:hidden}
				#pjT11Panel .t11-big input{position:absolute;left:-10px;top:-10px;width:calc(100% + 20px);height:calc(100% + 20px);opacity:0;cursor:pointer;margin:0;padding:0;border:0}
				#pjT11Panel .t11-big span{position:absolute;right:6px;bottom:5px;background:rgba(255,255,255,.9);border-radius:5px;font-size:10px;font-weight:bold;padding:1px 6px;color:#333;pointer-events:none}
				#pjT11Panel .t11-tn{font-size:12.5px;font-weight:bold;margin-bottom:5px;line-height:1.3;color:#2b3036}
				#pjT11Panel .t11-row2{display:flex;gap:6px;align-items:center;flex-wrap:wrap}
				#pjT11Panel .t11-hex{flex:1 1 84px;min-width:0;width:auto !important;padding:7px 9px;border:1px solid #cfd4d8;border-radius:7px;font-family:Menlo,Consolas,monospace;font-size:13px;box-sizing:border-box;height:auto;line-height:1.3}
				#pjT11Panel .t11-hex.err{border-color:#d33;background:#fff5f5}
				#pjT11Panel .t11-bd{font-size:10.5px;font-weight:bold;border-radius:999px;padding:2px 8px;white-space:nowrap}
				#pjT11Panel .t11-bd.ok{background:#dff3e5;color:#1d6b38}
				#pjT11Panel .t11-bd.warn{background:#fff1d6;color:#8a5a00}
				#pjT11Panel .t11-bd.bad{background:#fde0de;color:#a3261d}
				#pjT11Panel .t11-hint{font-size:11.5px;color:#7a8088;margin-top:5px;line-height:1.4}
				#pjT11Panel .t11-actions{display:flex;gap:10px;align-items:center;margin-top:16px;flex-wrap:wrap}
				#pjT11Panel .t11-reset{background:#fff;color:#444;border:1px solid #c9cdd0;border-radius:4px;padding:6px 14px;font-size:13px;cursor:pointer}
				#pjT11Panel .t11-note{font-size:12px;color:#7a8088;margin-top:8px}
				#pjT11Panel .t11-lp{font-size:11px;color:#7a8088;margin:0 0 6px;display:flex;justify-content:space-between;align-items:center}
				#pjT11Panel .t11-lp span{background:#e8f4ea;color:#1d6b38;border-radius:999px;padding:1px 8px;font-weight:bold}
				/* live preview widget (mirrors the front-end Theme 11 look) */
				#pjT11Panel .t11w{--header:#12304d;--page:#f2f4f7;--card:#ffffff;--th:#0f2a43;--tb:#5a6a7a;--ta:#a06a10;--btn:#1b4a73;--btnh:#12365a;--la:#d9a441;--li:#dbe3ec;background:var(--page);border-radius:16px;padding:12px;color:var(--tb);font-family:Arial,Helvetica,sans-serif;overflow:hidden}
				#pjT11Panel .t11w *{box-sizing:border-box}
				#pjT11Panel .t11w svg.i{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;display:block;flex:0 0 auto}
				#pjT11Panel .t11w .nv{display:flex;align-items:center;gap:8px;background:var(--header);border-radius:12px;padding:6px 8px;margin-bottom:10px}
				#pjT11Panel .t11w .br{width:28px;height:28px;border-radius:8px;background:var(--la);color:var(--header);display:flex;align-items:center;justify-content:center}
				#pjT11Panel .t11w .tb{font-size:11.5px;font-weight:bold;color:rgba(255,255,255,.72);padding:7px 9px}
				#pjT11Panel .t11w .tb.on{color:#fff;box-shadow:inset 0 -3px 0 var(--la)}
				#pjT11Panel .t11w .lg{margin-left:auto;font-size:11px;font-weight:bold;color:#fff;background:rgba(255,255,255,.14);border-radius:8px;padding:6px 10px}
				#pjT11Panel .t11w .sr{display:flex;gap:6px;background:var(--card);border-radius:12px;padding:8px;margin-bottom:10px;box-shadow:0 1px 6px rgba(0,0,0,.08)}
				#pjT11Panel .t11w .sr .f{flex:1;border:1.5px solid var(--li);border-radius:9px;padding:7px 9px;font-size:11px;color:var(--tb);min-width:0;white-space:nowrap;overflow:hidden}
				#pjT11Panel .t11w .sr .go{background:var(--header);color:#fff;border-radius:9px;padding:7px 11px;font-size:11px;font-weight:bold}
				#pjT11Panel .t11w .pc{background:var(--card);border-radius:13px;overflow:hidden;margin-bottom:9px;box-shadow:0 1px 6px rgba(0,0,0,.08)}
				#pjT11Panel .t11w .im{position:relative;height:92px;background:var(--li)}
				#pjT11Panel .t11w .im:before{content:"";position:absolute;left:14%;right:14%;bottom:0;height:58%;background:var(--header);opacity:.55;border-radius:6px 6px 0 0}
				#pjT11Panel .t11w .im:after{content:"";position:absolute;left:0;right:0;bottom:0;height:60%;background:linear-gradient(to top,rgba(8,18,30,.72),rgba(8,18,30,0))}
				#pjT11Panel .t11w .tg{position:absolute;left:8px;top:8px;z-index:2;background:var(--card);color:var(--th);font-size:9px;font-weight:bold;letter-spacing:.06em;text-transform:uppercase;border-radius:6px;padding:3px 7px}
				#pjT11Panel .t11w .pr{position:absolute;left:10px;bottom:7px;z-index:2;color:#fff;font-size:16px;font-weight:bold}
				#pjT11Panel .t11w .bd2{padding:9px 11px}
				#pjT11Panel .t11w .tt{font-weight:bold;font-size:12.5px;color:var(--th)}
				#pjT11Panel .t11w .ft{display:flex;gap:12px;font-size:11px;margin:5px 0 6px}
				#pjT11Panel .t11w .ft span{display:flex;align-items:center;gap:4px}
				#pjT11Panel .t11w .ft svg.i{width:14px;height:14px;color:var(--header)}
				#pjT11Panel .t11w .ft b{color:var(--th)}
				#pjT11Panel .t11w .ln{font-size:11px;font-weight:bold;color:var(--ta)}
				#pjT11Panel .t11w .cb{background:var(--btn);color:#fff;border-radius:9px;padding:8px 12px;font-size:11px;font-weight:bold;text-align:center;margin-top:2px}
				#pjT11Panel .t11w .cb:hover{background:var(--btnh)}
				</style>
			<form id="frmTheme11Colors" action="?controller=pjAdminOptions&amp;action=pjActionUpdate" method="post" class="pj-form form">
				<input type="hidden" name="options_update" value="1" />
				<input type="hidden" name="next_action" value="pjActionPreview" />
				<div class="t11-grid">
					<div class="t11-main">
						<p class="t11-lab"><?php echo pjSanitize::html($t11('t11_quick_palettes')); ?></p>
						<div class="t11-pres" id="t11Pres"></div>
						<div class="t11-tabs" id="t11Tabs">
							<?php foreach ($t11_tab_keys as $t11_i => $t11_tk) { ?>
								<button type="button" data-t="<?php echo $t11_i; ?>" class="<?php echo $t11_i === 0 ? 'on' : ''; ?>"><?php echo pjSanitize::html($t11($t11_tk)); ?></button>
							<?php } ?>
						</div>
						<?php foreach ($theme11_color_groups as $t11_i => $group_colors) { ?>
							<div class="t11-tiles<?php echo $t11_i === 0 ? ' on' : ''; ?>" data-g="<?php echo $t11_i; ?>">
								<?php foreach ($group_colors as $key => $default) {
									$value = isset($option_arr[$key]) && preg_match('/^#[0-9a-fA-F]{6}$/', $option_arr[$key]) ? $option_arr[$key] : $default;
									$t11_suffix = substr($key, strlen('o_theme11_'));
									?>
									<div class="t11-tile">
										<div class="t11-big" style="background:<?php echo $value; ?>">
											<input type="color" class="t11-pick" data-key="<?php echo $key; ?>" value="<?php echo $value; ?>" />
											<span><?php echo pjSanitize::html($t11('t11_click_to_change')); ?></span>
										</div>
										<div class="t11-tn"><?php echo pjSanitize::html($t11('t11_lbl_' . $t11_suffix)); ?></div>
										<div class="t11-row2">
											<input type="text" id="<?php echo $key; ?>_text" name="value-string-<?php echo $key; ?>" value="<?php echo $value; ?>" maxlength="7" class="pj-form-field t11-hex" data-key="<?php echo $key; ?>" data-default="<?php echo $default; ?>" spellcheck="false" />
											<span class="t11-bd" data-badge="<?php echo $key; ?>"></span>
										</div>
										<div class="t11-hint"><?php echo pjSanitize::html($t11('t11_hint_' . $t11_suffix)); ?></div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="t11-actions">
							<input type="submit" value="<?php echo pjSanitize::html($t11('t11_btn_save')); ?>" class="pj-button" />
							<button type="button" class="t11-reset" id="t11Reset"><?php echo pjSanitize::html($t11('t11_btn_reset')); ?></button>
						</div>
						<div class="t11-note"><?php echo pjSanitize::html($t11('t11_note')); ?></div>
					</div>

					<div class="t11-side">
						<div class="t11-lp"><?php echo pjSanitize::html($t11('t11_live_preview')); ?> <span><?php echo pjSanitize::html($t11('t11_live_preview_badge')); ?></span></div>
						<div class="t11w" id="t11Widget">
							<div class="nv"><div class="br"><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/></svg></div><span class="tb on"><?php echo pjSanitize::html($t11w('front_layout1_all', 'All')); ?></span><span class="tb"><?php echo pjSanitize::html($t11w('front_layout1_map', 'Map')); ?></span><span class="lg"><?php echo pjSanitize::html($t11w('menu_login', 'Login')); ?></span></div>
							<div class="sr"><span class="f"><?php echo pjSanitize::html($t11w('front_layout1_keyword', 'Keyword')); ?></span><span class="go"><?php echo pjSanitize::html($t11w('front_layout1_button_search', 'Search')); ?></span></div>
							<div class="pc"><div class="im"><span class="tg"><?php echo pjSanitize::html($t11_type_sale); ?></span><span class="pr">$450,000</span></div><div class="bd2"><div class="tt"><?php echo pjSanitize::html($t11('t11_sample_1')); ?></div><div class="ft"><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 18v-8a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8"/><path d="M3 15h18"/><path d="M7 8V6h4v2"/></svg><b>4</b></span><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"/><path d="M6 12V6a2 2 0 0 1 4 0"/></svg><b>3</b></span><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h6V3"/></svg><b>210 m²</b></span></div><div class="ln"><?php echo pjSanitize::html($t11w('front_layout1_full_details', 'Full details')); ?> &rarr;</div></div></div>
							<div class="pc"><div class="im"><span class="tg"><?php echo pjSanitize::html($t11_type_rent); ?></span><span class="pr">$1,800</span></div><div class="bd2"><div class="tt"><?php echo pjSanitize::html($t11('t11_sample_2')); ?></div><div class="ft"><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 18v-8a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8"/><path d="M3 15h18"/><path d="M7 8V6h4v2"/></svg><b>2</b></span><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"/><path d="M6 12V6a2 2 0 0 1 4 0"/></svg><b>1</b></span><span><svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h6V3"/></svg><b>78 m²</b></span></div><div class="cb"><?php echo pjSanitize::html($t11w('front_layout1_button_search', 'Search')); ?></div></div></div>
						</div>
					</div>

				</div>
			</form>
			<script type="text/javascript">
			(function () {
				var root = document.getElementById('pjT11Panel');
				if (!root) { return; }
				var PALS = <?php echo json_encode($t11_palettes); ?>;
				var TXT = <?php echo json_encode($t11_js_text); ?>;
				var KEYS = ['o_theme11_header','o_theme11_page','o_theme11_card','o_theme11_text_heading','o_theme11_text_body','o_theme11_text_accent','o_theme11_button','o_theme11_button_hover','o_theme11_list_active','o_theme11_list_inactive'];
				var VARS = ['--header','--page','--card','--th','--tb','--ta','--btn','--btnh','--la','--li'];
				/* [foreground index (-1 = white), background index] */
				var PAIRS = {0:[-1,0], 3:[3,1], 4:[4,2], 5:[5,2], 6:[-1,6], 8:[8,0]};
				var widget = document.getElementById('t11Widget');
				var pres = document.getElementById('t11Pres');
				function $all(sel) { return Array.prototype.slice.call(root.querySelectorAll(sel)); }
				function hexInput(i) { return root.querySelector('.t11-hex[data-key="' + KEYS[i] + '"]'); }
				function pickInput(i) { return root.querySelector('.t11-pick[data-key="' + KEYS[i] + '"]'); }
				function norm(v) {
					v = (v || '').replace(/^\s+|\s+$/g, '').toLowerCase();
					if (v.charAt(0) !== '#') { v = '#' + v; }
					if (/^#[0-9a-f]{3}$/.test(v)) { v = '#' + v.charAt(1) + v.charAt(1) + v.charAt(2) + v.charAt(2) + v.charAt(3) + v.charAt(3); }
					return /^#[0-9a-f]{6}$/.test(v) ? v : null;
				}
				function current() { return KEYS.map(function (k, i) { var h = norm(hexInput(i).value); return h || '#000000'; }); }
				function lum(h) {
					var c = [1, 3, 5].map(function (n) { var v = parseInt(h.substr(n, 2), 16) / 255; return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4); });
					return 0.2126 * c[0] + 0.7152 * c[1] + 0.0722 * c[2];
				}
				function ratio(a, b) { var x = lum(a), y = lum(b); return (Math.max(x, y) + 0.05) / (Math.min(x, y) + 0.05); }
				function refresh() {
					var S = current();
					VARS.forEach(function (v, i) { widget.style.setProperty(v, S[i]); });
					$all('.t11-big').forEach(function (b) { var p = b.querySelector('.t11-pick'); var i = KEYS.indexOf(p.getAttribute('data-key')); b.style.background = S[i]; });
					Object.keys(PAIRS).forEach(function (i) {
						var p = PAIRS[i], fg = p[0] < 0 ? '#ffffff' : S[p[0]], r = ratio(fg, S[p[1]]);
						var cls = r >= 4.5 ? 'ok' : (r >= 3 ? 'warn' : 'bad'), lbl = r >= 4.5 ? TXT.good : (r >= 3 ? TXT.low : TXT.poor);
						var el = root.querySelector('[data-badge="' + KEYS[i] + '"]');
						if (el) { el.className = 't11-bd ' + cls; el.textContent = r.toFixed(1) + ' · ' + lbl; el.title = TXT.title; }
					});
					var key = S.join(',');
					$all('.t11-pt').forEach(function (b, n) { b.className = 't11-pt' + (PALS[n][1].join(',') === key ? ' on' : ''); });
				}
				function setAll(arr) {
					arr.forEach(function (h, i) { hexInput(i).value = h; hexInput(i).className = hexInput(i).className.replace(' err', ''); pickInput(i).value = h; });
					refresh();
				}
				/* quick palettes */
				pres.innerHTML = PALS.map(function (p, n) {
					return '<button type="button" class="t11-pt" data-p="' + n + '"><span class="t11-strip">' + [0, 1, 2, 3, 6].map(function (k) { return '<i style="background:' + p[1][k] + '"></i>'; }).join('') + '</span><b>' + p[0] + '</b></button>';
				}).join('');
				$all('.t11-pt').forEach(function (b) { b.onclick = function () { setAll(PALS[+b.getAttribute('data-p')][1]); }; });
				/* tabs */
				$all('#t11Tabs button').forEach(function (b) {
					b.onclick = function () {
						var t = b.getAttribute('data-t');
						$all('#t11Tabs button').forEach(function (x) { x.className = x === b ? 'on' : ''; });
						$all('.t11-tiles').forEach(function (g) { g.className = 't11-tiles' + (g.getAttribute('data-g') === t ? ' on' : ''); });
					};
				});
				/* colour pickers + hex fields */
				$all('.t11-pick').forEach(function (p) {
					p.oninput = function () { var i = KEYS.indexOf(p.getAttribute('data-key')); hexInput(i).value = p.value; hexInput(i).className = hexInput(i).className.replace(' err', ''); refresh(); };
				});
				$all('.t11-hex').forEach(function (h) {
					h.oninput = function () {
						var v = norm(h.value), i = KEYS.indexOf(h.getAttribute('data-key'));
						if (v) { h.className = h.className.replace(' err', ''); pickInput(i).value = v; refresh(); } else if (h.className.indexOf(' err') < 0) { h.className += ' err'; }
					};
					h.onblur = function () { var v = norm(h.value); if (v) { h.value = v; } };
				});
				document.getElementById('t11Reset').onclick = function () {
					setAll(KEYS.map(function (k, i) { return hexInput(i).getAttribute('data-default'); }));
				};
				/* never post an invalid colour */
				document.getElementById('frmTheme11Colors').onsubmit = function () {
					var bad = null;
					$all('.t11-hex').forEach(function (h) { var v = norm(h.value); if (v) { h.value = v; } else if (!bad) { bad = h; } });
					if (bad) { bad.className += bad.className.indexOf(' err') < 0 ? ' err' : ''; bad.focus(); return false; }
					return true;
				};
				refresh();
			})();
			</script>
		</fieldset>
		<?php
	}
	?>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.field_required = "<?php __('pj_field_required'); ?>";
	myLabel.digits_only = "<?php __('pj_digits_only'); ?>";
	myLabel.positive_number = "<?php __('pj_positive_number'); ?>";
	</script>
	<?php
}
?>