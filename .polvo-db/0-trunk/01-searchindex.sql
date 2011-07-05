create table `_searchindex` (
  `id` int(11) primary key auto_increment,
  `idObj` int(11) not null,
  `type` varchar(100) not null,
  `word` varchar(100) not null, 
  `weight` int(11) not null
);
