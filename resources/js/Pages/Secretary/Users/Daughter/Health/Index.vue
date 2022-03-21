<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Estado de Salud de la Hermana
      </h6>
      <form @submit.prevent="submit">
        <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
          Estado de Salud Actual:
        </label>
        <p class="text-red-400 text-sm" v-show="$page.props.errors.actual_health">
          {{ $page.props.errors.actual_health }}
        </p>
        <div class="bg-white">
          <quill-editor
            ref="qleditor1"
            v-model:content="form.actual_health"
            contentType="html"
            theme="snow"
            :toolbar="toolbarOptions"
            placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
          ></quill-editor>
        </div>
        <label
          class="mt-2 block text-sm font-medium text-gray-700"
          htmlfor="grid-password"
        >
          Enfermedades Crónicas:
        </label>
        <p class="text-red-500 text-sm" v-show="$page.props.errors.chronic_diseases">
          {{ $page.props.errors.chronic_diseases }}
        </p>
        <div class="bg-white">
          <quill-editor
            ref="qleditor2"
            v-model:content="form.chronic_diseases"
            contentType="html"
            theme="snow"
            :toolbar="toolbarOptions"
            placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
          ></quill-editor>
        </div>

        <label
          class="mt-2 block text-sm font-medium text-gray-700"
          htmlfor="grid-password"
        >
          Otros Problemas de Salud:
        </label>
        <p class="text-red-400 text-sm" v-show="$page.props.errors.other_health_problems">
          {{ $page.props.errors.other_health_problems }}
        </p>
        <div class="bg-white">
          <quill-editor
            ref="qleditor3"
            v-model:content="form.other_health_problems"
            contentType="html"
            theme="snow"
            :toolbar="toolbarOptions"
            placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
          ></quill-editor>
        </div>

        <div class="flex flex-wrap">
          <div class="w-full lg:w-2/4 mt-2">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Ingreso:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.consult_date">
                {{ $page.props.errors.consult_date }}
              </p>
              <Datepicker
                v-model="form.consult_date"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-2/4">
            <div class="m-2 md:mt-8 lg:mt-8 xl:mt-8">
              <jet-button-success>Ingresar Estado. S</jet-button-success>
            </div>
          </div>
        </div>
      </form>
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />
      <!-- Table -->
      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial Médico</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(health, index) in this.getAllHealth()"
            :key="health"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ health.consult_date }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationHealthUpdate(health)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationHealthDelete(health)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <jet-confirmation-modal :show="healthBeingDeleted" @close="healthBeingDeleted == null">
    <template #title> Eliminar el estado de Salud</template>

    <template #content>
      ¿Está seguro de que desea eliminar el estado de salud ?

      <quill-editor
        refs="ql_deleteditor3"
        v-model:content="deleteHealthForm.actual_health"
        contentType="html"
        theme="snow"
        :readOnly="true"
      ></quill-editor>
    </template>

    <template #footer>
      <jet-secondary-button @click="healthBeingDeleted = null">
        Cancelar
      </jet-secondary-button>

      <jet-danger-button class="ml-3" @click="deleteHealthStatus">
        Eliminar
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>

  <jet-dialog-modal
    :max-width="'input-md'"
    :show="healthBeingUpdated"
    @close="healthBeingUpdated == null"
  >
    <template #title> Datos de Registro de Salud</template>

    <template #content>
      <label class="block text-sm font-medium text-black" htmlfor="grid-password">
        Estado de Salud Actual:
      </label>
      <p class="text-red-400 text-sm" v-show="$page.props.errors.actual_health">
        {{ $page.props.errors.actual_health }}
      </p>
      <div class="bg-white">
        <quill-editor
          ref="qlupdateditor1"
          v-model:content="updateHealthForm.actual_health"
          contentType="html"
          theme="snow"
          :toolbar="toolbarOptions"
          placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
        ></quill-editor>
      </div>

      <label class="mt-2 block text-sm font-medium text-gray-700" htmlfor="grid-password">
        Enfermedades Crónicas:
      </label>
      <p class="text-red-500 text-sm" v-show="$page.props.errors.chronic_diseases">
        {{ $page.props.errors.chronic_diseases }}
      </p>
      <div class="bg-white">
        <quill-editor
          ref="qlupdateditor2"
          v-model:content="updateHealthForm.chronic_diseases"
          contentType="html"
          theme="snow"
          :toolbar="toolbarOptions"
          placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
        ></quill-editor>
      </div>

      <label class="mt-2 block text-sm font-medium text-gray-700" htmlfor="grid-password">
        Otros Problemas de Salud:
      </label>
      <p class="text-red-400 text-sm" v-show="$page.props.errors.other_health_problems">
        {{ $page.props.errors.other_health_problems }}
      </p>
      <div class="bg-white">
        <quill-editor
          ref="qlupdateditor3"
          v-model:content="updateHealthForm.other_health_problems"
          contentType="html"
          theme="snow"
          :toolbar="toolbarOptions"
          placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
        ></quill-editor>
      </div>

      <div class="flex flex-wrap">
        <div class="w-full lg:w-2/4 mt-2">
          <div class="relative w-full mb-3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Fecha de Ingreso:
            </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.consult_date">
              {{ $page.props.errors.consult_date }}
            </p>
            <Datepicker
              v-model="updateHealthForm.consult_date"
              :format="format"
              :transitions="false"
              menuClassName="dp-custom-menu"
              required
            />
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="healthBeingUpdated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button-success class="ml-3" @click="updateHealthStatus">
        Actualizar
      </jet-button-success>
    </template>
  </jet-dialog-modal>
