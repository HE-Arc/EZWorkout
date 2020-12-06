<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vos entraînements
            </h2>
        </template>

        <div class="overflow-visible py-12">
            <div class="overflow-visible max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-visible shadow-xl sm:rounded-lg">
                    <div class="overflow-visible flex flex-col">
                    <div class="overflow-visible -my-2 sm:-mx-6 lg:-mx-8">
                        <div class="overflow-visible py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-visible shadow  border-b border-gray-200 sm:rounded-lg">
                            <div v-if="!t_present" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <div class="text-3xl font-bold leading-tight text-gray-900">
                                    Vous n'avez aucun entraînement pour le moment.
                                </div>
                            </div>
                            <table v-if="t_present" class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">
                                    <span class="sr-only">Voir/Éditer</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="training in trainings" :key="training.id">
                                <td class="px-18 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{training.name}}
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a :href="getExerciseLink(training.id)" class="text-indigo-600 hover:text-indigo-900">Voir</a> 
                                    <a :href="editTrainingLink(training.id)" class="text-indigo-600 hover:text-indigo-900">Éditer</a>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="overflow-visible flex items-center w-full justify-evenly px-2 py-7 bg-gray-50 text-right sm:px-6">
                                <a :href="newLink()" class="pr-12">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Créer un nouvel entraînement
                                    </button>
                                </a>
                                <v-select class=" px-2 py-2" style="min-width: 500px" label="name" :options="AllTrainings" :reduce="tr => tr.id" v-model="newSelected" />
                                <button @click="addExisting" :disabled="btnDisabled" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Ajouter un entraînement exsistant
                                </button>
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
    import Welcome from './../Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },

        data(){
            return{
                trainings:[],
                AllTrainings: [],
                newSelected: null,
            }
        },
        methods:{
            getTrainings(){
                axios.get('/training/fromTP/'+ this.$parent.props.id)
                .then((res) => {
                    this.trainings = res.data
                }).catch((err) => {
                    console.log(err)
                });
                axios.get('/training/')
                .then((res) => {
                    this.AllTrainings = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            getExerciseLink(id){
                return "/selectExercises/" + id
            },
            editTrainingLink(id){
                return "/editTraining/" + id
            },
            newLink(){
                return "/newTraining/" + this.$parent.props.id
            },
            addExisting(){
                axios.post('/training/' + this.newSelected + '/addToTrainingPlan', {trainingPlan: this.$parent.props.id});
                this.getTrainings();
            }
        },
        created(){
            this.getTrainings()
        },
        computed: {
            t_present: function(){
                return this.trainings.length > 0
            },
            btnDisabled: function(){
                return this.newSelected == null
            }
        }
    }
</script>
