create table docusaur (
	id int not null auto_increment primary key,
	version char(8) not null,
	name char(32) not null, ; bar
	class char(32) not null, ; Foo
	type enum('function','property','class') not null,
	usage char(128) not null, ; bool Foo::bar ($asdf = false)
	summary text not null,
	example text not null,
	notes text not null,
	index (version, name)
	index (version, class, name)
);
