<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: ["href", "active"],

  computed: {
    classes() {
      return this.active
        ? "rounded-lg mt-4 mb-4  inline-flex items-center px-1 pt-1 border-b-2 border-blue-600 text-base font-medium leading-5 text-white focus:outline-none focus:border-indigo-700 transition"
        : "rounded-lg  mt-4 mb-4  inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-gray-200 hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition";
    },
  },
});
</script>
