<?php 
class OrderFormService {
    private $id;
    private $startDate;
    private $endDate;
    private $startHour;
    private $endHour;
    private $orderFormId;
    private $serviceId;
    private $royaltyId;

    public function __construct($startDate, $endDate, $startHour, 
                                $endHour, $orderFormId, $serviceId, 
                                $royaltyId) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startHour = $startHour;
        $this->endHour = $endHour;
        $this->orderFormId = $orderFormId;
        $this->serviceId = $serviceId;
        $this->royaltyId = $royaltyId;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getStartHour() {
        return $this->startHour;
    }

    public function getEndHour() {
        return $this->endHour;
    }

    public function getOrderFormId() {
        return $this->orderFormId;
    }

    public function getServiceId() {
        return $this->serviceId;
    }
    
    public function getRoyaltyId() {
        return $this->royaltyId;
    }

    public function setRoyaltyId($royaltyId) {
        $this->royaltyId = $royaltyId;
    }
}
?>