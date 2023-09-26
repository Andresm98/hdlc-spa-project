<template>
  <app-layout>
    <div v-if="$page.props.flash != null">
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
    </div>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Información Personal del Perfil de la Hermana
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenida Hermana: {{ $page.props.user.name }}
        {{ $page.props.user.lastname }}
      </div>
    </template>
    <operation></operation>
    <div class="my-2 md:m-2 lg:m-4 xl:m-5 md:p-2 lg:p-4 rounded-md bg-gray-50">
      <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Estado de Salud
              </h3>
              <p class="mt-1 text-sm text-gray-600 text-justify">
                La información que puede visualizar se relacionan a la
                información de sus registros de salud, tenga en cuenta que los
                datos deben mantener los formatos solicitados. La información
                recopila todos los registros del historial médico de su perfil,
                en este apartado podrá detallar la información requerida por la
                compañía HDCL.
              </p>
            </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <section
              class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 rounded-lg sm:m-2 lg:m-3 md:m-4"
            >
              <div
                class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
              >
                <div
                  class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 lg:row-start-1"
                >
                  <h1
                    class="mt-1 text-lg font-semibold text-black sm:text-black md:text-2xl dark:sm:text-white"
                  >
                    Provincia Ecuador
                  </h1>
                  <p
                    class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
                  >
                    Información General de la Hermana
                  </p>
                </div>
                <div class="grid gap-4"></div>
                <dl
                  class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2"
                >
                  <dt class="sr-only">Visto</dt>
                  <dd
                    class="text-indigo-600 flex items-center dark:text-indigo-400"
                  >
                    <svg
                      width="24"
                      height="24"
                      fill="none"
                      aria-hidden="true"
                      class="mr-1 stroke-current dark:stroke-blue-100"
                    >
                      <path
                        d="m12 5 2 5h5l-4 4 2.103 5L12 16l-5.103 3L9 14l-4-4h5l2-5Z"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <span
                      >0.00
                      <span class="text-slate-400 font-normal">(0)</span></span
                    >
                  </dd>
                  <dt class="sr-only">Ubicación por defecto - Ecuador</dt>
                  <dd class="flex items-center">
                    <svg
                      width="2"
                      height="2"
                      aria-hidden="true"
                      fill="currentColor"
                      class="mx-3 text-white"
                    >
                      <circle cx="1" cy="1" r="1" />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="mr-1 text-black dark:text-white"
                      aria-hidden="true"
                    >
                      <path
                        d="M18 11.034C18 14.897 12 19 12 19s-6-4.103-6-7.966C6 7.655 8.819 5 12 5s6 2.655 6 6.034Z"
                      />
                      <path d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                    </svg>
                    <p class="text-black dark:text-white">Quito, Ecuador</p>
                  </dd>
                </dl>
              </div>
              <div class="mt-2">
                <p class="text-black dark:text-white">
                  La presente plantilla de información se relaciona a la
                  información el historial médico, por favor tenga en cuenta que
                  si desea ingresar un nuevo registro debe dar clic en el botón
                  de color verde. Una vez ingresada la información requerida
                  avance al pie de página y oprima el botón (Guardar). En caso
                  de que requiera actualizar algún registro, por favor oprima el
                  ícono de un lápiz en la parte derecha de cada registro.
                </p>
              </div>
            </section>
            <div class="content-center mt-2">
              <jet-button-success
                @click="confirmationHealthCreate()"
                class="block mx-2 p-5 leading-normal"
                >¿Desea ingresar un nuevo registro?</jet-button-success
              >
            </div>
            <!-- Container Filters -->
            <div class="container mx-auto">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Fecha de Registro</small
                  >
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.dateStart"
                  >
                    {{ $page.props.errors.dateStart }}
                  </p>
                  <Datepicker
                    v-model="params.dateStart"
                    :format="format"
                    autoApply
                    required
                  />
                  <small class="justify-content-center ml-6"
                    >Deste - Hasta</small
                  >
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.dateEnd"
                  >
                    {{ $page.props.errors.dateEnd }}
                  </p>
                  <Datepicker
                    v-model="params.dateEnd"
                    :format="format"
                    autoApply
                    required
                  />
                </div>
              </div>
            </div>
            <!-- End container Filters -->
            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="health_list.links" />
            </section>
            <small class="ml-6">
              Se encontraron {{ health_list.total }} registros de salud.</small
            >
            <div class="py-2">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                  >
                    <table
                      v-if="health_list.data.length > 0"
                      class="min-w-full divide-y divide-gray-200"
                    >
                      <thead class="bg-yellow-200">
                        <tr>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between"
                              >Fecha
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between"
                              >Estado de Salud
                            </span>
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
                        <tr v-for="health in health_list.data" :key="health.id">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <span
                                class="px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-blue-100 text-blue-800"
                              >
                                {{ this.formatShowDate(health.consult_date) }}
                              </span>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-6/8 ...">
                              <div
                                class="p-2 whitespace-normal text-sm font-semibold rounded-sm bg-cyan-100 text-cyan-800"
                              >
                                <p v-html="health.actual_health"></p>
                              </div>
                            </div>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <div class="mx-auto flex gap-10">
                              <button @click="confirmationHealthUpdate(health)">
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
                              </button>

                              <button
                                @click="
                                  modal_open = true;
                                  selected_health = health;
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
                        No exisen datos que coincidan con su búsqueda
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="health_list.links" />
            </section>
          </div>
        </div>
      </div>
      <jet-dialog-modal :show="modal_open">
        <template v-slot:title> Eliminar </template>
        <template v-slot:content>
          <p class="text-lg text-black">
            ¿Está seguro/a de que desea eliminar el registro de salud?
          </p>
          Una vez el historial de salud es eliminado no puede ser recuperado.
          Por favor verifique que la información antes de confirmar su
          eliminación.
        </template>
        <template v-slot:footer>
          <jet-secondary-button @click="closeModal()">
            Cancelar
          </jet-secondary-button>
          <jet-danger-button class="ml-3" @click="deleteHealth()">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-dialog-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="healthBeingUpdated"
        @close="healthBeingUpdated == null"
      >
        <template #title> Datos de Registro de Salud</template>
        <template #content>
          <label
            class="block text-sm font-medium text-black"
            htmlfor="grid-password"
          >
            Estado de Salud Actual:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.actual_health"
          >
            {{ $page.props.errors.actual_health }}
          </p>
          <small
            >Formato: Estado de salud actual de la Hermana, deberá ingresar
            máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qlupdateditor1"
              v-model:content="updateHealthForm.actual_health"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <label
            class="mt-2 block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Enfermedades Crónicas:
          </label>
          <p
            class="text-red-500 text-sm"
            v-show="$page.props.errors.chronic_diseases"
          >
            {{ $page.props.errors.chronic_diseases }}
          </p>
          <small
            >Formato: Detallar las enfermedades crónicas que presenta la
            Hermana, deberá ingresar máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qlupdateditor2"
              v-model:content="updateHealthForm.chronic_diseases"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <label
            class="mt-2 block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Otros Problemas de Salud:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.other_health_problems"
          >
            {{ $page.props.errors.other_health_problems }}
          </p>
          <small
            >Formato: Detallar los otros problemas de salud que presenta la
            hermana, deberá ingresar máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qlupdateditor3"
              v-model:content="updateHealthForm.other_health_problems"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-2/4 mt-2">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Ingreso:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.consult_date"
                >
                  {{ $page.props.errors.consult_date }}
                </p>
                <small>Formato: Fecha del día de registro.</small>
                <Datepicker
                  v-model="updateHealthForm.consult_date"
                  :format="format"
                  autoApply
                  required
                />
              </div>
            </div>
          </div>
        </template>
        <template #footer>
          <jet-secondary-button @click="healthBeingUpdated = null">
            Cancelar
          </jet-secondary-button>
          <jet-button-success class="ml-3" @click="updateHealthStatus">
            Actualizar
          </jet-button-success>
        </template>
      </jet-dialog-modal>
      <jet-dialog-modal
        :max-width="'input-md'"
        :show="healthBeingCreated"
        @close="healthBeingCreated == null"
      >
        <template #title> Datos del Nuevo Registro de Salud</template>
        <template #content>
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Estado de Salud Actual:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.actual_health"
          >
            {{ $page.props.errors.actual_health }}
          </p>
          <small
            >Formato: Estado de salud actual de la Hermana, deberá ingresar
            máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qleditor1"
              v-model:content="form.actual_health"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <label
            class="mt-2 block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Enfermedades Crónicas:
          </label>
          <p
            class="text-red-500 text-sm"
            v-show="$page.props.errors.chronic_diseases"
          >
            {{ $page.props.errors.chronic_diseases }}
          </p>
          <small
            >Formato: Detallar las enfermedades crónicas que presenta la
            Hermana, deberá ingresar máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qleditor2"
              v-model:content="form.chronic_diseases"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <label
            class="mt-2 block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Otros Problemas de Salud:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.other_health_problems"
          >
            {{ $page.props.errors.other_health_problems }}
          </p>
          <small
            >Formato: Detallar los otros problemas de salud que presenta la
            Hermana, deberá ingresar máximo 4000 caracteres.</small
          >
          <div class="bg-white">
            <quill-editor
              ref="qleditor3"
              v-model:content="form.other_health_problems"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              placeholder="Ingresar los datos solicitados..."
            ></quill-editor>
          </div>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-2/4 mt-2">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Ingreso:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.consult_date"
                >
                  {{ $page.props.errors.consult_date }}
                </p>
                <small>Formato: Fecha del día de registro.</small>
                <Datepicker
                  v-model="form.consult_date"
                  :format="format"
                  autoApply
                  required
                />
              </div>
            </div>
          </div>
        </template>
        <template #footer>
          <jet-secondary-button
            @click="
              healthBeingCreated = null;
              form = null;
            "
          >
            Cancelar
          </jet-secondary-button>
          <jet-button-success class="ml-3" @click="createHealthStatus">
            Crear
          </jet-button-success>
        </template>
      </jet-dialog-modal>
      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { pickBy, throttle, mapValues } from "lodash";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Datepicker from "vue3-date-time-picker";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Operation from "@/Components/Daughter/Operation";
