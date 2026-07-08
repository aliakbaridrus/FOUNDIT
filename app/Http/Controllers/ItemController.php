<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function home(): View
    {
        $items = Item::with('user')->latest()->take(4)->get();

        return view('home', compact('items'));
    }

    public function explore(Request $request): View
    {
        $items = Item::with('user')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->string('category'));
            })
            ->latest()
            ->get();

        return view('items.explore', compact('items'));
    }

    public function show(Item $item): View
    {
        $item->load('user');

        $whatsapp = preg_replace('/[^0-9]/', '', (string) $item->user->whatsapp);

        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '62'.substr($whatsapp, 1);
        }

        $waLink = null;

        if ($whatsapp !== '') {
            $message = urlencode("Hi, I found your item on FoundIt: {$item->title}");
            $waLink = "https://wa.me/{$whatsapp}?text={$message}";
        }

        return view('items.show', compact('item', 'waLink'));
    }

    public function create(): View
    {
        return view('items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:Lost,Found'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $data['image'] = $request->file('image')->store('items', 'public');
        $data['user_id'] = $request->user()->id;

        Item::create($data);

        return redirect()->route('dashboard');
    }

    public function dashboard(Request $request): View
    {
        $items = $request->user()->items()->latest()->get();

        return view('items.dashboard', [
            'items' => $items,
            'total' => $items->count(),
            'lost' => $items->where('status', 'Lost')->count(),
            'found' => $items->whereIn('status', ['Found', 'Returned'])->count(),
        ]);
    }

    public function destroy(Item $item): RedirectResponse
    {
        $this->authorize('delete', $item);

        Storage::disk('public')->delete($item->image);
        $item->delete();

        return back();
    }
}
