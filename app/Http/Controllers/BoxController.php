<?php

namespace App\Http\Controllers;
use App\Models\Box;

use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::all();
        return view('dashboard', compact('boxes'));
    }

    public function show($id)
    {
        $box = Box::findOrFail($id);
        return view('box.show', compact('box'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        Box::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $box = Box::findOrFail($id);
        $box->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('box.show', $id);
    }

    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return redirect()->route('dashboard');
    }
}
