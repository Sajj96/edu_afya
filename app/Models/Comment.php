<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments_tbl';

    public $timestamps = false;

    public function reply()
    {
        return $this->belongsTo(self::class, 'parent_comment_id', 'id');
    }

    protected static function boot() 
    {
      parent::boot();

      static::deleting(function($comments) {
        foreach ($comments->replies()->get() as $replies) {
            $replies->delete();
        }

      });
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_comment_id', 'id');
    }
}
