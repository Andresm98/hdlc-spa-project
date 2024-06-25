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
    <section
      class="bg-blue-100 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
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
        ></div>
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
          La presente plantilla de información se relaciona a todos los
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
                      <option
                        v-for="option in this.filterOptions"
                        :value="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                  </search-filter>
                </div>

                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Rangos de Fechas</small
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
                    :year-range="[1800, this.year]"
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
                    :year-range="[1800, this.year]"
                  />
                </div>
              </div>
            </div>

            <div class="text-center section px-5 my-3">
              <div class="flex flex-col">
                <section class="pl-4">
                  <pagination class="mt-6 mb-5" :links="events.links" />
                </section>
                <div class="-m-1.5 overflow-x-auto">
                  <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-200">
                          <tr>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-sm font-bold text-black uppercase"
                            >
                              Nombre Documento
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-sm font-bold text-black uppercase"
                            >
                              Tipo Documento
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-start text-sm font-bold text-black uppercase"
                            >
                              Fecha Creación y Actualización
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-end text-sm font-bold text-black uppercase"
                            >
                              Operaciones
                            </th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                          <tr
                            v-for="document in this.events.data"
                            :key="document"
                          >
                            <td
                              class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-800"
                            >
                              {{ document.name }}
                              <br />
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-sm bg-lime-100 text-lime-800"
                              >
                                {{ document.user.name }}
                                {{ document.user.lastname }}
                              </span>
                            </td>
                            <td
                              class="px-6 py-4 whitespace-nowrap text-lg text-gray-800"
                            >
                              {{ showDocumentType(document.type) }}
                              {{ document.type }}
                            </td>
                            <td
                              class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"
                            >
                              {{ formatShowDate(document.created_at) }} -
                              {{ formatShowDate(document.updated_at) }}
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
                <section class="pl-4">
                  <pagination class="mt-6 mb-5" :links="events.links" />
                </section>
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
                Nombre Documento:
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
              ref="qleditor0"
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
      <jet-secondary-button @click="cancelCreate">
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
    :show="documentBeingUpdated"
    @close="documentBeingUpdated == null"
  >
    <template #title> Datos del Evento</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre Documento:
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
                v-model="updateDocumentForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="read-only">
              <label class="block text-sm font-medium text-gray-700">
                Tipo Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                disabled
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
            <div class="read-only">
              <label class="block text-sm font-medium text-gray-700">
                Nombre Tipo de Documento:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                disabled
                v-model="updateDocumentForm.type"
                id="option"
                name="option"
                autocomplete="article-material"
                class="select-none mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
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
              v-model:content="updateDocumentForm.content"
              placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
            ></quill-editor>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.documentBeingUpdated = null">
        Cerrar
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
import Pagination from "@/Components/Pagination";
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
    Pagination,
  },

  mounted() {
    this.reloadData;
    this.loadAllOptions;
  },

  computed: {
    reloadData() {},

    loadAllOptions() {
      for (let i = 0; i < this.optionMain.length; i++) {
        const element = this.optionMain[i].options;
        for (let j = 0; j < element.length; j++) {
          const inside = element[j];
          this.filterOptions.push(inside);
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
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
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
            { id: 3, idMain: 1, name: "PARA UNA SALIDA DE LA COMPAÑIA PT1" },
            { id: 4, idMain: 1, name: "PARA UNA SALIDA DE LA COMPAÑIA PT2" },
            { id: 5, idMain: 1, name: "PARA UNA NUEVA IMPLANTACION" },
            { id: 6, idMain: 1, name: "MISIÓN AD GENTES – CUESTIONARIO" },
            {
              id: 7,
              idMain: 1,
              name: "CERTIFICADO DE ADMISIÓN EN LA COMPAÑIA",
            },
            { id: 11, idMain: 2, name: "PERMISO NORMAL" },
            { id: 12, idMain: 2, name: "REVISIÓN TÉCNICA VEHICULAR" },
          ],
        },
        {
          id: 2,
          name: "Documentos para las Hermanas",
          options: [
            { id: 8, idMain: 2, name: "INFORMACION (Estatuto 64b)" },
            {
              id: 9,
              idMain: 2,
              name: "FORMULA RELATIVA A LAS CUESTIONES DE NATURALEZA ECONOMICA",
            },
            { id: 10, idMain: 2, name: "CERTIFICADO DE LA RENOVACION" },
            { id: 13, idMain: 2, name: "INFORMACIÓN ANUAL" },
          ],
        },
      ],

      eventsCommunity: [],

      eventBeingCreated: null,

      createDocumentForm: this.$inertia.form({
        name: null,
        content: null,
        type: null,
      }),

      documentBeingUpdated: null,

      updateDocumentForm: this.$inertia.form({
        name: null,
        content: null,
        type: null,
        dates: null,
        datesEnd: null,
      }),

      filterOptions: [],
    };
  },

  watch: {
    "createDocumentForm.content": function () {
      var limit = 40000;
      const quill = this.$refs.qleditor0;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },

    "updateAcademicForm.content": function () {
      var limit = 40000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },

    "mainOptionSelected.options": function () {},

    "createDocumentForm.type": function () {
      const quill = this.$refs.qleditor0;
      if (this.createDocumentForm.type === 1) {
        this.createDocumentForm.content = `<h3 class="ql-align-center"><strong>VISITA REGULAR</strong></h3><p><br></p><p><strong>Provincia:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Localidad: </strong></p><p><strong>&nbsp;</strong></p><p><strong>Nombre de la Comunidad local:</strong> </p><p><br></p><p><strong>Dirección completa: </strong></p><p><br></p><p><strong>Teléfono: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>E-mail de la comunidad local:</strong></p><p><br></p><p><strong>VISITA hecha por: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;el&nbsp;&nbsp;</strong></p><p><br></p><p><strong>Fecha de la Última Visita Regular:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>hecha por&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><br></p><p><strong>Fecha de la Última Visita Pastoral</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>por el Padre: </strong></p><p><br></p><p><strong>Fecha de Fundación de la Casa: </strong></p><p><br></p><p><strong>A quién pertenecen los inmuebles</strong></p><p><br></p><p><strong>¿Ha habido adquisiciones desde la última Visita?&nbsp;&nbsp;&nbsp;</strong></p><p><strong>&nbsp;</strong></p><p><strong>¿Alienaciones?&nbsp;&nbsp;&nbsp;</strong></p><p><strong>¿Existen deudas?&nbsp;&nbsp;</strong></p><p><strong>¿Existen litigios?&nbsp;&nbsp;&nbsp;</strong></p><p>&nbsp;</p><p><strong><u>La Hermana Sirviente: &nbsp;&nbsp;&nbsp;&nbsp;</u></strong></p><p><strong>&nbsp;</strong></p><p><strong>Sor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p><strong>Nacida el</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>en</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><strong>Fecha de Vocación: </strong></p><p><strong>Hermana Sirviente de esta Comunidad desde el</strong>: </p><p><br></p><p><br></p><p><br></p><p class="ql-align-center"><strong>NOMBRE DE LA COMUNIDAD LOCAL</strong></p><p class="ql-align-center"><strong>&nbsp;ECUADOR</strong></p><p><br></p><p><br></p><p class="ql-align-justify">Por delegación de Sor Nila GÓMEZ AYORA, Visitadora Provincial, yo Sor, Consejera Provincial, realicé la Vista Regular a la comunidad Local de ……. Desde……………………</p><p class="ql-align-justify">La comunidad Local fue fundada el ………………y está constituida por: (por vocación)</p><p class="ql-align-justify">Sor ………………….&nbsp;Hermana Sirviente </p><p class="ql-align-justify">Sor&nbsp;&nbsp;&nbsp;…………………Asistenta local </p><p class="ql-align-justify">Sor …………………… </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Con la presencia de las Hermanas, reunidas en Comunidad, se hizo la <strong>APERTURA</strong> de la Visita Regular, ………….</p><p class="ql-align-justify">Luego se explicó el procedimiento a seguir y los aspectos sobre los cuales se basa la evaluación: ENTREGADAS A DIOS, EN COMUNIDAD DE VIDA FRATERNA Y PARA SERVIR A CRISTO EN LOS POBRES<em>,</em> inmediatamente concretamos el orden para las entrevistas con la finalidad de no interferir en el trabajo.</p><p class="ql-align-justify">Después de la comunicación con cada una de las Hermanas, el personal, el Párroco, la visita por los servicios y revisión de libros de la Comunidad y la Obra, formulo las siguientes <strong>constataciones:</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>OBSERVACIONES</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En la vida espiritual,</strong> </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En la vida comunitaria,</strong> </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>En el servicio a los pobres,</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>HERMANA SIRVIENTE:</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Su animación</strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sus relaciones</strong></p><p>&nbsp;</p><p class="ql-align-justify"><strong>DOCUMENTOS DE COMUNIDAD Y DE OBRA:</strong> </p><p class="ql-align-justify"><strong>En cuanto al Personal:</strong> </p><p class="ql-align-justify"><strong><u>En lo económico.</u></strong></p><p class="ql-align-justify">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>De la comunidad</u></strong></p><p class="ql-align-justify"><br></p><p class="ql-align-justify">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>De la obra</u></strong><u> </u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p><strong>&nbsp;</strong></p><p class="ql-align-justify"><strong>SUGERENCIAS:</strong></p><p class="ql-align-justify"><strong><u>AGRADECIMIENTO</u></strong></p><p><strong>FIRMA:</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 2) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>SALIDA DE LA COMPAÑIA</strong></p><p class="ql-align-justify">Yo, la abajo firmante…………………………………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><strong>Declaro: </strong></p><p class="ql-align-justify">Que me retiro de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, a la que he pertenecido desde el .............. (fecha de admisión) hasta................ (fecha de salida). </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que salgo voluntariamente, antes de hacer los votos / después de haber firmado la dispensa de mis votos / no habiendo renovado mis votos. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-right">En …………………………….. el ………………………………………</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify"><br></p><p><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>&nbsp;</strong></p><p class="ql-align-center"><strong>……………………………….</strong></p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad&nbsp;</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 3) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>PARA UNA SALIDA DE LA COMPAÑIA</strong></p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Yo, la abajo firmante……………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Declaro; </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que he pertenecido a la Compañía de las Hijas de la Caridad de San Vicente de Paúl desde el .................. a………………………..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que recibo de la Compañía, como donativo, la cantidad de …………………….que se me entrega hoy. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Que la Compañía de las Hijas de la Caridad de San Vicente de Paúl no tiene ninguna responsabilidad económica conmigo y que nadie puede hacer una reclamación a la Compañía. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">En………………………..el………………………… </p><p class="ql-align-justify">&nbsp;</p><p>&nbsp;</p><p class="ql-align-center"><strong>……………………………….</strong></p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad&nbsp;</strong></p><p class="ql-align-center"><br></p>`;
      } else if (this.createDocumentForm.type === 4) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>PARA UNA SALIDA DE LA COMPAÑIA</strong></p><p>&nbsp;</p><p>&nbsp;</p><p>Yo tomo nota de mi despido de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, y de que, por este mismo hecho, estoy desligada de mis votos. </p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p class="ql-align-right">En………………………..el………………………… </p><p>&nbsp;</p><p>&nbsp;</p><p class="ql-align-center"><strong>……………………………….</strong></p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad&nbsp;</strong></p><p class="ql-align-center"><br></p>`;
      } else if (this.createDocumentForm.type === 5) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>PARA UNA NUEVA IMPLANTACION </strong></p><p><strong>PROVINCIA: </strong></p><p><strong><em>Para una apertura en: </em></strong></p><p><strong><em>Situación del país </em></strong></p><p><em>Texto</em></p><p><strong><em>Situación geográfica y demográfica</em></strong></p><p><em>Texto</em></p><p><strong><em>Situación sociológica</em></strong></p><p><em>Texto</em></p><p><strong><em>Situación religiosa</em></strong></p><p><em>Texto</em></p><p><strong>&nbsp;</strong></p><p><br></p><p><strong>Condiciones de la implantación </strong></p><ul><li><strong>¿Quién ha hecho la petición? </strong></li><li><strong>¿Cuál será la misión de las Hermanas? </strong></li><li><strong>Condiciones de vida de la comunidad: </strong></li></ul><p class="ql-indent-2"><strong>Número de Hermanas: </strong></p><p class="ql-indent-2"><strong>Alojamiento de las Hermanas: </strong></p><p class="ql-indent-2"><strong>Situación financiera: </strong></p><p class="ql-indent-2"><strong>Asistencia espiritual: </strong></p><ul><li><strong>Autorización del Ordinario del lugar (por escrito) </strong></li><li><strong>Ficha de Consejo&nbsp;</strong></li></ul>`;
      } else if (this.createDocumentForm.type === 6) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>MISIÓN AD GENTES – CUESTIONARIO</strong></p><p><strong>PROVINCIA:</strong></p><p><strong>Hermana:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comunidad Local:</strong></p><p><strong>Fecha de nacimiento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Vocación</strong></p><p><strong>Ha pedido la Misión Ad Gentes a la Superiora General.</strong></p><p><br></p><p class="ql-align-center"><strong><u>Informaciones pedidas a la Visitadora y a su Consejo</u></strong></p><p><strong>1.- Sobre las diferentes dimensiones de la vida de esta Hermana:</strong></p><p><strong>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimisión Humana (salud – equilibrio afectivo y psicológico, capacidad de adaptación, vida de relación)</strong></p><p><strong>&nbsp;</strong></p><p><strong>b)&nbsp;&nbsp;&nbsp;&nbsp;Dimisión espiritual (espiritual de fe – vida de oración – sentido eclesial…)</strong></p><p><br></p><p><strong>c)&nbsp;&nbsp;&nbsp;&nbsp;Dimensión comunitaria (interés por el bien común: participación – actitud para compartir – adaptación – capacitación de la diversidad…)</strong></p><p><br></p><p><strong>d)&nbsp;&nbsp;&nbsp;&nbsp;Dimensión apostólica (capacitación de colaboración – preparación profesional – conocimiento de lenguas o capacidad para aprenderlas…, experiencias en el servicio de los pobres) </strong></p><p><br></p><p><strong>e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¿ha recibido ya una preparación misionera?</strong></p><p><br></p><p><strong>2.- Opinión de la Visitadora con su Consejo</strong></p><p><strong>Positivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motivaciones:</strong></p><p><strong>Negativo: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motivaciones:</strong></p><p><br></p><p><strong>3.- En caso de ser aceptada para la Misión, ¿Cuánto tiempo será necesario para liberar a la Hermana?</strong></p><p><br></p><p><strong>Fecha: </strong></p><p><br></p><p><br></p><p class="ql-align-center">……………………………….</p><p class="ql-align-center"><strong>Sor ……….</strong></p><p class="ql-align-center"><strong>Hija de la Caridad</strong></p><p><br></p><p><br></p><p class="ql-align-center"><strong> &nbsp;</strong></p>`;
      } else if (this.createDocumentForm.type === 7) {
        this.createDocumentForm.content = `<h3 class="ql-align-center"><strong>CERTIFICADO DE ADMISIÓN EN LA COMPAÑIA</strong></h3><h3>&nbsp;</h3><p class="ql-align-justify">Dirección </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">El ……………………………………(fecha)</p><p class="ql-align-justify">Nombre </p><p class="ql-align-justify">…………………………………………………………………………………..</p><p class="ql-align-justify">Dirección </p><p class="ql-align-justify">…………………………………………………………………………………..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Ha sido admitida como miembro de la Compañía de las Hijas de la Caridad de San Vicente de Paúl, en la Provincia de …….</p><p class="ql-align-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p class="ql-align-justify">&nbsp;</p><p class="ql-indent-1 ql-align-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p class="ql-indent-1 ql-align-right">Sor Nila GOMEZ A. </p><p class="ql-indent-1 ql-align-right"><strong>HIJA DE LA CARIDAD</strong></p><p class="ql-indent-1 ql-align-right"><strong>VISITADORA PROVINCIAL</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 8) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>INFORMACIÓN (Estatuto 64b)</strong></p><p class="ql-align-justify">Provincia: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           Año 20...... </p><p class="ql-align-justify">Sor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comunidad local: </p><p class="ql-align-justify">Fecha de nacimiento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de vocación: </p><p class="ql-align-justify">________________________________________________________________________</p><p class="ql-align-justify">Formación realizada durante los últimos 5 años: </p><p class="ql-align-justify">Salud (intervenciones quirúrgicas, enfermedades): </p><p class="ql-align-justify">________________________________________________________________________</p><p class="ql-align-justify"><strong>Aspectos positivos del crecimiento de la Hermana en el espíritu de la Compañía (vida espiritual, vida comunitaria, vida de servicio...) </strong></p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Dificultades principales:</p><p class="ql-align-justify"><strong>&nbsp;</strong></p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Otras observaciones: </p><p class="ql-align-justify"><br></p><p class="ql-align-justify">&nbsp;&nbsp;&nbsp;_______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		_______________________</p><p><strong>Firma de la Hermana Sirviente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  Firma de la Hermana</strong></p>`;
      } else if (this.createDocumentForm.type === 9) {
        this.createDocumentForm.content = `<p class="ql-align-center"><strong>FÓRMULA RELATIVA A LAS CUESTIONES DE NATURALEZA ECONÓMICA</strong></p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Teniendo en cuenta mi ADMISIÓN como MIEMBRO de la Compañía de las Hijas de la Caridad de San Vicente de Paúl. </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Yo (nombre) ……………………………………………………………….</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">DECLARO que cualquier cantidad de dinero o donación, sea cual fuere el origen, resultante de los servicios por mi realizados, pertenecen a las Hijas de la Caridad y que no haré ninguna reclamación a la Compañía (cf. C. 300) </p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Testigos: </p><p class="ql-align-justify">………………………………</p><p class="ql-align-right">&nbsp;</p><p class="ql-align-right">Sor……………..</p><p class="ql-align-right"><strong>HIJA DE LA CARIDAD</strong></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 10) {
        this.createDocumentForm.content = `<h2 class="ql-align-center"><strong>CERTIFICADO DE LA RENOVACIÓN</strong></h2><p class="ql-align-center"><strong>&nbsp;</strong></p><p class="ql-align-justify">Yo </p><p class="ql-align-justify">………………………………………….</p><p class="ql-align-justify">CERTIFICO haber renovado los Votos en la Compañía de las Hijas de la Caridad, en la fiesta de la Anunciación el … de …… del 20..</p><p class="ql-align-justify">&nbsp;</p><p class="ql-align-justify">Firma:</p><p class="ql-align-justify"><br></p><p class="ql-align-center"><strong>………………………</strong></p><p><br></p><p><br></p>`;
      } else if (this.createDocumentForm.type === 11) {
        this.createDocumentForm.content = `<p><strong>Sor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Emisión: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p><p class="ql-align-justify"><strong>Autorización:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; uu</strong></p><p class="ql-align-justify"><strong>Lugar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;oo</strong></p><p class="ql-align-justify"><strong>Tiempo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii</strong></p><p class="ql-align-justify"><strong>Días:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; oo</strong></p><p class="ql-align-justify"><strong>Observación: </strong>Visitará a su Mamá delicada de salud, la (…………..) Ruego mantener la flexibilidad pertinente ante los requerimientos de la Comunidad local; salvo casos súbitos de su Familia, deberán en diálogo fraterno con su Hermana Sirviente, tomar otras decisiones. </p><p class="ql-align-justify">Tener presente este permiso en la planificación comunitaria.                   </p><p class="ql-align-justify">                                                                                                                                                                       </p><p class="ql-align-justify">&nbsp;&nbsp;&nbsp;_______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		_______________________</p><p><strong><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sor Nila GOMEZ A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HERMANA SIRVIENTE</em></strong><em>
</em></p><p><strong><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hija de la Caridad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sor Fffff Uuuuu B.&nbsp;&nbsp;&nbsp;</em></strong></p>`;
      } else if (this.createDocumentForm.type === 12) {
        this.createDocumentForm.content = `<p class="ql-align-right"><br></p><p class="ql-align-right">Quito, (fecha)</p><p><strong>Señores</strong></p><p><strong>REVISIÓN TÉCNICA VEHICULAR</strong></p><p><strong>Presente. -</strong></p><p>&nbsp;</p><p class="ql-align-justify"><strong>Sor ...........................</strong>, Representante Legal de la Compañía de las Hijas de la Caridad de San Vicente de Paúl del Ecuador, con C.I ….............., con residencia en Quito, en la calle Bolívar Oe6 110 e Imbabura.</p><h2 class="ql-align-center"><strong>AUTORIZA</strong></h2><p class="ql-align-center"><br></p><p class="ql-align-justify"><strong>A ………………………………., </strong>con Cédula de Identidad Nº …………….  nacida/o en ………………………. y con domicilio en ………………………………., para que realice la matrícula y revisión del carro: <strong>MARCA</strong>…………., <strong>PLACA</strong>…………..., perteneciente a la <strong>COMPAÑÍA DE LAS HIJAS DE LA CARIDAD DE SAN VICENTE DE PAÚL DEL ECUADOR</strong>, para servicio de las Hijas de la Caridad de la Comunidad ...................</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Esta autorización puede ser utilizada para los trámites consiguientes.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify"><br></p><p class="ql-align-center">_____________________________</p><p class="ql-align-center">Sor .....................</p><p class="ql-align-center">Hija de la Caridad</p><p class="ql-align-center">REPRESENTANTE LEGAL</p><p class="ql-align-center"><br></p><p class="ql-align-center"><br></p><p class="ql-align-center"><br></p>`;
      } else if (this.createDocumentForm.type === 13) {
        this.createDocumentForm.content = `<h3 class="ql-align-center"><strong>INFORMACIÓN ANUAL</strong></h3><p><strong>Sor (Apellidos y nombre): ………………………….</strong></p><p><strong>Fecha y lugar de nacimiento: ……………………..</strong></p><p><strong>Nacionalidad: ……………………………..</strong></p><p><strong>Fecha de vocación: ……………………….</strong></p><p><strong>Nombre de la Comunidad: ………………</strong></p><p><strong>Dirección: …………………..</strong></p><p class="ql-align-center"><strong>INFORMACION CORRESPONDIENTE AL PERIODO 20...</strong></p><p><strong>Cultura (Titulos, diplomas) ……………………</strong></p><p><strong>Actividades ……………………</strong></p><p><strong>Salud (enfermedades, operaciones, estado habitual) ...............</strong></p><p class="ql-align-right">«El espíritu de vuestra Compañía,</p><p class="ql-align-right">Hermanas mías, consiste en el amor de</p><p class="ql-align-right">Nuestro Señor, el amor a los pobres, el</p><p class="ql-align-right">amor entre vosotras, la humildad y la </p><p class="ql-align-right">sencillez» </p><p class="ql-align-right">(San Vicente, 9-2-1653) </p><p>	<strong>	I. Aspectos positivos del crecimiento de la Hermana en el espíritu de la Compañía (vida espiritual, vida comunitaria, vida de servicio …)</strong></p><p><strong>		II. Dificultades principales</strong></p><p><strong>		III. Otras observaciones</strong></p><p></p><p><strong> </strong></p><p>&nbsp;&nbsp; _________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                 _________________________</p><p><strong>Firma de la Hermana Sirviente: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;   </strong><strong style="background-color: rgb(255 255 255 / var(--tw-bg-opacity));"> Firma de la Hermana:</strong></p>`;
      } else {
        this.createDocumentForm.content = null;
      }
      quill.setHTML(this.createDocumentForm.content);
    },

    dataTransfer: function () {},

    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
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
      this.eventBeingCreated = this.createDocumentForm;
      this.createDocumentForm.name = null;
      this.createDocumentForm.content = null;
      this.createDocumentForm.type = null;
    },

    cancelCreate() {
      this.eventBeingCreated = null;
      this.reloadData;
      this.createDocumentForm.name = null;
      this.createDocumentForm.content = null;
      this.createDocumentForm.type = null;
    },

    createEvent() {
      this.createDocumentForm.post(this.route("secretary.documents.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.eventBeingCreated = null;
          this.reloadData;
          this.createDocumentForm.name = null;
          this.createDocumentForm.content = null;
          this.createDocumentForm.type = null;
        },
      });
    },

    confirmUpdateEvent(event) {
      this.updateDocumentForm.name = event.name;
      this.updateDocumentForm.content = event.content;
      this.updateDocumentForm.type = event.type;
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

      this.documentBeingUpdated = event;
    },

    downloadResume() {
      window.open(
        route(
          "secretary.documents.report.pdf",
          {
            event_id: this.documentBeingUpdated.id,
          },
          "one"
        )
      );
    },

    updateEvent() {
      this.updateDocumentForm.put(
        this.route("secretary.documents.update", {
          event_id: this.documentBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            // this.documentBeingUpdated = null;
            setTimeout(() => {
              this.reloadData;
            }, 2);
          },
        }
      );
    },

    deleteEvent() {
      this.updateDocumentForm.get(
        this.route("secretary.documents.delete", {
          event_id: this.documentBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            this.documentBeingUpdated = null;
            setTimeout(() => {
              this.reloadData;
            }, 2);
          },
        }
      );
    },

    showDocumentType(id) {
      let pivoteB;
      for (let i = 0; i < this.optionMain.length; i++) {
        const element = this.optionMain[i].options;
        for (let j = 0; j < element.length; j++) {
          const inside = element[j];
          if (parseInt(id) === inside.id) {
            pivoteB = inside.name;
            break;
          }
        }
      }
      return pivoteB;
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
