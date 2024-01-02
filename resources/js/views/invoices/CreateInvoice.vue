<script setup>
import useInvoices from "@/composables/invoices"
import useCustomers from "@/composables/customers"
import currencies from "@core/utils/currencies"
import paymentMethods from "@core/utils/paymentMethods"
import { requiredValidator } from "@validators"
import { formatCurrency } from "@core/utils/formatters"
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import moment from 'moment'

const {
  customers,
  isLoading,
  fetchCustomersList,
} = useCustomers()

const { storeInvoice, respResult, isLoading: invoiceLoading } = useInvoices()


onMounted(() => {
  fetchCustomersList()
})

const initialState = {
  due_date: moment().add(15, 'days').format('YYYY-MM-DD'),
  invoice_date: '',
  total: 0,
  customer: {
    id: "",
    name: "",
    address: "",
    phone: "",
    email: "",
  },
  subtotal: 0,
  tax_percentage: 0,
  tax_amount: 0,
  vat_percentage: 0,
  vat_amount: 0,
  note: "",
  payment_method: "Authorize.net",
  status: "Draft",
  items: [
    {
      id: 1,
      quantity: 0,
      description: "",
      item_code: "",
      cost: 0,
      total: 0,
    },
  ],
}

const invoiceData = ref({ ...initialState })
const refForm = ref()
const currency = ref({})
const selectedCustomer = ref({})

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
    parseFloat(invoiceData.value.tax_amount)+
    parseFloat(invoiceData.value.vat_amount)
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

  const taxPercentage = parseInt(invoiceData.value.tax_percentage)
  if (taxPercentage > 0 && invoiceData.value.subtotal > 0) {
    invoiceData.value.tax_amount = parseFloat(
      (invoiceData.value.subtotal * taxPercentage) / 100,
    )
  }
  calculateTotal()
}

const calculateVatTax = () => {
  invoiceData.value.vat_amount = 0

  const vatPercentage = parseInt(invoiceData.value.vat_percentage)
  if (vatPercentage > 0 && invoiceData.value.subtotal > 0) {
    invoiceData.value.vat_amount = parseFloat(
      (invoiceData.value.subtotal * vatPercentage) / 100,
    )
  }
  calculateTotal()
}


const generateItemTotal = index => {
  const item = invoiceData.value.items[index]
  const { cost, quantity } = item

  item.total = parseInt(cost) * parseInt(quantity)
  calculateSubTotal()
}

const resetFormData = () => {
  invoiceData.value = {
    ...initialState,
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
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
      formNewData.append("tax_percentage", invoiceData.value.tax_percentage)
      formNewData.append("tax_amount", invoiceData.value.tax_amount)
      formNewData.append("vat_amount", invoiceData.value.vat_amount)
      formNewData.append("vat_percentage", invoiceData.value.vat_percentage)
      formNewData.append("note", invoiceData.value.note ?? "")
      formNewData.append("payment_method", invoiceData.value.payment_method)
      formNewData.append("status", invoiceData.value.status)

      for (let index = 0; index < items.length; index++) {
        formNewData.append(`items[${index}][quantity]`, items[index].quantity)
        formNewData.append(
          `items[${index}][description]`,
          items[index].description,
        )
        formNewData.append(`items[${index}][cost]`, items[index].cost)
        formNewData.append(`items[${index}][total]`, items[index].total)
      }
      await storeInvoice(formNewData)
      if (respResult.value.status === 200) {
        resetFormData()
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
    cost: 0,
    total: 0,
  })
}

const removeProduct = id => {
  invoiceData.value.items.splice(id, 1)
}
</script>

