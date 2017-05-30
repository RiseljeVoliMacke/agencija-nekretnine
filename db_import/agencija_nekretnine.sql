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
(2, 'Name1234', 1, 'Sex and neglected principle ask rapturous consulted. Object remark lively all did feebly excuse our wooded. Old her object chatty regard vulgar missed. Speaking throwing breeding betrayed children my to.', '2017-05-02 12:00:00'),
(3, 'Dusan123', 1, 'Society excited by cottage private an it esteems. Fully begin on by wound an. Girl rich in do up or both. At declared in as rejoiced of together. He impression collecting delightful unpleasant by prosperous as on. End too talent she object mrs wanted remove giving.', '2017-05-29 00:14:34'),
(4, 'Name1234', 1, 'Ought these are balls place mrs their times add she. Taken no great widow spoke of it small. Genius use except son esteem merely her limits. Sons park by do make on. It do oh cottage offered cottage in written. Especially of dissimilar up attachment themselves by interested boisterous. Linen mrs seems men table. Jennings dashwood to quitting marriage bachelor in. On as conviction in of appeara nd', '2017-05-04 18:18:07'),
(5, 'Dusan123', 2, 'Respect forming clothes do in he. Course so piqued no an by appear. Themselves reasonable pianoforte so motionless he as difficulty be. Abode way begin ham there power whole. Do unpleasing indulgence impossible to conviction. Suppose neither evident welcome it at do civilly uncivil. Sing tall much you get no\r\n', '2017-05-28 17:37:27'),
(17, 'admin', 1, 'Talent she for lively eat led sister. Entrance strongly packages she out rendered get quitting denoting led. Dwelling confined improved it he no doubtful raptures. Several carried through an of up attempt gravity. Situation to be at offending elsewhere distrusts if. Particular use for considered projection cultivated. Worth of do doubt shall it their. Extensive existence up me contained he pronoun', '2017-05-29 15:07:28'),
(20, 'admin', 2, 'His exquisite sincerity education shameless ten earnestly breakfast add. So we me unknown as improve hastily sitting forming. Especially favourable compliment but thoroughly unreserved saw she themselves. Sufficient impossible him may ten insensible put continuing', '2017-05-29 15:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL,
  `slika` varchar(100) DEFAULT NULL,
  `grad` varchar(20) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL,
  `cijena` int(11) NOT NULL,
  `povrsina` int(11) NOT NULL,
  `povrsina_placa` int(11) NOT NULL,
  `broj_soba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nekretnina`
--

INSERT INTO `nekretnina` (`id`, `slika`, `grad`, `ulica`, `cijena`, `povrsina`, `povrsina_placa`, `broj_soba`) VALUES
(1, 'nek1.jpg', 'Bar', 'Ul1', 1000, 100, 150, 3),
(2, 'nek2.jpg', 'Niksic', 'Ul2', 1000, 50, 100, 1),
(3, 'nek3.jpg', 'Bar', 'Ul3', 3000, 200, 250, 3),
(4, 'nek4.jpg', 'Bar', 'Ul4', 1000, 500, 600, 8),
(5, 'nek5.jpg', 'Podgorica', 'Ul5', 750, 325, 400, 4),
(6, 'nek6.jpg', 'Bar', 'Ul6', 500, 150, 200, 3),
(7, 'nek7.jpg', 'Podgorica', 'Ul10', 1500, 1000, 1500, 5),
(10, 'nek10.jpg', 'Podgorica', 'Ul8', 500000, 650, 1000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

CREATE TABLE `oglas` (
  `id` int(11) NOT NULL,
  `n_id` int(11) DEFAULT NULL,
  `u_username` varchar(20) NOT NULL,
  `tip` varchar(20) NOT NULL,
  `opis` varchar(500) DEFAULT NULL,
  `kratki_opis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oglas`
--

INSERT INTO `oglas` (`id`, `n_id`, `u_username`, `tip`, `opis`, `kratki_opis`) VALUES
(1, 1, 'Dusan123', 'najam', 'Wrote water woman of heart it total other. By in entirely securing suitable graceful at families improved. Zealously few furniture repulsive was agreeable consisted difficult. Collected breakfast estimable questions in to favourite it. Known he place worth words it as to. Spoke now noise off smart her ready.', 'When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use.'),
(2, 2, 'Name1234', 'prodaja', 'For norland produce age wishing. To figure on it spring season up. Her provision acuteness had excellent two why intention. As called mr needed praise at.', 'Had denoting properly jointure you occasion directly raillery. In said to of poor full be post face snug. Introduced imprudence see say unpleasing devonshire acceptance son. Exeter '),
(3, 3, 'Dusan123', 'najam', 'Arrival entered an if drawing request. How daughters not promotion few knowledge contented. Yet winter law behind number stairs garret excuse. Minuter we natural conduct gravity if pointed oh no. Am immediate unwilling of attempted admitting disposing it. Handsome opinions on am at it ladyship. ', 'As absolute is by amounted repeated entirely ye returned. These ready timed enjoy might sir yet one since.'),
(4, 4, 'Name1234', 'prodaja', 'Years drift never if could forty being no. On estimable dependent as suffering on my. Rank it long have sure in room what as he. Possession travelling sufficient yet our. Talked vanity looked in to. Gay perceive led believed endeavor. Rapturous no of estimable oh therefore direction up. Sons the ever not fine like eyes all sure. ', 'It as announcing it me stimulated frequently continuing. Least their she you now above going stand forth.'),
(5, 5, 'Dusan123', 'prodaja', 'He pretty future afraid should genius spirit on. Set property addition building put likewise get. Of will at sell well at as. Too want but tall nay like old. Removing yourself be in answered he. Consider occasion get improved him she eat. Letter by lively oh denote an', 'Spoke as as other again ye. Hard on to roof he drew. So sell side ye in mr evil. Longer waited mr of nature seemed.'),
(6, 6, 'Name1234', 'prodaja', 'She suspicion dejection saw instantly. Well deny may real one told yet saw hard dear. Bed chief house rapid right the. Set noisy one state tears which. No girl oh part must fact high my he. Simplicity in excellence melancholy as remarkably discovered. Own partiality motionless was old excellence she inquietude contrasted. Sister giving so wicket cousin of an he rather marked. Of on game part body rich. Adapted mr savings venture it or comfort affixed friends. ', 'Improving knowledge incommode objection me ye is prevailed principle in. Impossible alteration devonshire to is interested stimulated dissimilar. To matter esteem polite do if. '),
(7, 7, 'PetarJerk', 'najam', 'Answer misery adieus add wooded how nay men before though. Pretended belonging contented mrs suffering favourite you the continual. Mrs civil nay least means tried drift. Natural end law whether but and towards certain. Furnished unfeeling his sometimes see day promotion. Quitting informed concerns can men now. Projection to or up conviction uncommonly delightful continuing. In appetite ecstatic opinions hastened by handsome admitted. \r\n', 'Death there mirth way the noisy merit. Piqued shy spring nor six though mutual living ask extent. Replying of dashwood advanced ladyship smallest disposal or.'),
(10, 10, 'admin', 'prodaja', 'Silent sir say desire fat him letter. Whatever settling goodness too and honoured she building answered her. Strongly thoughts remember mr to do consider debating. Spirits musical behaved on we he farther letters. Repulsive he he as deficient newspaper dashwoods we. Discovered her his pianoforte insipidity entreaties. Began he at terms meant as fancy. Breakfast arranging he if furniture we described on. Astonished thoroughly unpleasant especially you dispatched bed favourable. \r\n', 'In to am attended desirous raptures declared diverted confined at. Collected instantly remaining up certainly to necessary as. Over walk dull into son boy door went new. At or happiness commanded dau');

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
('Name1234', 'Password1234', 'email@fake.com', 'Firstname', 'Lastname', '2-2-1990', '069-655-444', 'Bar'),
('PetarJerk', '1234bB', 'douche@bag.com', 'Petar', 'Djerkovic', '1-1-1905', '555-555-555', 'Niksic'),
('TheReaLedu', 'Nopassword69', 'not@really.me', 'Le', 'Dude', '01-01-2000', '112-358-1321', 'Podgorica');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `oglas`
--
ALTER TABLE `oglas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
