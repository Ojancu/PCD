<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Start page</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper p-0" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="card auth-card mb-0 mx-3">
          <div class="card-body">
            <!-- <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
              <img src="assets/images/logos/dark-logo.svg" width="180" alt="">
            </a> -->
              <div class="d-flex align-items-center justify-content-center">
                <!-- <p class="fs-4 mb-0 fw-bold">Start?</p> -->
                <a class="text-primary fw-bold ms-2 mb-0" href="{{ url('/bg_removal') }}">Start</a>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>