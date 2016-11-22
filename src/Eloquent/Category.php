<?php

namespace CopyaCategory\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Category extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'categories';
    protected $fillable = ['name', 'description'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


}
