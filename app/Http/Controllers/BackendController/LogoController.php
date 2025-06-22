<?php

namespace App\Http\Controllers\BackendController;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

use Illuminate\Support\Facades\View;

class LogoController extends Controller
{
    // Show upload form
    function addLogo()
    {
        return view('backend.addLogo');
    }

    // Handle file upload

    public function addLogoSubmit(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('logo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = 'images/' . $imageName;
        $image->move(public_path('images'), $imageName);

        // Check if a logo already exists
        $existingLogo = Logo::first();
        if ($existingLogo) {
            // Delete the old image file
            $oldImagePath = public_path($existingLogo->logo);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Update existing logo record
            $existingLogo->update([
                'logo' => $imagePath
            ]);
        } else {
            // Create new logo record if none exists
            Logo::create([
                'logo' => $imagePath
            ]);
        }

        return redirect()->back()->with('success', 'Logo updated successfully!');
    }
    public function viewLogo()
{
    $logo = Logo::latest()->first(); // single model
    return view('backend.viewLogo', compact('logo'));
}
    public function deleteLogo(Request $request)
    {
        $logo = Logo::findOrFail($request->id);

        // Delete the image file from disk
        $imagePath = public_path($logo->logo);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the database record
        $logo->delete();

        return redirect()->back()->with('success', 'Logo deleted successfully!');
    }
}
