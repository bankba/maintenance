<?php namespace Stevebauman\Maintenance\Controllers;

use Stevebauman\Maintenance\Services\InventoryCategoryService;
use Stevebauman\Maintenance\Validators\CategoryValidator;
use Stevebauman\Maintenance\Controllers\BaseNestedSetController;

class InventoryCategoryController extends BaseNestedSetController {
	
	public function __construct(
                InventoryCategoryService $inventoryCategory, CategoryValidator $categoryValidator){
		$this->service = $inventoryCategory;
		$this->serviceValidator = $categoryValidator;
		
                $this->resource = 'Inventory Category';
	}
	
}