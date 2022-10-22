<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public static function throwExceptionIfNotTasks() {
        if (sizeof(Task::all()) === 0) {
            throw new Exception();
        }
    }
}
