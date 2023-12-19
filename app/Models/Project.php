<?php

namespace App\Models;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'url',
        'user_id',
        'plan_id',
        'custom_fields',
        'public_note',
        'private_note',
    ];

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

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
    }
}
