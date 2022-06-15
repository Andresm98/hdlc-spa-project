<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use App\Models\PoliticalDivision;
use App\Http\Controllers\AddressController;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Convert to timetamps
        // $min = strtotime('1900-02-01 00:00:00');
        // $max = strtotime('2022-02-01 00:00:00');

        // Generate random number using above bounds
        // $val = rand($min, $max);

        $array =  [
            [
                1, null, '1791304841001', 'Casa Provincial "San Carlos"', 1,
                '022282996', 'casaprovincialhdlc@gmail.com', '1870-07-15 00:00:00', 8,
                //  Address
                'Calle Bolívar Oe6 110 e Imbabura', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 1, '1791304841001', 'Escuela de Educación Básica "San Carlos"', 2,
                '022282996', 'quito.escuelasancarlos@gmail.com', '1979-04-02 00:00:00', 1,
                //  Address
                'Calle Bolívar Oe6 110 e Imbabura', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1710344522', 'Centro Social San Vicente de Paul', 1,
                '032420231', 'ambatocentrosocialsvp@gmail.com', '1885-12-30 00:00:00', 4,
                //  Address
                'Rocafuerte, 11-62 y Lalama. Barrio Medalla Milagrosa', '180150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1090110450001', 'Unidad Educativa Fiscomisional "Santa Luisa de Marillac"', 1,
                '062906606', 'luisitahdlcatuntaqui@gmail.com', '1920-09-19 00:00:00', 1,
                //  Address
                'Calle General Enríquez 10-37 y García M.', '100202',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0917074718', 'Hospital "José Miguel Rosillo"', 2,
                '072689638', 'cariamanga.hdlc@gmail.com', '1965-03-04 00:00:00', 2,
                //  Address
                'Avenida Loja y José Miguel Rosillo', '110201',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0917074718', 'Hospital "Dr. Guido Díaz Jumbo"', 2,
                '072683010', 'comunidadcatacocha11@gmail.com', '1969-02-04 00:00:00', 2,
                //  Address
                'Av. Shiriculapo y Larinuma', '110901',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1791748786001', 'Unidad Educativa Fiscomisional "Mariana de Jesús"', 1,
                '022360126', 'comunidadhccayambe@gmail.com', '1911-02-28 00:00:00', 1,
                //  Address
                'Calle Sucre E1-31 y Terán', '170250',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1791304845001', 'Centro de Reposo "Hogar Sor Emilia Zumárraga"', 1,
                '022190375', 'emiliazumarragahdlc@gmail.com', '2004-07-28 00:00:00', 6,
                //  Address
                'La Rivera II calle La Caridad 82 y Pío Jaramillo', '170156',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '190160890001', 'Hogar "Miguel León"', 1,
                '072822928', 'comunidadhml@gmail.com', '1870-12-18 00:00:00', 3,
                //  Address
                'Simón Bolívar 1458 y Coronel Talbot', '010150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 9, '1000000000', 'Escuela "Daniel Hermida"', 2,
                '072835328', 'lvdani1953@gmail.com', '1870-12-18 00:00:00', 3,
                //  Address
                'Juan Jaramillo 1078 y General Torres', '010150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1792965187001', 'Casa de Retiros "Getsemaní"', 1,
                '022777248', 'getsemanhdlc@gmail.com', '1952-10-03 00:00:00', 5,
                //  Address
                'Lalagachi, Km. 35 vía al Quinche', '170159',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1791304845001', 'Casa "Oasis Marillac"', 1,
                '023614201', 'oasismarillac2015@gmail.com', '2001-06-24 00:00:00', 6,
                //  Address
                'Lalagachi, Km. 35 vía al Quinche', '170159',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 12, '1791304845001', 'Unidad Educativa "Santa Catalina Labouré"', 2,
                '023614201', 'info@santacatalinalab.edu.ec', '2001-06-24 00:00:00', 1,
                //  Address
                'Lalagachi, Km. 35 vía al Quinche', '170159',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1100571452', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '032684023', 'comunidadcorazon@yahoo.com', '1952-10-24 00:00:00', 2,
                //  Address
                'Calle General Enríquez Gallo', '050350',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1704593894', 'Casa Misional "El Triunfo"', 1,
                '072010567', 'casamisionaltriunfo@gmail.com', '1978-02-22 00:00:00', 4,
                //  Address
                'Anselmo Di-Lorenzo 1002 y 9 de Octubre', '090950',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0600484018', 'Casa "La Anunciación"', 1,
                '072010567', 'hdlcesmeraldas@gmail.com', '1985-02-16 00:00:00', 2,
                //  Address
                'Galápagos - B° 20 de noviembre y calle El Oro', '080103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0700291008', 'Casa Misional "San Vicente de Paúl"', 1,
                '032970204', 'svpechandia@gmail.com', '1995-07-05 00:00:00', 4,
                //  Address
                'Avenida 5 de Octubre, Calle Ángel Polivio Chávez', '020450',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0400828331', 'Casa Misional "Nuestra Señora de Fátima"', 1,
                '032798107 ', ' misionfatima@hotmail.com', '1985-01-30 00:00:00', 4,
                //  Address
                'Km. 7 Vía al Tena', '160155',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0991462481001', 'Unidad Educativa "La Providencia"', 1,
                '042400328', 'casahermaprovi@gmail.com', '1905-12-30 00:00:00', 1,
                //  Address
                'Calle Eloy Alfaro, entre Gómez Rendón y Brasil', '090150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 19, '0903930006', 'Hospital "Luis Vernaza"', 2,
                '042303934', ' casavernaza@gmail.com', '1905-12-30 00:00:00', 2,
                //  Address
                'Julián Coronel 404 y Boyacá', '090150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1090027871001', 'Unidad Educativa Fiscomisional "La Inmaculada Concepción"', 1,
                '042400328', 'uefliccdad@yahoo.com', '1985-11-30 00:00:00', 1,
                //  Address
                'Pedro Moncayo 545 y Bolívar', '100103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '591706675001', 'Hogar de Ancianos "Instituto Estupiñán"', 1,
                '032660754', 'hdlclatacunga@hotmail.com', '1914-01-24 00:00:00', 3,
                //  Address
                'Juan Abel Echeverría N1 10-73 y Napo', '050150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1704841921', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '032801547', 'hdlcinmaculada1885@gmail.com', '1885-12-05 00:00:00', 1,
                //  Address
                'Calle Antonio Vela Nº 2-01 Y Tarqui', '050150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1191700623', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '072570461', 'comunidadlocaluefliloja@gmail.com', '1888-12-30 00:00:00', 1,
                //  Address
                'Bolívar Nº 0935 y Rocafuerte', '110150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0791708427', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '072980500', 'orocomunidad@gmail.com', '1951-05-31 00:00:00', 1,
                //  Address
                'La Carolina Calle Babahoyo y Octava Norte.', '070102',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 25, '1101429726', 'Misión Interprovincial de Huaquillas', 2,
                '090311556', 'moralesluna.c@gmail.com', '2020-03-13 00:00:00', 3,
                //  Address
                'Huaquillas', '070750',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1091704508', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '062920307', 'hdelacaridadotavalo@gmail.com', '1889-10-05 00:00:00', 1,
                //  Address
                'Calle Sucre 509 y Piedrahita', '100450',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1891700977001', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '032873198', 'hcomuninmaculadapillaro@hotmail.com', '1943-07-25 00:00:00', 1,
                //  Address
                'Nueva Ciudadela Girasoles 030 e Ilusiones', '180802',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0791710510001', 'Unidad Educativa Fiscomisional "Sagrado Corazón"', 1,
                '072976010', 'hdlcpinas@hotmail.com', '1944-05-24 00:00:00', 1,
                //  Address
                'Calle José Joaquín de Olmedo y Juan José Loaiza', '071050',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1791131606001', 'Hogar del Niño "San Vicente De Paúl"', 1,
                '022955355', 'hogarsanvip2017@gmail.com', '1874-12-30 00:00:00', 3,
                //  Address
                'Calle Exposición E2-72 y San Vicente de Paúl', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 30, '1790098400001', 'Unidad Educativa Fiscomisional "María De Nazaret"', 2,
                '022956604', 'madena1954@yahoo.com', '1954-09-08 00:00:00', 1,
                //  Address
                'La Recoleta', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 30, '1790442748001', 'Unidad Educativa Fiscomisional "Santa Luisa De Marillac"', 2,
                '022315062', 'uelmachachi@gmail.com', '1905-05-15 00:00:00', 1,
                //  Address
                'Calle García Moreno y Sucre', '170350',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1791304845001', 'Hogar de Ancianos "Santa Catalina Labouré"', 1,
                '022958047', 'comunidadsclbquito@gmail.com', '2002-08-04 00:00:00', 3,
                //  Address
                'La Recoleta E2-142 y la Exposición', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0200866986', 'Casa "Betania"', 1,
                '022235409', 'casabetania2016@gmail.com', '1975-10-26 00:00:00', 6,
                //  Address
                'Floresta, Calle Madrid 316-100 y Tolosa', '170350',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0400876645', 'Residencia "Santa Luisa de Marillac"', 1,
                '022545616', 'casasantaluisahdlc@gmail.com', '1910-12-30 00:00:00', 4,
                //  Address
                'Pablo Guevara N. E17-41', '170150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0690015072001', 'Unidad Educativa Fiscomisional "San Vicente de Paúl"', 1,
                '032961710', 'sanvicentedepaulriobamba@hotmail.com', '1875-10-30 00:00:00', 1,
                //  Address
                'Calle Espejo 1852 y Villarroel', '060150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 36, '1790155137', 'Misión de Flores', 2,
                '033017943', 'mindeflor95@gmail.com', '1984-11-20 00:00:00', 4,
                //  Address
                'Kilometro 1 Vía a Guamote', '060154',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '190301575001', 'Unidad Educativa Fiscomisional "La Inmaculada"', 1,
                '072270283', 'hdlcsantaisabel@yahoo.com', '1951-12-30 00:00:00', 1,
                //  Address
                'José Peralta y Fidel Rosales (Junto a la Farmacia San Antonio)', '010850',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1101841680', 'Hospital Fiscomisional "Divina Providencia"', 1,
                '062781898', 'hdlcsanlorenzo2017@gmail.com', '1989-11-02 00:00:00', 3,
                //  Address
                'Barrio Kenedy, Avenida Carchi y S/N', '080550',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0300802071', 'Casa Misional "Margarita Naseau"', 1,
                '022750581', 'casamisionalmargaritanaseau@hotmail.com', '1953-10-19 00:00:00', 4,
                //  Address
                'Av. Quito, Nº 12 – 36 entre Rio Chimbo y Pallatanga', '230106',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0491503696001', 'Unidad Educativa Fiscomisional "Pablo Muñoz Vega"', 1,
                '062290017', 'hcsangabriel@gmail.com', '1992-12-30 00:00:00', 1,
                //  Address
                'Rocafuerte 11-10 entre García Moreno y Olmedo', '040550',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 41, '0491509252001', 'Unidad Educativa Fiscomisional "Medalla Milagrosa"', 2,
                '062287145', 'uemmilagrosa36@yahoo.es', '1936-11-27 00:00:00', 1,
                //  Address
                'Gran Colombia y Julio Andrade', '040250',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '0602487225', 'Misión "San Vicente de Paúl"', 1,
                '062323205', 'misionsanvicentedepaul@gmail.com', '1995-10-09 00:00:00', 4,
                //  Address
                'Av. Dos Ríos 629', '150150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 43, '0602487225', 'Unidad Educativa Fiscomisional Hermano Miguel', 2,
                '062886317', 'uhermanomigueltena@gmail.com', '1995-10-09 00:00:00', 1,
                //  Address
                'Av. Dos Ríos 629', '150150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 43, '1801667005', 'Unidad Educativa "Pacifico Cembranos"', 2,
                '062367235', 'glosu180@gmail.com', '2016-08-22 00:00:00', 1,
                //  Address
                'Av. Gonzalo Marañon Km2', '210150',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1391708483001', 'Unidad Educativa Fiscomisional "Santa Luisa de Marillac"', 1,
                '052330213', 'csluisatosagua@gmail.com', '1944-04-30 00:00:00', 1,
                //  Address
                'Calle 24 de mayo y Eloy Alfaro', '131550',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1002860110', 'Hospital "Luis Gabriel Dávila"', 1,
                '062236903', 'comunidadlgd@hmail.com', '1932-12-30 00:00:00', 2,
                //  Address
                'Avenida San Francisco y Gustavo Backer', '040102',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1900244151', 'Casa "Medalla Milagrosa"', 1,
                '072605229', 'cmedallamilagrosa34@hotmail.com', '1967-11-05 00:00:00', 4,
                //  Address
                'AJosé Luis Tamayo y Avenida Loja', '190102',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 1, '1791304841001', 'Casa de formación Santa Luisa de Marillac - Postulantado', 2,
                '022282996', 'postulantadosancarlos@gmail.com', '1979-04-02 00:00:00', 7,
                //  Address
                'Calle Bolívar Oe6 110 e Imbabura', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, 1, '1791304841001', 'Curia Provincial', 2,
                '022282996', 'curiaprovincialsancarlos@gmail.com', '1979-04-02 00:00:00', 7,
                //  Address
                'Calle Bolívar Oe6 110 e Imbabura', '170103',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
            [
                1, null, '1900244151', 'Otras', 1,
                '072605229', 'otracomunidadhdlc@hotmail.com', '1967-11-05 00:00:00', 4,
                //  Address
                'Otra dirección', '999999',
                // Inventory
                'Nombre de Inventario ', 'Descripción del Inventario '
            ],
        ];

        $addressClass = new AddressController();


        foreach ($array as list(
            $status, $comm_id, $id_card, $comm_name, $comm_level,
            $comm_phone, $comm_email, $date_fndt_comm, $pastoral_id,
            $address, $political_division_id,
            $name_inventory, $description_inventory
        )) {
            $arrayAddress =  $addressClass->getActualAddress($political_division_id);
            $data_province = $arrayAddress["data_province"];
            $data_canton = $arrayAddress["data_canton"];
            // $name_parish =  strtolower($name_parish);

            $commmunity =   Community::create([
                'comm_status' => $status,
                'comm_id' => $comm_id,
                'comm_identity_card' => $id_card,
                'comm_name' => $comm_name . ' de ' .  $data_province . ', ' . $data_canton,
                'comm_slug' => Str::slug($comm_name . ' de ' . $arrayAddress["data_province"] . ' ' . $arrayAddress["data_parish"]),
                'comm_level' => $comm_level,
                'comm_phone' => $comm_phone,
                'comm_email' => $comm_email,
                'date_fndt_comm' => $date_fndt_comm,
                'rn_collaborators' => 1,
                'pastoral_id' => $pastoral_id
            ]);

            $commmunity->address()->create([
                'address' => $address,
                'political_division_id' => '' . $political_division_id,
            ]);

            $commmunity->inventory()->create([
                'name' => $name_inventory,
                'description' => $description_inventory,
            ]);
        }





        // for ($i = 0; $i <= 120; $i++) {

        //     // Convert to timetamps
        //     $min = strtotime('1900-02-01 00:00:00');
        //     $max = strtotime('2022-02-01 00:00:00');

        //     // Generate random number using above bounds
        //     $val = rand($min, $max);

        //     // Convert back to desired date format

        //     $name_community = 'COMUNIDAD ' . Str::random(10);
        //     $commmunity = Community::create([
        //         'comm_identity_card' => Str::random(10),
        //         'comm_name' => $name_community,
        //         'comm_slug' => Str::slug($name_community),
        //         'comm_level' => 1,
        //         'comm_cellphone' =>  Str::random(6),
        //         'comm_phone' => Str::random(6),
        //         'comm_email' => Str::random(10) . '@gmail.com',
        //         'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
        //         'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
        //         'comm_status' => rand(1, 0),
        //         'rn_collaborators' => $i * 3,
        //         "zone_id" =>  rand(1, 6),
        //         'pastoral_id' => rand(1, 9)
        //     ]);

        //     if ($commmunity->comm_status == 0) {
        //         $commmunity->update([
        //             'date_close' => date('Y-m-d H:i:s', $val),
        //         ]);
        //     }

        //     $political_division_id =   PoliticalDivision::where('level', '=', 3)
        //         ->where('last_level', '=', 'Y')
        //         ->inRandomOrder()
        //         ->first();

        //     if (strlen($political_division_id->id) == 6) {
        //         $commmunity->address()->create([
        //             'address' => 'Dirr de ' . $name_community,
        //             'political_division_id' => '' . $political_division_id->id . '',
        //         ]);
        //     } else {
        //         $commmunity->address()->create([
        //             'address' => 'Dirr de ' . $name_community,
        //             'political_division_id' => '0' . $political_division_id->id . '',
        //         ]);
        //     }



        //     $commmunity->inventory()->create([
        //         'name' => $name_community,
        //         'description' => 'Description for ' . $name_community
        //     ]);

        //     for ($j = 0; $j <= 2; $j++) {
        //         $name_section = 'Secion ' . $j . ' name for ' . $name_community;

        //         $section =    $commmunity->inventory->sections()->create([
        //             'name' => $name_section,
        //             'slug' => Str::slug($name_section),
        //             'description' => 'Description section for ' . $name_community . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
        //         ]);

        //         for ($u = 0; $u <= 5; $u++) {
        //             $section->articles()->create([
        //                 "name" => Str::random(30),
        //                 "color" => Str::random(15),
        //                 "price" => 10,
        //                 "material" => rand(1, 5),
        //                 "status" =>  rand(1, 5),
        //                 "size" => "0.5",
        //                 "brand" => "buena",
        //                 "description" => "description product",
        //                 "section_id" => $section->id
        //             ]);
        //         }
        //         $name_section = "";
        //     }

        //     $name_community = '';
        // }

        // for ($i = 1; $i <= 3; $i++) {
        //     if ($i % 2 == 0) {
        //         for ($j = 0; $j <= 2; $j++) {

        //             // Convert to timetamps
        //             $min = strtotime('1900-02-01 00:00:00');
        //             $max = strtotime('2022-02-01 00:00:00');

        //             // Generate random number using above bounds
        //             $val = rand($min, $max);

        //             // Convert back to desired date format

        //             $name_work = 'OBRA ' . Str::random(14);
        //             $work = Community::create([
        //                 'comm_id' => $i,
        //                 'comm_identity_card' => Str::random(10),
        //                 'comm_name' => $name_work,
        //                 'comm_slug' => Str::slug($name_work),
        //                 'comm_level' => 2,
        //                 'comm_cellphone' =>  Str::random(6),
        //                 'comm_phone' => Str::random(6),
        //                 'comm_email' => Str::random(10) . '@gmail.com',
        //                 'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
        //                 'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
        //                 'rn_collaborators' => $j * 3,
        //                 'comm_status' => 1,
        //                 "zone_id" =>  rand(1, 6),
        //                 'pastoral_id' => rand(1, 9)
        //             ]);
        //             $political_division_id =   PoliticalDivision::where('level', '=', 3)
        //                 ->where('last_level', '=', 'Y')
        //                 ->inRandomOrder()
        //                 ->first();
        //             if (strlen($political_division_id->id) == 6) {
        //                 $work->address()->create([
        //                     'address' => 'Dirr de ' . $name_work,
        //                     'political_division_id' => '' . $political_division_id->id . '',
        //                 ]);
        //             } else {
        //                 $work->address()->create([
        //                     'address' => 'Dirr de ' . $name_work,
        //                     'political_division_id' => '0' . $political_division_id->id . '',
        //                 ]);
        //             }

        //             $work->inventory()->create([
        //                 'name' => $name_work,
        //                 'description' => 'Description work for ' . $name_work
        //             ]);

        //             for ($k = 0; $k <= 2; $k++) {
        //                 $name_section = 'Secion ' . $k . ' name for ' . $name_work;

        //                 $section =  $work->inventory->sections()->create([
        //                     'name' => $name_section,
        //                     'slug' => Str::slug($name_section),
        //                     'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
        //                 ]);

        //                 for ($u = 0; $u <= 3; $u++) {
        //                     $section->articles()->create([
        //                         "name" => Str::random(30),
        //                         "color" => Str::random(15),
        //                         "price" => 10,
        //                         "material" => rand(1, 5),
        //                         "status" =>  rand(1, 5),
        //                         "size" => "0.5",
        //                         "brand" => "buena",
        //                         "description" => "description product",
        //                         "section_id" => $section->id
        //                     ]);
        //                 }
        //                 $name_section = "";
        //             }

        //             $name_work = "";
        //         }
        //     } else {
        //         for ($j = 0; $j <= 2; $j++) {
        //             // Convert to timetamps
        //             $min = strtotime('1900-02-01 00:00:00');
        //             $max = strtotime('2022-02-01 00:00:00');

        //             // Generate random number using above bounds
        //             $val = rand($min, $max);

        //             // Convert back to desired date format
        //             $name_work = 'OBRA ' . Str::random(14);
        //             $work =  Community::create([
        //                 'comm_id' => $i,
        //                 'comm_identity_card' => Str::random(10),
        //                 'comm_name' => $name_work,
        //                 'comm_slug' => Str::slug($name_work),
        //                 'comm_level' => 2,
        //                 'comm_cellphone' =>  Str::random(6),
        //                 'comm_phone' => Str::random(6),
        //                 'comm_email' => Str::random(10) . '@gmail.com',
        //                 'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
        //                 'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
        //                 'rn_collaborators' => $j * 3,
        //                 'comm_status' => 1,
        //                 "zone_id" =>  rand(1, 6),
        //                 'pastoral_id' => rand(1, 9)
        //             ]);
        //             $political_division_id =   PoliticalDivision::where('level', '=', 3)
        //                 ->where('last_level', '=', 'Y')
        //                 ->inRandomOrder()
        //                 ->first();
        //             if (strlen($political_division_id->id) == 6) {
        //                 $work->address()->create([
        //                     'address' => 'Dirr de ' . $name_work,
        //                     'political_division_id' => '' . $political_division_id->id . '',
        //                 ]);
        //             } else {
        //                 $work->address()->create([
        //                     'address' => 'Dirr de ' . $name_work,
        //                     'political_division_id' => '0' . $political_division_id->id . '',
        //                 ]);
        //             }

        //             $work->inventory()->create([
        //                 'name' => $name_work,
        //                 'description' => 'Description work for ' . $name_work
        //             ]);

        //             for ($k = 0; $k <= 2; $k++) {
        //                 $name_section = 'Secion ' . $k . ' name for ' . $name_work;

        //                 $section = $work->inventory->sections()->create([
        //                     'name' => $name_section,
        //                     'slug' => Str::slug($name_section),
        //                     'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
        //                 ]);

        //                 for ($u = 0; $u <= 5; $u++) {
        //                     $section->articles()->create([
        //                         "name" => Str::random(30),
        //                         "color" => Str::random(15),
        //                         "price" => 10,
        //                         "material" => rand(1, 5),
        //                         "status" =>  rand(1, 5),
        //                         "size" => "0.5",
        //                         "brand" => "buena",
        //                         "description" => "description product",
        //                         "section_id" => $section->id
        //                     ]);
        //                 }
        //                 $name_section = "";
        //             }

        //             $name_work = "";
        //         }
        //     }
        // }
    }
}
