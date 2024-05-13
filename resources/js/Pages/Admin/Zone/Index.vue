<template>
  <div>
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
          Zonas del Sistema
        </h2>
        <div class="text-sm text-blue-700 mt-3 mb-6">
          Bienvenido Usuario: {{ $page.props.user.name }}
        </div>
      </template>
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

      <div>
        <div class="mb-10 sm:mt-0">
          <jet-action-section>
            <template #title> Administrar Zonas del Sistema </template>

            <template #description>
              Puede eliminar o gestionar las zonas aquí descritas, tenga en
              cuenta deberá seleccionar sólo una hermana que será la encargada
              de visitar las comunidades u obras descritas en cada zona.
            </template>
            <template #content>
              <div class="space-y-6">
                <div
                  class="flex items-center justify-between"
                  v-for="zon in zone"
                  :key="zon"
                >
                  <div>
                    {{ zon.name }}
                  </div>

                  <div class="flex items-center">
                    <div
                      class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                      v-if="zon.created_at"
                    >
                      Creada en {{ showFormatDate(zon.created_at) }}
                    </div>
                    <button
                      class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                      @click="updateConfirmPastoral(zon)"
                    >
                      Actualizar
                    </button>

                    <button
                      class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                      @click="confirmPastoralDeletion(zon)"
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
      <jet-section-border />

      <jet-form-section @submitted="createPastoral">
        <template #title> Crear Zonas en el Sistema </template>

        <template #description>
          Las zonas son asignadas a cada comunidad u obra, dicha zona será
          monitoreada por una hermana específica en la compañía.
        </template>

        <template #form>
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Zona" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
              {{ $page.props.errors.name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="createZoneForm.name"
              autofocus
            />

            <jet-label for="description" value="Descripción" class="mt-2" />
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.description"
            >
              {{ $page.props.errors.description }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="createZoneForm.description"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>

        <template #actions>
          <jet-action-message
            :on="createZoneForm.recentlySuccessful"
            class="mr-3"
          >
            Creado.
          </jet-action-message>

          <jet-button-success
            :class="{ 'opacity-25': createZoneForm.processing }"
            :disabled="createZoneForm.processing"
            class="ml-4 mt-4 btn btn-primary"
            >Crear</jet-button-success
          >
        </template>
      </jet-form-section>

      <jet-dialog-modal
        :show="displayingToken"
        @close="displayingToken = false"
      >
        <template #title
          ><h2 class="text-slate-600">Zona Creada Correctamente</h2></template
        >

        <template #content>
          <div>
            Recuerde que la zona que acaba de crear se encuentra disponible en
            la zona de Comunidades en el rol de secretaria.
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="displayingToken = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>

      <jet-dialog-modal
        :show="zoneBeingUpdated"
        @close="zoneBeingUpdated = null"
      >
        <template #title> Datos de la Zona</template>

        <template #content>
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Zona" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
              {{ $page.props.errors.name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="updateZoneForm.name"
              autofocus
            />

            <jet-label for="description" value="Descripción" class="mt-2" />
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.description"
            >
              {{ $page.props.errors.description }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="updateZoneForm.description"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="zoneBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button
            class="ml-3"
            @click="updatePastoral"
            :class="{ 'opacity-25': updateZoneForm.processing }"
            :disabled="updateZoneForm.processing"
          >
            Guardar
          </jet-button>
        </template>
      </jet-dialog-modal>

      <jet-confirmation-modal
        :show="zoneBeingDeleted"
        @close="zoneBeingDeleted = null"
      >
        <template #title> Eliminar Zona </template>

        <template #content>
          <h5>
            ¿Está seguro de que desea eliminar la zona:
            <strong class="text-red-500">{{ deleteZoneForm.name }}</strong>
            ?
          </h5>
        </template>

        <template #footer>
          <jet-secondary-button @click="zoneBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button
            class="ml-3"
            @click="deleteApiToken"
            :class="{ 'opacity-25': deleteZoneForm.processing }"
            :disabled="deleteZoneForm.processing"
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
import Alert from "@/Components/Alert";

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
    Alert,
  },

  layout: PrincipalLayout,

  props: ["zone"],

  data() {
    return {
      createZoneForm: this.$inertia.form({
        name: "",
        description: "",
      }),

      updateZoneForm: this.$inertia.form({
        name: "",
        description: "",
      }),

      deleteZoneForm: this.$inertia.form({
        name: "",
      }),

      displayingToken: false,
      zoneBeingUpdated: null,
      zoneBeingDeleted: null,
    };
  },

  methods: {
    showFormatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    createPastoral() {
      this.createZoneForm.post(route("admin.zone.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true;
          this.createZoneForm.reset();
        },
      });
    },

    updateConfirmPastoral(zone) {
      this.updateZoneForm.name = zone.name;
      this.updateZoneForm.description = zone.description;

      this.zoneBeingUpdated = zone;
    },

    updatePastoral() {
      this.updateZoneForm.put(
        route("admin.zone.update", this.zoneBeingUpdated),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.zoneBeingUpdated = null),
        }
      );
    },

    confirmPastoralDeletion(pastor) {
      this.deleteZoneForm.name = pastor.name;
      this.deleteZoneForm.description = pastor.description;

      this.zoneBeingDeleted = pastor;
    },

    deleteApiToken() {
      this.deleteZoneForm.delete(
        route("admin.zone.destroy", this.zoneBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.zoneBeingDeleted = null),
        }
      );
    },
  },
};
</script>
