
<script setup>
import useAccount from '@/composables/account'
import ability from '@/plugins/casl/ability'
import MonthlyEarning from './charts/MonthlyEarning.vue'

const { fetchDashboardStats } = useAccount()

const totalCustomers = ref(0)
const totalInvoices = ref(0)
const totalDraftInvoices = ref(0)
const monthlySales = ref(null)
const companyCurrency = ref({})
import authBg from '@images/circuit100.jpg'



onMounted( async () => {
  const resp =  await fetchDashboardStats()

  totalCustomers.value = resp.data.totalCustomers
  totalInvoices.value = resp.data.totalInvoices
  totalDraftInvoices.value = resp.data.totalDraftInvoices
  companyCurrency.value = resp.data.companyCurrency

  monthlySales.value = resp.data.monthlySales
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
                  {{ totalDraftInvoices }}
                </span>
              </div>
              <span class="text-body-2">
                Draft invoices
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

    <VCol
      cols="12"
      sm="12"
      md="12"
    >
      <MonthlyEarning
        v-if="monthlySales"
        :monthly-sales="monthlySales"
        :company-currency="companyCurrency"
      />
    </VCol>

    <VCol
      cols="12"
      sm="12"
      md="12"
    >
    </VCol>
  </VRow>
</template>

<style>
.blank-space{
  min-height: 483px;
  background-image: url(@images/circuit100.jpg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