</template>
<script>
import { defineComponent, ref } from "vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";

import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";

import { useForm } from "@inertiajs/inertia-vue3";
import { mapActions, mapGetters, mapState } from "vuex";
import Datepicker from "vue3-date-time-picker";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetButtonSuccess,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSectionBorder,
    AppLayout,
    Datepicker,
    moment,
  },
  mounted() {
    this.allHealth;
  },
  watch: {
    content() {
      var limit = 4000;
      const quill = this.$refs.myQuillEditor;
      if (quill.getHTML().length <= limit) {
        this.data_flag = quill.getHTML();
      } else {
        quill.setHTML(this.data_flag);
      }
    },
    "form.actual_health": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "form.chronic_diseases": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor2;
      if (quill.getHTML().length <= limit) {
        this.data_intput_two = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_two);
      }
    },
    "form.other_health_problems": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor3;
      if (quill.getHTML().length <= limit) {
        this.data_intput_three = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_three);
      }
    },

    "updateHealthForm.actual_health": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor1;

      if (this.updateHealthForm.actual_health.length <= limit) {
        this.data_intput_one = this.updateHealthForm.actual_health;
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateHealthForm.chronic_diseases": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor2;
      if (this.updateHealthForm.chronic_diseases.length <= limit) {
        this.data_intput_two = this.updateHealthForm.chronic_diseases;
      } else {
        quill.setHTML(this.data_intput_two);
      }
    },
    "updateHealthForm.other_health_problems": function () {
      var limit = 4000;
      const quill = this.$refs.qlupdateditor3;
      if (this.updateHealthForm.other_health_problems.length <= limit) {
        this.data_intput_three = this.updateHealthForm.other_health_problems;
      } else {
        quill.setHTML(this.data_intput_three);
      }
    },
  },
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    const form = useForm({
      consult_date: null,
      actual_health: null,
      chronic_diseases: null,
      other_health_problems: null,
    });

    const dateinput = ref(new Date());
    function dateSelected(payload) {
      console.log(payload);
    }
    return { dateinput, dateSelected, date, format, form };
  },
  props: {
    errors: [],
  },
  data() {
    return {
      data_flag: "",
      content: "",
      data_intput_one: "",
      data_intput_two: "",
      data_intput_three: "",
      delta: undefined,
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
        "Select option",
        "Disable me!",
        "Reset me!",
        "mulitple",
        "label",
        "searchable",
      ],
      healthBeingDeleted: null,
      deleteHealthForm: this.$inertia.form({
        consult_date: null,
        actual_health: null,
        chronic_diseases: null,
        other_health_problems: null,
      }),
      healthBeingUpdated: null,
      updateHealthForm: this.$inertia.form({
        consult_date: null,
        actual_health: null,
        chronic_diseases: null,
        other_health_problems: null,
      }),
    };
  },

  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("health", ["health"]),
    allHealth() {
      axios
        .get(
          this.route("secretary.daughter-profile.health.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllHealth(res.data);
        });
    },
  },

  methods: {
    ...mapActions("health", ["updateAllHealth"]),
    ...mapGetters("health", ["getAllHealth"]),
    submit() {
      this.form.consult_date = this.formatDate(this.form.consult_date);
      //
      Inertia.post(
        route("secretary.daughter-profile.health.store", {
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
            this.form.consult_date = null;
            this.form.actual_health = null;
            this.form.chronic_diseases = null;
            this.form.other_health_problems = null;

            this.$refs.qleditor1.setHTML("");
            this.$refs.qleditor2.setHTML("");
            this.$refs.qleditor3.setHTML("");
          },
        }
      );
      //
    },

    updateTable() {
      console.log("siempre");
      axios
        .get(
          this.route("secretary.daughter-profile.health.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllHealth(res.data);
        });
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    // Delete Health

    confirmationHealthDelete(health) {
      this.deleteHealthForm.actual_health = health.actual_health;
      this.healthBeingDeleted = health;
    },

    deleteHealthStatus() {
      this.deleteHealthForm.delete(
        this.route("secretary.daughter-profile.health.delete", {
          user_id: this.profile.user_id,
          health_id: this.healthBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.healthBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 500)
          ),
        }
      );
    },

    // Update Health

    confirmationHealthUpdate(health) {
      this.updateHealthForm.consult_date = health.consult_date;
      this.updateHealthForm.actual_health = health.actual_health;
      this.updateHealthForm.chronic_diseases = health.chronic_diseases;
      this.updateHealthForm.other_health_problems = health.other_health_problems;
      this.healthBeingUpdated = health;
    },
    updateHealthStatus() {
      this.updateHealthForm.consult_date = this.formatDate(
        this.updateHealthForm.consult_date
      );
      this.updateHealthForm.put(
        this.route("secretary.daughter-profile.health.update", {
          user_id: this.profile.user_id,
          health_id: this.healthBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.healthBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
  },
};
</script>
