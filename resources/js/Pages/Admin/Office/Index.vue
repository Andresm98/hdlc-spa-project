<template>
  <div>
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
          Oficios Registrados del Sistema
        </h2>
        <div class="text-sm text-blue-700 mt-3 mb-6">
          Bienvenido Usuario: {{ $page.props.user.name }}
        </div>
      </template>
      <jet-form-section @submitted="createOffice">
        <template #title> Crear Oficios en el Sistema </template>
        <template #description>
          Los oficios permiten que se asigne a cada cambio que se asigna a una
          determinada hermana.
        </template>
        <template #form>
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Oficio" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
              {{ $page.props.errors.name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="createOfficeForm.office_name"
              autofocus
            />
            <jet-label for="description" value="Descripción" class="mt-2" />
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.office_observation"
            >
              {{ $page.props.errors.office_observation }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="createOfficeForm.office_observation"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>
        <template #actions>
          <jet-action-message
            :on="createOfficeForm.recentlySuccessful"
            class="mr-3"
          >
            Creado.
          </jet-action-message>

          <jet-button-success
            :class="{ 'opacity-25': createOfficeForm.processing }"
            :disabled="createOfficeForm.processing"
            class="ml-4 mt-4 btn btn-primary"
            >Crear</jet-button-success
          >
        </template>
      </jet-form-section>
      <div>
        <jet-section-border />

        <div class="mt-10 sm:mt-0">
          <jet-action-section>
            <template #title> Administrar Oficios del Sistema </template>

            <template #description>
              Puede eliminar o gestionar los oficios que se gestionan para los
              cambios de las hermanas de la comunidad, tenga en cuenta que si
              los oficios se encuentran asociados perfiles de hermanas no pueden
              ser eliminados.
            </template>
            <template #content>
              <div class="space-y-6">
                <div
                  class="flex items-center justify-between"
                  v-for="office in offices"
                  :key="office"
                >
                  <div>
                    {{ office.office_name }}
                  </div>

                  <div class="flex items-center">
                    <div
                      class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                      v-if="office.created_at"
                    >
                      Creado en {{ showFormatDate(office.created_at) }}
                    </div>
                    <button
                      class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                      @click="updateConfirmOffice(office)"
                    >
                      Actualizar
                    </button>

                    <button
                      class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                      @click="confirmOfficeDeletion(office)"
                    >
                      Eliminar
                    </button>
                  </div>
                </div>
              </div>
            </template>
          </jet-action-section>
        </div>
      </div>
      <jet-dialog-modal
        :show="displayingToken"
        @close="displayingToken = false"
      >
        <template #title
          ><h2 class="text-slate-600">Oficio Creado Correctamente</h2></template
        >
        <template #content>
          <div>
            Recuerde que el oficio que acaba de crear se encuentra disponible en
            la zona de Cambios pertenecientes a Hermanas de la comunidad.
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="displayingToken = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>

      <jet-dialog-modal
        :show="officeBeingUpdated"
        @close="officeBeingUpdated = null"
      >
        <template #title> Datos del Oficio</template>

        <template #content>
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Oficio" />
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.office_name"
            >
              {{ $page.props.errors.office_name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="updateOfficeForm.office_name"
              autofocus
            />

            <jet-label for="description" value="Descripción" class="mt-2" />
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.office_observation"
            >
              {{ $page.props.errors.office_observation }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="updateOfficeForm.office_observation"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>
        <template #footer>
          <jet-secondary-button @click="officeBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button
            class="ml-3"
            @click="updateOffice"
            :class="{ 'opacity-25': updateOfficeForm.processing }"
            :disabled="updateOfficeForm.processing"
          >
            Guardar
          </jet-button>
        </template>
      </jet-dialog-modal>

      <jet-confirmation-modal
        :show="officeBeingDeleted"
        @close="officeBeingDeleted = null"
      >
        <template #title> Eliminar el Oficio </template>
        <template #content>
          <h5>
            ¿Está seguro de que desea eliminar el oficio:
            <strong class="text-red-500">{{
              deleteOfficeForm.office_name
            }}</strong>
            ?
          </h5>
        </template>
        <template #footer>
          <jet-secondary-button @click="officeBeingDeleted = null">
            Cancelar
          </jet-secondary-button>
          <jet-danger-button
            class="ml-3"
            @click="deleteOffice"
            :class="{ 'opacity-25': deleteOfficeForm.processing }"
            :disabled="deleteOfficeForm.processing"
          >
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </app-layout>
  </div>
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

  props: ["offices"],

  data() {
    return {
      createOfficeForm: this.$inertia.form({
        office_name: "",
        office_observation: "",
      }),

      updateOfficeForm: this.$inertia.form({
        office_name: "",
        office_observation: "",
      }),

      deleteOfficeForm: this.$inertia.form({
        office_name: "",
      }),

      displayingToken: false,
      officeBeingUpdated: null,
      officeBeingDeleted: null,
    };
  },

  methods: {
    showFormatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    createOffice() {
      this.createOfficeForm.post(route("admin.office.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true;
          this.createOfficeForm.reset();
        },
      });
    },

    updateConfirmOffice(office) {
      this.updateOfficeForm.office_name = office.office_name;
      this.updateOfficeForm.office_observation = office.office_observation;
      this.officeBeingUpdated = office;
    },

    updateOffice() {
      this.updateOfficeForm.put(
        route("admin.office.update", this.officeBeingUpdated),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.officeBeingUpdated = null),
        }
      );
    },

    confirmOfficeDeletion(office) {
      this.deleteOfficeForm.office_name = office.office_name;

      this.officeBeingDeleted = office;
    },

    deleteOffice() {
      this.deleteOfficeForm.delete(
        route("admin.office.destroy", this.officeBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.officeBeingDeleted = null),
        }
      );
    },
  },
};
</script>
