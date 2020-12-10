<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Results ?
            </h2>
            {{training_plans.logbook_pages[0].training_effs[0].exercise_effs[0].series_effs[0].rep}}
        </template>
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
                training_plans:{},
            }
        },
        methods:{
            getTrainingPlans(){
                axios.get("/trainingPlan/"+this.$parent.props.id+"/results")
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
