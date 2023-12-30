<script setup>
import axios from '@axios'

import useCompanies from '@/composables/companies'

import {
  requiredValidator,
} from '@validators'

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

const { storeCompany, errors, respResult, isLoading } = useCompanies()

const refForm = ref()
const refInputEl = ref()
const logoPreview = ref('')

const initialState = {
  name: '',
  currency_id: 1,
  country_id: 231,
  logo: '',
}

// countries

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


const formData = ref({ ...initialState })

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

      const obj = new FormData()

      obj.append('name', formData.value.name)
      obj.append('country_id', formData.value.country_id)
      obj.append('currency_id', formData.value.currency_id)
      if(formData.value.logo){
        obj.append('logo', formData.value.logo)
      }
      await storeCompany(obj)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}

const changeAvatar = file => {
  const fileReader = new FileReader()
  const { files } = file.target
  if (files && files.length) {
    fileReader.readAsDataURL(files[0])
    fileReader.onload = () => {
      formData.value.logo = files[0]
      if (typeof fileReader.result === 'string')
        logoPreview.value = fileReader.result
    }
  }
}


const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 600"
    :model-value="props.isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New Company">
      <VCardText>
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="12"
            >
              <VCardText class="d-flex justify-center border">
                <VAvatar
                  rounded
                  size="120"
                  class="me-6 border"
                  :image="logoPreview"
                />

                <div class="d-flex flex-column justify-center gap-2 align-center">
                  <div class="d-flex flex-wrap gap-2">
                    <VBtn
                      color="primary"
                      @click="refInputEl?.click()"
                    >
                      <VIcon
                        icon="tabler-cloud-upload"
                        class="d-sm-none"
                      />
                      <span class="d-none d-sm-block">Upload logo</span>
                    </VBtn>

                    <input
                      ref="refInputEl"
                      type="file"
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
            </VCol>
            <VCol
              cols="12"
              md="12"
            >
              <label class="text-body-1">Company Name <span class="color-red">*</span></label>
              <VTextField
                v-model="formData.name"
                :rules="[requiredValidator]"
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
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isLoading"
                :disabled="isLoading"
                @click="refForm?.validate()"
              >
                Save
                <VIcon
                  icon="tabler-download"
                  class="ms-2"
                />
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
