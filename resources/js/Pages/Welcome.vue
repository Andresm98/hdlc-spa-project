<template>
  <Head title="Welcome" />

  <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4 sm:block">
    <Link v-if="$page.props.user" :href="route('dashboard')">
      <span
        class="
          px-5
          inline-flex
          text-sm
          leading-5
          rounded-lg
          bg-white
          text-black
        "
      >
        SISTEMA
      </span>
    </Link>

    <template v-else>
      <Link :href="route('login')" class="">
        <span
          class="
            px-5
            inline-flex
            text-sm
            leading-5
            rounded-lg
            bg-white
            text-black
          "
        >
          Ingresar
        </span>
      </Link>

      <Link v-if="canRegister" :href="route('register')" class="mx-2">
        <span
          class="
            px-5
            inline-flex
            text-sm
            leading-5
            rounded-lg
            bg-white
            text-black
          "
        >
          Registrarse
        </span>
      </Link>
    </template>
  </div>

  <!--



     -->

  <!-- component -->
  <div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
      <div
        class="bg-cover lg:block lg:w-full"
        style="
          background-image: url(https://files-hdlc-frontend.s3.amazonaws.com/banner_welcome.jpg);
        "
      >
        <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
          <div>
            <h2 class="text-4xl font-bold text-white">
              Sistema Gestión Documental
            </h2>

            <p class="max-w-xl mt-3 text-gray-300">
              La Compañía de las Hijas de la Caridad Provincia Ecuador a lo
              largo de los años ha llevando a cabo varios proyectos, entre ellos
              la implementación de herramientas tecnológicas que permitan una
              mejor gestión de la información.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
  color: #cbd5e0;
  color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
  color: #a0aec0;
  color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
  color: #1a202c;
  color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }

  .dark\:bg-gray-900 {
    background-color: #1a202c;
    background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
  }

  .dark\:border-gray-700 {
    border-color: #4a5568;
    border-color: rgba(74, 85, 104, var(--tw-border-opacity));
  }

  .dark\:text-white {
    color: #fff;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
  }

  .dark\:text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
  }
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import SimpleUpload from "@/Components/SimpleUpload";

export default defineComponent({
  components: {
    Head,
    Link,
    SimpleUpload,
  },

  props: {
    image: null,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
});
</script>
