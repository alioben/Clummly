-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 15 Juillet 2016 à 08:02
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `953366`
--

-- --------------------------------------------------------

--
-- Structure de la table `en_cinema`
--

CREATE TABLE IF NOT EXISTS `en_cinema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_economie`
--

CREATE TABLE IF NOT EXISTS `en_economie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_hightech`
--

CREATE TABLE IF NOT EXISTS `en_hightech` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_laune`
--

CREATE TABLE IF NOT EXISTS `en_laune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_musique`
--

CREATE TABLE IF NOT EXISTS `en_musique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_politique`
--

CREATE TABLE IF NOT EXISTS `en_politique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_sante`
--

CREATE TABLE IF NOT EXISTS `en_sante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_science`
--

CREATE TABLE IF NOT EXISTS `en_science` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `en_sport`
--

CREATE TABLE IF NOT EXISTS `en_sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_cinema`
--

CREATE TABLE IF NOT EXISTS `fr_cinema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_economie`
--

CREATE TABLE IF NOT EXISTS `fr_economie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_hightech`
--

CREATE TABLE IF NOT EXISTS `fr_hightech` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_laune`
--

CREATE TABLE IF NOT EXISTS `fr_laune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_musique`
--

CREATE TABLE IF NOT EXISTS `fr_musique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_politique`
--

CREATE TABLE IF NOT EXISTS `fr_politique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_sante`
--

CREATE TABLE IF NOT EXISTS `fr_sante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_science`
--

