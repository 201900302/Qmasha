<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\multiImg;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Wishlist;


use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use Exception;

class VendorProductController extends Controller
{
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }
    public function VendorAddProduct()
    {
        $categories = Category::latest()->get();
        return view('vendor.backend.product.vendor_product_add', compact('categories'));
    }


    public function VendorStoreProduct(Request $request)
    {

        try {
            $vendor_id = Auth::user()->id;
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalName();
            Image::make($image)->resize(800, 800)->save('uploud/products/thumbnail/' . $name_gen);
            $save_url = 'uploud/products/thumbnail/' . $name_gen;

            $product_id = Product::insertGetId([
                'vendor_id' => $vendor_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_thumbnail' => $save_url,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'tags' => $request->tags,
                'product_color' => $request->product_color,
                'product_size' => $request->product_size,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'status' => 1,
                'on_sale' => $request->on_sale,
                'length_needed' => $request->length_needed,
                'created_at' => Carbon::now(),
            ]);


            //multiple images apload in the other table 
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '-' . $img->getClientOriginalName();
                Image::make($img)->resize(800, 800)->save('uploud/products/multi-images/' . $make_name);
                $uploadPath = 'uploud/products/multi-images/' . $make_name;


                //insert in the database
                multiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }

            //display notification when both insertion successfully done
            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }


        return redirect()->route('vendor.all.products')->with($notification);
    }


    public function VendorEditProduct($id)
    {

        $multiImgs = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit', compact('categories', 'products', 'subcategories', 'multiImgs'));
    }


    public function VendorUpdateProduct(Request $request)
    {

        try {

            $product_id = $request->id;

            Product::findOrFail($product_id)->update([

                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                // 'product_thumbnail' => $save_url,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'tags' => $request->tags,
                'product_color' => $request->product_color,
                'product_size' => $request->product_size,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                // 'status' => 1,
                'on_sale' => $request->on_sale,
                'length_needed' => $request->length_needed,
                'updated_at' => Carbon::now(),
            ]);


            $notification = array(
                'message' => 'Product Updated Without Image Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->route('vendor.all.products')->with($notification);
    }
    public function VendorUpdateProductThumbnail(Request $request)
    {

        try {

            $pro_id = $request->id;
            $old_image = $request->old_image;

            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalName();
            Image::make($image)->resize(800, 800)->save('uploud/products/thumbnail/' . $name_gen);
            $save_url = 'uploud/products/thumbnail/' . $name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Product::findOrFail($pro_id)->update([
                'product_thumbnail' => $save_url,
                'updated_at' => Carbon::now(),
            ]);


            $notification = array(
                'message' => 'Product Main Image Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }


    public function VendorUpdateProductMultiimage(Request $request)
    {

        try {
            $imgs = $request->multi_img;
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);
                unlink($imgDel->photo_name);

                $make_name = hexdec(uniqid()) . '-' . $img->getClientOriginalName();
                Image::make($img)->resize(800, 800)->save('uploud/products/multi-images/' . $make_name);
                $uploadPath = 'uploud/products/multi-images/' . $make_name;

                MultiImg::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);

                $notification = array(
                    'message' => 'Product Multiple Image Updated Successfully',
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
    }

    public function VendorDeleteProductMultiimage($id)
    {

        try {
            $oldImg = MultiImg::findOrFail($id);
            unlink($oldImg->photo_name);
            MultiImg::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Product Multiple Image Deleted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function VendorProductInactive($id)
    {

        try {
            Product::findOrFail($id)->update([
                'status' => 0,
                'admin_favourite' => 0,
            ]);
            $notification = array(
                'message' => 'Product Inactived Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function VendorProductActive($id)
    {

        try {
            Product::findOrFail($id)->update([
                'status' => 1,
            ]);
            $notification = array(
                'message' => 'Product Activated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }


    public function VendorDeleteProduct($id)
    {

        try {

            $product = Product::findOrFail($id);

            //get order items liked with the product
            $product_id = $product->id;

            $orderItems = count(OrderDetail::where('product_id', $product_id)->latest()->get());

            //if there are linked products
            if ($orderItems > 0) {
                $notification = array(
                    'message' => 'There are linked orders to this product! Product Cannot Be deleted, you can inactive it instead.',
                    'alert-type' => 'warning'
                );
            }

            //if there are no orders for the product 
            else {
                unlink($product->product_thumbnail);
                Product::findOrFail($id)->delete();

                $images = MultiImg::where('product_id', $id)->get();
                foreach ($images as $image) {
                    unlink($image->photo_name);
                    MultiImg::where('product_id', $id)->delete();
                }

                //delete wishlists
                Wishlist::where('product_id', $id)->delete();



                $notification = array(
                    'message' => 'Product Deleted Successfully',
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
    }


    public function AdminAllProduct()
    {
        $vendors = User::where('role', 'vendor')->get();
        $products = Product::orderBy('created_at')->get();
        return view('admin.backend.product.admin_product_all', compact('products', 'vendors'));
    }

    public function AdminProductFavourite($id)
    {
        try {
            Product::findOrFail($id)->update([
                'admin_favourite' => 1,
            ]);
            $notification = array(
                'message' => 'Product Favourited Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function AdminProductUnFavourite($id)
    {
        try {
            Product::findOrFail($id)->update([
                'admin_favourite' => 0,
            ]);
            $notification = array(
                'message' => 'Product Un-Favourited Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function AdminAllFavouriteProduct()
    {
        $products = Product::where('admin_favourite', 1)->get();
        return view('admin.backend.product.admin_product_favourite', compact('products'));
    }

    public function AdminViewProduct($id)
    {

        $multiImgs = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('admin.backend.product.admin_product_details', compact('categories', 'products', 'subcategories', 'multiImgs'));
    }


    public function AdminDeleteProduct($id)
    {

        try {
            $product = Product::findOrFail($id);

            //get order items liked with the product
            $product_id = $product->id;

            $orderItems = count(OrderDetail::where('product_id', $product_id)->latest()->get());

            //if there are linked products
            if ($orderItems > 0) {
                $notification = array(
                    'message' => 'There are linked orders to this product! Product Cannot Be deleted.',
                    'alert-type' => 'warning'
                );
            }

            //if there are no orders for the product 
            else {
                unlink($product->product_thumbnail);
                Product::findOrFail($id)->delete();

                $images = MultiImg::where('product_id', $id)->get();
                foreach ($images as $image) {
                    unlink($image->photo_name);
                    MultiImg::where('product_id', $id)->delete();
                }

                $notification = array(
                    'message' => 'Product Deleted Successfully',
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
    }


    public function AdminSelectedVendorProducts($id)
    {
        $vendor = User::findOrFail($id);
        $products = Product::orderBy('created_at')->get()->where('vendor_id', $id);
        return view('admin.backend.product.admin_product_selected_vendor', compact('products', 'vendor'));
    }



    public function VendorAllProductStock()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_stock', compact('products'));
    }
}
