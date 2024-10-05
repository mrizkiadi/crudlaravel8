<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD LARAVEL 8</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>

    <div class="container">
        <a href="/tambahpegawai" class="btn btn-success mb-3">Tambah +</a>
        
        <div class="row g-3 align-items-center">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label mb-2">Search Nama</label>
          </div>
          <div class="col-auto">
            <form action="/pegawai" method="GET">
              <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Input Name" class="mb-2">
            </form>
          </div>
          <div class="col-auto">
            <a href="/exportpdf" class="btn btn-warning mb-2 text-black">Export PDF</a>
          </div>
          
          <div class="col-auto">
            <a href="/exportexcel" class="btn btn-info mb-2 text-black">Export Excel</a>
          </div>

          <div class="col-auto mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Import Excel
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importexcel" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                  <div class="form-group">
                    <input type="file" name="file" required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
        <div class="row">
        @if($message = Session::get('success'))        
            <div class="alert alert-info" role="alert">
              {{ $message }}
            </div>
        @elseif ($message = Session::get('hapus'))
        <div class="alert alert-danger" role="alert">
          {{ $message }} 
        </div>
        {{-- @else
        <div class="alert alert-warning" role="alert">
          {{ $message }} 
        </div> --}}
        @endif

        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Foto</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No Handphone</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Dibuat 2</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;   
              ?>
                {{-- @foreach ($data as $row) --}}
                @foreach ($data as $index => $row)
                <tr>
                    <th scope="row">{{ $index + $data->firstitem() }}</th>
                    <td>{{ $row->nama }}</td>
                    <td>
                      <img src="{{ asset('fotopegawai/'. $row->foto) }}" style="width: 40px" alt="">
                    </td>
                    <td>{{ $row->jeniskelamin }}</td>
                    <td>0{{ $row->notelpon }}</td>
                    <td>{{ $row->created_at->format('D M Y'); }}</td>
                    <td>{{ $row->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="/tampilkandata/{{ $row->id }}" class="btn btn-info text-white">Edit</a>
                      <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
                    </td>
                  </tr>
                @endforeach
              
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>

  </body>
  
  <script>
    $('.delete').click(function(){
      var pegawaiid = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');
      swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data pegawai dengan id "+pegawaiid+" dengan nama "+nama+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "/delete/"+pegawaiid+""
        swal("Data Berhasil Dihapus", {
          icon: "success",
        });
      } else {
        swal("Data tidak jadi dihapus");
      }
    });
  });
  </script>

  <script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
  </script>
</html>