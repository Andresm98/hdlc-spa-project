<template >
  <!-- {{$daughter_custom}} -->
  <form
    @submit.prevent="submit"
    class="
      bg-gradient-to-r
      from-slate-800
      via-slate-800
      to-slate-700
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
              v-model="this.profile.address['address']"
              placeholder="Agregar la dirección actual.."
            />
          </div>
        </div>
      </div>

      <div class="w-full lg:w-2/5 px-4 mb-2">
        <div class="relative w-full">
          <label
            class="block text-sm font-medium text-white"
            htmlfor="grid-password"
          >
            Provincia
          </label>
          <div>
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
          </div>
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
import Multiselect from "@suadelabs/vue3-multiselect";

export default {
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState({
      message: (state) => state.obj.message,
    }),
  },
  components: { Datepicker, JetButton, moment, Multiselect },
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
        value: "020251",
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
    onSelectedProvince(province) {
      console.log("se muestran");
    },
    onSearchProvincesChange() {


    },
    //   Mutationss


    localData() {
      console.log("TIPS " + this.profileDaughter());
    },
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
        // user_id: this.form.user_id,
      });
    },

    /*
     * Send Data to Update Data
     */
    submit() {
      this.form.identity_card = this.profile.identity_card;
      this.form.cellphone = this.profile.cellphone;
      this.form.phone = this.profile.phone;
      this.form.observation = this.profile.observation;
      this.form.date_birth = this.profile.date_birth;
      this.form.date_vocation = this.profile.date_vocation;
      this.form.date_admission = this.profile.date_admission;
      //   this.form.user_id = this.profile.user_id;
      this.updateData();
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
