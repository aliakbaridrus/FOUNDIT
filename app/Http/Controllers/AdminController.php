<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $items = Item::with('user')->latest()->get();

        return view('admin.dashboard', [
            'items' => $items,
            'total' => $items->count(),
            'lost' => $items->where('status', 'Lost')->count(),
            'found' => $items->where('status', 'Found')->count(),
            'returned' => $items->where('status', 'Returned')->count(),
        ]);
    }

    public function destroy(Item $item): RedirectResponse
    {
        Storage::disk('public')->delete($item->image);
        $item->delete();

        return redirect()->route('admin.dashboard');
    }
}
