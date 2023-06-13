<?php

namespace app\Http\Controllers\Cat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cat\CatRequest;
use App\Http\Requests\Cat\CatUpdateRequest;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function getCats()
    {
        return Cat::all();
    }

    public function addCat(CatRequest $request)
    {
        Cat::create([
            'name' => $request->input('name'),
            'shelter_id' => $request->input('shelter_id'),
            'health' => $request->input('health'),
            'arrival' => $request->input('arrival'),
            'departure' => $request->input('departure'),
        ]);

        return response()->json([
            'Request' => 'Cat data successfully created'
        ]);
    }

    public function updateCat(CatUpdateRequest $request)
    {
        $id = $request['cat_id'];
        $cat = Cat::find($id);

        if (isset($cat)) {
            $cat->name = $request->input('name', $cat->name);
            $cat->shelter_id = $request->input('shelter_id', $cat->shelter_id);
            $cat->health = $request->input('health', $cat->health);
            $cat->arrival = $request->input('arrival', $cat->arrival);
            $cat->departure = $request->input('departure', $cat->departure);
            $cat->save();

            return response()->json([
                'Request' => 'Cat data successfully updated',
            ]);
        } else {
            return response()->json([
                'Error' => 'ID cat not found',
            ]);
        }
    }

    public function deleteCat(Request $request)
    {
        $id = $request['cat_id'];
        if (Cat::where('id', $id)->exists()) {
            Cat::find($id)->delete();
            return response()->json([
                'Request' => 'Cat data successfully deleted',
            ]);
        } else {
            return response()->json([
                'Error' => 'There is no such cat.',
            ]);
        }
    }
}
