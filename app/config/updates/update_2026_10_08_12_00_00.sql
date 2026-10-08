START TRANSACTION;

-- 1) theme picker enum (keeps the currently selected theme)
UPDATE `options`
SET `value` = CONCAT('theme1|theme2|theme3|theme4|theme5|theme6|theme7|theme8|theme9|theme10|theme11::', SUBSTRING_INDEX(`value`, '::', -1)),
    `label` = 'Theme 1|Theme 2|Theme 3|Theme 4|Theme 5|Theme 6|Theme 7|Theme 8|Theme 9|Theme 10|Theme 11'
WHERE `key` = 'o_theme' AND `value` NOT LIKE '%theme11%';

UPDATE `options`
SET `value` = CONCAT('default|theme1|theme2|theme3|theme4|theme5|theme6|theme7|theme8|theme9|theme10|theme11::', SUBSTRING_INDEX(`value`, '::', -1)),
    `label` = 'Default|Theme 1|Theme 2|Theme 3|Theme 4|Theme 5|Theme 6|Theme 7|Theme 8|Theme 9|Theme 10|Theme 11'
WHERE `key` = 'o_layout' AND `value` NOT LIKE '%theme11%';

-- 2) colour options (foreign_id 1 = global script options)
INSERT IGNORE INTO `options` (`foreign_id`, `key`, `tab_id`, `value`, `label`, `type`, `order`, `is_visible`, `style`) VALUES
(1, 'o_theme11_header', NULL, '#12304d', 'Theme 11 / Header colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_page', NULL, '#f2f4f7', 'Theme 11 / Page background', 'string', NULL, 0, NULL),
(1, 'o_theme11_card', NULL, '#ffffff', 'Theme 11 / Card background', 'string', NULL, 0, NULL),
(1, 'o_theme11_text_heading', NULL, '#0f2a43', 'Theme 11 / Heading text colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_text_body', NULL, '#5a6a7a', 'Theme 11 / Body text colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_text_accent', NULL, '#a06a10', 'Theme 11 / Accent text colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_button', NULL, '#1b4a73', 'Theme 11 / Button colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_button_hover', NULL, '#12365a', 'Theme 11 / Button hover colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_list_active', NULL, '#d9a441', 'Theme 11 / Highlight colour', 'string', NULL, 0, NULL),
(1, 'o_theme11_list_inactive', NULL, '#dbe3ec', 'Theme 11 / Soft colour', 'string', NULL, 0, NULL);

