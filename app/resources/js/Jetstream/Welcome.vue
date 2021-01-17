<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Bienvenue sur EZWorkout
            </div>

            <div class="mt-6 text-gray-500">
                            EZWorkout vous permet de planifier facilement vos entraînements et de voir vos résultats en un coup d'oeil.
                            <br><br>
                            Pour suivre vos entraînements, téléchargez notre application android.
                            <a target="_blank" rel="noopener noreferrer" href="https://play.google.com/store/apps/details?id=ch.hearc.ezworkout"><img width="300em" src="https://play.google.com/intl/en_us/badges/static/images/badges/fr_badge_web_generic.png" alt="badge playsotre"></a>
                            <br>
                            Pour vous connecter à l'application android, vous pouvez afficher le QRcode à l'aide du lien ci-dessous ou dans le menu de votre profil.
                            <br><a class="text-blue-500" href="user/api-tokens">Afficher le QRcode</a>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <font-awesome-icon icon="ruler-combined" class="w-8 h-8 text-gray-400"/>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="/trainingPlans">Vos plans d'entraînement</a></div>
                </div>

                <div class="ml-8">
                    <div class="mt-2 text-sm text-gray-500">
                        Cette section vous permet de gérer vos plans d'entraînement, vous pourrez les créer, les modifier et y ajouter des entraînements et des exercices.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <font-awesome-icon icon="chart-line" class="w-8 h-8 text-gray-400"/>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="/results">Vos résultats</a></div>
                </div>

                <div class="ml-8">
                    <div class="mt-2 text-sm text-gray-500">
                        Vous pourrez ici visualiser les résultats de vos entraînements précédents.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200">
                <div class="flex items-center">
                    <font-awesome-icon icon="book" class="w-8 h-8 text-gray-400"/>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="/trainings">Bibliothèque des entraînements</a></div>
                </div>

                <div class="ml-8">
                    <div class="mt-2 text-sm text-gray-500">
                        Ici, vous pourrez parcourir tous vos entraînements.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-l">
                <div class="flex items-center">
                    <font-awesome-icon icon="dumbbell" class="w-8 h-8 text-gray-400"/>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="/exercises">Bibliothèque des exercices</a></div>
                </div>

                <div class="ml-8">
                    <div class="mt-2 text-sm text-gray-500">
                        Cette dernière section vous permet de parcourir tous vos exercices.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
