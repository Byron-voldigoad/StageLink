<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\OffreStage;
use App\Models\ProfilEtudiant;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Création des utilisateurs
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role' => 'entreprise'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role' => 'etudiant'
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Création des entreprises
        $entreprises = [
            [
                'nom' => 'Tech Solutions',
                'adresse' => '123 Rue de l\'Innovation',
                'quartier' => 'Plateau',
                'telephone' => '0123456789',
                'email' => 'contact@techsolutions.com',
                'description' => 'Entreprise leader en solutions technologiques'
            ],
            [
                'nom' => 'Digital Agency',
                'adresse' => '456 Avenue du Digital',
                'quartier' => 'Cocody',
                'telephone' => '9876543210',
                'email' => 'info@digitalagency.com',
                'description' => 'Agence de marketing digital innovante'
            ],
            [
                'nom' => 'Green IT',
                'adresse' => '789 Boulevard Écologique',
                'quartier' => 'Yopougon',
                'telephone' => '5555555555',
                'email' => 'contact@greenit.com',
                'description' => 'Solutions IT écologiques'
            ],
            [
                'nom' => 'Data Analytics Corp',
                'adresse' => '321 Rue des Données',
                'quartier' => 'Plateau',
                'telephone' => '1111111111',
                'email' => 'info@dataanalytics.com',
                'description' => 'Expertise en analyse de données'
            ],
            [
                'nom' => 'Web Masters',
                'adresse' => '654 Avenue du Web',
                'quartier' => 'Cocody',
                'telephone' => '2222222222',
                'email' => 'contact@webmasters.com',
                'description' => 'Développement web professionnel'
            ]
        ];

        foreach ($entreprises as $entrepriseData) {
            Entreprise::create($entrepriseData);
        }

        // Création des offres de stage
        $offresStage = [
            [
                'titre' => 'Stage Développeur Full Stack',
                'description' => 'Stage de 6 mois en développement web',
                'id_entreprise' => 1,
                'duree' => '6 mois',
                'remuneration' => '150000',
                'competences_requises' => 'PHP, JavaScript, MySQL',
                'secteur' => 'Développement web',
                'statut' => 'ouvert'
            ],
            [
                'titre' => 'Stage Marketing Digital',
                'description' => 'Stage en marketing digital et réseaux sociaux',
                'id_entreprise' => 2,
                'duree' => '3 mois',
                'remuneration' => '100000',
                'competences_requises' => 'SEO, Social Media, Analytics',
                'secteur' => 'Marketing',
                'statut' => 'ouvert'
            ],
            [
                'titre' => 'Stage Data Science',
                'description' => 'Analyse de données et machine learning',
                'id_entreprise' => 4,
                'duree' => '4 mois',
                'remuneration' => '200000',
                'competences_requises' => 'Python, R, SQL',
                'secteur' => 'Data Science',
                'statut' => 'ouvert'
            ]
        ];

        foreach ($offresStage as $offreData) {
            OffreStage::create($offreData);
        }

        // Création des profils étudiants
        $profilsEtudiants = [
            [
                'id_utilisateur' => 3,
                'prenom' => 'Jane',
                'nom' => 'Smith',
                'telephone' => '0123456789',
                'adresse' => '123 Rue des Étudiants',
                'ecole' => 'École Supérieure d\'Informatique',
                'niveau' => 'Master',
                'domaine_etude' => 'Informatique',
                'credits' => 0
            ]
        ];

        foreach ($profilsEtudiants as $profilData) {
            ProfilEtudiant::create($profilData);
        }

        // Création des messages
        $messages = [
            [
                'id_expediteur' => 3,
                'id_destinataire' => 2,
                'contenu' => 'Je suis intéressé par votre offre de stage.',
                'lu' => false
            ],
            [
                'id_expediteur' => 2,
                'id_destinataire' => 3,
                'contenu' => 'Merci de votre intérêt. Pouvons-nous prévoir un entretien?',
                'lu' => false
            ]
        ];

        foreach ($messages as $messageData) {
            Message::create($messageData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
