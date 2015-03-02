create database bookorama;

create librarian identified by 'readmorebooks';

grant all on bookorama.* to 'librarian'@'localhost';
