<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Nombramientos
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Nivel:
              </label>

              <small>Formato: Seleccionar el nivel del permiso.</small>
              <div :class="{ invalid: isInvalidLevel }">
                <multiselect
                  :searchable="true"
                  v-model="selectOne.selectedLevel"
                  :options="selectOne.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  mode="tags"
                  label="name"
                  @search-change="onSearchLevelChange"
                  @select="onSelectedLevel"
                  track-by="name"
                  placeholder="Buscar Nivel"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidLevel">Obligatorio</p>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Título:
              </label>
              <small>Formato: Seleccionar el nombramiento específico.</small>
              <div :class="{ invalid: isInvalidLevelCategory }">
                <multiselect
                  :searchable="true"
                  v-model="selectTwo.selectedLevelCategory"
                  :options="selectTwo.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  mode="tags"
                  label="name"
                  @search-change="onSearchLevelCategoryChange"
                  @select="onSelectedCategoryLevel"
                  track-by="name"
                  placeholder="Buscar Categoría"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidLevelCategory">
                  Obligatorio
                </p>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700 pt-4"
                htmlfor="grid-password"
              >
                Comunidad:
              </label>
              <small
                >Formato: Seleccionar la comunidad u obra en la que cumplirá sus
                funciones.</small
              >
              <div :class="{ invalid: isInvalidCommunity }">
                <div v-if="this.allWork != null">
                  <multiselect
                    :searchable="true"
                    placeholder="Por favor seleccionar la comunidad a la que va"
                    select-label="Seleccionar!"
                    v-model="this.form.community_id"
                    :options="this.allWork"
                    :close-on-select="true"
                    :clear-on-select="false"
                    :max-height="200"
                    :disabled="isDisabled"
                    @select="onSelect"
                    mode="tags"
                    label="comm_name"
                  ></multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidCommunity">
                    Obligatorio
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700 pt-4"
                htmlfor="grid-password"
              >
                Fecha:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.date_appointment"
              >
                {{ $page.props.errors.date_appointment }}
              </p>
              <small>Formato: Fecha que en la que se asigna el nombramiento.</small>
              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.date_appointment"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-full px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Descripción:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                {{ $page.props.errors.description }}
              </p>
              <small>Formato: Descripción del nombramiento.</small>
              <div class="bg-white">
                <quill-editor
                  v-model:content="form.description"
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados..."
                ></quill-editor>
              </div>
            </div>
          </div>
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Nombramiento</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <!-- Table -->

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllAppointment()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th
                    scope="col"
                    class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Comunidad/Obra
                  </th>
                  <th
                    scope="col"
                    class="text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Cargo
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Fechas (inicio-fin)
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
                <tr v-for="appointment in this.getAllAppointment()" :key="appointment">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="2 2 23 23">
                          <path
                            d="M17.283,5.549h-5.26V4.335c0-0.222-0.183-0.404-0.404-0.404H8.381c-0.222,0-0.404,0.182-0.404,0.404v1.214h-5.26c-0.223,0-0.405,0.182-0.405,0.405v9.71c0,0.223,0.182,0.405,0.405,0.405h14.566c0.223,0,0.404-0.183,0.404-0.405v-9.71C17.688,5.731,17.506,5.549,17.283,5.549 M8.786,4.74h2.428v0.809H8.786V4.74z M16.879,15.26H3.122v-4.046h5.665v1.201c0,0.223,0.182,0.404,0.405,0.404h1.618c0.222,0,0.405-0.182,0.405-0.404v-1.201h5.665V15.26z M9.595,9.583h0.81v2.428h-0.81V9.583zM16.879,10.405h-5.665V9.19c0-0.222-0.183-0.405-0.405-0.405H9.191c-0.223,0-0.405,0.183-0.405,0.405v1.215H3.122V6.358h13.757V10.405z"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-black hover:text-blue-500">
                          <div
                            v-if="
                              appointment.community.comm_level == 1 &&
                              appointment.community.comm_id == null
                            "
                          >
                            <a
                              :href="
                                route('secretary.communities.edit', {
                                  slug: appointment.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ appointment.community.comm_name.substring(0, 15) }}...
                            </a>
                          </div>
                          <div
                            v-if="
                              appointment.community.comm_level == 2 &&
                              appointment.community.comm_id != null
                            "
                          >
                            <a
                              :href="
                                route('secretary.works.edit', {
                                  slug: appointment.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ appointment.community.comm_name.substring(0, 15) }}...
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ appointment.appointment_level.name }}
                    </div>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="appointment.date_end_appointment == null"
                  >
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                    >
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{ this.formatDateShow(appointment.date_end_appointment) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                    >
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{ this.formatDateShow(appointment.date_end_appointment) }}
                    </span>
                  </td>

                  <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <!-- Components -->

                    <div class="mx-auto flex gap-10">
                      <jet-button @click="confirmationAppointmentUpdate(appointment)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationAppointmentDelete(appointment)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">Por el momento no existen registros.</p>
          </div>
        </div>
      </div>

      <jet-confirmation-modal
        :show="appointmentBeingDeleted"
        @close="appointmentBeingDeleted == null"
      >
        <template #title> Eliminar el Nombramiento</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial del Nombramiento?

          <div class="w-full lg:w-12/12 mt-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Nombramiento:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="deleteAppointmentForm.name_appointment"
                  readonly
                />
              </div>
            </div>
          </div>
          <div class="w-3/3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Descripción:
            </label>

            <quill-editor
              v-model:content="deleteAppointmentForm.description"
              contentType="html"
              theme="snow"
              :readOnly="true"
            ></quill-editor>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="appointmentBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteAppointment">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="appointmentBeingUpdated"
        @close="appointmentBeingUpdated == null"
      >
        <template #title> Datos de Registro del Nombramiento</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Nivel:
                </label>
                <small>Formato: Seleccionar el nivel del permiso.</small>
                <div :class="{ invalid: isInvalidLevel }">
                  <multiselect
                    :searchable="true"
                    v-model="selectOne.selectedLevel"
                    :options="selectOne.options"
                    :close-on-select="true"
                    :clear-on-select="false"
                    mode="tags"
                    label="name"
                    @search-change="onSearchLevelChange"
                    @select="onSelectedLevel"
                    track-by="name"
                    placeholder="Buscar Nivel"
                  >
                  </multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidLevel">Obligatorio</p>
                </div>
              </div>
            </div>
            <div class="w-full lg:w-6/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Título:
                </label>
                <small>Formato: Seleccionar el nombramiento específico.</small>
                <div :class="{ invalid: isInvalidLevelCategory }">
                  <multiselect
                    :searchable="true"
                    v-model="selectTwo.selectedLevelCategory"
                    :options="selectTwo.options"
                    :close-on-select="true"
                    :clear-on-select="false"
                    mode="tags"
                    label="name"
                    @search-change="onSearchLevelCategoryChange"
                    @select="onSelectedCategoryLevel"
                    track-by="name"
                    placeholder="Buscar Categoría"
                  >
                  </multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidLevelCategory">
                    Obligatorio
                  </p>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Comunidad:
                </label>
                <small
                  >Formato: Seleccionar la comunidad u obra en la que cumplirá sus
                  funciones.</small
                >
                <div :class="{ invalid: isInvalidUpdateCommunity }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="this.selectThree.selectedCommunity"
                      :options="this.allWork"
                      :close-on-select="true"
                      :clear-on-select="false"
                      :max-height="200"
                      :disabled="isDisabled"
                      @select="onSelect"
                      mode="tags"
                      label="comm_name"
                    ></multiselect>
                    <p class="text-sm text-red-400" v-show="isInvalidUpdateCommunity">
                      Obligatorio
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Fecha:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.date_appointment"
                >
                  {{ $page.props.errors.date_appointment }}
                </p>
                <small>Formato: Fecha que en la que se asigna el nombramiento.</small>
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateAppointmentForm.date_appointment"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Fecha Fin:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.date_end_appointment"
                >
                  {{ $page.props.errors.date_end_appointment }}
                </p>
                <small>Formato: Fecha que en la que culmina el nombramiento.</small>
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateAppointmentForm.date_end_appointment"
                />
              </div>
            </div>
            <!-- Description -->

            <div class="w-full lg:w-full px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Descripción:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                  {{ $page.props.errors.description }}
                </p>
                <small>Formato: Descripción del nombramiento.</small>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="updateAppointmentForm.description"
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="cancelUpdateAppointment()">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateAppointment">
            Actualizar
          </jet-button-success>
        </template>
      </jet-dialog-modal>
    </div>
  </div>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";
