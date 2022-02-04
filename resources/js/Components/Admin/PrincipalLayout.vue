<template>
  <div>
    <div id="dropdown" />
    <general-nav></general-nav>
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:flex-shrink-0">
          <div
            class="flex items-center justify-between px-6 py-4 bg-slate-600 md:flex-shrink-0 md:justify-center md:w-56"
          >
            <Link class="mt-1" href="/">
              <logo class="fill-white" width="60" height="28" />
            </Link>
            <dropdown class="md:hidden" placement="bottom-end">
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
                <div class="mt-2 px-8 py-4 bg-slate-800 rounded shadow-lg">
                  <main-menu />
                </div>
              </template>
            </dropdown>
          </div>
          <div
            class="bg-gradient-to-r from-slate-600 via-slate-400 to-slate-900 md:text-md flex items-center justify-between p-4 w-full text-sm border-b md:px-12 md:py-0"
          >
            <div class="text-white text-center">SYS - Panel Súper Administrador</div>
          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <!-- Menu Left -->
          <main-menu
            class="hidden flex-shrink-0 p-12 w-56 bg-slate-800 overflow-y-auto md:block"
          />
          <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
            <!-- <flash-messages /> -->
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Logo from "@/Components/Logo";
import Dropdown from "@/Components/Dropdown";

import MainMenu from "@/Components/Admin/MainMenu";
import AppLayout from "@/Layouts/AppLayout.vue";
import GeneralNav from "@/Components/GeneralNav.vue";

export default {
  components: {
    Link,
    Logo,
    Dropdown,
    MainMenu,
    GeneralNav,
  },
  layout: AppLayout,
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
