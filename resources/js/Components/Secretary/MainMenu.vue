<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/secretary/welcome">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('secretary/welcome') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('secretary/welcome') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Menu</div>
      </Link>
     <hr :class="isUrl('secretary/welcome') ? 'text-white' : 'hidden'">
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('secretary.daughters.index')">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('secretary/daughters-charity/all') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('secretary/daughters-charity/all') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Hermanas</div>
      </Link>
        <hr :class="isUrl('secretary/daughters-charity/all') ? 'text-white' : 'hidden'"/>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('admin.roles.index')">
        <icon name="roles" class="mr-2 w-4 h-4" :class="isUrl('system/admin/roles') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('system/admin/roles') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Elemento Pendiente</div>
      </Link>
        <hr :class="isUrl('system/admin/roles') ? 'text-white' : 'hidden'"/>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('admin.settings.index')">
        <icon name="settings" class="mr-2 w-4 h-4" :class="isUrl('sytem/admin/settings') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('system/admin/settings') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Configuración</div>
      </Link>
        <hr :class="isUrl('system/admin/settings') ? 'text-white' : 'hidden'"/>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/cominities">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('cominities') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('cominities') ? 'text-white' : 'text-gray-400 group-hover:text-white'">División</div>
      </Link>
        <hr :class="isUrl('cominities') ? 'text-white' : 'hidden'"/>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/reports">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('reports') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('reports') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Reportes</div>
      </Link>
      <hr :class="isUrl('reports') ? 'text-white' : 'hidden'"/>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Components/Icon'
import JetNavLink from "@/Jetstream/NavLink.vue";


export default {
  components: {
    Icon,
    JetNavLink,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
