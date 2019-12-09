<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();

        return response()->json(
            [
                'status' => 'success',
                'animals' => $animals->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $animal = Animal::find($id);

        return response()->json(
            [
                'status' => 'success',
                'animal' => $animal->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'color' => 'required',
            'breed' => 'required',
            'size' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'is_sterilised' => 'required',
            'cage_id' => 'required',
        ]);
        $animal = Animal::create($request->all());
        return response()->json($animal, 201);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'color' => 'required',
            'breed' => 'required',
            'size' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'is_sterilised' => 'required',
            'cage_id' => 'required',
        ]);
        $animal->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'animal' => $animal->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
