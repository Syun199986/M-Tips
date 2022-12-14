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
        // 'category_id',
        'user_name',
    ];
    
    public function order($select)
    {
        if($select == 'old'){
            return $this->orderBy('created_at', 'asc')->get();
        } elseif($select == 'new') {
            return $this->orderBy('created_at', 'desc')->get();
        } else {
            return $this->orderBy('created_at', 'desc')->get();;
        }    
    }
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
