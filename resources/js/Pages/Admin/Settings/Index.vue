<template>
  <!-- A -->
  <app-layout title="Admin Sistema">
    <div v-if="$page.props.flash != null">
      <alert
        v-if="$page.props.flash.success"
        class="alert"
        :type_alert_r="(type_alert = 'success')"
        :message="$page.props.flash.success"
      >
      </alert>
    </div>
    <div v-if="$page.props.flash != null">
      <alert
        v-if="$page.props.flash.error"
        class="alert"
        :type_alert_r="(type_alert = 'error')"
        :message="$page.props.flash.error"
      >
      </alert>
    </div>
    <section>
      <div>
        <div class="">
          <div class="mt-5">
            <form @submit.prevent="updateEnvData">
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div>
                  <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <!--
                      Information Server
                     -->
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Información General Servidor
                    </h3>
                    <div class="grid grid-cols-6 gap-6">
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.APP_NAME"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >APP_NAME</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.APP_NAME.value"
                        />
                      </div>

                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.APP_ENV"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >APP_ENV</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.APP_ENV.value"
                        />
                      </div>

                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.APP_DEBUG"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >APP_DEBUG</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.APP_DEBUG.value"
                        />
                      </div>

                      <div
                        class="col-span-6 sm:col-span-6"
                        v-if="this.listKeys.APP_URL"
                      >
                        <label
                          for="company-website"
                          class="block text-sm font-medium text-gray-700"
                        >
                          APP_URL
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                          <span
                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                          >
                            http://
                          </span>
                          <input
                            type="text"
                            name="company-website"
                            id="company-website"
                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                            placeholder="www.example.com"
                            v-model="this.listKeys.APP_URL.value"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6" aria-hidden="true">
                      <div class="py-5">
                        <div class="border-t border-gray-200" />
                      </div>
                    </div>
                    <!--
                        Database information
                     -->
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Información Base de Datos
                    </h3>
                    <div class="grid grid-cols-6 gap-6">
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_CONNECTION"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_CONNECTION</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_CONNECTION.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_HOST"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_HOST</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_HOST.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_PORT"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_PORT</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_PORT.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_DATABASE"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_DATABASE</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_DATABASE.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_USERNAME"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_USERNAME</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_USERNAME.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.DB_PASSWORD"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >DB_PASSWORD</label
                        >
                        <input
                          type="password"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.DB_PASSWORD.value"
                        />
                      </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6" aria-hidden="true">
                      <div class="py-3">
                        <div class="border-t border-gray-200" />
                      </div>
                    </div>
                    <!--
                        Mail Server
                     -->
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Conexión a Servidor de Correo
                    </h3>
                    <div class="grid grid-cols-6 gap-6">
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_MAILER"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_MAILER</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_MAILER.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_HOST"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_HOST</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_HOST.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_PORT"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_PORT</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_PORT.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_USERNAME"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_USERNAME</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_USERNAME.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_PASSWORD"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_PASSWORD</label
                        >
                        <input
                          type="password"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_PASSWORD.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_ENCRYPTION"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_ENCRYPTION</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_ENCRYPTION.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.MAIL_FROM_ADDRESS"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >MAIL_FROM_ADDRESS</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.MAIL_FROM_ADDRESS.value"
                        />
                      </div>
                    </div>
                    <!--
                        AWS Container
                     -->
                    <div class="col-span-6 sm:col-span-6" aria-hidden="true">
                      <div class="py-3">
                        <div class="border-t border-gray-200" />
                      </div>
                    </div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      Contenedor de archivos cifrados
                    </h3>
                    <div class="grid grid-cols-6 gap-6">
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.AWS_ACCESS_KEY_ID"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >AWS_ACCESS_KEY_ID</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.AWS_ACCESS_KEY_ID.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-4"
                        v-if="this.listKeys.AWS_SECRET_ACCESS_KEY"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >AWS_SECRET_ACCESS_KEY</label
                        >
                        <input
                          type="password"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.AWS_SECRET_ACCESS_KEY.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.AWS_DEFAULT_REGION"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >AWS_DEFAULT_REGION</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.AWS_DEFAULT_REGION.value"
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.AWS_USE_PATH_STYLE_ENDPOINT"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >AWS_USE_PATH_STYLE_ENDPOINT</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="
                            this.listKeys.AWS_USE_PATH_STYLE_ENDPOINT.value
                          "
                        />
                      </div>
                      <div
                        class="col-span-6 sm:col-span-2"
                        v-if="this.listKeys.AWS_BUCKET"
                      >
                        <label
                          for="first-name"
                          class="block text-sm font-medium text-gray-700"
                          >AWS_BUCKET</label
                        >
                        <input
                          type="text"
                          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          v-model="this.listKeys.AWS_BUCKET.value"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button
                    type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Guardar Información
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200" />
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";
import Alert from "@/Components/Alert";
import { defineComponent } from "vue";
export default defineComponent({
  setup() {},

  props: {
    keys: Object,
  },

  data() {
    return {
      listKeys: this.$inertia.form(this.keys),
    };
  },

  layout: PrincipalLayout,

  components: {
    AppLayout,
    Alert,
  },

  methods: {
    updateEnvData() {
      this.listKeys.post(route("admin.settings.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true;
        },
      });
    },

    sub() {
      console.log("redes ", this.listKeys);
    },
  },
});
</script>
