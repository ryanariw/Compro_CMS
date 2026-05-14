<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCount('images')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'category'          => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['nullable', 'boolean'],
            'images.*'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3048'],
            'spec_keys'         => ['nullable', 'array'],
            'spec_vals'         => ['nullable', 'array'],
        ]);

        $validated['slug']      = $this->generateUniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        // Build specs array from key-value pairs
        $specs = [];
        if ($request->filled('spec_keys')) {
            foreach ($request->spec_keys as $i => $key) {
                if ($key !== null && $key !== '') {
                    $specs[] = ['key' => $key, 'val' => $request->spec_vals[$i] ?? ''];
                }
            }
        }
        $validated['specs'] = count($specs) ? $specs : null;
        unset($validated['spec_keys'], $validated['spec_vals']);

        $product = Product::create($validated);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'caption'    => $request->captions[$idx] ?? null,
                    'sort_order' => $idx,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'category'          => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['nullable', 'boolean'],
            'images.*'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3048'],
            'spec_keys'         => ['nullable', 'array'],
            'spec_vals'         => ['nullable', 'array'],
        ]);

        $validated['slug']      = $this->generateUniqueSlug($validated['name'], $product->id);
        $validated['is_active'] = $request->boolean('is_active');

        // Specs
        $specs = [];
        if ($request->filled('spec_keys')) {
            foreach ($request->spec_keys as $i => $key) {
                if ($key !== null && $key !== '') {
                    $specs[] = ['key' => $key, 'val' => $request->spec_vals[$i] ?? ''];
                }
            }
        }
        $validated['specs'] = count($specs) ? $specs : null;
        unset($validated['spec_keys'], $validated['spec_vals']);

        $product->update($validated);

        // New images
        if ($request->hasFile('images')) {
            $lastOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'caption'    => $request->captions[$idx] ?? null,
                    'sort_order' => $lastOrder + 1 + $idx,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product berhasil dihapus.');
    }

    // Delete single image via AJAX / form
    public function destroyImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $productId = $image->product_id;
        $image->delete();

        return redirect()->route('admin.products.edit', $productId)
            ->with('success', 'Foto berhasil dihapus.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 1;
        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $counter++;
        }
        return $slug;
    }
}