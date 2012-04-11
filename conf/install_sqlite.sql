create table docusaur (
	id integer primary key,
	version char(8) not null,
	name char(32) not null,
	class char(32) not null,
	usage char(128) not null,
	summary text not null,
	example text not null,
	notes text not null
);

create index docusaur_name on docusaur (version, name);
create index docusaur_class on docusaur (version, class, name);
