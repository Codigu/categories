<?php

namespace CopyaCategory\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaCategory\Eloquent\Category;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => (int) $category->id,
            'name' => $category->name,
            'description' => $category->description,
        ];
    }
}