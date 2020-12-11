<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Results ?
            </h2>
            {{training_plans_effective.logbook_pages[0].training_effs[0].exercise_effs[0].series_effs[0].rep}}
            {{training_plans_template.training}}
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table  class="border-collapse border border-gray-200">
                                  <thead>
                                      <tr class="border border-collapse border-gray-400 ..."> <!-- TODO: v-for here -->
                                          <th>Exercice</th>
                                          <th colspan="2" class="border border-collapse border-gray-200 ...">training1</th> <!-- TODO: colspan value from nb of series -->
                                          <th colspan="2" class="border border-collapse border-gray-200 ...">training2</th>
                                          <th colspan="2" class="border border-collapse border-gray-200 ...">training3</th>
                                     </tr>
                                    <div v-for="training in training_plans_template.trainings" :key="training.id">
                                        <tr class="border border-collapse border-gray-400 ...">
                                            <div v-for="exo in training.exercises" :key="exo.id" >
                                                <th class="border border-collapse border-gray-200 ..." >{{exo.name}}</th>
                                             </div>
                                        </tr>
                                      </div>
                                </thead>
                                <tbody>
                                    <div v-for="page in training_plans_effective.logbook_pages" :key="page.id">
                                        <tr v-for="training in page.training_effs" :key="training.id">
                                        <td v-for="exo in training.exercise_effs" :key="exo.id" class="border border-gray-200 ...">{{exo.rating}}</td>
                                        </tr>
                                        <tr>
                                        <td class="border border-gray-200 ...">Ohio</td>
                                        <td class="border border-gray-200 ...">Columbus</td>
                                        </tr>
                                        <tr>
                                        <td class="border border-gray-200 ...">Michigan</td>
                                        <td class="border border-gray-200 ...">Detroit</td>
                                        </tr>
                                    </div>
                                </tbody>
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
