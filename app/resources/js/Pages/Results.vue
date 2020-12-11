<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Results
            </h2>
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
                                    <tr v-for="page in training_plans.logbook_pages" :key="page.id">
                                    <th class="border border-gray-200 ..." :colspan = "page.training_effs[0].exercise_effs[0].series_effs.length">Page {{page.id}}</th><!--TOFIX: display number and series number (keep only the max of series of the plan)  -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="border border-gray-200 ...">Indiana</td>
                                    <td class="border border-gray-200 ...">Indianapolis</td>
                                    </tr>
                                    <tr>
                                    <td class="border border-gray-200 ...">Ohio</td>
                                    <td class="border border-gray-200 ...">Columbus</td>
                                    </tr>
                                    <tr>
                                    <td class="border border-gray-200 ...">Michigan</td>
                                    <td class="border border-gray-200 ...">Detroit</td>
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
                training_plans:[],
                training_plan:{
                    name:''

                }
            }
        },
        methods:{
            getTrainingPlans(){
                axios.get('/trainingPlan')
                .then((res) => {
                    this.training_plans = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
            goToTrainingPlanResults(id){
                window.location.href = "/Results/" + id
            },
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
