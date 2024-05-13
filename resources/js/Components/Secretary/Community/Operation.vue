<template>
  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.index')"
        :class="
          isUrl('secretary/communities/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Inicio</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.create')"
        :class="
          isUrl('secretary/communities/create')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Crear Comunidades</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.worksindividual.create')"
        :class="
          isUrl('secretary/communities/worksindividual/create')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Crear Obras Individuales</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.activities.index')"
        :class="
          isUrl('secretary/community/activities/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Actividades</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.resumes.index')"
        :class="
          isUrl('secretary/community/resumes/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Resumenes</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.visits.index')"
        :class="
          isUrl('secretary/community/visits/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Visitas</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.vehicles.index')"
        :class="
          isUrl('secretary/community/vehicles/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Vehículos</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.filesglobal.communities.index')"
        :class="
          isUrl('secretary/communities/filesglobal/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Archivos</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communitiesglobal.inventories.index')"
        :class="
          isUrl('secretary/communities/inventoryglobal/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Inventarios</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.reality.index')"
        :class="
          isUrl('secretary/communities/reality')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Realidad de la Provincia</Link
      >
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
