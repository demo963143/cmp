-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 04:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundryapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `backup_id` int(10) UNSIGNED NOT NULL,
  `backup_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `backup_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `num` varchar(50) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `store_id`, `name`, `num`, `created_at`, `user_id`, `updated_at`) VALUES
(2, 1, 'women', 'CG002', '2020-12-31 17:07', 1, '2021-04-18 14:08'),
(3, 1, 'Men', 'CG003', '2020-12-31 21:57', 1, '2021-04-18 14:56'),
(4, 1, 'covers', 'CG004', '2021-02-02 14:17', 1, '2021-04-18 14:38');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_expences`
--

CREATE TABLE `categorie_expences` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_date` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie_expences`
--

INSERT INTO `categorie_expences` (`id`, `name`, `store_id`, `created_date`) VALUES
(15, 'water bill', 1, '2021-01-22 14:15'),
(12, 'internet', 1, '2021-01-03 17:51'),
(11, 'Electricity', 1, '2021-01-03 17:00'),
(17, 'category 5', 1, '2021-04-18 15:05');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `num` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `discount` float DEFAULT NULL,
  `adress` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `num`, `phone`, `lastname`, `firstname`, `discount`, `adress`, `store_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 'CL007', '2348037002385', 'customer', 'crm', 4, 'BENI MELLAL maroc', 1, 1, '2021-02-02', '2021-04-18 02:18');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `color`) VALUES
(27, 'red', '#f50000'),
(29, 'black', '#0d0c0c'),
(45, 'red', '#ff0505'),
(48, 'blue', '#103fad');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `code`, `country`) VALUES
(6, 'usd', 'us dollar');

-- --------------------------------------------------------

--
-- Table structure for table `expences`
--

CREATE TABLE `expences` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(150) NOT NULL,
  `note` text DEFAULT NULL,
  `amount` float NOT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_action`
--

CREATE TABLE `group_action` (
  `id_action` int(11) NOT NULL,
  `name_action` varchar(50) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE `icons` (
  `id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`id`, `type`, `link`) VALUES
