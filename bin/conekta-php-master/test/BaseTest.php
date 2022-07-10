<?php

namespace Conekta;

use \PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function setApiKey()
    {
        $apiEnvKey = getenv('CONEKTA_API');
        if (!$apiEnvKey) {
            $apiEnvKey = 'key_yyczvqafz8rczrGbSieNwA';
        }
        Conekta::setApiKey($apiEnvKey);
    }

    public function setApiVersion($version)
    {
        Conekta::setApiVersion($version);
    }

}
