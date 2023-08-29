<?php

namespace App\tools\code;

class HttpCode
{
    const HTTP_OK                    = 200;
    const HTTP_SWITCHING_PROTOCOLS   = 101;
    const HTTP_CONTINUE              = 100;
    const HTTP_CREATED               = 201;
    const HTTP_ACCEPTED              = 202;
    const HTTP_MOVED_PERMANENTLY     = 301;
    const HTTP_BAD_REQUEST           = 400;
    const HTTP_PAYMENT_REQUIRED      = 402;
    const HTTP_FORBIDDEN             = 403;
    const HTTP_NOT_FOUND             = 404;
    const HTTP_METHOD_NOT_ALLOWED    = 405;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED       = 501;
    const HTTP_BAD_GATEWAY           = 502;
    const HTTP_GATEWAY_TIMEOUT       = 504;
}
