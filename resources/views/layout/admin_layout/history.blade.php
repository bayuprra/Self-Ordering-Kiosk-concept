@extends('layout.main_layout.main')
@section('style')
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card content-card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse" id="showingData">
                            <button class="toastsDefaultAutohide" hidden></button>

                            <audio id="audio" src="{{ asset('notification/money.mp3') }}" type="audio/mpeg">
                            </audio>
                            @php use Carbon\Carbon; @endphp

                            @if (count($data) > 0)
                                @foreach ($data as $da)
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            <span class="time"><i class="far fa-clock"></i>
                                                {{ Carbon::parse($da->created_at)->locale('id_ID')->isoFormat('HH:mm') }}</span>
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="far fa-money-bill-alt bg-info"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Pembayaran Masuk</a>
                                            </h3>
                                            <div class="timeline-body">
                                                RP.
                                                {{ number_format($da->total_belanja, 0, ',', '.') }}
                                            </div>
                                            <div class="timeline-footer">
                                                <strong>From Table
                                                    {{ $da->meja->nomor }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div>
                                    <i class="far fa-money-bill-alt bg-info"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">No Transaction Today</a>
                                        </h3>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
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
                title: 'New Payment Receive',
                autohide: true,
                delay: 7000,
                class: 'bg-warning', // Menentukan warna latar belakang menjadi warning
                icon: 'far fa-money-bill-alt', // Menambahkan ikon peringatan
                body: 'money money money!'
            });
            sound();
        });
        $(function() {
            const data = {!! json_encode($data) !!}
            sessionStorage.setItem("oldTransaksi", data.length)
            var x = setInterval(function() {
                newTransaksi();

                // fetchData();
                const oNow = parseInt(sessionStorage.getItem("oldTransaksi")) ?? 0;
                const oNew = parseInt(sessionStorage.getItem("newTransaksi")) ?? 0;
                if (oNow !== oNew) {
                    newTransaksi(true);
                }
            }, 1000);
        })

        function newTransaksi(refresh) {
            refresh = refresh || false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('history') }}",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    sessionStorage.setItem("newTransaksi", res.data.length)
                    if (refresh === true) {
                        let parent = $("#showingData");
                        let date = new Date(res.data[0].created_at);
                        let hours = date.getHours();
                        let minutes = date.getMinutes();
                        let formattedTime = hours.toString().padStart(2, '0') + ':' + minutes.toString()
                            .padStart(2, '0');
                        let formattedTotalBelanja = res.data[0].total_belanja.toLocaleString('id-ID', {
                            minimumFractionDigits: 0
                        });

                        let additional = `
    <div class="time-label">
        <span class="bg-success">
            <span class="time"><i class="far fa-clock"></i>
                ${formattedTime}
            </span>
        </span>
    </div>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <div>
        <i class="far fa-money-bill-alt bg-info"></i>
        <div class="timeline-item">
            <h3 class="timeline-header"><a href="#">Pembayaran Masuk</a></h3>
            <div class="timeline-body">
                RP. ${formattedTotalBelanja}
            </div>
            <div class="timeline-footer">
                <strong>From Table ${res.data[0].meja.nomor}</strong>
            </div>
        </div>
    </div>
`;
                        parent.prepend(additional);
                        $(".toastsDefaultAutohide").click()
                        sessionStorage.setItem("oldTransaksi", res.data.length)

                    }
                }
            })
        }
    </script>
@endSection
