<template>
  <div>
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
          Roles del Sistema
        </h2>
        <div class="text-sm text-blue-700 mt-3 mb-6">
          Bienvenido Usuario: {{ $page.props.user.name }}
        </div>
      </template>
      <!-- Generate Permission Token -->
      <jet-form-section @submitted="createApiToken">
        <template #title> Crear Roles en el Sistema </template>

        <template #description>
          Los permisos permiten que un rol tenga ciertos privilegios en el sistema, por lo
          tanto es necesario que cada uno de ellos sea correctamente validado y escogido.
          El sistema cuenta con la siguiente categoría de roles.
        </template>

        <template #form>
          <!-- Token Name -->
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Nombre Rol" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="createApiTokenForm.name"
              autofocus
            />
            <jet-input-error :message="createApiTokenForm.errors.name" class="mt-2" />
          </div>

          <!-- Token Permissions -->
          <div class="col-span-6" v-if="availablePermissions.length > 0">
            <jet-label for="permissions" value="Permisos" />
            <jet-input-error
              :message="createApiTokenForm.errors.permissions"
              class="mt-2"
            />
            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div v-for="permission in availablePermissions" :key="permission">
                <label class="flex items-center">
                  <jet-checkbox
                    :value="permission.id"
                    v-model:checked="createApiTokenForm.permissions"
                  />
                  <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                </label>
              </div>
            </div>
          </div>
        </template>

        <template #actions>
          <jet-action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
            Creado.
          </jet-action-message>

          <jet-button-success
            :class="{ 'opacity-25': createApiTokenForm.processing }"
            :disabled="createApiTokenForm.processing"
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
            <template #title> Administrar Roles del Sistema </template>

            <template #description>
              Puede eliminar cualquiera de los roles existentes, tenga cuidado con
              aquellos de mayor rango, para más información consulte la documentación.
            </template>
            <!-- API Token List -->
            <template #content>
              <div class="space-y-6">
                <div
                  class="flex items-center justify-between"
                  v-for="role in roles"
                  :key="role"
                >
                  <div>
                    {{ role.name }}
                  </div>

                  <div class="flex items-center">
                    <div
                      class="hidden md:block md:text-sm md:text-gray-700 lg:block lg:text-sm lg:text-gray-400"
                      v-if="role.created_at"
                    >
                      Creado en {{ this.formatShowDate(role.created_at) }}
                    </div>

                    <button
                      class="bg-blue-500 pt-2 pb-2 pr-2 pl-2 ml-4 mr-4 rounded-md cursor-pointer text-sm hover:bg-blue-600 text-white"
                      @click="manageApiTokenPermissions(role)"
                      v-if="availablePermissions.length > 0"
                    >
                      Permisos
                    </button>

                    <button
                      class="bg-red-500 pt-2 pb-2 pr-2 pl-2 rounded-md cursor-pointer text-sm hover:bg-red-600 text-white"
                      @click="confirmApiTokenDeletion(role)"
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
          ><h2 class="text-gray-800">Rol Creado Correctamente</h2></template
        >

        <template #content>
          <div>
            Recuerde que el rol que acaba de crear puede ser asignados a uno o más
            usuarios en el sistema
          </div>

          <div
            class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"
            v-if="$page.props.jetstream.flash.token"
          >
            {{ $page.props.jetstream.flash.token }}
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="displayingToken = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>

      <!-- API Token Permissions Modal -->
      <jet-dialog-modal
        :show="managingPermissionsFor"
        @close="managingPermissionsFor = null"
      >
        <template #title> Permisos del presente Rol </template>

        <template #content>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <jet-label for="name" value="Nombre" />
              <jet-input-error :message="updateApiTokenForm.errors.name" class="mt-2" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="updateApiTokenForm.name"
                autofocus
              />
            </div>
            <hr />

            <div v-for="permission in availablePermissions" :key="permission">
              <label class="flex items-center">
                <jet-checkbox
                  :value="permission.id"
                  v-model:checked="updateApiTokenForm.permissions"
                />
                <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
              </label>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="managingPermissionsFor = null">
            Cancelar
          </jet-secondary-button>

          <jet-button
            class="ml-3"
            @click="updateApiToken"
            :class="{ 'opacity-25': updateApiTokenForm.processing }"
            :disabled="updateApiTokenForm.processing"
          >
            Guardar
          </jet-button>
        </template>
      </jet-dialog-modal>

      <!-- Delete Token Confirmation Modal -->
      <jet-confirmation-modal
        :show="apiTokenBeingDeleted"
        @close="apiTokenBeingDeleted = null"
      >
        <template #title> Eliminar el Rol </template>

        <template #content>
          <h5>
            ¿Está seguro de que desea eliminar el rol:
            <strong class="text-red-500">{{ deleteApiTokenForm.name }}</strong>
            ?
          </h5>
        </template>

        <template #footer>
          <jet-secondary-button @click="apiTokenBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button
            class="ml-3"
            @click="deleteApiToken"
            :class="{ 'opacity-25': deleteApiTokenForm.processing }"
            :disabled="deleteApiTokenForm.processing"
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
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";
import moment from "moment";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";

export default defineComponent({
  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetButtonSuccess,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetCheckbox,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSectionBorder,
    AppLayout,
  },
  layout: PrincipalLayout,
  props: ["roles", "availablePermissions", "defaultPermissions"],

  data() {
    return {
      createApiTokenForm: this.$inertia.form({
        name: "",
        permissions: [],
      }),

      updateApiTokenForm: this.$inertia.form({
        name: "",
        permissions: [],
      }),

      deleteApiTokenForm: this.$inertia.form({
        name: "",
      }),

      displayingToken: false,
      managingPermissionsFor: null,
      apiTokenBeingDeleted: null,
    };
  },

  methods: {
    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "";
    },
    createApiToken() {
      this.createApiTokenForm.post(route("admin.roles.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true;
          this.createApiTokenForm.reset();
        },
      });
    },

    manageApiTokenPermissions(role) {
      let array_permissions = [];
      for (let index = 0; index < role.permissions.length; index++) {
        array_permissions.push(role.permissions[index].id);
      }
      this.updateApiTokenForm.permissions = array_permissions;
      this.updateApiTokenForm.name = role.name;
      this.managingPermissionsFor = role;
    },

    updateApiToken() {
      this.updateApiTokenForm.put(
        route("admin.roles.update", this.managingPermissionsFor),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.managingPermissionsFor = null),
        }
      );
    },

    confirmApiTokenDeletion(role) {
      this.deleteApiTokenForm.name = role.name;
      this.apiTokenBeingDeleted = role;
    },

    deleteApiToken() {
      this.deleteApiTokenForm.delete(
        route("admin.roles.destroy", this.apiTokenBeingDeleted),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (this.apiTokenBeingDeleted = null),
        }
      );
    },
  },
});
</script>