CREATE TABLE IF NOT EXISTS `fr_science` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fr_sport`
--

CREATE TABLE IF NOT EXISTS `fr_sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resume` longtext NOT NULL,
  `tags` text NOT NULL,
  `lien` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(50) NOT NULL,
  `lien` text NOT NULL,
  `categorie` varchar(60) NOT NULL,
  `icon` text NOT NULL,
  `langage` varchar(10) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Contenu de la table `sources`
--

INSERT INTO `sources` (`id`, `source`, `lien`, `categorie`, `icon`, `langage`, `last_update`) VALUES
(1, 'linternaute.com', 'http://www.linternaute.com/actualite/rss/', 'laune', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(2, 'linternaute.com', 'http://www.linternaute.com/sport/rss/', 'sport', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(3, 'linternaute.com', 'http://www.linternaute.com/cinema/rss/', 'cinema', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(4, 'linternaute.com', 'http://www.linternaute.com/musique/rss/', 'musique', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(5, 'linternaute.com', 'http://www.linternaute.com/hightech/rss/', 'hightech', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(6, 'linternaute.com', 'http://www.linternaute.com/science/rss/', 'science', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(7, 'linternaute.com', 'http://www.linternaute.com/sante/rss/', 'sante', 'ico-linternaute.png', 'fr', '0000-00-00 00:00:00'),
(8, 'lefigaro.fr', 'http://rss.lefigaro.fr/lefigaro/laune', 'laune', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(9, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_musique.xml', 'musique', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(10, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_sciences-technologies.xml', 'science', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(11, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_sante.xml', 'sante', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(12, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_politique.xml', 'politique', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(13, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_economie.xml', 'economie', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(14, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_cinema.xml', 'cinema', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(15, 'lefigaro.fr', 'http://www.lefigaro.fr/rss/figaro_sport.xml', 'sport', 'ico-lefigaro.png', 'fr', '0000-00-00 00:00:00'),
(16, 'lemonde.fr', 'http://www.lemonde.fr/rss/une.xml', 'laune', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(24, 'nouvelobs.com', 'http://tempsreel.nouvelobs.com/rss.xml', 'laune', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(18, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/technologies.xml', 'hightech', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(19, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/sante.xml', 'sante', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(20, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/politique.xml', 'politique', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(21, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/economie.xml', 'economie', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(22, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/sport.xml', 'sport', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(23, 'lemonde.fr', 'http://www.lemonde.fr/rss/tag/sciences.xml', 'science', 'ico-lemonde.png', 'fr', '0000-00-00 00:00:00'),
(25, 'nouvelobs.com', 'http://sciencesetavenir.nouvelobs.com/high-tech/rss.xml', 'hightech', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(26, 'nouvelobs.com', 'http://tempsreel.nouvelobs.com/sante/rss.xml', 'sante', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(27, 'nouvelobs.com', 'http://tempsreel.nouvelobs.com/politique/rss.xml', 'politique', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(28, 'nouvelobs.com', 'http://tempsreel.nouvelobs.com/economie/rss.xml', 'economie', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(29, 'nouvelobs.com', 'http://tempsreel.nouvelobs.com/sport/rss.xml', 'sport', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(30, 'nouvelobs.com', 'http://sciencesetavenir.nouvelobs.com/sciences/rss.xml', 'science', 'ico-nouvelobs.png', 'fr', '0000-00-00 00:00:00'),
(31, 'lexpress.fr', 'http://www.lexpress.fr/rss/alaune.xml', 'laune', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(32, 'lexpress.fr', 'http://www.lexpress.fr/rss/high-tech.xml', 'hightech', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(33, 'lexpress.fr', 'http://www.lexpress.fr/rss/politique.xml', 'politique', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(34, 'lexpress.fr', 'http://www.lexpress.fr/rss/sport.xml', 'sport', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(35, 'lexpress.fr', 'http://www.lexpress.fr/rss/musique.xml', 'musique', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(36, 'lexpress.fr', 'http://www.lexpress.fr/rss/cinema.xml', 'cinema', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(37, 'lexpress.fr', 'http://www.lexpress.fr/rss/science-et-sante.xml', 'science', 'ico-lexpress.png', 'fr', '0000-00-00 00:00:00'),
(39, 'yahoo.com', 'http://news.yahoo.com/rss/politics', 'politique', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(40, 'yahoo.com', 'http://news.yahoo.com/rss/us', 'laune', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(41, 'yahoo.com', 'http://news.yahoo.com/rss/economy', 'economie', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(42, 'yahoo.com', 'http://news.yahoo.com/rss/sports', 'sport', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(43, 'yahoo.com', 'http://news.yahoo.com/rss/music', 'musique', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(44, 'yahoo.com', 'http://news.yahoo.com/rss/movies', 'cinema', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(45, 'yahoo.com', 'http://news.yahoo.com/rss/tech', 'hightech', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(46, 'yahoo.com', 'http://news.yahoo.com/rss/science', 'science', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(47, 'yahoo.com', 'http://news.yahoo.com/rss/health', 'sante', 'ico-yahoo.png', 'en', '0000-00-00 00:00:00'),
(61, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Health.xml', 'sante', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(60, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Science.xml', 'science', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(59, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Sports.xml', 'sport', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(58, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Politics.xml', 'politique', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(57, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/US.xml', 'laune', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(56, 'nytimes.com', 'http://rss.nytimes.com/services/xml/rss/nyt/Economy.xml', 'economie', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(62, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Movies.xml', 'cinema', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(63, 'nytimes.com', 'http://www.nytimes.com/services/xml/rss/nyt/Music.xml', 'musique', 'ico-nytimes.png', 'en', '0000-00-00 00:00:00'),
(64, 'huffingtonpost.com', 'http://feeds.huffingtonpost.com/huffingtonpost/LatestNews', 'laune', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(65, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/politics/news.xml', 'politique', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(66, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/technology/news.xml', 'hightech', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(67, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/health-news/news.xml', 'sante', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(68, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/science/news.xml', 'science', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(69, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/sports/news.xml', 'sport', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(70, 'huffingtonpost.com', 'http://www.huffingtonpost.com/feeds/verticals/business/news.xml', 'economie', 'ico-huffingtonpost.png', 'en', '0000-00-00 00:00:00'),
(71, 'cnn.com', 'http://rss.cnn.com/rss/edition_us.rss', 'laune', 'ico-cnn.png', 'en', '0000-00-00 00:00:00'),
(72, 'cnn.com', 'http://rss.cnn.com/rss/edition_technology.rss', 'hightech', 'ico-cnn.png', 'en', '0000-00-00 00:00:00'),
(73, 'cnn.com', 'http://rss.cnn.com/rss/edition_sport.rss', 'sport', 'ico-cnn.png', 'en', '0000-00-00 00:00:00'),
(74, 'cnn.com', 'http://rss.cnn.com/rss/edition_business.rss', 'economie', 'ico-cnn.png', 'en', '0000-00-00 00:00:00'),
(75, 'nbcnews.com', 'http://rss.msnbc.msn.com/id/3032524/device/rss/rss.xml ', 'laune', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00'),
(76, 'nbcnews.com', 'http://rss.msnbc.msn.com/id/3032552/device/rss/rss.xml ', 'politique', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00'),
(77, 'nbcnews.com', 'http://rss.nbcsports.msnbc.com/id/3032112/device/rss/rss.xml ', 'sport', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00'),
(78, 'nbcnews.com', 'http://rss.msnbc.msn.com/id/3032071/device/rss/rss.xml ', 'economie', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00'),
(79, 'nbcnews.com', 'http://rss.msnbc.msn.com/id/3088327/device/rss/rss.xml ', 'sante', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00'),
(80, 'nbcnews.com', 'http://rss.msnbc.msn.com/id/3032117/device/rss/rss.xml ', 'science', 'ico-nbcnews.png', 'en', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
