<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\State\BookProcessor;
use App\State\BookProvider;
use Symfony\Component\Mapper\Attributes\Map;

#[GetCollection(provider: BookProvider::class)]
#[Patch(processor: BookProcessor::class, provider: BookProvider::class)]
final class Book
{
    #[Map(if: false)]
    public string $id;
    public string $title;
}
