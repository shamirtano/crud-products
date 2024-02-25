<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = $request->slug;

        if ($slug == null || $slug == '') {
            $slug = $request->name;
            $slug = str_replace(' ', '-', $slug);
            $slug = strtolower($slug);
        } else {
            $slug = str_replace(' ', '-', $slug);
            $slug = strtolower($slug);
        }

        $request->slug = $slug;
        // hasta aqui

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
        ]);

        $category = new Category(); // esto es lo que cambia en el update

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->image = $request->image;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255']
        ]);

        // busca la categoria
        $category = Category::find($id);

        // la almacena en un objeto
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->status = $request->status;

        // actualiza la categoria
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productos = Category::find($id)->products;

        if (count($productos) > 0) {
            return redirect()->route('categories.index')->with('error', 'No se puede eliminar la categoría porque tiene productos');
        } else {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente');
        }
    }
}
