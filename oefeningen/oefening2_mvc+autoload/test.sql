Create Database testDatabase;
Create Table test(
    id int auto_increment not null,
    t1 varchar(45),
    primary_key(id),
);

insert into test (t1)
    Values ('test database')
