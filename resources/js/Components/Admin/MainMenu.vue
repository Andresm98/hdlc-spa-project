<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/system/admin/welcome">
        <icon
          name="dashboard"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/welcome')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/welcome')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Menu
        </div>
      </Link>
      <hr :class="isUrl('system/admin/welcome') ? 'text-white' : 'hidden'" />
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('admin.roles.index')"
      >
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/roles')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/roles')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Roles
        </div>
      </Link>
      <hr :class="isUrl('system/admin/roles') ? 'text-white' : 'hidden'" />
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/system/admin/users/all">
        <icon
          name="users"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/users/all')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/users/all')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Usuarios
        </div>
      </Link>
      <hr :class="isUrl('system/admin/users/all') ? 'text-white' : 'hidden'" />
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('admin.pastoral.index')"
      >
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/pastoral')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/pastoral')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Pastorales
        </div>
      </Link>
      <hr :class="isUrl('system/admin/pastoral') ? 'text-white' : 'hidden'" />
    </div>

    <!-- <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('admin.office.index')">
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/office')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/office')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Oficios
        </div>
      </Link>
      <hr :class="isUrl('system/admin/office') ? 'text-white' : 'hidden'" />
    </div> -->

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('admin.appointmentlevel.index')"
      >
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/appointmentlevel')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/appointmentlevel')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Consejo y Curia
        </div>
      </Link>
      <hr
        :class="
          isUrl('system/admin/appointmentlevel') ? 'text-white' : 'hidden'
        "
      />
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('admin.zone.index')"
      >
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('system/admin/zone')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/zone')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Zonas
        </div>
      </Link>
      <hr :class="isUrl('system/admin/zone') ? 'text-white' : 'hidden'" />
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('admin.settings.index')"
      >
        <icon
          name="settings"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('sytem/admin/settings')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('system/admin/settings')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Configuración
        </div>
      </Link>
      <hr :class="isUrl('system/admin/settings') ? 'text-white' : 'hidden'" />
    </div>
    <!-- <div class="mb-4">
      <Link class="group flex items-center py-3" href="/cominities">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('cominities') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('cominities') ? 'text-white' : 'text-gray-400 group-hover:text-white'">División</div>
      </Link>
        <hr :class="isUrl('cominities') ? 'text-white' : 'hidden'"/>
    </div> -->

    <!-- <div class="mb-4">
      <Link class="group flex items-center py-3" href="/reports">
        <icon
          name="printer"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('reports') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('reports') ? 'text-white' : 'text-gray-400 group-hover:text-white'
          "
        >
          Reportes
        </div>
      </Link>
      <hr :class="isUrl('reports') ? 'text-white' : 'hidden'" />
    </div> -->
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Components/Icon";
import JetNavLink from "@/Jetstream/NavLink.vue";

export default {
  components: {
    Icon,
    JetNavLink,
    Link,
  },
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
