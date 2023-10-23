-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/10/2023 às 09:43
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
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `cod` int(10) NOT NULL,
  `materia` int(5) NOT NULL,
  `idProfessor` int(10) NOT NULL,
  `nomeSala` varchar(15) DEFAULT NULL,
  `assunto` varchar(25) DEFAULT NULL,
  `data_hora` date DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `cod` int(5) NOT NULL,
  `nomeCurso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(10) NOT NULL,
  `tipo` int(2) NOT NULL,
  `salario` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `tipo`, `salario`) VALUES
(1111111, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias`
--

CREATE TABLE `materias` (
  `cod` int(5) NOT NULL,
  `codCurso` int(5) NOT NULL,
  `nomeMateria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `cod` int(10) NOT NULL,
  `raAluno` int(10) NOT NULL,
  `codCurso` int(5) NOT NULL,
  `mensalidade` decimal(5,2) DEFAULT NULL,
  `dataMAtricula` date DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `matricula` int(10) NOT NULL,
  `materia` int(5) DEFAULT NULL,
  `nota` int(3) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos`
--

CREATE TABLE `tipos` (
  `cod` int(2) NOT NULL,
  `nomeTipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos`
--

INSERT INTO `tipos` (`cod`, `nomeTipo`) VALUES
(1, 'Gerente'),
(2, 'Professor'),
(3, 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `aula` int(10) NOT NULL,
  `aluno` int(10) NOT NULL,
  `presenca` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `sexo` int(1) NOT NULL,
  `dataNasc` date DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `CPF`, `sexo`, `dataNasc`, `email`, `senha`) VALUES
(1111111, 'Administrador', NULL, 0, NULL, NULL, 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `materia` (`materia`),
  ADD KEY `idProfessor` (`idProfessor`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD KEY `id` (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- Índices de tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `codCurso` (`codCurso`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `raAluno` (`raAluno`),
  ADD KEY `codCurso` (`codCurso`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD KEY `matricula` (`matricula`),
  ADD KEY `materia` (`materia`);

--
-- Índices de tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD KEY `aula` (`aula`),
  ADD KEY `aluno` (`aluno`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `cod` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cod` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `cod` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `cod` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111112;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`materia`) REFERENCES `materias` (`cod`),
  ADD CONSTRAINT `aulas_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `funcionarios` (`id`);

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `funcionarios_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipos` (`cod`);

--
-- Restrições para tabelas `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`codCurso`) REFERENCES `cursos` (`cod`);

--
-- Restrições para tabelas `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`raAluno`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`codCurso`) REFERENCES `cursos` (`cod`);

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `matriculas` (`cod`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`materia`) REFERENCES `materias` (`cod`);

--
-- Restrições para tabelas `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`aula`) REFERENCES `aulas` (`cod`),
  ADD CONSTRAINT `turmas_ibfk_2` FOREIGN KEY (`aluno`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
