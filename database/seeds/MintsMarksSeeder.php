<?php

use Illuminate\Database\Seeder;

class MintsMarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = 
        [
            "Alexandria"          =>  "AL, ALE, ALEX, SMAL",
            "Ambianum"            =>  "AMB, AMBI",
            "Antiochia"           =>  "AN, ANT, ANTOB, SMAN",
            "Aquileia"            =>  "AQ, AQVI, AQVIL, AQOB, AQPS, SMAQ",
            "Arelatum"            =>  "A, AR, ARL, CON, CONST, KON, KONSTAN",
            "Barcino"             =>  "BA, SMBA",
            "Camulodunum"         =>  "C, CL",
            "Carthage"            =>  "K, KAR, KART, PK", 
            "Cherson"             =>  "CON",
            "Clausentum"          =>  "C, CL",
            "Constantinopolis"    =>  "C, CP, CON, CONS, CONSP, CONOB",
            "Cyzicus"             =>  "CVZ, CVZIC, CYZ, CYZIC, K, KV, KVZ, KY, SMK",
            "Heraclea"            =>  "H, HER, HERAC, HERACI, HERACL, HT, SMH",
            "Londinium"           =>  "L, LI, LN, LON, ML, MLL. MLN, MSL, PLN, PLON, AVG, AVGOB, AVGPS",
            "Lugdunum"            =>  "LD, LG, LVG, LVGD, LVGPS, PLG",
            "Mediolanum"          =>  "MD, MDOB, MDPS, MED",
            "Nicomedia"           =>  "MN, N, NIC, NICO, NIK, SMN",
            "Ostia"               =>  "MOST, OST", 
            "Ravenna"             =>  "RAV, RV, RVPS",
            "Rome"                =>  "R, RM, ROM, ROMA, ROMOB", 
            "Serdica"             =>  "SD, SER, SERD, SMSD",
            "Sirmium"             =>  "SIR, SIRM, SM, SIROB", 
            "Siscia"              =>  "S, SIS, SISC, SISCPS",
            "Thessalonica"        =>  "COM, COMOB, SMTS, TH, THS, THES, THSOB, TE, TES, TESOB, TH, TS, OES", 	
            "Ticinum"             =>  "T",
            "Treveri"             =>  "SMTR, TR, TRE, TROB, TRPS"
        ];

        foreach ($data as $mint => $mintmarks) {
            
            $id = DB::table('mints')->insertGetId(
                [
                    "name" => $mint
                ]
            );
            
            foreach (explode(',', $mintmarks) as $m ) {
                
                DB::table('mintmarks')->insert(
                    [
                        "mark" => trim($m),
                        "mint_id" => $id
                    ]
                );
            }

        }




    }
}
