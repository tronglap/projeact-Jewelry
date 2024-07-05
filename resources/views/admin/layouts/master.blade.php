<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="{{ asset('assets/admin/images/logo/favicon.png') }}" type="image/x-icon">

        <!-- Custom fonts for this template-->
        <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
            type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('admin.blocks.sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <!-- This is header  -->
                    @include('admin.blocks.topbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('admin.blocks.footer')
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button Start-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Scroll to Top Button End-->

        <!-- Logout Modal Start-->
        <!-- Đây là pop-up xác nhận bạn có muốn đăng xuất hay không -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="btn btn-primary"
                                onclick="event.preventDefault();
                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logout Modal End-->


        <!-- Bootstrap core JavaScript-->
        <script type="text/javascript" src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/admin/addClassActive.js') }}"></script>


        <!-- Core plugin JavaScript-->
        <script type="text/javascript" src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script type="text/javascript" src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script type="text/javascript" src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script type="text/javascript" src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/demo/chart-pie-demo.js') }}"></script>
        <script type="text/javascript" src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        @yield('script')


    </body>

</html>
