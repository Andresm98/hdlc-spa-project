<template>
  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.index')"
        class="uppercase pt-12 pb-1 pl-4 pr-4 bg-red-500 border-2 border-red-500 text-white text-xs rounded-lg hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300"
        >Inicio</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.create')"
        class="uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
        >Crear Comunidades</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.reality.index')"
        class="uppercase pt-12 pb-1 pl-4 pr-4 bg-green-500 border-2 border-green-500 text-white text-xs rounded-lg hover:bg-green-500 hover:text-gray-100 focus:border-4 focus:border-green-300"
        >Realidad de la Provincia</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.communities.create')"
        class="uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
        >Crear Comunidades</Link
      >
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('secretary.worksindividual.create')"
        class="uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
        >Crear Obras</Link
      >
    </section>
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },
};
</script>