import { mapState, mapActions, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: {
    errors: null,
  },
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
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
      description: null,
      date_appointment: null,
      date_end_appointment: null,
      appointment_level_id: null,
      community_id: null,
    });
    return {
      date,
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
      appointmentBeingDeleted: null,
      deleteAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        community_id: null,
      }),
      appointmentBeingUpdated: null,
      updateAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        community_id: null,
      }),

      //   Selects

      selectOne: {
        selectedLevel: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevel: null,
        vSelectLevel: null,
      },
      selectTwo: {
        selectedLevelCategory: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevelCategory: null,
        vSelectLevelCategory: null,
      },
      selectThree: {
        selectedCommunity: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectCommunity: null,
        vSelectCommunity: null,
      },

      isDisabled: false,
      isTouched: false,
      value: null,
    };
  },
  created() {
    axios
      .get(this.route("secretary.daughter-profile.transfer.communities.index"))
      .then((res) => {
        this.updateAllWork(res.data);
      });
  },
  mounted() {
    this.allAppointment;
    this.allAppointmentLevel;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("appointment", ["appointment"]),
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),

    // Validate Multioption
    isInvalidLevel() {
      //   console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOne.selectedLevel == undefined || this.selectOne.selectedLevel == null
      );
    },
    isInvalidLevelCategory() {
      //   console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwo.selectedLevelCategory == undefined ||
        this.selectTwo.selectedLevelCategory == null
      );
    },
    isInvalidCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return this.form.community_id == undefined || this.form.community_id == null;
    },
    isInvalidUpdateCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedCommunity == undefined ||
        this.selectThree.selectedCommunity == null
      );
    },
    allAppointment() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllAppointment(res.data);
        });
    },
    allAppointmentLevel() {
      axios
        .get(
          this.route("secretary.appointment.levels.index", {
            id: 0,
            status: 1,
          })
        )
        .then((res) => {
          this.selectOne.options = res.data;
        });
    },
  },
  watch: {
    "selectOne.selectedLevel": function () {
      if (this.selectOne.selectedLevel === null) {
        this.selectTwo.selectedLevelCategory = null;
        this.selectTwo.options = [];
        // Clean data Form
        this.form.appointment_level_id = null;

        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "selectTwo.selectedLevelCategory": function () {
      if (this.selectTwo.selectedLevelCategory === null) {
        // Clean data Form
        this.form.appointment_level_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },

    "form.description": function () {
      var limit = 2000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateAppointmentForm.description": function () {
      var limit = 2000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
  },
  methods: {
    ...mapActions("appointment", ["updateAllAppointment"]),
    ...mapGetters("appointment", ["getAllAppointment"]),
    ...mapActions("work", ["updateAllWork"]),
    ...mapGetters("work", ["getAllWork"]),

    onSearchLevelChange() {},
    onSelectedLevel(level) {
      this.form.appointment_level_id = null;

      this.selectTwo.selectedLevelCategory = undefined;

      this.selectTwo.options = [];
      axios
        .get(
          this.route("secretary.appointment.levels.index", {
            id: level.id,
            status: 2,
          })
        )
        .then((res) => {
          this.selectTwo.options = res.data;
        });
    },

    onSearchLevelCategoryChange() {},
    onSelectedCategoryLevel(category) {
      this.form.appointment_level_id = category.id;

      if (this.appointmentBeingUpdated != null) {
        this.updateAppointmentForm.appointment_level_id = category.id;
      }
    },

    // Save
    submit() {
      if (this.form.date_appointment != null) {
        this.form.date_appointment = this.formatDate(this.form.date_appointment);
      }

      if (
        this.isInvalidLevel == false &&
        this.isInvalidLevelCategory == false &&
        this.isInvalidCommunity == false
      ) {
        Inertia.post(
          route("secretary.daughter-profile.appointment.store", {
            user_id: this.profile.user_id,
          }),
          this.form,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.updateTable();
              }, 10);

              this.form.appointment_level_id = null;
              this.form.community_id = null;
              this.form.description = null;
              this.form.date_appointment = null;

              this.selectOne.selectedLevel = null;
              this.selectTwo.selectedLevelCategory = null;
              this.selectTwo.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];

              this.$refs.qleditor1.setHTML("");
            },
          }
        );
      }
    },
    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllAppointment(res.data);
        });
    },

    // Update

    confirmationAppointmentUpdate(appointment) {
      this.updateAppointmentForm.name_appointment = appointment.name_appointment;
      this.updateAppointmentForm.description = appointment.description;
      this.updateAppointmentForm.date_appointment = appointment.date_appointment;
      this.updateAppointmentForm.date_end_appointment = appointment.date_end_appointment;

      this.status(appointment).then((data) => {
        this.selectOne.selectedLevel = data.level;
        axios
          .get(
            this.route("secretary.appointment.levels.index", {
              id: data.level.id,
              status: 2,
            })
          )
          .then((res) => {
            this.selectTwo.options = res.data;
          });

        axios
          .get(
            this.route("secretary.daughter-profile.appointment.community.index", {
              community_id: appointment.community_id,
            })
          )
          .then((res) => {
            // console.log("abs ", res.data);
            this.selectThree.selectedCommunity = res.data;
          });

        this.selectTwo.selectedLevelCategory = data.levelCategory;
      });

      this.appointmentBeingUpdated = appointment;
    },
    async status(appointment) {
      let response = await axios.get(
        this.route("secretary.appointment-data.index", {
          appointment_level_id: appointment.appointment_level_id,
        })
      );
      return response.data;
    },
    cancelUpdateAppointment() {
      this.selectOne.selectedLevel = null;
      this.selectTwo.selectedLevelCategory = null;
      this.selectTwo.options = [];
      this.selectThree.selectedCommunity = null;
      this.selectThree.options = [];
      this.appointmentBeingUpdated = null;
    },
    updateAppointment() {
      this.updateAppointmentForm.date_appointment = this.formatDate(
        this.updateAppointmentForm.date_appointment
      );
      if (this.updateAppointmentForm.date_end_appointment != null) {
        this.updateAppointmentForm.date_end_appointment = this.formatDate(
          this.updateAppointmentForm.date_end_appointment
        );
      }

      this.updateAppointmentForm.appointment_level_id = this.selectTwo.selectedLevelCategory;
      this.updateAppointmentForm.community_id = this.selectThree.selectedCommunity;

      this.updateAppointmentForm.put(
        this.route("secretary.daughter-profile.appointment.update", {
          user_id: this.profile.user_id,
          appointment_id: this.appointmentBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.appointmentBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 1);
            this.selectOne.selectedLevel = null;
            this.selectTwo.selectedLevelCategory = null;
            this.selectTwo.options = [];
            this.selectThree.selectedCommunity = null;
            this.selectThree.options = [];
            this.appointmentBeingUpdated = null;
          },
        }
      );
    },

    // Delete
    confirmationAppointmentDelete(appointment) {
      this.deleteAppointmentForm.name_appointment = appointment.name_appointment;
      this.deleteAppointmentForm.description = appointment.description;
      this.deleteAppointmentForm.date_appointment = appointment.date_appointment;
      this.deleteAppointmentForm.date_end_appointment = appointment.date_end_appointment;
      this.appointmentBeingDeleted = appointment;
    },

    deleteAppointment() {
      this.deleteAppointmentForm.delete(
        this.route("secretary.daughter-profile.appointment.delete", {
          user_id: this.profile.user_id,
          appointment_id: this.appointmentBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.appointmentBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 1)
          ),
        }
      );
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatDateShow(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "Vigente";
    },

    onChange(value) {
      this.value = value;
      //   console.log("aiudaaa> ", value);
      if (value.indexOf("Reset me!") !== -1) {
        // console.log("is reset");
        this.value = [];
      }
    },
    onSelect(option) {
      if (option === "Disable me!") {
        // console.log("is disable");
        this.isDisabled = true;
      }
    },
    onTouch() {
      //   console.log("is touched");
      //   console.log(this.allOffice);
      this.isTouched = true;
    },
  },
};
</script>
