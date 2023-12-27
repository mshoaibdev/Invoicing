const routes = [
  {
    path: '/projects',
    name: 'projects',
    component: () => import('@/views/projects/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },
    
]
    
export default routes
    