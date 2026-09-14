-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 14, 2026 at 10:54 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisbudlombok`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `departure_date` date NOT NULL,
  `participants` int UNSIGNED NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('unpaid','paid','expired','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_code`, `user_id`, `trip_id`, `departure_date`, `participants`, `total_price`, `phone`, `notes`, `status`, `snap_token`, `payment_status`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 'BKG-L07MCR', 2, 1, '2026-09-06', 1, 850000.00, '082935729', 'asdasds', 'completed', '70dcdf61-d36d-440f-b3f4-b16b6ad02ee4', 'paid', '2026-09-02 18:04:01', '2026-09-02 18:02:58', '2026-09-02 18:04:16'),
(26, 'BKG-ABFMHY', 2, 1, '2026-09-04', 2, 1700000.00, '081974477372', 'sadasdsad', 'completed', '9ac12bca-00d2-49e9-9ca9-3ca9d0650aa9', 'paid', '2026-09-02 19:29:35', '2026-09-02 19:28:42', '2026-09-03 18:17:04'),
(36, 'BKG-TSDCJN', 2, 1, '2026-09-05', 1, 850000.00, '0812341242', 'jati arya', 'completed', '38aa42c8-fa64-4632-b6bd-19c482961259', 'paid', '2026-09-02 20:06:19', '2026-09-02 20:05:46', '2026-09-03 15:55:24'),
(37, 'BKG-8SMZKU', 2, 1, '2026-09-04', 1, 850000.00, '081891252', 'dengan ini', 'completed', 'c2c86de9-a38a-41c3-b0d5-fdeaa4fa7aa3', 'paid', '2026-09-02 20:12:40', '2026-09-02 20:12:11', '2026-09-03 15:55:20'),
(38, 'BKG-3AMC1F', 2, 1, '2026-09-06', 3, 2550000.00, '081924142', 'jahsdjashds', 'confirmed', '447495c8-64d3-4d95-9be5-5859a84349da', 'paid', '2026-09-03 18:18:31', '2026-09-03 18:17:33', '2026-09-03 18:18:50'),
(39, 'BKG-8LIMQD', 2, 1, '2026-09-30', 1, 850000.00, '98102841242', 'dfsfds', 'confirmed', '3e654baa-5877-401c-a899-cffa3eade60b', 'paid', '2026-09-04 16:08:45', '2026-09-04 16:07:03', '2026-09-04 16:08:52'),
(40, 'BKG-LCFOQO', 2, 1, '2026-09-21', 1, 850000.00, '08197447273', 'asdsdads', 'completed', '6b1c613c-e8e6-487e-8e07-93a64041db8a', 'paid', '2026-09-06 05:17:43', '2026-09-06 05:16:49', '2026-09-06 05:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Rumah Adat', 'rumah-adat', 'Rumah tradisional Suku Sasak dengan arsitektur khas.', NULL, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(2, 'Situs Sejarah', 'situs-sejarah', 'Makam dan peninggalan bersejarah kerajaan Lombok.', NULL, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(3, 'Desa Wisata', 'desa-wisata', 'Desa yang masih mempertahankan tradisi dan kesenian lokal.', NULL, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(4, 'Kerajinan Tradisional', 'kerajinan-tradisional', 'Sentra kerajinan tenun, gerabah, dan anyaman khas Lombok.', NULL, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(5, 'Tari Tradisional', 'tari-tradisional', 'Tari Tradisional', NULL, '2026-09-13 23:08:00', '2026-09-13 23:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `category_id`, `name`, `slug`, `description`, `address`, `latitude`, `longitude`, `thumbnail`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 3, 'Desa Adat Sade', 'desa-adat-sade', 'Kampung Adat Sade – Pesona Budaya Sasak di Lombok, Indonesia 🇮🇩\r\nKampung Adat Sade adalah salah satu destinasi wisata budaya yang menjadi wajah tradisi masyarakat Sasak di Pulau Lombok, Provinsi Nusa Tenggara Barat (West Nusa Tenggara), Indonesia. Kampung ini berada di Desa Rembitan, Kecamatan Pujut, Kabupaten Lombok Tengah, tidak jauh dari kawasan wisata Mandalika.\r\nDi tengah perbukitan Lombok, rumah-rumah tradisional Sasak berdiri dengan arsitektur khas yang sarat makna dan kearifan lokal. Wisatawan dapat mengenal kehidupan masyarakat Sasak, tradisi, kerajinan tenun, serta budaya yang diwariskan dari generasi ke generasi.\r\nSade bukan sekadar tempat untuk dikunjungi, tetapi sebuah cerita tentang budaya, tradisi, dan kehidupan masyarakat Sasak yang tetap hidup hingga hari ini.', 'Rembitan, Pujut, Lombok Tengah, NTB', -8.8845000, 116.2799000, 'destinations/mex6jJCOaD2GmM3v8RvxBlNRxrvlwZ2RUw7vux2k.webp', 1, '2026-09-02 18:01:22', '2026-09-13 23:00:47'),
(2, 3, 'Desa Adat Bayan', 'desa-adat-bayan', 'Desa Adat Bayan – Jejak Budaya Sasak yang Penuh Makna\r\n\r\nDesa Adat Bayan adalah salah satu kawasan budaya yang menyimpan kekayaan tradisi masyarakat Sasak di Pulau Lombok, Nusa Tenggara Barat, Indonesia. Terletak di Kecamatan Bayan, Kabupaten Lombok Utara, desa ini dikenal sebagai salah satu pusat warisan budaya dan tradisi Sasak yang masih dijaga hingga kini.\r\n\r\nDi Bayan, wisatawan dapat menemukan rumah adat tradisional, masjid kuno, tradisi masyarakat, hukum adat, serta kearifan lokal yang diwariskan dari generasi ke generasi. Suasana alam yang asri berpadu dengan kehidupan masyarakat adat, menciptakan pengalaman wisata yang tidak hanya indah, tetapi juga sarat nilai sejarah dan spiritual.\r\n\r\nBayan bukan sekadar destinasi wisata, tetapi sebuah perjalanan untuk mengenal akar budaya Sasak dan kehidupan masyarakat Lombok yang tetap hidup di tengah perkembangan zaman.\r\n\r\n📍 Bayan Traditional Village, North Lombok, West Nusa Tenggara, Indonesia 🇮🇩', 'Bayan, Lombok Utara, NTB', -8.2333000, 116.3667000, 'destinations/yU6AE1yHoZqS1LxSIxtUNTutnj9ix48TLj1HUJoi.webp', 1, '2026-09-02 18:01:22', '2026-09-13 23:02:25'),
(3, 2, 'Makam Selaparang', 'makam-selaparang', 'Makam Selaparang – Jejak Sejarah Kerajaan Islam di Lombok\r\n\r\nMakam Selaparang merupakan salah satu situs bersejarah yang menjadi bagian penting dari perjalanan sejarah Pulau Lombok, Nusa Tenggara Barat, Indonesia. Berada di kawasan Selaparang, Kecamatan Suela, Kabupaten Lombok Timur, tempat ini menjadi salah satu peninggalan yang mengingatkan kita pada kejayaan Kerajaan Selaparang, salah satu kerajaan penting dalam sejarah Lombok.\r\n\r\nKompleks makam ini tidak hanya memiliki nilai sejarah, tetapi juga menjadi tempat yang sarat dengan nilai budaya dan spiritual bagi masyarakat setempat. Di sinilah wisatawan dapat mengenal lebih dekat jejak para tokoh dan leluhur yang memiliki peran dalam perkembangan kehidupan masyarakat Lombok pada masa lalu.\r\n\r\nMakam Selaparang bukan sekadar tempat berziarah, tetapi sebuah pintu untuk mengenal sejarah, budaya, dan perjalanan panjang masyarakat Lombok.\r\n\r\n📍 Selaparang, East Lombok, West Nusa Tenggara, Indonesia 🇮🇩', 'Selaparang, Lombok Timur, NTB', -8.5722000, 116.5083000, 'destinations/fv6QQmBdIiI51vEd6nHZhGP1o3gwFKxoGmFidJJo.webp', 0, '2026-09-02 18:01:22', '2026-09-13 23:05:57'),
(4, 1, 'Rumah Adat Segenter', 'rumah-adat-segenter', 'Kampung tradisional dengan tata letak rumah yang tersusun rapi menghadap arah yang sama.', 'Segenter, Lombok Utara, NTB', -8.3167000, 116.2000000, 'destinations/Yw6qFrbXQhacG3KK3H0ckgO7sXlyIbIRvdUqWIjW.jpg', 1, '2026-09-02 18:01:22', '2026-09-13 23:06:56'),
(5, 4, 'Sentra Tenun Sukarara', 'sentra-tenun-sukarara', 'Desa penghasil kain tenun songket khas Lombok tempat menyaksikan langsung proses menenun.', 'Sukarara, Jonggat, Lombok Tengah, NTB', -8.7167000, 116.2667000, NULL, 0, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(6, 5, 'Tari Gandrung - Lenek', 'tari-gandrung-lenek', 'Tari Gandrung Lenek – Pesona Seni Sasak dari Lombok hingga Jepang 🇮🇩🇯🇵\r\n\r\nTari Gandrung Lenek adalah salah satu kesenian tradisional khas Desa Lenek, Kabupaten Lombok Timur, Nusa Tenggara Barat, Indonesia. Tarian ini merupakan bagian dari kekayaan budaya masyarakat Sasak yang memadukan gerak tari, musik tradisional, dan nilai-nilai kehidupan masyarakat setempat.\r\n\r\nDengan gerakan yang dinamis, ekspresi yang khas, serta iringan musik tradisional Sasak, Tari Gandrung Lenek menjadi salah satu kesenian yang memiliki daya tarik tersendiri. Keunikan budaya ini bahkan telah membawa Tari Gandrung Lenek tampil di Jepang, memperkenalkan seni dan identitas budaya Lombok kepada masyarakat internasional.\r\n\r\nDari sebuah desa di Lombok Timur, Tari Gandrung Lenek melangkah ke panggung dunia—membawa cerita, keindahan, dan kebanggaan budaya Sasak.', 'CGP3+WHQ, Lenek Daya, Aikmel, East Lombok Regency, West Nusa Tenggara 83653', -8.5626487, 116.5039290, 'destinations/z2QqbsvQVNLw0RPYIpZJ2Pa2Uf47UV6Ejoy4NIvd.jpg', 1, '2026-09-13 23:12:44', '2026-09-13 23:12:44'),
(7, 1, 'Kampung Adat Sugian', 'kampung-adat-sugian', 'Kampung Adat Sugian – Pesona Tradisi Sasak di Lombok Timur\r\n\r\nKampung Adat Sugian merupakan salah satu kawasan yang menyimpan kekayaan budaya dan kearifan lokal masyarakat Sasak di Pulau Lombok, Nusa Tenggara Barat, Indonesia. Berada di Desa Sugian, Kecamatan Sambelia, Kabupaten Lombok Timur, kawasan ini menawarkan suasana kehidupan masyarakat yang masih dekat dengan tradisi dan lingkungan alamnya.\r\n\r\nDi Sugian, wisatawan dapat mengenal kehidupan masyarakat Sasak, tradisi leluhur, nilai-nilai kebersamaan, serta kearifan lokal yang diwariskan dari generasi ke generasi. Perpaduan antara budaya, kehidupan masyarakat, dan keindahan alam menjadikan Sugian memiliki daya tarik tersendiri sebagai destinasi wisata berbasis budaya.\r\n\r\nSugian bukan hanya sebuah tempat untuk dikunjungi, tetapi sebuah ruang untuk mengenal kehidupan, tradisi, dan warisan budaya Sasak yang tetap tumbuh bersama masyarakatnya.', 'Sugian, Sambelia, Kabupaten Lombok Timur, Nusa Tenggara Barat', -8.3380607, 116.6910910, NULL, 0, '2026-09-13 23:22:14', '2026-09-13 23:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `destination_images`
--

CREATE TABLE `destination_images` (
  `id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_01_000001_create_categories_table', 1),
(5, '2025_08_01_000002_create_destinations_table', 1),
(6, '2025_08_01_000003_create_destination_images_table', 1),
(7, '2025_08_01_000004_create_trips_table', 1),
(8, '2025_08_01_000005_create_trip_itineraries_table', 1),
(9, '2025_08_01_000006_create_reviews_table', 1),
(10, '2025_08_01_000007_add_role_to_users_table', 1),
(11, '2026_08_16_000842_create_bookings_table', 1),
(12, '2026_08_16_235547_create_notifications_table', 1),
(13, '2026_09_02_020116_create_product_categories_table', 1),
(14, '2026_09_02_020137_create_product_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0cf01cf4-32a9-4187-b685-491104a5380c', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-3AMC1F telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-3AMC1F\",\"status\":\"confirmed\"}', '2026-09-03 18:19:02', '2026-09-03 18:18:50', '2026-09-03 18:19:02'),
('11fb85ff-1183-4a2c-be8e-f363390ad5c0', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-8LIMQD telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-8LIMQD\",\"status\":\"confirmed\"}', '2026-09-04 16:09:29', '2026-09-04 16:08:52', '2026-09-04 16:09:29'),
('1dcbb1e0-9369-4785-a921-802db70cb0ee', 'App\\Notifications\\BookingCreatedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Berhasil Dibuat!\",\"message\":\"Kode booking Anda BKG-8SMZKU menunggu pembayaran.\",\"booking_code\":\"BKG-8SMZKU\"}', '2026-09-02 20:12:27', '2026-09-02 20:12:15', '2026-09-02 20:12:27'),
('1f68fee4-44cf-4d99-bad3-11bf54c67676', 'App\\Notifications\\BookingCreatedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Berhasil Dibuat!\",\"message\":\"Kode booking Anda BKG-3AMC1F menunggu pembayaran.\",\"booking_code\":\"BKG-3AMC1F\"}', '2026-09-03 18:17:56', '2026-09-03 18:17:43', '2026-09-03 18:17:56'),
('2ffaa64e-5f6a-4879-aa5c-25064daa3a35', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-3AMC1F telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-3AMC1F\",\"status\":\"confirmed\"}', '2026-09-03 18:18:42', '2026-09-03 18:18:31', '2026-09-03 18:18:42'),
('47708242-6fb2-4d2e-b32e-3889876268ad', 'App\\Notifications\\BookingCreatedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Berhasil Dibuat!\",\"message\":\"Kode booking Anda BKG-8LIMQD menunggu pembayaran.\",\"booking_code\":\"BKG-8LIMQD\"}', '2026-09-04 16:09:29', '2026-09-04 16:07:13', '2026-09-04 16:09:29'),
('60816e03-7153-4c2c-9a81-00e20f7a27ae', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-8SMZKU telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-8SMZKU\",\"status\":\"confirmed\"}', '2026-09-02 20:12:49', '2026-09-02 20:12:40', '2026-09-02 20:12:49'),
('771a44dd-00e1-49d0-97e1-9b06eeb63372', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-3AMC1F telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-3AMC1F\",\"status\":\"confirmed\"}', '2026-09-03 18:19:02', '2026-09-03 18:18:51', '2026-09-03 18:19:02'),
('82847602-8bc3-48c5-9586-80dbac34697f', 'App\\Notifications\\BookingCreatedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Berhasil Dibuat!\",\"message\":\"Kode booking Anda BKG-TSDCJN menunggu pembayaran.\",\"booking_code\":\"BKG-TSDCJN\"}', '2026-09-02 20:06:01', '2026-09-02 20:05:51', '2026-09-02 20:06:01'),
('85f2be51-23c2-4449-a8b4-b9785e5d6076', 'App\\Notifications\\BookingCreatedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Berhasil Dibuat!\",\"message\":\"Kode booking Anda BKG-LCFOQO menunggu pembayaran.\",\"booking_code\":\"BKG-LCFOQO\"}', '2026-09-06 05:17:04', '2026-09-06 05:16:55', '2026-09-06 05:17:04'),
('af74cd91-e6f3-4f44-a699-61e3417e330b', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-8SMZKU telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-8SMZKU\",\"status\":\"confirmed\"}', '2026-09-02 20:13:14', '2026-09-02 20:12:58', '2026-09-02 20:13:14'),
('c93b4020-50d6-4804-9ed8-85f0c1551972', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-8LIMQD telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-8LIMQD\",\"status\":\"confirmed\"}', '2026-09-04 16:09:29', '2026-09-04 16:08:45', '2026-09-04 16:09:29'),
('d3c2e9c5-86e7-4205-b160-9fdc3fddd84a', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-LCFOQO telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-LCFOQO\",\"status\":\"confirmed\"}', '2026-09-06 05:18:12', '2026-09-06 05:17:43', '2026-09-06 05:18:12'),
('e7117316-76a1-4629-bafc-42aa308d56e3', 'App\\Notifications\\BookingConfirmedNotification', 'App\\Models\\User', 2, '{\"title\":\"Pesanan Dikonfirmasi! \\ud83c\\udf89\",\"message\":\"Pembayaran untuk kode booking BKG-LCFOQO telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!\",\"booking_code\":\"BKG-LCFOQO\",\"status\":\"confirmed\"}', '2026-09-06 05:18:12', '2026-09-06 05:17:55', '2026-09-06 05:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `name`, `slug`, `description`, `price`, `thumbnail`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Minyak Gosok Tradisional Sasak', 'minyak-gosok-tradisional-sasak', 'Minyak herbal tradisional yang diracik dari rempah-rempah pilihan khas Lombok untuk meredakan pegal linu.', 45000.00, NULL, 1, 1, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(2, 2, 'Kain Tenun Sasak Motif Lumbung', 'kain-tenun-sasak-motif-lumbung', 'Kain tenun tangan asli buatan perajin lokal Sukarara dengan motif lumbung padi khas Lombok.', 250000.00, NULL, 1, 1, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(3, 2, 'Souvenir Gerabah Hias', 'souvenir-gerabah-hias', 'Kerajinan tanah liat hiasan meja dengan bentuk unik khas sentra gerabah Banyumulek.', 75000.00, NULL, 0, 1, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(4, 1, 'Minyak Tengkining Kanang', 'minyak-tengkining-kanang', 'Obat Tradisional yang dibuat dengan segala macam tumbuhan medis', 500000.00, 'products/wVV9XzFHLVwDuvpPuR3rlRfPybBRQq6bTEz4BaZ0.png', 1, 1, '2026-09-04 16:16:35', '2026-09-04 16:16:45'),
(5, NULL, 'Bata Merah', 'bata-merah', 'Bata merah', 750000.00, 'products/IHOcSy7bfDEGiBI24UdePRwTiP007UV3Zef4aqi4.webp', 1, 1, '2026-09-06 05:00:34', '2026-09-06 05:00:34'),
(6, 6, 'Buku Sejarah Sasak', 'buku-sejarah-sasak', 'asdads,kjdbaskjdbaskjhbds', 150000.00, 'products/sfrbZHh5rDF3iTEq0GBDHfVDf2w3dTEif9ihe1cv.jpg', 1, 1, '2026-09-06 05:15:31', '2026-09-06 05:15:31'),
(8, NULL, 'asdas', 'asdas', 'adsad', 60000.00, 'products/YVP5jAqCAa90HjaccBVLADNOr2QELitoVdJCX5wd.png', 0, 1, '2026-09-06 16:50:40', '2026-09-06 16:50:40'),
(9, NULL, 'hdfhf', 'hdfhf', 'jhjfdhf', 3000.00, 'products/jBN3HP3praWfOJc9i4QT6oTHCESCSDwd788Y9xjK.webp', 0, 1, '2026-09-06 16:51:02', '2026-09-06 16:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Minyak & Jamu Tradisional', 'minyak-jamu-tradisional', 'Minyak gosok dan ramuan herbal warisan leluhur Sasak.', '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(2, 'Kerajinan & Cinderamata', 'kerajinan-cinderamata', 'Produk kerajinan tangan, tenun, dan oleh-oleh khas Lombok.', '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(6, 'Buku Sejarah, Budaya & Peradaban Sasak.', 'buku-sejarah-budaya-peradaban-sasak', 'Jhdjaskhd sjbjdkabjdbsajkds', '2026-09-06 05:14:46', '2026-09-06 16:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `reviewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `reviewable_type`, `reviewable_id`, `name`, `rating`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 2, 'App\\Models\\Destination', 1, 'Jati Arya', 5, 'Kerennnnnnnn', 1, '2026-09-04 16:11:36', '2026-09-04 16:11:46'),
(2, 2, 'App\\Models\\Destination', 2, 'Jati Arya', 5, 'mantapppppppp', 1, '2026-09-04 16:12:58', '2026-09-04 16:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5klWqdeW5Ny9VVE8XjnYCMPpcNpTViuWWTzb2ZR5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'eyJfdG9rZW4iOiI4SmVyQTdMUmd2MFROOU5ra3JwZlhPRVp0a1NySTBhVWFNdlV4TlQ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3dpc2F0YWJ1ZGF5YWxvbWJvay50ZXN0XC9hZG1pblwvY2F0ZWdvcmllc1wvY3JlYXRlIiwicm91dGUiOiJhZG1pbi5jYXRlZ29yaWVzLmNyZWF0ZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1789370748),
('pw3NgoSh5s6wvLHkh1Uq357qI7jHL6hAk5F7gwhN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'eyJfdG9rZW4iOiJYeElUdnJLQkJNNGlaamFHVEZ4Mnl1M3BPSWZHeEo5VHMxaHhTdmVwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3dpc2F0YWJ1ZGF5YWxvbWJvay50ZXN0XC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1789368972),
('ZQ3sJ67ZXjzme9KnHHZv8PAfltOfM4tJ4kjKrjUO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkR1JsZE5GcWtuMHVZUVQ2NzdPN05CWjYyUkhGaklCeElLZTk2cVJ3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3dpc2F0YWJ1ZGF5YWxvbWJvay50ZXN0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1789370027);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `duration_days` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `duration_nights` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `name`, `slug`, `description`, `price`, `duration_days`, `duration_nights`, `thumbnail`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Jelajah Budaya Sasak 2 Hari', 'jelajah-budaya-sasak-2-hari', 'Paket 2 hari 1 malam menjelajahi desa adat, situs sejarah, dan sentra kerajinan khas Suku Sasak.', 850000.00, 2, 1, 'trips/ONNQodggaEmvQhwWV9AJuuMyq0KkB38yPaqG5NGY.png', 1, '2026-09-02 18:01:22', '2026-09-04 16:17:23'),
(2, 'Lombok Travel 3D2N', 'lombok-travel-3d2n', 'dsadsadads', 150000.00, 3, 2, 'trips/Uoc2TYKK3O2ECH9imHwISmK0Lx8ZTpr997ZcIhxE.webp', 1, '2026-09-06 16:32:37', '2026-09-06 16:44:27'),
(3, 'Travel 2D1N', 'travel-2d1n', 'adfsfsf', 50000.00, 2, 1, 'trips/0aRiI5VZ90oGA8stlVkScafE12qHM9vOIpke92wg.webp', 1, '2026-09-06 16:52:03', '2026-09-06 16:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `trip_itineraries`
--

CREATE TABLE `trip_itineraries` (
  `id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED DEFAULT NULL,
  `day_number` tinyint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_itineraries`
--

INSERT INTO `trip_itineraries` (`id`, `trip_id`, `destination_id`, `day_number`, `title`, `description`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 1, 'Kunjungan ke Desa Adat Sade', NULL, '2026-09-04 16:17:23', '2026-09-04 16:17:23'),
(5, 1, 5, 2, 'Belajar menenun di Sukarara', NULL, '2026-09-04 16:17:23', '2026-09-04 16:17:23'),
(6, 1, 3, 3, 'Ziarah dan wisata sejarah di Makam Selaparang', NULL, '2026-09-04 16:17:23', '2026-09-04 16:17:23'),
(13, 2, 4, 1, 'Kunjungan Adat', 'ggsdvd', '2026-09-06 16:44:27', '2026-09-06 16:44:27'),
(14, 2, 2, 2, 'Kunjungan Religi', 'fzdzxv', '2026-09-06 16:44:27', '2026-09-06 16:44:27'),
(15, 2, 3, 3, 'Ziarah dan wisata sejarah di Makam Selaparang', 'vzxv', '2026-09-06 16:44:27', '2026-09-06 16:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `google_id`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Wisata Budaya Lombok', 'admin@wisatabudayalombok.id', 'admin', NULL, NULL, '2026-09-02 18:01:22', '$2y$12$mCRMBiC/9z/fVxhhnJxw3Ou9j7BVomZIDwCbv5kfk7wiXE9qZVSNq', NULL, '2026-09-02 18:01:22', '2026-09-02 18:01:22'),
(2, 'Jati Arya', 'jazlyyy04@gmail.com', 'user', NULL, NULL, NULL, '$2y$12$MXk6Xzo2TPCStjJqrZzNU.cbz/nXs2fczOrCKvUQPy12TOaI02pcW', NULL, '2026-09-02 18:02:29', '2026-09-03 17:59:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_code_unique` (`booking_code`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`),
  ADD KEY `destinations_category_id_foreign` (`category_id`);

--
-- Indexes for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_images_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trips_slug_unique` (`slug`);

--
-- Indexes for table `trip_itineraries`
--
ALTER TABLE `trip_itineraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_itineraries_trip_id_foreign` (`trip_id`),
  ADD KEY `trip_itineraries_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `destination_images`
--
ALTER TABLE `destination_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trip_itineraries`
--
ALTER TABLE `trip_itineraries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `destination_images`
--
ALTER TABLE `destination_images`
  ADD CONSTRAINT `destination_images_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trip_itineraries`
--
ALTER TABLE `trip_itineraries`
  ADD CONSTRAINT `trip_itineraries_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `trip_itineraries_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
