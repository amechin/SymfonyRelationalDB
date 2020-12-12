<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorie = new Categorie();
        $categorie->setNom('jouet');
        $manager->persist($categorie);

        for($i = 1; $i <= 100; $i++ ){
            $produit = new Produit();

            $produit->setNom('Produit'.$i);
            $produit->setPrix(rand(10, 100));
            $produit->setDescription('description'.$i);
            $produit->setCategorie($categorie);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
