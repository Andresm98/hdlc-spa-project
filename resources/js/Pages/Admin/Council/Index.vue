<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Niveles de Nombramientos Registrados del Sistema
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <!-- Generate Permission Token -->

    <jet-action-section>
      <template #title> Crear Niveles de Nombramientos en el Sistema </template>

      <template #description>
        Los niveles de nombramiento permiten que se asigne categorías para realizar
        nombramientos a nivel de hermana.
      </template>

      <template #content>
        <div class="mb-2">
          <jet-button-success @click="confirmationLevelCreate()"
            >Crear Niveles</jet-button-success
          >
        </div>
        <hr class="pb-3" />
        <!-- Token Name -->
        <div class="space-y-6 mt-2">
          <div class="space-y-6">
            <div
              class="flex items-center justify-between"
              v-for="appointmentlevel in appointmentlevels"
              :key="appointmentlevel"
            >
              <span
                class="hover:cursor-pointer px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                @click="loadLevelCategories(appointmentlevel)"
              >
                {{ appointmentlevel.name }}
              </span>

              <div class="flex items-center">
                <div
                  class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                  v-if="appointmentlevel.created_at"
                ></div>

                <button
                  class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                  @click="updateConfirmLevel(appointmentlevel)"
                >
                  Actualizar
                </button>

                <button
                  class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                  @click="confirmLevelDeletion(appointmentlevel)"
                >
                  Eliminar
                </button>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #actions> </template>
    </jet-action-section>

    <!-- Form Category Levels -->

    <div v-show="listLevelCategories != null">
      <jet-section-border />

      <!-- Manage API Tokens -->
      <div class="mt-10 sm:mt-0">
        <jet-action-section>
          <template #title> Administrar las Categorías </template>

          <template #description>
            Puede eliminar o gestionar las categorías del nombramiento que decida
            modificar
          </template>
          <!-- API Token List -->
          <template #content>
            <div class="mb-2">
              <jet-button-success @click="confirmationCategoryCreate()"
                >Crear Categorías</jet-button-success
              >
            </div>
            <small v-if="this.levelCategoryGlobal != null"
              >Nota: En el bloque que se muestra se encuentran todas las categorías que
              pertenecen al nivel de nombramiento que seleccionó, ({{
                this.levelCategoryGlobal.name
              }}).</small
            >
            <hr />
            <div class="space-y-6 mt-2">
              <div class="space-y-6">
                <div
                  class="flex items-center justify-between"
                  v-for="category in listLevelCategories"
                  :key="category"
                >
                  <span
                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800"
                  >
                    {{ category.name }}
                  </span>

                  <div class="flex items-center">
                    <div
                      class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                      v-if="category.created_at"
                    ></div>
                    <button
                      class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                      @click="updateConfirmCategory(category)"
                    >
                      Actualizar
                    </button>

                    <button
                      class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                      @click="confirmCategoryDeletion(category)"
                    >
                      Eliminar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </jet-action-section>
      </div>
    </div>
  </app-layout>

  <!--
    Head Data
 -->

  <!-- Post Data Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="levelBeingCreated"
    @close="levelBeingCreated == null"
  >
    <template #title> Datos del Nuevo Nivel</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <small>Formato: Ingresar el nombre del nivel.</small>
              <input
                type="text"
                minLength="5"
                maxlength="50"
                placeholder="Ingresar nombre del nivel"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createLevelForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block text-sm font-medium text-gray-700"> Descripción: </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <small
              >Formato: Ingresar la descripción del nivel, max 3000 caracteres.</small
            >
            <div class="bg-white">
              <quill-editor
                ref="qlcreateditor1"
                contentType="html"
                theme="snow"
                :toolbar="toolbarOptions"
                v-model:content="createLevelForm.description"
                placeholder="Ingresar los datos solicitados..."
              ></quill-editor>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.levelBeingCreated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button-success class="ml-3" @click="createLevel"> Crear </jet-button-success>
    </template>
  </jet-dialog-modal>

  <!-- Put Data Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="levelBeingUpdated"
    @close="levelBeingUpdated == null"
  >
    <template #title> Actualizar datos del Nivel</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <small>Formato: Ingresar el nombre de la categoría.</small>
              <input
                type="text"
                minLength="5"
                maxlength="50"
                placeholder="Ingresar nombre de la categoría"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateLevelForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block text-sm font-medium text-gray-700"> Descripción: </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <small
              >Formato: Ingresar la descripción de la sección, max 3000 caracteres.</small
            >
            <div class="bg-white">
              <quill-editor
                ref="qlcreateditor1"
                contentType="html"
                theme="snow"
                :toolbar="toolbarOptions"
                v-model:content="updateLevelForm.description"
                placeholder="Ingresar los datos solicitados..."
              ></quill-editor>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.levelBeingUpdated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button
        class="ml-3"
        @click="updateLevel"
        :class="{ 'opacity-25': levelBeingUpdated.processing }"
        :disabled="levelBeingUpdated.processing"
      >
        Actualizar
      </jet-button>
    </template>
  </jet-dialog-modal>

  <!-- Delete Level Confirmation Modal -->
  <jet-confirmation-modal :show="levelBeingDeleted" @close="levelBeingDeleted = null">
    <template #title> Eliminar el Nivel </template>

    <template #content>
      <h5>
        ¿Está seguro de que desea eliminar el nivel:
        <strong class="text-red-500">{{ deleteLevelForm.name }}</strong>
        ?
      </h5>
    </template>

    <template #footer>
      <jet-secondary-button @click="levelBeingDeleted = null">
        Cancelar
      </jet-secondary-button>

      <jet-danger-button
        class="ml-3"
        @click="deleteLevel"
        :class="{ 'opacity-25': deleteLevelForm.processing }"
        :disabled="deleteLevelForm.processing"
      >
        Eliminar
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>

  <!--
    End Head Data
 -->

  <!--
    Detail Data
 -->

  <!-- Post Data Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="categoryBeingCreated"
    @close="categoryBeingCreated == null"
  >
    <template #title> Datos de la Categoría</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <small>Formato: Ingresar el nombre de la categoría.</small>
              <input
                type="text"
                minLength="5"
                maxlength="50"
                placeholder="Ingresar nombre de la categoría"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createCategoryForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block text-sm font-medium text-gray-700"> Descripción: </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <small
              >Formato: Ingresar la descripción de la categoría, max 3000
              caracteres.</small
            >
            <div class="bg-white">
              <quill-editor
                ref="qlcreateditor1"
                contentType="html"
                theme="snow"
                :toolbar="toolbarOptions"
                v-model:content="createCategoryForm.description"
                placeholder="Ingresar los datos solicitados..."
              ></quill-editor>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.categoryBeingCreated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button-success class="ml-3" @click="createCategory">
        Crear
      </jet-button-success>
    </template>
  </jet-dialog-modal>

  <!-- Put Data Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="categoryBeingUpdated"
    @close="categoryBeingUpdated == null"
  >
    <template #title> Actualizar datos de la categoría</template>

    <template #content>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <div class="">
              <label class="block text-sm font-medium text-gray-700"> Nombre: </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
                {{ $page.props.errors.name }}
              </p>
              <small>Formato: Ingresar el nombre de la categoría.</small>
              <input
                type="text"
                minLength="5"
                maxlength="50"
                placeholder="Ingresar nombre de la categoría"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateCategoryForm.name"
                required
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block text-sm font-medium text-gray-700"> Descripción: </label>
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <small
              >Formato: Ingresar la descripción de la sección, max 3000 caracteres.</small
            >
            <div class="bg-white">
              <quill-editor
                ref="qlcreateditor1"
                contentType="html"
                theme="snow"
                :toolbar="toolbarOptions"
                v-model:content="updateCategoryForm.description"
                placeholder="Ingresar los datos solicitados..."
              ></quill-editor>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.categoryBeingUpdated = null">
        Cancelar
      </jet-secondary-button>

      <jet-button
        class="ml-3"
        @click="updateCategory"
        :class="{ 'opacity-25': categoryBeingUpdated.processing }"
        :disabled="categoryBeingUpdated.processing"
      >
        Actualizar
      </jet-button>
    </template>
  </jet-dialog-modal>

  <!-- Delete Category Confirmation Modal -->
  <jet-confirmation-modal
    :show="categoryBeingDeleted"
    @close="categoryBeingDeleted = null"
  >
    <template #title> Eliminar la categoría </template>

    <template #content>
      <h5>
        ¿Está seguro de que desea eliminar la categoría:
        <strong class="text-red-500">{{ deleteCategoryForm.name }}</strong>
        ?
      </h5>
    </template>

    <template #footer>
      <jet-secondary-button @click="categoryBeingDeleted = null">
        Cancelar
      </jet-secondary-button>

      <jet-danger-button
        class="ml-3"
        @click="deleteCategory"
        :class="{ 'opacity-25': deleteCategoryForm.processing }"
        :disabled="deleteCategoryForm.processing"
      >
        Eliminar
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>

  <!--
    End Detail Data
 -->
