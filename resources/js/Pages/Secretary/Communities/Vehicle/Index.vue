<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Vehículos
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Marca:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.brand"
                >
                  {{ $page.props.errors.brand }}
                </p>
                <small>Formato: Marca del Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.brand"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Tipo:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.type"
                >
                  {{ $page.props.errors.type }}
                </p>
                <small>Formato: Tipo de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.type"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Color:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.color"
                >
                  {{ $page.props.errors.color }}
                </p>
                <small>Formato: Color de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.color"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Placa:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.plaque"
                >
                  {{ $page.props.errors.plaque }}
                </p>
                <small>Formato: Placa de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.plaque"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Año:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.year">
                {{ $page.props.errors.year }}
              </p>
              <small>Formato: Fecha del resumen anual.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.year"
                :year-range="[1800, this.year]"
              />
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Vehículo</jet-button-success
        >
      </form>
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />
      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllVehicle()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div className="overflow-y-auto h-96">
              <div className="relative px-4">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-blue-100">
                    <tr>
                      <th
                        scope="col"
                        class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Marca
                      </th>
                      <th
                        scope="col"
                        class="text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Año
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Placa
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Acciones
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="vehicle in this.getAllVehicle()" :key="vehicle">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-10">
                            <svg class="svg-icon mt-1" viewBox="2 2 23 23">
                              <path
                                d="M18.092,5.137l-3.977-1.466h-0.006c0.084,0.042-0.123-0.08-0.283,0H13.82L10,5.079L6.178,3.671H6.172c0.076,0.038-0.114-0.076-0.285,0H5.884L1.908,5.137c-0.151,0.062-0.25,0.207-0.25,0.369v10.451c0,0.691,0.879,0.244,0.545,0.369l3.829-1.406l3.821,1.406c0.186,0.062,0.385-0.029,0.294,0l3.822-1.406l3.83,1.406c0.26,0.1,0.543-0.08,0.543-0.369V5.506C18.342,5.344,18.242,5.199,18.092,5.137 M5.633,14.221l-3.181,1.15V5.776l3.181-1.15V14.221z M9.602,15.371l-3.173-1.15V4.626l3.173,1.15V15.371z M13.57,14.221l-3.173,1.15V5.776l3.173-1.15V14.221z M17.547,15.371l-3.182-1.15V4.626l3.182,1.15V15.371z"
                              ></path>
                            </svg>
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              {{ vehicle.brand }}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div
                          v-if="vehicle.year != null"
                          class="text-sm text-gray-900"
                        >
                          {{ this.formatShowDate(vehicle.year) }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-2"
                        >
                          {{ vehicle.plaque }}
                        </span>
                      </td>
                      <td
                        class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <!-- Components -->

                        <div class="mx-auto flex gap-10">
                          <jet-button @click="confirmationResumeUpdate(vehicle)"
                            >Detalles</jet-button
                          >
                          <jet-danger-button
                            @click="confirmationResumeDelete(vehicle)"
                            >Eliminar</jet-danger-button
                          >
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      <jet-confirmation-modal
        :show="resumeBeingDeleted"
        @close="resumeBeingDeleted == null"
      >
        <template #title> Eliminar el Vehículo</template>

        <template #content>
          ¿Está seguro de que desea eliminar el vehículo:
          {{ this.deleteResumeForm.brand }}?
        </template>

        <template #footer>
          <jet-secondary-button @click="resumeBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteResume">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="resumeBeingUpdated"
        @close="resumeBeingUpdated == null"
      >
        <template #title> Datos del Vehículo</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Marca:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.brand"
                  >
                    {{ $page.props.errors.brand }}
                  </p>
                  <small>Formato: Marca del Vehículo.</small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre del resumen"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVehicleForm.brand"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Tipo:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.type"
                  >
                    {{ $page.props.errors.type }}
                  </p>
                  <small>Formato: Tipo de Vehículo.</small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre del resumen"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVehicleForm.type"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Color:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.color"
                  >
                    {{ $page.props.errors.color }}
                  </p>
                  <small>Formato: Color de Vehículo.</small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre del resumen"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVehicleForm.color"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Placa:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.plaque"
                  >
                    {{ $page.props.errors.plaque }}
                  </p>
                  <small>Formato: Placa de Vehículo.</small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre del resumen"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVehicleForm.plaque"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Año:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.year"
                >
                  {{ $page.props.errors.year }}
                </p>
                <small>Formato: Fecha del resumen anual.</small>
                <Datepicker
                  :format="format"
                  autoApply
                  v-model="updateVehicleForm.year"
                  :year-range="[1800, this.year]"
                />
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="this.resumeBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateResume">
            Actualizar
          </jet-button-success>
        </template>
      </jet-dialog-modal>
    </div>
  </div>
</template>

  <script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import { mapState, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";
import { useForm } from "@inertiajs/inertia-vue3";
import Datepicker from "vue3-date-time-picker";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import moment from "moment";
import { ref } from "vue";

export default {
  props: {
    errors: [],
  },

  mounted() {
    this.allVehicle;
  },

  computed: {
    isInvalid() {
      return this.value == null;
    },

    ...mapState("community", ["community"]),

    ...mapState("vehicle", ["vehicle"]),

    allVehicle() {
      axios
        .get(
          this.route("secretary.communities.vehicle.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllVehicle(res.data);
        });
    },
  },

  components: {
    Datepicker,
    JetButtonSuccess,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetInputError,
    JetInput,
    JetDialogModal,
    JetFormSection,
    moment,
  },

  setup() {
    const date = ref(new Date());

    const year = new Date().getFullYear();

    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    const form = useForm({
      brand: null,
      type: null,
      color: null,
      plaque: null,
      year: null,
    });

    return {
      date,
      year,
      format,
      form,
    };
  },

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

      isDisabled: false,

      isTouched: false,

      value: null,

      options: [
        "Bautismo",
        "Penitencia",
        "Eucaristia",
        "Confirmación",
        "Orden Sacerdotal",
        "Matrimonio",
        "Unión de Enfermos",
      ],

      resumeBeingDeleted: null,

      deleteResumeForm: this.$inertia.form({
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null,
      }),

      resumeBeingUpdated: null,

      updateVehicleForm: this.$inertia.form({
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null,
      }),
    };
  },
  methods: {
    ...mapActions("vehicle", ["updateAllVehicle"]),

    ...mapGetters("vehicle", ["getAllVehicle"]),

    submit() {
      if (this.form.year) {
        this.form.year = this.formatDate(this.form.year);
      }

      Inertia.post(
        route("secretary.communities.vehicle.store", {
          community_id: this.community.id,
        }),
        this.form,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.updateTable();
            }, 10);
            this.form.brand = null;
            this.form.type = null;
            this.form.color = null;
            this.form.plaque = null;
            this.form.year = null;
          },
        }
      );
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatShowDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    confirmationResumeUpdate(resume) {
      this.updateVehicleForm.brand = resume.brand;
      this.updateVehicleForm.type = resume.type;
      this.updateVehicleForm.color = resume.color;
      this.updateVehicleForm.plaque = resume.plaque;
      this.updateVehicleForm.year = resume.year;

      this.resumeBeingUpdated = resume;
    },

    updateResume() {
      if (this.updateVehicleForm.year != null) {
        this.updateVehicleForm.year = this.formatDate(
          this.updateVehicleForm.year
        );
      }

      this.updateVehicleForm.put(
        this.route("secretary.communities.vehicle.update", {
          community_id: this.community.id,
          vehicle_id: this.resumeBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.resumeBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },

    confirmationResumeDelete(resume) {
      this.deleteResumeForm.brand = resume.brand;

      this.resumeBeingDeleted = resume;
    },

    deleteResume() {
      this.deleteResumeForm.delete(
        this.route("secretary.communities.vehicle.delete", {
          community_id: this.community.id,
          vehicle_id: this.resumeBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.resumeBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 2)
          ),
        }
      );
    },

    updateTable() {
      axios
        .get(
          this.route("secretary.communities.vehicle.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllVehicle(res.data);
        });
    },
  },
};
</script>
