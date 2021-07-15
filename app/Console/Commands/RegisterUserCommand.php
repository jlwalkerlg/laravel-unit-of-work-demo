<?php

namespace App\Console\Commands;

use App\Features\Users\RegisterUser\RegisterUserHandler;
use Faker\Generator;
use Illuminate\Console\Command;

class RegisterUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new user.';

    public function __construct(
        private RegisterUserHandler $handler,
        private Generator $faker
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $command = new \App\Features\Users\RegisterUser\RegisterUserCommand();
        $command->name = $this->faker->name();
        $command->email = $this->faker->email();
        $command->password = $this->faker->password();

        $userDto = $this->handler->handle($command);

        $this->output->success('New user registered.');

        $this->output->table(
            [
                'ID', 'Name', 'Email'
            ],
            [
                [
                    $userDto->id,
                    $userDto->name,
                    $userDto->email
                ],
            ]
        );

        return 0;
    }
}
