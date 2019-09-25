<?php
if (!file_exists('db/users')) {
    mkdir('db/users', 0755);
}
file_put_contents("admin/users/gheram", hash('whirlpool', "admin"));
file_put_contents("admin/users/cedric", hash('whirlpool', "admin"));

?>
