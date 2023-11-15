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
                <br>
                <div class="col-span-full mt-6">
                    <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                    <div class="mt-2">
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>
                </div>
                <div class="col-span-full mt-5">
                    <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                    <div class="mt-2" id="fileinput_wrapper">
                    </div>
                    <button class="btn btn-primary">
                        <a id="tambah" onclick="addFileInput()">Tambah Input data</a>
                    </button>

                    <script type="text/javascript">
                        function addFileInput() {
                            var div = document.getElementById('fileinput_wrapper');
                            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                        };
                    </script>
                </div>

            </div>
        </div>
    </form>
</div>