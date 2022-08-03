<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col md:h-screen">
      <div class="md:flex md:flex-shrink-0">
        <div
          class="
            flex
            items-center
            justify-between
            px-6
            py-4
            bg-blue-600
            md:flex-shrink-0 md:justify-center md:w-56
          "
        ></div>
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

import MainMenu from "@/Components/Secretary/MainMenu";
import GeneralNav from "@/Components/GeneralNav.vue";

export default {
  mounted() {
    axios.get(this.route("web.user.roles.index")).then((response) => {
      this.allRoles = response.data;
    });
  },
  components: {
    Link,
    Logo,
    Dropdown,
    MainMenu,
    GeneralNav,
  },
  props: {
    auth: Object,
  },
  data() {
    return {
      showingNavigationDropdown: false,
      allRoles: null,
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
