<?php
namespace MailSender\Interfaces;

/**
 * Interface MailSender
 * @package MailSender\Interfaces
 */
interface MailSender {
    /**
     * Отправить список получателей в сервис рассылок
     * @return mixed
     */
    public function send();

    /**
     * Добавить получателя в список получателей
     * @param MailSenderUnit $unit
     * @return mixed
     */
    public function addUnit(\MailSender\Interfaces\MailSenderUnit $unit);

    /**
     * Получить список получателей
     * @return mixed
     */
    public function getUnits();

    /**
     * Очистить список получателей
     * @return mixed
     */
    public function cleanUnits();
}