export default [
  {
    title: 'Dashboard',
    to: { name: 'dashboard' },
    icon: { icon: 'tabler-apps' },
    action: 'Read',
    subject: 'dashboard-view',
  },
  { heading: 'Pages' },

  {
    title: 'Invoices',

    to: { name: 'invoices' },
    icon: { icon: 'tabler-cash' },
    action: 'Read',
    subject: 'invoices-list',
  },

  {
    title: 'Customers',
    icon: { icon: 'tabler-heart-handshake' },
    action: 'Read',
    to: { name: 'customers' },
    subject: 'customers-list',
  },

  {
    title: 'Users',
    to: { name: 'users' },
    icon: { icon: 'tabler-users' },
    action: 'Read',
    subject: 'users-list',
  },
 
 
  { heading: 'Settings & Profile', action: 'Read', subject: 'all' },
  
  {
    title: 'Profile',
    to: { name: 'settings-account' },
    icon: { icon: 'tabler-user' },
    action: 'Read',
    subject: 'all',
  },
  {
    title: 'Security',
    to: { name: 'settings-security' },
    icon: { icon: 'tabler-lock' },
    action: 'Read',
    subject: 'all',
  },
]
