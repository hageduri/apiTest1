<?php

namespace App\Http\Controllers;

use App\Models\head_logo;
use Illuminate\Http\Request;

class head_logoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/logos'), $imageName);

        head_logo::create(['image' => $imageName]);

        return redirect()->route('head-logo.index')->with('success', 'Logo uploaded successfully.');
    }

    public function destroy($id)
    {
        $logoHead = head_logo::findOrFail($id);

        if (file_exists(public_path('images/logos/' . $logoHead->image))) {
            unlink(public_path('images/logos/' . $logoHead->image));
        }

        $logoHead->delete();

        return redirect()->route('head-logo.index')->with('success', 'Logo deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoHead = head_logo::findOrFail($id);

        if (file_exists(public_path('images/logos/' . $logoHead->image))) {
            unlink(public_path('images/logos/' . $logoHead->image));
        }

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/logos'), $imageName);

        $logoHead->update(['image' => $imageName]);

        return redirect()->route('head-logo.index')->with('success', 'Logo updated successfully.');
    }
}
