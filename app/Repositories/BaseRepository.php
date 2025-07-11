<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records
     */
    public function all(): Collection
    {
        return $this->model->newQuery()->get();
    }

    /**
     * Find a record
     */
    public function find($id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * Find a record or throw an exception
     */
    public function findOrFail($id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * Create a record
     */
    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * Update a record
     */
    public function update($id, array $data): bool
    {
        return $this->findOrFail($id)->update($data);
    }

    /**
     * Delete a record
     */
    public function delete($id): bool
    {
        return $this->findOrFail($id)->delete();
    }

    /**
     * Destroy records
     */
    public function destroy(array $ids): int
    {
        if (empty($ids)) {
            return 0;
        }

        return $this->model->newQuery()->whereIn('id', $ids)->delete();
    }

    /**
     * Get records with pagination
     */
    public function paginate(int $perPage = 10, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->newQuery()->select($columns)->paginate($perPage);
    }

    /**
     * Update or create a record
     */
    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->model->newQuery()->updateOrCreate($attributes, $values);
    }

    /**
     * Search records by criteria
     */
    public function searchByCriteria(array $criteria): Collection
    {
        $query = $this->model->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value); // 處理多值條件
            } else {
                $query->where($key, $value); // 單值條件
            }
        }

        return $query->get();
    }

    /**
     * Upsert a record
     *
     * @param  array|null  $update
     */
    public function upsert(array $data, array $uniqueKeys, $update = null): bool
    {
        return $this->model->newQuery()
            ->upsert($data, $uniqueKeys, $update);
    }
}
