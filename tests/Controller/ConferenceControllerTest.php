<?php 
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2','Give your feedback');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('Get', '/');

        $this->assertCount(2, $crawler->filter('h4'));

        $client->clickLink(('View'));

        $this->assertPageTitleContains('Amstertdam');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2','Amsterdam 2019');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }
}
