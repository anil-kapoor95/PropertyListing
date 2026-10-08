<?php
mt_srand();
$index = mt_rand(1, 9999);
include_once dirname(__FILE__) . '/elements/icons.php';
$special_items = __('front_layout1_special_items', true);
$types = __('front_types', true);
$per_arr = __('price_per', true);
$floor_metrics = __('floor_metrics', true);
$t11_total = isset($tpl['paginator']['total']) ? (int) $tpl['paginator']['total'] : count($tpl['arr']);
?>
<div id="pjWrapperPropertyListing_<?php echo $index;?>" class="t11-wrap">
	<div class="container-fluid pjPplContainer">
		<?php include_once dirname(dirname(__FILE__)) . '/elements/header.php';?>
		<?php include_once dirname(__FILE__) . '/elements/search.php';?>

		<?php
		if (count($tpl['arr']) > 0)
		{
			?>
			<div class="t11-results-bar">
				<strong><?php echo $t11_total; ?></strong> <span><?php echo pjSanitize::html(t11_label('t11_properties_found', 'properties found')); ?></span>
			</div>
			<div class="t11-grid">
			<?php
			foreach ($tpl['arr'] as $v)
			{
				$image = PJ_INSTALL_URL . PJ_IMG_PATH . 'frontend/300x226.png';
				if (!empty($v['medium_image']) && is_file(PJ_INSTALL_PATH . $v['medium_image']))
				{
					$image = PJ_INSTALL_URL . $v['medium_image'];
				}
				$listing_title = pjSanitize::html(stripslashes($v['title']));
				if ($tpl['option_arr']['o_seo_url'] == 'No')
				{
					$url = $_SERVER['SCRIPT_NAME'] . '?controller=pjListings&amp;action=pjActionView&amp;id=' . $v['id'] . (isset($_GET['iframe']) ? '&amp;iframe' : NULL);
				} else {
					$path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
					$path = $path == '/' ? '' : $path;
					$url = $path . '/' . $controller->friendlyURL($listing_title) . "-" . $v['id'] . ".html";
				}
				$address_arr = array();
				foreach (array('address_1', 'address_city', 'address_state', 'address_zip', 'country_title') as $f)
				{
					if (!empty($v[$f])) { $address_arr[] = pjSanitize::html($v[$f]); }
				}
				$metric = isset($floor_metrics[preg_replace('/\s+/', '', $tpl['option_arr']['o_floor_metric'])]) ? $floor_metrics[preg_replace('/\s+/', '', $tpl['option_arr']['o_floor_metric'])] : '';
				?>
				<article class="t11-card pjPplProduct">
					<a href="<?php echo $url;?>" class="t11-media">
						<img src="<?php echo $image;?>" alt="<?php echo $listing_title;?>" class="pjPplProductImage">
						<span class="t11-badges">
							<span class="t11-tag t11-tag-for t11-for-<?php echo $v['for']; ?>"><?php echo $types[$v['for']];?></span>
							<?php if ($v['special'] != 'none') { ?><span class="t11-tag t11-tag-sp t11-sp-<?php echo $v['special']; ?>"><?php echo $special_items[$v['special']];?></span><?php } ?>
						</span>
						<?php if ($v['price'] != '') { ?>
						<span class="t11-price">
							<strong class="pjPplProductPrice"><?php echo is_numeric($v['price']) ? pjUtil::formatPrice($v['price'], $tpl['option_arr']['o_price_format'], $tpl['option_arr']['o_currency']) : pjSanitize::html($v['price']);?></strong>
							<?php if ($v['for'] == 'rent' && !empty($v['price_per'])) { ?><small><?php echo $per_arr[$v['price_per']];?></small><?php } ?>
						</span>
						<?php } ?>
					</a>
					<div class="t11-body">
						<h3 class="t11-title pjPplProductTitle"><a href="<?php echo $url;?>"><?php echo $listing_title;?></a></h3>
						<?php if (!empty($address_arr)) { ?><p class="t11-addr pjPplProductAddress"><?php echo t11_icon('pin'); ?><span><?php echo join(', ', $address_arr);?></span></p><?php } ?>
						<ul class="t11-facts">
							<?php if ($v['bedrooms'] != 'na' && $v['bedrooms'] !== '' && $v['bedrooms'] !== null) { ?><li title="<?php __('front_layout1_beds');?>"><?php echo t11_icon('bed'); ?><b><?php echo $v['bedrooms'];?></b><span><?php __('front_layout1_beds');?></span></li><?php } ?>
							<?php if ($v['bathrooms'] != 'na' && $v['bathrooms'] !== '' && $v['bathrooms'] !== null) { ?><li title="<?php __('front_layout1_baths');?>"><?php echo t11_icon('bath'); ?><b><?php echo $v['bathrooms'];?></b><span><?php __('front_layout1_baths');?></span></li><?php } ?>
							<?php if (!empty($v['floor_area'])) { ?><li title="<?php __('front_layout1_area');?>"><?php echo t11_icon('area'); ?><b><?php echo (float) $v['floor_area'] == (int) $v['floor_area'] ? (int) $v['floor_area'] : $v['floor_area'];?></b><span><?php echo $metric;?></span></li><?php } ?>
						</ul>
						<div class="t11-foot">
							<span class="t11-type pjPplProductType"><?php echo pjSanitize::html($v['type']);?></span>
							<a href="<?php echo $url;?>" class="t11-more-link"><?php __('front_layout1_full_details');?><?php echo t11_icon('arrow'); ?></a>
						</div>
					</div>
				</article>
				<?php
			}
			?>
			</div>
			<?php
			include_once dirname(dirname(__FILE__)) . '/elements/paginator.php';
		} else {
			?><p class="pjPplNoProducts t11-empty"><?php echo t11_icon('search'); ?><span><?php __('front_no_properties_found'); ?></span></p><?php
		}
		?>
	</div>
</div>
<?php include_once dirname(dirname(__FILE__)) . '/elements/loadjs.php';?>
