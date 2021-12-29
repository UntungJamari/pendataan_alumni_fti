<?php

session_start();

if ($_SESSION['role'] != "User_Alumni") {
    header("location:../");
}

$koneksi = mysqli_connect("localhost", "root", "", "pendataan_alumni_fti");

if (isset($_POST['edit_profile'])) {
    if (empty($_POST["nip"]) || empty($_POST["nama"]) || empty($_POST["jenis_kelamin"])) {
        $gagal = "Isian Tidak Boleh Kosong!!!";
    } else {
        $nim = $_POST['nip'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST["jenis_kelamin"];

        $query2 = mysqli_query($koneksi, "update alumni set nama='$nama', jenis_kelamin='$jenis_kelamin' where nim='$nim'");
        if ($query2) {
            $berhasil = "Berhasil Mengubah Profil!!!";
        } else {
            $gagal = "Gagal Mengubah Profil!!!";
        }

        $instansi = $_POST['instansi'];

        $query = mysqli_query($koneksi, "update alumni set instansi='$instansi' where nim='$nim'");

        $jabatan = $_POST['jabatan'];

        $query = mysqli_query($koneksi, "update alumni set jabatan='$jabatan' where nim='$nim'");

        $ipk = $_POST['ipk'];

        $query = mysqli_query($koneksi, "update alumni set ipk='$ipk' where nim='$nim'");

        if ($query) {
            $berhasil = "Berhasil Mengubah Profil!!!";
        } else {
            $gagal = "IPK Tidak Valid!!!";
        }

        $image = $_FILES['foto']['name'];

        if (!empty($image)) {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $image = $_FILES['foto']['name'];
            $x = explode('.', $image);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 1044070) {
                    move_uploaded_file($file_tmp, '../assets/img/faces/' . $image);
                    $query = mysqli_query($koneksi, "update alumni set foto='$image' where nim='$nim';");
                    if ($query) {
                        $berhasil = "Foto Berhasil Diubah";

                        $_SESSION['foto'] = $image;
                    } else {
                        $gagal = "Foto Gagal Diubah";
                    }
                } else {
                    $gagal = "Foto Gagal Diubah, Ukuran File Gambar Terlalu Besar";
                }
            } else {
                $gagal = "Foto Gagal Diubah, Ekstensi File Gambar Tidak Diperbolehkan";
            }
        }
    }
    $_GET['nim'] = $nim;
}

if (isset($_POST['tambah_organisasi'])) {
    if (empty($_POST["nama_organisasi"]) || empty($_POST["jabatan"])) {
        $gagalo = "Isian Tidak Boleh Kosong!!!";
    } else {
        $nama_organisasi = $_POST['nama_organisasi'];
        $jabatan = $_POST['jabatan'];
        $nim = $_POST['nim'];

        $query = mysqli_query($koneksi, "insert into riwayat_organisasi (nim, nama_organisasi, jabatan) values ('$nim', '$nama_organisasi', '$jabatan')");
        if ($query) {
            $berhasilo = "Berhasil Menambahkan Data";
        } else {
            $gagalo = "Gagal Menambahkan Data";
        }
    }
}

if (isset($_GET['hapusno'])) {
    $no = $_GET['hapusno'];
    $nim = $_GET['hapusnim'];

    $query = mysqli_query($koneksi, "delete from riwayat_organisasi where no = $no and nim=$nim");
    if ($query) {
        $berhasilo = "Berhasil Menghapus Data";
    } else {
        $gagalo = "Gagal Menghapus Data";
    }
}

if (isset($_POST['tambah_sosmed'])) {
    if (empty($_POST["kode_sosial_media"]) || empty($_POST["username"])) {
        $gagals = "Isian Tidak Boleh Kosong!!!";
    } else {
        $kode_sosial_media = $_POST['kode_sosial_media'];
        $username = $_POST['username'];
        $nim = $_POST['nim'];

        $query = mysqli_query($koneksi, "insert into alumni_sosial_media values ('$nim', '$kode_sosial_media', '$username')");
        if ($query) {
            $berhasils = "Berhasil Menambahkan Data";
        } else {
            $gagals = "Gagal Menambahkan Data";
        }
    }
}

