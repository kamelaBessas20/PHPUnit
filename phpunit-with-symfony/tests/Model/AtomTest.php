<?php

/*
 * This file is part of the phpunitwithsymfony package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Model;

use App\Model\Atom;
use PHPUnit\Framework\TestCase;

/**
 * $atom = new Atom('Carbone', 'C'); // On doit instancier un atome avec absolument 2 chaines. La seconde chaine doit contenir au maximum 2 caractères.
 * $atom->getName(); // Doit retourner le nom de l'atome
 * $atom->getSymbol(); // Doit retourner le symbole de l'atome
 */
class AtomTest extends TestCase
{
    public function testAtomCanBeCreated()
    {
        $this->assertInstanceOf(
            Atom::class,
            new Atom('Carbon', 'C')
        );
    }

    public function testAtomHasAName()
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('Carbon', $atom->getName());
    }

    public function testAtomHasASymbol()
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('C', $atom->getSymbol());
    }

    public function testAtomCannotHaveSymbolMoreThanTwoCharacters()
    {
        $this->expectException(\LengthException::class);
        $atom = new Atom('Carbon', 'Coooo');
    }

    public function testAtomNameAndSymbolAreNotStrings()
    {
        $this->expectException(\InvalidArgumentException::class);
        $atom = new Atom(['ee'], 2);
    }

    public function testAtomCannotBeCreated()
    {
        $this->expectException(\ArgumentCountError::class);
        $atom = new Atom();
    }
}