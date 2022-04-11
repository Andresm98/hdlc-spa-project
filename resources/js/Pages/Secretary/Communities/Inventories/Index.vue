<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:px-6">
      <h6
        class="mt-2 mb-2 text-lg font-medium text-center leading-6 text-gray-900 uppercase"
      >
        Plantilla del Inventario de la Comunidad
      </h6>

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

      <form @submit.prevent="submit" class="my-4">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Inventario:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                  {{ $page.props.errors.name }}
                </p>
                <small>Formato: Ingresar el nombre del inventario.</small>
                <input
                  type="text"
                  minLength="5"
                  maxlength="50"
                  placeholder="Ingresar nombre del inventario"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="formInventory.name"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                {{ $page.props.errors.description }}
              </p>
              <small>Formato: Ingresar la descripción del inventario.</small>
              <div class="bg-white">
                <div v-if="formInventory.description != null">
                  <quill-editor
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="formInventory.description"
                    placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>

          <jet-button type="submit">Actualizar</jet-button>
        </div>
      </form>

      <hr class="w-full border-b-1 border-gray-400 hover:border-gray-400" />
      <!-- Data Table  -->

      <div class="my-4">
        <div class="w-full md:w-5/5 mx-auto">
          <h4 class="text-lg font-medium text-center leading-6 text-gray-900 uppercase">
            <strong>Secciones</strong>
          </h4>

          <div class="p-4 bg-white border-2 rounded-lg">
            <p>
              En la siguiente ficha usted puede visualizar cada una de las secciones
              asignadas al inventario general de :
              <strong> {{ this.formInventory.name }}</strong> . Tenga en cuenta que en
              cada una de las secciones puede agregar los artículos que usted crea
              conveniente, para ello y otras funcionalidades debe tener en cuenta las
              siguientes consideraciones:
            </p>
            <ul class="list-disc pl-5 pt-2">
              <li>No puede eliminar las secciones que contengan artículos.</li>
              <li>Si desea eliminar la sección, asegúrese que no contenga artículos.</li>
              <li>Recuerde que cada una de las acciones es irreversible.</li>
              <li>
                Puede obtener reportes generales y específicos de cada una de las
                secciones.
              </li>
            </ul>
            <div class="content-center mt-2">
              <jet-button-success
                @click="confirmationSectionCreate()"
                class="block mx-2 p-5 leading-normal"
                >¿Desea crear una nueva sección?</jet-button-success
              >
            </div>
          </div>

          <div v-if="this.allSection.length > 0">
            <div class="shadow-md bg-white mt-4">
              <div v-for="section in this.allSection" :key="section.id">
                <div class="tab w-full overflow-hidden border-t">
                  <input
                    class="absolute opacity-0"
                    :id="section.id"
                    type="radio"
                    name="tabs2"
                  />
                  <label
                    class="block p-5 leading-normal cursor-pointer"
                    :for="section.id"
                    >{{ section.name }}</label
                  >
                  <div
                    class="w-full tab-content overflow-hidden border-l-2 bg-gray-100 border-blue-500 leading-normal"
                  >
                    <div class="p-5 overflow-y-auto h-60">
                      <section>
                        <jet-button
                          @click="confirmationSectionUpdate(section)"
                          class="block p-5 leading-normal"
                          >Editar</jet-button
                        >
                        <jet-danger-button
                          @click="confirmationSectionDelete(section)"
                          class="block mx-2 p-5 leading-normal"
                          >Eliminar</jet-danger-button
                        >

                        <jet-button-success
                          @click="accessArticles(section)"
                          class="block mx-2 p-5 leading-normal"
                        >
                          Acceder
                        </jet-button-success>
                      </section>
                      <br />

                      <quill-editor
                        contentType="html"
                        theme="snow"
                        toolbar="minimal"
                        v-model:content="section.description"
                        :readOnly="true"
                      ></quill-editor>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Post Data Form -->
      <jet-dialog-modal
        :max-width="'input-md'"
        :show="sectionBeingCreated"
        @close="sectionBeingCreated == null"
      >
        <template #title> Datos de la nueva sección</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
                  <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                    {{ $page.props.errors.name }}
                  </p>
                  <small>Formato: Ingresar el nombre de la sección.</small>
                  <input
                    type="text"
                    minLength="5"
                    maxlength="50"
                    placeholder="Ingresar nombre de la sección"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="createSectionForm.name"
                    required
                  />
                </div>
              </div>
            </div>
            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Descripción:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                  {{ $page.props.errors.description }}
                </p>
                <small
                  >Formato: Ingresar la descripción de la sección, max 3000
                  caracteres.</small
                >
                <div class="bg-white">
                  <quill-editor
                    ref="qlcreateditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="createSectionForm.description"
                    placeholder="Ingresar los datos solicitados..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="this.sectionBeingCreated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="createSection">
            Crear
          </jet-button-success>
        </template>
      </jet-dialog-modal>

      <!-- Delete  Data Form-->
      <jet-confirmation-modal
        :show="sectionBeingDeleted"
        @close="sectionBeingDeleted == null"
      >
        <template #title> Eliminar la Sección</template>

        <template #content>
          ¿Está seguro de que desea eliminar la sección:
          {{ this.deleteSectionForm.name }}?
        </template>

        <template #footer>
          <jet-secondary-button @click="sectionBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteSection">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <!-- Put Data Form -->
      <jet-dialog-modal
        :max-width="'input-md'"
        :show="sectionBeingUpdated"
        @close="sectionBeingUpdated == null"
      >
        <template #title> Datos de la Sección</template>

        <template #content>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <div class="">
                  <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
                  <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                    {{ $page.props.errors.name }}
                  </p>
                  <small>Formato: Ingresar el nombre de la sección.</small>
                  <input
                    type="text"
                    minLength="10"
                    maxlength="100"
                    placeholder="Ingresar nombre de la sección"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="updateSectionForm.name"
                    required
                  />
                </div>
              </div>
            </div>
            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  Descripción:
                </label>
                <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
                  {{ $page.props.errors.description }}
                </p>
                <small
                  >Formato: Ingresar la descripción de la sección, max 3000
                  caracteres.</small
                >
                <div class="bg-white">
                  <quill-editor
                    ref="qlcreateditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    v-model:content="updateSectionForm.description"
                    placeholder="Ingresar los datos solicitados..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="this.sectionBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateSection">
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
import { Link } from "@inertiajs/inertia-vue3";

