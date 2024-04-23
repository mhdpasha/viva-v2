@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kategori</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button class="btn btn-dark" data-toggle="modal" data-target="#add">+ Tambah Kategori</button>

                <!-- Modal Tambah -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kategori.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col">
                                            <label>Kode</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Kode kategori"
                                                    autocomplete="off" name="kode">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Kategori</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Jenis kategori"
                                                    autocomplete="off" name="nama">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->kode }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td class="text-center">
                                        @if ($kategori->status == 'aktif')
                                            <span class="p-2 px-4 badge badge-success">Aktif</span>
                                        @else
                                            <span class="p-2 badge badge-danger">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <button data-toggle="modal" data-target="#edit{{ $kategori->id }}"
                                            class="btn btn-warning mx-2"><i class="fa fa-edit"
                                                aria-hidden="true"></i></button>
                                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit{{ $kategori->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('kategori.update', $kategori) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label>Kode</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Kode kategori"
                                                                            autocomplete="off" name="kode"
                                                                            value="{{ $kategori->kode }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Kategori</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Jenis kategori"
                                                                            autocomplete="off" name="nama"
                                                                            value="{{ $kategori->nama }}">
                                                                    </div>
                                                                </div>

                                                                <select class="form-control px-3 mx-2" name="status"
                                                                    id="status">
                                                                    <option value="aktif"
                                                                        {{ $kategori->status == 'aktif' ? 'selected' : '' }}>
                                                                        Aktif </option>
                                                                    <option value="non-aktif"
                                                                        {{ $kategori->status == 'non-aktif' ? 'selected' : '' }}>
                                                                        Non-Aktif</option>
                                                                </select>

                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                </div>



                </td>
                </tr>
                @endforeach
                </tbody>
                </table>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert"
                        data-dismiss="alert" style="cursor: pointer;">
                        <h4><strong>Field belum terisi :</strong></h4>
                        <ul style="list-style-type: >">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif (session()->has('added'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert"
                        data-dismiss="alert" style="cursor: pointer;">
                        <strong class="d-flex items-center justify-content-center">
                            {{ session('added') }}
                        </strong>
                    </div>
                @elseif (session()->has('saved'))
                    <div class="alert alert-primary alert-dismissible fade show mt-4" role="alert"
                        data-dismiss="alert" style="cursor: pointer;">
                        <strong class="d-flex items-center justify-content-center">
                            {{ session('saved') }}
                        </strong>
                    </div>
                @elseif (session()->has('deleted'))
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert"
                        data-dismiss="alert" style="cursor: pointer;">
                        <strong class="d-flex items-center justify-content-center">
                            {{ session('deleted') }}
                        </strong>
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<style>
    .dt-button {
        border: none;
        margin-top: 20px;
        border-radius: 20px;
        padding: 10px 20px;
    }

    .dt-button-collection button {
        transition: 0.3s ease;
        position: absolute;
        color: white;
        background: #adb5bd;
        top: 88px;
    }

    .dt-button-collection button:hover {
        background: #6c757d;
    }

    .dt-button-collection button:nth-child(1) {
        left: 400px
    }

    .dt-button-collection button:nth-child(2) {
        left: 505px
    }

    .dt-button-collection button:nth-child(3) {
        left: 610px
    }

    .dt-button-collection button:nth-child(4) {
        left: 715px
    }
</style>
@endsection
