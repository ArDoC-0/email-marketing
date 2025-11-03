<?php

namespace Domain\Shared\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ReadCsvAction
{
    public static function execute(string $path)
    {
        $file = fopen($path, 'r');
        $data = [];
        while ($row = fgetcsv($file)) {
            $data[] = $row;
        }
        $data = [
            'head' => collect($data[0])->map(fn($title) => Str::snake($title)),
            'body' => collect($data)->slice(1)
        ];

        return  array_values($data['body']
        ->map(fn($subs) => $data['head']->combine($subs)->all())
        ->all());
    }
}
