<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#0670f0">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- TITLE -->
    <title>NISPA-2024</title>

    <!-- DASHBOARD CSS -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />

    <!-- COLOR-THEMES CSS -->
    <link href="{{ asset('assets/css/color-themes.css') }}" rel="stylesheet" />

    <!-- Sidemenu css -->
    <link id="side" href="{{ asset('assets/plugins/side-menu/full-sidemenu.css') }}" rel="stylesheet" />

    <!-- Sidebar Accordions css -->
    <link href="{{ asset('assets/plugins/sidemenu-responsive-tabs/css/easy-responsive-tabs.css') }}" rel="stylesheet">

    <!-- Perfect scroll bar css-->
    <link href="{{ asset('assets/plugins/pscrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

    <!--C3.JS CHARTS PLUGIN -->
    <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

    <!-- TABS CSS -->
    <link href="{{ asset('assets/plugins/tabs/tabs-style2.css') }}" rel="stylesheet" type="text/css">

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="{{ asset('assets/plugins/mcustomscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- RIGHT-MENU CSS -->
    <link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

    <!-- LEFT-SIDEMENU CSS -->
    <link href="{{ asset('assets/plugins/jquery-jside-menu-master/css/jside-menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-jside-menu-master/css/jside-skins.css') }}" rel="stylesheet" />

    <!-- SELECT2 CSS -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- TIME PICKER CSS -->
    <link href="{{ asset('assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet" />

    <!-- DATE PICKER CSS -->
    <link href="{{ asset('assets/plugins/spectrum-date-picker/spectrum.css') }}" rel="stylesheet" />

    <!-- MULTI SELECT CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

    <!-- FILE UPLODES -->
    <link href="{{ asset('assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Data table css -->
    <link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

    <!-- TABS CSS -->
    <link href="{{ asset('assets/plugins/tabs/tabs-style2.css" rel="stylesheet') }}" type="text/css" />

    <!-- TABS STYLES -->
    <link href="{{ asset('assets/plugins/tabs/tabs-style.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" />

    <!-- TOASTR -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body class="app sidebar-mini rtl">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">

            <!-- Sidebar menu-->
            {{-- <navbar-component></navbar-component> --}}
            @include('admin.body.navbar', ['menuItems' => $menuItems])
            <!--sidemenu end-->

            <!-- app-content-->
            <div class="app-content  my-3 my-md-5">

                <!-- HEADER -->
                <!-- <header-component></header-component> -->
                <!-- HEADER END -->

                <!--Resposnisve Navbar-->
                {{-- <responsive-navbar></responsive-navbar> --}}
                @include('admin.body.responsive-navbar')
                <!--/Resposnisve Navbar-->

                @yield('admin')
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
    </div>

    <!-- MENU COMPONENT -->
    {{-- <script src="{{asset('assets/js/component.js')}}"></script> --}}

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>

    <!-- SPARKLINE -->
    <script src="{{ asset('assets/js/vendors/jquery.sparkline.min.js') }}"></script>

    <!-- CHART-CIRCLE -->
    <script src="{{ asset('assets/js/vendors/circle-progress.min.js') }}"></script>

    <!-- RATING STAR -->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!-- C3.JS CHART PLUGIN -->
    <script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>

    <!-- INPUT MASK PLUGIN-->
    <script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!--Side-menu js-->
    <script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}"></script>

    <!-- STICKY JS-->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/horizontal-sticky.js') }}"></script>

    <!-- Sidebar Accordions js -->
    <script src="{{ asset('assets/plugins/sidemenu-responsive-tabs/js/easyResponsiveTabs.js') }}"></script>

    <!-- Perfect scroll bar js-->
    <script src="{{ asset('assets/plugins/pscrollbar/perfect-scrollbar.js') }}"></script>

    <!-- CUSTOM SCROLL BAR JS-->
    <script src="{{ asset('assets/plugins/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- DATA TABLE -->
    <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script>
        $(function(e) {
            $('#example2').DataTable();
        });
    </script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- LEFT-SIDEMENU PLUGIN -->
    <script src="{{ asset('assets/plugins/jquery-jside-menu-master/js/jquery.jside.menu.js') }}"></script>

    <!-- RIGHT-MENU JS -->
    <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

    <!-- CUSTOM JS-->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- LEFT-SIDEMENU PLUGIN -->
    <script src="{{ asset('assets/plugins/jquery-jside-menu-master/js/jquery.jside.menu.js') }}"></script>

    <!-- MULTI SELECT JS-->
    <script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

    <!-- Left CUSTOM JS-->
    <script src="{{ asset('assets/js/left-custom.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!--- TABS JS -->
    <script src="{{ asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ asset('assets/plugins/tabs/tab-content.js') }}"></script>

    <!-- TOASTR -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var provinceSelect = document.getElementById('provinceSelect');
            var ampherSelect = document.getElementById('ampherSelect');

            provinceSelect.addEventListener('change', function() {
                console.log('1234');
                // var provinceId = this.value;
                // fetch('/get-amphurs/' + provinceId)
                //     .then(response => response.json())
                //     .then(data => {
                //         ampherSelect.innerHTML = ''; // Clear previous options
                //         data.forEach(function(amp) {
                //             var option = document.createElement('option');
                //             option.value = amp.AMP_ID;
                //             option.textContent = amp.AMP_NAME;
                //             ampherSelect.appendChild(option);
                //         });
                //     })
                //     .catch(error => console.error('Error fetching amphurs:', error));
            });
        });
    </script>
    <script>
        function formatText(icon) {
            return $('<span><i class="side-menu__icon typcn ' + $(icon.element).data('icon') + '"></i> ' + icon.text +
                '</span>');
        };

        $('.select2-icon').select2({
            width: "100%",
            templateSelection: formatText,
            templateResult: formatText
        });

        $(".js-example-tags").select2({
            width: "100%",
            tags: true,
        });

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
