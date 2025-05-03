<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <title>@yield('title', 'SB Admin 2')</title>

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/main/style.css') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    {{-- Font Nunito --}}
    <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    {{-- Font Montserrat --}}
    <link href="{{ asset('assets/css/css2.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
     <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
</head>
@stack('scripts')
@php
    $isMobile = preg_match('/(android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini)/i', request()->header('User-Agent'));
@endphp
<body id="page-top" class="{{ $isMobile ? 'sidebar-toggled' : '' }}">
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner-border text-primary preloader-spinner" role="status">
        </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

    @include('components.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
            @include('components.topbar')

                @yield('content')
            </div>

            @include('components.footer')

        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header position-relative">
                    <h5 class="modal-title" id="profileModalLabel">Profil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body text-center">
                    <!-- Tombol Hapus Gambar -->
                    <form action="{{ route('profile.deleteImage') }}" method="POST" class="d-inline position-absolute" style="top: 10px; right: 18px;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                    @php
                        $user = auth()->user();
                        $nama = $user->name;
                        $kode = '';

                        if ($user->role_id == '1') {
                            $nama = $user->name;
                        }

                        elseif ($user->role_id == '2') {
                            $siswa = \App\Models\Siswa::where('users_id', $user->id_users)->first();
                            if ($siswa) {
                                $nama = $siswa->nama;
                                $kode = 'NIS: ' . $siswa->nis;
                            }
                        }

                        elseif (in_array($user->role_id, ['3', '4', '5'])) {
                            $guru = \App\Models\Guru::where('users_id', $user->id_users)->first();
                            if ($guru) {
                                $nama = $guru->nama;
                                $kode = 'NIP: ' . $guru->nip;
                            }
                        }
                    @endphp

                    <!-- Foto Profil -->
                    <img id="avatarPreview"
                        src="{{ $user->gambar ? asset('assets/img/profil/' . $user->gambar) : asset('assets/img/no-avatar.png') }}"
                        class="rounded-circle mb-3 border border-secondary"
                        width="100" height="100"
                        alt="{{ $user->name }}">

                    <h5>{{ $nama }}</h5>
                    <p>{{ $kode }}</p>
                    @php
                        $roles = [
                            1 => 'Admin',
                            2 => 'Siswa',
                            3 => 'Guru',
                            4 => 'Bendahara',
                            5 => 'Kepala Sekolah'
                        ];
                    @endphp
                    <p>Status: {{ $roles[$user->role_id] }}</p>

                    <!-- Form Upload Gambar -->
                    <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-4"
                                    onclick="document.getElementById('avatar').click();">
                                <i class="fas fa-camera mr-2"></i> Ubah Foto Profil
                            </button>
                            <input type="file" name="avatar" id="avatar" class="d-none"
                                accept="image/*" onchange="previewAvatar(this)">

                            <input type="hidden" name="gambar_lama" value="{{ Auth::user()->gambar ?? '' }}">

                            <small class="text-muted d-block mt-2">
                                Format: jpg, png. Maks 2MB<span class="text-danger">*</span>
                            </small>                            
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin mau Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih “Logout” di bawah jika Anda siap mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/main/script.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Tambahkan ini di bawah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/npm/bootstrap.bundle.min.js') }}"></script>

    {{-- JS Select2 --}}
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        // Tidak bisa klik kanan
        // document.addEventListener('contextmenu', function(e) {
        //     e.preventDefault();
        // });
    </script>

    </body>

    </html>
