SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `quizsite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE `answer` (
  `pk_fk_questionID` int(11) NOT NULL,
  `pk_answerID` int(11) NOT NULL,
  `AnswerText` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`pk_fk_questionID`, `pk_answerID`, `AnswerText`) VALUES
(1, 1, 'a router'),
(2, 1, 'extranet'),
(3, 1, 'an intranet'),
(4, 1, 'convergence'),
(5, 1, 'a router'),
(6, 1, 'extranet'),
(7, 1, 'an intranet'),
(8, 1, 'convergence'),
(1, 2, 'a firewall'),
(2, 2, 'intranet'),
(3, 2, 'the internet'),
(4, 2, 'congestion'),
(5, 2, 'a firewall'),
(6, 2, 'intranet'),
(7, 2, 'the internet'),
(8, 2, 'congestion'),
(1, 3, 'a web server'),
(2, 3, 'wired LAN'),
(3, 3, 'an extranet'),
(4, 3, 'optimization'),
(5, 3, 'a web server'),
(6, 3, 'wired LAN'),
(7, 3, 'an extranet'),
(8, 3, 'optimization'),
(1, 4, 'a DSL modem'),
(2, 4, 'wireless LAN'),
(3, 4, 'a local area network'),
(4, 4, 'synchronization'),
(5, 4, 'a DSL modem'),
(6, 4, 'wireless LAN'),
(7, 4, 'a local area network'),
(8, 4, 'synchronization');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE `question` (
  `pk_questionID` int(11) NOT NULL,
  `fk_pk_quizID` int(11) DEFAULT NULL,
  `question` varchar(4000) DEFAULT NULL,
  `rightAnswer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`pk_questionID`, `fk_pk_quizID`, `question`, `rightAnswer`) VALUES
(1, 1, 'Which device performs the function of determining the path that messages should take through internetworks?', 1),
(2, 1, 'Which area of the network would a college IT staff most likely have to redesign as a direct result of many students bringing their own tablets and smartphones to school to access school resources?', 4),
(3, 1, 'An employee at a branch office is creating a quote for a customer. In order to do this, the employee needs to access confidential pricing information from internal servers at the Head Office. What type of network would the employee access?', 1),
(4, 1, 'Which term describes the state of a network when the demand on the network resources exceeds the available capacity?', 2),
(5, 2, 'Erste Frage', 1),
(6, 2, 'Zweite Frage', 4),
(7, 2, 'Dritte Frage', 1),
(8, 2, 'Vierte Frage', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quiz`
--

CREATE TABLE `quiz` (
  `pk_quizID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `quiz`
--

INSERT INTO `quiz` (`pk_quizID`, `name`, `description`) VALUES
(1, 'Simple Math Quiz', 'This is a simple math quiz. Its demonstrate how a quiz could look like.'),
(2, 'A Second Simple Quiz', 'This is a simple quiz. This Quiz also demonstrate how a quiz could look like.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`pk_answerID`,`pk_fk_questionID`),
  ADD KEY `cfk_answer` (`pk_fk_questionID`);

--
-- Indizes für die Tabelle `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`pk_questionID`),
  ADD KEY `cfk_question` (`fk_pk_quizID`);

--
-- Indizes für die Tabelle `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`pk_quizID`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `cfk_answer` FOREIGN KEY (`pk_fk_questionID`) REFERENCES `question` (`pk_questionID`);

--
-- Constraints der Tabelle `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `cfk_question` FOREIGN KEY (`fk_pk_quizID`) REFERENCES `quiz` (`pk_quizID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
