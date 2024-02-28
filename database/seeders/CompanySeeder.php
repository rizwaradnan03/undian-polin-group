<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyNames = [
            'KSP Sinar Mas Kalimantan',
            'KSP Sinar Jaya',
            'KSP Cipta Abadi Mutiara',
            'KSP Gotong Royong',
            'KSP Jaya Abadi',
            'KSP Murni',
            'KSP Pelita Jaya',
            'KSP Pelita Mekar',
            'KSP Pelita Sejahtera',
            'KSP Sehat Ekonomi Mandiri',
            'KSP Serdang Indah Mandiri',
            'KSP Sinar Berlian',
            'KSP Sinar Kandaga',
            'KSP Sinar Murni',
            'KSP Sinar Tama Sejahtera',
            'KSP Stabat Sejahtera',
            'KSP Sinar Pelita Bandung',
            'KSP Sinar Pelita Mas Gresik',
            'KSP Sinar Pelita Mas Surabaya',
            'KSP Sinar Pelita Mas Cijerah',
            'KSP Sinar Pelita Mas Bandung',
            'KSP Sinar Pelita Mas Denpasar',
            'KSP Sinar Pelita Rancaekek',
            'KSP Sinar Pelita Mas Palembang',
            'KSP Sinar Pelita Mas Pekanbaru',
            'KSP Sinar Pelita Mas Mojokerto',
        ];

        for($i = 0; $i < sizeof($companyNames);$i++){
            $company = new Company();
            $company->name = $companyNames[$i];
            $company->save();
        }
    }
}
