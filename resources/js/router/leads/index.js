const routes = [
  {
    path: '/leads',
    name: 'leads',
    component: () => import('@/views/customers/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },
  
]
  
export default routes
  