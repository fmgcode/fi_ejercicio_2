<?php

declare(strict_types=1);

namespace App\Customers\Infrastructure\Controller;

use App\Customers\Domain\Command\CreateCustomerCommand;
use App\Customers\Domain\Command\EditCustomerCommand;
use App\Customers\Domain\Query\SearchAllCustomerQuery;
use App\Customers\Domain\Query\SearchCustomerByIdQuery;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractController
{
    private QueryBus $queryBus;
    private CommandBus $commandBus;

    /**
     * @param QueryBus $queryBus
     * @param CommandBus $commandBus
     */
    public function __construct(QueryBus $queryBus,
                                CommandBus $commandBus)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function all(Request $request) : JsonResponse
    {
        $customers = $this->queryBus->ask(
            SearchAllCustomerQuery::create()
        );

        return new JsonResponse($customers, Response::HTTP_OK);
    }

    /**
     * @param int $customerId
     * @return JsonResponse
     */
    public function detail(int $customerId) : JsonResponse
    {
        $customer = $this->queryBus->ask(
            SearchCustomerByIdQuery::create($customerId)
        );

        return new JsonResponse($customer, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $params = json_decode($request->getContent(), true);

        $this->commandBus->execute(
            CreateCustomerCommand::create($params)
        );

        return new Response("OK", Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param int $customerId
     * @return Response
     */
    public function edit(Request $request, int $customerId): Response
    {
        $params = json_decode($request->getContent(), true);
        $params['id'] = $customerId;

        $this->commandBus->execute(
            EditCustomerCommand::create($params)
        );

        return new Response("OK", Response::HTTP_OK);
    }
}
