<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateDefaultUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a default user for the application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->ask('Enter the user name');
        $email = $this->ask('Enter the user email');
        $password = $this->secret('Enter the user password');

        User::create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
        ]);

        return self::SUCCESS;
    }
}
