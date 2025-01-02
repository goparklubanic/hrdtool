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
                        <a class="nav-link active" href="/comelate">Comming Late</a>
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
              Karyawan Terlambat Absen Tanggal: {{ date('d-m-Y') }}
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
                          <th>Jam Masuk</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $chkid = []; ?>
                        @foreach($emp as $e)
                          <tr>
                            <td>{{ $e->NikKaryawan }}<br/></td>
                            <td>
                              {{ $e->NamaLengkap }}
                            </td>
                            <td>
                                {{ $e->JamMasuk }}
                            </td>
                          </tr>
                          <?php $chkid[] = $e->checkin_id; ?>
                        @endforeach
                      </tbody>
                    </table>
                    <form action="{{ url('/recheckin') }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                      @csrf
                      <input type="hidden" name="chkid" value="{{ implode(',', $chkid) }}">
                      <div class="col-12">
                        <label class="visually-hidden" for="inlineFormSelectPref">Set To</label>
                        <div class="input-group">
                            <div class="input-group-text">Set To</div>
                            <select class="form-select" name="JamMasuk" id="checkin_time">
                              <option selected>Choose...</option>
                              <option value="07:25:00">07:25:00</option>n>
                              <option value="07:55:00">07:55:00</option>n>
                            </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
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
  </body>
</html>