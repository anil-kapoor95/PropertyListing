<?php
mt_srand();
$index = mt_rand(1, 9999);
include_once dirname(__FILE__) . '/elements/icons.php';
?>
<div id="pjWrapperPropertyListing_<?php echo $index;?>" class="t11-wrap t11-view">
	<div class="container-fluid pjPplContainer">
		<?php include_once dirname(dirname(__FILE__)) . '/elements/header.php';?>
		<?php
		if ($tpl['status'] == '200')
		{
			$back = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?controller=pjListings&amp;action=pjActionProperties' . (isset($_GET['iframe']) ? '&amp;iframe' : NULL);
			$listing_title = pjSanitize::html(stripslashes($tpl['arr']['title']));
			$special_items = __('front_layout1_special_items', true);
			$per_arr = __('price_per', true);
			$types = __('front_types', true);
			$floor_metrics = __('floor_metrics', true);
			$metric = isset($floor_metrics[preg_replace('/\s+/', '', $tpl['option_arr']['o_floor_metric'])]) ? $floor_metrics[preg_replace('/\s+/', '', $tpl['option_arr']['o_floor_metric'])] : '';
			$a = $tpl['arr'];
			$address_arr = array();
			foreach (array('address_1', 'address_city', 'address_state', 'address_zip', 'country_title') as $f)
			{
				if (!empty($a[$f])) { $address_arr[] = pjSanitize::html($a[$f]); }
			}
			?>
			<a class="t11-back" href="<?php echo $back; ?>"><?php echo t11_icon('back'); ?><span><?php echo pjSanitize::html(t11_label('t11_back_to_listings', 'Back to listings')); ?></span></a>

			<header class="t11-head">
				<div class="t11-head-main">
					<div class="t11-tags">
						<span class="t11-tag t11-tag-for t11-for-<?php echo $a['for']; ?>"><?php echo $types[$a['for']];?></span>
						<?php if ($a['special'] != 'none') { ?><span class="t11-tag t11-tag-sp t11-sp-<?php echo $a['special']; ?>"><?php echo $special_items[$a['special']];?></span><?php } ?>
						<?php if (!empty($a['type'])) { ?><span class="t11-tag t11-tag-type"><?php echo pjSanitize::html($a['type']);?></span><?php } ?>
					</div>
					<h1 class="pjPplProductTitle"><?php echo $listing_title;?></h1>
					<?php if (!empty($address_arr)) { ?><p class="t11-addr"><?php echo t11_icon('pin'); ?><span><?php echo join(', ', $address_arr);?></span></p><?php } ?>
				</div>
				<div class="t11-head-side">
					<?php if ($a['price'] != '') { ?>
					<div class="t11-bigprice pjPplProductPrice"><?php echo is_numeric($a['price']) ? pjUtil::formatPrice($a['price'], $tpl['option_arr']['o_price_format'], $tpl['option_arr']['o_currency']) : pjSanitize::html($a['price']); ?><?php if ($a['for'] == 'rent' && !empty($a['price_per'])) { ?><small><?php echo $per_arr[$a['price_per']];?></small><?php } ?></div>
					<?php } ?>
					<a href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjListings&amp;action=pjActionPrint&amp;id=<?php echo $a['id'];?>" class="t11-print" target="_blank"><?php echo t11_icon('print'); ?><span><?php __('front_print');?></span></a>
				</div>
			</header>

			<?php
			$gal = $tpl['gallery_arr'];
			$gcount = count($gal);
			if ($gcount > 0)
			{
				?>
				<div class="t11-gallery t11-g<?php echo $gcount >= 3 ? '3' : $gcount; ?>">
					<?php
					foreach ($gal as $k => $g)
					{
						$large_url = $medium_url = PJ_INSTALL_URL . PJ_IMG_PATH . 'frontend/768x526.png';
						if (is_file(PJ_INSTALL_PATH . $g['large_path'])) { $large_url = PJ_INSTALL_URL . $g['large_path']; }
						if (is_file(PJ_INSTALL_PATH . $g['medium_path'])) { $medium_url = PJ_INSTALL_URL . $g['medium_path']; }
						$cls = $k == 0 ? 't11-g-main' : ($k < 3 ? 't11-g-thumb' : 't11-g-hidden');
						?>
						<a class="plThumbnail <?php echo $cls; ?>" rel="lytebox[allphotos]" href="<?php echo $large_url; ?>" title="<?php echo pjSanitize::clean($g['title']);?>">
							<img src="<?php echo $medium_url; ?>" alt="<?php echo pjSanitize::clean($g['alt']);?>" title="<?php echo pjSanitize::clean($g['title']);?>">
							<?php if ($gcount > 3 && $k == 2) { ?><span class="t11-more-photos"><?php echo t11_icon('img'); ?>+<?php echo $gcount - 3; ?></span><?php } ?>
						</a>
						<?php
					}
					?>
					<span class="t11-count"><?php echo t11_icon('img'); ?><?php echo $gcount; ?> <?php echo pjSanitize::html(t11_label('t11_photos', 'photos')); ?></span>
				</div>
				<?php
			}
			?>

			<div class="t11-layout">
				<div class="t11-main">
					<section class="t11-card-block pjPplProductPanel">
						<h2 class="t11-h"><?php __('front_layout1_description');?></h2>
						<div class="pjPplProductDesc"><?php echo stripslashes($a['description']);?></div>
					</section>
					<?php
					foreach (__('feature_categories', true) as $k => $category)
					{
						if (!isset($tpl['feature_arr'][$k]) || empty($tpl['feature_arr'][$k])) { continue; }
						?>
						<section class="t11-card-block pjPplProductPanel">
							<h2 class="t11-h"><?php echo $category;?></h2>
							<ul class="t11-feats">
								<?php foreach ($tpl['feature_arr'][$k] as $fv) { ?><li><?php echo t11_icon('check'); ?><span><?php echo $fv;?></span></li><?php } ?>
							</ul>
						</section>
						<?php
					}
					if ($a['show_googlemap'] == 'T')
					{
						?>
						<section class="t11-card-block pjPplProductPanel">
							<h2 class="t11-h"><?php __('front_layout1_map');?></h2>
							<div id="ppDetailsMap_<?php echo $index;?>" class="ppMapDetailsContainer" data-lat="<?php echo $a['lat'];?>" data-lng="<?php echo $a['lng'];?>"></div>
						</section>
						<?php
					}
					ob_start();
					include dirname(dirname(__FILE__)) . '/elements/address_' . $controller->getDirection() . '.php';
					$ob_address = ob_get_contents();
					ob_end_clean();
					if (!empty($ob_address))
					{
						?>
						<section class="t11-card-block pjPplProductPanel t11-addr-block">
							<h2 class="t11-h"><?php __('front_layout1_address');?></h2>
							<?php echo $ob_address; ?>
						</section>
						<?php
					}
					?>
				</div>

				<aside class="t11-side">
					<section class="t11-card-block t11-keyfacts">
						<h2 class="t11-h"><?php echo pjSanitize::html(t11_label('t11_key_facts', 'Key facts')); ?></h2>
						<div class="t11-tiles">
							<?php if ($a['bedrooms'] != 'na' && $a['bedrooms'] !== '' && $a['bedrooms'] !== null) { ?><div class="t11-tile"><?php echo t11_icon('bed'); ?><b><?php echo $a['bedrooms'];?></b><span><?php $a['bedrooms'] != 1 ? __('front_layout1_bedrooms') : __('front_layout1_bedroom');?></span></div><?php } ?>
							<?php if ($a['bathrooms'] != 'na' && $a['bathrooms'] !== '' && $a['bathrooms'] !== null) { ?><div class="t11-tile"><?php echo t11_icon('bath'); ?><b><?php echo $a['bathrooms'];?></b><span><?php $a['bathrooms'] != 1 ? __('front_layout1_bathrooms') : __('front_layout1_bathroom');?></span></div><?php } ?>
							<?php if (!empty($a['floor_area'])) { ?><div class="t11-tile"><?php echo t11_icon('area'); ?><b><?php echo (float) $a['floor_area'] == (int) $a['floor_area'] ? (int) $a['floor_area'] : $a['floor_area'];?></b><span><?php echo $metric; ?> &middot; <?php __('front_layout1_floor_area');?></span></div><?php } ?>
							<?php if (!empty($a['year_built'])) { ?><div class="t11-tile"><?php echo t11_icon('cal'); ?><b><?php echo pjSanitize::html($a['year_built']);?></b><span><?php __('front_layout1_year_built');?></span></div><?php } ?>
						</div>
						<dl class="t11-dl">
							<div><dt><?php __('front_layout1_reference_id');?></dt><dd><?php echo pjSanitize::html($a['ref_id']);?></dd></div>
							<div><dt><?php __('front_layout1_type');?></dt><dd><?php echo pjSanitize::html($a['type']);?></dd></div>
							<?php if (!empty($a['lot'])) { ?><div><dt><?php __('front_layout1_lot_dimensions');?></dt><dd><?php echo pjSanitize::html($a['lot']);?> <?php echo $metric;?></dd></div><?php } ?>
							<?php if (!empty($a['floor_plan_filepath'])) { ?><div><dt><?php __('front_layout1_floor_plan');?></dt><dd><a href="<?php echo PJ_INSTALL_URL . 'file.php?id=' . $a['id'] . '&amp;hash=' . $a['floor_plan_hash']; ?>" target="_blank"><?php __('front_layout1_floor_plan');?></a></dd></div><?php } ?>
						</dl>
					</section>
					<?php
					if ($a['owner_show'] == 'T')
					{
						$owner_name = !empty($a['owner_name']) ? $a['owner_name'] : (!empty($a['name']) ? $a['name'] : null);
						$owner_email = !empty($a['owner_email']) ? $a['owner_email'] : (!empty($a['email']) ? $a['email'] : null);
						$owner_phone = !empty($a['owner_phone']) ? $a['owner_phone'] : (!empty($a['phone']) ? $a['phone'] : null);
						if ($owner_name || $owner_email || $owner_phone)
						{
							?>
							<section class="t11-card-block t11-contact">
								<h2 class="t11-h"><?php __('front_layout1_contact_details');?></h2>
								<?php if ($owner_name) { ?><p class="t11-agent"><span class="t11-avatar"><?php echo t11_icon('user'); ?></span><b><?php echo pjSanitize::html($owner_name);?></b></p><?php } ?>
								<?php if ($owner_phone) { ?><p class="t11-line"><?php echo t11_icon('phone'); ?><span><?php echo pjSanitize::html($owner_phone);?></span></p><?php } ?>
								<?php if ($owner_email) { ?><p class="t11-line"><?php echo t11_icon('mail'); ?><span><?php echo !preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i', $owner_email) ? pjSanitize::html($owner_email) : '<a href="mailto:' . pjSanitize::html($owner_email) . '">' . pjSanitize::html($owner_email) . '</a>'; ?></span></p><?php } ?>
								<?php if ($tpl['option_arr']['o_show_contact'] == 'Yes') { ?>
									<a href="#" class="btn btn-default t11-cta" data-pj-toggle="modal" data-pj-target="#frmPLContactDetails"><?php echo t11_icon('mail'); ?><span><?php __('front_request_details');?></span></a>
								<?php } ?>
							</section>
							<?php
						}
					}
					?>
				</aside>
			</div>
			<div class="modal fade" id="frmPLContactDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				    <div class="modal-content">
				      	<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        	<h4 class="modal-title" id="myModalLabel"><?php __('front_request_details');?></h4>
				      	</div>
				      	<div class="modal-body">
				        	<form id="frmPLSendRequest"action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjListings&amp;action=pjActionSend" method="post">
								<input type="hidden" name="send" value="request" />
								<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']?>"/>
								
								
								<div class="form-group">
									<label><?php __('front_layout1_name')?></label>
									<input type="text" name="name" class="form-control required" data-err="<?php __('front_layout1_name_required');?>"/>
								</div>
				
								<div class="form-group">
									<label><?php __('front_layout1_email')?></label>
									<input type="text" name="email" class="form-control required email" data-err="<?php __('front_layout1_email_required');?>" data-email="<?php __('front_layout1_email_invalid');?>"/>
								</div>
								<div class="form-group">
									<label><?php __('front_layout1_phone')?></label>
									<input type="text" name="phone" class="form-control"/>
								</div>
								<div class="form-group">
									<label><?php __('front_layout1_message')?></label>
									<textarea name="message" class="form-control required" cols="30" rows="5" data-err="<?php __('front_layout1_message_required');?>"></textarea>
								</div>
								<div class="form-group">
									<label><?php __('front_layout1_captcha');?></label>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<input type="text" id="pjPlCaptchaField" name="captcha" class="form-control ppCaptchaField required" maxlength="6" autocomplete="off" data-folder="<?php echo PJ_INSTALL_FOLDER;?>" data-err="<?php __('front_layout1_captcha_required');?>" data-captcha="<?php __('front_layout1_captcha_incorrect');?>"/>
										</div>
										<div class="col-md-6 col-sm-6">
											<img id="ppCaptchaImage_<?php echo $index;?>" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="Captcha" style="vertical-align:top;cursor: pointer;"/>
										</div>
									</div>
								</div><!-- /.form-group -->
								<div class="form-group" style="display:none;">
									<label class="ppFormWarning alert alert-info" role="alert"><?php __('front_request_sending');?></label>
									<label class="ppFormSuccess alert alert-success" role="alert"><?php __('front_request_sent');?></label>
								</div>
							</form>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-default pjPplBtnNav" data-dismiss="modal"><?php __('front_layout1_close');?></button>
				        	<button type="button" class="btn btn-default btnSendContact"><?php __('front_layout1_send');?></button>
				      	</div>
				    </div>
				 </div>
			</div>
			<?php
		} else {
			$property_statuses = __('property_statuses', true);
			?>
			<div class="t11-card-block"><?php echo $property_statuses[$tpl['status']];?></div>
			<?php
		}
		?>
	</div>
</div>
<?php include_once dirname(dirname(__FILE__)) . '/elements/loadjs.php';?>
