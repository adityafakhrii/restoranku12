<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;

class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all items from the database
        $items = Item::orderBy('name', 'asc')->get();

        // Return the view with the items
        return view('admin.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('cat_name', 'asc')->get();

        // Return the view to create a new item
        return view('admin.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ],
        [
            'name.required' => 'The item name is required.',
            'description.string' => 'The description must be a string.',
            'price.required' => 'The price is required.',
            'category_id.required' => 'The category is required.',
            'img.image' => 'The image must be an image file.',
            'img.max' => 'The image size must not exceed 2MB.',
            'is_active.required' => 'The active status is required.',
            'is_active.boolean' => 'The active status must be true or false.',
        ]);


        // Handle image upload if provided
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time().'.'. $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

        $item = Item::create($validatedData);

        // Redirect to the items index with a success message
        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('cat_name', 'asc')->get();

        // Return the view to create a new item
        return view('admin.item.edit', compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ],
        [
            'name.required' => 'The item name is required.',
            'description.string' => 'The description must be a string.',
            'price.required' => 'The price is required.',
            'category_id.required' => 'The category is required.',
            'img.image' => 'The image must be an image file.',
            'img.max' => 'The image size must not exceed 2MB.',
            'is_active.required' => 'The active status is required.',
            'is_active.boolean' => 'The active status must be true or false.',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time().'.'. $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload'), $imageName);
            $validatedData['img'] = $imageName;
        }

        // Find the item and update it
        $item = Item::findOrFail($id);
        $item->update($validatedData);

        // Redirect to the items index with a success message
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item and delete it
        $item = Item::findOrFail($id);
        $item->delete();

        // Redirect to the items index with a success message
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
