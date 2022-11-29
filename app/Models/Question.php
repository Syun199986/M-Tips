<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_name'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
