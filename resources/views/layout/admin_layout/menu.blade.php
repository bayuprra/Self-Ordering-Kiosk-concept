@extends('layout.main_layout.main')
@section('style')
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            padding: 0.46875rem 0.75rem;
            height: calc(2.25rem + 2px);
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
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
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Gambar</th>
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
                                    <td>{{ $da->nama }}
                                    </td>
                                    <td>{{ $da->kategori }}</td>
                                    <td>{{ $da->Harga }}</td>
                                    <td></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-warning btn-xs btn-block"
                                                    id="editButton-{{ $da->id }}" data-toggle="modal"
                                                    data-target="#modal-update-{{ $da->id }}"><i
                                                        class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn  btn-danger btn-xs btn-block"
                                                    id="deleteButton" onclick="hapus({{ $da->id }})"><i
                                                        class="fas fa-solid fa-trash"></i></button>
                                            </div>
                                            <form action="{{ route('deleteKategori') }}" method="post"
                                                id="formHapus{{ $da->id }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $da->id }}">
                                            </form>
                                        </div>

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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addMenu') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" placeholder="Nama Menu" name="nama"
                                        required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control select2" style="width: 100%;" tabindex="-1"
                                        aria-hidden="true" name="kategori" required>
                                        <option selected="selected" disabled>- Select Category -</option>
                                        @foreach ($kategori as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" placeholder="Harga" name="harga" required
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto Menu</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input gambarMenu" name="gambar"
                                            accept=".jpg, .jpeg, .png" data-con="0">
                                        <label class="custom-file-label" for="gambarMenu">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Preview</label>
                                    <img class="img-fluid " style="max-height: 150px; width:100%" alt="Photo"
                                        src="{{ asset('image/prev.png') }}" id="preview-0">
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateMenu') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $da->id }}">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nama Menu</label>
                                        <input type="text" class="form-control" placeholder="Nama Menu"
                                            name="nama" required value="{{ $da->nama }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control select2" style="width: 100%;" tabindex="-1"
                                            aria-hidden="true" name="kategori" required>
                                            <option selected="selected" disabled>- Select Category -</option>
                                            @foreach ($kategori as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $da->kategori_id ? 'selected' : '' }}>
                                                    {{ $cat->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" placeholder="Harga" name="harga"
                                            value="{{ $da->Harga }}" required
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Foto Menu</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input gambarMenu" id="gambarMenu"
                                                name="gambar" accept=".jpg, .jpeg, .png" value="{{ $da->gambar }}"
                                                data-con="{{ $da->id }}">
                                            <label class="custom-file-label" for="gambarMenu">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Preview</label>
                                        <img class="img-fluid" style="max-height: 150px; width:100%" alt="Photo"
                                            src="{{ $da->gambar != 'prev.png' && file_exists(public_path('image/menu/' . $da->gambar)) ? asset('image/menu/' . $da->gambar) : asset('image/' . $da->gambar) }}"
                                            id="preview-{{ $da->id }}">
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
    @endforeach
@endSection

@section('script')
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
                // "columnDefs": [{
                //         "width": "10%",
                //         "targets": 0
                //     }, // Kolom pertama
                //     {
                //         "width": "70%",
                //         "targets": 1
                //     }, // Kolom kedua
                //     {
                //         "width": "20%",
                //         "targets": 2
                //     } // Kolom ketiga
                // ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        });

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