(1, 'iconsminds', 'glyph-icon iconsminds-t-shirt'),
(2, 'iconsminds', 'glyph-icon iconsminds-jeans'),
(3, 'iconsminds', 'glyph-icon iconsminds-blouse'),
(4, 'iconsminds', 'glyph-icon iconsminds-jacket'),
(5, 'iconsminds', 'glyph-icon iconsminds-tie'),
(6, 'iconsminds', 'glyph-icon iconsminds-baby-clothes'),
(7, 'iconsminds', 'glyph-icon iconsminds-bikini'),
(8, 'iconsminds', 'glyph-icon iconsminds-dress'),
(9, 'iconsminds', 'glyph-icon iconsminds-walkie-talkie'),
(10, 'iconsminds', 'glyph-icon iconsminds-cap'),
(11, 'iconsminds', 'glyph-icon iconsminds-gloves'),
(12, 'iconsminds', 'glyph-icon iconsminds-boot'),
(13, 'svg', 'clothes.svg'),
(14, 'svg', 'laundry.svg'),
(15, 'svg', 'mattress.svg'),
(16, 'svg', 'shirts.svg'),
(17, 'svg', 'jacket.svg'),
(18, 'svg', 'sneaker.svg'),
(19, 'svg', 'trench-coat.svg'),
(20, 'svg', 'cap.svg'),
(21, 'svg', 'pant.svg'),
(22, 'svg', 't-shirt.svg'),
(23, 'svg', 'sweatshirt.svg'),
(24, 'svg', 'blazer.svg'),
(25, 'svg', 'batik-skirt.svg'),
(26, 'vest', 'vest.svg'),
(27, 'svg', 'uniform.svg'),
(28, 'svg', 'uniform-medical.svg'),
(29, 'svg', 'leather-jacket.svg'),
(30, 'svg', 'bed-sheets.svg');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `phrase` text NOT NULL,
  `english` text DEFAULT NULL,
  `arabic` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`) VALUES
(1, 'dashboard', 'Dashboard', 'لوحة التحكم'),
(3, 'add_new', 'add new', 'اضافة جديد'),
(5, 'address', 'Address', 'العنوان'),
(6, 'email', 'email', 'البريد الالكتروني'),
(7, 'phone', 'phone', 'الهاتف'),
(8, 'favicon', 'favicon', 'الايقونة'),
(9, 'logo', 'logo', 'الشعار'),
(10, 'language', 'language', 'اللغة'),
(11, 'site_align', 'site align ', 'محاذاة الموقع'),
(12, 'footer_text', 'Footer text', 'معلومات الفوتر'),
(13, 'successfully_deleted', 'Successfully deleted ', 'تم الحدف بنجاح'),
(14, 'successfully_updated', 'Successfully updated ', 'تم التحديث بنجاح'),
(15, 'successfully_added', 'Successfully added', 'تمت الاضافة بنجاح'),
(16, 'try_again', 'Error Please try again', 'حاول مرة أخرى'),
(19, 'statistics', 'Statistics', 'الاحصائيات'),
(22, 'month', 'Month', 'شهر'),
(23, 'welcome', 'Welcome', 'مرحبا'),
(27, 'currencies', 'Currencies', 'العملات'),
(31, 'settings', 'Settings', 'الإعدادات'),
(32, 'attendance', 'Attendance', 'الحضور'),
(35, 'categories', 'Categories', 'التصنيفات'),
(40, 'general', 'General', 'العام'),
(41, 'system_users', 'System Users', 'المستخدمين'),
(42, 'database', 'Data Base', 'قاعدة البيانات'),
(43, 'profile', 'Profile', 'الحساب'),
(44, 'signout', 'Sign Out', 'تسجيل الخروج'),
(45, 'currencys_list', ' Currencies list', 'لائحة العملات'),
(48, 'num', 'Num', 'رقم'),
(49, 'name', 'Name', 'الاسم'),
(50, 'manager', 'Manager', 'مدير'),
(52, 'action', 'Action', 'عمليات'),
(53, 'please_fill_the_form', 'Please fill in the form', 'المرجو ملئ الخانات'),
(55, 'update', 'Update', 'تحديث'),
(56, 'delete', 'Delete', 'حدف'),
(57, 'empty', 'Empty', 'فارغ'),
(58, 'cancel', 'Cancel', 'الغاء'),
(59, 'add', 'Add', 'اضافة'),
(60, 'create', 'Create', 'انشاء'),
(61, 'save', 'Save', 'حفظ'),
(62, 'doyou_want_empty', 'Do you want to empty', 'هل تود افراغ الخانات'),
(63, 'close', 'Close', 'اغلاق'),
(71, 'edit_currency', 'Update Currency', 'تعديل عملة'),
(72, 'create_currency', 'Create currency', 'اضافة عملة'),
(73, 'code', 'code', 'رمز'),
(74, 'currency', 'Currency', 'العملة'),
(75, 'title', 'Title', 'العنوان'),
(76, 'default', 'Default', 'التلقائي'),
(77, 'make', 'Make', 'تطبيق'),
(78, 'status', 'Status', 'الحالة'),
(80, 'informations', 'informations', 'معلومات'),
(82, 'start_date', 'date from', 'التاريخ من'),
(83, 'last_name', 'Last name', 'الإسم الثاني'),
(84, 'first_name', 'First name', 'الاسم الاول'),
(88, 'situation', 'Situation', 'الحالة'),
(92, 'choose', 'choose', 'اختيار'),
(98, 'photo', 'Photo', 'الصورة'),
(110, 'filtering', 'Filtering', 'بحث'),
(111, 'no_result', 'no result', 'لا توجد نتائج'),
(112, 'adress', 'Address', 'عنوان'),
(113, 'all', 'All', 'الكل'),
(114, 'backup', 'Backup', 'نسخ'),
(116, 'deletion_confirmation', 'Deletion confirmation', 'هل حقا تريد الحدف '),
(117, 'msg_delet', 'Are you sure you want to delete', 'هل حقا تريد حدف المعلومات'),
(118, 'print', 'Print', 'طباعة'),
(120, 'year', 'year', 'السنة'),
(122, 'payment', 'payment', 'الدفع'),
(123, 'payment_history', 'Payment History', 'تاريخ الدفعات'),
(126, 'files', 'files', 'ملفات'),
(127, 'file', 'File', 'ملف'),
(128, 'add_file', 'Add file', 'اضافة ملف'),
(130, 'category_name', 'Category name', 'اسم التصنيف'),
(131, 'consumption', 'Consumption', 'استهلاك'),
(132, 'solde', 'balance', 'الرصيد'),
(134, 'activate', 'activate', 'مفعل'),
(137, 'current_year', 'Current Year', 'السنة الحالية'),
(139, 'days', 'days', 'الايام'),
(140, 'paid', 'paid', 'دفع'),
(141, 'unpaid', 'Unpaid', 'غير مدفوع'),
(144, 'pending', 'Pending', 'انتظار'),
(147, 'increase', 'Increase', 'زيادة'),
(148, 'discounts', 'Discounts', 'خصم'),
(150, 'total', 'Total', 'المجموع'),
(151, 'create_position', 'Create Position', 'اضافة '),
(153, 'description', 'Description', 'وصف'),
(159, 'entry', 'Entry', 'الدخول'),
(160, 'out', 'Out', 'خروج'),
(161, 'employee_score', 'employee_score', ''),
(165, 'day', 'Day', 'اليوم'),
(173, 'download', 'Download', 'تحميل'),
(174, 'validate', 'Validate', 'مصادقة'),
(175, 'date', 'date', 'التاريخ'),
(176, 'done', 'Done', 'تم'),
(177, 'not_done', 'not done', 'لم تفعل'),
(178, 'hours', 'Hours', 'الساعات'),
(179, 'observation', 'Observation', 'ملاحظات'),
(180, 'september', 'September', 'شتنبر'),
(181, 'october', 'October', 'اكتوبر'),
(182, 'november', 'November', 'نونبر'),
(183, 'may', 'May', 'ماي'),
(184, 'march', 'March', 'مارس'),
(185, 'june', 'June', 'يونيو'),
(186, 'july', 'July', 'يوليوز'),
(187, 'january', 'January', 'يناير'),
(188, 'february', 'February', 'فبراير'),
(189, 'december', 'December', 'دجنبر'),
(190, 'august', 'August', 'غشت'),
(191, 'april', 'April', 'ابريل'),
(192, 'syntyse', 'Syntyse', 'كشف'),
(195, 'price', 'price', 'الثمن'),
(196, 'show', 'Show', 'اظهار '),
(197, 'value', 'Value', 'القيمة'),
(198, 'today', 'Today', 'اليوم'),
(199, 'division', 'Division', 'تقسيم'),
(205, 'display', 'Display', 'اظهار'),
(206, 'calculate', 'Calculate', 'احتساب'),
(207, 'pay', 'pay', 'دفع'),
(208, 'number_hours', 'Number of hours', 'عدد الساعات'),
(209, 'paiement', 'paiement', 'الدفع'),
(210, 'checks', 'Checks', 'الشيكات'),
(211, 'check', 'Check', 'الشيك'),
(212, 'payment_mode', 'Payment mode', 'طرق الدفع'),
(213, 'cash', 'Cash', 'نقد'),
(214, 'bank_transfer', 'Bank transfer', 'التحويل البنكي'),
(215, 'generate', 'Generate', 'توليد'),
(216, 'category', 'Category', 'التصنيف'),
(217, 'create_category', 'Create Category', 'اضافة تصنيف'),
(218, 'category_list', 'Category list', 'لائحة التصنيفات'),
(219, 'payment_rate', 'Payment Rate', 'نسبة الدفع'),
(220, 'rate', 'Rate', 'نسبة'),
(224, 'categorys', 'Categorys', 'التصنيفات'),
(225, 'starte', 'Starte', 'البداية'),
(226, 'return', 'Return', 'الرجوع'),
(230, 'recheck', 'Re-check', 'اعادة بحث'),
(232, 'order_number', 'Order number', 'رقم الطلب'),
(244, 'user_exist', 'User Exist', 'المستخدم موجود'),
(245, 'email_exist', 'Email exist', 'البريد موجود'),
(246, 'general_settings', 'General settings', 'الاعدادات العامة'),
(247, 'create_language', 'Create language', 'اضافة لغة'),
(248, 'language_name', 'language name', 'اسم اللغة'),
(249, 'add_language', 'Add language', 'اضافة لغة'),
(250, 'languages_list', 'Languages list', 'لائحة  اللغات'),
(251, 'phrases', 'phrases', 'الجملة'),
(252, 'add_phrase', 'Add phrase', 'اضافة جملة'),
(253, 'phrase_name', 'Phrase name', 'اسم الجملة'),
(254, 'phrases_list', 'Phrases list', 'لائحة الجمل'),
(255, 'reset', 'reset', 'مسح'),
(256, 'label', 'label', 'عنوان'),
(257, 'roles', 'Roles', 'ادوار'),
(258, 'user_list', 'Users List', 'قائمة المستخدمين'),
(259, 'add_user', 'Add User', 'اضافة مستخدم'),
(260, 'role', 'Role', 'دور'),
(261, 'password', 'Password', 'كلمة المرور'),
(262, 'not_change_your_password', 'Leave blank if you do not want to change your password', 'اتركه فارغا ان لم ترغب في تغييره'),
(263, 'download_backup_database', 'Download database backup ', 'نسخ قاعدة البيانات'),
(264, 'my_profile', 'My profile', 'الحساب الشخصي'),
(265, 'user_password_incorrect', 'username or password incorrect', 'المستخدم او كلمة المرور خاطئة'),
(266, 'authentication', 'Authentication', 'تسيجل دخول'),
(267, 'remember_me', 'Remember me', 'تفكرني'),
(268, 'log_in', 'log in', 'تسجيل الدخول'),
(269, 'username', 'Username', 'اسم المستخدم'),
(270, 'on', 'on', 'on'),
(271, 'off', 'off', 'off'),
(275, 'wording', 'wording', 'الوصف'),
(276, 'to_pay', 'TO PAY', 'للسداد'),
(277, 'to_discount', 'TO Discount', 'للخصم'),
(278, 'create_role', 'create_role', 'اضافة مجموعة'),
(279, 'permissions', 'permissions', 'الصلاحيات'),
(280, 'login_to_system', 'Login to the system', 'الدخول الى النظام'),
(282, 'send', 'Send', 'ارسال'),
(284, 'new', 'new', 'جديد'),
(288, 'sun', 'Sun', 'اح'),
(289, 'sat', 'Sat', 'سب'),
(291, 'tue', 'Tue', 'ثلث'),
(292, 'wed', 'Wed', 'ارب'),
(293, 'thu', 'Thu', 'خم'),
(294, 'fri', 'Fri', 'جم'),
(295, 'number_days', 'number of days', 'عدد الايام'),
(301, 'expiry_date_hijr', 'Date to', 'التاريخ الى'),
(311, 'seriale', '', 'التسلسل'),
(314, 'communication', NULL, 'التواصل'),
(324, 'company', NULL, 'الشركة'),
(325, 'branche', NULL, 'فرع'),
(326, 'branches', NULL, 'الفروع'),
(327, 'forgot_my_password', 'I forgot my password', 'استرجاع كلمة المرور'),
(328, 'send_me', 'send me', 'أرسل إلي'),
(329, 'enter_your_email_receive_instructions', 'Enter your email and to receive instructions', 'أدخل بريدك الإلكتروني وتلقي التعليمات'),
(330, 'back_to_login', 'back to login', 'العودة لتسجيل الدخول'),
(333, 'notes', 'notes ', 'الملاحظات'),
(335, 'main', 'Main', 'الرئيسية'),
(336, 'pos', 'pos', 'سجل البيع'),
(337, 'account', 'account', 'الحساب'),
(338, 'sales', 'sales', 'المبيعات'),
(339, 'customers', 'Customers', 'العملاء'),
(340, 'expenses', 'expenses', 'المصاريف'),
(341, 'reports', 'Reports', 'التقارير'),
(342, 'todaysale', 'Today Sale', 'مبيعات اليوم'),
(343, 'requeststoday', 'Requests Today', 'طلبات اليوم'),
(344, 'client', 'Client', 'العميل'),
(345, 'number_of_services', 'number of services', 'عدد الخدمات'),
(346, 'partial_payment', 'partial payment', 'دفع جزئي'),
(347, 'receipt', 'Receipt', 'إيصال'),
(348, 'statementofexpensesandsalesfortheyear', 'Statement of expenses and sales for the year', 'مبيان المصاريف والمبيعات لسنة '),
(349, 'storename', 'Store name', 'إسم المتجر'),
(350, 'play_audio_alerts', 'Play audio alerts', 'تشغيل التنبيهات الصوتية'),
(351, 'tax', 'tax', 'الضريبة'),
(352, 'yes', 'yes', 'نعم '),
(353, 'no', 'no', 'لا'),
(354, 'message_of_thanks', 'Message of thanks', 'رسالة شكر'),
(355, 'warning', 'warning', 'تنبيه '),
(356, 'address_above_the_receipt', 'Address above the receipt', 'عنوان أعلى على الإيصال '),
(357, 'laundry_management_software', 'Laundry management software', 'برنامج إدارة المغاسل'),
(358, 'country', 'country', 'الدولة'),
(359, 'password_does_not_match', 'password does not match', 'كلمة المرور غير مطابقة'),
(360, 'this_fieldis_required', 'This field is required', 'هذه الخانات مطلوبة'),
(361, 'error_writing_a_backup_db_copy_to_disk', 'Error writing a backup DB copy to disk', 'خطأ أثناء كتابة نسخة القاعدة احتياطية على القرص '),
(362, 'an_error_occurred', 'an error occurred', 'حدث خطا'),
(363, 'default_client', 'default client ', 'عميل إفتراضي'),
(364, 'there_is_no', 'there is no', 'لا يوجد'),
(365, 'add_services', 'add services', 'إضافة خدمات'),
(366, 'service', 'service', 'الخدمة'),
(367, 'services', 'services', 'خدمات'),
(368, 'quantity', 'quantity', 'الكمية'),
(369, 'product', 'product', 'المنتج'),
(370, 'subtotal', 'subtotal', 'المجموع الفرعي'),
(371, 'rest', 'rest', 'الباقي'),
(372, 'openedby', 'opened by', 'تم الفتح بواسطة'),
(373, 'cashinhand', 'Cashin Hand', 'نقد في اليد'),
(374, 'openingtime', 'Opening time', 'تاريخ الفتح'),
(375, 'expected', 'EXPECTED', 'متوقع'),
(376, 'counted', 'COUNTED', 'المعدود'),
(377, 'differences', 'DIFFERENCES', 'الفرق'),
(378, 'cheque', 'Cheque', ' الشيك'),
(379, 'paymentssummary', 'Payments Summary', 'ملخص الدفوعات'),
(380, 'payementtype', 'Payement Type', 'طرق الدفع'),
(381, 'deliverydate', 'delivery date', 'تاريخ التسليم'),
(382, 'delivery', 'delivery', 'تم التسليم'),
(383, 'delivered_by', 'delivered by', 'تسليم بواسطة'),
(384, 'depositdate', 'deposit date', ' تاريخ الإيداع'),
(385, 'delivery_and_payment', 'Delivery and payment', 'تسليم وتسوية'),
(386, 'open', 'open', 'مفتوح'),
(387, 'closeby', 'Close by', 'أغلق بواسطة'),
(388, 'did_not_deliver', 'did not deliver', 'لم يسلم'),
(389, 'bill', 'bill', 'الفاتورة'),
(390, 'copy_the_database', 'Copy the database', NULL),
(391, 'fileformat', 'File format', 'صيغة الملف'),
(392, 'copyingfiles', 'copying files', NULL),
(393, 'filename', 'file name', 'إسم الملف'),
(394, 'add_a_new_category', 'add a new category', 'إضافة نوع جديد'),
(395, 'products_list', 'products list', 'لائحة المنتجات'),
(396, 'additional_services', 'additional services', 'خدمات إضافية'),
(397, 'search', 'search', 'بحث '),
(398, 'add_new_customer', 'add new customer', 'إضافة عميل جديد'),
(399, 'list_of_clients', 'List of clients', 'لائحة العملاء'),
(400, 'total_transactions', 'total transactions', 'مجموع التعاملات'),
(401, 'list_of_expenses', 'List of expenses', 'لائحة المصاريف'),
(402, 'ad_an_expense', 'Ad an expense', NULL),
(403, 'add_an_expense', 'Add an expense', 'إضافة مصروف جديد'),
(404, 'sorry_you_dont_have_the_powerstodo_this', 'Sorry, you don\'t have the powers to do this!', ' المعذرة, ليس لديك الصلاحيات للقيام بالامر!'),
(405, 'open_sale', 'open sale', 'فتح السجل'),
(406, 'laundry', 'laundry', 'غسيل'),
(407, 'presser', NULL, NULL),
(408, 'iron', NULL, NULL),
(409, 'dry_wash', 'dry wash', 'غسيل جاف'),
(410, 'other_services', 'other services', 'خدمات اخرى'),
(411, 'normal', 'normal', 'عادي'),
(412, 'express', 'express\r\n', 'سريع'),
(413, 'lroning', 'lroning', 'كوي'),
(414, 'laundrylroning', 'laundry and ironing', 'غسيل وكوي'),
(415, 'dry', 'dry wash', 'غسيل جاف'),
(416, 'other', 'Other services', 'خدمات اخرى'),
(417, 'fast', 'fast', 'مستعجل'),
(418, 'color', 'color', 'اللون'),
(419, 'daily_sales', 'daily sales', 'المبيعات اليومية'),
(420, 'number_of_daily_orders', 'number of daily orders', 'عدد الطلبات اليومية'),
(421, 'invoice_does_not_exist', 'invoice does not exist', 'الفاتورة غير موجودة'),
(422, 'add_an_invoice', 'Add an invoice', 'إضافة فاتورة'),
(423, 'check_number', 'check number', 'رقم الشيك'),
(424, 'close_the_sale', 'Close the sale', 'إغلاق السجل'),
(425, 'hide', 'Hide', 'إخفاء'),
(426, 'find_an_invoice', 'find an invoice', 'بحث عن فاتورة'),
(427, 'add_product', 'add product', 'إضافة منتج '),
(428, 'product_name', 'product name', 'إسم المنتج'),
(429, 'products', 'products', 'المنتجات'),
(430, 'add_an_icon', 'Add an icon', ' إضافة ايقونة'),
(431, 'point_sale_report', 'Point of Sale Report', 'تقرير ال'),
(432, 'closingtime', 'closing time', 'وقت الاغلاق'),
(433, 'earnings', 'earnings', 'المداخيل'),
(434, 'total_taxes', 'total taxes', 'مجموع الضرائب'),
(435, 'paid_up', 'paid up', 'المدفوع'),
(436, 'total_discounts', 'total discounts', 'مجموع الخصومات'),
(437, 'by', 'by', 'بواسطة'),
(438, 'sales_report', 'sales report', 'تقرير المبيعات '),
(439, 'graph', 'graph', 'المبيان'),
(440, 'list_of_the_most_requested_services', 'list of the most requested services', 'قائمة الخدمات الأكثر طلبًا'),
(441, 'from', 'from', 'من'),
(442, 'to', 'to', 'إلى'),
(443, 'total_revenue', 'total revenue', ' إجمالي الإيرادات'),
(444, 'register', 'register', 'القيد'),
(445, 'deletion_confirmation_regester', 'All sale related to the listing will be deleted', 'سيتم حدف جميع  عمليات البيع المتعلقة بالقيد'),
(446, 'advanced_search', 'advanced search', 'بحث متقدم'),
(447, 'service_name', 'Service name', 'إسم الخدمة'),
(448, 'leave_this_field_blank', 'Leave this field blank if you do not want to change the password', 'اترك فارغا ان لم ترد ان تغير كلمة المرور'),
(449, 'old_password', 'old password', 'كلمة المرور القديمة'),
(450, 'new_password', 'new password', 'كلمة المرور الجديدة'),
(451, 'close_register', 'Close register', 'إغلاق سجل البيع'),
(452, 'add_a_new_customer', 'add a new customer', 'إضافة عميل'),
(453, 'colors', 'colors', 'الالوان'),
(454, 'delet', 'Delete', 'حدف'),
(455, 'arabic', 'arabic', 'العربية'),
(456, 'english', 'english', 'الانجليزية'),
(457, 'white', 'white', 'أبيض'),
(458, 'sale_num', 'Receipt number', 'رقم الإيصال'),
(459, 'document_type', 'document type', NULL),
(460, 'sms', 'sms', 'الرسائل القصيرة'),
(461, 'sms_of_adding_the_order', 'sms of adding the order', NULL),
(462, 'sms_when_order_is_ready', 'when order is ready', NULL),
(463, 'send_sms', 'Send sms', NULL),
(464, 'message', 'message', NULL),
(465, 'add_new_sms', 'add new sms', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mdls`
--

