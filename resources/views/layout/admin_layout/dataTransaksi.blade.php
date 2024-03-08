@extends('layout.main_layout.main')
@section('style')
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card content-card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Transaksi</th>
                                <th>Nomor Meja</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Belanja</th>
                                <th>Status Pembayaran</th>
                                <th>Status Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Carbon\Carbon;
                                $no = 1;
                                $badge = 'secondary';
                                $status = 'Cooking';
                                $statusBadge = 'secondary';
                            @endphp
                            @foreach ($data as $tra)
                                @php $conBadge = strtolower($tra->status_pembayaran); @endphp
                                @if ($conBadge == 'waiting')
                                    @php $badge = "warning";@endphp
                                @elseif($conBadge == 'failed')
                                    @php $badge = "danger";@endphp
                                @elseif($conBadge == 'success')
                                    @php $badge = "success"; @endphp
                                @endif

                                @if ($tra->status == 1)
                                    @php
                                        $status = 'Served';
                                        $statusBadge = 'success';
                                    @endphp
                                @endif
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ Carbon::parse($tra->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY, H:mm') }}
                                    </td>
                                    <td>Meja {{ $tra->meja->nomor ?? '' }}</td>
                                    <td>{{ str_replace('_', ' ', $tra->pembayaran) }}</td>
                                    <td>Rp. {{ number_format($tra->total_belanja, 0, ',', '.') }}</td>
                                    <td><span
                                            class="badge badge-pill badge-{{ $badge }} w-100">{{ $tra->status_pembayaran }}</span>
                                    </td>
                                    <td><span class="badge badge-{{ $statusBadge }} w-100">{{ $status }}</span>
                                    </td>
                                    <td><button data-toggle="modal" data-target="#modal-update-{{ $tra->id }}"
                                            class="badge badge-primary w-100">Detail</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
    @foreach ($data as $da)
        <div class="modal fade" id="modal-update-{{ $da->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Order</h4>

                    </div>
                    <div class="modal-body">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img src="{{ asset('image/assets/logob.png') }}" alt="Logo"
                                            class="image img-circle" style="max-height: 30px; width:auto"> Phoenix
                                        Gastrobar
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-12 invoice-col">
                                    <br>
                                    <b>Order ID:</b> {{ $da->id }}<br>
                                    <b>DateTime:</b>
                                    {{ Carbon::parse($da->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY, H:mm') }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $or)
                                                @if ($da->id == $or->transaksi_id)
                                                    <tr>
                                                        <td>{{ $or->menu }}</td>
                                                        <td>{{ $or->jumlah }}</td>
                                                        <td>{{ $or->harga }}</td>
                                                        <td>{{ $or->total }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Payment Methods:</p>

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {{ str_replace('_', ' ', $da->pembayaran) }}
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>Rp. {{ number_format($da->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>PB1 (10%)</th>
                                                <td>Rp. {{ number_format($da->pajak, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>Rp. {{ number_format($da->total_belanja, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
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
                "buttons": ["excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                        "width": "10%",
                        "targets": 2
                    },
                    {
                        "width": "10%",
                        "targets": 3
                    },
                    {
                        "width": "10%",
                        "targets": 5
                    },
                    {
                        "width": "10%",
                        "targets": 6
                    },
                    {
                        "width": "10%",
                        "targets": 7,
                        "orderable": false
                    },
                    {
                        "targets": 4,
                        "orderable": false
                    },
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endSection
