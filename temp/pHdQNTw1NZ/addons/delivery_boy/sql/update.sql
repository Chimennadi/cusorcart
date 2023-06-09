--
-- Table structure for table `delivery_boys`
--

CREATE TABLE `delivery_boys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_collection` double(25,2) NOT NULL DEFAULT 0.00,
  `earning` double(25,2) NOT NULL DEFAULT 0.00,
  `monthly_salary` double(25,2) DEFAULT NULL,
  `order_commission` double(25,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


ALTER TABLE `users` CHANGE `user_type` `user_type` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer';
ALTER TABLE `orders` ADD `assign_delivery_boy` INT(11) NULL DEFAULT NULL AFTER `seller_id`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Table structure for table `delivery_histories`
--

CREATE TABLE `delivery_histories` (
  `id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `delivery_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_histories`
--
ALTER TABLE `delivery_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;
COMMIT;

ALTER TABLE `delivery_boys` CHANGE `earning` `total_earning` DOUBLE(25,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `orders` ADD `cancel_request` TINYINT(1) NOT NULL DEFAULT '0' AFTER `delivery_viewed`;

ALTER TABLE `orders` ADD `cancel_request_at` DATETIME NULL DEFAULT NULL AFTER `cancel_request`;

ALTER TABLE `delivery_histories` ADD `earning` DOUBLE(25,2) NOT NULL DEFAULT '0.00' AFTER `payment_type`, ADD `collection` DOUBLE(25,2) NOT NULL DEFAULT '0.00' AFTER `earning`;
ALTER TABLE `delivery_histories` CHANGE `delivery_boy_id` `delivery_boy_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `orders` ADD `delivery_history_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `commission_calculated`;