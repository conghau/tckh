-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tckh
CREATE DATABASE IF NOT EXISTS `tckh` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tckh`;


-- Dumping structure for table tckh.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tckh.migrations: ~3 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2013_05_23_114020_create_conversations_table', 1),
	('2013_05_23_114039_create_messages_table', 1),
	('2013_05_24_140404_create_participants_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table tckh.web_config
CREATE TABLE IF NOT EXISTS `web_config` (
  `cfgname` varchar(50) NOT NULL,
  `cfgvalue` varchar(500) DEFAULT NULL,
  `modname` varchar(50) DEFAULT NULL,
  `modtext` varchar(50) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `datatype` varchar(50) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`cfgname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_config: ~27 rows (approximately)
/*!40000 ALTER TABLE `web_config` DISABLE KEYS */;
INSERT INTO `web_config` (`cfgname`, `cfgvalue`, `modname`, `modtext`, `descr`, `datatype`, `updated_at`) VALUES
	('app.ghostscript_exe', 'C:\\Program Files\\gs\\gs9.15\\bin\\gswin64.exe', 'app', 'Hệ thống', 'Đường dẫn đến file thực thi Ghostscript (trên server)', 'string', NULL),
	('app.html_allow_tag', '<br/><br /><br>', 'app', 'Hệ thống', 'Tags HTML được phép dùng', 'string', NULL),
	('app.log_page_size', '20', 'app', 'Hệ thống', 'Số mẫu tin Log hiển thị khi phân trang', 'number', NULL),
	('app.my_session_name', 'htttnb_session', 'app', 'Hệ thống', 'Tên Session trên serverver', 'string', NULL),
	('app.site_title', 'Tạp chí khoa học - Trường Đại học Mở Tp.HCM', 'app', 'Hệ thống', 'Tiêu đề Website', 'string', NULL),
	('app.trim_login_username', '@ou.edu.vn', 'app', 'Hệ thống', 'Chuỗi loại bỏ trong tên đăng nhập khi login', 'string', NULL),
	('app.user_master_pass', 'Password!@', 'app', 'Hệ thống', 'Mật khẩu dùng để đăng nhập vào tất cả tài khoản của User', 'string', NULL),
	('app.use_logs', '0', 'app', 'Hệ thống', 'Ghi logs hệ thống', 'bool', NULL),
	('frontpage.news_items_in_cat', '3', 'frontpage', 'Trang chủ', 'Số tin hiển thị tại mỗi Cat ở trang chủ', 'number', NULL),
	('frontpage.news_items_in_cat_more', '0', 'frontpage', 'Trang chủ', 'Số tin hiển thị dạng thu gọn ở mỗi Cat ở trang chủ', 'number', NULL),
	('gapp.email_domain', '@ou.edu.vn', 'gapp', 'Google', 'Email domain', 'string', 1422876974),
	('menus.list_page_size', '20', 'menus', 'Menu', 'Số Menu hiển thị trên trang (Admin paging)', 'number', NULL),
	('news.default_daduyet', '1', 'news', 'Tin tức - Thông báo', 'Giá trị duyệt mặc định khi đăng bài viết (1=duyệt, 0=không duyệt)', 'number', NULL),
	('news.default_published', '1', 'news', 'Tin tức - Thông báo', 'Giá trị publish mặc định khi đăng bài viết (1=publish, 0=unpublish)', 'number', NULL),
	('news.list_page_size', '20', 'news', 'Tin tức - Thông báo', 'Số tin hiển thị ở 1 trang (Admin paging)', 'number', NULL),
	('news.more_article_items', '5', 'news', 'Tin tức - Thông báo', 'Số bài viết hiển thị tiêu đề tiếp theo bài viết chính', 'number', NULL),
	('news.strip_tags_allow', '<br><br/><br />', 'news', 'Tin tức - Thông báo', 'Tags HTML được phép dùng', 'string', NULL),
	('news_common_cat_articleitems', '5', 'news', 'Tin tức - Thông báo', 'Số tin hiển thị khi xem tin trong 1 Danh mục', 'number', NULL),
	('pages.list_page_size', '20', 'pages', 'Pages', 'Số trang hiển thị trên 1 trang (Admin paging)', 'number', NULL),
	('pages.strip_tags_allow', '<br><br/><br />', 'pages', 'Pages', 'Tags HTML được phép sử dụng', 'string', NULL),
	('session.cookie', 'htttnbou_session', 'app', 'Hệ thống', 'Tên Cookie', 'string', NULL),
	('tapchikhoahoc.quantam_paging_size', '10', 'tckh', 'Tạp chí khoa học', 'Số mẫu tin bài viết được quan tâm nhất', 'number', NULL),
	('tapchikhoahoc.search_paging_size', '1', 'tckh', 'Tạp chí khoa học', 'Số mẫu tin hiển thị khi tìm tạp chí', 'number', NULL),
	('tapchikhoahoc.tapchimoinhat_paging_size', '3', 'tckh', 'Tạp chí khoa học', 'Số tạp chí mới nhất hiển thị', 'number', NULL),
	('tckh.files_dir', 'D:\\TapChiKhoaHoc2015\\app\\storage\\tckh', 'tckh', 'Tạp chí khoa học', 'Thư mục lưu file upload của TCKH', 'string', NULL),
	('tckh.list_sotapchi_pagesize', '20', 'tckh', 'Tạp chí khoa học', 'Số mẫu tin phân trang (Số tạp chí)', 'number', NULL),
	('userman.list_page_size', '20', 'app', 'Hệ thống', 'Số mẫu tin User khi phân trang', 'number', NULL);
/*!40000 ALTER TABLE `web_config` ENABLE KEYS */;


