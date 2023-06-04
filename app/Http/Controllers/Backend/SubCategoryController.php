<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

use Exception;

class SubCategoryController extends Controller
{
    //
    public function AllSubCategory()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    }

    public function AddSubCategory()
    {
        //take the categoies and pass theim to the add subcategory page
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }

    public function StoreSubCategory(Request $request)
    {

        try {
            SubCategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            ]);
            $notification = array(
                'message' => 'Subcategory Inserted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('all.subcategory')->with($notification);
    } // End Method 

    public function EditSubCategory($id)
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }


    public function UpdateSubCategory(Request $request)
    {

        try {

            $subcat_id = $request->id;

            SubCategory::findOrFail($subcat_id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            ]);


            $notification = array(
                'message' => 'SubCategory Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('all.subcategory')->with($notification);
        // end else

    } // End Method 


    public function DeleteSubCategory($id)
    {

        try {
            $subcategory = SubCategory::findOrFail($id);

            //find linked products
            $subcategory_id = $subcategory->id;

            $products = count(Product::where('subcategory_id', $subcategory_id)->latest()->get());

            //if there are linked products
            if ($products > 0) {
                $notification = array(
                    'message' => 'There are linked products! Subcategory Cannot Be Deleted.',
                    'alert-type' => 'warning'
                );
            }
            //if there is no linked products 
            else {
                SubCategory::findOrFail($id)->delete();
                $notification = array(
                    'message' => 'Sub Category Deleted Successfully',
                    'alert-type' => 'success'
                );
            }
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    } // End Method 


    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    } // End Method 

}
