<template>
  <!-- {{$daughter_custom}} -->
  <form @submit.prevent="submit" class="bg-gray-100 p-2 border-2 rounded-lg">
    <h6
      class="mt-2 mb-4 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
    >
      Crear Perfil Personal
    </h6>

    <div class="flex flex-wrap">
      <div class="w-full lg:w-4/12 px-4">
        <div class="">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Cédula de Identidad
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.identity_card">
            {{ $page.props.errors.identity_card }}
          </p>
          <p
            class="text-red-400 text-sm"
            v-show="!validateIdentityCard || form.identity_card == ''"
          >
            Ingresar cédula o RUC válido
          </p>
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
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Nacimiento
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_birth">
            {{ $page.props.errors.date_birth }}
          </p>
          <Datepicker
            v-model="form.date_birth"
            :format="format"
            @blur="blur"
            @focus="muestra"
            @closed="cerrado"
            :transitions="false"
            menuClassName="dp-custom-menu"
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Vocación
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_vocation">
            {{ $page.props.errors.date_vocation }}
          </p>
          <Datepicker
            class=""
            v-model="form.date_vocation"
            :format="format"
            :transitions="false"
            menuClassName="dp-custom-menu"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Admisión
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_admission">
            {{ $page.props.errors.date_admission }}
          </p>
          <Datepicker
            class=""
            v-model="form.date_admission"
            :format="format"
            :transitions="false"
            menuClassName="dp-custom-menu"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Envío
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_send">
            {{ $page.props.errors.date_send }}
          </p>
          <Datepicker
            class=""
            v-model="form.date_send"
            :format="format"
            :transitions="false"
            menuClassName="dp-custom-menu"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Votos
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_vote">
            {{ $page.props.errors.date_vote }}
          </p>
          <Datepicker
            class=""
            v-model="form.date_vote"
            :format="format"
            :transitions="false"
            menuClassName="dp-custom-menu"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Fecha de Muerte
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_death">
            {{ $page.props.errors.date_death }}
          </p>
          <Datepicker
            class=""
            v-model="form.date_death"
            :format="format"
            :transitions="false"
            menuClassName="dp-custom-menu"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Celular
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.cellphone">
            {{ $page.props.errors.cellphone }}
          </p>
          <input
            type="text"
            minLength="10"
            maxlength="15"
            pattern="[0-9]+"
            placeholder="123-4567-890"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="form.cellphone"
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Teléfono Convencional
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.phone">
            {{ $page.props.errors.phone }}
          </p>
          <input
            type="text"
            minLength="10"
            maxlength="15"
            pattern="[0-9]+"
            placeholder="123-4567-890"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="form.phone"
            required
          />
        </div>
      </div>

      <!-- Information Address -->

      <div class="w-full lg:w-full px-4">
        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">
            Dirección Actual
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.address">
            {{ $page.props.errors.address }}
          </p>
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
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
            Provincia
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
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
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
            <p class="text-sm text-red-400" v-show="isInvalidCanton">Obligatorio</p>
          </div>
        </div>
      </div>

      <div class="w-full lg:w-12/12 px-4 mb-2">
        <div class="relative w-full">
          <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
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
            <p class="text-sm text-red-400" v-show="isInvalidParish">Obligatorio</p>
          </div>
        </div>
      </div>

      <!--  Observations -->
      <div class="w-full lg:w-full px-4">
        <div>
          <label for="about" class="block text-sm font-medium text-gray-700">
            Observaciones generales
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.observation">
            {{ $page.props.errors.observation }}
          </p>
          <div class="mt-1 bg-white">
            <!-- <quill-editor
              v-model:content="form.observation"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
            ></quill-editor> -->
            <textarea
              id="observation"
              name="observation"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="form.observation"
              placeholder="Agregar las observaciones generales..."
              required
              :maxlength="4000"
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
      date_death: null,
      cellphone: null,
      phone: null,
      observation: null,
      address: null,
      province_id: null,
      canton_id: null,
      parish_id: null,
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

    // Validate ID Card`
    validateIdentityCard() {
      this.form.identity_card = this.form.identity_card + "";
      //   console.log(typeof identity_card + "" + identity_card);
      if (this.form.identity_card == null) {
        return false;
      }
      if (this.form.identity_card.length == 10 || this.form.identity_card.length == 13) {
        const digit = this.form.identity_card.split("").map(Number);
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
          this.route("secretary.daughters-profile.cantons", {
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
          this.route("secretary.daughters-profile.parishes", {
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

    //   Mutationss
    // updateMessage(e) {
    //   this.$store.commit("updateMessage", e.target.value);
    // },
    ...mapMutations("daughter", ["updateProfile"]),
    ...mapGetters("daughter", ["profileDaughter"]),

    updateData() {
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
        date_death: this.formatDate(this.form.date_death),
        user_id: this.profile.user_id,
        //  Address Object
        address: {
          address: this.form.address,
          political_division_id: this.form.parish_id,
        },
      });
    },

    // Send Data
    submit() {
      this.form.user_id = this.profile.user_id;
      this.updateData();
      if (
        this.isInvalid == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCard == true
      ) {
        // console.log("listo: ", this.profile);
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
