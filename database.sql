use webcuoiki; 
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 04:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webcuoiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 2, '2024-06-19 11:50:19', '2024-06-19 11:57:01'),
(2, 2, 2, 3, '2024-06-19 11:50:22', '2024-06-19 11:51:29'),
(3, 2, 1, 3, '2024-06-19 11:51:34', '2024-06-19 12:07:43'),
(4, 2, 5, 1, '2024-06-19 11:57:08', '2024-06-19 11:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_12_101620_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total`, `payment_method`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'pending', 62999000.00, 'visa', 'Khánh An, Yên Khánh, Ninh Bình', '2024-06-19 10:50:03', '2024-06-19 10:50:03'),
(2, 2, 'pending', 81597000.00, 'cod', 'wbchyhjqidrmsnl@eurokool.com', '2024-06-19 11:35:12', '2024-06-19 11:35:12'),
(3, 3, 'pending', 50599000.00, 'momo', 'HẢI PHÒNG', '2024-06-19 13:25:38', '2024-06-19 13:25:38'),
(4, 3, 'pending', 193097000.00, 'momo', 'hai phong', '2024-06-19 13:30:09', '2024-06-19 13:30:09'),
(5, 3, 'pending', 193097000.00, 'momo', 'hai phong', '2024-06-19 13:31:04', '2024-06-19 13:31:04'),
(6, 3, 'pending', 62999000.00, 'visa', 'ha noi', '2024-06-19 13:33:30', '2024-06-19 13:33:30'),
(7, 3, 'pending', 129097000.00, 'cod', 'HẢI PHÒNG', '2024-06-19 13:56:34', '2024-06-19 13:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 62999000.00, '2024-06-19 10:50:03', '2024-06-19 10:50:03'),
(2, 2, 2, 2, 15499000.00, '2024-06-19 11:35:12', '2024-06-19 11:35:12'),
(3, 2, 3, 1, 50599000.00, '2024-06-19 11:35:12', '2024-06-19 11:35:12'),
(4, 3, 3, 1, 50599000.00, '2024-06-19 13:25:38', '2024-06-19 13:25:38'),
(5, 5, 10, 1, 148099000.00, '2024-06-19 13:31:04', '2024-06-19 13:31:04'),
(6, 5, 8, 2, 22499000.00, '2024-06-19 13:31:04', '2024-06-19 13:31:04'),
(7, 6, 1, 1, 62999000.00, '2024-06-19 13:33:30', '2024-06-19 13:33:30'),
(8, 7, 1, 1, 62999000.00, '2024-06-19 13:56:35', '2024-06-19 13:56:35'),
(9, 7, 2, 1, 15499000.00, '2024-06-19 13:56:35', '2024-06-19 13:56:35'),
(10, 7, 3, 1, 50599000.00, '2024-06-19 13:56:35', '2024-06-19 13:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`,`detail`, `price`, `quantity`, `created_at`, `updated_at`, `image`) VALUES
(1, 'HACOM APOLLO I01 (I7 14700K/RTX 4070 TI)', 'Thông số sản phẩm\r\nCPU : INTEL i7-14700K\r\nMAIN : Z790M\r\nRAM : 32GB (2x16GB) DDR5\r\nSSD : 512GB SSD\r\nVGA: RTX 4070 Ti\r\nNGUỒN : 850W','HACOM APOLLO I01 là dòng PC cao cấp, được trang bị bộ vi xử lý Intel Core i7-14700K mạnh mẽ, đảm bảo hiệu năng vượt trội cho mọi nhu cầu sử dụng từ chơi game, đồ họa đến xử lý các tác vụ nặng. Với mainboard Z790M, máy tính có khả năng nâng cấp và tương thích tốt với các linh kiện hiện đại. Bộ nhớ RAM 32GB DDR5 cung cấp tốc độ xử lý nhanh chóng và mượt mà, đảm bảo đa nhiệm hiệu quả. Ổ cứng SSD 512GB giúp khởi động hệ thống và các ứng dụng nhanh chóng, đồng thời cung cấp không gian lưu trữ đủ lớn cho dữ liệu cá nhân và công việc. Card đồ họa NVIDIA GeForce RTX 4070 Ti mang lại trải nghiệm hình ảnh tuyệt vời với khả năng xử lý đồ họa mạnh mẽ, hỗ trợ tốt cho các tựa game AAA và các phần mềm đồ họa chuyên nghiệp. Hệ thống nguồn 850W đảm bảo cung cấp đủ điện năng cho toàn bộ hệ thống hoạt động ổn định và bền bỉ.\nHiệu năng vượt trội: Với Intel Core i7-14700K, xử lý mượt mà mọi tác vụ nặng.\nĐa nhiệm hiệu quả: RAM 32GB DDR5 cho phép mở nhiều ứng dụng cùng lúc mà không lo giật lag.\nTrải nghiệm hình ảnh đỉnh cao: RTX 4070 Ti mang lại hình ảnh sắc nét, chân thực cho mọi nhu cầu từ chơi game đến làm việc đồ họa.\nKhởi động nhanh chóng: Ổ cứng SSD 512GB giúp hệ thống và các ứng dụng khởi động trong tích tắc.\nKhả năng nâng cấp dễ dàng: Mainboard Z790M tương thích với nhiều linh kiện hiện đại, giúp bạn dễ dàng nâng cấp khi cần.', 62999000, 7, '2024-06-12 03:59:40', '2024-06-19 13:56:35', 'product_images/vlYzrvbnhF9RQHMSWyuogNWeFMHQoT5DobNYfnSR.webp'),
(2, 'MINI C2 WHITE V2 (I5 12400F/GTX 1660 SUPER)', 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B660M\r\nRAM : 8GB (1x8G) DDR4\r\nSSD : 500 GB SSD\r\nVGA: GTX 1660 Super\r\nNGUỒN : 550W','MINI C2 WHITE V2 là dòng PC nhỏ gọn với hiệu năng vượt trội, phù hợp cho các nhu cầu đa dạng từ công việc văn phòng đến giải trí giải trí và gaming cơ bản. Bộ vi xử lý Intel Core i5-12400F cung cấp hiệu suất ổn định, đủ mạnh mẽ cho các tác vụ hàng ngày. Mainboard B660M hỗ trợ tính năng nâng cấp linh kiện tốt, giúp bạn dễ dàng cập nhật nếu có nhu cầu. RAM 8GB DDR4 đảm bảo khả năng xử lý nhanh chóng cho các ứng dụng cơ bản và game nhẹ. Ổ cứng SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ khởi động nhanh, mang lại trải nghiệm sử dụng mượt mà. Card đồ họa NVIDIA GeForce GTX 1660 Super cho phép bạn trải nghiệm game với độ phân giải cao và hiệu suất ổn định. Nguồn 550W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng đáng tin cậy: Với Intel Core i5-12400F, đủ mạnh mẽ cho các nhu cầu hàng ngày.\nKhả năng nâng cấp linh hoạt: Mainboard B660M hỗ trợ tính năng nâng cấp tốt.\nKhởi động nhanh chóng: SSD 500GB giúp hệ thống khởi động và tải ứng dụng nhanh chóng.\nTrải nghiệm gaming tốt: GTX 1660 Super cho phép trải nghiệm game mượt mà với độ phân giải cao.\nThiết kế nhỏ gọn: Phù hợp với không gian hẹp và dễ dàng di chuyển.', 15499000, 7, '2024-06-12 04:03:31', '2024-06-19 13:56:35', 'product_images/1BEJ14l8QOgmhUXBzohUyN673ifIVpHJwKhTLHC1.png'),
(3, 'POSEIDON (I7 13700F/RTX 4070)', 'Thông số sản phẩm\r\nCPU : INTEL i7-13700F\r\nMAIN : Z690\r\nRAM : 32GB (2x16G) DDR4\r\nSSD : 1TB SSD\r\nVGA: RTX 4070 12G\r\nNGUỒN : 750W','POSEIDON là dòng PC mạnh mẽ với bộ vi xử lý Intel Core i7-13700F, đem đến hiệu năng vượt trội cho các ứng dụng đa nhiệm và gaming. Mainboard Z690 hỗ trợ tính năng nâng cấp cao, đảm bảo tương thích với các linh kiện hiện đại. RAM 32GB DDR4 cung cấp khả năng xử lý mượt mà cho các tác vụ nặng. Ổ cứng SSD 1TB cung cấp không gian lưu trữ lớn và tốc độ truy xuất nhanh. Card đồ họa RTX 4070 12G mang lại trải nghiệm hình ảnh sống động và mượt mà cho gaming và đồ họa. Nguồn 750W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng mạnh mẽ: Với Intel Core i7-13700F và RAM 32GB DDR4.\nTính năng nâng cấp cao: Mainboard Z690 hỗ trợ tính năng nâng cấp linh kiện.\nLưu trữ lớn và nhanh chóng: SSD 1TB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh.\nTrải nghiệm gaming và đồ họa tuyệt vời: Card đồ họa RTX 4070 12G.\nĐiện năng ổn định: Nguồn 750W đảm bảo hệ thống hoạt động ổn định.', 50599000, 7, '2024-06-12 04:07:25', '2024-06-19 13:56:35', 'product_images/EopRbHBMFc82qn9XCLbQEknDQyS1ac67Vzo1Rj7E.webp'),
(4, 'SNIPER (R5 4600G/RADEON GRAPHICS)', 'Thông số sản phẩm\r\nCPU : AMD Ryzen 5 4600G\r\nMAIN : B450\r\nRAM : 16GB DDR4\r\nSSD : 500GB SSD\r\nVGA: Radeon™ Graphics\r\nNGUỒN : 500W','SNIPER là dòng PC đa năng với bộ vi xử lý AMD Ryzen 5 4600G, phù hợp cho các nhu cầu đơn giản từ công việc văn phòng đến giải trí nhẹ và các ứng dụng học tập. Mainboard B450 hỗ trợ tính năng cơ bản, đáp ứng đầy đủ các yêu cầu sử dụng hàng ngày. RAM 16GB DDR4 đảm bảo khả năng xử lý mượt mà cho các tác vụ cơ bản. Ổ cứng SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh. Card đồ họa Radeon™ Graphics giúp hiển thị hình ảnh sắc nét trong các ứng dụng văn phòng và giải trí nhẹ. Nguồn 500W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng đơn giản: Với AMD Ryzen 5 4600G và RAM 16GB DDR4.\nTính đa năng: Phù hợp với các nhu cầu từ công việc văn phòng đến giải trí nhẹ.\nLưu trữ nhanh chóng: SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh.\nHiển thị hình ảnh sắc nét: Card đồ họa Radeon™ Graphics.\nĐiện năng ổn định: Nguồn 500W đảm bảo hệ thống hoạt động ổn định.', 8499000, 10, '2024-06-12 05:09:06', '2024-06-12 05:09:06', 'product_images/eagL0ymnsR5AifGjBrKH4MFBtHFQTZcEwBkYehia.webp'),
(5, 'SNIPER (I5 12400F/GTX 1660 SUPER)', 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B660M\r\nRAM : 8GB (1x8GB) DDR4\r\nSSD : 250GB SSD\r\nVGA: GTX 1660 Super 6GB\r\nNGUỒN : 500W','SNIPER là dòng PC đa năng với bộ vi xử lý Intel Core i5-12400F, phù hợp cho các nhu cầu từ công việc văn phòng đến giải trí nhẹ và gaming cơ bản. Mainboard B660M hỗ trợ tính năng cơ bản, đảm bảo tương thích với các linh kiện hiện đại. RAM 8GB DDR4 đảm bảo khả năng xử lý mượt mà cho các tác vụ cơ bản. Ổ cứng SSD 250GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh. Card đồ họa GTX 1660 Super 6GB giúp hiển thị hình ảnh sắc nét trong các game và ứng dụng đồ họa. Nguồn 500W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng đơn giản: Với Intel Core i5-12400F và RAM 8GB DDR4.\nTính đa năng: Phù hợp với các nhu cầu từ công việc văn phòng đến giải trí nhẹ và gaming cơ bản.\nLưu trữ nhanh chóng: SSD 250GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh.\nHiển thị hình ảnh sắc nét: Card đồ họa GTX 1660 Super 6GB.\nĐiện năng ổn định: Nguồn 500W đảm bảo hệ thống hoạt động ổn định.', 15299000, 10, '2024-06-12 06:44:03', '2024-06-12 06:44:03', 'product_images/2dryBTwkqbCTYNVLmarW0dr2gcAxY1BcdlJt0oNT.webp'),
(6, 'APOLLO I13 (I7 12700F/RTX 4060 TI)', 'Thông số sản phẩm\r\nCPU : INTEL i7-12700F\r\nMAIN : B760M\r\nRAM : 32GB (2x16GB) DDR4\r\nSSD : 500GB SSD\r\nVGA: RTX 4060 Ti\r\nNGUỒN : 750W','APOLLO I13 là dòng PC cao cấp với bộ vi xử lý Intel Core i7-12700F, mang đến hiệu năng mạnh mẽ cho các tác vụ đa nhiệm và gaming nặng. Mainboard B760M hỗ trợ tính năng nâng cấp cao, tương thích với các linh kiện mới nhất. RAM 32GB DDR4 đảm bảo khả năng xử lý mượt mà cho các ứng dụng nặng. Ổ cứng SSD 500GB cung cấp không gian lưu trữ lớn và tốc độ truy xuất nhanh. Card đồ họa RTX 4060 Ti mang đến trải nghiệm gaming với độ phân giải cao và hiệu suất ổn định. Nguồn 750W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng mạnh mẽ: Với Intel Core i7-12700F và RAM 32GB DDR4.\nTính năng nâng cấp cao: Mainboard B760M hỗ trợ tính năng nâng cấp linh kiện.\nLưu trữ lớn và nhanh chóng: SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh.\nTrải nghiệm gaming tuyệt vời: Card đồ họa RTX 4060 Ti với độ phân giải cao.\nĐiện năng ổn định: Nguồn 750W đảm bảo hệ thống hoạt động ổn định.', 33499000, 10, '2024-06-12 06:44:52', '2024-06-12 06:44:52', 'product_images/AlUz1s8PR2cUsSedUGeCBhBCf3UjfAZ18dC5ee33.webp'),
(7, 'POSEIDON LIMITED EDITION (I9 14900K/RTX 4090)', 'Thông số sản phẩm\r\nCPU : Intel i9-14900K\r\nMAIN : Z790\r\nRAM : 64GB (4x16GB) DDR5\r\nSSD : 1TB SSD\r\nVGA: NVIDIA 4090\r\nNGUỒN : 1050W','POSEIDON LIMITED EDITION là phiên bản đặc biệt với bộ vi xử lý Intel Core i9-14900K, mang đến hiệu năng siêu mạnh mẽ cho các tác vụ đa nhiệm và gaming cao cấp. Mainboard Z790 hỗ trợ tính năng nâng cấp cao nhất, tương thích với các linh kiện mới nhất. RAM 64GB DDR5 đảm bảo khả năng xử lý mượt mà cho các ứng dụng nặng. Ổ cứng SSD 1TB cung cấp không gian lưu trữ lớn và tốc độ truy xuất siêu nhanh. Card đồ họa NVIDIA 4090 với độ phân giải cao và hiệu suất vượt trội. Nguồn 1050W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng siêu mạnh mẽ: Với Intel Core i9-14900K và RAM 64GB DDR5.\nTính năng nâng cấp cao: Mainboard Z790 hỗ trợ tính năng nâng cấp linh kiện.\nLưu trữ siêu nhanh: SSD 1TB cung cấp không gian lưu trữ lớn và tốc độ truy xuất siêu nhanh.\nTrải nghiệm gaming cao cấp: Card đồ họa NVIDIA 4090 với độ phân giải cao.\nĐiện năng ổn định: Nguồn 1050W đảm bảo hệ thống hoạt động ổn định.', 119999000, 10, '2024-06-12 06:45:35', '2024-06-12 06:45:35', 'product_images/0ctz1mnxdpBI7HV2DaBJrgQTVbIKyYfnAaDoG7Lx.webp'),
(8, 'SNIPER S25 (I5 13400F/RTX 4060)', 'Thông số sản phẩm\r\nCPU : INTEL i5-13400F\r\nMAIN : B760M\r\nRAM : 16GB (2x8GB) DDR4\r\nSSD : 500GB SSD\r\nVGA: RTX 4060\r\nNGUỒN : 650W','SNIPER S25 là dòng PC với bộ vi xử lý Intel Core i5-13400F, mang đến hiệu năng vượt trội cho các nhu cầu từ công việc đến giải trí nhẹ và gaming cơ bản. Mainboard B760M hỗ trợ tính năng cơ bản, đảm bảo tương thích với các linh kiện hiện đại. RAM 16GB DDR4 đảm bảo khả năng xử lý mượt mà cho các tác vụ đa nhiệm. Ổ cứng SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh. Card đồ họa RTX 4060 giúp hiển thị hình ảnh sắc nét trong các game và ứng dụng đồ họa. Nguồn 650W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng vượt trội: Với Intel Core i5-13400F và RAM 16GB DDR4.\nTính tương thích cao: Mainboard B760M tương thích với các linh kiện hiện đại.\nLưu trữ và xử lý mượt mà: SSD 500GB và RAM 16GB DDR4.\nHiển thị hình ảnh sắc nét: Card đồ họa RTX 4060.\nĐiện năng ổn định: Nguồn 650W đảm bảo hệ thống hoạt động ổn định.', 22499000, 8, '2024-06-12 06:47:10', '2024-06-19 13:31:04', 'product_images/wmNpowM0Qpp850YJJ1ks1oyRfPvhk6uqKmGCB0rx.webp'),
(9, 'APOLLO I07 (I7 14700F/RTX 3060)', 'Thông số sản phẩm\r\nCPU : INTEL i7-14700K\r\nMAIN : B760\r\nRAM : 16GB (2x8GB) DDR4\r\nSSD : 500GB SSD\r\nVGA: RTX 3060\r\nNGUỒN : 650W','APOLLO I07 là dòng PC với bộ vi xử lý Intel Core i7-14700F, mang đến hiệu năng ổn định cho các nhu cầu từ công việc đến giải trí nhẹ và gaming cơ bản. Mainboard B760 hỗ trợ tính năng cơ bản, đảm bảo tương thích với các linh kiện hiện đại. RAM 16GB DDR4 đảm bảo khả năng xử lý mượt mà cho các tác vụ đa nhiệm. Ổ cứng SSD 500GB cung cấp không gian lưu trữ đủ lớn và tốc độ truy xuất nhanh. Card đồ họa RTX 3060 giúp hiển thị hình ảnh sắc nét trong các game và ứng dụng đồ họa. Nguồn 650W đảm bảo cung cấp điện năng ổn định cho toàn bộ hệ thống.\nHiệu năng ổn định: Với Intel Core i7-14700F và RAM 16GB DDR4.\nTính tương thích cao: Mainboard B760 tương thích với các linh kiện hiện đại.\nLưu trữ và xử lý mượt mà: SSD 500GB và RAM 16GB DDR4.\nHiển thị hình ảnh sắc nét: Card đồ họa RTX 3060.\nĐiện năng ổn định: Nguồn 650W đảm bảo hệ thống hoạt động ổn định.', 28999000, 10, '2024-06-12 06:48:37', '2024-06-12 06:48:37', 'product_images/n5wQKJuQ8hTbKATQ65irCRc2ejYPiRPolnjmAp6z.webp'),
(10, 'ASUS - I9 14900K/RTX 4090 (POWERED BY ASUS)', 'Thông số sản phẩm\r\nCPU : INTEL i9-14900K\r\nMAIN : Z790\r\nRAM : 64GB (2x32GB) DDR5\r\nSSD : 2TB SSD NVME 4x4\r\nVGA: RTX 4090','ASUS - I9 14900K/RTX 4090 (POWERED BY ASUS) là dòng PC cao cấp, sử dụng bộ vi xử lý Intel Core i9-14900K và card đồ họa RTX 4090 của NVIDIA. Với RAM 64GB DDR5 và ổ cứng SSD NVME 2TB 4x4, đây là sản phẩm mạnh mẽ, phù hợp cho các nhu cầu chuyên sâu như đồ họa, render hay gaming nặng.\nBộ vi xử lý mạnh mẽ: Intel Core i9-14900K.\nĐồ họa vượt trội: Card đồ họa RTX 4090.\nLưu trữ nhanh chóng: SSD NVME 2TB 4x4.\nRAM lớn: 64GB DDR5.', 148099000, 9, '2024-06-12 06:54:12', '2024-06-19 13:31:04', 'product_images/vao8TltW83rzr75yLsUM4c6hrhE7wU2i9AewiKFw.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `full_name`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trần Long Hải', 'admin@gmail.com', NULL, '$2y$10$pYvcrHlSBFjsEL.U2ex5x.8CBseYQ/4I9XJIQZNF8zRbLYlR2q/R6', 'admin', '', NULL, NULL, NULL, '2024-06-12 03:32:52', '2024-06-12 03:32:52'),
(2, 'Nguyễn Bá Minh Tuấn', 'tuan2003@gmail.com', NULL, '$2y$10$18t5Uxn3kQcRdIfABgOILO.Jf2tTxwIbYu6AaVfCYQ5GWx.HosPWC', 'user', 'Nguyễn Bá Minh Tuấn', '0987654321', 'NInh BÌnh', NULL, '2024-06-17 20:03:13', '2024-06-19 08:13:06'),
(3, 'Nguyễn Bá Tài', 'tai2003@gmail.com', NULL, '$2y$10$s0.WbBsc5WRxW8wbHAMTzuSxIE8bhIY74Nr2/K6PLCIVKUWaNsoHS', 'user', 'Nguyễn Bá Tài', '0987654321', 'HẢI PHÒNG', NULL, '2024-06-19 13:06:39', '2024-06-19 13:39:38'),
(4, 'Phạm Hoàng A', 'phamhoanga@gmail.com', NULL, '$2y$10$azEzSVStXkP56YiNMrQyKu8lkEk3ltkag3Zr2vCJeqF.HpiObX4.2', 'user', NULL, NULL, NULL, NULL, '2024-06-19 13:58:18', '2024-06-19 13:58:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--

ALTER TABLE `products`
  ADD COLUMN `category` VARCHAR(255) DEFAULT 'PC';

INSERT INTO `products` (`id`, `name`, `description`, `detail`, `price`, `quantity`, `created_at`, `updated_at`, `image`, `category`) VALUES
(11, 'Dell Inspiron 14 5000 2-in-1', 'Thông số sản phẩm\nCPU : Core i5-1135G7\nRAM : 8GB DDR4\nSSD : 1TB SSD\nVGA: Intel Iris Xe Graphics\nPIN : 90Wh\nMÀN HÌNH: 14" FHD', 'Laptop Dell Inspiron là laptop cao cấp với bộ vi xử lý Intel Core i5-1135G7 mạnh mẽ, cung cấp hiệu năng vượt trội cho các nhu cầu từ làm việc đến giải trí. RAM 8GB DDR4 đảm bảo khả năng đa nhiệm mượt mà. Ổ cứng SSD 1TB cung cấp không gian lưu trữ rộng rãi và tốc độ truy xuất dữ liệu nhanh chóng. Card đồ họa Intel Iris Xe Graphics mang đến trải nghiệm chơi game và xử lý đồ họa mượt mà. Pin 90Wh cung cấp thời lượng sử dụng lâu dài. Màn hình 14" FHD mang lại hình ảnh sắc nét và mượt mà.', 39990000, 5, '2024-07-18 12:00:00', '2024-07-18 12:00:00', 'product_images/2226_1.jpg', 'Laptop'),
(12, 'THINKBOOK 14 G6+ 2024', 'Thông số sản phẩm\nCPU : Intel Core Ultra 5-125H\nRAM : 16GB\nSSD : 512GB SSD\nVGA: Intel® Arc™ graphics\nPIN : 85wh\nMÀN HÌNH: 14.5″, 2.5K+ IPS', 'Laptop THINKBOOK 14 G6+ 2024 là laptop cao cấp với bộ vi xử lý Intel Core Ultra 5-125H mạnh mẽ, cung cấp hiệu năng vượt trội cho các nhu cầu từ làm việc đến giải trí. RAM 16GB đảm bảo khả năng đa nhiệm mượt mà. Ổ cứng SSD 512GB cung cấp không gian lưu trữ rộng rãi và tốc độ truy xuất dữ liệu nhanh chóng. Card đồ họa Intel® Arc™ graphics mang đến trải nghiệm chơi game và xử lý đồ họa mượt mà. Pin 85Wh cung cấp thời lượng sử dụng lâu dài. Màn hình 14.5″, 2.5K+ IPS mang lại hình ảnh sắc nét và mượt mà.', 39990000, 5, '2024-07-18 12:00:00', '2024-07-18 12:00:00', 'product_images/3181_Thinkbook-14-G6-2024-Intel-Ultra-7-155H-h1.jpg', 'Laptop'),
(13, 'THINKBOOK 14 G6+ 2024', 'Thông số sản phẩm\nCPU : Intel Core Ultra 5-125H\nRAM : 16GB\nSSD : 512GB SSD\nVGA: Intel® Arc™ graphics\nPIN : 85wh\nMÀN HÌNH: 14.5″, 2.5K+ IPS', 'Laptop THINKBOOK 14 G6+ 2024 là laptop cao cấp với bộ vi xử lý Intel Core Ultra 5-125H mạnh mẽ, cung cấp hiệu năng vượt trội cho các nhu cầu từ làm việc đến giải trí. RAM 16GB đảm bảo khả năng đa nhiệm mượt mà. Ổ cứng SSD 512GB cung cấp không gian lưu trữ rộng rãi và tốc độ truy xuất dữ liệu nhanh chóng. Card đồ họa Intel® Arc™ graphics mang đến trải nghiệm chơi game và xử lý đồ họa mượt mà. Pin 85Wh cung cấp thời lượng sử dụng lâu dài. Màn hình 14.5″, 2.5K+ IPS mang lại hình ảnh sắc nét và mượt mà.', 39990000, 5, '2024-07-18 12:00:00', '2024-07-18 12:00:00', 'product_images/3181_Thinkbook-14-G6-2024-Intel-Ultra-7-155H-h1.jpg', 'Laptop'),
(14, 'ASUS Prime B760M-K D4', 'Thông số sản phẩm\n- Socket Intel® LGA 1700: sẵn sàng cho bộ xử lý Intel® thế hệ 14, 13 và 12.\n- Kết nối cực nhanh: PCIe 4.0, hai khe M.2 PCIe 4.0, Ethernet Realtek 2.5Gb và USB 3.2 Gen 1 trên bo\n- Tản nhiệt toàn diện: Tản nhiệt VRM, tản nhiệt PCH, cổng cắm quạt hybrid và Fan Xpert\n- Đèn RGB Aura Sync: Đầu cắm RGB Addressable Gen 2 trên bo mạch và đầu cắm Aura RGB cho dải đèn LED RGB, dễ dàng đồng bộ hóa với linh kiện phần cứng hỗ trợ Aura Sync', 'Dòng PRIME B760 được thiết kế để xử lý đa nhân và nhu cầu băng thông từ Bộ vi xử lý Intel® Core™ thế hệ 14, 13 và 12. Bo mạch chủ ASUS B760 cung cấp tất cả các nguyên tắc cơ bản để tăng năng suất làm việc hàng ngày, vì vậy hệ thống của bạn sẽ sẵn sàng hoạt động với nguồn điện ổn định, khả năng tản nhiệt trực quan và các tùy chọn truyền dữ liệu linh hoạt.', 39990000, 5, '2024-07-18 12:00:00', '2024-07-18 12:00:00', 'product_images/card.webp', 'linhkien'),
(15, 'ASUS Prime B760M-K D4', 'Thông số sản phẩm\n- Socket Intel® LGA 1700: sẵn sàng cho bộ xử lý Intel® thế hệ 14, 13 và 12.\n- Kết nối cực nhanh: PCIe 4.0, hai khe M.2 PCIe 4.0, Ethernet Realtek 2.5Gb và USB 3.2 Gen 1 trên bo\n- Tản nhiệt toàn diện: Tản nhiệt VRM, tản nhiệt PCH, cổng cắm quạt hybrid và Fan Xpert\n- Đèn RGB Aura Sync: Đầu cắm RGB Addressable Gen 2 trên bo mạch và đầu cắm Aura RGB cho dải đèn LED RGB, dễ dàng đồng bộ hóa với linh kiện phần cứng hỗ trợ Aura Sync', 'Dòng PRIME B760 được thiết kế để xử lý đa nhân và nhu cầu băng thông từ Bộ vi xử lý Intel® Core™ thế hệ 14, 13 và 12. Bo mạch chủ ASUS B760 cung cấp tất cả các nguyên tắc cơ bản để tăng năng suất làm việc hàng ngày, vì vậy hệ thống của bạn sẽ sẵn sàng hoạt động với nguồn điện ổn định, khả năng tản nhiệt trực quan và các tùy chọn truyền dữ liệu linh hoạt.', 39990000, 5, '2024-07-18 12:00:00', '2024-07-18 12:00:00', 'product_images/card.webp', 'linhkien');

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

SELECT product_id, SUM(quantity) AS total_sold
FROM order_items
GROUP BY product_id;
SELECT id, name, quantity AS stock_remaining
FROM products;
SELECT id, name, quantity AS stock_remaining
FROM products;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
