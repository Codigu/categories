<?php

namespace CopyaCategory\Http\Controllers\API;

use Exception;
use Auth;
use Copya\Eloquent\Form;
use Copya\Transformers\FormTransformer;
use Copya\Http\Controllers\API\ApiBaseController;

class CategoriesController extends ApiBaseController
{
    public function index()
    {
        return $this->collection(Form::all(), new FormTransformer);
    }

    public function show($id)
    {
        $navigation = Navigation::find($id);

        return $this->item($navigation, new NavigationTransformer);
    }

    public function store(NavigationRequest $request)
    {
        try {
            $navigation = new Navigation;

            $navigation['display_name'] = $request->name;

            $navigation->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $navigation]);
    }

    public function update(NavigationRequest $request, $id)
    {
        //$items = $request->get('items');
        if($request->has('items') && count($request->get('items')) > 0){
            return $this->saveNavigationItems($request->get('id'), $request->get('items'));
        } else if( $request->has('update') && $request->get('update') == 'item_detail'){
            $id = $request->get('menu_id');
            $navigation = Navigation::find($request->get('navigation_id'));
            $data = array(
                'name' => $request->get('name'),
                'target' => $request->get('target'),
                'description' => $request->get('description'),
                'active' => (bool) $request->get('active'),
                'rel' => $request->get('rel'),
                'secure' => (bool) $request->get('secure'),
            );

            $navigation->menus()->syncWithoutDetaching([$id => $data]);

        }

        try {

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => "Item Detail Successful"]);
        //return $this->item($navigation, new PageTransformer());
    }

    private function saveNavigationItems($id, $items)
    {
        try{
            $navigation = Navigation::find($id);

            //build data
            $data = array();


            /* $ids = array();
             array_walk_recursive($items, function($value, $key) use (&$ids) {
                 if($key == 'id'){
                     $ids[] = $value;
                 }
             });*/


            foreach($items as $key => $menu){
                $data[$menu['id']] = array(
                    'parent_id' => null,
                    'name' => 'to be updated',
                    'url' => $menu['url'],
                );

                if(count($menu['items']) > 0){
                    foreach($menu['items'] as $key => $submenu){
                        $data[$submenu['id']] = array(
                            'parent_id' => $menu['id'],
                            'name' => 'to be updated',
                            'url' => $submenu['url'],
                        );
                    }
                }
            }

            $navigation->menus()->sync($data);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $navigation]);
    }
}
