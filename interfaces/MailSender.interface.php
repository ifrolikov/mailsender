<?php
namespace MailSender\Interfaces;

interface MailSender {
    public function send();
    public function addUnit($unit);
    public function getUnits();
    public function cleanUnits();
}