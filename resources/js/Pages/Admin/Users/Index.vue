<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de Usuarios
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <section class="py-1 bg-gray">
      <div class="w-full lg:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <alert
              v-if="$page.props.flash.success"
              class="alert"
              :type_alert_r="(type_alert = 'success')"
              :message="$page.props.flash.success"
            >
            </alert>
            <alert
              v-if="$page.props.flash.error"
              class="alert"
              :type_alert_r="(type_alert = 'error')"
              :message="$page.props.flash.error"
            >
            </alert>

            <Link
              :href="route('admin.user.create')"
              class="pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-sm rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
              >Crear Usuarios</Link
            >
            <!-- Container Filters -->
            <div class="container mx-auto">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm m-4 bg-gray-100"
                >
                  <search-filter
                    v-model="params.search"
                    class="border border-blue-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    @reset="reset"
                  >
                    <label class="block text-gray-700">Rol:</label>
                    <select
                      v-model="params.role"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todas</option>
                      <option
                        v-for="role in roles"
                        :key="role"
                        :value="role.name"
                      >
                        {{ role.name }}
                      </option>
                    </select>
                  </search-filter>
                </div>
              </div>
            </div>

            <small class="ml-6">
              Se encontraron {{ users_list.total }} resultados.</small
            >
            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="users_list.links" />
            </section>

            <div class="py-2">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                  >
                    <table
                      v-if="users_list.data.length > 0"
                      class="min-w-full divide-y divide-gray-200"
                    >
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between hover:cursor-pointer"
                              @click="sort('name')"
                              >Nombre
                              <svg
                                v-if="
                                  params.field === 'name' &&
                                  params.direction === 'asc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.889,11.611c-0.17,0.17-0.443,0.17-0.612,0l-3.189-3.187l-3.363,3.36c-0.171,0.171-0.441,0.171-0.612,0c-0.172-0.169-0.172-0.443,0-0.611l3.667-3.669c0.17-0.17,0.445-0.172,0.614,0l3.496,3.493C14.058,11.167,14.061,11.443,13.889,11.611 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.692-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.383,10c0-4.07-3.312-7.382-7.383-7.382S2.618,5.93,2.618,10S5.93,17.381,10,17.381S17.383,14.07,17.383,10"
                                ></path>
                              </svg>
                              <svg
                                v-if="
                                  params.field === 'name' &&
                                  params.direction === 'desc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"
                                ></path>
                              </svg>
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between hover:cursor-pointer"
                              @click="sort('email')"
                              >Correo
                              <svg
                                v-if="
                                  params.field === 'email' &&
                                  params.direction === 'asc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.889,11.611c-0.17,0.17-0.443,0.17-0.612,0l-3.189-3.187l-3.363,3.36c-0.171,0.171-0.441,0.171-0.612,0c-0.172-0.169-0.172-0.443,0-0.611l3.667-3.669c0.17-0.17,0.445-0.172,0.614,0l3.496,3.493C14.058,11.167,14.061,11.443,13.889,11.611 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.692-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.383,10c0-4.07-3.312-7.382-7.383-7.382S2.618,5.93,2.618,10S5.93,17.381,10,17.381S17.383,14.07,17.383,10"
                                ></path>
                              </svg>
                              <svg
                                v-if="
                                  params.field === 'email' &&
                                  params.direction === 'desc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"
                                ></path>
                              </svg>
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Estado
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Acciones
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                          v-for="user_custom in users_list.data"
                          :key="user_custom.id"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <img
                                  class="h-10 w-10 rounded-full"
                                  :src="user_custom.profile_photo_url"
                                  alt=""
                                />
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ user_custom.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ user_custom.lastname }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ user_custom.email }}
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                            >
                              Activo
                            </span>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <div class="mx-auto flex gap-10">
                              <Link
                                :href="
                                  route('admin.user.show', {
                                    slug: `${user_custom.slug}`,
                                  })
                                "
                              >
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-blue-800 text-white shadow rounded-lg hover:bg-blue-50 hover:text-zinc-300"
                                    >
                                      <div class="relative">
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="h-5 w-5 text-blue-800"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"
                                          ></path>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </Link>

                              <Link
                                :href="
                                  route('admin.user.edit', {
                                    slug: user_custom.slug,
                                  })
                                "
                              >
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-green-500 text-white shadow rounded-lg hover:bg-green-50 hover:text-zinc-300"
                                    >
                                      <div class="relative">
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="h-5 w-5 text-green-500"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </Link>

                              <button
                                @click="
                                  modal_open = true;
                                  selected_user = user_custom;
                                "
                              >
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-red-500 text-white shadow rounded-lg hover:bg-red-50 hover:text-zinc-300"
                                    >
                                      <div class="relative">
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="h-5 w-5 text-red-500"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"
                                          ></path>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </button>
                              <div></div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div
                      v-else
                      class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg"
                    >
                      <p class="text-center text-lg">
                        No existen datos que coincidan con su búsqueda
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <section>
              <pagination
                class="mt-2 mb-6 pl-4 align-center"
                :links="users_list.links"
              />
            </section>
          </div>
        </div>
      </div>
    </section>
    <jet-dialog-modal :show="modal_open">
      <template v-slot:title> Eliminar </template>

      <template v-slot:content>
        <p class="text-lg text-black">
          ¿Está seguro/a de que desea eliminar la cuenta de
          {{ selected_user.name }}
          ?
        </p>
        Una vez la cuenta es eliminada, todos los recursos y los datos asociados
        al usuario se eliminarán de forma permanente. Por favor verifique
        nuevamente su acción pues es irreversible.
      </template>
      <template v-slot:footer>
        <jet-secondary-button @click="closeModal()">
          Cancelar
        </jet-secondary-button>
        <jet-danger-button class="ml-3" @click="deleteUser()">
          Eliminar Usuario
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";

import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import { Inertia } from "@inertiajs/inertia";
import "sweetalert2/dist/sweetalert2.min.css";
import { pickBy, throttle, mapValues } from "lodash";

import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

import TextInput from "@/Components/TextInput";
import SearchFilter from "@/Components/SearchFilter";
import Alert from "@/Components/Alert";

export default defineComponent({
  layout: PrincipalLayout,
  mounted() {
    this.all;
  },

  computed: {
    all() {},
  },

  props: {
    users_list: Object,
    user_custom: Object,
    roles: Object,
    filters: Object,
  },

  components: {
    Link,
    AppLayout,
    Pagination,
    JetDangerButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
    SearchFilter,
    TextInput,
    Alert,
  },

  data() {
    return {
      modal_open: false,
      selected_user: Object,
      type_alert: null,
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
        role: this.filters.role,
      },
    };
  },

  methods: {
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },

    deleteUser: function () {
      Inertia.delete(
        route("admin.user.destroy", { slug: this.selected_user.slug })
      );
      this.modal_open = false;
    },

    closeModal() {
      this.modal_open = false;
    },

    reset() {
      this.params = mapValues(this.params, () => null);
    },
  },
  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);
        this.$inertia.get(this.route("admin.users.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
        });
      }, 150),
      deep: true,
    },
  },
});
</script>
