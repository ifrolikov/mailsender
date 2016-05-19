<?php
namespace MailSender\Classes;

class Unit implements \MailSender\Interfaces\MailSenderUnit {
    private $email = null, $name = null, $listIds = null, $params = [];
    public function __construct($email, $name, $listIds) {
        $this->setEmail($email);
        $this->setName($name);
        $this->setListIds($listIds);
    }
    public function setListIds($ids) {
        $this->listIds = $ids;
        return $this;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function setParams($params = []) {
        $this->params = $params;
        return $this;
    }
    public function getParams() {
        return is_array($this->params)?$this->params:[];
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getListIds() {
        return $this->listIds;
    }
}