<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;

class ShelterController extends Controller
{
    public function index()
    {
        $shelters = Shelter::all();

        return response()->json(
            [
                'status' => 'success',
                'shelters' => $shelters->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $shelter = Shelter::find($id);

        return response()->json(
            [
                'status' => 'success',
                'shelter' => $shelter->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'bank_account_number' => 'required'
        ]);
        $shelter = Shelter::create($request->all());
        return response()->json($shelter, 201);
    }

    public function update(Request $request, $id)
    {
        $shelter = Shelter::find($id);
        $this->validate($request, [
            'address' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'bank_account_number' => 'required'
        ]);
        $shelter->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'shelter' => $shelter->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $shelter = Shelter::find($id);
        $shelter->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
