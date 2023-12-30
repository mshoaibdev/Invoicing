<script setup>
import ability from '@/plugins/casl/ability'
import { useRoute } from 'vue-router'
import Account from './Account.vue'
import Company from './Company.vue'
import Roles from './Roles.vue'
import Security from './Security.vue'

const route = useRoute()
const activeTab = ref(route.params.tab)


// tabs
const tabs = [
  {
    title: 'Account Settings',
    icon: 'tabler-users',
    tab: 'account',
  },
  {
    title: 'Company Information',
    icon: 'tabler-building',
    tab: 'company-information',
  },
  {
    title: 'Security',
    icon: 'tabler-lock',
    tab: 'security',
  },
]

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
    <VRow>
      <VCol cols="2">
        <VTabs
          v-model="activeTab"
          show-arrows
          :border="false"
          direction="vertical"
        >
          <VTab
            v-for="item in tabs"
            :key="item.icon"
            :border="false"
            :value="item.tab"
            
            :to="{ name: 'settings', params: { tab: item.tab } }"
          >
            <VIcon
              size="20"
              start
              :icon="item.icon"
            />
            {{ item.title }}
          </VTab>
        </VTabs>
      </VCol>

      <VCol cols="10">
        <VWindow
          v-model="activeTab"
          class=" disable-tab-transition"
          :touch="false"
        >
          <VWindowItem value="account">
            <Account />
          </VWindowItem>

          <VWindowItem value="company-information">
            <Company />
          </VWindowItem>

          <VWindowItem value="security">
            <Security />
          </VWindowItem>

          <VWindowItem value="roles">
            <Roles />
          </VWindowItem>
        </VWindow>
      </VCol>
    </VRow>
  </div>
</template>

