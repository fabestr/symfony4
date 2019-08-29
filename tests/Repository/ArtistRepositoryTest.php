<?php

namespace App\Tests\Repository;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class ArtistRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
            //faire un fixture ici pour remplir la bdd
            //le fixture doit etre adapté aux résultat attendu dans le test de la méthode
    }

    public function testFindByArtist()
    {
        $artist = $this->entityManager
            ->getRepository(Artist::class)
            ->findByArtist()
        ;

        $this->assertCount(1, $artist);
    }



    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}