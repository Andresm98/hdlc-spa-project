<template>
    <jet-form-section @submitted="createTeam">
        <template #title>
            Detalles del Equipo
        </template>

        <template #description>
           Crear nuevos equipos para colaborar con otros usuarios en otros proyectos.
        </template>

        <template #form>
            <div class="col-span-6">
                <jet-label value="Propietario del Equipo" />

                <div class="flex items-center mt-2">
                    <img class="object-cover w-12 h-12 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">

                    <div class="ml-4 leading-tight">
                        <div>{{ $page.props.user.name }}</div>
                        <div class="text-sm text-gray-700">{{ $page.props.user.email }}</div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Nombre del Equipo" />
                <jet-input id="name" type="text" class="block w-full mt-1" v-model="form.name" autofocus />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Crear
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import { defineComponent } from 'vue'

    export default defineComponent({
        components: {
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                })
            }
        },

        methods: {
            createTeam() {
                this.form.post(route('teams.store'), {
                    errorBag: 'createTeam',
                    preserveScroll: true
                });
            },
        },
    })
</script>
