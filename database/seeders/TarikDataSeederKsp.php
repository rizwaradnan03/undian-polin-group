<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Undian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TarikDataSeederKsp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $search_data = DB::connection('sqlsrv')->select("select * from tenants where grup = 'polin'");

        foreach ($search_data as $search) {
            $explode = explode(';', $search->database_dsn);
            $connection = $search->database_name;
            $driver = 'sqlsrv';
            $host = str_replace('server=', '', $explode[0]);
            $port = '1433';
            $database = $search->database_name;
            $username = str_replace('uid=', '', $explode[3]);
            $password = str_replace('pwd=', '', $explode[4]);

            Config::set(["database.connections.$connection" => [
                'driver' => $driver,
                'host' => $host,
                'port' => $port,
                'database' => $database,
                'username' => $username,
                'password' => $password,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'options' => extension_loaded('sqlsrv') ? array_filter([
                    "Database" => $database,
                    "UID" => $username,
                    "PWD" => $password,
                    "CharacterSet" => "UTF-8",
                ]) : null,
            ]]);

            $query_simpanans = DB::connection($connection)->select("select tabmaster.*, cif.namalengkap from tabmaster inner join cif on cif.cif = tabmaster.cif where tabmaster.stsbar = '1' and tabmaster.oto = '1' and tabmaster.kodeproduktab = '01'");
            $query_pinjamans = DB::connection($connection)->select("select rps.*, sum(rps.totalangsuran) as totalangsuran , cif.namalengkap from rps inner join cif on cif.cif = rps.cif where rps.tglbyr = rps.tglangsuran group by rps.cif, rps.kodeljk, cif.namalengkap, rps.sandicabang, rps.norekcrd, rps.periode, rps.tglangsuran, rps.saldoawal, rps.saldoakhir, rps.tagpokok, rps.tagbunga, rps.totalangsuran, rps.tagdenda, rps.byrpokok, rps.byrbunga, rps.byrdenda, rps.tglbyr, rps.sukubunga, rps.noakad, rps.jmlharidenda, rps.tglbyrdenda, rps.tglbyrbunga");
            $companyDatabase = Company::where('name','=',$search->name)->first();

            //looping simpanan
            foreach ($query_simpanans as $query_simpanan) {
                for ($i = 1; $i <= intval($query_simpanan->saldoakhir / 100000); $i++) {
                    $Undian = new Undian();
                    $Undian->noacc = substr($query_simpanan->kodeljk, 4,5) . $query_simpanan->norekening;
                    $Undian->no_undian = substr($query_simpanan->kodeljk, 4,5) . '01' . substr($query_simpanan->norekening, 7, 14) . sprintf("%04d", $i);
                    $Undian->nama_lengkap = $query_simpanan->namalengkap;
                    $Undian->point = '1';
                    $Undian->periode_id = '1';
                    $Undian->company_id = $companyDatabase->id;
                    $Undian->status = '0';
                    $Undian->save();
                }
            }

            //looping pinjaman
            foreach($query_pinjamans as $query_pinjaman){
                for ($i = 1; $i <= intval($query_pinjaman->totalangsuran / 100000); $i++) {
                    $Undian = new Undian();
                    $Undian->noacc = substr($query_pinjaman->kodeljk, 4,5) . $query_pinjaman->norekcrd;
                    $Undian->no_undian = substr($query_pinjaman->kodeljk, 4,5) . '02' . substr($query_pinjaman->norekcrd, 7, 14) . sprintf("%04d", $i);
                    $Undian->nama_lengkap = $query_pinjaman->namalengkap;
                    $Undian->point = '1';
                    $Undian->periode_id = '1';
                    $Undian->company_id = $companyDatabase->id;
                    $Undian->status = '0';
                    $Undian->save();
                }
            }
        }
    }
}
