<template>
  <Head title="Register" />

  <!-- component -->
  <div class="bg-white dark:bg-gray-900">
    <div
      class="flex justify-center sm:h-full md:h-full lg:h-screen xl:h-screen"
    >
      <div
        class="hidden bg-cover lg:block lg:w-3/6"
        style="
          background-image: url(https://files-hdlc-frontend.s3.us-east-1.amazonaws.com/banner_spa.jpg);
        "
      >
        <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
          <div>
            <h2 class="text-4xl font-bold text-white">Provincia Ecuador</h2>

            <p class="max-w-xl mt-3 text-gray-300">
              Por favor ingrese sus credeciales de acceso, si desea recuperar su
              contraseña por favor siga las instrucciones
            </p>
          </div>
        </div>
      </div>

      <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-6/6">
        <div class="flex-1">
          <div class="text-center sm:justify-center items-center flex flex-col">
            <jet-authentication-card-logo />

            <p class="mt-3 text-black dark:text-white">
              Ingrese la información solicitada
            </p>
          </div>

          <div class="mt-8">
            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
              <div>
                <jet-label
                  class="text-black dark:text-white"
                  for="username"
                  value="Nombre de Usuario"
                />
                <jet-input
                  id="username"
                  type="text"
                  class="mt-1 block w-full"
                  @keydown.space.prevent
                  v-model="form.username"
                  required
                  autofocus
                  autocomplete="username"
                />
              </div>

              <div class="flex flex-wrap">
                <div class="w-full lg:w-2/4 pr-2 mb-2">
                  <div class="mt-4 w-full">
                    <jet-label
                      class="text-black dark:text-white"
                      for="name"
                      value="Nombres"
                    />
                    <jet-input
                      id="name"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.name"
                      required
                      autofocus
                      autocomplete="name"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-2/4 mb-2">
                  <div class="mt-4 w-full">
                    <jet-label
                      class="text-black dark:text-white"
                      for="lastname"
                      value="Apellidos"
                    />
                    <jet-input
                      id="lastname"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.lastname"
                      required
                      autofocus
                      autocomplete="lastname"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-2/4 mb-2">
                  <div class="mt-4 pr-2">
                    <jet-label
                      class="text-black dark:text-white"
                      for="fullnamecomm"
                      value="Nombre en Comunidad"
                    />
                    <jet-input
                      id="fullnamecomm"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.fullnamecomm"
                      required
                      autofocus
                      autocomplete="fullnamecomm"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-2/4 mb-2">
                  <div class="mt-4">
                    <jet-label
                      class="text-black dark:text-white"
                      for="email"
                      value="Correo"
                    />
                    <jet-input
                      id="email"
                      type="email"
                      class="mt-1 block w-full"
                      v-model="form.email"
                      required
                    />
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <jet-label
                  class="text-black dark:text-white"
                  for="password"
                  value="Contraseña"
                />
                <jet-input
                  id="password"
                  type="password"
                  class="mt-1 block w-full"
                  v-model="form.password"
                  required
                  autocomplete="new-password"
                />
              </div>

              <div class="mt-4">
                <jet-label
                  class="text-black dark:text-white"
                  for="password_confirmation"
                  value="Confirmar Contraseña"
                />
                <jet-input
                  id="password_confirmation"
                  type="password"
                  class="mt-1 block w-full"
                  v-model="form.password_confirmation"
                  required
                  autocomplete="new-password"
                />
              </div>

              <div
                class="mt-4"
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
              >
                <jet-label for="terms">
                  <div class="flex items-center">
                    <jet-checkbox
                      name="terms"
                      id="terms"
                      v-model:checked="form.terms"
                    />

                    <div class="text-black dark:text-white ml-2">
                      Estoy de acuerdo
                      <a
                        target="_blank"
                        :href="route('terms.show')"
                        class="underline text-sm text-black dark:text-white"
                        >Términos de Uso</a
                      >
                      y
                      <a
                        target="_blank"
                        :href="route('policy.show')"
                        class="underline text-sm text-black dark:text-white"
                        >Política de Uso</a
                      >
                    </div>
                  </div>
                </jet-label>
              </div>

              <div class="flex items-center justify-end mt-4">
                <Link
                  :href="route('login')"
                  class="
                    text-sm text-blue-500
                    focus:outline-none focus:underline
                    hover:underline
                  "
                >
                  Ya está registrado?
                </Link>

                <jet-button
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Registrarse
                </jet-button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  data() {
    return {
      form: this.$inertia.form({
        username: "",
        lastname: "",
        fullnamecomm: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      console.log(this.form);
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
});
</script>
