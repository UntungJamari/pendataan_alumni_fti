<?php

session_start();

if ($_SESSION['role'] != "Admin") {
    header("location:../");
}

echo $_SESSION['nip'] . $_SESSION['role'] . $_SESSION['nama'];
