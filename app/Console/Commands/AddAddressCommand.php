<?php

namespace App\Console\Commands;

use App\Features\Users\AddAddress\AddAddressHandler;
use App\Models\User;
use Faker\Generator;
use Illuminate\Console\Command;

class AddAddressCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:addresses:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add address to user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private AddAddressHandler $handler,
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
        $command = new \App\Features\Users\AddAddress\AddAddressCommand();
        $command->userId = User::query()->first()?->id;
        $command->line_1 = $this->faker->streetAddress();
        $command->line_2 = null;
        $command->city = $this->faker->city();
        $command->postcode = $this->faker->postcode();

        $this->handler->handle($command);

        return 0;
    }
}
