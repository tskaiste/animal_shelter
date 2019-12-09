<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();

        return response()->json(
            [
                'status' => 'success',
                'bills' => $bills->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $bill = Bill::find($id);

        return response()->json(
            [
                'status' => 'success',
                'bill' => $bill->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'sum' => 'required',
            'type' => 'required',
            'sender' => 'required',
            'shelter_id' => 'required'
        ]);
        $bill = Bill::create($request->all());
        return response()->json($bill, 201);
    }

    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);
        $this->validate($request, [
            'date' => 'required|date',
            'sum' => 'required',
            'type' => 'required',
            'sender' => 'required',
            'shelter_id' => 'required'
        ]);
        $bill->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'bill' => $bill->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $bill = Bill::find($id);
        $bill->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
