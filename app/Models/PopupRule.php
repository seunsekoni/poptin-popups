<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupRule extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the owning popup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function popup()
    {
        return $this->belongsTo(Popup::class);
    }
}
