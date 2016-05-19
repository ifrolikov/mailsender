<?php
namespace MailSender\Classes;

abstract class AbstractMailSender implements \MailSender\Interfaces\MailSender {
    private $units = [];
    public function addUnit($unit) {
        if (!($unit instanceof \MailSender\Interfaces\MailSenderUnit))
            throw new \Exception("Не верный тип адресата MailSender");
        
        $this->units[] = $unit;
    }
    
    public function cleanUnits() {
        $this->units = [];
    }
    
    public function getUnits() {
        return $this->units;
    }
}