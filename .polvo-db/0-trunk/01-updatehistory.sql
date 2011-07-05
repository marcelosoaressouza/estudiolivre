create table `_updatehistory` (
  `id` int(11) primary key auto_increment,
  `objType` char(255) not null,
  `objId` varchar(100) not null,
  key(`objType`,`objId`),
  `tstamp` int4 not null,
  `version` int not null, key(version),
  `responsibleType` char(255) not null,
  `responsibleId` int(11) not null,
  key(`responsibleType`, `responsibleId`),
  title char(255) not null,
  changes longblob
);
