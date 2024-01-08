<script setup>
import useInvoices from "@/composables/invoices"
import useCustomers from "@/composables/customers"
import usePaymentMethods from '@/composables/paymentMethods'
import useTaxTypes from '@/composables/taxTypes'

import { requiredValidator } from "@validators"
import { formatCurrency } from "@core/utils/formatters"
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import SendInvoiceDialog from './SendInvoice.vue'

const {
  customers,
  isLoading,
  fetchCustomersList,
} = useCustomers()

const { updateInvoice, respResult, isLoading: invoiceLoading, getInvoice, invoiceData: invoiceItem } = useInvoices()
const { fetchPaymentMethodsList, paymentMethods, isLoading: paymentMethodsLoading } = usePaymentMethods()
const { fetchTaxTypesList, taxTypes, isLoading: taxTypeLoading } = useTaxTypes()


const route = useRoute()
const invoiceId = route.params.id
const isSendInvoiceDialogVisible = ref(false)
const refForm = ref()
const currency = ref({})
const selectedCustomer = ref({})
const selectedTaxes = ref([])

const invoiceData = ref({
  invoice_date: '',
  due_date: '',
})

onMounted(async() => {
  await fetchCustomersList()
  await getInvoice(invoiceId)
  await fetchPaymentMethodsList()
  await fetchTaxTypesList()
  invoiceData.value = {
    ...invoiceItem.value,
  }

  if(invoiceData.value.taxes){
    selectedTaxes.value = invoiceData.value.taxes.map(tax => {
      return {
        id: tax.tax_type.id,
        name: tax.tax_type?.name,
        tax_percentage: tax.tax_percentage,
        tax_amount: tax.tax_amount,
      }
    })
  }

  if(invoiceData.value.customer_id){
    selectCustomer(invoiceData.value.customer_id)
  }
 
})



const selectCustomer = customerId => {

  const customer = customers.value.find(customer => customer.id === customerId)
  
  currency.value = customer.currency

  selectedCustomer.value = {
    id: customer.id,
    name: customer.name,
    phone: customer.phone,
    email: customer.email,
    billing: customer.billing,
  }
}


const calculateTotal = () => {
  invoiceData.value.total = 0
  invoiceData.value.total =
    parseFloat(invoiceData.value.subtotal) +
    parseFloat(invoiceData.value.tax_amount)
}

const calculateSubTotal = () => {
  invoiceData.value.subtotal = 0
  invoiceData.value.items.forEach(item => {
    invoiceData.value.subtotal += parseFloat(item.total)
  })
  calculateTax()
}

const calculateTax = () => {
  invoiceData.value.tax_amount = 0

  selectedTaxes.value.forEach(tax => {
    invoiceData.value.tax_amount += parseFloat(tax.tax_amount)
  })


  calculateTotal()
}


const calculateTaxType = tax => {

  const taxType = selectedTaxes.value.find(taxType => taxType.id === tax.id)

  const taxPercentage = parseInt(tax.tax_percentage)
  if (taxPercentage > 0 && invoiceData.value.subtotal > 0) {
    taxType.tax_amount = parseFloat(
      (invoiceData.value.subtotal * taxPercentage) / 100,
    )
  }
  calculateSubTotal()
  calculateTax()
  calculateTotal()
}

const calculateTaxAmount = () => {

  selectedTaxes.value.forEach(tax => {
    const taxPercentage = parseInt(tax.tax_percentage)
    if (taxPercentage > 0 && invoiceData.value.subtotal > 0) {
      tax.tax_amount = parseFloat(
        (invoiceData.value.subtotal * taxPercentage) / 100,
      )
    }
  })

  calculateTotal()
}

const generateItemTotal = index => {
  const item = invoiceData.value.items[index]
  const { cost, quantity } = item

  item.total = parseInt(cost) * parseInt(quantity)
  calculateSubTotal()

  calculateTaxAmount()
}



