<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">Crear Obras</h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <alert
      v-if="$page.props.flash.success"
      class="alert"
      :type_alert_r="(type_alert = 'success')"
      :message="$page.props.flash.success"
    >
    </alert>
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
            Información General de la Obra
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
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_3.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg sm:block sm:col-span-2 md:col-span-1 lg:row-start-2 lg:col-span-2 lg:h-32"
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_1.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg md:block lg:row-start-2 lg:col-span-2 lg:h-32"
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
            <span>0.00 <span class="text-slate-400 font-normal">(0)</span></span>
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
              La presente plantiflla de información se relaciona con los datos principales
              de la obra a la que desea modificar al sistema, por lo que deberá verificar
              los datos a ingresar.
            </p>
            <ul class="list-disc pl-5">
              <li class="dark:text-white">
                <p class="mt-2 pt-6 text-sm uppercase">
                  Nombre de obra único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Correo electrónico único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">Números de contacto.</p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Fechas de fundación de la obra.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">Número de colaboradores.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="py-1 bg-slate-800 rounded-lg m-1">
      <div class="w-full lg:w-5/6 px-4 mx-auto mt-6">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div class="bg-slate-200 hover:bg-slate-200 rounded-lg">
            <form @submit.prevent="submit" class="">
              <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                  <h6 class="text-lg font-medium leading-6 text-gray-900">
                    Tarjeta de Información General de la Obra
                  </h6>
                  <button
                    class="bg-green-500 hover:bg-green-700 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    type="submit"
                  >
                    Crear Obra
                  </button>
                </div>
              </div>
              <hr />
              <h6 class="mt-2 text-lg font-medium text-center leading-6 text-gray-900">
                Información General
              </h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-3/3 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombre:
                    </label>
                    <jet-input-error :message="errors.comm_name" />
                    <small>Formato: Ingresar el nombre de la obra.</small>

                    <input
                      type="text"
                      placeholder="Nombre de la obra en el Sistema"
                      class="border-0 px-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.comm_name"
                      required
                    />
                  </div>
                </div>
              </div>

              <div class="flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Correo Electrónico:
                  </label>

                  <jet-input-error :message="errors.comm_email" />
                  <small>Formato: Ingresar un correo de contacto.</small>
                  <input
                    type="email"
                    placeholder="micorreo@correo.com"
                    class="border-0 px-3 mb-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.comm_email"
                    required
                  />
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Número de RUC:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="!validateIdentityCard || this.form.comm_identity_card == ''"
                  >
                    Ingresar RUC válido
                  </p>
                  <jet-input-error :message="errors.comm_identity_card" />
                  <small>Formato: Ingresar RUC Formato Ecuador. </small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="13"
                    placeholder="0102211274 ó 0102211274001"
                    pattern="[+-]?\d+(?:[.,]\d+)?"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.comm_identity_card"
                    @keydown.space.prevent
                    required
                  />
                </div>
              </div>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de Fundación:
                    </label>

                    <jet-input-error :message="errors.date_fndt_comm" />
                    <small>Formato: Ingresar la fecha de fundación de la obra.</small>
                    <Datepicker
                      v-model="form.date_fndt_comm"
                      :format="format"
                      :transitions="false"
                      menuClassName="dp-custom-menu"
                      required
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de la Obra:
                    </label>

                    <jet-input-error :message="errors.date_fndt_work" />
                    <small>Formato: Ingresar la fecha de la obra.</small>
                    <Datepicker
                      v-model="form.date_fndt_work"
                      :format="format"
                      :transitions="false"
                      menuClassName="dp-custom-menu"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Celular:
                    </label>

                    <jet-input-error :message="errors.comm_cellphone" />
                    <small>Formato: Ingresar un número de celular.</small>
                    <input
                      minLength="10"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.comm_cellphone"
                      @keydown.space.prevent
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Teléfono:
                    </label>

                    <jet-input-error :message="errors.comm_phone" />
                    <small>Formato: Ingresar un número de teléfono.</small>
                    <input
                      minLength="8"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.comm_phone"
                      @keydown.space.prevent
                    />
                  </div>
                </div>

                <div class="w-full lg:w-3/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nro. de Colaboradores:
                    </label>

                    <jet-input-error :message="errors.rn_collaborators" />
                    <small>Formato: Número de colaboradores, max 1000.</small>

                    <input
                      minLength="0"
                      maxLength="1000"
                      pattern="[0-9]+"
                      placeholder="Nro. de Colaboradores"
                      type="number"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.rn_collaborators"
                      @keydown.space.prevent
                      required
                    />
                  </div>
                </div>

                <div class="w-full lg:w-5/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Pastoral:
                    </label>
                    <small
                      >Formato: Seleccionar la pastoral a la que pertenece la
                      comunidad.</small
                    >
                    <div
                      :class="{ invalid: isInvalidPastoral }"
                      v-if="this.allPastoral != null"
                    >
                      <multiselect
                        :searchable="true"
                        v-model="selectFour.selectedPastoral"
                        :options="this.allPastoral"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @search-change="onSearchPrastoralsChange"
                        @select="onSelectedPastoral"
                        track-by="name"
                        placeholder="Buscar pastoral"
                      >
                      </multiselect>
                      <p class="text-red-400 text-sm" v-show="isInvalidPastoral">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Information Address -->
                <hr
                  class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
                />
                <div class="w-full lg:w-full px-4">
                  <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">
                      Dirección Actual:
                    </label>
                    <p class="text-red-400 text-sm" v-show="$page.props.errors.address">
                      {{ $page.props.errors.address }}
                    </p>
                    <small
                      >Formato: Dirección actual en la que se encuentra la
                      comunidad.</small
                    >
                    <div class="mb-1">
                      <textarea
                        id="address"
                        name="address"
                        rows="1"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                        v-model="form.address"
                        placeholder="Agregar la dirección actual.."
                        :maxlength="100"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3" v-if="this.allProvinces != null">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Provincia
                    </label>
                    <div :class="{ invalid: isInvalidProvince }">
                      <multiselect
                        :searchable="true"
                        v-model="selectOne.selectedProvince"
                        :options="this.allProvinces"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @search-change="onSearchProvincesChange"
                        @select="onSelectedProvince"
                        track-by="name"
                        placeholder="Buscar provincia"
                      >
                      </multiselect>
                      <p class="text-red-400 text-sm" v-show="isInvalidProvince">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
                <div class="w-full lg:w-8/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Cantón
                    </label>
                    <div :class="{ invalid: isInvalidCanton }">
                      <multiselect
                        :searchable="true"
                        v-model="selectTwo.selectedCanton"
                        :options="selectTwo.options"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @select="onSelectedCanton"
                        @search-change="onSearchCantonChange"
                        track-by="name"
                        placeholder="Buscar cantón"
                      >
                      </multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidCanton">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>

                <div class="w-full lg:w-12/12 px-4 mb-2">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Parroquia
                    </label>
                    <div :class="{ invalid: isInvalidParish }">
                      <multiselect
                        :searchable="true"
                        v-model="selectThree.selectedParish"
                        :options="selectThree.options"
                        :close-on-select="true"
                        :clear-on-select="false"
                        label="name"
                        @select="onSelectedParish"
                        @search-change="onSearchParishChange"
                        track-by="name"
                        placeholder="Buscar parroquia"
                      >
                      </multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidParish">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <hr
              class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
            />
          </div>
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetCheckbox from "@/Jetstream/Checkbox";
import Alert from "@/Components/Alert";
import { ref } from "vue";
import Datepicker from "vue3-date-time-picker";
import moment from "moment";
import { mapState, mapActions, mapGetters } from "vuex";

