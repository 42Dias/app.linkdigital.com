-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Ago-2020 às 19:24
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
(9, 'Tudo sobre Destino', 'bookmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Cartão de vacinas', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
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
(24, 'Visto no Canadá', 'reader-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Comprovando a renda', 'wallet-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Como abrir conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Transporte no Canadá', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'O que fazer em Toronto', 'map-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'É hora de compras Outlets', 'cart-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Informações importantes', 'warning-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Compra de passagem áerea', 'cart-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'OHSC Seguro de viagem', 'shield-checkmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Cartão de passageiro', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Como abrir conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, '+18 Card', 'alert-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Tax File Number', 'car-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Transporte na Austrália', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Dicas e Informações importantes', 'warning-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Busca de Jobs', 'newspaper-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Cartão de vacinas', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Cartão de passageiro', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Como abrir conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, '+18 Card', 'alert-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Tax File Number', 'car-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Transporte na Austrália', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Dicas e Informações importantes', 'warning-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Busca de Jobs', 'newspaper-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Compra de passagem áerea', 'cart-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Seguro de viagem', 'shield-checkmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Cartão de vacinas', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Como abrir conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, '+18 Card', 'alert-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'IRD', 'folder-open-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Transporte na Austrália', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Dicas e Informações importantes', 'warning-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Busca de Jobs', 'newspaper-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Aplicação do visto', 'airplane-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Comprovação de renda', 'wallet-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Compra de passagem áerea', 'cart-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Seguro de viagem', 'shield-checkmark-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Cartão de vacinas', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Chegada no aeroporto', 'briefcase-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Acomodações', 'bed-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Primeiro dia de aula', 'trail-sign-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Empadronamiento', 'document-text-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'TIE', 'airplane-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Conta bancária', 'documents-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Transporte em Madrid', 'bus-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Busca de Jobs', 'newspaper-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Acompanhar sua viagem', 'golf-outline', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
