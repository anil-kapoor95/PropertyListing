<?php
$t11_theme = $controller->getTheme();
if (!$t11_theme && isset($tpl['option_arr']['o_theme'])) { $t11_theme = $tpl['option_arr']['o_theme']; }
include_once ROOT_PATH . PJ_TEMPLATE_PATH . PJ_TEMPLATE_SCRIPT_PATH . ($t11_theme === 'theme11' ? 'theme11/' : '') . 'pjActionProperties.php';
?>
