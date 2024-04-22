@extends('layouts.main')

@section('subtitle', 'SubKriteria')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SubKriteria</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data SubKriteria</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-default">
                                        Tambah
                                    </button>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data SubKriteria</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('subkriteria.store') }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="subkriteria">SubKriteria</label>
                                                                <input type="text" class="form-control"
                                                                    name="subkriteria" id="subkriteria"
                                                                    placeholder="Subkriteria">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kriteria">Kriteria</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="kriteria" id="kriteria">
                                                                    <option disabled selected="selected">Pilih Kriteria
                                                                    </option>
                                                                    @foreach ($kriteria as $item)
                                                                        <option value="{{ $item->id_kriteria }}">
                                                                            {{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nilai">Nilai</label>
                                                                <input type="text" class="form-control" name="nilai"
                                                                    id="nilai" placeholder="Nilai">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>SubKriteria</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data SubKriteria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('subkriteria.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <input type="hidden" name="id_subkriteria" id="id_subkriteria">
                                <div class="form-group">
                                    <label for="subkriteria">SubKriteria</label>
                                    <input type="text" class="form-control" name="subkriteria" id="subkriteria"
                                        placeholder="Subkriteria">
                                </div>
                                <div class="form-group">
                                    <label for="kriteria">Kriteria</label>
                                    <select class="form-control select2" style="width: 100%;" name="kriteria"
                                        id="kriteria">
                                        <option value="" selected="selected">Pilih Kriteria</option>
                                        @foreach ($kriteria as $item)
                                            <option value="{{ $item->id_kriteria }}"
                                                {{ $item->id_kriteria == $item->id_kriteria ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="text" class="form-control" name="nilai" id="nilai"
                                        placeholder="Nilai">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({
                processing: true,
                ordering: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('subkriteria') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'subkriteria',
                        name: 'subkriteria'
                    },
                    {
                        data: 'kriteria',
                        name: 'kriteria'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<button type="button" class="btn btn-warning m-1" data-toggle="modal"' +
                                'data-target="#modal-edit" data-id="' + data
                                .id + '" data-subkriteria="' + data.subkriteria +
                                '" data-kriteria="' +
                                data.id_kriteria + '" data-nilai="' + data.nilai + '">' +
                                'Edit' +
                                '</button>' +
                                '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                                data.id + ')"' +
                                'data-id="' + data.id +
                                '">Hapus</button>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ],
                rowCallback: function(row, data, index) {
                    var dt = this.api();
                    $(row).attr('data-id', data.id);
                    $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                }
            });
            $('#modal-edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_subkriteria = button.data('id');
                var subkriteria = button.data('subkriteria');
                var kriteria = button.data('kriteria');
                var nilai = button.data('nilai');
                var modal = $(this);

                modal.find('.modal-body #id_subkriteria').val(id_subkriteria);
                modal.find('.modal-body #subkriteria').val(subkriteria);
                modal.find('.modal-body #kriteria option[value="' + kriteria + '"]').prop('selected', true);
                modal.find('.modal-body #nilai').val(nilai);
            });
            $('.datatable-input').on('input', function() {
                var searchText = $(this).val().toLowerCase();

                $('.table tr').each(function() {
                    var rowData = $(this).text().toLowerCase();
                    if (rowData.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('sub-kriteria') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            $('#myTable').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data. Silahkan coba lagi',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
