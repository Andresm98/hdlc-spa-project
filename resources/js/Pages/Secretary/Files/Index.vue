<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de Archivos
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
        {{ $page.props.user.lastname }}
      </div>
    </template>

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
    <operation></operation>

    <section
      class="
        bg-gray-200
        dark:bg-slate-800
        y-1
        px-4
        sm:p-6
        md:py-10 md:px-8
        pt-2
        pb-4
        rounded-lg
        sm:m-2
        lg:m-3
        md:m-4
      "
    >
      <div
        class="
          max-w-4xl
          mx-auto
          grid grid-cols-1
          lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2
        "
      >
        <div
          class="
            relative
            p-3
            col-start-1
            row-start-1
            flex flex-col-reverse
            rounded-lg
            bg-gradient-to-t
            from-black/75
            via-black/0
            sm:bg-none sm:row-start-2 sm:p-0
            md:bg-none md:row-start-2 md:p-0
            lg:row-start-1
          "
        >
          <h1
            class="
              mt-1
              text-lg
              font-semibold
              text-black
              sm:text-black
              md:text-2xl
              dark:sm:text-white
            "
          >
            Provincia Ecuador
          </h1>
          <p
            class="
              text-sm
              leading-4
              font-medium
              text-black
              sm:text-black
              dark:sm:text-slate-400
            "
          >
            Información General de los archivos pertenecientes a la Hermana.
          </p>
        </div>
        <div
          class="
            grid
            gap-4
            col-start-1 col-end-3
            row-start-1
            sm:mb-6 sm:grid-cols-4
            md:mb-6 md:grid-cols-4
            lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0
          "
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="
              w-full
              h-60
              object-cover
              rounded-lg
              sm:h-52 sm:col-span-2
              md:h-52 md:col-span-2
              lg:col-span-full
            "
            loading="lazy"
          />
        </div>
        <dl
          class="
            mt-4
            text-xs
            font-medium
            flex
            items-center
            row-start-2
            sm:mt-1 sm:row-start-3
            md:mt-1 md:row-start-3
            lg:row-start-2
          "
        >
          <dt class="sr-only">Visto</dt>
          <dd class="text-indigo-600 flex items-center dark:text-indigo-400">
            <svg
              width="24"
              height="24"
              fill="none"
              aria-hidden="true"
              class="mr-1 stroke-current dark:stroke-blue-100"
            >
              <path
                d="m12 5 2 5h5l-4 4 2.103 5L12 16l-5.103 3L9 14l-4-4h5l2-5Z"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >0.00 <span class="text-slate-400 font-normal">(0)</span></span
            >
          </dd>
          <dt class="sr-only">Ubicación por defecto - Ecuador</dt>
          <dd class="flex items-center">
            <svg
              width="2"
              height="2"
              aria-hidden="true"
              fill="currentColor"
              class="mx-3 text-white"
            >
              <circle cx="1" cy="1" r="1" />
            </svg>
            <svg
              width="24"
              height="24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="mr-1 text-black dark:text-white"
              aria-hidden="true"
            >
              <path
                d="M18 11.034C18 14.897 12 19 12 19s-6-4.103-6-7.966C6 7.655 8.819 5 12 5s6 2.655 6 6.034Z"
              />
              <path d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
            </svg>
            <p class="text-black dark:text-white">Quito, Ecuador</p>
          </dd>
        </dl>
      </div>
      <div class="mt-2">
        <p class="text-black dark:text-white">
          La presente plantilla de información se relaciona a todos los
          documentos de la Hermana, lea las istrucciones al ingresar un
          documento. Tamaño, formatos y otros requisitos para almacenar de
          manera correcta un archivo específico.
        </p>
      </div>
      <div class="content-center mt-2">
        <jet-button-success
          @click="confirmationFileCreate()"
          class="block mx-2 p-5 leading-normal"
          >¿Desea ingresar un nuevo fichero?</jet-button-success
        >
      </div>
    </section>

    <!-- Container Filters -->
    <div class="container mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            bg-gray-100
          "
        >
          <small class="justify-content-center ml-20 uppercase">Hermana</small>
          <multiselect
            :searchable="true"
            v-model="params.profile"
            :options="selectFour.options"
            :close-on-select="true"
            :clear-on-select="false"
            :custom-label="customLabel"
            @select="onSelectedPerfil"
            @search-change="onSearchPerfilChange"
            track-by="name"
            placeholder="Buscar hermana"
          >
          </multiselect>
        </div>

        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            bg-gray-100
          "
        >
          <small class="justify-content-center ml-20 uppercase"
            >Filtros de Búsqueda</small
          >

          <search-filter
            v-model="params.search"
            class="
              border border-blue-300
              rounded-md
              shadow-sm
              focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
              sm:text-sm
            "
            @reset="reset"
          >
          </search-filter>
        </div>

        <div
          class="
            justify-center
            text-sm
            border-1 border-gray-300
            rounded-sm
            p-1
            bg-gray-100
          "
        >
          <small class="justify-content-center ml-20 uppercase"
            >Rangos de Fechas</small
          >
          <p class="text-red-400 text-sm" v-show="$page.props.errors.dateStart">
            {{ $page.props.errors.dateStart }}
          </p>
          <Datepicker
            v-model="params.dateStart"
            :format="format"
            autoApply
            required
          />
          <small class="justify-content-center ml-6">Deste - Hasta</small>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.dateEnd">
            {{ $page.props.errors.dateEnd }}
          </p>
          <Datepicker
            v-model="params.dateEnd"
            :format="format"
            autoApply
            required
          />
        </div>
      </div>
      <!-- Table -->
      <section class="pl-4">
        <pagination class="mt-6 mb-5" :links="files_list.links" />
      </section>
      <small class="ml-6">
        Se encontraron {{ files_list.total }} ficheros.</small
      >
      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
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
                    Hermana y Nombre Archivo
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
                    Tamaño - Extensión
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
                    Fecha Creación - Fecha Actualización
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
                <tr v-for="file in this.files_list.data" :key="file">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="
                        my-2
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-full
                        bg-pink-100
                        text-pink-800
                      "
                    >
                      {{ file.fileable.user.name }}
                      {{ file.fileable.user.lastname }}
                    </span>
                    <br />
                    {{ file.external_filename.substring(0, 40) }}...
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
                      {{ this.bytesToSize(file.filesize) }} -
                      {{ this.extensionFile(file.external_filename) }}
                    </span>
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
                        bg-red-100
                        text-red-800
                      "
                    >
                      {{ this.formatShowDate(file.created_at) }}
                    </span>
                    -
                    <span
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-full
                        bg-yellow-100
                        text-yellow-800
                      "
                    >
                      {{ this.formatShowDate(file.updated_at) }}
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
                      <svg
                        class="h-8 w-8 text-blue-500 hover:cursor-pointer"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        @click="confirmationFileUpdate(file)"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                          d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"
                        />
                        <path
                          d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"
                        />
                        <line x1="16" y1="5" x2="19" y2="8" />
                      </svg>
                      <a
                        :href="
                          this.route('secretary.daughter-profile.files.show', {
                            file_id: file.id,
                          })
                        "
                      >
                        <svg
                          class="h-8 w-8 text-teal-400 hover:cursor-pointer"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
                          /></svg
                      ></a>

                      <svg
                        class="h-8 w-8 text-red-500 hover:cursor-pointer"
                        viewBox="0 0 24 24"
                        fill="none"
                        @click="confirmationFileDelete(file)"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                      </svg>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <section class="pl-4">
        <pagination class="mt-6 mb-5" :links="files_list.links" />
      </section>
    </div>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="fileBeingCreated"
      @close="fileBeingCreated == null"
    >
      <template #title> Datos del Nuevo Archivo</template>

      <template #content>
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="w-full lg:w-12/12 px-4 mb-2">
            <div class="relative w-full">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Hermana:
              </label>
              <div :class="{ invalid: isInvalidPerfil }">
                <multiselect
                  :searchable="true"
                  v-model="selectCyx.selectedPerfil"
                  :options="selectCyx.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  :custom-label="customCyxLabel"
                  @select="onCyxSelectedPerfil"
                  @search-change="onCyxSearchPerfilChange"
                  track-by="name"
                  placeholder="Buscar hermana"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidPerfil">
                  Obligatorio
                </p>
              </div>
            </div>
          </div>

          <div>
            <small
              >En el presente apartado usted puede almacenar archivos privados
              de cada perfil de Hermana, por ejemplo puede guardar PDFs que
              contengan copias de cédulas de identidad, pasaportes y otros
              documentos que son necesarios para los trámites que requiere
              realizar la comunidad.
              <br />
              Para hacer uso del almacenamiento de archivos debe tener en cuenta
              las siguientes indicaciones:
              <br />
              <ul>
                <li>1. Los archivos no pueden exceder 5MB.</li>
                <li>
                  2. Los archivos que usted puede adjuntar serán del formato que
                  usted requiera (.mp3, mp4, PDF, DOC y otros).
                </li>
                <li>
                  3. Tenga en cuenta que si sube un archivo que contenga un
                  nombre de un fichero existente en los registro de la base de
                  datos, el antiguo fichero será reemplazado.
                </li>
                <li>
                  5. Puede descargar, visualizar y eliminar el archivo (eliminar
                  un fichero es una acción irreversible por lo que debe
                  verificar de manera adecuada cual fichero ya no necesita).
                </li>
              </ul>
            </small>
            <br />
            <label class="block text-sm font-medium text-gray-700">
              Subir Ficheros:
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.filedata"
            >
              {{ $page.props.errors.filedata }}
            </p>
            <div
              class="
                mt-1
                flex
                justify-center
                px-6
                pt-5
                pb-6
                border-2 border-gray-300 border-dashed
                rounded-md
                hover:border-blue-600
              "
            >
              <div class="space-y-1 text-center">
                <svg
                  class="mx-auto h-12 w-12 text-gray-400"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 48 48"
                  aria-hidden="true"
                >
                  <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label
                    for="file-upload"
                    class="
                      relative
                      cursor-pointer
                      bg-white
                      rounded-md
                      font-medium
                      text-blue-600
                      hover:text-blue-500
                      focus-within:outline-none
                      focus-within:ring-2
                      focus-within:ring-offset-2
                      focus-within:ring-blue-500
                    "
                  >
                    <input
                      id="file-upload"
                      name="file-upload"
                      type="file"
                      class="
                        block
                        w-full
                        text-sm text-blue-500
                        file:mr-4
                        file:px-4
                        file:rounded-full
                        file:border-0
                        file:text-sm
                        file:font-semibold
                        file:bg-emerald-500
                        file:text-white
                        hover:file:bg-emerald-600
                        mb-4
                      "
                      @input="form.filedata = $event.target.files[0]"
                      @change="onFileChange"
                    />
                  </label>
                  <br />
                  <br />
                  <p class="">Clic en el botón verde para agregar archivos.</p>
                </div>
                <p class="text-xs text-gray-500">
                  PDF, DOCX, PNG, JPG, GIF max 5MB.
                </p>

                <div
                  class="w-full bg-gray-200 h-1"
                  v-if="form.progress"
                  :value="form.progress.percentage"
                  max="100"
                >
                  <div class="bg-blue-600 h-1" style="width: 100%">
                    {{ form.progress.percentage }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button
          @click="
            fileBeingCreated = null;
            form = null;
            selectCyx.options = [];
            selectCyx.selectedPerfil = null;
          "
        >
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="createFile">
          Crear
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="fileBeingUpdated"
      @close="fileBeingUpdated == null"
    >
      <template #title> Vista Previa del fichero</template>
      <template #content>
        <label
          class="block text-sm font-medium text-gray-700"
          htmlfor="grid-password"
        >
          Nombre del Archivo:
        </label>
        <input
          type="text"
          minLength="10"
          maxlength="40"
          placeholder="Ingresar "
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
          v-model="this.updateFileForm.external_filename"
          required
          readonly
        />
        <iframe
          class="w-full aspect-video ..."
          :src="this.updateFileForm.fileshow"
          title="Resource Data"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </template>

      <template #footer>
        <jet-secondary-button @click="clearUpdateData()">
          Cerrar
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>

    <jet-confirmation-modal
      :show="fileBeingDeleted"
      @close="fileBeingDeleted == null"
    >
      <template #title> Eliminar el fichero</template>

      <template #content>
        ¿Está seguro de que desea eliminar el archivo?

        <div class="flex flex-wrap">
          <div class="w-full lg:w-2/4 mt-2">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Nombre del Archivo:
              </label>
              <input
                type="text"
                minLength="10"
                maxlength="40"
                placeholder="Ingresar "
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
                v-model="deleteFileForm.external_filename"
                required
                readonly
              />
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="fileBeingDeleted = null">
          Cancelar
        </jet-secondary-button>

        <jet-danger-button class="ml-3" @click="deleteFile">
          Eliminar
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { pickBy, throttle, mapValues } from "lodash";
import { useForm, Link } from "@inertiajs/inertia-vue3";

import moment from "moment";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import { range } from "moment-range";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Datepicker from "vue3-date-time-picker";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Pagination from "@/Components/Pagination";
import Icon from "@/Components/Icon";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetButton from "@/Jetstream/Button.vue";

import TextInput from "@/Components/TextInput";
import { ref } from "vue";
import Alert from "@/Components/Alert";
import SearchFilter from "@/Components/SearchFilter";
import Operation from "@/Components/Secretary/Daughter/Operation";

import { Inertia } from "@inertiajs/inertia";
import { mapState, mapActions, mapGetters } from "vuex";
import Dropdown from "@/Components/Dropdown";

export default {
  layout: PrincipalLayout,
  props: {
    files_list: Object,
    allProvinces: Object,

    filters: Object,
  },
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    return {
      date,
      format,
    };
  },
  components: {
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetInput,
    JetInputError,
    JetButtonSuccess,
    JetSecondaryButton,
    TextInput,
    Alert,
    JetButton,
    SearchFilter,
    Datepicker,
    Icon,
    Dropdown,
    Operation,
    Pagination,
    JetConfirmationModal,
  },

  data() {
    return {
      params: {
        search: this.filters.search,
        date: this.filters.date,
        type: this.filters.type,
        status: this.filters.status,
        profile: this.filters.profile,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
      },
      navigationOp: 1,
      searchProfile: null,
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
      statustransfer: 0,
      fileBeingCreated: null,
      form: null,
      photoPreview: null,
      url: null,
      fileBeingDeleted: null,
      deleteFileForm: this.$inertia.form({
        filename: null,
        external_filename: null,
        filesize: null,
        url: null,
      }),

      fileBeingUpdated: null,
      updateFileForm: useForm({
        filedata: null,
        filename: null,
        external_filename: null,
        filesize: null,
        url: null,
        fileshow: null,
      }),

      isDisabled: false,
      isTouched: false,
      value: null,
      allAppointmentsTransfer: null,
      selectFour: {
        selectedPerfil: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectPerfil: null,
        vSelectPerfil: null,
      },
      selectCyx: {
        selectedPerfil: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectPerfil: null,
        vSelectPerfil: null,
      },
    };
  },
  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }
        this.$inertia.get(
          this.route("secretary.filesglobal.daughter.index"),
          params,
          {
            replace: true,
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
              // console.log("Success");
            },
          }
        );
      }, 1),
      deep: true,
    },

    "form.transfer.transfer_observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
    "updateTransferForm.transfer_observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
  },
  computed: {
    isInvalidCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.form.transfer.community_id == undefined ||
        this.form.transfer.community_id == null
      );
    },
    isInvalidUpdateCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectOne.selectedCommunity == undefined ||
        this.selectOne.selectedCommunity == null
      );
    },
    isInvalidPerfil() {
      //   console.log("ee Parish", this.selectFour.selectedPerfil);
      return (
        this.selectCyx.selectedPerfil == undefined ||
        this.selectCyx.selectedPerfil == null
      );
    },
  },
  methods: {
    bytesToSize(bytes) {
      var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
      if (bytes == 0) return "0 Byte";
      var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
      return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    },
    extensionFile(filename) {
      if (filename != null) {
        return (
          filename.substring(filename.lastIndexOf(".") + 1, filename.length) ||
          filename
        );
      }
      return "";
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
    onFileChange(e) {
      //   console.log("event", e);
      const filedata = e.target.files[0];
      this.url = URL.createObjectURL(filedata);
    },

    onFileChangeUpdate(e) {
      //   console.log("event", e);
      const filedata = e.target.files[0];
      this.url = URL.createObjectURL(filedata);
    },

    //
    confirmationFileCreate() {
      this.form = useForm({
        filedata: null,
      });
      this.fileBeingCreated = this.form;
    },
    createFile() {
      if (this.isInvalidPerfil == false) {
        this.form.post(
          route(`secretary.daughter-profile.files.store`, {
            user_id: this.selectCyx.selectedPerfil.id,
          }),
          {
            preserveScroll: true,
            onSuccess: () => {
              this.selectCyx.options = [];
              this.selectCyx.selectedPerfil = null;
              this.fileBeingCreated = null;
            },
          }
        );
      }
    },

    //
    confirmationFileUpdate(file) {
      this.updateFileForm.filename = file.filename;
      this.updateFileForm.external_filename = file.external_filename;
      this.updateFileForm.filesize = file.filesize;
      this.updateFileForm.url = file.url;
      axios
        .get(
          this.route("secretary.daughter-profile.files.edit", {
            file_id: file.id,
          })
        )
        .then((response) => {
          this.updateFileForm.fileshow = response.data;
        });

      this.fileBeingUpdated = file;
    },
    clearUpdateData() {
      this.fileBeingUpdated = null;
      this.updateFileForm.filedata = null;
      this.updateFileForm.filename = null;
      this.updateFileForm.external_filename = null;
      this.updateFileForm.filesize = null;
      this.updateFileForm.url = null;
      this.updateFileForm.fileshow = null;
    },
    updateFile() {
      //   console.log("data update", this.updateFileForm);
      this.updateFileForm.post(
        this.route("secretary.daughter-profile.files.update", {
          user_id: this.profile.user_id,
          file_id: this.fileBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.fileBeingUpdated = null;
            setTimeout(() => {
              axios
                .get(
                  this.route("secretary.daughter-profile.files.index", {
                    user_id: this.profile.user_id,
                  })
                )
                .then((response) => {
                  this.allFiles = response.data;
                });
            }, 100);
          },
        }
      );
    },
    //
    confirmationFileDelete(file) {
      this.deleteFileForm.external_filename = file.external_filename;
      this.deleteFileForm.filename = file.filename;
      this.deleteFileForm.filesize = file.filesize;
      this.deleteFileForm.url = file.url;

      this.fileBeingDeleted = file;
    },

    deleteFile() {
      this.deleteFileForm.delete(
        this.route("secretary.daughter-profile.files.delete", {
          file_id: this.fileBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.fileBeingDeleted = null), setTimeout(() => {}, 1)
          ),
        }
      );
    },
    reset() {
      this.params = mapValues(this.params, () => null);
    },

    onSearchPerfilChange(search) {
      var string = search;
      var length = 60;
      search = string.substring(0, length);
      if (search != null) {
        axios
          .get(
            this.route("secretary.filesglobal.daughters.search", {
              search: search,
            })
          )
          .then((response) => {
            // console.log("jj ", response.data);
            this.selectFour.options = response.data;
          });
      }
    },
    onSelectedPerfil(perfil) {
      this.selectFour.selectedPerfil = perfil;
      //   this.selectFour.options = perfil;
    },

    customLabel(option) {
      return `${option.name} ${option.lastname} (${option.fullnamecomm})`;
    },

    //

    onCyxSearchPerfilChange(search) {
      var string = search;
      var length = 60;
      search = string.substring(0, length);
      if (search != null) {
        axios
          .get(
            this.route("secretary.filesglobal.daughters.search", {
              search: search,
            })
          )
          .then((response) => {
            // console.log("jj ", response.data);
            this.selectCyx.options = response.data;
          });
      }
    },
    onCyxSelectedPerfil(perfil) {
      this.selectCyx.selectedPerfil = perfil;
      //   this.selectFour.options = perfil;
    },

    customCyxLabel(option) {
      return `${option.name} ${option.lastname} (${option.fullnamecomm})`;
    },
  },
};
</script>
