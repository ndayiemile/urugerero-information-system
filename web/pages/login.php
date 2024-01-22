<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.2-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../libs/css/global.css" />
  <script src="../../libs/js/utils.js"></script>
  <script src="../../libs/js/global.js"></script>
  <script src="../../libs/js/login.js"></script>
</head>

<body style="
      background-color: rgba(0, 0, 0, 0.773);
      background-image: url('../../depository/backgrounds/download.jpeg');
      background-blend-mode: multiply;
      background-repeat:no-repeat;
      background-size:100vw 100vh;
    ">
  <section class="container p-3" style="height: 100vh">
    <div class="row justify-content-center p-3 h-100">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xlg-3 pt-5">
        <div class="mt-5">
          <form action="" method="post" class="rounded-4 p-3" style="background-color: rgba(255, 255, 255, 0.356)">
            <h3 class="text-center text-white m-0">
              <span>
                <span class="fs-2 p-0 m-0"><span class="text-medium-yellow">U</span><span class="text-medium-green">D</span><span class="text-solid-blue">M</span></span><span class="text-light-blue">S</span></span> Login
            </h3>
            <article class="bg-light p-3 rounded-4 mt-4">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                  </svg>
                </span>
                <input type="email" class="form-control" name="email" placeholder="user@host.domain" aria-label=email" aria-describedby="basic-addon1" />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                  </svg>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2" />
              </div>
              <button type="submit" class="btn btn-primary py-2 rounded-pill form-control" serverTargetFunction="userLogin">
                Login
              </button>
              <p class="m-0 mt-3 p-0"><span class="text-secondary">Forgot password?</span><br />Or <span class="text-secondary">Sinup</span></p>
              <!-- <p class="text-danger"><?php //var_dump($_COOKIE) ?></p> -->
              <!-- <p class="text-warning"><?php //var_dump($_SESSION) ?></p> -->
            </article>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>