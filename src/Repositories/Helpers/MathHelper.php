<?php

namespace DanPowell\Jellies\Repositories\Helpers;

class MathHelper
{

    static function percentage($percentage, $value)
    {
        if ( $value > 0 ) {
            return ($percentage / 100) * $value;
        } else {
            return 0;
        }
    }

}
