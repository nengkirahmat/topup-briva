<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords"
        content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/icon/192x192.png">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="manifest" href="__manifest.json">
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="./assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="./assets/img/logo.png" alt="logo" class="logo">
        </div>

    </div>
    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Balance</span>
                        <h1 class="total">Rp. {{ number_format(auth()->user()->customer->saldo, 0, ",", ".") }}</h1>
                    </div>
                    {{-- <div class="right">
                        <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                            <ion-icon name="add-outline"></ion-icon>
                        </a>
                    </div> --}}
                </div>

            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TopUp</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="form-topup" method="post">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">To</label>
                                        <select class="form-control custom-select" name="va" id="va">
                                            @foreach ($va as $va)
                                                <option value="{{ $va->no_va }}">Virtual Account
                                                    ({{ $va->no_va }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addona1">Rp. </span>
                                        <input type="text" class="form-control" readonly name="amountLabel" id="amountLabel"
                                            placeholder="Enter an amount" value="100">
                                        <input type="hidden" class="form-control" name="amount" id="amount"
                                            placeholder="Enter an amount" value="100">
                                    </div>
                                </div>


                                <div class="form-group basic">
                                    <button type="button" class="btn btn-primary btn-block btn-lg"
                                        data-bs-dismiss="modal" id="topup">Deposit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet -->


        <div class="modal fade action-sheet" id="settingActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Setting</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="form-setting" action="{{route('update-user')}}" method="post">
                                @csrf
                                <div class="form-group basic">
                                    <label class="label">Nama Lengkap</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="name" id="name" value="{{auth()->user()->name}}"
                                            placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="divider">
                                    <span class="text-info">Kosongkan Jika Tidak Merubah Password</span>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">New Password</label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" name="password1" id="password1"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <label class="label">Retype Password</label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" name="password2" id="password2"
                                            placeholder="Retype Password">
                                    </div>
                                </div>


                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"
                                        data-bs-dismiss="modal" id="updateUser">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Value Topup -->
        <div class="section">
            <div class="row mt-2">
                @foreach ($harga as $harga)
                    <div class="col-6 mt-2">
                        <a href="javascript:void(0);" data-nilai="{{ $harga->harga }}" class="nilai"
                            data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                            <div class="stat-box">
                                <div class="title">TopUp</div>
                                <div class="value text-success">Rp. {{ number_format($harga->harga, 0, ',', '.') }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- * Stats -->

        <!-- Transactions -->
        <div class="section mt-4" id="history">
            <div class="section-heading">
                <h2 class="title">History TopUp</h2>
                {{-- <a href="app-transactions.html" class="link">View All</a> --}}
            </div>
            <div class="transactions mb-2" id="list-history">

            </div>
        </div>
        <!-- * Transactions -->









        <!-- app footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © {{ config('app.name') }} {{ date('Y') }}. All Rights Reserved.
            </div>
        </div>
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="javascript:void(0);" class="item" data-bs-toggle="modal" data-bs-target="#settingActionSheet">
            <div class="col">
                <ion-icon name="settings-outline"></ion-icon>
                <strong>Settings</strong>
            </div>
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="item">
            <div class="col">
                <ion-icon name="log-out-outline"></ion-icon>
                <strong>Logout</strong>
            </div>
        </a>
        
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <img src="./assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged  w36">
                        </div>
                        <div class="in">
                            <strong>{{ auth()->user()->name }}</strong>
                            <div class="text-muted"></div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
                    <!-- balance -->
                    <div class="sidebar-balance">
                        <div class="listview-title">Balance</div>
                        <div class="in">
                            <h1 class="amount">Rp. {{ number_format(auth()->user()->customer->saldo, 0, ",", ".") }}</h1>
                        </div>
                    </div>
                    <!-- * balance -->





                    <!-- others -->
                    <div class="listview-title mt-1">Others</div>
                    <ul class="listview flush transparent no-line image-listview">

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="item">

                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Log out
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>


                    </ul>
                    <!-- * others -->



                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            list_history();

            function list_history() {
                $("#list-history").load("{{ route('list-history') }}");
            }

            $(document).on("click", ".nilai", function() {
                let nilai = $(this).data("nilai");
                let rupiah = nilai;
                $("#amountLabel").val(format(rupiah));
                $("#amount").val(nilai);
                })

            $(document).on("click", "#topup", function() {
                let nilai = $("#amount").val();
                let va = $("#va").val();
                Swal.fire({
                    title: 'TopUp Rp. ' + format(nilai) + "?",
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            data: {
                                'nilai': nilai,
                                'no_va': va
                            },
                            url: "{{ route('topup') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                if (data.success == true) {
                                    list_history();
                                    Swal.fire(data.message,
                                        "Selamat Topup Telah Berhasil, Silahkan Melakukan Pembayaran Ke " +
                                        va);
                                } else {
                                    Swal.fire(data.message, '', 'error');
                                }
                            },
                            error: function(xhr) {
                                var res = xhr.responseJSON;
                                if ($.isEmptyObject(res) == false) {
                                    err = '';
                                    $.each(res.errors, function(key, value) {
                                        err += value + ', ';
                                    });
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('TopUp Dibatalkan', '', 'error')
                    }
                })
            })


            var format = function(num){
      var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
      if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
      }
      str = str.split("").reverse();
      for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
          output.push(str[j]);
          if(i%3 == 0 && j < (len - 1)) {
            output.push(".");
          }
          i++;
        }
      }
      formatted = output.reverse().join("");
      return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

        })
    </script>


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="./assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="./assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="./assets/js/base.js"></script>

    <script>
        // Add to Home with 2 seconds delay.
        AddtoHome("2000", "once");
    </script>

</body>

</html>
