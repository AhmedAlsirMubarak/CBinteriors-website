<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::ordered()->get();

        $products = Product::ordered()
            ->with('category')
            ->when($request->category, fn($q) => $q->byCategory($request->category))
            ->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        $validated['slug']        = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['active']      = $request->boolean('active', true);
        $validated['sort_order']  = Product::max('sort_order') + 1;
        $validated['images']      = $this->handleImages($request, []);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product->id);
        $validated['slug']        = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['active']      = $request->boolean('active');

        // If new images are uploaded, delete old ones and replace entirely
        if ($request->hasFile('new_images')) {
            foreach ($product->images ?? [] as $old) {
                Storage::disk('public')->delete($old);
            }
            $validated['images'] = $this->handleImages($request, []);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted.');
    }

    /**
     * Remove a single image from a product.
     * PATCH /admin/products/{product}/remove-image
     */
    public function removeImage(Request $request, Product $product)
    {
        $request->validate(['image_path' => 'required|string']);

        $images = collect($product->images ?? [])
            ->reject(fn($p) => $p === $request->image_path)
            ->values()
            ->toArray();

        Storage::disk('public')->delete($request->image_path);
        $product->update(['images' => $images]);

        return back()->with('success', 'Image removed.');
    }

    /**
     * PATCH /admin/products/reorder
     */
    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);

        foreach ($request->ids as $order => $id) {
            Product::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    // ── Private helpers ────────────────────────────────────────

    private function validateProduct(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'active'      => 'nullable|boolean',
            'new_images'  => 'nullable|array',
            'new_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:6144',
        ]);
    }

    private function handleImages(Request $request, array $existing): array
    {
        $images = $existing;

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $images[] = ImageOptimizer::store($file, 'products');
            }
        }

        return $images;
    }
}