<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageGallery;
class ImagesGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function multipleImages(){
        return view('images_gallery.imageview');
     }
    public function uploadMultipleImages(Request $request){
        // dd($request->all());
        $request->validate([
            'images.*' =>'mimes:jpeg,jpg,png',
        ],
        [
        'images.*.required' => 'Image type must be jpeg,jpg,png.',
       
      ]
    );
        // dd($request->all());
        $filename = '';
        if(isset($request->images) && count($request->images) > 0){
            $images = $request->images;
            // dd($images);
            foreach($images as $image){
                $filename = $image->getClientOriginalName();
                $img = ImageGallery::where('image',$filename)->first();
                
                if(!$img)
                {
                    $image->move('assets/images/gallery_images',$filename);
                    $gal = new ImageGallery();
                    $gal->image = $filename;
                    $gal->save();
                }
            }

            return redirect()->route('galleryimages.index')->with('success','Images Added successfully.');
            
        }else{
            return back()->withSuccess(__('Please Select at-least one image.'));
        }
        
            
        
    }

    public function removeImage($id){
        $gal = ImageGallery::find($id);

        if($gal){
            if(file_exists(public_path(). '/assets/images/gallery_images/'. $gal->image)){
                unlink(public_path('/assets/images/gallery_images/') . $gal->image);
            }
            $gal->delete();
            return redirect()->route('galleryimages.index')->with('success','Images Deleted successfully.');
        }else{
            return redirect()->route('galleryimages.index')->with('error','Images not Deleted');
        }
    }
    public function index()
    {
        $images = ImageGallery::paginate(8);
        
        return view('images_gallery.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
