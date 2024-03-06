<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mapper\ObjectMapper;
use Symfony\Component\Mapper\ReflectionMapperMetadataFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class BookProvider implements ProviderInterface
{
    private $mapper;
    public function __construct(private readonly ManagerRegistry $manager) {
        $this->mapper = new ObjectMapper(new ReflectionMapperMetadataFactory(), PropertyAccess::createPropertyAccessor());
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $manager = $this->manager->getManagerForClass(Book::class);
        $repository = $manager->getRepository(Book::class);
        
        if (!$operation instanceof CollectionOperationInterface) {
            $context['request']->attributes->set('doctrine_entity', $doctrineEntity = $repository->find($uriVariables));
            return $this->mapper->map($doctrineEntity);
        }

        $data = [];
        foreach ($repository->findAll() as $bookEntity) {
            $data[] = $this->mapper->map($bookEntity);
        }

        return $data;
    }
}
