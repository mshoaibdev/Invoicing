const routes = [
  {
    path: '/account-settings/:tab',
    name: 'account-settings',
    component: () => import('@/views/account-settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'account-settings',
    },
  },

  {
    path: '/account-settings/users',
    name: 'account-settings-users',
    redirect: { name: 'account-settings', params: { tab: 'users' } },
    component: () => import('@/views/account-settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'account-settings',
    },
  },

  {
    path: '/account-settings/security',
    name: 'account-settings-security',
    redirect: { name: 'account-settings', params: { tab: 'security' } },
    component: () => import('@/views/account-settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'account-settings',
    },
  },

  {
    path: '/account-settings/account',
    name: 'account-settings-account',
    redirect: { name: 'account-settings', params: { tab: 'account' } },
    component: () => import('@/views/account-settings/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'account-settings',
    },
  },


  
]
  
export default routes
  