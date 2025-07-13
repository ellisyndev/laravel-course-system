<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all();

    public function find($id);

    public function findOrFail($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function destroy(array $ids);

    public function paginate(int $perPage = 10);
}
