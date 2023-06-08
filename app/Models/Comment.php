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

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_comment_id', 'id');
    }
}
