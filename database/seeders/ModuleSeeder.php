<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = ['Neural Networks','Final Year Project','Security of Real World Systems', 'Dependable and Distributed Systems','Networking'];
        foreach(User::all() as $user){
            foreach($titles as $title)
                Module::factory()->create(['title'=>$title,'user_id'=>$user->id]);
        }
    }
}
