<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\multiImg;
use App\Models\Product;

class IndexController extends Controller
{
    //
    public function ProductDetails($id, $slug)
    {

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $tag = $product->tags;
        $product_tag = explode(',', $tag);

        $multiImage = multiImg::where('product_id', $id)->get();


        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('status', 1)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(6)->get();

        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size', 'product_tag', 'multiImage', 'relatedProduct'));
    }


    public function BoutiqueDetails($id)
    {

        $boutique = User::findOrFail($id);

        $products = Product::query();

        //cetegory filter
        if (!empty($_GET['category'])) {

            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();

            $boutique_products = Product::whereIn('category_id', $catIds)->where('status', 1)->where('vendor_id', $id)->get();
        } else {
            $boutique_products = Product::where('vendor_id', $id)->where('status', 1)->get();
        }

        //price filter

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $boutique_products = $boutique_products->whereBetween('selling_price', $price);
        }
        $categories = Category::orderBy('category_name', 'ASC')->get();


        return view('frontend.boutique.boutique_details', compact('boutique', 'boutique_products', 'categories'));
    }

    public function BoutiqueAll()
    {
        $boutiques = User::where('role', 'vendor')->where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('frontend.boutique.boutique_all', compact('boutiques'));
    }


    // public function CategoryProducts(Request $request, $id, $slug){

    //     $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();

    //     $categories = Category::orderBy('category_name', 'ASC')->get();
    //     $subcategories = SubCategory::where('category_id', $id)->latest()->get();
    //     $categoryName = Category::where('id', $id)->first(); //get the category name 
    //     return view('frontend.product.category_products', compact('products', 'categories', 'categoryName', 'subcategories'));
    // }


    public function CategoryProducts(Request $request, $id, $slug)
    {

        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategories = SubCategory::where('category_id', $id)->latest()->get();
        $categoryName = Category::where('id', $id)->first(); //get the category name 
        return view('frontend.product.category_products', compact('products', 'categories', 'categoryName', 'subcategories'));
    }



    public function SubCategoryProducts(Request $request, $id, $slug)
    {

        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $subcategories = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subCategorySelected = Subcategory::where('id', $id)->first(); //get the subcategory 
        return view('frontend.product.subcategory_products', compact('products', 'categories', 'subcategories', 'subCategorySelected'));
    }


    public function SearchProduct(Request $request)
    {
        $request->validate(['search' => 'required']);
        $searched_item = $request->search;

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $results_products = Product::where('product_name', 'LIKE', "%$searched_item%")->get();
        return view('frontend.product.search_product', compact('results_products', 'searched_item', 'categories'));
    }

    public function ProductAll()
    {
        $products = Product::query();

        //cetegory filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();

            $products = Product::whereIn('category_id', $catIds)->where('status', 1)->get();
        } else {
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        }

        //price filter

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('selling_price', $price);
        }
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('frontend.product.product_all', compact('products', 'categories'));
    }

    public function SaleProductAll()
    {

        $products = Product::query();

        //cetegory filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();

            $products = Product::whereIn('category_id', $catIds)->where('status', 1)->where('on_sale', 1)->get();
        } else {
            $products = Product::where('on_sale', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        }

        //price filter

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('discount_price', $price);
        }
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('frontend.product.product_onSale', compact('products', 'categories'));
    }


    public function ShopPageFilter(Request $request)
    {
        $data = $request->all();
        //category filter
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }


        //price filter
        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
            $priceRangeUrl .= '&price=' . $data['price_range'];
        }

        return redirect()->route('product.all', $catUrl . $priceRangeUrl);
    }



    public function SalePageFilter(Request $request)
    {
        $data = $request->all();
        //category filter
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }


        //price filter
        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
            $priceRangeUrl .= '&price=' . $data['price_range'];
        }

        return redirect()->route('product.sale.all', $catUrl . $priceRangeUrl);
    }


    public function CollectionAll()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('frontend.product.all_collections', compact('categories'));
    }
    public function BoutiquePageFilter(Request $request)
    {
        $data = $request->all();
        $id = $request->vendor_id;
        //category filter
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '?category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }


        //price filter
        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
            $priceRangeUrl .= '?price=' . $data['price_range'];
        }

        return redirect()->route('boutique.details', $id . '/' . $catUrl . $priceRangeUrl);
    }
}
