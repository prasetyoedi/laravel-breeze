@include('layout')

<h1 class="text-center m-4">Tabel Buku</h1>
@if(session('pesan'))
<div class="alert alert-success">
    {{ session('pesan') }}
</div> @endif <div class="container">
    <form action="{{ route('buku.search') }}" method="GET">@csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%;
        display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
    </form>

    @if(count($data_buku))
    <div class="alert alert-success">
        Ditemukan <b> {{count($data_buku)}}</b> dengan kata <b>{{$cari}}</b>
    </div>
    <a href="/buku" class="btn btn-info">Kembali</a>
    @else
    <div class="alert alert-warning">
        <h4>Data {{($data_buku)}} dengan kata {{$cari}} tidak ditemukan</h4>
        <a href="/buku" class="btn btn-warning">Kembali</a>
    </div>
    @endif

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $buku)
            <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ 'Rp ' . number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('buku.edit', ['id' => $buku->id]) }}">
                        <button type="button" class="btn btn-primary">
                            Edit
                        </button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('yakin mau
                    dihapus?');">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex justify-content-center">{{ $data_buku->links() }}</div>
    <!-- <div>Jumlah Buku : {{$jumlah_buku}}</div> -->


</div>
