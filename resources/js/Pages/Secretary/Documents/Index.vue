<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de Documentos en la Compañía
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <section
      class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
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
            Información General de Documentos
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="w-full h-60 object-cover rounded-lg sm:h-52 sm:col-span-2 lg:col-span-full"
            loading="lazy"
          />
        </div>
        <dl
          class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2"
        >
          <dt class="sr-only">Visto</dt>
          <dd class="text-blue-600 flex items-center dark:text-blue-400">
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
              >0.00 <span class="text-slate-400 font-normal">(0)</span></span
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
          La presente plantiflla de información se relaciona a todos los
          documentos que se realizan en el la compañía de las Hijas de la
          Caridad de San Vicente de Paúl.
        </p>
      </div>
    </section>
    <br />
    <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
      <section class="flex-shrink-0">
        <button
          @click="confirmCreateEvent()"
          class="pt-1 pb-1 pl-4 pr-4 m-4 bg-blue-500 border-2 border-blue-500 text-white text-sm rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
        >
          Crear Documento
        </button>
      </section>
    </div>

    <section class="py-1 bg-gray">
      <div class="w-full lg:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <!-- Container Filters -->
            <div class="container mx-auto ml-5">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Filtros de Búsqueda</small
                  >

                  <search-filter
                    v-model="params.search"
                    class="border border-blue-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    @reset="reset"
                  >
                    <small class="block text-gray-700 mt-2"
                      >Tipo de evento:</small
                    >

                    <select
                      v-model="params.type"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todas</option>
                      <option value="1">Comunitario</option>
                      <option value="2">Extracomunitaria</option>
                      <option value="3">Internacional</option>
                      <!-- <option value="4">Extraordinaria</option> -->
                    </select>
                  </search-filter>
                </div>

                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="block text-gray-700">Estado:</small>
                  <Datepicker
                    :format="format"
                    v-model="params.date"
                    monthPicker
                    autoApply
                    :year-range="[1800, this.year]"
                  />
                </div>

                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Exportar Listas</small
                  >
                  <div
                    class="md:text-md flex items-center justify-between p-4 w-full text-sm md:px-12 md:py-0"
                  >
                    <dropdown class="mt-1" placement="bottom-end">
                      <template #default>
                        <div
                          class="group flex items-center cursor-pointer select-none"
                        >
                          <div
                            class="mr-1 text-gray-700 group-hover:text-blue-600 focus:text-blue-600 whitespace-nowrap"
                          >
                            <span
                              class="px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-gray-200 text-gray-800"
                              >&nbsp;Filtros</span
                            >
                          </div>
                          <icon
                            class="w-5 h-5 fill-gray-700 group-hover:fill-blue-600 focus:fill-blue-600"
                            name="cheveron-down"
                          />
                        </div>
                      </template>
                      <template #dropdown>
                        <div
                          class="mt-2 py-2 text-sm bg-white rounded shadow-xl"
                        >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              route('secretary.events.report.pdf', this.params)
                            "
                            >PDF</a
                          >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              route(
                                'secretary.events.export.excel',
                                this.params
                              )
                            "
                            >Excel</a
                          >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              route('secretary.events.export.csv', this.params)
                            "
                            >CSV</a
                          >
                        </div>
                      </template>
                    </dropdown>
                  </div>
                </div>
              </div>
            </div>

            <div class="text-center section px-5 my-3">
              <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                  <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                          <tr>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                            >
                              Name
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                            >
                              Age
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                            >
                              Creator
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase"
                            >
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          <tr v-for="document in this.events" :key="document">
                            <td
                              class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800"
                            >
                              {{ document.name }}
                            </td>
                            <td
                              class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"
                            >
                              {{ document.type }}
                            </td>
                            <td
                              class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"
                            >
                              {{ document.user.name }}
                              {{ document.user.lastname }}
                            </td>
                            <td
                              class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium"
                            >
                              <button @click="confirmUpdateEvent(document)">
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
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </app-layout>

  <!-- Create Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="eventBeingCreated"
    @close="eventBeingCreated == null"
  >
    <template #title> Datos del nuevo documento</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar nombre"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createDocumentForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Tipo Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="mainOptionSelected"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option v-for="option in optionMain" :value="option">
                  {{ option.name }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-12/12 px-2" v-if="mainOptionSelected">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre Tipo de Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="createDocumentForm.type"
                id="option"
                name="option"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option
                  v-for="option in mainOptionSelected.options"
                  :value="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div class="relative w-full px-2">
            <label class="block text-sm font-medium text-gray-700">
              Contenido
            </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.content">
              {{ $page.props.errors.content }}
            </p>

            <quill-editor
              ref="qleditor1"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              v-model:content="this.createDocumentForm.content"
              placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
            ></quill-editor>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.eventBeingCreated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button-success class="ml-3" @click="createEvent">
        Crear
      </jet-button-success>
    </template>
  </jet-dialog-modal>

  <!-- Update Form -->

  <jet-dialog-modal
    :max-width="'input-md'"
    :show="eventBeingUpdated"
    @close="eventBeingUpdated == null"
  >
    <template #title> Datos del Evento</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar nombre"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateEventForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Tipo Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="mainOptionSelected"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option v-for="option in optionMain" :value="option">
                  {{ option.name }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-12/12 px-2" v-if="mainOptionSelected">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre Tipo de Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="updateEventForm.type"
                id="option"
                name="option"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option
                  v-for="option in mainOptionSelected.options"
                  :value="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div class="relative w-full px-2">
            <label class="block text-sm font-medium text-gray-700">
              Contenido
            </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.content">
              {{ $page.props.errors.content }}
            </p>

            <quill-editor
              ref="qleditor1"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
              v-model:content="updateEventForm.content"
              placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
            ></quill-editor>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.eventBeingUpdated = null">
        Cancelar
      </jet-secondary-button>

      <jet-danger-button class="ml-3" @click="deleteEvent">
        Eliminar
      </jet-danger-button>

      <jet-secondary-button class="ml-3" @click="downloadResume">
        Imprimir
      </jet-secondary-button>
      <jet-button-success class="ml-3" @click="updateEvent">
        Actualizar
      </jet-button-success>
    </template>
  </jet-dialog-modal>
</template>

  <script>
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetInputError from "@/Jetstream/InputError.vue";
import SearchFilter from "@/Components/SearchFilter";
import { pickBy, throttle, mapValues } from "lodash";
import Datepicker from "vue3-date-time-picker";
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";
import JetInput from "@/Jetstream/Input.vue";
import Alert from "@/Components/Alert";
import { range } from "moment-range";
import Icon from "@/Components/Icon";
import moment from "moment";
import { ref } from "vue";

export default {
  layout: PrincipalLayout,

  setup() {
    const date = ref(new Date());

    const year = new Date().getFullYear();

    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    return {
      date,
      year,
      format,
    };
  },

  props: {
    events: Object,
    filters: Object,
  },

  components: {
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetInput,
    JetInputError,
    JetButtonSuccess,
    JetSecondaryButton,
    TextInput,
    Alert,
    SearchFilter,
    Datepicker,
    Icon,
    Dropdown,
  },

  mounted() {
    if (this.params.date != null) {
      this.dateMonth = parseInt(this.params.date.month);
      this.dateYear = parseInt(this.params.date.year);
    } else {
      this.dateMonth = new Date().getMonth();
      this.dateYear = new Date().getFullYear();
    }
    this.reloadData;
  },

  computed: {
    reloadData() {
      this.eventsCommunity = [];
      const now = new Date();
      for (var key in this.events) {
        let ob = {};

        var color = "";

        if (this.events[key].type == 1) {
          color = "bg-pink-500 text-white";
        }

        if (this.events[key].type == 2) {
          color = "bg-orange-500 text-white";
        }

        if (this.events[key].type == 3) {
          color = "bg-blue-500 text-white";
        }

        if (this.events[key].type == 4) {
          color = "bg-red-500 text-white";
        }

        const start = new Date(this.events[key].dates);

        const end = new Date(this.events[key].datesEnd);

        for (var dt = start; dt <= end; dt.setDate(dt.getDate() + 1)) {
          const pivote = this.events[key].dates,
            flag = this.events[key].datesEnd;
          let status = 1;

          if (flag == pivote) {
            flag = pivote;
            status = 2;
          }

          ob = {
            key: this.events[key].id,
            customData: {
              id: this.events[key].id,
              description: this.events[key].description,
              type: this.events[key].type,
              dates: this.events[key].dates,
              datesEnd: this.events[key].datesEnd,
              class: color,
              status: status,
            },
            dates: { start: pivote, end: flag },
          };
          this.eventsCommunity.push(ob);
        }
      }
    },
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
        ["clean"],
      ],

      value: [],

      options: [
        { name: "Vue.js", code: "vu" },
        { name: "Javascript", code: "js" },
        { name: "Open Source", code: "os" },
      ],

      masks: {
        weekdays: "WWW",
      },

      dateMonth: Number,

      dateYear: Number,

      params: {
        search: this.filters.search,
        date: this.filters.date,
        type: this.filters.type,
      },

      modelConfig: {
        start: {
          timeAdjust: "00:00:00",
        },
        end: {
          timeAdjust: "23:59:59",
        },
      },

      mainOptionSelected: null,

      optionMain: [
        {
          id: 1,
          name: "Documentos Secretaría",
          options: [
            {
              id: 1,
              idMain: 1,
              name: "INFORME DE VISITA REGULAR",
            },
            { id: 2, idMain: 1, name: "SALIDA DE LA COMPAÑIA" },
            { id: 3, idMain: 1, name: "PARA UNA SALIDA DE LA COMPAÑIA" },
            { id: 4, idMain: 1, name: "PARA UNA NUEVA IMPLANTACION" },
            { id: 5, idMain: 1, name: "MISIÓN AD GENTES – CUESTIONARIO" },
            {
              id: 6,
              idMain: 1,
              name: "CERTIFICADO DE ADMISION EN LA COMPAÑIA",
            },
          ],
        },
        {
          id: 2,
          name: "Documentos para las Hermanas",
          options: [
            { id: 7, idMain: 2, name: "INFORMACION (Estatuto 64b)" },
            {
              id: 8,
              idMain: 2,
              name: "FORMULA RELATIVA A LAS CUESTIONES DE NATURALEZA ECONOMICA",
            },
            { id: 9, idMain: 2, name: "CERTIFICADO DE LA RENOVACION" },
            { id: 10, idMain: 2, name: "INFORMACION ANUAL" },
          ],
        },
        {
          id: 3,
          name: "Permiso Secretaría",
          options: [{ id: 11, idMain: 3, name: "Permiso Normal" }],
        },
      ],

      eventsCommunity: [],

      eventBeingCreated: null,

      createDocumentForm: null,

      eventBeingUpdated: null,

      updateEventForm: this.$inertia.form({
        name: null,
        content: null,
        type: null,
        dates: null,
        datesEnd: null,
      }),

      eventBeingDeleted: null,

      deleteEventForm: this.$inertia.form({
        name: null,
        description: null,
        type: null,
        dates: null,
        datesEnd: null,
      }),
    };
  },

  watch: {
    "form.observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },

    "updateAcademicForm.observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },

    "mainOptionSelected.options": function () {
      //   const quill = this.$refs.qleditor1;
      //   this.createDocumentForm.content = null;
      //   quill.setHTML("");
    },

    "createDocumentForm.type": function () {
      const quill = this.$refs.qleditor1;
      if (this.createDocumentForm.type === 1) {
        this.createDocumentForm.content = `<p><strong>Provincia:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Localidad: </strong></p><p><strong>&nbsp;</strong></p><p><strong>Nombre de la Comunidad local:</strong> </p><p><br></p><p><strong>Dirección completa: </strong></p><p><br></p><p><strong>Teléfono: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>E-mail de la comunidad local:</strong></p><p><br></p><p><strong>VISITA hecha por: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;el&nbsp;&nbsp;</strong></p><p><br></p><p><strong>Fecha de la Última Visita Regular:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>hecha por&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><br></p><p><strong>Fecha de la Última Visita Pastoral</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>por el Padre: </strong></p><p><br></p><p><strong>Fecha de Fundación de la Casa: </strong></p><p><br></p><p><strong>A quién pertenecen los inmuebles</strong></p><p><br></p><p><strong>¿Ha habido adquisiciones desde la última Visita?&nbsp;&nbsp;&nbsp;</strong></p><p><strong>&nbsp;</strong></p><p><strong>¿Alienaciones?&nbsp;&nbsp;&nbsp;</strong></p><p><strong>¿Existen deudas?&nbsp;&nbsp;</strong></p><p><strong>¿Existen litigios?&nbsp;&nbsp;&nbsp;</strong></p><p>&nbsp;</p><p><strong><u>La Hermana Sirviente: &nbsp;&nbsp;&nbsp;&nbsp;</u></strong></p><p><strong>&nbsp;</strong></p><p><strong>Sor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>Nacida el</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>en</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><strong>Fecha de Vocación: </strong></p><p><strong>Hermana Sirviente de esta Comunidad desde el</strong>: </p><p><br></p><p><br></p><p><br></p><p class="ql-align-center"><strong>NOMBRE DE LA COMUNIDAD LOCAL</strong></p><p class="ql-align-center"><strong>&nbsp;ECUADOR</strong></p><p><br></p><p><br></p><p class="ql-align-justify">Por delegación de Sor Nila GÓMEZ AYORA, Visitadora Provincial, yo Sor, Consejera Provincial, realicé la Vista Regular a la comunidad Local de ……. Desde……………………</p><p class="ql-align-justify">La comunidad Local fue fundada el ………………y está constituida por: (por vocación)</p><p class="ql-align-justify">Sor ………………….&nbsp;Hermana Sirviente </p><p class="ql-align-justify">Sor&nbsp;&nbsp;&nbsp;…………………Asistenta local </p><p class="ql-align-justify">Sor …………………… </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Con la presencia de las Hermanas, reunidas en Comunidad, se hizo la <strong>APERTURA</strong> de la Visita Regular, ………….</p><p class="ql-align-justify">Luego se explicó el procedimiento a seguir y los aspectos sobre los cuales se basa la evaluación: ENTREGADAS A DIOS, EN COMUNIDAD DE VIDA FRATERNA Y PARA SERVIR A CRISTO EN LOS POBRES<em>,</em> inmediatamente concretamos el orden para las entrevistas con la finalidad de no interferir en el trabajo.</p><p class="ql-align-justify">Después de la comunicación con cada una de las Hermanas, el personal, el Párroco, la visita por los servicios y revisión de libros de la Comunidad y la Obra, formulo las siguientes <strong>constataciones:</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>OBSERVACIONES</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En la vida espiritual,</strong> </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En la vida comunitaria,</strong> </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En el servicio a los pobres,</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>HERMANA SIRVIENTE:</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Su animación</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sus relaciones</strong></p><p>&nbsp;</p><p class="ql-align-justify"><strong>DOCUMENTOS DE COMUNIDAD Y DE OBRA:</strong> </p><p class="ql-align-justify"><strong>En cuanto al Personal:</strong> </p><p class="ql-align-justify"><strong><u>En lo económico.</u></strong></p><p class="ql-align-justify">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>De la comunidad</u></strong></p><p class="ql-align-justify"><strong><u>&nbsp;</u></strong></p><p class="ql-align-justify">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>De la obra</u></strong><u> </u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>SUGERENCIAS:</strong></p><p class="ql-align-justify"><strong><u>AGRADECIMIENTO</u></strong></p><p><strong>FIRMA:</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 2) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>SALIDA DE LA COMPAÑIA</strong></p><p class="ql-align-justify">Yo, la abajo firmante…………………………………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><strong>Declaro: </strong></p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que me retiro de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, a la que he pertenecido desde el .............. (fecha de admisión) hasta................ (fecha de salida). </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que salgo voluntariamente, antes de hacer los votos / después de haber firmado la dispensa de mis votos / no habiendo renovado mis votos. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-right">En …………………………….. el ………………………………………</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><br></p><p><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>……………………………….</strong></p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad&nbsp;</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 3) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>SALIDA DE LA COMPAÑIA</strong></p><p class="ql-align-justify">Yo, la abajo firmante…………………………………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><strong>Declaro: </strong></p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que me retiro de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, a la que he pertenecido desde el .............. (fecha de admisión) hasta................ (fecha de salida). </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que salgo voluntariamente, antes de hacer los votos / después de haber firmado la dispensa de mis votos / no habiendo renovado mis votos. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-right">En …………………………….. el ………………………………………</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><br></p><p><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>……………………………….</strong></p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad&nbsp;</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 4) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>PARA UNA NUEVA IMPLANTACION </strong></p><p><strong>PROVINCIA: </strong></p><p><br></p><p><strong>Para una apertura en: </strong></p><p><strong>Situación del país </strong></p><ul><li><strong>Situación geográfica y demográfica </strong></li><li><strong>Situación sociológica </strong></li><li><strong>Situación religiosa </strong></li></ul><p class="ql-align-center"><strong>&nbsp;</strong></p><p><strong>Condiciones de la implantación </strong></p><ul><li><strong>¿Quién ha hecho la petición? </strong></li><li><strong>¿Cuál será la misión de las Hermanas? </strong></li><li><strong>Condiciones de vida de la comunidad: </strong></li></ul><p class="ql-indent-2"><strong>Número de Hermanas: </strong></p><p class="ql-indent-2"><strong>Alojamiento de las Hermanas: </strong></p><p class="ql-indent-2"><strong>Situación financiera: </strong></p><p class="ql-indent-2"><strong>Asistencia espiritual: </strong></p><ul><li><strong>Autorización del Ordinario del lugar (por escrito) </strong></li><li><strong>Ficha de Consejo&nbsp;</strong></li></ul>`;
      } else if (this.createDocumentForm.type === 5) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>MISIÓN AD GENTES – CUESTIONARIO</strong></p><p><strong>PROVINCIA:</strong></p><p><strong>Hermana:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comunidad Local:</strong></p><p><strong>Fecha de nacimiento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Vocación</strong></p><p><strong>Ha pedido la Misión Ad Gentes a la Superiora General.</strong></p><p class="ql-align-center"><strong><u>Informaciones pedidas a la Visitadora y a su Consejo</u></strong></p><p><strong>1.- Sobre las diferentes dimensiones de la vida de esta Hermana:</strong></p><p><strong>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimisión Humana (salud – equilibrio afectivo y psicológico, capacidad de adaptación, vida de relación)</strong></p><p><strong>&nbsp;</strong></p><p><strong>b)&nbsp;&nbsp;&nbsp;&nbsp;Dimisión espiritual (espiritual de fe – vida de oración – sentido eclesial…)</strong></p><p><strong>………………………………………………………………….</strong></p><p><strong>&nbsp;</strong></p><p><strong>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimensión comunitaria (interés por el bien común: participación – actitud para compartir – adaptación – capacitación de la diversidad…)</strong></p><p><strong>……………………………………………………………………………………………………</strong></p><p><strong>d)&nbsp;&nbsp;&nbsp;&nbsp;Dimensión apostólica (capacitación de colaboración – preparación profesional – conocimiento de lenguas o capacidad para aprenderlas…, experiencias en el servicio de los pobres) </strong></p><p><strong>……………………………………………………………………………………………………………………………………..</strong></p><p><strong>&nbsp;</strong></p><p><strong>e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¿ha recibido ya una preparación misionera?</strong></p><p><strong>…………………………………………………………………………………………………………………………………………………………………………………………………….</strong></p><p><strong>2.- Opinión de la Visitadora con su Consejo</strong></p><p><strong>Positivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motivaciones:</strong></p><p><strong>Negativo: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motivacioens:</strong></p><p><strong>3.- En caso de ser aceptada para la Misión, ¿Cuánto tiempo será necesario para liberar a la Hermana?</strong></p><p><br></p><p><strong>Fecha: </strong></p><p><br></p><p><br></p><p class="ql-align-center">……………………………….</p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad</strong></p><p><br></p><p><br></p><p class="ql-align-center"><strong> &nbsp;</strong></p>`;
      } else if (this.createDocumentForm.type === 6) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>CERTIFICADO DE ADMISION EN LA COMPAÑIA</strong></p><p>&nbsp;</p><p class="ql-align-justify">Dirección </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">El ………………………………………………………………………………….(fecha)</p><p class="ql-align-justify">Nombre</p><p class="ql-align-justify">…………………………………………………………………………………..</p><p class="ql-align-justify">Dirección </p><p class="ql-align-justify">…………………………………………………………………………………..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Ha sido admitida como miembro de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, en la Provincia de ………………………………………………………………</p><p class="ql-align-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p class="ql-align-center">Sor Nila GOMEZ A.</p><p class="ql-align-center"><strong>HIJA DE LA CARIDAD</strong></p><p class="ql-align-center"><strong>VISITADORA PROVINCIAL</strong></p><p><br></p>`;
      }
      //
      else if (this.createDocumentForm.type === 7) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>INFORMACION (Estatuto 64b)</strong></p><p class="ql-align-justify">Provincia: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año 20...... </p><p class="ql-align-justify">Sor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comunidad local: </p><p class="ql-align-justify">Fecha de nacimiento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de vocación: </p><p class="ql-align-justify">Formación realizada durante los últimos 5 años: - </p><p class="ql-align-justify">Salud (intervenciones quirúrgicas, enfermedades): </p><p class="ql-align-justify"><strong>Aspectos positivos del crecimiento de la Hermana en el espíritu de la Compañía (vida espiritual, vida comunitaria, vida de servicio...) </strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify">Dificultades principales: </p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><img src="//:0" height="2" width="160"></p><p class="ql-align-justify"><img src="//:0" height="2" width="160"></p><p class="ql-align-justify">Otras observaciones: </p><p><strong>Firma de la Hermana Sirviente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma de la Hermana</strong></p>`;
      } else if (this.createDocumentForm.type === 8) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>FORMULA RELATIVA A LAS CUESTIONES DE NATURALEZA ECONOMICA</strong></p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Teniendo en cuenta mi ADMISION como MIEMBRO de la Compañía de las Hijas de la Caridad de San Vicente de Paúl. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Yo (nombre) ……………………………………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">DECLARO que cualquier cantidad de dinero o donación, sea cual fuere el origen, resultante de los servicios por mi realizados, pertenecen a las Hijas de la Caridad y que no haré ninguna reclamación a la Compañía (cf. C. 300) </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Testigos: </p><p class="ql-align-justify">……………………………………………………………………………………………………………………………………………………………………………………..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-center">Sor……………..</p><p class="ql-align-center"><strong>HIJA DE LA CARIDAD</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 9) {
        this.createDocumentForm.content = `<h2 class="ql-align-center"><strong>CERTIFICADO DE LA RENOVACION</strong></h2><p class="ql-align-center"><strong>&nbsp;</strong></p><p class="ql-align-justify">Yo </p><p class="ql-align-justify">………………………………………….</p><p class="ql-align-justify">CERTIFICO haber renovado los Votos en la Compañía de las Hijas de la Caridad, en la fiesta de la Anunciación el … de …… del 20..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Firma:</p><p class="ql-align-justify"><br></p><p class="ql-align-center"><strong>………………………</strong></p><p><br></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 10) {
        this.createDocumentForm.content = `<h2 class="ql-align-center"><strong>INFORMACION ANUAL</strong></h2><p class="ql-align-center"><br></p><p><strong>Sor (Apellidos y nombre): ………………………….</strong></p><p><br></p><p><strong>Fecha y lugar de nacimiento: ……………………..</strong></p><p><br></p><p><strong>Nacionalidad: ……………………………..</strong></p><p><br></p><p><strong>Fecha de vocación: ……………………….</strong></p><p><br></p><p><strong>Nombre de la Comunidad: ………………</strong></p><p><br></p><p><strong>Dirección: …………………..</strong></p><p><br></p><h2 class="ql-align-center"><strong>INFORMACION CORRESPONDIENTE AL PERIODO 20...</strong></h2><p class="ql-align-center"><br></p><p><strong>Cultura (Titulos, diplomas)</strong></p><p><strong>……………………</strong></p><p><strong>……………………</strong></p><p><strong>Actividades</strong></p><p><strong>……………………</strong></p><p><strong>……………………</strong></p><p><strong>&nbsp;</strong></p><p><strong>Salud (enfermedades, operaciones, estado habitual)</strong></p><p><strong>...............</strong></p><p><strong>&nbsp;</strong></p><p class="ql-align-justify">«El espíritu de vuestra Compañía, Hermanas mías, consiste en el amor de Nuestro Señor, el amor a los pobres, el amor entre vosotras, la humildad y la sencillez» </p><p class="ql-align-right">(San Vicente, 9-2-1653) </p><p class="ql-align-right">&nbsp;</p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aspectos positivos del crecimiento de la Hermana en el espíritu de la Compañía (vida espiritual, vida comunitaria, vida de servicio …) </strong></p><p><strong>&nbsp;</strong></p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;II.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dificultades principales </strong></p><p><strong>&nbsp;</strong></p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;III.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Otras observaciones </strong></p><p><strong>&nbsp;</strong></p><p><br></p><p>  --------------------------------------													-------------------------------------  &nbsp;</p><p>Firma de la Hermana Sirviente: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma de la Hermana:</p>`;
      } else {
        this.createDocumentForm.content = null;
        quill.setHTML("");
      }
    },

    dataTransfer: function () {},

    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);
        if (params.date != null) {
          this.dateMonth = params.date.month;
          this.dateYear = params.date.year;
        } else {
          this.dateMonth = new Date().getMonth();
          this.dateYear = new Date().getFullYear();
        }
        this.$inertia.get(this.route("secretary.documents.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.reloadData;
          },
        });
      }, 1),
      deep: true,
    },
  },

  methods: {
    miDato() {},

    showDay(day) {},

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatShowDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    reset() {
      this.params = mapValues(this.params, () => null);
    },

    listEvent(day) {},

    confirmCreateEvent() {
      this.createDocumentForm = this.$inertia.form({
        name: null,
        content: null,
        type: null,
      });
      this.eventBeingCreated = this.createDocumentForm;
    },

    createEvent() {
      this.createDocumentForm.post(this.route("secretary.documents.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.eventBeingCreated = null;
          this.reloadData;
        },
      });
    },

    confirmUpdateEvent(event) {
      this.updateEventForm.name = event.name;
      this.updateEventForm.content = event.content;
      this.updateEventForm.type = event.type;
      let pivoteB;

      for (let i = 0; i < this.optionMain.length; i++) {
        const element = this.optionMain[i].options;
        for (let j = 0; j < element.length; j++) {
          const inside = element[j];
          if (parseInt(event.type) === inside.id) {
            pivoteB = this.optionMain[i];
            break;
          }
        }
      }

      this.mainOptionSelected = pivoteB;

      this.eventBeingUpdated = event;
    },

    downloadResume() {
      window.open(
        route(
          "secretary.documents.report.pdf",
          {
            event_id: this.eventBeingUpdated.id,
          },
          "one"
        )
      );


    },

    updateEvent() {
      this.updateEventForm.put(
        this.route("secretary.documents.update", {
          event_id: this.eventBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            this.eventBeingUpdated = null;
            setTimeout(() => {
              this.reloadData;
            }, 2);
          },
        }
      );
    },

    deleteEvent() {
      this.updateEventForm.get(
        this.route("secretary.documents.delete", {
          event_id: this.eventBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            this.eventBeingUpdated = null;
            setTimeout(() => {
              this.reloadData;
            }, 2);
          },
        }
      );
    },

    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.value.push(tag);
    },
  },
};
</script>

  <style>
.custom-calendar.vc-container {
  --day-border: 1px solid #b8c2cc;
  --day-border-highlight: 1px solid #b8c2cc;
  --day-width: 90px;
  --day-height: 90px;
  --weekday-bg: #ebebeb;
  --weekday-border: 1px solid #eaeaea;
  border-radius: 5px;
  width: 100%;
}

.custom-calendar.vc-container .vc-header {
  background-color: #f1f5f8;
  /* visibility: hidden; */
}
.custom-calendar.vc-container .vc-arrows-container {
  background-color: #f1f5f8;
  visibility: hidden;
}
.custom-calendar.vc-container .vc-weeks {
  padding: 0;
}
.custom-calendar.vc-container .vc-weekday {
  background-color: var(--weekday-bg);
  border-bottom: var(--weekday-border);
  border-top: var(--weekday-border);
  padding: 5px 0;
}
.custom-calendar.vc-container .vc-day {
  border-style: solid;
  text-align: center;
  background-color: white;
}
.custom-calendar.vc-container .vc-day-dots {
  margin-bottom: 5px;
}
</style>