<template>
  <VForm
    ref="refForm"
    @submit.prevent="onSubmit"
  >
    <VRow>
      <!-- 👉 InvoiceEditable -->
      <VCol
        cols="12"
        md="9"
      >
        <VCard>
          <h2 class="p-4 text-center pt-2">
            New Invoice
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
                />

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
                      <tr >
                        <td class="pe-6">
                          Address:
                        </td>
                        <td v-if="selectedCustomer.billing">
                          {{ selectedCustomer.billing.address_street_1 }}
                          {{ selectedCustomer.billing.city }}
                          {{ selectedCustomer.billing.state }}
                          {{ selectedCustomer.billing.country_name }}
                          {{ selectedCustomer.billing.zip }}
                        </td>
                      </tr>
                      <tr >
                        <td class="pe-6">
                          Phone:
                        </td>
                        <td v-if="selectedCustomer.billing">{{ selectedCustomer.billing.phone }}</td>
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
                  <span class="text-sm"> Description </span>
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
              :key="product.title"
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
                      <VTextarea
                        v-model="product.description"
                        :rules="[requiredValidator]"
                        rows="1"
                        label="Description"
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

          <VCardText class="d-flex justify-space-between flex-wrap flex-column flex-sm-row ma-sm-2">
            <VRow>
              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="invoiceData.vat_percentage"
                  label="VAT Tax (%)"
                  :rules="[requiredValidator]"
                  type="number"
                  min="0"
                  max="100"
                  @update:model-value="calculateVatTax"
                />
              </VCol>
              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="invoiceData.tax_percentage"
                  label="Select Tax (%)"
                  :rules="[requiredValidator]"
                  type="number"
                  min="0"
                  max="100"
                  @update:model-value="calculateTax"
                />
              </VCol>
            </VRow>
          </VCardText>

          <!-- 👉 Total Amount -->
          <VCardText class="d-flex justify-space-between flex-wrap flex-column flex-sm-row">
            <div class="mx-sm-4 my-2" />

            <div class="my-2 mx-sm-4">
              <table>
                <tr>
                  <td class="text-end">
                    <div class="me-5">
                      <p class="mb-2">
                        Subtotal:
                      </p>
                      <p class="mb-2">
                        Tax:
                      </p>
                      <p class="mb-2">
                        VAT:
                      </p>
                      <p class="mb-2">
                        Total:
                      </p>
                    </div>
                  </td>
                  <td class="font-weight-semibold">
                    <p class="mb-2">
                      {{
                        formatCurrency(
                          invoiceData.subtotal,
                          currency.code ?? "USD"
                        )
                      }}
                    </p>
                    <p class="mb-2">
                      {{
                        formatCurrency(
                          invoiceData.tax_amount,
                          currency.code ?? "USD"
                        )
                      }}
                    </p>
                    <p class="mb-2">
                      {{
                        formatCurrency(
                          invoiceData.vat_amount,
                          currency.code ?? "USD"
                        )
                      }}
                    </p>
                    <p class="mb-2">
                      {{
                        formatCurrency(
                          invoiceData.total,
                          currency.code ?? "USD"
                        )
                      }}
                    </p>
                  </td>
                </tr>
              </table>
            </div>
          </VCardText>

          <VDivider />

          <VCardText class="mx-sm-4">
            <p class="font-weight-semibold mb-2 mt-2">
              Note:
            </p>
            <VTextarea
              v-model="invoiceData.note"
              clearable
              placeholder="Enter your note here..."
              clear-icon="tabler-circle-x"
            />
          </VCardText>
        </VCard>
      </VCol>
      <VCol
        cols="12"
        md="3"
      >
        <div class="mt-13">
          <VSelect
            v-model="invoiceData.payment_method"
            :items="paymentMethods"
            label="Payment Method"
            class="mb-6"
          />

          <!--
            <VSelect
            v-model="currency.code"
            label="Currency"
            :items="currencies"
            :menu-props="{ maxHeight: 500 }"
            class="mb-6"
            />
          -->
          <VSelect
            v-model="invoiceData.status"
            label="Status"
            :items="['Draft', 'Sent', 'Paid', 'Overdue']"
            :menu-props="{ maxHeight: 500 }"
            class="mb-6"
          />
        </div>
        <div class="d-flex flex-wrap gap-4 justify-end pt-4 pb-4">
          <VBtn
            block
            type="submit"
            prepend-icon="tabler-file"
            :loading="invoiceLoading"
            :disabled="invoiceLoading"
            @click="refForm?.validate()"
          >
            Create Invoice
          </VBtn>
          <VBtn
            block
            prepend-icon="tabler-arrow-left"
            color="secondary"
            variant="tonal"
            :to="{ name: 'invoices' }"
          >
            Back to Invoices
          </VBtn>
        </div>
      </VCol>
    </VRow>
  </VForm>
</template>