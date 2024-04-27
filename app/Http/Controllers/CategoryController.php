<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list page
    public function listPage()
    {
        $cat = Category::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%');

        })
            ->orderBy('id', 'asc')
            ->paginate(5);
        return view('admin.category.categoryList', compact('cat'));
    }

    //create page
    public function createPage()
    {
        return view('admin.category.categoryCreate');
    }

    //create
    public function create(Request $request)
    {
        $this->createValidation($request);
        $data = $this->getData($request);
        Category::create($data);
        return redirect()->route('category#listPage')->with(['createSuccess' => 'created Successfully']);

    }

    //delete
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('category#listPage')->with(['deleteSuccess' => 'deleted successfully']);
    }

    //edit page
    public function editPage($id)
    {

        $c = Category::where('id', $id)->get();

        return view('admin.category.categoryEdit', compact('c'));

    }

    //update

    public function update(Request $request)
    {
        $this->createValidation($request);
        $data = $this->getData($request);

        Category::where('id', $request->category_id)->update($data);
        return redirect()->route('category#listPage')->with(['updateSuccess' => 'updated Successfully']);
    }

    //create validation
    private function createValidation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|min:5|unique:categories,name,' . $request->category_id,

        ])->validate();
    }

    //create data to insert to db
    private function getData($request)
    {
        return [
            'name' => $request->name,
        ];
    }

}