-- Dumping structure for table tckh.web_counter
CREATE TABLE IF NOT EXISTS `web_counter` (
  `visitor` int(11) DEFAULT NULL,
  `pageview` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_counter: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_counter` DISABLE KEYS */;
INSERT INTO `web_counter` (`visitor`, `pageview`) VALUES
	(50266, 114652);
/*!40000 ALTER TABLE `web_counter` ENABLE KEYS */;


-- Dumping structure for table tckh.web_menus
CREATE TABLE IF NOT EXISTS `web_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `menugroup` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `linktarget` varchar(20) DEFAULT NULL,
  `is_hidden` tinyint(3) unsigned DEFAULT NULL,
  `orderno` int(11) DEFAULT NULL,
  `pageid` int(11) DEFAULT NULL,
  `allow_perms` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_menus: ~12 rows (approximately)
/*!40000 ALTER TABLE `web_menus` DISABLE KEYS */;
INSERT INTO `web_menus` (`id`, `parent_id`, `menugroup`, `title`, `link`, `linktarget`, `is_hidden`, `orderno`, `pageid`, `allow_perms`) VALUES
	(5, NULL, NULL, 'Trang chủ', '/', '', NULL, -10, NULL, '*'),
	(14, NULL, NULL, 'Giới thiệu', '#', '', NULL, 1, NULL, '*'),
	(15, NULL, NULL, 'Qui định gởi bài', 'pages/view/4-qui-dinh-goi-bai', '', NULL, 6, 4, '*'),
	(18, NULL, NULL, 'Liên hệ', 'pages/view/5-lien-he', '', NULL, 20, 5, '*'),
	(21, 14, NULL, 'Qui chế hoạt động', 'pages/view/1-qui-che-hoat-dong', '', NULL, 0, 1, '*'),
	(22, 14, NULL, 'Lịch sử phát triển', 'pages/view/2-lich-su-phat-trien', '', NULL, 1, 2, '*'),
	(23, 14, NULL, 'Hội đồng biên tập', 'pages/view/3-hoi-dong-bien-tap', '', NULL, 2, 3, '*'),
	(24, NULL, NULL, 'Đặt mua', 'pages/view/6-dat-mua', '', NULL, 10, NULL, '*'),
	(25, NULL, NULL, 'Tin tức', 'news/viewartilces/5', '', NULL, -9, NULL, '*'),
	(26, NULL, NULL, 'Bài viết', '#', '', NULL, 9, NULL, '*'),
	(27, 26, NULL, 'Bài viết từ năm 2005-2013', 'http://www.ou.edu.vn/tapchikh', '', NULL, 1, NULL, '*'),
	(28, 26, NULL, 'Bài viết từ năm 2014', 'pages/view/7-bai-viet-tu-nam-2014', '', NULL, 2, NULL, '*');
/*!40000 ALTER TABLE `web_menus` ENABLE KEYS */;


-- Dumping structure for table tckh.web_migrations
CREATE TABLE IF NOT EXISTS `web_migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_migrations` ENABLE KEYS */;


-- Dumping structure for table tckh.web_news_articles
CREATE TABLE IF NOT EXISTS `web_news_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  `summary_text` varchar(1000) DEFAULT NULL,
  `summary_html` varchar(1000) DEFAULT NULL,
  `sticky` tinyint(3) unsigned DEFAULT NULL,
  `post_date` int(11) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `daduyet` tinyint(3) unsigned DEFAULT '1',
  `user_duyet` int(11) DEFAULT NULL,
  `ngay_duyet` int(11) DEFAULT NULL,
  `published` tinyint(3) unsigned DEFAULT '1',
  `ngay_published` int(11) DEFAULT NULL,
  `user_published` int(11) DEFAULT NULL,
  `hot` tinyint(3) unsigned DEFAULT '0',
  `notshowsummaryindetail` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_web_news_articles_web_news_categories` (`cat_id`),
  CONSTRAINT `web_news_articles_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `web_news_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_news_articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_news_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_news_articles` ENABLE KEYS */;


-- Dumping structure for table tckh.web_news_articles_full
CREATE TABLE IF NOT EXISTS `web_news_articles_full` (
  `article_id` int(11) NOT NULL,
  `full_content_text` longtext,
  `full_content_html` longtext,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  CONSTRAINT `web_news_articles_full_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `web_news_articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_news_articles_full: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_news_articles_full` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_news_articles_full` ENABLE KEYS */;


-- Dumping structure for table tckh.web_news_categories
CREATE TABLE IF NOT EXISTS `web_news_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `catname` varchar(100) DEFAULT NULL,
  `catdesc` varchar(200) DEFAULT NULL,
  `childcount` int(11) DEFAULT NULL,
  `orderno` int(11) DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_news_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_news_categories` DISABLE KEYS */;
INSERT INTO `web_news_categories` (`id`, `parent_id`, `catname`, `catdesc`, `childcount`, `orderno`, `create_user`, `create_date`) VALUES
	(5, 0, 'Tin tức - Sự kiện', '', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `web_news_categories` ENABLE KEYS */;


-- Dumping structure for table tckh.web_pages
CREATE TABLE IF NOT EXISTS `web_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(200) DEFAULT NULL,
  `pagetitle` varchar(200) DEFAULT NULL,
  `pagetitle_seo` varchar(200) DEFAULT NULL,
  `pagecontent` longtext,
  `pagecontent_text` longtext,
  `create_at` int(11) DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `allow_perms` longtext,
  `page_is_hidden` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_pages: ~7 rows (approximately)
/*!40000 ALTER TABLE `web_pages` DISABLE KEYS */;
INSERT INTO `web_pages` (`id`, `pagename`, `pagetitle`, `pagetitle_seo`, `pagecontent`, `pagecontent_text`, `create_at`, `create_user`, `update_at`, `update_user`, `allow_perms`, `page_is_hidden`) VALUES
	(1, 'Qui chế hoạt động', 'Qui chế hoạt động', '1-qui-che-hoat-dong', '<table border="0" cellpadding="1" cellspacing="1" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="text-align:center; vertical-align:top; width:250px">BỘ GIÁO DỤC &amp; ĐÀO TẠO</td>\r\n			<td style="text-align:center"><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align:center"><strong>TRƯỜNG <u>ĐẠI HỌC MỞ</u> TP.HCM</strong></td>\r\n			<td style="text-align:center"><strong><u>Độc lập – Tự do – Hạnh phúc</u></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1 style="text-align:center">QUY CHẾ</h1>\r\n\r\n<h2 style="text-align:center">Hoạt động Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh</h2>\r\n\r\n<p style="text-align:center"><strong><em>(Ban hành kèm theo Quyết định số 880 /QĐ-ĐHM, ngày 22 tháng 08 năm 2014 của Trường Đại Mở Tp.HCM) </em></strong></p>\r\n\r\n<p style="margin-left:.5pt">&nbsp;</p>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương I</strong> <strong>QUY ĐỊNH CHUNG</strong></h2>\r\n\r\n<h2>Điều 1. Phạm vi điều chỉnh và đối tượng áp dụng &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Quy chế này quy định về hoạt động của Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh (sau đây gọi là Tạp chí Khoa học) bao gồm các quy định về tổ chức bộ máy, phản biện, tác giả, đăng bài, xét duyệt, lưu trữ, sử dụng bài báo, kinh phí hoạt động, khen thưởng và xử lý vi phạm trong hoạt động của Tạp chí Khoa học.&nbsp;</li>\r\n	<li>Quy chế này áp dụng đối với Ban Biên tập, Hội đồng biên tập, Ban Thư ký tòa soạn, các phản biện, các cộng tác viên và các tác giả có bài báo gửi đăng trên Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh.</li>\r\n</ol>\r\n\r\n<h2>Điều 2. Mục đích, đối tượng phục vụ</h2>\r\n\r\n<ol>\r\n	<li>Tạp chí Khoa học nhằm góp phần xây dựng và phát triển đội ngũ cán bộ, giảng viên, những người làm công tác khoa học; góp phần đẩy mạnh các hoạt động nghiên cứu khoa học, học thuật đáp ứng mục tiêu đào tạo, nghiên cứu khoa học và dịch vụ xã hội của Nhà trường.</li>\r\n	<li>Đối tượng phục vụ là những người làm công tác khoa học, giảng viên, nghiên cứu sinh, học viên cao học, sinh viên, cán bộ quản lý và bạn đọc có quan tâm.&nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 3. Tên gọi, trụ sở, định kỳ xuất bản và phát hành &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Tên gọi, trụ sở: &nbsp;</li>\r\n</ol>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tên tiếng Việt: Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí minh.&nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tên tiếng Anh: Journal of Science Ho Chi Minh City Open University&nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trụ sở tòa soạn: Trường Đại học Mở Thành phố Hồ Chí Minh &nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Số 97, Võ Văn Tần, Phường 6, Quận 3, TP. Hồ Chí Minh &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Điện thoại: 08.39300210, 39304469&nbsp; Email: <u>tapchikhoahoc@ou.edu.vn</u>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website: <u>www.ou.edu.vn</u>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Thể thức xuất bản: &nbsp;</li>\r\n</ol>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ngôn ngữ thể hiện: tiếng Việt và tiếng Anh; &nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kỳ hạn xuất bản: 1 năm /10 kỳ: Gồm 6 kỳ tiếng Việt và 4 kỳ tiếng Anh;&nbsp;&nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Khuôn khổ: 20cm x 27cm;&nbsp;</p>\r\n\r\n<p style="margin-left:34.35pt">Số trang: 80-150 trang;&nbsp;</p>\r\n\r\n<p style="margin-left:34.35pt">Số lượng: 500-1000 bản/kỳ. &nbsp;</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nơi in: Thành phố Hồ Chí Minh &nbsp;</p>\r\n\r\n<ol>\r\n	<li>Nộp lưu chiểu và phát hành&nbsp;</li>\r\n</ol>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>Nộp lưu chiểu tại Sở Thông tin và Truyền thông Thành phố Hồ Chí Minh,</li>\r\n</ol>\r\n\r\n<p style="margin-left:-.25pt">Cục Báo chí – Bộ Thông tin và Truyền thông, Thư viện Quốc Gia Việt Nam;</p>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>Phạm vi phát hành trong cả nước; &nbsp;</li>\r\n	<li>Đăng tiêu đề, tóm tắt bài báo và toàn văn các bài báo (sau một tháng phát</li>\r\n</ol>\r\n\r\n<p style="margin-left:-.25pt">hành bản in) trên website của Trường Đại học Mở Thành phố Hồ Chí Minh. &nbsp;</p>\r\n\r\n<h2>Điều 4. Nội dung xuất bản &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Tạp chí Khoa học đăng tải các bài báo khoa học; công bố các công trình nghiên cứu khoa học; thông tin các kết quả nghiên cứu khoa học; trao đổi các nội dung mang tính học thuật, quan điểm khoa học, phương pháp tiếp cận các vấn đề khoa học mới; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước trong các lĩnh vực mang tính định kỳ theo kế hoạch được Hiệu trưởng phê duyệt;</li>\r\n	<li>Tạp chí Khoa học có thể xuất bản các số theo các chủ đề bằng tiếng Việt hoặc tiếng Anh theo Giấy phép xuất bản; &nbsp;</li>\r\n	<li>Tạp chí Khoa học đăng các giới thiệu, quảng cáo theo quy định, phù hợp với giấy phép xuất bản và theo sự phê duyệt của Tổng biên tập.</li>\r\n</ol>\r\n\r\n<h2>Điều 5. Nguyên tắc hoạt động &nbsp;</h2>\r\n\r\n<p style="margin-left:-.75pt">Tạp chí Khoa học hoạt động theo quy định của Luật Báo chí, Luật xuất bản, các quy định của Trường Đại học Mở Thành phố Hồ Chí Minh và các quy định của Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí Minh. Các thành viên của Ban biên tập, Hội đồng biên tập, Ban thư ký, các phản biện, các cộng tác viên và các tác giả có bài báo gửi đăng trong Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh có trách nhiệm thực hiện các quy định trên và theo sự phân công, giao nhiệm vụ của Tổng biên tập. &nbsp;</p>\r\n\r\n<h2 style="text-align:center"><strong>Chương II TỔ CHỨC BỘ MÁY &nbsp;</strong></h2>\r\n\r\n<h2><strong>Điều 6. Cơ cấu tổ chức</strong></h2>\r\n\r\n<p style="margin-left:-.75pt">Cơ cấu tổ chức của Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí Minh gồm: &nbsp;</p>\r\n\r\n<ol>\r\n	<li>Tổng biên tập; &nbsp;</li>\r\n	<li>Phó tổng biên tập; &nbsp;</li>\r\n	<li>Hội đồng biên tập; &nbsp;4. Ban thư ký tòa soạn;</li>\r\n</ol>\r\n\r\n<p style="margin-left:34.35pt">5. Cộng tác viên.&nbsp;</p>\r\n\r\n<h2>Điều 7. Tổng biên tập&nbsp; &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Tổng biên tập chịu trách nhiệm thực hiện việc lãnh đạo, điều hành và quản lý Tạp chí Khoa học về mọi mặt, đảm bảo thực hiện tôn chỉ, mục đích của Tạp chí Khoa học; chịu trách nhiệm trước Hiệu trưởng và pháp luật về hoạt động của Tạp chí Khoa học;</li>\r\n	<li>Chịu trách nhiệm xuất bản các ấn phẩm của Tạp chí Khoa học theo quy định của Luật Báo chí, Luật Xuất bản và chỉ đạo của Hiệu trưởng; &nbsp;</li>\r\n	<li>Tổng biên tập là người duyệt cuối cùng các ấn phẩm Tạp chí Khoa học trước khi in và quyết định nộp lưu chiểu, phát hành;&nbsp;</li>\r\n	<li>Trình Hiệu trưởng phê duyệt kế hoạch xuất bản Tạp chí Khoa học định kỳ;</li>\r\n	<li>Là người ký kết, nghiệm thu các hợp đồng in ấn và phát hành Tạp chí Khoa học theo sự ủy quyền của Hiệu trưởng. &nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 8. Phó tổng biên tập &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Giúp Tổng biên tập lãnh đạo, điều hành và quản lý Tạp chí Khoa học; chịu trách nhiệm trước Hiệu trưởng và Tổng biên tập về các hoạt động của Tạp chí Khoa học;&nbsp;</li>\r\n	<li>Giúp Tổng biên tập trong việc quản lý xuất bản Tạp chí Khoa học và xét duyệt các ấn phẩm Tạp chí Khoa học theo sự phân công của Tổng biên tập;</li>\r\n	<li>Giúp Tổng biên tập thực hiện kế hoạch xuất bản Tạp chí Khoa học theo kế hoạch và theo phê duyệt của Hiệu trưởng. &nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 9. Hội đồng biên tập &nbsp;</h2>\r\n\r\n<p style="margin-left:-.75pt">Hội đồng biên tập có trách nhiệm biên tập về mặt chuyên môn, học thuật, nội dung cũng như hình thức xuất bản của Tạp chí Khoa học:</p>\r\n\r\n<ol>\r\n	<li>Đề xuất kế hoạch xuất bản, đề xuất nội dung và hình thức của Tạp chí Khoa học;</li>\r\n	<li>Đề xuất phản biện; theo dõi quá trình sửa chữa của tác giả, biên tập các bài gửi đăng theo đúng tôn chỉ mục đích, thể lệ của Tạp chí Khoa học và chịu trách nhiệm về nội dung biên tập trước khi Tổng biên tập duyệt đăng;</li>\r\n	<li>Đề xuất phân loại và xếp hạng bài báo khoa học; xem xét và có ý kiến về nội dung và hình thức bài báo;&nbsp;</li>\r\n	<li>Biên tập, rà soát các lỗi về nội dung, hình thức trước khi Tổng biên tập duyệt xuất bản và phát hành.&nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 10. Ban thư ký tòa soạn &nbsp;</h2>\r\n\r\n<p style="margin-left:-.75pt">Thực hiện công tác nghiệp vụ hành chính, tài vụ và trị sự của tòa soạn theo quy định của Tạp chí Khoa học và sự phân công của Tổng biên tập: &nbsp;</p>\r\n\r\n<ol>\r\n	<li>Thực hiện các chức năng về nghiệp vụ hành chính tổng hợp của tòa soạn;</li>\r\n	<li>Mời viết bài báo; tiếp nhận bài báo; yêu cầu phản biện; xét duyệt bài báo và phản hồi kết quả theo đúng quy trình xét duyệt đăng bài của Tạp chí Khoa học;</li>\r\n	<li>Rà soát các lỗi kỹ thuật dàn trang, lỗi trình bày, chính tả; &nbsp;</li>\r\n	<li>Trình duyệt ma-két (maquette), theo dõi quá trình in ấn Tạp chí Khoa học;&nbsp;&nbsp;</li>\r\n	<li>Lưu trữ tư liệu, bài báo và quản lý trang web của Tạp chí Khoa học;</li>\r\n	<li>Thanh toán thù lao cho tác giả, phản biện, biên tập, cộng tác viên và các loại thù lao khác theo quy định;</li>\r\n	<li>Thực hiện việc phát hành, nộp lưu chiểu và gửi báo biếu theo quy định của Tạp chí Khoa học.&nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 11. Cộng tác viên &nbsp;</h2>\r\n\r\n<p style="margin-left:-.25pt">&nbsp;Giúp Hội đồng biên tập và Ban thư ký tòa soạn thực hiện các chức năng, nhiệm vụ theo quy định:</p>\r\n\r\n<ol>\r\n	<li>Hỗ trợ việc mời viết bài báo, đặt hàng viết bài báo, mời phản biện bài báo;</li>\r\n	<li>Hỗ trợ việc rà soát về mặt hình thức, kỹ thuật, các lỗi chính tả, in ấn;</li>\r\n	<li>Hỗ trợ việc tổ chức hội thảo, sự kiện của Tạp chí Khoa học;</li>\r\n	<li>Cộng tác viên do Tổng biên tập đề nghị, phân công và Hiệu trưởng phê duyệt;</li>\r\n	<li>Chế độ cộng tác viên theo quy định của Nhà trường.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương III</strong> <strong>PHẢN BIỆN, TÁC GIẢ </strong></h2>\r\n\r\n<h2>Điều 12. Người phản biện &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Người phản biện cho Tạp chí Khoa học là các nhà khoa học có uy tín ở các trường đại học, viện nghiên cứu, trung tâm khoa học công nghệ, các cơ quan quản lý, doanh nghiệp hoặc các nhà nghiên cứu độc lập trong và ngoài nước có chuyên môn phù hợp với bài báo khoa học được mời phản biện;</li>\r\n	<li>Danh sách phản biện được Hội đồng biên tập đề xuất, các nhà khoa học giới thiệu và được Tổng biên tập ký duyệt;</li>\r\n	<li>Người phản biện được mời phản biện bài báo theo đường bưu điện, qua Email, hoặc phản biện trực tiếp tại tòa soạn theo yêu cầu của Tạp chí Khoa học;</li>\r\n	<li>Người phản biện có nhiệm vụ nhận xét, thẩm định nội dung khoa học và hình thức của bài báo một cách khách quan, trung thực và hoàn thành công việc theo Mẫu TC-02 (Phụ lục II) đúng thời hạn quy định; &nbsp;</li>\r\n	<li>Người phản biện được hưởng thù lao phản biện theo quy định của Nhà trường. &nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 13. Tác giả bài báo</h2>\r\n\r\n<ol>\r\n	<li>Tác giả bài báo là một cá nhân hay tập thể các cá nhân đứng tên người viết bài báo gửi bài báo khoa học đến Tòa soạn Tạp chí Khoa học theo đúng thể lệ gửi bài của Tạp chí Khoa học qua đường bưu điện, Email hoặc trực tiếp tại tòa soạn;</li>\r\n	<li>Tác giả bài báo chịu trách nhiệm trước các quy định của pháp luật về nội dung, sử dụng tài liệu, dữ liệu, hình ảnh, bản quyền bài báo của mình;&nbsp;</li>\r\n	<li>Tác giả tuân thủ quy định về thể lệ đăng bài trên Tạp chí Khoa học; chỉnh sửa bài viết, làm rõ nội dung theo ý kiến phản biện (nếu có) và theo yêu cầu của Ban biên tập; &nbsp;</li>\r\n	<li>Tác giả không gửi đến Tòa soạn bài báo đã được đăng ở các tạp chí, kỷ yếu khoa học, các báo khác; không gửi bài báo đến tạp chí, báo khác cho đến khi có quyết định xét duyệt cuối cùng của Ban biên tập Tạp chí Khoa học;&nbsp;</li>\r\n	<li>Tác giả có bài viết đăng trong Tạp chí Khoa học được trả thù lao theo quy định, được Tạp chí Khoa học gửi báo biếu; &nbsp;</li>\r\n	<li>Tác giả có bài báo được đăng sẽ được Tạp chí Khoa học xác nhận, tác giả được tính điểm công trình khoa học theo quy định của Hội đồng Chức danh giáo sư Nhà nước.<br />\r\n	<br />\r\n	&nbsp;</li>\r\n</ol>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương IV QUY ĐỊNH VỀ ĐĂNG BÀI, XÉT DUYỆT, LƯU TRỮ&nbsp; VÀ SỬ DỤNG BÀI BÁO</strong></h2>\r\n\r\n<h2>Điều 14. Điều kiện bài báo được đăng trên Tạp chí Khoa học &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Các bài gửi đăng phải có nội dung khoa học theo đúng tôn chỉ, mục đích của Tạp chí Khoa học và chưa được công bố trên bất kỳ tạp chí nào hoặc các dạng xuất bản phẩm khác;</li>\r\n	<li>Bài báo chưa được công bố trên các Tạp chí và các ấn phẩm in hoặc điện tử khác;</li>\r\n	<li>Bài báo đã thông qua phản biện; đã chỉnh sửa theo ý kiến (nếu có) của phản biện, của Ban biên tập và Ban thư ký;&nbsp;</li>\r\n	<li>Bài báo đã được biên tập và được Tổng biên tập duyệt cho đăng;</li>\r\n	<li>Trong trường hợp đặc biệt, Tổng biên tập sẽ quyết định cho phép đăng;</li>\r\n	<li>Đối với các bài báo không thông qua phản biện bao gồm: Các bài báo đặt hàng cho các nhà khoa học, các nhà quản lý, chuyên gia trong các lĩnh vực theo yêu cầu của Tổng biên tập; các bài báo mang tính trao đổi học thuật; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước. Các bài báo này được biên tập lại (nếu có) bởi các biên tập viên được phân công, được xác nhận lại của tác giả và được Tổng biên tập duyệt cho đăng.&nbsp;&nbsp;<br />\r\n	&nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 15. Quy trình xét duyệt bài báo khoa học</h2>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Nhận bài viết từ tác giả:</p>\r\n\r\n<p style="margin-left:80px">Ban thư ký tòa soạn nhận bài viết từ tác giả và ghi vào sổ nhận bài; tập hợp, chuyển bài báo cho thường trực Ban biên tập. Thời gian tối đa là 3 ngày.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Sơ duyệt:</p>\r\n\r\n<p style="margin-left:80px">Thường trực Ban biên tập:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li>Sơ duyệt các yêu cầu về nội dung và hình thức của bài báo. Những bài viết không đúng quy cách của một bài báo khoa học hoặc có nội dung không phù hợp sẽ bị từ chối, thông báo đến tác giả thông qua Ban thư ký tòa soạn; &nbsp;</li>\r\n	<li>Những bài đủ điều kiện, được Thường trực Ban biên tập phân loại ghi mã số bài báo chuyển đến Tổng biên tập theo Mẫu TC-01 (Phụ lục II). Thời gian tối đa là 3 ngày.</li>\r\n</ul>\r\n\r\n<p style="margin-left:34.35pt">3. Phân công và gửi phản biện:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li>Tổng biên tập phân công phản biện (đối với các bài báo phải thông qua phản biện) trên cơ sở danh sách phản biện do Hội đồng biên tập, các nhà khoa học giới thiệu;&nbsp; &nbsp;</li>\r\n	<li>Ban thư ký tòa soạn gửi bài báo đến phản biện theo Mẫu TC-02 (Phụ lục II). Thời gian tối đa là 3 ngày.</li>\r\n</ul>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4. Phản biện:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li>Phản biện thực hiện việc nhận xét, thẩm định các nội dung của bài báo theo yêu cầu của Tạp chí Khoa học theo Mẫu TC-02 (Phụ lục II) và theo đúng thời gian quy định;</li>\r\n	<li>Phiếu nhận xét phản biện phải ghi ngày tháng, ký tên và gửi cho Ban thư ký qua bưu điện, Email hoặc trực tiếp tại tòa soạn. Thời gian tối đa là 14 ngày.</li>\r\n</ul>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5. Kết quả phản biện:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li>Ban thư ký tập hợp, trình Tổng biên tập về kết quả phản biện theo Mẫu TC-03 (Phụ lục II);</li>\r\n	<li>Trên cơ sở ý kiến của Tổng biên tập, Ban thư ký:</li>\r\n</ul>\r\n\r\n<p style="margin-left:40px">+ Gửi bài báo cho tác giả chỉnh sửa theo ý kiến phản biện;&nbsp;</p>\r\n\r\n<p style="margin-left:40px">+ Trường hợp ý kiến của phản biện 1 không rõ ràng hoặc có ý kiến khác từ Thường trực Hội đồng biên tập thì bài báo được gửi cho phản biện 2 nếu được tổng biên tập cho phép. Thời gian tối đa là 7 ngày.</p>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 6. Biên tập bài báo:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li style="text-align:justify">Các bài báo không phải chỉnh sửa, các bài báo đã được tác giả chỉnh sửa theo ý kiến của phản biện (đối với các bài báo phải thông qua phản biện); các bài báo không phải thông qua phản biện được quy định tại khoản 6, điều 14 của Quy chế hoạt động Tạp chí Khoa học) đều được biên tập theo đúng yêu cầu của Tạp chí Khoa học;</li>\r\n	<li style="text-align:justify">Tổng biên tập phân công biên tập viên để biên tập các bài báo;</li>\r\n	<li style="text-align:justify">Ban thư ký chuyển bài báo đến từng biên tập viên theo sự phân công của Tổng biên tập. Thời gian tối đa là 3 ngày;&nbsp;&nbsp;&nbsp;&nbsp;</li>\r\n	<li style="text-align:justify">Các biên tập viên thực hiện việc biên tập theo yêu cầu về nội dung và hình thức của bài báo. Thời gian tối đa là 4 ngày.&nbsp;&nbsp;&nbsp;&nbsp;</li>\r\n</ul>\r\n\r\n<p style="margin-left:34.35pt">7. Xét duyệt, xếp hạng và duyệt đăng bài báo:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li style="text-align:justify">Hội đồng biên tập (hoặc thường trực) rà soát, phân loại, xét duyệt các bài báo đã được biên tập trước khi trình Tổng biên tập duyệt đăng;</li>\r\n	<li style="text-align:justify">Hội đồng biên tập (hoặc thường trực) đề xuất xếp hạng bài báo;</li>\r\n	<li style="text-align:justify">Trên cơ sở đề xuất của Hội đồng biên tập, Tổng biên tập duyệt đăng bài báo;</li>\r\n	<li style="text-align:justify">Các bài báo được Tổng biên tập duyệt đăng theo Mẫu TC-04 (Phụ lục II) sẽ được Ban thư ký gửi cho tác giả hiệu đính trước khi gửi in ấn. Thời gian tối đa là 7 ngày.</li>\r\n</ul>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8. Biên tập, rà soát bản thảo, duyệt in:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li style="text-align:justify">Biên tập bản thảo Tạp chí Khoa học (bao gồm: các bài báo, thiết kế bìa, hình ảnh, quảng cáo, thông tin đã được duyệt); Biên tập viên được phân công;</li>\r\n	<li style="text-align:justify">Ban thư ký rà soát lỗi trước khi gửi bản thảo Tạp chí Khoa học đến cơ sở in ấn;</li>\r\n	<li style="text-align:justify">Sau khi cơ sở in ấn hoàn thành chế bản, Ban thư ký đọc, rà soát chế bản trước khi trình Tổng biên tập duyệt cho in theo Mẫu TC-05 (Phụ lục II). Thời gian tối đa là 7 ngày.</li>\r\n</ul>\r\n\r\n<p style="margin-left:-.75pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9. In ấn, nộp lưu chiểu, phát hành, đưa Tạp chí Khoa học lên website:</p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li style="text-align:justify">Cơ sở in ấn thực hiện việc in ấn đúng bản thảo và số lượng in ấn theo hợp đồng; &nbsp;</li>\r\n	<li style="text-align:justify">Ban thư ký tiến hành nộp lưu chiểu theo quy định;</li>\r\n	<li style="text-align:justify">Ban thư ký phát hành Tạp chí Khoa học đến đúng địa chỉ và số lượng đã được Tổng biên tập phê duyệt;</li>\r\n	<li style="text-align:justify">Ban thư ký thực hiện chế độ lưu trữ;</li>\r\n	<li style="text-align:justify">Ban thư ký đưa Tạp chí Khoa học lên website của Tạp chí Khoa học và gửi bài đến website của Tạp chí Khoa học Việt Nam trực tuyến theo quy định. Thời gian tối đa là hai tháng.</li>\r\n</ul>\r\n\r\n<h2>Điều 16. Lưu trữ&nbsp; và sử dụng</h2>\r\n\r\n<ol>\r\n	<li style="text-align:justify">Tạp chí Khoa học thực hiện chế độ lưu trữ dưới 2 hình thức: dạng bản in và lưu file. Số lượng bản in được lưu trữ là 10 bản/1 số Tạp chí Khoa học, file được lưu dưới dạng word và pdf;</li>\r\n	<li style="text-align:justify">Tạp chí Khoa học được lưu kho, bảo quản và bảo đảm an toàn theo các chế độ lưu trữ và bảo quản của Nhà trường;</li>\r\n	<li style="text-align:justify">Thời gian lưu trữ các số của bài báo bằng bản in, bằng file là vĩnh viễn; Thời gian lưu trữ các tài liệu, hồ sơ của Tạp chí theo quy định lưu trữ của Nhà trường.&nbsp; &nbsp;</li>\r\n	<li style="text-align:justify">Các số của Tạp chí Khoa học (dạng bản in) đều gửi tại Thư viện Nhà trường. Các cá nhân trong và ngoài trường được phép sử dụng tại chỗ và mượn Tạp chí Khoa học theo các quy định của Thư viện Nhà trường;</li>\r\n	<li style="text-align:justify">Toàn văn bài báo trên các số Tạp chí Khoa học được đăng tải trên trang web của Tạp chí Khoa học sau một tháng kể từ ngày phát hành bản báo in. Việc sử dụng các bài báo phải tuân thủ Luật sở hữu trí tuệ Việt Nam. &nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương V KINH PHÍ HOẠT ĐỘNG </strong></h2>\r\n\r\n<h2>Điều 17. Nguồn kinh phí hoạt động &nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Kinh phí của Nhà trường dành cho hoạt động của Tạp chí Khoa học;</li>\r\n	<li>Quảng cáo, hỗ trợ của các đơn vị trong và ngoài nước;</li>\r\n	<li>Các nguồn thu hợp pháp khác.&nbsp; &nbsp;</li>\r\n</ol>\r\n\r\n<h2>Điều 18. Các khoản chi của Tạp chí Khoa học</h2>\r\n\r\n<ol>\r\n	<li>Thù lao nhuận bút, phản biện, biên tập, thù lao chuyên môn khác;</li>\r\n	<li>Chi cho công tác in ấn, phát hành;</li>\r\n	<li>Hoạt động chuyên môn của Tạp chí Khoa học;</li>\r\n	<li>Chi cho công tác hành chính;</li>\r\n	<li>Chi phí khác.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương VI KHEN THƯỞNG VÀ XỬ LÝ VI PHẠM </strong></h2>\r\n\r\n<h2>Điều 19. Khen thưởng &nbsp;</h2>\r\n\r\n<ol>\r\n	<li style="text-align:justify">Các tác giả, phản biện, biên tập viên, các cộng tác viên, Ban thư ký, cán bộ, nhân viên của Tạp chí Khoa học có nhiều đóng góp cho sự phát triển của Tạp chí Khoa học sẽ được Tạp chí Khoa học đề nghị khen thưởng theo quy chế khen thưởng của Nhà trường;</li>\r\n	<li style="text-align:justify">Các tác giả, có nhiều bài viết được bạn đọc quan tâm; cộng tác viên tích cực đóng góp sẽ được biếu tặng Tạp chí Khoa học thường xuyên.</li>\r\n</ol>\r\n\r\n<h2>Điều 20. Xử lý vi phạm &nbsp;</h2>\r\n\r\n<ol>\r\n	<li style="text-align:justify">Đối với các tác giả có vi phạm bản quyền; tác giả gửi bài đến Tạp chí Khoa học những bài đã đăng ở các Tạp chí khác, Tạp chí Khoa học sẽ không nhận đăng bài của các tác giả đó trong thời gian 1 năm. Đồng thời, tác giả vi phạm sẽ chịu trách nhiệm xử lý theo quy định của Luật sở hữu trí tuệ, Luật báo chí, Luật xuất bản. &nbsp;</li>\r\n	<li style="text-align:justify">Lãnh đạo Tạp chí Khoa học, Tòa soạn, Hội đồng biên tập, Ban thư ký, các cá nhân thuộc phạm vi điều chỉnh của quy chế này nếu vi phạm Luật báo chí, đạo đức nghề nghiệp sẽ bị xử lý theo Luật báo chí và các quy định của Nhà trường. &nbsp;</li>\r\n</ol>\r\n\r\n<p style="margin-left:33.85pt">&nbsp;</p>\r\n\r\n<h2 style="margin-left:0.5pt; text-align:center"><strong>Chương VII ĐIỀU KHOẢN THI HÀNH </strong></h2>\r\n\r\n<h2>Điều 21. Điều khoản thi hành&nbsp;</h2>\r\n\r\n<ol>\r\n	<li>Quy chế sẽ điều chỉnh tùy theo tình hình thực tế, theo sự điều chỉnh của Luật báo chí, Luật xuất bản, Luật sở hữu trí tuệ và quy định của Nhà trường;</li>\r\n	<li>Quy chế này có hiệu lực kể từ ngày ký và ban hành. Những quy định trước đây trái với quy chế này đều không còn hiệu lực./.</li>\r\n</ol>\r\n\r\n<table border="0" cellpadding="1" cellspacing="1" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td style="text-align:center; width:250px"><strong>HIỆU TRƯỞNG</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td style="text-align:center"><strong>Nguyễn Văn Phúc</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </strong></p>\r\n', '\r\n	\r\n		\r\n			BỘ GIÁO DỤC &amp; ĐÀO TẠO\r\n			CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM\r\n		\r\n		\r\n			TRƯỜNG ĐẠI HỌC MỞ TP.HCM\r\n			Độc lập – Tự do – Hạnh phúc\r\n		\r\n	\r\n\r\n\r\n&nbsp;\r\n\r\nQUY CHẾ\r\n\r\nHoạt động Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh\r\n\r\n(Ban hành kèm theo Quyết định số 880 /QĐ-ĐHM, ngày 22 tháng 08 năm 2014 của Trường Đại Mở Tp.HCM) \r\n\r\n&nbsp;\r\n\r\nChương I QUY ĐỊNH CHUNG\r\n\r\nĐiều 1. Phạm vi điều chỉnh và đối tượng áp dụng &nbsp;\r\n\r\n\r\n	Quy chế này quy định về hoạt động của Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh (sau đây gọi là Tạp chí Khoa học) bao gồm các quy định về tổ chức bộ máy, phản biện, tác giả, đăng bài, xét duyệt, lưu trữ, sử dụng bài báo, kinh phí hoạt động, khen thưởng và xử lý vi phạm trong hoạt động của Tạp chí Khoa học.&nbsp;\r\n	Quy chế này áp dụng đối với Ban Biên tập, Hội đồng biên tập, Ban Thư ký tòa soạn, các phản biện, các cộng tác viên và các tác giả có bài báo gửi đăng trên Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh.\r\n\r\n\r\nĐiều 2. Mục đích, đối tượng phục vụ\r\n\r\n\r\n	Tạp chí Khoa học nhằm góp phần xây dựng và phát triển đội ngũ cán bộ, giảng viên, những người làm công tác khoa học; góp phần đẩy mạnh các hoạt động nghiên cứu khoa học, học thuật đáp ứng mục tiêu đào tạo, nghiên cứu khoa học và dịch vụ xã hội của Nhà trường.\r\n	Đối tượng phục vụ là những người làm công tác khoa học, giảng viên, nghiên cứu sinh, học viên cao học, sinh viên, cán bộ quản lý và bạn đọc có quan tâm.&nbsp;\r\n\r\n\r\nĐiều 3. Tên gọi, trụ sở, định kỳ xuất bản và phát hành &nbsp;\r\n\r\n\r\n	Tên gọi, trụ sở: &nbsp;\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tên tiếng Việt: Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí minh.&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tên tiếng Anh: Journal of Science Ho Chi Minh City Open University&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trụ sở tòa soạn: Trường Đại học Mở Thành phố Hồ Chí Minh &nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Số 97, Võ Văn Tần, Phường 6, Quận 3, TP. Hồ Chí Minh &nbsp;\r\n\r\n&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Điện thoại: 08.39300210, 39304469&nbsp; Email: tapchikhoahoc@ou.edu.vn&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website: www.ou.edu.vn&nbsp;\r\n\r\n\r\n	Thể thức xuất bản: &nbsp;\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ngôn ngữ thể hiện: tiếng Việt và tiếng Anh; &nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kỳ hạn xuất bản: 1 năm /10 kỳ: Gồm 6 kỳ tiếng Việt và 4 kỳ tiếng Anh;&nbsp;&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Khuôn khổ: 20cm x 27cm;&nbsp;\r\n\r\nSố trang: 80-150 trang;&nbsp;\r\n\r\nSố lượng: 500-1000 bản/kỳ. &nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nơi in: Thành phố Hồ Chí Minh &nbsp;\r\n\r\n\r\n	Nộp lưu chiểu và phát hành&nbsp;\r\n\r\n\r\n\r\n	Nộp lưu chiểu tại Sở Thông tin và Truyền thông Thành phố Hồ Chí Minh,\r\n\r\n\r\nCục Báo chí – Bộ Thông tin và Truyền thông, Thư viện Quốc Gia Việt Nam;\r\n\r\n\r\n	Phạm vi phát hành trong cả nước; &nbsp;\r\n	Đăng tiêu đề, tóm tắt bài báo và toàn văn các bài báo (sau một tháng phát\r\n\r\n\r\nhành bản in) trên website của Trường Đại học Mở Thành phố Hồ Chí Minh. &nbsp;\r\n\r\nĐiều 4. Nội dung xuất bản &nbsp;\r\n\r\n\r\n	Tạp chí Khoa học đăng tải các bài báo khoa học; công bố các công trình nghiên cứu khoa học; thông tin các kết quả nghiên cứu khoa học; trao đổi các nội dung mang tính học thuật, quan điểm khoa học, phương pháp tiếp cận các vấn đề khoa học mới; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước trong các lĩnh vực mang tính định kỳ theo kế hoạch được Hiệu trưởng phê duyệt;\r\n	Tạp chí Khoa học có thể xuất bản các số theo các chủ đề bằng tiếng Việt hoặc tiếng Anh theo Giấy phép xuất bản; &nbsp;\r\n	Tạp chí Khoa học đăng các giới thiệu, quảng cáo theo quy định, phù hợp với giấy phép xuất bản và theo sự phê duyệt của Tổng biên tập.\r\n\r\n\r\nĐiều 5. Nguyên tắc hoạt động &nbsp;\r\n\r\nTạp chí Khoa học hoạt động theo quy định của Luật Báo chí, Luật xuất bản, các quy định của Trường Đại học Mở Thành phố Hồ Chí Minh và các quy định của Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí Minh. Các thành viên của Ban biên tập, Hội đồng biên tập, Ban thư ký, các phản biện, các cộng tác viên và các tác giả có bài báo gửi đăng trong Tạp chí Khoa học Trường Đại học Mở Thành phố Hồ Chí Minh có trách nhiệm thực hiện các quy định trên và theo sự phân công, giao nhiệm vụ của Tổng biên tập. &nbsp;\r\n\r\nChương II TỔ CHỨC BỘ MÁY &nbsp;\r\n\r\nĐiều 6. Cơ cấu tổ chức\r\n\r\nCơ cấu tổ chức của Tạp chí Khoa học Đại học Mở Thành phố Hồ Chí Minh gồm: &nbsp;\r\n\r\n\r\n	Tổng biên tập; &nbsp;\r\n	Phó tổng biên tập; &nbsp;\r\n	Hội đồng biên tập; &nbsp;4. Ban thư ký tòa soạn;\r\n\r\n\r\n5. Cộng tác viên.&nbsp;\r\n\r\nĐiều 7. Tổng biên tập&nbsp; &nbsp;\r\n\r\n\r\n	Tổng biên tập chịu trách nhiệm thực hiện việc lãnh đạo, điều hành và quản lý Tạp chí Khoa học về mọi mặt, đảm bảo thực hiện tôn chỉ, mục đích của Tạp chí Khoa học; chịu trách nhiệm trước Hiệu trưởng và pháp luật về hoạt động của Tạp chí Khoa học;\r\n	Chịu trách nhiệm xuất bản các ấn phẩm của Tạp chí Khoa học theo quy định của Luật Báo chí, Luật Xuất bản và chỉ đạo của Hiệu trưởng; &nbsp;\r\n	Tổng biên tập là người duyệt cuối cùng các ấn phẩm Tạp chí Khoa học trước khi in và quyết định nộp lưu chiểu, phát hành;&nbsp;\r\n	Trình Hiệu trưởng phê duyệt kế hoạch xuất bản Tạp chí Khoa học định kỳ;\r\n	Là người ký kết, nghiệm thu các hợp đồng in ấn và phát hành Tạp chí Khoa học theo sự ủy quyền của Hiệu trưởng. &nbsp;\r\n\r\n\r\nĐiều 8. Phó tổng biên tập &nbsp;\r\n\r\n\r\n	Giúp Tổng biên tập lãnh đạo, điều hành và quản lý Tạp chí Khoa học; chịu trách nhiệm trước Hiệu trưởng và Tổng biên tập về các hoạt động của Tạp chí Khoa học;&nbsp;\r\n	Giúp Tổng biên tập trong việc quản lý xuất bản Tạp chí Khoa học và xét duyệt các ấn phẩm Tạp chí Khoa học theo sự phân công của Tổng biên tập;\r\n	Giúp Tổng biên tập thực hiện kế hoạch xuất bản Tạp chí Khoa học theo kế hoạch và theo phê duyệt của Hiệu trưởng. &nbsp;\r\n\r\n\r\nĐiều 9. Hội đồng biên tập &nbsp;\r\n\r\nHội đồng biên tập có trách nhiệm biên tập về mặt chuyên môn, học thuật, nội dung cũng như hình thức xuất bản của Tạp chí Khoa học:\r\n\r\n\r\n	Đề xuất kế hoạch xuất bản, đề xuất nội dung và hình thức của Tạp chí Khoa học;\r\n	Đề xuất phản biện; theo dõi quá trình sửa chữa của tác giả, biên tập các bài gửi đăng theo đúng tôn chỉ mục đích, thể lệ của Tạp chí Khoa học và chịu trách nhiệm về nội dung biên tập trước khi Tổng biên tập duyệt đăng;\r\n	Đề xuất phân loại và xếp hạng bài báo khoa học; xem xét và có ý kiến về nội dung và hình thức bài báo;&nbsp;\r\n	Biên tập, rà soát các lỗi về nội dung, hình thức trước khi Tổng biên tập duyệt xuất bản và phát hành.&nbsp;\r\n\r\n\r\nĐiều 10. Ban thư ký tòa soạn &nbsp;\r\n\r\nThực hiện công tác nghiệp vụ hành chính, tài vụ và trị sự của tòa soạn theo quy định của Tạp chí Khoa học và sự phân công của Tổng biên tập: &nbsp;\r\n\r\n\r\n	Thực hiện các chức năng về nghiệp vụ hành chính tổng hợp của tòa soạn;\r\n	Mời viết bài báo; tiếp nhận bài báo; yêu cầu phản biện; xét duyệt bài báo và phản hồi kết quả theo đúng quy trình xét duyệt đăng bài của Tạp chí Khoa học;\r\n	Rà soát các lỗi kỹ thuật dàn trang, lỗi trình bày, chính tả; &nbsp;\r\n	Trình duyệt ma-két (maquette), theo dõi quá trình in ấn Tạp chí Khoa học;&nbsp;&nbsp;\r\n	Lưu trữ tư liệu, bài báo và quản lý trang web của Tạp chí Khoa học;\r\n	Thanh toán thù lao cho tác giả, phản biện, biên tập, cộng tác viên và các loại thù lao khác theo quy định;\r\n	Thực hiện việc phát hành, nộp lưu chiểu và gửi báo biếu theo quy định của Tạp chí Khoa học.&nbsp;\r\n\r\n\r\nĐiều 11. Cộng tác viên &nbsp;\r\n\r\n&nbsp;Giúp Hội đồng biên tập và Ban thư ký tòa soạn thực hiện các chức năng, nhiệm vụ theo quy định:\r\n\r\n\r\n	Hỗ trợ việc mời viết bài báo, đặt hàng viết bài báo, mời phản biện bài báo;\r\n	Hỗ trợ việc rà soát về mặt hình thức, kỹ thuật, các lỗi chính tả, in ấn;\r\n	Hỗ trợ việc tổ chức hội thảo, sự kiện của Tạp chí Khoa học;\r\n	Cộng tác viên do Tổng biên tập đề nghị, phân công và Hiệu trưởng phê duyệt;\r\n	Chế độ cộng tác viên theo quy định của Nhà trường.\r\n\r\n\r\n&nbsp;\r\n\r\nChương III PHẢN BIỆN, TÁC GIẢ \r\n\r\nĐiều 12. Người phản biện &nbsp;\r\n\r\n\r\n	Người phản biện cho Tạp chí Khoa học là các nhà khoa học có uy tín ở các trường đại học, viện nghiên cứu, trung tâm khoa học công nghệ, các cơ quan quản lý, doanh nghiệp hoặc các nhà nghiên cứu độc lập trong và ngoài nước có chuyên môn phù hợp với bài báo khoa học được mời phản biện;\r\n	Danh sách phản biện được Hội đồng biên tập đề xuất, các nhà khoa học giới thiệu và được Tổng biên tập ký duyệt;\r\n	Người phản biện được mời phản biện bài báo theo đường bưu điện, qua Email, hoặc phản biện trực tiếp tại tòa soạn theo yêu cầu của Tạp chí Khoa học;\r\n	Người phản biện có nhiệm vụ nhận xét, thẩm định nội dung khoa học và hình thức của bài báo một cách khách quan, trung thực và hoàn thành công việc theo Mẫu TC-02 (Phụ lục II) đúng thời hạn quy định; &nbsp;\r\n	Người phản biện được hưởng thù lao phản biện theo quy định của Nhà trường. &nbsp;\r\n\r\n\r\nĐiều 13. Tác giả bài báo\r\n\r\n\r\n	Tác giả bài báo là một cá nhân hay tập thể các cá nhân đứng tên người viết bài báo gửi bài báo khoa học đến Tòa soạn Tạp chí Khoa học theo đúng thể lệ gửi bài của Tạp chí Khoa học qua đường bưu điện, Email hoặc trực tiếp tại tòa soạn;\r\n	Tác giả bài báo chịu trách nhiệm trước các quy định của pháp luật về nội dung, sử dụng tài liệu, dữ liệu, hình ảnh, bản quyền bài báo của mình;&nbsp;\r\n	Tác giả tuân thủ quy định về thể lệ đăng bài trên Tạp chí Khoa học; chỉnh sửa bài viết, làm rõ nội dung theo ý kiến phản biện (nếu có) và theo yêu cầu của Ban biên tập; &nbsp;\r\n	Tác giả không gửi đến Tòa soạn bài báo đã được đăng ở các tạp chí, kỷ yếu khoa học, các báo khác; không gửi bài báo đến tạp chí, báo khác cho đến khi có quyết định xét duyệt cuối cùng của Ban biên tập Tạp chí Khoa học;&nbsp;\r\n	Tác giả có bài viết đăng trong Tạp chí Khoa học được trả thù lao theo quy định, được Tạp chí Khoa học gửi báo biếu; &nbsp;\r\n	Tác giả có bài báo được đăng sẽ được Tạp chí Khoa học xác nhận, tác giả được tính điểm công trình khoa học theo quy định của Hội đồng Chức danh giáo sư Nhà nước.<br />\r\n	<br />\r\n	&nbsp;\r\n\r\n\r\nChương IV QUY ĐỊNH VỀ ĐĂNG BÀI, XÉT DUYỆT, LƯU TRỮ&nbsp; VÀ SỬ DỤNG BÀI BÁO\r\n\r\nĐiều 14. Điều kiện bài báo được đăng trên Tạp chí Khoa học &nbsp;\r\n\r\n\r\n	Các bài gửi đăng phải có nội dung khoa học theo đúng tôn chỉ, mục đích của Tạp chí Khoa học và chưa được công bố trên bất kỳ tạp chí nào hoặc các dạng xuất bản phẩm khác;\r\n	Bài báo chưa được công bố trên các Tạp chí và các ấn phẩm in hoặc điện tử khác;\r\n	Bài báo đã thông qua phản biện; đã chỉnh sửa theo ý kiến (nếu có) của phản biện, của Ban biên tập và Ban thư ký;&nbsp;\r\n	Bài báo đã được biên tập và được Tổng biên tập duyệt cho đăng;\r\n	Trong trường hợp đặc biệt, Tổng biên tập sẽ quyết định cho phép đăng;\r\n	Đối với các bài báo không thông qua phản biện bao gồm: Các bài báo đặt hàng cho các nhà khoa học, các nhà quản lý, chuyên gia trong các lĩnh vực theo yêu cầu của Tổng biên tập; các bài báo mang tính trao đổi học thuật; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước. Các bài báo này được biên tập lại (nếu có) bởi các biên tập viên được phân công, được xác nhận lại của tác giả và được Tổng biên tập duyệt cho đăng.&nbsp;&nbsp;<br />\r\n	&nbsp;\r\n\r\n\r\nĐiều 15. Quy trình xét duyệt bài báo khoa học\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Nhận bài viết từ tác giả:\r\n\r\nBan thư ký tòa soạn nhận bài viết từ tác giả và ghi vào sổ nhận bài; tập hợp, chuyển bài báo cho thường trực Ban biên tập. Thời gian tối đa là 3 ngày.\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Sơ duyệt:\r\n\r\nThường trực Ban biên tập:\r\n\r\n\r\n	Sơ duyệt các yêu cầu về nội dung và hình thức của bài báo. Những bài viết không đúng quy cách của một bài báo khoa học hoặc có nội dung không phù hợp sẽ bị từ chối, thông báo đến tác giả thông qua Ban thư ký tòa soạn; &nbsp;\r\n	Những bài đủ điều kiện, được Thường trực Ban biên tập phân loại ghi mã số bài báo chuyển đến Tổng biên tập theo Mẫu TC-01 (Phụ lục II). Thời gian tối đa là 3 ngày.\r\n\r\n\r\n3. Phân công và gửi phản biện:\r\n\r\n\r\n	Tổng biên tập phân công phản biện (đối với các bài báo phải thông qua phản biện) trên cơ sở danh sách phản biện do Hội đồng biên tập, các nhà khoa học giới thiệu;&nbsp; &nbsp;\r\n	Ban thư ký tòa soạn gửi bài báo đến phản biện theo Mẫu TC-02 (Phụ lục II). Thời gian tối đa là 3 ngày.\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4. Phản biện:\r\n\r\n\r\n	Phản biện thực hiện việc nhận xét, thẩm định các nội dung của bài báo theo yêu cầu của Tạp chí Khoa học theo Mẫu TC-02 (Phụ lục II) và theo đúng thời gian quy định;\r\n	Phiếu nhận xét phản biện phải ghi ngày tháng, ký tên và gửi cho Ban thư ký qua bưu điện, Email hoặc trực tiếp tại tòa soạn. Thời gian tối đa là 14 ngày.\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5. Kết quả phản biện:\r\n\r\n\r\n	Ban thư ký tập hợp, trình Tổng biên tập về kết quả phản biện theo Mẫu TC-03 (Phụ lục II);\r\n	Trên cơ sở ý kiến của Tổng biên tập, Ban thư ký:\r\n\r\n\r\n+ Gửi bài báo cho tác giả chỉnh sửa theo ý kiến phản biện;&nbsp;\r\n\r\n+ Trường hợp ý kiến của phản biện 1 không rõ ràng hoặc có ý kiến khác từ Thường trực Hội đồng biên tập thì bài báo được gửi cho phản biện 2 nếu được tổng biên tập cho phép. Thời gian tối đa là 7 ngày.\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 6. Biên tập bài báo:\r\n\r\n\r\n	Các bài báo không phải chỉnh sửa, các bài báo đã được tác giả chỉnh sửa theo ý kiến của phản biện (đối với các bài báo phải thông qua phản biện); các bài báo không phải thông qua phản biện được quy định tại khoản 6, điều 14 của Quy chế hoạt động Tạp chí Khoa học) đều được biên tập theo đúng yêu cầu của Tạp chí Khoa học;\r\n	Tổng biên tập phân công biên tập viên để biên tập các bài báo;\r\n	Ban thư ký chuyển bài báo đến từng biên tập viên theo sự phân công của Tổng biên tập. Thời gian tối đa là 3 ngày;&nbsp;&nbsp;&nbsp;&nbsp;\r\n	Các biên tập viên thực hiện việc biên tập theo yêu cầu về nội dung và hình thức của bài báo. Thời gian tối đa là 4 ngày.&nbsp;&nbsp;&nbsp;&nbsp;\r\n\r\n\r\n7. Xét duyệt, xếp hạng và duyệt đăng bài báo:\r\n\r\n\r\n	Hội đồng biên tập (hoặc thường trực) rà soát, phân loại, xét duyệt các bài báo đã được biên tập trước khi trình Tổng biên tập duyệt đăng;\r\n	Hội đồng biên tập (hoặc thường trực) đề xuất xếp hạng bài báo;\r\n	Trên cơ sở đề xuất của Hội đồng biên tập, Tổng biên tập duyệt đăng bài báo;\r\n	Các bài báo được Tổng biên tập duyệt đăng theo Mẫu TC-04 (Phụ lục II) sẽ được Ban thư ký gửi cho tác giả hiệu đính trước khi gửi in ấn. Thời gian tối đa là 7 ngày.\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8. Biên tập, rà soát bản thảo, duyệt in:\r\n\r\n\r\n	Biên tập bản thảo Tạp chí Khoa học (bao gồm: các bài báo, thiết kế bìa, hình ảnh, quảng cáo, thông tin đã được duyệt); Biên tập viên được phân công;\r\n	Ban thư ký rà soát lỗi trước khi gửi bản thảo Tạp chí Khoa học đến cơ sở in ấn;\r\n	Sau khi cơ sở in ấn hoàn thành chế bản, Ban thư ký đọc, rà soát chế bản trước khi trình Tổng biên tập duyệt cho in theo Mẫu TC-05 (Phụ lục II). Thời gian tối đa là 7 ngày.\r\n\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9. In ấn, nộp lưu chiểu, phát hành, đưa Tạp chí Khoa học lên website:\r\n\r\n\r\n	Cơ sở in ấn thực hiện việc in ấn đúng bản thảo và số lượng in ấn theo hợp đồng; &nbsp;\r\n	Ban thư ký tiến hành nộp lưu chiểu theo quy định;\r\n	Ban thư ký phát hành Tạp chí Khoa học đến đúng địa chỉ và số lượng đã được Tổng biên tập phê duyệt;\r\n	Ban thư ký thực hiện chế độ lưu trữ;\r\n	Ban thư ký đưa Tạp chí Khoa học lên website của Tạp chí Khoa học và gửi bài đến website của Tạp chí Khoa học Việt Nam trực tuyến theo quy định. Thời gian tối đa là hai tháng.\r\n\r\n\r\nĐiều 16. Lưu trữ&nbsp; và sử dụng\r\n\r\n\r\n	Tạp chí Khoa học thực hiện chế độ lưu trữ dưới 2 hình thức: dạng bản in và lưu file. Số lượng bản in được lưu trữ là 10 bản/1 số Tạp chí Khoa học, file được lưu dưới dạng word và pdf;\r\n	Tạp chí Khoa học được lưu kho, bảo quản và bảo đảm an toàn theo các chế độ lưu trữ và bảo quản của Nhà trường;\r\n	Thời gian lưu trữ các số của bài báo bằng bản in, bằng file là vĩnh viễn; Thời gian lưu trữ các tài liệu, hồ sơ của Tạp chí theo quy định lưu trữ của Nhà trường.&nbsp; &nbsp;\r\n	Các số của Tạp chí Khoa học (dạng bản in) đều gửi tại Thư viện Nhà trường. Các cá nhân trong và ngoài trường được phép sử dụng tại chỗ và mượn Tạp chí Khoa học theo các quy định của Thư viện Nhà trường;\r\n	Toàn văn bài báo trên các số Tạp chí Khoa học được đăng tải trên trang web của Tạp chí Khoa học sau một tháng kể từ ngày phát hành bản báo in. Việc sử dụng các bài báo phải tuân thủ Luật sở hữu trí tuệ Việt Nam. &nbsp;\r\n\r\n\r\n&nbsp;\r\n\r\nChương V KINH PHÍ HOẠT ĐỘNG \r\n\r\nĐiều 17. Nguồn kinh phí hoạt động &nbsp;\r\n\r\n\r\n	Kinh phí của Nhà trường dành cho hoạt động của Tạp chí Khoa học;\r\n	Quảng cáo, hỗ trợ của các đơn vị trong và ngoài nước;\r\n	Các nguồn thu hợp pháp khác.&nbsp; &nbsp;\r\n\r\n\r\nĐiều 18. Các khoản chi của Tạp chí Khoa học\r\n\r\n\r\n	Thù lao nhuận bút, phản biện, biên tập, thù lao chuyên môn khác;\r\n	Chi cho công tác in ấn, phát hành;\r\n	Hoạt động chuyên môn của Tạp chí Khoa học;\r\n	Chi cho công tác hành chính;\r\n	Chi phí khác.\r\n\r\n\r\n&nbsp;\r\n\r\nChương VI KHEN THƯỞNG VÀ XỬ LÝ VI PHẠM \r\n\r\nĐiều 19. Khen thưởng &nbsp;\r\n\r\n\r\n	Các tác giả, phản biện, biên tập viên, các cộng tác viên, Ban thư ký, cán bộ, nhân viên của Tạp chí Khoa học có nhiều đóng góp cho sự phát triển của Tạp chí Khoa học sẽ được Tạp chí Khoa học đề nghị khen thưởng theo quy chế khen thưởng của Nhà trường;\r\n	Các tác giả, có nhiều bài viết được bạn đọc quan tâm; cộng tác viên tích cực đóng góp sẽ được biếu tặng Tạp chí Khoa học thường xuyên.\r\n\r\n\r\nĐiều 20. Xử lý vi phạm &nbsp;\r\n\r\n\r\n	Đối với các tác giả có vi phạm bản quyền; tác giả gửi bài đến Tạp chí Khoa học những bài đã đăng ở các Tạp chí khác, Tạp chí Khoa học sẽ không nhận đăng bài của các tác giả đó trong thời gian 1 năm. Đồng thời, tác giả vi phạm sẽ chịu trách nhiệm xử lý theo quy định của Luật sở hữu trí tuệ, Luật báo chí, Luật xuất bản. &nbsp;\r\n	Lãnh đạo Tạp chí Khoa học, Tòa soạn, Hội đồng biên tập, Ban thư ký, các cá nhân thuộc phạm vi điều chỉnh của quy chế này nếu vi phạm Luật báo chí, đạo đức nghề nghiệp sẽ bị xử lý theo Luật báo chí và các quy định của Nhà trường. &nbsp;\r\n\r\n\r\n&nbsp;\r\n\r\nChương VII ĐIỀU KHOẢN THI HÀNH \r\n\r\nĐiều 21. Điều khoản thi hành&nbsp;\r\n\r\n\r\n	Quy chế sẽ điều chỉnh tùy theo tình hình thực tế, theo sự điều chỉnh của Luật báo chí, Luật xuất bản, Luật sở hữu trí tuệ và quy định của Nhà trường;\r\n	Quy chế này có hiệu lực kể từ ngày ký và ban hành. Những quy định trước đây trái với quy chế này đều không còn hiệu lực./.\r\n\r\n\r\n\r\n	\r\n		\r\n			&nbsp;\r\n			HIỆU TRƯỞNG\r\n		\r\n		\r\n			&nbsp;\r\n			&nbsp;\r\n		\r\n		\r\n			&nbsp;\r\n			&nbsp;\r\n		\r\n		\r\n			&nbsp;\r\n			Nguyễn Văn Phúc\r\n		\r\n	\r\n\r\n\r\n&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n', 1427346068, 5, 1429501303, 38, '*', NULL),
	(2, 'Lịch sử phát triển', 'Lịch sử phát triển', '2-lich-su-phat-trien', '<ul>\r\n	<li>Ngày 29-9-2003 thành lập Bản tin Đại học Mở Bán công TP. Hồ Chí Minh theo quyết định số 369/QĐ-ĐHMBC do ông Lê Thế Dõng, bí thư Đảng ủy làm trưởng Ban Biên tập, xuất bản các Bản tin lưu hành nội bộ;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 21-10-2003 thành lập Ban biên tập Tập san Khoa học theo quyết định số394/2003/QĐ-ĐHMBC do PGS.TS Nguyễn Quốc Lộc làm trưởng Ban biên tập, xuất bản được 1 số theo giấy phép xuất bản số 179/GP-SVHTT của Sở Văn hóa thông tin TP. HCM (nay là Sở Thông tin Truyền thông);<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 29-10-2004 thành lập mới Ban Biên tập Tập san Khoa học Đại học Mở Bán công TP.HCM do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập theo quyết định số 328/QĐ-ĐHMBC. Ngày 17-02-2005 Cục Báo chí cấp giấy phép hoạt động số 60/GP-XBBT. Trong thời gian này, Tập san Khoa học xuất bản 10 số với 195 bài báo khoa học;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 15-11-2006, Tập san Khoa học chính thức chuyển đổi thành Tạp chí Khoa học thực hiện theo giấy phép hoạt động của Bộ Thông tin và Truyền thông số 169/GP-BVHTT do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 21-12-2009, Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh được Trung tâm Thông tin khoa học và công nghệ Quốc gia của Bộ Khoa học và Công nghệ cấp mã số chuẩn quốc tế cho xuất bản phẩm nhiều kỳ (ISSN) theo công văn số 487/TTKHCN-ISSN;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 9-5-2011, Hội đồng Chức danh giáo sư nhà nước công nhận Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh và đưa vào danh mục các Tạp chí được tính điểm công trình khoa học ngành Kinh tế theo quyết định số 14/QĐ-HĐCDGSNN;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 15-9-2011, Bộ Thông tin và Truyền thông cấp giấy phép Hoạt động báo chí in&nbsp; theo quyết định số 1489/GP-BTTTT, do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập;<br />\r\n	&nbsp;</li>\r\n	<li>Ngày 3-6-2013, Hội đồng Chức danh giáo sư nhà nước bổ sung thêm vào danh mục các Tạp chí được tính điểm công trình khoa học các ngành Cơ học, Triết học, Xã hội học, Chính trị học, theo quyết định số 16a/QĐ-HĐCDGSNN;</li>\r\n</ul>\r\n', '\r\n	Ngày 29-9-2003 thành lập Bản tin Đại học Mở Bán công TP. Hồ Chí Minh theo quyết định số 369/QĐ-ĐHMBC do ông Lê Thế Dõng, bí thư Đảng ủy làm trưởng Ban Biên tập, xuất bản các Bản tin lưu hành nội bộ;<br />\r\n	&nbsp;\r\n	Ngày 21-10-2003 thành lập Ban biên tập Tập san Khoa học theo quyết định số394/2003/QĐ-ĐHMBC do PGS.TS Nguyễn Quốc Lộc làm trưởng Ban biên tập, xuất bản được 1 số theo giấy phép xuất bản số 179/GP-SVHTT của Sở Văn hóa thông tin TP. HCM (nay là Sở Thông tin Truyền thông);<br />\r\n	&nbsp;\r\n	Ngày 29-10-2004 thành lập mới Ban Biên tập Tập san Khoa học Đại học Mở Bán công TP.HCM do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập theo quyết định số 328/QĐ-ĐHMBC. Ngày 17-02-2005 Cục Báo chí cấp giấy phép hoạt động số 60/GP-XBBT. Trong thời gian này, Tập san Khoa học xuất bản 10 số với 195 bài báo khoa học;<br />\r\n	&nbsp;\r\n	Ngày 15-11-2006, Tập san Khoa học chính thức chuyển đổi thành Tạp chí Khoa học thực hiện theo giấy phép hoạt động của Bộ Thông tin và Truyền thông số 169/GP-BVHTT do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập;<br />\r\n	&nbsp;\r\n	Ngày 21-12-2009, Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh được Trung tâm Thông tin khoa học và công nghệ Quốc gia của Bộ Khoa học và Công nghệ cấp mã số chuẩn quốc tế cho xuất bản phẩm nhiều kỳ (ISSN) theo công văn số 487/TTKHCN-ISSN;<br />\r\n	&nbsp;\r\n	Ngày 9-5-2011, Hội đồng Chức danh giáo sư nhà nước công nhận Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh và đưa vào danh mục các Tạp chí được tính điểm công trình khoa học ngành Kinh tế theo quyết định số 14/QĐ-HĐCDGSNN;<br />\r\n	&nbsp;\r\n	Ngày 15-9-2011, Bộ Thông tin và Truyền thông cấp giấy phép Hoạt động báo chí in&nbsp; theo quyết định số 1489/GP-BTTTT, do PGS.TS. Nguyễn Thuấn làm Tổng Biên tập;<br />\r\n	&nbsp;\r\n	Ngày 3-6-2013, Hội đồng Chức danh giáo sư nhà nước bổ sung thêm vào danh mục các Tạp chí được tính điểm công trình khoa học các ngành Cơ học, Triết học, Xã hội học, Chính trị học, theo quyết định số 16a/QĐ-HĐCDGSNN;\r\n\r\n', 1427346277, 5, 1428630052, 5, '*', NULL),
	(3, 'Hội đồng biên tập', 'Hội đồng biên tập', '3-hoi-dong-bien-tap', '<p style="text-align:center"><img alt="" src="/asset/ckfinder/userfiles/5/images/nguyenthuan.png" style="height:437px; width:680px" /><br />\r\nPGS.TS. Nguyễn Thuấn –Tổng Biên tập Tạp chí Khoa học Đại học Mở Tp.HCM</p>\r\n\r\n<table border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse; height:1446px; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Nguyễn Thuấn</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Tổng Biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Nguyễn Văn Phúc</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Chủ tịch Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Trịnh Thùy Anh</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Phó Chủ tịch Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>GS.TS. Nguyễn Thành Xương</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>GS.TS. Nguyễn Đình Hương</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Phan Xuân Biên</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS. Đào Công Tiến</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Trần Thành Trai</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Trịnh Hữu Phước</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Đoàn Thị Mỹ Hạnh</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Nguyễn Thị Minh Kiều</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Vũ Hữu Đức</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Lưu Trường Văn</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Nguyễn Minh Hà</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>PGS.TS. Dương Hồng Thẩm</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Lê Thị Thanh Thu</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Hoàng Mạnh Dũng</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Lê Thị Kính</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Lê Thái Thường Quân</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Cao Xuân Dung</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Thái Thị Ngọc Dư</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Nguyễn Xuân Nghĩa</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>TS. Iwata Yayoi</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Ủy viên Hội đồng biên tập</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:283px">\r\n			<p>ThS. Huỳnh Thị Kim Tuyết</p>\r\n			</td>\r\n			<td style="width:281px">\r\n			<p>Thư ký tòa soạn</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '<br />\r\nPGS.TS. Nguyễn Thuấn –Tổng Biên tập Tạp chí Khoa học Đại học Mở Tp.HCM\r\n\r\n\r\n	\r\n		\r\n			\r\n			PGS.TS. Nguyễn Thuấn\r\n			\r\n			\r\n			Tổng Biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Nguyễn Văn Phúc\r\n			\r\n			\r\n			Chủ tịch Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Trịnh Thùy Anh\r\n			\r\n			\r\n			Phó Chủ tịch Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			GS.TS. Nguyễn Thành Xương\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			GS.TS. Nguyễn Đình Hương\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Phan Xuân Biên\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS. Đào Công Tiến\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Trần Thành Trai\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Trịnh Hữu Phước\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Đoàn Thị Mỹ Hạnh\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Nguyễn Thị Minh Kiều\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Vũ Hữu Đức\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Lưu Trường Văn\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Nguyễn Minh Hà\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			PGS.TS. Dương Hồng Thẩm\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Lê Thị Thanh Thu\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Hoàng Mạnh Dũng\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Lê Thị Kính\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Lê Thái Thường Quân\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Cao Xuân Dung\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Thái Thị Ngọc Dư\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Nguyễn Xuân Nghĩa\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			TS. Iwata Yayoi\r\n			\r\n			\r\n			Ủy viên Hội đồng biên tập\r\n			\r\n		\r\n		\r\n			\r\n			ThS. Huỳnh Thị Kim Tuyết\r\n			\r\n			\r\n			Thư ký tòa soạn\r\n			\r\n		\r\n	\r\n\r\n', 1427346308, 5, 1432612488, 38, '*', NULL),
	(4, 'Qui định gởi bài', 'Qui định gởi bài', '4-qui-dinh-goi-bai', '<p style="margin-left:-.75pt">Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh đăng tải các bài báo khoa học; công bố các công trình nghiên cứu khoa học; thông tin các kết quả nghiên cứu khoa học; trao đổi các nội dung mang tính học thuật, quan điểm khoa học, phương pháp tiếp cận các vấn đề khoa học mới; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước.</p>\r\n\r\n<p style="margin-left:-.75pt">Các bài báo khoa học gởi đăng phải bảo đảm điều kiện chưa được công bố trên bất kỳ tạp chí nào hoặc các dạng xuất bản phẩm khác.</p>\r\n\r\n<p style="margin-left:-.75pt">Độ dài bài báo khoa học tối đa không quá 15 trang đánh máy khổ A4 bao gồm cả tài liệu tham khảo (khoảng 7.000 từ). Bài báo khoa học bao gồm các thành phần sau:</p>\r\n\r\n<ol>\r\n	<li>Tựa bài báo bằng tiếng Việt và tiếng Anh</li>\r\n	<li>Tóm tắt bằng tiếng Việt và tiếng Anh: Phần tóm tắt có độ dài không quá nửa trang đánh máy (không quá 250 từ), bao gồm: Khái quát về mục đích, phương pháp nghiên cứu, kết quả đạt được và các kết luận chính. Tóm tắt bằng tiếng Việt và tiếng Anh không khác biệt về nội dung, ý nghĩa.&nbsp; &nbsp;</li>\r\n	<li>Từ khóa: Từ khóa được trình bày theo thứ tự alphabet, không quá 5 từ. Từ khóa bằng tiếng Việt và tiếng Anh phải tương đương về nội dung, ý nghĩa của từ.</li>\r\n	<li>Nội dung bài báo</li>\r\n	<li>Tài liệu tham khảo: Liệt kê tài liệu đã sử dụng, trích dẫn trong bài viết. Tài liệu tham khảo trình bày thống nhất theo quy định của Tạp chí (chuẩn định dạng APA – American Psychological Association).&nbsp;</li>\r\n	<li>Cuối bài viết ghi thông tin về tác giả: Họ và tên, học hàm, học vị, chức vụ công tác, nơi công tác, địa chỉ liên lạc, số điện thoại, email.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Địa chỉ liên hệ và gởi bài báo khoa học</strong>:</p>\r\n\r\n<p><strong>TẠP CHÍ KHOA HỌC ĐẠI HỌC MỞ THÀNH PHỐ HỒ CHÍ MINH </strong></p>\r\n\r\n<p style="margin-left: -0.75pt;">Trụ sở tòa soạn: Trường Đại học Mở Thành phố Hồ Chí Minh &nbsp;</p>\r\n\r\n<p>Số 97, Võ Văn Tần, Phường 6, Quận 3, TP. Hồ Chí Minh &nbsp;</p>\r\n\r\n<p>Điện thoại: 08.39300210, 39304469; Email: tapchikhoahoc@ou.edu.vn&nbsp;</p>\r\n', 'Tạp chí Khoa học Đại học Mở TP. Hồ Chí Minh đăng tải các bài báo khoa học; công bố các công trình nghiên cứu khoa học; thông tin các kết quả nghiên cứu khoa học; trao đổi các nội dung mang tính học thuật, quan điểm khoa học, phương pháp tiếp cận các vấn đề khoa học mới; giới thiệu thông tin khoa học, các hoạt động khoa học trong nước và ngoài nước.\r\n\r\nCác bài báo khoa học gởi đăng phải bảo đảm điều kiện chưa được công bố trên bất kỳ tạp chí nào hoặc các dạng xuất bản phẩm khác.\r\n\r\nĐộ dài bài báo khoa học tối đa không quá 15 trang đánh máy khổ A4 bao gồm cả tài liệu tham khảo (khoảng 7.000 từ). Bài báo khoa học bao gồm các thành phần sau:\r\n\r\n\r\n	Tựa bài báo bằng tiếng Việt và tiếng Anh\r\n	Tóm tắt bằng tiếng Việt và tiếng Anh: Phần tóm tắt có độ dài không quá nửa trang đánh máy (không quá 250 từ), bao gồm: Khái quát về mục đích, phương pháp nghiên cứu, kết quả đạt được và các kết luận chính. Tóm tắt bằng tiếng Việt và tiếng Anh không khác biệt về nội dung, ý nghĩa.&nbsp; &nbsp;\r\n	Từ khóa: Từ khóa được trình bày theo thứ tự alphabet, không quá 5 từ. Từ khóa bằng tiếng Việt và tiếng Anh phải tương đương về nội dung, ý nghĩa của từ.\r\n	Nội dung bài báo\r\n	Tài liệu tham khảo: Liệt kê tài liệu đã sử dụng, trích dẫn trong bài viết. Tài liệu tham khảo trình bày thống nhất theo quy định của Tạp chí (chuẩn định dạng APA – American Psychological Association).&nbsp;\r\n	Cuối bài viết ghi thông tin về tác giả: Họ và tên, học hàm, học vị, chức vụ công tác, nơi công tác, địa chỉ liên lạc, số điện thoại, email.\r\n\r\n\r\n&nbsp;\r\n\r\nĐịa chỉ liên hệ và gởi bài báo khoa học:\r\n\r\nTẠP CHÍ KHOA HỌC ĐẠI HỌC MỞ THÀNH PHỐ HỒ CHÍ MINH \r\n\r\nTrụ sở tòa soạn: Trường Đại học Mở Thành phố Hồ Chí Minh &nbsp;\r\n\r\nSố 97, Võ Văn Tần, Phường 6, Quận 3, TP. Hồ Chí Minh &nbsp;\r\n\r\nĐiện thoại: 08.39300210, 39304469; Email: tapchikhoahoc@ou.edu.vn&nbsp;\r\n', 1427346444, 5, 1428632457, 5, '*', NULL),
	(5, 'Liên hệ', 'Liên hệ', '5-lien-he', '<p><strong>Địa chỉ:</strong> 97 Võ Văn Tần, P6, Quận 3, Tp.HCM</p>\r\n\r\n<p><strong>Điện thoại:</strong> 08. 39 304 469</p>\r\n\r\n<p><strong>Fax:</strong> 08. 39 300 085, 08. 39 306 539</p>\r\n\r\n<p><strong>Email:</strong> tapchikhoahoc@ou.edu.vn</p>\r\n\r\n<p><strong>Website:</strong> http://tckh.ou.edu.vn</p>\r\n', 'Địa chỉ: 97 Võ Văn Tần, P6, Quận 3, Tp.HCM\r\n\r\nĐiện thoại: 08. 39 304 469\r\n\r\nFax: 08. 39 300 085, 08. 39 306 539\r\n\r\nEmail: tapchikhoahoc@ou.edu.vn\r\n\r\nWebsite: http://tckh.ou.edu.vn\r\n', 1427346475, 5, 1428632550, 5, '*', NULL),
	(6, 'Đặt mua', 'Đặt mua', '6-dat-mua', '<p>Đang cập nhật...<br />\r\n&nbsp;</p>\r\n', 'Đang cập nhật...<br />\r\n&nbsp;\r\n', 1427346534, 5, NULL, NULL, '*', NULL),
	(7, 'Bài viết từ năm 2014', 'Bài viết từ năm 2014', '7-bai-viet-tu-nam-2014', '<div><strong>Năm 2014</strong></div>\r\n\r\n<ul>\r\n	<li>Tiếng Việt:\r\n	<ul>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=7"><span style="color:#000080;">Số 1(34) - 2014</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=8"><span style="color:#0000CD;">Số 2(35) - 2014</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=12"><span style="color:#0000CD;">Số 3(36) - 2014</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=9"><span style="color:#0000CD;">Số 4(37) - 2014</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=10"><span style="color:#0000CD;">Số 5(38) - 2014</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=11"><span style="color:#0000CD;">Số 6(39) - 2014</span></a></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div><strong>Năm 2015</strong></div>\r\n\r\n<ul>\r\n	<li>Tiếng Việt:\r\n	<ul>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=2"><span style="color:#0000CD;">Số 1(40) 2015</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=4"><span style="color:#0000CD;">Số 2(41) 2015</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=6"><span style="color:#0000CD;">Số 3(42) 2015<span id="cke_bm_103E" style="display: none;">&nbsp;</span></span></a></li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>Tiếng Anh: </strong>\r\n	<ul>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=3"><span style="color:#0000CD;">Số 1(13) 2015</span></a></li>\r\n		<li><a href="http://tckh.ou.edu.vn/tckh/xemtapchi?idsotapchi=5"><span style="color:#0000CD;">Số 2(14)2015</span></a></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n', 'Năm 2014\r\n\r\n\r\n	Tiếng Việt:\r\n	\r\n		Số 1(34) - 2014\r\n		Số 2(35) - 2014\r\n		Số 3(36) - 2014\r\n		Số 4(37) - 2014\r\n		Số 5(38) - 2014\r\n		Số 6(39) - 2014\r\n	\r\n	\r\n\r\n\r\n&nbsp;\r\n\r\nNăm 2015\r\n\r\n\r\n	Tiếng Việt:\r\n	\r\n		Số 1(40) 2015\r\n		Số 2(41) 2015\r\n		Số 3(42) 2015&nbsp;\r\n	\r\n	\r\n	Tiếng Anh: \r\n	\r\n		Số 1(13) 2015\r\n		Số 2(14)2015\r\n	\r\n	\r\n\r\n', 1435120261, 38, 1439610019, 38, '*', NULL);
/*!40000 ALTER TABLE `web_pages` ENABLE KEYS */;


-- Dumping structure for table tckh.web_permissions
CREATE TABLE IF NOT EXISTS `web_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(100) DEFAULT NULL,
  `p_code` varchar(100) NOT NULL,
  `mod_name` varchar(50) DEFAULT NULL,
  `auto_assign` smallint(6) DEFAULT NULL,
  `public_role` smallint(6) DEFAULT NULL,
  `expiry_time` int(11) DEFAULT NULL,
  `allow_delete` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`,`p_code`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_permissions: ~15 rows (approximately)
/*!40000 ALTER TABLE `web_permissions` DISABLE KEYS */;
INSERT INTO `web_permissions` (`id`, `p_name`, `p_code`, `mod_name`, `auto_assign`, `public_role`, `expiry_time`, `allow_delete`) VALUES
	(15, 'Thay đổi mật khẩu', 'change_password', 'User', 1, 1, NULL, 0),
	(18, 'Quản lý Menu', 'admin_menu', 'Menu', 0, 0, NULL, 0),
	(19, 'Quản lý Trang', 'admin_pages', 'Page', 0, 0, NULL, 0),
	(22, 'Quản lý đăng tin', 'admin_news', 'Đăng tin', 0, 0, NULL, 0),
	(23, 'Đăng bài viết', 'viet_bai_viet', 'Đăng tin', 0, 0, NULL, 0),
	(24, 'Sửa bài viết', 'sua_bai_viet', 'Đăng tin', 0, 0, NULL, 0),
	(25, 'Xóa bài viết', 'xoa_bai_viet', 'Đăng tin', 0, 0, NULL, 0),
	(26, 'Duyệt bài viết', 'duyet_bai_viet', 'Đăng tin', 0, 0, NULL, 0),
	(27, 'Publish bài viết', 'xuat_ban_bai_viet', 'Đăng tin', 0, 0, NULL, 0),
	(34, 'Quản trị viên (Hiển thị admin menu)', 'quan_tri_vien', 'Hệ thống', 0, 0, NULL, 0),
	(35, 'Xem danh sách bài viết', 'xem_ds_baiviet', 'Đăng tin', 0, 0, NULL, 0),
	(44, 'Quản lý Web Link', 'admin_weblink', 'Liên kết Website', 0, 0, NULL, 0),
	(45, 'Quản lý TCKH', 'admin_tckh', 'Tạp chí khoa học', 0, 0, NULL, 0),
	(46, 'Phản biện TCKH', 'phan_bien', 'Tạp chí khoa học', 0, 0, NULL, 0),
	(47, 'Chấm bài', 'cham_bai', 'Tạp chí khoa học', 0, 0, NULL, 0),
	(51, 'Đăng bài viết TCKH', 'viet_bai_tckh', 'Tạp chí khoa học', 0, 0, NULL, 0);
/*!40000 ALTER TABLE `web_permissions` ENABLE KEYS */;


-- Dumping structure for table tckh.web_roles
CREATE TABLE IF NOT EXISTS `web_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `role_code` varchar(100) DEFAULT NULL,
  `allow_delete` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_roles: ~6 rows (approximately)
/*!40000 ALTER TABLE `web_roles` DISABLE KEYS */;
INSERT INTO `web_roles` (`id`, `role_name`, `role_code`, `allow_delete`) VALUES
	(16, 'Truy xuất Menu Quản trị', 'quan_tri_vien', 0),
	(19, 'Authenticated User', 'authed_user', 0),
	(25, 'Quản lý TCKH', 'quan_ly_tckh', 1),
	(26, 'Đăng tin', 'dang_tin', 1),
	(27, 'Quản lý Menu', 'quan_ly_menu', 1),
	(28, 'Quản lý Pages', 'quan_ly_pages', 1);
/*!40000 ALTER TABLE `web_roles` ENABLE KEYS */;


-- Dumping structure for table tckh.web_roles_permissions
CREATE TABLE IF NOT EXISTS `web_roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_web_roles_permissions_web_roles` (`role_id`),
  CONSTRAINT `web_roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `web_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_roles_permissions: ~11 rows (approximately)
/*!40000 ALTER TABLE `web_roles_permissions` DISABLE KEYS */;
INSERT INTO `web_roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
	(37, 25, 45),
	(38, 26, 22),
	(39, 26, 23),
	(40, 26, 24),
	(41, 26, 25),
	(42, 26, 26),
	(43, 26, 27),
	(44, 26, 35),
	(45, 27, 18),
	(46, 28, 19),
	(47, 16, 34),
	(48, 19, 15),
	(49, 19, 51);
/*!40000 ALTER TABLE `web_roles_permissions` ENABLE KEYS */;


-- Dumping structure for table tckh.web_sessions
CREATE TABLE IF NOT EXISTS `web_sessions` (
  `id` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions$sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_sessions: ~2 rows (approximately)
/*!40000 ALTER TABLE `web_sessions` DISABLE KEYS */;
INSERT INTO `web_sessions` (`id`, `payload`, `last_activity`) VALUES
	('572ccfb19806bcaa086a5973caa859245c8c9560', 'YTo2OntzOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJXdWl0dTNnSEg5NjZ6UHV2d1IweTZpNTBVVXRhOGhHVDFKeXpjcTZTIjtzOjc6InZpc2l0ZWQiO2I6MTtzOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aTo1O3M6ODoidXNlcmluZm8iO3M6MTM2MToiTzo0OiJVc2VyIjoyMDp7czo4OiIAKgB0YWJsZSI7czo5OiJ3ZWJfdXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTE6IgAqAGZpbGxhYmxlIjthOjI6e2k6MDtzOjg6InVzZXJuYW1lIjtpOjE7czo4OiJwYXNzd29yZCI7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiIAKgBjb25uZWN0aW9uIjtOO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czoxMzoiACoAYXR0cmlidXRlcyI7YToxMzp7czoyOiJpZCI7aTo1O3M6ODoidXNlcm5hbWUiO3M6NToiYWRtaW4iO3M6MTI6ImRpc3BsYXlfbmFtZSI7czoxMzoiQWRtaW5pc3RhcnRvciI7czo1OiJlbWFpbCI7czowOiIiO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyYSQxMCRLTVhSMzlackJ1Tnk4aktzRG9DSHAuMDNVRk5PaWh5UFBvRDVmc2ZUUXNyUTVhMEF0WDVPSyI7czo5OiJwYXNzd29yZDIiO047czoyOiJzYSI7aToxO3M6MTI6ImJ1aWxkaW5fcm9sZSI7TjtzOjEwOiJsYXN0YWNjZXNzIjtpOjE0NTkwNjc1OTY7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMjoiYWxsb3dfZGVsZXRlIjtpOjA7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAxNC0wOS0xOCAwNTowNzo1MyI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAxNi0wMy0yNyAxNTozMzoxNiI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjEzOntzOjI6ImlkIjtpOjU7czo4OiJ1c2VybmFtZSI7czo1OiJhZG1pbiI7czoxMjoiZGlzcGxheV9uYW1lIjtzOjEzOiJBZG1pbmlzdGFydG9yIjtzOjU6ImVtYWlsIjtzOjA6IiI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJhJDEwJEtNWFIzOVpyQnVOeThqS3NEb0NIcC4wM1VGTk9paHlQUG9ENWZzZlRRc3JRNWEwQXRYNU9LIjtzOjk6InBhc3N3b3JkMiI7TjtzOjI6InNhIjtpOjE7czoxMjoiYnVpbGRpbl9yb2xlIjtOO3M6MTA6Imxhc3RhY2Nlc3MiO2k6MTQ1OTA2NzU5NjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEyOiJhbGxvd19kZWxldGUiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDE0LTA5LTE4IDA1OjA3OjUzIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDE2LTAzLTI3IDE1OjMzOjE2Ijt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czo4OiIAKgBkYXRlcyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6NzoiACoAd2l0aCI7YTowOnt9czoxMzoiACoAbW9ycGhDbGFzcyI7TjtzOjY6ImV4aXN0cyI7YjoxO30iO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDU5MDY3NjQwO3M6MToiYyI7aToxNDU5MDYwOTY5O3M6MToibCI7czoxOiIwIjt9fQ==', 1459067641),
	('ec9d79d5f84d371d63862f4fad3d7521dcd7eef6', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYnE4ZzJ6SUNXYWN2ZjZDY2JaRmk0alZoaU5VSThINEQzeEQ3dFdtbiI7czo3OiJ2aXNpdGVkIjtiOjE7czoxNzoidXJsX3JlcXVlc3RfbG9naW4iO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvdGNraC9wdWJsaWMvdGNraC90aGVtYmFpdmlldCI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aTo0MDtzOjg6InVzZXJpbmZvIjtzOjEzOTk6Ik86NDoiVXNlciI6MjA6e3M6ODoiACoAdGFibGUiO3M6OToid2ViX3VzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjExOiIAKgBmaWxsYWJsZSI7YToyOntpOjA7czo4OiJ1c2VybmFtZSI7aToxO3M6ODoicGFzc3dvcmQiO31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoiACoAY29ubmVjdGlvbiI7TjtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTM6e3M6MjoiaWQiO2k6NDA7czo4OiJ1c2VybmFtZSI7czo5OiJzdXBwb3J0ZXIiO3M6MTI6ImRpc3BsYXlfbmFtZSI7czo4OiJMw6ogVsSDbiI7czo1OiJlbWFpbCI7czoxOToidmFubGU5ODkwQGdtYWlsLmNvbSI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEwJFZtZWE3MzY1eFhjYXcxdjh5WXBPOC54bUtrOGxKVWUzMy9McEp6UUlpaXd5Nkd4SGExUTZXIjtzOjk6InBhc3N3b3JkMiI7TjtzOjI6InNhIjtpOjA7czoxMjoiYnVpbGRpbl9yb2xlIjtOO3M6MTA6Imxhc3RhY2Nlc3MiO2k6MTQ1OTE3MzIzMDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEyOiJhbGxvd19kZWxldGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDE2LTAzLTEzIDE2OjE5OjM2IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDE2LTAzLTI4IDIwOjUzOjUwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTM6e3M6MjoiaWQiO2k6NDA7czo4OiJ1c2VybmFtZSI7czo5OiJzdXBwb3J0ZXIiO3M6MTI6ImRpc3BsYXlfbmFtZSI7czo4OiJMw6ogVsSDbiI7czo1OiJlbWFpbCI7czoxOToidmFubGU5ODkwQGdtYWlsLmNvbSI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEwJFZtZWE3MzY1eFhjYXcxdjh5WXBPOC54bUtrOGxKVWUzMy9McEp6UUlpaXd5Nkd4SGExUTZXIjtzOjk6InBhc3N3b3JkMiI7TjtzOjI6InNhIjtpOjA7czoxMjoiYnVpbGRpbl9yb2xlIjtOO3M6MTA6Imxhc3RhY2Nlc3MiO2k6MTQ1OTE3MzIzMDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEyOiJhbGxvd19kZWxldGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDE2LTAzLTEzIDE2OjE5OjM2IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDE2LTAzLTI4IDIwOjUzOjUwIjt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czo4OiIAKgBkYXRlcyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6NzoiACoAd2l0aCI7YTowOnt9czoxMzoiACoAbW9ycGhDbGFzcyI7TjtzOjY6ImV4aXN0cyI7YjoxO30iO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDU5MTczNTUwO3M6MToiYyI7aToxNDU5MTczMjIxO3M6MToibCI7czoxOiIwIjt9fQ==', 1459173551);
/*!40000 ALTER TABLE `web_sessions` ENABLE KEYS */;


-- Dumping structure for table tckh.web_tckh_baiviet
CREATE TABLE IF NOT EXISTS `web_tckh_baiviet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sotapchi` int(11) DEFAULT NULL,
  `nhombaiviet` varchar(255) DEFAULT NULL,
  `tenbaiviet` longtext,
  `gioithieubaiviet` longtext,
  `noidung` longtext,
  `trangthai` int(2) unsigned DEFAULT NULL,
  `tacgia` mediumtext,
  `sofiles` int(11) DEFAULT '0',
  `ngaynhap` int(11) DEFAULT NULL,
  `usernhap` int(11) DEFAULT NULL,
  `viewno` int(11) DEFAULT '0',
  `quantam` int(11) DEFAULT '0',
  `orderno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sotapchi` (`id_sotapchi`),
  CONSTRAINT `web_tckh_baiviet_ibfk_1` FOREIGN KEY (`id_sotapchi`) REFERENCES `web_tckh_tapchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_tckh_baiviet: ~118 rows (approximately)
/*!40000 ALTER TABLE `web_tckh_baiviet` DISABLE KEYS */;
INSERT INTO `web_tckh_baiviet` (`id`, `id_sotapchi`, `nhombaiviet`, `tenbaiviet`, `gioithieubaiviet`, `noidung`, `trangthai`, `tacgia`, `sofiles`, `ngaynhap`, `usernhap`, `viewno`, `quantam`, `orderno`) VALUES
	(2, 2, 'Kinh tế', 'Nghiên  cứu  các  yếu  tố  ảnh  hưởng đến  việc  doanh  nghiệp  đầu  tư  vào khu  công  nghiệp  và  cụm  công nghiệp trên địa bàn tỉnh Tiền Giang', 'Nghiên  cứu  các  yếu  tố  ảnh  hưởng đến  việc  doanh  nghiệp  đầu  tư  vào khu  công  nghiệp  và  cụm  công nghiệp trên địa bàn tỉnh Tiền Giang', NULL, NULL, '["Nguyễn Minh Hà","Nguyễn Duy Khương"]', 1, 1432698330, 5, 0, 0, NULL),
	(3, 2, 'Kinh tế', 'Ứng dụng mô hình Hedonic để phân tích  mức  đóng  góp  của  các  thuộc  tính vào giá tour du ngoạn biển đảo một ngày tại vịnh Nha Trang', 'Ứng dụng mô hình Hedonic để phân tích  mức  đóng  góp  của  các  thuộc  tính vào giá tour du ngoạn biển đảo một ngày tại vịnh Nha Trang', NULL, NULL, '["Nguyễn Thị Thủy Tiên","Nguyễn Minh Đức"]', 1, 1432708264, 5, 0, 0, NULL),
	(4, 2, 'Kinh tế', 'Nâng cao động lực chia sẻ tri thức của các nhân viên công ty cổ phần Tư vấn xây dựng điện 3', 'Nâng cao động lực chia sẻ tri thức của các nhân viên công ty cổ phần Tư vấn xây dựng điện 3', NULL, NULL, '["Phạm Quốc Trung","Lạc Thái Phước"]', 1, 1432708666, 5, 0, 0, NULL),
	(5, 2, 'Kinh tế', 'Xây dựng mô hình đo lường sự hài lòng  của  nhân  viên  trong  công  việc tại cảng hàng không - Sân bay Pleiku', 'Xây dựng mô hình đo lường sự hài lòng  của  nhân  viên  trong  công  việc tại cảng hàng không - Sân bay Pleiku', NULL, NULL, '["Trịnh Tú Anh","Lê Thị Phương Linh"]', 1, 1432708859, 5, 0, 0, NULL),
	(6, 2, 'Khoa học công nghệ', 'Xây dựng phương pháp luận nghiên cứu  hỗ  trợ  định  danh  nấm  ký  sinh côn  trùng  bằng  phân  tích  phả  hệ phân tử vùng ITS1-5.8S-ITS2', 'Xây dựng phương pháp luận nghiên cứu  hỗ  trợ  định  danh  nấm  ký  sinh côn  trùng  bằng  phân  tích  phả  hệ phân tử vùng ITS1-5.8S-ITS2', NULL, NULL, '["Lê Huyền Ái Thúy","Đinh Minh Hiệp","Trương Bình Nguyên","Lao Đức Thuận","Trương Kim Phượng","Đỗ Ngọc Nam"]', 1, 1432708985, 5, 0, 0, NULL),
	(7, 2, 'Khoa học công nghệ', 'Nghiên cứu quy trình tách chiết beta glucan từ tế bào Saccharomyces Cerevisiae trong bã men bia', 'Nghiên cứu quy trình tách chiết beta glucan từ tế bào Saccharomyces Cerevisiae trong bã men bia', NULL, NULL, '["Lý Thị Minh Hiền","Đoàn Hạnh Kiểm","Trần Thị Thu Chi"]', 1, 1432709117, 5, 0, 0, NULL),
	(8, 2, 'Chính trị - Xã hội', 'Nâng  cao  chất  lượng  công  tác  đối ngoại  quốc  phòng  trong  điều  kiện hiện nay', 'Nâng  cao  chất  lượng  công  tác  đối ngoại  quốc  phòng  trong  điều  kiện hiện nay', NULL, NULL, '["Nguyễn Năng Nam"]', 1, 1432709339, 5, 0, 0, NULL),
	(9, 2, 'Chính trị - Xã hội', 'Tác  động  của  quá  trình  toàn  cầu hóa và hội nhập quốc tế đối với đời sống văn hóa tinh thần của giai cấp công nhân Việt Nam hiện nay', 'Tác  động  của  quá  trình  toàn  cầu hóa và hội nhập quốc tế đối với đời sống văn hóa tinh thần của giai cấp công nhân Việt Nam hiện nay', NULL, NULL, '["Phạm Thị Minh Nguyệt"]', 1, 1432709466, 5, 0, 0, NULL),
	(10, 2, 'Trao đổi học thuật và thông tin khoa học', 'Đào tạo từ xa: Thách thức ở thế kỷ 21', 'Đào tạo từ xa: Thách thức ở thế kỷ 21', NULL, NULL, '["Lê Thị Thanh Thu",""]', 1, 1432709921, 5, 0, 0, NULL),
	(11, 2, 'Trao đổi học thuật và thông tin khoa học', 'Marketing xã hội – Giải pháp kinh tế cho các vấn đề xã hội: Trường hợp công tác phòng chống HIV/AIDS và kế hoạch hóa gia đình', 'Marketing xã hội – Giải pháp kinh tế cho các vấn đề xã hội: Trường hợp công tác phòng chống HIV/AIDS và kế hoạch hóa gia đình', NULL, NULL, '["Lê Sĩ Trí",""]', 1, 1432709940, 5, 0, 0, NULL),
	(12, 3, '', 'The  effect  of  paraquat  herbicide on in vivo spermatogenesis in mice', 'The  effect  of  paraquat  herbicide on in vivo spermatogenesis in mice', NULL, NULL, '["Nguyen Nhut Vu","Nguyen Thi Thuy Hang","Nguyen Thi Bich Thao","Trinh Huu Phuoc"]', 1, 1432711038, 5, 0, 0, NULL),
	(13, 3, '', 'Establishment  of  multiplex  realtime  PCR  assay  for  simultaneous detection  of  herpes  simplex  virus and varicella-zoster virus', 'Establishment  of  multiplex  realtime  PCR  assay  for  simultaneous detection  of  herpes  simplex  virus and varicella-zoster virus', NULL, NULL, '["Lao Duc Thuan","Truong Kim Phuong","Ho Thi Thanh Thuy","Le Huyen Ai Thuy"]', 1, 1432711142, 5, 0, 0, NULL),
	(14, 3, '', 'Discorvery  of  entomopathogenic fungi  Cordyceps  takaomontana  at Langbian  mountain,  Lam  Dong, Vietnam', 'Discorvery  of  entomopathogenic fungi  Cordyceps  takaomontana  at Langbian  mountain,  Lam  Dong, Vietnam', NULL, NULL, '["Vu Tien Luyen","Trinh Van Hanh","Trinh Hoang Luan","Nguyen Thi Bich Thao","Dinh Minh Hiep","Truong Binh Nguyen","Lao Duc Thuan"]', 1, 1432711236, 5, 0, 0, NULL),
	(15, 3, '', 'Isolation  and  identification  of some  Lactobacillus  sp. strain from traditional fermented foods', 'Isolation  and  identification  of some  Lactobacillus  sp. strain from traditional fermented foods', NULL, NULL, '["Truong Kim Phuong","Nguyen Trong Nghia","Le Huyen Ai Thuy"]', 1, 1432711308, 5, 0, 0, NULL),
	(16, 3, '', 'EGFR  and  K-RAS  in  molecularly targeted  therapy:  from  in  silico  to in vitro study', 'EGFR  and  K-RAS  in  molecularly targeted  therapy:  from  in  silico  to in vitro study', NULL, NULL, '["Lieu Chi Hung","Lao Duc Thuan","Le Huyen Ai Thuy"]', 1, 1432711429, 5, 0, 0, NULL),
	(17, 3, '', 'Avoidance of multiple oviposition in Meteorus pulchricornis (hymenoptera: braconidae)', 'Avoidance of multiple oviposition in Meteorus pulchricornis (hymenoptera: braconidae)', NULL, NULL, '["Nguyen Ngoc Bao Chau "]', 1, 1432711472, 5, 0, 0, NULL),
	(18, 3, '', 'Literature review of climate change impact induced migration', 'Literature review of climate change impact induced migration', NULL, NULL, '["Do Thi Kim Chi"]', 1, 1432711510, 5, 0, 0, NULL),
	(19, 4, 'Kinh tế', 'Mô hình Oaxaca - Blinder trong phân tích kinh tế', 'Mô hình Oaxaca - Blinder trong phân tích kinh tế', NULL, NULL, '["Lê Bảo Lâm","Nguyễn Minh Hà","Lê Văn Hưởng"]', 1, 1434967089, 38, 0, 0, NULL),
	(20, 4, 'Kinh tế', 'Ảnh hưởng của thu nhập và giá cả đến chi tiêu cho thực phẩm của các hộ gia đình Việt Nam', 'Ảnh hưởng của thu nhập và giá cả đến chi tiêu cho thực phẩm của các hộ gia đình Việt Nam', NULL, NULL, '["Nguyễn Hữu Dũng","Nguyễn Ngọc Thuyết"]', 1, 1434967761, 38, 0, 0, NULL),
	(21, 4, 'Kinh tế', 'Tác động của các yếu tố quản lý đến hiệu suất của doanh nghiệp xuất khẩu thủy sản tỉnh Bà Rịa-Vũng Tàu', 'Tác động của các yếu tố quản lý đến hiệu suất của doanh nghiệp xuất khẩu thủy sản tỉnh Bà Rịa-Vũng Tàu', NULL, NULL, '["Trần Hữu Ái","Nguyễn Minh Đức"]', 1, 1434967943, 38, 0, 0, NULL),
	(22, 4, 'Kinh tế', 'Cảm nhận giá trị và sự gắn kết nhân viên tại các công ty Kiểm toán trên địa bàn Thành Phố Hồ Chí Minh', 'Cảm nhận giá trị và sự gắn kết nhân viên tại các công ty Kiểm toán trên địa bàn Thành Phố Hồ Chí Minh', NULL, NULL, '["Nguyễn Thế Khải","Đỗ Thị Thanh Trúc"]', 1, 1434968041, 38, 0, 0, NULL),
	(23, 4, 'Kinh tế', 'Chất lượng nhân viên bán hàng, bảo hành và giá trị thương hiệu trong ngành bán lẻ kim khí điện máy', 'Chất lượng nhân viên bán hàng, bảo hành và giá trị thương hiệu trong ngành bán lẻ kim khí điện máy', NULL, NULL, '["Lê Tấn Bửu","Lê Đăng Lăng"]', 1, 1435023438, 38, 0, 0, NULL),
	(24, 4, 'Kinh tế', 'Phân cấp đề tài khóa và tăng trưởng kinh tế: Minh chứng ở Việt Nam', 'Phân cấp tài khóa và tăng trưởng kinh tế: Minh chứng ở Việt Nam', NULL, NULL, '["Trần Phạm Khánh Toàn",""]', 1, 1435030509, 38, 0, 0, NULL),
	(25, 4, 'Kinh tế', 'Mối quan hệ "Tiến-Thoái" giữa Việt Nam và các nướn Asean-4', 'Mối quan hệ "Tiến-Thoái" giữa Việt Nam và các nướn Asean-4', NULL, NULL, '["Lâm Trí Dũng","Lê Sĩ Trí","Trần Nha Ghi"]', 1, 1435030596, 38, 0, 0, NULL),
	(26, 4, 'Giáo dục', 'Nguồn lực tương tác, hành vi hướng tới người học và vai tròn đồng tạo sinh giá trị của học viên trong dịch vụ đào tạo', 'Nguồn lực tương tác, hành vi hướng tới người học và vai tròn đồng tạo sinh giá trị của học viên trong dịch vụ đào tạo', NULL, NULL, '["Hồ Hoàng Diệu","Phạm Ngọc Thúy"]', 1, 1435030755, 38, 0, 0, NULL),
	(27, 4, 'Giáo dục', 'Chiến lược phát triển của trường đại học ngoài công lập: Nghiên cứu trường hợp Trường Đại học Đông Á-Đà Nẵng', 'Chiến lược phát triển của trường đại học ngoài công lập: Nghiên cứu trường hợp Trường Đại học Đông Á-Đà Nẵng', NULL, NULL, '["Nhâm Phong Tuân","Đặng Thị Kim Thoa"]', 1, 1435030930, 38, 0, 0, NULL),
	(28, 4, 'Khoa học Kỹ thuật', 'Phân tích phi tuyến khung dàn thép phẳng sử dụng phương pháp dầm-cột', 'Phân tích phi tuyến khung dàn thép phẳng sử dụng phương pháp dầm-cột', NULL, NULL, '["Đặng Thị Phương Uyên","Lê Thanh Cường","Ngô Hữu Cường"]', 1, 1435031627, 38, 0, 0, NULL),
	(29, 4, 'Trao đổi học thuật và thông tin khoa học', 'Quản lý nợ công tại Việt Nam nhìn từ thông lệ quốc tế và một số khủng hoảng nợ công trên thế giới', 'Quản lý nợ công tại Việt Nam nhìn từ thông lệ quốc tế và một số khủng hoảng nợ công trên thế giới', NULL, NULL, '["Nguyễn Quốc Toản"]', 1, 1435031732, 38, 0, 0, NULL),
	(30, 5, 'ECONOMICS', 'Interest  rate  pass- through  estimates from error correction models ECM', 'Interest  rate  pass- through  estimates from error correction models ECM', NULL, NULL, '["Le Phan Thi Dieu Thao","Nguyen Thi Thu Trang"]', 1, 1435051796, 38, 0, 0, NULL),
	(31, 5, 'ECONOMICS', 'An assessment of multidimensional urban  poverty  in  Vietnam  central cities', 'An assessment of multidimensional urban  poverty  in  Vietnam  central cities', NULL, NULL, '["Nguyen Huu Dung","Nguyen Van Cuong"]', 1, 1435051871, 38, 0, 0, NULL),
	(32, 5, 'ECONOMICS', 'Government’s  and  professional associations’  roles  in  promoting corporate  social  resposibility  – An  exploratory in  Vietnamese construction firms', 'Government’s  and  professional associations’  roles  in  promoting corporate  social  resposibility  – An  exploratory in  Vietnamese construction firms', NULL, NULL, '["Le Thi Thanh Xuan","Tran Tien Khoa"]', 1, 1435051994, 38, 0, 0, NULL),
	(33, 5, 'ECONOMICS', 'Assessing the development potential of modern retail in Vietnam', 'Assessing the development potential of modern retail in Vietnam', NULL, NULL, '["Tran Tuan Anh"]', 1, 1435052042, 38, 0, 0, NULL),
	(34, 5, 'ECONOMICS', 'Customer satisfaction and customer loyalty  in  Vietnamese  mobile telecommunication industry', 'Customer satisfaction and customer loyalty  in  Vietnamese  mobile telecommunication industry', NULL, NULL, '["Trinh Kim Hoa","Luu Thi Bich Ngoc"]', 1, 1435052097, 38, 0, 0, NULL),
	(35, 5, 'EDUCATION', 'Common  errors  in  writing  journals of  the  english-major  students  at  Ho Chi Minh City   Open University', 'Common  errors  in  writing  journals of  the  english-major  students  at  Ho Chi Minh City   Open University', NULL, NULL, '["Pham Vu Phi Ho","Pham Ngoc Thuy Duong"]', 1, 1435052163, 38, 0, 0, NULL),
	(36, 5, 'EDUCATION', 'Student  -   teachers’  self- assessment of their autonomy', 'Student  -   teachers’  self- assessment of their autonomy', NULL, NULL, '["Phan Thi Thu Nga"]', 1, 1435053814, 38, 0, 0, NULL),
	(37, 5, 'TECHNOLOGY', 'Experimental studies on ingredients of  composite  soil  for  a  higher strength backfill material', 'Experimental studies on ingredients of  composite  soil  for  a  higher strength backfill material', NULL, NULL, '["Duong Hong Tham","Truong Dinh Duong","Huynh Huu Minh Dang","Le Huyen Thoai"]', 1, 1435053896, 38, 0, 0, NULL),
	(38, 5, 'TECHNOLOGY', 'The family braconidae (hymenoptera) parasitoids: Taxonomy and behavior', 'The family braconidae (hymenoptera) parasitoids: Taxonomy and behavior', NULL, NULL, '["Nguyen Ngoc Bao Chau","Nguyen Bao Quoc"]', 1, 1435053973, 38, 0, 0, NULL),
	(39, 5, 'ACADEMIC EXCHANGE AND SCIENTIFIC INFORMATION', 'Evaluation use and influence – A review of related literature', 'Evaluation use and influence – A review of related literature', NULL, NULL, '["Ha Minh Tri"]', 1, 1435054026, 38, 0, 0, NULL),
	(40, 6, 'Kinh tế', 'Đi tìm giá trị hợp lý của các cổ phiếu hàng đầu trên sàn giao dịch chứng khoán  Thành phố Hồ Chí Minh (Hose)', 'Đi tìm giá trị hợp lý của các cổ phiếu hàng đầu trên sàn giao dịch chứng khoán  Thành phố Hồ Chí Minh (Hose)', NULL, NULL, '["Vương Đức Hoàng Quân"]', 1, 1435915245, 38, 0, 0, NULL),
	(41, 6, 'Kinh tế', 'Yếu  tố  chuyển  giao  của  hoạt  động  nhượng quyền thương mại trong lĩnh vực ăn uống-giải khát: Trường hợp nghiên cứu tại Việt Nam', 'Yếu  tố  chuyển  giao  của  hoạt  động  nhượng quyền thương mại trong lĩnh vực ăn uống-giải khát: Trường hợp nghiên cứu tại Việt Nam', NULL, NULL, '["Nguyễn Khánh Trung "]', 1, 1435915413, 38, 0, 0, NULL),
	(42, 6, 'Kinh tế', 'Lòng  trung  thành  thương  hiệu  trong  mối quan  hệ  B2B:  Trường  hợp  sản  phẩm  thuốc bảo vệ thực vật tại đồng bằng sông Cửu Long', 'Lòng  trung  thành  thương  hiệu  trong  mối quan  hệ  B2B:  Trường  hợp  sản  phẩm  thuốc bảo vệ thực vật tại đồng bằng sông Cửu Long', NULL, NULL, '["Hoàng Thị Phương Thảo","Nguyễn Công Phục"]', 1, 1435915610, 38, 0, 0, NULL),
	(43, 6, 'Kinh tế', 'Mối quan hệ giữa hành vi của Bác sĩ với sự tin tưởng, hài lòng và lòng trung thành của bệnh  nhân  -  Một  nghiên  cứu  tại  các  bệnh viện tỉnh Lâm Đồng', 'Mối quan hệ giữa hành vi của Bác sĩ với sự tin tưởng, hài lòng và lòng trung thành của bệnh  nhân  -  Một  nghiên  cứu  tại  các  bệnh viện tỉnh Lâm Đồng', NULL, NULL, '["Nguyễn Thúy Quỳnh Loan","Lê Quang Vinh"]', 1, 1435915704, 38, 0, 0, NULL),
	(44, 6, 'Kinh tế', 'Tổng  quan  cơ  sở  khoa  học  cho  phát  triểnnông thôn bền vững ở Việt Nam', 'Tổng  quan  cơ  sở  khoa  học  cho  phát  triểnnông thôn bền vững ở Việt Nam', NULL, NULL, '["Trần Tiến Khai"]', 1, 1435915833, 38, 0, 0, NULL),
	(45, 6, 'Kinh tế', 'Có  tiền  vẫn  chưa  đủ:  Vai  trò  của  sự  tham gia của khách hàng trong quá trình đồng tạo sinh  dịch  vụ  và  cảm  nhận  giá  trị.  Một nghiên cứu trong ngành đào tạo Đại học', 'Có  tiền  vẫn  chưa  đủ:  Vai  trò  của  sự  tham gia của khách hàng trong quá trình đồng tạo sinh  dịch  vụ  và  cảm  nhận  giá  trị.  Một nghiên cứu trong ngành đào tạo Đại học', NULL, NULL, '["Mai Thị Mỹ Quyên","Lê Nguyễn Hậu"]', 1, 1435915979, 38, 0, 0, NULL),
	(46, 6, 'Kinh tế', 'Mô  hình  lý  thuyết  về  hiệu  quả  đội  trong doanh nghiệp Việt Nam', 'Mô  hình  lý  thuyết  về  hiệu  quả  đội  trong doanh nghiệp Việt Nam', NULL, NULL, '["Huỳnh Thị Minh Châu","Trương Thị Lan Anh","Nguyễn Mạnh Tuân"]', 1, 1435916074, 38, 0, 0, NULL),
	(47, 6, 'Kinh tế', 'Kinh tế ngầm & tham nhũng tại các quốc gia Đông Nam Á', 'Kinh tế ngầm & tham nhũng tại các quốc gia Đông Nam Á', NULL, NULL, '["Võ Hồng Đức","Lý Hưng Thịnh"]', 1, 1435916138, 38, 0, 0, NULL),
	(48, 6, 'Kinh tế', 'Tiền tố và hậu tố của chất lượng mối quan hệ giữa người trồng hoa công nghệ cao với nhà phân phối tại Đà Lạt', 'Tiền tố và hậu tố của chất lượng mối quan hệ giữa người trồng hoa công nghệ cao với nhà phân phối tại Đà Lạt', NULL, NULL, '["Trần Thị Lam Phương","Sử Thị Oanh Hoa","Phạm Ngọc Thúy",""]', 1, 1435916354, 38, 0, 0, NULL),
	(49, 6, 'Kinh tế', 'Ảnh hưởng của chính sách vốn lưu động đến hiệu quả hoạt động của các công ty niêm yết trên thị trường chứng khoán Việt Nam', 'Ảnh hưởng của chính sách vốn lưu động đến hiệu quả hoạt động của các công ty niêm yết trên thị trường chứng khoán Việt Nam', NULL, NULL, '["Tô Thị Thanh Trúc","Nguyễn Đình Thiên"]', 1, 1435916430, 38, 0, 0, NULL),
	(50, 6, 'Kinh tế', 'Định  hướng  giá  trị  khi  đi  mua  sắm  của người tiêu dùng đối với các kênh phân phối hiện  đại:  Một  nghiên  cứu  tại  các  siêu  thị điện máy Thành phố Hồ Chí Minh', 'Định  hướng  giá  trị  khi  đi  mua  sắm  của người tiêu dùng đối với các kênh phân phối hiện  đại:  Một  nghiên  cứu  tại  các  siêu  thị điện máy Thành phố Hồ Chí Minh', NULL, NULL, '["Hứa Kiều Phương Mai","Lê Phước Luông","Lê Nguyễn Hậu"]', 1, 1435916523, 38, 0, 0, NULL),
	(51, 6, 'Kinh tế', 'Vai trò của du lịch đối với tăng trưởng kinh tế Việt Nam', 'Vai trò của du lịch đối với tăng trưởng kinh tế Việt Nam', NULL, NULL, '["Nguyễn Quyết","Võ Thanh Hải"]', 1, 1435916621, 38, 0, 0, NULL),
	(52, 6, 'Kinh tế', 'Các rào cản thương mại khi xuất khẩu thủy sản vào thị trường quốc tế', 'Các rào cản thương mại khi xuất khẩu thủy sản vào thị trường quốc tế', NULL, NULL, '["Trần Hữu Ái"]', 1, 1435916688, 38, 0, 0, NULL),
	(53, 6, 'Trao đổi học thuật và thông tin khoa học', 'Sự khác biệt của tiêu chuẩn ISO 9001:2015', 'Sự khác biệt của tiêu chuẩn ISO 9001:2015', NULL, NULL, '["Hoàng Mạnh Dũng","Trịnh Tuấn Dũng"]', 1, 1435916755, 38, 0, 0, NULL),
	(54, 6, 'Trao đổi học thuật và thông tin khoa học', 'Bàn về thuật ngữ “văn bản pháp luật” trong hệ thống pháp luật Việt Nam', 'Bàn về thuật ngữ “văn bản pháp luật” trong hệ thống pháp luật Việt Nam', NULL, NULL, '["Trần Thị Mai Phước"]', 1, 1435916863, 38, 0, 0, NULL),
	(55, 6, 'Trao đổi học thuật và thông tin khoa học', 'Kinh  nghiệm  phát  triển  năng  lượng  tái tạo  của  Trung  Quốc  và  bài  học  đối  với Việt Nam', 'Kinh  nghiệm  phát  triển  năng  lượng  tái tạo  của  Trung  Quốc  và  bài  học  đối  với Việt Nam', NULL, NULL, '["Nguyễn Hùng Cường"]', 1, 1435916918, 38, 0, 0, NULL),
	(56, 7, 'Kinh tế', 'Tìm hiểu lịch sử tăng trưởng kinh tế thế giới trong 2000 năm', 'Tìm hiểu lịch sử tăng trưởng kinh tế thế giới trong 2000 năm', NULL, NULL, '["Nguyễn Văn Phúc"]', 1, 1437971311, 38, 0, 0, NULL),
	(57, 7, 'Kinh tế', 'Các yếu tố tác động đến thù lao Hội đồng quản trị: Bằng chứng từ các công ty niêm yết ở Sở giao dịch chứng khoán TP.HCM', 'Các yếu tố tác động đến thù lao Hội đồng quản trị: Bằng chứng từ các công ty niêm yết ở Sở giao dịch chứng khoán TP.HCM', NULL, NULL, '["Võ Hồng Đức","Hoàng Đình Sơn","Phan Bùi Gia Thủy"]', 1, 1437971467, 38, 0, 0, NULL),
	(58, 7, 'Kinh tế', 'Mô  hình  toán  thiết  kế  chuỗi  cung  ứng: Xem xét công suất vận hành của các đơn vị kinh doanh', 'Mô  hình  toán  thiết  kế  chuỗi  cung  ứng: Xem xét công suất vận hành của các đơn vị kinh doanh', NULL, NULL, '["Đường Võ Hùng","Bùi Nguyên Hùng"]', 1, 1437971515, 38, 0, 0, NULL),
	(59, 7, 'Kinh tế', 'Xây dựng và vận dụng hệ thống đánh giá năng  lực  nhân  viên  để  đề  xuất  chương trình đào tạo phù hợp', 'Xây dựng và vận dụng hệ thống đánh giá năng  lực  nhân  viên  để  đề  xuất  chương trình đào tạo phù hợp', NULL, NULL, '["Trần Minh Thư","Bùi Văn Dự"]', 1, 1437971599, 38, 0, 0, NULL),
	(60, 7, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI', 'Phát huy chủ nghĩa yêu nước Việt Nam trong thời kỳ đẩy mạnh công nghiệp hóa, hiện đại hóa', 'Phát huy chủ nghĩa yêu nước Việt Nam trong thời kỳ đẩy mạnh công nghiệp hóa, hiện đại hóa', NULL, NULL, '["Nguyễn Năng Nam","Nguyễn Đình Bắc",""]', 1, 1437971772, 38, 0, 0, NULL),
	(61, 7, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI', '“Lộn trái” một hình tượng mở lối mới tìm hiểu tư tưởng chủ đề Nho lâm Ngoại sử', '“Lộn trái” một hình tượng mở lối mới tìm hiểu tư tưởng chủ đề Nho lâm Ngoại sử', NULL, NULL, '["Lê Thời Tân"]', 1, 1437971838, 38, 0, 0, NULL),
	(62, 7, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI', 'Xây dựng nông thôn mới ở vùng người Khmer:  Thách  thức  của  sự  nghèo  đói, sinh kế và di cư', 'Xây dựng nông thôn mới ở vùng người Khmer:  Thách  thức  của  sự  nghèo  đói, sinh kế và di cư', NULL, NULL, '["Phạm Thanh Thôi",""]', 1, 1437973342, 38, 0, 0, NULL),
	(63, 7, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI', 'Tại sao sinh viên từ xa Trường Đại Học Mở Thành Phố Hồ Chí Minh bỏ học?', 'Tại sao sinh viên từ xa Trường Đại Học Mở Thành Phố Hồ Chí Minh bỏ học?', NULL, NULL, '["Lê Thị Thanh Thu"]', 1, 1437973422, 38, 0, 0, NULL),
	(64, 7, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI', 'Luận văn tốt nghiệp đại học ngành quản trị – cách tiếp cận từ phương pháp định tính 93', 'Luận văn tốt nghiệp đại học ngành quản trị – cách tiếp cận từ phương pháp định tính 93', NULL, NULL, '["Trần Tiến Khoa","Lê Thị Thanh Xuân"]', 1, 1437973482, 38, 0, 0, NULL),
	(65, 7, 'Khoa học Kỹ thuật', 'Phân tích sự hiệu quả giảm chấn của gối trượt ma sát kết hợp hệ cản lưu biến từ nối giữa hai kết cấu chịu động đất', 'Phân tích sự hiệu quả giảm chấn của gối trượt ma sát kết hợp hệ cản lưu biến từ nối giữa hai kết cấu chịu động đất', NULL, NULL, '["Phạm Đình Trung","Nguyễn Văn Nam","Nguyễn Trọng Phước"]', 1, 1437973556, 38, 0, 0, NULL),
	(66, 8, 'Kinh tế', 'Văn hóa ảnh hưởng gián tiếp lên hành vi tiêu dùng: Một tổng lược lý thuyết', 'Văn hóa ảnh hưởng gián tiếp lên hành vi tiêu dùng: Một tổng lược lý thuyết', NULL, NULL, '["Nguyễn Văn Phúc","Nguyễn Đình Trọng"]', 1, 1438936287, 38, 0, 0, NULL),
	(67, 8, 'Kinh tế', 'Các nhân tố tác động đến hiệu quả sản xuất  của  doanh  nghiệp  vừa  và  nhỏ  tại Việt Nam', 'Các nhân tố tác động đến hiệu quả sản xuất  của  doanh  nghiệp  vừa  và  nhỏ  tại Việt Nam', NULL, NULL, '["Võ Hồng Đức","Lê Hoàng Long"]', 1, 1438936740, 38, 0, 0, NULL),
	(68, 8, 'Kinh tế', 'Ý định thuê văn phòng ảo của các doanh nghiệp nhỏ và vừa', 'Ý định thuê văn phòng ảo của các doanh nghiệp nhỏ và vừa', NULL, NULL, '["Bùi Thanh Tráng",""]', 1, 1438937164, 38, 0, 0, NULL),
	(69, 8, 'Kinh tế', 'Phân tích lợi ích tài chính của chuỗi giá trị bưởi Da xanh tỉnh Bến Tre', 'Phân tích lợi ích tài chính của chuỗi giá trị bưởi Da xanh tỉnh Bến Tre', NULL, NULL, '["Hoàng Văn Việt"]', 1, 1438937317, 38, 0, 0, NULL),
	(70, 8, 'Kinh tế', 'Quan hệ của viện trợ nước ngoài và tăng trưởng kinh tế thực tiễn tại Việt Nam', 'Quan hệ của viện trợ nước ngoài và tăng trưởng kinh tế thực tiễn tại Việt Nam', NULL, NULL, '["Nguyễn Quyết"]', 1, 1438937433, 38, 0, 0, NULL),
	(71, 8, 'Chính trị - Xã hội', 'Tư tưởng Hồ Chí Minh về bình đẳng dân tộc ở Việt Nam', 'Tư tưởng Hồ Chí Minh về bình đẳng dân tộc ở Việt Nam', NULL, NULL, '["Nguyễn Năng Nam","Trần Minh Quốc"]', 1, 1438937491, 38, 0, 0, NULL),
	(72, 8, 'Chính trị - Xã hội', 'Hiện trạng và khả năng tiếp cận phúc lợi xã  hội  của  người  công  nhân  đang  làm việc  tại  các  khu  công  nghiệp  tỉnh  Bình Dương, Việt Nam', 'Hiện trạng và khả năng tiếp cận phúc lợi xã  hội  của  người  công  nhân  đang  làm việc  tại  các  khu  công  nghiệp  tỉnh  Bình Dương, Việt Nam', NULL, NULL, '["Nguyễn Đức Lộc"]', 1, 1438937546, 38, 0, 0, NULL),
	(73, 8, 'Khoa học Kỹ thuật', 'Phân tích ổn định của tấm FGMsử dụng lý thuyết biến dạng cắt bậc cao', 'Phân tích ổn định của tấm FGMsử dụng lý thuyết biến dạng cắt bậc cao', NULL, NULL, '["Ngô Phát Đạt","Ngô Thành Phong","Trần Trung Dũng"]', 1, 1438937607, 38, 0, 0, NULL),
	(74, 8, 'GIỚI THIỆU SÁCH', 'Làng Việt – Đối diện tương lai hồi sinh quá khứ', 'Làng Việt – Đối diện tương lai hồi sinh quá khứ', NULL, NULL, '["Lê Minh Tiến"]', 1, 1438937708, 38, 0, 0, NULL),
	(75, 8, 'THÔNG TIN HOẠT ĐỘNG KHOA HỌC', 'Sinh  viên  nghiên  cứu  khoa  học Trường Đại Học Mở Tp.HCM năm học 2012-2013', 'Sinh  viên  nghiên  cứu  khoa  học Trường Đại Học Mở Tp.HCM năm học 2012-2013', NULL, NULL, '["Huỳnh Thị Kim Tuyết"]', 1, 1438937760, 38, 0, 0, NULL),
	(76, 9, 'Công nghệ', 'Bước đầu xây dựng quy trình PCR nhằm phát hiện thành phần động vật trong thực phẩm  chay  dựa  trên  vùng  16S  rDNA  ty thể', 'Bước đầu xây dựng quy trình PCR nhằm phát hiện thành phần động vật trong thực phẩm  chay  dựa  trên  vùng  16S  rDNA  ty thể', NULL, NULL, '["Lao Đức Thuận","Nguyễn Thị Thanh Nhàn","Nguyễn Thị Thiên Hương","Trần Kiến Đức","Võ Phi Phi Nguyên","Phan Thi Trâm","Lê Huyền Ái Thúy"]', 1, 1438939173, 38, 0, 0, NULL),
	(77, 9, 'Công nghệ', 'Khảo  sát  tác  dụng  hạ  đường  huyết  của một số loại thảo dược trên mô hình chuột In Vivo', 'Khảo  sát  tác  dụng  hạ  đường  huyết  của một số loại thảo dược trên mô hình chuột In Vivo', NULL, NULL, '["Hồ Thị Huyền Trang","Phạm Thị Ngọc Bích","Phạm Xuân Xinh","Trương Thị Bạch Vân","Vũ Tiến Luyện","Lao Đức Thuận"]', 1, 1438939255, 38, 0, 0, NULL),
	(78, 9, 'Công nghệ', 'Khảo sát thiên địch và sâu hại rau  ở  một số  vườn rau canh tác an toàn huyện  Hóc Môn  và  đánh  giá  khá  năng  ký  sinh  của ong ký sinh Cotesia plutellae Kurdjumov', 'Khảo sát thiên địch và sâu hại rau  ở  một số  vườn rau canh tác an toàn huyện  Hóc Môn  và  đánh  giá  khá  năng  ký  sinh  của ong ký sinh Cotesia plutellae Kurdjumov', NULL, NULL, '["Cao Hoàng Yến Nhi","Lê Thị Bích Liên","Đặng Thị Kim Chi","Trương Thành Đạt","Nguyễn Thị Thanh Thảo","Trịnh Đức Thịnh","Đặng Thị Tình","Nguyễn Thanh Bạch","Trần Hậu Toàn","Nguyễn Đức Nam","Nguyễn Ngọc Bảo Châu"]', 1, 1438939382, 38, 0, 0, NULL),
	(79, 9, 'Kinh tế', 'Kiểm định đồng liên kết giữa giá cà phê Việt Nam xuất khẩu và giá cà phê thế giới giai đoạn 2008 -2014', 'Kiểm định đồng liên kết giữa giá cà phê Việt Nam xuất khẩu và giá cà phê thế giới giai đoạn 2008 -2014', NULL, NULL, '["Nguyễn Văn Phúc","Tô Thị Kim Hồng"]', 1, 1438939438, 38, 0, 0, NULL),
	(80, 9, 'Kinh tế', 'Yếu tố quyết định tỷ lệ an toàn vốn: Bằng chứng  thực  nghiệm  từ  hệ  thống  Ngân hàng Thương Mại Việt Nam', 'Yếu tố quyết định tỷ lệ an toàn vốn: Bằng chứng  thực  nghiệm  từ  hệ  thống  Ngân hàng Thương Mại Việt Nam', NULL, NULL, '["Võ Hồng Đức","Nguyễn Minh Vương","Đỗ Thành Trung"]', 1, 1438939497, 38, 0, 0, NULL),
	(81, 9, 'Kinh tế', 'Ảnh  hưởng  của  phong  cách  lãnh  đạo người  Nhật  đến  kết  quả  làm  việc của  nhân  viên  tại  các  công  ty  Nhật  ở Việt Nam', 'Ảnh  hưởng  của  phong  cách  lãnh  đạo người  Nhật  đến  kết  quả  làm  việc của  nhân  viên  tại  các  công  ty  Nhật  ở Việt Nam', NULL, NULL, '["Nguyễn Minh Hà","Phạm Thế Khánh","Lê Khoa Huân"]', 1, 1438939558, 38, 0, 0, NULL),
	(82, 9, 'Kinh tế', 'Tác  động  của  hoạt  động  quản  trị  nguồn nhân lực đối với độ hài lòng  trong công việc và hiệu quả công việc', 'Tác  động  của  hoạt  động  quản  trị  nguồn nhân lực đối với độ hài lòng  trong công việc và hiệu quả công việc', NULL, NULL, '["Lưu Thị Bích Ngọc","Lưu Hoàng Mai"]', 1, 1438939637, 38, 0, 0, NULL),
	(83, 9, 'Kinh tế', 'Giải  pháp  tăng  hiệu  quả  sản  xuất  tôm càng xanh tại tỉnh Đồng Tháp', 'Giải  pháp  tăng  hiệu  quả  sản  xuất  tôm càng xanh tại tỉnh Đồng Tháp', NULL, NULL, '["Nguyễn Kim Phước",""]', 1, 1438939689, 38, 0, 0, NULL),
	(84, 9, 'TRAO ĐỔI HỌC THUẬT', 'Định  hướng  phát  triển  thị  trường  chứng khoán phái sinh ở nước ta', 'Định  hướng  phát  triển  thị  trường  chứng khoán phái sinh ở nước ta', NULL, NULL, '["Thái Đắc Liệt"]', 1, 1438939738, 38, 0, 0, NULL),
	(85, 9, 'GIỚI THIỆU SÁCH', 'Thế giới như tôi thấy', 'Thế giới như tôi thấy', NULL, NULL, '["Nguyễn Thị Ngọc Tú"]', 1, 1438939790, 38, 0, 0, NULL),
	(86, 10, 'Kinh tế', 'Khủng  hoảng  nợ  công  châu  Âu  và bài học cho Việt Nam', 'Khủng  hoảng  nợ  công  châu  Âu  và bài học cho Việt Nam', NULL, NULL, '["Nguyễn Văn Phúc"]', 1, 1439002374, 38, 0, 0, NULL),
	(87, 10, 'Kinh tế', 'Các yếu tố ảnh hưởng đến thời gian gắn  kết  của  giáo  viên  cơ  hữu  tại Trường  PTTH  ngoài  công  lập  trên địa bàn TP.HCM', 'Các yếu tố ảnh hưởng đến thời gian gắn  kết  của  giáo  viên  cơ  hữu  tại Trường  PTTH  ngoài  công  lập  trên địa bàn TP.HCM', NULL, NULL, '["Nguyễn Nguyên Bằng","Nguyễn Minh Hà","Lê Khoa Huân"]', 1, 1439002495, 38, 0, 0, NULL),
	(88, 10, 'Kinh tế', 'Trách  nhiệm  xã  hội  của  doanh nghiệp  từ  nhận  thức  của  sinh  viên đại học', 'Trách  nhiệm  xã  hội  của  doanh nghiệp  từ  nhận  thức  của  sinh  viên đại học', NULL, NULL, '["Nguyễn Đình Hải","Trần Tiến Khoa","Lê Thị Thanh Xuân"]', 1, 1439002567, 38, 0, 0, NULL),
	(89, 10, 'Kinh tế', 'Danh tiếng tổ chức đào tạo theo góc nhìn học viên cao học', 'Danh tiếng tổ chức đào tạo theo góc nhìn học viên cao học', NULL, NULL, '["Hoàng Thị Phương Thảo"]', 1, 1439002621, 38, 0, 0, NULL),
	(90, 10, 'Kinh tế', 'Các  yếu  tố  ảnh  hưởng  đến  quyết định  chọn  dịch  vụ  hỗ  trợ  tuyển dụng  nhân  sự  cao  cấp  của  các doanh nghiệp TP.HCM', 'Các  yếu  tố  ảnh  hưởng  đến  quyết định  chọn  dịch  vụ  hỗ  trợ  tuyển dụng  nhân  sự  cao  cấp  của  các doanh nghiệp TP.HCM', NULL, NULL, '["Nguyễn Minh Nhật","Lại Văn Tài"]', 1, 1439002684, 38, 0, 0, NULL),
	(91, 10, 'Kinh tế', 'Quan  hệ  giữa  tăng  trưởng  kinh  tế và  tiêu  thụ  điện  năng  thực  tiễn  tại Việt Nam', 'Quan  hệ  giữa  tăng  trưởng  kinh  tế và  tiêu  thụ  điện  năng  thực  tiễn  tại Việt Nam', NULL, NULL, '["Nguyễn Quyết","Vũ Quốc Khánh"]', 1, 1439002770, 38, 0, 0, NULL),
	(92, 10, 'CHÍNH TRỊ - GIÁO DỤC  - XÃ HỘI', 'Tổng  quan  những  nghiên  cứu  đa ngành về lễ hội: Đề xuất hướng tiếp cận liên ngành trong bối cảnh đô thị ', 'Tổng  quan  những  nghiên  cứu  đa ngành về lễ hội: Đề xuất hướng tiếp cận liên ngành trong bối cảnh đô thị ', NULL, NULL, '["Phạm Thanh Thôi"]', 1, 1439002891, 38, 0, 0, NULL),
	(93, 10, 'CHÍNH TRỊ - GIÁO DỤC  - XÃ HỘI', 'Những hạn chế trong phương pháp dạy  và  học  môn  Viết  tại  Khoa Ngoại  ngữ  Trường  Đại  học  Mở TP.HCM', 'Những hạn chế trong phương pháp dạy  và  học  môn  Viết  tại  Khoa Ngoại  ngữ  Trường  Đại  học  Mở TP.HCM', NULL, NULL, '["Phạm Vũ Phi Hổ"]', 1, 1439002950, 38, 0, 0, NULL),
	(94, 10, 'CHÍNH TRỊ - GIÁO DỤC  - XÃ HỘI', 'Đo lường kết quả đọc âm cuối tiếng Anh  của  sinh  viên  năm  1,  khoá 2011  chuyên  ngành  tiếng  Anh  tạiTrường Đại học Mở TP.HCM', 'Đo lường kết quả đọc âm cuối tiếng Anh  của  sinh  viên  năm  1,  khoá 2011  chuyên  ngành  tiếng  Anh  tạiTrường Đại học Mở TP.HCM', NULL, NULL, '["Nguyễn Thị Hoài Minh","Nguyễn Vũ Phương Thảo"]', 1, 1439003049, 38, 0, 0, NULL),
	(95, 10, 'CHÍNH TRỊ - GIÁO DỤC  - XÃ HỘI', 'Vài  nét  về  nghệ  thuật  chiến  dịch trong  chiến  tranh  nhân  dân Việt Nam', 'Vài  nét  về  nghệ  thuật  chiến  dịch trong  chiến  tranh  nhân  dân Việt Nam', NULL, NULL, '["Nguyễn Anh Cường"]', 1, 1439003146, 38, 0, 0, NULL),
	(96, 11, 'Kinh tế', 'Các nhân tố ảnh hưởng đến sự thành công của các dự án hệ thống thông tin ở TP.HCM', 'Các nhân tố ảnh hưởng đến sự thành công của các dự án hệ thống thông tin ở TP.HCM', NULL, NULL, '["Nguyễn Văn Phúc","Phạm Trần Sĩ Lâm"]', 1, 1439521779, 38, 0, 0, NULL),
	(97, 11, 'Kinh tế', 'Một số nhân tố ảnh hưởng đến lòng trung thành của khách hàng: Một nghiên cứu về dịch vụ hàng không nội địa ở Việt Nam', 'Một số nhân tố ảnh hưởng đến lòng trung thành của khách hàng: Một nghiên cứu về dịch vụ hàng không nội địa ở Việt Nam', NULL, NULL, '["Dương Thanh Truyền","Nguyễn Thị Mai Trang"]', 1, 1439521910, 38, 0, 0, NULL),
	(98, 11, 'Kinh tế', 'Nhìn lại quá trình chuyển dịch cơ cấu kinh tế trên địa bàn TP.HCM', 'Nhìn lại quá trình chuyển dịch cơ cấu kinh tế trên địa bàn TP.HCM', NULL, NULL, '["Vương Đức Hoàng Quân"]', 0, 1439522050, 38, 0, 0, NULL),
	(99, 11, 'Kinh tế', 'Rủi ro trong các dự án xây dựng công trình giao thông ở Việt Nam', 'Rủi ro trong các dự án xây dựng công trình giao thông ở Việt Nam', NULL, NULL, '["Trịnh Thùy Anh"]', 1, 1439525285, 38, 0, 0, NULL),
	(100, 11, 'Kinh tế', 'Ảnh hưởng của toàn cầu hóa kinh tế và tăng trưởng kinh tế lên tỷ lệ thất nghiệp: Thực tiễn tại Việt Nam', 'Ảnh hưởng của toàn cầu hóa kinh tế và tăng trưởng kinh tế lên tỷ lệ thất nghiệp: Thực tiễn tại Việt Nam', NULL, NULL, '["Nguyễn Quyết"]', 1, 1439525601, 38, 0, 0, NULL),
	(101, 11, 'Công nghệ', 'Khảo sát In Silico, xây dựng cơ sở khoa học cho việc phát hiện kết hợp yếu tố nhiễm và bất ổn di truyền trong ưng thu vòm họng', 'Khảo sát In Silico, xây dựng cơ sở khoa học cho việc phát hiện kết hợp yếu tố nhiễm và bất ổn di truyền trong ưng thu vòm họng', NULL, NULL, '["Nguyễn Văn Trường","Nguyễn Thị Thúy Tài","Nguyễn Thị Thanh Nhàn","Nguyễn Thị Thu Ngân","Lý Thị Tuyết Ngọc","Lao Đức Thuận"]', 1, 1439525765, 38, 0, 0, NULL),
	(102, 11, 'Công nghệ', 'Ứng dụng kỹ thuật real-time PCR để xác định kiểu gen, lượng virus trong máu và đặc điểm kháng thuốc điều trị của virus viêm gan B trên người bệnh của Bệnh viện Đa khoa Đồng Tháp', 'Ứng dụng kỹ thuật real-time PCR để xác định kiểu gen, lượng virus trong máu và đặc điểm kháng thuốc điều trị của virus viêm gan B trên người bệnh của Bệnh viện Đa khoa Đồng Tháp', NULL, NULL, '["Lao Đức Thuận","Trương Kim Phượng","Mai Ngọc Lành","Lê Thị Phượng","Phan Văn Bé Bảy","Hồ Thị Thanh Thúy","Lê Huyền Ái Thúy"]', 1, 1439525868, 38, 0, 0, NULL),
	(103, 11, 'Công nghệ', 'Nhân giống in vitro cây Thanh Long ruột đỏ', 'Nhân giống in vitro cây Thanh Long ruột đỏ', NULL, NULL, '["Đặng Văn Tùng","Nguyễn Trần Đông Phương"]', 1, 1439525970, 38, 0, 0, NULL),
	(104, 11, 'Công nghệ', 'Mô hình dự đoán khuyếch tán ion clorua vào vết nứt bê thông cốt thép trong môi trường biển', 'Mô hình dự đoán khuyếch tán ion clorua vào vết nứt bê thông cốt thép trong môi trường biển', NULL, NULL, '["Nguyễn Thị Hồng Nhung","Vũ Quốc Hoàng","Nguyễn Ninh Thụy"]', 1, 1439526076, 38, 0, 0, NULL),
	(105, 11, 'TRAO ĐỔI HỌC THUẬT', 'Thương hiệu nhà tuyển dụng: Từ lý luận đến thực tiễn tại Việt Nam', 'Thương hiệu nhà tuyển dụng: Từ lý luận đến thực tiễn tại Việt Nam', NULL, NULL, '["Nguyễn Khánh Trung","Lê Thị Hoàng Dung"]', 1, 1439526190, 38, 0, 0, NULL),
	(106, 12, 'Kinh tế', 'Vốn xã hội và tăng trưởng kinh tế', 'Vốn xã hội và tăng trưởng kinh tế', NULL, NULL, '["Nguyễn Văn Phúc","Nguyễn Lê Hoàng Thụy Tố Quyên"]', 1, 1439608754, 38, 0, 0, NULL),
	(107, 12, 'Kinh tế', 'Các yếu tố ảnh hưởng đến rủi ro tín dụng của hệ thống ngân hàng thương mại Việt Nam', 'Các yếu tố ảnh hưởng đến rủi ro tín dụng của hệ thống ngân hàng thương mại Việt Nam', NULL, NULL, '["Võ Thị Quý","Bùi Ngọc Toản"]', 1, 1439609077, 38, 0, 0, NULL),
	(108, 12, 'Kinh tế', 'Các yếu tố ảnh hưởng đến ý định mua theo nhóm trực tuyến', 'Các yếu tố ảnh hưởng đến ý định mua theo nhóm trực tuyến', NULL, NULL, '["Hoàng Thị Phương Thảo","Phan Thị Thanh Hằng"]', 1, 1439609159, 38, 0, 0, NULL),
	(109, 12, 'Kinh tế', 'Pr Việt Nam: từ lý thuyết đến thực tiễn', 'Pr Việt Nam: từ lý thuyết đến thực tiễn', NULL, NULL, '["Vân Thị Hồng Loan"]', 1, 1439609367, 38, 0, 0, NULL),
	(110, 12, 'Kinh tế', 'Tác  động  của  chi  tiêu  công  đến  tăng trưởng kinh tế tại các quốc gia Đông Nam Á ', 'Tác  động  của  chi  tiêu  công  đến  tăng trưởng kinh tế tại các quốc gia Đông Nam Á ', NULL, NULL, '["Nguyễn Quang Trung","Trần Phạm Khánh Toàn"]', 1, 1439609434, 38, 0, 0, NULL),
	(111, 12, 'Kinh tế', 'Nhận thức của người tiêu dùng về trách nhiệm xã hội của doanh nghiệp vàýđịnh mua  –  Một  nghiên  cứu  từ  ngành  hàng điện máy', 'Nhận thức của người tiêu dùng về trách nhiệm xã hội của doanh nghiệp vàýđịnh mua  –  Một  nghiên  cứu  từ  ngành  hàng điện máy', NULL, NULL, '["Nguyễn Phan Thanh Nhã","Lê Thị Thanh Xuân"]', 1, 1439609549, 38, 0, 0, NULL),
	(112, 12, 'Giáo dục - Xã hội', 'Đạo  đức  nghề  nghiệp  –  tổng  quan  lý thuyết và nhận thức của sinh viên đại học quốc gia TPHCM', 'Đạo  đức  nghề  nghiệp  –  tổng  quan  lý thuyết và nhận thức của sinh viên đại học quốc gia TPHCM', NULL, NULL, '["Nguyễn Thu Trang","Trần Tiến Khoa","Lê Thị Thanh Xuân"]', 1, 1439609652, 38, 0, 0, NULL),
	(113, 12, 'Giáo dục - Xã hội', 'Tác động của đào tạo đến hiệu quả làm việc của nhân viên ngành dệt may', 'Tác động của đào tạo đến hiệu quả làm việc của nhân viên ngành dệt may', NULL, NULL, '["Nguyễn Minh Hà","Lê Văn Tùng"]', 1, 1439609714, 38, 0, 0, NULL),
	(114, 12, 'Giáo dục - Xã hội', 'Tìm  hiểu  sự  tự  học  môn  phương  pháp giảng  dạy  của  sinh  viên  chuyên  ngành giảng dạy tiếng anh theo học chế tín chỉ ', 'Tìm  hiểu  sự  tự  học  môn  phương  pháp giảng  dạy  của  sinh  viên  chuyên  ngành giảng dạy tiếng anh theo học chế tín chỉ ', NULL, NULL, '["Phan Thị Thu Nga","Trần Vũ Diễm Thúy","Dương Đoàn Hoàng Trúc"]', 1, 1439609802, 38, 0, 0, NULL),
	(115, 12, 'TRAO ĐỔI HỌC THUẬT', 'Khái niệm “văn hóa tổ chức”', 'Khái niệm “văn hóa tổ chức”', NULL, NULL, '["Nguyễn Quang Vinh"]', 1, 1439609862, 38, 0, 0, NULL),
	(116, 12, 'TRAO ĐỔI HỌC THUẬT', 'Nhàlãnh đạo hiệu quả', 'Nhàlãnh đạo hiệu quả', NULL, NULL, '["Nguyễn Văn Khanh"]', 1, 1439609939, 38, 0, 0, NULL),
	(117, NULL, 'Kinh tế', 'Example about add new paper', 'sun will rise', 'what happend', 1, 'Array', 0, NULL, NULL, 0, 0, NULL),
	(118, NULL, '', 'Example about add new paper', 'sun will rise', 'what happend', 1, 'Array', 0, NULL, NULL, 0, 0, NULL),
	(119, NULL, 'Tài chính - Kinh tế', 'test eđitedd', 'sun will rise', 'next', 1, '["Le Van"]', 0, NULL, NULL, 0, 0, NULL),
	(120, NULL, 'Khoa học công nghệ', 'học laravel', 'đây là series học laravel cho beginner', 'abc', 1, '["Le Van"]', 0, NULL, NULL, 0, 0, NULL),
	(121, NULL, 'Khoa học công nghệ', 'tên bài viết', 'giới thiệu', 'nội dung', 1, '["Le Van"]', 0, NULL, NULL, 0, 0, NULL),
	(122, NULL, 'nhóm', 'tên', 'giới thiệu', 'nội dung', 1, '["Le Van"]', 0, NULL, 40, 0, 0, NULL);
/*!40000 ALTER TABLE `web_tckh_baiviet` ENABLE KEYS */;


-- Dumping structure for table tckh.web_tckh_nhombaiviet
CREATE TABLE IF NOT EXISTS `web_tckh_nhombaiviet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tennhombaiviet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_tckh_nhombaiviet: ~22 rows (approximately)
/*!40000 ALTER TABLE `web_tckh_nhombaiviet` DISABLE KEYS */;
INSERT INTO `web_tckh_nhombaiviet` (`id`, `tennhombaiviet`) VALUES
	(1, 'Tài chính - Kinh tế'),
	(2, 'Công nghệ thông tin'),
	(3, 'Xã hội học'),
	(4, 'Xây dựng'),
	(5, 'Kinh tế'),
	(8, 'Khoa học công nghệ'),
	(9, 'Chính trị - Xã hội'),
	(12, 'Trao đổi học thuật và thông tin khoa học'),
	(13, ''),
	(14, 'Giáo dục'),
	(15, 'Khoa học Kỹ thuật'),
	(16, 'ECONOMICS'),
	(17, 'EDUCATION'),
	(18, 'TECHNOLOGY'),
	(19, 'ACADEMIC EXCHANGE AND SCIENTIFIC INFORMATION'),
	(20, 'CHÍNH TRỊ-GIÁO DỤC-VĂN HÓA-XÃ HỘI'),
	(21, 'GIỚI THIỆU SÁCH'),
	(22, 'THÔNG TIN HOẠT ĐỘNG KHOA HỌC'),
	(23, 'Công nghệ'),
	(24, 'TRAO ĐỔI HỌC THUẬT'),
	(25, 'CHÍNH TRỊ - GIÁO DỤC  - XÃ HỘI'),
	(26, 'Giáo dục - Xã hội');
/*!40000 ALTER TABLE `web_tckh_nhombaiviet` ENABLE KEYS */;


-- Dumping structure for table tckh.web_tckh_tapchi
CREATE TABLE IF NOT EXISTS `web_tckh_tapchi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sotapchi` int(11) DEFAULT NULL,
  `namtapchi` int(11) DEFAULT NULL,
  `tentapchi` varchar(255) DEFAULT NULL,
  `anhbia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_tckh_tapchi: ~11 rows (approximately)
/*!40000 ALTER TABLE `web_tckh_tapchi` DISABLE KEYS */;
INSERT INTO `web_tckh_tapchi` (`id`, `sotapchi`, `namtapchi`, `tentapchi`, `anhbia`) VALUES
	(2, 1, 2015, 'Số 1 - năm 2015 (Tiếng Việt)', 'anh-bia-vi.jpg'),
	(3, 1, 2015, 'Số 1 - năm 2015 (Tiếng Anh)', 'anh-bia-en.jpg'),
	(4, 2, 2015, 'Số 2 - năm 2015 (Tiếng Việt)', 'bia-so2-2015.jpg'),
	(5, 2, 2015, 'Số 2 - năm 2015 (Tiếng Anh)', 'bia-so-2-2015-en.JPG'),
	(6, 3, 2015, 'Số 3 - năm 2015 (Tiếng Việt)', 'bia-so3-2015-vi.JPG'),
	(7, 1, 2014, 'Số 1 - năm 2014 (Tiếng Việt)', '1. BIATAPCHI KHOAHOCso1(34)2014.JPG'),
	(8, 2, 2014, 'Số 2 - năm 2014 (Tiếng Việt)', '2. BIATAPCHI KHOAHOCso2(35)2014.JPG'),
	(9, 4, 2014, 'Số 4 - năm 2015 (Tiếng Việt)', '4. BIATAPCHI KHOAHOCso4(37)2014.JPG'),
	(10, 5, 2014, 'Số 5 - năm 2014 (Tiếng Việt)', '5. BIATAPCHI KHOAHOCso5(38)2014.jpg'),
	(11, 6, 2014, 'Số 6 - năm 2014 (Tiếng Việt)', '6. BIATAPCHI KHOAHOCso6(39)2014.jpg'),
	(12, 3, 2014, 'Số 3- năm 2014 (Tiếng Việt)', '3. BIATAPCHI KHOAHOCso3(36)2014.JPG');
/*!40000 ALTER TABLE `web_tckh_tapchi` ENABLE KEYS */;


-- Dumping structure for table tckh.web_uploaded_files
CREATE TABLE IF NOT EXISTS `web_uploaded_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `context_id` int(11) DEFAULT NULL,
  `context_name` char(10) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `file_ext` varchar(10) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `tmp` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `userupload` int(11) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_uploaded_files: ~115 rows (approximately)
/*!40000 ALTER TABLE `web_uploaded_files` DISABLE KEYS */;
INSERT INTO `web_uploaded_files` (`id`, `context_id`, `context_name`, `file_path`, `file_ext`, `file_size`, `tmp`, `deleted`, `userupload`, `created_at`, `updated_at`) VALUES
	(1, 1, 'tckh', '25042015\\renluyendaoduccachmang_hcm.pdf', 'pdf', 165069, 0, 0, 5, '2015-04-25 09:29:25.000000', '2015-04-25 09:29:25.000000'),
	(3, 2, 'tckh', '27052015\\012015-bai-1-vi.pdf', 'pdf', 14433345, 0, 0, 5, '2015-05-27 13:29:52.000000', '2015-05-27 13:29:52.000000'),
	(4, 3, 'tckh', '27052015\\012015-bai-2-vi.pdf', 'pdf', 11500177, 0, 0, 5, '2015-05-27 13:36:18.000000', '2015-05-27 13:36:18.000000'),
	(5, 4, 'tckh', '27052015\\012015-bai-3-vi.pdf', 'pdf', 11231092, 0, 0, 5, '2015-05-27 13:38:46.000000', '2015-05-27 13:38:46.000000'),
	(6, 5, 'tckh', '27052015\\012015-bai-4-vi.pdf', 'pdf', 7099124, 0, 0, 5, '2015-05-27 13:41:30.000000', '2015-05-27 13:41:30.000000'),
	(7, 6, 'tckh', '27052015\\012015-bai-5-vi.pdf', 'pdf', 9569189, 0, 0, 5, '2015-05-27 13:43:51.000000', '2015-05-27 13:43:51.000000'),
	(8, 7, 'tckh', '27052015\\012015-bai-6-vi.pdf', 'pdf', 6641548, 0, 0, 5, '2015-05-27 13:47:59.000000', '2015-05-27 13:47:59.000000'),
	(9, 8, 'tckh', '27052015\\012015-bai-7-vi.pdf', 'pdf', 8062283, 0, 0, 5, '2015-05-27 13:50:12.000000', '2015-05-27 13:50:12.000000'),
	(10, 9, 'tckh', '27052015\\012015-bai-8-vi.pdf', 'pdf', 8047504, 0, 0, 5, '2015-05-27 13:51:41.000000', '2015-05-27 13:51:41.000000'),
	(11, 10, 'tckh', '27052015\\012015-bai-9-vi.pdf', 'pdf', 7198228, 0, 0, 5, '2015-05-27 13:54:06.000000', '2015-05-27 13:54:06.000000'),
	(12, 11, 'tckh', '27052015\\012015-bai-10-vi.pdf', 'pdf', 6309745, 0, 0, 5, '2015-05-27 13:58:04.000000', '2015-05-27 13:58:04.000000'),
	(13, 12, 'tckh', '27052015\\1.-nhut-vu--thuy-hang--bich-thao--huu-phuoc-1-7.pdf', 'pdf', 422182, 0, 0, 5, '2015-05-27 14:17:36.000000', '2015-05-27 14:17:36.000000'),
	(14, 13, 'tckh', '27052015\\2.-THUAN--PHUONG--AI-THUY--THANH-THUY-8-13.pdf', 'pdf', 522344, 0, 0, 5, '2015-05-27 14:19:17.000000', '2015-05-27 14:19:17.000000'),
	(15, 14, 'tckh', '27052015\\3.-HANH-LUAN-THAO-THUAN-HIEP-NGUYEN-14-20.pdf', 'pdf', 365561, 0, 0, 5, '2015-05-27 14:20:45.000000', '2015-05-27 14:20:45.000000'),
	(17, 15, 'tckh', '27052015\\4.-PHUONG--NGHIA--AI-THUY-21-29.pdf', 'pdf', 352018, 0, 0, 5, '2015-05-27 14:22:50.000000', '2015-05-27 14:22:50.000000'),
	(18, 16, 'tckh', '27052015\\5.-HUNG--THUAN--AI-THUY-30-36.pdf', 'pdf', 403319, 0, 0, 5, '2015-05-27 14:23:58.000000', '2015-05-27 14:23:58.000000'),
	(19, 17, 'tckh', '27052015\\6.-BAO-CHAU-37-44.pdf', 'pdf', 283349, 0, 0, 5, '2015-05-27 14:24:40.000000', '2015-05-27 14:24:40.000000'),
	(20, 18, 'tckh', '27052015\\7.-DO-THI-KIM-CHI-45-52.pdf', 'pdf', 159518, 0, 0, 5, '2015-05-27 14:25:20.000000', '2015-05-27 14:25:20.000000'),
	(21, 19, 'tckh', '22062015\\3_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 345240, 0, 0, 38, '2015-06-22 16:58:24.000000', '2015-06-22 16:58:24.000000'),
	(22, 20, 'tckh', '22062015\\12_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 640651, 0, 0, 38, '2015-06-22 17:09:35.000000', '2015-06-22 17:09:35.000000'),
	(23, 21, 'tckh', '22062015\\24_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 596474, 0, 0, 38, '2015-06-22 17:12:32.000000', '2015-06-22 17:12:32.000000'),
	(24, 22, 'tckh', '22062015\\37_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 633362, 0, 0, 38, '2015-06-22 17:15:48.000000', '2015-06-22 17:15:48.000000'),
	(25, 23, 'tckh', '23062015\\51_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 788022, 0, 0, 38, '2015-06-23 08:37:29.000000', '2015-06-23 08:37:29.000000'),
	(26, 24, 'tckh', '23062015\\64_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 319951, 0, 0, 38, '2015-06-23 08:38:54.000000', '2015-06-23 08:38:54.000000'),
	(27, 25, 'tckh', '23062015\\72_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 813619, 0, 0, 38, '2015-06-23 10:36:46.000000', '2015-06-23 10:36:46.000000'),
	(28, 26, 'tckh', '23062015\\80_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 524904, 0, 0, 38, '2015-06-23 10:39:25.000000', '2015-06-23 10:39:25.000000'),
	(29, 27, 'tckh', '23062015\\91_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 516541, 0, 0, 38, '2015-06-23 10:42:27.000000', '2015-06-23 10:42:27.000000'),
	(30, 28, 'tckh', '23062015\\103_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 573262, 0, 0, 38, '2015-06-23 10:54:03.000000', '2015-06-23 10:54:03.000000'),
	(31, 29, 'tckh', '23062015\\112_FILE-TONG-HOP-TCTVso2-41-2015.pdf', 'pdf', 350849, 0, 0, 38, '2015-06-23 10:55:47.000000', '2015-06-23 10:55:47.000000'),
	(32, 30, 'tckh', '23062015\\3_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 250790, 0, 0, 38, '2015-06-23 16:30:13.000000', '2015-06-23 16:30:13.000000'),
	(33, 31, 'tckh', '23062015\\12_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 498157, 0, 0, 38, '2015-06-23 16:31:55.000000', '2015-06-23 16:31:55.000000'),
	(34, 32, 'tckh', '23062015\\23_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 267521, 0, 0, 38, '2015-06-23 16:33:25.000000', '2015-06-23 16:33:25.000000'),
	(35, 33, 'tckh', '23062015\\31_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 463276, 0, 0, 38, '2015-06-23 16:34:11.000000', '2015-06-23 16:34:11.000000'),
	(36, 34, 'tckh', '23062015\\41_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 343483, 0, 0, 38, '2015-06-23 16:35:06.000000', '2015-06-23 16:35:06.000000'),
	(37, 35, 'tckh', '23062015\\60_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 265380, 0, 0, 38, '2015-06-23 16:36:54.000000', '2015-06-23 16:36:54.000000'),
	(38, 36, 'tckh', '23062015\\70_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 479197, 0, 0, 38, '2015-06-23 17:03:45.000000', '2015-06-23 17:03:45.000000'),
	(39, 37, 'tckh', '23062015\\83_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 506016, 0, 0, 38, '2015-06-23 17:05:05.000000', '2015-06-23 17:05:05.000000'),
	(40, 38, 'tckh', '23062015\\90_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 168412, 0, 0, 38, '2015-06-23 17:06:28.000000', '2015-06-23 17:06:28.000000'),
	(41, 39, 'tckh', '23062015\\96_TC-TIENG-ANH-SO-2-14---1-.pdf', 'pdf', 251088, 0, 0, 38, '2015-06-23 17:07:16.000000', '2015-06-23 17:07:16.000000'),
	(42, 40, 'tckh', '03072015\\3_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 411259, 0, 0, 38, '2015-07-03 16:21:27.000000', '2015-07-03 16:21:27.000000'),
	(43, 41, 'tckh', '03072015\\14_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 556493, 0, 0, 38, '2015-07-03 16:23:43.000000', '2015-07-03 16:23:43.000000'),
	(44, 42, 'tckh', '03072015\\23_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 371971, 0, 0, 38, '2015-07-03 16:27:21.000000', '2015-07-03 16:27:21.000000'),
	(45, 43, 'tckh', '03072015\\34_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 379450, 0, 0, 38, '2015-07-03 16:28:53.000000', '2015-07-03 16:28:53.000000'),
	(46, 44, 'tckh', '03072015\\42_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 409536, 0, 0, 38, '2015-07-03 16:30:46.000000', '2015-07-03 16:30:46.000000'),
	(47, 45, 'tckh', '03072015\\51_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 362493, 0, 0, 38, '2015-07-03 16:33:15.000000', '2015-07-03 16:33:15.000000'),
	(48, 46, 'tckh', '03072015\\63_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 491943, 0, 0, 38, '2015-07-03 16:34:46.000000', '2015-07-03 16:34:46.000000'),
	(49, 47, 'tckh', '03072015\\78_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 555432, 0, 0, 38, '2015-07-03 16:35:50.000000', '2015-07-03 16:35:50.000000'),
	(50, 48, 'tckh', '03072015\\91_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 600228, 0, 0, 38, '2015-07-03 16:39:31.000000', '2015-07-03 16:39:31.000000'),
	(51, 49, 'tckh', '03072015\\101_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 387585, 0, 0, 38, '2015-07-03 16:40:42.000000', '2015-07-03 16:40:42.000000'),
	(52, 50, 'tckh', '03072015\\111_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 367699, 0, 0, 38, '2015-07-03 16:42:15.000000', '2015-07-03 16:42:15.000000'),
	(53, 51, 'tckh', '03072015\\121_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 415550, 0, 0, 38, '2015-07-03 16:43:54.000000', '2015-07-03 16:43:54.000000'),
	(54, 52, 'tckh', '03072015\\134_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 525680, 0, 0, 38, '2015-07-03 16:45:04.000000', '2015-07-03 16:45:04.000000'),
	(55, 53, 'tckh', '03072015\\146_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 636508, 0, 0, 38, '2015-07-03 16:47:01.000000', '2015-07-03 16:47:01.000000'),
	(56, 54, 'tckh', '03072015\\156_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 318127, 0, 0, 38, '2015-07-03 16:47:55.000000', '2015-07-03 16:47:55.000000'),
	(57, 55, 'tckh', '03072015\\165_T---P-CH---KHOA-H---C-S----3--42--2015.pdf', 'pdf', 415539, 0, 0, 38, '2015-07-03 16:48:51.000000', '2015-07-03 16:48:51.000000'),
	(58, 56, 'tckh', '27072015\\3_1.-TV-1--34--2014_file-in.pdf', 'pdf', 281643, 0, 0, 38, '2015-07-27 11:29:13.000000', '2015-07-27 11:29:13.000000'),
	(59, 57, 'tckh', '27072015\\14_1.-TV-1--34--2014_file-in.pdf', 'pdf', 320907, 0, 0, 38, '2015-07-27 11:30:29.000000', '2015-07-27 11:30:29.000000'),
	(60, 58, 'tckh', '27072015\\28_1.-TV-1--34--2014_file-in.pdf', 'pdf', 354501, 0, 0, 38, '2015-07-27 11:32:05.000000', '2015-07-27 11:32:05.000000'),
	(61, 59, 'tckh', '27072015\\42_1.-TV-1--34--2014_file-in.pdf', 'pdf', 352077, 0, 0, 38, '2015-07-27 11:33:31.000000', '2015-07-27 11:33:31.000000'),
	(62, 60, 'tckh', '27072015\\57_1.-TV-1--34--2014_file-in.pdf', 'pdf', 270450, 0, 0, 38, '2015-07-27 11:35:39.000000', '2015-07-27 11:35:39.000000'),
	(63, 61, 'tckh', '27072015\\64_1.-TV-1--34--2014_file-in.pdf', 'pdf', 354049, 0, 0, 38, '2015-07-27 12:00:18.000000', '2015-07-27 12:00:18.000000'),
	(64, 62, 'tckh', '27072015\\75_1.-TV-1--34--2014_file-in.pdf', 'pdf', 322870, 0, 0, 38, '2015-07-27 12:02:41.000000', '2015-07-27 12:02:41.000000'),
	(65, 63, 'tckh', '27072015\\87_1.-TV-1--34--2014_file-in.pdf', 'pdf', 263645, 0, 0, 38, '2015-07-27 12:03:53.000000', '2015-07-27 12:03:53.000000'),
	(66, 64, 'tckh', '27072015\\93_1.-TV-1--34--2014_file-in.pdf', 'pdf', 273421, 0, 0, 38, '2015-07-27 12:04:55.000000', '2015-07-27 12:04:55.000000'),
	(67, 65, 'tckh', '27072015\\102_1.-TV-1--34--2014_file-in.pdf', 'pdf', 1480986, 0, 0, 38, '2015-07-27 12:06:10.000000', '2015-07-27 12:06:10.000000'),
	(68, 66, 'tckh', '07082015\\3_2.-TV-2--35--2014_.pdf', 'pdf', 413254, 0, 0, 38, '2015-08-07 15:31:36.000000', '2015-08-07 15:31:36.000000'),
	(69, 67, 'tckh', '07082015\\14_2.-TV-2--35--2014_.pdf', 'pdf', 470092, 0, 0, 38, '2015-08-07 15:45:22.000000', '2015-08-07 15:45:22.000000'),
	(70, 68, 'tckh', '07082015\\27_2.-TV-2--35--2014_.pdf', 'pdf', 304690, 0, 0, 38, '2015-08-07 15:47:30.000000', '2015-08-07 15:47:30.000000'),
	(71, 69, 'tckh', '07082015\\39_2.-TV-2--35--2014_.pdf', 'pdf', 369238, 0, 0, 38, '2015-08-07 15:49:53.000000', '2015-08-07 15:49:53.000000'),
	(72, 70, 'tckh', '07082015\\49_2.-TV-2--35--2014_.pdf', 'pdf', 363499, 0, 0, 38, '2015-08-07 15:50:42.000000', '2015-08-07 15:50:42.000000'),
	(73, 71, 'tckh', '07082015\\59_2.-TV-2--35--2014_.pdf', 'pdf', 300097, 0, 0, 38, '2015-08-07 15:51:40.000000', '2015-08-07 15:51:40.000000'),
	(74, 72, 'tckh', '07082015\\69_2.-TV-2--35--2014_.pdf', 'pdf', 364947, 0, 0, 38, '2015-08-07 15:52:33.000000', '2015-08-07 15:52:33.000000'),
	(75, 73, 'tckh', '07082015\\82_2.-TV-2--35--2014_.pdf', 'pdf', 881720, 0, 0, 38, '2015-08-07 15:53:34.000000', '2015-08-07 15:53:34.000000'),
	(76, 74, 'tckh', '07082015\\92_2.-TV-2--35--2014_.pdf', 'pdf', 324781, 0, 0, 38, '2015-08-07 15:55:15.000000', '2015-08-07 15:55:15.000000'),
	(77, 75, 'tckh', '07082015\\94_2.-TV-2--35--2014_.pdf', 'pdf', 1035974, 0, 0, 38, '2015-08-07 15:56:07.000000', '2015-08-07 15:56:07.000000'),
	(78, 76, 'tckh', '07082015\\3_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 803615, 0, 0, 38, '2015-08-07 16:19:45.000000', '2015-08-07 16:19:45.000000'),
	(79, 77, 'tckh', '07082015\\11_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 555239, 0, 0, 38, '2015-08-07 16:21:03.000000', '2015-08-07 16:21:03.000000'),
	(80, 78, 'tckh', '07082015\\19_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 629468, 0, 0, 38, '2015-08-07 16:23:10.000000', '2015-08-07 16:23:10.000000'),
	(81, 79, 'tckh', '07082015\\30_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 566882, 0, 0, 38, '2015-08-07 16:24:04.000000', '2015-08-07 16:24:04.000000'),
	(82, 80, 'tckh', '07082015\\37_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 558376, 0, 0, 38, '2015-08-07 16:25:05.000000', '2015-08-07 16:25:05.000000'),
	(83, 81, 'tckh', '07082015\\51_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 572582, 0, 0, 38, '2015-08-07 16:26:05.000000', '2015-08-07 16:26:05.000000'),
	(84, 82, 'tckh', '07082015\\71_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 656236, 0, 0, 38, '2015-08-07 16:27:24.000000', '2015-08-07 16:27:24.000000'),
	(85, 83, 'tckh', '07082015\\84_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 759643, 0, 0, 38, '2015-08-07 16:28:16.000000', '2015-08-07 16:28:16.000000'),
	(86, 84, 'tckh', '07082015\\99_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 464250, 0, 0, 38, '2015-08-07 16:29:07.000000', '2015-08-07 16:29:07.000000'),
	(87, 85, 'tckh', '07082015\\111_4.-TC-DH-MO-TV-4--37--2014-HC.pdf', 'pdf', 637044, 0, 0, 38, '2015-08-07 16:29:56.000000', '2015-08-07 16:29:56.000000'),
	(99, 86, 'tckh', '08082015\\3_5.TC-TV-5-38-2014hc.pdf', 'pdf', 484740, 0, 0, 38, '2015-08-08 10:13:41.000000', '2015-08-08 10:13:41.000000'),
	(100, 87, 'tckh', '08082015\\16_5.TC-TV-5-38-2014hc.pdf', 'pdf', 512050, 0, 0, 38, '2015-08-08 10:15:52.000000', '2015-08-08 10:15:52.000000'),
	(101, 88, 'tckh', '08082015\\28_5.TC-TV-5-38-2014hc.pdf', 'pdf', 625351, 0, 0, 38, '2015-08-08 10:16:26.000000', '2015-08-08 10:16:26.000000'),
	(102, 89, 'tckh', '08082015\\41_5.TC-TV-5-38-2014hc.pdf', 'pdf', 636221, 0, 0, 38, '2015-08-08 10:17:01.000000', '2015-08-08 10:17:01.000000'),
	(103, 90, 'tckh', '08082015\\54_5.TC-TV-5-38-2014hc.pdf', 'pdf', 384089, 0, 0, 38, '2015-08-08 10:17:43.000000', '2015-08-08 10:17:43.000000'),
	(105, 91, 'tckh', '08082015\\66_5.TC-TV-5-38-2014hc.pdf', 'pdf', 471497, 0, 0, 38, '2015-08-08 10:18:41.000000', '2015-08-08 10:18:41.000000'),
	(106, 92, 'tckh', '08082015\\79_5.TC-TV-5-38-2014hc.pdf', 'pdf', 464317, 0, 0, 38, '2015-08-08 10:19:16.000000', '2015-08-08 10:19:16.000000'),
	(107, 93, 'tckh', '08082015\\91_5.TC-TV-5-38-2014hc.pdf', 'pdf', 469198, 0, 0, 38, '2015-08-08 10:19:48.000000', '2015-08-08 10:19:48.000000'),
	(108, 94, 'tckh', '08082015\\105_5.TC-TV-5-38-2014hc.pdf', 'pdf', 671861, 0, 0, 38, '2015-08-08 10:20:23.000000', '2015-08-08 10:20:23.000000'),
	(109, 95, 'tckh', '08082015\\112_5.TC-TV-5-38-2014hc.pdf', 'pdf', 314148, 0, 0, 38, '2015-08-08 10:20:53.000000', '2015-08-08 10:20:53.000000'),
	(110, 96, 'tckh', '14082015\\3_6.-TC-TV-6-39-14HC.pdf', 'pdf', 511749, 0, 0, 38, '2015-08-14 10:10:50.000000', '2015-08-14 10:10:50.000000'),
	(111, 97, 'tckh', '14082015\\14_6.-TC-TV-6-39-14HC.pdf', 'pdf', 490472, 0, 0, 38, '2015-08-14 10:12:11.000000', '2015-08-14 10:12:11.000000'),
	(112, 99, 'tckh', '14082015\\43_6.-TC-TV-6-39-14HC.pdf', 'pdf', 2655108, 0, 0, 38, '2015-08-14 11:10:29.000000', '2015-08-14 11:10:29.000000'),
	(113, 100, 'tckh', '14082015\\54_6.-TC-TV-6-39-14HC.pdf', 'pdf', 509332, 0, 0, 38, '2015-08-14 11:14:39.000000', '2015-08-14 11:14:39.000000'),
	(114, 101, 'tckh', '14082015\\67_6.-TC-TV-6-39-14HC.pdf', 'pdf', 807182, 0, 0, 38, '2015-08-14 11:16:14.000000', '2015-08-14 11:16:14.000000'),
	(115, 102, 'tckh', '14082015\\76_6.-TC-TV-6-39-14HC.pdf', 'pdf', 546861, 0, 0, 38, '2015-08-14 11:18:38.000000', '2015-08-14 11:18:38.000000'),
	(116, 103, 'tckh', '14082015\\87_6.-TC-TV-6-39-14HC.pdf', 'pdf', 633667, 0, 0, 38, '2015-08-14 11:20:21.000000', '2015-08-14 11:20:21.000000'),
	(117, 104, 'tckh', '14082015\\94_6.-TC-TV-6-39-14HC.pdf', 'pdf', 923648, 0, 0, 38, '2015-08-14 11:22:25.000000', '2015-08-14 11:22:25.000000'),
	(118, 105, 'tckh', '14082015\\108_6.-TC-TV-6-39-14HC.pdf', 'pdf', 336246, 0, 0, 38, '2015-08-14 11:23:17.000000', '2015-08-14 11:23:17.000000'),
	(119, 107, 'tckh', '15082015\\16_3.-TV-3--36--2014--1-.pdf', 'pdf', 342250, 0, 0, 38, '2015-08-15 10:25:11.000000', '2015-08-15 10:25:11.000000'),
	(120, 108, 'tckh', '15082015\\26_3.-TV-3--36--2014--1-.pdf', 'pdf', 321173, 0, 0, 38, '2015-08-15 10:28:37.000000', '2015-08-15 10:28:37.000000'),
	(121, 109, 'tckh', '15082015\\38_3.-TV-3--36--2014--1-.pdf', 'pdf', 331860, 0, 0, 38, '2015-08-15 10:29:37.000000', '2015-08-15 10:29:37.000000'),
	(122, 110, 'tckh', '15082015\\50_3.-TV-3--36--2014--1-.pdf', 'pdf', 351827, 0, 0, 38, '2015-08-15 10:31:41.000000', '2015-08-15 10:31:41.000000'),
	(123, 111, 'tckh', '15082015\\60_3.-TV-3--36--2014--1-.pdf', 'pdf', 455912, 0, 0, 38, '2015-08-15 10:32:43.000000', '2015-08-15 10:32:43.000000'),
	(124, 112, 'tckh', '15082015\\80_3.-TV-3--36--2014--1-.pdf', 'pdf', 363391, 0, 0, 38, '2015-08-15 10:34:24.000000', '2015-08-15 10:34:24.000000'),
	(125, 113, 'tckh', '15082015\\92_3.-TV-3--36--2014--1-.pdf', 'pdf', 349851, 0, 0, 38, '2015-08-15 10:35:24.000000', '2015-08-15 10:35:24.000000'),
	(126, 114, 'tckh', '15082015\\110_3.-TV-3--36--2014--1-.pdf', 'pdf', 515097, 0, 0, 38, '2015-08-15 10:36:50.000000', '2015-08-15 10:36:50.000000'),
	(127, 115, 'tckh', '15082015\\124_3.-TV-3--36--2014--1-.pdf', 'pdf', 292014, 0, 0, 38, '2015-08-15 10:38:27.000000', '2015-08-15 10:38:27.000000'),
	(128, 116, 'tckh', '15082015\\134_3.-TV-3--36--2014--1-.pdf', 'pdf', 234248, 0, 0, 38, '2015-08-15 10:39:06.000000', '2015-08-15 10:39:06.000000'),
	(129, 106, 'tckh', '15082015\\3_3.-TV-3--36--2014--1-.pdf', 'pdf', 751302, 0, 0, 38, '2015-08-15 10:43:07.000000', '2015-08-15 10:43:07.000000');
/*!40000 ALTER TABLE `web_uploaded_files` ENABLE KEYS */;


-- Dumping structure for table tckh.web_users
CREATE TABLE IF NOT EXISTS `web_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `password2` varchar(60) DEFAULT NULL,
  `sa` smallint(6) DEFAULT '0',
  `buildin_role` varchar(10) DEFAULT NULL,
  `lastaccess` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `allow_delete` tinyint(3) unsigned DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web_users_id_idx` (`id`),
  UNIQUE KEY `web_users_username_idx` (`username`),
  FULLTEXT KEY `web_users_displayname_idx` (`display_name`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_users: ~6 rows (approximately)
/*!40000 ALTER TABLE `web_users` DISABLE KEYS */;
INSERT INTO `web_users` (`id`, `username`, `display_name`, `email`, `password`, `password2`, `sa`, `buildin_role`, `lastaccess`, `remember_token`, `allow_delete`, `created_at`, `updated_at`) VALUES
	(5, 'admin', 'Administartor', '', '$2a$10$KMXR39ZrBuNy8jKsDoCHp.03UFNOihyPPoD5fsfTQsrQ5a0AtX5OK', NULL, 1, NULL, 1459067596, NULL, 0, '2014-09-18 05:07:53', '2016-03-27 15:33:16'),
	(37, 'no-reply', 'System', NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2015-02-11 18:28:54', '2015-02-11 18:28:54'),
	(38, 'tuyet.htk', 'Huỳnh Thị Kim Tuyết', 'tuyet.htk@ou.edu.vn', '$2a$10$KMXR39ZrBuNy8jKsDoCHp.03UFNOihyPPoD5fsfTQsrQ5a0AtX5OK', NULL, 0, NULL, 1458844748, NULL, 1, '2015-04-20 10:15:34', '2016-03-25 01:39:08'),
	(39, 'chuong.ha', 'Hồ Anh Chương', '', '$2y$10$cQjEPBXRNtSB9xdi3VdrsOW2cW6LUOUUCwF08Xj5/imagtG3BM07.', NULL, 0, NULL, NULL, NULL, 1, '2015-05-04 09:27:44', '2015-05-04 09:27:44'),
	(40, 'supporter', 'Lê Văn', 'vanle9890@gmail.com', '$2y$10$Vmea7365xXcaw1v8yYpO8.xmKk8lJUe33/LpJzQIiiwy6GxHa1Q6W', NULL, 0, NULL, 1459173230, NULL, 1, '2016-03-13 16:19:36', '2016-03-28 20:53:50'),
	(41, 'vanlektmt', 'le van', 'van.le.k3c1@gmail.com', '$2y$10$nd84qWa8NI7RB1MzXTiAYeIKA7ZQOC2ImmNGUWb8GrXYOVDcifH7q', NULL, 0, NULL, NULL, NULL, 1, '2016-03-19 11:58:02', '2016-03-19 11:58:02');
/*!40000 ALTER TABLE `web_users` ENABLE KEYS */;


-- Dumping structure for table tckh.web_users_roles
CREATE TABLE IF NOT EXISTS `web_users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_web_users_permissions_web_users` (`user_id`),
  KEY `FK_web_users_roles_web_roles` (`role_id`),
  CONSTRAINT `web_users_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `web_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `web_users_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `web_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_users_roles: ~12 rows (approximately)
/*!40000 ALTER TABLE `web_users_roles` DISABLE KEYS */;
INSERT INTO `web_users_roles` (`id`, `user_id`, `role_id`) VALUES
	(3, 38, 16),
	(4, 38, 19),
	(5, 38, 25),
	(6, 38, 26),
	(7, 38, 27),
	(8, 38, 28),
	(9, 39, 16),
	(10, 39, 19),
	(11, 39, 25),
	(12, 39, 26),
	(13, 39, 27),
	(14, 39, 28),
	(15, 40, 19);
/*!40000 ALTER TABLE `web_users_roles` ENABLE KEYS */;


-- Dumping structure for table tckh.web_weblink
CREATE TABLE IF NOT EXISTS `web_weblink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_title` varchar(200) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_order` int(11) DEFAULT NULL,
  `link_image` varchar(200) DEFAULT NULL,
  `link_target` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tckh.web_weblink: ~0 rows (approximately)
/*!40000 ALTER TABLE `web_weblink` DISABLE KEYS */;
INSERT INTO `web_weblink` (`id`, `link_title`, `link_url`, `link_order`, `link_image`, `link_target`, `created_at`, `updated_at`) VALUES
	(3, 'Đại học Mở Tp.HCM', 'http://www.ou.edu.vn', 1, '124-huong-dan-bam-cap-mang-rj45-13.jpg', NULL, '2015-03-16 11:22:29', '11:22:29');
/*!40000 ALTER TABLE `web_weblink` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
