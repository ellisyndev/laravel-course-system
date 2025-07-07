<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements BaseRepositoryInterface
{
    /**
     * 注入model
     */
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(array $filter = [], array $columns = ['*']): array|\Illuminate\Database\Eloquent\Collection
    {
        $query = $this->model->newQuery();

        return $query->get($columns);
    }

    public function paginate(array $filter = [], int $limit = 15, array $columns = ['*'], string $method = 'paginate'): mixed
    {
        $query = $this->getQuery($filter);

        $sorting = $filter['sorting'] ?? 'id';
        $direction = $filter['direction'] ?? 'asc';

        $query->orderBy($sorting, $direction);

        $perPage = $filter['per_page'] ?? $limit;
        $page = $filter['page'] ?? 1;

        return $query->paginate($perPage, $columns, 'page', $page);
    }

    public function find(mixed $id, array $columns = ['*']): mixed
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    public function findByField(string $relation, string $field, mixed $value, array $columns = ['*']): mixed
    {
        $query = $this->model->newQuery();

        return $query->whereHas($relation, function ($query) use ($field, $value) {
            $query->where($field, $value);
        })->first($columns);
    }

    public function findWhere(array $where, array $columns = ['*']): mixed
    {
        $query = $this->model->newQuery();

        foreach ($where as $field => $value) {
            $query->where($field, $value);
        }

        return $query->get($columns);
    }

    public function findWhereIn(string $field, array $values, array $columns = ['*']): mixed
    {
        $query = $this->model->newQuery();

        return $query->whereIn($field, $values)->get($columns);
    }

    public function findWhereNotIn(string $field, array $values, array $columns = ['*']): mixed
    {
        $query = $this->model->newQuery();

        return $query->whereNotIn($field, $values)->get($columns);
    }

    public function create(array $attributes): mixed
    {
        $query = $this->model->newQuery();

        return $query->create($attributes);
    }

    public function update(array $attributes, mixed $id): mixed
    {
        $query = $this->model->newQuery();

        $record = $query->findOrFail($id);
        $record->update($attributes);

        return $record;
    }

    public function getQuery($filter = []): \Illuminate\Database\Eloquent\Builder {}

    public function getModel(): Issue
    {
        return $this->model;
    }

    public function newQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model
            ->newQuery();
    }

    public function applyDefaultConditions($query)
    {
        return $query;
    }
}
