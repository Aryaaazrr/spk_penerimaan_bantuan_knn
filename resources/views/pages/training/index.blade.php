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
                                                    <form action="{{ route('training.store') }}" method="POST"
                                                        onsubmit="return validateForm()">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="rt">RT/RW</label>
                                                                <input type="text" class="form-control" name="rt"
                                                                    id="rt" placeholder="RT/RW">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nik">NIK</label>
                                                                <input type="text" class="form-control" name="nik"
                                                                    id="nik" placeholder="NIK">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" placeholder="Nama">
                                                            </div>
                                                            @foreach ($kriteria as $kriteriaItem)
                                                                <div class="form-group">
                                                                    <label
                                                                        for="{{ $kriteriaItem->nama }}">{{ $kriteriaItem->nama }}</label>
                                                                    <select class="form-control select2" id="select2"
                                                                        name="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria"
                                                                        style="width: 100%;" required>
                                                                        <option disabled selected>Pilih
                                                                            {{ $kriteriaItem->nama }}</option>
                                                                        @foreach ($detailKriteria->where('kriteria', $kriteriaItem->nama) as $detail)
                                                                            <option value="{{ $detail->id_subkriteria }}">
                                                                                {{ $detail->subkriteria }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endforeach
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
                                            <th>RT/RW</th>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
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
                            @method('PUT')
                            <div class="card-body">
                                <input type="hidden" name="id_training" id="id_training">
                                <div class="form-group">
                                    <label for="rt">RT/RW</label>
                                    <input type="text" class="form-control" name="rt" id="rt"
                                        placeholder="RT/RW">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" name="nik" id="nik"
                                        placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama">
                                </div>
                                @foreach ($kriteria as $kriteriaItem)
                                    <div class="form-group">
                                        <label for="{{ $kriteriaItem->nama }}">{{ $kriteriaItem->nama }}</label>
                                        <select class="form-control select2" id="subkriteria"
                                            name="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria"
                                            style="width: 100%;" required>
                                            <option disabled selected>Pilih
                                                {{ $kriteriaItem->nama }}</option>
                                            {{-- <option value="{{ $detail->id_subkriteria }}">
                                                {{ $detail->subkriteria }}</option> --}}
                                            {{-- @foreach ($detailKriteria->where('kriteria', $kriteriaItem->nama) as $detail)
                                                <option value="{{ $detail->id_subkriteria }}">
                                                    {{ $detail->subkriteria }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                @endforeach
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
                        data: 'rt_rw',
                        name: 'rt_rw'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    @foreach ($kriteria as $kriteriaItem)
                        {
                            data: 'subkriteria.{{ $kriteriaItem->nama }}',
                            name: '{{ $kriteriaItem->nama }}',
                            render: function(data) {
                                return data ? data : 'N/A';
                            }
                        },
                    @endforeach {
                        data: 'keputusan',
                        name: 'keputusan',
                        render: function(data) {
                            return data ? data : '?';
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            var subkriteriaString = JSON.stringify(data.subkriteria);

                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<button type="button" class="btn btn-warning m-1" data-toggle="modal"' +
                                'data-target="#modal-edit" data-id="' + data.DT_RowIndex +
                                '" data-rt="' + data.rt_rw + '" data-nik="' + data.nik +
                                '" data-nama="' + data.nama + '" data-subkriteria=\'' +
                                subkriteriaString + '\' data-nilai="' + data.nilai + '">' + 'Edit' +
                                '</button>' +
                                '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                                data.DT_RowIndex + ')"' +
                                'data-id="' + data.DT_RowIndex +
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
                var rt = button.data('rt');
                var nik = button.data('nik');
                var nama = button.data('nama');
                var subkriteria = button.data('subkriteria');
                var nilai = button.data('nilai');
                var modal = $(this);

                modal.find('.modal-body #id_subkriteria').val(id_subkriteria);
                modal.find('.modal-body #rt').val(rt);
                modal.find('.modal-body #nik').val(nik);
                modal.find('.modal-body #nama').val(nama);

                var subkriteriaOptions = '';
                for (var key in subkriteria) {
                    subkriteriaOptions += '<option value="' + subkriteria[key] + '">' + key + '</option>';
                }
                modal.find('.modal-body #subkriteria').html(subkriteriaOptions);
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
                        url: "{{ url('training') }}/" + id,
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

        function validateForm() {
            var selects = document.querySelectorAll('#select2');

            for (var i = 0; i < selects.length; i++) {
                if (!selects[i].selectedOptions[0]) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Mohon pilih semua kriteria sebelum menyimpan.'
                    });
                    return false;
                }
            }
            return true;
        }
    </script>
@endsection
