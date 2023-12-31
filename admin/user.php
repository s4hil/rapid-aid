<?php
    include 'loginCheck.php';
    if(!isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] != true)  {
      die("Unauthorized");
    }
    class myDB extends SQLite3
    {
      
      function __construct()
      {
        $this->open("../api/db.sqlite");
      }
    }

    $db = new myDB();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RapidAid - Admin</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <link rel="icon" href="favicon.png">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./dashboard.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">ADMIN</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./hospital.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Hospitals</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./user.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">User</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./driver.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Driver</span>
              </a>
            </li>
            <li class="sidebar-item ">
              <a class="sidebar-link" href="?logout" aria-expanded="false">
                <span >
                  <i class="ti ti-power"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
              <?php
                if (isset($_GET['logout'])) {
                    session_destroy();
                    header('location: index.php');
                }
              ?>
            </li> 
          </ul>  
        </nav>
        <!-- End Sidebar navigation -->
      
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
           
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                   
                    
                    <a href="./authentication-login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <style>
            .table-striped th h6 {
                color: #fff;
            }
        </style>
          <table class="table text-nowrap mb-0 align-middle table-striped">
            <thead class="text-white fs-4 table-dark">
              <tr class="text-white">
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Id</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Name</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Coordinates</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Phone</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Action</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php

              $sql = "SELECT * FROM `_users`";
              $res = $db->query($sql);
              if ($res) {
                while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                ?>
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['id']; ?></h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1"><?php echo $row['name']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?php echo $row['coordinates']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?php echo $row['phone']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                        <a href="?del&userID=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                  </tr> 

                  <?php
                }
              }

              ?>
              <?php
                if (isset($_GET['del'])) {
                    $id = $_GET['userID'];
                    $sql = "DELETE FROM `_users` WHERE id=$id";
                    $res = $db->exec($sql);
                    if ($res) {
                        ?>
                            <script>
                                window.location = "user.php";
                            </script>
                        <?php
                    }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>