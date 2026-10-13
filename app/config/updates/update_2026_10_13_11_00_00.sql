START TRANSACTION;

INSERT IGNORE INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 't11_no_account', 'backend', 'Theme 11 / Account page: No account yet?', 'script', NULL),
(NULL, 't11_have_account', 'backend', 'Theme 11 / Account page: Already have an account?', 'script', NULL),
(NULL, 't11_show_password', 'backend', 'Theme 11 / Account page: Show password', 'script', NULL);

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'No account yet?', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 't11_no_account';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Already have an account?', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 't11_have_account';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Show password', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 't11_show_password';

UPDATE `multi_lang` SET `content` = 'Welcome back. Log in to manage your property listings.' WHERE `model` = 'pjField' AND `field` = 'title' AND `content` LIKE 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor%' AND `foreign_id` IN (SELECT `id` FROM `fields` WHERE `key` = 'front_layout1_login_text');

UPDATE `multi_lang` SET `content` = 'Sign up to add and manage your own property listings.' WHERE `model` = 'pjField' AND `field` = 'title' AND `content` LIKE 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor%' AND `foreign_id` IN (SELECT `id` FROM `fields` WHERE `key` = 'front_layout1_account_text');

UPDATE `options` SET `value` = MD5(RAND()) WHERE `key` = 'o_fields_index';

COMMIT;