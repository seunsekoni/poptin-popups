<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    /**
     * Get the owning domain.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    /**
     * Get the the rules for the popup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rules()
    {
        return $this->hasMany(PopupRule::class);
    }

    /**
     * Get the popup's code snippet.
     *
     * @return string
     */
    public function getSnippetLinkAttribute()
    {
        $fullUrl = request()->getSchemeAndHttpHost();
        return "{$fullUrl}/task.js?id={$this->domain->reference}";
    }
}
