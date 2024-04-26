<?php

namespace App\Controller;

use App\Form\ExportFilterType;
use App\Service\ExportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_export_')]
class ExportController extends AbstractController
{
    public function __construct(readonly ExportService $exportService)
    {
    }


    #[Route('', name: 'list')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ExportFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        $exports = $this->exportService->loadExports($data ?? []);
        return $this->render('export/index.html.twig', [
            'exports' => $exports,
            'form' => $form->createView(),
        ]);
    }
}
