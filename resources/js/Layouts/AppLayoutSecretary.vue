<template>
  <div>
    <Head :title="title" />
    <div class="min-h-screen bg-gray-100">
      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>
      <!-- Page Content -->
      <slot></slot>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
export default defineComponent({
  props: {
    title: String,
  },
  components: {
    Head,
  },
});
</script>