import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";
import { mapState, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";
import Alert from "@/Components/Alert";

export default {
  props: {
    errors: null,
  },
  mounted() {
    this.inventory;
  },
  updated() {
    this.section;
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
    Link,
    Alert,
  },
  watch: {
    "createSectionForm.description": function () {
      var limit = 4000;
      const quill = this.$refs.qlcreateditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
    "updateSectionForm.description": function () {
      var limit = 4000;
      const quill = this.$refs.qlcreateditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
    "formInventory.description": function () {
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
      formInventory: this.$inertia.form({
        name: null,
        description: null,
        community_id: null,
      }),
      sectionBeingCreated: null,
      createSectionForm: null,
      sectionBeingDeleted: null,
      deleteSectionForm: this.$inertia.form({
        name: null,
        description: null,
        community_id: null,
      }),
      sectionBeingUpdated: null,
      updateSectionForm: this.$inertia.form({
        name: null,
        description: null,
        community_id: null,
      }),
      allSection: {
        default: Array,
      },
    };
  },
  computed: {
    ...mapState("community", ["community"]),
    ...mapState("inventory", ["inventory"]),

    inventory() {
      axios
        .get(
          this.route("secretary.communities.inventory.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateInventory(res.data);
          this.formInventory = this.getInventory();
        });

      //
      //
      //

      const headers = { "Content-Type": "application/json" };
      fetch("https://api.npms.io/v2/search?q=vue", { headers })
        .then((response) => response.json())
        .then((data) => {
          console.log("Send data: ");
          console.log("Print: ", data.results);
        });

      //
      //
      //

      fetch(
        this.route("secretary.communities.inventory.index", {
          community_id: this.community.id,
        })
      )
        .then(async (response) => {
          const data = await response.json();

          // check for error response
          if (!response.ok) {
            // get error message from body or default to response statusText
            const error = (data && data.message) || response.statusText;
            return Promise.reject(error);
          }

          console.log("Send data 2: ");
          console.log("Print 2: ", data);
        })
        .catch((error) => {
          this.errorMessage = error;
          console.error("There was an error!", error);
        });

      //
    },

    section() {
      axios
        .get(
          this.route("secretary.communities.section.all", {
            inventory_id: this.formInventory.id,
          })
        )
        .then((res) => {
          this.updateAllSection(res.data);
          this.allSection = this.getAllSection();
        });
    },
  },
  methods: {
    ...mapActions("inventory", ["updateInventory"]),
    ...mapGetters("inventory", ["getInventory"]),
    ...mapActions("inventory", ["updateAllSection"]),
    ...mapGetters("inventory", ["getAllSection"]),
    submit() {
      Inertia.put(
        this.route("secretary.communities.inventory.update", {
          inventory_id: this.formInventory.id,
        }),
        this.formInventory,
        {
          preserveScroll: true,
          preserveState: true,
        }
      );
    },
    accessArticles(section) {
      Inertia.get(
        this.route(
          "secretary.communities.articles.index",
          {
            section_slug: section.slug,
          },
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {},
          }
        )
      );
    },
    // Update Data Table

    updateTable() {
      axios
        .get(
          this.route("secretary.communities.section.all", {
            inventory_id: this.formInventory.id,
          })
        )
        .then((res) => {
          this.updateAllSection(res.data);
          this.allSection = this.getAllSection();
        });
    },
    // Create Data
    confirmationSectionCreate() {
      this.createSectionForm = this.$inertia.form({
        name: null,
        description: null,
        community_id: null,
      });
      this.sectionBeingCreated = this.createSectionForm;
    },

    createSection() {
      this.createSectionForm.post(
        this.route("secretary.communities.section.store", {
          community_id: this.community.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.sectionBeingCreated = null;
            setTimeout(() => {
              this.updateTable();
            }, 2);
          },
        }
      );
    },

    // Put Data
    confirmationSectionUpdate(section) {
      this.updateSectionForm.name = section.name;
      this.updateSectionForm.description = section.description;
      this.sectionBeingUpdated = section;
    },

    updateSection() {
      this.updateSectionForm.put(
        this.route("secretary.communities.section.update", {
          inventory_id: this.formInventory.id,
          section_id: this.sectionBeingUpdated.id,
          community_id: this.community.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.sectionBeingUpdated = null;
            setTimeout(() => {
              this.updateTable();
            }, 2);
          },
        }
      );
    },
    // Delete Data

    confirmationSectionDelete(section) {
      this.deleteSectionForm.name = section.name;
      this.sectionBeingDeleted = section;
    },

    deleteSection() {
      this.deleteSectionForm.delete(
        this.route("secretary.communities.section.delete", {
          inventory_id: this.formInventory.id,
          section_id: this.sectionBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.sectionBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 2)
          ),
        }
      );
    },
  },
};

/* Optional Javascript to close the radio button version by clicking it again */
var myRadios = document.getElementsByName("tabs2");
var setCheck;
var x = 0;
for (x = 0; x < myRadios.length; x++) {
  myRadios[x].onclick = function () {
    if (setCheck != this) {
      setCheck = this;
    } else {
      this.checked = false;
      setCheck = null;
    }
  };
}
</script>

<style>
/* Tab content - closed */
.tab-content {
  max-height: 0;
  -webkit-transition: max-height 0.35s;
  -o-transition: max-height 0.35s;
  transition: max-height 0.35s;
}
/* :checked - resize to full height */
.tab input:checked ~ .tab-content {
  max-height: 100vh;
}
/* Label formatting when open */
.tab input:checked + label {
  /*@apply text-xl p-5 border-l-2 border-indigo-500 bg-gray-100 text-indigo*/
  font-size: 1.25rem; /*.text-xl*/
  padding: 1.25rem; /*.p-5*/
  border-left-width: 2px; /*.border-l-2*/
  border-color: #5586cf; /*.border-indigo*/
  background-color: #f8fafc; /*.bg-gray-100 */
  color: #5189d1; /*.text-indigo*/
}
/* Icon */
.tab label::after {
  float: right;
  right: 0;
  top: 0;
  display: block;
  width: 1.5em;
  height: 1.5em;
  line-height: 1.5;
  font-size: 1.25rem;
  text-align: center;
  -webkit-transition: all 0.35s;
  -o-transition: all 0.35s;
  transition: all 0.35s;
}
/* Icon formatting - closed */
.tab input[type="checkbox"] + label::after {
  content: "+";
  font-weight: bold; /*.font-bold*/
  border-width: 1px; /*.border*/
  border-radius: 9999px; /*.rounded-full */
  border-color: #b8c2cc; /*.border-grey*/
}
.tab input[type="radio"] + label::after {
  content: "\25BE";
  font-weight: bold; /*.font-bold*/
  border-width: 1px; /*.border*/
  border-radius: 9999px; /*.rounded-full */
  border-color: #b8c2cc; /*.border-grey*/
}
/* Icon formatting - open */
.tab input[type="checkbox"]:checked + label::after {
  transform: rotate(315deg);
  background-color: #5577b6; /*.bg-indigo*/
  color: #f8fafc; /*.text-grey-lightest*/
}
.tab input[type="radio"]:checked + label::after {
  transform: rotateX(180deg);
  background-color: #5586cf; /*.bg-indigo*/
  color: #f8fafc; /*.text-grey-lightest*/
}
</style>
