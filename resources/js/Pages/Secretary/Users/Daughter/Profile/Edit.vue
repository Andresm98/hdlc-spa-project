<template >
  <!-- {{$daughter_custom}} -->
  <form
    @submit.prevent="submit"
    class="
      bg-gradient-to-r
      from-slate-800
      via-slate-800
      to-slate-800
      p-2
      border-2
      rounded-lg
    "
  >
    <h6
      class="
        mt-2
        mb-4
        text-lg
        font-medium
        text-center
        leading-6
        text-white
        uppercase
      "
    >
      Editar Perfil Personal
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
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
              v-model="profile.identity_card"
              required
            />
          </div>
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Fecha de Nacimiento
          </label>
          <Datepicker
            class="
              border-0
              py-0.5
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
            v-model="profile.date_birth"
            :format="format"
            required
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Fecha de Vocación
          </label>
          <Datepicker
            class="
              border-0
              py-0.5
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
            v-model="profile.date_vocation"
            :format="format"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Fecha de Admisión
          </label>
          <Datepicker
            class="
              border-0
              py-0.5
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
            v-model="profile.date_admission"
            :format="format"
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
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
            v-model="profile.cellphone"
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-white"
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
            v-model="profile.phone"
            required
          />
        </div>
      </div>

      <!-- Address Information -->

      <div class="w-full lg:w-full px-4">
        <div>
          <label for="address" class="block text-sm font-medium text-white">
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
              v-model="profile.address['address']"
              placeholder="Agregar la dirección actual.."
            />
          </div>
        </div>
      </div>

      <div class="w-full lg:w-2/5 px-4 mb-2">
        <div class="w-full">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Provincia
          </label>
          <div>
            <multiselect
              class="absolute"
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
          </div>
        </div>
      </div>
      <div class="w-full lg:w-3/5 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Cantón
          </label>
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
        </div>
      </div>

      <div class="w-full lg:w-12/12 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Parroquia
          </label>
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
        </div>
      </div>

      <!-- Observations -->
      <div class="w-full lg:w-full px-4">
        <div>
          <label for="about" class="block text-sm font-medium text-white">
            Observaciones generales
          </label>
          <div class="mt-1">
            <textarea
              id="observation"
              name="observation"
              rows="5"
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
              v-model="profile.observation"
              placeholder="Agregar las observaciones generales..."
            />
          </div>
        </div>
        <div class="mr-9 ml-9 mt-2 text-center">
          <p class="text-sm text-white">
            Fecha creación del perfil: {{ this.formatDate(profile.created_at) }}
          </p>
          <p class="text-sm text-white">
            Fecha actualización del perfil:
            {{ this.formatDate(profile.updated_at) }}
          </p>
        </div>
      </div>
    </div>
    <jet-button type="submit" class="ml-4 mt-4 btn btn-primary"
      >Actualizar Perfil</jet-button
    >
  </form>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import moment from "moment";
import "vue3-date-time-picker/dist/main.css";
import { mapState, mapMutations, mapGetters } from "vuex";
import { Inertia } from "@inertiajs/inertia";

export default {
  mounted() {
    this.status().then((data) => {
      console.log(data);
      this.selectThree.options = data.parishes;
      this.selectThree.selectedParish = data.data_parish;

      this.selectTwo.options = data.cantons;
      this.selectTwo.selectedCanton = data.data_canton;

      this.selectOne.selectedProvince = data.data_province;
    });

    // // console.log(global_address);

    // this.selectThree.selectedParish = {
    //   id: "02",
    //   name: this.profile.address["name"],
    // };
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState({
      message: (state) => state.obj.message,
    }),
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
  components: { Datepicker, JetButton, moment },
  props: { daughter_custom: Object },
  setup() {
    const formatSet = "YYYY-MM-DD";
    let date = new Date();
    var format = (date) => {
      console.log("set " + date);
      date.setDate(date.getDate());
      console.log("curr: " + date);
      return moment(date).format(formatSet);
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
      address: {
        address: null,
        political_division_id: null,
      },
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

  data() {
    return {
      example1: {
        value: "Robin",
        options: ["Batman", "Robin", "Joker"],
      },
      selectOne: {
        selectedProvince: undefined,
        value: 0,
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

  methods: {
    async status() {
      console.log("perfil");
      let response = await axios.get(
        this.route("secretary.daughters-profile.actual-address", {
          actual_parish: this.profile.address["political_division_id"],
        })
      );
      return response.data;
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
      this.profile.address["political_division_id"] = parish.id;
      console.log("input parish data selecter " + this.form.parish_id);
    },

    localData() {
      console.log("TIPS " + this.profileDaughter());
    },
    updateMessage(e) {
      this.$store.commit("updateMessage", e.target.value);
    },
    ...mapMutations("daughter", ["updateProfile"]),
    ...mapGetters("daughter", ["profileDaughter"]),

    /*
     * Send Data to Update Data
     */
    submit() {
      this.profile.date_birth = this.formatDate(this.profile.date_birth);
      this.profile.date_vocation = this.formatDate(this.profile.date_vocation);
      this.profile.date_admission = this.formatDate(
        this.profile.date_admission
      );

      //   console.log(this.profile);
      Inertia.put(
        route("secretary.daughters-profile.update", {
          profile_custom_id: this.profile.user_id,
        }),
        this.profile
      );
      //   this.form.post(route("secretary.daughters-profile.create"));
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
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
