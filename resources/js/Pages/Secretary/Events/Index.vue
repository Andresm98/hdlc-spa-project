<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de Eventos Globales en la Compañía
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <section
      class="
        bg-gray-200
        dark:bg-slate-800
        y-1
        px-4
        sm:p-6
        md:py-10 md:px-8
        pt-2
        pb-4
        rounded-lg
        sm:m-2
        lg:m-3
        md:m-4
      "
    >
      <div
        class="
          max-w-4xl
          mx-auto
          grid grid-cols-1
          lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2
        "
      >
        <div
          class="
            relative
            p-3
            col-start-1
            row-start-1
            flex flex-col-reverse
            rounded-lg
            bg-gradient-to-t
            from-black/75
            via-black/0
            sm:bg-none sm:row-start-2 sm:p-0
            lg:row-start-1
          "
        >
          <h1
            class="
              mt-1
              text-lg
              font-semibold
              text-black
              sm:text-black
              md:text-2xl
              dark:sm:text-white
            "
          >
            Provincia Ecuador
          </h1>
          <p
            class="
              text-sm
              leading-4
              font-medium
              text-black
              sm:text-black
              dark:sm:text-slate-400
            "
          >
            Información General de Eventos
          </p>
        </div>
        <div
          class="
            grid
            gap-4
            col-start-1 col-end-3
            row-start-1
            sm:mb-6 sm:grid-cols-4
            lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0
          "
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="
              w-full
              h-60
              object-cover
              rounded-lg
              sm:h-52 sm:col-span-2
              lg:col-span-full
            "
            loading="lazy"
          />
        </div>
        <dl
          class="
            mt-4
            text-xs
            font-medium
            flex
            items-center
            row-start-2
            sm:mt-1 sm:row-start-3
            md:mt-2.5
            lg:row-start-2
          "
        >
          <dt class="sr-only">Visto</dt>
          <dd class="text-indigo-600 flex items-center dark:text-indigo-400">
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
        <p>
          La presente plantiflla de información se relaciona a todos los eventos
          que se realizan en el la compañía de las Hijas de la Caridad de San
          Vicente de Paúl.
        </p>
      </div>
    </section>
    <br />
    <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
      <section class="flex-shrink-0">
        <button
          @click="confirmCreateEvent()"
          class="
            pt-1
            pb-1
            pl-4
            pr-4
            m-4
            bg-blue-500
            border-2 border-blue-500
            text-white text-sm
            rounded-lg
            hover:bg-blue-500 hover:text-gray-100
            focus:border-4 focus:border-blue-300
          "
        >
          Crear Eventos
        </button>
      </section>
    </div>

    <!-- Container Filters -->
    <div class="container mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            bg-gray-100
          "
        >
          <small class="justify-content-center ml-20 uppercase"
            >Filtros de Búsqueda</small
          >

          <search-filter
            v-model="params.search"
            class="
              border border-blue-300
              rounded-md
              shadow-sm
              focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
              sm:text-sm
            "
            @reset="reset"
          >
            <!-- <v-date-picker v-model="params.date" is-required :format="format">
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="bg-white border px-2 py-1 rounded"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </v-date-picker> -->

            <small class="block text-gray-700 mt-2">Tipo de evento:</small>

            <select
              v-model="params.type"
              class="
                mt-1
                block
                w-full
                px-3
                border border-gray-300
                bg-white
                rounded-md
                shadow-sm
                focus:outline-none focus:ring-blue-500 focus:border-blue-500
                sm:text-sm
              "
            >
              <option :value="null">Todas</option>
              <option value="1">Comunidad</option>
              <option value="2">Extracomunitaria</option>
              <option value="3">Ordinaria</option>
              <option value="4">Extraordinaria</option>
            </select>
          </search-filter>
        </div>

        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            p-1
            bg-gray-100
          "
        >
          <small class="block text-gray-700">Estado:</small>
          <Datepicker
            :format="format"
            v-model="params.date"
            monthPicker
            autoApply
          />
        </div>

        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            p-1
            bg-gray-100
          "
        >
          <small class="justify-content-center ml-20 uppercase"
            >Exportar Listas</small
          >
          <div
            class="
              md:text-md
              flex
              items-center
              justify-between
              p-4
              w-full
              text-sm
              md:px-12 md:py-0
            "
          >
            <dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div
                    class="
                      mr-1
                      text-gray-700
                      group-hover:text-blue-600
                      focus:text-blue-600
                      whitespace-nowrap
                    "
                  >
                    <span
                      class="
                        px-1
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-sm
                        bg-gray-200
                        text-gray-800
                      "
                      >&nbsp;Filtros</span
                    >
                  </div>
                  <icon
                    class="
                      w-5
                      h-5
                      fill-gray-700
                      group-hover:fill-blue-600
                      focus:fill-blue-600
                    "
                    name="cheveron-down"
                  />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <a
                    class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                    target="_blank"
                    :href="
                      route('secretary.communities.export.excel', this.params)
                    "
                    >Excel</a
                  >
                  <a
                    class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                    target="_blank"
                    :href="
                      route('secretary.communities.export.csv', this.params)
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
      <calendar
        ref="calendar"
        class="custom-calendar flex overflow-x-auto w-full"
        :attributes="eventsCommunity"
        is-expanded
        is-range
        :visible="true"
        :from-page="{
          month: parseInt(this.dateMonth) + 1,
          year: parseInt(this.dateYear),
        }"
        show-weeknumbers="right"
        v-model="params.date"
      >
        <template v-slot:day-content="{ day, attributes }">
          <div class="flex flex-col h-full z-10 overflow-hidden">
            <span
              @click="listEvent(day.id)"
              class="
                day-label
                text-sm text-black
                hover:cursor-pointer
                mt-3
                mb-1
                md:mx-2
                lg:mx-4
                rounded-sm
                bg-gray-200
              "
              >{{ day.day }}</span
            >
            <div class="overflow-y-auto">
              <div v-for="attr in attributes" :key="attr">
                <p
                  v-if="attr.customData.status == 2"
                  class="
                    text-xs
                    p-1
                    mt-0
                    mb-1
                    hover:cursor-pointer
                    rounded-full
                    mx-5
                  "
                  :class="attr.customData.class"
                  @click="confirmUpdateEvent(attr)"
                >
                  {{ attr.customData.title.substring(0, 15) }}
                </p>
                <p
                  v-if="attr.customData.status == 1"
                  class="text-xs p-1 mt-0 mb-1 hover:cursor-pointer rounded-md"
                  :class="attr.customData.class"
                  @click="confirmUpdateEvent(attr)"
                >
                  {{ attr.customData.title.substring(0, 15) }}
                </p>
              </div>
            </div>
          </div>
        </template>
      </calendar>
    </div>
  </app-layout>

  <!-- Create Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="eventBeingCreated"
    @close="eventBeingCreated == null"
  >
    <template #title> Datos del nuevo evento</template>

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
                class="
                  border-0
                  px-3
                  placeholder-blueGray-300
                  text-blueGray-600
                  bg-white
                  rounded
                  text-sm
                  shadow
                  focus:outline-none focus:ring
                  w-full
                  ease-linear
                  transition-all
                  duration-150
                "
                v-model="createEventForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700">
                Nombre:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="createEventForm.type"
                id="material"
                name="material"
                autocomplete="article-material"
                class="
                  mt-1
                  block
                  w-full
                  px-3
                  border border-gray-300
                  bg-white
                  rounded-md
                  shadow-sm
                  focus:outline-none
                  focus:ring-indigo-500
                  focus:border-indigo-500
                  sm:text-sm
                "
              >
                <option value="1">Comunidad</option>
                <option value="2">Extracomunitaria</option>
                <option value="3">Ordinaria</option>
                <option value="4">Extraordinaria</option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div class="relative w-full px-2">
            <label class="block text-sm font-medium text-gray-700">
              Descripción
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.description"
            >
              {{ $page.props.errors.description }}
            </p>
            <textarea
              v-model="this.createEventForm.description"
              id="about"
              name="about"
              rows="3"
              maxlength="2000"
              class="
                shadow-sm
                focus:ring-blue-500 focus:border-blue-500
                mt-1
                block
                w-full
                sm:text-sm
                border border-gray-300
                rounded-md
              "
              placeholder="Ingresar descripción"
            />
          </div>
        </div>

        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700 mt-2">
                Fecha Inicio:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.dates">
                {{ $page.props.errors.dates }}
              </p>
              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="this.createEventForm.dates"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700 mt-2">
                Fecha Fin:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.datesEnd"
              >
                {{ $page.props.errors.datesEnd }}
              </p>
              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="createEventForm.datesEnd"
              />
            </div>
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
                class="
                  border-0
                  px-3
                  placeholder-blueGray-300
                  text-blueGray-600
                  bg-white
                  rounded
                  text-sm
                  shadow
                  focus:outline-none focus:ring
                  w-full
                  ease-linear
                  transition-all
                  duration-150
                "
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
                Nombre:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.type">
                {{ $page.props.errors.type }}
              </p>
              <select
                v-model="updateEventForm.type"
                id="material"
                name="material"
                autocomplete="article-material"
                class="
                  mt-1
                  block
                  w-full
                  px-3
                  border border-gray-300
                  bg-white
                  rounded-md
                  shadow-sm
                  focus:outline-none
                  focus:ring-indigo-500
                  focus:border-indigo-500
                  sm:text-sm
                "
              >
                <option value="1">Comunidad</option>
                <option value="2">Extracomunitaria</option>
                <option value="3">Ordinaria</option>
                <option value="4">Extraordinaria</option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full">
          <div class="relative w-full px-2">
            <label class="block text-sm font-medium text-gray-700">
              Descripción
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.description"
            >
              {{ $page.props.errors.description }}
            </p>
            <textarea
              v-model="updateEventForm.description"
              id="about"
              name="about"
              rows="3"
              maxlength="2000"
              class="
                shadow-sm
                focus:ring-blue-500 focus:border-blue-500
                mt-1
                block
                w-full
                sm:text-sm
                border border-gray-300
                rounded-md
              "
              placeholder="Ingresar descripción"
            />
          </div>
        </div>

        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700 mt-2">
                Fecha Inicio:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.dates">
                {{ $page.props.errors.dates }}
              </p>
              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="updateEventForm.dates"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-2">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700 mt-2">
                Fecha Fin:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.datesEnd"
              >
                {{ $page.props.errors.datesEnd }}
              </p>
              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="updateEventForm.datesEnd"
              />
            </div>
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
      <jet-button-success class="ml-3" @click="updateEvent">
        Actualizar
      </jet-button-success>
    </template>
  </jet-dialog-modal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { pickBy, throttle, mapValues } from "lodash";
