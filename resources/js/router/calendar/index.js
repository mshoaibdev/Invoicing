const routes = [
  {
    path: '/calendar',
    name: 'calendar',
    component: () => import('@/views/calendar/Index.vue'),
  
    meta: {
      auth: true,
      action: 'Read',
      subject: 'calendar-list',
    },
  },
]
  
export default routes
  