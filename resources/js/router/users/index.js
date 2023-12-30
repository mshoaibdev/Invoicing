const routes = [
  {
    path: '/users',
    name: 'users',
    component: () => import('@/views/users/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'users-list',
    },
  },
      
]
      
export default routes
      