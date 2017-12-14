<?php

namespace Test\Unit;

use \PHPUnit\Framework\TestCase;
use RoundPartner\Pigeon\Entity\Email;
use RoundPartner\Pigeon\Pigeon;
use RoundPartner\Pigeon\PigeonInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class PigeonTest extends TestCase
{

    /**
     * @var PigeonInterface
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Pigeon('http://0.0.0.0:3411');
    }

    /**
     * @param Response[] $responses
     *
     * @throws \RoundPartner\Pigeon\Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendEmail($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendEmail(Email::factory('sender@mailinator.com', 'reciptient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!'));
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @throws \RoundPartner\Pigeon\Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendAnEmailUsingBasicParams($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendBasicEmail('sender@mailinator.com', 'reciptient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!');
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @return Client
     */
    protected function getClientMock($responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }
}