-- 3) labels
INSERT IGNORE INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'option_themes_ARRAY_11', 'arrays', 'option_themes_ARRAY_11', 'script', NULL),
(NULL, 'error_titles_ARRAY_AO05', 'arrays', 'error_titles_ARRAY_AO05', 'script', NULL),
(NULL, 'error_bodies_ARRAY_AO05', 'arrays', 'error_bodies_ARRAY_AO05', 'script', NULL),
(NULL, 't11_legend', 'backend', 'Label / Theme 11 colours - t11_legend', 'script', NULL),
(NULL, 't11_quick_palettes', 'backend', 'Label / Theme 11 colours - t11_quick_palettes', 'script', NULL),
(NULL, 't11_tab_general', 'backend', 'Label / Theme 11 colours - t11_tab_general', 'script', NULL),
(NULL, 't11_tab_fonts', 'backend', 'Label / Theme 11 colours - t11_tab_fonts', 'script', NULL),
(NULL, 't11_tab_buttons', 'backend', 'Label / Theme 11 colours - t11_tab_buttons', 'script', NULL),
(NULL, 't11_tab_list', 'backend', 'Label / Theme 11 colours - t11_tab_list', 'script', NULL),
(NULL, 't11_lbl_header', 'backend', 'Label / Theme 11 colours - t11_lbl_header', 'script', NULL),
(NULL, 't11_lbl_page', 'backend', 'Label / Theme 11 colours - t11_lbl_page', 'script', NULL),
(NULL, 't11_lbl_card', 'backend', 'Label / Theme 11 colours - t11_lbl_card', 'script', NULL),
(NULL, 't11_lbl_text_heading', 'backend', 'Label / Theme 11 colours - t11_lbl_text_heading', 'script', NULL),
(NULL, 't11_lbl_text_body', 'backend', 'Label / Theme 11 colours - t11_lbl_text_body', 'script', NULL),
(NULL, 't11_lbl_text_accent', 'backend', 'Label / Theme 11 colours - t11_lbl_text_accent', 'script', NULL),
(NULL, 't11_lbl_button', 'backend', 'Label / Theme 11 colours - t11_lbl_button', 'script', NULL),
(NULL, 't11_lbl_button_hover', 'backend', 'Label / Theme 11 colours - t11_lbl_button_hover', 'script', NULL),
(NULL, 't11_lbl_list_active', 'backend', 'Label / Theme 11 colours - t11_lbl_list_active', 'script', NULL),
(NULL, 't11_lbl_list_inactive', 'backend', 'Label / Theme 11 colours - t11_lbl_list_inactive', 'script', NULL),
(NULL, 't11_hint_header', 'backend', 'Label / Theme 11 colours - t11_hint_header', 'script', NULL),
(NULL, 't11_hint_page', 'backend', 'Label / Theme 11 colours - t11_hint_page', 'script', NULL),
(NULL, 't11_hint_card', 'backend', 'Label / Theme 11 colours - t11_hint_card', 'script', NULL),
(NULL, 't11_hint_text_heading', 'backend', 'Label / Theme 11 colours - t11_hint_text_heading', 'script', NULL),
(NULL, 't11_hint_text_body', 'backend', 'Label / Theme 11 colours - t11_hint_text_body', 'script', NULL),
(NULL, 't11_hint_text_accent', 'backend', 'Label / Theme 11 colours - t11_hint_text_accent', 'script', NULL),
(NULL, 't11_hint_button', 'backend', 'Label / Theme 11 colours - t11_hint_button', 'script', NULL),
(NULL, 't11_hint_button_hover', 'backend', 'Label / Theme 11 colours - t11_hint_button_hover', 'script', NULL),
(NULL, 't11_hint_list_active', 'backend', 'Label / Theme 11 colours - t11_hint_list_active', 'script', NULL),
(NULL, 't11_hint_list_inactive', 'backend', 'Label / Theme 11 colours - t11_hint_list_inactive', 'script', NULL),
(NULL, 't11_click_to_change', 'backend', 'Label / Theme 11 colours - t11_click_to_change', 'script', NULL),
(NULL, 't11_btn_save', 'backend', 'Label / Theme 11 colours - t11_btn_save', 'script', NULL),
(NULL, 't11_btn_reset', 'backend', 'Label / Theme 11 colours - t11_btn_reset', 'script', NULL),
(NULL, 't11_note', 'backend', 'Label / Theme 11 colours - t11_note', 'script', NULL),
(NULL, 't11_live_preview', 'backend', 'Label / Theme 11 colours - t11_live_preview', 'script', NULL),
(NULL, 't11_live_preview_badge', 'backend', 'Label / Theme 11 colours - t11_live_preview_badge', 'script', NULL),
(NULL, 't11_read_good', 'backend', 'Label / Theme 11 colours - t11_read_good', 'script', NULL),
(NULL, 't11_read_low', 'backend', 'Label / Theme 11 colours - t11_read_low', 'script', NULL),
(NULL, 't11_read_poor', 'backend', 'Label / Theme 11 colours - t11_read_poor', 'script', NULL),
(NULL, 't11_read_title', 'backend', 'Label / Theme 11 colours - t11_read_title', 'script', NULL),
(NULL, 't11_sample_1', 'backend', 'Label / Theme 11 colours - t11_sample_1', 'script', NULL),
(NULL, 't11_sample_2', 'backend', 'Label / Theme 11 colours - t11_sample_2', 'script', NULL),
(NULL, 't11_pal_navy', 'backend', 'Label / Theme 11 colours - t11_pal_navy', 'script', NULL),
(NULL, 't11_pal_emerald', 'backend', 'Label / Theme 11 colours - t11_pal_emerald', 'script', NULL),
(NULL, 't11_pal_graphite', 'backend', 'Label / Theme 11 colours - t11_pal_graphite', 'script', NULL),
(NULL, 't11_pal_plum', 'backend', 'Label / Theme 11 colours - t11_pal_plum', 'script', NULL),
(NULL, 't11_pal_teal', 'backend', 'Label / Theme 11 colours - t11_pal_teal', 'script', NULL),
(NULL, 't11_pal_terracotta', 'backend', 'Label / Theme 11 colours - t11_pal_terracotta', 'script', NULL),
(NULL, 't11_pal_indigo', 'backend', 'Label / Theme 11 colours - t11_pal_indigo', 'script', NULL),
(NULL, 't11_pal_slate', 'backend', 'Label / Theme 11 colours - t11_pal_slate', 'script', NULL),
(NULL, 't11_more_filters', 'frontend', 'Label / Theme 11 - t11_more_filters', 'script', NULL),
(NULL, 't11_properties_found', 'frontend', 'Label / Theme 11 - t11_properties_found', 'script', NULL),
(NULL, 't11_back_to_listings', 'frontend', 'Label / Theme 11 - t11_back_to_listings', 'script', NULL),
(NULL, 't11_photos', 'frontend', 'Label / Theme 11 - t11_photos', 'script', NULL),
(NULL, 't11_key_facts', 'frontend', 'Label / Theme 11 - t11_key_facts', 'script', NULL);

