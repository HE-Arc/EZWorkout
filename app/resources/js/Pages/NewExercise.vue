<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Créez un exercice
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Créez un exercice
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Créez un nouvel exercice pour qu'il corresponde à vos besoins
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form @submit.prevent="createExercise">
                                        <input id="trainig" type="hidden" v-model="form.Training">
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="name" class="block font-medium text-sm text-gray-700">
                                                        <span>Nom</span>
                                                    </label>
                                                    <input id="name" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.name">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="comment" class="block font-medium text-sm text-gray-700">
                                                        <span>Commentaire</span>
                                                    </label>
                                                    <input id="comment" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.comment">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="nbSerie" class="block font-medium text-sm text-gray-700">
                                                        <span>Nombre de séries</span>
                                                    </label>
                                                    <input id="nbSerie" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.nbSerie">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="repMin" class="block font-medium text-sm text-gray-700">
                                                        <span>Nombre de répetitions minimales</span>
                                                    </label>
                                                    <input id="repMin" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.repMin">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="repMax" class="block font-medium text-sm text-gray-700">
                                                        <span>Nombre de répetitions maximales</span>
                                                    </label>
                                                    <input id="repMax" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.repMax">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="pauseSerie" class="block font-medium text-sm text-gray-700">
                                                        <span>Temps de pause entre chaque série (secondes)</span>
                                                    </label>
                                                    <input id="pauseSerie" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.pauseSerie">
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="pauseExercise" class="block font-medium text-sm text-gray-700">
                                                        <span>Temps de pause à la fin de l'exercice (secondes)</span>
                                                    </label>
                                                    <input id="pauseExercise" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.pauseExercise">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </app-layout>
    </div>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
            },

        data(){
            return{
                form: {
                    name: '',
                    training: this.$parent.props.idTraining,
                    comment: '',
                    nbSerie: 1,
                    repMin: 1,
                    repMax: 1,
                    pauseSerie: 30,
                    pauseExercise: 60,
                },
            }
        },
        methods:{
            createExercise() {
                this.$inertia.post('/exercise/', this.form);
                window.location.href = '/selectExercises/' + this.form.training;
            },
        },
    }
</script>
