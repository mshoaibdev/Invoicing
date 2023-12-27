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
    title: 'Customers',
    icon: { icon: 'tabler-users' },
    action: 'Read',
    to: { name: 'customers' },
    subject: 'customers-list',
  },
  // {
  //   title: 'Estimates',

  //   to: { name: 'estimates' },
  //   icon: { icon: 'tabler-list-check' },
  //   action: 'Read',
  //   subject: 'estimates-list',
  // },
  {
    title: 'Invoices',

    to: { name: 'invoices' },
    icon: { icon: 'tabler-cash' },
    action: 'Read',
    subject: 'invoices-list',
  },
  // {
  //   title: 'Projects',
  //   to: { name: 'projects' },
  //   icon: { icon: 'tabler-list-check' },
  //   action: 'Read',
  //   subject: 'projects-list',
  // },
  {
    title: 'Users',
    to: { name: 'account-settings-users' },
    icon: { icon: 'tabler-users' },
    action: 'Read',
    subject: 'settings-users-list',
  },
  { heading: 'Settings & Profile', action: 'Read',
    subject: 'All' },
  {
    title: 'Profile',
    to: { name: 'account-settings-account' },
    icon: { icon: 'tabler-user' },
    action: 'Read',
    subject: 'All',
  },
  {
    title: 'Security',
    to: { name: 'account-settings-security' },
    icon: { icon: 'tabler-lock' },
    action: 'Read',
    subject: 'All',
  },
]
