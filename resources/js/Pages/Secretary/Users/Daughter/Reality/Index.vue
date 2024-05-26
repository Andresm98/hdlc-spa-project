<template @scroll="handleScroll">
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Realidad de la Provincia
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
    <operation></operation>
    <br />
    <div>
      <section
        class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg m-1"
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
              Información General de Hermanas
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
          <div
            class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
          >
            <div
              class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 text-black dark:text-white"
            >
              <p>
                La presente plantilla de información se relaciona con las
                Hermanas registradas en la compañía, tenga en cuenta que los
                gráficos estadísticos corresponden a las Hermanas activas,
                fallecidas y retiradas.
              </p>
            </div>
          </div>
        </div>

        <br />

        <div class="py-2">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-yellow-200">
                    <tr>
                      <th
                        scope="col"
                        class="text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        <span
                          class="inline-flex px-6 py-3 w-full justify-between"
                        >
                          Nro.</span
                        >
                      </th>
                      <th
                        scope="col"
                        class="text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Estado
                      </th>

                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Número de Hermanas
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="data in groupDaughters" :key="data">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                          <div class="flex items-center">
                            <p class="text-sm">{{ data.status }}</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 whitespace-nowrap">
                        <span
                          v-if="data.status == 1"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                        >
                          Activas
                        </span>
                        <span
                          v-if="data.status == 2"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                        >
                          Fallecidas
                        </span>
                        <span
                          v-if="data.status == 3"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                        >
                          Retiradas
                        </span>
                        <span
                          v-if="data.status == 4"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                        >
                          Otros Países
                        </span>
                        <span
                          v-if="data.status == 5"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                        >
                          Sin Datos
                        </span>
                      </td>
                      <td class="px-6 whitespace-nowrap">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                        >
                          {{ data.total }}
                        </span>
                      </td>
                    </tr>

                    <tr class="bg-gray-100">
                      <td class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                          >
                            TOTAL
                          </span>
                        </div>
                      </td>
                      <td class="px-6 whitespace-nowrap">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                        >
                        </span>
                      </td>

                      <td class="px-6 whitespace-nowrap">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                        >
                          {{ countDaughters() }}
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br />
      <div
        class="py-2 justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
      >
        <small class="justify-content-center ml-20 uppercase"
          >Mostrar gráficos personalizados</small
        >
        <div
          class="md:text-md flex items-center justify-between p-4 w-full text-sm md:px-12 md:py-0"
        >
          <dropdown class="mt-1" placement="bottom-end">
            <template #default>
              <div class="group flex items-center cursor-pointer select-none">
                <div
                  class="mr-1 text-gray-700 group-hover:text-blue-600 focus:text-blue-600 whitespace-nowrap"
                >
                  <span
                    class="px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-gray-200 text-gray-800"
                    >&nbsp;Seleccionar formatos:</span
                  >
                </div>
                <icon
                  class="w-5 h-5 fill-gray-700 group-hover:fill-blue-600 focus:fill-blue-600"
                  name="cheveron-down"
                />
              </div>
            </template>
            <template #dropdown>
              <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                <a
                  class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                  target="_blank"
                  @click="showGraphs(1)"
                  >Principal</a
                >
              </div>
            </template>
          </dropdown>
        </div>
      </div>
      <div v-if="showDataCase == 1">
        <h6
          class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
        >
          Gráficos Estadísticos de Hermanas
        </h6>
      </div>
      <div
        class="pb-6 lg:grid lg:grid-cols-2 lg:gap-2 lg:mx-12 lg:mb-6 h-1/2 w-4/6"
      >
        <div class="px-2" v-if="showDataCase == 1">
          <PieChart
            :arrayData="this.getData(this.groupDaughters)"
            :arrayLabels="this.getLabels(this.groupDaughters)"
          />
        </div>

        <div class="px-2" v-if="showDataCase == 1">
          <Chart
            :arrayData="this.getData(this.groupDaughters)"
            :arrayLabels="this.getLabels(this.groupDaughters)"
          />
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import PieChart from "@/Pages/Secretary/Users/Daughter/Reality/PieChart";
import Linear from "@/Pages/Secretary/Users/Daughter/Reality/Linear";
import Operation from "@/Components/Secretary/Daughter/Operation";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import Chart from "@/Pages/Secretary/Users/Daughter/Reality/Chart";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import JetInputError from "@/Jetstream/InputError";
import Dropdown from "@/Components/Dropdown";
import { Inertia } from "@inertiajs/inertia";
import Alert from "@/Components/Alert";
import { defineComponent } from "vue";
import Icon from "@/Components/Icon";
import { jsPDF } from "jspdf";
import { ref } from "vue";

export default {
  data() {
    return {
      place: "",
      fontSize: "100",
      fontFill: "grey",
      arrayLabels: {
        type: Array,
        default: () => [],
      },
      arrayData: {
        type: Array,
        default: () => [],
      },
      showDataCase: 1,
    };
  },

  props: {
    groupDaughters: Object,
  },

  layout: PrincipalLayout,

  components: {
    AppLayout,
    JetInputError,
    Alert,
    Operation,
    Chart,
    PieChart,
    Icon,
    Dropdown,
    Linear,
  },

  methods: {
    getData(array) {
      let data = [];
      for (let index = 0; index < this.groupDaughters.length; index++) {
        data.push(array[index].total);
      }

      return (this.arrayData = data);
    },

    getLabels(array) {
      let data = [];
      for (let index = 0; index < this.groupDaughters.length; index++) {
        if (array[index].status == 1) {
          data.push("Activas");
        }
        if (array[index].status == 2) {
          data.push("Fallecidas");
        }
        if (array[index].status == 3) {
          data.push("Retiradas");
        }
        if (array[index].status == 4) {
          data.push("A otros Países");
        }
        if (array[index].status == 5) {
          data.push("Sin Datos");
        }
      }
      return (this.arrayLabels = data);
    },

    countDaughters() {
      let total = 0;
      this.groupDaughters.forEach(myFunction);

      function myFunction(value, index, array) {
        total += value.total;
      }
      return total;
    },

    showGraphs(key) {
      switch (key) {
        case 1:
          this.showDataCase = 1;
          break;

        case 2:
          this.showDataCase = 2;
          break;
        default:
          break;
      }
    },

    printData() {
      var doc = new jsPDF("p", "pt", "a4");
      doc.setFontSize(this.fontSize);
      const graph = this.$refs.content;

      doc.html(graph, {
        callback: function (doc) {
          doc.save();
        },
      });
    },
  },
};
</script>
