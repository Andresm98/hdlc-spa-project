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
                  Razón:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_reason_visit"
                >
                  {{ $page.props.errors.comm_reason_visit }}
                </p>
                <small>Formato: Razón de la visita.</small>
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
                  Tipo:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_type_visit"
                >
                  {{ $page.props.errors.comm_type_visit }}
                </p>
                <small>Formato: Seleccionar el tipo de la visita.</small>
                <select
                  v-model="form.comm_type_visit"
                  id="material"
                  name="material"
                  autocomplete="article-material"
                  class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option value="1">Fraterna</option>
                  <option value="2">Regular</option>
                  <option value="3">Pastoral</option>
                </select>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_description_visit"
              >
                {{ $page.props.errors.comm_description_visit }}
              </p>
              <small
                >Formato: Descripción de la visita, máx 3000 caracteres.</small
              >
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
                Fecha Inicio:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_init_visit"
              >
                {{ $page.props.errors.comm_date_init_visit }}
              </p>
              <small>Formato: Fecha en la que inicia la visita.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.comm_date_init_visit"
                required
                :year-range="[1800, this.year]"
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha Fin:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_end_visit"
              >
                {{ $page.props.errors.comm_date_end_visit }}
              </p>
              <small>Formato: Fecha en la que termina la visita.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.comm_date_end_visit"
                required
                :year-range="[1800, this.year]"
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

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllVisit()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div className="overflow-y-auto h-96">
              <div className="relative px-4">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-blue-100">
                    <tr>
                      <th
                        scope="col"
                        class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Razón
                      </th>
                      <th
                        scope="col"
                        class="text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Tipo
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                      >
                        Fecha Inicio - Fin
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
                    <tr v-for="visit in this.getAllVisit()" :key="visit">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-10">
                            <svg class="svg-icon mt-1" viewBox="2 2 23 23">
                              <path
                                d="M14.467,1.771H5.533c-0.258,0-0.47,0.211-0.47,0.47v15.516c0,0.414,0.504,0.634,0.802,0.331L10,13.955l4.136,4.133c0.241,0.241,0.802,0.169,0.802-0.331V2.241C14.938,1.982,14.726,1.771,14.467,1.771 M13.997,16.621l-3.665-3.662c-0.186-0.186-0.479-0.186-0.664,0l-3.666,3.662V2.711h7.994V16.621z"
                              ></path>
                            </svg>
                          </div>
                          <div class="ml-4">
                            {{ visit.comm_reason_visit.substring(0, 10) }}
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div
                          class="text-sm font-medium text-gray-900"
                          v-if="visit.comm_type_visit == 1"
                        >
                          Fraterna
                        </div>
                        <div
                          class="text-sm font-medium text-gray-900"
                          v-if="visit.comm_type_visit == 2"
                        >
                          Regular
                        </div>
                        <div
                          class="text-sm font-medium text-gray-900"
                          v-if="visit.comm_type_visit == 3"
                        >
                          Pastoral
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-2"
                        >
                          {{ this.formatShowDate(visit.comm_date_init_visit) }}
                        </span>
                        <span
                          class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 mr-2"
                        >
                          {{ this.formatShowDate(visit.comm_date_end_visit) }}
                        </span>
                      </td>
                      <td
                        class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <!-- Components -->

                        <div class="mx-auto flex gap-10">
                          <jet-button @click="confirmationVisitUpdate(visit)"
                            >Detalles</jet-button
                          >
                          <jet-danger-button
                            @click="confirmationVisitDelete(visit)"
                            >Eliminar</jet-danger-button
                          >
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
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
                    Razón:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.comm_reason_visit"
                  >
                    {{ $page.props.errors.comm_reason_visit }}
                  </p>
                  <small>Formato: Razón de la visita.</small>
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
                    Tipo:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.comm_type_visit"
                  >
                    {{ $page.props.errors.comm_type_visit }}
                  </p>
                  <small>Formato: Seleccionar el tipo de la visita.</small>
                  <select
                    v-model="updateVisitForm.comm_type_visit"
                    id="material"
                    name="material"
                    autocomplete="article-material"
                    class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  >
                    <option value="1">Fraterna</option>
                    <option value="2">Regular</option>
                    <option value="3">Pastoral</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Descripción:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_description_visit"
                >
                  {{ $page.props.errors.comm_description_visit }}
                </p>
                <small
                  >Formato: Descripción de la visita, máx 3000
                  caracteres.</small
                >
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
                  Fecha Inicio:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_date_init_visit"
                >
                  {{ $page.props.errors.comm_date_init_visit }}
                </p>
                <small>Formato: Fecha en la que inicia la visita.</small>
                <Datepicker
                  :format="format"
                  autoApply
                  v-model="updateVisitForm.comm_date_init_visit"
                  required
                  :year-range="[1800, this.year]"
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha Fin:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_date_end_visit"
                >
                  {{ $page.props.errors.comm_date_end_visit }}
                </p>
                <small>Formato: Fecha en la que termina la visita.</small>
                <Datepicker
                  :format="format"
                  autoApply
                  v-model="updateVisitForm.comm_date_end_visit"
                  required
                  :year-range="[1800, this.year]"
                />
              </div>
            </div>
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
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import { mapState, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button.vue";
import Datepicker from "vue3-date-time-picker";
import JetInput from "@/Jetstream/Input.vue";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import moment from "moment";
import { ref } from "vue";

export default {
  props: {
    errors: [],
  },

  mounted() {
    this.allVisit;
  },

  computed: {
    isInvalid() {
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

  setup() {
    const date = ref(new Date());
    const year = new Date().getFullYear();

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
      year,
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
      this.form.comm_date_init_visit = this.formatDate(
        this.form.comm_date_init_visit
      );
      this.form.comm_date_end_visit = this.formatDate(
        this.form.comm_date_end_visit
      );
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
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "";
    },

    confirmationVisitUpdate(visit) {
      this.updateVisitForm.comm_reason_visit = visit.comm_reason_visit;
      this.updateVisitForm.comm_type_visit = visit.comm_type_visit;
      this.updateVisitForm.comm_description_visit =
        visit.comm_description_visit;
      this.updateVisitForm.comm_date_init_visit = visit.comm_date_init_visit;
      this.updateVisitForm.comm_date_end_visit = visit.comm_date_end_visit;
      this.visitBeingUpdated = visit;
    },

    updateVisit() {
      if (this.updateVisitForm.comm_date_init_visit != null) {
        this.updateVisitForm.comm_date_init_visit = this.formatDate(
          this.updateVisitForm.comm_date_init_visit
        );
      }
      if (this.updateVisitForm.comm_date_end_visit != null) {
        this.updateVisitForm.comm_date_end_visit = this.formatDate(
          this.updateVisitForm.comm_date_end_visit
        );
      }

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
  },
};
</script>
