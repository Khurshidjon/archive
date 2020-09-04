<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];
    public function children()
    {
        return $this->hasMany(File::class, 'parent_id', 'id');
    }
}
