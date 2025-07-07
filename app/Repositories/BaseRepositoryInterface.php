<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    /**
     * 取得所有資料。
     *
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function all(array $filter = [], array $columns = ['*']): mixed;

    /**
     * 取得所有資料並分頁。
     *
     * @param  int  $limit  每頁資料數量（可選，預設為null）
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     * @param  string  $method  分頁方法（預設為"paginate"）
     */
    public function paginate(array $filter = [], int $limit = 15, array $columns = ['*'], string $method = 'paginate'): mixed;

    /**
     * 透過指定的 ID 取得單一資料。
     *
     * @param  mixed  $id  資料 ID
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function find(mixed $id, array $columns = ['*']): mixed;

    /**
     * 透過指定欄位和值取得單一資料。
     *
     * @param  string  $field  欄位名稱
     * @param  mixed  $value  欄位值
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function findByField(string $relation, string $field, mixed $value, array $columns = ['*']): mixed;

    /**
     * 透過指定條件取得符合的多筆資料。
     *
     * @param  array  $where  欄位與值的條件陣列
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function findWhere(array $where, array $columns = ['*']): mixed;

    /**
     * 透過指定欄位和值的範圍條件，取得多筆資料。
     *
     * @param  string  $field  欄位名稱
     * @param  array  $values  欄位值的範圍陣列
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function findWhereIn(string $field, array $values, array $columns = ['*']): mixed;

    /**
     * 透過指定欄位和不包含的值的條件，取得多筆資料。
     *
     * @param  string  $field  欄位名稱
     * @param  array  $values  不包含的值的陣列
     * @param  array  $columns  選擇的欄位（預設為所有欄位）
     */
    public function findWhereNotIn(string $field, array $values, array $columns = ['*']): mixed;

    /**
     * 創建一個新的實體。
     *
     * @param  array  $attributes  要創建的屬性
     */
    public function create(array $attributes): mixed;

    /**
     * 透過 ID 更新一個實體。
     *
     * @param  array  $attributes  更新的屬性
     * @param  mixed  $id  要更新的實體 ID
     */
    public function update(array $attributes, mixed $id): mixed;

    public function getQuery($filter = []);

    public function getModel();

    public function newQuery();

    public function applyDefaultConditions($query);
}
