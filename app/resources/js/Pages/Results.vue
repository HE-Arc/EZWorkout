<template>
    <div>
        <app-layout>
        <template #header>
            <h2  class="font-semibold text-xl text-gray-800 leading-tight">
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
                                    <tr class="border border-collapse border-gray-200 ">
                                        <th class="border border-collapse border-gray-400 " scope="col" >Exercice</th>
                                        <th v-for="index in exercisesData.header[1]" :key="index" :colspan="exercisesData.header[0][0]" class="border border-collapse border-gray-400 " scope="col" >Semaine {{index}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="exo in exercisesData.data" :key="exo[0]" class="border border-collapse border-gray-200 ">
                                        <th class="border border-collapse border-gray-400 " scope="col" >{{exo[0]}}</th>
                                        <td v-for="serie in exo.slice(1)" :key="serie.id" class="border border-collapse border-gray-200 " >{{serie.rep}}x{{serie.weight}}kg</td>
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

    export default {
        components: {
            AppLayout,
        },

        data(){
            return{
                exercisesData:{
                    data:[
                        {
                            id:0,
                            rep:0,
                            weight:0,
                        }
                    ],
                    header:[]
                },
            }
        },
        methods:{
            getTrainingPlansResults(){
                axios.get("/trainingPlan/"+this.$parent.props.id+"/results")
                .then((res) => {
                    this.exercisesData = res.data
                }).catch((err) => {
                    console.log(err)
                });
            },
        },
        created(){
            this.getTrainingPlansResults();
        },
    }
</script>
