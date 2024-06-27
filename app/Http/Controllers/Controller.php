<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

abstract class Controller
{
    public function sort_items(Request $request, $model)
    {
        if(!empty($request->item_id)) {
            $i = 1;
            foreach($request->item_id as $item_id) {
                $item = $model::find($item_id);
                $item->ordering = $i;
                $item->save();

                $i++;
            }
        }

        return response()->json(['success' => true]);
    }
}
