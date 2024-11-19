-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2024 às 16:48
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devmusic`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'heavy metal'),
(2, 'Rock'),
(3, 'Hard Rock'),
(4, 'Alternativo'),
(5, 'blues');

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_music` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `musics`
--

CREATE TABLE `musics` (
  `id` int(11) NOT NULL,
  `music` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `artista` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `musics`
--

INSERT INTO `musics` (`id`, `music`, `title`, `capa`, `artista`, `categoria`, `id_user`) VALUES
(12, '634f92b5fce6254cdebfa45058ca0732.mp3', 'scar tissue', '979039ce0b17d7e3709fbf5bb2aadc61', 'Red Hot Chilli Peppers', 'Rock', 0),
(13, 'cbe62911b013b725c0aa66a410091f86.mp3', 'sweet child o&#039;mine', '59018c2edcb2be8a3f8b728d142d7019', 'guns n&#039; roses', 'Hard Rock', 0),
(14, 'a63b64313c1b310c701d85848b2b2d50.mp3', 'fear of the dark', '920826e77982b64185806e60b52a7526', 'iron maiden', 'heavy metal', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `usuario`, `password`, `token`, `avatar`, `created_at`) VALUES
(1, 'flavyson@gmail.com', 'flavyson', '$2y$10$5Z5Er83EyoDv8ZAudC7KW.Qm.hto1lGq78s2lGH6fOWma7RTNbM1y', 'c8384bb2a39024daa61d90cf468e6715', '3ee0c2e8e22932c1646d8032d6b06e82', '2024-11-17 23:50:23'),
(3, 'usuario@gmail.com', 'usuario', '$2y$10$p.lCAUS14u5gHNUSBg77/O2hnC1b4rhKPAnqkY1Q3vCzsUoPx8fjG', '313125103d95de31d8e5bfd05eff8127', 'default.png', '2024-11-18 00:00:12');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `musics`
--
ALTER TABLE `musics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
