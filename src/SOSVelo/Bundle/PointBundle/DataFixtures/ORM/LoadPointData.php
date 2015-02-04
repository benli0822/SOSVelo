<?php

namespace SOSVelo\Bundle\PointBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SOSVelo\Bundle\PointBundle\Entity\Point;
use SOSVelo\Bundle\PointBundle\Entity\PointService;


class LoadPointData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
//        Liste des points SOS Vélo actuellement en service.
//
//        ARMENTIÈRES
//
//        • Base de plein air et de loisirs des Prés du Hem, 7 Avenue Marc Sangnier 
//        en avril, mai, septembre et octobre : du mercredi au dimanche de 10 h à 18 h (dimanche 19h) ; en juin, juillet et août : tous les jours de 10 h à 19 h (dimanche 20h).
//
//        HOUPLIN-ANCOISNE
//
//        • Parc Mozaïc 
//        en avril, mai, septembre et octobre : du mercredi au dimanche de 10 h à 18 h (dimanche 19h) ; en juin, juillet et août : tous les jours de 10 h à 19 h (dimanche 20h).
//
//        LILLE
//
//        • Acteurs pour une économie solidaire (APES), 81 rue Gantois 
//        du lundi au vendredi de 9h à 12h et de 14h à 18h. 
//        • Atelier Lille Sud Insertion , 1 rue Jean Giraudoux et avenue Willy Brandt 
//        du lundi au jeudi de 8h30 à 16h30 et le vendredi de 8h à midi.	
//        • Café Citoyen, 7 place du Marché aux Chevaux 
//        du lundi au vendredi de 12h à minuit et le samedi de 14h à 21h, le dimanche de 16h à 19h. 
//        • Coffee Street, vente de café ambulant, Place des Buisses 
//        du lundi au vendredi de 7h à 9h. 
//        • Coiffeur Jackie G, 138 rue Léon Gambetta 
//        du mardi au samedi de 10h à 18h. 
//        • Épicerie équitable, Halles de Wazemmes 
//        du mardi au jeudi de 8h à 14h, le vendredi et le samedi de 8h à 20h et le dimanche 8h à 15h. 
//        • Lilas Autopartage, 55 boulevard de la Liberté 
//        du lundi au samedi de 9h à 12h30 et de 14h à 18h. 
//        • Maison des Associations, 72 rue Royale 
//        le lundi de 14h à 18h30, du mardi au vendredi de 10h à 18h30 et le samedi de 9h à 12h30. 
//        • MRES, 23 rue Gosselet 
//        du lundi au vendredi de 9h à midi et de 14h à 19h et le samedi de 9h à midi. 
//        • Les Potes en ciel, 46 Rue de Lannoy 
//        mercredi de 9h à 19h, vendredi de 9h à 12h et de 16h30 à 19h30, samedi de 9h à 19h, dimanche de 14h à 18h30. 
//        • Ressourcerie Envie , 15 rue de Courmont 
//        du mardi au samedi de 10h à 12h et de 14h à 19h. 
//        • Toubio, 52 rue de Wazemmes 
//        le lundi de 15h à 19h30, du mardi au vendredi de 10h à 13h et de 15h à 19h30, le samedi de 10h à 13h et de 15h à 19h30.
//
//        ROUBAIX
//
//        • Maison des Associations, place de la Liberté 
//        le lundi de 14h à 18h, du mardi au vendredi de 9h à 19h et le samedi de 9h à 18h.
//
//        SANTES
//
//        • Relais Nature du Parc de la Deûle, 20 chemin de Halage 
//        Ouvert au public d’avril à octobre : 
//        10h à 17h du mercredi au vendredi 
//        10h à 18h les week-ends, jours fériés et vacances scolaires
//
//        Fermeture les lundis et mardis.
//
//        VILLENEUVE D’ASCQ
//
//        • Pavillon de Chasse, chemin du Grand Marais 
//        du lundi au vendredi de 9h à 17h.
        
        $point1 = new Point();
        $point1->setName('Base de plein air et de loisirs des Prés du Hem');
        $point1->setAddress('7 Avenue Marc Sangnier, ARMENTIÈRES');
        $point1->setDescription('du lundi au vendredi de 12h à minuit et le samedi de 14h à 21h, le dimanche de 16h à 19h.');
        $point1->setLatitude('50.69465');
        $point1->setLongitude('2.880861');
        $point1->setActivated(true);

        $manager->persist($point1);
        $manager->flush();
        
        $point2 = new Point();
        $point2->setName('Parc Mozaïc');
        $point2->setAddress('Parc Mozaïc, HOUPLIN-ANCOISNE');
        $point2->setDescription('en avril, mai, septembre et octobre : du mercredi au dimanche de 10 h à 18 h (dimanche 19h) ; en juin, juillet et août : tous les jours de 10 h à 19 h (dimanche 20h).');
        $point2->setLatitude('50.578604');
        $point2->setLongitude('2.980317');
        $point2->setActivated(true);

        $manager->persist($point2);
        $manager->flush();
        
        $point3 = new Point();
        $point3->setName('Acteurs pour une économie solidaire (APES)');
        $point3->setAddress('81 rue Gantois, Lille');
        $point3->setDescription('du lundi au vendredi de 9h à 12h et de 14h à 18h.');
        $point3->setLatitude('50.623712');
        $point3->setLongitude('3.059002');
        $point3->setActivated(true);

        $manager->persist($point3);
        $manager->flush();
        
        $point4 = new Point();
        $point4->setName('Atelier Lille Sud Insertion');
        $point4->setAddress('1 rue Jean Giraudoux et avenue Willy Brandt, Lille');
        $point4->setDescription('du lundi au jeudi de 8h30 à 16h30 et le vendredi de 8h à midi.du lundi au jeudi de 8h30 à 16h30 et le vendredi de 8h à midi.');
        $point4->setLatitude('50.60834');
        $point4->setLongitude('3.045677');
        $point4->setActivated(true);

        $manager->persist($point4);
        $manager->flush();
        
        $point5 = new Point();
        $point5->setName('Café Citoyen');
        $point5->setAddress('7 place du Marché aux Chevaux, Lille');
        $point5->setDescription('du lundi au vendredi de 12h à minuit et le samedi de 14h à 21h, le dimanche de 16h à 19h.');
        $point5->setLatitude('50.632791');
        $point5->setLongitude('3.063122');
        $point5->setActivated(true);

        $manager->persist($point5);
        $manager->flush();
        
        $point6 = new Point();
        $point6->setName('Coffee Street vente de café ambulant');
        $point6->setAddress('Place des Buisses, Lille');
        $point6->setDescription('du lundi au vendredi de 7h à 9h.');
        $point6->setLatitude('50.636846');
        $point6->setLongitude('3.070997');
        $point6->setActivated(true);

        $manager->persist($point6);
        $manager->flush();
        
        $point7 = new Point();
        $point7->setName('Coiffeur Jackie G');
        $point7->setAddress('138 rue Léon Gambetta, Lille');
        $point7->setDescription('du mardi au samedi de 10h à 18h.');
        $point7->setLatitude('50.629728');
        $point7->setLongitude('3.055333');
        $point7->setActivated(true);

        $manager->persist($point7);
        $manager->flush();
        
        $point8 = new Point();
        $point8->setName('Épicerie équitable');
        $point8->setAddress('Halles de Wazemmes, Lille');
        $point8->setDescription('du mardi au jeudi de 8h à 14h, le vendredi et le samedi de 8h à 20h et le dimanche 8h à 15h.');
        $point8->setLatitude('50.626638');
        $point8->setLongitude('3.049454');
        $point8->setActivated(true);

        $manager->persist($point8);
        $manager->flush();
        
        $point9 = new Point();
        $point9->setName('Lilas Autopartage');
        $point9->setAddress('55 boulevard de la Liberté, Lille');
        $point9->setDescription('du lundi au samedi de 9h à 12h30 et de 14h à 18h.');
        $point9->setLatitude('50.635091');
        $point9->setLongitude('3.055676');
        $point9->setActivated(true);

        $manager->persist($point9);
        $manager->flush();
        
        $point10 = new Point();
        $point10->setName('Maison des Associations');
        $point10->setAddress('72 rue Royale, Lille');
        $point10->setDescription('le lundi de 14h à 18h30, du mardi au vendredi de 10h à 18h30 et le samedi de 9h à 12h30.');
        $point10->setLatitude('50.641528');
        $point10->setLongitude('3.056792');
        $point10->setActivated(true);

        $manager->persist($point10);
        $manager->flush();
        
        $point11 = new Point();
        $point11->setName('MRES');
        $point11->setAddress('23 rue Gosselet, Lille');
        $point11->setDescription('du lundi au vendredi de 9h à midi et de 14h à 19h et le samedi de 9h à midi.');
        $point11->setLatitude('50.626189');
        $point11->setLongitude('3.067478');
        $point11->setActivated(true);

        $manager->persist($point11);
        $manager->flush();
        
        $point12 = new Point();
        $point12->setName('Les Potes en ciel');
        $point12->setAddress('46 Rue de Lannoy, Lille');
        $point12->setDescription('mercredi de 9h à 19h, vendredi de 9h à 12h et de 16h30 à 19h30, samedi de 9h à 19h, dimanche de 14h à 18h30.');
        $point12->setLatitude('50.634111');
        $point12->setLongitude('3.094193');
        $point12->setActivated(true);

        $manager->persist($point12);
        $manager->flush();
        
        $point13 = new Point();
        $point13->setName('Ressourcerie Envie');
        $point13->setAddress('15 rue de Courmont , Lille');
        $point13->setDescription('du mardi au samedi de 10h à 12h et de 14h à 19h.');
        $point13->setLatitude('50.6196');
        $point13->setLongitude('3.06662');
        $point13->setActivated(true);

        $manager->persist($point13);
        $manager->flush();
        
        $point14 = new Point();
        $point14->setName('Toubio');
        $point14->setAddress('52 rue de Wazemmes, Lille');
        $point14->setDescription('le lundi de 15h à 19h30, du mardi au vendredi de 10h à 13h et de 15h à 19h30, le samedi de 10h à 13h et de 15h à 19h30.');
        $point14->setLatitude('50.622881');
        $point14->setLongitude('3.062436');
        $point14->setActivated(true);

        $manager->persist($point14);
        $manager->flush();
        
        $point15 = new Point();
        $point15->setName('Maison des Associations');
        $point15->setAddress('place de la Liberté , Roubaix');
        $point15->setDescription('le lundi de 14h à 18h, du mardi au vendredi de 9h à 19h et le samedi de 9h à 18h.');
        $point15->setLatitude('50.691904');
        $point15->setLongitude('3.178994');
        $point15->setActivated(true);

        $manager->persist($point15);
        $manager->flush();
        
        $point16 = new Point();
        $point16->setName('Relais Nature du Parc de la Deûle');
        $point16->setAddress('20 chemin de Halage, SANTES');
        $point16->setDescription('Ouvert au public d’avril à octobre : 10h à 17h du mercredi au vendredi 10h à 18h les week-ends, jours fériés et vacances scolaires Fermeture les lundis et mardis.');
        $point16->setLatitude('50.565399');
        $point16->setLongitude('2.95931');
        $point16->setActivated(true);

        $manager->persist($point16);
        $manager->flush();
        
        $point17 = new Point();
        $point17->setName('Pavillon de Chasse');
        $point17->setAddress('chemin du Grand Marais, VILLENEUVE D’ASCQ');
        $point17->setDescription('du lundi au vendredi de 9h à 17h.');
        $point17->setLatitude('50.64033');
        $point17->setLongitude('3.167235');
        $point17->setActivated(true);

        $manager->persist($point17);
        $manager->flush();


        //ajouter les services
        $names = array(
            'Huile',
            'Outils',
            'Rustines',
            'Pompe',
            'Autres',
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $service = new PointService();
            $service->setName($name);
            $service->setDescription($name);
            $service->setPrivilege(0);
            $point1->addService($service);
            // On la persiste
            $manager->persist($service);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}