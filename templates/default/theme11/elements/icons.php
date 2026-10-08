<?php
/* Theme 11 line icons (inline SVG, they follow the text colour) */
if (!function_exists('t11_icon'))
{
	function t11_icon($name, $class = 't11-i')
	{
		static $paths = array(
			'bed'   => '<path d="M3 18v-7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v7"/><path d="M3 15h18"/><path d="M7 9V7a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v2"/><path d="M3 18v2M21 18v2"/>',
			'bath'  => '<path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3z"/><path d="M6 12V6a2 2 0 0 1 3.5-1.3"/><path d="M8 19l-1 2M16 19l1 2"/>',
			'area'  => '<path d="M4 4h6M4 4v6M20 4h-6M20 4v6M4 20h6M4 20v-6M20 20h-6M20 20v-6"/>',
			'pin'   => '<path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/>',
			'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
			'back'  => '<path d="M19 12H5M11 6l-6 6 6 6"/>',
			'print' => '<path d="M7 9V4h10v5"/><rect x="4" y="9" width="16" height="8" rx="2"/><path d="M7 14h10v6H7z"/>',
			'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
			'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
			'user'  => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
			'check' => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
			'cal'   => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
			'tag'   => '<path d="M3 12V4h8l10 10-8 8L3 12z"/><circle cx="7.5" cy="8.5" r="1.2"/>',
			'img'   => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.8"/><path d="M21 16l-5-5-8 8"/>',
			'filter'=> '<path d="M4 6h16M7 12h10M10 18h4"/>',
			'search'=> '<circle cx="11" cy="11" r="6"/><path d="M20 20l-4.2-4.2"/>',
			'home'  => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
			'ruler' => '<path d="M3 17L17 3l4 4L7 21z"/><path d="M7 13l2 2M10 10l2 2M13 7l2 2"/>',
			'cal2'  => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18"/>'
		);
		if (!isset($paths[$name])) { return ''; }
		return '<svg class="' . $class . '" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[$name] . '</svg>';
	}
}
if (!function_exists('t11_label'))
{
	/* dynamic, translatable label with a built-in English fallback */
	function t11_label($key, $fallback)
	{
		$v = __($key, true);
		return ($v !== null && $v !== false && $v !== '' && $v !== $key) ? $v : $fallback;
	}
}
