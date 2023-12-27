<script setup>
import ability from '@/plugins/casl/ability'
import { useRoute } from 'vue-router'
import AccountSettingsAccount from './AccountSettingsAccount.vue'
import AccountSettingsRoles from './AccountSettingsRoles.vue'
import AccountSettingsSecurity from './AccountSettingsSecurity.vue'
import AccountSettingsUsers from './AccountSettingsUsers.vue'

const route = useRoute()
const activeTab = ref(route.params.tab)


// tabs
const tabs = [
  {
    title: 'Account',
    icon: 'tabler-users',
    tab: 'account',
  },
  {
    title: 'Security',
    icon: 'tabler-lock',
    tab: 'security',
  },
]

if (ability.can('Read', 'settings-users-list')) {
  tabs.push({
    title: 'Users',
    icon: 'tabler-users',
    tab: 'users',
  })
}
if (ability.can('Read', 'settings-roles-list')) {
  tabs.push( {
    title: 'Roles',
    icon: 'tabler-lock',
    tab: 'roles',
  })
}
</script>

<template>
  <div>
    <VTabs
      v-model="activeTab"
      show-arrows
    >
      <VTab
        v-for="item in tabs"
        :key="item.icon"
        :value="item.tab"
        :to="{ name: 'account-settings', params: { tab: item.tab } }"
      >
        <VIcon
          size="20"
          start
          :icon="item.icon"
        />
        {{ item.title }}
      </VTab>
    </VTabs>

    <VWindow
      v-model="activeTab"
      class="mt-6 disable-tab-transition"
      :touch="false"
    >
      <VWindowItem value="account">
        <AccountSettingsAccount />
      </VWindowItem>

      <VWindowItem value="security">
        <AccountSettingsSecurity />
      </VWindowItem>

      <VWindowItem value="users">
        <AccountSettingsUsers />
      </VWindowItem>
      <VWindowItem value="roles">
        <AccountSettingsRoles />
      </VWindowItem>
    </VWindow>
  </div>
</template>

