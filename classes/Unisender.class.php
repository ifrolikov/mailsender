<?php
namespace MailSender\Classes;

class Unisender extends \MailSender\Classes\AbstractMailSender {
    private static $senders = [];
    private $apiKey = null;

    private function __construct($apiKey) {
        if (empty($apiKey))
            throw new \Exception("Пустой ключ ".__CLASS__);
        $this->apiKey = $apiKey;
    }
    static public function init($apiKey) {
        if (!isset(self::$senders[$apiKey])) {
            self::$senders[$apiKey] = new self($apiKey);
        }
        return self::$senders[$apiKey];
    }

    public function send() {
        $unitArgs = $this->getUserArgs();
        $settings = [
            "field_names" => array_merge(['email','Name','email_list_ids'],$unitArgs),
            "double_optin" => 1,
            "overwrite_tags" => 1,
            "overwrite_lists" => 0,
            "force_import" => 1
        ];
        
        //TODO: отправка не более чем 500 адресатов за раз
        $settings['data'] = $this->getUnitsData($unitArgs);
        return $this->request("importContacts",$settings);
    }

    private function request($method,$args = []) {
        $sendArgs = ["api_key" => $this->apiKey];
        if (!empty($args)) {
            foreach ($args as $key => $arg) {
                if (is_array($arg))
                    $this->prepareArgs($args,$arg,$key);
            }
            $sendArgs += $args;
        }

        $uri = "http://api.unisender.com/ru/api/{$method}?format=json";
        $curl = curl_init();
        curl_setopt($curl, CURLINFO_HEADER_OUT, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $sendArgs);
        curl_setopt($curl, CURLOPT_URL, $uri);
        $ret = curl_exec($curl);
        curl_close($curl);
        return json_decode($ret,true);
    }

    private function prepareArgs(&$src, $args, $key = "", $train = "") {
        if (empty($tran))
            unset($src[$key]);
        foreach ($args as $argKey => $arg) {
            if (is_array($arg)) {
                $this->prepareArgs($src, $arg, $key, $train.'[{$arkKey}]');
            } else {
                $src[$key.$train."[{$argKey}]"] = $arg;
            }
        }
    }
    
    private function getUnitsData($unitArgs) {
        $ret = [];
        $units = $this->getUnits();
        foreach ($units as $unit) {
            $unitData = [
                $unit->getEmail(),
                $unit->getName(),
                $unit->getListIds()
            ];
            $unitParams = $unit->getParams();
            foreach ($unitArgs as $arg) {
                $val = isset($unitParams[$arg])?$unitParams[$arg]:"";
                $unitData[] = $val;
            }
            $ret[] = $unitData;
        }
        return $ret;
    }

    private function getUserArgs() {
        $units = $this->getUnits();
        $allParams = [];
        foreach ($units as $unit) {
            $unitParams = $unit->getParams();
            $allParams = array_merge($allParams,$unitParams);
        }
        return array_keys($allParams);
    }
}