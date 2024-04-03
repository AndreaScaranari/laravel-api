<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $project_ids = Project::pluck('id')->toArray();

        $techs = [
            ['label' => 'HTML', 'color' => 'secondary'],
            ['label' => 'CSS', 'color' => 'primary'],
            ['label' => 'JavaScript', 'color' => 'warning'],
            ['label' => 'Bootstrap', 'color' => 'dark'],
            ['label' => 'Vue', 'color' => 'success'],
            ['label' => 'SQL', 'color' => 'muted'],
            ['label' => 'PHP', 'color' => 'dark'],
            ['label' => 'Laravel', 'color' => 'danger'],
        ];

        foreach($techs as $tech) {
            $new_tech = new Technology();

            $new_tech->label = $tech['label'];
            $new_tech->slug = Str::slug($tech['label']);
            $new_tech->color = $tech['color'];

            $new_tech->save();

            // $tech_projects = [];
            // foreach($project_ids as $project_id){
            //     if(rand(0,1)) $tech_projects[] = $project_id;
            // }
            $tech_projects = array_filter($project_ids, fn () => rand(0,1));
            $new_tech->projects()->attach($tech_projects);
        }
    }
}
