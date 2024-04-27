<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list page
    public function listPage()
    {
        $pro = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->orWhere('products.name', 'like', '%' . request('key') . '%')
                    ->orWhere('products.description', 'like', '%' . request('key') . '%')
                    ->orWhere('products.id', 'like', '%' . request('key') . '%')
                    ->orWhere('categories.name', 'like', '%' . request('key') . '%')
                    ->orWhere('products.waiting_day', 'like', '%' . request('key') . '%')
                    ->orWhere('products.view_count', 'like', '%' . request('key') . '%');
            })->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.id', 'asc')
            ->paginate(5);
        return view('admin.product.listPage', compact('pro'));
    }

    //create page
    public function createPage()
    {
        $cat = Category::get();
        return view('admin.product.createPage', compact('cat'));
    }

    //create
    public function create(Request $request)
    {
        $this->createValidation($request, 'create');
        $data = $this->getData($request);

        $file = $request->file('image');

        $fileName = 'product' . uniqid() . $file->getClientOriginalName();

        $file->move(public_path() . '/ProjectImg', $fileName);

        $data = [...$data, 'image' => $fileName];

        Product::create($data);
        return redirect()->route('product#listPage')->with(['createSuccess' => 'created successfully']);

    }

    //delete
    public function delete($id)
    {
        $dbFile = Product::where('id', $id)->first();
        $dbName = $dbFile['image'];

        if (File::exists(public_path() . '/ProjectImg/' . $dbName)) {
            File::delete(public_path() . '/ProjectImg/' . $dbName);
        }

        Product::where('id', $id)->delete();

        return back()->with(['deleteSuccess' => 'delete successfully']);

    }

    //edit page
    public function editPage($id)
    {
        $cat = Category::get();
        $p = Product::where('id', $id)->first();
        return view('admin.product.editPage', compact('p', 'cat'));
    }

    //update
    public function update(Request $request)
    {
        $this->createValidation($request, 'update');
        $data = $this->getData($request);
        if ($request->file('image')) {
            $dbFile = Product::where('id', $request->id)->first();
            $dbImage = $dbFile->image;
            if (File::exists(public_path() . '/ProjectImg/' . $dbImage)) {
                File::delete(public_path() . '/ProjectImg/' . $dbImage);
            }

            $file = $request->file('image');
            $fileName = 'product' . uniqId() . $file->getClientOriginalName();
            $file = move(public_path() . '/ProjectImg', $filename);

            $data = [...$data, 'image' => $fileName];

            Product::where('id', $request->id)->update($data);
        }
        Product::where('id', $request->id)->update($data);
        return redirect()->route('product#listPage')->with(['updateSuccess' => 'updated Successfully']);

    }

    //createCheck
    private function createValidation(Request $request, $actions)
    {
        $validationRule = [
            'name' => 'required|min:5|unique:products,name,' . $request->id,
            'category_id' => 'required',
            'description' => 'required|min:10',
            'price' => 'required',
            'waiting_day' => 'required',
            'stock' => 'required',
            // 'image' => 'required|mimes:png,webp,jpg,jpeg',
        ];

        $validationRule['image'] = $actions == 'create' ? 'required|mimes:png,webp,jpg,jpeg' : 'mimes:png,webp,jpg,jpeg';
        Validator::make($request->all(), $validationRule)->validate();

    }

    //get create data
    private function getData(Request $request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,

            'unit_price' => $request->price,
            'waiting_day' => $request->waiting_day,
            'stock' => $request->stock,

        ];
    }
}