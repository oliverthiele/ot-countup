CREATE TABLE tx_otcountup_item
(
	parent_id     int(11)      default 0  not null,
	parent_table  varchar(50)  default '' not null,
	title         varchar(255) default '' not null,
	value_start   int(11)      default 0  not null,
	value_end     int(11)      default 0  not null,
	value_prefix  varchar(50)  default '' not null,
	value_suffix  varchar(50)  default '' not null,
	icon_identifier varchar(255) default '' not null
);
