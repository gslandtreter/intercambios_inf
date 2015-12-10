-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2015 at 08:54 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intercambios_inf`
--

-- --------------------------------------------------------

--
-- Table structure for table `afastamentos`
--

CREATE TABLE IF NOT EXISTS `afastamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL,
  `tipo` varchar(256) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `programa` varchar(256) DEFAULT NULL,
  `universidade` varchar(256) DEFAULT NULL,
  `pais` varchar(256) DEFAULT NULL,
  `observacoes` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `afastamentos`
--

INSERT INTO `afastamentos` (`id`, `id_aluno`, `tipo`, `data_inicio`, `data_fim`, `programa`, `universidade`, `pais`, `observacoes`) VALUES
(1, 103023, 'Realização de Estudos', '2013-06-12', '2017-03-20', 'Convênio INF', 'INP Grenoble', 'França', 'Tudo OK');

-- --------------------------------------------------------

--
-- Table structure for table `alunos`
--

CREATE TABLE IF NOT EXISTS `alunos` (
  `id_ufrgs` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `curso` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_ufrgs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228993 ;

--
-- Dumping data for table `alunos`
--

INSERT INTO `alunos` (`id_ufrgs`, `nome`, `curso`) VALUES
(118551, 'Eduardo Studzinski Estima de Castro', NULL),
(118576, 'EMANUEL MULLER RAMOS', NULL),
(118841, 'Gisele Pinheiro de Souza', 'CIC'),
(116420, 'FABIO KROEFF CARDOSO', NULL),
(128863, 'Paulo Schreiner', NULL),
(129925, 'Bruno Luis de Moura Donassolo', NULL),
(130805, 'Diego Midon Pereira', NULL),
(119624, 'OLIVER DALL BELLO PESSUTTO', NULL),
(128800, 'Felipe Mobus', NULL),
(115282, 'Gustavo Mello Machado', NULL),
(130184, 'JOSÉ IRIGON DE IRIGON', NULL),
(106624, 'ALEXANDRE COSTER', NULL),
(130766, 'JOANA MATOS FONSECA DA TRINDADE', NULL),
(130500, 'LEONARDO RECH DALPIAZ', NULL),
(129315, 'Luiz Hermes Svoboda Junior', NULL),
(129420, 'Victor Frederico Beust da Silva', NULL),
(134657, 'Carlos Eduardo Ramisch', NULL),
(134722, 'ELIAS RICKEN DE MEDEIROS', NULL),
(130548, 'Tiago Roberto Conceição da Silva', NULL),
(134721, 'CAESAR RALF FRANZ HOPPEN', NULL),
(141919, 'CAETANO SAUER', NULL),
(155347, 'FERNANDA SANT ANNA PIMENTA', NULL),
(134719, 'MATEUS VOLKMER NUNES GOMES', NULL),
(141938, 'DANILO FUKUDA CONRAD', NULL),
(151050, 'MARCO ANTONIO WISNIEWSKI', NULL),
(141952, 'RODRIGO SCHEFFER LUMERTZ', NULL),
(141934, 'THIAGO ADDEVICO PRESA', NULL),
(141946, 'THIAGO WINKLER ALVES', NULL),
(141960, 'JOÃO CLAUDIO RODRIGUES AMÉRICO', NULL),
(141923, 'MARCELO ZAMBIASI', NULL),
(151311, 'Felipe Cecagno', NULL),
(151297, 'CAROLINA PARREIRA LORINI', NULL),
(134724, 'DENYS HUPEL DA SILVA OLIVEIRA', NULL),
(141970, 'JONAS JESKE', NULL),
(134730, 'JOSUÉ DIOGO NEIS', NULL),
(134710, 'MARCOS RATES CRIPPA', NULL),
(134718, 'RENATO OLIVEIRA DA SILVA', NULL),
(158910, 'Pablo Cristini Guedes', NULL),
(150286, 'Guilherme Lazzarotto de Lima', NULL),
(150427, 'JONAS HARTMANN', NULL),
(149892, 'Rosália Galiazzi Schneider', NULL),
(151142, 'WILLIAM WOLMANN GONÇALVES', NULL),
(106527, 'GABRIEL MARQUES PORTAL', NULL),
(151392, 'Gustavo Führ', NULL),
(151086, 'Julio Toss', NULL),
(141924, 'EDUARDO CASOTTI POSTAL', NULL),
(150971, 'GUILHERME JAMES DE ANGELIS FACHINI', NULL),
(150786, 'Guilherme Selau Ribeiro', NULL),
(150746, 'HENRIQUE VALER', NULL),
(106897, 'RODRIGO OTÁVIO SILVA SANTOS', NULL),
(159098, 'ANDRÉ MARTINS FERREIRA', NULL),
(171359, 'BRUNO COSWIG FISS', NULL),
(141029, 'CASSIO RAMPELOTTO DIAS', NULL),
(171315, 'LUÍS ARMANDO BIANCHIN', NULL),
(171774, 'MARCOS VINICIUS CAVINATO', NULL),
(161900, 'MATHEUS PRIEBE BERTRAM', NULL),
(159011, 'SAMUEL GRIMM MATSCHULAT', NULL),
(171671, 'KAUÊ SOARES DA SILVEIRA', NULL),
(159847, 'Leonardo Fernando dos Santos Moura', NULL),
(149748, 'RAFAEL HANSEN DA SILVA', NULL),
(143266, 'MARTIN REUS', NULL),
(173256, 'PAULO VITOR SILVESTRIN', NULL),
(160507, 'ANDRÉ RODRIGUES OLIVERA', NULL),
(171102, 'BRUNO ROMEU NUNES', NULL),
(160238, 'FRANCISCO GERDAU DE BORJA', NULL),
(149792, 'FRANCO ALMADA VALDEZ', NULL),
(159204, 'GERMANO THOMAS', NULL),
(162022, 'LUIZA DE SOUZA', NULL),
(160884, 'PEDRO MARTINS DUSSO', NULL),
(150609, 'THIAGO BASEGGIO DAL PAI', NULL),
(159373, 'THOMAS DA SILVA RODRIGUES', NULL),
(151325, 'VICTOR YOSHIAKI MIYAI', NULL),
(158879, 'VÍTOR UWE REUS', NULL),
(160636, 'LEONARDO PILETTI CHATAIN', NULL),
(172968, 'DAMIEN THOMÉ LUTZ', NULL),
(180665, 'DENNIS GIOVANI BALREIRA', NULL),
(181046, 'HENRIQUE WEBER', NULL),
(172865, 'BRUNO JURKOVSKI', NULL),
(170662, 'FEDERICO WASSERMAN', NULL),
(171594, 'GUSTAVO GARCIA VALDEZ', NULL),
(159839, 'LISARDO SALLABERRY KIST', NULL),
(180659, 'RICARDO CHAGAS RAPACKI', NULL),
(192332, 'GUILHERME VIEIRA SCHWADE', NULL),
(180178, 'HUGO SCHROTER LAZZARI', NULL),
(160128, 'BRUNO RECKZIEGEL FILHO', NULL),
(180028, 'DIEGO MACEDO DA SILVA', NULL),
(173683, 'EDUARDO GISCHKOW PÖTTER', NULL),
(180187, 'FELIPE MATHIAS SCHMIDT', NULL),
(161578, 'GABRIEL ROLETO CARDOSO', NULL),
(180169, 'GUILHERME ANDRIGHETTO TEIXEIRA', NULL),
(171985, 'JOHN CRISTIAN BORGES GAMBOA', NULL),
(171232, 'LUCAS DOS SANTOS LERSCH', NULL),
(173143, 'MATHEUS DE OLIVEIRA JULLIEN', NULL),
(180663, 'PAULA BURGUÊZ', NULL),
(180658, 'VÍTOR FORTES REY', NULL),
(181047, 'KARINA GABIN MINUZZO', NULL),
(181045, 'ANDRÉ FELIPE BITENCOURT MORAES', NULL),
(186044, 'GABRIEL MANZONI MOREIRA', NULL),
(180149, 'JONATA TEIXEIRA PASTRO', NULL),
(193027, 'JONATHAS GABRIEL DIPP HARB', NULL),
(173736, 'Ricardo Gomes da Silva', NULL),
(144093, 'CAROLINA PEREIRA NOGUEIRA', NULL),
(151820, 'ALEXANDRE HAUBER DA SILVA', NULL),
(154085, 'ANDRE ROLIM BEHR', NULL),
(194282, 'AUGUSTO BARCELLOS BERND', NULL),
(181098, 'HELENA MICHAELSEN ROESLER', NULL),
(153016, 'LEANDRO AVILA DA SILVA', NULL),
(187984, 'MILLER BIAZUS', NULL),
(194046, 'RAFAEL THOMAZI GONZALEZ', NULL),
(180177, 'GUILHERME GROCHAU AZZI', NULL),
(172805, 'JOÃO GILBERTO HEITOR GAIEWSKI', NULL),
(181051, 'DIOGO RAPHAEL CRAVO', NULL),
(205677, 'CARLOS EDUARDO TUSSI LEITE', NULL),
(173362, 'CRISTIANO MEDEIROS DALBEM', NULL),
(213943, 'DANIEL RIEGER BECKERT', NULL),
(194050, 'LUCAS MARTINELLI TABAJARA', NULL),
(136830, 'LUÍS AUGUSTO DE OLIVEIRA BRANDELLI', NULL),
(193092, 'SUYA PEREIRA CASTILHOS', NULL),
(205650, 'TAÍS LOUREIRO BELLINI', NULL),
(171920, 'ARTHUR DIEHL BRAZ', NULL),
(174021, 'LUCAS JOSÉ KREUTZ ALVES', NULL),
(205974, 'MARCELO GARLET MILLANI', NULL),
(180181, 'ANDERSON DIDONÉ FOSCARINI', NULL),
(170933, 'CLAUDIO JOSÉ CASTALDELLO BUSATTO', NULL),
(181026, 'GUILHERME AUGUSTO DIAS', NULL),
(180684, 'LUCAS MENEZES FREIRE', NULL),
(213917, 'AFFONSO DICK NETO', NULL),
(208669, 'ALEX ZOCH GLIESCH', NULL),
(171946, 'ANDRÉ ANTUNES DA CUNHA', NULL),
(205980, 'ARTHUR SELLE JACOBS', NULL),
(208152, 'CRISTIANO CARLOS MATTE', NULL),
(193031, 'EDUARDO DELAZERI FERREIRA', NULL),
(213502, 'GIANEI LEANDRO SEBASTIANY', NULL),
(182283, 'GUILHERME BENDER', NULL),
(180186, 'GUILHERME SCHIEVELBEIN', NULL),
(205655, 'JONAS CALVI MEINERZ', NULL),
(181464, 'LORENZO PEZZI DALAQUA', NULL),
(205692, 'LUCAS FOLLE', NULL),
(205687, 'FELIPE DE MEDEIROS SCHMIDT', NULL),
(217443, 'KHIN EMMANUEL RODRIGUES BAPTISTA', NULL),
(205608, 'Marcus Vinicius da Silva', NULL),
(217432, 'Pedro Henrique Arruda Faustini', NULL),
(205689, 'Henrique de Paula Lopes', NULL),
(193032, 'Ana Claudia de Almeida Bordignon', NULL),
(205648, 'Lucas Torresan Cardozo', NULL),
(192331, 'Guilherme Vieira Schwade', NULL),
(120921, 'Gabriel Mattos Langeloh', NULL),
(206526, 'Rodrigo Cardoso Buske', NULL),
(219421, 'Bernardo de Freitas Zamperetti', NULL),
(177768, 'Bruno Giovenardi Esteve', NULL),
(217436, 'Gabriel Restori Soares', NULL),
(218324, 'Fernando Bombardelli da Silva', NULL),
(218323, 'William Bombardelli da Silva', NULL),
(161887, 'Luís Antônio Leite Francisco da Costa', NULL),
(208151, 'Bruno Iochins Grisci', NULL),
(194648, 'Matheus dos Santos Gonzaga', NULL),
(219435, 'João Paulo Tarasconi Ruschel', NULL),
(207300, 'Rodrigo Zanella Ribeiro', NULL),
(218327, 'Luís Felipe Polo', NULL),
(221065, 'Rodrigo Augusto Scheller Boos', NULL),
(194235, 'Roberta Robert', NULL),
(220640, 'Rafael Garcia', NULL),
(205649, 'Vinícius Bittencourt Garcia', NULL),
(220496, 'Cristiano Ruschel Marques Dias', NULL),
(219432, 'Bruno Soares Fillmann', NULL),
(205975, 'Jorge Alberto Wagner Filho', NULL),
(205978, 'Tiago Covolan Bozzetti', NULL),
(103023, 'Arthur Remuzzi Foscarini', NULL),
(180229, 'Tagline Treichel', NULL),
(159984, 'Vinicius Amaro Cechin', NULL),
(228992, 'Gabriella Rossi Barbieri Homem', NULL),
(205652, 'Hyago César da Silva Sallet', NULL),
(228539, 'Diego Velasco Volkmann', NULL),
(220488, 'João Pedro Duro Reis', NULL),
(180190, 'José Luis Damaren Junior', NULL),
(228343, 'Fernando Luis Spaniol', NULL),
(208157, 'Mateus Riad da Cunha Soares', NULL),
(192529, 'Gilson da Rosa Webber', NULL),
(192535, 'Filipe Avila Soares', NULL),
(192670, 'Roberto Oppermann Cordoni', NULL),
(218138, 'Glauber de Souza Rosa', NULL),
(217047, 'Felipe Dienstmann Musse', NULL),
(218762, 'João Victor Gomes Cachola', NULL),
(201926, 'Marcelo Cardoso Bortolozzo', NULL),
(207269, 'Matheus Marrone Castanho', NULL),
(193402, 'Vinicius Maciel Hoff', NULL),
(219824, 'Matheus Schuh', NULL),
(217051, 'João Pedro Muller Meireles Assumpção', NULL),
(218770, 'Daniel Souza', NULL),
(208003, 'Thales Baierlo Tabajara', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(196) NOT NULL,
  `permissions` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permissions`, `email`) VALUES
(1, 'gslandtreter', '698dc19d489c4e4db73e28a713eab07b', 'admin', 'gslandtreter@inf.ufrgs.br'),
(2, 'lfschauren', '698dc19d489c4e4db73e28a713eab07b', 'user', 'lfschauren@inf.ufrgs.br');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
