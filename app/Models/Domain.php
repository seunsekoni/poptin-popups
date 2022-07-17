<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    /**
     * Interact with the popup's url.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function topLevel(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => preg_replace('/^(https?:|http?:)\/\//', '', $value),
        );
    }

    /**
     * Get the owning user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the popups for the domain.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function popups()
    {
        return $this->hasMany(Popup::class);
    }
}
