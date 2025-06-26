<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.package', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Package::create($request->all());

        return redirect()->back()->with('success', 'Package berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
    ]);

    $package = Package::findOrFail($id);
    $package->update($request->all());

    return redirect()->back()->with('success', 'Paket berhasil diperbarui.');
}


    public function destroy($id)
    {
        Package::destroy($id);
        return redirect()->back()->with('success', 'Package berhasil dihapus.');
    }
}

