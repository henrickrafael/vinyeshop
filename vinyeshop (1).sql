-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jun-2022 às 00:53
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vinyeshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artistas`
--

CREATE TABLE `artistas` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `artistas`
--

INSERT INTO `artistas` (`id`, `nome`, `ativo`) VALUES
(1, 'Nirvana', 'S'),
(2, 'Metallica', 'S'),
(3, 'Silverchair', 'S'),
(4, 'Pearl Jam', 'S'),
(5, 'Stone Sour', 'S'),
(6, 'Tim Maia', 'S'),
(7, 'Calos Maia', 'S'),
(9, 'Supercombo', 'S'),
(10, 'Tim Maia', 'S'),
(11, 'Linkin Park', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `discos`
--

CREATE TABLE `discos` (
  `id` int(11) NOT NULL,
  `foto` varchar(55) DEFAULT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_artista` int(11) DEFAULT NULL,
  `lancamento` date DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `discos`
--

INSERT INTO `discos` (`id`, `foto`, `nome`, `descricao`, `id_artista`, `lancamento`, `id_genero`, `valor`, `ativo`) VALUES
(1, '../images/in-utero.jpg', 'In utero', 'Terceiro e último album da banda de grunge Nirvana', 1, '1993-08-13', 1, '49.90', 'S'),
(3, '../images/in-utero.jp', 'Kill Em All', 'Puta album daora', 2, '1983-04-17', 2, '54.80', 'S'),
(4, '../images/nevermind.jpg', 'Nevermind', 'Segundo albúm do Nirvana e até hoje o maior sucesso da banda e responsável por imortalizar o gênero Grunge', 1, '1991-08-24', 1, '19.90', 'N'),
(15, '../images/Come Whatever.png', 'Come Whatever', 'Segundo álbum de estúdio da banda Stone Sour', 5, '2022-06-01', 2, '40.00', 'S'),
(16, '../images/Frog .png', 'Frog ', 'Album', 5, '2022-06-06', 2, '80.00', 'S'),
(17, '../images/Iron Maiden.png', 'Iron Maiden', 'aaaaaa', 2, '2022-06-29', 2, '100.00', 'S'),
(18, '../images/Iron ferro.png', 'Iron ferro', 'T', 2, '2022-06-29', 2, '100.00', 'S'),
(19, '../images/Iron Maiden.png', 'Iron Maiden', 'Aaaaaaaaaaa', 2, '1900-06-29', 2, '100.00', 'S'),
(20, '../images/Iron Maiden.png', 'Iron Maiden', 'Aaaaaaaaaaa', 2, '1900-06-29', 2, '100.00', 'S'),
(22, '../images/Supercombo22.png', 'Supercombo', 'Album 2021', 9, '2022-06-01', 4, '10.00', 'S'),
(23, '../images/Ever End.png', 'Ever End', 'Ultimo', 11, '2022-05-29', 5, '20.00', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `id_discos` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `id_discos`, `quantidade`) VALUES
(1, 1, 5),
(2, 3, 0),
(3, 4, 3),
(4, 15, 19),
(5, 16, 30),
(6, 17, 10),
(7, 22, 7),
(8, 23, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id`, `nome`, `ativo`) VALUES
(1, 'Grunge', 'S'),
(2, 'Trash Metal', 'S'),
(3, 'Eletronica', 'S'),
(4, 'Indie', 'S'),
(5, 'Pop', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `nome` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(70) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `nasc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `nome`, `email`, `senha`, `foto`, `tipo`, `sexo`, `nasc`) VALUES
(1, 0, 'marcel', 'usr@usr.com', '123', '05-06-2022-6-06-2616', NULL, 'M', '1997-09-15'),
(2, 1111111111, 'marcel2', 'usr@usr.com.br', '321', 'teste/05-06-2022-6-0', NULL, 'M', '1997-09-15'),
(3, 2147483647, 'mar', 'usr2@usr.com', '202cb962ac59075b964b07152d234b70', 'teste/05-06-2022-6-0', NULL, 'M', '8988-07-18'),
(4, 0, '', NULL, NULL, '4.png', NULL, NULL, NULL),
(5, 2147483647, 'teste', 'usr34@usr.com', 'd41d8cd98f00b204e9800998ecf8427e', '5.png', NULL, 'M', '1997-09-15'),
(6, 2147483647, 'qwdasda', 'usr@usr.com', 'd41d8cd98f00b204e9800998ecf8427e', '6.png', NULL, 'M', '0000-00-00'),
(7, 2147483647, 'sdfasdsa', 'usr@usr.com', '202cb962ac59075b964b07152d234b70', '7.png', NULL, 'M', '2022-06-10'),
(9, 2147483647, 'Marcel Eshi', 'marceleshima@gmail.com', '202cb962ac59075b964b07152d234b70', '../images/9.png', 'A', 'M', '1997-09-15'),
(10, 2147483647, '1', '1@1.com', '202cb962ac59075b964b07152d234b70', '10.png', NULL, 'M', '2022-06-19'),
(11, 2147483647, '2', '2@2.com', '202cb962ac59075b964b07152d234b70', '../images/11.png', NULL, 'M', '2022-07-01'),
(12, 2147483647, 'Marcel Eshi', 'teste20@gmail.com', '202cb962ac59075b964b07152d234b70', '../images/12.png', NULL, 'M', '1997-09-15'),
(13, 984260951, 'Lucas', 'lucas@hotmail.com', '202cb962ac59075b964b07152d234b70', '../images/13.png', 'U', 'M', '2022-06-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `id_discos` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `valor_total` decimal(5,2) DEFAULT NULL,
  `data_compra` date DEFAULT NULL,
  `tipo_pagamento` char(1) DEFAULT NULL,
  `qtd` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `id_discos`, `id_usuario`, `valor_total`, `data_compra`, `tipo_pagamento`, `qtd`) VALUES
(17, 1, 12, '99.80', '2022-06-13', 'C', 2),
(18, 15, 12, '40.00', '2022-06-13', 'B', 1),
(19, 22, 12, '30.00', '2022-06-13', 'C', 3),
(20, 3, 13, '109.60', '2022-06-13', 'C', 2),
(21, 23, 9, '180.00', '2022-06-13', 'B', 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `discos`
--
ALTER TABLE `discos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discos` (`id_discos`);

--
-- Índices para tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discos` (`id_discos`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `discos`
--
ALTER TABLE `discos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `discos`
--
ALTER TABLE `discos`
  ADD CONSTRAINT `discos_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id`),
  ADD CONSTRAINT `discos_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`);

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`id_discos`) REFERENCES `discos` (`id`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_discos`) REFERENCES `discos` (`id`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
