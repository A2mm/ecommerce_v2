<?php

function generateRandomNumber($length = 16) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function generateProductSerial($category_id, $subcategory_id, $product_id)
{
  do{
// $unique_id = generateRandomNumber(5);
    $unique_id = str_pad($category_id, 1, '0', STR_PAD_LEFT) . str_pad($subcategory_id, 6, '0', STR_PAD_LEFT) . str_pad($product_id, 6, '0', STR_PAD_LEFT);
//    $unique_id = $category_id.$subcategory_id.$product_id;
$product = App\Product::where('unique_id', $unique_id)->first();
  } while ($product);
  return $unique_id;
}
function getRequest()
{

    $link = '';
    $link .= '?g='.request()->g;  //GENDER
	$link .= (isset(request()->subcategory)) ? '&subcategory='.request()->subcategory : '&subcategory=ALL';
    $link .= (isset(request()->accessory)) ? '&accessory='.request()->accessory : '&accessory=ALL';
    $link .= (isset(request()->gem_shape)) ? '&gem_shape='.request()->gem_shape : '&gem_shape=ALL';
	$link .= (isset(request()->local)) ? '&local='.request()->local : '&local=ALL';
    $link .=  isset(request()->c) ? '&c='.request()->c : ''; //Currency


	return $link;

}

function getRequestBetweenPages()
{

    $link = [];

    $link['g'] = request()->g;




     if(isset(request()->subcategory)){
    	$link['subcategory'] = request()->subcategory;
    }

     if(isset(request()->accessory)){
    	$link['accessory'] = request()->accessory;
    }

    if(isset(request()->gem_shape)){
        $link['gem_shape'] = request()->gem_shape;
    }


    if(isset(request()->local)){
        $link['local'] = request()->local;
    }


    if(isset(request()->c)){
        $link['c'] = request()->c;
    }


     if(isset(request()->word)){
        $link['word'] = request()->word;
    }

    return $link;

}

