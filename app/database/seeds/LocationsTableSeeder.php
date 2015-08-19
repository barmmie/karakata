<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LocationsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        DB::table('locations')->delete();

        $locations = [

            [
                'name' => 'Andorra la Vella',
                'latitude' => '42.50779',
                'longitude' => '1.52109',
                'parentName' => 'Andorra',
                'geonameid' => 3041563

            ],
            [
                'name' => 'La Margineda',
                'latitude' => '42.48599',
                'longitude' => '1.49024',
                'parentName' => 'Andorra',
                'geonameid' => 7302102
            ],
            [
                'name' => 'Santa Coloma',
                'latitude' => '42.49454',
                'longitude' => '1.49897',
                'parentName' => 'Andorra',
                'geonameid' => 3039181
            ],
            [
                'name' => 'Bordes de Envalira',
                'latitude' => '42.55962',
                'longitude' => '1.68576',
                'parentName' => 'Andorra',
                'geonameid' => 8260083
            ],
            [
                'name' => 'Canillo',
                'latitude' => '42.5676',
                'longitude' => '1.59756',
                'parentName' => 'Andorra',
                'geonameid' => 3041204
            ],
            [
                'name' => 'El Tarter',
                'latitude' => '42.57952',
                'longitude' => '1.65362',
                'parentName' => 'Andorra',
                'geonameid' => 3039154
            ],
            [
                'name' => 'El Vilar',
                'latitude' => '42.57204',
                'longitude' => '1.608',
                'parentName' => 'Andorra',
                'geonameid' => 3040694
            ],
            [
                'name' => 'Els Plans',
                'latitude' => '42.58142',
                'longitude' => '1.63273',
                'parentName' => 'Andorra',
                'geonameid' => 3040709
            ],
            [
                'name' => 'Incles',
                'latitude' => '42.58285',
                'longitude' => '1.66267',
                'parentName' => 'Andorra',
                'geonameid' => 8260082
            ],
            [
                'name' => 'Meritxell',
                'latitude' => '42.55403',
                'longitude' => '1.59087',
                'parentName' => 'Andorra',
                'geonameid' => 3039862
            ],
            [
                'name' => 'Molleres',
                'latitude' => '42.55093',
                'longitude' => '1.58985',
                'parentName' => 'Andorra',
                'geonameid' => 3039819
            ],
            [
                'name' => 'Prats',
                'latitude' => '42.56003',
                'longitude' => '1.59396',
                'parentName' => 'Andorra',
                'geonameid' => 3039386
            ],
            [
                'name' => 'Ransol',
                'latitude' => '42.58137',
                'longitude' => '1.63812',
                'parentName' => 'Andorra',
                'geonameid' => 3039320
            ],
            [
                'name' => 'Sant Joan de Caselles',
                'latitude' => '42.57116',
                'longitude' => '1.60761',
                'parentName' => 'Andorra',
                'geonameid' => 3039166
            ],
            [
                'name' => 'Soldeu',
                'latitude' => '42.57688',
                'longitude' => '1.66769',
                'parentName' => 'Andorra',
                'geonameid' => 3038999
            ],
            [
                'name' => "l'Aldosa de canillo'",
                'latitude' => '42.57895',
                'longitude' => '1.62902',
                'parentName' => 'Andorra',
                'geonameid' => 3040140
            ],
            [
                'name' => 'Encamp',
                'latitude' => '42.53474',
                'longitude' => '1.58014',
                'parentName' => 'Andorra',
                'geonameid' => 3040686
            ],
            [
                'name' => 'Les Bons',
                'latitude' => '42.53873',
                'longitude' => '1.58649',
                'parentName' => 'Andorra',
                'geonameid' => 3040067
            ],
            [
                'name' => 'Pas de la Casa',
                'latitude' => '42.54277',
                'longitude' => '1.73361',
                'parentName' => 'Andorra',
                'geonameid' => 3039604
            ],
            [
                'name' => 'Vila',
                'latitude' => '42.53176',
                'longitude' => '1.56654',
                'parentName' => 'Andorra',
                'geonameid' => 3038832
            ],
            [
                'name' => 'Engordany',
                'latitude' => '42.51115',
                'longitude' => '1.54118',
                'parentName' => 'Andorra',
                'geonameid' => 3040648
            ],
            [
                'name' => 'Escaldes-Engordany',
                'latitude' => '42.50729',
                'longitude' => '1.53414',
                'parentName' => 'Andorra',
                'geonameid' => 3040051
            ],
            [
                'name' => 'Ràmio',
                'latitude' => '42.49734',
                'longitude' => '1.57401',
                'parentName' => 'Andorra',
                'geonameid' => 3039322
            ],

            [
                'name' => 'Escàs',
                'latitude' => '42.54643',
                'longitude' => '1.50895',
                'parentName' => 'Andorra',
                'geonameid' => 3040601
            ],
            [
                'name' => 'La Massana',
                'latitude' => '42.54499',
                'longitude' => '1.51483',
                'parentName' => 'Andorra',
                'geonameid' => 3040132
            ],
            [
                'name' => 'Mas de Ribafeta',
                'latitude' => '42.56932',
                'longitude' => '1.48858',
                'parentName' => 'Andorra',
                'geonameid' => 3039896
            ],
            [
                'name' => 'Pal',
                'latitude' => '42.54592',
                'longitude' => '1.47524',
                'parentName' => 'Andorra',
                'geonameid' => 3039634
            ],
            [
                'name' => 'Sispony',
                'latitude' => '42.53368',
                'longitude' => '1.51613',
                'parentName' => 'Andorra',
                'geonameid' => 3039077
            ],
            [
                'name' => 'Xixerella',
                'latitude' => '42.55327',
                'longitude' => '1.48736',
                'parentName' => 'Andorra',
                'geonameid' => 3038816
            ],

            [
                'name' => 'Aixirivall',
                'latitude' => '42.46245',
                'longitude' => '1.50209',
                'parentName' => 'Andorra',
                'geonameid' => 3041604
            ],
            [
                'name' => 'Aixovall',
                'latitude' => '42.4764',
                'longitude' => '1.48899',
                'parentName' => 'Andorra',
                'geonameid' => 3041598
            ],
            [
                'name' => 'Aixàs',
                'latitude' => '42.48647',
                'longitude' => '1.46838',
                'parentName' => 'Andorra',
                'geonameid' => 3041609
            ],
            [
                'name' => 'Aubinyà',
                'latitude' => '42.4531',
                'longitude' => '1.49247',
                'parentName' => 'Andorra',
                'geonameid' => 3041475
            ],
            [
                'name' => 'Bixessarri',
                'latitude' => '42.48197',
                'longitude' => '1.46052',
                'parentName' => 'Andorra',
                'geonameid' => 3041375
            ],
            [
                'name' => 'Certers',
                'latitude' => '42.47457',
                'longitude' => '1.50611',
                'parentName' => 'Andorra',
                'geonameid' => 3041098
            ],
            [
                'name' => 'Fontaneda',
                'latitude' => '42.45405',
                'longitude' => '1.46471',
                'parentName' => 'Andorra',
                'geonameid' => 3040437
            ],
            [
                'name' => 'Juberri',
                'latitude' => '42.44',
                'longitude' => '1.49194',
                'parentName' => 'Andorra',
                'geonameid' => 3040200
            ],
            [
                'name' => 'Llumeneres',
                'latitude' => '42.47229',
                'longitude' => '1.51165',
                'parentName' => 'Andorra',
                'geonameid' => 3039959
            ],
            [
                'name' => 'Mas d’Alins',
                'latitude' => '42.44112',
                'longitude' => '1.45128',
                'parentName' => 'Andorra',
                'geonameid' => 3039901
            ],
            [
                'name' => 'Nagol',
                'latitude' => '42.47142',
                'longitude' => '1.50231',
                'parentName' => 'Andorra',
                'geonameid' => 3039757
            ],
            [
                'name' => 'Sant Julià de Lòria',
                'latitude' => '42.46372',
                'longitude' => '1.49129',
                'parentName' => 'Andorra',
                'geonameid' => 3039163
            ],
            [
                'name' => 'Ansalonga',
                'latitude' => '42.56881',
                'longitude' => '1.52198',
                'parentName' => 'Andorra',
                'geonameid' => 3041546
            ],
            [
                'name' => 'Arans',
                'latitude' => '42.58226',
                'longitude' => '1.51844',
                'parentName' => 'Andorra',
                'geonameid' => 3041541
            ],
            [
                'name' => 'El Serrat',
                'latitude' => '42.6183',
                'longitude' => '1.53912',
                'parentName' => 'Andorra',
                'geonameid' => 3040737
            ],
            [
                'name' => 'La Cortinada',
                'latitude' => '42.57423',
                'longitude' => '1.51845',
                'parentName' => 'Andorra',
                'geonameid' => 3040154
            ],
            [
                'name' => 'Les Salines',
                'latitude' => '42.60952',
                'longitude' => '1.53697',
                'parentName' => 'Andorra',
                'geonameid' => 3040027
            ],
            [
                'name' => 'Les Sobiranes',
                'latitude' => '42.62006',
                'longitude' => '1.53988',
                'parentName' => 'Andorra',
                'geonameid' => 3040025
            ],
            [
                'name' => 'Llorts',
                'latitude' => '42.59625',
                'longitude' => '1.52658',
                'parentName' => 'Andorra',
                'geonameid' => 3039979
            ],
            [
                'name' => 'Ordino',
                'latitude' => '42.55623',
                'longitude' => '1.53319',
                'parentName' => 'Andorra',
                'geonameid' => 3039678
            ],
            [
                'name' => 'Segudet',
                'latitude' => '42.55713',
                'longitude' => '1.53808',
                'parentName' => 'Andorra',
                'geonameid' => 3039132
            ],
            [
                'name' => 'Sornàs',
                'latitude' => '42.56461',
                'longitude' => '1.52757',
                'parentName' => 'Andorra',
                'geonameid' => 3038987]
        ];

        Location::bulkInsert($locations);
    }

}