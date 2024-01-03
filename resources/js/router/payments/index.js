const routes = [
  {
    path: '/payments',
    name: 'payments',
    component: () => import('@/views/payments/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'payments-list',
    },
  },
 
]
    
export default routes
    