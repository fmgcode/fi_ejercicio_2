<?php

namespace App\Tests\Customers\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/');

        $response = json_decode($client->getResponse()->getContent(), true);

        // Validate a successful response and some content
        $this->assertResponseStatusCodeSame(200);
        $this->assertManyResultHaveKeys($this->expectedKeys(), $response);

    }

    protected function assertManyResultHaveKeys(array $keys, array $results, bool $allowEmpty = false): void
    {
        if(false === $allowEmpty){
            self::assertNotEmpty($results);
        }
        foreach ($results as $result){
            $this->assertSingleResultHasKeys($keys, $result);
        }
    }

    protected function assertSingleResultHasKeys(array $keys, array $data): void
    {
        self::assertCount(count($keys), $data);
        foreach ($keys as $key) {
            self::assertArrayHasKey($key, $data);
        }
    }

    private function expectedKeys(): array
    {
        return [
            'id',
            'identifier',
            'name',
            'firstLastname'
        ];
    }
}
