create database mvc;

use mvc;

create table `pages`(
`id` tinyint(3) unsigned not null auto_increment,
`title` varchar(100) not null,
`content` text default null,
`active` tinyint(1) unsigned default 0,
primary key (`id`)
) engine = InnoDB default charset=utf8;


insert into `pages` values
(1, 'About us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1),
(2, 'Test page', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1);


create table `feedback` (
`id` tinyint(3) unsigned not null auto_increment,
`name` varchar(100) not null,
`email` varchar(100) not null,
`messages` text default null,
primary key (`id`)
) engine=InnoDB default charset=utf8;

create table `url_rewrite` (
`id` int(10) unsigned not null auto_increment,
`alias` varchar(100) not null,
`target` varchar(100) not null,
primary key (`id`)
) engine=InnoDB default charset=utf8;

create table `users` (
`id` smallint(5) unsigned not null auto_increment,
`login` varchar(45) not null,
`email` varchar(100) not null,
`role` varchar(45) not null default 'admin',
`password` char(32) not null,
`active` tinyint(1) unsigned default '1',
primary key (`id`)
) engine=InnoDB default charset=utf8;