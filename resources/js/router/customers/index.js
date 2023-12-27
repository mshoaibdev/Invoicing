const routes = [
  {
    path: '/customers',
    name: 'customers',
    component: () => import('@/views/customers/Index.vue'),

    meta: {
      auth: true,
      action: 'Read',
      subject: 'customers-list',
    },
  },
]

export default routes
