<?php

namespace CopyaCategory\Http\Controllers\API;

use Exception;
use Auth;
use CopyaCategory\Transformers\CategoryTransformer;
use Copya\Http\Controllers\API\ApiBaseController;
use CopyaCategory\Eloquent\Category;
use CopyaCategory\Http\Requests\CategoryRequest;


class CategoriesController extends ApiBaseController
{
    public function index()
    {
        return $this->collection(Category::all(), new CategoryTransformer);
    }

    public function show($id)
    {
        $navigation = Navigation::find($id);

        return $this->item($navigation, new NavigationTransformer);
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category;

            $category->name = $request->name;
            $category->description = $request->description;

            $category->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($category, new CategoryTransformer);
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);

            $category->name = $request->name;
            $category->description = $request->description;

            $category->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($category, new CategoryTransformer);
    }
}
