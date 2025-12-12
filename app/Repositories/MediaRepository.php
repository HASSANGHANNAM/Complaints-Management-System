<?php

namespace App\Repositories;

use App\Models\Media;
use App\Repositories\Contracts\MediaRepositoryInterface;
use Ramsey\Collection\Collection;

class MediaRepository implements MediaRepositoryInterface
{
    public function __construct(private Media $media) {}

    public function all(): Collection
    {
        return new Collection(Media::class, Media::all()->toArray());
    }

    public function create(array $data): Media
    {
        return $this->media->create([
            'Media' => $data['Media'],
            'ComplaintId' => $data['ComplaintId'],
        ]);
    }

    public function update(Media $media, array $data): bool
    {
        return $media->update($data);
    }

    public function delete(int $id): bool
    {
        $media = $this->findById($id);
        if (!$media) {
            return false;
        }
        return $media->delete();
    }

    public function findById(int $id): ?Media
    {
        return $this->media->find($id);
    }
}

