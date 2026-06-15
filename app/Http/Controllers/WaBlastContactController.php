<?php

namespace App\Http\Controllers;

use App\Models\WaBlast\WaBlastContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaBlastContactController extends Controller
{
    public function index()
    {
        $contacts = WaBlastContact::with('addedBy')->latest()->paginate(20);

        return view('wa-blast.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('wa-blast.contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'origin'    => 'nullable|string|max:255',
            'telp'      => 'required|numeric',
            'category'  => 'required|integer|in:1,2,3',
            'is_active' => 'boolean',
            'note'      => 'nullable|string|max:500',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['added_by']  = Auth::id();

        WaBlastContact::create($validated);

        return redirect()->route('wa-blast.contacts.index')
                         ->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function edit(WaBlastContact $waBlastContact)
    {
        return view('wa-blast.contacts.edit', compact('waBlastContact'));
    }

    public function update(Request $request, WaBlastContact $waBlastContact)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'origin'    => 'nullable|string|max:255',
            'telp'      => 'required|numeric',
            'category'  => 'required|integer|in:1,2,3',
            'is_active' => 'boolean',
            'note'      => 'nullable|string|max:500',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $waBlastContact->update($validated);

        return redirect()->route('wa-blast.contacts.index')
                         ->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy(WaBlastContact $waBlastContact)
    {
        $waBlastContact->delete();

        return redirect()->route('wa-blast.contacts.index')
                         ->with('success', 'Kontak berhasil dihapus.');
    }
}
