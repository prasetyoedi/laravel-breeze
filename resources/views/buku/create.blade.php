@include('buku.layout')

<div class="container">
    <h4 class="mt-5 mb-5">Tambah Buku</h4> @if(count($errors) > 0) <ul>
        @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
        </ul> @endif <form method="POST" action="{{route('buku.store')}}"> @csrf <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis Buku</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tanggal" name="tgl_terbit">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/dashboard" class="btn btn-outline-danger">Batal</a>
            </div>
        </div>
</div>
</form>
</div>