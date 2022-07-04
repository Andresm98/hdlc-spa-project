<template>
  <Head title="Forgot Password" />

  <div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
      <div
        class="hidden bg-cover lg:block lg:w-full"
        style="
          background-image: url(https://images.unsplash.com/photo-1616763355603-9755a640a287?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80);
        "
      >
        <jet-authentication-card>
          <template #logo>
            <jet-authentication-card-logo />
          </template>

          <div class="mb-4 text-sm text-gray-600">
            ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber
            su dirección de correo electrónico y le enviaremos un enlace de
            restablecimiento de contraseña que le permitirá elegir una nueva.
          </div>

          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>

          <jet-validation-errors class="mb-4" />

          <form @submit.prevent="submit">
            <div>
              <jet-label for="email" value="Correo" />
              <jet-input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
              />
            </div>

            <div class="flex items-center justify-end mt-4">
              <jet-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Enlace de restablecimiento de contraseña de correo electrónico
              </jet-button>
            </div>
          </form>
        </jet-authentication-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    JetValidationErrors,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.email"));
    },
  },
});
</script>
