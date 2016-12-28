<?php

namespace CopyaCategory\Shortcodes;

use Illuminate\Contracts\Container\Container;
use CopyaCategory\Eloquent\Category;
use Illuminate\Support\Facades\View;

class CategoryShortcode {

    public function register($shortcode, $content, $compiler, $name)
    {
        $categories = Category::all();

        return view('vendor.copya.front.widgets.categories', ['categories' => $categories]);

    }
}