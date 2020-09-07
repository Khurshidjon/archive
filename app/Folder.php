<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = [];
    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->hasOne(Folder::class, 'id', 'parent_id');
    }
}
