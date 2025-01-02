<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HrdController extends Controller
{
    public function index()
    {
        $thisday = date('j');
        $thismonth = date('m');
        $thisyear = date('Y');
        $query = "SELECT k.NikKaryawan,k.NamaLengkap, b.NamaBagian, ah.tahun as Tahun, ah.bulan as Bulan, ah.{$thisday} as Kehadiran
            FROM tabsen_karyawan ah, tkaryawan_pribadi k, tbagian b
            WHERE ah.tahun={$thisyear} && ah.bulan={$thismonth} && ah.IdKaryawan = k.IdKaryawan && ah.IdBAgian = b.IdBagian && k.Aktif = 'Ya' && LOWER(ah.{$thisday}) = 'x'
            ORDER BY b.NamaBagian, k.NamaLengkap";
        $data = DB::select($query);
        $bagian = [];

        foreach ($data as $d) {
            $bagian[$d->NamaBagian][] = $d;
        }
        $thisday = date('d');
        $tanggal = "{$thisday}-{$thismonth}-{$thisyear}";
        // return response()->json($bagian);
        return view('home', ['data' => $bagian, 'tanggal' => $tanggal]);
    }

    public function absent()
    {
        $thisday = date('d');
        $thismonth = date('m');
        $thisyear = date('Y');
        $tanggal = "{$thisday}-{$thismonth}-{$thisyear}";
        $query = "SELECT k.NikKaryawan,k.NamaLengkap, b.NamaBagian, ah.tahun as Tahun, ah.bulan as Bulan, ah.{$thisday} as Kehadiran
            FROM tabsen_karyawan ah, tkaryawan_pribadi k, tbagian b
            WHERE ah.tahun={$thisyear} && ah.bulan={$thismonth} && ah.IdKaryawan = k.IdKaryawan && ah.IdBAgian = b.IdBagian && k.Aktif = 'Ya' && LOWER(ah.{$thisday}) = 'x'
            ORDER BY b.NamaBagian, k.NamaLengkap";
        $data = DB::select($query);
        $bagian = [];

        foreach ($data as $d) {
            $bagian[$d->NamaBagian][] = $d;
        }

        // return response()->json($bagian);
        return view('absexport', ['data' => $bagian, 'tanggal' => $tanggal]);
    }

    public function comelate()
    {
        $hari_ini = date('Y-m-d');
        $query = "SELECT k.NikKaryawan, k.NamaLengkap, b.NamaBagian, a.JamMasuk, a.IdAbsenJam as checkin_id 
        FROM tkaryawan_pribadi k, tbagian b, tabsen_jam a 
        WHERE k.Aktif='Ya' && k.IdKaryawan = a.IdKaryawan && b.IdBagian = a.IdBagian && a.TglAbsen='{$hari_ini}' && a.JamMasuk > '07:25:00' ORDER BY NamaBagian, NamaLengkap";

        $data = DB::select($query);
        $bagian = [];

        foreach ($data as $d) {
            $bagian[$d->NamaBagian][] = $d;
        }
        return view('comelate', ['data' => $bagian]);
    }

    public function absmasuk()
    {
        $tgl = date('Y-m-d');
        $query = "SELECT tabsen_jam.*
        , tkaryawan_pribadi.NikKaryawan
        , tkaryawan_pribadi.NamaLengkap
        , tsetting_harikerja.MaxTerlambat
        , tbagian.NamaBagian
            FROM
        tsetting_harikerja
            INNER JOIN tkaryawan_pribadi 
                ON (tsetting_harikerja.IdBagian = tkaryawan_pribadi.IdBagian)
            INNER JOIN tabsen_jam 
                ON (tabsen_jam.IdKaryawan = tkaryawan_pribadi.IdKaryawan)
            INNER JOIN tbagian 
                ON (tkaryawan_pribadi.IdBagian = tbagian.IdBagian)
        WHERE (tabsen_jam.JamMasuk > tsetting_harikerja.MaxTerlambat and tabsen_jam.TglAbsen='$tgl')";

        $data = DB::select($query);
        return response()->json($data);
    }

    public function recheckin(Request $request)
    {
        // dd($request->all());
        // Send Post Curl to http://localhost:8080/www/update-absen.php
        $url = 'http://10.10.10.10/payroll/update-absen.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->all());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        // return $result;
        echo $result;
    }

    public function cuti()
    {
        $onvacation = DB::table('cuti')->where('TanggalMulai', 'LIKE', date('Y') . '%')->where('approved', '1')->orderBy('TanggalMulai', 'asc')->limit(50)->get();
        return view('cuti', ['data' => $onvacation]);
    }

    public function savecuti(Request $request)
    {
        $url = 'http://10.10.10.10/absenqr/save-cuti.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->all());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        // return $result;
        return redirect('/cuti');
    }
}
