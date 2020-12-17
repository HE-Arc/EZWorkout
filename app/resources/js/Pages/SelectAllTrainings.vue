<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tous vos entraînements
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
                                    <span class="sr-only">Éditer</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="training in trainings" :key="training.id" class="hover:bg-gray-200">
                                <td @click="gotoExercise(training.id)" class="px-18 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{training.name}}
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a :href="editTrainingLink(training.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="edit" /></a> 
                                    <a @click="delTraining(training.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="trash-alt" /></a>
                                </td>
                                </tr>
                            </tbody>
                            </table>
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
                trainings:[],
                delId: null
            }
        },
        methods:{
            getTrainings(){
                axios.get('/api/web/training')
                .then((res) => {
                    this.trainings = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            editTrainingLink(id){
                return "/training/" + id + "/edit"
            },
            delTraining(id){
                this.delId = id;
                this.$modal.show('dialog', {
                    title: 'Supprimer un entraînement',
                    text: 'Êtes-vous sûr de vouloir supprimer cet entraînement?<br>Cette action est définitive.',
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
                                axios.delete('/api/web/training/' + this.delId + "/all")
                                this.delId = null;
                                this.getTrainings();
                                this.$modal.hide('dialog');
                            }
                        }
                    ]
                })
            },
            gotoExercise(id){
                window.location.href = "/exercises/" + id;
            }
        },
        created(){
            this.getTrainings()
        },
        computed: {
            t_present: function(){
                return this.trainings.length > 0
            }
        }
    }
</script>
