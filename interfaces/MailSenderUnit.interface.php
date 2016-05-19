<?php
namespace MailSender\Interfaces;

interface MailSenderUnit {
    public function __construct($email,$name,$listIds);
    public function setParams($params = []);
    public function getParams();
    public function setEmail($email);
    public function setName($name);
    public function setListIds($ids);
    public function getEmail();
    public function getName();
    public function getListIds();
}