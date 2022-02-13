<template >
  <!-- {{$daughter_custom}} -->
  <form @submit.prevent="submit" class="bg-gray-100 p-2 border-2 rounded-lg">
    <h6
      class="
        mt-2
        mb-4
        text-lg
        font-medium
        text-center
        leading-6
        text-gray-900
        uppercase
      "
    >
      Crear Perfil Personal
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Cédula de Identidad
          </label>
          <div>
            <input
              type="text"
              minLength="10"
              maxlength="13"
              placeholder="0102211274 ó 0102211274001"
              pattern="[+-]?\d+(?:[.,]\d+)?"
              class="
                border-0
                px-3
                py-3
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
              v-model="form.identity_card"
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
            Fecha de Nacimiento
          </label>
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
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Fecha de Vocación
          </label>
          <Datepicker
            class=""
            v-model="form.date_vocation"
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
            Fecha de Admisión
          </label>
          <Datepicker
            class=""
            v-model="form.date_admission"
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
            Celular
          </label>
          <input
            type="text"
            minLength="10"
            maxlength="20"
            pattern="[0-9]+"
            placeholder="123-4567-890"
            class="
              border-0
              px-3
              py-3
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
            Teléfono Convencional
          </label>
          <input
            type="text"
            minLength="10"
            maxlength="20"
            pattern="[0-9]+"
            placeholder="123-4567-890"
            class="
              border-0
              px-3
              py-3
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
          <div class="mb-1">
            <textarea
              id="address"
              name="address"
              rows="1"
              class="
                shadow-sm
                focus:ring-blue-500 focus:border-blue-500
                mt-1
                mb-2
                block
                w-full
                sm:text-sm
                border border-gray-300
                rounded-md
              "
              v-model="form.address"
              placeholder="Agregar la dirección actual.."
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
        <div class="relative w-full">
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

      <!--  Observations -->
      <div class="w-full lg:w-full px-4">
        <div>
          <label for="about" class="block text-sm font-medium text-gray-700">
            Observaciones generales
          </label>
          <div class="mt-1">
            <textarea
              id="observation"
              name="observation"
              rows="6"
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
              v-model="form.observation"
              placeholder="Agregar las observaciones generales..."
              required
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

export default {
  //   Props
  props: {
    daughter_custom: Object,
  },
  //  Return Data
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState({
      message: (state) => state.obj.message,
    }),
    isInvalid() {
      console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOne.selectedProvince == undefined ||
        this.selectOne.selectedProvince == null
      );
    },
    isInvalidCanton() {
      console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwo.selectedCanton == undefined ||
        this.selectTwo.selectedCanton == null
      );
    },
    isInvalidParish() {
      console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedParish == undefined ||
        this.selectThree.selectedParish == null
      );
    },
  },
  // Data in this component
  data() {
    return {
      selected: null,
      options: ["list", "of", "options"],
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
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    moment,
  },
  // Setup Date
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    const form = useForm({
      user_id: null,
      date_birth: null,
      identity_card: null,
      date_vocation: null,
      date_admission: null,
      cellphone: null,
      phone: null,
      observation: null,
      address: null,
      province_id: null,
      canton_id: null,
      parish_id: null,
      political_division_id: null,
    });
    return {
      date,
      format,
      form,
    };
  },
  // Mehods in this component
  methods: {
    muestra() {
      console.log("abrir");
    },
    cerrado() {
      console.log("cerrado");
    },
    blur() {
      console.log("blurrr");
    },
    onSearchProvincesChange(term) {
      console.log("input data search " + term);
    },
    onSelectedProvince(province) {
      console.log("input data selecter " + province.id);
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
          console.log(res.data);
          this.selectTwo.options = res.data;
        });
    },

    onSearchCantonChange(term) {
      console.log(term);
    },
    onSelectedCanton(canton) {
      console.log("input data selecter " + canton.id);
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
          console.log(res.data);
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {
      console.log(term);
    },
    onSelectedParish(parish) {
      this.form.parish_id = parish.id;
      this.form.political_division_id = parish.id;
      console.log("input parish data selecter " + this.form.parish_id);
    },

    //   Mutationss
    updateMessage(e) {
      this.$store.commit("updateMessage", e.target.value);
    },
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
        user_id: this.profile.user_id,
        //  Address
        address: this.form.address,
        political_division_id: this.form.parish_id,
      });
    },

    // Send Data
    submit() {
      this.form.date_birth = this.form.date_birth;
      this.form.date_vocation = this.form.date_vocation;
      this.form.date_admission = this.form.date_admission;
      this.form.user_id = this.profile.user_id;
      this.updateData();
      if (
        this.isInvalid == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false
      ) {
        Inertia.post(route("secretary.daughters-profile.store"), this.profile);
      }
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    createProfile() {
      console.log("send " + this.form);
      if (this.validateIdentityCard(this.form.identity_card)) {
        form.post(route("secretary.daughters-profile.store"));
      } else {
        alert("DNI No funciona");
      }
    },

    validateIdentityCard(identity_card) {
      identity_card = identity_card + "";
      console.log(typeof identity_card + "" + identity_card);

      try {
        if (identity_card.length == 10 || identity_card.length == 13) {
          const digit = identity_card.split("").map(Number);
          console.log(digit);
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
      } catch (error) {
        console.log(error);
      }
    },

    inAscOrder(arr) {
      return arr.every(function (_, i) {
        return i == 0 || arr[i] >= arr[i - 1];
      });
    },
  },
};
</script>

<style >
.dp-custom-menu {
  box-shadow: 0 0 6px #2d5a0f;
}
</style>

