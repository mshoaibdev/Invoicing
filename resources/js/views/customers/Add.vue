<script setup>
import useCustomers from '@/composables/customers'
import { emailValidator, requiredValidator } from '@validators'
import axios from '@axios'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { storeCustomer, errors, respResult, isLoading } = useCustomers()

const initialState = {
  name: '',
  email: '',
  phone: '',
  billing: {
    name: '',
    address_street_1: '',
    city: '',
    state: '',
    zip: '',
    country_id: '',
  },
  'currency_id': 1,
  'company_name': '',
  'website': '',
}

const formData = ref({ ...initialState })
const refForm = ref()
const countries = ref([])
const currencies = ref([])


const fetchCountries = async () => {
  try {
    const resp = await axios.get('/countries')

    countries.value = resp.data.data
  } catch (error) {
    console.log(error)
  }
}

const fetchCurrencies = async () => {
  try {
    const resp = await axios.get('/currencies')

    currencies.value = resp.data.data
  } catch (error) {
    console.log(error)
  }
}

onMounted(async () => {
  if(props.isDialogVisible){
    await fetchCountries()
    await fetchCurrencies()
  }
})


const resetFormData = () => {
  formData.value = {
    ...initialState,
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      const formNewData = new FormData()

      Object.keys(formData.value).forEach(key => {
        if (key === 'billing') {
          Object.keys(formData.value.billing).forEach(billingKey => {
            formNewData.append(`billing[${billingKey}]`, formData.value.billing[billingKey])
          })
        } else {
          formNewData.append(key, formData.value[key])
        }
      })
     
      await storeCustomer(formNewData)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 1000"
    :model-value="props.isDialogVisible"
    persistent
    @update:model-value="dialogModelValueUpdate"
  >
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New Customer">
      <VCardText>
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.name"
                label="Customer Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.email"
                label=" Email"
                :rules="[requiredValidator, emailValidator]"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.phone"
                label="Phone"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VSelect
                v-model="formData.currency_id"
                label="Currency"
                :rules="[requiredValidator]"
                :items="currencies"
                :item-title="item => `${item.code} - ${item.name} `"
                item-value="id"
              />
            </VCol>
            <VCol
              cols="12"
              md="12"
            >
              <span class="text-h6 font-weight-bold">Billing Address</span>
              <VDivider />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.billing.name"
                label="Name"
              />
            </VCol>
            

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.billing.address_street_1"
                label="Street 1"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.billing.city"
                label="City"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.billing.state"
                label="State"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.billing.zip"
                label="Zip"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VAutocomplete
                v-model="formData.billing.country_id"
                label="Country"
                item-title="name"
                item-value="id"
                :items="countries"
              />
            </VCol>

         

            <VCol
              cols="12"
              md="12"
            >
              <span class="text-h6 font-weight-bold">Company Details</span>
              <VDivider />
            </VCol>

            

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.company_name"
                label="Company Name"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.website"
                label="Website"
              />
            </VCol>


            <VCol
              cols="12"
              md="12"
            >
              <VTextarea
                v-model="formData.notes"
                clearable
                clear-icon="tabler-circle-x"
                label="Notes"
              />
            </VCol>

            <VCol
              cols="12"
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isLoading"
                :disabled="isLoading"
                @click="refForm?.validate()"
              >
                Create Customer
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="dialogModelValueUpdate(false)"
              >
                Cancel
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</template>
