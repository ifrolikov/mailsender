<?php
namespace MailSender;

spl_autoload_register(function($name){
    $namespaces = ['interfaces' => 'interface','classes' => 'class'];
    $ext = 'php';
    $path = explode('\\',$name);
    $mainClass = array_shift($path);
    if ($mainClass == 'MailSender') {
        $objectName = array_pop($path);

        reset($path);
        $path = array_map('strtolower', $path);
        $objectType = current($path);

        $path = __DIR__ . '/' . implode('/', $path);

        try {
            if (!isset($namespaces[$objectType])) {
                throw new \Exception("Отсутствует пространтство {$objectType}");
            }

            include_once $path . '/' . implode('.', [$objectName, $namespaces[$objectType], $ext]);
        } catch (\Exception $e) {
            var_dump($e->getMessage(), implode(':', [__FILE__, __LINE__]));
            exit;
        }
    }
});