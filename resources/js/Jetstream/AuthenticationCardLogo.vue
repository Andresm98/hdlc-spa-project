<template>
  <Link :href="'/'">
    <img
      class="w-46 h-16"
      src="https://files-hdlc-frontend.s3.amazonaws.com/logo_hdlc.png"
    />
  </Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
});
</script>
