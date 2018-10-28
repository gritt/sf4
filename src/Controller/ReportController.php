<?php

namespace App\Controller;

use App\Service\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report")
 */
class ReportController extends AbstractController
{
    /**
     * @Route("/tags-by-products", name="report_tags_by_products", methods="GET")
     */
    public function tagsByProducts(Request $request, Report $report): JsonResponse
    {
        return new JsonResponse(
            $report->getTagsByProducts()
        );
    }
}