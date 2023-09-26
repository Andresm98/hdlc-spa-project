<template>
  <div>
    <div id="dropdown" />

    <div class="md:flex md:flex-col md:h-screen">
      <div class="md:flex md:flex-shrink-0">
        <div
          class="flex items-center justify-between px-6 py-4 bg-blue-600 md:flex-shrink-0 md:justify-center md:w-56"
        >
          <dropdown placement="bottom-end">
            <template #default>
              <svg
                class="w-6 h-6 fill-white"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
              </svg>
            </template>
            <template #dropdown>
              <div class="mt-2 px-8 py-4 bg-slate-800 rounded shadow-lg"></div>
            </template>
          </dropdown>
        </div>
        <general-nav></general-nav>
      </div>
      <div class="md:flex md:flex-grow">
        <div
          class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto"
          scroll-region
        >
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Logo from "@/Components/Logo";
import Dropdown from "@/Components/Dropdown";

import GeneralNav from "@/Components/GeneralNav.vue";

export default {
  components: {
    Link,
    Logo,
    Dropdown,
    GeneralNav,
  },
  props: {
    auth: Object,
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
};
</script>
