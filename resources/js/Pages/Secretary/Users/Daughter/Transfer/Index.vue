<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Transferencias
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo de la Transferencia:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar motivo de la transferencia"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.transfer_reason"
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
                  v-model:content="form.transfer_observation"
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Comunidad Transferencia:
                </label>

                <div :class="{ invalid: isInvalid }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="form.community_id"
                      :options="this.allWork"
                      :max-height="200"
                      :disabled="isDisabled"
                      @input="onChange"
                      @close="onTouch"
                      @select="onSelect"
                      mode="tags"
                      label="comm_name"
                      track-by="comm_name"
                    ></multiselect>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Oficio a Ocupar:
                </label>

                <div :class="{ invalid: isInvalid }">
                  <div v-if="this.allOffice != null">
                    <multiselect
                      placeholder="Por favor seleccionar el oficio a ocupar"
                      select-label="Seleccionar!"
                      v-model="form.office_id"
                      :options="this.allOffice"
                      :max-height="200"
                      :disabled="isDisabled"
                      mode="tags"
                      label="name"
                      track-by="name"
                    ></multiselect>
                  </div>
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
                Fecha de Ubicación:
              </label>

              <Datepicker
                v-model="form.transfer_date_adission"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
                required
              />
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Transferencia</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="w-full bg-white rounded-lg shadow overflow-y-auto h-52">
        <ul class="divide-y-2 divide-gray-100">
          <li class="text-center text-white bg-slate-900">Historial de Transferencias</li>
          <li
            class="p-2 hover:bg-emerald-500 hover:text-white"
            v-for="(transfer, index) in this.getAllTransfer()"
            :key="transfer"
          >
            <div class="grid gap-5 grid-cols-5">
              <div class="md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ index }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2">
                {{ transfer.transfer_reason }}
              </div>
              <div class="hidden md:block md:text-sm lg:block lg:text-sm pt-2"></div>
              <div>
                <jet-button @click="confirmationTransferUpdate(transfer)"
                  >Detalles</jet-button
                >
              </div>
              <div>
                <jet-danger-button @click="confirmationTransferDelete(transfer)"
                  >Eliminar</jet-danger-button
                >
              </div>
            </div>
          </li>
        </ul>
      </div>

      <jet-confirmation-modal
        :show="transferBeingDeleted"
        @close="transferBeingDeleted == null"
      >
        <template #title> Eliminar el historial de Transferencia</template>

        <template #content>
          ¿Está seguro de que desea eliminar la transferencia?
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo de la Transferencia:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar motivo de la transferencia"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="deleteTransferForm.transfer_reason"
                  readonly
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
        </template>

        <template #footer>
          <jet-secondary-button @click="transferBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteTransfer">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="transferBeingUpdated"
        @close="transferBeingUpdated == null"
      >
        <template #title> Datos de Registro de la Transferencia</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Motivo de la Transferencia:
                </label>

                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar motivo de la transferencia"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateTransferForm.transfer_reason"
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
                <div class="">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Comunidad Transferencia:
                  </label>

                  <div :class="{ invalid: isInvalid }">
                    <div v-if="this.allWork != null">
                      <multiselect
                        placeholder="Por favor seleccionar la comunidad a la que va"
                        select-label="Seleccionar!"
                        v-model="selectOne.selectedCommunity"
                        :options="this.allWork"
                        :max-height="200"
                        :disabled="isDisabled"
                        @input="onChange"
                        @close="onTouch"
                        @select="onSelect"
                        mode="tags"
                        label="comm_name"
                        track-by="comm_name"
                      ></multiselect>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Oficio a Ocupar:
                  </label>

                  <div :class="{ invalid: isInvalid }">
                    <div v-if="this.allOffice != null">
                      <multiselect
                        placeholder="Por favor seleccionar el oficio a ocupar"
                        select-label="Seleccionar!"
                        v-model="selectTwo.selectedOffice"
                        :options="this.allOffice"
                        :max-height="200"
                        :disabled="isDisabled"
                        mode="tags"
                        label="name"
                        track-by="name"
                      ></multiselect>
                    </div>
                  </div>
                </div>
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
                    v-model:content="updateTransferForm.transfer_observation"
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
                  Fecha de Ubicación:
                </label>

                <Datepicker
                  v-model="updateTransferForm.transfer_date_adission"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  required
                />
              </div>
            </div>

            <!-- Information Address -->
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="transferBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateTransfer">
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
  created() {
    axios.get(this.route("secretary.offices.index")).then((res) => {
      this.updateAllOffice(res.data);
    });

    axios
      .get(this.route("secretary.daughter-profile.transfer.communities.index"))
      .then((res) => {
        console.log(res.data);
        this.updateAllWork(res.data);
      });
  },
  mounted() {
    this.allTransfer;
  },
  computed: {
    isInvalid() {
      console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },
    ...mapState("daughter", ["profile"]),
    ...mapState("transfer", ["transfer"]),
    ...mapState("transfer", ["allOffice"]),
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),

    allTransfer() {
      axios
        .get(
          this.route("secretary.daughter-profile.transfer.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllTransfer(res.data);
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
      transfer_date_adission: null,
      transfer_date_relocated: null,
      transfer_reason: null,
      transfer_observation: null,
      profile_id: null,
      community_id: null,
      office_id: null,
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

      selectOne: {
        selectedCommunity: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectCommunity: null,
        vSelectCommunity: null,
      },
      selectTwo: {
        selectedOffice: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectOffice: null,
        vSelectOffice: null,
      },
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
      transferBeingDeleted: null,
      deleteTransferForm: this.$inertia.form({
        transfer_date_adission: null,
        transfer_date_relocated: null,
        transfer_reason: null,
        transfer_observation: null,
        profile_id: null,
        community_id: null,
        office_id: null,
      }),
      transferBeingUpdated: null,
      updateTransferForm: this.$inertia.form({
        transfer_date_adission: null,
        transfer_date_relocated: null,
        transfer_reason: null,
        transfer_observation: null,
        profile_id: null,
        community_id: null,
        office_id: null,
      }),
    };
  },
  watch: {
    "form.transfer_observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updateTransferForm.transfer_observation": function () {
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
    ...mapActions("transfer", ["updateAllTransfer"]),
    ...mapActions("transfer", ["updateAllOffice"]),
    ...mapActions("transfer", ["getAllOffice"]),
    ...mapGetters("transfer", ["getAllTransfer"]),
    ...mapActions("work", ["updateAllWork"]),
    ...mapGetters("work", ["getAllWork"]),

    submit() {
      console.log("data send", this.form);
      this.form.transfer_date_adission = this.formatDate(
        this.form.transfer_date_adission
      );
      this.form.transfer_date_relocated = this.formatDate(
        this.form.transfer_date_relocated
      );
      //
      Inertia.post(
        route("secretary.daughter-profile.transfer.store", {
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
            this.form.transfer_date_adission = null;
            this.form.transfer_date_relocated = null;
            this.form.transfer_reason = null;
            this.form.transfer_observation = null;
            this.form.community_id = null;
            this.form.office_id = null;
            this.form.profile_id = null;

            this.$refs.qleditor1.setHTML("");
          },
        }
      );
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    confirmationTransferUpdate(transfer) {
      this.updateTransferForm.transfer_date_adission = transfer.transfer_date_adission;
      this.updateTransferForm.transfer_date_relocated = transfer.transfer_date_relocated;
      this.updateTransferForm.transfer_reason = transfer.transfer_reason;
      this.updateTransferForm.transfer_observation = transfer.transfer_observation;
      this.updateTransferForm.profile_id = transfer.profile_id;
      this.updateTransferForm.community_id = transfer.community_id;
      this.updateTransferForm.office_id = transfer.office_id;

      this.status(transfer).then((data) => {
        this.selectOne.selectedCommunity = data.community;
        this.selectTwo.selectedOffice = data.office;
      });

      this.transferBeingUpdated = transfer;
    },
    async status(transfer) {
      let response = await axios.get(
        this.route("secretary.daughter-profile.transfer-data.index", {
          transfer_id: transfer.id,
        })
      );
      return response.data;
    },
    updateTransfer() {
      this.updateTransferForm.transfer_date_adission = this.formatDate(
        this.updateTransferForm.transfer_date_adission
      );

      this.updateTransferForm.community_id = this.selectOne.selectedCommunity;
      this.updateTransferForm.office_id = this.selectTwo.selectedOffice;

      this.updateTransferForm.put(
        this.route("secretary.daughter-profile.transfer.update", {
          user_id: this.profile.user_id,
          transfer_id: this.transferBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.transferBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 100);
          },
        }
      );
    },
    // Delete
    confirmationTransferDelete(transfer) {
      this.deleteTransferForm.transfer_reason = transfer.transfer_reason;
      this.transferBeingDeleted = transfer;
    },
    deleteTransfer() {
      this.deleteTransferForm.delete(
        this.route("secretary.daughter-profile.transfer.delete", {
          user_id: this.profile.user_id,
          transfer_id: this.transferBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.transferBeingDeleted = null),
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
          this.route("secretary.daughter-profile.transfer.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllTransfer(res.data);
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
      console.log(this.allOffice);
      this.isTouched = true;
    },
  },
};
</script>
