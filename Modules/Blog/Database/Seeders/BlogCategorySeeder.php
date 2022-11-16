<?php

namespace Modules\Blog\Database\Seeders;

use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return Generator
     * @throws BindingResolutionException
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
//        ini_set('memory_limit', '-1');
//        $data =[];
        for ($i = 0; $i < 1000; $i++) {
//            $data[] = [
//                'id' => Str::uuid()->toString(),
//                'title' => "title$i",
//                'slug' => str("title$i")->slug(),
//                'created_at' => Carbon::now()
//            ];
            BlogCategory::insert([
                'id' => Str::uuid()->toString(),
                'title' => "title$i",
                'slug' => str("title$i")->slug(),
                'created_at' => Carbon::now()
            ]);
        }

//        BlogCategory::insert($data);

//        BlogCategory::factory()->count(100)->create();
        BlogCategory::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'title' => 'Technology',
                'slug' => str('Technology')->slug(),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645982',
                'title' => 'Animal',
                'slug' => str('Animal')->slug(),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
