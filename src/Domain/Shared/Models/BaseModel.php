<?php

namespace Domain\Shared\Models;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static function newFactory()
    {
        $parts = str(get_called_class())->explode('\\');
        $domain = $parts[1];
        $model = $parts->last();

        return app("\\Database\\Factories\\{$domain}\\{$model}Factory");

    }
}
