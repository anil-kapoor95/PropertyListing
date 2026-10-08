<?php
/**
 * Theme 11 - saved colours (Admin > Preview & Install > "Theme 11 colours").
 * Prints the CSS variables that theme11.css reads. Only #rrggbb values are printed.
 */
if (!function_exists('t11_colors_style'))
{
	function t11_colors_style($option_arr)
	{
		$map = array(
			'o_theme11_header'       => '--t11-header',
			'o_theme11_page'         => '--t11-page',
			'o_theme11_card'         => '--t11-card',
			'o_theme11_text_heading' => '--t11-heading',
			'o_theme11_text_body'    => '--t11-body',
			'o_theme11_text_accent'  => '--t11-accent',
			'o_theme11_button'       => '--t11-button',
			'o_theme11_button_hover' => '--t11-button-hover',
			'o_theme11_list_active'  => '--t11-active',
			'o_theme11_list_inactive'=> '--t11-inactive'
		);
		$css = array();
		foreach ($map as $key => $var)
		{
			if (isset($option_arr[$key]) && is_string($option_arr[$key]) && preg_match('/^#[0-9a-fA-F]{6}$/', $option_arr[$key]))
			{
				$css[] = $var . ':' . $option_arr[$key];
			}
		}
		return count($css) > 0 ? '<style type="text/css">body [id^=pjWrapper]{' . implode(';', $css) . '}</style>' : '';
	}
}
if (isset($tpl['option_arr']))
{
	echo t11_colors_style($tpl['option_arr']);
}
