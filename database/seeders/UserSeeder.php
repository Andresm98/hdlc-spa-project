<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Office;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\AppointmentLevel;
use Laravel\Jetstream\Jetstream;
use App\Models\PoliticalDivision;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AddressController;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Admin' => 'admin@gmail.com',
            'Owner' => 'owner@gmail.com',
            'Collaborator' => 'collaborator@gmail.com',
            'Staff' => 'staff@gmail.com',
            'Volunteer' => 'volunteer@gmail.com',
        ];

        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email) {
                return tap(User::create([
                    'username' => 'usernamehdlc' . $name,
                    'slug' => Str::slug('usernamehdlc ' . $name),
                    'name' => $name,
                    'fullnamecomm' => $name,
                    'lastname' => 'last-' . $name,
                    'email' => $email,
                    'password' => Hash::make('secret'),
                ]), function (User $user) {
                    $this->createTeam($user);
                    $user->assignRole('super admin');
                });
            });
        }

        // Create one team
        $team = $this->createBigTeam('owner@gmail.com');

        // assign to team
        $role = 'collaborator';
        $email = 'collaborator@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        $role = 'collaborator';
        $email = 'staff@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        $role = 'visitor';
        $email = 'volunteer@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        // invited

        for ($i = 0; $i <= 5; $i++) {
            $username = 'invited  ' . Str::random(15);
            $slug =  Str::slug($username);
            $user =  User::create([
                'username' => $username,
                'slug' => $slug,
                'name' => Str::random(15),
                'fullnamecomm' => Str::random(15),
                'lastname' =>  Str::random(15),
                'email' =>  $slug .  '@gmail.com',
                'password' => Hash::make('secret'),
            ]);
            $user->assignRole('invited');
            $this->createTeam($user);
        }

        //  secretary
        $username = 'secretary  ' . Str::random(15);
        $slug =  Str::slug($username);
        $user =  User::create([
            'username' => $username,
            'slug' => $slug,
            'name' => Str::random(15),
            'fullnamecomm' => Str::random(15),
            'lastname' =>  Str::random(15),
            'email' =>  'secretary@gmail.com',
            'password' => Hash::make('secret'),
        ]);
        $user->assignRole('secretary');
        $this->createTeam($user);

        // for ($i = 0; $i <= 60; $i++) {
        //     $username = 'secretary  ' . Str::random(15);
        //     $slug =  Str::slug($username);
        //     $user =  User::create([
        //         'username' => $username,
        //         'slug' => $slug,
        //         'name' => Str::random(15),
        //         'fullnamecomm' => Str::random(15),
        //         'lastname' =>  Str::random(15),
        //         'email' =>  $slug .  '@gmail.com',
        //         'password' => Hash::make('secret'),
        //     ]);
        //     $user->assignRole('secretary');
        //     $this->createTeam($user);
        // }

        //  daughter
        // for ($i = 0; $i <= 1; $i++) {
        // Convert to timetamps
        // $min = strtotime('1900-02-01 00:00:00');
        // $max = strtotime('2022-02-01 00:00:00');

        // Generate random number using above bounds
        // $val = rand($min, $max);

        // Convert back to desired date format

        // $username = 'daughter  ' . Str::random(15);
        // $slug =  Str::slug($username);
        // $user =  User::create([
        //     'username' => $username,
        //     'slug' => $slug,
        //     'name' => Str::random(15),
        //     'fullnamecomm' => Str::random(15),
        //     'lastname' =>  Str::random(15),
        //     'email' =>  $slug . '@gmail.com',
        //     'password' => Hash::make('secret'),
        // ]);
        // $user->assignRole('daughter');

        // $political_division_id =   PoliticalDivision::where('level', '=', 3)
        //     ->where('last_level', '=', 'Y')
        //     ->inRandomOrder()
        //     ->first();

        // $profile = $user->profile()->create([
        //     'identity_card' => '1004280135',
        //     'status' => rand(1, 3),
        //     'date_birth' => date('Y-m-d H:i:s', rand($min, $max)),
        //     'date_vocation' => date('Y-m-d H:i:s', $val),
        //     'date_admission' => date('Y-m-d H:i:s', $val),
        //     'date_send' => date('Y-m-d H:i:s', rand($min, $max)),
        //     'date_vote' => date('Y-m-d H:i:s', rand($min, $max)),
        //     'cellphone' => '09967316479',
        //     'phone' => '022405124',
        //     'observation' => 'Observation of ' . $user->name,
        // ]);

        // if ($profile->status == 2) {
        //     $profile->update([
        //         'date_death' => date('Y-m-d H:i:s', $val),
        //     ]);
        // }
        // if ($profile->status == 3) {
        //     $profile->update([
        //         'date_exit' => date('Y-m-d H:i:s', $val),
        //     ]);
        // }

        // if (strlen($political_division_id->id) == 6) {
        //     $profile->address()->create([
        //         'address' => 'Dirr de ' . $user->name,
        //         'political_division_id' =>  $political_division_id->id . '',
        //     ]);
        // } else {
        //     $profile->address()->create([
        //         'address' => 'Dirr de ' . $user->name,
        //         'political_division_id' => '0' . $political_division_id->id . '',
        //     ]);
        // }

        // $comm =  Community::where('comm_status', '=', 1)
        //     ->inRandomOrder()
        //     ->first();


        // $transferData = $profile->transfers()->create([
        //     'transfer_reason' => 'Reason of ' . $user->name,
        //     'transfer_date_adission' => date('Y-m-d H:i:s', rand($min, $max)),
        // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
        //     'transfer_observation' => 'Observation transfer of ' . $user->name,
        //     'community_id' => $comm->id,
        // ]);


        // $appointment =  AppointmentLevel::select('*')
        //     ->where('level', '=', 2)
        //     ->where('last_level', '=', 'Y')
        //     ->inRandomOrder()
        //     ->first();

        // $profile->appointments()->create([
        //     'community_id' =>  $comm->id,
        //     'appointment_level_id' => $appointment->id,
        //     'description' => 'Description transfer of ' . $user->name,
        //     'date_appointment' => date('Y-m-d H:i:s', rand($min, $max)),
        //     'transfer_id' => $transferData->id,
        // ]);
        //     $this->createTeam($user);
        // }



        $array =  [
            [
                "Zoila Dorila", "Aguilera Pruna", "Zoila", "comunidadsclbquito@gmail.com", "900902065",
                "1935-12-29", "1958-03-13", "1963-03-15", "1959-03-12", "999027645", 33,
                $appointments = [14]
            ],
            [
                "Carmen Isabel", "Alban Figueroa", "Carmen", "carmitaisabel@hotmail.com", "1100262649",
                "1946-05-02", "1969-03-15", "1974-03-15", "1970-02-27", "999027645", 33,
                $appointments = [10]
            ],
            [
                "Martha Alicia", "Albuja Vasconez", "Martha", "marthalbuja@gmail.com", "1700354499",
                "1942-06-01", "1968-03-15", "1973-03-15", "1969-03-08", "981506242", 23,
                $appointments = [14]
            ],
            [
                "Elizabeth Narcisa", "Alcivar Alcivar", "Elizabeth", "e.alcivar@hotmail.com", "1304588633",
                "1964-01-18", "1996-09-21", "2003-03-15", "1998-07-01", "983199414", 40,
                $appointments = [14]
            ],
            [
                "María Cecilia", "Alcivar Alcivar", "María Cecilia", "casasantaluisahdlc@gmail.com", "1305236877",
                "1966-03-28", "1996-09-21", "2003-03-15", "1998-07-01", "939943545", 35,
                $appointments = [14]
            ],
            [
                "Jenny Angélica", "Almeida  Maldonado", "Angélica", "angy_jaam86@hotmail.com", "1721904280",
                "1986-10-24", "2007-09-27", "2013-08-15", "2009-07-18", "980829151", 35,
                $appointments = [14]
            ],
            [
                "Blanca Leonor", "Altamirano Guevara", "Leonor", "blancaaltamirano18@hotmail.com", "1701919332",
                "1939-09-18", "1958-10-16", "1963-11-01", "1960-03-08", "993622513", 11,
                $appointments = [14]
            ],
            [
                "Mariana Olimpia", "Altamirano Hurtado", "Mariana", "casahermaprovi@gmail.com", "1800401778",
                "1930-12-22", "1950-12-23", "1955-12-25", "1951-11-27",  "993724591", 20,
                $appointments = [14]
            ],
            [
                "Patricia Alexandra", "Arcos Arroba", "Patricia", "patriciaarcosjmv@hotmail.com", "1803100476",
                "1977-11-24", "1998-09-27", "2004-11-27", "2000-07-18", "997527160", 14,
                $appointments = [17]
            ],
            [
                "María Magdalena", "Arevalo Estrada", "María Magdalena", "malenae64@gmail.com", "1708834849",
                "1964-09-02", "1982-09-27", "1987-09-27", "1984-09-15",  "981186917", 36,
                $appointments = [14]
            ],
            [
                "Inés María", "Arevalo Estrada", "Inés", "ineshdlc@gmail.com", "601619240",
                "1962-07-15", "1982-09-27", "1987-09-27", "1984-09-15", "999116504", 1,
                $appointments = [14]
            ],
            [
                "María Renée", "Arevalo Hernandez", "María", "arevalo1952@hotmail.com", "1704593894",
                "1952-12-05", "1972-09-27", "1977-09-27", "1974-03-09", "991228282", 15,
                $appointments = [10]
            ],
            [
                "Anatolia Elodia", "Arias Paredes", "Anatolia", "anatoliaarias@gmail.com", "600513113",
                "1921-12-22", "1944-08-06", "1949-08-15", "1945-07-25", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Alba Rosalía", "Arreaga Rivas", "Alba", "albaarreaga473@gmail.com", "1701772798",
                "1946-02-09", "1965-11-09", "1970-11-27", "1967-03-08", "958731012", 19,
                $appointments = [14]
            ],
            [
                "Hilda Beatriz", "Arteaga Cadena", "Hilda", "hildaarteaga@gmail.com", "400125134",
                "1946-05-12", "1973-03-15", "1978-09-27", "1974-11-16",  "981850190", 33,
                $appointments = [14]
            ],
            [
                "Lidia Lucrecia", "Arteaga Montenegro", "Lidia", "liarteaga@yahoo.com", "1001653508",
                "1965-11-23", "1989-11-27", "1995-12-08", "1991-10-18", "998035763", 30,
                $appointments = [14]
            ],
            [
                "Susana Servilla", "Asencio Moran", "Susana", "susanaservilla@gmail.com", "902639731",
                "1934-05-24", "1956-10-26", "1961-11-01", "1958-10-18", "993724591", 19,
                $appointments = [14]
            ],
            [
                "María Leonor", "Astudillo Pallmay", " Leonor", "sorleas@hotmail.com", "1705150397",
                "1954-12-03", "1977-03-15", "1982-03-15", "1978-10-10", "997623563", 5,
                $appointments = [14]
            ],
            [
                "Vilma Mercedes", "Aucapiña Tipan", "Vilma", "vilmamerat@yahoo.com", "1802272003",
                "1967-04-22", "1987-11-27", "1993-11-27", "1989-03-20", "967612416", 1,
                $appointments = [14]
            ],
            [
                "Leonor Rosalía", "Balcazar Vega", "Leonor", "balcazarleonor09@yahoo.com", "1714378138",
                "1980-09-04", "2016-05-31", "2022-03-19", "2018-03-10", "979503549", 14,
                $appointments = [14]
            ],
            [
                "Gladis Vilma", "Barragan Gonsalez", "Gladis", "gladisb70@yahoo.es", "201215712",
                "1970-11-20", "1996-09-21", "2003-03-15", "1998-07-01", "987235243", 48,
                $appointments = [14]
            ],
            [
                "Rosa Margarita", "Barreiro Gorozabel", "Rosa", "svpecheandia@gmail.com", "1302605827",
                "1956-09-15", "1983-03-15", "1988-11-26", "1985-04-20", "985872321", 17,
                $appointments = [14]
            ],
            [
                "Claudia María", "Barreiro Zambrano", "Claudia", "sorclaudiambz@hotmail.com", "1310436389",
                "1982-10-05", "2007-09-27", "2013-08-15", "2009-07-18", "982551131", 5,
                $appointments = [14]
            ],
            [
                "Digna Emérita", "Barrionuevo Barrionuevo", "Digna", "emeritaba-@hotmail.com", "1713275418",
                "1974-10-25", "1996-09-21", "2003-03-15", "1998-07-01", "984328634", 46,
                $appointments = [10]
            ],
            [
                "Alicia de Lourdes", "Bedoya Arguello", "Alicia", "aloubed@yahoo.es", "1700685470",
                "1946-12-23", "1966-01-26", "1971-03-15", "1967-03-08", "990985905", 36,
                $appointments = [14]
            ],
            [
                "María Inés", "Benitez Marcillo", " Inés", "mariabenitez@gmail.com", "1700609074", "
                1931-04-05", "1950-01-30", "1955-02-02", "1951-02-15", "981843740", 34,
                $appointments = [14]
            ],
            [
                "María Teresa", "Bermudez Espinoza", "María Teresa", "mariateresabermudez@gmail.com", "1701785006",
                "1927-11-13", "1965-08-06", "1970-09-27", "1966-07-25", "993724591", 19,
                $appointments = [14]
            ],
            [
                "Elena María", "Berrezueta Jara", "María Elena", "elenaberrezueta@gmail.com", "1700056474",
                "1929-12-08", "1957-08-06", "1962-08-15", "1958-09-12", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Nancy Elena", "Brito Cabezas", "Nancy", "nbritocabezas@gmail.com", "101503456",
                "1955-03-22", "1974-09-27", "1979-09-27", "1976-05-26", "997588708", 1,
                $appointments = [14]
            ],
            [
                "Rosa T Marilina", "Burgos Sornoza", "Rosa T", "rosaburgos@gmail.com", "1702059971",
                "1938-08-04", "1958-01-03", "1963-02-02", "1959-08-08", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Yessenia Ivanova", "Cabrera Arteaga", "Yessenia", "yessihdlc2016@gmail.com", "1150061388",
                "1994-07-05", "2016-05-31", "2022-03-19", "2018-03-10", "986567970", 22,
                $appointments = [14]
            ],
            [
                "Silvia Monserrat", "Cabrera Chica", "Silvia", "sorsilviapecesito@hotmail.com ", "102864618",
                "1973-02-28", "1997-09-27", "2004-03-15", "1999-06-24", "985897950", 37,
                $appointments = [14]
            ],
            [
                "Sara Maritza", "Cadena  Ruiz", "Sara", "sorsaracadenahdlc@hotmail.com", "1713417069",
                "1976-10-16", "2004-09-27", "2010-11-27", "2006-07-18", "988272117", 51,
                $appointments = [14]
            ],
            [
                "Gloria Susana", "Caiza Ushiña", "Susana", "glosu180@gmail.com", "1801667005",
                "1961-11-18", "1980-09-27", "1986-03-15", "1982-09-19", "960207216", 45,
                $appointments = [6, 17]
            ],
            [
                "María Piedad", "Cajamarca Quinde", "María Piedad", "maria1piedad@hotmail.com", "916117898",
                "1975-05-17", "1998-09-27", "2004-03-15", "2000-07-18", "968695257", 29,
                $appointments = [14]
            ],
            [
                "Rosa Elvira", "Calle Aulestia", "Cecilia", "rosacalle@gmail.com", "1702741727",
                "1927-09-27", "1954-05-25", "1959-05-31", "1955-07-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Roxana del Carmen", "Cambisaca Diaz", "Roxana", "cadyroxy@hotmail.com", "1104182934",
                "1985-07-14", "2012-11-27", "2019-05-09", "2014-11-27", "968797150", 41,
                $appointments = [14]
            ],
            [
                "Esperanza", "Campoverde Jaramillo", "Esperanza", "cesperanza75@yahoo.es", "1705750535",
                "1951-10-09", "1974-09-27", "1979-09-27", "1976-05-26", "959631659", 25,
                $appointments = [14]
            ],
            [
                "Bertha Alicia", "Cardenas Almeida", "Bertha Alicia", "berthacardenas@gmail.com", "1700303082",
                "1945-08-27", "1963-04-25", "1968-11-27", "1964-07-25", "999086615", 13,
                $appointments = [14]
            ],
            [
                "Bertha Beatriz", "Cargua Parra", "Bertha Beatriz", "bertabeatrizcargua@gmail.com", "600767917",
                "1950-01-08", "1973-09-27", "1978-09-27", "1975-04-21", "981650911", 19,
                $appointments = [14]
            ],
            [
                "Nancy Araceli", "Carrera Escobar", "Nancy", "nancycarrera14@hotmail.com", "903930006",
                "1950-06-14", "1978-03-15", "1983-03-12", "1980-04-20", "984049440", 20,
                $appointments = [14]
            ],
            [
                "Lucrecia", "Carrillo Cervantes", "Lucrecia", "lucreciacarrillo@gmail.com", "903082923",
                "1939-03-16", "1959-11-25", "1964-11-27", "1961-02-10", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Emma Isabel", "Carrion Torres", "Emma", "emmacarrion@gmail.com", "902505288",
                "1933-05-10", "1957-08-06", "1962-08-15", "1958-09-12", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Miriam Susana", "Casa Casa", "Susana", "susy17c@hotmail.com", "502526379",
                "1979-02-16", "2000-09-27", "2005-11-27", "2002-07-18", "986579646", 38,
                $appointments = [17]
            ],
            [
                "Luisa Marina", "Casanova Mejia", "Lucía", "emiliazumarragahdlc@gmail.com", "1700302829",
                "1924-12-14", "1945-10-30", "1950-11-01", "1946-11-15", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Susana", "Castillo Alvarez", "Susana", "susanacastillo@gmail.com", "1700302423",
                "1943-08-11", "1964-12-18", "1969-12-25", "1966-02-20", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Estela Marina", "Castro Ceron", "Estela", "medamilacho@gmail.com", "400828331",
                "1966-04-26", "1988-11-27", "1994-03-15", "1990-03-05", "986591042", 18,
                $appointments = [10]
            ],
            [
                "María Josefina", "Castro Pesantez", "Josefina", "mariacastro@gmail.com", "902642487",
                "1941-01-22", "1964-01-22", "1969-03-15", "1965-07-25", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Rosa Beatriz Alicia", "Cervantes Duran", "Alicia", "rosacervantes@gmail.com", "1700302860",
                "1932-08-30", "1949-12-06", "1954-12-08", "1950-11-27", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Rosario del Carmen", "Cervantes Yepez", "Carmen", "rosariocervantes@hotmail.com", "1703445468",
                "1950-10-22", "1968-09-27", "1973-09-27", "1969-09-12", "981816813", 1,
                $appointments = [10]
            ],
            [
                "Rosa Eelvina", "Cevallos Lopez", "Genovena", "rosacevallos@gmail.com", "1700302928",
                "1929-07-24", "1948-01-27", "1953-02-02", "1949-02-15", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Blanca María", "Cevallos Nuñez", "Blanca", "blancacevallos@gmail.com", "903983781",
                "1932-01-30", "1955-08-06", "1960-08-15", "1956-07-25", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Mariana de Jesús", "Chamba Gonzalez", "Mariana", "sor_mariana7@hotmail.com", "1703369817",
                "1951-06-02", "1970-03-15", "1975-03-15", "1971-07-29", "997883051", 24,
                $appointments = [14]
            ],
            [
                "Ana Isabel", "Chanchay Cuasquer", "Ana Isabel", "anaisa1408@hotmail.es", "1712309804",
                "1973-08-14", "1999-10-07", "2005-11-27", "2001-06-24", "980532682", 11,
                $appointments = [14]
            ],
            [
                "María Dolores", "Chicaiza Maisincho", "María Dolores", "lvdani1953@gmail.com", "1704964871",
                "1958-10-19", "1979-03-15", "1984-03-15", "1981-02-08", "987925113", 10,
                $appointments = [14]
            ],
            [
                "Enma Ernestina", "Chico Leon", "Enma Ernestina", "getsemanihdlc@gmail.com", "901284745",
                "1943-07-24", "1964-08-01", "1969-08-15", "1965-10-27", "993622513", 11,
                $appointments = [14]
            ],
            [
                "Alba Alexandra", "Chorlango Garcia", "Alba", "economaecuador@gmail.com", "1002422549",
                "1977-03-15", "2002-10-07", "2008-11-27", "2004-07-18", "985922279", 1,
                $appointments = [8]
            ],
            [
                "Carmen Beatriz", "Cisneros Serrano", "Carmen", "carmencisneros@gmail.com", "1700302803",
                "1929-11-19", "1950-12-23", "1955-12-25", "1951-11-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "María Silvia", "Clavijo Carrera", "Silvia", "clavijocarrerasilvia@gmail.com", "1709794935",
                "1975-02-13", "2000-09-27", "2006-03-15", "2002-07-18", "989420843", 7,
                $appointments = [17]
            ],
            [
                "Jenny Amparo", "Coca Arias", "Jenny", "jennyamparito@hotmail.com", "1715947642",
                "1980-10-04", "2012-11-27", "2019-02-02", "2014-11-27", "959214343", 46,
                $appointments = [14]
            ],
            [
                "María Elvia", "Cojitambo Medina", "Elvia", "elvia.cojitambo@yahoo.com", "700606080",
                "1948-12-02", "1970-03-15", "1975-03-15", "1971-11-26", "991203377", 24,
                $appointments = [14]
            ],
            [
                "Teresa de Jesús", "Coronel Hernandez", "Teresa", "tjesus_coronel@yahoo.es", "1200883187",
                "1955-12-31", "1977-09-27", "1983-03-12", "1979-10-08", "981356269", 13,
                $appointments = [17]
            ],
            [
                "María Leonor", "Cortez Centeno", "Susana", "mariacortez@gmail.com", "903098747",
                "1928-09-03", "1947-11-24", "1953-07-19", "1948-11-15", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Inés Piedad", "Costa Songor", "Inés", "inescosta@gmail.com", "1702179845",
                "1936-03-23", "1956-07-17", "1961-07-19", "1957-07-25", "981843740", 34,
                $appointments = [14]
            ],
            [
                "María Sonia", "Cuasapaz Lucero", "Sonia", "marisony58@gmail.com", "400555031",
                "1958-07-09", "1985-11-27", "1991-03-15", "1987-03-02", "987321599", 24,
                $appointments = [10, 17]
            ],
            [
                "Mercedes Noemí", "Cuesta Jimemez", "Noemí", "mercedescuesta@gmail.com", "905971529",
                "1954-01-13", "1973-03-15", "1978-09-27", "1974-11-16", "959246298", 34,
                $appointments = [14]
            ],
            [
                "Mariana de Jesús", "Cueva Vaca", "Mariana", "marycvloja@hotmail.com", "1100571452",
                "1951-04-23", "1971-09-27", "1976-09-27", "1973-01-31", "985782632", 14,
                $appointments = [10]
            ],
            [
                "Peregrina", "Cumbicos Cumbicos", "Peregrina", "comunidadcatacocha11@gmail.com", "903146124",
                "1940-01-29", "1962-03-04", "1967-03-15", "1963-07-25", "981375953", 6,
                $appointments = [14]
            ],
            [
                "Judith Marina", "Delgado Soto", "Judith", "judithmarina@gmail.com", "1800724740",
                "1934-05-10", "1956-07-17", "1961-11-01", "1957-07-25", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Nelly Beatriz", "Diaz Yaguana", "Nelly", "nebediya_2007@yahoo.es", "1103166045",
                "1974-06-05", "1994-11-26", "2000-11-27", "1996-07-04", "984064316", 38,
                $appointments = [14]
            ],
            [
                "Flor Marina de Jesús", "Dominguez Solorzano", "Flor Marina", "florjedoso46@gmail.com", "1700302522",
                "1945-12-28", "1964-12-18", "1969-12-25", "1966-02-10", "988644193", 19,
                $appointments = [17]
            ],
            [
                "Rosario", "Egas Teran", "Rosario", "olimpitateran@gmail.com", "700362049",
                "1941-10-20", "1960-11-11", "1966-05-31", "1962-02-14", "990524141", 4,
                $appointments = [14]
            ],
            [
                "Blanca Fabiola", "Endara Tafur", "Fabiola", "comuninmaculadapillaro@hotmail.com", "1000364123",
                "1930-12-05", "1970-03-15", "1975-03-15", "1971-07-29", "982249518", 28,
                $appointments = [14]
            ],
            [
                "María Leonor", "Enriquez Lopez", "María Leonor", "mariaenriquez@gmail.com", "700390537",
                "1921-04-14", "1945-10-30", "1950-12-25", "1947-02-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Lida Benilda", "Escaleras Cueva", "Lida", "lidaescaleras@gmail.com", "1100507845",
                "1944-11-04", "1969-09-27", "1974-09-27", "1970-09-04", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Germania del Rocío", "Escobar Arguero", "Rocío", "rcescobar6@gmail.com", "1707656763",
                "1962-06-07", "1983-09-27", "1988-11-26", "1985-09-20", "939754907", 21,
                $appointments = [10, 17]
            ],
            [
                "Aída Leonor", "Escobar Pozo", "Bernardita", "aidaescobar@hotmail.com", "1702222819",
                "1926-04-12", "1956-07-17", "1961-07-19", "1957-07-25", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Micaela Yolanda", "Espinel Pazuña", "Micaela", "espinelmicaela92@gmail.com", "550265805",
                "1995-11-17", "2018-11-27", null, "2020-09-27", "992526521", 15,
                $appointments = [14]
            ],
            [
                "Mariana de Jesús", "Espinoza Pasquel", "Mariana", "pastoralformacion.hdlc@gmail.com", "902882612",
                "1950-09-22", "1969-03-15", "1974-03-15", "1970-02-27", "980476197", 1,
                $appointments = [5]
            ],
            [
                "María Esthela", "Estrella Almeida", "Esthela", "mariaestrella@gmail.com", "1100133170",
                "1941-10-09", "1962-08-02", "1967-08-15", "1963-11-14", "998295924", 24,
                $appointments = [14]
            ],
            [
                "Clara Aurora", "Falconi Sosa", "Clara", "clarafalconi@gmail.com", "1700925074",
                "1929-02-20", "1950-12-23", "1955-12-25", "1951-11-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Olga María", "Feijoo Romero", " María", "olgafeijoo@hotmail.com", "1700302993",
                "1940-08-13", "1961-11-26", "1967-11-27", "1963-01-31", "986569055", 40,
                $appointments = [14]
            ],
            [
                "Norma María", "Figueroa Donoso", "Norma", "normafido@hotmail.com", "904243110",
                "1951-05-18", "1985-11-27", "1992-03-16", "1987-03-02", "997492906", 48,
                $appointments = [14]
            ],
            [
                "Magdalena de Lourdes", "Flores Chavez", "Magdalena", "uefliccdad@yahoo.com", "500104864",
                "1947-05-09", "1966-11-27", "1971-11-27", "1968-03-08", "939754907", 21,
                $appointments = [14]
            ],
            [
                "Gabriela Vicenta", "Galindo Andrade", "Odila", "gabrielagalindo@gmail.com", "1700302373",
                "1926-03-22", "1948-01-27", "1953-02-02", "1949-02-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Amalia Ethel", "Gallardo Roman", "Amalia", "amaloagallardo@gmail.com", "1700303157",
                "1932-10-17", "1960-12-23", "1965-12-25", "1962-02-14", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Mariana de Jesús", "Garcia Rodriguez", "Margarita", "marianagarcia@gmail.com", "100686104",
                "1936-05-10", "1956-04-28", "1961-05-01", "1957-07-25", "999027645", 33,
                $appointments = [14]
            ],
            [
                "María Hilda", "Garzon Acosta", "Hilda", "mariagarzon@gmail.com", "1701935023",
                "1933-11-15", "1952-03-07", "1957-03-15", "1953-02-15", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Nila de Lourdes", "Gomez Ayora", "Nila", "alinahdlc@gmail.com", "1102361100",
                "1963-05-15", "1984-11-27", "1991-03-15", "1986-08-31", "984371393", 31,
                $appointments = [14]
            ],
            [
                "Laura Narcisa", "Gonzalez Cajamarca", " Narcisa", "lauranarcisagc@gmail.com", "702410119",
                "1967-04-30", "1990-11-27", "1996-03-15", "1992-06-29", "994705781", 16,
                $appointments = [10]
            ],
            [
                "Carmen Rocío", "Gonzalez Medina", "Carmen", "carmenrocio610@hotmail.com", "1900244151",
                "1969-06-10", "1991-11-27", "1996-11-27", "1993-07-19", "980633098", 48,
                $appointments = [14]
            ],
            [
                "María Augusta", "Gordillo Perez", "María Augusta", "pastoralsocialecu@gmail.com", "1001990553",
                "1974-12-30", "1994-11-26", "2000-11-27", "1996-07-04", "993524170", 1,
                $appointments = [14]
            ],
            [
                "Sabina Melania", "Granda Encalada", "Melania", "sormelaniagranda@yahoo.com", "1101841680",
                "1961-12-30", "1983-03-15", "1988-11-26", "1985-04-20", "997917503", 39,
                $appointments = [10]
            ],
            [
                "Evangelina María", "Guachi Criollo", " María", "evangelinaguachi@gmail.com", "1801044924",
                "1952-08-11", "1982-09-27", "1987-09-27", "1984-09-11", "998035763", 30,
                $appointments = [14]
            ],
            [
                "Katty María", "Gualan Macas", "Katty", "gk909986@gmail.com", "1900797943",
                "1996-01-30", "2018-11-27", null, "2020-09-27", "997240882",  9,
                $appointments = [14]
            ],
            [
                "Magdalena Fabiola", "Guaman Oña", "Fabiola", "magfbygo@hotmail.fr", "501807325",
                "1973-05-22", "1994-11-26", "2000-11-27", "1996-07-04", "968263939", 1,
                $appointments = [14]
            ],
            [
                "Geovanna Maricela", "Guanoluisa Guanoluisa", "Geovanna", "govamary@gmail.com", "1718608688",
                "1990-10-22", "2020-11-27", null, null, "3137373885",  49,
                $appointments = [15]
            ],
            [
                "Nelly Helen", "Guapas Enriquez", "Nelly", "nellyguapas@gmail.com", "1700302571",
                "1946-03-26", "1965-05-29", "1970-11-27", "1966-07-25", "984371393", 31,
                $appointments = [14]
            ],
            [
                "Bertha Yolanda", "Guerrero Pazmiño", "Yolanda", "berthaygp@gmail.com", "1100210341",
                "1939-03-11", "1961-04-26", "1966-05-31", "1962-08-25", "995354953", 21,
                $appointments = [14]
            ],
            [
                "Zoila Amelia", "Guevara Tenesaca", "Zoila", "zoilameghc@hotmail.com", "100321108",
                "1941-03-05", "1961-02-12", "1966-03-15", "1962-07-25", "989612771", 33,
                $appointments = [14]
            ],
            [
                "Elvia Mariana", "Guizado Guzman", "Elvia", "elviaguizadog@hotmail.com", "200502813",
                "1952-06-02", "1977-03-15", "1982-03-15", "1978-10-10", "961060533", 49,
                $appointments = [14]
            ],
            [
                "Romelia Alicia", "Haro Davila", "Alicia", "alirome37@yahoo.es", "600234546",
                "1950-12-05", "1972-03-15", "1977-09-27", "1973-08-06", "995776915", 36,
                $appointments = [14]
            ],
            [
                "Gladys Angela", "Hernandez Velastegui", "Angela", "gladyshernandez@gmail.com", "1800521518",
                "1942-11-28", "1960-12-23", "1965-12-25", "1962-02-14", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Rosa Guillermina", "Herrera Pacheco", "Guillermina", "rosaherrera@gmail.com", "1700081159",
                "1934-06-25", "1957-04-25", "1962-05-01", "1958-04-13", "993724591", 19,
                $appointments = [14]
            ],
            [
                "Jenny Cristina", "Herrera Pillajo", "Cristina", "crisjenny2009@hotmail.com", "1717167827",
                "1981-03-29", "2008-09-27", "2014-09-27", "2010-11-27", "934346670", 1,
                $appointments = [14]
            ],
            [
                "Paulina Susana", "Huaraca  Salazar", "Paulina", "hdlcpau@hotmail.com", "1717577041",
                "1982-11-15", "2004-09-27", "2010-10-27", "2006-07-18", "981792404", 22,
                $appointments = [18]
            ],
            [
                "Mariana Domitila", "Hurtado Arellano", "Mariana", "marianahurtado@gmail.com", "1700303058",
                "1941-01-13", "1960-02-17", "1965-03-15", "1961-07-25", "981843740", 12,
                $appointments = [14]
            ],
            [
                "Yonny Maritza", "Imaicela Pardo", "Maritza", "maryimaicela@hotmail.com", "1103780233",
                "1979-09-09", "2002-10-07", "2008-11-27", "2004-07-18", "985642246", 9,
                $appointments = [10, 18]
            ],
            [
                "Emma Lucinda", "Jacome Vallejos", "Emma", "emmajacome@gmail.com", "1701925768",
                "1944-06-07", "1966-02-18", "1971-03-15", "1967-03-08", "998035763", 30,
                $appointments = [10]
            ],
            [
                "María Agustina", "Jara Camacho", "María Agustina", "maritinahdlc@gmail.com", "1101851374",
                "1958-11-08", "1981-05-31", "1986-11-27", "1983-05-01", "990524141", 4,
                $appointments = [10]
            ],
            [
                "Rosa Victoria", "Jara Jara", "Rosa", "rosajara@gmail.com", "600269310",
                "1926-10-05", "1947-08-06", "1952-12-25", "1948-07-19", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Umbelina Pastoriza", "Jara Jara", "Inés", "umbelinajara@gmail.com", "600545479",
                "1931-06-19", "1947-06-09", "1954-12-08", "1950-10-15", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Lourdes Victoria", "Jaramillo Bermudez", "Lourdes", "lourdes_jaramillo.18@hotmail.com", "953743507",
                "1995-06-16", "2018-11-27", null, "2020-09-27", "989920646", 22,
                $appointments = [14]
            ],
            [
                "Olga Francisca", "Jaramillo Carrion", "Olga", "olgajaramillo@gmail.com", "1101610481",
                "1949-06-16", "1984-11-27", "1991-03-15", "1986-08-31", "984355648", 20,
                $appointments = [14]
            ],
            [
                "Clara Luz", "Jimenez Alvarado", "Clara Luz", "clarajimenez@gmail.com", "700333958",
                "1938-01-04", "1959-01-31", "1964-02-02", "1960-07-25", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Rosa Isabel", "Landazuri Soto", "Isabel", "rosalandazuri@gmail.com", "1100222817",
                "1930-09-08", "1951-03-13", "1956-03-15", "1952-02-28", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Blanca Rosa", "Landi Lema", "Rosa", "rosalandi7@gmail.com", "300802071",
                "1962-11-01", "1991-11-26", "1996-11-27", "1993-07-19", "986569055", 40,
                $appointments = [10]
            ],
            [
                "Mariana de Jesús", "Lara Villagran", "Mariana", "marianalara@gmail.com", "1300411434",
                "1939-12-19", "1957-12-05", "1962-12-08", "1959-03-12", "986754146", 23,
                $appointments = [14]
            ],
            [
                "Cecilia Beatriz", "Lazcano Peñafiel", "Cecilia", "cecibachita@yahoo.com", "1704521481",
                "1954-03-08", "1972-03-15", "1977-09-27", "1973-08-06", "992746513", 7,
                $appointments = [14]
            ],
            [
                "Ulvia Sulema", "Leiva Herrera", "Sulema", "sulemahdlc@yahoo.com", "702281668",
                "1968-04-11", "1989-11-27", "1995-12-08", "1991-03-11", "984656202", 12,
                $appointments = [14]
            ],
            [
                "María Maclovia", "Lema  Tenenuela", "Maclovia", "marialema@gmail.com", "603280306",
                "1977-03-13", "2004-09-27", "2010-11-27", "2006-07-18", "0998864136", 43,
                $appointments = [14]
            ],
            [
                "Lucila Angélica", "Lema Almeida", "Lucila", "misionsanvicentedepaul@gmail.com", "1700839994",
                "1946-02-18", "1970-03-15", "1975-03-15", "1971-07-29", "994161563", 22,
                $appointments = [10]
            ],
            [
                "Lucrecia", "Lema Tenenuela", "Lucrecia", "Luc_ky2009@hotmail.com", "603617879",
                "1983-05-01", "2011-08-15", "2017-11-25", "2013-09-08", "994161563", 27,
                $appointments = [14]
            ],
            [
                "Dolores del Rosario", "Leon Toledo", "Rosario", "doloresleon@gmail.com", "1700527995",
                "1943-04-20", "1962-08-02", "1968-02-02", "1963-11-14", "993724591", 19,
                $appointments = [14]
            ],
            [
                "Martha Cecilia", "Llive Benavides", "Martha", "marthallive@gmail.com", "400763009",
                "1964-02-02", "1984-11-27", "1991-11-27", "1986-08-31", "989829337", 17,
                $appointments = [14]
            ],
            [
                "Ana Luisa", "Llive Benavides", "Ana Luisa", "anallive@gmail.com", "400763017",
                "1961-09-24", "1984-11-27", "1991-03-15", "1986-08-31", "985969776", 29,
                $appointments = [14]
            ],
            [
                "María Yolanda", "Llumiquinga Muela", "Yolanda", "anallive2009@hotmail.com", "1702716380",
                "1948-12-21", "1968-09-27", "1974-03-15", "1969-09-12", "998925164", 7,
                $appointments = [14]
            ],
            [
                "María Teresa", "Loor Vergara", "María Teresa", "merialoor@gmail.com", "1300710439",
                "1944-03-03", "1970-09-27", "1975-09-27", "1972-02-06", "997775205", 35,
                $appointments = [14]
            ],
            [
                "María Concepción", "Lopez Arevalo", "María", "comunidadhml@gmail.com", "1300892187",
                "1941-02-16", "1960-05-31", "1965-05-31", "1961-09-12", "985642246", 9,
                $appointments = [14]
            ],
            [
                "Yolanda Piedad", "Lopez Lopez", "Yolanda", "soryolandalopez@yahoo.es", "600484018",
                "1941-11-06", "1967-09-27", "1972-09-27", "1968-09-16", "999225546", 16,
                $appointments = [10]
            ],
            [
                "Maria Fátima", "Lopez Vera", "Fátima", "fatiimalopez@hotmail.com", "927643510",
                "1994-01-25", "2018-11-27", null, "2020-09-27", "986377409",  18,
                $appointments = [14]
            ],
            [
                "Rosa Delia", "Lozada Basantes", " Delia", "rosalozada@gmail.com", "1300945209",
                "1929-02-17", "1950-11-25", "1955-11-27", "1951-11-27", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Victoria Esther", "Lozada Flores", "Victoria", "victorialozada@gmail.com", "903047066",
                "1937-07-16", "1961-09-12", "1966-09-27", "1962-11-14", "999027645", 33,
                $appointments = [14]
            ],
            [
                "Ricardina Janeth", "Lugo Mendieta", " Janeth", "ricardinalugo@gmail.com", "917074718",
                "1975-04-03", "2003-11-27", "2010-09-26", "2005-07-18", "981375953", 6,
                $appointments = [10]
            ],
            [
                "Justa Elida", "Luzuriaga Gonzalez", "Inés", "justaluzuriaga@gmail.com", "1700302647",
                "1942-07-19", "1960-03-11", "1965-09-08", "1961-07-25", "988059804", 25,
                $appointments = [14]
            ],
            [
                "Alexandra María", "Macias Peña", "Alexandra", "jazalex2009@hotmail.com", "1204219818",
                "1974-03-25", "1999-10-07", "2005-11-27", "2001-06-24", "982766600", 17,
                $appointments = [14]
            ],
            [
                "Ana María", "Maldonado Aguilar", "Ana María", "anamaramaldonado@gmail.com", "1102366927",
                "1963-08-06", "1983-09-27", "1990-03-15", "1985-09-20", "997917594", 1,
                $appointments = [4]
            ],
            [
                "Doraliza del Carmen", "Maldonado Riofrio", "Doraliza", "doralizamr@yahoo.com", "1101785127",
                "1954-03-21", "1979-03-15", "1984-03-15", "1981-02-08", "993558803", 45,
                $appointments = [14]
            ],
            [
                "Hilda Felicia", "Malla Ortega", "Hilda", "hildamallaortega@gmail.com", "1900240183",
                "1969-01-25", "1990-11-27", "1996-03-15", "1992-06-29", "993724591", 19,
                $appointments = [10]
            ],
            [
                "Lida Victoria", "Maza Tandazo", "Lida", "lidamaza@gmail.com", "1101728127",
                "1959-02-14", "1984-03-15", "1990-03-15", "1986-03-30", "986051287", 42,
                $appointments = [14]
            ],
            [
                "Geovanna Esmeralda", "Mejia Aguilar", "Geovanna", "meagui22@hotmail.com", "400876645",
                "1967-11-22", "1990-11-27", "1996-11-27", "1992-06-29", "995397988", 35,
                $appointments = [10]
            ],
            [
                "Clara Adeliza", "Melendrez Espin", "Clara", "clarymelendrez@hotmail.com", "201210291",
                "1972-09-11", "1997-09-27", "2004-03-15", "1999-06-24", "990414651", 47,
                $appointments = [14]
            ],
            [
                "Julia Isabel", "Mendoza Muñoz", "Julia", "juliamendoza@gmail.com", "802531350",
                "1982-03-29", "2003-11-27", "2010-11-27", "2005-07-18", "985844786", 12,
                $appointments = [14]
            ],
            [
                "Ida Gloria", "Merino Cuzco", " Gloria", "casamisionaltriunfo@gmail.com", "600743629",
                "1948-05-23", "1971-03-15", "1976-03-15", "1972-07-23", "991228282", 15,
                $appointments = [14]
            ],
            [
                "María Magdalena", "Mestanza Lombeida", "María Magdalena", "magdamml@hotmail.com", "200866986",
                "1964-02-19", "1983-03-15", "1990-03-15", "1985-04-02", "981843740", 34,
                $appointments = [10]
            ],
            [
                "María Noemí", "Milan Aguilar", "María Noemí", "mary_1990-m@hotmail.com", "1600608705",
                "1990-08-10", "2012-11-27", "2019-05-09", "2014-11-27", "939757788", 9,
                $appointments = [14]
            ],
            [
                "Blanca Noemí", "Miño Godoy", " Noemí", "lulunoe1665@gmail.com", "1708840606",
                "1965-03-16", "1985-11-27", "1991-03-15", "1987-03-02", "985586471", 4,
                $appointments = [14]
            ],
            [
                "Gladys Susana", "Mise Cofre", " Susana", "gladysmise@yahoo.es", "1710183789",
                "1971-03-21", "1990-11-27", "1996-03-15", "1992-06-29", "993622513", 11,
                $appointments = [10]
            ],
            [
                "Fausta Targelia", "Montesdeoca Cedeño", "Fausta", "faustamontesdeoca@gmail.com", "1700082298",
                "1932-12-19", "1955-03-05", "1960-03-15", "1956-02-24", "994190917", 1,
                $appointments = [14]
            ],
            [
                "Edith Amelia", "Mora Aguilar", "Edith", "edithmora@gmail.com", "1700302472",
                "1941-04-10", "1965-03-13", "1970-03-16", "1966-07-25", "999137285", 19,
                $appointments = [14]
            ],
            [
                "Laura Marina", "Moya Perez", "Laura", "molaurap@yahoo.es", "1710344522",
                "1967-11-29", "1996-09-21", "2003-03-15", "1998-07-01", "984795709", 3,
                $appointments = [10]
            ],
            [
                "Rosa Rebeca", "Muñoz Bernal", " Rebeca", "rosamunoz@gmail.com", "100263243",
                "1932-09-19", "1952-03-07", "1957-03-15", "1953-02-15", "993724591", 19,
                $appointments = [14]
            ],
            [
                "María Teresa", "Muñoz Molina", "María Teresa", "uelmachachi@gmail.com", "700079767",
                "1940-10-10", "1959-01-31", "1964-02-02", "1960-03-04", "997703449", 32,
                $appointments = [14]
            ],
            [
                "Sara Loide", "Naranjo Ortega", "Sara", "naranjoortegasara@yahoo.com", "500704226",
                "1952-05-02", "1973-09-27", "1978-09-27", "1975-04-21", "939842050", 18,
                $appointments = [14]
            ],
            [
                "Gertrudis Mónica", "Navarrete Vinueza", "Mónica", "gertrudisnavarrete@gmail.com", "1701920322",
                "1934-03-30", "1954-08-06", "1959-08-15", "1955-07-25", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Mirian Elizabeth", "Neira Mejia", "Elizabeth", "mieli_hdlc@hotmail.com", "1104858137",
                "1989-03-21", "2011-08-15", "2017-11-25", "2013-09-08", "985969288", 39,
                $appointments = [14]
            ],
            [
                "María de Jesús Dolores", "Noboa Lopez", "María Elena", "marianoboa@gmail.com", "1700607391",
                "1929-03-09", "1949-03-12", "1954-03-15", "1950-02-15", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Rosa María", "Nuñez Herrera", "Rosa", "rosanunez@gmail.com", "1200052254",
                "1931-03-30", "1963-11-21", "1968-11-27", "1965-02-12", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Catalina Francisca", "Olvera Tobar", "Catalina", "catalinaolvera@gmail.com", "905940888",
                "1958-03-05", "1979-03-15", "1984-03-15", "1981-02-08", "984049440", 20,
                $appointments = [14]
            ],
            [
                "Aída Beatriz", "Orbe Bastidas", "Aída", "aidaorbe@gmail.com", "1702159953",
                "1947-09-08", "1969-09-27", "1974-09-27", "1970-09-04", "997703449", 32,
                $appointments = [14]
            ],
            [
                "María Esther", "Ortega Cajilema", "María Esther", "estherort59@gmail.com", "604797522",
                "1988-07-27", "2012-11-27", "2019-02-02", "2015-02-14", "967888198", 22,
                $appointments = [14]
            ],
            [
                "Guadalupe", "Pabon Castro", "Guadalupe", "guadalupepabon@gmail.com", "1700302399",
                "1946-01-24", "1964-08-01", "1969-08-15", "1965-10-27", "999027645", 33,
                $appointments = [14]
            ],
            [
                "Carmita Teresa", "Paladines Guevara", "Carmita", "carmitapg.2014@gmail.com", "1001064235",
                "1951-01-06", "1973-03-15", "1978-09-27", "1974-11-16", "989979140", 38,
                $appointments = [10]
            ],
            [
                "Elida Isabel", "Paliz", "Isabel", "elidapaliz@gmail.com", "200003846",
                "1939-04-26", "1966-11-27", "1971-11-27", "1968-03-08", "985862407", 2,
                $appointments = [14]
            ],
            [
                "Ritha Elizabeth", "Palma Carrera", " Elizabeth", "rithapalma@yahoo.com", "500919147",
                "1959-03-04", "1980-09-27", "1986-03-15", "1982-09-19", "995654794", 27,
                $appointments = [17]
            ],
            [
                "María Lucila", "Paneluisa Vargas", " Lucila", "marialucilapaneluisa@yahoo.es", "1707294581",
                "1960-09-26", "1982-03-15", "1987-09-27", "1984-03-09", "991271164", 41,
                $appointments = [17]
            ],
            [
                "Ana Lucía", "Paredes Camacho", "Ana Lucía", "luisitahdlcatuntaqui@gmail.com", "1000400455",
                "1936-10-25", "1956-10-26", "1962-03-15", "1957-10-18", "991271164", 4,
                $appointments = [14]
            ],
            [
                "Mercedes del Carmen", "Paredes Grijalva", "Carmen", "sorcarmipagri@yahoo.com", "500022140",
                "1947-05-13", "1967-09-27", "1972-09-27", "1968-09-16", "993359409", 12,
                $appointments = [10]
            ],
            [
                "Adriana de Jesús", "Paredes Ipanaque", "Adriana", "adrianaparedes@gmail.com", "902106186",
                "1948-03-04", "1984-03-15", "1990-03-15", "1986-03-30", "993622513", 11,
                $appointments = [14]
            ],
            [
                "Beatriz Helena", "Paredes Robalino", "Helena", "helparo@hotmail.es", "1709155137",
                "1965-08-13", "1985-11-27", "1992-09-25", "1987-03-02", "986789979", 36,
                $appointments = [14]
            ],
            [
                "Teresita de Jesús", "Parra Alvarez", "Teresita", "hogarmiguelleoncuenca@gmail.com", "700317985",
                "1943-04-23", "1963-11-21", "1968-11-27", "1965-02-12", "992548220", 9,
                $appointments = [14]
            ],
            [
                "María Rosario", "Pastor Vargas", "Rosario", "mariapastor@gmail.com", "1100194115",
                "1940-07-17", "1963-08-09", "1969-03-15", "1964-09-12", "981816813", 2,
                $appointments = [14]
            ],
            [
                "Carmen Melania", "Patiño Jaramillo", "Carmen", "carmepa22@hotmail.com", "1704841939",
                "1951-02-02", "1970-09-27", "1975-09-27", "1972-02-06", "959016316", 41,
                $appointments = [10]
            ],
            [
                "Teresa Piedad", "Patiño Jaramillo", "Teresa", "hcsangabriel@gmail.com", "1704088358",
                "1949-03-28", "1968-09-27", "1973-09-27", "1969-09-12", "994936913", 41,
                $appointments = [14]
            ],
            [
                "Norma Olivia", "Patiño Quezada", "Norma", "norolipq12@hotmail.com", "1102549761",
                "1964-06-12", "1987-11-27", "1993-11-27", "1989-03-20", "981426114", 1,
                $appointments = [7]
            ],
            [
                "Maria Gladys", "Paucar Melendres", "Maria", "mariapaucar@gmail.com", "1301176044",
                "1942-10-12", "1960-07-14", "1965-07-19", "1961-09-12", "983638053", 26,
                $appointments = [14]
            ],
            [
                "Elvia", "Paucar Paucar", "Elvia", "elviapaucarpaucar@hotmail.com", "1101438313",
                "1950-06-07", "1978-03-15", "1983-03-15", "1980-04-20", "961060533", 28,
                $appointments = [14]
            ],
            [
                "Juana Albertina", "Peña Jumbo", "Albertina", "juanapenia@gmail.com", "1101429726",
                "1947-06-12", "1972-09-27", "1977-09-27", "1974-03-09", "990311556", 26,
                $appointments = [14]
            ],
            [
                "Laura Guillermina", "Peralta Cardenas", "Josefina", "lauraperalta@gmail.com", "500111307",
                "1931-02-03", "1950-04-29", "1955-05-01", "1951-07-19", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Bertha Elena", "Perez Ayala", "Bertha", "berthaperez@gmail.com", "700573207",
                "1938-05-27", "1961-09-12", "1966-09-27", "1962-11-14", "997703449", 21,
                $appointments = [14]
            ],
            [
                "Teresa Carlota", "Perez Pazmiño", "Teresa", "hdelacaridadotavalo@gmail.com", "1701679043",
                "1930-09-19", "1952-11-23", "1957-11-27", "1953-11-15", "997917728", 27,
                $appointments = [14]
            ],
            [
                "Mercedes Antonieta", "Piedra Solis", "Mercedes", "mercedespiedra@gmail.com", "600091599",
                "1931-11-09", "1954-03-12", "1959-03-15", "1955-02-28", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Flora Margarita", "Pinoargote Pacheco", "Flora", "florapi@hotmail.com", "1700302431",
                "1929-02-22", "1953-03-22", "1958-03-25", "1954-02-28", "998491576", 12,
                $appointments = [14]
            ],
            [
                "Julia Leonor", "Polo Bonilla", " Leonor", "haieobraltg@hotmail.com", "1700527987",
                "1936-02-22", "1959-01-31", "1964-02-02", "1960-03-08", "994161563", 22,
                $appointments = [14]
            ],
            [
                "Narciza del Pilar", "Pozo Vinueza", "Narciza", "pilepv304@hotmail.com", "400914057",
                "1970-04-30", "1999-10-07", "2006-09-27", "2001-06-24", "990323719", 21,
                $appointments = [14]
            ],
            [
                "Blanca Ofelia", "Proaño Andrade", "Blanca", "blancamariaec@yahoo.com", "400221925",
                "1934-07-08", "1951-12-04", "1957-05-31", "1952-10-15", "999185046", 9,
                $appointments = [14]
            ],
            [
                "María Zoila", "Punina Guano", " Zoila", "zoilapunina@hotmail.com", "201022746",
                "1965-04-25", "1993-11-27", "1999-11-27", "1996-07-04", "968160240", 39,
                $appointments = [14]
            ],
            [
                "María Elena", "Quevedo Flores", "María Elena", "maryelenaqf2012@gmail.com", "602487225",
                "1971-09-30", "1992-11-26", "1997-11-27", "1994-06-12", "996018346", 43,
                $appointments = [10]
            ],
            [
                "Martha Beatriz", "Quinatoa Olmedo", "Martha", "hdlcesmeraldas@gmail.com", "1701838060",
                "1938-01-23", "1958-04-30", "1963-05-01", "1959-08-08", "999225546", 16,
                $appointments = [14]
            ],
            [
                "María Emilia", "Quisphe Cajilema", "María Emilia", "mariaehdlc@gmail.com", "1704841921",
                "1953-10-15", "1971-09-27", "1976-09-27", "1973-01-31", "986754146", 23,
                $appointments = [10]
            ],
            [
                "Martha Leonor", "Ramirez Campos", "Martha", "csluisatosagua@gmail.com", "912092756",
                "1963-01-18", "1996-09-21", "2003-03-15", "1999-03-15", "984328634", 46,
                $appointments = [14]
            ],
            [
                "Luzmila Antonieta", "Ramos Avila", "Luzmila", "luzmilaramos@gmail.com", "1701663252",
                "1936-09-19", "1954-08-06", "1959-08-15", "1955-06-25", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Carmen Amelia", "Reinoso Mazorra", "María del Carmen", "comunidadhccayambe@gmail.com", "900838202",
                "1936-07-16", "1959-03-24", "1964-04-04", "1960-07-25", "984164121", 7,
                $appointments = [14]
            ],
            [
                "Cecilia", "Reinoso Olvera", "Cecilia", "cecilliareinoso@gmail.com", "1700302902",
                "1927-11-22", "1948-08-06", "1953-08-15", "1949-07-15", "993724591", 19,
                $appointments = [14]
            ],
            [
                "Mirtha Eslerida", "Rey Rios", "Mirtha", "mirtharey@gmail.com", "903047074",
                "1939-06-29", "1963-11-21", "1968-11-27", "1965-02-12", "990552463", 8,
                $appointments = [14]
            ],
            [
                "María Lucrecia", "Riera Troya", "Rosa", "mariariera@gmail.com", "200174035",
                "1928-02-20", "1954-08-06", "1959-08-15", "1955-07-25", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Ligia Yolanda Beatriz", "Riofrio Suarez", "Beatriz", "ligiariofrio@gmail.com", "1700302514",
                "1941-03-07", "1964-12-18", "1969-12-25", "1966-02-20", "998448186", 34,
                $appointments = [14]
            ],
            [
                "Laura Piedad", "Robalino Diaz", "Laura", "hsanvip@andinanet.net", "1700303108",
                "1938-06-17", "1960-02-17", "1965-03-15", "1961-07-25", "998035763", 30,
                $appointments = [14]
            ],
            [
                "Lilia América", "Rodriguez Palacios", "Lilia", "liliarodriguez@gmail.com", "1701906412",
                "1929-05-01", "1951-11-16", "1956-11-27", "1952-10-15", "990552463", 8,
                $appointments = [14]
            ],
            [
                "María Emperatriz", "Rodriguez Ramirez", "Patricia", "mariarodriguez@gmail.com", "100162981",
                "1929-08-29", "1948-12-19", "1953-12-25", "1949-11-15", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Laura Piedad", "Rodriguez Zapata", "Piedad", "laurarodriguez@gmail.com", "1700302753",
                "1929-07-23", "1946-08-06", "1951-09-27", "1947-07-18", "990552463", 8,
                $appointments = [14]
            ],
            [
                "María Rosa", "Rojas Apolo", "María Rosa", "mariarojas@gmail.com", "1800530154",
                "1932-09-08", "1953-04-29", "1958-05-01", "1954-04-15", "958809658", 2,
                $appointments = [14]
            ],
            [
                "Elvita Piedad", "Rojas Encalada", "Piedad", "elvitarojas@hotmail.com", "1700302787",
                "1937-04-09", "1960-03-11", "1965-03-15", "1961-08-25", "967172409", 12,
                $appointments = [14]
            ],
            [
                "Ruth Grimaneza", "Roldan Torres", "Ruth", "ruthroldn@yahoo.es", "1100133188",
                "1942-11-06", "1959-11-25", "1964-11-27", "1961-02-10", "997917728", 27,
                $appointments = [10]
            ],
            [
                "Mariana Esther", "Romero Cabezas", "Mariana", "mariaromero@gmail.com", "1700930173",
                "1940-01-26", "1959-05-22", "1964-05-31", "1960-07-25", "999027645", 33,
                $appointments = [14]
            ],
            [
                "Luz Isabel", "Romero Espinoza", " Isabel", "luziroes07@outlook.es", "700291008",
                "1947-05-23", "1968-09-27", "1973-09-27", "1969-09-12", "997309165", 17,
                $appointments = [10]
            ],
            [
                "Bertha Oliva", "Romero Jimenez", " Oliva", "bertharomero@gmail.com", "701103426",
                "1954-11-30", "1973-09-27", "1978-09-27", "1975-04-21", "996512266", 21,
                $appointments = [14]
            ],
            [
                "Mercedes del Carmen", "Romero Lopez", "Mercedes", "sormeches@yahoo.com", "1001810538",
                "1965-11-27", "1983-09-27", "1988-11-26", "1985-09-20", "998157547", 2,
                $appointments = [18]
            ],
            [
                "Lucía Irene", "Rosero Chausa", "Lucía", "lucyrene29@hotmail.com", "401183777",
                "1975-03-29", "2000-09-27", "2006-03-15", "2002-07-18", "989655150", 41,
                $appointments = [14]
            ],
            [
                "María Eufemia", "Rubio Borja", "María Eufemia", "mariarubio@gmail.com", "900838210",
                "1938-10-16", "1960-02-17", "1965-08-15", "1961-07-25", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Paula Bertha", "Salazar Gonzaga", "Paola", "paulasalazar@gmail.com", "1101438719",
                "1953-06-07", "1975-04-20", "1980-05-31", "1976-11-06", "969484899", 2,
                $appointments = [14]
            ],
            [
                "María Catalina", "Salgado Granja", "Catalina", "catysal@outlook.es", "1701919654",
                "1944-01-16", "1963-03-06", "1968-03-15", "1964-07-25", "994166115", 3,
                $appointments = [14]
            ],
            [
                "Hilda Faviola", "Salguero Malliquinga", "Hilda", "shildafaviola@gmail.com", "1700303215",
                "1946-12-24", "1966-07-02", "1971-07-19", "1967-09-13", "990552463", 8,
                $appointments = [10]
            ],
            [
                "María Elena", "Samaniego Valdivieso", "María Elena", "meriasamaniego@gmail.com", "1700302662",
                "1924-04-28", "1955-03-25", "1960-03-15", "1956-02-24", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Olga María", "Sanchez Procel", "Olga", "olgasanchez@gmail.com", "1000385888",
                "1932-02-11", "1955-08-06", "1960-12-08", "1956-07-25", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Cemira", "Sanchez Sanchez", "Cemira", "cemirasanchez@gmail.com", "900541293",
                "1938-01-01", "1962-07-12", "1967-07-19", "1963-11-14", "999137285", 19,
                $appointments = [14]
            ],
            [
                "Sandra Gabriela", "Santin Ochoa", "Sandra", "28m1975@gmail.com", "1103463459",
                "1975-05-28", "2007-09-27", "2013-08-15", "2009-07-18", "983888651", 33,
                $appointments = [14]
            ],
            [
                "Carmen de Jesús", "Sarango Cueva", "Carmen", "casamisionalmargaritanaseau@hotmail.com", "903220101",
                "1933-10-21", "1953-03-22", "1958-03-25", "1954-02-02", "986569055", 40,
                $appointments = [14]
            ],
            [
                "Concepción Adelina", "Sarchi Guayasamin", " Adelina", "adesarchi@hotmail.com", "1800421180",
                "1943-12-26", "1966-11-27", "1971-11-27", "1968-03-08", "988509757", 22,
                $appointments = [14]
            ],
            [
                "Gladys Leonor", "Sasig Unapanta", "Gladys", "sorgla20@hotmail.com", "1708077183",
                "1964-11-20", "1983-09-27", "1988-11-26", "1985-09-20", "983774389", 10,
                $appointments = [14]
            ],
            [
                "Sara Guadalupe", "Segovia Freire", "Sara", "sarasegovia@gmail.com", "600050025",
                "1944-05-20", "1967-09-27", "1972-09-27", "1968-09-16", "961595482", 34,
                $appointments = [14]
            ],
            [
                "Luz María Bernardita", "Serrano Serrano", "Luz María", "luzserrano@gmail.com", "101812642",
                "1961-08-21", "1981-05-31", "1986-11-27", "1983-05-01", "994250607", 8,
                $appointments = [14]
            ],
            [
                "Olga Marina", "Sillo Gallardo", "Marina", "marinahc14@gmail.com", "1706244454",
                "1959-01-28", "1983-09-27", "1990-03-15", "1985-09-20", "980602377", 9,
                $appointments = [14]
            ],
            [
                "Rita", "Soto Betancourth", "Rita", "ritasoto@gmail.com", "1000223048",
                "1946-11-26", "1963-08-09", "1968-08-15", "1964-11-12", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Jenny Alexandra", "Suquillo Rivera", "Jenny", "sorjenny21@yahoo.com", "1711275899",
                "1971-06-21", "2001-10-07", "2007-11-27", "2003-07-18", "989812817", 2,
                $appointments = [14]
            ],
            [
                "Teresa de Jesús", "Tacuri Carabajo", "Teresa", "terejesust@yahoo.com", "900758558",
                "1950-03-07", "1969-03-15", "1974-03-15", "1970-02-27", "985414760", 7,
                $appointments = [10]
            ],
            [
                "Jesús Cristina", "Tapia Pazmiño", "Cristina", "jesustapia@gmail.com", "1701925479",
                "1931-12-11", "1964-03-23", "1969-03-25", "1965-07-25", "981816813", 2,
                $appointments = [14]
            ],
            [
                "Emérita Eudofia", "Tapia Revelo", "Emérita", "emeritatapia@gmail.com", "500113402",
                "1941-10-02", "1962-03-04", "1967-03-15", "1963-07-25", "990552463", 8,
                $appointments = [14]
            ],
            [
                "Toa Miriam", "Tenenuela Yaule", "Toa", "miriansita-94@outlook.com", "604833798",
                "1994-04-17", "2016-05-31", "2022-03-19", "2018-03-10", "990594365", 39,
                $appointments = [14]
            ],
            [
                "Luisa Clementina", "Teran Teran", " Clementina", "luisateran@gmail.com", "600459671",
                "1919-06-19", "1941-03-12", "1946-03-15", "1942-02-15", "995397988", 35,
                $appointments = [14]
            ],
            [
                "Martha Luz", "Tisalema Peralta", "Martha", "malut26@gmail.com", "1802542744",
                "1971-09-26", "1992-11-26", "1997-11-27", "1994-06-12", "982249518", 28,
                $appointments = [10, 18]
            ],
            [
                "Laura Celina", "Toledo Romero", "Laura", "lauratoledo@gmail.com", "900559378",
                "1944-11-11", "1969-09-27", "1974-09-27", "1970-09-04", "984795709", 3,
                $appointments = [14]
            ],
            [
                "Guillermina", "Torres Flores", "Guillermina", "guillerminatorres@gmail.com", "200069730",
                "1939-02-28", "1957-12-05", "1962-12-08", "1959-03-12", "997800005", 12,
                $appointments = [14]
            ],
            [
                "Nardi Jaqueline", "Torres Marin", "Nardi", "narditorres@hotmail.com", "1103164974",
                "1973-09-01", "1992-11-26", "1997-11-27", "1994-06-12", "981846810", 25,
                $appointments = [10]
            ],
            [
                "Nelly María", "Torres Matamoros", "Nelly", "sornellytorresm@yahoo.es", "1703142917",
                "1950-08-02", "1970-09-27", "1975-09-27", "1972-02-06", "979789044", 29,
                $appointments = [10]
            ],
            [
                "Lucrecia", "Toscano Parra", "Lucrecia", "lucreciatoscano@gmail.com", "600160741",
                "1934-10-14", "1956-03-05", "1961-03-15", "1957-02-08", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Clara Luz", "Trujillo Gonzalez", "Clara", "claratrujillo@gmail.com", "100768225",
                "1921-03-26", "1944-03-11", "1949-03-15", "1945-02-23", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Dolores Virginia", "Ullauri Armijos", "Virginia", "doloresullauri@gmail.com", "1701926485",
                "1934-08-03", "1958-08-09", "1963-08-15", "1959-08-08", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Mery Mercy", "Ullco Cruz", "Mery", "uc783@hotmail.com", "1716364409",
                "1983-04-17", "2012-11-27", "2019-02-02", "2014-11-27", "999903205", 14,
                $appointments = [14]
            ],
            [
                "Blanca España", "Valarezo Martinez", "Blanca", "valarezoblanca@hotmail.com", "1100210333",
                "1943-12-04", "1962-11-14", "1968-05-31", "1964-01-30", "981487026", 21,
                $appointments = [14]
            ],
            [
                "Gloria de Jesús", "Valle Moya", "Gloria", "sorgloriavalle@hotmail.com", "1800211151",
                "1946-11-27", "1972-09-27", "1977-09-27", "1974-03-09", "997465841", 36,
                $appointments = [10]
            ],
            [
                "María Angélica", "Valverde Freire", "Angélica", "mariavalverde@gmail.com", "1000135275",
                "1939-09-02", "1959-11-25", "1965-05-31", "1961-02-10", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Elsa Cecilia", "Vargas Aguas", "Cecilia", "elsavargas@gmail.com", "1101487591",
                "1952-03-20", "1973-03-15", "1978-09-27", "1974-11-16", "991265897", 33,
                $appointments = [18]
            ],
            [
                "Ligia Moraima", "Vargas Aguilera", "Ligia", "ligiavargas@gmail.com", "1702322544",
                "1948-04-04", "1966-08-15", "1971-08-15", "1967-09-13", "981843740", 8,
                $appointments = [14]
            ],
            [
                "Esthela Marina", "Vargas Benavides", "Esthela", "esthelavargas@gmail.com", "1701788315",
                "1929-07-03", "1948-03-12", "1953-03-15", "1949-02-02", "993724591", 20,
                $appointments = [14]
            ],
            [
                "María Silvia", "Vargas Redin", "María", "mariavargas@gmail.com", "903241156",
                "1942-05-15", "1968-09-27", "1973-09-27", "1969-09-12", "989824155", 19,
                $appointments = [14]
            ],
            [
                "Delia María", "Vasquez Jimenez", "Delia", "deliavasquez@gmail.com", "902624865",
                "1929-04-21", "1952-11-23", "1958-03-25", "1953-11-15", "981843740", 34,
                $appointments = [14]
            ],
            [
                "Mélida Violeta", "Velastegui Dominguez", "Mélida", "melidavelastegui@gmail.com", "1701595157",
                "1936-12-31", "1964-01-22", "1969-03-15", "1965-07-25", "984795709", 3,
                $appointments = [14]
            ],
            [
                "Esthela Lucía", "Villalba Coloma", " Lucía", "esthelavillalba@gmail.com", "600100671",
                "1931-09-17", "1952-06-27", "1957-06-29", "1953-07-19", "993359409", 12,
                $appointments = [14]
            ],
            [
                "Amable Ernestina", "Villalba Coloma", " Ernestina", "amablevillalba@gmail.com", "1700302837",
                "1934-02-17", "1952-06-27", "1957-06-29", "1953-07-15", "985450018", 26,
                $appointments = [14]
            ],
            [
                "Ximena Verónica", "Vinueza Vinueza", " Verónica", "sorveronicavinueza@yahoo.com", "401227624",
                "1977-11-06", "1999-10-07", "2005-11-27", "2001-06-24", "999225546", 16,
                $appointments = [14]
            ],
            [
                "Cruz Angela", "Vivanco Samaniego", "Cruz Angela", "sorangelavivanco@hotmail.com", "1102313440",
                "1963-05-03", "1998-09-27", "2004-03-15", "2000-07-18", "993109371", 33,
                $appointments = [14]
            ],
            [
                "Angela Ramona", "Vivas Montalvan", "Angelita", "angelavivas@gmail.com", "600100697",
                "1936-07-26", "1959-05-22", "1964-05-31", "1960-07-25", "989523356", 15,
                $appointments = [14]
            ],
            [
                "Alegría Azucena", "Vizuete Chacon", "Alegría", "alegriavizuete@gmail.com", "501351837",
                "1962-08-16", "1984-03-15", "1990-03-15", "1986-03-30", "988290113", 43,
                $appointments = [14]
            ],
            [
                "Martha Mercedes", "Vizuete Chacon", "Martha", "marthamercedesvizuetechacon@yahoo.es", "501732879",
                "1968-06-24", "2000-09-27", "2006-11-27", "2002-07-18", "983137063", 8,
                $appointments = [14]
            ],
            [
                "Angélica Gonzalina", "Vizuete Peñafiel", "Angélica", "angelicavizuete@gmail.com", "600696223",
                "1948-09-18", "1968-09-27", "1973-09-27", "1969-09-12", "996533979", 23,
                $appointments = [14]
            ],
            [
                "Gabriela  Violeta", "Yepez  Imbaquingo", "Gabriela", "sorgaby01@hotmail.com", "1002860110",
                "1981-07-21", "2003-11-27", "2009-12-08", "2005-07-18", "985409031", 47,
                $appointments = [10]
            ],
        ];

        // $addressClass = new AddressController();

        foreach ($array as list(
            $name, $lastname, $fullnamecomm, $email,
            $id_card, $date_birth, $date_vocation,
            $date_vote, $date_send, $cellphone, $community_id,
            $appointments
        )) {



            if (strlen($id_card) == 9) {
                $id_card = '0' . $id_card;
            }
            $username = 'daughter ' . $name . ' ' . $lastname . ' ' . $id_card;

            $user =  User::create([
                'name' => $name,
                'lastname' => $lastname,
                'fullnamecomm' => $fullnamecomm,
                'email' =>  $email,
                'username' => $username,
                'slug' => Str::slug($username),
                'password' => Hash::make("secret"),
            ]);

            if ($date_vote != null) {
                $date_vote =  $date_vote . " 00:00:00";
            } else {
                $date_vote = null;
            }
            if ($date_send != null) {
                $date_send =  $date_send . " 00:00:00";
            } else {
                $date_send = null;
            }

            $profile = $user->profile()->create([
                'identity_card' => $id_card,
                'status' => 1,
                'date_birth' => $date_birth . " 00:00:00",
                'date_vocation' => $date_vocation . " 00:00:00",
                'date_admission' =>  $date_vocation . " 00:00:00",
                'date_vote' => $date_vote,
                'date_send' => $date_send,
                'cellphone' => "0" . $cellphone,
                'phone' => null,
                'observation' => 'Observación de la hermana ' . $user->name . ' ' . $user->lastname,
            ]);

            $community =  Community::find($community_id);

            $profile->address()->create([
                'address' => $community->address->address,
                'political_division_id' => $community->address->political_division_id,
            ]);

            $transfer =  $profile->transfers()->create([
                'transfer_reason' => 'Razón del cambio de la hermana ',
                'transfer_date_adission' => '2021-01-05 00:00:00',
                'transfer_observation' => 'Observaciones relacionadas al cambio de la hermana ' . $user->name,
                'community_id' => $community->id,
                'status' => 1,
            ]);

            if ($appointments) {
                foreach ((array)$appointments as $appointment) {
                    $appointment =  $transfer->appointments()->create([
                        'community_id' => $transfer->community_id,
                        'appointment_level_id' =>  $appointment,
                        'description' => "Descripción del nombramiento",
                        // 'date_appointment' => date('Y-m-d H:i:s', rand($min, $max)),
                        'date_appointment' => '2021-01-05 00:00:00',
                        'profile_id' => $profile->id,
                        'status' => 1,
                    ]);

                    if ($appointment->appointment_level_id == 7) {
                        $user->assignRole('daughter', 'secretary');
                    } else {
                        $user->assignRole('daughter');
                    }
                }
            }

            $this->createTeam($user);

            // // Convert to timetamps
            // $min = strtotime('2021-11-01 00:00:00');
            // $max = strtotime('2022-04-01 00:00:00');

            // // Generate random number using above bounds
            // $val = rand($min, $max);

            // if ($profile->status == 1) {
            //     $profile->update([
            //         'date_vocation' => date('Y-m-d H:i:s', $val),
            //         'date_admission' => date('Y-m-d H:i:s', $val),
            //     ]);
            // }
            // if ($profile->status == 2) {
            //     $profile->update([
            //         'date_death' => date('Y-m-d H:i:s', $val),
            //     ]);
            // }
            // if ($profile->status == 3) {
            //     $profile->update([
            //         'date_exit' => date('Y-m-d H:i:s', $val),
            //     ]);
            // }

            // $permit =  $profile->permits()->create([
            //     'reason' => 'Razón del permiso de ' . $user->name,
            //     'description' => 'Descripción del permiso',
            //     'date_province' => date('Y-m-d H:i:s', rand($min, $max)),
            //     'date_general' => date('Y-m-d H:i:s', rand($min, $max)),
            //     'date_out' => date('Y-m-d H:i:s', rand($min, $max)),
            //     'date_in' => date('Y-m-d H:i:s', rand($min, $max)),
            //     'status' => 1,
            // ]);

            // $political_division_id =  PoliticalDivision::where('level', '=', 3)
            //     ->where('last_level', '=', 'Y')
            //     ->inRandomOrder()
            //     ->first();

            // if (strlen($political_division_id->id) == 6) {
            //     $permit->address()->create([
            //         'address' => 'Dirección del permiso de la hermana ' . $user->name,
            //         'political_division_id' => '' .  $political_division_id->id,
            //     ]);
            // } else {
            //     $permit->address()->create([
            //         'address' => 'Dirección del permiso de la hermana ' . $user->name,
            //         'political_division_id' => '0' .  $political_division_id->id,
            //     ]);
            // }

            // for ($i = 0; $i < 15; $i++) {
            //     $profile->healths()->create([
            //         'actual_health' => $i . ' Salud actual ' . $user->name,
            //         'chronic_diseases' => $i . ' Enfermedades cronicas ' . $user->name,
            //         'other_health_problems' => $i . ' Otros problemas de salud ' . $user->name,
            //         'consult_date' => date('Y-m-d H:i:s', rand($min, $max)),
            //     ]);

            //     $profile->academic_trainings()->create([
            //         'name_title' => $i . 'Nombre del título ' . $user->name,
            //         'institution' => $i . ' Inst. ' . $user->name,
            //         'observation' => $i . ' Observaciones de titulo ' . $user->name,
            //         'date_title' => date('Y-m-d H:i:s', rand($min, $max)),
            //     ]);
            // }

            // $profile->sacraments()->create([
            //     'sacrament_name' => 'Primera Comunión',
            //     'observation' => ' Observation sac. ' . $user->name,
            //     'sacrament_date' => date('Y-m-d H:i:s', rand($min, $max)),
            // ]);
            // $profile->sacraments()->create([
            //     'sacrament_name' => 'Confirmación',
            //     'observation' => ' Observation sac. ' . $user->name,
            //     'sacrament_date' => date('Y-m-d H:i:s', rand($min, $max)),
            // ]);
            // $profile->sacraments()->create([
            //     'sacrament_name' => 'Bautismo',
            //     'observation' => ' Observation sac. ' . $user->name,
            //     'sacrament_date' => date('Y-m-d H:i:s', rand($min, $max)),
            // ]);
        }
    }
    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'Equipo de ' . $user->name,
            'personal_team' => true,
        ]));
    }
    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email): Team
    {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "HDLCCompany",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    }
}
