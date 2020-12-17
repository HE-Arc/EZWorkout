<template>
    <div>
        <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Créez un entraînement
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Créez un entraînement
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Choisissez un nom reconnaissable
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form @submit.prevent="createTraining">
                                        <input id="trainigPlan" type="hidden" v-model="form.TrainingPlan">
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-4">
                                                    <label for="name" class="block font-medium text-sm text-gray-700">
                                                        <span>Nom</span>
                                                    </label>
                                                    <input id="name" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" v-model="form.name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    export default {
        components: {
            AppLayout,
            },

        data(){
            return{
                form: {
                    name: '',
                    trainingPlan: this.$parent.props.idTP
                },
            }
        },
        methods:{
            createTraining() {
                this.$inertia.post('/api/web/training/', this.form);
                window.location.href = '/trainings/' + this.form.trainingPlan;
            },
        },
    }
</script>
