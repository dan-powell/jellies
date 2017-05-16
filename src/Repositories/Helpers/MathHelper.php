<?php

namespace DanPowell\Jellies\Repositories\Helpers;

class MathHelper
{

    static function percentage($total, $number)
    {
        if ( $total > 0 ) {
            return round($number / ($total / 100),2);
        } else {
            return 0;
        }
    }

}
