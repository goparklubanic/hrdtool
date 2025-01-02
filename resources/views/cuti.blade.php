<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRD Helper:dev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link" href="/attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/comelate">Comming Late</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="/cuti">Vacation</a>
                    </li>
                  </ul>
            </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <p class="h3">
              Daftar Cuti Karyawan
            </p>
          </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center mb-5">
                <button class="btn btn-primary" id="btnTambahCuti">Tambah Cuti</button>
            </div>
        </div>
        <div class="row my-3" id="formcuti" style="display: none">
            <div class="col-4">
                <div class="form-group row mb-2">
                    <div class="col-10">
                        <input type="text" id="findNamaKaryawan" class="form-control" placeholder="Cari Nama Karyawan">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" id="findKDataKaryawan">Cari</button>
                    </div>
                </div>
                <div class="list-group" id="resultKaryawan"></div>                
            </div>
            <div class="col-8">
                <form action="{{ url('/save-cuti') }}" method="post">
                  @csrf
                    <div class="form-group row mb-2">
                        <label for="NikKaryawan" class="col-2">Nik Karyawan</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="NikKaryawan" name="NikKaryawan">
                        </div>
                        <label for="NamaLengkap" class="col-2">Nama Lengkap</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="NamaBagian" class="col-2">Nama Bagian</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="NamaBagian" name="NamaBagian">
                        </div>
                        <label class="col-2">Tgl Pengajuan</label>
                        <div class="col-4">
                            <input type="date" name="TanggalPengajuan" id="TanggalPengajuan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="TanggalMulai" class="col-2">Mulai Tanggal</label>
                        <div class="col-4">
                            <input type="date" name="TanggalMulai" id="TanggalMulai" class="form-control">
                        </div>
                        <label for="TanggalSelesai" class="col-2">Sampai Tanggal</label>
                        <div class="col-4">
                            <input type="date" name="TanggalSelesai" id="TanggalSelesai" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="Keterangan" class="col-2">Keterangan</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                        <label for="approved" class="col-2">Approved</label>
                        <div class="col-4">
                            <select name="approved" id="approved" class="form-control">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end p3-3">
                        <button type="submit" name="save-cuti" value="Simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
          <div class="col" style="min-height: 70vh;">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIK Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Bagian</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Keterangan</th>
                  <th>Approved</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @php $today = date('Y-m-d'); @endphp
                @foreach($data as $ov)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ov->NikKaryawan }}</td>
                  <td>{{ $ov->NamaLengkap }}</td>
                  <td>{{ $ov->NamaBagian }}</td>
                  <td>{{ $ov->TanggalPengajuan }}</td>
                  <td>{{ $ov->TanggalMulai }}</td>
                  <td>{{ $ov->TanggalSelesai }}</td>
                  <td>{{ $ov->keterangan }}</td>
                  <td>{{ $ov->approved == '1' ? 'Ya' : 'Tidak' }}</td>                  
                  <td>
                    @if($ov->TanggalMulai <= $today && $ov->TanggalSelesai >= $today)
                      <span class="badge bg-success">On Progress</span>
                    @elseif($ov->TanggalSelesai < $today)
                      <span class="badge bg-danger">Expired</span>
                    @else
                      <span class="badge bg-warning">Upcoming</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col text-center mb-5">
        <a href="#">Export</a>
      </div>
    </div>
    <div class="row bg-dark">
      <col class="p-3"><small class="text-light text-center">Developed by: <b>PT. Veronique Indonesia &copy;2025</b></small></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script><script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      $("#btnTambahCuti").click(function(){
        $("#formcuti").toggle();
      });

      $("#findKDataKaryawan").click(function(){
        var NamaKaryawan = $("#findNamaKaryawan").val();
        $.ajax({
          url: 'http://10.10.10.10/payroll/query-karyawan.php',
          type: 'post',
          dataType: 'json',
          data: {
            NamaKaryawan: NamaKaryawan
          },
          success: function(response){
            console.log(response);
            $("#resultKaryawan").empty();
            response.forEach(karyawan => {
              $("#resultKaryawan").append(`
              <li class="list-group-item" data-nik="${karyawan.NikKaryawan}" data-nama="${karyawan.NamaLengkap}" data-bagian="${karyawan.NamaBagian}" onClick="setForm(this)">
                <a href="#">
                  ${karyawan.NikKaryawan} | ${karyawan.NamaLengkap} | ${karyawan.NamaBagian}
                </a>
              </li>
              `);
            });
          }
      });
      });
      function setForm(k){
        $("#NikKaryawan").val($(k).data('nik'));
        $("#NamaLengkap").val($(k).data('nama'));
        $("#NamaBagian").val($(k).data('bagian'));
        $("#resultKaryawan").empty();
      }
    </script>
  </body>
</html>