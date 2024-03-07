@extends('layout.main_layout.main')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Set Unavailable Menu's</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <select class="duallistbox" multiple="multiple" name="unavail[]">
                                        @foreach ($menu as $avail)
                                            <option value="{{ $avail->id }}"
                                                {{ $avail->available == 0 ? 'selected' : '' }}>
                                                {{ $avail->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="dt-buttons btn-group flex-wrap">
                        <button class="btn btn-secondary btn-primary btn-info ml-auto" type="button" id="save"
                            onclick="save()">
                            <span>Save Available Menu</span></button>
                    </div>

                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
@endSection

@section('script')
    <script>
        $(function() {
            $('.duallistbox').bootstrapDualListbox({
                nonSelectedListLabel: 'Available Menu',
                selectedListLabel: 'Unavailable Menu',
                preserveSelectionOnMove: false,
                moveOnSelect: false,
            })


        });

        function reloadDualListbox() {
            dualListbox.bootstrapDualListbox('destroy');
            dualListbox = $('.duallistbox').bootstrapDualListbox({
                nonSelectedListLabel: 'Available Menu',
                selectedListLabel: 'Unavailable Menu',
                preserveSelectionOnMove: false,
                moveOnSelect: false,
            });
        }

        function save() {
            const storeData = {
                unavail: $('.duallistbox').val(),
            }
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('setUnavailbleMenu') }}",
                        data: {
                            'data': storeData
                        },
                        type: 'POST',
                        dataType: 'json',
                    }).then(function(data) {
                        console.log(data)
                        Swal.fire({
                            position: "top-end",
                            icon: data.success === true ? "success" : "error",
                            title: data.message ?? "",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                }
            });

        }
    </script>
@endSection
