<?php

namespace Domain\Shared\Concerns;

use Domain\Shared\Models\User as ModelsUser;
use Domain\Shared\Scopes\Userscope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    /**
         * Get the user that owns the HasUser
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user(): BelongsTo
        {
            return $this->belongsTo(ModelsUser::class);
        }

        protected static function booted()
        {
            static::addGlobalScope(new Userscope());
        }
    
}