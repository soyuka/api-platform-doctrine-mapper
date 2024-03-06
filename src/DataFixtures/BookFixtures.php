<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book = new Book();
        $book->setTitle('1984');

        $manager->persist($book);

        $manager->flush();
    }
}
