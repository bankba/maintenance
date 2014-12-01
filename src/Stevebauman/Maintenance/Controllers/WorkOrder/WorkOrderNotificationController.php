<?php

namespace Stevebauman\Maintenance\Controllers;

use Stevebauman\Maintenance\Validators\WorkOrderNotificationValidator;
use Stevebauman\Maintenance\Services\WorkOrderService;
use Stevebauman\Maintenance\Services\WorkOrderNotificationService;
use Stevebauman\Maintenance\Controllers\BaseController;

class WorkOrderNotificationController extends BaseController {
    
    public function __construct(
            WorkOrderService $workOrder, 
            WorkOrderNotificationService $workOrderNotification,
            WorkOrderNotificationValidator $workOrderNotificationValidator
            )
    {
        $this->workOrderNotification = $workOrderNotification;
        $this->workOrderNotificationValidator = $workOrderNotificationValidator;
        $this->workOrder = $workOrder;
    }
    
    public function store($workOrder_id)
    {
        
        if($this->workOrderNotificationValidator->passes()){
            
            $workOrder = $this->workOrder->find($workOrder_id);
            
            $data = $this->inputAll();
            $data['work_order_id'] = $workOrder->id;
            
            $this->workOrderNotification->setInput($data)->create();
            
            $this->message = 'Successfully updated notifications';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', array($workOrder->id));
        } else{
            $this->errors = $this->workOrderNotificationValidator->getErrors();
            $this->redirect = route('maintenance.work-orders.show', array($workOrder_id));
        }
        
        return $this->response();
        
    }
    
    public function update($workOrder_id, $notification_id)
    {
        if($this->workOrderNotificationValidator->passes()){
            
            $workOrder = $this->workOrder->find($workOrder_id);
            
            $notifications = $this->workOrderNotification->find($notification_id);
            
            $data = $this->inputAll();
            $data['work_order_id'] = $workOrder->id;
            
            $this->workOrderNotification->setInput($data)->update($notifications->id);
            
            $this->message = 'Successfully updated notifications';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', array($workOrder->id));
            
        } else{
            $this->errors = $this->workOrderNotificationValidator->getErrors();
            $this->redirect = route('maintenance.work-orders.show', array($workOrder_id));
        }
        
        return $this->response();
    }
    
}