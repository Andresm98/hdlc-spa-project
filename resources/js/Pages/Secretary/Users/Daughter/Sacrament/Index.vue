<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Sacramentos
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Nombre de Sacramento:
                </label>

                <div :class="{ invalid: isInvalid }">
                  <multiselect
                    placeholder="Por favor seleccionar el sacramento específico"
                    select-label="Enter doesn’t work here!"
                    v-model="form.sacrament_name"
                    :options="options"
                    :max-height="200"
                    :disabled="isDisabled"
                    @input="onChange"
                    @close="onTouch"
                    @select="onSelect"
                  ></multiselect>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Realización del Sacramento:
              </label>

              <Datepicker
                v-model="form.sacrament_date"
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
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  v-model:content="form.observation"
                ></quill-editor>
              </div>
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Sacramento</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Sacramentos</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(sacrament, index) in this.getAllSacrament()"
            :key="sacrament"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ sacrament.sacrament_date }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationSacramentUpdate(sacrament)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationSacramentDelete(sacrament)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="sacramentBeingDeleted"
        @close="sacramentBeingDeleted == null"
      >
        <template #title> Eliminar el historial de Sacramento</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial de sacramento ?

          <div class="w-3/3">
            <quill-editor
              refs="ql_deleteditor3"
              v-model:content="deleteSacramentForm.observation"
              contentType="html"
              theme="snow"
              :readOnly="true"
            ></quill-editor>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="sacramentBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteSacrament">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="sacramentBeingUpdated"
        @close="sacramentBeingUpdated == null"
      >
        <template #title> Datos de Registro del Sacramento</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Nombre de Sacramento:
                  </label>

                  <div :class="{ invalid: isInvalid }">
                    <multiselect
                      placeholder="Por favor seleccionar el sacramento específico"
                      select-label="Enter doesn’t work here!"
                      v-model="updateSacramentForm.sacrament_name"
                      :options="options"
                      :max-height="200"
                      :disabled="isDisabled"
                      @input="onChange"
                      @close="onTouch"
                      @select="onSelect"
                    ></multiselect>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Realización del Sacramento:
                </label>

                <Datepicker
                  v-model="updateSacramentForm.sacrament_date"
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
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                    v-model:content="updateSacramentForm.observation"
                  ></quill-editor>
                </div>
              </div>
            </div>

            <!-- Information Address -->
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="sacramentBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateSacrament">
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
    errors: [],
  },
  mounted() {
    this.allSacrament;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },
    ...mapState("daughter", ["profile"]),
    ...mapState("sacrament", ["sacrament"]),
    allSacrament() {
      axios
        .get(
          this.route("secretary.daughter-profile.sacrament.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllSacrament(res.data);
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
      sacrament_name: null,
      sacrament_date: null,
      observation: null,
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
        // "Penitencia",
        // "Eucaristia",
        "Primera Comunión",
        "Confirmación",
        // "Orden Sacerdotal",
        // "Matrimonio",
        // "Unión de Enfermos",
      ],
      sacramentBeingDeleted: null,
      deleteSacramentForm: this.$inertia.form({
        sacrament_name: null,
        sacrament_date: null,
        observation: null,
      }),
      sacramentBeingUpdated: null,
      updateSacramentForm: this.$inertia.form({
        sacrament_name: null,
        sacrament_date: null,
        observation: null,
      }),
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
    "updateSacramentForm.observation": function () {
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
    ...mapActions("sacrament", ["updateAllSacrament"]),
    ...mapGetters("sacrament", ["getAllSacrament"]),
    submit() {
      this.form.sacrament_date = this.formatDate(this.form.sacrament_date);
      //
      Inertia.post(
        route("secretary.daughter-profile.sacrament.store", {
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
            this.form.sacrament_name = null;
            this.form.sacrament_date = null;
            this.form.observation = null;

            this.$refs.qleditor1.setHTML("");
          },
        }
      );
      //
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    confirmationSacramentUpdate(sacrament) {
      this.updateSacramentForm.sacrament_name = sacrament.sacrament_name;
      this.updateSacramentForm.sacrament_date = sacrament.sacrament_date;
      this.updateSacramentForm.observation = sacrament.observation;
      this.sacramentBeingUpdated = sacrament;
    },
    updateSacrament() {
      this.updateSacramentForm.sacrament_date = this.formatDate(
        this.updateSacramentForm.sacrament_date
      );
      this.updateSacramentForm.put(
        this.route("secretary.daughter-profile.sacrament.update", {
          user_id: this.profile.user_id,
          sacrament_id: this.sacramentBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.sacramentBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
    // Delete
    confirmationSacramentDelete(sacrament) {
      this.deleteSacramentForm.observation = sacrament.observation;
      this.sacramentBeingDeleted = sacrament;
    },
    deleteSacrament() {
      this.deleteSacramentForm.delete(
        this.route("secretary.daughter-profile.sacrament.delete", {
          user_id: this.profile.user_id,
          sacrament_id: this.sacramentBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.sacramentBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 500)
          ),
        }
      );
    },

    //

    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.sacrament.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllSacrament(res.data);
        });
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
};
</script>
