<?php

/*
 * This file is part of the phpunitwithsymfony package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Model;


class Atom
{
    private $name;
    private $symbol;

    public function __construct($name, $symbol)
    {
        if (strlen($symbol) > 2) {
            throw new \LengthException('Le symbole n\'est pas correct.');
        }

        if (!is_string($name) || !is_string($symbol)) {
            throw new \InvalidArgumentException('Les 2 arguments de l\'Atome doivent être des chaines de caractères.');
        }

        $this->name = $name;
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }
}