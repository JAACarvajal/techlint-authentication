<?php

namespace App\Services;

use App\Concerns\{ApiResponse, AuthMetadata};

class BaseService
{
    use ApiResponse;
    use AuthMetadata;
}
