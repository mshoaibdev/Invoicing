<script setup>
import useCompanies from '@/composables/companies'
import axios from '@axios'

import { requiredValidator } from '@validators'

const { updateCompany, errors, respResult, isLoading, currentCompany } = useCompanies()


const formData = ref({
  name: '',
  phone: '',
  last_name: '',
  currency_id: 1,
  country_id: 231,
  address: {
    address_street_1: '',
    city: '',
    state: '',
    zip: '',
    country_id: '',
  },
  logo: '',
})

const refForm = ref()
const refInputEl = ref('')
const logoFile = ref('')
const logoPreview = ref('')

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

onMounted( async () => {
  await currentCompany().then( async resp => {
    formData.value = resp.data.data
    logoPreview.value = formData.value.logo_url
  })
  await fetchCountries()
  await fetchCurrencies()
})


const changeAvatar = file => {
  const fileReader = new FileReader()
  const { files } = file.target
  if (files && files.length) {
    fileReader.readAsDataURL(files[0])
    logoFile.value = files[0]
    
    fileReader.onload = () => {
      if (typeof fileReader.result === 'string')
        logoPreview.value = fileReader.result
    }
  }
}


const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      const formNewData = new FormData()

      Object.keys(formData.value).forEach(key => {
        if (key === 'address') {
          Object.keys(formData.value.address).forEach(addressKey => {
            formNewData.append(`address[${addressKey}]`, formData.value.address[addressKey])
          })
        } else {
          formNewData.append(key, formData.value[key])
        }
      })
      
      if(logoFile.value && logoFile.value !== null){
        formNewData.append('logo', logoFile.value)
        formNewData.append('is_company_logo_removed', true)
      }

      formNewData.append('_method', 'PUT')
      await updateCompany( formData.value.id, formNewData)
    }
  })
}
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Company Information">
        <VCardText class="d-flex">
          <VAvatar
            rounded
            size="100"
            class="me-6"
            :image="logoPreview"
          />

          <div class="d-flex flex-column justify-center gap-4">
            <div class="d-flex flex-wrap gap-2">
              <VBtn
                color="primary"
                @click="refInputEl?.click()"
              >
                <VIcon
                  icon="tabler-cloud-upload"
                  class="d-sm-none"
                />
                <span class="d-none d-sm-block">Upload new logo</span>
              </VBtn>

              <input
                ref="refInputEl"
                type="file"
                name="file"
                accept=".jpeg,.png,.jpg,GIF"
                hidden
                @input="changeAvatar"
              >
            </div>

            <p class="text-body-1 mb-0">
              Allowed JPG, GIF or PNG. Max size of 10MB
            </p>
          </div>
        </VCardText>

        <VDivider />

        <VCardText class="pt-2">
          <!-- 👉 Form -->
          <VForm
            ref="refForm"
            class="mt-6"
            on-submit="return false;"
            @submit.prevent="onSubmit"
          >
            <VRow>
              <VCol
                md="6"
                cols="12"
              >
                <VTextField
                  v-model="formData.name"
                  label="Company Name"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.phone"
                  label="Phone Number"
                  name="phone"
                />
              </VCol>

          

              <VCol
                cols="12"
                md="12"
              >
                <label class="text-body-1">Select Country <span class="color-red">*</span></label>
                <VAutocomplete
                  v-model="formData.country_id"
                  :rules="[requiredValidator]"
                  :items="countries"
                  item-title="name"
                  item-value="id"
                  :loading="isLoading"
                />
              </VCol>
              <VCol
                cols="12"
                md="12"
              >
                <label class="text-body-1">Select Currency <span class="color-red">*</span></label>


                <VAutocomplete
                  v-model="formData.currency_id"
                  :rules="[requiredValidator]"
                  :items="currencies"
                  :item-title="item => `${item.code} - ${item.name} `"
                  item-value="id"
                  :loading="isLoading"
                />
              </VCol>
            

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.address.address_street_1"
                  label="Street 1"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.address.city"
                  label="City"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.address.state"
                  label="State"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.address.zip"
                  label="Zip"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VAutocomplete
                  v-model="formData.address.country_id"
                  label="Country"
                  item-title="name"
                  item-value="id"
                  :items="countries"
                />
              </VCol>


              <!-- 👉 Form Actions -->
              <VCol
                cols="12"
                class="d-flex flex-wrap gap-4"
              >
                <VBtn
                  type="submit"
                  :loading="isLoading"
                  :disabled="isLoading"
                  class="userbtnForMobileSize"
                >
                  <span class="fontForMobileSize">Save changes</span> 
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>

<style scoped lang="scss">
@use "@/@layouts/styles/mediaStyles.scss";

</style>
