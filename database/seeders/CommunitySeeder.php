<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use App\Models\PoliticalDivision;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i <= 100; $i++) {

            // Convert to timetamps
            $min = strtotime('1900-02-01 00:00:00');
            $max = strtotime('2022-02-01 00:00:00');

            // Generate random number using above bounds
            $val = rand($min, $max);

            // Convert back to desired date format

            $name_community = 'COMUNIDAD ' . Str::random(10);
            $commmunity =    Community::create([
                'comm_identity_card' => Str::random(10),
                'comm_name' =>     $name_community,
                'comm_slug' => Str::slug($name_community),
                'comm_level' => 1,
                'comm_cellphone' =>  Str::random(6),
                'comm_phone' => Str::random(6),
                'comm_email' => Str::random(10) . '@gmail.com',
                'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
                'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
                'comm_status' => rand(1, 0),
                'rn_collaborators' => $i * 3,
                'pastoral_id' => rand(1, 9)
            ]);
            $political_division_id =   PoliticalDivision::where('level', '=', 3)
                ->where('last_level', '=', 'Y')
                ->inRandomOrder()
                ->first();

            if (strlen($political_division_id->id) == 6) {
                $commmunity->address()->create([
                    'address' => 'Dirr de ' . $name_community,
                    'political_division_id' => '' . $political_division_id->id . '',
                ]);
            } else {
                $commmunity->address()->create([
                    'address' => 'Dirr de ' . $name_community,
                    'political_division_id' => '0' . $political_division_id->id . '',
                ]);
            }



            $commmunity->inventory()->create([
                'name' => $name_community,
                'description' => 'Description for ' . $name_community
            ]);

            for ($j = 0; $j <= 2; $j++) {
                $name_section = 'Secion ' . $j . ' name for ' . $name_community;

                $section =    $commmunity->inventory->sections()->create([
                    'name' => $name_section,
                    'slug' => Str::slug($name_section),
                    'description' => 'Description section for ' . $name_community . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                ]);

                for ($u = 0; $u <= 5; $u++) {
                    $section->articles()->create([
                        "name" => Str::random(30),
                        "color" => Str::random(15),
                        "price" => 10,
                        "material" => rand(1, 5),
                        "status" =>  rand(1, 5),
                        "size" => "0.5",
                        "brand" => "buena",
                        "description" => "description product",
                        "section_id" => $section->id
                    ]);
                }
                $name_section = "";
            }

            $name_community = '';
        }

        for ($i = 1; $i <= 3; $i++) {
            if ($i % 2 == 0) {
                for ($j = 0; $j <= 2; $j++) {

                    // Convert to timetamps
                    $min = strtotime('1900-02-01 00:00:00');
                    $max = strtotime('2022-02-01 00:00:00');

                    // Generate random number using above bounds
                    $val = rand($min, $max);

                    // Convert back to desired date format

                    $name_work = 'OBRA ' . Str::random(14);
                    $work = Community::create([
                        'comm_id' => $i,
                        'comm_identity_card' => Str::random(10),
                        'comm_name' => $name_work,
                        'comm_slug' => Str::slug($name_work),
                        'comm_level' => 2,
                        'comm_cellphone' =>  Str::random(6),
                        'comm_phone' => Str::random(6),
                        'comm_email' => Str::random(10) . '@gmail.com',
                        'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
                        'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
                        'rn_collaborators' => $j * 3,
                        'comm_status' => 1,
                        'pastoral_id' => rand(1, 9)
                    ]);
                    $political_division_id =   PoliticalDivision::where('level', '=', 3)
                        ->where('last_level', '=', 'Y')
                        ->inRandomOrder()
                        ->first();
                    if (strlen($political_division_id->id) == 6) {
                        $work->address()->create([
                            'address' => 'Dirr de ' . $name_work,
                            'political_division_id' => '' . $political_division_id->id . '',
                        ]);
                    } else {
                        $work->address()->create([
                            'address' => 'Dirr de ' . $name_work,
                            'political_division_id' => '0' . $political_division_id->id . '',
                        ]);
                    }

                    $work->inventory()->create([
                        'name' => $name_work,
                        'description' => 'Description work for ' . $name_work
                    ]);

                    for ($k = 0; $k <= 2; $k++) {
                        $name_section = 'Secion ' . $k . ' name for ' . $name_work;

                        $section =  $work->inventory->sections()->create([
                            'name' => $name_section,
                            'slug' => Str::slug($name_section),
                            'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                        ]);

                        for ($u = 0; $u <= 3; $u++) {
                            $section->articles()->create([
                                "name" => Str::random(30),
                                "color" => Str::random(15),
                                "price" => 10,
                                "material" => rand(1, 5),
                                "status" =>  rand(1, 5),
                                "size" => "0.5",
                                "brand" => "buena",
                                "description" => "description product",
                                "section_id" => $section->id
                            ]);
                        }
                        $name_section = "";
                    }

                    $name_work = "";
                }
            } else {
                for ($j = 0; $j <= 2; $j++) {
                    // Convert to timetamps
                    $min = strtotime('1900-02-01 00:00:00');
                    $max = strtotime('2022-02-01 00:00:00');

                    // Generate random number using above bounds
                    $val = rand($min, $max);

                    // Convert back to desired date format
                    $name_work = 'OBRA ' . Str::random(14);
                    $work =  Community::create([
                        'comm_id' => $i,
                        'comm_identity_card' => Str::random(10),
                        'comm_name' => $name_work,
                        'comm_slug' => Str::slug($name_work),
                        'comm_level' => 2,
                        'comm_cellphone' =>  Str::random(6),
                        'comm_phone' => Str::random(6),
                        'comm_email' => Str::random(10) . '@gmail.com',
                        'date_fndt_comm' =>  date('Y-m-d H:i:s', $val),
                        'date_fndt_work' =>  date('Y-m-d H:i:s', $val),
                        'rn_collaborators' => $j * 3,
                        'comm_status' => 1,
                        'pastoral_id' => rand(1, 9)
                    ]);
                    $political_division_id =   PoliticalDivision::where('level', '=', 3)
                        ->where('last_level', '=', 'Y')
                        ->inRandomOrder()
                        ->first();
                    if (strlen($political_division_id->id) == 6) {
                        $work->address()->create([
                            'address' => 'Dirr de ' . $name_work,
                            'political_division_id' => '' . $political_division_id->id . '',
                        ]);
                    } else {
                        $work->address()->create([
                            'address' => 'Dirr de ' . $name_work,
                            'political_division_id' => '0' . $political_division_id->id . '',
                        ]);
                    }

                    $work->inventory()->create([
                        'name' => $name_work,
                        'description' => 'Description work for ' . $name_work
                    ]);

                    for ($k = 0; $k <= 2; $k++) {
                        $name_section = 'Secion ' . $k . ' name for ' . $name_work;

                        $section = $work->inventory->sections()->create([
                            'name' => $name_section,
                            'slug' => Str::slug($name_section),
                            'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                        ]);

                        for ($u = 0; $u <= 5; $u++) {
                            $section->articles()->create([
                                "name" => Str::random(30),
                                "color" => Str::random(15),
                                "price" => 10,
                                "material" => rand(1, 5),
                                "status" =>  rand(1, 5),
                                "size" => "0.5",
                                "brand" => "buena",
                                "description" => "description product",
                                "section_id" => $section->id
                            ]);
                        }
                        $name_section = "";
                    }

                    $name_work = "";
                }
            }
        }
    }
}
