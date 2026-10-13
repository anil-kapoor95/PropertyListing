-- PropertyListing / Stripe Checkout payments  (UNPREFIXED table names)
-- Adds Stripe as a second payment method for property renewals (next to PayPal): the plugin_stripe log table,
-- the Stripe options (Options > Submissions) and the labels. English text is added for every language id already
-- used by the labels; translate afterwards from the admin label editor. Safe to re-run.

-- 1) pjStripe plugin table (payment log + protection against processing a payment twice)
CREATE TABLE IF NOT EXISTS `plugin_stripe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foreign_id` int(10) unsigned DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `payment_intent` varchar(255) DEFAULT NULL,
  `event_id` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) unsigned DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2) options (Options > Submissions tab)
INSERT IGNORE INTO `options` (`foreign_id`, `key`, `tab_id`, `value`, `label`, `type`, `order`, `is_visible`, `style`) VALUES
(1, 'o_allow_stripe', 2, 'Yes|No::No', 'Yes|No', 'enum', 15, 1, NULL),
(1, 'o_stripe_secret_key', 2, '', NULL, 'string', 16, 1, NULL),
(1, 'o_stripe_api_key', 2, '', NULL, 'string', 17, 1, NULL);

-- 3) labels
INSERT IGNORE INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'payment_renew_stripe', 'backend', 'Label / Pay by card (Stripe)', 'script', NULL),
(NULL, 'payment_no_method', 'backend', 'Label / No payment method available', 'script', NULL),
(NULL, 'plugin_stripe_error', 'backend', 'Plugin / Stripe / Could not start payment', 'script', NULL),
(NULL, 'opt_o_allow_stripe', 'backend', 'Options / Allow payments with Stripe', 'script', NULL),
(NULL, 'opt_o_stripe_secret_key', 'backend', 'Options / Stripe secret key', 'script', NULL),
(NULL, 'opt_o_stripe_api_key', 'backend', 'Options / Stripe public key', 'script', NULL),
(NULL, 'error_titles_ARRAY_AP21', 'arrays', 'error_titles_ARRAY_AP21', 'script', NULL),
(NULL, 'error_bodies_ARRAY_AP21', 'arrays', 'error_bodies_ARRAY_AP21', 'script', NULL),
(NULL, 'error_titles_ARRAY_AP22', 'arrays', 'error_titles_ARRAY_AP22', 'script', NULL),
(NULL, 'error_bodies_ARRAY_AP22', 'arrays', 'error_bodies_ARRAY_AP22', 'script', NULL);

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Pay by card', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'payment_renew_stripe';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Online payment is not available at the moment. Please contact the administrator.', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'payment_no_method';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'The online payment could not be started. Please try again or contact the administrator.', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'plugin_stripe_error';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Allow payments with Stripe checkout', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'opt_o_allow_stripe';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Stripe secret key', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'opt_o_stripe_secret_key';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Stripe public key', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'opt_o_stripe_api_key';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Expiry date extended', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'error_titles_ARRAY_AP21';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'The payment was received and the property expiry date has been extended.', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'error_bodies_ARRAY_AP21';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'Payment not confirmed', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'error_titles_ARRAY_AP22';

INSERT IGNORE INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`)
SELECT NULL, f.`id`, 'pjField', l.`locale`, 'title', 'We could not confirm your payment. If you were charged, please contact the administrator and quote your Stripe receipt.', 'script'
FROM `fields` f
CROSS JOIN (SELECT DISTINCT `locale` FROM `multi_lang` WHERE `model` = 'pjField' AND `locale` IS NOT NULL) l
WHERE f.`key` = 'error_bodies_ARRAY_AP22';

-- 4) the two payment buttons are now PayPal and card: clearer captions (only where the original text is still there)
UPDATE `multi_lang` SET `content` = 'Pay with PayPal' WHERE `model` = 'pjField' AND `field` = 'title' AND `content` = 'Buy now' AND `foreign_id` IN (SELECT `id` FROM `fields` WHERE `key` = 'payment_renew_paypal');
UPDATE `multi_lang` SET `content` = REPLACE(`content`, 'click on "Buy now" button', 'click on one of the payment buttons') WHERE `model` = 'pjField' AND `field` = 'title' AND `foreign_id` IN (SELECT `id` FROM `fields` WHERE `key` = 'infoExtendDesc');

-- 5) refresh the cached label list so the new labels show up immediately
UPDATE `options` SET `value` = MD5(RAND()) WHERE `key` = 'o_fields_index';
