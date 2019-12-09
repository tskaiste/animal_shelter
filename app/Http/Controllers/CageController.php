<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cage;

class CageController extends Controller
{
    public function index()
    {
        $cages = Cage::all();

        return response()->json(
            [
                'status' => 'success',
                'cages' => $cages->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $cage = Cage::find($id);

        return response()->json(
            [
                'status' => 'success',
                'cage' => $cage->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'area' => 'required',
            'spaces_number' => 'required',
            'shelter_id' => 'required'
        ]);
        $cage = Cage::create($request->all());
        return response()->json($cage, 201);
    }

    public function update(Request $request, $id)
    {
        $cage = Cage::find($id);
        $this->validate($request, [
            'area' => 'required',
            'spaces_number' => 'required',
            'shelter_id' => 'required'
        ]);
        $cage->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'cage' => $cage->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $cage = Cage::find($id);
        $cage->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
