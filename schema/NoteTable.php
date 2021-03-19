create table note(
id int not null auto_increment primary key,
category_id  int,
label  int DEFAULT 0,
note_data text,
old_data text,
change_count int,
reg_time timestamp
);