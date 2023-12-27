const routes = [
  {
    path: '/invoices',
    name: 'invoices',
    component: () => import('@/views/invoices/Index.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'invoices-list',
    },
  },
  {
    path: '/invoices/create',
    name: 'create-invoice',
    component: () => import('@/views/invoices/CreateInvoice.vue'),
    meta: {
      auth: false,
      action: 'Create',
      subject: 'invoices-create',
    },
  },
  // {
  //   path: '/invoices/edit/:id',
  //   name: 'edit-invoice',
  //   component: () => import('@/views/invoices/EditInvoice.vue'),
  //   meta: {
  //     auth: false,
  //     action: 'Update',
  //     subject: 'invoices-edit',
  //   },
  // },
  {
    path: '/invoices/view/:id',
    name: 'view-invoice',
    component: () => import('@/views/invoices/ViewInvoice.vue'),
    meta: {
      auth: false,
      action: 'Read',
      subject: 'invoices-view',
    },
  },
]
  
export default routes
  