const onSubmit = async () => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid) {
      const formNewData = new FormData()
      const items = invoiceData.value.items

      formNewData.append("customer_id", invoiceData.value.customer_id)
      formNewData.append("due_date", invoiceData.value.due_date)
      formNewData.append("invoice_date", invoiceData.value.invoice_date)
      formNewData.append("total", invoiceData.value.total)
      formNewData.append("subtotal", invoiceData.value.subtotal)
      formNewData.append("tax_amount", invoiceData.value.tax_amount)
      formNewData.append("note", invoiceData.value.note ?? "")
      formNewData.append("terms", invoiceData.value.terms ?? "")
      formNewData.append("payment_method_id", invoiceData.value.payment_method_id)
      formNewData.append("status", invoiceData.value.status)

      if(selectedTaxes.value.length > 0){
        for (let index = 0; index < selectedTaxes.value.length; index++) {
          formNewData.append(
            `tax_types[${index}][tax_type_id]`,
            selectedTaxes.value[index].id,
          )
          formNewData.append(
            `tax_types[${index}][tax_percentage]`,
            selectedTaxes.value[index].tax_percentage,
          )
          formNewData.append(
            `tax_types[${index}][tax_amount]`,
            selectedTaxes.value[index].tax_amount,
          )
        }
      }

      for (let index = 0; index < items.length; index++) {
        formNewData.append(`items[${index}][quantity]`, items[index].quantity)
        formNewData.append(
          `items[${index}][description]`,
          items[index].description ?? "",
        )
        formNewData.append(`items[${index}][title]`, items[index].title)
        formNewData.append(`items[${index}][cost]`, items[index].cost)
        formNewData.append(`items[${index}][total]`, items[index].total)
      }
      formNewData.append("_method", "PUT")
      await updateInvoice(
        invoiceId,
        formNewData,
      )
      if (respResult.value.status === 200) {
      }
    } else {
      toast.error("Form contains error, please check again")
    }
  })
}

// 👉 Add item function
const addItem = () => {
  invoiceData.value.items.push({
    id: invoiceData.value.items.length + 1,
    quantity: 0,
    description: "",
    title: "",
    cost: 0,
    total: 0,
  })
}


const addTax = tax => {
  selectedTaxes.value.push({
    id: tax.id,
    name: tax.name,
    tax_percentage: 0,
    tax_amount: 0,
  })

  calculateTax()
}


const removeTaxType = index => {
  selectedTaxes.value.splice(index, 1)
  calculateTax()
}

const removeProduct = id => {
  invoiceData.value.items = invoiceData.value.items.filter(
    item => item.id !== id,
  )
  calculateSubTotal()
}
</script>

