<?php

$connect = mysqli_connect('localhost', 'cms', '1234', 'cms_2');

if (mysqli_connect_errno()){
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>