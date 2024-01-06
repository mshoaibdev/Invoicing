<script setup>
import useCustomers from '@/composables/customers'
import useInvoices from '@/composables/invoices'
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { formatCurrency } from '@core/utils/formatters'
import ability from '@/plugins/casl/ability'


const emit = defineEmits([
  'update:isDialogVisible',
  'editCustomer',
  'deleteCustomer',
])

const router = useRoute()

const customerId = router.params.id

console.log(customerId)

const { invoices, totalRecords, isLoading, fetchInvoices, currentPage, headers, deleteInvoice, itemsPerPage, searchQuery, paginationData, filters, resolveInvoiceStatusVariantAndIcon } = useInvoices()
const selectedRows = ref([])
const invoiceId = ref(0)
const invoice = ref({})


const { getCustomer, customerData } = useCustomers()

// mount
onMounted(async () => {
  filters.customerId = customerId
  await getCustomer(customerId)
  await fetchInvoices()
})
</script>

<template>
  <div>
    <VCard>
      <VCardText>
        <VRow>
          <VCol 
            cols="12"
            lg="12"
            md="12"
            sm="12"
          >
            <p class="text-sm text-uppercase text-disabled">
              Customer Details
            </p>

            <VTable>
              <tbody>
                <tr>
                  <th>
                    Customer Name:
                  </th>
                  <td>
                    {{ customerData.name }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Email:
                  </th>
                  <td>
                    <a :href="`mailto:${customerData.email}`">{{ customerData.email }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Phone:
                  </th>
                  <td>
                    <a :href="`tel:${customerData?.billing?.phone}`">{{ customerData?.billing?.phone }}</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Billing Address :
                  </th>
                  <td />
                </tr>

                <tr>
                  <th>
                    Name
                  </th>
                  <td>
                    {{ customerData?.billing?.name }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Address
                  </th>
                  <td>
                    {{ customerData?.billing?.address_street_1 }}
                  </td>
                </tr>

                <tr>
                  <th>
                    City
                  </th>
                  <td>
                    {{ customerData?.billing?.city }}
                  </td>
                </tr>

                <tr>
                  <th>
                    State
                  </th>
                  <td>
                    {{ customerData?.billing?.state }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Zip
                  </th>
                  <td>
                    {{ customerData?.billing?.zip }}
                  </td>
                </tr>
               
                <tr>
                  <th>
                    Date Added:
                  </th>
                  <td>
                    {{ customerData.created_at }}
                  </td>
                </tr>
              </tbody>
            </VTable>
          </VCol>
        </VRow>
      </VCardText>
    </VCard>

    <VCard class="mt-4">
      <VCardText class="d-flex align-center flex-wrap gap-4">
        <VRow>
          <VCol
            lg="3"
            md="3"
            sm="4"
            cols="12"
          >
            <div class="me-3 d-flex gap-3">
              <VBtn
                v-if="ability.can('Create', 'invoices-create')"
                prepend-icon="tabler-plus"
                :to="{ name: 'create-invoice' }"
              >
                Create Invoice
              </VBtn>
            </div>
          </VCol>
          <VCol
            offset="6"
            lg="3"
            md="3"
            cols="12"
            sm="6"
          >
            <AppTextField
              v-model="searchQuery"
              label="Search Invoices"
              density="compact"
            />
          </VCol>
        </VRow>
      </VCardText>


      <VDivider />
      <VCardText title="Invoices">
        <VDataTableServer
          v-model="selectedRows"
          v-model:items-per-page="itemsPerPage"
          v-model:page="currentPage"
          :loading="isLoading"
          :items-length="totalRecords"
          :headers="headers"
          :items="invoices"
          class="text-no-wrap"
        >
          <template #item.invoice_id="{ item }">
            <div class="d-flex align-center">
              <VAvatar
                variant="tonal"
                class="me-3"
                size="38"
                color="primary"
              >
                <VImg
                  v-if="item.raw.company"
                  :src="item.raw.company.logo_url"
                />
                <span v-else>{{
                  item.raw.company?.name
                }}</span>
              </VAvatar>

              <div class="d-flex flex-column">
                <h6 class="text-base">
                  {{ item.raw.company?.name }}
                </h6>
                <span class="text-sm text-disabled">{{
                  item.raw.invoice_id
                }}</span>
              </div>
            </div>
          </template>
      

          <template #item.customer.email="{ item }">
            <a
              :href="`mailto:${item.raw.customer.email}`"
              class="text-decoration-none"
            >
              {{ item.raw.customer.email }}
            </a>
          </template>


          <template #item.customer.phone="{ item }">
            <a
              :href="`tel:${item.raw.customer.phone}`"
              class="text-decoration-none"
            >
              {{ item.raw.customer.phone }}
            </a>
          </template>

      
          <template #item.total="{ item }">
            <div class="d-flex align-center">
              <span class="me-3">
                {{ formatCurrency(item.raw.total) }}
              </span>
            </div>
          </template>

          <template #item.status="{ item }">
            <div class="d-flex align-center">
              <VTooltip>
                <template #activator="{ props }">
                  <VAvatar
                    :size="30"
                    v-bind="props"
                    :color="
                      resolveInvoiceStatusVariantAndIcon(item.raw.status)
                        .variant
                    "
                    variant="tonal"
                  >
                    <VIcon
                      :size="20"
                      :icon="
                        resolveInvoiceStatusVariantAndIcon(item.raw.status)
                          .icon
                      "
                    />
                  </VAvatar>
                </template>

                <p class="mb-0">
                  {{ item.raw.status }}
                </p>
              </VTooltip>
            </div>
          </template>

          <template #item.title="{ item }">
            <div class="d-flex align-center">
              <a
                href="javascript:;" 
              
                @click="viewInvoice(item.raw.id)"
              >
                {{ item.raw.title }}
              </a>
            </div>
          </template>
            
          <template #item.actions="{ item }">
            <IconBtn density="compact">
              <VIcon icon="tabler-dots-vertical" />

              <VMenu activator="parent">
                <VList>
                  <VListItem 
                    :to="{
                      name: 'edit-invoice',
                      params: { id: item.raw.id },
                    }"
                  >
                    <VIcon icon="tabler-pencil" /> Edit Invoice  
                  </VListItem>

                  <VListItem
                    v-if="item.raw.status !== 'Paid' && item.raw.payment_method.is_gateway"
                    @click="sendInvoice(item.raw)"
                  >
                    <VIcon icon="tabler-send" /> Send Invoice  
                  </VListItem>
                  <VListItem
                    :href="item.raw.invoice_link"
                    target="_blank"
                    rel="noopener noreferrer"
                    download
                  >
                    <VIcon icon="tabler-download" /> Download Invoice  
                  </VListItem>
                  <VListItem @click="viewInvoice(item.raw.id)">
                    <VIcon icon="tabler-eye" /> View Invoice  
                  </VListItem>
                  <VListItem
                    v-if="ability.can('Delete', 'invoices-delete')"
                    @click="deleteInvoiceConfirm(item.raw.id)"
                  >
                    <VIcon icon="tabler-trash" /> Delete Invoice  
                  </VListItem>
                </VList>
              </VMenu>
            </IconBtn>
          </template>
        </VDataTableServer>
      </VCardText>
    </VCard>
  </div>
</template>

<style scoped>
th,td {
  padding: 0rem !important;
}
</style>
