<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="
          mt-2
          mb-2
          text-lg
          font-medium
          text-center
          leading-6
          text-gray-900
          uppercase
        "
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.sacrament_name"
                >
                  {{ $page.props.errors.sacrament_name }}
                </p>
                <small>Formato: Escoger uno de los sacramentos.</small>
                <div :class="{ invalid: isInvalid }">
                  <multiselect
                    :searchable="true"
                    placeholder="Por favor seleccionar el sacramento específico"
                    select-label="Enter doesn’t work here!"
                    :close-on-select="true"
                    :clear-on-select="false"
                    track-by="sacrament_name"
                    v-model="form.sacrament_name"
                    :options="options"
                    :max-height="200"
                    :disabled="isDisabled"
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
                Fecha Sacramento:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.sacrament_date"
              >
                {{ $page.props.errors.sacrament_date }}
              </p>
              <small>Formato: Fecha de Realización del Sacramento.</small>
              <Datepicker
                v-model="form.sacrament_date"
                :format="format"
                autoApply
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
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.observation"
              >
                {{ $page.props.errors.observation }}
              </p>
              <small
                >Formato: Opcional, agregar las observaciones relacionadas al
                sacramento.</small
              >
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
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Sacramento</jet-button-success
        >
      </form>
      <hr
        class="
          w-full
          mt-1
          mb-3
          ml-4
          mr-4
          border-b-1 border-gray-400
          hover:border-gray-400
        "
      />

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllSacrament()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th
                    scope="col"
                    class="
                      pl-4
                      text-left text-xs
                      font-medium
                      text-black
                      uppercase
                      tracking-wider
                    "
                  >
                    Nombre Sacramento
                  </th>
                  <th
                    scope="col"
                    class="
                      pl-4
                      text-left text-xs
                      font-medium
                      text-black
                      uppercase
                      tracking-wider
                    "
                  >
                    Fecha Sacramento
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-black
                      uppercase
                      tracking-wider
                    "
                  >
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr
                  v-for="sacrament in this.getAllSacrament()"
                  :key="sacrament"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ sacrament.sacrament_name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-full
                        bg-green-100
                        text-green-800
                      "
                    >
                      {{ this.formatShowDate(sacrament.sacrament_date) }}
                    </span>
                  </td>
                  <td
                    class="
                      px-3
                      py-4
                      whitespace-nowrap
                      text-right text-sm
                      font-medium
                    "
                  >
                    <!-- Components -->

                    <div class="mx-auto flex gap-10">
                      <jet-button
                        @click="confirmationSacramentUpdate(sacrament)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationSacramentDelete(sacrament)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      <jet-confirmation-modal
        :show="sacramentBeingDeleted"
        @close="sacramentBeingDeleted == null"
      >
        <template #title> Eliminar el historial de Sacramento</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial de sacramento ?

          <div class="w-3/3">
            <input
              type="text"
              minLength="10"
              maxlength="100"
              class="
                border-0
                px-3
                my-2
                placeholder-blueGray-300
                text-blueGray-600
                bg-white
                rounded
                text-sm
                shadow
                focus:outline-none focus:ring
                w-full
                ease-linear
                transition-all
                duration-150
              "
              v-model="deleteSacramentForm.sacrament_name"
              readonly
            />
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
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.sacrament_name"
                  >
                    {{ $page.props.errors.sacrament_name }}
                  </p>
                  <small>Formato: Escoger uno de los sacramentos.</small>

                  <div :class="{ invalid: isInvalid }">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar el sacramento específico"
                      select-label="Enter doesn’t work here!"
                      v-model="updateSacramentForm.sacrament_name"
                      :options="options"
                      :close-on-select="true"
                      :clear-on-select="false"
                      :max-height="200"
                      :disabled="isDisabled"
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
                  Fecha Sacramento:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.sacrament_date"
                >
                  {{ $page.props.errors.sacrament_date }}
                </p>
                <small>Formato: Fecha de Realización del Sacramento.</small>
                <Datepicker
                  v-model="updateSacramentForm.sacrament_date"
                  :format="format"
                  autoApply
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.observation"
                >
                  {{ $page.props.errors.observation }}
                </p>
                <small
                  >Formato: Opcional, agregar las observaciones relacionadas al
                  sacramento.</small
                >
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
      //   console.log("inva ", this.isTouched, "\n\nopp> ");
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

    formatShowDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },
    confirmationSacramentUpdate(sacrament) {
      this.updateSacramentForm.sacrament_name = sacrament.sacrament_name;
      this.updateSacramentForm.sacrament_date = sacrament.sacrament_date;
      this.updateSacramentForm.observation = sacrament.observation;
      this.sacramentBeingUpdated = sacrament;
    },
    updateSacrament() {
      if (this.updateSacramentForm.sacrament_date != null) {
        this.updateSacramentForm.sacrament_date = this.formatDate(
          this.updateSacramentForm.sacrament_date
        );
      }
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
      this.deleteSacramentForm.sacrament_name = sacrament.sacrament_name;
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
      this.isTouched = true;
    },
  },
};
</script>
