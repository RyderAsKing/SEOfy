<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public $casts = ['features' => SchemalessAttributes::class];

    public function scopeWithFeatures(): Builder
    {
        return $this->features->modelScope();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
