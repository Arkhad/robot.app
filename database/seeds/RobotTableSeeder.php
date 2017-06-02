<?php

use Illuminate\Database\Seeder;

class RobotTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {


        $uploads = public_path('images'); // adresse du dossier images dans le dossier public de votre application

        // récupération
        $files = File::allFiles($uploads);

        foreach ($files as $file) File::delete($file); // on supprime toutes les images si elles existent


        factory(App\Robot::class, 30)->create()->each(function ($robot) use ($uploads) {

            $nbTags = App\Tag::all()->count(); // dans le modèle Eloquent on a une méthode count() que l'on peut chaîner

            $indices = [];

            $max = rand(1, $nbTags); // prendre un nombre aléatoire de tags parmi tous les tags

            while (count($indices) != $max) {

                $tagId = rand(1, $nbTags);
                while (in_array($tagId, $indices)) $tagId = rand(1, $max);

                $indices[] = $tagId; // array_push

            }

            $robot->tags()->attach($indices);

            $uri = str_random(12) . '.jpg'; // pour donner un nom à l'image unique

            // gestion du flux d'octects de l'image récupération
            $image = file_get_contents('http://lorempicsum.com/futurama/400/200/' . rand(1, 9));

            // déplacer le flux d'octets et l'enregistrer dans un fichier

            File::put($uploads . DIRECTORY_SEPARATOR . $uri, $image);

            $robot->link = $uri;
 
            $robot->save();

        });

    }

}
