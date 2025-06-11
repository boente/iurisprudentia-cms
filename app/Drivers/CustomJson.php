<?php

namespace App\Drivers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Orbit\Drivers\Json;
use SplFileInfo;

class CustomJson extends Json
{
    protected function dumpContent(Model $model): string
    {
        $data = array_filter($this->getModelAttributes($model), fn ($value) => $value !== null);

        $data = [
            'id' => $data['id'],
            ...$data['data'],
        ];

        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    protected function parseContent(SplFileInfo $file): array
    {
        $contents = parent::parseContent($file);

        return [
            'id' => $contents['id'],
            'data' => Arr::except($contents, 'id'),
        ];
    }
}
