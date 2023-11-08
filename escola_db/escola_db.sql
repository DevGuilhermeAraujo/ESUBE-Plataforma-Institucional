-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/11/2023 às 20:24
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola_db`
--
CREATE DATABASE IF NOT EXISTS `escola_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `escola_db`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `ra` int(9) DEFAULT NULL,
  `id` int(9) NOT NULL,
  `dt_MATRICULA` date NOT NULL,
  `id_turma` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`ra`, `id`, `dt_MATRICULA`, `id_turma`) VALUES
(1111115, 1, '2015-02-27', 1),
(1111116, 2, '2015-02-27', 1),
(1111117, 3, '2015-02-27', 1),
(1111118, 4, '2015-02-27', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(1) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `pontoAtribuido` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividades`
--

INSERT INTO `atividades` (`id`, `descricao`, `pontoAtribuido`) VALUES
(1, 'Prova Mensal', 8),
(2, 'Prova Bimestral', 7),
(3, 'Trabalho', 5),
(4, 'Participação', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunicacao`
--

CREATE TABLE `comunicacao` (
  `id` int(9) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descricao` longtext DEFAULT NULL,
  `id_funcionario` int(9) DEFAULT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_turma` int(3) DEFAULT NULL,
  `data_atribuicao` timestamp NOT NULL DEFAULT current_timestamp(),
  `validacao` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `id` int(9) NOT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `data_atribuida` timestamp NOT NULL DEFAULT current_timestamp(),
  `desc_frequencia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `ra` int(9) DEFAULT NULL,
  `id` int(9) NOT NULL,
  `dt_CONTRATO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`ra`, `id`, `dt_CONTRATO`) VALUES
(1111111, 1, '2015-02-27'),
(1111112, 2, '2015-02-27'),
(1111113, 3, '2015-02-27'),
(1111114, 4, '2015-02-27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias`
--

CREATE TABLE `materias` (
  `id` int(5) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quant_aulas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `materias`
--

INSERT INTO `materias` (`id`, `nome`, `quant_aulas`) VALUES
(1, 'Matemática', 40),
(2, 'Português', 40),
(3, 'Geografia', 40),
(4, 'História', 40),
(5, 'Biologia', 40),
(6, 'Filosofia', 40),
(7, 'Química', 40),
(8, 'Física', 40),
(9, 'Sociologia', 40),
(10, 'Artes', 40),
(11, 'Educação Física', 40);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(10) NOT NULL,
  `nota` decimal(10,0) DEFAULT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `id_atividade` int(1) DEFAULT NULL,
  `dataAtribuida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_materia`
--

CREATE TABLE `professor_materia` (
  `id` int(5) NOT NULL,
  `id_prof` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor_materia`
--

INSERT INTO `professor_materia` (`id`, `id_prof`, `id_materia`) VALUES
(1, 2, 1),
(2, 2, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id` int(5) NOT NULL,
  `id_prof` int(9) DEFAULT NULL,
  `id_turma` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor_turma`
--

INSERT INTO `professor_turma` (`id`, `id_prof`, `id_turma`) VALUES
(1, 2, 1),
(2, 2, 5),
(3, 2, 7),
(4, 2, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(1) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id`, `descricao`) VALUES
(1, 'Gerente'),
(2, 'Professor'),
(3, 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(3) NOT NULL,
  `desc_turma` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `desc_turma`) VALUES
(1, 'Turma A'),
(2, 'Turma B'),
(3, 'Turma C'),
(4, 'Turma D'),
(5, 'Turma E'),
(6, 'Turma F'),
(7, 'Turma G'),
(8, 'Turma H'),
(9, 'Turma I'),
(10, 'Turma J');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ra` int(9) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `genero` int(1) NOT NULL,
  `dt_NASC` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ra`, `nome`, `cpf`, `genero`, `dt_NASC`, `email`, `senha`, `dt_registro`, `tipo`) VALUES
(1111111, 'Administrador', '000.000.000-00', 1, '2002-02-27', 'admin@gmail.com', '$2y$10$DZY.OqhJWyYgelu8snEoZutt0/QFSTegiAzcK.I43AC5kCqb0zkS.', '2023-11-01 21:47:21', 1),
(1111112, 'Professor1', '000.000.000-00', 1, '2002-02-27', 'professor@gmail.com', '$2y$10$tjQ6bJzaQ3w0ry4drM3ueOGqUBSRWTWBlW0it7GIOGrgqfimBTcUy', '2023-11-01 21:47:21', 2),
(1111113, 'Professor2', '000.000.000-00', 1, '2002-02-27', 'professor@gmail.com', '$2y$10$ZpWSFrotpHH5D.3yTEqKsuIIAxC2f9iVGnJdh2hlUapRLcPz2pY5C', '2023-11-01 21:47:21', 2),
(1111114, 'Professor3', '000.000.000-00', 1, '2002-02-27', 'professor@gmail.com', '$2y$10$E1tmLsTldcL1tMlNg9Zp/.5K6F.RTvVwV58ALS0jxSjidhUm8OFDG', '2023-11-01 21:47:21', 2),
(1111115, 'Guilherme Araujo', '000.000.000-00', 1, '2002-02-27', 'aluno@gmail.com', '$2y$10$pR1a7VLNKBTirO2aHK6mO.ZBYfTR.UNZgLpoMWGFT5s6DHt6BO56O', '2023-11-01 21:47:21', 3),
(1111116, 'Matheus Arantes', '000.000.000-00', 1, '2002-02-27', 'aluno@gmail.com', '$2y$10$dBAyhTDu8CjWnjAV6qL2P.NFRns0rUysMhNca6uqTKtxQBsxZ6kpe', '2023-11-01 21:47:21', 3),
(1111117, 'Gabriel Garcia', '000.000.000-00', 1, '2002-02-27', 'aluno@gmail.com', '$2y$10$VSPFwiq8PmLCrVZBJFHplemyfvxrwNh89fLlR9kkZdfl73QOdjrn2', '2023-11-01 21:47:21', 3),
(1111118, 'Alexandre Borges', '000.000.000-00', 1, '2002-02-27', 'aluno@gmail.com', '$2y$10$wP3qzeEJaUV5RR/Ryu.vwuDwOeK5B13mk9CQ0cMqoc1Yb8GjNQASS', '2023-11-03 04:50:48', 3);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_alunos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_alunos` (
`ra` int(9)
,`nome` varchar(50)
,`idade` bigint(21)
,`cpf` varchar(14)
,`desc_turma` varchar(20)
,`id_turma` int(3)
,`id_aluno` int(9)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_professores`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_professores` (
`ra` int(9)
,`nome` varchar(50)
,`idade` bigint(21)
,`cpf` varchar(14)
,`id` int(9)
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_alunos`
--
DROP TABLE IF EXISTS `view_alunos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_alunos`  AS SELECT `u`.`ra` AS `ra`, `u`.`nome` AS `nome`, timestampdiff(YEAR,`u`.`dt_NASC`,curdate()) AS `idade`, `u`.`cpf` AS `cpf`, `t`.`desc_turma` AS `desc_turma`, `t`.`id` AS `id_turma`, `a`.`id` AS `id_aluno` FROM ((`usuarios` `u` join `alunos` `a` on(`u`.`ra` = `a`.`ra`)) join `turmas` `t` on(`t`.`id` = `a`.`id_turma`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_professores`
--
DROP TABLE IF EXISTS `view_professores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_professores`  AS SELECT `u`.`ra` AS `ra`, `u`.`nome` AS `nome`, timestampdiff(YEAR,`u`.`dt_NASC`,curdate()) AS `idade`, `u`.`cpf` AS `cpf`, `f`.`id` AS `id` FROM (`usuarios` `u` join `funcionarios` `f` on(`u`.`ra` = `f`.`ra`)) WHERE `u`.`tipo` = 2 ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ra` (`ra`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comunicacao`
--
ALTER TABLE `comunicacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ra` (`ra`);

--
-- Índices de tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_atividade` (`id_atividade`);

--
-- Índices de tabela `professor_materia`
--
ALTER TABLE `professor_materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Índices de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ra`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comunicacao`
--
ALTER TABLE `comunicacao`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor_materia`
--
ALTER TABLE `professor_materia`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ra` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111119;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`ra`) REFERENCES `usuarios` (`ra`),
  ADD CONSTRAINT `alunos_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`);

--
-- Restrições para tabelas `comunicacao`
--
ALTER TABLE `comunicacao`
  ADD CONSTRAINT `comunicacao_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id`);

--
-- Restrições para tabelas `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `frequencia_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `frequencia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`ra`) REFERENCES `usuarios` (`ra`);

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id`);

--
-- Restrições para tabelas `professor_materia`
--
ALTER TABLE `professor_materia`
  ADD CONSTRAINT `professor_materia_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `professor_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
