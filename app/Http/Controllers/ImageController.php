<?php

namespace App\Http\Controllers;

use File;
use Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show($arg1, $arg2 = null)
    {
        // Build file path
        $path = $arg1 ? $arg1 : '';
        $path .= $arg2 ? '/' . $arg2 : '';
        $path = storage_path(sprintf('image/%s', $path));

        // Make sure file exists
        if (! File::exists($image = $path)) {
            return abort(404, 'No such file found');
        }

        $image = Image::make($image);
        $width = request('width') ? request('width') : $image->getWidth();
        $height = request('height') ? request('height') : $image->getHeight();
        $scaleDownTo = $width > $height ? $height : $width;

        // Rotate image by given value
        if (request('rotate')) {
            $image->rotate(request('rotate'));
        }

        // If width is larger than height and width it larger than scale value
        // resize the image based on width and maintain aspect ratio
        if ($width > $height) {
            $image->resize($scaleDownTo, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize(null, $scaleDownTo, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $image->response();
    }
}
