<?php

namespace Copya\Transformers;

use League\Fractal\TransformerAbstract;
use Copya\Eloquent\Form;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Form $form)
    {
        return [
            'id' => (int) $form->id,
            'name' => $form->name,
            'display_name' => $form->display_name,
        ];
    }
}