<template>
  <VForm
    ref="refForm"
    @submit.prevent="onSubmit"
  >
    <div
      v-if="!invoiceData.customer_id"
      class="text-center pa-12"
    >
      <VProgressCircular
        :width="3"
        :size="70"
        indeterminate
      />
    </div>
    <VRow v-else>
      <!-- 👉 InvoiceEditable -->
      <VCol
        cols="12"
        md="9"
      >
        <VCard>
          <h2 class="p-4 text-center pt-2">
            Edit Invoice
          </h2>

          <VCardText>
            <VRow>
              <VCol
                cols="12"
                md="4"
              >
                <h6 class="text-sm font-weight-medium mb-3">
                  Select Customer:
                </h6>
                <VAutocomplete
                  v-model="invoiceData.customer_id"
                  :items="customers"
                  item-title="name"
                  item-value="id"
                  placeholder="Select Customer"
                  :loading="isLoading"
                  :rules="[requiredValidator]"
                  :menu-props="{ maxHeight: 300 }"
                  density="compact"
                  @update:model-value="selectCustomer"
                >
                  <template #item="{ props, item }">
                    <VListItem
                      v-bind="props"
                      :subtitle="item.raw.email"
                    />
                  </template>
                </VAutocomplete>
                

                <div
                  v-if="selectedCustomer"
                  class="scrollable-table"
                >
                  <h6 class="text-sm font-weight-medium  mt-2">
                    Billed To:
                  </h6>
                  <table class="text-sm">
                    <tbody>
                      <tr class="mobileCardSize">
                        <td class="pe-6">
                          Name:
                        </td>
                        <td class="font-weight-semibold">
                          {{ selectedCustomer.name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="pe-6">
                          Address:
                        </td>
                        <td v-if="selectedCustomer.billing">
                          {{ selectedCustomer.billing.address_street_1 }}
                          {{ selectedCustomer.billing.city }}
                          {{ selectedCustomer.billing.state }}
                          {{ selectedCustomer.billing.zip }} <br>
                          {{ selectedCustomer.billing.country_name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="pe-6">
                          Phone:
                        </td>
                        <td v-if="selectedCustomer.billing">
                          {{ selectedCustomer.billing.phone }}
                        </td>
                      </tr>
                      <tr>
                        <td class="pe-6">
                          Email:
                        </td>
                        <td>{{ selectedCustomer.email }}</td>
                      </tr>
                    </tbody>
                  </table>  
                </div>
              </VCol>
              <VCol
                offset="4"
                cols="12"
                md="4"
              >
                <VRow>
                  <VCol
                    cols="12"
                    md="12"
                  >
                    <span class="me-3">Date of Invoice</span>
                    <AppDateTimePicker
                      v-model="invoiceData.invoice_date"
                      :rules="[requiredValidator]"
                      density="compact"
                      placeholder="DD-MM-YYYY"
                      :config="{
                        position: 'auto right',
                        dateFormat: 'Y-m-d',
                        disableMobile: true,
                      }"
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    md="12"
                  >
                    <span class="me-3">Due Date </span>
                    <AppDateTimePicker
                      v-model="invoiceData.due_date"
                      :rules="[requiredValidator]"
                      density="compact"
                      placeholder="DD-MM-YYYY"
                      :config="{
                        position: 'auto right',
                        dateFormat: 'Y-m-d',
                        disableMobile: true,
                      }"
                    />
                  </VCol>
                </VRow>
              </VCol>
            </VRow>
          </VCardText>

          <VDivider />

          <!-- 👉 Add purchased products -->
          <VCardText class="add-products-form">
            <div class="add-products-header mb-2 d-none d-md-flex">
              <VRow class="font-weight-medium px-4">
                <VCol
                  cols="12"
                  md="6"
                >
                  <span class="text-sm"> Product Name </span>
                </VCol>
                <VCol
                  cols="12"
                  md="2"
                >
                  <span class="text-sm"> Quantity </span>
                </VCol>
                <VCol
                  cols="12"
                  md="2"
                >
                  <span class="text-sm"> Cost per item </span>
                </VCol>
                <VCol
                  cols="12"
                  md="2"
                >
                  <span class="text-sm"> Total </span>
                </VCol>
              </VRow>
            </div>
            <div
              v-for="(product, index) in invoiceData.items"
              :key="index"
              class="ma-sm-2 mb-2"
            >
              <VCard
                flat
                border
                class="d-flex flex-row"
              >
                <!-- 👉 Left Form -->
                <div class="pa-5 flex-grow-1">
                  <VRow>
                    <VCol
                      cols="12"
                      md="6"
                    >
                      <VTextField
                        v-model="product.title"
                        :rules="[requiredValidator]"
                        label="Title"
                      />
                    </VCol>
                   
                    <VCol
                      cols="12"
                      md="2"
                    >
                      <VTextField
                        v-model="product.quantity"
                        :rules="[requiredValidator]"
                        type="number"
                        label="Quantity"
                        min="0"
                        @update:model-value="generateItemTotal(index)"
                      />
                    </VCol>
                    <VCol
                      cols="12"
                      md="2"
                    >
                      <VTextField
                        v-model="product.cost"
                        :rules="[requiredValidator]"
                        type="number"
                        min="0"
                        label="Cost per item"
                        @update:model-value="generateItemTotal(index)"
                      />
                    </VCol>
                    <VCol
                      cols="12"
                      md="2"
                      sm="4"
                    >
                      <p class="text-sm-center my-2">
                        <span class="d-inline d-md-none">Price: </span>
                        <span class="text-body-1">{{
                          formatCurrency(
                            product.total,
                            currency.code ?? "USD"
                          )
                        }}</span>
                      </p>
                    </VCol>

                    <VCol
                      cols="12"
                      md="12"
                    >
                      <VTextarea
                        v-model="product.description"
                        rows="3"
                        label="Description"
                      />
                    </VCol>
                  </VRow>
                </div>

                <!-- 👉 Item Actions -->
                <div class="d-flex flex-column justify-space-between border-s pa-1">
                  <VBtn
                    icon
                    size="x-small"
                    color="default"
                    variant="text"
                    :disabled="index === 0"
                    @click="removeProduct"
                  >
                    <VIcon
                      size="20"
                      icon="tabler-x"
                    />
                  </VBtn>
                </div>
              </VCard>
            </div>

            <div class="mt-4 ma-sm-2">
              <VBtn @click="addItem">
                Add Item
              </VBtn>
            </div>
          </VCardText>

          <VDivider />

          <VCardText class="d-flex justify-end flex-wrap flex-column">
            <VRow>
              <VCol
                cols="12"
                md="6"
              >
                <p class="font-weight-semibold mb-2 mt-2">
                  Note:
                </p>
                <VTextarea
                  v-model="invoiceData.note"
                  clearable
                  placeholder="Enter your note here..."
                  clear-icon="tabler-circle-x"
                />
              </VCol>
              <VCol
                cols="12"
                md="4"
                offset="2"
              >
                <div class="d-flex justify-space-between gap-3">
                  <p class="font-weight-bold mb-2">
                    Sub Total:
                  </p>

                  
                  <p class="text-body-1">
                    {{
                      formatCurrency(
                        invoiceData.subtotal,
                        currency.code ?? "USD"
                      )
                    }}
                  </p>
                </div>

                <div v-if="selectedTaxes">
                  <VRow
                    v-for="(selectedTax, index) in selectedTaxes"
                    :key="index"
                  
                    class="mt-3"
                  >
                    <VDivider />
                    <VCol
                      cols="12"
                      md="6"
                    >
                      <p class="font-weight-bold mb-2">
                        {{ selectedTax.name }} ({{ selectedTax.tax_percentage }}%)
                      </p>
                    </VCol>
                    <VCol
                      cols="12"
                      md="6"
                    >
                      <VTextField
                        v-model="selectedTax.tax_percentage"
                        label="Enter Tax Percentage"
                        :rules="[requiredValidator]"
                        type="number"
                        variant="underlined"
                        min="0"
                        max="100"
                        @update:model-value="calculateTaxType(selectedTax)"
                      />
                    </VCol>

                    <VCol
                      cols="12"
                      md="12"
                    >
                      <p class="text-body-1 text-end">
                        {{
                          formatCurrency(
                            selectedTax.tax_amount,
                            currency.code ?? "USD"
                          )
                        }}
                        <VBtn
                          icon
                          size="x-small"
                          color="default"
                          variant="text"
                          @click="removeTaxType(index)"
                        >
                          <VIcon
                            size="20"
                            icon="tabler-x"
                          />
                        </VBtn>
                      </p>
                    </VCol>
                  </VRow>
                  <VDivider />
                </div>

                <div class="d-flex justify-end gap-3">
                  <VBtn
                    color="primary"
                    variant="plain"
                    prepend-icon="tabler-plus"
                    class="px-0"
                  >
                    Add Tax
                    <VMenu
                      activator="parent"
                      offset-y
                      width="200"
                    >
                      <VList>
                        <VListItem
                          v-for="(item, index) in taxTypes"
                          :key="index"
                          :value="index"
                          :disabled="selectedTaxes.some(tax => tax.id === item.id)"
                          @click="addTax(item)"
                        >
                          <VListItemTitle>{{ item.name }}</VListItemTitle>
                          <VListItemSubtitle>{{ item.description }}</VListItemSubtitle>
                        </VListItem>
                      </VList>
                    </VMenu>
                  </VBtn>
                </div>

                <VDivider />


                <div class="d-flex justify-space-between gap-3 mt-2">
                  <h3 class="font-weight-bold mb-2">
                    Total:
                  </h3>
                  <p class="text-body-1">
                    {{
                      formatCurrency(
                        invoiceData.total,
                        currency.code ?? "USD"
                      )
                    }}
                  </p>
                </div>
              </VCol>
            </VRow>
          </VCardText>

          <VDivider />

          <VCardText>
            <p class="font-weight-semibold mb-2 mt-2">
              Terms and Conditions:
            </p>
            <VTextarea
              v-model="invoiceData.terms"
              clearable
              placeholder="Enter your terms here..."
              clear-icon="tabler-circle-x"
            />
          </VCardText>
        </VCard>
      </VCol>
      <VCol
        cols="12"
        md="3"
      >
        <VCardText>
          <h6 class="font-weight-medium text-h5 mb-3">
            Invoice #{{ invoiceData.invoice_id }}
          </h6>
                
          <VSelect
            v-model="invoiceData.payment_method_id"
            :items="paymentMethods"
            :rules="[requiredValidator]"
            :loading="paymentMethodsLoading"
            item-title="name"
            item-value="id"
            label="Payment Method"
            class="mb-6"
          />

       
          <VBtn
            block
            type="submit"
            prepend-icon="tabler-edit"
            :loading="invoiceLoading"
            :disabled="invoiceLoading"
            class="mb-2"
            @click="refForm?.validate()"
          >
            Update Invoice
          </VBtn>


          <!-- 👉 Send Invoice Trigger button -->
          <VBtn
            v-if="invoiceData.status === 'Draft' || invoiceData.status === 'Sent'"
            block
            prepend-icon="tabler-send"
            class="mb-2"
            @click="isSendInvoiceDialogVisible = true"
          >
            Send Invoice
          </VBtn>

          
       

          <VBtn
            block
            class="mb-2"
            prepend-icon="tabler-download"
            :href="invoiceData.invoice_link"
            target="_blank"
            rel="noopener noreferrer"
          >
            Download Invoice
          </VBtn>

          <VBtn
            block
            prepend-icon="tabler-arrow-left"
            color="secondary"
            class="mb-2"
            variant="tonal"
            :to="{ name: 'invoices' }"
          >
            Back to Invoices
          </VBtn>
        </VCardText>
      </VCol>
    </VRow>
    <SendInvoiceDialog
      v-if="isSendInvoiceDialogVisible"
      v-model:isDialogVisible="isSendInvoiceDialogVisible"
      :invoice="invoiceData"
    />
  </VForm>
</template>
