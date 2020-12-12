<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Results ?
            </h2>
            {{training_plans_effective.logbook_pages[0].training_effs[0].exercise_effs[0].series_effs[0].rep}}
            {{training_plans_template.trainings[0].exercises[0].name}}
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table  class="border-collapse border border-gray-200">
                                 <div v-for="(page,index) in training_plans_effective.logbook_pages" :key="page.id" >
                                    <tr class="border border-collapse border-gray-400 ">
                                        <th class="border border-collapse border-gray-200 " scope="col" >Exercice</th>
                                        <th class="border border-collapse border-gray-200 " scope="col" >Seance {{index+1}}</th> <!-- TODO: v-for here -->
                                    </tr>
                                 <div v-for="training in page.training_effs" :key="training.id" class="border border-collapse border-gray-400">
                                    <tr v-for="exo in training.exercise_effs" :key="exo.id" class="border border-collapse border-gray-200">
                                            <th class="border border-collapse border-gray-200 ..." scope="row"  >{{exo.id}}</th>
                                            <td v-for="serie in exo.series_effs" :key="serie.id">{{serie.rep}} </td>
                                    </tr>
                                </div>
                                   
                                        <tr >
                                        <td class="border border-gray-200"></td>
                                        </tr>
                                    </div>
                            </table>
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
                training_plans_effective:{},
                training_plans_template:{},
            }
        },
        methods:{
            getTrainingPlansResults(){
                axios.get("/trainingPlan/"+this.$parent.props.id+"/results")
                .then((res) => {
                    this.training_plans_effective = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            getTrainingPlansTemplate(){
                axios.get("/trainingPlan/"+this.$parent.props.id+"/resultsTemplate")
                .then((res) => {
                    this.training_plans_template = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
        },
        created(){
            this.getTrainingPlansResults();
            this.getTrainingPlansTemplate();
        },
        computed: {
            tp_present: function(){
                return this.training_plans_effective.length > 0
            }
        }
    }
</script>
