<template>
  <form @submit.prevent="createProfile">
    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 ml-4 font-bold uppercase">
      Perfil de Hermana
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-12/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
            htmlfor="grid-password"
          >
            Dirección Actual
          </label>
          <input
            type="text"
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
            v-model="form.address"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
            htmlfor="grid-password"
          >
            Comunidad
          </label>
          <input
            type="text"
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
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
            htmlfor="grid-password"
          >
            País
          </label>
          <input
            type="text"
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
            value="Ecuador"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
            htmlfor="grid-password"
          >
            Fecha
          </label>
          <Datepicker v-model="form.current_date" :format="format" />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4"></div>
    </div>

    <jet-button type="submit" class="ml-4 btn btn-primary">Aceptar</jet-button>
  </form>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";

import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";

export default {
  components: { Datepicker, JetButton },
  props: { identity_card: String },
  setup() {
    const date = ref(new Date());
    var current = "";
    var format = (date) => {
      var dat, dat2;
      const year = date.getFullYear();
      const month = date.getMonth() + 1;
      const day = date.getDate();
      dat = month;
      dat2 = day;
      if (month < 10) {
        dat = "0" + month;
      }
      if (day < 10) {
        dat2 = "0" + day;
      }
      current = `${year}-${dat}-${dat2}`;
      return `${year}-${dat}-${dat2}`;
    };

    const form = useForm({
      current_date: null,
      identity_card: null,
      address: null,
    });

    return {
      date,
      format,
      form,
    };
  },

  methods: {
    createProfile() {
      console.log(
        "A) " + this.form.identity_card + "\nB) " + this.form.current_date
      );
      if (this.validateIdentityCard(this.form.identity_card)) {
        console.log("Success");
      } else {
        console.log("Error");
      }
    },

    validateIdentityCard(identity_card) {
      try {
        if (
          typeof identity_card == "string" &&
          (identity_card.length == 10 || identity_card.length == 13)
        ) {
          const digit = identity_card.split("").map(Number);
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
