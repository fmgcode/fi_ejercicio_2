<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;

use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Twig\Environment;
use App\Customers\Domain\Query\SearchAllCustomerQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class SharedController extends AbstractController
{
    private QueryBus $queryBus;

    /**
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @return JsonResponse
     */
    public function check() : JsonResponse
    {
        return new JsonResponse("OK", Response::HTTP_OK);
    }

    /**
     * @param KernelInterface $kernel
     * @return JsonResponse
     */
    public function entities(KernelInterface $kernel) : JsonResponse
    {
        $projectRoot = $kernel->getProjectDir();

        $finder = new Finder();
        $finder->files()->in("$projectRoot\src\Entity");

        $result = [];

        foreach ($finder as $file) {
            $result[] = $file->getRelativePathname();
        }

        return new JsonResponse($result, Response::HTTP_OK);
    }

    /**
     * @param Pdf $pdf
     * @return Response
     */
    public function entities_pdf(Pdf $pdf) : Response
    {
        $customers = $this->queryBus->ask(
            SearchAllCustomerQuery::create()
        );

        $html = $this->renderView('@pdf/entities_data.html.twig', array(
            'data'  => $customers
        ));

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'data.pdf'
        );
    }
}
