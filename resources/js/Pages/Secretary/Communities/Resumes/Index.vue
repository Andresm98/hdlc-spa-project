<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Resumen de la Comunidad
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre Resumen
                </label>

                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_name_resume"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha del Resumen
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.comm_date_resume"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Anexo del Resumen
              </label>
              <input
                minLength="10"
                maxlength="400"
                type="text"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                name="anexed"
                placeholder="Ingresar el anexo del resumen"
                v-model="form.comm_annexed_resume"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Observaciones
              </label>

              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="form.comm_observation_resume"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Resumen</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Resúmenes</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="resume in this.getAllResume()"
            :key="resume"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ resume.comm_name_resume }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationResumeUpdate(resume)"
                  >Detalles</jet-button
                >
                <jet-danger-button @click="confirmationResumeDelete(resume)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="resumeBeingDeleted"
        @close="resumeBeingDeleted == null"
      >
        <template #title> Eliminar el Resumen</template>

        <template #content>
          ¿Está seguro de que desea eliminar el resumen:
          {{ this.deleteResumeForm.comm_name_resume }}?
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
        <template #title> Datos del Resumen</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Nombre Resumen
                  </label>

                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre del resumen"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateResumeForm.comm_name_resume"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Fecha del Resumen
                </label>

                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateResumeForm.comm_date_resume"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Anexo del Resumen
                </label>
                <input
                  minLength="10"
                  maxlength="400"
                  type="text"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  name="anexed"
                  placeholder="Ingresar el anexo del resumen"
                  v-model="updateResumeForm.comm_annexed_resume"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Observaciones
                </label>

                <div class="bg-white">
                  <quill-editor
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="updateResumeForm.comm_observation_resume"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>

            <!-- Information Address -->
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
import { mapState, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: {
    errors: [],
  },
  mounted() {
    this.allResumes;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },

    ...mapState("community", ["community"]),
    ...mapState("resume", ["resume"]),

    allResumes() {
      axios
        .get(
          this.route("secretary.communities.resume.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllResume(res.data);
        });
    },
  },
  // Relashionship with another components
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
  //  Setup all data
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    const form = useForm({
      comm_name_resume: null,
      comm_annexed_resume: null,
      comm_observation_resume: null,
      comm_date_resume: null,
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
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
      }),
      resumeBeingUpdated: null,
      updateResumeForm: this.$inertia.form({
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
      }),
    };
  },
  watch: {
    "form.comm_observation_resume": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateResumeForm.comm_observation_resume": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
  },
  methods: {
    ...mapActions("resume", ["updateAllResume"]),
    ...mapGetters("resume", ["getAllResume"]),
    submit() {
      this.form.comm_date_resume = this.formatDate(this.form.comm_date_resume);
      //
      Inertia.post(
        route("secretary.communities.resume.store", {
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

            this.form.comm_name_resume = null;
            this.form.comm_annexed_resume = null;
            this.form.comm_observation_resume = null;
            this.form.comm_date_resume = null;
            this.$refs.qleditor1.setHTML("");
          },
        }
      );
      //
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
    confirmationResumeUpdate(resume) {
      this.updateResumeForm.comm_name_resume = resume.comm_name_resume;
      this.updateResumeForm.comm_observation_resume = resume.comm_observation_resume;
      this.updateResumeForm.comm_date_resume = resume.comm_date_resume;
      this.updateResumeForm.comm_annexed_resume = resume.comm_annexed_resume;

      this.resumeBeingUpdated = resume;
    },
    updateResume() {
      this.updateResumeForm.comm_date_resume = this.formatDate(
        this.updateResumeForm.comm_date_resume
      );

      this.updateResumeForm.put(
        this.route("secretary.communities.resume.update", {
          community_id: this.community.id,
          resume_id: this.resumeBeingUpdated.id,
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

    // // Delete
    confirmationResumeDelete(resume) {
      this.deleteResumeForm.comm_name_resume = resume.comm_name_resume;
      this.deleteResumeForm.comm_observation_resume = resume.comm_observation_resume;
      this.deleteResumeForm.comm_date_resume = resume.comm_date_resume;

      this.resumeBeingDeleted = resume;
    },

    deleteResume() {
      this.deleteResumeForm.delete(
        this.route("secretary.communities.resume.delete", {
          community_id: this.community.id,
          resume_id: this.resumeBeingDeleted.id,
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
    // //
    updateTable() {
      axios
        .get(
          this.route("secretary.communities.resume.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllResume(res.data);
        });
    },
    // showAlert() {
    //   // Use sweetalert2
    //   this.$swal("Hello Vue world!!!");
    // },
    // onChange(value) {
    //   this.value = value;
    //   console.log("aiudaaa> ", value);
    //   if (value.indexOf("Reset me!") !== -1) {
    //     console.log("is reset");
    //     this.value = [];
    //   }
    // },
    // onSelect(option) {
    //   if (option === "Disable me!") {
    //     console.log("is disable");
    //     this.isDisabled = true;
    //   }
    // },
    // onTouch() {
    //   console.log("is touched");
    //   this.isTouched = true;
    // },
  },
};
</script>
