<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Actividades
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre Actividad:
                </label>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre actividad"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_name_activity"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha de Actividad:
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.comm_date_activity"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción:
              </label>

              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="form.comm_description_activity"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_daughters"
              >
                Número de Hermanas:
              </label>

              <input
                type="number"
                name="nr_daughters"
                placeholder="Número de Hermanas"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                v-model="form.comm_nr_daughters"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_beneficiaries"
              >
                Número de Beneficiarios:
              </label>

              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_beneficiaries"
                placeholder="Número de Beneficiarios"
                v-model="form.comm_nr_beneficiaries"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_collaborators"
              >
                Número de Colaboradores:
              </label>

              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_collaborators"
                v-model="form.comm_nr_collaborators"
                placeholder="Número de Colaboradores"
                required
              />
            </div>
          </div>
          <!-- Information Address -->
        </div>

        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Actividad</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Actividades</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="activity in this.getAllActivity()"
            :key="activity"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ activity.comm_name_activity }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationActivityUpdate(activity)"
                  >Detalles</jet-button
                >
                <jet-danger-button @click="confirmationActivityDelete(activity)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="activityBeingDeleted"
        @close="activityBeingDeleted == null"
      >
        <template #title> Eliminar la Actividad</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial de la actividad:
          {{ this.deleteActivityForm.comm_name_activity }}?
        </template>

        <template #footer>
          <jet-secondary-button @click="activityBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteActivity">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="activityBeingUpdated"
        @close="activityBeingUpdated == null"
      >
        <template #title> Datos de Registro de la Actividad</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Nombre Actividad:
                  </label>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre actividad"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateActivityForm.comm_name_activity"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Fecha de Actividad:
                </label>

                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateActivityForm.comm_date_activity"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Descripción:
                </label>

                <div class="bg-white">
                  <quill-editor
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="updateActivityForm.comm_description_activity"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-4/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="nr_daughters"
                >
                  Número de Hermanas:
                </label>

                <input
                  type="number"
                  name="nr_daughters"
                  placeholder="Número de Hermanas"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  min="0"
                  max="1000"
                  v-model="updateActivityForm.comm_nr_daughters"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-4/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="nr_beneficiaries"
                >
                  Número de Beneficiarios:
                </label>

                <input
                  type="number"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  min="0"
                  max="1000"
                  name="nr_beneficiaries"
                  placeholder="Número de Beneficiarios"
                  v-model="updateActivityForm.comm_nr_beneficiaries"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-4/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="nr_collaborators"
                >
                  Número de Colaboradores:
                </label>

                <input
                  type="number"
                  class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                  min="0"
                  max="1000"
                  name="nr_collaborators"
                  v-model="updateActivityForm.comm_nr_collaborators"
                  placeholder="Número de Colaboradores"
                  required
                />
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="this.activityBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateActivity">
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
    this.allActivities;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },

    ...mapState("community", ["community"]),
    ...mapState("activity", ["activity"]),

    allActivities() {
      axios
        .get(
          this.route("secretary.communities.activity.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllActivity(res.data);
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
      comm_name_activity: null,
      comm_description_activity: null,
      comm_date_activity: null,
      comm_nr_daughters: null,
      comm_nr_beneficiaries: null,
      comm_nr_collaborators: null,
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
      activityBeingDeleted: null,
      deleteActivityForm: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
      }),
      activityBeingUpdated: null,
      updateActivityForm: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
      }),
    };
  },
  watch: {
    "form.comm_description_activity": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateActivityForm.comm_description_activity": function () {
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
    ...mapActions("activity", ["updateAllActivity"]),
    ...mapGetters("activity", ["getAllActivity"]),
    submit() {
      this.form.comm_date_activity = this.formatDate(this.form.comm_date_activity);
      //
      Inertia.post(
        route("secretary.communities.activity.store", {
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

            this.form.comm_name_activity = null;
            this.form.comm_description_activity = null;
            this.form.comm_date_activity = null;
            this.form.comm_nr_daughters = null;
            this.form.comm_nr_beneficiaries = null;
            this.form.comm_nr_collaborators = null;

            this.$refs.qleditor1.setHTML("");
          },
        }
      );
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    // Update

    confirmationActivityUpdate(activity) {
      this.updateActivityForm.comm_name_activity = activity.comm_name_activity;
      this.updateActivityForm.comm_description_activity =
        activity.comm_description_activity;
      this.updateActivityForm.comm_date_activity = activity.comm_date_activity;
      this.updateActivityForm.comm_nr_daughters = activity.comm_nr_daughters;
      this.updateActivityForm.comm_nr_beneficiaries = activity.comm_nr_beneficiaries;
      this.updateActivityForm.comm_nr_collaborators = activity.comm_nr_collaborators;

      this.activityBeingUpdated = activity;
    },
    updateActivity() {
      this.updateActivityForm.comm_date_activity = this.formatDate(
        this.updateActivityForm.comm_date_activity
      );

      this.updateActivityForm.put(
        this.route("secretary.communities.activity.update", {
          community_id: this.community.id,
          activity_id: this.activityBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.activityBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },

    // // Delete
    confirmationActivityDelete(activity) {
      this.deleteActivityForm.comm_name_activity = activity.comm_name_activity;
      this.deleteActivityForm.comm_description_activity =
        activity.comm_description_activity;
      this.deleteActivityForm.comm_date_activity = activity.comm_date_activity;

      this.activityBeingDeleted = activity;
    },

    deleteActivity() {
      this.deleteActivityForm.delete(
        this.route("secretary.communities.activity.delete", {
          community_id: this.community.id,
          activity_id: this.activityBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.activityBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 2)
          ),
        }
      );
    },
    //
    updateTable() {
      axios
        .get(
          this.route("secretary.communities.activity.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllActivity(res.data);
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
