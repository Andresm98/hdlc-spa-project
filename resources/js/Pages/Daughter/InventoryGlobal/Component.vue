<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Inventario
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenida Hermana: {{ $page.props.user.name }}
      </div>
    </template>
    <operation></operation>

    <section
      class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
    >
      <div
        class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
      >
        <div
          class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 md:bg-none md:row-start-2 md:p-0 lg:row-start-1"
        >
          <h1
            class="mt-1 text-lg font-semibold text-black sm:text-black md:text-2xl dark:sm:text-white"
          >
            {{ this.datac.comm_name }}
          </h1>
          <p
            class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            Información General del inventario de la comunidad u obra.
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 md:mb-6 md:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="w-full h-60 object-cover rounded-lg sm:h-52 sm:col-span-2 md:h-52 md:col-span-2 lg:col-span-full"
            loading="lazy"
          />
        </div>
        <dl
          class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-1 md:row-start-3 lg:row-start-2"
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
          La presente plantilla de información se relaciona al inventario y a
          todas las secciones de la comunidad u obra.
        </p>
      </div>
    </section>
    <div class="w-full shadow sm:rounded-md">
      <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-100 sm:px-6">
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
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.name"
                  >
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.description"
                >
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
            <h4
              class="text-lg font-medium text-center leading-6 text-gray-900 uppercase"
            >
              <strong>Secciones</strong>
            </h4>

            <div class="p-4 bg-white border-2 rounded-lg">
              <p>
                En la siguiente ficha usted puede visualizar cada una de las
                secciones asignadas al inventario general de :
                <strong> {{ this.formInventory.name }}</strong> . Tenga en
                cuenta que en cada una de las secciones puede agregar los
                artículos que usted crea conveniente, para ello y otras
                funcionalidades debe tener en cuenta las siguientes
                consideraciones:
              </p>
              <ul class="list-disc pl-5 pt-2">
                <li>
                  No puede eliminar las secciones que contengan artículos.
                </li>
                <li>
                  Si desea eliminar la sección, asegúrese que no contenga
                  artículos.
                </li>
                <li>Recuerde que cada una de las acciones es irreversible.</li>
                <li>
                  Puede obtener reportes generales y específicos de cada una de
                  las secciones.
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
                      >{{ section.name }}
                      <br />

                      <small>
                        Cantidad de artículos: {{ section.articles.length }}.
                      </small>
                    </label>

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
                    <label class="block text-sm font-medium text-gray-700">
                      Nombre:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.name"
                    >
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
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.description"
                  >
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
                    <label class="block text-sm font-medium text-gray-700">
                      Nombre:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.name"
                    >
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
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.description"
                  >
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
  </app-layout>
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
import AppLayout from "@/Layouts/AppLayout.vue";
import Operation from "@/Components/Daughter/Operation";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import { mapState, mapGetters, mapActions } from "vuex";
import JetInput from "@/Jetstream/Input.vue";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import JetInputError from "@/Jetstream/InputError";
import Alert from "@/Components/Alert";
import moment from "moment";
import { ref } from "vue";

export default {
  props: {
    errors: null,
    community: Object,
    datac: Object,
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
    AppLayout,
    Link,
    Alert,
    Operation,
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
    inventory() {
      axios
        .get(
          this.route("daughter.communities.inventory.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          this.updateInventory(res.data);
          this.formInventory = this.getInventory();
        });
      const headers = { "Content-Type": "application/json" };
      fetch("https://api.npms.io/v2/search?q=vue", { headers })
        .then((response) => response.json())
        .then((data) => {});
      fetch(
        this.route("daughter.communities.inventory.index", {
          community_id: this.community.id,
        })
      )
        .then(async (response) => {
          const data = await response.json();
          if (!response.ok) {
            const error = (data && data.message) || response.statusText;
            return Promise.reject(error);
          }
        })
        .catch((error) => {
          this.errorMessage = error;
        });
      this.section;
    },
    section() {
      axios
        .get(
          this.route("daughter.communities.section.all", {
            inventory_id: this.community.id,
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
        this.route("daughter.communities.inventory.update", {
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
          "daughter.communities.articles.index",
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
    updateTable() {
      axios
        .get(
          this.route("daughter.communities.section.all", {
            inventory_id: this.formInventory.id,
          })
        )
        .then((res) => {
          this.updateAllSection(res.data);
          this.allSection = this.getAllSection();
        });
    },
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
        this.route("daughter.communities.section.store", {
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
    confirmationSectionUpdate(section) {
      this.updateSectionForm.name = section.name;
      this.updateSectionForm.description = section.description;
      this.sectionBeingUpdated = section;
    },
    updateSection() {
      this.updateSectionForm.put(
        this.route("daughter.communities.section.update", {
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
    confirmationSectionDelete(section) {
      this.deleteSectionForm.name = section.name;
      this.sectionBeingDeleted = section;
    },
    deleteSection() {
      this.deleteSectionForm.delete(
        this.route("daughter.communities.section.delete", {
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
.tab-content {
  max-height: 0;
  -webkit-transition: max-height 0.35s;
  -o-transition: max-height 0.35s;
  transition: max-height 0.35s;
}
.tab input:checked ~ .tab-content {
  max-height: 100vh;
}
.tab input:checked + label {
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