import TextInput from "@/Components/TextInput";
import SearchFilter from "@/Components/SearchFilter";
import Dropdown from "@/Components/Dropdown";
import { Inertia } from "@inertiajs/inertia";
import JetButton from "@/Jetstream/Button";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import { range } from "moment-range";
import moment from "moment";
import { ref } from "vue";

export default {
  props: {
    daughter: null,
    errors: null,
    image: null,
    address: Object,
    health_list: Object,
    filters: Object,
    provinces: {
      type: Array,
    },
  },
  setup() {
    const formatSet = "YYYY-MM-DD";
    let date = new Date();
    var format = (date) => {
      return moment(date).format(formatSet);
    };
    return {
      date,
      format,
    };
  },
  data() {
    return {
      toolbarOptions: [
        ["bold", "italic", "underline", "strike"], // toggled buttons
        ["blockquote", "code-block"],

        [{ header: 1 }, { header: 2 }], // custom button values
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ direction: "rtl" }], // text direction

        [{ size: ["small", false, "large", "huge"] }], // custom dropdown
        [{ header: [1, 2, 3, 4, 5, 6, false] }],

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ font: [] }],
        [{ align: [] }],

        ["clean"], // remove formatting button
      ],
      modal_open: false,
      selected_health: Object,
      params: {
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
        perPage: this.filters.perPage,
      },
      healthBeingCreated: null,
      form: null,
      healthBeingUpdated: null,
      updateHealthForm: this.$inertia.form({
        consult_date: null,
        actual_health: null,
        chronic_diseases: null,
        other_health_problems: null,
      }),
    };
  },
  watch: {
    "form.actual_health": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "form.chronic_diseases": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor2;
      if (quill.getHTML().length <= limit) {
        this.data_intput_two = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_two);
      }
    },
    "form.other_health_problems": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor3;
      if (quill.getHTML().length <= limit) {
        this.data_intput_three = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_three);
      }
    },
    "updateHealthForm.actual_health": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor1;

      if (this.updateHealthForm.actual_health.length <= limit) {
        this.data_intput_one = this.updateHealthForm.actual_health;
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateHealthForm.chronic_diseases": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor2;
      if (this.updateHealthForm.chronic_diseases.length <= limit) {
        this.data_intput_two = this.updateHealthForm.chronic_diseases;
      } else {
        quill.setHTML(this.data_intput_two);
      }
    },
    "updateHealthForm.other_health_problems": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor3;
      if (this.updateHealthForm.other_health_problems.length <= limit) {
        this.data_intput_three = this.updateHealthForm.other_health_problems;
      } else {
        quill.setHTML(this.data_intput_three);
      }
    },
    params: {
      handler: throttle(function () {
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }
        let params = pickBy(this.params);
        this.$inertia.get(this.route("daughter.health.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
        });
      }, 10),
      deep: true,
    },
  },
  components: {
    Datepicker,
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetInput,
    JetInputError,
    JetButtonSuccess,
    JetButton,
    JetSecondaryButton,
    TextInput,
    Alert,
    SearchFilter,
    Icon,
    Dropdown,
    Link,
    Pagination,
    Operation,
    ref,
  },
  methods: {
    formatDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
      }
      return null;
    },
    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return null;
    },
    confirmationHealthCreate() {
      this.form = this.$inertia.form({
        consult_date: null,
        actual_health: null,
        chronic_diseases: null,
        other_health_problems: null,
      });
      this.healthBeingCreated = this.form;
    },
    createHealthStatus() {
      if (this.form.consult_date != null) {
        this.form.consult_date = this.formatDate(this.form.consult_date);
      }
      this.form.post(
        this.route("daughter.health.store", {
          user_id: this.daughter.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.healthBeingCreated = null;
            this.form = null;
            setTimeout(() => {}, 100);
          },
        }
      );
    },
    confirmationHealthUpdate(health) {
      this.updateHealthForm.consult_date = health.consult_date;
      this.updateHealthForm.actual_health = health.actual_health;
      this.updateHealthForm.chronic_diseases = health.chronic_diseases;
      this.updateHealthForm.other_health_problems =
        health.other_health_problems;
      this.healthBeingUpdated = health;
    },
    updateHealthStatus() {
      if (this.updateHealthForm.consult_date != null) {
        this.updateHealthForm.consult_date = this.formatDate(
          this.updateHealthForm.consult_date
        );
      }
      this.updateHealthForm.put(
        this.route("daughter.health.update", {
          user_id: this.daughter.id,
          health_id: this.healthBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.healthBeingUpdated = null;
            setTimeout(() => {}, 100);
          },
        }
      );
    },
    closeModal() {
      this.modal_open = false;
    },
    deleteHealth: function () {
      Inertia.delete(
        this.route("daughter.health.delete", {
          user_id: this.daughter.id,
          health_id: this.selected_health.id,
        })
      );
      this.modal_open = false;
    },
  },
  computed: {},
};
</script>
