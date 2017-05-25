--
-- Database: `agencija_nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`naziv`) VALUES
('Bar'),
('Cetinje'),
('Niksic'),
('Podgorica');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `u_username` varchar(20) NOT NULL,
  `oglas_id` int(11) DEFAULT NULL,
  `tekst` varchar(400) DEFAULT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `u_username`, `oglas_id`, `tekst`, `datum`) VALUES
(1, 'Dusan123', 1, 'Top kuca, must have', '2017-05-10 12:36:21'),
(2, 'Name1234', 1, 'Sex and neglected principle ask rapturous consulted. Object remark lively all did feebly excuse our wooded. Old her object chatty regard vulgar missed. Speaking throwing breeding betrayed children my to.', '2017-05-02 12:00:00'),
(3, 'Dusan123', 1, 'Society excited by cottage private an it esteems. Fully begin on by wound an. Girl rich in do up or both. At declared in as rejoiced of together. He impression collecting delightful unpleasant by prosperous as on. End too talent she object mrs wanted remove giving. \r\n', '2017-05-07 00:00:00'),
(4, 'Name1234', 1, 'Good draw knew bred ham busy his hour. Ask agreed answer rather joy nature admire wisdom. Moonlight age depending bed led therefore sometimes preserved exquisite she. An fail up so shot leaf wise in. Minuter highest his arrived for put and. Hopes lived by rooms oh in no death house. Contented direction september but end led excellent ourselves may. Ferrars few arrival his offered not charmed you. ', '2017-05-04 18:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL,
  `slika` varchar(100) DEFAULT NULL,
  `grad` varchar(20) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nekretnina`
--

INSERT INTO `nekretnina` (`id`, `slika`, `grad`, `ulica`) VALUES
(1, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek1.jpg', 'Podgorica', 'Ul1'),
(2, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek2.jpg', 'Niksic', 'Ul2'),
(3, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek3.jpg', 'Cetinje', 'Ul3'),
(4, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek4.jpg', 'Bar', 'Ul4'),
(5, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek5.jpg', 'Podgorica', 'Ul5'),
(6, 'http://localhost:8080/agencija-nekretnine/oglasi_images/nek6.jpg', 'Bar', 'Ul6');

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

CREATE TABLE `oglas` (
  `id` int(11) NOT NULL,
  `n_id` int(11) DEFAULT NULL,
  `u_username` varchar(20) NOT NULL,
  `opis` varchar(500) DEFAULT NULL,
  `kratki_opis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oglas`
--

INSERT INTO `oglas` (`id`, `n_id`, `u_username`, `opis`, `kratki_opis`) VALUES
(1, 1, 'Dusan123', 'Wrote water woman of heart it total other. By in entirely securing suitable graceful at families improved. Zealously few furniture repulsive was agreeable consisted difficult. Collected breakfast estimable questions in to favourite it. Known he place worth words it as to. Spoke now noise off smart her ready. \r\n', 'Of resolve to gravity thought my prepare chamber so. Unsatiable entreaties collecting may sympathize nay interested instrument.'),
(2, 2, 'Name1234', 'For norland produce age wishing. To figure on it spring season up. Her provision acuteness had excellent two why intention. As called mr needed praise at.', 'Had denoting properly jointure you occasion directly raillery. In said to of poor full be post face snug. Introduced imprudence see say unpleasing devonshire acceptance son. Exeter '),
(3, 3, 'Dusan123', 'Arrival entered an if drawing request. How daughters not promotion few knowledge contented. Yet winter law behind number stairs garret excuse. Minuter we natural conduct gravity if pointed oh no. Am immediate unwilling of attempted admitting disposing it. Handsome opinions on am at it ladyship. ', 'As absolute is by amounted repeated entirely ye returned. These ready timed enjoy might sir yet one since.'),
(4, 4, 'Name1234', 'Years drift never if could forty being no. On estimable dependent as suffering on my. Rank it long have sure in room what as he. Possession travelling sufficient yet our. Talked vanity looked in to. Gay perceive led believed endeavor. Rapturous no of estimable oh therefore direction up. Sons the ever not fine like eyes all sure. ', 'It as announcing it me stimulated frequently continuing. Least their she you now above going stand forth.'),
(5, 5, 'Dusan123', 'He pretty future afraid should genius spirit on. Set property addition building put likewise get. Of will at sell well at as. Too want but tall nay like old. Removing yourself be in answered he. Consider occasion get improved him she eat. Letter by lively oh denote an', 'Spoke as as other again ye. Hard on to roof he drew. So sell side ye in mr evil. Longer waited mr of nature seemed.'),
(6, 6, 'Name1234', 'She suspicion dejection saw instantly. Well deny may real one told yet saw hard dear. Bed chief house rapid right the. Set noisy one state tears which. No girl oh part must fact high my he. Simplicity in excellence melancholy as remarkably discovered. Own partiality motionless was old excellence she inquietude contrasted. Sister giving so wicket cousin of an he rather marked. Of on game part body rich. Adapted mr savings venture it or comfort affixed friends. ', 'Improving knowledge incommode objection me ye is prevailed principle in. Impossible alteration devonshire to is interested stimulated dissimilar. To matter esteem polite do if. ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `phoneNum` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `firstName`, `lastName`, `birthDate`, `phoneNum`, `city`) VALUES
('admin', '123456', '', '', '', '', '', ''),
('Dusan123', '1234aA', 'dmilenkovic@ymail.com', 'Dusan', 'Milenkovic', '11-11-1995', '069-653-671', 'Podgorica'),
('Name1234', 'Password1234', 'email@fake.com', 'Firstname', 'Lastname', '2-2-1990', '069-655-444', 'Bar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`naziv`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_username` (`u_username`),
  ADD KEY `oglas_id` (`oglas_id`);

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grad` (`grad`);

--
-- Indexes for table `oglas`
--
ALTER TABLE `oglas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_id` (`n_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `oglas`
--
ALTER TABLE `oglas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`u_username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`oglas_id`) REFERENCES `oglas` (`id`);

--
-- Constraints for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD CONSTRAINT `nekretnina_ibfk_1` FOREIGN KEY (`grad`) REFERENCES `grad` (`naziv`);

--
-- Constraints for table `oglas`
--
ALTER TABLE `oglas`
  ADD CONSTRAINT `oglas_ibfk_1` FOREIGN KEY (`n_id`) REFERENCES `nekretnina` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
