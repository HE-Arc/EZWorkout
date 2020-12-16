<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vos plans d'entraînement
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div v-if="!tp_present" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <div class="text-3xl font-bold leading-tight text-gray-900">
                                    Vous n'avez aucun plan d'entraînement pour le moment.
                                </div>
                            </div>
                            <table v-if="tp_present" class="min-w-full divide-y divide-gray-200">
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
                                <tr v-for="plan in training_plans" :key="plan.id" class="hover:bg-gray-200">
                                <td @click="gotoTraining(plan.id)" class="px-18 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                        {{plan.name}}
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"> 
                                    <a :href="editTrainingPlanLink(plan.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="edit" /></a> 
                                    <a @click="delTP(plan.id)" class="text-indigo-600 hover:text-indigo-900"><font-awesome-icon icon="trash-alt" /></a>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="/newTrainingPlan">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Créer un nouveau plan d'entraînement
                                    </button>
                                </a>
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
                training_plans:[],
                delId: null,
            }
        },
        methods:{
            getTrainingPlans(){
                axios.get('/api/web/trainingPlan')
                .then((res) => {
                    this.training_plans = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            editTrainingPlanLink(id){
                return "/editTrainingPlan/" + id
            },
            delTP(id){
                this.delId = id;
                this.$modal.show('dialog', {
                    title: 'Supprimer un plan d\'entraînement',
                    text: 'Êtes-vous sûr de vouloir supprimer ce plan d\'entraînement?<br>Cette action est définitive.',
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
                                axios.delete('/api/web/trainingPlan/' + this.delId)
                                this.delId = null;
                                this.getTrainingPlans();
                                this.$modal.hide('dialog');
                            }
                        }
                    ]
                })
            },
            gotoTraining(id){
                window.location.href = "/selectTrainings/" + id;
            }
        },
        created(){
            this.getTrainingPlans()
        },
        computed: {
            tp_present: function(){
                return this.training_plans.length > 0
            }
        }
    }
</script>
