<?php

namespace App\Service;

use App\Entity\Export;
use Doctrine\ORM\EntityManagerInterface;

class ExportService
{

    public function __construct(readonly EntityManagerInterface $entityManager)
    {
    }


    public function loadExports(array $data): array
    {
        return $this->entityManager->getRepository(Export::class)->filterExports(
            $data['date_from'],
            $data['date_to'],
            $data['place'],
        );
    }

    public function getAvailablePlaces()
    {
        return $this->entityManager->getRepository(Export::class)->getDistinctPlaces();
    }
}