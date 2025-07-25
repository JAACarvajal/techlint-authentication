<?php

namespace App\Constants;

/**
 * Summary of HttpCodes
 *
 * Cconstants for common HTTP status codes
 */
class HttpCodes
{
    public const OK = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const UNPROCESSABLE_CONTENT = 422;
    public const FORBIDDEN = 403;
    public const CONFLICT = 409;
    public const NOT_FOUND = 404;
    public const INTERNAL_SERVER_ERROR = 500;
}
