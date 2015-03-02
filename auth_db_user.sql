create database auth;

create auth_admin identified by 'rootakses';

grant all on auth.* to 'auth_admin'@'localhost';

