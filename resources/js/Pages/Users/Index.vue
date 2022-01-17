<template>
  <app-layout title="Admin Sistema">
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Usuarios
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template> -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="
                shadow
                overflow-hidden
                border-b border-gray-200
                sm:rounded-lg
              "
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
                :href="route('admin.users.create')"
                class="
                  pt-12
                  pb-1
                  pl-4
                  pr-4
                  bg-blue-500
                  border-2 border-blue-500
                  text-white text-sm
                  rounded-lg
                  hover:bg-blue-500 hover:text-gray-100
                  focus:border-4 focus:border-blue-300

                "
                >Crear usuarios</Link
              >

              <section class="pl-4">
                <pagination class="mt-6 mb-5" :links="usersList.links" />
              </section>

              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Identificador
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Nombre
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Correo
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Estado
                    </th>
                    <!-- <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th> -->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="userCustom in usersList.data" :key="userCustom.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img
                            class="h-10 w-10 rounded-full"
                            :src="userCustom.profile_photo_url"
                            alt=""
                          />
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ userCustom.name }}
                          </div>
                          <div class="text-sm text-gray-500">
                            {{ userCustom.email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">
                        Hijas de la Caridad San V. Paúl
                      </div>
                      <div class="text-sm text-gray-500">Ecuador</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="
                          px-2
                          inline-flex
                          text-xs
                          leading-5
                          font-semibold
                          rounded-full
                          bg-green-100
                          text-green-800
                        "
                      >
                        Activo
                      </span>
                    </td>
                    <!-- <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      Admin
                    </td> -->
                    <td
                      class="
                        px-3
                        py-4
                        whitespace-nowrap
                        text-right text-sm
                        font-medium
                      "
                    >
                      <!-- Componentes -->

                      <div class="mx-auto flex gap-10">

                        <!-- Observar -->
                        <Link
                          :href="
                            route('admin.users.show', {
                              userCustom: userCustom.id,
                            })
                          "
                        >
                          <div class="w-auto h-auto">
                            <div class="flex-1 h-full">
                              <div
                                class="
                                  flex
                                  items-center
                                  justify-center
                                  flex-1
                                  h-full
                                  p-2
                                  border border-blue-800
                                  text-white
                                  shadow
                                  rounded-lg
                                  hover:bg-blue-50 hover:text-zinc-300
                                "
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

                        <!-- Editar -->

                        <Link
                          :href="
                            route('admin.users.edit', {
                              userCustom: userCustom.id,
                            })
                          "
                        >
                          <div class="w-auto h-auto">
                            <div class="flex-1 h-full">
                              <div
                                class="
                                  flex
                                  items-center
                                  justify-center
                                  flex-1
                                  h-full
                                  p-2
                                  border border-green-500
                                  text-white
                                  shadow
                                  rounded-lg
                                  hover:bg-green-50 hover:text-zinc-300
                                "
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

                        <!-- Eliminar -->
                        <button
                          @click="
                            modalOpen = true;
                            selectedUser = userCustom;
                          "
                        >
                          <div class="w-auto h-auto">
                            <div class="flex-1 h-full">
                              <div
                                class="
                                  flex
                                  items-center
                                  justify-center
                                  flex-1
                                  h-full
                                  p-2
                                  border border-red-500
                                  text-white
                                  shadow
                                  rounded-lg
                                  hover:bg-red-50 hover:text-zinc-300
                                "
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

                        <!-- Delete Account Confirmation Modal -->
                        <jet-dialog-modal :show="modalOpen">
                          <template v-slot:title> Eliminar </template>

                          <template v-slot:content>
                            <p class="text-lg text-blue-700">
                              ¿Está seguro/a de que desea eliminar la cuenta de
                              {{ selectedUser.name }} ?
                            </p>
                            Una vez la cuenta es eliminada, todos sus recursos y
                            los datos se eliminarán de forma permanente. Por
                            favor verifique nuevamente su acción pues es
                            irreversible.
                          </template>

                          <template v-slot:footer>
                            <jet-secondary-button @click="closeModal()">
                              Cancelar
                            </jet-secondary-button>

                            <jet-danger-button
                              class="ml-3"
                              @click="deleteUser()"
                            >
                              Eliminar Usuario
                            </jet-danger-button>
                          </template>
                        </jet-dialog-modal>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

              <section>
                <pagination
                  class="mt-2 mb-6 pl-4 align-center"
                  :links="usersList.links"
                />
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>


<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import { Inertia } from "@inertiajs/inertia";

import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

import TextInput from "@/Components/TextInput";
import SelectInput from "@/Components/SelectInput";
import LoadingButton from "@/Components/LoadingButton";
import TrashedMessage from "@/Components/TrashedMessage";
import Alert from "@/Components/Alert";

import "sweetalert2/dist/sweetalert2.min.css";

export default defineComponent({
  props: {
    usersList: Object,
    userCustom: Object,
  },

  components: {
    AppLayout,
    Link,
    Pagination,
    JetActionSection,
    JetDangerButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    Alert,
  },

  data() {
    return {
      modalOpen: false,
      selectedUser: Object,
      type_alert: null,
    };
  },
  methods: {
    deleteUser: function () {
      Inertia.delete(
        route("admin.users.destroy", { userCustom: this.selectedUser })
      );
      this.modalOpen = false;
    //   window.location.reload();
    },
    closeModal() {
      this.modalOpen = false;
    },
  },
});
</script>
