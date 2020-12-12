<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Utilisateur extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //Création de mon admin
        $admin = new Utilisateur();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));
        $manager->persist($admin);

        //Création de 5 utilisateurs ROLE USER
        for($i = 1; $i < 6; $i++)
        {
            $utilisateur = new Utilisateur();
            $utilisateur->setEmail('utilisateur'.$i.'@gmail.com');
            $utilisateur->setRoles(['ROLE_USER']);
            $utilisateur->setPassword($this->passwordEncoder->encodePassword(
                $utilisateur,
                'utilisateur'
            ));
            $manager->persist($utilisateur);
        }
        $manager->flush();
    }
}
