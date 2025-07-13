<?php

namespace App\Cache;

use Illuminate\Support\Facades\Redis;

class RedisCacheManager
{
    public function cacheData($cacheKey, $cacheTime, $dataClosure): mixed
    {
        $cacheData = Redis::get($cacheKey);

        if ($cacheData) {
            // 如果資料存在，延長期限
            Redis::expire($cacheKey, $cacheTime);

            return unserialize($cacheData);
        } else {
            // 如果資料不存在，執行閉包函數取得資料
            $data = $dataClosure();
            $serializedData = serialize($data);
            Redis::setex($cacheKey, $cacheTime, $serializedData);

            return $data;
        }
    }

    public function clearKeys($pattern): void
    {
        $keys = Redis::keys($pattern);

        if (! empty($keys)) {
            foreach ($keys as $key) {
                Redis::del($key);
            }
        }
    }

    public static function getSha256Key(string $key): string
    {
        return hash('sha256', $key);
    }
}