CREATE TABLE `mdls` (
  `id_mdls` int(11) NOT NULL,
  `name_ar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mdls`
--

INSERT INTO `mdls` (`id_mdls`, `name_ar`) VALUES
(1, 'المستخدمين');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(11) NOT NULL,
  `fr_months` varchar(20) NOT NULL,
  `en_months` varchar(20) NOT NULL,
  `months_ar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `fr_months`, `en_months`, `months_ar`) VALUES
(1, 'janvier', 'January', 'يناير'),
(2, 'février', 'February', 'فيراير'),
(3, 'mars ', 'March', 'مارس'),
(4, 'avril', 'April', 'ابريل'),
(5, 'mai', 'May', 'ماي'),
(6, 'juin', 'June', 'يونيو'),
(7, 'juillet', 'July', 'يوليوز'),
(8, 'août', 'August', 'غشت'),
(9, 'septembre', 'September', 'شتنبر'),
(10, 'octobre', 'October', 'أكتوبر'),
(11, 'novembre', 'November', 'نونبر'),
(12, 'décembre', 'December', 'دجنبر');

-- --------------------------------------------------------

--
-- Table structure for table `payements`
--

CREATE TABLE `payements` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid` float NOT NULL,
  `paidmethod` varchar(300) CHARACTER SET latin1 NOT NULL,
  `created_by` varchar(60) CHARACTER SET latin1 NOT NULL,
  `register_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posale`
--

CREATE TABLE `posale` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `register` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `type_one` varchar(30) DEFAULT NULL,
  `type_second` varchar(30) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `num` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `lroning_normal` float NOT NULL,
  `lroning_fast` float NOT NULL,
  `laundry_normal` float NOT NULL,
  `laundry_fast` float NOT NULL,
  `laundrylroning_normal` float NOT NULL,
  `laundrylroning_fast` float NOT NULL,
  `dry_normal` float NOT NULL,
  `dry_fast` float NOT NULL,
  `other_normal` float NOT NULL,
  `other_fast` float NOT NULL,
  `icon` varchar(100) NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `num`, `name`, `category_id`, `lroning_normal`, `lroning_fast`, `laundry_normal`, `laundry_fast`, `laundrylroning_normal`, `laundrylroning_fast`, `dry_normal`, `dry_fast`, `other_normal`, `other_fast`, `icon`, `store_id`, `user_id`, `created_at`, `updated_at`) VALUES
