<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import { initialAbility } from '@/plugins/casl/ability'
import { useAppAbility } from '@/plugins/casl/useAppAbility'

import useAuth from "@/composables/auth"
import useJwtService from "@/composables/jwtService"

const { logout: logoutUser } = useAuth()
const router = useRouter()

const { removeToken, removeUserData, removeUserAbilities, getUser } = useJwtService()

const ability = useAppAbility()

const unsetStorage = () => {
  removeToken()
  removeUserData()
  removeUserAbilities()
}


const userData = JSON.parse(localStorage.getItem('userData') || 'null')

const logout = () => {
  logoutUser().then(() => {
    unsetStorage()
    ability.update(initialAbility)
    router.push({ name: 'login' })
  })

}
</script>

<template>
  <VBadge
    dot
    bordered
    location="bottom right"
    offset-x="3"
    offset-y="3"
    color="success"
  >
    <VAvatar
      class="cursor-pointer"
      :color="!(userData && userData.avatar) ? 'primary' : undefined"
      :variant="!(userData && userData.avatar) ? 'tonal' : undefined"
    >
      <VImg
        v-if="userData && userData.avatar"
        :src="userData.avatar"
      />
      <VIcon
        v-else
        icon="tabler-user"
      />

      <!-- SECTION Menu -->
      <VMenu
        activator="parent"
        width="230"
        location="bottom end"
        offset="14px"
      >
        <VList>
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                  bordered
                >
                  <VAvatar
                    :color="!(userData && userData.avatar) ? 'primary' : undefined"
                    :variant="!(userData && userData.avatar) ? 'tonal' : undefined"
                  >
                    <VImg
                      v-if="userData && userData.avatar"
                      :src="userData.avatar"
                    />
                    <VIcon
                      v-else
                      icon="tabler-user"
                    />
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-medium">
              {{ userData.name }}
            </VListItemTitle>
            <VListItemSubtitle>{{ userData.role }}</VListItemSubtitle>
          </VListItem>

          <PerfectScrollbar :options="{ wheelPropagation: false }">
            <VListItem :to="{name: 'account-settings-account'}">
              <template #prepend>
                <VIcon
                  class="me-2"
                  icon="tabler-settings"
                  size="22"
                />
              </template>

              <VListItemTitle>Settings</VListItemTitle>
            </VListItem>


            <!-- Divider -->
            <VDivider class="my-2" />

            <!-- 👉 Logout -->
            <VListItem @click="logout">
              <template #prepend>
                <VIcon
                  class="me-2"
                  icon="tabler-logout"
                  size="22"
                />
              </template>

              <VListItemTitle>Logout</VListItemTitle>
            </VListItem>
          </PerfectScrollbar>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
