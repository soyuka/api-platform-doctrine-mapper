<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mapper\ObjectMapper;
use Symfony\Component\Mapper\ReflectionMapperMetadataFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class BookProcessor implements ProcessorInterface
{
    private $mapper;
    public function __construct(private readonly ManagerRegistry $manager) {
        $this->mapper = new ObjectMapper(new ReflectionMapperMetadataFactory(), PropertyAccess::createPropertyAccessor());
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $doctrineEntity = $context['request']->attributes->get('doctrine_entity');
        $manager = $this->manager->getManagerForClass(Book::class);
        $manager->persist($this->mapper->map($data, $doctrineEntity));
        $manager->flush();
        return $data;
    }
}
