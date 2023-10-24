<?php

namespace App\Http\Controllers;

use App\Models\Outing;
use App\Models\HomerImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OutingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      /*
      $response = [ 'success' => false, 'response' => '' ];
      $validator = Validator::make( $request->all(), [
        'location' => 'required|max:255',
        'description' => 'max:255',
        'date' => 'required|date_format:Y-m-d',
        'img' => 'file',
      ]);

      if ( $validator->fails() ){
        $response['response'] = $validator->messages();
        //dd($response);
        return response($response,200);
      }

      return response(['success' => true, 'response' => 'Thank you for your submission' ], 200);
      */
      
      $validated = $request->validate([
        'location' => 'required|max:255',
        'description' => 'max:999',
        'date' => 'required|date_format:Y-m-d',
        'img' => 'file'
      ]);

      $outing_data = array_slice( $validated, 0 );
      unset( $outing_data['img'] );

      $outing = new Outing( $outing_data );
      $outing->save();

      $file = $validated['img'];

      $path = $file->store('public');

      $image = [
        'size' => $file->getSize(),
        'name' => $file->getClientOriginalName(),
        'mimeType' => $file->getMimeType(),
        'path' => $path,
      ];

      $outing->image()->create( $image );

      //return redirect( route( 'dashboard' ));
      return response(['success' => true, 'response' => 'Thank you for your submission.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Outing $outing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outing $outing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outing $outing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outing $outing)
    {
        //
    }
}
