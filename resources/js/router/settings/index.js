const routes = [
  {
    path: '/settings/:tab',
    name: 'settings',
    component: () => import('@/views/settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },

  {
    path: '/settings/security',
    name: 'settings-security',
    redirect: { name: 'settings', params: { tab: 'security' } },
    component: () => import('@/views/settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },

  // company-information

  {
    path: '/settings/company-information',
    name: 'settings-company-information',
    redirect: { name: 'settings', params: { tab: 'company-information' } },
    component: () => import('@/views/settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'account-company-information',
    },
  },

  {
    path: '/settings/account-settings',
    name: 'settings-account',
    redirect: { name: 'settings', params: { tab: 'account' } },
    component: () => import('@/views/settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },


  
]
  
export default routes
  