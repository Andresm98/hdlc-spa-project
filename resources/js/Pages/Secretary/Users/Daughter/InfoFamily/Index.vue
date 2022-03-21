<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-4 bg-gray-200 sm:p-6 rounded-lg">
      <form @submit.prevent="submit">
        <div class="">
          <h6
            class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
          >
            Plantilla de Estado de Salud de la Hermana
          </h6>

          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12">
              <label class="block text-sm font-medium text-gray-700 mr-2">
                Nombres Completos del Padre:
              </label>
              <div class="mt-1 rounded-md mx-2">
                <input
                  type="text"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mr-2"
                  placeholder="Ingrese los nombres del padre"
                  maxlength="100"
                  v-model="this.infofamily.names_father"
                  required
                />
              </div>
            </div>
            <div class="w-full lg:w-6/12">
              <label class="block text-sm font-medium text-gray-700">
                Nombres Completos de la Madre:
              </label>
              <div class="mt-1 rounded-md mx-2">
                <input
                  type="text"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  placeholder="Ingrese los nombres de la madre"
                  maxlength="100"
                  v-model="this.infofamily.names_mother"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-4/12 mt-2">
              <label class="block text-sm font-medium text-gray-700">
                Número de Hermanas:
              </label>
              <div class="mt-1 rounded-md mx-2">
                <input
                  type="number"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  placeholder="Ingrese el número"
                  min="0"
                  max="20"
                  v-model="this.infofamily.nr_sisters"
                  required
                />
              </div>
            </div>
            <div class="w-full lg:w-4/12 mt-2">
              <label class="block text-sm font-medium text-gray-700">
                Número de Hermanos:
              </label>
              <div class="mt-1 rounded-md mx-2">
                <input
                  type="number"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  placeholder="Ingrese el número"
                  min="0"
                  max="20"
                  v-model="this.infofamily.nr_brothers"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-4/12 mt-2">
              <label class="block text-sm font-medium text-gray-700">
                Lugar en la Familia:
              </label>
              <div class="mt-1 rounded-md mx-2">
                <input
                  type="number"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  placeholder="Ingrese el número"
                  min="0"
                  max="20"
                  v-model="this.infofamily.place_of_family"
                  required
                />
              </div>
            </div>
          </div>
        </div>

        <div v-if="isExistData">
          <jet-button type="submit" class="ml-4 mt-4"
            >Actualizar Información Familiar</jet-button
          >
        </div>
        <div v-else>
          <jet-button-success type="submit" class="ml-4 mt-4"
            >Crear Información Familiar</jet-button-success
          >
        </div>
      </form>
      <form @submit.prevent="submitTwo" v-if="isExistData">
        <!-- Info Break Family -->
        <hr
          class="mt-4 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
        />
        <h6
          class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
        >
          Información del familiar en donde la hermana se hospeda en los días de descanso
        </h6>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12">
            <label class="block text-sm font-medium text-gray-700 mr-2">
              Nombres Completos del Familiar:
            </label>
            <div class="mt-1 rounded-md mx-2">
              <input
                type="text"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mr-2"
                placeholder="Ingrese los nombres del familiar"
                maxlength="100"
                v-model="this.infofamilybreak.name_family_member"
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-6/12">
            <label class="block text-sm font-medium text-gray-700">
              Relación del Familiar con la Hermana:
            </label>
            <div class="mt-1 rounded-md mx-2">
              <input
                type="text"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                placeholder="Ingrese el parentesco"
                maxlength="100"
                v-model="this.infofamilybreak.relation"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 mt-2">
            <label class="block text-sm font-medium text-black" htmlfor="grid-password">
              Celular:
            </label>
            <div class="mx-2 mt-1">
              <input
                type="text"
                minLength="10"
                maxlength="20"
                pattern="[0-9]+"
                placeholder="123-4567-890"
                class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="this.infofamilybreak.cellphone"
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-6/12 mt-2">
            <label class="block text-sm font-medium text-black" htmlfor="grid-password">
              Teléfono:
            </label>
            <div class="mx-2 mt-1">
              <input
                type="text"
                minLength="10"
                maxlength="20"
                pattern="[0-9]+"
                placeholder="123-4567-890"
                class="border-0 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="this.infofamilybreak.phone"
                required
              />
            </div>
          </div>
        </div>
        <div v-if="isExistDataInfBreak">
          <jet-button type="submit" class="ml-4 mt-4"
            >Actualizar Información de Contacto</jet-button
          >
        </div>
        <div v-else>
          <jet-button-success type="submit" class="ml-4 mt-4"
            >Crear Información de Contacto</jet-button-success
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import Datepickerf from "vuejs3-datepicker";
import { useForm } from "@inertiajs/inertia-vue3";
import { mapActions, mapGetters, mapState } from "vuex";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetButton from "@/Jetstream/Button.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Datepickerf,
    JetButtonSuccess,
    JetButton,
  },
  data() {
    return {
      isExistData: false,
      isExistDataInfBreak: false,
      isDisabled: false,
      isTouched: false,
      value: null,
      options: [
        "Select option",
        "Disable me!",
        "Reset me!",
        "mulitple",
        "label",
        "searchable",
      ],
    };
  },
  mounted() {
    this.getDataInfoFamily;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("informationfamily", ["infofamily"]),
    ...mapState("informationfamily", ["infofamilybreak"]),
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },

    getDataInfoFamily() {
      axios
        .get(
          this.route("secretary.daughter-profile.infofamily.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          if (res.data != "") {
            this.updateInfoFamily(res.data);
            this.isExistData = true;
            this.getDataInfoFamilyBreak;
          }
        });
    },
    getDataInfoFamilyBreak() {
      if (this.isExistData) {
        axios
          .get(
            this.route("secretary.daughter-profile.infofamilybreak.index", {
              user_id: this.profile.user_id,
            })
          )
          .then((res) => {
            if (res.data != "") {
              this.updateInfoFamilyBreak(res.data);
              this.isExistDataInfBreak = true;
            }
          });
      }
    },
  },
  methods: {
    ...mapActions("informationfamily", ["updateInfoFamily"]),
    ...mapGetters("informationfamily", ["getInfoFamily"]),
    ...mapActions("informationfamily", ["updateInfoFamilyBreak"]),
    ...mapGetters("informationfamily", ["getInfoFamilyBreak"]),
    submit() {
      Inertia.post(
        this.route("secretary.daughter-profile.infofamily.store", {
          user_id: this.profile.user_id,
        }),
        this.infofamily,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              console.log("saved.");
            }, 1000);
          },
        }
      );
    },
    submitTwo() {
      try {
        Inertia.post(
          this.route("secretary.daughter-profile.infofamilybreak.store", {
            user_id: this.profile.user_id,
          }),
          this.infofamilybreak,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                console.log("saved.");
              }, 1000);
            },
          }
        );
      } catch (error) {
        console.log(error);
      }
    },
    showAlert() {
      // Use sweetalert2
      this.$swal("Hello Vue world!!!");
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
  setup() {
    const dateinput = ref(new Date());
    function dateSelected(payload) {
      console.log(payload);
    }
    return { dateinput, dateSelected };
  },
};
</script>
