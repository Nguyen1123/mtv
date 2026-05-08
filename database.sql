-- Database Solar Energy Website
-- Import file này vào MySQL

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`username`, `password`) VALUES 
('admin', '$2y$10$vZT1F5UDJ5QZ5V8d3kL5h.8V8nZqR9qR7zJ5K6L8N3P1Q2R3S4T5U6');

-- Password: admin123 (đổi lại sau khi import)

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255),
  `power` varchar(100),
  `price` varchar(100),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`name`, `description`, `image`, `power`, `price`) VALUES
('Tấm pin mặt trời 400W', 'Tấm pin năng lượng mặt trời công suất cao', 'panel_400w.jpg', '400W', '8.500.000 VNĐ'),
('Inverter 5KW', 'Inverter chuyển đổi DC sang AC', 'inverter_5kw.jpg', '5KW', '15.000.000 VNĐ'),
('Pin lưu trữ 10KWh', 'Pin năng lượng lưu trữ đêm', 'battery_10kwh.jpg', '10KWh', '50.000.000 VNĐ');

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`title`, `content`, `image`) VALUES
('Lợi ích của năng lượng mặt trời', 'Năng lượng mặt trời là một trong những nguồn năng lượng tái tạo sạch nhất và tiết kiệm chi phí nhất.', 'solar_benefits.jpg');

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` varchar(100),
  `image` varchar(255),
  `description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `projects` (`name`, `location`, `capacity`, `image`, `description`) VALUES
('Dự án điện mặt trời TP.HCM', 'Thành phố Hồ Chí Minh', '50KW', 'project_hcm.jpg', 'Hệ thống năng lượng mặt trời tại TP.HCM');

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20),
  `email` varchar(255),
  `message` longtext NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
