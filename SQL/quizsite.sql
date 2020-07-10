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
(1, 1, '10'),
(2, 1, '12'),
(3, 1, '25'),
(4, 1, '0'),
(5, 1, '30'),
(6, 1, '3'),
(7, 1, '50'),
(8, 1, '1'),
(1, 2, '11'),
(2, 2, '10'),
(3, 2, '30'),
(4, 2, '1'),
(5, 2, '61'),
(6, 2, '44'),
(7, 2, '40'),
(8, 2, '60'),
(1, 3, '31'),
(2, 3, '5'),
(3, 3, '3'),
(4, 3, '2'),
(5, 3, '105'),
(6, 3, '33'),
(7, 3, '65'),
(8, 3, '70'),
(1, 4, '21'),
(2, 4, '0'),
(3, 4, '5'),
(4, 4, '10'),
(5, 4, '77'),
(6, 4, '40'),
(7, 4, '82'),
(8, 4, '24');

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
(1, 1, 'Task: 5 + 5', 1),
(2, 1, 'Task: 5 - 5', 4),
(3, 1, 'Task: 5 * 5', 1),
(4, 1, 'Task: 5 : 5', 2),
(5, 2, 'Task: 25 + 5', 1),
(6, 2, 'Task: 35 + 5', 4),
(7, 2, 'Task: 45 + 5', 1),
(8, 2, 'Task: 55 + 5', 2);

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
