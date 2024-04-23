@extends('layouts.main')

@section('subtitle', 'Training')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Training</h1>
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
                                <h3 class="card-title">Data Training</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-default">
                                        Tambah
                                    </button>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Training</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('training.store') }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" placeholder="Nama">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="usia">Usia</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="usia" id="usia">
                                                                    <option disabled selected="selected">Pilih Usia
                                                                    </option>
                                                                    @foreach ($usia as $item)
                                                                        <option value="{{ $item->nilai }}">
                                                                            {{ $item->subkriteria }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pekerjaan">Pekerjaan</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="pekerjaan" id="pekerjaan">
                                                                    <option disabled selected="selected">Pilih Pekerjaan
                                                                    </option>
                                                                    @foreach ($pekerjaan as $item)
                                                                        <option value="{{ $item->nilai }}">
                                                                            {{ $item->subkriteria }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="gaji">Gaji</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="gaji" id="gaji">
                                                                    <option disabled selected="selected">Pilih Gaji
                                                                    </option>
                                                                    @foreach ($gaji as $item)
                                                                        <option value="{{ $item->nilai }}">
                                                                            {{ $item->subkriteria }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggungan">Tanggungan</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="tanggungan" id="tanggungan">
                                                                    <option disabled selected="selected">Pilih Tanggungan
                                                                    </option>
                                                                    @foreach ($tanggungan as $item)
                                                                        <option value="{{ $item->nilai }}">
                                                                            {{ $item->subkriteria }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status_rumah">Status Rumah</label>
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="status_rumah" id="status_rumah">
                                                                    <option disabled selected="selected">Pilih Status Rumah
                                                                    </option>
                                                                    @foreach ($status_rumah as $item)
                                                                        <option value="{{ $item->nilai }}">
                                                                            {{ $item->subkriteria }}</option>
                                                                    @endforeach
                                                                </select>
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
                                            <th>Nama Lengkap</th>
                                            <th>Usia</th>
                                            <th>Pekerjaan</th>
                                            <th>Gaji</th>
                                            <th>Tanggungan</th>
                                            <th>Status Rumah</th>
                                            <th>Keputusan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('training.update') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="usia">Usia</label>
                                    <select class="form-control select2" style="width: 100%;" name="usia"
                                        id="usia">
                                        <option disabled selected="selected">Pilih Usia
                                        </option>
                                        @foreach ($usia as $item)
                                            <option value="{{ $item->nilai }}">
                                                {{ $item->subkriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <select class="form-control select2" style="width: 100%;" name="pekerjaan"
                                        id="pekerjaan">
                                        <option disabled selected="selected">Pilih Pekerjaan
                                        </option>
                                        @foreach ($pekerjaan as $item)
                                            <option value="{{ $item->nilai }}">
                                                {{ $item->subkriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <select class="form-control select2" style="width: 100%;" name="gaji"
                                        id="gaji">
                                        <option disabled selected="selected">Pilih Gaji
                                        </option>
                                        @foreach ($gaji as $item)
                                            <option value="{{ $item->nilai }}">
                                                {{ $item->subkriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggungan">Tanggungan</label>
                                    <select class="form-control select2" style="width: 100%;" name="tanggungan"
                                        id="tanggungan">
                                        <option disabled selected="selected">Pilih Tanggungan
                                        </option>
                                        @foreach ($tanggungan as $item)
                                            <option value="{{ $item->nilai }}">
                                                {{ $item->subkriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_rumah">Status Rumah</label>
                                    <select class="form-control select2" style="width: 100%;" name="status_rumah"
                                        id="status_rumah">
                                        <option disabled selected="selected">Pilih Status Rumah
                                        </option>
                                        @foreach ($status_rumah as $item)
                                            <option value="{{ $item->nilai }}">
                                                {{ $item->subkriteria }}</option>
                                        @endforeach
                                    </select>
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
                ajax: "{{ route('training') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'usia',
                        name: 'usia'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
                    },
                    {
                        data: 'gaji',
                        name: 'gaji'
                    },
                    {
                        data: 'tanggungan',
                        name: 'tanggungan'
                    },
                    {
                        data: 'status_rumah',
                        name: 'status_rumah'
                    },
                    {
                        data: 'keputusan',
                        name: 'keputusan',
                        render: function(data) {
                            return data ? data : '?';
                        }
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
    </script>
@endsection
