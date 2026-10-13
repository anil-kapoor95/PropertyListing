<?php
/**
 * Theme 11 - print view (opened by the "Print" button on the property page).
 * Clean, printer-friendly page that follows the Theme 11 look and colours.
 * The toolbar is shown on screen only (so the page is still usable after the print dialog is cancelled).
 */
mt_srand();
$index = mt_rand(1, 9999);
include_once dirname(__FILE__) . '/elements/icons.php';
?>
<div id="pjWrapperPropertyListing_<?php echo $index;?>" class="t11-wrap t11-printpage">
	<div class="t11-pr-bar">
		<div class="t11-pr-brand"><span class="t11-brand"><?php echo t11_icon('home', 't11-i t11-i-brand'); ?></span></div>
		<div class="t11-pr-actions">
			<button type="button" class="t11-pr-btn t11-pr-btn-main" onclick="window.print();"><?php echo t11_icon('print'); ?><span><?php __('front_print');?></span></button>
			<button type="button" class="t11-pr-btn" onclick="if (window.opener || window.history.length < 2) { window.close(); } else { window.history.back(); }"><span><?php __('front_layout1_close');?></span></button>
		</div>
	</div>
	<div class="t11-pr-page">
		<?php
		if ($tpl['status'] == '200')
		{
			$a = $tpl['arr'];
			$listing_title = pjSanitize::html(stripslashes($a['title']));
			$special_items = __('front_layout1_special_items', true);
			$per_arr = __('price_per', true);
			$types = __('front_types', true);
			$floor_metrics = __('floor_metrics', true);
			$metric_key = preg_replace('/\s+/', '', $tpl['option_arr']['o_floor_metric']);
			$metric = isset($floor_metrics[$metric_key]) ? $floor_metrics[$metric_key] : '';
			$address_arr = array();
			foreach (array('address_1', 'address_city', 'address_state', 'address_zip', 'country_title') as $f)
			{
				if (!empty($a[$f])) { $address_arr[] = pjSanitize::html($a[$f]); }
			}
			?>
			<header class="t11-pr-head">
				<div class="t11-pr-head-main">
					<div class="t11-tags">
						<span class="t11-tag t11-tag-for t11-for-<?php echo $a['for']; ?>"><?php echo $types[$a['for']];?></span>
						<?php if ($a['special'] != 'none') { ?><span class="t11-tag t11-tag-sp t11-sp-<?php echo $a['special']; ?>"><?php echo $special_items[$a['special']];?></span><?php } ?>
						<?php if (!empty($a['type'])) { ?><span class="t11-tag t11-tag-type"><?php echo pjSanitize::html($a['type']);?></span><?php } ?>
					</div>
					<h1><?php echo $listing_title;?></h1>
					<?php if (!empty($address_arr)) { ?><p class="t11-addr"><?php echo t11_icon('pin'); ?><span><?php echo join(', ', $address_arr);?></span></p><?php } ?>
				</div>
				<?php if ($a['price'] != '') { ?>
				<div class="t11-pr-head-side">
					<div class="t11-bigprice"><?php echo is_numeric($a['price']) ? pjUtil::formatPrice($a['price'], $tpl['option_arr']['o_price_format'], $tpl['option_arr']['o_currency']) : pjSanitize::html($a['price']); ?><?php if ($a['for'] == 'rent' && !empty($a['price_per'])) { ?><small><?php echo $per_arr[$a['price_per']];?></small><?php } ?></div>
					<div class="t11-pr-ref"><?php __('front_layout1_reference_id');?>: <b><?php echo pjSanitize::html($a['ref_id']);?></b></div>
				</div>
				<?php } ?>
			</header>

			<?php
			$gal = $tpl['gallery_arr'];
			if (count($gal) == 0)
			{
				// no photos: show the default image
				$gal = array(array('large_path' => '', 'medium_path' => '', 'alt' => ''));
			}
			if (count($gal) > 0)
			{
				$img_url = function ($g, $key) {
					$url = PJ_INSTALL_URL . PJ_TEMPLATE_PATH . PJ_TEMPLATE_SCRIPT_PATH . 'images/t11_no_photo.svg';
					if (!empty($g[$key]) && is_file(PJ_INSTALL_PATH . $g[$key])) { $url = PJ_INSTALL_URL . $g[$key]; }
					return $url;
				};
				?>
				<div class="t11-pr-gallery<?php echo count($gal) > 1 ? ' t11-pr-gallery-multi' : ''; ?>">
					<div class="t11-pr-main-img"><img src="<?php echo $img_url($gal[0], 'large_path'); ?>" alt="<?php echo pjSanitize::clean($gal[0]['alt']);?>"></div>
					<?php
					if (count($gal) > 1)
					{
						?>
						<div class="t11-pr-thumbs">
							<?php for ($k = 1; $k < count($gal) && $k <= 3; $k++) { ?>
								<div><img src="<?php echo $img_url($gal[$k], 'medium_path'); ?>" alt="<?php echo pjSanitize::clean($gal[$k]['alt']);?>"></div>
							<?php } ?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>

			<section class="t11-pr-facts">
				<?php if ($a['bedrooms'] != 'na' && $a['bedrooms'] !== '' && $a['bedrooms'] !== null) { ?><div class="t11-tile"><?php echo t11_icon('bed'); ?><b><?php echo $a['bedrooms'];?></b><span><?php $a['bedrooms'] != 1 ? __('front_layout1_bedrooms') : __('front_layout1_bedroom');?></span></div><?php } ?>
				<?php if ($a['bathrooms'] != 'na' && $a['bathrooms'] !== '' && $a['bathrooms'] !== null) { ?><div class="t11-tile"><?php echo t11_icon('bath'); ?><b><?php echo $a['bathrooms'];?></b><span><?php $a['bathrooms'] != 1 ? __('front_layout1_bathrooms') : __('front_layout1_bathroom');?></span></div><?php } ?>
				<?php if (!empty($a['floor_area'])) { ?><div class="t11-tile"><?php echo t11_icon('area'); ?><b><?php echo (float) $a['floor_area'] == (int) $a['floor_area'] ? (int) $a['floor_area'] : $a['floor_area'];?></b><span><?php echo $metric; ?> &middot; <?php __('front_layout1_floor_area');?></span></div><?php } ?>
				<?php if (!empty($a['year_built'])) { ?><div class="t11-tile"><?php echo t11_icon('cal'); ?><b><?php echo pjSanitize::html($a['year_built']);?></b><span><?php __('front_layout1_year_built');?></span></div><?php } ?>
			</section>

			<section class="t11-pr-block">
				<h2 class="t11-h"><?php __('front_layout1_description');?></h2>
				<div class="t11-pr-desc"><?php echo stripslashes($a['description']);?></div>
			</section>

			<?php
			foreach (__('feature_categories', true) as $k => $category)
			{
				if (!isset($tpl['feature_arr'][$k]) || empty($tpl['feature_arr'][$k])) { continue; }
				?>
				<section class="t11-pr-block">
					<h2 class="t11-h"><?php echo $category;?></h2>
					<ul class="t11-feats">
						<?php foreach ($tpl['feature_arr'][$k] as $fv) { ?><li><?php echo t11_icon('check'); ?><span><?php echo $fv;?></span></li><?php } ?>
					</ul>
				</section>
				<?php
			}
			?>

			<div class="t11-pr-two">
				<section class="t11-pr-block">
					<h2 class="t11-h"><?php __('front_layout1_address');?></h2>
					<dl class="t11-dl">
						<div><dt><?php __('front_layout1_type');?></dt><dd><?php echo pjSanitize::html($a['type']);?></dd></div>
						<?php if (!empty($a['lot'])) { ?><div><dt><?php __('front_layout1_lot_dimensions');?></dt><dd><?php echo pjSanitize::html($a['lot']);?> <?php echo $metric;?></dd></div><?php } ?>
						<?php if (!empty($a['country_title'])) { ?><div><dt><?php __('front_layout1_country');?></dt><dd><?php echo pjSanitize::html($a['country_title']);?></dd></div><?php } ?>
						<?php if (!empty($a['address_state'])) { ?><div><dt><?php __('front_layout1_state');?></dt><dd><?php echo pjSanitize::html($a['address_state']);?></dd></div><?php } ?>
						<?php if (!empty($a['address_city'])) { ?><div><dt><?php __('front_layout1_city');?></dt><dd><?php echo pjSanitize::html($a['address_city']);?></dd></div><?php } ?>
						<?php if (!empty($a['address_1'])) { ?><div><dt><?php __('front_layout1_address_1');?></dt><dd><?php echo pjSanitize::html($a['address_1']);?></dd></div><?php } ?>
						<?php if (!empty($a['address_2'])) { ?><div><dt><?php __('front_layout1_address_2');?></dt><dd><?php echo pjSanitize::html($a['address_2']);?></dd></div><?php } ?>
						<?php if (!empty($a['address_zip'])) { ?><div><dt><?php __('front_layout1_zip');?></dt><dd><?php echo pjSanitize::html($a['address_zip']);?></dd></div><?php } ?>
					</dl>
				</section>
				<?php
				$owner_name = !empty($a['owner_name']) ? $a['owner_name'] : (!empty($a['name']) ? $a['name'] : null);
				$owner_email = !empty($a['owner_email']) ? $a['owner_email'] : (!empty($a['email']) ? $a['email'] : null);
				$owner_phone = !empty($a['owner_phone']) ? $a['owner_phone'] : (!empty($a['phone']) ? $a['phone'] : null);
				$owner_fax = !empty($a['owner_fax']) ? $a['owner_fax'] : (!empty($a['fax']) ? $a['fax'] : null);
				if ($owner_name || $owner_email || $owner_phone || $owner_fax)
				{
					?>
					<section class="t11-pr-block">
						<h2 class="t11-h"><?php __('front_layout1_contact_details');?></h2>
						<dl class="t11-dl">
							<?php if ($owner_name) { ?><div><dt><?php __('front_layout1_name');?></dt><dd><?php echo pjSanitize::html($owner_name);?></dd></div><?php } ?>
							<?php if ($owner_email) { ?><div><dt><?php __('front_layout1_email');?></dt><dd><?php echo pjSanitize::html($owner_email);?></dd></div><?php } ?>
							<?php if ($owner_phone) { ?><div><dt><?php __('front_layout1_phone');?></dt><dd><?php echo pjSanitize::html($owner_phone);?></dd></div><?php } ?>
							<?php if ($owner_fax) { ?><div><dt><?php __('front_layout1_fax');?></dt><dd><?php echo pjSanitize::html($owner_fax);?></dd></div><?php } ?>
						</dl>
					</section>
					<?php
				}
				?>
			</div>
			<?php
		} else {
			$property_statuses = __('property_statuses', true);
			?>
			<section class="t11-pr-block"><?php echo $property_statuses[$tpl['status']];?></section>
			<?php
		}
		?>
	</div>
</div>
<?php include dirname(__FILE__) . '/elements/colors.php'; ?>
<?php if ($tpl['status'] == '200') { ?>
<script type="text/javascript">
window.onload = function () { if (window.print) { window.print(); } };
</script>
<?php } ?>
