<?php

namespace App\Service;

use App\Entity\Export;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ExportService
{

    private EntityRepository $repository;

    public function __construct(readonly EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Export::class);
    }


    public function loadExports(array $data): array
    {
        if (!empty($data)) {
            return $this->repository->filterExports(
                $data['date_from'],
                $data['date_to'],
                $data['place'],
            );
        } else {
            return $this->repository->findAll();
        }


    }

    public function getAvailablePlaces()
    {
        return $this->repository->getDistinctPlaces();
    }
}