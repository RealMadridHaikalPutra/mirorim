<?php

require '../assets/php/function.php';

if(isset($_GET['ids'])){
  $ambilsku = $_GET['ids'];
  $mainsku = mysqli_query($koneksi, "UPDATE exititem SET readmsg=1 WHERE skutoko='$ambilsku'");
}

if(isset($_GET['ids'])){
  $ambilsku = $_GET['ids'];
  $mainsku = mysqli_query($koneksi, "UPDATE updateitem SET readmsg=1 WHERE skutoko='$ambilsku'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MIRORIM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
      <style>
        .zoomable {
      width: 100px;
      }

       .zoomable:hover {
      transform: scale(3);
      transition: 0.3s ease;
      }

        .gambar {
          width: 250px;
        }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">MIRORIM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">
        <?php

          $getnumber = mysqli_query($koneksi, "SELECT * FROM updateitem WHERE readmsg='0'");
          $hitungnumber = mysqli_num_rows($getnumber);

        ?>
        <?php

          $getnumberex = mysqli_query($koneksi, "SELECT * FROM exititem WHERE readmsg='0'");
          $hitungnumberex = mysqli_num_rows($getnumberex);

        ?>

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?=$hitungnumber+$hitungnumberex;?></span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <?php
                  $getmsg = mysqli_query($koneksi, "SELECT * FROM updateitem INNER JOIN exititem ON updateitem.readmsg = exititem.readmsg");
                  while($data  =mysqli_fetch_assoc($getmsg)){
                    $skut = $data['skutoko'];
                    $id = $data['idstok'];
                  }
                  ?>
            <li class="dropdown-header">
              You have <?=$hitungnumber+$hitungnumberex;?> new notifications
              <a href="gudang.php?ids=<?=$id;?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Close</span></a>
            </li>
            
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php

                  $getmsg = mysqli_query($koneksi, "SELECT * FROM updateitem WHERE readmsg='0'");
                  if(mysqli_num_rows($getmsg)>0);
                  while($data  =mysqli_fetch_assoc($getmsg)){
                      $skut = $data['skutoko'];
                      $quantity = $data['quantityup'];
                      $id = $data['idstok'];
                  ?>
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <p><a href="updatebarang.php?id=<?=$skut;?>">SKU <?=$skut;?> Telah di Update</a></p>
                <p><?=$quantity;?></p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php
              }
            ?>
            <?php

                $getmsg = mysqli_query($koneksi, "SELECT * FROM exititem WHERE readmsg='0'");
                if(mysqli_num_rows($getmsg)>0);
                while($data  =mysqli_fetch_assoc($getmsg)){
                    $skut = $data['skutoko'];
                    $quantity = $data['quantityx'];
                    $id = $data['idstok'];
            ?>
              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                      <p><a href="barangkeluar.php?idx=<?=$id;?>">SKU <?=$skut;?> Telah Berkurang</a></p>
                      <p><?=$quantity;?></p>
                    </div>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php
              }
            ?>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-bank"></i><span>All Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            <li>
                <a href="gudang.php"  class="active">
                  <i class="bi bi-circle"></i><span>Warehouse</span>
                </a>
              </li>
              <li>
                <a href="gudang5.php">
                  <i class="bi bi-circle"></i><span>Warehouse 5</span>
                </a>
              </li>
              <li>
                <a href="toko.php">
                  <i class="bi bi-circle"></i><span>Store</span>
                </a>
              </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-arrow-left-right"></i><span>Transmigration</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="updatebarang.php">
              <i class="bi bi-circle"></i><span>Update Item</span>
            </a>
          </li>
          <li>
            <a href="barangkeluar.php">
              <i class="bi bi-circle"></i><span>Exit Item</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <!--F.A.Q-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.php">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Warehouse</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Warehouse</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
  
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                    <h5>Stock Warehouse</h5>
                    <a class="btn btn-outline-primary" type="button" href="baru.php">
                      Add New
                    </a>
                    <a class="btn btn-outline-primary" type="button" href="update.php">
                      Update Item
                    </a>
                    <a class="btn btn-outline-primary" type="button" href="exit.php">
                      Exit Item
                    </a>
                </div>
              <!-- Table with hoverable rows -->
              
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">SKU Store</th>
                    <th scope="col">SKU Warehouse</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <?php 
                    $ambildata = mysqli_query($koneksi, "SELECT * FROM stok where gudang <> 5");
                    $i = 1;
                    while($data=mysqli_fetch_array($ambildata)){
                      $idb = $data['idstok'];
                      $nama = $data['nama'];
                      $skut = $data['skutoko'];
                      $skug = $data['skugudang'];
                      $gudang = $data['gudang'];
                      $quantity = $data['quantity'];

                      //cek data gambar ada apa kagak
                      $gambar = $data['image'];
                      if($gambar==null){
                        // jika tidak ada gambar
                        $img = '<img src="../assets/img/noimageavailable.png" class="zoomable">';
                      } else {
                        //jika ada gambar
                        $img ='<img src="../images/'.$gambar.'" class="zoomable">';
                      }

                      //cek data gambar ada apa kagak
                      $gambar = $data['image'];
                      if($gambar==null){
                        // jika tidak ada gambar
                        $imgx = '<img src="../assets/img/noimageavailable.png" class="gambar">';
                      } else {
                        //jika ada gambar
                        $imgx ='<img src="../images/'.$gambar.'" class="gambar">';
                      }


                  ?>
                <tbody data-bs-toggle="modal" data-bs-target="#largeModal<?=$idb;?>">
                  
                  <tr>
                    <th scope="row"><?=$i++;?></th>
                    <td><?=$img;?></td>
                    <td><?=$nama;?></td>
                    <td class="text-uppercase"><?=$skut;?></td>
                    <td class="text-uppercase"><?=$skug;?></td>
                    <td><?=$gudang;?></td>
                    <td><?=$quantity;?></td>
                  </tr>
                  <!--Modal-->
                <div class="modal fade" id="largeModal<?=$idb;?>" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                        <!-- Floating Labels Form -->
                      <form method="post" class="row g-3" enctype="multipart/form-data">   
                      <div class="modal-body">
                              <div class="col-sm-12">
                                <label><?=$imgx;?></label>
                                <div class="form-floating">
                                  <input type="file" name="file" class="form-control" id="floatingName">
                                </div>
                              </div>
                              <br>
                              <div class="col-sm-12">
                                <label>Item Name</label>
                                <div class="form-floating">
                                  <input type="text" name="nama" class="form-control"  value="<?=$nama;?>" id="floatingName" placeholder="SKU Store">
                                  <label for="floatingName"></label>
                                </div>
                              </div>
                              <br>
                              <input type="hidden" class="form-control text-uppercase" id="floatingName" name="skutoko" value="<?=$skut;?>" placeholder="SKU Warehouse">
                              <div class="col-sm-12">
                                <label>SKU Warehouse</label>
                                <div class="form-floating">
                                  <input type="text" class="form-control text-uppercase" id="floatingName" value="<?=$skug;?>" name="skugudang" placeholder="SKU Warehouse">
                                  <label for="floatingName" class="text-uppercase"></label>
                                </div>
                              </div>
                              <br>
                              <div class="col-sm-12">
                                <label>Warehouse</label>
                                <div class="form-floating">
                                  <input type="number" class="form-control text-uppercase" id="floatingName" value="<?=$gudang;?>" name="gudang" placeholder="arehouse">
                                  <label for="floatingName"></label>
                                </div>
                              </div>
                              <br>
                              <div class="col-sm-12">
                                <label>Quantity</label>
                                <div class="form-floating">
                                  <input type="number" class="form-control text-uppercase" value="<?=$quantity;?>" id="floatingName" name="quantity" placeholder="Quantity">
                                  <label for="floatingName"></label>
                                </div>
                              </div>
                              <br>
                              <div class="text-center">
                                <button type="submit" name="editaja" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                              </div> 
                      </div>
                      </form>
                        <!-- End floating Labels Form -->
                    </div>
                  </div>
                </div>
                <?php
                  };
                ?>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
    </div>
  </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><a href="https://instagram.com/mxdrxds">Madrid</a></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  

</body>

</html>