</template>

<script>
import { defineComponent } from "vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import moment from "moment";
export default {
  props: ["appointmentlevels"],
  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetCheckbox,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetButtonSuccess,
    JetSectionBorder,
    AppLayout,
    moment,
  },
  layout: PrincipalLayout,
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
      createLevelForm: null,
      levelBeingCreated: null,
      updateLevelForm: this.$inertia.form({
        name: "",
        description: "",
      }),
      levelBeingUpdated: null,
      deleteLevelForm: this.$inertia.form({
        name: "",
      }),
      levelBeingDeleted: null,
      //
      listLevelCategories: null,
      createCateroryForm: null,
      categoryBeingCreated: null,
      updateCategoryForm: this.$inertia.form({
        name: "",
        description: "",
      }),
      categoryBeingUpdated: null,
      deleteCategoryForm: this.$inertia.form({
        name: "",
      }),
      categoryBeingDeleted: null,
      //
      levelCategoryGlobal: null,
    };
  },

  watch: {
    "createLevelForm.description": function () {
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
    "updateLevelForm.description": function () {
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
  },
  methods: {
    showFormatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    confirmationLevelCreate() {
      this.createLevelForm = this.$inertia.form({
        name: null,
        description: null,
      });
      this.levelBeingCreated = this.createLevelForm;
    },
    createLevel() {
      this.createLevelForm.post(route("admin.appointmentlevel.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.levelBeingCreated = null;
          this.createLevelForm.reset();
          if (this.levelCategoryGlobal != null) {
            this.loadLevelCategories(this.levelCategoryGlobal);
          }
        },
      });
    },

    updateConfirmLevel(level) {
      this.updateLevelForm.name = level.name;
      this.updateLevelForm.description = level.description;

      this.levelBeingUpdated = level;
    },

    updateLevel() {
      this.updateLevelForm.put(
        route("admin.appointmentlevel.update", this.levelBeingUpdated),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.levelBeingUpdated = null;
            if (this.levelCategoryGlobal != null) {
              this.loadLevelCategories(this.levelCategoryGlobal);
            }
          },
        }
      );
    },

    confirmLevelDeletion(level) {
      this.deleteLevelForm.name = level.name;

      this.levelBeingDeleted = level;
    },
    deleteLevel() {
      this.deleteLevelForm.delete(
        route("admin.appointmentlevel.destroy", this.levelBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.levelBeingDeleted = null;
            if (this.levelCategoryGlobal != null) {
              this.loadLevelCategories(this.levelCategoryGlobal);
            }
          },
        }
      );
    },

    //

    loadLevelCategories(levelCategory) {
      this.levelCategoryGlobal = levelCategory;
      //   console.log("Variable Global: ", this.levelCategoryGlobal);
      const headers = {
        "Content-Type": "application/json",
        Accept: "application/json",
      };
      fetch(route("admin.appointmentlevelcategory.index", { id: levelCategory.id }), {
        headers,
      })
        .then(async (response) => {
          const data = await response.json();

          // check for error response
          if (!response.ok) {
            // get error message from body or default to response statusText
            const error = (data && data.message) || response.statusText;
            return Promise.reject(error);
          }

          this.listLevelCategories = data;
        })
        .catch((error) => {
          this.errorMessage = error;
          console.error("Error!", error);
        });
    },

    confirmationCategoryCreate() {
      this.createCategoryForm = this.$inertia.form({
        name: null,
        description: null,
      });
      this.categoryBeingCreated = this.createCategoryForm;
    },
    createCategory() {
      this.createCategoryForm.post(
        route("admin.appointmentlevelcategory.store", {
          id: this.levelCategoryGlobal.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.loadLevelCategories(this.levelCategoryGlobal);
            this.categoryBeingCreated = null;
            this.createCategoryForm.reset();
          },
        }
      );
    },

    updateConfirmCategory(category) {
      this.updateCategoryForm.name = category.name;
      this.updateCategoryForm.description = category.description;

      this.categoryBeingUpdated = category;
    },

    updateCategory() {
      this.updateCategoryForm.put(
        route("admin.appointmentlevelcategory.update", this.categoryBeingUpdated),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.categoryBeingUpdated = null;
            this.loadLevelCategories(this.levelCategoryGlobal);
          },
        }
      );
    },

    confirmCategoryDeletion(category) {
      this.deleteCategoryForm.name = category.name;
      this.categoryBeingDeleted = category;
    },

    deleteCategory() {
      this.deleteCategoryForm.delete(
        route("admin.appointmentlevelcategory.destroy", this.categoryBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.categoryBeingDeleted = null;
            this.loadLevelCategories(this.levelCategoryGlobal);
          },
        }
      );
    },
  },
};
</script>
