<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Mint;
use App\Mintmark;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $f =  Faker\Factory::create();
        $emperors = ["Nerva", "Trajan", "Hadrian", "Antoninus Pius", "Lucius Verus", "Marcus Aurelius", "Commodus", "Pertinax","Didius Julianus","Severus",
        "Caracalla","Geta","Macrinus","Diadumenian","Elagabalus","Severus Alexander","Maximinus I","Gordian I","Gordian II","Pupienus",
        "Balbinus","Gordian III","Philip I","Trajan Decius","Hostilian","Trebonianus Gallus","Aemilianus","Valerian","Gallienus","Claudius II Gothicus",
        "Quintillus","Aurelian","Marcus Claudius Tacitus","Florian","Probus","Carus","Numerian","Carinus"];
        
        $denominations = ["Solidus","Semissis","Scripulum","Miliarense","Siliquae","AE 1",
        "AE 2","AE 3","AE 4","Aureus","Denarius","Quinarius","Sestertius",
        "Dupondius","As","Semis","Quadrans"];
        $mids = Mint::pluck('id')->toArray();
        for ($i = 50; $i<1050; $i++ ) {        
            DB::table('coins')->insert(
                [
                    "field_inventory" => $f->numberBetween(1, 10000) . "/" . $f->numberBetween(1960, 2017) ,
                    "bag_number" => $i,
                    "emperor" => $f->randomElement($emperors),
                    "obverse" => $f->words(3, true),
                    "reverse" => $f->words(5, true),
                    "emission" => $f->numberBetween(1,500),
                    "weight" => $f->randomFloat(2,1,80),
                    "diameter" => $f->numberBetween(10, 50),
                    "denomination" => $f->randomElement($denominations),
                    "axis" => $f->numberBetween(1,12),
                    "reference" => "RIC " . $f->numberBetween(1,500),
                    "location" => $f->sentence(8,true),
                    "find_date" => $f->dateTimeBetween('-3 years', 'now', null),
                    "square" => $f->randomElement(["A", "B", "C", "D"]) . "/" . $f->numberBetween(1,6),
                    //"created_at" => ,
                    //"updated_at" => ,
                    "mint_id" =>  $randomMid = $f->randomElement($mids),
                    "mintmark_id" => $f->randomElement(Mintmark::where('mint_id', $randomMid)->pluck('id')->toArray()),
                    "obverse_photo" => \Cloudinary\Uploader::upload($f->image('storage/app/public', 500, 500, 'cats'))['url'],
                    "reverse_photo" => \Cloudinary\Uploader::upload($f->image('storage/app/public', 500, 500, 'cats'))['url']
                    
                ]
            );
        }
    }
    public function imgFname($s)
    {
        $n = explode('/', $s);
        return $n[count($n) -1];
    }

    foreach ($r['resources'] as $d) {
        if (Coin::where('obverse_photo', $d['url'])->count() > 0) {
            $c = Coin::where('obverse_photo', $d['url'])->first();
            $c->obverse_photo_pid = $d['public_id'];
            $c->save();
        } else if (Coin::where('reverse_photo', $d['url'])->count() > 0){
            $c = Coin::where('reverse_photo', $d['url'])->first();
            $c->reverse_photo_pid = $d['public_id'];
            $c->save();
        }
    }
}
