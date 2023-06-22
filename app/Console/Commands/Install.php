<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Api\v1\AuthCategories;
use App\Models\Api\v1\Role;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App installation setup';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {
            // Run the installation

            AuthCategories::insert([
                ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ]);

            Role::insert([
                [
                    'name' => 'principle', # For government institutions
                    'permissions' => json_encode(
                        [
                            'institutions.index',
                            'institutions.store',
                            'institutions.update',
                            'institutions.delete',
                            'classrooms.index',
                            'classrooms.store',
                            'classrooms.update',
                            'classrooms.delete',
                            'students.index',
                            'students.store',
                            'students.update',
                            'students.delete'
                        ]
                    ), 'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'name' => 'head', # For private institutions
                    'permissions' => json_encode(
                        [
                            'institutions.index',
                            'institutions.store',
                            'institutions.update',
                            'institutions.delete',
                            'classrooms.index',
                            'classrooms.store',
                            'classrooms.update',
                            'classrooms.delete',
                            'students.index',
                            'students.store',
                            'students.update',
                            'students.delete'
                        ]
                    ), 'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'name' => 'teacher', # For government and private institutions
                    'permissions' => json_encode(
                        [
                            'classrooms.index',
                            'classrooms.store',
                            'classrooms.update',
                            'classrooms.delete',
                            'students.index',
                            'students.store',
                            'students.update',
                            'students.delete'
                        ]
                    ), 'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'name' => 'parent', # For government and private institutions
                    'permissions' => json_encode(
                        [
                            'students.index',
                            'students.update',
                        ]
                    ), 'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'name' => 'student', # For government and private institutions
                    'permissions' => json_encode(
                        [
                            'students.index',
                        ]
                    ), 'created_at' => now(), 'updated_at' => now()
                ]
            ]);

            return $this->info('App installed successfully!');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
