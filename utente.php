<?php
session_start();
$title = "Area personale";
include('header.php');
echo $_SESSION['is_admin'];


if ($_SESSION['is_admin'] == 0) {
  echo "pagina user";
  include('homepage_user.php');
} else {
  echo "pagina admin";
  include('homepage_admin.php');
}




include('footer.php');
