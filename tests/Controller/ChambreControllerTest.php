<?php

namespace App\Test\Controller;

use App\Entity\Chambre;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChambreControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ChambreRepository $repository;
    private string $path = '/chambre/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Chambre::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chambre index');

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
            'chambre[titre]' => 'Testing',
            'chambre[description_courte]' => 'Testing',
            'chambre[description_longue]' => 'Testing',
            'chambre[photo]' => 'Testing',
            'chambre[prix_journalier]' => 'Testing',
            'chambre[date_enregistrement]' => 'Testing',
        ]);

        self::assertResponseRedirects('/chambre/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chambre();
        $fixture->setTitre('My Title');
        $fixture->setDescription_courte('My Title');
        $fixture->setDescription_longue('My Title');
        $fixture->setPhoto('My Title');
        $fixture->setPrix_journalier('My Title');
        $fixture->setDate_enregistrement('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chambre');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chambre();
        $fixture->setTitre('My Title');
        $fixture->setDescription_courte('My Title');
        $fixture->setDescription_longue('My Title');
        $fixture->setPhoto('My Title');
        $fixture->setPrix_journalier('My Title');
        $fixture->setDate_enregistrement('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'chambre[titre]' => 'Something New',
            'chambre[description_courte]' => 'Something New',
            'chambre[description_longue]' => 'Something New',
            'chambre[photo]' => 'Something New',
            'chambre[prix_journalier]' => 'Something New',
            'chambre[date_enregistrement]' => 'Something New',
        ]);

        self::assertResponseRedirects('/chambre/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDescription_courte());
        self::assertSame('Something New', $fixture[0]->getDescription_longue());
        self::assertSame('Something New', $fixture[0]->getPhoto());
        self::assertSame('Something New', $fixture[0]->getPrix_journalier());
        self::assertSame('Something New', $fixture[0]->getDate_enregistrement());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Chambre();
        $fixture->setTitre('My Title');
        $fixture->setDescription_courte('My Title');
        $fixture->setDescription_longue('My Title');
        $fixture->setPhoto('My Title');
        $fixture->setPrix_journalier('My Title');
        $fixture->setDate_enregistrement('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/chambre/');
    }
}