if (isset($_GET['hapussm'])) {
    $kode_sosial_media = $_GET['hapussm'];
    $nim = $_GET['hapusnim'];

    $query = mysqli_query($koneksi, "delete from alumni_sosial_media where kode_sosial_media = $kode_sosial_media and nim=$nim");
    if ($query) {
        $berhasils = "Berhasil Menghapus Data";
    } else {
        $gagals = "Gagal Menghapus Data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo_unand.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Edit Profile
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="javascript:void(0)" class="simple-text logo-normal">
                    Pendataan Alumni FTI
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./data_alumni.php">
                            <i class="material-icons">person</i>
                            <p>Alumni</p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="./data_mahasiswa.php">
                            <i class="material-icons">school</i>
                            <p>Mahasiswa</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./edit_profile.php">
                            <i class="material-icons">manage_accounts</i>
                            <p>Profile</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:void(0)">Profile</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i><img src="../assets/img/faces/<?php echo $_SESSION['foto']; ?>" style="width: 25px; height: 25px; border-radius: 30px;"></i>
                                    <p class="d-lg-none d-md-block">
                                        <?php
                                        echo $_SESSION['nama'];
                                        ?>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../autentikasi/logout.php" onclick="return confirm('Anda Akan Log Out')">
                                    <i class="material-icons">logout</i>
                                    <p class="d-lg-none d-md-block">
                                        Log Out
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title"> Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($gagal)) {
                                    ?>
                                        <p class="text-danger pull-middle"><?php echo $gagal; ?></p>
                                    <?php
                                    }
                                    if (isset($berhasil)) {
                                    ?>
                                        <p class="text-success pull-middle"><?php echo $berhasil; ?></p>
                                    <?php
                                    }

                                    $nim = $_SESSION['nim'];
                                    $query = mysqli_query($koneksi, "select * from alumni WHERE nim = '$nim'");
                                    $result = mysqli_fetch_assoc($query);
                                    ?>
                                    <form method="POST" action="editt_profile.php" enctype="multipart/form-data">
                                        <div class="row mt-5">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">NIP</label>
                                                    <input type="text" class="form-control" value="<?php echo $result['nim']; ?>" disabled>
                                                    <input type="hidden" class="form-control" name="nip" value="<?php echo $result['nim']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Nama</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $result['nama']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Instansi</label>
                                                    <input type="text" class="form-control" name="instansi" value="<?php echo $result['instansi']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Jabatan</label>
                                                    <input type="text" class="form-control" name="jabatan" value="<?php echo $result['jabatan']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">IPK</label>
                                                    <input type="text" class="form-control" name="ipk" value="<?php echo $result['ipk']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select class="custom-select mt-2" aria-label="Default select example" name="jenis_kelamin">
                                                        <?php

                                                        if ($result['jenis_kelamin'] == 'Laki-laki') {
                                                        ?>
                                                            <option value="Laki-laki" selected>Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan" selected>Perempuan</option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="formFile" class="form-label">Ganti Foto</label>
                                                <input class="form-control" type="file" name="foto">
                                                <p style="font-size: 12px; color: #8f8f8f;">*ukuran file maksimal 1 mb dan format file : .jpg, .jpeg, .png</p>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right mt-5" name="edit_profile">Simpan</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title"> Edit Riwayat Organisasi</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($gagalo)) {
                                    ?>
                                        <p class="text-danger pull-middle"><?php echo $gagalo; ?></p>
                                    <?php
                                    }
                                    if (isset($berhasilo)) {
                                    ?>
                                        <p class="text-success pull-middle"><?php echo $berhasilo; ?></p>
                                    <?php
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="example">
                                            <thead class=" text-primary">
                                                <th>Nama Organisasi</th>
                                                <th>Jabatan</th>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $query = mysqli_query($koneksi, "select * from riwayat_organisasi where nim = $nim");

                                                while ($tampil = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $tampil['nama_organisasi']; ?></td>
                                                        <td><?php echo $tampil['jabatan']; ?></td>
                                                        <td><a class="btn btn-danger pull-middle btn-sm" href="./editt_profile.php?hapusno=<?php echo $tampil['no']; ?>&hapusnim=<?php echo $tampil['nim']; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini? semua data yang berkaitan akan hilang!!')"><i class="material-icons">delete</i></a></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <form action="editt_profile.php" method="POST">
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">Nama Organisasi</label>
                                                                        <input type="text" class="form-control" name="nama_organisasi">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="bmd-label-floating">Jabatan</label>
                                                                        <input type="text" class="form-control" name="jabatan">
                                                                        <input type="hidden" class="form-control" name="nim" value="<?php echo $nim; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary pull-right" name="tambah_organisasi">Simpan</button>
                                                        </td>
                                                    </tr>
                                                </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title"> Sosial Media</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($gagals)) {
                                    ?>
                                        <p class="text-danger pull-middle"><?php echo $gagals; ?></p>
                                    <?php
                                    }
                                    if (isset($berhasils)) {
                                    ?>
                                        <p class="text-success pull-middle"><?php echo $berhasils; ?></p>
                                    <?php
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="example" style="width: 98%;">
                                            <thead class=" text-primary">
                                                <th>Sosial Media</th>
                                                <th>Username</th>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $query = mysqli_query($koneksi, "select * from sosial_media, alumni_sosial_media where sosial_media.kode_sosial_media = alumni_sosial_media.kode_sosial_media and alumni_sosial_media.nim = $nim");

                                                while ($tampil = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><img src="../assets/img/<?php echo $tampil['nama_sosial_media'] . ".png"; ?>" style="width: 20%; height: 20%; border-radius: 30px;"></td>
                                                        <td><?php echo $tampil['username']; ?></td>
                                                        <td><a class="btn btn-danger pull-middle btn-sm" href="./editt_profile.php?hapussm=<?php echo $tampil['kode_sosial_media']; ?>&hapusnim=<?php echo $tampil['nim']; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini? semua data yang berkaitan akan hilang!!')"><i class="material-icons">delete</i></a></td>
                                                    </tr>
                                                <?php
                                                }
                                                $query = mysqli_query($koneksi, "select * from sosial_media where kode_sosial_media not in(select kode_sosial_media from alumni_sosial_media where nim=$nim)");
                                                if (mysqli_affected_rows($koneksi) != 0) {
                                                ?>
                                                    <form action="editt_profile.php" method="POST">
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Sosial Media</label>
                                                                            <select class="custom-select mt-2" aria-label="Default select example" name="kode_sosial_media">
                                                                                <option selected>----------------------</option>
                                                                                <?php


                                                                                while ($tampil = mysqli_fetch_array($query)) {
                                                                                ?>

                                                                                    <option value="<?php echo $tampil['kode_sosial_media']; ?>"><?php echo $tampil['nama_sosial_media']; ?></option>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="bmd-label-floating">Username</label>
                                                                            <input type="text" class="form-control" name="username">
                                                                            <input type="hidden" class="form-control" name="nim" value="<?php echo $nim; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-primary pull-right" name="tambah_sosmed">Simpan</button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-12">
                            <h5 class="text-center">
                                2021, made by Kelompok 9
                            </h5>
                        </div>
                    </div>
                </div>
            </footer>
            <script>
                const x = new Date().getFullYear();
                let date = document.getElementById('date');
                date.innerHTML = '&copy; ' + x + date.innerHTML;
            </script>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="https://unpkg.com/default-passive-events"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="../assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                    } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');

                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);

                });
            });
        });
    </script>
</body>

</html>