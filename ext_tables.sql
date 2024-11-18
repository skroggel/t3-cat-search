#
# Tables
#
CREATE TABLE sys_file_reference
(
	tx_catsearch_header   varchar(255) DEFAULT '' NOT NULL,
	tx_catsearch_bodytext text,
);


CREATE TABLE tt_content
(
	tx_catsearch_content_element int(11) DEFAULT '0' NOT NULL,
	KEY                          tx_catsearch_content_element (tx_catsearch_content_element)
);


CREATE TABLE tx_catsearch_domain_model_filterable
(
	uid                            int(11) NOT NULL auto_increment,
	record_type                    int(4) NOT NULL DEFAULT '0',
	layout                         varchar(255) DEFAULT 'default' NOT NULL,
	detail_pid                     int(4) NOT NULL DEFAULT '0',

	title                          varchar(255) DEFAULT ''        NOT NULL,
	title_cleaned                  varchar(255) DEFAULT ''        NOT NULL,
	title_seo                      varchar(255) DEFAULT ''        NOT NULL,
	slug                           varchar(2048),
	subtitle                       varchar(255) DEFAULT ''        NOT NULL,

	product_number                 varchar(255) DEFAULT ''        NOT NULL,
	teaser                         text,
	header                         varchar(255) DEFAULT ''        NOT NULL,
	header2                        varchar(255) DEFAULT ''        NOT NULL,
	header3                        varchar(255) DEFAULT ''        NOT NULL,
	subheader                      varchar(255) DEFAULT ''        NOT NULL,
	subheader2                     varchar(255) DEFAULT ''        NOT NULL,
	subheader3                     varchar(255) DEFAULT ''        NOT NULL,
	description                    text,
	description_seo                text,
	description2                   text,
	description3                   text,
	options                        text,
	applications                   text,
	features                       text,
	highlights                     text,
	details                        text,

	manufacturer                   int(11) DEFAULT '0' NOT NULL,
	filters                        int(11) unsigned DEFAULT '0',
	primary_filter1                int(11) unsigned DEFAULT '0',
	primary_filter2                int(11) unsigned DEFAULT '0',
	primary_filter3                int(11) unsigned DEFAULT '0',
	primary_filter4                int(11) unsigned DEFAULT '0',
	primary_filter5                int(11) unsigned DEFAULT '0',

	publish_date                   int(11) unsigned DEFAULT '0' NOT NULL,
	publish_date_year              int(4) unsigned DEFAULT '0' NOT NULL,

	teaser_image                   int(11) unsigned DEFAULT '0' NOT NULL,
	main_image                     int(11) unsigned DEFAULT '0' NOT NULL,
	images                         varchar(255) DEFAULT ''        NOT NULL,

	download                       int(11) unsigned DEFAULT '0' NOT NULL,
	downloads                      varchar(255) DEFAULT ''        NOT NULL,
	data_sheets                    varchar(255) DEFAULT ''        NOT NULL,

	media_files                    varchar(255) DEFAULT ''        NOT NULL,

	related_filterables            varchar(255) DEFAULT ''        NOT NULL,
	related_filterables_from       varchar(255) DEFAULT ''        NOT NULL,

	related_filterable_documents   varchar(255) DEFAULT ''        NOT NULL,
	related_filterable_products    varchar(255) DEFAULT ''        NOT NULL,

	related_filterable_accessories varchar(255) DEFAULT ''        NOT NULL,
	related_filterable_products2   varchar(255) DEFAULT ''        NOT NULL,

	content_elements               int(11) DEFAULT '0' NOT NULL,

	content_index                  longtext,
	content_index_tstamp           int(11) unsigned DEFAULT '0' NOT NULL,
	sys_language_uid               int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY                            parent (pid),
	KEY                            publish_date_year (publish_date_year),
	KEY                            record_type (record_type),
	KEY                            filters (filters, primary_filter1, primary_filter2, primary_filter3, primary_filter4, primary_filter5),
	KEY                            sys_language (l10n_parent,sys_language_uid),
	KEY                            deleted_hidden (deleted, hidden),
	KEY                            sys_language_uid (sys_language_uid),
	FULLTEXT KEY `content_index` (`content_index`)
);


CREATE TABLE tx_catsearch_domain_model_filtertype
(
	uid              int(11) NOT NULL auto_increment,

	title            varchar(255) DEFAULT '' NOT NULL,
	title_long       varchar(255) DEFAULT '' NOT NULL,
	filters          int(11) unsigned DEFAULT '0',

	sys_language_uid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY              parent (pid),
	KEY language (l10n_parent,sys_language_uid)
);


CREATE TABLE tx_catsearch_domain_model_filter
(
	uid         int(11) NOT NULL auto_increment,

	title       varchar(255) DEFAULT '' NOT NULL,
	title_long  varchar(255) DEFAULT '' NOT NULL,

	type        int(11) unsigned DEFAULT '0',
	filterables int(11) unsigned DEFAULT '0',

	PRIMARY KEY (uid),
	KEY         parent (pid),
	KEY language (l10n_parent,sys_language_uid)
);


CREATE TABLE tx_catsearch_domain_model_manufacturer
(
	uid        int(11) NOT NULL auto_increment,

	title      varchar(255) DEFAULT '' NOT NULL,
	title_long varchar(255) DEFAULT '' NOT NULL,

	image      int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY        parent (pid),
	KEY language (l10n_parent,sys_language_uid)
);
