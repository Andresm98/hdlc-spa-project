<template>
  <div
    class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-12 md:py-0"
  >
    <div class="mr-4 mt-1">Sistema de Gestión de Secretaría - Administrador</div>
    <!-- <dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap">
                    <span> fsdfsdf</span>
                    <span class="hidden md:inline">sdfasdfsafd</span>
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-indigo-600 focus:fill-indigo-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" :href="` `">My Profile</Link>
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" href="/users">Manage Users</Link>
                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="/logout" method="delete" as="button">Logout</Link>
                </div>
              </template>
            </dropdown> -->

    <div class="sm:flex sm:items-end sm:ml-6">
      <div class="ml-3 relative">
        <!-- Teams Dropdown -->
        <jet-dropdown
          align="right"
          width="60"
          v-if="$page.props.jetstream.hasTeamFeatures"
        >
          <template #trigger>
            <span class="inline-flex rounded-md">
              <button
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
              >
                {{ $page.props.user.current_team.name }}

                <svg
                  class="ml-2 -mr-0.5 h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </span>
          </template>

          <template #content>
            <div class="w-60">
              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Administrar Equipos
                </div>

                <!-- Team Settings -->
                <jet-dropdown-link
                  :href="route('teams.show', $page.props.user.current_team)"
                >
                  Configurar Equipo
                </jet-dropdown-link>

                <jet-dropdown-link
                  :href="route('teams.create')"
                  v-if="$page.props.jetstream.canCreateTeams"
                >
                  Crear Nuevo Equipo
                </jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">Cambiar Equipos</div>

                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                  <form @submit.prevent="switchToTeam(team)">
                    <jet-dropdown-link as="button">
                      <div class="flex items-center">
                        <svg
                          v-if="team.id == $page.props.user.current_team_id"
                          class="mr-2 h-5 w-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>{{ team.name }}</div>
                      </div>
                    </jet-dropdown-link>
                  </form>
                </template>
              </template>
            </div>
          </template>
        </jet-dropdown>
      </div>

      <!-- Settings Dropdown -->
      <div class="ml-3 relative">
        <jet-dropdown align="right" width="48">
          <template #trigger>
            <button
              v-if="$page.props.jetstream.managesProfilePhotos"
              class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
            >
              <img
                class="h-8 w-8 rounded-full object-cover"
                :src="$page.props.user.profile_photo_url"
                :alt="$page.props.user.name"
              />
            </button>

            <span v-else class="inline-flex rounded-md">
              <button
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
              >
                {{ $page.props.user.name }}

                <svg
                  class="ml-2 -mr-0.5 h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </span>
          </template>

          <template #content>
            <!-- Account Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">Administrar Cuenta</div>

            <jet-dropdown-link :href="route('profile.show')"> Perfil </jet-dropdown-link>
            <jet-dropdown-link :href="route('admin.welcome')">
              Administrar Sistema
            </jet-dropdown-link>

            <jet-dropdown-link
              :href="route('api-tokens.index')"
              v-if="$page.props.jetstream.hasApiFeatures"
            >
              API Tokens
            </jet-dropdown-link>

            <div class="border-t border-gray-100"></div>

            <!-- Authentication -->
            <form @submit.prevent="logout">
              <jet-dropdown-link as="button"> Salir </jet-dropdown-link>
            </form>
          </template>
        </jet-dropdown>
      </div>
    </div>
  </div>

  <!-- <dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap">
                    <span> fsdfsdf</span>
                    <span class="hidden md:inline">sdfasdfsafd</span>
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-indigo-600 focus:fill-indigo-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" :href="` `">My Profile</Link>
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" href="/users">Manage Users</Link>
                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="/logout" method="delete" as="button">Logout</Link>
                </div>
              </template>
            </dropdown> -->

  <!-- <div class="grid grid-cols-3">
        <div class="bg-red-400 ...">01</div>
        <div class="bg-blue-400 ...">02</div>
        <div class="bg-green-400 ...">03</div>
        <div class="bg-yellow-400 col-span-2 ...">04</div>
        <div class="bg-blue-400 ...">05</div>
        <div class="bg-gray-400 ...">06</div>
        <div class="bg-blue-700 col-span-2 ...">07</div>
        </div> -->
</template>

<script>
import { defineComponent } from "@vue/composition-api";

export default defineComponent({
  setup() {},
});
</script>
