<?php

namespace App\Tests;

use App\Entity\Enum\CommentStateEnum;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        static::assertResponseIsSuccessful();
        static::assertSelectorTextContains('h2', 'Give your feedback!');
    }

    public function testCommentSubmission(): void
    {
        $client = static::createClient();
        $client->request('GET', '/conference/amsterdam-2019');

        $client->submitForm('Submit', [
            'comment_form[author]' => 'Fabien',
            'comment_form[text]' => 'Some feedback from an automated functional test',
            'comment_form[email]' => $email = 'me@automat.ed',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
        ]);

        $comment = static::getContainer()->get(CommentRepository::class)->findOneByEmail($email);
        $comment->setState(CommentStateEnum::Published);
        static::getContainer()->get(EntityManagerInterface::class)->flush();
        static::assertResponseRedirects();
        $client->followRedirect();
        static::assertSelectorExists('div:contains("There are 3 comments")');
    }

    public function testConferencePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        static::assertCount(2, $crawler->filter('h4'));
        $client->clickLink('View');

        static::assertPageTitleContains('Amsterdam');

        static::assertResponseIsSuccessful();
        static::assertSelectorTextContains('h2', 'Amsterdam 2019');
        static::assertSelectorExists('div:contains("There are 2 comments")');
    }
}
