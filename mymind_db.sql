-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2026 at 04:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymind_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'oci', 'oci@gmail.com', '12355', '2026-04-25 13:19:39'),
(2, 'yosi', 'yosi@gmail.com', '29515bb9a5d5e558e2b3ba71e3b6e037', '2026-04-25 13:20:37'),
(3, 'aura', 'aura@gmail.com', '67890', '2026-04-25 13:21:55'),
(5, 'yoria', 'yoria@gmail.com', 'a8698009bce6d1b8c2128eddefc25aad', '2026-04-26 12:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `writings`
--

CREATE TABLE `writings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) DEFAULT 'Diary',
  `mood` varchar(50) DEFAULT 'Netral',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writings`
--

INSERT INTO `writings` (`id`, `user_id`, `title`, `content`, `category`, `mood`, `created_at`) VALUES
(1, 2, '', '', 'Diary', 'Netral', '2026-04-25 14:28:38'),
(5, 2, 'Lirik Lagu Highway 1009', '[Verse 1: Jake, Jungwon, Heeseung, NI-KI, *Sunghoon*]\r\nHamkke han sijagui clear blue sky\r\nUseum gadeukaetdeon cheot chulbal\r\nGidae dwi sumgyeodwotdeon\r\nUri buranhaetdeon dwinmoseupgwa\r\nTto bulhwaksilhan jeongdapdeul\r\nBut I don\'t care when I\'m with you\r\nIjen naman mitgo ttarawa\r\n*ijen naman bogo georeowa*\r\n\r\n[Pre-Chorus: Sunoo, Sunghoon, Jay]\r\nGeochilgiman haetdeon off-road tracks\r\nManyang dallyeotda haedo\r\nIt was okay, yeah\r\nHamkkehal days, ijen neowa na\r\n\r\n[Chorus: Heeseung, Jake]\r\nGive me your hands just a little bit more\r\nDeo kkwak anajwo nal\r\nHimdeulgo jichin naredo\r\nDasi seol su itge\r\nCan you stay with me a little bit more?\r\nDeo kkwak anajwo nal\r\nSarangeuro neol deryeoga\r\nHighway 1009, yeah\r\n[Verse 2: NI-KI, Jake, Jungwon, Jay, *Sunghoon*]\r\nI told you like a million times\r\nWith you, everything will be alright\r\nNeoreul kkwak anajulge\r\n\'Cause I\'ll be there, be your engine now, yeah\r\nJeo noeul neomeo dallyeoga\r\nKkeuteomneun doro wireul jina\r\nIjen naman mitgo ttarawa\r\n*ijen naman bogo georeowa*\r\n\r\n[Pre-Chorus: Heeseung, NI-KI, Jungwon]\r\nSeorol bichwojudeon golden hours\r\nJogeum apatdeon timeline\r\nBut I\'m on my way, yeah\r\nNeol derireo ga ijen neowa na\r\n\r\n[Chorus: Sunoo, Jay]\r\nGive me your hands just a little bit more\r\nDeo kkwak anajwo nal\r\nHimdeulgo jichin naredo\r\nDasi seol su itge\r\nCan you stay with me a little bit more?\r\nDeo kkwak anajwo nal\r\nSarangeuro neol deryeoga\r\nHighway 1009, yeah\r\n[Instrumental Bridge]\r\n\r\n[Chorus: Jake, Heeseung]\r\nGive me your hands just a little bit more\r\nDeo kkwak anajwo nal\r\nNeon nae yeope isseumyeon dwae\r\nEodideun deryeogalge\r\nCan you stay with me a little bit more?\r\nDeo kkwak anajwo nal\r\nModeun geokjeong da throw away\r\nYeongwonhi saranghae neol, yeah\r\n\r\n[Post-Chorus: Heeseung, Sunoo, Sunghoon]\r\nWoah, oh-oh-oh-oh, oh-oh-oh-oh\r\nHighway with you, we ride\r\nWoah, oh-oh-oh-oh, oh-oh-oh-oh\r\nLast forever\r\n\r\n[Outro: Heeseung]\r\nNarang yeongwonhi hamkke haejwo', 'Lirik Lagu', 'Bahagia', '2026-04-25 14:47:10'),
(8, 2, 'Resep Buat Kaya', 'Jangan malas! jangan malas! ayo belajar! yeyy', 'Resep', 'Bahagia', '2026-04-25 14:51:03'),
(9, 2, 'lala', 'yeyy jadiiii uwuuu', 'Diary', 'Bahagia', '2026-04-25 14:52:58'),
(10, 2, 'Lirik Lagu Fatal Trouble ', 'Intro: Heeseung]\r\nOh\r\nYeah, yeah\r\n\r\n[Verse 1: Jungwon, Sunoo]\r\nCan\'t believe, nunapui neon (nunapui neon)\r\nModeun ge geudaeronde\r\nNan moreuneun misoreul jitgo isseo (Yeah, yeah)\r\nSimyeon gateun nundongja (nundongja)\r\nGeu neomeo neoreul chajabwadonatseoreo, who are you?\r\nNaega saranghaneun neon nugunji\r\n\r\n[Pre-Chorus: NI-KI, Sunghoon]\r\nHollan sogui mollak eojireowo, baby\r\nNan neol aneun geolkka?\r\nMwonga byeonhan geolkka? jebal daedapae bwa\r\nNaega teullin geolkka?\r\n\r\n[Chorus: Heeseung, Jay]\r\nFatal trouble\r\nIt\'s getting blurry\r\nNeoui gieogi\r\nMuneojyeonaeryeo\r\nFatal trouble\r\nNeol hyanghan maeumdo\r\nOraen mideumdo\r\nDa coming undone\r\n [Post-Chorus: Jake, Heeseung]\r\nI don\'t know you (I don\'t know you)\r\nNan muneojyeoga (nan muneojyeoga)\r\nHemego isseo (hemaego isseo)\r\nNeol jikige haejwo\r\nFatal trouble\r\nGateun memory\r\nTto dareun story\r\nNal heundeureonwa\r\nFatal trouble\r\n\r\n[Verse 2: NI-KI, Sunoo]\r\nAh, gyeou jikyeonaen\r\nNeol ilkin sileunde burani deuriwo\r\nJeomjeom yeowin dal gachi\r\nHeuryeojyeo hwaksini I don\'t know what to do\r\n\r\n[Pre-Chorus: Jungwon, Sunghoon]\r\nHollan ttawin don\'t mind, jipjunghaneun gamgak\r\nBunmyeong neoneun hana\r\nSo now, dwiro hae da\r\nNae simjangi ttwineun daero georeoga nan\r\n\r\n[Chorus: Jay, Jake]\r\nFatal trouble (Oh)\r\nIt\'s getting blurry (Oh)\r\nNeoui gieogi\r\nMuneojyeonaeryeo (muneojyeonaeryeo)\r\nFatal trouble\r\nNeol hyanghan maeumdo (maeumdo)\r\nOraen mideumdo (Ooh)\r\nDa coming undone\r\n [Post-Chorus: Jake, Heeseung]\r\nI don\'t know you (I don\'t know you)\r\nNan muneojyeoga (nan muneojyeoga)\r\nHemego isseo (hemaego isseo)\r\nNeol jikige haejwo\r\nFatal trouble\r\nGateun memory\r\nTto dareun story\r\nNal heundeureonwa\r\nFatal trouble\r\n\r\n[Verse 2: NI-KI, Sunoo]\r\nAh, gyeou jikyeonaen\r\nNeol ilkin sileunde burani deuriwo\r\nJeomjeom yeowin dal gachi\r\nHeuryeojyeo hwaksini I don\'t know what to do\r\n\r\n[Pre-Chorus: Jungwon, Sunghoon]\r\nHollan ttawin don\'t mind, jipjunghaneun gamgak\r\nBunmyeong neoneun hana\r\nSo now, dwiro hae da\r\nNae simjangi ttwineun daero georeoga nan\r\n\r\n[Chorus: Jay, Jake]\r\nFatal trouble (Oh)\r\nIt\'s getting blurry (Oh)\r\nNeoui gieogi\r\nMuneojyeonaeryeo (muneojyeonaeryeo)\r\nFatal trouble\r\nNeol hyanghan maeumdo (maeumdo)\r\nOraen mideumdo (Ooh)\r\nDa coming undone\r\n[Post-Chorus: NI-KI, Heeseung]\r\nI know, I know you (I know, I know you)\r\nJa malhae naege (malhae naege)\r\nAnirago (anirago)\r\nByeonhan geon eopdago\r\nFatal trouble\r\nHanaui yeonghon\r\nMideo nae dabeul\r\nTeulliji ana\r\nFatal trouble\r\n..', 'Lirik Lagu', 'Marah', '2026-04-26 07:11:57'),
(11, 5, 'MASAK MASAK', 'MASAK AYAM GORENG SAMA AYAM', 'Resep', 'Senang', '2026-04-26 13:13:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `writings`
--
ALTER TABLE `writings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `writings`
--
ALTER TABLE `writings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `writings`
--
ALTER TABLE `writings`
  ADD CONSTRAINT `writings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
