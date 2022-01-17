<template>
  <div >
    <div class="mb-4">
      <Link class="rounded-full focus:outline-none focus:ring-2 focus:bg-blue-50 focus:ring-blue-800  sm:ml-8" href="/">
        <div :class="isUrl('admin/user') ? 'text-sm text-center py-2 text-white' : 'text-sm text-center py-2  bg-blue-600 text-white hover:text-white hover:text-sm hover:bg-blue-500 rounded-full'">Inicio</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-blue-800  sm:ml-8" href="/">
        <div :class="isUrl('') ? 'text-sm text-center py-2  text-white' : ' text-sm text-center py-2  bg-blue-600 text-white hover:text-white hover:text-sm hover:bg-blue-500 rounded-full'">Usuarios</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link  class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-blue-800  sm:ml-8" href="/">
        <div :class="isUrl('') ? 'text-sm text-center py-2   text-white' : ' text-sm text-center py-2   bg-blue-600 text-white hover:text-white hover:text-sm hover:bg-blue-500 rounded-full'">Comunidad</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link  class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-blue-800  sm:ml-8" href="/">
        <div :class="isUrl('') ? 'text-sm text-center py-2  text-white' : ' text-sm text-center py-2 bg-blue-600 text-white hover:text-white hover:text-sm hover:bg-blue-500 rounded-full'">Reportes</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Components/Icon'

export default {
  components: {
    Icon,
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