(18, 'PR001', 'pants', 2, 4.5, 6, 4, 8, 8, 10, 5, 5, 0, 0, 'glyph-icon iconsminds-jeans', 1, 1, '2021-01-08 22:11', '2021-04-18 14:49'),
(20, 'PR020', 'jacket', 3, 10, 12, 12, 14, 20, 22, 4, 5.5, 0, 0, 'jacket.svg', 1, 1, '2021-01-24 13:48', '2021-04-18 14:10'),
(21, 'PR021', 'Carpets', 4, 50, 60, 50, 60, 100, 120, 40, 45, 0, 0, 'mattress.svg', 1, 1, '2021-02-02 14:40', '2021-04-18 14:44'),
(22, 'PR022', 'coat', 2, 10, 12, 10, 12, 20, 22, 5, 7, 0, 0, 'trench-coat.svg', 1, 1, '2021-03-17 14:59', '2021-04-18 14:14'),
(23, 'PR023', 't-shirt', 3, 5, 6, 5, 6, 10, 12, 6, 6, 0, 0, 'glyph-icon iconsminds-t-shirt', 1, 1, '2021-03-17 14:32', '2021-04-18 14:42'),
(24, 'PR024', 'dress', 2, 12, 14, 12, 14, 22, 30, 10, 10, 0, 0, 'glyph-icon iconsminds-dress', 1, 1, '2021-03-17 14:19', '2021-04-18 14:07'),
(25, 'PR024', 't-shirt', 3, 7, 10, 7, 10, 14, 20, 4, 6, 0, 0, 'glyph-icon iconsminds-blouse', 1, 1, '2021-03-17 14:25', '2021-04-18 14:56'),
(26, 'PR026', 'Shirt', 3, 7, 7, 10, 12, 17, 18, 10, 10, 0, 0, 'shirts.svg', 1, 1, '2021-03-17 14:42', '2021-04-18 14:28'),
(27, 'PR027', 'towel', 4, 5, 5, 6, 6, 12, 14, 10, 10, 0, 0, 'laundry.svg', 1, 1, '2021-03-17 14:39', '2021-04-18 14:52'),
(28, 'PR025', 'Sweat pants', 3, 5, 6, 5, 6, 10, 12, 7, 8, 0, 0, 'pant.svg', 1, 1, '2021-03-17 14:29', '2021-04-18 14:27'),
(29, 'PR029', 'shoes', 3, 0, 0, 10, 15, 0, 0, 7, 10, 0, 0, 'sneaker.svg', 1, 1, '2021-03-17 14:45', '2021-04-18 14:53'),
(30, 'PR028', 'cap', 3, 3, 4, 3, 4, 6, 7, 4, 5, 0, 0, 'cap.svg', 1, 1, '2021-03-17 14:00', '2021-04-18 14:28'),
(31, 'PR031', 'Hat', 2, 3, 5, 3, 5, 5, 7, 3, 5, 0, 0, 'glyph-icon iconsminds-cap', 1, 1, '2021-03-17 14:42', '2021-04-18 14:15'),
(32, 'PR032', 'skirt', 2, 5, 7, 5, 7, 10, 14, 6, 6, 0, 0, 'batik-skirt.svg', 1, 1, '2021-03-17 14:46', '2021-04-18 14:47'),
(33, 'PR033', 'costume', 3, 10, 12, 10, 12, 10, 13, 4, 5, 0, 0, 'blazer.svg', 1, 1, '2021-03-17 14:41', '2021-04-18 14:54'),
(34, 'PR034', 'military uniform', 3, 10, 12, 10, 12, 20, 24, 7, 8, 0, 0, 'uniform.svg', 1, 1, '2021-03-17 14:44', '2021-04-18 14:51'),
(35, 'PR035', 'Medical suit', 2, 5, 7, 6, 6, 10, 10, 10, 10, 0, 0, 'uniform-medical.svg', 1, 1, '2021-03-17 15:49', '2021-04-18 14:39'),
(36, 'PR036', 'vest', 3, 5, 5, 5, 5, 10, 10, 2, 2, 0, 0, 'vest.svg', 1, 1, '2021-03-17 15:38', '2021-04-18 14:05'),
(37, 'PR037', 'Queer jacket', 3, 15, 20, 15, 20, 30, 32, 10, 12, 0, 0, 'leather-jacket.svg', 1, 1, '2021-03-17 15:10', '2021-04-18 14:38'),
(38, 'PR038', 'Sleeping mattress', 4, 10, 12, 10, 12, 20, 24, 10, 12, 0, 0, 'bed-sheets.svg', 1, 1, '2021-03-17 15:15', '2021-04-18 14:18');

