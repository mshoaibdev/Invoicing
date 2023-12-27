const routes = [
  {
    path: '/estimates',
    name: 'estimates',
    component: () => import('@/views/estimates/Index.vue'),

    meta: {
      auth: true,
      action: 'Read',
      subject: 'estimates-list',
    },
  },
]

export default routes
