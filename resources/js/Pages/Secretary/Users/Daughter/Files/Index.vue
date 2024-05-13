<template>
  <div class="w-full shadow sm:rounded-md py-5">
    <h6
      class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
    >
      Espacio de archivos para perfil de hermanas
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

    <form @submit.prevent="submit" class="p-2">
      <div class="px-4 py-5 bg-white sm:p-6">
        <div>
          <small
            >En el presente apartado usted puede almacenar archivos privados de cada
            perfil de hermana, por ejemplo puede guardar PDFs que contengan copias de
            cédulas de identidad, pasaportes y otros documentos que son necesarios para
            los trámites que requiere realizar la comunidad.
            <br />
            Para hacer uso del almacenamiento de archivos debe tener en cuenta las
            siguientes indicaciones:
            <br />
            <ul>
              <li>1. Los archivos no pueden exceder 5MB.</li>
              <li>
                2. Los archivos que usted puede adjuntar serán del formato que usted
                requiera (.mp3, mp4, PDF, DOC y otros).
              </li>
              <li>
                3. Tenga en cuenta que si sube un archivo que contenga un nombre de un
                fichero existente en los registro de la base de datos, el antiguo fichero
                será reemplazado.
              </li>
              <li>
                5. Puede descargar, visualizar y eliminar el archivo (eliminar un fichero
                es una acción irreversible por lo que debe verificar de manera adecuada
                cual fichero ya no necesita).
              </li>
            </ul>
          </small>
          <br />
          <label class="block text-sm font-medium text-gray-700"> Subir Ficheros: </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.filedata">
            {{ $page.props.errors.filedata }}
          </p>
          <div
            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-600"
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
                  class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                >
                  <input
                    id="file-upload"
                    name="file-upload"
                    type="file"
                    class="block w-full text-sm text-blue-500 file:mr-4 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-500 file:text-white hover:file:bg-emerald-600 mb-4"
                    @input="form.filedata = $event.target.files[0]"
                    @change="onFileChange"
                  />
                </label>
                <br />
                <br />
                <p class="">Clic en el botón verde para agregar archivos.</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOCX, PNG, JPG, GIF max 5MB.</p>

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
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <jet-button-success type="submit" class="ml-4 mt-4 btn btn-primary"
          >Guardar Archivo</jet-button-success
        >
      </div>
    </form>
    <div class="px-4 py-5 m-4 bg-gray-200 sm:p-6 rounded-lg">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4 overflow-y-auto h-80">
        <div v-if="this.allFiles != null" class="px-5">
          <small> Número de archivos: {{ this.allFiles.length }}. </small>
          <br />
          <small v-if="this.allFiles.length == 10" class="text-red-600">
            No dispone de espacio para almacenar más archivos, en su carpeta personal sólo
            puede almacenar un máximo de 10 archivos.
          </small>
        </div>
        <div
          v-if="this.allFiles"
          class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
        >
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-100">
              <tr>
                <th
                  scope="col"
                  class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                >
                  Nombre
                </th>
                <th
                  scope="col"
                  class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                >
                  Tamaño - Extensión
                </th>
                <th
                  scope="col"
                  class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                >
                  Fecha Creación - Fecha Actualización
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
              <tr v-for="file in this.allFiles" :key="file">
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ file.external_filename.substring(0, 20) }}...
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  >
                    {{ this.bytesToSize(file.filesize) }} -
                    {{ this.extensionFile(file.external_filename) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                  >
                    {{ this.formatShowDate(file.created_at) }}
                  </span>
                  -
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                  >
                    {{ this.formatShowDate(file.updated_at) }}
                  </span>
                </td>
                <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
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
                      <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
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
        <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
          <p class="text-center text-lg">Por el momento no existen registros.</p>
        </div>
      </div>
    </div>
  </div>

  <jet-confirmation-modal :show="fileBeingDeleted" @close="fileBeingDeleted == null">
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
              class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
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

      <jet-danger-button class="ml-3" @click="deleteFile"> Eliminar </jet-danger-button>
    </template>
  </jet-confirmation-modal>

  <jet-dialog-modal
    :max-width="'input-md'"
    :show="fileBeingUpdated"
    @close="fileBeingUpdated == null"
  >
    <template #title> Vista Previa del fichero</template>
    <template #content>
      <label class="block text-sm font-medium text-gray-700" htmlfor="grid-password">
        Nombre del Archivo:
      </label>
      <input
        type="text"
        minLength="10"
        maxlength="40"
        placeholder="Ingresar "
        class="border-0 px-3 my-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
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
      <jet-secondary-button @click="clearUpdateData()"> Cerrar </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import JetInputError from "@/Jetstream/InputError";
import { Inertia } from "@inertiajs/inertia";
import JetButton from "@/Jetstream/Button";
import Alert from "@/Components/Alert";
import { mapState } from "vuex";
import moment from "moment";

export default {
  components: {
    JetButtonSuccess,
    JetButton,
    JetDangerButton,
    JetInputError,
    JetSecondaryButton,
    JetConfirmationModal,
    JetDialogModal,
    Alert,
    moment,
  },

  props: {
    errors: null,
    image: String,
  },

  data() {
    return {
      allFiles: null,
      form: useForm({
        filedata: null,
      }),
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
    };
  },

  mounted() {
    axios
      .get(
        this.route("secretary.daughter-profile.files.index", {
          user_id: this.profile.user_id,
        })
      )
      .then((response) => {
        this.allFiles = response.data;
      });
  },

  computed: {
    ...mapState("daughter", ["profile"]),
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
          filename.substring(filename.lastIndexOf(".") + 1, filename.length) || filename
        );
      }
      return "";
    },

    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "";
    },

    onFileChange(e) {
      const filedata = e.target.files[0];
      this.url = URL.createObjectURL(filedata);
    },

    onFileChangeUpdate(e) {
      const filedata = e.target.files[0];
      this.url = URL.createObjectURL(filedata);
    },

    submit() {
      this.form.post(
        route(`secretary.daughter-profile.files.store`, {
          user_id: this.profile.user_id,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            axios
              .get(
                this.route("secretary.daughter-profile.files.index", {
                  user_id: this.profile.user_id,
                })
              )
              .then((response) => {
                this.allFiles = response.data;
              });
          },
        }
      );
    },

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
            (this.fileBeingDeleted = null),
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
            }, 1)
          ),
        }
      );
    },
  },
};
</script>
