<template>
  <div class="md:flex md:flex-col md:h-screen">
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/secretary/welcome">
        <icon
          name="dashboard"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('secretary/welcome')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('secretary/welcome')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Menu
        </div>
      </Link>
      <hr :class="isUrl('secretary/welcome') ? 'text-white' : 'hidden'" />
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('secretary.daughters.index')"
      >
        <icon
          name="users"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('secretary/daughters-charity/all')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('secretary/daughters-charity/all')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Hermanas
        </div>
      </Link>
      <hr
        :class="
          isUrl('secretary/daughters-charity/all') ? 'text-white' : 'hidden'
        "
      />
    </div>

    <div
      class="ml-4"
      v-if="
        route().current('secretary.daughters.index') ||
        route().current('secretary.daughters.create') ||
        route().current('secretary.permissions.index') ||
        route().current('secretary.transfers.index') ||
        route().current('secretary.appoinments.index') ||
        route().current('secretary.daughters.reality.index') ||
        route().current('secretary.filesglobal.daughter.index')
      "
    >
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.daughters.create')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/daughters-charity/create')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/daughters-charity/create')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Crear Hermanas
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/daughters-charity/create')
              ? 'text-white '
              : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.permissions.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/permissions/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/permissions/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Permisos
          </div>
        </Link>
        <hr
          :class="isUrl('secretary/permissions/all') ? 'text-white ' : 'hidden'"
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.transfers.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/transfers/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/transfers/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Cambios
          </div>
        </Link>
        <hr
          :class="isUrl('secretary/transfers/all') ? 'text-white ' : 'hidden'"
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.appoinments.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/appoinments/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/appoinments/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Nombramientos
          </div>
        </Link>
        <hr
          :class="isUrl('secretary/appoinments/all') ? 'text-white ' : 'hidden'"
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.filesglobal.daughter.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/files/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/files/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Ficheros
          </div>
        </Link>
        <hr :class="isUrl('secretary/files/all') ? 'text-white ' : 'hidden'" />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.daughters.reality.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/daughters-charity/reality')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/daughters-charity/reality')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Realidad de la Provincia
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/daughters-charity/reality')
              ? 'text-white '
              : 'hidden'
          "
        />
      </div>
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('secretary.communities.index')"
      >
        <icon
          name="roles"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('secretary/communities/all')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('secretary/communities/all')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Comunidades
        </div>
      </Link>
      <hr :class="isUrl('system/admin/roles') ? 'text-white' : 'hidden'" />
    </div>
    <div
      class="ml-4"
      v-if="
        route().current('secretary.communities.index') ||
        route().current('secretary.communities.create') ||
        route().current('secretary.worksindividual.create') ||
        route().current('secretary.communities.reality.index') ||
        route().current('secretary.activities.index') ||
        route().current('secretary.resumes.index') ||
        route().current('secretary.visits.index') ||
        route().current('secretary.filesglobal.communities.index') ||
        route().current('secretary.communitiesglobal.inventories.index')
      "
    >
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.communities.create')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/communities/create')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/communities/create')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Crear Comunidades
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/communities/create') ? 'text-white ' : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.worksindividual.create')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/communities/worksindividual/create')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/communities/worksindividual/create')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Crear Comunidades Individuales
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/communities/worksindividual/create')
              ? 'text-white '
              : 'hidden'
          "
        />
      </div>

      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.activities.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/community/activities/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/community/activities/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Actividades
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/community/activities/all')
              ? 'text-white '
              : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.resumes.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/community/resumes/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/community/resumes/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Resumenes
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/community/resumes/all') ? 'text-white ' : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.visits.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/community/visits/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/community/visits/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Visitas
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/community/visits/all') ? 'text-white ' : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.filesglobal.communities.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/communities/filesglobal/all')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/communities/filesglobal/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Archivos
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/communities/filesglobal/all') ? 'text-white ' : 'hidden'
          "
        />
      </div>
      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.communitiesglobal.inventories.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/communities/inventoryglobal/alll')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/communities/inventoryglobal/all')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Inventarios
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/communities/inventoryglobal/all') ? 'text-white ' : 'hidden'
          "
        />
      </div>

      <div class="mr-4 mb-4">
        <Link
          class="group flex items-center py-3"
          :href="route('secretary.communities.reality.index')"
        >
          <icon
            name="point"
            class="mr-2 w-4 h-4"
            :class="
              isUrl('secretary/communities/reality')
                ? 'fill-white'
                : 'fill-gray-400 group-hover:fill-white'
            "
          />
          <div
            :class="
              isUrl('secretary/communities/reality')
                ? 'text-white text-sm'
                : 'text-gray-400 group-hover:text-white text-sm'
            "
          >
            Realidad de la Provincia
          </div>
        </Link>
        <hr
          :class="
            isUrl('secretary/communities/reality') ? 'text-white ' : 'hidden'
          "
        />
      </div>
    </div>

    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        :href="route('secretary.events.index')"
      >
        <icon
          name="settings"
          class="mr-2 w-4 h-4"
          :class="
            isUrl('secretary/events/all')
              ? 'fill-white'
              : 'fill-gray-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('secretary/events/all')
              ? 'text-white'
              : 'text-gray-400 group-hover:text-white'
          "
        >
          Eventos
        </div>
      </Link>
      <hr :class="isUrl('secretary/events/all') ? 'text-white' : 'hidden'" />
    </div>
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