-- English text for every language already used by the script's labels (translate afterwards in the label editor)
INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', t.`txt`, 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
INNER JOIN (
SELECT 'option_themes_ARRAY_11' AS `k`, 'Theme 11' AS `txt`
UNION ALL SELECT 'error_titles_ARRAY_AO05', 'Theme 11 colours saved'
UNION ALL SELECT 'error_bodies_ARRAY_AO05', 'The Theme 11 colours were saved and are now used on the listing pages.'
UNION ALL SELECT 't11_legend', 'Theme 11 colours'
UNION ALL SELECT 't11_quick_palettes', 'Quick palettes'
UNION ALL SELECT 't11_tab_general', 'General'
UNION ALL SELECT 't11_tab_fonts', 'Fonts'
UNION ALL SELECT 't11_tab_buttons', 'Buttons'
UNION ALL SELECT 't11_tab_list', 'Highlights'
UNION ALL SELECT 't11_lbl_header', 'Top bar / header colour'
UNION ALL SELECT 't11_lbl_page', 'Page background'
UNION ALL SELECT 't11_lbl_card', 'Card background'
UNION ALL SELECT 't11_lbl_text_heading', 'Heading text colour'
UNION ALL SELECT 't11_lbl_text_body', 'Body text colour'
UNION ALL SELECT 't11_lbl_text_accent', 'Accent text colour (prices, links)'
UNION ALL SELECT 't11_lbl_button', 'Button colour'
UNION ALL SELECT 't11_lbl_button_hover', 'Button hover colour'
UNION ALL SELECT 't11_lbl_list_active', 'Highlight colour'
UNION ALL SELECT 't11_lbl_list_inactive', 'Soft / inactive colour'
UNION ALL SELECT 't11_hint_header', 'Navigation bar, search button, icons'
UNION ALL SELECT 't11_hint_page', 'Behind the whole listing widget'
UNION ALL SELECT 't11_hint_card', 'Property cards, search box, panels'
UNION ALL SELECT 't11_hint_text_heading', 'Titles and property names'
UNION ALL SELECT 't11_hint_text_body', 'Descriptions, addresses and labels'
UNION ALL SELECT 't11_hint_text_accent', 'Links and highlighted text'
UNION ALL SELECT 't11_hint_button', 'Main buttons (white text)'
UNION ALL SELECT 't11_hint_button_hover', 'When the mouse is over a button'
UNION ALL SELECT 't11_hint_list_active', 'Active tab underline, brand badge, selected items'
UNION ALL SELECT 't11_hint_list_inactive', 'Input borders, image placeholders, soft backgrounds'
UNION ALL SELECT 't11_click_to_change', 'click to change'
UNION ALL SELECT 't11_btn_save', 'Save colours'
UNION ALL SELECT 't11_btn_reset', 'Reset to default'
UNION ALL SELECT 't11_note', 'Picking a quick palette or changing a colour only previews it here. Press “Save colours” to apply it to the listing pages. The readability badge shows text contrast (4.5 or higher is good).'
UNION ALL SELECT 't11_live_preview', 'Live preview'
UNION ALL SELECT 't11_live_preview_badge', 'updates as you edit'
UNION ALL SELECT 't11_read_good', 'Good'
UNION ALL SELECT 't11_read_low', 'Low'
UNION ALL SELECT 't11_read_poor', 'Poor'
UNION ALL SELECT 't11_read_title', 'Readability (WCAG): 4.5 or higher is good'
UNION ALL SELECT 't11_sample_1', 'Modern Family Villa'
UNION ALL SELECT 't11_sample_2', 'Sunny City Apartment'
UNION ALL SELECT 't11_pal_navy', 'Harbor Navy (default)'
UNION ALL SELECT 't11_pal_emerald', 'Emerald Estate'
UNION ALL SELECT 't11_pal_graphite', 'Graphite Night'
UNION ALL SELECT 't11_pal_plum', 'Plum & Rose Gold'
UNION ALL SELECT 't11_pal_teal', 'Ocean Teal'
UNION ALL SELECT 't11_pal_terracotta', 'Terracotta Brick'
UNION ALL SELECT 't11_pal_indigo', 'Royal Indigo'
UNION ALL SELECT 't11_pal_slate', 'Slate & Amber'
UNION ALL SELECT 't11_more_filters', 'More filters'
UNION ALL SELECT 't11_properties_found', 'properties found'
UNION ALL SELECT 't11_back_to_listings', 'Back to listings'
UNION ALL SELECT 't11_photos', 'photos'
UNION ALL SELECT 't11_key_facts', 'Key facts'
) t ON t.`k` = f.`key`;

UPDATE `options`
SET `value` = CONCAT(SUBSTRING_INDEX(`value`, '::', 1), '::theme11')
WHERE `key` = 'o_theme';

-- refresh the label cache
UPDATE `options` SET `value` = MD5(RAND()) WHERE `key` = 'o_fields_index';

COMMIT;
