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
     * @throws \Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendEmail($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendEmail(Email::factory('sender@mailinator.com', 'recipient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!'));
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @throws \Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendTrackedEmail($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendTrackedEmail('sender@mailinator.com', 'recipient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!');
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @throws \Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendAnEmailUsingBasicParams($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendBasicEmail('sender@mailinator.com', 'recipient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!');
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @throws \Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendAnEmailUsingTemplate($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendEmailTemplate('recipient@mailinator.com', 'test', []);
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @throws \Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::getTemplateSuccessfully()
     */
    public function testGetTemplate($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->template('test', []);
        $this->assertInstanceOf('RoundPartner\Pigeon\Entity\Email', $response);
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
