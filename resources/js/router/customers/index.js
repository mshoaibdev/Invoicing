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

  // view single customer

  {
    path: '/customers/:id',
    name: 'customers.view',
    component: () => import('@/views/customers/CustomerInvoices.vue'),

    meta: {
      auth: true,
      action: 'Read',
      subject: 'customers-list',
    },
  },
]

export default routes
