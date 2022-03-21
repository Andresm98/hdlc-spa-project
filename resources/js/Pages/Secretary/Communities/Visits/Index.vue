<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Visitas
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Razón de la Visita
                </label>

                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar razón visita"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_reason_visit"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Tipo de Visita
                </label>

                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar tipo de visita"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_type_visit"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción de Visita
              </label>

              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  v-model:content="form.comm_description_visit"
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Inicio
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.comm_date_init_visit"
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
                Fecha de Finalización
              </label>

              <Datepicker
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                v-model="form.comm_date_end_visit"
                required
              />
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Visita</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />
      <!-- Data Table  -->
      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Visitas</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="visit in this.getAllVisit()"
            :key="visit"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ visit.comm_reason_visit }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationVisitUpdate(visit)">Detalles</jet-button>
                <jet-danger-button @click="confirmationVisitDelete(visit)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!-- Delete  Data Form-->
      <jet-confirmation-modal
        :show="visitBeingDeleted"
        @close="visitBeingDeleted == null"
      >
        <template #title> Eliminar la Visita</template>

        <template #content>
          ¿Está seguro de que desea eliminar la visita:
          {{ this.deleteVisitForm.comm_reason_visit }}?
        </template>

        <template #footer>
          <jet-secondary-button @click="visitBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteVisit">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <!-- Put Data Form -->
      <jet-dialog-modal
        :max-width="'input-md'"
        :show="visitBeingUpdated"
        @close="visitBeingUpdated == null"
      >
        <template #title> Datos de la Visita</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Razón de la Visita
                  </label>

                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar razón visita"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVisitForm.comm_reason_visit"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700">
                    Tipo de Visita
                  </label>

                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar tipo de visita"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateVisitForm.comm_type_visit"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Descripción de Visita
                </label>

                <div class="bg-white">
                  <quill-editor
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                    v-model:content="updateVisitForm.comm_description_visit"
                  ></quill-editor>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Inicio
                </label>

                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateVisitForm.comm_date_init_visit"
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
                  Fecha de Finalización
                </label>

                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateVisitForm.comm_date_end_visit"
                  required
                />
              </div>
            </div>

            <!-- Information Address -->
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="this.visitBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateVisit">
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
    this.allVisit;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },

    ...mapState("community", ["community"]),
    ...mapState("visit", ["visit"]),

    allVisit() {
      axios
        .get(
          this.route("secretary.communities.visit.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllVisit(res.data);
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
      comm_reason_visit: null,
      comm_type_visit: null,
      comm_description_visit: null,
      comm_date_init_visit: null,
      comm_date_end_visit: null,
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
      visitBeingDeleted: null,
      deleteVisitForm: this.$inertia.form({
        comm_reason_visit: null,
        comm_type_visit: null,
        comm_description_visit: null,
        comm_date_init_visit: null,
        comm_date_end_visit: null,
      }),
      visitBeingUpdated: null,
      updateVisitForm: this.$inertia.form({
        comm_reason_visit: null,
        comm_type_visit: null,
        comm_description_visit: null,
        comm_date_init_visit: null,
        comm_date_end_visit: null,
      }),
    };
  },
  watch: {
    "form.comm_description_visit": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateVisitForm.comm_description_visit": function () {
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
    ...mapActions("visit", ["updateAllVisit"]),
    ...mapGetters("visit", ["getAllVisit"]),
    submit() {
      this.form.comm_date_init_visit = this.formatDate(this.form.comm_date_init_visit);
      this.form.comm_date_end_visit = this.formatDate(this.form.comm_date_end_visit);
      //
      Inertia.post(
        route("secretary.communities.visit.store", {
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

            this.form.comm_reason_visit = null;
            this.form.comm_type_visit = null;
            this.form.comm_description_visit = null;
            this.form.comm_date_init_visit = null;
            this.form.comm_date_end_visit = null;
            this.$refs.qleditor1.setHTML("");
          },
        }
      );
      //
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
    confirmationVisitUpdate(visit) {
      this.updateVisitForm.comm_reason_visit = visit.comm_reason_visit;
      this.updateVisitForm.comm_type_visit = visit.comm_type_visit;
      this.updateVisitForm.comm_description_visit = visit.comm_description_visit;
      this.updateVisitForm.comm_date_init_visit = visit.comm_date_init_visit;
      this.updateVisitForm.comm_date_end_visit = visit.comm_date_end_visit;

      this.visitBeingUpdated = visit;
    },
    updateVisit() {
      this.updateVisitForm.comm_date_init_visit = this.formatDate(
        this.updateVisitForm.comm_date_init_visit
      );
      this.updateVisitForm.comm_date_end_visit = this.formatDate(
        this.updateVisitForm.comm_date_end_visit
      );

      this.updateVisitForm.put(
        this.route("secretary.communities.visit.update", {
          community_id: this.community.id,
          visit_id: this.visitBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.visitBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
    // Delete
    confirmationVisitDelete(visit) {
      this.deleteVisitForm.comm_reason_visit = visit.comm_reason_visit;
      this.visitBeingDeleted = visit;
    },
    deleteVisit() {
      this.deleteVisitForm.delete(
        this.route("secretary.communities.visit.delete", {
          community_id: this.community.id,
          visit_id: this.visitBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.visitBeingDeleted = null),
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
          this.route("secretary.communities.visit.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateAllVisit(res.data);
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
