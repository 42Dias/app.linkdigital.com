-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Ago-2020 às 17:32
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitalintercambios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assuntos`
--

CREATE TABLE `assuntos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `featured` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `assuntos`
--

INSERT INTO `assuntos` (`id`, `titulo`, `icon`, `featured`, `created`, `updated`) VALUES
(1, 'Vídeos mais importantes', 'videocam-outline', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Próximos eventos', 'calendar-outline', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Perguntas mais frequentes', 'chatbubble-outline', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Baixar o manual completo', 'cloud-download-outline', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Emissão do passaporte', 'reader-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Renovação do passaporte', 'airplane-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Compra de passagem áerea', 'cart-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Seguro saúde privado', 'shield-checkmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Cartão de vacinas', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Tudo sobre Destino', 'bookmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Comprovando a renda', 'wallet-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Carterinha de estudante', 'journal-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Como abrir conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Antigo GNBI IRP', 'folder-open-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Como fazer o PPS Number', 'git-compare-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Fazendo o Walking Tour', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Dicas e serviços úteis', 'alert-circle-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Busca de Jobs', 'newspaper-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Fique atento', 'warning-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Visto no Canadá', 'reader-outline', 0, '2020-08-05 11:08:27', '2020-08-05 11:08:27'),
(25, 'Chegada no aeroporto', 'briefcase-outline', 0, '2020-08-05 11:15:29', '2020-08-05 11:15:29'),
(26, 'Comprovando a renda', 'wallet-outline', 0, '2020-08-05 11:17:18', '2020-08-05 11:17:18'),
(27, 'Primeiro dia de aula', 'trail-sign-outline', 0, '2020-08-05 11:18:30', '2020-08-05 11:18:30'),
(28, 'Como abrir conta bancária', 'documents-outline', 0, '2020-08-05 11:19:53', '2020-08-05 11:19:53'),
(29, 'Transporte no Canadá', 'bus-outline', 0, '2020-08-05 11:22:01', '2020-08-05 11:22:01'),
(30, 'Acomodações', 'bed-outline', 0, '2020-08-05 11:26:39', '2020-08-05 11:26:39'),
(31, 'O que fazer em Toronto', 'map-outline', 0, '2020-08-05 11:26:39', '2020-08-05 11:26:39'),
(32, 'É hora de compras Outlets', 'cart-outline', 0, '2020-08-05 11:47:27', '2020-08-05 11:47:27'),
(33, 'Informações importantes', 'warning-outline', 0, '2020-08-05 11:49:43', '2020-08-05 11:49:43'),
(34, 'OHSC Seguro de viagem', 'shield-checkmark-outline', 0, '2020-08-05 17:51:42', '2020-08-05 17:51:42'),
(35, 'Cartão de passageiro', 'document-text-outline', 0, '2020-08-05 18:12:52', '2020-08-05 18:12:52'),
(36, '+18 Card', 'alert-outline', 0, '2020-08-05 18:12:52', '2020-08-05 18:12:52'),
(37, 'Tax File Number', 'car-outline', 0, '2020-08-05 18:12:52', '2020-08-05 18:12:52'),
(38, 'Transporte na Austrália', 'bus-outline', 0, '2020-08-05 11:22:01', '2020-08-05 11:22:01'),
(39, 'Dicas e Informações importantes', 'warning-outline', 0, '2020-08-05 11:49:43', '2020-08-05 11:49:43'),
(40, 'IRD', 'folder-open-outline', 0, '2020-08-07 10:55:42', '2020-08-07 10:55:42'),
(41, 'Transporte na Nova Zelândia', 'bus-outline', 0, '2020-08-05 11:22:01', '2020-08-05 11:22:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assuntos`
--
ALTER TABLE `assuntos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assuntos`
--
ALTER TABLE `assuntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
