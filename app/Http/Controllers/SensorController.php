<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::all();

        return view('sensors.index', [
            'sensors' => $sensors,
        ]);
    }

    public function create()
    {
        return view('towers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sensor' => 'required|string|max:100',
            'threshold' => 'required|integer|max:1000',
            'status' => 'required|in:Active,Inactive',
        ]);

        Sensor::create($validated);

        return redirect()->route('sensor.index')->with('success', 'Sensor berhasil ditambahkan');
    }

    public function edit($id){
        $sensor = Sensor::findOrFail($id);

        return view('sensors.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);

        $validated = $request->validate([
            'nama_sensor' => 'required|string|max:100',
            'threshold' => 'required|integer|max:1000',
            'status' => 'required|in:Active,Inactive',
        ]);

        $sensor->update($validated);

        return redirect()->route('sensor.index')->with('success', 'Sensor berhasil diubah');
    }

    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->delete();

        return redirect()->route('sensor.index')->with('success', 'Sensor berhasil dihapus');
    }
}
