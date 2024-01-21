<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class GenerateCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cafs:generate-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Main Category 1',
                'parent_id' => null
            ],
            [
                'id' => 2,
                'name' => 'Sub Category 1',
                'parent_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Sub Category 2',
                'parent_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'Main Category 2',
                'parent_id' => null
            ],
            [
                'id' => 5,
                'name' => 'Sub Category 3',
                'parent_id' => 4
            ],
            [
                'id' => 6,
                'name' => 'Sub Category 4',
                'parent_id' => 4
            ],
        ]);
        $this->info('Generated categories successfully.');
    }
}
