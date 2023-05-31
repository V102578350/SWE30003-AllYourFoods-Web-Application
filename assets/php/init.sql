CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `attributes` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `disabled` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_items` text NOT NULL,
  `total_cost` float NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) AUTO_INCREMENT = 1;

INSERT INTO `products` (`id`, `name`, `category`, `attributes`, `price`, `stock`, `disabled`) VALUES
	(41, 'Red Apples', 'Fresh Produce', '{"color": "red", "weight": "1kg", "origin": "Australia"}', 10.5, 100, 0),
	(42, 'Cola Blast', 'Beverage', '{"size": "500ml", "flavor": "cola", "sugarContent": "39g"}', 2.5, 200, 0),
	(43, 'Canned Beans', 'Packaged Food', '{"expiryDate": "2024-01-01", "ingredients": "Beans, Water, Salt", "weight": "400g"}', 1.5, 150, 0),
	(44, 'Chicken Breast', 'Animal Product', '{"animalType": "Chicken", "cut": "Breast", "weight": "1kg"}', 7.5, 80, 0),
	(45, 'Green Pears', 'Fresh Produce', '{"color": "green", "weight": "1kg", "origin": "Australia"}', 11, 70, 0),
	(46, 'Apple Juice', 'Beverage', '{"size": "1L", "flavor": "apple", "sugarContent": "24g"}', 3.5, 180, 0),
	(47, 'Spaghetti Pasta', 'Packaged Food', '{"expiryDate": "2023-12-01", "ingredients": "Durum Wheat Semolina", "weight": "500g"}', 2.2, 120, 0),
	(48, 'Lamb Chops', 'Animal Product', '{"animalType": "Lamb", "cut": "Chops", "weight": "500g"}', 15, 60, 0),
	(49, 'Leafy Lettuce', 'Fresh Produce', '{"color": "green", "weight": "200g", "origin": "Australia"}', 2.5, 130, 0),
	(50, 'Orange Fizz', 'Beverage', '{"size": "500ml", "flavor": "orange", "sugarContent": "38g"}', 2.8, 150, 0),
	(51, 'Canned Tuna', 'Packaged Food', '{"expiryDate": "2024-02-01", "ingredients": "Tuna, Olive Oil", "weight": "200g"}', 3, 160, 0),
	(52, 'T-bone Steak', 'Animal Product', '{"animalType": "Beef", "cut": "T-bone", "weight": "600g"}', 20, 50, 0),
	(53, 'Vibrant Peppers', 'Fresh Produce', '{"color": "red, green, yellow", "weight": "1kg", "origin": "Mexico"}', 12, 85, 0),
	(54, 'Lemonade', 'Beverage', '{"size": "1L", "flavor": "lemon", "sugarContent": "30g"}', 3, 165, 0),
	(55, 'Muesli', 'Packaged Food', '{"expiryDate": "2023-12-15", "ingredients": "Oats, Dried Fruits", "weight": "500g"}', 4, 140, 0),
	(56, 'Pork Sausages', 'Animal Product', '{"animalType": "Pork", "cut": "Sausages", "weight": "1kg"}', 8, 75, 0),
	(57, 'Blue Berries', 'Fresh Produce', '{"color": "blue", "weight": "1kg", "origin": "Maine"}', 15, 95, 0),
	(58, 'Grape Juice', 'Beverage', '{"size": "1L", "flavor": "grape", "sugarContent": "28g"}', 3.2, 175, 0),
	(59, 'Instant Ramen', 'Packaged Food', '{"expiryDate": "2024-03-01", "ingredients": "Noodles, Spices", "weight": "70g"}', 0.9, 200, 0),
	(60, 'Salmon Fillet', 'Animal Product', '{"animalType": "Fish", "cut": "Fillet", "weight": "200g"}', 14.5, 65, 0);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);