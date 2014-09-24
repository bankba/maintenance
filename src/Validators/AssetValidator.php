<?php namespace Stevebauman\Maintenance\Validators;

use Stevebauman\Maintenance\Validators\AbstractValidator;

class AssetValidator extends AbstractValidator {
	
	protected $rules = array(
		'name' => 'required|min:3',
		'condition' => 'required|integer',
		'category' => 'required',
		'category_id' => 'integer',
	);
	
}