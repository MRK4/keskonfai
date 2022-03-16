<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Keskonfai</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="./src/styles/main.css">
    </head>
    <body class="w-screen h-screen overflow-hidden bg-gradient-to-r from-indigo-200 via-red-200 to-yellow-100">
        <div class="h-full flex justify-center align-center conten-center items-center">
            <?php

            // Mise en place de curl avec l'URL de l'API
            $curl = curl_init('https://www.boredapi.com/api/activity');
            //Disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER by
            //setting them to false.
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($curl);

            if ($data === false) {
                var_dump(curl_error($curl));
            } else {
                $data = json_decode($data, true);

                ?>
                    <div class="relative max-w-6xl flex flex-col p-14 rounded-lg bg-white bg-opacity-50 shadow-lg shadow-white/25">


                        <!-- ON AFFICHE L'ACTIVITÉ AVEC LE TYPE -->
                        <div class="flex flex-row justify-between">
                            <h2 class="text-5xl text-zinc-800 font-medium"><?php echo($data['activity']); ?></h2> <!-- ACTIVITÉ -->
                            <div class="w-fit min-w-fit h-fit ml-2 py-2 px-2 uppercase text-xs text-white bg-purple-400 rounded-lg shadow-lg shadow-purple-300/50">
                                <?php
                                // "education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"
                                    if($data['type'] == 'social'){
                                        echo('social 😅');
                                    }
                                    elseif($data['type'] == 'education'){
                                        echo('education 📚');
                                    }
                                    elseif($data['type'] == 'recreational'){
                                        echo('recreational 🎾');
                                    }
                                    elseif($data['type'] == 'diy'){
                                        echo('diy 🛠️');
                                    }
                                    elseif($data['type'] == 'charity'){
                                        echo('charity 🌟');
                                    }
                                    elseif($data['type'] == 'cooking'){
                                        echo('cooking 🍔');
                                    }
                                    elseif($data['type'] == 'relaxation'){
                                        echo('relaxation 🧘');
                                    }
                                    elseif($data['type'] == 'music'){
                                        echo('music 🎵');
                                    }
                                    elseif($data['type'] == 'busywork'){
                                        echo('busywork 😴');
                                    }
                                    else{
                                        echo('ERROR ☠️');
                                    }
                                ?>
                            </div> <!-- TYPE -->
                        </div>

                        <div class="flex flex-row justify-start">
                            <!-- NOMBRE DE PARTICIPANTS -->
                            <?php
                            if($data['participants']==1){
                                ?>
                                <div class="py-1 px-2 my-2 text-sm rounded-full w-fit h-fit border-2 border-blue-400 text-blue-400 shadow-lg shadow-blue-400/50 bg-transparent"><?php echo($data['participants']); ?> Person 🙋‍♂️</div> <!-- SI UNE SEULE PERSONNE -->
                                <?php
                            }
                            else{
                                ?>
                                <div class="py-1 px-2 my-2 text-sm rounded-full w-fit h-fit border-2 border-blue-400 text-blue-400 shadow-lg shadow-blue-400/50 bg-transparent"><?php echo($data['participants']); ?>~ People 👨‍👧‍👦</div> <!-- SI PLUSIEURS PERSONNES -->
                                <?php
                            }
                            ?>

                            <!-- DIFFICULTÉ -->
                            <?php
                            if($data['accessibility'] >= 0 && $data['accessibility'] <= 0.33){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-green-400 border-2 border-green-400 text-white shadow-lg shadow-green-400/50">Easy 😁</div>
                                <?php
                            }
                            elseif($data['accessibility'] > 0.33 && $data['accessibility'] <= 0.66){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-orange-400 border-2 border-orange-400 text-white shadow-lg shadow-orange-400/50">Medium 😅</div>
                                <?php
                            }
                            elseif($data['accessibility'] > 0.66){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-red-400 border-2 border-red-400 text-white shadow-lg shadow-red-400/50">Hard 😬</div>
                                <?php
                            }
                            else{
                                echo 'ERREUR';
                            }
                            ?>

                            <!-- PRIX -->
                            <?php
                            if($data['price']==0){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-green-400 border-2 border-green-400 text-yellow-100 shadow-lg shadow-green-400/50">FREE 😍</div>
                                <?php
                            }
                            elseif($data['price'] > 0 && $data['price'] <= 0.33){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-green-400 border-2 border-green-400 text-white shadow-lg shadow-green-400/50">Cheap 🙂</div>
                                <?php
                            }
                            elseif($data['price'] > 0.33 && $data['price'] <= 0.66){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-orange-400 border-2 border-orange-400 text-white shadow-lg shadow-orange-400/50">Moderately expensive 😅</div>
                                <?php
                            }
                            elseif($data['price'] > 0.66){
                                ?>
                                <div class="py-1 px-2 my-2 ml-2 text-sm rounded-full w-fit h-fit bg-red-400 border-2 border-red-400 text-white shadow-lg shadow-red-400/50">Expensive 😬</div>
                                <?php
                            }
                            else{
                                echo 'ERREUR';
                            }
                            ?>

                        </div>

                        <!-- SI IL Y A UN LIEN, ON AFFICHE UN BOUTON -->
                        <div class="mt-4 flex justify-end">
                            <?php
                                if(!empty($data['link'])){
                                    ?>
                                    <a class="underline hover:color-" href="<?php echo($data['link']); ?>">Lean more . . .</a>
                                    <?php
                                }
                            ?>
                        </div>

                        <img class="absolute inset-x-0 top-0 right-0 m-4 max-h-5 min-h-5 max-w-auto min-w-auto cursor-pointer" src="./src/img/reload.svg" alt="un bouton pour rafraichir la page" onclick='window.location.reload(true);' />
                    </div>
                <?php
                // var_dump($data);
            }

            curl_close($curl);

            ?>
        </div>
        <div class="w-full py-4 absolute inset-x-0 bottom-0 text-center text-white/75">Thanks to the great <a class="underline" href="https://www.boredapi.com/">BoredAPI</a> ✨</div>

        <script src="" async defer></script>
    </body>
</html>