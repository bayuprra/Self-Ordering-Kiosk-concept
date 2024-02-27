@extends('layout.user_layout.main')
@section('style')
    <style>
        body {
            overflow: hidden;
        }

        .tab-pane .card {
            padding: 20px;
            border-radius: 20px;
            background: #e8e8e8;
            box-shadow: 5px 5px 6px #dadada,
                -5px -5px 6px #f6f6f6;
            transition: 0.4s;
        }

        .tab-pane .card:hover {
            translate: 0 -10px;
        }

        .tab-pane .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #2e54a7;
            margin: 15px 0 0 0;
        }

        .tab-pane .card-image {
            min-height: 170px;
            background-color: #c9c9c9;
            border-radius: 15px;
            box-shadow: inset 8px 8px 10px #c3c3c3,
                inset -8px -8px 10px #cfcfcf;
        }

        .tab-pane .card-body {
            color: rgb(31, 31, 31);
            font-size: 15px;
            text-align: justify;
            padding: 0.5rem;
        }


        .tab-pane .by-name {
            font-weight: 700;
        }

        .sticky-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 15px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: var(--primary)
        }

        .sticky-button .badge-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            line-height: 1;
            vertical-align: middle;
        }

        .css-1aq53kl-unf-quantity-editor {
            -webkit-box-align: center;
            align-items: center;
            border: solid 1px var(--NN300, #bfc9d9);
            border-radius: 8px;
            display: inline-flex;
            padding: 3px;
            transition: border 120ms cubic-bezier(0.2, 0.64, 0.21, 1) 0s;
            min-width: 70px;
            width: 102px;
        }

        .css-6cobzs {
            background-color: transparent;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
            height: 24px;
            padding: 0px;
            width: 24px;
            appearance: none;
        }

        .css-3a6js2-unf-quantity-editor__input {
            background-color: transparent;
            border: none;
            color: var(--NN950, #212121);
            font-family: inherit;
            font-size: 14px;
            line-height: 18px;
            outline: none;
            text-align: center;
            flex-shrink: 2;
            -webkit-box-flex: 2;
            flex-grow: 2;
            width: 100%;
        }

        #mennu {
            max-height: 420px;
            overflow-y: auto;
        }

        #cart {
            color: white;
        }

        @media only screen and (max-width: 576px) {

            /* Small devices (landscape phones, 576px and up) */
            #mennu {
                max-height: 600px;
                /* Sesuaikan nilai max-height untuk layar laptop */
            }
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card content-card">
                <div class="card-header">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Menu</h1>
                                </div><!-- /.col -->

                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#"><strong>Table</strong></a></li>
                                        <li class="breadcrumb-item active">{{ $table }}</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-xs-12 col-lg-12">
                            <div class="card card-info card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @php
                                            $num = 1;
                                            $active = 'active';
                                            $selected = 'true';
                                        @endphp

                                        @foreach ($kategori as $cat)
                                            @if ($num++ != 1)
                                                @php
                                                    $active = '';
                                                    $selected = 'false';
                                                @endphp
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link {{ $active }}"
                                                    id="custom-tabs-one-{{ $cat->id }}-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-{{ $cat->id }}" role="tab"
                                                    aria-controls="custom-tabs-one-{{ $cat->id }}"
                                                    aria-selected="{{ $selected }}">{{ $cat->nama }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body" id="mennu">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @php
                                            $num = 1;
                                            $active = 'show active';
                                        @endphp
                                        @foreach ($kategori as $cat)
                                            @if ($num++ != 1)
                                                @php
                                                    $active = '';
                                                @endphp
                                            @endif
                                            <div class="tab-pane fade {{ $active }}"
                                                id="custom-tabs-one-{{ $cat->id }}" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-{{ $cat->id }}-tab">
                                                <div class="row">
                                                    @foreach ($menu as $me)
                                                        @if ($me->kategori_id == $cat->id)
                                                            @php
                                                                $source = 'image/';
                                                            @endphp
                                                            @if ($me->gambar != 'prev.png')
                                                                @php
                                                                    $source = 'image/menu/';
                                                                @endphp
                                                            @endif
                                                            <div class="col-md-3 col-sm-4 col-xs-6">
                                                                <div class="card">
                                                                    <div class="card-image">
                                                                        <img class="img-fluid"
                                                                            style="height: 100%; width: 100%;"
                                                                            alt="{{ $me->nama }}"
                                                                            src="{{ asset(file_exists($source . $me->gambar) ? $source . $me->gambar : 'image/prev.png') }}">
                                                                    </div>
                                                                    <div class="card-title row">
                                                                        <div class="col-8">
                                                                            <p>{{ $me->nama }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="col-4 text-xs float-sm-right text-right text-secondary">
                                                                            (Rp.
                                                                            {{ number_format($me->Harga, 0, ',', '.') }})
                                                                        </div>
                                                                    </div>
                                                                    <p
                                                                        class="card-body {{ $me->deskripsi == null ? 'font-italic text-secondary' : '' }}">
                                                                        {{ $me->deskripsi == null ? 'No Description' : $me->deskripsi }}
                                                                    </p>
                                                                    <hr>
                                                                    <div class="footer">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="css-1aq53kl-unf-quantity-editor"
                                                                                    id="sum-{{ $me->id }}"
                                                                                    style="display: none">
                                                                                    <button aria-label="Kurangi 1"
                                                                                        class="css-6cobzs" disabled=""
                                                                                        tabindex="-1"
                                                                                        onclick="kurangJumlahReal({{ $me->id }})"
                                                                                        id="kurangiReal-{{ $me->id }}">
                                                                                        <svg class="unf-icon"
                                                                                            viewBox="0 0 24 24"
                                                                                            width="16px" height="16px"
                                                                                            fill="var(--NN300, #00AA5B)"
                                                                                            style="display: inline-block; vertical-align: middle">
                                                                                            <path
                                                                                                d="M20 12.75H4a.75.75 0 110-1.5h16a.75.75 0 110 1.5z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                    <input id="jmlReal-{{ $me->id }}"
                                                                                        aria-valuenow="1" aria-valuemin="1"
                                                                                        aria-valuemax="7"
                                                                                        class="css-3a6js2-unf-quantity-editor__input"
                                                                                        data-unify="QuantityEditor"
                                                                                        role="spinbutton" type="text"
                                                                                        value="1" />
                                                                                    <button aria-label="Tambah 1"
                                                                                        class="css-6cobzs" tabindex="-1"
                                                                                        onclick="tambahJumlahReal({{ $me->id }})">
                                                                                        <svg class="unf-icon"
                                                                                            viewBox="0 0 24 24"
                                                                                            width="16px" height="16px"
                                                                                            fill="var(--GN500, #00AA5B)"
                                                                                            style="display: inline-block; vertical-align: middle">
                                                                                            <path
                                                                                                d="M20 11.25h-7.25V4a.75.75 0 10-1.5 0v7.25H4a.75.75 0 100 1.5h7.25V20a.75.75 0 101.5 0v-7.25H20a.75.75 0 100-1.5z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <button id="toChart-{{ $me->id }}"
                                                                                    class="btn btn-sm btn-info float-sm-right"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modal-jml-{{ $me->id }}">Add
                                                                                    To
                                                                                    Cart</button>
                                                                                <button id="fromChart-{{ $me->id }}"
                                                                                    class="btn btn-sm btn-danger float-sm-right"
                                                                                    data-id="{{ $me->id }}"
                                                                                    onclick="deleteCart({{ $me->id }})"
                                                                                    style="display: none">Cancel</button>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
    @foreach ($menu as $me)
        <div class="modal fade" id="modal-jml-{{ $me->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Jumlah</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="css-1aq53kl-unf-quantity-editor" style="width: 100%">
                                    <button aria-label="Kurangi 1" class="css-6cobzs" tabindex="-1"
                                        onclick="kurangJumlah({{ $me->id }})" id="kurangi-{{ $me->id }}">
                                        <svg class="unf-icon" viewBox="0 0 24 24" width="16px" height="16px"
                                            fill="var(--NN300, #00AA5B)"
                                            style="display: inline-block; vertical-align: middle">
                                            <path d="M20 12.75H4a.75.75 0 110-1.5h16a.75.75 0 110 1.5z">
                                            </path>
                                        </svg>
                                    </button>
                                    <input id="jml-{{ $me->id }}" aria-valuenow="1" aria-valuemin="1"
                                        aria-valuemax="7" class="css-3a6js2-unf-quantity-editor__input"
                                        data-unify="QuantityEditor" role="spinbutton" type="text" value="1" />
                                    <button aria-label="Tambah 1" class="css-6cobzs" tabindex="-1"
                                        onclick="tambahJumlah({{ $me->id }})">
                                        <svg class="unf-icon" viewBox="0 0 24 24" width="16px" height="16px"
                                            fill="var(--GN500, #00AA5B)"
                                            style="display: inline-block; vertical-align: middle">
                                            <path
                                                d="M20 11.25h-7.25V4a.75.75 0 10-1.5 0v7.25H4a.75.75 0 100 1.5h7.25V20a.75.75 0 101.5 0v-7.25H20a.75.75 0 100-1.5z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" data-id="{{ $me->id }}" onclick="addCart({{ $me->id }})"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <button class="btn btn-lg btn-info sticky-button"><i class="fas fa-shopping-cart"></i>
        <span class="badge badge-warning  .badge-center" id="cart">0</span></button>
@endSection

@section('script')
    <script>
        $(document).ready(function() {
            var x = setInterval(function() {
                const jumlahCart = $("#cart");
                let jmlCart = sessionStorage.getItem('cart') ?? 0;
                console.log(jmlCart)
                jumlahCart.text(jmlCart);
            }, 1000);

            function clearSessionStorage() {
                sessionStorage.clear();
            }
            window.addEventListener('beforeunload', clearSessionStorage);
        });

        function addCart(id) {
            const modal = $("#modal-jml-" + id);
            const idAddChart = $("#toChart-" + id);
            const idSum = $("#sum-" + id);
            const idDelChart = $("#fromChart-" + id);
            modal.modal('hide');
            let jmlModal = $("#jml-" + id).val();
            const realJml = $("#jmlReal-" + id);
            realJml.val(parseInt(jmlModal));
            let countCart = sessionStorage.getItem('cart') || 0;
            countCart = parseInt(countCart) + 1;
            sessionStorage.setItem('cart', countCart.toString());

            idAddChart.hide();
            idSum.show();
            idDelChart.show();
        }

        function deleteCart(id) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const idAddChart = $("#toChart-" + id);
                    const idSum = $("#sum-" + id);
                    const idDelChart = $("#fromChart-" + id);

                    idAddChart.show();
                    idSum.hide();
                    idDelChart.hide();
                    $("#jmlReal-" + id).val(1);
                    $("#jml-" + id).val(1);
                    let countCart = sessionStorage.getItem('cart');
                    countCart = parseInt(countCart) - 1;
                    sessionStorage.setItem('cart', countCart.toString());
                }
            });

        }

        function tambahJumlah(id) {
            const jml = $("#jml-" + id);
            let current = parseInt(jml.val());
            jml.val(current += 1)
            $("#kurangi-" + id).prop("disabled", false)
        }

        function kurangJumlah(id) {
            const jml = $("#jml-" + id);
            let current = parseInt(jml.val());
            if (current === 1) {
                $("#kurangi-" + id).prop("disabled", true)
                return;
            }
            jml.val(current -= 1)
        }

        function tambahJumlahReal(id) {
            const jml = $("#jmlReal-" + id);
            let current = parseInt(jml.val());
            jml.val(current += 1)
            $("#kurangiReal-" + id).prop("disabled", false)
        }

        function kurangJumlahReal(id) {
            const jml = $("#jmlReal-" + id);
            let current = parseInt(jml.val());
            if (current === 1) {
                $("#kurangiReal-" + id).prop("disabled", true)
                return;
            }
            jml.val(current -= 1)
        }
    </script>
@endSection
