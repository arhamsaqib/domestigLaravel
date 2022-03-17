<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function addimage(Request $request)
    {
        $id = $this->generateRandomNumber();
        $ext = $request->file('image')->extension();
        $path = "storage/upload/images/img-$id." . $ext;
        $request->file('image')->storeAs("public/upload/images/", "img-$id." . $ext);

        $x = Image::create([
            "name" => $id,
            "title" => $id,
            "uri" => $path,
        ]);

        return $x;
        //return url($path);
    }
    function generateRandomNumber() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->nameExists($number)) {
            return $this->generateRandomNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    function nameExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Image::whereName($number)->exists();
    }
}
