<?php
namespace MailSender\Interfaces;

/**
 * Interface MailSenderUnit
 * @package MailSender\Interfaces
 */
interface MailSenderUnit {
    /**
     * MailSenderUnit constructor.
     * @param $email - email получателя
     * @param $name - как величать получателя
     * @param $listIds - id списков рассылки получателя (к которым он будет добавлен)
     */
    public function __construct($email,$name,$listIds);

    /**
     * Добавить дополнительные параметры получателя
     * @param array $params - параметры (ключ = значение)
     * @return mixed
     */
    public function setParams($params = []);

    /**
     * Получить параметры получателя
     * @return array
     */
    public function getParams();

    /**
     * Установить почту получателя
     * @param $email
     * @return mixed
     */
    public function setEmail($email);

    /**
     * Установить имя получателя
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * Установить списки рассылки получателя
     * @param $ids
     * @return mixed
     */
    public function setListIds($ids);

    /**
     * Получить email получателя
     * @return string
     */
    public function getEmail();

    /**
     * Получить имя получателя
     * @return string
     */
    public function getName();

    /**
     * Получить список рассылок получателя
     * @return string
     */
    public function getListIds();
}