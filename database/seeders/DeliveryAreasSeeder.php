<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryArea;

class DeliveryAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery_areas = [
            [
                'delivery_location_id' => 1,
                'area_name' => 'Moi Avenue',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'Tom Mboya',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'Kenyatta Avenue',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'City Hall Way',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'OTC',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'Nyamakima',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'Kamukunji',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 1,
                'area_name' => 'Gikomba',
                'price' => '100'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Museum Hill',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'ICEA Lion',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Westlands',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Kangemi',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Upper Kabete',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Uthiru',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Kikuyu',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Thogoto',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Gitaru',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 2,
                'area_name' => 'Sigona',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'CID Headquaters',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Karura Forest',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Muthaiga',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Ridgeways',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Fourways',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Thindigua',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Kiambu Town',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 3,
                'area_name' => 'Tatu City',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Upper Hill',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Traffic Area',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'KNH',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Adams Arcade',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Jamhuri Estate',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Junction Mall',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Dagoretti Corner',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Dagoretti Market',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Woodley',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Race Course',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Show Ground',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Nairobi Business Park',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Karen',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'The Hub',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Shade Hotel',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Ngong Town',
                'price' => '700'
            ],
            [
                'delivery_location_id' => 4,
                'area_name' => 'Kiserian',
                'price' => '800'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Highway Mall',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Nyayo Stadium',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Nairobi West',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Madaraka',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Tmall',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Wilson Airport',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Carnivore',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Langata',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Bomas of Kenya',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Galleria Mall',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Saiffe Park',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Ongata Rongai',
                'price' => '550'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'JKUAT',
                'price' => '550'
            ],
            [
                'delivery_location_id' => 5,
                'area_name' => 'Karen Hospital',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => 'Spring Valley',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => 'Lower Kabete',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => 'Kitusuru',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => 'Mwimuto',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => "King'eero",
                'price' => '500'
            ],
            [
                'delivery_location_id' => 6,
                'area_name' => 'Wangige',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Fig Tree',
                'price' => '200'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Jamhuri Sec',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Stima Laza',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Parklands',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'City Park',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Highridge',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Muthaiga Mini',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'UN Gigiri',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Village Market',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Rosslyn',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Runda',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Ruaka',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Ndenderu',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Muchatha',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 7,
                'area_name' => 'Banana',
                'price' => '700'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Ngara',
                'price' => '200'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Kariokor',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Pangani',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Eastliegh',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'NYS',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Survey',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Utalii',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Allsops',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Baba Ndogo',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Roasters',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Garden City',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Safari Park',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'TRM',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Roysambu',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Zimmerman',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Thome',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Marurui',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Githurai 44/45',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Mwihoko Githu',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Kasarani Center',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Kasarani Season',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Kasarani Hunter',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Mwiki',
                'price' => '450'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Kahawa (West/ Suk/ Wen)',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Ruiru',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Membley',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 8,
                'area_name' => 'Juja',
                'price' => '700'
            ],
            [
                'delivery_location_id' => 9,
                'area_name' => 'Milimani Area',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 9,
                'area_name' => 'Kawangware',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'South B',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Industrial Area',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Imara Daima',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Emba Village',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Kenya Airways',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Githunguri',
                'price' => '550'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'JKIA',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Katani',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Athi river',
                'price' => '650'
            ],
            [
                'delivery_location_id' => 10,
                'area_name' => 'Kitengela',
                'price' => '800'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Burma',
                'price' => '250'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Shauri Moyo',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Bahati',
                'price' => '300'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Huruma',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Buruburu',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Donholm',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Umoja',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Nasra',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Kariobangi N.',
                'price' => '350'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Kariobangi S.',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Nyayou Estate',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Kayole',
                'price' => '400'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Komarock',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Chokaa',
                'price' => '500'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Ruai',
                'price' => '600'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Kamulu',
                'price' => '1000'
            ],
            [
                'delivery_location_id' => 11,
                'area_name' => 'Joska',
                'price' => '1200'
            ],
        ];

        foreach($delivery_areas as $delivery_area) {
            DeliveryArea::create([
                'delivery_location_id' => $delivery_area['delivery_location_id'],
                'area_name' => $delivery_area['area_name'],
                'price' => $delivery_area['price'],
            ]);
        }
    }
}
