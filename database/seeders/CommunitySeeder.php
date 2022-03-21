<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i <= 15; $i++) {
            $name_community = 'COMUNIDAD ' . Str::random(10);
            $commmunity =    Community::create([
                'comm_identity_card' => Str::random(10),
                'comm_name' =>     $name_community,
                'comm_slug' => Str::slug($name_community),
                'comm_level' => 1,
                'comm_cellphone' =>  Str::random(6),
                'comm_phone' => Str::random(6),
                'comm_email' => Str::random(10) . '@gmail.com',
                'date_fndt_comm' => '1900-02-01',
                'date_fndt_work' => '1900-12-10',
                'rn_collaborators' => $i * 3
            ]);

            $commmunity->inventory()->create([
                'name' => $name_community,
                'description' => 'Description for ' . $name_community
            ]);

            for ($j = 0; $j <= 2; $j++) {
                $commmunity->inventory->sections()->create([
                    'name' => 'Secion ' . $j . ' name for ' . $name_community,
                    'description' => 'Description section for ' . $name_community . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                ]);
            }

            $name_community = '';
        }

        for ($i = 1; $i <= 13; $i++) {
            if ($i % 2 == 0) {
                for ($j = 0; $j <= 5; $j++) {
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
                        'date_fndt_comm' => '1900-02-01',
                        'date_fndt_work' => '1900-12-10',
                        'rn_collaborators' => $j * 3
                    ]);

                    $work->inventory()->create([
                        'name' => $name_work,
                        'description' => 'Description work for ' . $name_work
                    ]);

                    for ($k = 0; $k <= 2; $k++) {
                        $work->inventory->sections()->create([
                            'name' => 'Secion ' . $k . ' name for ' . $name_work,
                            'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                        ]);
                    }

                    $name_work = "";
                }
            } else {
                for ($j = 0; $j <= 4; $j++) {
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
                        'date_fndt_comm' => '1900-02-01',
                        'date_fndt_work' => '1900-12-10',
                        'rn_collaborators' => $j * 3
                    ]);

                    $work->inventory()->create([
                        'name' => $name_work,
                        'description' => 'Description work for ' . $name_work
                    ]);

                    for ($k = 0; $k <= 2; $k++) {
                        $work->inventory->sections()->create([
                            'name' => 'Secion ' . $k . ' name for ' . $name_work,
                            'description' => 'Description section for ' . $name_work . "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc."
                        ]);
                    }

                    $name_work = "";
                }
            }
        }
    }
}
