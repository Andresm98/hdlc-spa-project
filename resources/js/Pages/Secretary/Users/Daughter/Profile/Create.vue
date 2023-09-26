<template>
  <!-- {{$daughter_custom}} -->
  <form @submit.prevent="submit" class="bg-gray-100 p-2 border-2 rounded-lg">
    <h6
      class="mt-2 mb-4 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
    >
      Crear Perfil Personal
    </h6>

    <div class="flex flex-wrap">
      <div class="w-full lg:w-4/12 px-4 my-4">
        <div class="">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Cédula de Identidad:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.identity_card"
          >
            {{ $page.props.errors.identity_card }}
          </p>
          <p
            class="text-red-400 text-sm"
            v-show="!validateIdentityCard || form.identity_card == ''"
          >
            Ingresar cédula o RUC válido
          </p>
          <small>Formato: Cédula Ecuatoriana</small>
          <!-- <jet-input-error :message="errors.identity_card" /> -->
          <div>
            <input
              type="text"
              minLength="10"
              maxlength="13"
              placeholder="0102211274 ó 0102211274001"
              pattern="[+-]?\d+(?:[.,]\d+)?"
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
              v-model="form.identity_card"
              required
            />
          </div>
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4 my-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Nacimiento:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.date_birth"
          >
            {{ $page.props.errors.date_birth }}
          </p>
          <small>Formato: Necesario</small>
          <Datepicker
            v-model="form.date_birth"
            :format="format"
            autoApply
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-2/5 px-4 mb-2">
        <div class="w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Provincia Nacimiento:
          </label>
          <div>
            <multiselect
              :searchable="true"
              v-model="selectOneBt.selectedProvince"
              :options="this.allProvinces"
              :close-on-select="true"
              :clear-on-select="false"
              mode="tags"
              label="name"
              @search-change="onSearchProvincesChangeBt"
              @select="onSelectedProvinceBt"
              track-by="name"
              placeholder="Buscar provincia"
            >
            </multiselect>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-3/5 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Cantón Nacimiento:
          </label>
          <div>
            <multiselect
              :searchable="true"
              v-model="selectTwoBt.selectedCanton"
              :options="selectTwoBt.options"
              :close-on-select="true"
              :clear-on-select="false"
              mode="tags"
              label="name"
              @select="onSelectedCantonBt"
              @search-change="onSearchCantonChangeBt"
              track-by="name"
              placeholder="Buscar cantón"
            >
            </multiselect>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-12/12 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Parroquia Nacimiento:
          </label>
          <div>
            <multiselect
              :searchable="true"
              v-model="selectThreeBt.selectedParish"
              :options="selectThreeBt.options"
              :close-on-select="true"
              :clear-on-select="false"
              label="name"
              @select="onSelectedParishBt"
              @search-change="onSearchParishChangeBt"
              track-by="name"
              placeholder="Buscar parroquia"
            >
            </multiselect>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-12/12 px-4">
        <div class="relative w-full mb-3">
          <label for="address" class="block text-sm font-medium text-gray-700">
            Lugar de Nacimiento Observaciones:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.address_bt"
          >
            {{ $page.props.errors.address_bt }}
          </p>
          <small>Formato: Ingrese la dirección máximo 100 caracteres.</small>
          <div class="mb-1">
            <textarea
              id="address_bt"
              name="address_bt"
              rows="1"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="form.address_bt"
              placeholder="Agregar la dirección actual.."
              :maxlength="100"
              required
            />
          </div>
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Vocación:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.date_vocation"
          >
            {{ $page.props.errors.date_vocation }}
          </p>
          <small>Formato: Necesario</small>
          <Datepicker v-model="form.date_vocation" :format="format" autoApply />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Admisión:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.date_vocation"
          >
            {{ $page.props.errors.date_vocation }}
          </p>
          <small>Formato: Opcional</small>
          <Datepicker
            v-model="form.date_vocation"
            :format="format"
            autoApply
            readonly
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Envío:
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_send">
            {{ $page.props.errors.date_send }}
          </p>
          <small>Formato: Opcional</small>
          <Datepicker v-model="form.date_send" :format="format" autoApply />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Votos:
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_vote">
            {{ $page.props.errors.date_vote }}
          </p>
          <small>Formato: Opcional</small>
          <Datepicker v-model="form.date_vote" :format="format" autoApply />
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
          <p class="text-red-400 text-sm" v-show="$page.props.errors.cellphone">
            {{ $page.props.errors.cellphone }}
          </p>
          <small>Formato: 0997643146</small>
          <input
            type="text"
            minLength="10"
            maxlength="10"
            pattern="^\d{10}$"
            title="Ingrese un número de celular con un formato válido, máximo 15 digitos."
            placeholder="123-4567-890"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="form.cellphone"
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
            Teléfono Convencional:
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.phone">
            {{ $page.props.errors.phone }}
          </p>
          <small>Formato: 022400111</small>

          <input
            type="text"
            minLength="9"
            maxlength="9"
            pattern="^\d{9}$"
            title="Ingrese un número de celular con un formato válido, máximo 12 digitos."
            placeholder="123-4567-890"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="form.phone"
          />
        </div>
      </div>

      <!-- Information Address -->

      <div class="w-full lg:w-full px-4">
        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">
            Dirección Residencia Actual:
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.address">
            {{ $page.props.errors.address }}
          </p>
          <small>Formato: Ingrese la dirección máximo 100 caracteres.</small>
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
      <div class="w-full lg:w-2/5 px-4 mb-2">
        <div class="w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Provincia Residencia:
          </label>
          <div :class="{ invalid: isInvalid }">
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
            <p class="text-red-400 text-sm" v-show="isInvalid">Obligatorio</p>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-3/5 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Cantón Residencia:
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
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Parroquia Residencia:
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

      <!--  Observations -->
      <div class="w-full lg:w-full px-4">
        <div>
          <label for="about" class="block text-sm font-medium text-gray-700">
            Observaciones generales:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.observation"
          >
            {{ $page.props.errors.observation }}
          </p>
          <small
            >Formato: Por favor ingresar las observaciones que usted crea
            pertinente relacionadas al perfil de la Hermana, deberán ser máximo
            2000 caracteres.</small
          >
          <div class="mt-1 bg-white">
            <textarea
              id="observation"
              name="observation"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="form.observation"
              placeholder="Agregar las observaciones generales..."
              required
              :maxlength="200"
            />
          </div>
        </div>
      </div>
    </div>
    <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
      >Crear Perfil</jet-button-success
    >
  </form>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";
