-- PropertyListing / Forgot password: the "email not found" error (code 104) had no message text, so the red box was empty.
-- Adds the missing label (English text for every language id already in use) and replaces the Lorem ipsum intro text. Safe to re-run. UNPREFIXED table names.

INSERT IGNORE INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`)
SELECT NULL, 'forgot_err_ARRAY_104', 'arrays', 'forgot_err_ARRAY_104', 'script', NULL
FROM (SELECT 1) x
WHERE NOT EXISTS (SELECT 1 FROM `fields` WHERE `key` = 'forgot_err_ARRAY_104');

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'We could not find an account with this email address.', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'forgot_err_ARRAY_104';

UPDATE `multi_lang` SET `content` = 'Enter the email address of your account and we will send you your password.' WHERE `model` = 'pjField' AND `field` = 'title' AND `content` LIKE 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor%' AND `foreign_id` IN (SELECT `id` FROM `fields` WHERE `key` = 'front_layout1_forgot_text');

UPDATE `options` SET `value` = MD5(RAND()) WHERE `key` = 'o_fields_index';
