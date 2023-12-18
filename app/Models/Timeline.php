<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
