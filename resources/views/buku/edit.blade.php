@include('buku.layout')

<div class="container">
    <h4 class="mt-5 mb-5">Edit Buku</h4>
    @if(count($errors) > 0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <form method="POST" action="{{route('buku.update', $buku->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="judul"
                        value="{{$buku->judul}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Penulis Buku</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="penulis"
                        value="{{$buku->penulis}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="harga"
                        value="{{$buku->harga}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_terbit"
                        value="{{$buku->tgl_terbit}}">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/buku" class="btn btn-outline-danger">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
