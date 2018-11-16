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
use App\Model\Molecule;
use PHPUnit\Framework\TestCase;

/**
 * $molecule = new Molecule('glucide');
 * $molecule->addAtom(new Atom('Carbon', 'C'))
 *          ->addAtom(new Atom('Oxygen', 'O'));
 * $molecule->getAtoms(); // Retourne un tableau d'Atomes
 * $molecule->merge(); // La fusion ne doit fonctionner que s'il y au moins 2 atomes
 * $molecule->getName(); // Faire le merge et renvoyer le nom de la molécule
 * $molecule->getType(); // Renvoie le type de la molécule
 */
class MoleculeTest extends TestCase
{
    public function testMoleculeCanBeInstantiated()
    {
        $this->assertInstanceOf(
            Molecule::class,
            new Molecule('glucide')
        );
    }

    public function testAtomCanBeAddedInMolecule()
    {
        $atom = $this->createMock(Atom::class);
        $molecule = new Molecule();
        $molecule->addAtom($atom);

        $this->assertInternalType('array', $molecule->getAtoms());
        $this->assertCount(1, $molecule->getAtoms());
        $this->assertSame($molecule, $molecule->addAtom($atom));
        $this->assertCount(2, $molecule->getAtoms());
        $this->assertContainsOnlyInstancesOf(Atom::class, $molecule->getAtoms());
    }

    public function testAtomInMoleculeMustBeAnAtom()
    {
        $this->expectException(\TypeError::class);
        $molecule = new Molecule();
        $molecule->addAtom('Carbon');
    }

    public function testMoleculeCannotContainsOnlyOneAtom()
    {
        $this->expectException(\LogicException::class);
        $atom = $this->createMock(Atom::class);
        $molecule = new Molecule();
        $molecule->addAtom($atom);
        $molecule->getName();
    }

    public function testFirstMoleculeCanBeMerged()
    {
        $carbon = $this->getMockBuilder(Atom::class)
            ->disableOriginalConstructor()
            ->setMethods(['getSymbol'])
            ->getMock();
        $carbon->method('getSymbol')->willReturn('C');

        $oxygen = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'O'
        ]);

        $molecule = new Molecule();
        $molecule->addAtom($carbon)
                 ->addAtom($oxygen);
        $molecule->merge();
        $this->assertEquals('CO', $molecule->getName());
    }

    public function testSecondMoleculeCanBeMerged()
    {
        $hydrogen = $this->getMockBuilder(Atom::class)
            ->disableOriginalConstructor()
            ->setMethods(['getSymbol'])
            ->getMock();
        $hydrogen->method('getSymbol')->willReturn('H');

        $oxygen = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'O'
        ]);

        $molecule = new Molecule();
        $molecule->addAtom($hydrogen)
            ->addAtom($oxygen);
        $molecule->merge();
        $this->assertEquals('HO', $molecule->getName());
    }

    public function testCanRetrievedMoleculeType()
    {
        $molecule = new Molecule('glucide');
        $this->assertEquals('glucide', $molecule->getType());
    }
}