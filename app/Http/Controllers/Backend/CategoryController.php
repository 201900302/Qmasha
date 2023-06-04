<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use Exception;

class CategoryController extends Controller
{
    //

    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory()
    {
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request)
    {

        try {

            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalName();
            Image::make($image)->resize(300, 300)->save('uploud/category/' . $name_gen);
            $save_url = 'uploud/category/' . $name_gen;
            Category::insert([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Category Inserted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('all.category')->with($notification);
    } // End Method 


    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    } // End Method 

    public function UpdateCategory(Request $request)
    {

        try {

            $cat_id = $request->id;
            $old_img = $request->old_image;

            if ($request->file('category_image')) {

                $image = $request->file('category_image');
                $name_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalName();
                Image::make($image)->resize(300, 300)->save('uploud/category/' . $name_gen);
                $save_url = 'uploud/category/' . $name_gen;

                if (file_exists($old_img)) {
                    unlink($old_img);
                }

                Category::findOrFail($cat_id)->update([
                    'category_name' => $request->category_name,
                    'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                    'category_image' => $save_url,
                ]);

                $notification = array(
                    'message' => 'Category Updated with image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.category')->with($notification);
            } else {

                Category::findOrFail($cat_id)->update([
                    'category_name' => $request->category_name,
                    'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                ]);

                $notification = array(
                    'message' => 'Category Updated without image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.category')->with($notification);
            } // end else
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('all.category')->with($notification);
        }
    } // End Method 


    public function DeleteCategory($id)
    {

        try {
            $category = Category::findOrFail($id);


            //get products liked with the category
            $category_id = $category->id;

            $products = count(Product::where('category_id', $category_id)->latest()->get());

            //if there are linked products
            if ($products > 0) {
                $notification = array(
                    'message' => 'There are linked products! Category Cannot Be Deleted.',
                    'alert-type' => 'warning'
                );
            }

            //if there are no products 
            else {
                $img = $category->category_image;
                unlink($img);

                Category::findOrFail($id)->delete();

                //delete the sub categories of the category
                $subcategoies = Subcategory::where('category_id', $category_id)->delete();

                $notification = array(
                    'message' => 'Category Deleted Successfully',
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

}
