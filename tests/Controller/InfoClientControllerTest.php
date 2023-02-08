<?php

namespace App\Test\Controller;

use App\Entity\InfoClient;
use App\Repository\InfoClientRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InfoClientControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private InfoClientRepository $repository;
    private string $path = '/c/ontrolleur/info/client/crud/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(InfoClient::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InfoClient index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'info_client[prenom]' => 'Testing',
            'info_client[nom]' => 'Testing',
            'info_client[docteur]' => 'Testing',
            'info_client[mail]' => 'Testing',
            'info_client[age]' => 'Testing',
            'info_client[sexe]' => 'Testing',
            'info_client[forme_machoire]' => 'Testing',
            'info_client[bruxisme]' => 'Testing',
        ]);

        self::assertResponseRedirects('/c/ontrolleur/info/client/crud/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InfoClient();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setDocteur('My Title');
        $fixture->setMail('My Title');
        $fixture->setAge('My Title');
        $fixture->setSexe('My Title');
        $fixture->setForme_machoire('My Title');
        $fixture->setBruxisme('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InfoClient');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InfoClient();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setDocteur('My Title');
        $fixture->setMail('My Title');
        $fixture->setAge('My Title');
        $fixture->setSexe('My Title');
        $fixture->setForme_machoire('My Title');
        $fixture->setBruxisme('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'info_client[prenom]' => 'Something New',
            'info_client[nom]' => 'Something New',
            'info_client[docteur]' => 'Something New',
            'info_client[mail]' => 'Something New',
            'info_client[age]' => 'Something New',
            'info_client[sexe]' => 'Something New',
            'info_client[forme_machoire]' => 'Something New',
            'info_client[bruxisme]' => 'Something New',
        ]);

        self::assertResponseRedirects('/c/ontrolleur/info/client/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDocteur());
        self::assertSame('Something New', $fixture[0]->getMail());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getSexe());
        self::assertSame('Something New', $fixture[0]->getForme_machoire());
        self::assertSame('Something New', $fixture[0]->getBruxisme());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InfoClient();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setDocteur('My Title');
        $fixture->setMail('My Title');
        $fixture->setAge('My Title');
        $fixture->setSexe('My Title');
        $fixture->setForme_machoire('My Title');
        $fixture->setBruxisme('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/c/ontrolleur/info/client/crud/');
    }
}
