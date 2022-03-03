<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Permisos de Hermana
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo del Permiso:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar Nombre de Título"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.reason"
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

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Consejo Provincial que concede el Permiso:
              </label>

              <Datepicker
                v-model="form.date_province"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Consejo General que concede el Permiso:
              </label>

              <Datepicker
                v-model="form.date_general"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Salida:
              </label>

              <Datepicker
                v-model="form.date_out"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                required
              />
            </div>
          </div>

          <!-- <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Regreso (Eventual):
              </label>

              <Datepicker
                v-model="form.date_in"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
              />
            </div>
          </div> -->
          <div class="w-full lg:w-full px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Descripción del Permiso
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

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Permiso</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Permisos</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(permit, index) in this.getAllPermit()"
            :key="permit"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ permit.reason }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationPermitUpdate(permit)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationPermitDelete(permit)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="permitBeingDeleted"
        @close="permitBeingDeleted == null"
      >
        <template #title> Eliminar el Permiso</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial del permiso ?

          <div class="w-3/3">
            <quill-editor
              refs="ql_deleteditor3"
              v-model:content="deletePermitForm.description"
              contentType="html"
              theme="snow"
              :readOnly="true"
            ></quill-editor>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo del Permiso:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar Nombre de Título"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="deletePermitForm.reason"
                  readonly
                />
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="permitBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deletePermit">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="permitBeingUpdated"
        @close="permitBeingUpdated == null"
      >
        <template #title> Datos de Registro del Permiso</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Motivo del Permiso:
                </label>

                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar Nombre de Título"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updatePermitForm.reason"
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

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Consejo Provincial que concede el Permiso:
                </label>

                <Datepicker
                  v-model="updatePermitForm.date_province"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Consejo General que concede el Permiso:
                </label>

                <Datepicker
                  v-model="updatePermitForm.date_general"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Salida:
                </label>

                <Datepicker
                  v-model="updatePermitForm.date_out"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Regreso (Eventual):
                </label>

                <Datepicker
                  v-model="updatePermitForm.date_in"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                />
              </div>
            </div>
            <div class="w-full lg:w-full px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Descripción del Permiso
                </label>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="updatePermitForm.description"
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>

            <!-- Information Address -->
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="permitBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updatePermit">
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
      reason: null,
      description: null,
      date_province: null,
      date_general: null,
      date_out: null,
      date_in: null,
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
      permitBeingDeleted: null,
      deletePermitForm: this.$inertia.form({
        reason: null,
        description: null,
        date_province: null,
        date_general: null,
        date_out: null,
        date_in: null,
      }),
      permitBeingUpdated: null,
      updatePermitForm: this.$inertia.form({
        reason: null,
        description: null,
        date_province: null,
        date_general: null,
        date_out: null,
        date_in: null,
      }),
    };
  },

  mounted() {
    this.allPermit;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },
    ...mapState("daughter", ["profile"]),
    ...mapState("permit", ["permit"]),
    allPermit() {
      axios
        .get(
          this.route("secretary.daughter-profile.permit.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          console.log(res.data);
          this.updateAllPermit(res.data);
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
    "updatePermitForm.description": function () {
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
    ...mapActions("permit", ["updateAllPermit"]),
    ...mapGetters("permit", ["getAllPermit"]),
    submit() {
      this.form.date_province = this.formatDate(this.form.date_province);
      this.form.date_general = this.formatDate(this.form.date_general);
      this.form.date_out = this.formatDate(this.form.date_out);
      //   this.form.date_in = this.formatDate(this.form.date_in);
      //
      Inertia.post(
        route("secretary.daughter-profile.permit.store", {
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
            this.form.reason = null;
            this.form.description = null;
            this.form.date_province = null;
            this.form.date_general = null;
            this.form.date_out = null;
            this.form.date_in = null;

            this.$refs.qleditor1.setHTML("");
          },
        }
      );
    },
    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.permit.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllPermit(res.data);
        });
    },

    //  Update

    confirmationPermitUpdate(permit) {
      this.updatePermitForm.reason = permit.reason;
      this.updatePermitForm.description = permit.description;
      this.updatePermitForm.date_province = permit.date_province;
      this.updatePermitForm.date_general = permit.date_general;
      this.updatePermitForm.date_out = permit.date_out;
      this.updatePermitForm.date_in = permit.date_in;
      this.permitBeingUpdated = permit;
    },
    updatePermit() {
      this.updatePermitForm.date_province = this.formatDate(
        this.updatePermitForm.date_province
      );
      this.updatePermitForm.date_general = this.formatDate(
        this.updatePermitForm.date_general
      );
      this.updatePermitForm.date_out = this.formatDate(this.updatePermitForm.date_out);
      if (this.updatePermitForm.date_in != null) {
        this.updatePermitForm.date_in = this.formatDate(this.updatePermitForm.date_in);
      }
      this.updatePermitForm.put(
        this.route("secretary.daughter-profile.permit.update", {
          user_id: this.profile.user_id,
          permit_id: this.permitBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.permitBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
    // Delete

    confirmationPermitDelete(permit) {
      this.deletePermitForm.reason = permit.reason;
      this.deletePermitForm.description = permit.description;
      this.deletePermitForm.date_province = permit.date_province;
      this.permitBeingDeleted = permit;
    },

    deletePermit() {
      this.deletePermitForm.delete(
        this.route("secretary.daughter-profile.permit.delete", {
          user_id: this.profile.user_id,
          permit_id: this.permitBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.permitBeingDeleted = null),
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
