<?php

namespace App\Services;

use App\Features\Users\UserRepositoryInterface;
use App\Services\Events\EventInterface;
use Illuminate\Database\Eloquent\Model;

interface UnitOfWorkInterface
{
    public function add(Model $model): void;
    public function update(Model $model): void;
    public function delete(Model $model): void;
    public function users(): UserRepositoryInterface;
    public function dispatch(EventInterface $event): void;
    public function commit(): void;
}
