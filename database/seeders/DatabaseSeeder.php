<?php

namespace Database\Seeders;

use App\Models\Atrebute;
use App\Models\AtrebuteCharacter;
use App\Models\Category;
use App\Models\Character;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        for ($i=1; $i <=10; $i++) { 
            # code...
            Category::create([
                'name'=>'Category'.$i
            ]);
        }
        for ($i=1; $i <=10; $i++) { 
            Atrebute::create([
                'category_id'=>rand(1,10),
                'name'=>'Atrebut'.$i
            ]);
        }
        for ($i=1; $i <=30; $i++) { 
            Character::create([
                'name'=>'Character'.$i
            ]);
        }
        for ($i=1; $i <=50 ; $i++) { 
            AtrebuteCharacter::create([
                'atrebute_id'=>rand(1,10),
                'character_id'=>rand(1,30)
            ]);
        }
        for ($i=1; $i < 10; $i++) { 
            PostCategory::create([
                'name'=>'PostCategory'.$i
            ]);
        }
        for ($i=1; $i <=10; $i++) { 
            Post::create([
                'category_id'=>rand(1,10),
                'title'=>'title'.$i,
                'description'=>'description'.$i,
                'text'=>'text'.$i,
                'file'=>'file'.$i
            ]);
        }
    }

}
