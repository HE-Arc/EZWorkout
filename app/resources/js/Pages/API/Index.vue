<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Connexion à l'app
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <api-token-manager />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import ApiTokenManager from './ApiTokenManager'
    import AppLayout from './../../Layouts/AppLayout'
    import JetSectionBorder from './../../Jetstream/SectionBorder'

    export default {
        props: [
        ],

        components: {
            ApiTokenManager,
            AppLayout,
            JetSectionBorder,
        },
    }
</script>
