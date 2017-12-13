<?php

namespace Test\Provider;

use \GuzzleHttp\Psr7\Response;

class ResponseProvider
{
    /**
     * @return Response[]
     */
    public static function sendEmailSuccessfully()
    {
        return [
            [[new Response(204, [], '')]],
        ];
    }
}
