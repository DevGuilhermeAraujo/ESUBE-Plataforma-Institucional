-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/10/2023 às 17:55
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
  `turma` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `id` int(20) NOT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `data_atribuida` date NOT NULL,
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
(1111111, 1, '2015-02-27');

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
  `id` int(20) NOT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `nota` decimal(3,2) NOT NULL,
  `data_atribuida` date NOT NULL,
  `tipo` int(1) NOT NULL
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id` int(5) NOT NULL,
  `id_prof` int(9) DEFAULT NULL,
  `id_turma` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `senha` varchar(30) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ra`, `nome`, `cpf`, `genero`, `dt_NASC`, `email`, `senha`, `dt_registro`, `tipo`) VALUES
(1111111, 'Administrador', '000.000.000-00', 1, '2002-02-27', 'admin@gmail.com', 'admin', '2023-10-31 16:53:47', 1);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_alunos`  AS SELECT `u`.`ra` AS `ra`, `u`.`nome` AS `nome`, timestampdiff(YEAR,`u`.`dt_NASC`,curdate()) AS `idade`, `u`.`cpf` AS `cpf`, `t`.`desc_turma` AS `desc_turma`, `t`.`id` AS `id_turma`, `a`.`id` AS `id_aluno` FROM ((`usuarios` `u` join `alunos` `a` on(`u`.`ra` = `a`.`ra`)) join `turmas` `t` on(`t`.`id` = `a`.`turma`)) ;

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
  ADD KEY `turma` (`turma`);

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
  ADD KEY `id_materia` (`id_materia`);

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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor_materia`
--
ALTER TABLE `professor_materia`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ra` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111112;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`ra`) REFERENCES `usuarios` (`ra`),
  ADD CONSTRAINT `alunos_ibfk_2` FOREIGN KEY (`turma`) REFERENCES `turmas` (`id`);

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
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `professor_materia`
--
ALTER TABLE `professor_materia`
  ADD CONSTRAINT `professor_materia_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`ra`),
  ADD CONSTRAINT `professor_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`ra`),
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
