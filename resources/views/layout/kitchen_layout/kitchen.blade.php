@extends('layout.user_layout.main')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <section class="content">
        <button class="toastsDefaultAutohide" hidden></button>

        <audio id="audio" src="{{ asset('notification/son.mp3') }}" type="audio/mpeg">
        </audio>
        <div class="container-fluid">
            <div class="card content-card">
                <section class="content pb-3 mt-3">
                    <div class="container-fluid h-auto row" id="initial">
                    </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </section>
@endSection

@section('script')
    <script>
        const audioo = document.getElementById("audio");

        function sound() {
            const playPromise = audioo.play();

            if (playPromise !== undefined) {
                playPromise.then(_ => {
                        console.log("Pemutaran audio berhasil dimulai.");
                    })
                    .catch(error => {
                        console.error("Pemutaran audio diblokir:", error);
                    });
            }
        }
        $('.toastsDefaultAutohide').click(function() {
            $(document).Toasts('create', {
                title: 'New Order',
                autohide: true,
                delay: 7000,
                body: `There's New Order!`
            })
            sound();
        });
        $(document).ready(function() {
            fetchData();
            newOrder();

            var x = setInterval(function() {
                newOrder();

                // fetchData();
                const oNow = parseInt(sessionStorage.getItem("orderNow")) ?? 0;
                const oNew = parseInt(sessionStorage.getItem("orderNew")) ?? 0;
                if (oNow !== oNew) {
                    fetchData();
                }
            }, 5000);


        })

        function newOrder() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                url: "{{ route('orderForKitchen') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    sessionStorage.setItem('orderNew', response.data)
                },
                error: function(err) {
                    console.log(err)
                }
            });
        }

        function fetchData() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                url: "{{ route('kitchenOrder') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    sessionStorage.setItem('orderNow', response.data.length)
                    const card = $("#initial");
                    card.empty();
                    let addingOrder = "";
                    if (response.data.length > 0) {
                        response.data.forEach(function(dat) {
                            addingOrder +=
                                `<div class="card card-info card-outline col-md-3 col-sm-4 col-xs-12 mr-3" id="card-${dat.transaksi} }}">
                            <div class="card-header">
                                <h5 class="card-title">OrderID:<br>${dat.transaksi??""}</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-sm"s>
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th style="width: 20%">QTy</th>
                                            <th style="width: 10px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                            let counter = 0;
                            const countOrder = dat.order.length
                            dat.order.forEach(function(orderData) {
                                if (orderData.status === 1) {
                                    counter++
                                }
                                addingOrder +=
                                    `<tr>
                                    <td>${orderData.menu}</td>
                                        <td>${orderData.jumlah}</td>
                                        <td>
                                            <div class="form-check">
                                                <form id="form-${orderData.id}" data-countOrder="${countOrder}">
                                                <input class="form-check-input" type="checkbox"
                                                    id="box-${orderData.id}" data-id="${orderData.id}" data-transaksi="${dat.transaksi}" ${orderData.status ===  0 ? "":"checked"} onchange="updateOr(this)">
                                                </div>
                                                </form>
                                            </td>
                                </tr>`
                            })
                            addingOrder += `</tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"><button type="button"
                                                    class="btn btn-success btn-block" disabled id="butt-${dat.transaksi}" data-transaksi="${dat.transaksi}" onclick="serve(this)">Selesai</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>`;

                        })
                        card.append(addingOrder)
                        $(".toastsDefaultAutohide").click()

                    } else {
                        addingOrder = `<div class="card card-info card-outline col-md-12 col-sm-12 col-xs-12 mr-3 ">
                            <div class="card-header">
                                <h5 class="card-title">NO ORDER YET</h5>
                            </div>
                            </div>`;
                        card.append(addingOrder)
                    }

                },
                error: function(xhr, status, error) {
                    // Handle ketika terjadi kesalahan dalam permintaan
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        function updateOr(val) {
            const orid = {
                id: parseInt($(val).data('id')),
                con: $("#box-" + $(val).data('id')).is(":checked") ? 1 : 0
            }
            let dataTransaksi = $(val).data('transaksi');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('checklist') }}",
                data: {
                    'data': orid
                },
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    allFinish(dataTransaksi)
                }
            })
        }

        function allFinish(idTransaksi) {
            const da = {
                id: idTransaksi
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('allFinish') }}",
                data: {
                    'data': da
                },
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.data == true) {
                        $("#butt-" + idTransaksi).prop("disabled", false);
                    }
                }
            })
        }

        function serve(val) {
            let ids = $(val).data("transaksi");
            const da = {
                id: ids
            }
            Swal.fire({
                title: "Selesaikan Pesanan?",
                showCancelButton: true,
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('Finish') }}",
                        data: {
                            'data': da
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                autohide: true,
                                delay: 5000,
                                body: 'Pesanan Diselesaikan'
                            })
                            fetchData()

                        }
                    })
                }
            });
        }
    </script>
@endSection
