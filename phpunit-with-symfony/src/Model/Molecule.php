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


class Molecule
{
    private $name;
    private $atoms = [];
    private $type;

    public function __construct($type = 'base')
    {
        $this->type = $type;
    }

    public function addAtom(Atom $atom)
    {
        $this->atoms[] = $atom;

        return $this;
    }

    public function getAtoms()
    {
        return $this->atoms;
    }

    public function merge()
    {
        if (count($this->atoms) < 2) {
            throw new \LogicException('La molécule ne posséde pas assez d\'atomes.');
        }

        $this->name = '';

        foreach ($this->atoms as $atom) {
            $this->name .= $atom->getSymbol();
        }
    }

    public function getName()
    {
        if (null === $this->name) {
            $this->merge();
        }

        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }
}