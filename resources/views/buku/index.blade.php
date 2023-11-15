@include('buku.layout')

<h1 class="text-center m-4">Tabel Buku</h1>
@if (session('pesan'))
    <div class="alert alert-success">
        {{ session('pesan') }}
    </div>
@endif

<div class="container">
    <form action="{{ route('buku.search') }}" method="GET">@csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari..."
            style="width: 30%;
        display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
    </form>
    <a href="{{ route('buku.create') }}"> 
        <button type="button" class="btn btn-primary mb-5"> Tambah Buku Baru
        </button>
    </a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Gambar</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                @if (Auth::user()->role == 'admin')
                    <th>Aksi</th>
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>@if ( $buku->filepath )
                        <div class="">
                            <img
                            class="h-24 w-24"
                            src="{{ asset($buku->filepath) }}"
                            alt=""
                            style="padding-right: 20px;"
                            />
                        </div>
                        @endif

                                                <!-- <div class="relative h-10 w-10">
                            <img
                            class="h-full w-full rounded-full object-cover object-center"
                            src="{{ asset($buku->filepath) }}"
                            alt=""
                            style="padding-right: 20px;"
                            />
                        </div> -->
                    </td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ 'Rp ' . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                    @if (Auth::user()->role == 'admin')
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger"
                                    onclick="return confirm('Apakah Yakin Dihapus?')">Hapus</button>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('buku.edit', $buku->id) }}">Update</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5 d-flex justify-content-center">{{ $data_buku->links() }}</div>
</div>
