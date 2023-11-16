<template>
    <app-layout title="Create Team">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Equipo
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <create-team-form />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import CreateTeamForm from '@/Pages/Teams/Partials/CreateTeamForm.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { defineComponent } from 'vue'

    export default defineComponent({
        components: {
            AppLayout,
            CreateTeamForm,
        },
    })
</script>
