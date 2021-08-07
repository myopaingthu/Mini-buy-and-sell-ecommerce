<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Admin - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="csrf-token" content="{{csrf_token()}}">
        
        <link href="{{asset('admin/main.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

        {{-- Cusom css --}}
        @yield('css')
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            @include('admin.layouts.navigation')        
                    <div class="app-main">
                        @include('admin.layouts.sidebar')    
                    <div class="app-main__outer">
                        <div class="app-main__inner">
                            @yield('content')
                        </div>
                        <div class="app-wrapper-footer">
                            <div class="app-footer">
                                <div class="app-footer__inner">
                                    <div class="app-footer-left">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    Second Boutique @2021
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="app-footer-right">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    Developed by Myo Paing Thu
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </div>
        </div>
                <script type="text/javascript" src="{{asset('admin/assets/scripts/main.js')}}"></script>
                <script>
                    $(document).ready(function(){
                        let token = document.head.querySelector('meta[name="csrf-token"]');
                        if (token) {
                            $.ajaxSetup({
                                headers : {
                                    'X-CSRF_TOKEN' : token.content
                                }
                            });
                        }

                        $(".back-btn").click(function (){
                            window.history.back();
                            });
                        
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        @if (session('success'))
                        Toast.fire({
                            icon: 'success',
                            title: "{{session('success')}}"
                        });
                        @endif
                    });  
                </script>    
                @yield('script')
            
    </body>
</html>
