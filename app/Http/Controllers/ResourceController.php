<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();

        return response()->json(
            [
                'status' => 'success',
                'resources' => $resources->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $resource = Resource::find($id);

        return response()->json(
            [
                'status' => 'success',
                'resource' => $resource->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'shelter_id' => 'required'
        ]);
        $resource = Resource::create($request->all());
        return response()->json($resource, 201);
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::find($id);
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'shelter_id' => 'required'
        ]);
        $resource->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'resource' => $resource->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $resource = Resource::find($id);
        $resource->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
