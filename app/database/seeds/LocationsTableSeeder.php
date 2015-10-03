<?php


class LocationsTableSeeder extends Seeder
{

    public function run()
    {

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

        ];

        Location::bulkInsert($locations);
    }

}