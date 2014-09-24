<?php namespace Stevebauman\Maintenance\Http\Requests;

use Stevebauman\Maintenance\Http\Requests\AbstractUploadRequest;

/**
 * Processes the upload from PLUpload and store's it inside a temporary location.
 * A json view response is defineable here you can customize the layout of the dynamic uploads. 
 *
 */
class AssetImageUploadRequest extends AbstractUploadRequest {
	
	public function __construct(){
            parent::__construct();
			
            $this->responseView = 'maintenance::partials.upload';
	}
	
}