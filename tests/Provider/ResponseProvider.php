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

    /**
     * @return Response[]
     */
    public static function getTemplateSuccessfully()
    {
        return [
            [[new Response(200, [], '{"to":"","from":"","subject":"","text":"this is a text","html":"this is a html"}')]],
        ];
    }
}
