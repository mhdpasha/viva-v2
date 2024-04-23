<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arsene Library</title>

    <link rel="icon" href="../img/arsene-lib-logo-white.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


</head>

<body>
    <main class="d-flex justify-content-center align-items-center w-100 h-100 gap-5 mt-5">

        <a id="back" class="btn btn-dark" href="{{ URL::previous() }}">
            < </a>
                <div>
                    <img src="{{ $pinjam->buku->image }}" alt="cover" height="auto" width="530px">
                </div>
                <div>
                    <h1>{{ $pinjam->buku->judul }} <box-icon name='badge-check' type='solid'
                            color='#292b2c'></box-icon></h1>

                    <p style="max-width: 600px">{{ $pinjam->buku->deskripsi }}</p>

                    <h5>Detail Peminjaman</h5>
                    <ul>
                        <li>Status : <span
                                class="p-2 badge bg-{{ $pinjam->history ? 'success' : 'warning' }}">{{ $pinjam->history ? 'Dikembalikan' : 'Dipinjam' }}</span>
                        </li>
                        <li>Peminjam : <b>{{ "{$pinjam->user->nama} [{$pinjam->user->no_induk}]" }} </b></li>
                        <li>Penerima : <b>{{ "{$pinjam->admin->nama} [{$pinjam->admin->role}]" }}</b> </li>
                    </ul>

                    <h5>Detail Buku</h5>
                    <ul>
                        <li>Kategori : <span
                                class="p-2 badge bg-{{ $pinjam->buku->kategori->status == 'aktif' ? 'success' : 'danger' }}">{{ $pinjam->buku->kategori->kode }}</span>
                        </li>
                        <li>Pengarang : {{ $pinjam->buku->pengarang }} </li>
                        <li>Penerbit : {{ $pinjam->buku->penerbit }} </li>
                        <li>Stok tersisa: {{ $pinjam->buku->stok }} </li>
                    </ul>

                </div>
    </main>
</body>
<style>
    #back {
        display: flex;
        height: 200px;
        align-items: center;
        transition: 0.3s ease;
    }

    li {
        list-style-type: "- ";
    }

    img {
        aspect-ratio: 3/4;
        object-fit: cover;
        width: 420px;
        border-radius: 20px;
    }
</style>



</html>