import moment from "moment";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import { range } from "moment-range";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Datepicker from "vue3-date-time-picker";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Icon from "@/Components/Icon";

import TextInput from "@/Components/TextInput";
import { ref } from "vue";
import Alert from "@/Components/Alert";
import SearchFilter from "@/Components/SearchFilter";
import Dropdown from "@/Components/Dropdown";

export default {
  layout: PrincipalLayout,
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    return {
      date,
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
    // console.log("params ", this.params);
    if (this.params.date != null) {
      this.dateMonth = parseInt(this.params.date.month);
      this.dateYear = parseInt(this.params.date.year);
      //   console.log("si", this.dateMonth, "\n", this.dateYear);
    } else {
      this.dateMonth = new Date().getMonth();
      this.dateYear = new Date().getFullYear();
      //   console.log("no", this.dateMonth, "\n", this.dateYear);
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
        // Comunidad, Extracomunitaria, Ordinaria, Extraordinaria

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
              title: this.events[key].name,
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
      //   console.log(this.eventsCommunity.length);
    },
  },
  data() {
    return {
      //

      value: [],
      options: [
        { name: "Vue.js", code: "vu" },
        { name: "Javascript", code: "js" },
        { name: "Open Source", code: "os" },
      ],
      //
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
      eventsCommunity: [],
      //  Create

      eventBeingCreated: null,
      createEventForm: null,

      //   Update

      eventBeingUpdated: null,
      updateEventForm: this.$inertia.form({
        name: null,
        description: null,
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
    dataTransfer: function () {
      //   console.log("log ");
    },
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
        this.$inertia.get(this.route("secretary.events.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            // console.log("Success");
            this.reloadData;
          },
        });
      }, 1),
      deep: true,
    },
  },
  methods: {
    miDato() {
      //   console.log("funciona cerdo");
    },
    showDay(day) {
      //   console.log("Show data: ", day);
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
    formatShowDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },
    reset() {
      this.params = mapValues(this.params, () => null);
    },
    listEvent(day) {
      //   console.log("day ", day);
    },
    confirmCreateEvent() {
      this.createEventForm = this.$inertia.form({
        name: null,
        description: null,
        type: null,
        dates: null,
        datesEnd: null,
      });
      this.eventBeingCreated = this.createEventForm;
    },
    createEvent() {
      this.createEventForm.dates = this.formatDate(this.createEventForm.dates);
      if (this.createEventForm.datesEnd != null) {
        this.createEventForm.datesEnd = this.formatDate(
          this.createEventForm.datesEnd
        );
      }

      this.createEventForm.post(this.route("secretary.events.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.eventBeingCreated = null;
          this.reloadData;
        },
      });
    },

    confirmUpdateEvent(event) {
      this.updateEventForm.dates = this.formatDate(event.customData.dates);
      if (event.customData.datesEnd != null) {
        this.updateEventForm.datesEnd = this.formatDate(
          event.customData.datesEnd
        );
      }
      this.updateEventForm.name = event.customData.title;
      this.updateEventForm.description = event.customData.description;
      this.updateEventForm.type = event.customData.type;

      this.eventBeingUpdated = event.customData;
    },

    updateEvent() {
      this.updateEventForm.dates = this.formatDate(this.updateEventForm.dates);
      if (this.updateEventForm.datesEnd != null) {
        this.updateEventForm.datesEnd = this.formatDate(
          this.updateEventForm.datesEnd
        );
      }

      this.updateEventForm.put(
        this.route("secretary.events.update", {
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
        this.route("secretary.events.delete", {
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
