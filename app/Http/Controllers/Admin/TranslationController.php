<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $translations = Translation::all();
        return view('translations.index', compact('translations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'language' => 'required',
            'value' => 'required',
        ]);

        Translation::create($request->all());

        return redirect()->back()->with('success', 'Çeviri başarıyla eklendi.');
    }

    public function update(Request $request, $id)
    {
        $translation = Translation::findOrFail($id);
        $translation->update($request->all());

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }
}
