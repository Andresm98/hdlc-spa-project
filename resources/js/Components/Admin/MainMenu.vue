<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/system/admin/welcome">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('system/admin/welcome') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('system/admin/welcome') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Menu</div>
      </Link>
     <hr :class="isUrl('system/admin/welcome') ? 'text-white' : 'hidden'">
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/system/admin/users/all">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('system/admin/users/all') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('system/admin/users/all') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Usuarios</div>
      </Link>
        <hr :class="isUrl('system/admin/users/all') ? 'text-white' : 'hidden'"/>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/cominities">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('cominities') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('cominities') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Contacts</div>
      </Link>
        <hr :class="isUrl('cominities') ? 'text-white' : 'hidden'"/>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/reports">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('reports') ? 'fill-white' : 'fill-gray-400 group-hover:fill-white'" />
        <div :class="isUrl('reports') ? 'text-white' : 'text-gray-400 group-hover:text-white'">Reports</div>
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