-- --------------------------------------------------------

--
-- Table structure for table `prod_serv`
--

CREATE TABLE `prod_serv` (
  `id` int(11) NOT NULL,
  `pricing` float NOT NULL,
  `id_product` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prod_serv`
--

INSERT INTO `prod_serv` (`id`, `pricing`, `id_product`, `service_id`) VALUES
(1, 4, 2, 1),
(2, 1, 2, 2),
(3, 3, 3, 1),
(4, 2, 3, 2),
(5, 10, 4, 1),
(6, 5, 4, 2),
(7, 2, 5, 1),
(8, 1, 5, 2),
(9, 12, 6, 1),
(10, 14, 6, 2),
(11, 10, 7, 1),
(12, 8, 7, 2),
(13, 4, 8, 1),
(14, 3, 8, 2),
(15, 4, 9, 1),
(16, 4, 9, 2),
(17, 4, 10, 1),
(18, 4, 10, 2),
(19, 1, 11, 1),
(20, 1, 11, 2),
(21, 10, 12, 1),
(22, 10, 12, 2),
(23, 4, 13, 1),
(24, 4, 13, 2),
(25, 10, 14, 1),
(26, 10, 14, 2),
(27, 1, 15, 1),
(28, 2, 15, 2),
(29, 11, 16, 1),
(30, 11, 16, 2),
(31, 10, 17, 1),
(32, 10, 17, 2),
(33, 2, 18, 1),
(34, 2, 18, 2),
(35, 1, 19, 1),
(36, 2, 19, 2),
(37, 5, 20, 1),
(38, 4, 20, 2),
(39, 10, 21, 1),
(40, 5, 21, 2),
(41, 5, 22, 1),
(42, 10, 22, 2),
(43, 3, 23, 1),
(44, 3, 23, 2),
(45, 5, 24, 1),
(46, 5, 24, 2),
(47, 5, 25, 1),
(48, 5, 25, 2),
(49, 3, 26, 1),
(50, 3, 26, 2),
(51, 3, 27, 1),
(52, 3, 27, 2),
(53, 2, 28, 1),
(54, 2, 28, 2),
(55, 3, 29, 1),
(56, 3, 29, 2),
(57, 2, 30, 1),
(58, 2, 30, 2),
(59, 2, 31, 1),
(60, 2, 31, 2),
(61, 5, 32, 1),
(62, 5, 32, 2),
(63, 2, 33, 1),
(64, 2, 33, 2),
(65, 5, 34, 1),
(66, 5, 34, 2),
(67, 5, 35, 1),
(68, 5, 35, 2),
(69, 2, 36, 1),
(70, 2, 36, 2),
(71, 5, 37, 1),
(72, 5, 37, 2),
(73, 5, 38, 1),
(74, 5, 38, 2),
(75, 2, 39, 1),
(76, 3, 39, 2);

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_total` float DEFAULT NULL,
  `cash_sub` float DEFAULT NULL,
  `cheque_total` float DEFAULT NULL,
  `cheque_sub` float DEFAULT NULL,
  `cash_inhand` float DEFAULT NULL,
  `note` text DEFAULT NULL,
  `closed_at` varchar(150) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `store_id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 1, '2020-12-31 18:51', '2020-12-31 18:03'),
(2, 1, 'user', 2, '2021-01-16 23:11', '2020-12-31 18:03');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `clientname` varchar(50) NOT NULL,
  `tax` varchar(5) DEFAULT NULL,
  `discount` varchar(5) DEFAULT NULL,
  `subtotal` varchar(15) NOT NULL,
  `total` float NOT NULL,
  `created_at` date NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `date_yeare` int(11) NOT NULL,
  `date_month` int(11) NOT NULL,
  `delivery_at` varchar(50) NOT NULL,
  `modified_at` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `delivery_by` varchar(50) DEFAULT NULL,
  `totalitems` int(20) NOT NULL,
  `paid` varchar(15) DEFAULT NULL,
  `paidmethod` varchar(700) DEFAULT NULL,
  `taxamount` float DEFAULT NULL,
  `discountamount` float DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `firstpayement` float DEFAULT NULL,
  `note` text DEFAULT NULL,
  `phoneclient` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_one` varchar(20) DEFAULT NULL,
  `type_second` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `qt` int(6) NOT NULL,
  `subtotal` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `parent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `num` varchar(20) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `num`, `store_id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SR001', 1, 'Stain removal', 1, '2020-12-31 17:01', '2021-04-18 14:06'),
(2, 'SR002', 1, 'Dry up', 1, '2020-12-31 21:46', '2021-04-18 14:39');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `audio_alert` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_address` varchar(255) DEFAULT NULL,
  `store_phone` varchar(255) NOT NULL,
  `store_email` varchar(50) DEFAULT NULL,
  `logo` longtext NOT NULL,
  `tax` float NOT NULL,
  `discount` float NOT NULL,
  `language` varchar(20) DEFAULT NULL,
  `decimals` int(2) NOT NULL,
  `top_product` int(11) NOT NULL,
  `receiptheader` text NOT NULL,
  `receiptfooter` text NOT NULL,
  `footer_text` text NOT NULL,
  `timezone` varchar(400) DEFAULT NULL,
  `sms_add_order` text DEFAULT NULL,
  `sms_delivery_order` text DEFAULT NULL,
  `sms_order_readyr` text DEFAULT NULL,
  `api_sms` text DEFAULT NULL,
  `senderId` varchar(50) DEFAULT NULL,
  `dnd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `audio_alert`, `currency`, `store_name`, `store_address`, `store_phone`, `store_email`, `logo`, `tax`, `discount`, `language`, `decimals`, `top_product`, `receiptheader`, `receiptfooter`, `footer_text`, `timezone`, `sms_add_order`, `sms_delivery_order`, `sms_order_readyr`, `api_sms`, `senderId`, `dnd`) VALUES