import { mapState, mapMutations, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  //   Props
  props: {
    daughter_custom: Object,
    errors: null,
  },
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    JetInputError,
    moment,
  },
  //  Setup all data
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    const form = useForm({
      user_id: null,
      date_birth: null,
      identity_card: "",
      date_vocation: null,
      date_admission: null,
      date_send: null,
      date_vote: null,
      //   date_death: null,
      cellphone: null,
      phone: null,
      observation: null,

      //

      address: null,
      province_id: null,
      canton_id: null,
      parish_id: null,

      // Birth place

      address_bt: null,
      province_id_bt: null,
      canton_id_bt: null,
      parish_id_bt: null,
    });
    return {
      date,
      format,
      form,
    };
  },
  //  Return Data
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState({
      message: (state) => state.obj.message,
    }),

    // Validate Multioption
    isInvalid() {
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

    // Bt MlOption

    // Validate Multioption
    isInvalidBt() {
      return (
        this.selectOneBt.selectedProvince == undefined ||
        this.selectOneBt.selectedProvince == null
      );
    },
    isInvalidCantonBt() {
      return (
        this.selectTwoBt.selectedCanton == undefined ||
        this.selectTwoBt.selectedCanton == null
      );
    },
    isInvalidParishBt() {
      return (
        this.selectThreeBt.selectedParish == undefined ||
        this.selectThreeBt.selectedParish == null
      );
    },

    // Validate ID Card`
    validateIdentityCard() {
      this.form.identity_card = this.form.identity_card + "";
      //   console.log(typeof identity_card + "" + identity_card);
      if (this.form.identity_card == null) {
        return false;
      }
      if (
        this.form.identity_card.length == 10 ||
        this.form.identity_card.length == 13
      ) {
        const digit = this.form.identity_card.split("").map(Number);
        //   console.log(digit);
        const coefficient = [2, 1];
        var province_code = digit[0] * 10 + digit[1];
        var verification_code = digit.slice(9, 10);
        var dec, final_value, pivote;
        dec = final_value = pivote = 0;

        if (
          province_code >= 0 &&
          (province_code <= 24 || province_code == 30)
        ) {
          if (digit.length == 13) {
            digit.splice(9, 3);
          }
          for (let index = 0; index < 9; index++) {
            index % 2 == 0
              ? (pivote = digit[index] * coefficient[0])
              : (pivote = digit[index] * coefficient[1]);
            pivote >= 10
              ? (final_value += pivote - 9)
              : (final_value += pivote);
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
  // Data in this component
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

      //Provinces
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
      //
      selectOneBt: {
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
      selectTwoBt: {
        selectedCanton: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectCanton: null,
        vSelectCanton: null,
      },
      selectThreeBt: {
        selectedParish: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectParish: null,
        vSelectParish: null,
      },
    };
  },
  // Watch changes in data
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
    //
    "selectOneBt.selectedProvince": function () {
      if (this.selectOneBt.selectedProvince === null) {
        this.selectTwoBt.selectedCanton = null;
        this.selectThreeBt.selectedParish = null;
        this.selectTwoBt.options = [];
        this.selectThreeBt.options = [];
        // Clean data Form
        this.form.province_id_bt = null;
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
    "selectTwoBt.selectedCanton": function () {
      if (this.selectTwoBt.selectedCanton === null) {
        this.selectThreeBt.selectedParish = null;
        this.selectThreeBt.options = [];
        // Clean data Form
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
    "selectThreeBt.selectedParish": function () {
      if (this.selectThreeBt.selectedParish === null) {
        // Clean data Form
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
  },
  // Mehods in this component
  methods: {
    muestra() {
      //   console.log("abrir");
    },

    cerrado() {
      //   console.log("cerrado");
    },

    blur() {
      //   console.log("blurrr");
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

    onSearchCantonChange(term) {},

    onSelectedCanton(canton) {
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
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {},

    onSelectedParish(parish) {
      this.form.parish_id = parish.id;
      this.form.political_division_id = parish.id;
    },

    // Address Bt

    onSearchProvincesChangeBt(term) {},

    onSelectedProvinceBt(province) {
      this.form.province_id_bt = province.id;
      this.form.canton_id_bt = null;
      this.form.parish_id_bt = null;
      this.form.political_division_id_bt = null;
      this.selectTwoBt.selectedCanton = undefined;
      this.selectThreeBt.selectedParish = undefined;
      this.selectTwoBt.options = [];
      this.selectThreeBt.options = [];
      axios
        .get(
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          this.selectTwoBt.options = res.data;
        });
    },

    onSearchCantonChangeBt(term) {},

    onSelectedCantonBt(canton) {
      this.form.canton_id_bt = canton.id;
      this.form.parish_id_bt = null;
      this.form.political_division_id_bt = null;
      this.selectThreeBt.selectedParish = undefined;
      this.selectThreeBt.options = [];

      axios
        .get(
          this.route("secretary.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          this.selectThreeBt.options = res.data;
        });
    },

    onSearchParishChangeBt(term) {},

    onSelectedParishBt(parish) {
      this.form.parish_id_bt = parish.id;
      this.form.political_division_id_bt = parish.id;
    },

    //   Mutations

    ...mapMutations("daughter", ["updateProfile"]),

    ...mapGetters("daughter", ["profileDaughter"]),

    updateData() {
      let dataaddresbt = null;

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt === null &&
        this.form.parish_id_bt === null
      ) {
        dataaddresbt = this.form.province_id_bt;
      }

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt !== null &&
        this.form.parish_id_bt === null
      ) {
        dataaddresbt = this.form.canton_id_bt;
      }

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt !== null &&
        this.form.parish_id_bt !== null
      ) {
        dataaddresbt = this.form.parish_id_bt;
      }

      this.updateProfile({
        observation: this.form.observation,
        cellphone: this.form.cellphone,
        identity_card: this.form.identity_card,
        cellphone: this.form.cellphone,
        phone: this.form.phone,
        observation: this.form.observation,
        date_birth: this.formatDate(this.form.date_birth),
        date_vocation: this.formatDate(this.form.date_vocation),
        date_admission: this.formatDate(this.form.date_admission),
        date_send: this.formatDate(this.form.date_send),
        date_vote: this.formatDate(this.form.date_vote),
        // date_death: this.formatDate(this.form.date_death),
        user_id: this.profile.user_id,
        //  Address Object
        address: {
          address: this.form.address,
          political_division_id: this.form.parish_id,
        },
        //
        address_bt: {
          address_bt: this.form.address_bt,
          political_division_id_bt: dataaddresbt,
        },
      });
    },
    submit() {
      this.form.user_id = this.profile.user_id;
      this.updateData();
      if (
        this.isInvalid == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCard == true
      ) {
        Inertia.post(route("secretary.daughters-profile.store"), this.profile, {
          preserveScroll: true,
        });
      }
    },

    formatDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return null;
    },
  },
};
</script>

<style>
.dp-custom-menu {
  box-shadow: 0 0 6px #2d5a0f;
}
</style>
