
<script setup>
import useAccount from '@/composables/account'
import ability from '@/plugins/casl/ability'

const { fetchDashboardStats } = useAccount()

const totalCustomers = ref(0)
const totalEstimates = ref(0)
const totalInvoices = ref(0)



onMounted( async () => {
  const resp =  await fetchDashboardStats()

  totalCustomers.value = resp.data.totalCustomers
  totalEstimates.value = resp.data.totalEstimates
  totalInvoices.value = resp.data.totalInvoices
})
</script>

<template>
  <VRow class="match-height">
    <VCol
      v-if="ability.can('Read', 'customers-list')"
      cols="12"
      sm="6"
      md="4"
    >
      <RouterLink :to="{name: 'customers'}">
        <VCard>
          <VCardText class="d-flex align-center justify-space-between">
            <div>
              <div class="d-flex align-center flex-wrap">
                <span class="text-h5">
                  {{ totalCustomers }}
                </span>
              </div>
              <span class="text-body-2">
                Total customers
              </span>
            </div>

            <VAvatar
              icon="tabler-users"
              :size="42"
              variant="tonal"
            />
          </VCardText>
        </VCard>
      </RouterLink>
    </VCol>
    <VCol
      v-if="ability.can('Read', 'invoices-list')"
      cols="12"
      sm="6"
      md="4"
    >
      <RouterLink :to="{name: 'invoices'}">
        <VCard>
          <VCardText class="d-flex align-center justify-space-between">
            <div>
              <div class="d-flex align-center flex-wrap">
                <span class="text-h5">
                  {{ totalInvoices }}
                </span>
              </div>
              <span class="text-body-2">
                Total invoices
              </span>
            </div>

            <VAvatar
              icon="tabler-cash"
              :size="42"
              variant="tonal"
            />
          </VCardText>
        </VCard>
      </RouterLink>
    </VCol>
  </VRow>
</template>