(1, 1, 'usd', 'laundry Pro', 'Address 01 ozte morroco', '0672703042', 'cnt.somatech@gmail.com', 'logo_landry.jpg', 0, 0, 'english', 2, 5, 'laundry Pro Address 11', 'We are not responsible for the loss of your deposits after the expiration of the two month period.', 'thank you for your trust', 'Africa/Casablanca', 'Dear {customer},\r\n\r\nCloth(es) Received with Order No: {ORDERNO} Total: {TOTAL} Paid: {PAID} Bal: {BAL}', NULL, 'Dear {customer}, \r\nYour Job/Order {ORDERNO} dropped on {DATE} is now ready for pickup. Pls come with balance of {BAL}.', 'ZDm58A7iIw8FZggJuBj3ofOyv6iyvUkGqAUyOYCb041i9qJeLkqefQtZ5jRu', 'TRIPLE D', '2');

-- --------------------------------------------------------

--
-- Table structure for table `sms_msg`
--

CREATE TABLE `sms_msg` (
  `id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `message` text DEFAULT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `useraction`
--

CREATE TABLE `useraction` (
  `id_mdls` int(11) NOT NULL,
  `title_action` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `num` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `store_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `num`, `name`, `email`, `password`, `store_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'cra', 'admin', 'admin', 'd93a5def7511da3d0f2d171d9c344e91', 1, 1, NULL, NULL),
(2, 'US002', 'user1', 'user1', 'd93a5def7511da3d0f2d171d9c344e91', 1, 2, '2021-01-02 :15:22', '2021-05-15 06:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`backup_id`),
  ADD UNIQUE KEY `backup_name_UNIQUE` (`backup_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_expences`
--
ALTER TABLE `categorie_expences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_action`
--
ALTER TABLE `group_action`
  ADD PRIMARY KEY (`id_action`);

--
-- Indexes for table `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdls`
--
ALTER TABLE `mdls`
  ADD PRIMARY KEY (`id_mdls`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payements`
--
ALTER TABLE `payements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posale`
--
ALTER TABLE `posale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_serv`
--
ALTER TABLE `prod_serv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_msg`
--
ALTER TABLE `sms_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `backup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categorie_expences`
--
ALTER TABLE `categorie_expences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `group_action`
--
ALTER TABLE `group_action`
  MODIFY `id_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `mdls`
--
ALTER TABLE `mdls`
  MODIFY `id_mdls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payements`
--
ALTER TABLE `payements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `posale`
--
ALTER TABLE `posale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1118;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `prod_serv`
--
ALTER TABLE `prod_serv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_msg`
--
ALTER TABLE `sms_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
