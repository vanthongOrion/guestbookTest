<?php 
namespace App\Tests\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        $this->assertPageTitleContains('Hanoi');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2','Hanoi2019 Conference');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/hanoi-2023');
        $client->submitForm('Submit' ,['comment_form[author]' => 'Fabien', 
                                       'comment_form[text]' => 'Some feedback from an automated functional test',
                                       'comment_form[email]' => $email = 'me@automat.ed',
                                       'comment_form[photo]' => dirname(__DIR__,2) .'/public/images/under-construction.gif',
                                       ]);
        $this->assertResponseRedirects();

        // simulate comment validation
        $comment = self::getContainer()->get(CommentRepository::class)->findOneByEmail($email);
        $comment->setState('pulished');
        self::getContainer()->get(EntityManagerInterface::class)->flush();
        $client->followRedirects();
        $this->assertSelectorExists('div:contains("There are 2 comments")');
    }
}
