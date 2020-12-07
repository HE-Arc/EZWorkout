<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Results
            </h2>
        </template>
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
