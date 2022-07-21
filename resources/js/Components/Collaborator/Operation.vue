<template>
  <div class="flex overflow-x-auto space-x-4 w-full py-1 my-1">
    <section class="flex-shrink-0">
      <Link
        :href="route('collaborator.daughters.index')"
        :class="
          isUrl('collaborator/list-daughters')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Lista Hermanas
      </Link>
    </section>
    <section class="flex-shrink-0">
      <Link
        :href="route('collaborator.communities.index')"
        :class="
          isUrl('collaborator/list-communities')
            ? ' uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-700 border-2 border-blue-700 text-white text-xs rounded-lg hover:bg-blue-700 hover:text-gray-100 focus:border-4 focus:border-blue-500'
            : 'uppercase pt-12 pb-1 pl-4 pr-4 bg-blue-500 border-2 border-blue-500 text-white text-xs rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300'
        "
      >
        Lista Comunidades
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
