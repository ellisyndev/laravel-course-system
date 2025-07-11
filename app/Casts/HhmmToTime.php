<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class HhmmToTime implements CastsAttributes
{
    /**
     * 讀取時：將 hhmm 字串轉為 H:i
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (! $value || strlen($value) !== 4) {
            return null;
        }

        return substr($value, 0, 2).':'.substr($value, 2, 2);
    }

    /**
     * 存入時：將 H:i 轉為 hhmm 字串
     */
    public function set($model, string $key, $value, array $attributes)
    {
        // 如果給的是 Carbon，先轉成 H:i
        if ($value instanceof \DateTimeInterface) {
            $value = $value->format('H:i');
        }

        if (preg_match('/^\d{2}:\d{2}$/', $value)) {
            return str_replace(':', '', $value); // 轉為 hhmm 格式
        }

        return $value; // fallback（直接儲存）
    }
}
