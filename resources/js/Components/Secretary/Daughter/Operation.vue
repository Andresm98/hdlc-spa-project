<template>
  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.daughters.index')"
        :class="
          isUrl('secretary/daughters-charity/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Inicio
      </Link>
    </section>

    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.daughters.reality.index')"
        :class="
          isUrl('secretary/daughters-charity/reality')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Realidad de la Provincia</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.daughters.create')"
        :class="
          isUrl('secretary/daughters-charity/create')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Crear Hermanas</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.daughters.appointments.index')"
        :class="
          isUrl('secretary/daughters-charity/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Nombramientos</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.daughters.appointments.index')"
        :class="
          isUrl('secretary/daughters-charity/all')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
        >Permisos</Link
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
