<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Models\Api\v1\AuthCategories;
use App\Models\Api\v1\User;

class CreateAdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the admin account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newLine();

        $this->line('Enter the admin account details, ');

        $name = $this->ask('Username : ');

        $email = $this->ask('Email : ');

        $password = $this->secret('Password : ');

        if ($this->confirm('Confirm the creation of the admin account?', true)) {

            try {

                // Input data validation

                $validateUser = Validator::make(
                    [
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
                    ],
                    [
                        'name' => ['required', 'string', 'max:100'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                        'password' => ['required', Rules\Password::defaults()],
                    ]
                );

                if ($validateUser->fails()) {
                    return $this->error('Input data validation error!');
                }

                $AuthCategoriesId = AuthCategories::where('name', 'admin')->value('id');

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'auth_category_id' => $AuthCategoriesId,
                ]);

                event(new Registered($user));

                return $this->info('Admin account `' . $name . '` created successfully!');
            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        } else {
            $this->error('Admin account creation canceled!');
        }
    }
}
