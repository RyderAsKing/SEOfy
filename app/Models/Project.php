<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'url', 'user_id'];

    public $casts = [
        'custom_fields' => SchemalessAttributes::class,
    ];

    public function scopeWithCustomFields(): Builder
    {
        return $this->custom_fields->modelScope();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
