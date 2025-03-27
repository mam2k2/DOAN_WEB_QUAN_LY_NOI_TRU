-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2023 at 11:41 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2-core`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int UNSIGNED NOT NULL COMMENT 'admin log id(auto increment)',
  `user_id` int UNSIGNED NOT NULL COMMENT 'admin user id',
  `route` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'admin user operate route, like article/create',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci COMMENT 'admin user operate description',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`id`, `user_id`, `route`, `description`, `created_at`) VALUES
(1, 1, '/test/index', 'this is a demo', 1688446341),
(2, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 12 {{%RECORD%}}: <br>ID(id) => 12,<br>Type(type) => ,<br>Name(name) => website_title,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(3, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\form\\SettingWebsiteForm [ {{%options}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Value(value) : vi=>', 1688545492),
(4, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 13 {{%RECORD%}}: <br>ID(id) => 13,<br>Type(type) => ,<br>Name(name) => website_icp,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(5, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 14 {{%RECORD%}}: <br>ID(id) => 14,<br>Type(type) => ,<br>Name(name) => website_statics_script,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(6, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 15 {{%RECORD%}}: <br>ID(id) => 15,<br>Type(type) => ,<br>Name(name) => website_comment,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(7, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 16 {{%RECORD%}}: <br>ID(id) => 16,<br>Type(type) => ,<br>Name(name) => website_comment_need_verify,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(8, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\form\\SettingWebsiteForm [ {{%options}} ]  {{%UPDATED%}} {{%ID%}} 5 {{%RECORD%}}: <br>Value(value) : http://thuetau.local=>http://yii2-core.local', 1688545492),
(9, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 17 {{%RECORD%}}: <br>ID(id) => 17,<br>Type(type) => ,<br>Name(name) => seo_keywords,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(10, 1, 'setting/website', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Options [ {{%options}} ]  {{%CREATED%}} {{%ID%}} 18 {{%RECORD%}}: <br>ID(id) => 18,<br>Type(type) => ,<br>Name(name) => seo_description,<br>Value(value) => ,<br>Input Type(input_type) => ,<br>Autoload(autoload) => ,<br>Tips(tips) => ,<br>Sort(sort) => ,<br>Deleted At(deleted_at) => ', 1688545492),
(11, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Id(id) => 1,<br>Username(username) => test,<br>Auth Key(auth_key) => tuaVrERpwAR_x6RPXyCp1PX_vigSe-8q,<br>Password Hash(password_hash) => $2y$13$IsXmqBEieeG9gevNqnUKJuo1gmaZmYrKU1g1P1r8G8SqA95dmCFaG,<br>Password Reset Token(password_reset_token) => ,<br>Email(email) => test@gmail.com,<br>Avatar(avatar) => ,<br>Access Token(access_token) => ,<br>Status(status) => 10,<br>Created At(created_at) => 1688552970,<br>Updated At(updated_at) => 1688552970,<br>Deleted At(deleted_at) => ', 1688552970),
(12, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Password Hash(password_hash) : $2y$13$IsXmqBEieeG9gevNqnUKJuo1gmaZmYrKU1g1P1r8G8SqA95dmCFaG=>$2y$13$hQ8njVlPdFasceWcAbA61OpmrDSB2/B/HxtegMvKEjmV6OXJyBKBO,<br>Updated At(updated_at) : 1688552970=>1688553000', 1688553000),
(13, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Password Hash(password_hash) : $2y$13$hQ8njVlPdFasceWcAbA61OpmrDSB2/B/HxtegMvKEjmV6OXJyBKBO=>$2y$13$.TgMHPQ2IGgMBMBGIZkG7ONgd3ZsBa/SjMrFzYoEYQ2fKPjwc7m1m,<br>Updated At(updated_at) : 1688553000=>1688553040', 1688553040),
(14, 1, 'frontend-menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 2 {{%RECORD%}}: <br>ID(id) => 2,<br>Type(type) => 1,<br>Parent Id(parent_id) => 1,<br>Name(name) => Website Setting,<br>Url(url) => [\"\\/setting\\/website\"],<br>Icon(icon) => ,<br>Sort(sort) => 0,<br>Target(target) => _self,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688541848,<br>Updated At(updated_at) => 1688541848,<br>Deleted At(deleted_at) => 0', 1688553129),
(15, 1, 'frontend-menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 3 {{%RECORD%}}: <br>ID(id) => 3,<br>Type(type) => 1,<br>Parent Id(parent_id) => 1,<br>Name(name) => SMTP Setting,<br>Url(url) => [\"\\/setting\\/smtp\"],<br>Icon(icon) => ,<br>Sort(sort) => 1,<br>Target(target) => _self,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688541848,<br>Updated At(updated_at) => 1688541848,<br>Deleted At(deleted_at) => 0', 1688553137),
(16, 1, 'frontend-menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 4 {{%RECORD%}}: <br>ID(id) => 4,<br>Type(type) => 1,<br>Parent Id(parent_id) => 1,<br>Name(name) => Custom Setting,<br>Url(url) => [\"\\/setting\\/custom\"],<br>Icon(icon) => ,<br>Sort(sort) => 2,<br>Target(target) => _self,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688541848,<br>Updated At(updated_at) => 1688541848,<br>Deleted At(deleted_at) => 0', 1688553147),
(17, 1, 'frontend-menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 6 {{%RECORD%}}: <br>ID(id) => 6,<br>Type(type) => 1,<br>Parent Id(parent_id) => 5,<br>Name(name) => Frontend Menu,<br>Url(url) => [\"\\/frontend-menu\\/index\"],<br>Icon(icon) => ,<br>Sort(sort) => 0,<br>Target(target) => _self,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688541848,<br>Updated At(updated_at) => 1688541848,<br>Deleted At(deleted_at) => 0', 1688553154),
(18, 1, 'frontend-menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 1 {{%RECORD%}}: <br>ID(id) => 1,<br>Type(type) => 1,<br>Parent Id(parent_id) => 0,<br>Name(name) => Setting,<br>Url(url) => [\"\"],<br>Icon(icon) => ,<br>Sort(sort) => 0,<br>Target(target) => _self,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688541848,<br>Updated At(updated_at) => 1688541848,<br>Deleted At(deleted_at) => 0', 1688553161),
(19, 1, 'frontend-menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 7 {{%RECORD%}}: <br>Updated At(updated_at) : 1688541848=>1688553228', 1688553228),
(20, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 51 {{%RECORD%}}: <br>ID(id) => 51,<br>Type(type) => 0,<br>Parent Id(parent_id) => 0,<br>Name(name) => Product,<br>Url(url) => [\"\\/product\\/index\"],<br>Icon(icon) => ,<br>Sort(sort) => 2,<br>Target(target) => _blank,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688612145,<br>Updated At(updated_at) => 1688612145,<br>Deleted At(deleted_at) => 0', 1688612145),
(21, 1, 'category/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%CREATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>ID(id) => 1,<br>Parent Category Id(parent_id) => 0,<br>Type(type) => ,<br>Name(name) => Test,<br>Alias(alias) => test,<br>Sort(sort) => 0,<br>Category Template(template) => ,<br>Article Template(article_template) => ,<br>Remark(remark) => ,<br>Created At(created_at) => 1688626434,<br>Updated At(updated_at) => 1688626434,<br>Deleted At(deleted_at) => ', 1688626434),
(22, 1, 'category/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688626434=>1688626703', 1688626703),
(23, 1, 'category/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688626703=>1688626758', 1688626758),
(24, 1, 'category/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688626758=>1688626794', 1688626794),
(25, 1, 'category/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688626794=>1688626821', 1688626821),
(26, 1, 'category/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%CREATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>ID(id) => 2,<br>Parent Category Id(parent_id) => 0,<br>Type(type) => ,<br>Name(name) => Test 123,<br>Alias(alias) => 1234,<br>Sort(sort) => 0,<br>Category Template(template) => ,<br>Article Template(article_template) => ,<br>Remark(remark) => ,<br>Created At(created_at) => 1688626908,<br>Updated At(updated_at) => 1688626908,<br>Deleted At(deleted_at) => ', 1688626908),
(27, 1, 'category/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%DELETED%}} {{%ID%}} 2 {{%RECORD%}}: <br>ID(id) => 2,<br>Parent Category Id(parent_id) => 0,<br>Type(type) => ,<br>Name(name) => Test 123,<br>Alias(alias) => 1234,<br>Sort(sort) => 0,<br>Category Template(template) => ,<br>Article Template(article_template) => ,<br>Remark(remark) => ,<br>Created At(created_at) => 1688626908,<br>Updated At(updated_at) => 1688626908,<br>Deleted At(deleted_at) => ', 1688626935),
(28, 1, 'category/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%DELETED%}} {{%ID%}} 1 {{%RECORD%}}: <br>ID(id) => 1,<br>Parent Category Id(parent_id) => 0,<br>Type(type) => ,<br>Name(name) => Test,<br>Alias(alias) => test,<br>Sort(sort) => 0,<br>Category Template(template) => ,<br>Article Template(article_template) => ,<br>Remark(remark) => ,<br>Created At(created_at) => 1688626434,<br>Updated At(updated_at) => 1688626821,<br>Deleted At(deleted_at) => ', 1688626952),
(29, 1, 'product/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Product [ product ]  {{%CREATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>ID(id) => 1,<br>Name(name) => Test,<br>Category(category_id) => ,<br>Image(image) => ,<br>Price(price) => 1000000,<br>Description(description) => ,<br>Content(content) => ,<br>Num Of Seller(num_of_sellers) => 3,<br>Created By(created_by) => 1,<br>Updated By(updated_by) => 1,<br>Deleted By(deleted_by) => ,<br>Created At(created_at) => 1688626983,<br>Updated At(updated_at) => 1688626983', 1688626983),
(30, 1, 'product/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Product [ product ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688626983=>1688636773', 1688636773),
(31, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 52 {{%RECORD%}}: <br>ID(id) => 52,<br>Type(type) => 0,<br>Parent Id(parent_id) => 0,<br>Name(name) => Shop,<br>Url(url) => [\"\\/shop\\/index\"],<br>Icon(icon) => ,<br>Sort(sort) => 3,<br>Target(target) => _blank,<br>Is Absolute Url(is_absolute_url) => 0,<br>Is Display(is_display) => 1,<br>Created At(created_at) => 1688694685,<br>Updated At(updated_at) => 1688694685,<br>Deleted At(deleted_at) => 0', 1688694685),
(32, 1, 'shop/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Shop [ shop ]  {{%CREATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>ID(id) => 1,<br>Name(name) => VODY,<br>Shop Owner(owner_id) => 1,<br>Phone Number(phone_number) => ,<br>Address(address) => Hải Phòng,<br>Description(description) => Bán các mặt hàng về thực phẩm chức năng,<br>Created By(created_by) => 1,<br>Updated By(updated_by) => 1,<br>Created At(created_at) => 1688695482,<br>Updated At(updated_at) => 1688695482', 1688695482),
(33, 1, 'shop/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Shop [ shop ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Description(description) : Bán các mặt hàng về thực phẩm chức năng=><p>Bán các mặt hàng về thực phẩm chức năng</p>,<br>Updated At(updated_at) : 1688695482=>1688699321', 1688699321),
(34, 1, 'shop/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Shop [ shop ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Updated At(updated_at) : 1688699321=>1688717258', 1688717258);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int UNSIGNED NOT NULL COMMENT 'admin user id(auto increment)',
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'admin username',
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'admin user auth key for generate logged in cookie',
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'admin user crypt password',
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'admin user reset password temp token',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'admin user email',
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '' COMMENT 'admin user avatar url',
  `access_token` varchar(42) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'token',
  `status` smallint NOT NULL DEFAULT '10' COMMENT 'admin user status, (normal:10)',
  `created_at` int NOT NULL COMMENT 'created at',
  `updated_at` int NOT NULL COMMENT 'updated at',
  `deleted_at` int DEFAULT NULL COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `avatar`, `access_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'zr9mY7lt23oAhj_ZYjydbLJKcbE3FJ19', '$2y$13$jxJT9kD0Ytht/apbQFtyb.AeaPRtnaWqM1spk74g2Xpyb/iufuazG', NULL, 'admin@pacific.com', '', '', 10, 1688446341, 1688446341, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int UNSIGNED NOT NULL COMMENT 'article id(auto increment)',
  `cid` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article category id',
  `type` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'type(0 article, 1 page)',
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'article title',
  `sub_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article sub title',
  `summary` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article summary',
  `thumb` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'thumb',
  `seo_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'seo title',
  `seo_keywords` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'seo keywords',
  `seo_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'seo description',
  `status` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'article status(0 draft,1 published)',
  `sort` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article order',
  `author_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article published by admin user id',
  `author_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article published by admin username',
  `scan_count` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article visited count',
  `comment_count` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article comment count',
  `can_comment` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'article can be comment. (0 no, 1 yes)',
  `visibility` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'article visibility(1.public,2.after commented,3.password,4.after logged in)',
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article password(plain text)',
  `flag_headline` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is head line(0 no, 1 yes',
  `flag_recommend` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is recommend(0 no, 1 yes',
  `flag_slide_show` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is slide show(0 no, 1 yes',
  `flag_special_recommend` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is special recommend(0 no, 1 yes',
  `flag_roll` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is roll(0 no, 1 yes',
  `flag_bold` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is bold(0 no, 1 yes',
  `flag_picture` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is picture(0 no, 1 yes',
  `template` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article detail page template path',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'updated at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_content`
