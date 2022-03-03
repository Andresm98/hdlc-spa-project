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
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Título del nombramiento:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombramiento"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.name_appointment"
                  required
                />
                <!-- <textarea
                  id="observation"
                  name="observation"
                  rows="6"
                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md m-3"
                  placeholder="Agregar las observaciones generales..."
                  required
                  :maxlength="4000"
                /> -->
              </div>
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Nombramiento:
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.date_appointment"
                required
              />
            </div>
          </div>

          <!-- <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Culminación Nombramiento:
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.date_end_appointment"
                required
              />
            </div>
          </div> -->
          <!-- Description -->

          <div class="w-full lg:w-full px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Descripción del Nombramiento
              </label>
              <div class="bg-white">
                <quill-editor
                  v-model:content="form.description"
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Record</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Nombramientos</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(appointment, index) in this.getAllAppointment()"
            :key="appointment"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ appointment.name_appointment }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationAppointmentUpdate(appointment)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationAppointmentDelete(appointment)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
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
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Título del nombramiento:
                </label>

                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombramiento"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateAppointmentForm.name_appointment"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Nombramiento:
                </label>

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
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Culminación Nombramiento:
                </label>

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
                  Descripción del Nombramiento
                </label>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="updateAppointmentForm.description"
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="appointmentBeingUpdated = null">
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
      name_appointment: null,
      description: null,
      date_appointment: null,
      date_end_appointment: null,
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
        name_appointment: null,
        description: null,
        date_appointment: null,
        date_end_appointment: null,
      }),
      appointmentBeingUpdated: null,
      updateAppointmentForm: this.$inertia.form({
        name_appointment: null,
        description: null,
        date_appointment: null,
        date_end_appointment: null,
      }),
    };
  },
  mounted() {
    this.allAppointment;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("appointment", ["appointment"]),
    allAppointment() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          console.log("hola ", res.data);
          this.updateAllAppointment(res.data);
        });
    },
  },
  watch: {
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

    // Save
    submit() {
      this.form.date_appointment = this.formatDate(this.form.date_appointment);
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

            this.form.name_appointment = null;
            this.form.description = null;
            this.form.date_appointment = null;
            this.form.date_end_appointment = null;

            this.$refs.qleditor1.setHTML("");
          },
        }
      );
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
      this.appointmentBeingUpdated = appointment;
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
            }, 100);
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
            }, 500)
          ),
        }
      );
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
  },
};
</script>
