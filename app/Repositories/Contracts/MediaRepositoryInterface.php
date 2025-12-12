<?php

namespace App\Repositories\Contracts;

use App\Models\Media;
use Ramsey\Collection\Collection;

interface MediaRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): Media;
    public function update(Media $media, array $data): bool;
    public function delete(int $id): bool;
    public function findById(int $id): ?Media;
}

