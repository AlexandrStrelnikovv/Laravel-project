<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;

class MakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data';

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
//        $user = User::find(1);
//        $tasks = $user->tasks->toArray();
//        dd($tasks);

        $this->create();
    }

    public function create()
    {
        $user1 = User::create([
            'name' => 'vova',
            'email' => 'vova@mail.ru',
            'password' => bcrypt('vova'),
        ]);

        $user2 = User::create([
            'name' => 'den',
            'email' => 'den@mail.ru',
            'password' => bcrypt('den'),
        ]);

    }
}
