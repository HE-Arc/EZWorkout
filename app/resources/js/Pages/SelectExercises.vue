<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vos exercices
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-visible shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-visible sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-visible border-b border-gray-200 sm:rounded-lg">
                            <div v-if="!e_present" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <div class="text-3xl font-bold leading-tight text-gray-900">
                                    Vous n'avez aucun exercice pour le moment.
                                </div>
                            </div>
                            <table v-if="e_present" class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre de séries
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre de répétitions
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Temps de pause entre les séries/exercices
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">
                                    <span class="sr-only">Éditer</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="exercise in exercises" :key="exercise.id" class="hover:bg-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{exercise.name}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{exercise.comment}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{exercise.nbSerie}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Min: {{exercise.repMin}}, Max: {{exercise.repMax}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{exercise.pauseSerie}}/{{exercise.pauseExercise}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a :href="editExerciseLink(exercise.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="edit" /></a> 
                                    <a @click="delExercise(exercise.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="trash-alt" /></a>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="flex overflow-visible items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a :href="newLink()">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Créer un nouvel exercice
                                    </button>
                                </a>
                                <v-select class=" px-2 py-2" style="min-width: 500px" label="name" :options="AllExercises" :reduce="ex => ex.id" v-model="newSelected" />
                                <button @click="addExisting" :disabled="btnDisabled" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Ajouter un exercice existant
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <v-dialog />
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
                exercises:[],
                AllExercises: [],
                newSelected: null,
                delId: null
            }
        },
        methods:{
            getExercises(){
                axios.get('/api/web/exercise/fromT/'+ this.$parent.props.id)
                .then((res) => {
                    this.exercises = res.data
                }).catch((err) => {
                    console.log(err)
                });
                axios.get('/api/web/exercise/')
                .then((res) => {
                    this.AllExercises = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            editExerciseLink(id){
                return "/exercise/" + id + "/edit"
            },
            newLink(){
                return "/exercise/" + this.$parent.props.id + "/add"
            },
            addExisting(){
                axios.post('/api/web/exercise/' + this.newSelected + '/addToTraining', {training: this.$parent.props.id});
                this.getExercises();
            },
            delExercise(id){
                this.delId = id;
                this.$modal.show('dialog', {
                    title: 'Supprimer un exercice',
                    text: 'Êtes-vous sûr de vouloir supprimer cet exercice?<br>Cette action est définitive.',
                    buttons: [
                        {
                            title: 'Annuler',
                            handler: () => {
                                this.delId = null;
                                this.$modal.hide('dialog');
                            }
                        },
                        {
                            title: 'Supprimer',
                            handler: () => {
                                axios.post('/api/web/exercise/' + this.delId + '/removeFromTraining',  {training: this.$parent.props.id})
                                this.delId = null;
                                this.getExercises();
                                this.$modal.hide('dialog');
                            }
                        }
                    ]
                })
            }
        },
        created(){
            this.getExercises()
        },
        computed: {
            e_present: function(){
                return this.exercises.length > 0
            },
            btnDisabled: function(){
                return this.newSelected == null
            }
        }
    }
</script>
