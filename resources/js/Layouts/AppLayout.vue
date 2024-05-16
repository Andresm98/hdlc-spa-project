<template>
  <!--
                                     PLEASE READ
        Author:  https://github.com/Andresm98
        Date: 2021 - January

        App Layout Principal Landing Page, extends components:
        1. General Menu Component.
        2. Head Component.
    -->
  <div>
    <Head :title="title" />
    <jet-banner />
    <div class="min-h-screen bg-gray-50">
      <!-- Load General Menu -->
      <general-nav></general-nav>
      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>
      <!-- Page Content -->
      <main>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
            <slot></slot>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import GeneralNav from "@/Components/GeneralNav.vue";
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
    GeneralNav,
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
