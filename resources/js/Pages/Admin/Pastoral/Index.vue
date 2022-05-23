<template>
  <div>
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
          Pastorales del Sistema
        </h2>
        <div class="text-sm text-blue-700 mt-3 mb-6">
          Bienvenido Usuario: {{ $page.props.user.name }}
        </div>
      </template>
      <!-- Generate Permission Token -->

      <jet-form-section @submitted="createPastoral">
        <template #title> Crear Pastorales en el Sistema </template>

        <template #description>
          Las pastorales permiten que asigne categorías a cada una de las comunidades que
          son ingresadas por el rol de secretaria.
        </template>

        <template #form>
          <!-- Token Name -->
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Pastoral" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
              {{ $page.props.errors.name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="createPastoralForm.name"
              autofocus
            />

            <jet-label for="description" value="Descripción" class="mt-2" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="createPastoralForm.description"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>

        <template #actions>
          <jet-action-message :on="createPastoralForm.recentlySuccessful" class="mr-3">
            Creado.
          </jet-action-message>

          <jet-button-success
            :class="{ 'opacity-25': createPastoralForm.processing }"
            :disabled="createPastoralForm.processing"
            class="ml-4 mt-4 btn btn-primary"
            >Crear</jet-button-success
          >
        </template>
      </jet-form-section>

      <div>
        <jet-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
          <jet-action-section>
            <template #title> Administrar Pastorales del Sistema </template>

            <template #description>
              Puede eliminar o gestionar las pastorales aquí descritas, tenga en cuenta si
              las pastorales estan asociadas a una comunidad u obra no podrán ser
              eliminadas pero si actualizadas.
            </template>
            <!-- API Token List -->
            <template #content>
              <div class="space-y-6">
                <div
                  class="flex items-center justify-between"
                  v-for="pastor in pastoral"
                  :key="pastor"
                >
                  <div>
                    {{ pastor.name }}
                  </div>

                  <div class="flex items-center">
                    <div
                      class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                      v-if="pastor.created_at"
                    >
                      Creado en {{ showFormatDate(pastor.created_at) }}
                    </div>
                    <button
                      class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                      @click="updateConfirmPastoral(pastor)"
                    >
                      Actualizar
                    </button>

                    <button
                      class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                      @click="confirmPastoralDeletion(pastor)"
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

      <!-- Token Value Modal -->
      <jet-dialog-modal :show="displayingToken" @close="displayingToken = false">
        <template #title
          ><h2 class="text-slate-600">Pastoral Creada Correctamente</h2></template
        >

        <template #content>
          <div>
            Recuerde que la pastoral que acaba de crear se encuentra disponible en la zona
            de Comunidades en el rol de secretaria.
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="displayingToken = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>

      <!-- API Token Permissions Modal -->
      <jet-dialog-modal :show="pastoralBeingUpdated" @close="pastoralBeingUpdated = null">
        <template #title> Datos de la Pastoral</template>

        <template #content>
          <div class="col-span-6 sm:col-span-6">
            <jet-label for="name" value="Nombre Pastoral" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.name">
              {{ $page.props.errors.name }}
            </p>
            <jet-input
              id="name"
              type="text"
              minLength="5"
              maxlength="100"
              class="mt-1 block w-full"
              v-model="updatePastoralForm.name"
              autofocus
            />

            <jet-label for="description" value="Descripción" class="mt-2" />
            <p class="text-red-400 text-sm" v-show="$page.props.errors.description">
              {{ $page.props.errors.description }}
            </p>
            <textarea
              id="description"
              name="description"
              rows="6"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="updatePastoralForm.description"
              placeholder="Agregar la description..."
              required
              :maxlength="100"
            />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="pastoralBeingUpdated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button
            class="ml-3"
            @click="updatePastoral"
            :class="{ 'opacity-25': updatePastoralForm.processing }"
            :disabled="updatePastoralForm.processing"
          >
            Guardar
          </jet-button>
        </template>
      </jet-dialog-modal>

      <!-- Delete Token Confirmation Modal -->
      <jet-confirmation-modal
        :show="pastoralBeingDeleted"
        @close="pastoralBeingDeleted = null"
      >
        <template #title> Eliminar la Pastoral </template>

        <template #content>
          <h5>
            ¿Está seguro de que desea eliminar la pastoral:
            <strong class="text-red-500">{{ deletePastoralForm.name }}</strong>
            ?
          </h5>
        </template>

        <template #footer>
          <jet-secondary-button @click="pastoralBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button
            class="ml-3"
            @click="deleteApiToken"
            :class="{ 'opacity-25': deletePastoralForm.processing }"
            :disabled="deletePastoralForm.processing"
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
  props: ["pastoral"],
  data() {
    return {
      createPastoralForm: this.$inertia.form({
        name: "",
        description: "",
      }),

      updatePastoralForm: this.$inertia.form({
        name: "",
        description: "",
      }),

      deletePastoralForm: this.$inertia.form({
        name: "",
      }),

      displayingToken: false,
      pastoralBeingUpdated: null,
      pastoralBeingDeleted: null,
    };
  },

  methods: {
    showFormatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD");
    },

    createPastoral() {
      this.createPastoralForm.post(route("admin.pastoral.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true;
          this.createPastoralForm.reset();
        },
      });
    },

    updateConfirmPastoral(pastoral) {
      this.updatePastoralForm.name = pastoral.name;
      this.updatePastoralForm.description = pastoral.description;

      this.pastoralBeingUpdated = pastoral;
    },

    updatePastoral() {
      this.updatePastoralForm.put(
        route("admin.pastoral.update", this.pastoralBeingUpdated),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.pastoralBeingUpdated = null),
        }
      );
    },

    confirmPastoralDeletion(pastor) {
      this.deletePastoralForm.name = pastor.name;
      this.deletePastoralForm.description = pastor.description;

      this.pastoralBeingDeleted = pastor;
    },

    deleteApiToken() {
      this.deletePastoralForm.delete(
        route("admin.pastoral.destroy", this.pastoralBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.pastoralBeingDeleted = null),
        }
      );
    },
  },
};
</script>
