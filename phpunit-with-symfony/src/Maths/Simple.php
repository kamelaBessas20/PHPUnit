<?php

/*
 * This file is part of the phpunitwithsymfony package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Maths;


class Simple
{
    public function addition($a, $b)
    {
        return $a + $b;
    }

    public function substraction($a, $b)
    {
        return $a - $b;
    }
}