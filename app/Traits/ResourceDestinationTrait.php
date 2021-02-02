<?php

namespace App\Traits;

use App\Http\Requests\ResourceDestination;
use Illuminate\Support\Str;

trait ResourceDestinationTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeResources(ResourceDestination $request, $destination_id)
    {
        $data = $request->all();
        $request->validated();
        $data['destination_id'] = $destination_id;
        $images = [];
        if ($request->hasFile('destination_image')) {
            $image = $request->file('destination_image');
            foreach ($image as $file) {
                $name = Str::slug($request->input('destination_name') . '_' . time());
                $folder = '/destination' . "/" . $destination_id;
                $imgName = $name . '.' . $file->getClientOriginalExtension();
                $images[] = $imgName;
            }
            $data['destination_image'] = $images;
            $this->uploadMultiple($image, $folder, 'public', $images);
        }
        $test = [];
        foreach ($data as $input) {
            $test[] = $this->resources_destination->createOrUpdate(null, $input);
        }

        return $test;
    }
}
