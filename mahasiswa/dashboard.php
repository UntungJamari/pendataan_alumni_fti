<?php

session_start();

if ($_SESSION['role'] != "User_Mahasiswa") {
  header("location:../");
}

$koneksi = mysqli_connect("localhost", "root", "", "pendataan_alumni_fti");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo_unand.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard
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
          <li class="nav-item active">
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
          <li class="nav-item ">
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
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
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
              <li class=" nav-item">
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
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
              <h4 class="card-title text-center font-weight-bold">Alumni</h4>
              <p class="card-category">
              <h1 class="text-success text-center font-weight-bold">
                <?php

                $query = mysqli_query($koneksi, "SELECT COUNT(nim) as jumlah FROM alumni");
                $result = mysqli_fetch_assoc($query);
                echo $result['jumlah'];

                ?>
              </h1>
              </p>
            </div>
            <div class="col-md-5">
              <h4 class="card-title text-center font-weight-bold">Mahasiswa</h4>
              <p class="card-category">
              <h1 class="text-info text-center font-weight-bold">

                <?php

                $query = mysqli_query($koneksi, "SELECT COUNT(nim) as jumlah FROM mahasiswa");
                $result = mysqli_fetch_assoc($query);
                echo $result['jumlah'];

                ?>

              </h1>
              </p>
            </div>

            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                <div class="card">
                  <div class="card card-profile pull-middle">
                    <div class="card-avatar">
                      <a href="#">
                        <img class="img" src="../assets/img/Logo-Unand.png" />
                      </a>
                    </div>
                    <div class="card-header card-header-primary mt-3">
                      <h4 class="card-title">Sistem Informasi Pendataan Alumni FTI UNAND</h4>
                    </div>
                    <div class="card-body table-responsive">
                      <table class="table table-hover">
                        <thead class="text-warning">
                          Sistem Informasi Pendataan Alumni Fakultas Teknologi Informasi Universitas Andalas ini dibuat dengan tujuan untuk memudahkan alumni melakukan pendataan agar menjadi terstruktur serta lebih efektif dan efisien. Sistem ini juga bermanfaat bagi mahasiswa yang masih berkuliah, seperti untuk menambah relasi, sebagai referensi tugas akhir dan mencari pekerjaan.
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
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
          <script>
            $(document).ready(function() {
              // Javascript method's body can be found in assets/js/demos.js
              md.initDashboardPageCharts();

            });
          </script>
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
</body>

</html>