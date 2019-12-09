<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();

        return response()->json(
            [
                'status' => 'success',
                'donations' => $donations->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $donation = Donation::find($id);

        return response()->json(
            [
                'status' => 'success',
                'donation' => $donation->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'sum' => 'required',
            'purpose' => 'required',
            'sender' => 'required',
            'shelter_id' => 'required'
        ]);
        $donation = Donation::create($request->all());
        return response()->json($donation, 201);
    }

    public function update(Request $request, $id)
    {
        $donation = Donation::find($id);
        $this->validate($request, [
            'date' => 'required|date',
            'sum' => 'required',
            'purpose' => 'required',
            'sender' => 'required',
            'shelter_id' => 'required'
        ]);
        $donation->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'donation' => $donation->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $donation = Donation::find($id);
        $donation->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
