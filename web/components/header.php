<?php
require_once '../../core/App.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
  try {
    foreach ($app->linksAndScripts["head"] as $url) {
      echo $url;
    }
  } catch (Exception $e) {
    echo 'Exception:' . $e->getMessage();
  }
  ?>
  <title>UDMS-home</title>
</head>

<body class="bg-light">
  <!-- header start -->
  <!-- header / navbars -->
  <header>
    <nav class="offcanvas offcanvas-start d-lg-block bg-white border-0 rounded py-2 side-navbar" tabindex="-1" id="sideNavbar" aria-labelledby="SideNavbarLabel" data-mdb-backdrop="false">
      <!-- navbar header -->
      <div class="container logo">
        <!-- UDMS brand logo -->
        <div class="border-gradient d-flex p-1 p-lg-2 shadow rounded-3">
          <div class="bg-white d-flex w-100 justify-content-center rounded-1">
            <p class="m-auto">
              <span class="fs-2"><span class="text-medium-yellow">U</span><span class="text-medium-green">D</span><span class="text-solid-blue">M</span></span><span class="text-light-blue">S</span></span>
            </p>
          </div>
        </div>
      </div>
      <!-- navbar buttons  -->
      <div class="container pt-2 position-relative">
        <!-- sideNavbarButton -->
        <a href="home.php" class="btn mt-3 side-navbar-button current-page-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                    <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                    <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Dashboard </span>
            </div>
          </div>
        </a>

        <!-- sideNavbarButton -->
        <a href="activities.php" class="btn mt-3 side-navbar-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded shadow">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
                    <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Activities </span>
            </div>
          </div>
        </a>

        <!-- sideNavbarButton -->
        <a href="intore.php" class="btn mt-3 side-navbar-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded shadow">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Intore </span>
            </div>
          </div>
        </a>

        <!-- sideNavbarButton -->
        <a href="calendar.php" class="btn mt-3 side-navbar-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded shadow">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zM2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Calendar </span>
            </div>
          </div>
        </a>

        <!-- sideNavbarButton -->
        <a href="reports.php" class="btn mt-3 side-navbar-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded shadow">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                    <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Reports </span>
            </div>
          </div>
        </a>

        <!-- sideNavbarButton -->
        <a href="settings.php" class="btn mt-3 side-navbar-button d-flex p-0 rounded">
          <div class="col-12">
            <div class="d-flex align-items-center">
              <div class="p-2 rounded shadow">
                <span class="navbar-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                  </svg>
                </span>
              </div>
              <span class="ps-3 fs-5 d-flex"> Settings </span>
            </div>
          </div>
        </a>
      </div>
      <!-- navbar footer -->
      <div class="container position-absolute bottom-0 mb-2">
        <div class="position-relative bg-gradient-1 rounded">
          <!-- <div
              class="help-header py-1 px-4 rounded bg-solid-yellow position-absolute start-50 translate-middle"
            >
              <p class="text-white fs-5 m-0">Help</p>
            </div> -->
          <div class="text-center px-4 px-lg-5 pt-4 pb-4">
            <p class="text-white mb-0 mt-3">Contact the support team</p>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- main -->
  <main class="px-3">
    <!-- top navbar -->
    <nav class="navbar navbar-expand-lg bg-white rounded py-1 mt-2">
      <div class="container-fluid p-1">
        <div class="col-1 col-lg-2">
          <button class="navbar-toggler bg-none p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNavbar" aria-controls="sideNavbarOffcanvas">
            <span class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
              </svg>
            </span>
          </button>
          <div class="d-none d-lg-block">
            <span class="navbar-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
              </svg>
            </span>
            <span class="">Home</span>
          </div>
        </div>
        <div class="col-9 col-lg-7">
          <form class="container-fluid pe-1">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
              </span>
              <input type="text" class="form-control" placeholder="Quick search" aria-label="Quick search" aria-describedby="basic-addon1" />
            </div>
          </form>
        </div>
        <div class="col-2 col-lg-3">
          <div class="d-flex justify-content-end">
            <div class="px-lg-1">
              <img src="../../depository/profilePictures/9334183.jpg" class="profile-picture rounded-circle" alt="profile picture" />
            </div>
            <div class="d-none d-lg-block">
              <p class="m-0">Ndayishimiye</p>
              <p class="m-0">Emile</p>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <section class="mt-3 rounded d-flex justify-content-between align-items-center">
      <p class="m-0 fs-7 fw-light">
        Inkomezabogwi ikiciro cya 11 / <span>Kimisagara</span>
      </p>
      <button class="btn btn-sm btn-info border-0 shadow-sm bg-light-green">
        +Register Intore
      </button>
    </section>
    <!-- content start -->