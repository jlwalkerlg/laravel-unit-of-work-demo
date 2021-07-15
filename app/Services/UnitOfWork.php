<?php

namespace App\Services;

use App\Features\Users\UserRepository;
use App\Features\Users\UserRepositoryInterface;
use App\Services\Events\EventInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitOfWork implements UnitOfWorkInterface
{
    /** @var Model[] */
    private array $new = [];

    /** @var Model[] */
    private array $dirty = [];

    /** @var Model[] */
    private array $deleted = [];

    private UserRepository $userRepository;

    /** @var EventInterface[] */
    private array $events = [];

    public function add(Model $model): void
    {
        $this->new[] = $model;
    }

    public function update(Model $model): void
    {
        $this->dirty[] = $model;
    }

    public function delete(Model $model): void
    {
        $this->deleted[] = $model;
    }

    public function users(): UserRepositoryInterface
    {
        return $this->userRepository ??= new UserRepository;
    }

    public function dispatch(EventInterface $event): void
    {
        $this->events[] = $event;
    }

    public function commit(): void
    {
        DB::beginTransaction();

        foreach ($this->new as $model) {
            $model->save();
        }

        foreach ($this->dirty as $model) {
            $model->save();
        }

        foreach ($this->deleted as $model) {
            $model->delete();
        }

        foreach ($this->events as $event) {
            event($event);
        }

        DB::commit();
    }
}
