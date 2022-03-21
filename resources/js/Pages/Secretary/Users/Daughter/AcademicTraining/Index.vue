<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Récord Académico
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Nombre de Título:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="40"
                  placeholder="Ingresar Nombre de Título"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.name_title"
                  required
                />
              </div>
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Insitución:
              </label>
              <input
                type="text"
                minLength="10"
                maxlength="40"
                placeholder="Ingresar Insitución Académica"
                class="border-0 px-3 py-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="form.institution"
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
                Fecha de Entrega Título:
              </label>

              <Datepicker
                v-model="form.date_title"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
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
                Observaciones:
              </label>
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="form.observation"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 my-4 btn btn-primary"
          >Crear Récord</jet-button-success
        >
      </form>
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <!-- Table -->
      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial Académico</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(academic, index) in this.getAllAcademic()"
            :key="academic"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ academic.date_title }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationAcademicUpdate(academic)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationAcademicDelete(academic)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="academicBeingDeleted"
        @close="academicBeingDeleted == null"
      >
        <template #title> Eliminar el historial de Registro Académico</template>

        <template #content>
          ¿Está seguro de que desea eliminar el registro académico?

          <div class="w-3/3">
            <quill-editor
              refs="ql_deleteditor3"
              v-model:content="deleteAcademicForm.observation"
              contentType="html"
              theme="snow"
              :readOnly="true"
            ></quill-editor>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="academicBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteAcademic">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="academicBeingUpdated"
        @close="academicBeingUpdated == null"
      >
        <template #title> Datos de Registro Académico</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Nombre de Título
                </label>

                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="40"
                    placeholder="Ingresar Nombre de Título"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateAcademicForm.name_title"
                    required
                  />
                </div>
              </div>
            </div>
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Insitución
                </label>
                <input
                  type="text"
                  minLength="10"
                  maxlength="40"
                  placeholder="Ingresar Insitución Académica"
                  class="border-0 px-3 py-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateAcademicForm.institution"
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
                  Fecha de Entrega Título
                </label>

                <Datepicker
                  v-model="updateAcademicForm.date_title"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
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
                  Observaciones
                </label>
                <div class="bg-white">
                  <quill-editor
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="updateAcademicForm.observation"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>

            <!-- Information Address -->
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="academicBeingUpdated = null">
            Cancelar
          </jet-secondary-button>
          <jet-button-success class="ml-3" @click="updateAcademic">
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
import { mapState, mapMutations, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: {
    errors: null,
  },
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    JetInputError,
    JetButton,
    JetDangerButton,
    JetSecondaryButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetConfirmationModal,
    moment,
    JetButtonSuccess,
  },
  //  Setup all data
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    const form = useForm({
      name_title: null,
      institution: null,
      date_title: null,
      observation: null,
    });
    return {
      date,
      format,
      form,
    };
  },
  watch: {
    "form.observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
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
      data_intput_one: "",
      academicBeingDeleted: null,
      deleteAcademicForm: this.$inertia.form({
        name_title: null,
        institution: null,
        date_title: null,
        observation: null,
      }),
      academicBeingUpdated: null,
      updateAcademicForm: this.$inertia.form({
        name_title: null,
        institution: null,
        date_title: null,
        observation: null,
      }),
    };
  },
  mounted() {
    this.allAcademic;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("academic", ["academic"]),
    allAcademic() {
      axios
        .get(
          this.route("secretary.daughter-profile.academic.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllAcademic(res.data);
        });
    },
  },

  methods: {
    ...mapActions("academic", ["updateAllAcademic"]),
    ...mapGetters("academic", ["getAllAcademic"]),

    // Save
    submit() {
      this.form.date_title = this.formatDate(this.form.date_title);

      Inertia.post(
        route("secretary.daughter-profile.academic.store", {
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
            this.form.name_title = null;
            this.form.institution = null;
            this.form.date_title = null;
            this.form.observation = null;
            this.$refs.qleditor1.setHTML("");
          },
        }
      );
    },
    // Update
    confirmationAcademicUpdate(academic) {
      this.updateAcademicForm.name_title = academic.name_title;
      this.updateAcademicForm.institution = academic.institution;
      this.updateAcademicForm.date_title = academic.date_title;
      this.updateAcademicForm.observation = academic.observation;
      this.academicBeingUpdated = academic;
    },
    updateAcademic() {
      this.updateAcademicForm.date_title = this.formatDate(
        this.updateAcademicForm.date_title
      );
      this.updateAcademicForm.put(
        this.route("secretary.daughter-profile.academic.update", {
          user_id: this.profile.user_id,
          academic_id: this.academicBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.academicBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
    // Delete
    confirmationAcademicDelete(academic) {
      this.deleteAcademicForm.observation = academic.observation;
      this.academicBeingDeleted = academic;
    },
    deleteAcademic() {
      this.deleteAcademicForm.delete(
        this.route("secretary.daughter-profile.academic.delete", {
          user_id: this.profile.user_id,
          academic_id: this.academicBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.academicBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 500)
          ),
        }
      );
    },

    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.academic.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllAcademic(res.data);
        });
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
  },
};
</script>
