<script setup>
const shortcuts = [
  {
    icon: 'tabler-file',
    title: 'Invoices',
    subtitle: 'Manage Accounts',
    to: { name: 'invoices' },
  },
  {
    icon: 'tabler-user',
    title: 'Users',
    subtitle: 'Manage Users',
    to: {
      name: 'users',
    },
  },
  
  {
    icon: 'tabler-settings',
    title: 'Settings',
    subtitle: 'Account Settings',
    to: {
      name: 'settings-account',
    },
  },
  {
    icon: 'tabler-help',
    title: 'Customers',
    subtitle: 'Manage Customers',
    to: { name: 'customers' },
  },
]
</script>

<template>
  <Shortcuts :shortcuts="shortcuts" />
</template>
