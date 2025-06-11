<?php

namespace App\Models;

use App\Jobs\BuildIurisprudentia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;

class Collection extends Model
{
    use Orbital;

    protected $guarded = [];

    protected $casts = [
        'data' => 'json',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            BuildIurisprudentia::dispatch()->delay(now()->addSeconds(10));
        });
    }

    public static function getOrbitalName(): string
    {
        return 'model_json';
    }

    public static function schema(Blueprint $table)
    {
        $table->string('id');
        $table->string('data');
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getIncrementing()
    {
        return false;
    }
}
