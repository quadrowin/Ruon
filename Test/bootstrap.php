<?php

namespace Ruon;

function test_autoload($className)
{
    $nsPrefix = __NAMESPACE__ . '\\';
    
    if (strncmp($className, $nsPrefix, strlen($nsPrefix))) {
        return;
    }
    
    $className = substr($className, strlen($nsPrefix));
    $fileName  = '';
    $lastNsPos = strripos($className, '\\');
    if ($lastNsPos) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', '/', $namespace) . '/';
    }
    $fileName .= str_replace('_', '/', $className) . '.php';
    
    require __DIR__ . '/../' . $fileName;
}

spl_autoload_register('Ruon\\test_autoload');