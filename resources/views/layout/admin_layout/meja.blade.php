@extends('layout.main_layout.main')
@section('style')
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            padding: 0.46875rem 0.75rem;
            height: calc(2.25rem + 2px);
        }

        textarea {
            resize: none;
            overflow: hidden;
            min-height: 150px;
            max-height: 250px;
        }

        td {
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        #qr .card {
            width: 190px;
            background: white;
            padding: .4em;
            border-radius: 6px;
        }

        #qr .card-image {
            background-color: rgb(236, 236, 236);
            width: 100%;
            height: 130px;
            border-radius: 6px 6px 0 0;
        }

        #qr .card-image:hover {
            transform: scale(0.98);
        }

        #qr .heading {
            font-weight: 600;
            color: rgb(88, 87, 87);
            padding: 7px;
        }

        #qr .heading:hover {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card content-card">
                <div class="card-header">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor</th>
                                <th>QR Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($data as $da)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>meja {{ $da->nomor }}
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn  btn-info btn-sm btn-block" id="generateQR"
                                                onclick="generateQR({{ $da->id }})"><i
                                                    class="fas fa-solid fa-qrcode"></i>
                                                Generate QRCode</button>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-xs-12">
                                                <button type="button" class="btn btn-warning btn-xs btn-block"
                                                    id="editButton-{{ $da->id }}" data-toggle="modal"
                                                    data-target="#modal-update-{{ $da->id }}"><i
                                                        class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-6 col-sm-6 col-xs-12">
                                                <button type="button" class="btn  btn-danger btn-xs btn-block"
                                                    id="deleteButton" onclick="hapus({{ $da->id }})"><i
                                                        class="fas fa-solid fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <form action="{{ route('deleteMeja') }}" method="post"
                                            id="formHapus{{ $da->id }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $da->id }}">
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Meja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addMeja') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nomor Meja</label>
                                    <input type="text" class="form-control" placeholder="Nomor Meja" name="nomor"
                                        required
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    @foreach ($data as $da)
        <div class="modal fade" id="modal-update-{{ $da->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Meja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateMeja') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $da->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nomor Meja</label>
                                        <input type="text" class="form-control" placeholder="Nomor Meja" name="nomor"
                                            required
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            value="{{ $da->nomor }}">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div style="display: none" id="qr">
        <div class="card">
            <div class="card-image" id="qrCodeImage"></div>
            <div class="heading"> SCAN FOR ORDER!!
            </div>
        </div>
    </div> --}}
@endSection

@section('script')
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    "text": "Tambah Menu",
                    "className": "btn btn-primary btn-info",
                    "action": function() {
                        $('#modal-add').modal('show');
                    }
                }],
                "columnDefs": [{
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "targets": 1,
                        "orderable": false
                    },
                    {
                        "width": "20%",
                        "targets": 2,
                        "orderable": false
                    },
                    {
                        "width": "20%",
                        "targets": 3,
                        "orderable": false
                    },
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        });

        function generateQR(id) {
            var baseURL = {!! json_encode(url('/')) !!};

            // Assuming 'id' is the parameter you want to include in the URL
            var dataToEncode = `${baseURL}/order?table=${id}`;
            var qrcode = new QRCode(document.createElement("div"), {
                text: dataToEncode,
                width: 400,
                height: 400
            });
            var qrCodeDataURL = qrcode._el.childNodes[0].toDataURL("image/png");
            var downloadLink = document.createElement("a");
            downloadLink.href = qrCodeDataURL;
            downloadLink.download = `Meja ${id}.png`;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }




        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu Tidak Akan Bisa Mengembalikannya Lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#formHapus' + id).submit();
                }
            })
        }

        $(".gambarMenu").change(function(e) {
            e.preventDefault();
            var input = e.target;
            var reader = new FileReader();
            const dataCon = $(this).data('con');
            reader.onload = function() {
                var dataURL = reader.result;
                $("#preview-" + dataCon).attr("src", dataURL);
            };

            // Baca file gambar yang dipilih
            reader.readAsDataURL(input.files[0]);
        })
    </script>
@endSection
