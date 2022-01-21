<template>
  <div>
    <Head :title="title" />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <!-- Responsive Navigation Menu -->
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <!-- <div class="grid grid-cols-3">
        <div class="bg-red-400 ...">01</div>
        <div class="bg-blue-400 ...">02</div>
        <div class="bg-green-400 ...">03</div>
        <div class="bg-yellow-400 col-span-2 ...">04</div>
        <div class="bg-blue-400 ...">05</div>
        <div class="bg-gray-400 ...">06</div>
        <div class="bg-blue-700 col-span-2 ...">07</div>
        </div> -->

        <div class="md:flex md:flex-grow md:overflow-hidden">
          <div class="md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
            <slot></slot>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Dropdown";
import MainMenu from "@/Components/Admin/MainMenu";
export default defineComponent({
  props: {
    title: String,
  },

  components: {
    Head,
    JetApplicationMark,
    JetBanner,
    Dropdown,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    MainMenu,
    Link,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>
