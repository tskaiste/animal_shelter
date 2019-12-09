<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return response()->json(
            [
                'status' => 'success',
                'clients' => $clients->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $client = Client::find($id);

        return response()->json(
            [
                'status' => 'success',
                'client' => $client->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'activity_level' => 'required',
            'home_type' => 'required',
            'has_yard' => 'required',
            'shelter_id' => 'required'
        ]);
        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'activity_level' => 'required',
            'home_type' => 'required',
            'has_yard' => 'required',
            'shelter_id' => 'required'
        ]);
        $client->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'client' => $client->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
