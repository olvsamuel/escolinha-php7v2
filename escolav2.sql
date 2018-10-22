-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Out-2018 às 23:50
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escolav2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` bigint(20) NOT NULL,
  `n1` decimal(10,2) DEFAULT NULL,
  `n2` decimal(10,2) DEFAULT NULL,
  `media` decimal(10,2) DEFAULT NULL,
  `faltas` int(11) DEFAULT NULL,
  `statusaluno` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idpessoa` bigint(20) DEFAULT NULL,
  `idcurso` bigint(20) DEFAULT NULL,
  `idturma` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `n1`, `n2`, `media`, `faltas`, `statusaluno`, `idpessoa`, `idcurso`, `idturma`) VALUES
(1, '4.00', '3.00', '3.50', 9, 'rp', 1, 1, 1),
(2, '5.00', '6.00', '5.50', 4, 'rp', 3, 2, 1),
(4, '4.00', '2.00', '3.00', 3, 'rp', 3, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `idbairro` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `idestado` bigint(20) DEFAULT NULL,
  `idcidade` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`idbairro`, `nome`, `idestado`, `idcidade`) VALUES
(1, 'Partenon', 1, 1),
(2, 'Sumaré', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `idcidade` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `idestado` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`idcidade`, `nome`, `idestado`) VALUES
(1, 'Porto Alegre', 1),
(2, 'Alvorada', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `idcurso` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `ch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idcurso`, `nome`, `preco`, `ch`) VALUES
(1, 'Ciencia da Computacao', '20000.00', 4000),
(2, 'Engenharia da Computacao', '23000.00', 4200);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `idestado` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`idestado`, `nome`, `sigla`) VALUES
(1, 'Rio Grande do Sul', 'RS'),
(2, 'Rio Grande do Sul', 'RS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `idmateria` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `materia`
--

INSERT INTO `materia` (`idmateria`, `nome`, `ch`) VALUES
(1, 'Engenharia de Software', 60),
(2, 'Redes', 60);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` bigint(20) NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datanasc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` char(14) COLLATE utf8_unicode_ci NOT NULL,
  `idestado` bigint(20) DEFAULT NULL,
  `idcidade` bigint(20) DEFAULT NULL,
  `idbairro` bigint(20) DEFAULT NULL,
  `idrua` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `nome`, `sexo`, `datanasc`, `cpf`, `idestado`, `idcidade`, `idbairro`, `idrua`) VALUES
(1, 'Joao Souza', 'Masculino', '25/05/1995', '147.852.963-86', 1, 1, 1, 1),
(2, 'Marcio Malandragem', 'Masculino', '20/02/1976', '487.965.852-69', 1, 1, 1, 1),
(3, 'Samuel Martins', 'Masculino', '22/05/1995', '144.867.922-44', 1, 2, 2, 2),
(4, 'Maluco Beleza', 'masculino', '26/04/1978', '124.365.475-58', 1, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idprofessor` bigint(20) NOT NULL,
  `idpessoa` bigint(20) DEFAULT NULL,
  `idcurso` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idprofessor`, `idpessoa`, `idcurso`) VALUES
(1, 2, 1),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rua`
--

CREATE TABLE `rua` (
  `idrua` bigint(20) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idestado` bigint(20) DEFAULT NULL,
  `idcidade` bigint(20) DEFAULT NULL,
  `idbairro` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `rua`
--

INSERT INTO `rua` (`idrua`, `nome`, `cep`, `idestado`, `idcidade`, `idbairro`) VALUES
(1, 'Av Ipiranga', '85397', 1, 1, 1),
(2, 'Av Getulio Vargas', '-566', 1, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idturma` bigint(20) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `idprofessor` bigint(20) DEFAULT NULL,
  `idmateria` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idturma`, `nome`, `idprofessor`, `idmateria`) VALUES
(1, 'Engenharia de Software', 1, 1),
(2, 'Redes', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` bigint(20) NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `idaluno` bigint(20) DEFAULT NULL,
  `idprofessor` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `tipo`, `idaluno`, `idprofessor`) VALUES
(1, 'joao', '1f591a4c440e29f36bc86358a832dcd1', 'aluno', 1, NULL),
(2, 'marcio', '1f591a4c440e29f36bc86358a832dcd1', 'professor', NULL, 1),
(3, 'samuel', '1f591a4c440e29f36bc86358a832dcd1', 'aluno', 2, NULL),
(4, 'maluco', '1f591a4c440e29f36bc86358a832dcd1', 'professor', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`),
  ADD KEY `idturma` (`idturma`),
  ADD KEY `idcurso` (`idcurso`),
  ADD KEY `idpessoa` (`idpessoa`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`idbairro`),
  ADD KEY `idestado` (`idestado`),
  ADD KEY `idcidade` (`idcidade`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idcidade`),
  ADD KEY `idestado` (`idestado`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`),
  ADD KEY `idestado` (`idestado`),
  ADD KEY `idcidade` (`idcidade`),
  ADD KEY `idbairro` (`idbairro`),
  ADD KEY `idrua` (`idrua`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idprofessor`),
  ADD KEY `idpessoa` (`idpessoa`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Indexes for table `rua`
--
ALTER TABLE `rua`
  ADD PRIMARY KEY (`idrua`),
  ADD KEY `idestado` (`idestado`),
  ADD KEY `idcidade` (`idcidade`),
  ADD KEY `idbairro` (`idbairro`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idturma`),
  ADD KEY `idprofessor` (`idprofessor`),
  ADD KEY `idmateria` (`idmateria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idaluno` (`idaluno`),
  ADD KEY `idprofessor` (`idprofessor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `idbairro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `idcidade` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `idprofessor` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rua`
--
ALTER TABLE `rua`
  MODIFY `idrua` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `idturma` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`);

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`),
  ADD CONSTRAINT `bairro_ibfk_2` FOREIGN KEY (`idcidade`) REFERENCES `cidade` (`idcidade`);

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`);

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`),
  ADD CONSTRAINT `pessoa_ibfk_2` FOREIGN KEY (`idcidade`) REFERENCES `cidade` (`idcidade`),
  ADD CONSTRAINT `pessoa_ibfk_3` FOREIGN KEY (`idbairro`) REFERENCES `bairro` (`idbairro`),
  ADD CONSTRAINT `pessoa_ibfk_4` FOREIGN KEY (`idrua`) REFERENCES `rua` (`idrua`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`);

--
-- Limitadores para a tabela `rua`
--
ALTER TABLE `rua`
  ADD CONSTRAINT `rua_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`),
  ADD CONSTRAINT `rua_ibfk_2` FOREIGN KEY (`idcidade`) REFERENCES `cidade` (`idcidade`),
  ADD CONSTRAINT `rua_ibfk_3` FOREIGN KEY (`idbairro`) REFERENCES `bairro` (`idbairro`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`idprofessor`),
  ADD CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`idmateria`) REFERENCES `materia` (`idmateria`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`idprofessor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
