<?php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $names = array(
            'Développement web',
            'Développement mobile',
            'Graphisme',
            'Intégration',
            'Réseau'
        );

        foreach ($names as $name) {

            $category = new Category();
            $category->setName($name);


            $manager->persist($category);
        }
        $manager->flush();

        $title = array(
            'Développeur Web Jeune Diplômé H/F',
            'Développeur Full Stack',
            'Stage Bras-droit CEO / Business development',
            'STAGE DEVELOPPEUR WEB',
            'Développeur web Front & design (H/F)'
        );

        $author = array(
            'Qwertize ',
            'Bouygues Telecom',
            'INTUITU PARTNERS',
            'Groupe Vinci',
            'Leroy Merlin'
        );

        $contact = array(
            '0665194506',
            '0665194506',
            'guillaume.rachet@gmail.com',
            '0665194506',
            'guillaume.rachet@gmail.com'
        );

        $content = array(
            'Premier poste sur la partie technique d’une startup qui s’apprête à lever des fonds, ce recrutement est important pour les fondateurs, tant sur la vision technique que le feeling humain. Nous recherchons un développeur opérationnel dans le code.',
            'Vous êtes passionné(e) par les technologies du Web, et vous êtes prêt(e) à vous impliquer dans une aventure entrepreneuriale avec un fort potentiel dans une équipe où il fait bon vivre : rejoignez-nous !',
            'Notre équipe technique interne a développé l’intégralité de nos outils nous permettant d’être réactif face aux besoins des annonceurs et éditeurs. Nous garantissons aux annonceurs une diffusion simple et rapide de leur publicité.',
            'Au sein d’une équipe composé de 2 personnes à temps plein et d’intervenants extérieurs (développeurs, designers, conseils) vous aurez une vision complète d’un lancement produit alliant sujets pointus de la finance.',
            'Au sein de notre équipe technique, votre mission sera de développer et de maintenir plusieurs sites web et applications développés sous Laravel dans le domaine du tourisme notamment.'
        );

        $category = $manager->getRepository(Category::class)->findAll();


        for ($j = 0; $j < 3; $j++) {
            for ($i = 0; $i < count($title); $i++) {

                $advert = new Advert();
                $advert->setAuthor($author[$i]);
                $advert->setContent($content[$i]);
                $advert->setMail($contact[$i]);
                $advert->setPublished(true);
                $advert->setTitle($title[$i]);
                $advert->addCategory($category[$i]);
                if ($i < 4) {
                    $advert->addCategory($category[$i + 1]);
                }
                $manager->persist($advert);


            }
            $manager->flush();
        }



    }
}
