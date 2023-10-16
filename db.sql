--
-- dbname: games
--

create table users(
    id integer not null primary key auto_increment,
    username varchar(100),
    email varchar(100),
    password varchar(100),
    role varchar(100),
    token varchar(100)
);

create table games(
    id integer not null primary key auto_increment,
    image varchar(100),
    name varchar(100),
    description varchar(100),
    price varchar(100),
    platforms varchar(100),
    release_date varchar(100),
    game_producer varchar(100),
    classification varchar(100),
    user_id varchar(100),
    slug varchar(100)
);

insert into games(name, description) values ('fasterbill', 'https://licoesautenticas.rj.r.appspot.com/tutoriais/5/fasterbill.htm');
