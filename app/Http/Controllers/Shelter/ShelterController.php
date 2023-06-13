<?php

namespace App\Http\Controllers\Shelter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shelter\ShelterRequest;
use App\Http\Requests\Shelter\ShelterUpdateRequest;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function getShelters()
    {
        return Shelter::all();
    }

    public function addShelter(ShelterRequest $request)
    {
        Shelter::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);

        return response()->json([
            'Request' => 'Shelter successfully created'
        ]);
    }

    public function updateShelter(ShelterUpdateRequest $request)
    {
        $id = $request['shelter_id'];
        $shelter = Shelter::all()->find($id);

        if (isset($shelter)) {
            $shelter->name = $request->input('name', $shelter->name);
            $shelter->address = $request->input('address', $shelter->address);
            $shelter->save();

            return response()->json([
                'Request' => 'Shelter successfully updated',
            ]);
        } else {
            return response()->json([
                'Error' => 'ID shelter not found',
            ]);
        }
    }

    public function deleteShelter(Request $request)
    {
        $id = $request['shelter_id'];
        if (Shelter::where('id', $id)->exists()) {
            Shelter::find($id)->delete();
            return response()->json([
                'Request' => 'Shelter successfully deleted',
            ]);
        } else {
            return response()->json([
                'Error' => 'There is no such shelter.',
            ]);
        }
    }
}
