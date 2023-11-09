@include('buku.layout')

<div class="container">
    <h4 class="mt-5 mb-5">Edit Buku</h4> @if(count($errors) > 0) <ul> @foreach($errors->all() as $error) <li
        class="alert alert-danger">{{ $error }}</li> @endforeach </ul> @endif <form method="POST"
        action="{{route('buku.update', $buku->id)}}" enctype="multipart/form-data"> @csrf <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="judul" value="{{$buku->judul}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Penulis Buku</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="penulis"
                value="{{$buku->penulis}}">
                </div>
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Harga</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="harga" value="{{$buku->harga}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_terbit"
                    value="{{$buku->tgl_terbit}}">
                    </div>
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
                    <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah Input data</a>
                    <script type="text/javascript">
                        function addFileInput() {
                            var div = document.getElementById('fileinput_wrapper');
                            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                        };
                    </script>
                </div>

                <div class="gallery_items">
                    @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item">
                        <img class="rounded-full object-cover object-center" src="{{ asset($gallery->path) }}" alt=""
                            width="400" />
                    </div>
                    @endforeach
                </div>

                <div class='mt-5'>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/dashboard" class="btn btn-outline-danger">Batal</a>
                </div>
            </div>
        </div>
        </form>
</div>