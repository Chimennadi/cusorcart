--
-- Table structure for table `delivery_boy_payments`
--

CREATE TABLE `delivery_boy_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment` double(25,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_boy_payments`
--
ALTER TABLE `delivery_boy_payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_boy_payments`
--
ALTER TABLE `delivery_boy_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Table structure for table `delivery_boy_collections`
--

CREATE TABLE `delivery_boy_collections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `collection_amount` double(25,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_boy_collections`
--
ALTER TABLE `delivery_boy_collections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_boy_collections`
--
ALTER TABLE `delivery_boy_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
COMMIT;