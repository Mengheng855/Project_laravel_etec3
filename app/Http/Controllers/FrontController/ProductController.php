<?php

namespace App\Http\Controllers\FrontController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function home(){
        $newProducts=Product::query()->OrderBy('id','DESC')->paginate(4, ['*'], 'new_page');
        $promoProducts=Product::query()
                        ->whereColumn('reqular_price', '<>', 'sale_price')
                        ->OrderBy('id','DESC')
                        ->paginate(4, ['*'], 'promo_page');

        $popProducts=Product::query()->OrderBy('views','DESC')->paginate(4, ['*'], 'pop_page');
        return view('Frontend.home',compact('newProducts','promoProducts','popProducts'));
    }
    public function shop(Request $request){
        $getCate=$request->query('cate');
        if($getCate){
            $shops=Product::query()
                ->join('categories','products.cate_id','=','categories.id')
                ->select('products.*')
                ->where('categories.category_name',$getCate)
                ->orderBy('products.id','DESC')
                ->paginate(6);

        }else{
            $shops=Product::query()
                    ->orderBy('products.id','DESC')
                    ->paginate(6);
                    
        }

        $cate=Category::query()->get();
        return view('Frontend.shop',compact('cate','shops'));

    }

}
