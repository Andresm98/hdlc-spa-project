<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla de Permisos de Hermana
      </h6>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo del Permiso:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.reason">
                {{ $page.props.errors.reason }}
              </p>
              <small>Formato: Motivo del permiso.</small>
              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar Motivo del Permiso"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.reason"
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
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha de Consejo Provincial:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.date_province">
                {{ $page.props.errors.date_province }}
              </p>
              <small>Formato: Fecha de Consejo Provincial que concede el Permiso.</small>
              <Datepicker
                v-model="form.date_province"
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
                Fecha de Consejo General:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.date_general">
                {{ $page.props.errors.date_general }}
              </p>
              <small>Formato: Fecha de Consejo General que concede el Permiso.</small>
              <Datepicker
                v-model="form.date_general"
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
                Fecha de Salida:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.date_out">
                {{ $page.props.errors.date_out }}
              </p>
              <small>Formato: Fecha en la que sale la hermana.</small>
              <Datepicker
                v-model="form.date_out"
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
                Fecha de Regreso (Eventual):
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.date_in">
                {{ $page.props.errors.date_in }}
              </p>
              <small>Formato: Fecha en la que regresa la hermana.</small>
              <Datepicker
                v-model="form.date_in"
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
                Descripción del Permiso
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                {{ $page.props.errors.description }}
              </p>
              <small>Formato: Agregar la descripción del permiso.</small>
              <div class="bg-white">
                <quill-editor
                  v-model:content="form.description"
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <!-- Information Address -->

          <div class="w-full lg:w-full px-4">
            <div>
              <label for="address" class="block text-sm font-medium text-gray-700">
                Dirección:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.address">
                {{ $page.props.errors.address }}
              </p>
              <small>Formato: Agregar la dirección de destino.</small>
              <div class="mb-1">
                <textarea
                  id="address"
                  name="address"
                  rows="1"
                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                  v-model="form.address"
                  placeholder="Agregar la dirección de destino.."
                  :maxlength="100"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-2/5 px-4 mb-2">
            <div class="w-full">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Provincia Destino:
              </label>
              <div :class="{ invalid: isInvalid }">
                <multiselect
                  :searchable="true"
                  v-model="selectOne.selectedProvince"
                  :options="this.allProvinces"
                  :close-on-select="true"
                  :clear-on-select="false"
                  mode="tags"
                  label="name"
                  @search-change="onSearchProvincesChange"
                  @select="onSelectedProvince"
                  track-by="name"
                  placeholder="Buscar provincia"
                >
                </multiselect>
                <p class="text-red-400 text-sm" v-show="isInvalid">Obligatorio</p>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-3/5 px-4 mb-2">
            <div class="relative w-full">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Cantón Destino:
              </label>
              <div :class="{ invalid: isInvalidCanton }">
                <multiselect
                  :searchable="true"
                  v-model="selectTwo.selectedCanton"
                  :options="selectTwo.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  mode="tags"
                  label="name"
                  @select="onSelectedCanton"
                  @search-change="onSearchCantonChange"
                  track-by="name"
                  placeholder="Buscar cantón"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidCanton">Obligatorio</p>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4 mb-2">
            <div class="relative w-full">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Parroquia Destino:
              </label>
              <div :class="{ invalid: isInvalidParish }">
                <multiselect
                  :searchable="true"
                  v-model="selectThree.selectedParish"
                  :options="selectThree.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  label="name"
                  @select="onSelectedParish"
                  @search-change="onSearchParishChange"
                  track-by="name"
                  placeholder="Buscar parroquia"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidParish">Obligatorio</p>
              </div>
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Crear Permiso</jet-button-success
        >
      </form>

      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-400 hover:border-gray-400"
      />

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllPermit()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th
                    scope="col"
                    class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Motivo
                  </th>
                  <th
                    scope="col"
                    class="text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Fechas (provincial-general)
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Fechas (salida-regreso)
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
                <tr v-for="permit in this.getAllPermit()" :key="permit">
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ permit.reason.substring(0, 10) }}...
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                    >
                      {{ this.formatShowDate(permit.date_province) }} -
                      {{ this.formatShowDate(permit.date_general) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                    >
                      {{ this.formatShowDate(permit.date_out) }} -
                      {{ this.formatShowDate(permit.date_in) }}
                    </span>
                  </td>
                  <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <!-- Components -->

                    <div class="mx-auto flex gap-10">
                      <jet-button @click="confirmationPermitUpdate(permit)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button @click="confirmationPermitDelete(permit)"
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
        :show="permitBeingDeleted"
        @close="permitBeingDeleted == null"
      >
        <template #title> Eliminar el Permiso</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial del permiso ?

          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo del Permiso:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar Motivo del Permiso"
                  class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="deletePermitForm.reason"
                  readonly
                />
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="permitBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deletePermit">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="permitBeingUpdated"
        @close="permitBeingUpdated == null"
      >
        <template #title> Datos de Registro del Permiso</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Motivo del Permiso:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.reason">
                  {{ $page.props.errors.reason }}
                </p>
                <small>Formato: Motivo del permiso.</small>

                <div>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar Motivo del Permiso"
                    class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updatePermitForm.reason"
                    required
                  />
                </div>
              </div>
            </div>

            <!-- Information Address -->

            <div class="w-full lg:w-full px-4">
              <div>
                <label for="address" class="block text-sm font-medium text-gray-700">
                  Dirección:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.address">
                  {{ $page.props.errors.address }}
                </p>
                <small>Formato: Agregar la dirección de destino.</small>
                <div class="mb-1">
                  <textarea
                    id="address"
                    name="address"
                    rows="1"
                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                    v-model="updatePermitForm.address"
                    placeholder="Agregar la dirección de destino.."
                    :maxlength="100"
                    required
                  />
                </div>
              </div>
            </div>
            <div class="w-full lg:w-2/5 px-4 mb-2">
              <div class="w-full">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Provincia Destino:
                </label>
                <div :class="{ invalid: isInvalid }">
                  <multiselect
                    :searchable="true"
                    v-model="selectOne.selectedProvince"
                    :options="this.allProvinces"
                    :close-on-select="true"
                    :clear-on-select="false"
                    mode="tags"
                    label="name"
                    @search-change="onSearchProvincesChange"
                    @select="onSelectedProvince"
                    track-by="name"
                    placeholder="Buscar provincia"
                  >
                  </multiselect>
                  <p class="text-red-400 text-sm" v-show="isInvalid">Obligatorio</p>
                </div>
              </div>
            </div>
            <div class="w-full lg:w-3/5 px-4 mb-2">
              <div class="relative w-full">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Cantón Destino:
                </label>
                <div :class="{ invalid: isInvalidCanton }">
                  <multiselect
                    :searchable="true"
                    v-model="selectTwo.selectedCanton"
                    :options="selectTwo.options"
                    :close-on-select="true"
                    :clear-on-select="false"
                    mode="tags"
                    label="name"
                    @select="onSelectedCanton"
                    @search-change="onSearchCantonChange"
                    track-by="name"
                    placeholder="Buscar cantón"
                  >
                  </multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidCanton">Obligatorio</p>
                </div>
              </div>
            </div>
            <div class="w-full lg:w-12/12 px-4 mb-2">
              <div class="relative w-full">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Parroquia Destino:
                </label>
                <div :class="{ invalid: isInvalidParish }">
                  <multiselect
                    :searchable="true"
                    v-model="selectThree.selectedParish"
                    :options="selectThree.options"
                    :close-on-select="true"
                    :clear-on-select="false"
                    label="name"
                    @select="onSelectedParish"
                    @search-change="onSearchParishChange"
                    track-by="name"
                    placeholder="Buscar parroquia"
                  >
                  </multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidParish">Obligatorio</p>
                </div>
              </div>
            </div>

            <!-- Information Address -->

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Fecha de Consejo Provincial:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.date_province">
                  {{ $page.props.errors.date_province }}
                </p>
                <small
                  >Formato: Fecha de Consejo Provincial que concede el Permiso.</small
                >

                <Datepicker
                  v-model="updatePermitForm.date_province"
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
                  Fecha de Consejo General:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.date_general">
                  {{ $page.props.errors.date_general }}
                </p>
                <small>Formato: Fecha de Consejo General que concede el Permiso.</small>

                <Datepicker
                  v-model="updatePermitForm.date_general"
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
                  Fecha de Salida:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.date_out">
                  {{ $page.props.errors.date_out }}
                </p>
                <small>Formato: Fecha en la que sale la hermana.</small>
                <Datepicker
                  v-model="updatePermitForm.date_out"
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
                  Fecha de Regreso (Eventual):
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.date_in">
                  {{ $page.props.errors.date_in }}
                </p>
                <small>Formato: Fecha en la que regresa la hermana.</small>

                <Datepicker
                  v-model="updatePermitForm.date_in"
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                />
              </div>
            </div>
            <div class="w-full lg:w-full px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Descripción del Permiso
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                  {{ $page.props.errors.description }}
                </p>
                <small>Formato: Agregar la descripción del permiso.</small>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="updatePermitForm.description"
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="updatePermitCancel">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updatePermit">
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
import { mapState, mapActions, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: {
    errors: null,
  },
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetInputError,
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
      reason: null,
      description: null,
      date_province: null,
      date_general: null,
      date_out: null,
      date_in: null,
      address: null,
      province_id: null,
      canton_id: null,
      parish_id: null,
      political_division_id: null,
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
      permitBeingDeleted: null,
      deletePermitForm: this.$inertia.form({
        reason: null,
        description: null,
        date_province: null,
        date_general: null,
        date_out: null,
        date_in: null,
      }),
      permitBeingUpdated: null,
      updatePermitForm: this.$inertia.form({
        reason: null,
        description: null,
        date_province: null,
        date_general: null,
        date_out: null,
        date_in: null,
        address: null,
        province_id: null,
        canton_id: null,
        parish_id: null,
        political_division_id: null,
      }),

      //Provinces
      selectOne: {
        selectedProvince: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },
      selectTwo: {
        selectedCanton: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectCanton: null,
        vSelectCanton: null,
      },
      selectThree: {
        selectedParish: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectParish: null,
        vSelectParish: null,
      },
    };
  },

  mounted() {
    this.allPermit;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState("permit", ["permit"]),
    allPermit() {
      axios
        .get(
          this.route("secretary.daughter-profile.permit.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.updateAllPermit(res.data);
        });
    },

    // Validate Multioption
    isInvalid() {
      //   console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOne.selectedProvince == undefined ||
        this.selectOne.selectedProvince == null
      );
    },
    isInvalidCanton() {
      //   console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwo.selectedCanton == undefined ||
        this.selectTwo.selectedCanton == null
      );
    },
    isInvalidParish() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedParish == undefined ||
        this.selectThree.selectedParish == null
      );
    },
  },
  watch: {
    "selectOne.selectedProvince": function () {
      if (this.selectOne.selectedProvince === null) {
        this.selectTwo.selectedCanton = null;
        this.selectThree.selectedParish = null;
        this.selectTwo.options = [];
        this.selectThree.options = [];
        // Clean data Form
        this.form.province_id = null;
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "selectTwo.selectedCanton": function () {
      if (this.selectTwo.selectedCanton === null) {
        this.selectThree.selectedParish = null;
        this.selectThree.options = [];
        // Clean data Form
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "selectThree.selectedParish": function () {
      if (this.selectThree.selectedParish === null) {
        // Clean data Form
        this.form.parish_id = null;
        this.form.political_division_id = null;

        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "form.description": function () {
      var limit = 2000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
    "updatePermitForm.description": function () {
      var limit = 2000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
  },
  methods: {
    ...mapActions("permit", ["updateAllPermit"]),
    ...mapGetters("permit", ["getAllPermit"]),

    async status() {
      let response = await axios.get(
        this.route("secretary.address.actual-address", {
          actual_parish: this.updatePermitForm.political_division_id,
        })
      );
      return response.data;
    },

    onSearchProvincesChange(term) {
      //   console.log("input data search " + term);
    },

    onSelectedProvince(province) {
      //   console.log("input data selecter " + province.id);
      this.form.province_id = province.id;
      this.form.canton_id = null;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectTwo.selectedCanton = undefined;
      this.selectThree.selectedParish = undefined;
      this.selectTwo.options = [];
      this.selectThree.options = [];
      if (this.permitBeingUpdated != null) {
        this.updatePermitForm.political_division_id = null;
      }

      axios
        .get(
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.selectTwo.options = res.data;
        });
    },

    onSearchCantonChange(term) {
      //   console.log(term);
    },

    onSelectedCanton(canton) {
      //   console.log("input data selecter " + canton.id);
      this.form.canton_id = canton.id;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectThree.selectedParish = undefined;
      this.selectThree.options = [];
      if (this.permitBeingUpdated != null) {
        this.updatePermitForm.political_division_id = null;
      }

      axios
        .get(
          this.route("secretary.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {
      //   console.log(term);
    },

    onSelectedParish(parish) {
      this.form.parish_id = parish.id;
      this.form.political_division_id = parish.id;
      //   console.log("input parish data selecter " + this.form.parish_id);

      if (this.permitBeingUpdated != null) {
        this.updatePermitForm.political_division_id = parish.id;
      }
    },
    submit() {
      this.form.date_province = this.formatDate(this.form.date_province);
      this.form.date_general = this.formatDate(this.form.date_general);
      this.form.date_out = this.formatDate(this.form.date_out);
      this.form.date_in = this.formatDate(this.form.date_in);
      //
      if (
        this.isInvalid == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false
      ) {
        Inertia.post(
          route("secretary.daughter-profile.permit.store", {
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
              this.form.reason = null;
              this.form.description = null;
              this.form.date_province = null;
              this.form.date_general = null;
              this.form.date_out = null;
              this.form.date_in = null;
              this.form.address = null;

              this.$refs.qleditor1.setHTML("");
              //   Clean address data

              this.selectOne.selectedProvince = null;
              this.selectTwo.selectedCanton = null;
              this.selectThree.selectedParish = null;
              this.selectOne.options = [];
              this.selectTwo.options = [];
              this.selectThree.options = [];
              // Clean data Form
              this.form.province_id = null;
              this.form.canton_id = null;
              this.form.parish_id = null;
              this.form.political_division_id = null;
            },
          }
        );
      }
    },
    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.permit.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllPermit(res.data);
        });
    },

    //  Update

    confirmationPermitUpdate(permit) {
      this.updatePermitForm.reason = permit.reason;
      this.updatePermitForm.description = permit.description;
      this.updatePermitForm.date_province = permit.date_province;
      this.updatePermitForm.date_general = permit.date_general;
      this.updatePermitForm.date_out = permit.date_out;
      this.updatePermitForm.date_in = permit.date_in;

      //   address: null,
      //   province_id: null,
      //   canton_id: null,
      //   parish_id: null,
      //   political_division_id: null,

      this.updatePermitForm.address = permit.address.address;
      this.updatePermitForm.political_division_id = permit.address.political_division_id;

      this.status().then((data) => {
        //   console.log(data);
        this.selectThree.options = data.parishes;
        this.selectThree.selectedParish = data.data_parish;

        this.selectTwo.options = data.cantons;
        this.selectTwo.selectedCanton = data.data_canton;

        this.selectOne.selectedProvince = data.data_province;
      });

      this.permitBeingUpdated = permit;
    },
    updatePermit() {
      this.updatePermitForm.date_province = this.formatDate(
        this.updatePermitForm.date_province
      );
      this.updatePermitForm.date_general = this.formatDate(
        this.updatePermitForm.date_general
      );
      this.updatePermitForm.date_out = this.formatDate(this.updatePermitForm.date_out);
      if (this.updatePermitForm.date_in != null) {
        this.updatePermitForm.date_in = this.formatDate(this.updatePermitForm.date_in);
      }

      if (
        this.isInvalid == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false
      ) {
        this.updatePermitForm.put(
          this.route("secretary.daughter-profile.permit.update", {
            user_id: this.profile.user_id,
            permit_id: this.permitBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.permitBeingUpdated = null;
              this.updatePermitForm.political_division_id = null;
              setTimeout(() => {
                this.updateTable();
              }, 100);
            },
          }
        );
      }
    },

    updatePermitCancel() {
      this.permitBeingUpdated = null;
      //   Clean address data

      this.selectOne.selectedProvince = null;
      this.selectTwo.selectedCanton = null;
      this.selectThree.selectedParish = null;
      this.selectOne.options = [];
      this.selectTwo.options = [];
      this.selectThree.options = [];
      // Clean data Form
      this.form.province_id = null;
      this.form.canton_id = null;
      this.form.parish_id = null;
      this.form.political_division_id = null;
    },
    // Delete

    confirmationPermitDelete(permit) {
      this.deletePermitForm.reason = permit.reason;
      this.deletePermitForm.description = permit.description;
      this.deletePermitForm.date_province = permit.date_province;
      this.permitBeingDeleted = permit;
    },

    deletePermit() {
      this.deletePermitForm.delete(
        this.route("secretary.daughter-profile.permit.delete", {
          user_id: this.profile.user_id,
          permit_id: this.permitBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.permitBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 500)
          ),
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
      return "eventual";
    },
  },
};
</script>
