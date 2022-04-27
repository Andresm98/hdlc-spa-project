<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Cambios
      </h6>

      <div v-if="$page.props.flash != null">
        <alert
          v-if="$page.props.flash.success"
          class="alert"
          :type_alert_r="(type_alert = 'success')"
          :message="$page.props.flash.success"
        >
        </alert>
        <alert
          v-if="$page.props.flash.error"
          class="alert"
          :type_alert_r="(type_alert = 'error')"
          :message="$page.props.flash.error"
        >
        </alert>
      </div>

      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.transfer_reason">
                {{ $page.props.errors.transfer_reason }}
              </p>
              <small>Formato: Ingresar el motivo del cambio.</small>
              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar motivo del cambio"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.transfer_reason"
                  required
                />
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
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.transfer_observation"
              >
                {{ $page.props.errors.transfer_observation }}
              </p>
              <small
                >Formato: Ingresar las observaciones pertinentes, 3000 caracteres
                max.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados..."
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
                  Comunidad u Obra:
                </label>
                <small
                  >Formato: Seleccionar la comunidad u obra a la que se cambia la
                  hermana.</small
                >
                <div :class="{ invalid: isInvalidCommunity }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="this.form.community_id"
                      :options="this.allWork"
                      :close-on-select="true"
                      :clear-on-select="false"
                      :max-height="200"
                      :disabled="isDisabled"
                      @select="onSelect"
                      mode="tags"
                      label="comm_name"
                    ></multiselect>
                    <p class="text-sm text-red-400" v-show="isInvalidCommunity">
                      Obligatorio
                    </p>
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
                  Cargo:
                </label>
                <small>Formato: Seleccionar el cargo que desempeñará la hermana.</small>
                <div :class="{ invalid: isInvalidOffice }">
                  <div v-if="this.allOffice != null">
                    <multiselect
                      placeholder="Por favor seleccionar el oficio a ocupar"
                      select-label="Seleccionar!"
                      v-model="this.form.office_id"
                      :options="this.allOffice"
                      :max-height="200"
                      :disabled="isDisabled"
                      mode="tags"
                      label="office_name"
                      track-by="office_name"
                    ></multiselect>
                    <p class="text-sm text-red-400" v-show="isInvalidOffice">
                      Obligatorio
                    </p>
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
                Fecha Inicio:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.transfer_date_adission"
              >
                {{ $page.props.errors.transfer_date_adission }}
              </p>
              <small>Formato: Fecha de inicio de actividades.</small>
              <Datepicker
                v-model="form.transfer_date_adission"
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
                Fecha Culminación:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.transfer_date_relocated"
              >
                {{ $page.props.errors.transfer_date_relocated }}
              </p>
              <small>Formato: Fecha de cierre de actividades (opcional).</small>
              <Datepicker
                v-model="form.transfer_date_relocated"
                :format="format"
                :transitions="false"
                menuClassName="dp-custom-menu"
              />
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-1 btn btn-primary"
          >Crear Cambio</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <!-- Table -->

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllTransfer()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th
                    scope="col"
                    class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Comunidad/Obra
                  </th>
                  <th
                    scope="col"
                    class="text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Cargo
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Fechas (inicio-fin)
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
                <tr v-for="transfer in this.getAllTransfer()" :key="transfer">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="1 1 18 18">
                          <path
                            d="M10,1.529c-4.679,0-8.471,3.792-8.471,8.471c0,4.68,3.792,8.471,8.471,8.471c4.68,0,8.471-3.791,8.471-8.471C18.471,5.321,14.68,1.529,10,1.529 M10,17.579c-4.18,0-7.579-3.399-7.579-7.579S5.82,2.421,10,2.421S17.579,5.82,17.579,10S14.18,17.579,10,17.579 M14.348,10c0,0.245-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.201-0.446-0.446s0.2-0.446,0.446-0.446h5C14.146,9.554,14.348,9.755,14.348,10 M14.348,12.675c0,0.245-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.201-0.446-0.446s0.2-0.445,0.446-0.445h5C14.146,12.229,14.348,12.43,14.348,12.675 M7.394,10c0,0.245-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.201-0.446-0.446s0.201-0.446,0.446-0.446h0.849C7.194,9.554,7.394,9.755,7.394,10 M7.394,12.675c0,0.245-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.201-0.446-0.446s0.201-0.445,0.446-0.445h0.849C7.194,12.229,7.394,12.43,7.394,12.675 M14.348,7.325c0,0.246-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.2-0.446-0.446c0-0.245,0.2-0.446,0.446-0.446h5C14.146,6.879,14.348,7.08,14.348,7.325 M7.394,7.325c0,0.246-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.2-0.446-0.446c0-0.245,0.201-0.446,0.446-0.446h0.849C7.194,6.879,7.394,7.08,7.394,7.325"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-black hover:text-blue-500">
                          <div
                            v-if="
                              transfer.community.comm_level == 1 &&
                              transfer.community.comm_id == null
                            "
                          >
                            <a
                              :href="
                                route('secretary.communities.edit', {
                                  slug: transfer.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ transfer.community.comm_name.substring(0, 15) }}...
                            </a>
                          </div>
                          <div
                            v-if="
                              transfer.community.comm_level == 2 &&
                              transfer.community.comm_id != null
                            "
                          >
                            <a
                              :href="
                                route('secretary.works.edit', {
                                  slug: transfer.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ transfer.community.comm_name.substring(0, 15) }}...
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ transfer.office.office_name }}
                    </div>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="transfer.transfer_date_relocated == null"
                  >
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                    >
                      {{ this.formatDateShow(transfer.transfer_date_adission) }} -
                      {{ this.formatDateShow(transfer.transfer_date_relocated) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                    >
                      {{ this.formatDateShow(transfer.transfer_date_adission) }} -
                      {{ this.formatDateShow(transfer.transfer_date_relocated) }}
                    </span>
                  </td>

                  <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <!-- Components -->

                    <div class="mx-auto flex gap-10">
                      <jet-button @click="confirmationTransferUpdate(transfer)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button @click="confirmationTransferDelete(transfer)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">Por el momento no existen registros.</p>
          </div>
        </div>
      </div>

      <jet-confirmation-modal
        :show="transferBeingDeleted"
        @close="transferBeingDeleted == null"
      >
        <template #title> Eliminar el historial del Cambio</template>

        <template #content>
          ¿Está seguro de que desea eliminar el cambio?
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.transfer_reason">
                {{ $page.props.errors.transfer_reason }}
              </p>
              <small>Motivo del cambio.</small>
              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar motivo del cambio"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="deleteTransferForm.transfer_reason"
                  readonly
                  required
                />
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
        <template #title> Datos de Registro del Cambio</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Motivo:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.transfer_reason"
                >
                  {{ $page.props.errors.transfer_reason }}
                </p>
                <small>Formato: Ingresar el motivo del cambio.</small>
                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar motivo del cambio"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateTransferForm.transfer_reason"
                    required
                  />
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
                    Comunidad u Obra:
                  </label>
                  <small
                    >Formato: Seleccionar la comunidad u obra a la que se cambia la
                    hermana.</small
                  >
                  <div :class="{ invalid: isInvalidUpdateCommunity }">
                    <div v-if="this.allWork != null">
                      <multiselect
                        :searchable="true"
                        placeholder="Por favor seleccionar la comunidad de destino"
                        select-label="Seleccionar!"
                        v-model="this.selectOne.selectedCommunity"
                        :options="this.allWork"
                        :close-on-select="true"
                        :clear-on-select="false"
                        :max-height="200"
                        :disabled="isDisabled"
                        @select="onSelect"
                        mode="tags"
                        label="comm_name"
                      ></multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidUpdateCommunity">
                        Obligatorio
                      </p>
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
                    Cargo:
                  </label>
                  <small>Formato: Seleccionar el cargo que desempeñará la hermana.</small>

                  <div :class="{ invalid: isInvalidUpdateOffice }">
                    <div v-if="this.allOffice != null">
                      <multiselect
                        placeholder="Por favor seleccionar el oficio a ocupar"
                        select-label="Seleccionar!"
                        v-model="selectTwo.selectedOffice"
                        :options="this.allOffice"
                        :max-height="200"
                        :disabled="isDisabled"
                        mode="tags"
                        label="office_name"
                        track-by="office_name"
                      ></multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidUpdateOffice">
                        Obligatorio
                      </p>
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.transfer_observation"
                >
                  {{ $page.props.errors.transfer_observation }}
                </p>
                <small>Formato: Ingresar las observaciones pertinentes.</small>
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
                  Fecha Inicio:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.transfer_date_adission"
                >
                  {{ $page.props.errors.transfer_date_adission }}
                </p>
                <small>Formato: Fecha de inicio de actividades.</small>
                <Datepicker
                  v-model="updateTransferForm.transfer_date_adission"
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
                  Fecha Relocalización:
                </label>
                <small>Opcional: Fecha de inicio de actividades.</small>
                <Datepicker
                  v-model="updateTransferForm.transfer_date_relocated"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
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
import Alert from "@/Components/Alert";

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
        // console.log(res.data);
        this.updateAllWork(res.data);
      });
  },
  mounted() {
    this.allTransfer;
  },
  computed: {
    isInvalid() {
      //   console.log("inva ", this.isTouched, "\n\nopp> ");
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
          //   console.log("computed ", res.data);
          this.updateAllTransfer(res.data);
        });
    },

    isInvalidOffice() {
      return this.form.office_id == undefined || this.form.office_id == null;
    },
    isInvalidUpdateOffice() {
      return (
        this.selectTwo.selectedOffice == undefined ||
        this.selectTwo.selectedOffice == null
      );
    },
    isInvalidCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return this.form.community_id == undefined || this.form.community_id == null;
    },

    isInvalidUpdateCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectOne.selectedCommunity == undefined ||
        this.selectOne.selectedCommunity == null
      );
    },
  },
  // Relashionship with another components
  components: {
    Alert,
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
      //   console.log("data send", this.form);
      if (this.form.transfer_date_adission) {
        this.form.transfer_date_adission = this.formatDate(
          this.form.transfer_date_adission
        );
      }
      if (this.form.transfer_date_relocated) {
        this.form.transfer_date_relocated = this.formatDate(
          this.form.transfer_date_relocated
        );
      }

      if (this.isInvalidCommunity == false && this.isInvalidOffice == false) {
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
      }
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatDateShow(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "Vigente";
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
      if (this.updateTransferForm.transfer_date_adission != null) {
        this.updateTransferForm.transfer_date_adission = this.formatDate(
          this.updateTransferForm.transfer_date_adission
        );
      }
      if (this.updateTransferForm.transfer_date_relocated != null) {
        this.updateTransferForm.transfer_date_relocated = this.formatDate(
          this.updateTransferForm.transfer_date_relocated
        );
      }

      this.updateTransferForm.community_id = this.selectOne.selectedCommunity;
      this.updateTransferForm.office_id = this.selectTwo.selectedOffice;

      if (this.isInvalidUpdateCommunity == false && this.isInvalidUpdateOffice == false) {
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
      }
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
            }, 1)
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
      //   console.log(this.allOffice);
      this.isTouched = true;
    },
  },
};
</script>
