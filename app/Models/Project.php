<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "projects";

    protected $primaryKey = "id";

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function progressPercentage(): int
    {
        $total = $this->tasks()->count();

        if ($total === 0) return 0;

        $done = $this->tasks()->where('status','done')->count();

        return (int) round(($done / $total) * 100);
    }
}
