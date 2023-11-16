<template>
  <jet-action-section>
    <template #title> Eliminar el Equipo </template>

    <template #description>
      Eliminar de este equipo de manera permanente.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Una vez que este equipo sea eliminado, todos sus recursos y datos serán
        eliminados permanentemente. Antes de eliminar este equipo, por favor,
        descargue cualquier dato o información almacenada en este equipo que
        desea retener.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmTeamDeletion">
          Eliminar Equipo
        </jet-danger-button>
      </div>

      <!-- Delete Team Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingTeamDeletion"
        @close="confirmingTeamDeletion = false"
      >
        <template #title> Eliminar Equipo</template>

        <template #content>
          ¿Está seguro de que desea eliminar este equipo? Una vez que se elimina
          un equipo, todos sus los recursos y los datos se eliminarán de forma
          permanente.
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingTeamDeletion = false">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button
            class="ml-3"
            @click="deleteTeam"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Eliminar Equipo
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import { defineComponent } from "vue";

export default defineComponent({
  props: ["team"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingTeamDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmTeamDeletion() {
      this.confirmingTeamDeletion = true;
    },

    deleteTeam() {
      this.form.delete(route("teams.destroy", this.team), {
        errorBag: "deleteTeam",
      });
    },
  },
});
</script>