export default {
  props: {
    address: Object,
    community_custom: null,
    errors: null,
    provinces: {
      type: Array,
    },
  },
  created() {
    // console.log("created " + this.$el);
    axios.get(this.route("secretary.address.province")).then((res) => {
      this.uploadProvinces(res.data);
    });

    // Method fetch

    fetch(this.route("secretary.pastoral.index"))
      .then(async (response) => {
        const isJson = response.headers.get("content-type")?.includes("application/json");
        const data = isJson && (await response.json());
        if (!response.ok) {
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }
        this.allPastoral = data;
      })
      .catch((error) => {
        element.parentElement.innerHTML = `Error: ${error}`;
        console.error("There was an error!", error);
      });
  },

  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    const form = useForm({
      comm_identity_card: "",
      comm_name: null,
      comm_cellphone: null,
      comm_phone: null,
      comm_email: null,
      date_fndt_comm: null,
      date_fndt_work: null,
      rn_collaborators: null,
      address: null,
      province_id: null,
      canton_id: null,
      parish_id: null,
      political_division_id: null,
      pastoral_id: null,
      file: null,
    });
    return { form, format, date };
  },

  data() {
    return {
      selectOne: {
        selectedProvince: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },
      selectTwo: {
        selectedCanton: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectCanton: null,
        vSelectCanton: null,
      },
      selectThree: {
        selectedParish: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectParish: null,
        vSelectParish: null,
      },
      selectFour: {
        selectedPastoral: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectPastoral: null,
        vSelectPastoral: null,
      },
      allPastoral: null,
    };
  },
  layout: PrincipalLayout,
  components: {
    Link,
    JetInputError,
    JetInput,
    JetLabel,
    JetButton,
    JetCheckbox,

    Datepicker,
    moment,
    Alert,
    AppLayout,
  },

  computed: {
    ...mapState("address", ["allProvinces"]),
    // Validate Multioption
    isInvalidProvince() {
      //   console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOne.selectedProvince == undefined ||
        this.selectOne.selectedProvince == null
      );
    },
    isInvalidCanton() {
      //   console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwo.selectedCanton == undefined ||
        this.selectTwo.selectedCanton == null
      );
    },
    isInvalidParish() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedParish == undefined ||
        this.selectThree.selectedParish == null
      );
    },

    isInvalidPastoral() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectFour.selectedPastoral == undefined ||
        this.selectFour.selectedPastoral == null
      );
    },

    // Validate ID Card`
    validateIdentityCard() {
      this.form.comm_identity_card = this.form.comm_identity_card + "";
      if (this.form.comm_identity_card == null) {
        return false;
      }
      if (
        this.form.comm_identity_card.length == 10 ||
        this.form.comm_identity_card.length == 13
      ) {
        const digit = this.form.comm_identity_card.split("").map(Number);
        //   console.log(digit);
        const coefficient = [2, 1];
        var province_code = digit[0] * 10 + digit[1];
        var verification_code = digit.slice(9, 10);
        var dec, final_value, pivote;
        dec = final_value = pivote = 0;

        if (province_code >= 0 && (province_code <= 24 || province_code == 30)) {
          if (digit.length == 13) {
            digit.splice(9, 3);
          }
          for (let index = 0; index < 9; index++) {
            index % 2 == 0
              ? (pivote = digit[index] * coefficient[0])
              : (pivote = digit[index] * coefficient[1]);
            pivote >= 10 ? (final_value += pivote - 9) : (final_value += pivote);
            pivote = 0;
          }
          dec = final_value + (10 - (final_value % 10));
          dec = dec - final_value;
          return dec == 10 || dec == verification_code ? true : false;
        }
        return false;
      }

      return false;
    },
  },

  watch: {
    "selectOne.selectedProvince": function () {
      if (this.selectOne.selectedProvince === null) {
        this.selectTwo.selectedCanton = null;
        this.selectThree.selectedParish = null;
        this.selectTwo.options = [];
        this.selectThree.options = [];
        // Clean data Form
        this.form.province_id = null;
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },
    "selectTwo.selectedCanton": function () {
      if (this.selectTwo.selectedCanton === null) {
        this.selectThree.selectedParish = null;
        this.selectThree.options = [];
        // Clean data Form
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },
    "selectThree.selectedParish": function () {
      if (this.selectThree.selectedParish === null) {
        // Clean data Form
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },
  },
  methods: {
    handleScroll() {
      console.log(window.scrollY);
    },
    async status() {
      this.form.address = this.community_custom.address["address"];
      this.form.political_division_id = this.community_custom.address[
        "political_division_id"
      ];
      let response = await axios.get(
        this.route("secretary.address.actual-address", {
          actual_parish: this.community_custom.address["political_division_id"],
        })
      );
      return response.data;
    },
    onSearchPrastoralsChange() {},
    onSelectedPastoral(pastoral) {
      this.form.pastoral_id = pastoral.id;
    },
    onSearchProvincesChange(term) {
      //   console.log("input data search " + term);
    },

    onSelectedProvince(province) {
      //   console.log("input data selecter " + province.id);
      this.form.province_id = province.id;
      this.form.canton_id = null;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectTwo.selectedCanton = undefined;
      this.selectThree.selectedParish = undefined;
      this.selectTwo.options = [];
      this.selectThree.options = [];
      axios
        .get(
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.selectTwo.options = res.data;
        });
    },

    onSearchCantonChange(term) {
      //   console.log(term);
    },

    onSelectedCanton(canton) {
      //   console.log("input data selecter " + canton.id);
      this.form.canton_id = canton.id;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectThree.selectedParish = undefined;
      this.selectThree.options = [];

      axios
        .get(
          this.route("secretary.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {
      //   console.log(term);
    },

    onSelectedParish(parish) {
      this.form.parish_id = parish.id;
      this.form.political_division_id = parish.id;
      //   console.log("input parish data selecter " + this.form.parish_id);
    },

    ...mapActions("address", ["uploadProvinces"]),

    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
    submit() {
      this.form.date_fndt_comm = this.formatDate(this.form.date_fndt_comm);
      if (this.form.date_fndt_work != null) {
        this.form.date_fndt_work = this.formatDate(this.form.date_fndt_work);
      }
      if (
        this.isInvalidProvince == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.isInvalidPastoral == false &&
        this.validateIdentityCard == true
      ) {
        this.form.post(route("secretary.worksindividual.store"), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              console.log("saved.");
            }, 1000);
          },
        });
      }
    },

    onChange(value) {
      this.value = value;
      console.log("aiudaaa> ", value);
      if (value.indexOf("Reset me!") !== -1) {
        console.log("is reset");
        this.value = [];
      }
    },
    onSelect(option) {
      if (option === "Disable me!") {
        console.log("is disable");
        this.isDisabled = true;
      }
    },
    onTouch() {
      console.log("is touched");
      this.isTouched = true;
    },
  },
};
</script>
