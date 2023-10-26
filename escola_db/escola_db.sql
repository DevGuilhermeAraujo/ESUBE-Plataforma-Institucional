-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Out-2023 às 21:41
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `ra` int(9) DEFAULT NULL,
  `id` int(9) NOT NULL,
  `dt_MATRICULA` date NOT NULL,
  `id_turma` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`ra`, `id`, `dt_MATRICULA`, `id_turma`) VALUES
(1111112, 1, '2023-10-26', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `id` int(20) NOT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `data_atribuida` date NOT NULL,
  `desc_frequencia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `ra` int(9) DEFAULT NULL,
  `id` int(9) NOT NULL,
  `dt_CONTRATO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`ra`, `id`, `dt_CONTRATO`) VALUES
(1111111, 1, '2015-02-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `id` int(5) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quant_aulas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materias`
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
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(20) NOT NULL,
  `id_aluno` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL,
  `nota` decimal(3,2) NOT NULL,
  `data_atribuida` date NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `professores`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `professores` (
`ra` int(11)
,`nome` varchar(50)
,`id` int(9)
,`dt_CONTRATO` date
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_materia`
--

CREATE TABLE `professor_materia` (
  `id` int(5) NOT NULL,
  `id_prof` int(9) DEFAULT NULL,
  `id_materia` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id` int(5) NOT NULL,
  `id_prof` int(9) DEFAULT NULL,
  `id_turma` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(1) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `descricao`) VALUES
(1, 'Gerente'),
(2, 'Professor'),
(3, 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(3) NOT NULL,
  `desc_turma` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
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
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ra` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `genero` int(1) NOT NULL,
  `dt_NASC` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ra`, `nome`, `cpf`, `genero`, `dt_NASC`, `email`, `senha`, `dt_registro`, `tipo`) VALUES
(1111111, 'Administrador', '000.000.000-00', 1, '2002-02-27', 'admin@gmail.com', 'admin', '2023-10-26 16:23:30', 1),
(1111112, 'Guilherme Araujo', '144.684.996-13', 1, '2002-02-27', 'guiboas298@gmail.com', '123456789', '2023-10-26 18:43:36', 3);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_alunos_turmas`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_alunos_turmas` (
`ra` int(11)
,`nome` varchar(50)
,`desc_turma` varchar(20)
,`id` int(3)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `professores`
--
DROP TABLE IF EXISTS `professores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `professores`  AS SELECT `u`.`ra` AS `ra`, `u`.`nome` AS `nome`, `f`.`id` AS `id`, `f`.`dt_CONTRATO` AS `dt_CONTRATO` FROM (`usuarios` `u` join `funcionarios` `f`) WHERE `u`.`ra` = `f`.`ra``ra`  ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view_alunos_turmas`
--
DROP TABLE IF EXISTS `view_alunos_turmas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `view_alunos_turmas`  AS SELECT `u`.`ra` AS `ra`, `u`.`nome` AS `nome`, `t`.`desc_turma` AS `desc_turma`, `t`.`id` AS `id` FROM ((`usuarios` `u` join `alunos` `a` on(`u`.`ra` = `a`.`ra`)) join `turmas` `t` on(`a`.`id_turma` = `t`.`id`)) WHERE `u`.`tipo` = 33  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ra` (`ra`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices para tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ra` (`ra`);

--
-- Índices para tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Índices para tabela `professor_materia`
--
ALTER TABLE `professor_materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Índices para tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ra`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `ra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111115;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`ra`) REFERENCES `usuarios` (`ra`),
  ADD CONSTRAINT `alunos_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`);

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `frequencia_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`ra`),
  ADD CONSTRAINT `frequencia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`ra`) REFERENCES `usuarios` (`ra`);

--
-- Limitadores para a tabela `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`ra`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Limitadores para a tabela `professor_materia`
--
ALTER TABLE `professor_materia`
  ADD CONSTRAINT `professor_materia_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`ra`),
  ADD CONSTRAINT `professor_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`);

--
-- Limitadores para a tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `funcionarios` (`ra`),
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;