<template>
  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.welcome')"
        :class="
          isUrl('daughter/profile')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        INICIO
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.health.index')"
        :class="
          isUrl('daughter/health')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Historial Médico
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.academic.index')"
        :class="
          isUrl('daughter/academic')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Historial Académico
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.sacrament.index')"
        :class="
          isUrl('daughter/sacrament')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Historial Sacramentos
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.permit.index')"
        :class="
          isUrl('daughter/permit')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Permisos
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.transfer.index')"
        :class="
          isUrl('daughter/transfer')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Cambios y Nombramientos
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.files.index')"
        :class="
          isUrl('daughter/files')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Documentos Personales
      </Link>
    </section>
  </div>

  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.activities.index')"
        :class="
          isUrl('daughter/community/activities/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-700 border-2 border-emerald-700 text-white text-xs rounded-lg hover:bg-emerald-700 hover:text-gray-100 focus:border-4 focus:border-emerald-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-500 border-2 border-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-500 hover:text-gray-100 focus:border-4 focus:border-emerald-300'
        "
      >
        Actividades Comunidad
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.resumes.index')"
        :class="
          isUrl('daughter/community/resumes/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-700 border-2 border-emerald-700 text-white text-xs rounded-lg hover:bg-emerald-700 hover:text-gray-100 focus:border-4 focus:border-emerald-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-500 border-2 border-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-500 hover:text-gray-100 focus:border-4 focus:border-emerald-300'
        "
      >
        Resumenes Anuales Comunidad
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.visits.index')"
        :class="
          isUrl('daughter/community/visits/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-700 border-2 border-emerald-700 text-white text-xs rounded-lg hover:bg-emerald-700 hover:text-gray-100 focus:border-4 focus:border-emerald-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-500 border-2 border-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-500 hover:text-gray-100 focus:border-4 focus:border-emerald-300'
        "
      >
        Visitas Comunidad
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.filesglobal.communities.index')"
        :class="
          isUrl('daughter/community/filesglobal/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-700 border-2 border-emerald-700 text-white text-xs rounded-lg hover:bg-emerald-700 hover:text-gray-100 focus:border-4 focus:border-emerald-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-500 border-2 border-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-500 hover:text-gray-100 focus:border-4 focus:border-emerald-300'
        "
      >
        Archivos Comunidad
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('daughter.community.inventory.index')"
        :class="
          isUrl('daughter/community/inventory')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-700 border-2 border-emerald-700 text-white text-xs rounded-lg hover:bg-emerald-700 hover:text-gray-100 focus:border-4 focus:border-emerald-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-emerald-500 border-2 border-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-500 hover:text-gray-100 focus:border-4 focus:border-emerald-300'
        "
      >
        Inventario Comunidad
      </Link>
    </section>
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
};
</script>