--

CREATE TABLE `article_content` (
  `id` int UNSIGNED NOT NULL COMMENT 'article content id(auto increment)',
  `aid` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article id',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'article content'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_meta`
--

CREATE TABLE `article_meta` (
  `id` int UNSIGNED NOT NULL COMMENT 'article meta id(auto increment)',
  `aid` int UNSIGNED NOT NULL COMMENT 'article id',
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'key',
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'value',
  `created_at` int UNSIGNED NOT NULL COMMENT 'article meta created at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8mb3_unicode_ci,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `deleted_at` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `deleted_at` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL COMMENT 'category id(auto increment)',
  `parent_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'category parent id(an exist category id)',
  `type` int UNSIGNED DEFAULT NULL COMMENT 'category type',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'category name',
  `alias` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'category alias',
  `sort` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'category order',
  `template` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'category page template path',
  `article_template` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'article detail page template path',
  `remark` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'category remark info',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'updated at',
  `deleted_at` int UNSIGNED DEFAULT NULL COMMENT 'deleted at',
  `shop_id` int NOT NULL COMMENT 'Shop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_meta`
--

CREATE TABLE `category_meta` (
  `id` int UNSIGNED NOT NULL COMMENT 'category meta id(auto increment)',
  `cid` int UNSIGNED NOT NULL COMMENT 'category id',
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'key',
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'value',
  `created_at` int UNSIGNED NOT NULL COMMENT 'category meta created at',
  `deleted_at` int DEFAULT NULL COMMENT 'category meta deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int UNSIGNED NOT NULL COMMENT 'comment id(auto increment)',
  `aid` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'article id',
  `uid` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'user id(0 for guest)',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'admin user id(other user reply 0)',
  `reply_to` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'reply to comment id',
  `nickname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '游客' COMMENT 'user nickname',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'email',
  `website_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'user website',
  `content` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'comment content',
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'user ip',
  `status` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'comment status(0 to be audit, 1 approved, 2 reject',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'updated at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendly_link`
--

CREATE TABLE `friendly_link` (
  `id` int UNSIGNED NOT NULL COMMENT 'friendly link id(auto increment)',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'website name',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'website icon url',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'website url',
  `target` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '_blank' COMMENT 'open method(_blank, _self)',
  `sort` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'order',
  `status` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'status(0 hide, 1 display',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'updated at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int UNSIGNED NOT NULL COMMENT 'menu id(auto increment)',
  `type` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'menu type(0 backend, 1 frontend',
  `parent_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'parent menu id',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'menu name',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'menu url',
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'menu icon',
  `sort` float UNSIGNED NOT NULL DEFAULT '0' COMMENT 'menu order',
  `target` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '_blank' COMMENT 'open method(_blank, _self',
  `is_absolute_url` smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'is absolute url',
  `is_display` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'is display(0 no, 1 yes',
  `created_at` int UNSIGNED NOT NULL COMMENT 'created at',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'updated at',
  `deleted_at` int DEFAULT '0' COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `type`, `parent_id`, `name`, `url`, `icon`, `sort`, `target`, `is_absolute_url`, `is_display`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 0, 'Menu', '[\"\"]', '', 1, '_self', 0, 1, 1688541848, 1688541848, 0),
(7, 1, 5, 'Backend Menu', '[\"\\/menu\\/index\"]', '', 1, '_self', 0, 1, 1688541848, 1688553228, 0),
(8, 1, 0, 'Content', '[\"\"]', '', 2, '_self', 0, 1, 1688541848, 1688541848, 0),
(9, 1, 8, 'Article', '[\"\\/article\\/index\"]', '', 0, '_self', 0, 1, 1688541848, 1688541848, 0),
(10, 1, 8, 'Category', '[\"\\/category\\/index\"]', '', 1, '_self', 0, 1, 1688541848, 1688541848, 0),
(11, 1, 8, 'Comment', '[\"\\/comment\\/index\"]', '', 2, '_self', 0, 1, 1688541848, 1688541848, 0),
(12, 1, 8, 'Page', '[\"\\/page\\/index\"]', '', 3, '_self', 0, 1, 1688541848, 1688541848, 0),
(13, 1, 0, 'User', '[\"\\/user\\/index\"]', '', 3, '_self', 0, 1, 1688541848, 1688541848, 0),
(14, 1, 0, 'RBAC', '[\"\"]', '', 4, '_self', 0, 1, 1688541848, 1688541848, 0),
(15, 1, 14, 'Permissions', '[\"\\/rbac\\/permissions\"]', '', 0, '_self', 0, 1, 1688541848, 1688541848, 0),
(16, 1, 14, 'Roles', '[\"\\/rbac\\/roles\"]', '', 1, '_self', 0, 1, 1688541848, 1688541848, 0),
(17, 1, 14, 'Admin Users', '[\"\\/admin-user\\/index\"]', '', 2, '_self', 0, 1, 1688541848, 1688541848, 0),
(18, 1, 0, 'Friendly Link', '[\"\\/friendly-link\\/index\"]', '', 5, '_self', 0, 1, 1688541848, 1688541848, 0),
(19, 1, 0, 'Cache', '[\"\"]', '', 6, '_self', 0, 1, 1688541848, 1688541848, 0),
(20, 1, 19, 'Clear Frontend', '[\"\\/clear\\/frontend\"]', '', 0, '_self', 0, 1, 1688541848, 1688541848, 0),
(21, 1, 19, 'Clear Backend', '[\"\\/clear\\/backend\"]', '', 1, '_self', 0, 1, 1688541848, 1688541848, 0),
(22, 1, 0, 'Log', '[\"\\/log\\/index\"]', '', 7, '_self', 0, 1, 1688541848, 1688541848, 0),
(23, 1, 0, 'Operation', '[\"\"]', '', 8, '_self', 0, 1, 1688541849, 1688541849, 0),
(24, 1, 23, 'Banner', '[\"\\/banner\\/index\"]', '', 0, '_self', 0, 1, 1688541849, 1688541849, 0),
(25, 1, 23, 'Ad Management', '[\"\\/ad\\/index\"]', '', 1, '_self', 0, 1, 1688541849, 1688541849, 0),
(26, 0, 0, 'Setting', '[\"\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(27, 0, 26, 'Website Setting', '[\"\\/setting\\/website\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(28, 0, 26, 'SMTP Setting', '[\"\\/setting\\/smtp\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(29, 0, 26, 'Custom Setting', '[\"\\/setting\\/custom\"]', '', 2, '_self', 0, 1, 1688541876, 1688541876, 0),
(30, 0, 0, 'Menu', '[\"\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(31, 0, 30, 'Frontend Menu', '[\"\\/frontend-menu\\/index\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(32, 0, 30, 'Backend Menu', '[\"\\/menu\\/index\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(33, 0, 0, 'Content', '[\"\"]', '', 2, '_self', 0, 1, 1688541876, 1688541876, 0),
(34, 0, 33, 'Article', '[\"\\/article\\/index\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(35, 0, 33, 'Category', '[\"\\/category\\/index\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(36, 0, 33, 'Comment', '[\"\\/comment\\/index\"]', '', 2, '_self', 0, 1, 1688541876, 1688541876, 0),
(37, 0, 33, 'Page', '[\"\\/page\\/index\"]', '', 3, '_self', 0, 1, 1688541876, 1688541876, 0),
(38, 0, 0, 'User', '[\"\\/user\\/index\"]', '', 3, '_self', 0, 1, 1688541876, 1688541876, 0),
(39, 0, 0, 'RBAC', '[\"\"]', '', 4, '_self', 0, 1, 1688541876, 1688541876, 0),
(40, 0, 39, 'Permissions', '[\"\\/rbac\\/permissions\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(41, 0, 39, 'Roles', '[\"\\/rbac\\/roles\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(42, 0, 39, 'Admin Users', '[\"\\/admin-user\\/index\"]', '', 2, '_self', 0, 1, 1688541876, 1688541876, 0),
(43, 0, 0, 'Friendly Link', '[\"\\/friendly-link\\/index\"]', '', 5, '_self', 0, 1, 1688541876, 1688541876, 0),
(44, 0, 0, 'Cache', '[\"\"]', '', 6, '_self', 0, 1, 1688541876, 1688541876, 0),
(45, 0, 44, 'Clear Frontend', '[\"\\/clear\\/frontend\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(46, 0, 44, 'Clear Backend', '[\"\\/clear\\/backend\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(47, 0, 0, 'Log', '[\"\\/log\\/index\"]', '', 7, '_self', 0, 1, 1688541876, 1688541876, 0),
(48, 0, 0, 'Operation', '[\"\"]', '', 8, '_self', 0, 1, 1688541876, 1688541876, 0),
(49, 0, 48, 'Banner', '[\"\\/banner\\/index\"]', '', 0, '_self', 0, 1, 1688541876, 1688541876, 0),
(50, 0, 48, 'Ad Management', '[\"\\/ad\\/index\"]', '', 1, '_self', 0, 1, 1688541876, 1688541876, 0),
(51, 0, 0, 'Product', '[\"\\/product\\/index\"]', '', 2, '_blank', 0, 1, 1688612145, 1688612145, 0),
(52, 0, 0, 'Shop', '[\"\\/shop\\/index\"]', '', 3, '_blank', 0, 1, 1688694685, 1688694685, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1688446337),
('m130524_201442_init', 1688446343),
('m230704_044512_rbac_init', 1688446343),
('m230704_045008_add_article_teamplate', 1688446344),
('m230704_045122_addFrontendUserAccessToken', 1688453940),
('m230706_023037_create_product_table', 1688611444),
('m230707_013359_create_shop_table', 1688694216),
('m230707_014053_add_shop_id_to_category', 1688694216),
('m230707_014357_add_shop_id_to_product_table', 1688694274),
('m230707_083131_shop_meta', 1688718853);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int UNSIGNED NOT NULL COMMENT 'options id(auto increment)',
  `type` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'type (0 system, 1 custom, 2 banner, 3 advertisement',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'identifier',
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'value',
  `input_type` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'input box type',
  `autoload` smallint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'is autoload(0 no, 1 yes',
  `tips` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'tips',
  `sort` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'order',
  `deleted_at` int DEFAULT '0' COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `type`, `name`, `value`, `input_type`, `autoload`, `tips`, `sort`, `deleted_at`) VALUES
(1, 0, 'website_email', 'admin@pacific.com', 1, 0, '', 0, 0),
(2, 0, 'website_language', '', 1, 0, '', 0, 0),
(3, 0, 'website_status', '1', 1, 0, '', 0, 0),
(4, 0, 'website_timezone', 'Asia/Ho_Chi_Minh', 1, 0, '', 0, 0),
(5, 0, 'website_url', 'http://yii2-core.local', 1, 0, '', 0, 0),
(6, 0, 'smtp_host', '', 1, 0, '', 0, 0),
(7, 0, 'smtp_username', '', 1, 0, '', 0, 0),
(8, 0, 'smtp_password', '', 1, 0, '', 0, 0),
(9, 0, 'smtp_port', '', 1, 0, '', 0, 0),
(10, 0, 'smtp_encryption', '', 1, 0, '', 0, 0),
(11, 0, 'smtp_nickname', '', 1, 0, '', 0, 0),
(12, 0, 'website_title', '', 1, 1, '', 0, 0),
(13, 0, 'website_icp', '', 1, 1, '', 0, 0),
(14, 0, 'website_statics_script', '', 1, 1, '', 0, 0),
(15, 0, 'website_comment', '', 1, 1, '', 0, 0),
(16, 0, 'website_comment_need_verify', '', 1, 1, '', 0, 0),
(17, 0, 'seo_keywords', '', 1, 1, '', 0, 0),
(18, 0, 'seo_description', '', 1, 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name',
  `category_id` int DEFAULT NULL COMMENT 'Category',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Image',
  `price` float DEFAULT NULL COMMENT 'Price',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Description',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Content',
  `num_of_sellers` int DEFAULT NULL COMMENT 'Num Of Seller',
  `created_by` int DEFAULT NULL COMMENT 'Created By',
  `updated_by` int DEFAULT NULL COMMENT 'Updated By',
  `deleted_by` int DEFAULT NULL COMMENT 'Deleted By',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `shop_id` int NOT NULL COMMENT 'Shop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `image`, `price`, `description`, `content`, `num_of_sellers`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `shop_id`) VALUES
(1, 'Test', NULL, '', 1000000, '', '', 3, 1, 1, NULL, 1688626983, 1688636773, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name',
  `owner_id` int NOT NULL COMMENT 'Shop Owner',
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Phone Number',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Address',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Description',
  `created_by` int DEFAULT NULL COMMENT 'Created By',
  `updated_by` int DEFAULT NULL COMMENT 'Updated By',
  `created_at` int NOT NULL COMMENT 'Created At',
  `updated_at` int NOT NULL COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `owner_id`, `phone_number`, `address`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'VODY', 1, '', 'Hải Phòng', '<p>Bán các mặt hàng về thực phẩm chức năng</p>', 1, 1, 1688695482, 1688717258);

-- --------------------------------------------------------

--
-- Table structure for table `shop_meta`
--

CREATE TABLE `shop_meta` (
  `id` int NOT NULL,
  `shop_id` int NOT NULL COMMENT 'Shop',
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `value` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL COMMENT 'Created At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL COMMENT 'user id(auto increment)',
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'username',
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'auth key for generate logged in cookie',
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'crypt password',
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'reset password temp token',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'user email',
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '' COMMENT 'avatar url',
  `access_token` varchar(42) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'token',
  `status` smallint NOT NULL DEFAULT '10' COMMENT 'user status, (normal:10)',
  `created_at` int NOT NULL COMMENT 'created at',
  `updated_at` int NOT NULL COMMENT 'updated at',
  `deleted_at` int DEFAULT NULL COMMENT 'deleted at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `avatar`, `access_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'tuaVrERpwAR_x6RPXyCp1PX_vigSe-8q', '$2y$13$.TgMHPQ2IGgMBMBGIZkG7ONgd3ZsBa/SjMrFzYoEYQ2fKPjwc7m1m', NULL, 'test@gmail.com', '', '', 10, 1688552970, 1688553040, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_content`
--
ALTER TABLE `article_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_meta`
--
ALTER TABLE `article_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_meta_index_aid` (`aid`),
  ADD KEY `article_meta_index_key` (`key`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_index_shop_id` (`shop_id`);

--
-- Indexes for table `category_meta`
--
ALTER TABLE `category_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_meta_index_cid` (`cid`),
  ADD KEY `category_meta_index_key` (`key`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_index_aid` (`aid`);

--
-- Indexes for table `friendly_link`
--
ALTER TABLE `friendly_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `'idx-product-category_id` (`category_id`),
  ADD KEY `product_index_shop_id` (`shop_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_index_owner_id` (`owner_id`);

--
-- Indexes for table `shop_meta`
--
ALTER TABLE `shop_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'admin log id(auto increment)', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'admin user id(auto increment)', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'article id(auto increment)';

--
-- AUTO_INCREMENT for table `article_content`
--
ALTER TABLE `article_content`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'article content id(auto increment)';

--
-- AUTO_INCREMENT for table `article_meta`
--
ALTER TABLE `article_meta`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'article meta id(auto increment)';

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'category id(auto increment)', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_meta`
--
ALTER TABLE `category_meta`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'category meta id(auto increment)';

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'comment id(auto increment)';

--
-- AUTO_INCREMENT for table `friendly_link`
--
ALTER TABLE `friendly_link`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'friendly link id(auto increment)';

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'menu id(auto increment)', AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'options id(auto increment)', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_meta`
--
ALTER TABLE `shop_meta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'user id(auto increment)', AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
