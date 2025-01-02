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
                      <a class="nav-link active" href="/attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/comelate">Comming Late</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/cuti">Vacation</a>
                    </li>
                  </ul>
            </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <p class="h3">
              Karyawan Tidak / Belum Hadir Tanggal: {{ $tanggal }}
            </p>
          </div>
        </div>
        <div class="row">
          @foreach ($data as $d=>$emp)
          <div class="col-md-4 p-3">
              <div class="card">
                <div class="card-header fw-bold">
                  {{ $d }}
                  <span class="float-end">{{ COUNT($emp) }}</span>
                </div>
                <div class="card-body">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($emp as $e)
                        <tr>
                          <td>{{ $e->NikKaryawan }}</td>
                          <td>
                            {{ $e->NamaLengkap }}
                            <span class="float-end">
                              ({{ $e->Kehadiran }})</td>
                            </span>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          @endforeach
        </div>
    </div>
    <div class="row">
      <div class="col text-center mb-5">
        <a href="/absent">Export</a>
      </div>
    </div>
    <div class="row bg-dark">
      <col class="p-3"><small class="text-light text-center">Developed by: <b>PT. Veronique Indonesia &copy;2025</b></small></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script><script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>