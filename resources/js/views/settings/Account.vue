/* stylelint-disable CssSyntaxError */
<script setup>
import useAccount from '@/composables/account'
import { emailValidator, requiredValidator } from '@validators'
import axios from '@axios'


const { fetchAccount,  accountData, isLoading, updateAccount } = useAccount()

const formData = ref({
  first_name: '',
  last_name: '',
  email: '',
  address: {
    phone: '',
    address_street_1: '',
    city: '',
    state: '',
    zip: '',
    country_id: '',
  },
})

const refForm = ref()
const refInputEl = ref('')
const avatarFile = ref('')
const avatarPreview = ref('')
const countries = ref([])


const fetchCountries = async () => {
  try {
    const resp = await axios.get('/countries')

    countries.value = resp.data.data
  } catch (error) {
    console.log(error)
  }
}

onMounted( async () => {
  await fetchAccount()
  await fetchCountries()
  formData.value = { ...accountData.value }
  avatarPreview.value = accountData.value.avatar_url

  if (formData.value.address === null) {
    formData.value.address = {
      phone: '',
      address_street_1: '',
      city: '',
      state: '',
      zip: '',
      country_id: '',
    }
  }

  delete formData.value.avatar
})


const resetFormData = () => {
  formData.value = {
    ...accountData.value,
  }
}

const changeAvatar = file => {
  const fileReader = new FileReader()
  const { files } = file.target
  if (files && files.length) {
    fileReader.readAsDataURL(files[0])
    avatarFile.value = files[0]
    fileReader.onload = () => {
      if (typeof fileReader.result === 'string')
        avatarPreview.value = fileReader.result
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
            formNewData.append(`address[${addressKey}]`, formData.value.address[addressKey] ?? '')
          })
        } 
        else {
          formNewData.append(key, formData.value[key])
        }
      })
      
      if(avatarFile.value){
        formNewData.append('avatar', avatarFile.value)
        formNewData.append('is_avatar_removed', true)
      }

      formNewData.append('_method', 'PUT')
      await updateAccount(formNewData)
    }
  })
}

// reset avatar image
const resetAvatar = () => {
  formData.value.avatar_url= accountData.value.avatar_url
}
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Profile Details">
        <VCardText class="d-flex">
          <!-- 👉 Avatar -->
          <VAvatar
            rounded
            size="100"
            class="me-6"
            :image="avatarPreview"
          />

          <!-- 👉 Upload Photo -->
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
                <span class="d-none d-sm-block">Upload new photo</span>
              </VBtn>

              <input
                ref="refInputEl"
                type="file"
                name="file"
                accept=".jpeg,.png,.jpg,GIF"
                hidden
                @input="changeAvatar"
              >

              <VBtn
                type="reset"
                color="secondary"
                variant="tonal"
                @click="resetAvatar"
              >
                <span class="d-none d-sm-block">Reset</span>
                <VIcon
                  icon="tabler-refresh"
                  class="d-sm-none"
                />
              </VBtn>
            </div>

            <p class="text-body-1 mb-0">
              Allowed JPG, GIF or PNG. Max size of 4MB
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
              <!-- 👉 First Name -->
              <VCol
                md="6"
                cols="12"
              >
                <VTextField
                  v-model="formData.first_name"
                  label="First Name"
                  :rules="[requiredValidator]"
                  name="first_name"
                />
              </VCol>

              <!-- 👉 Last Name -->
              <VCol
                md="6"
                cols="12"
              >
                <VTextField
                  v-model="formData.last_name"
                  label="Last Name"
                  :rules="[requiredValidator]"
                  name="last_name"
                />
              </VCol>

             

              <!-- 👉 Email -->
              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.email"
                  :rules="[requiredValidator, emailValidator]"
                  label="E-mail"
                  type="email"
                  name="email"
                />
              </VCol>

             
              <VCol
                cols="12"
                md="12"
              >
                <span class="text-h6 font-weight-bold">Home Address</span>
                <VDivider />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.address.phone"
                  label="Home Phone"
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
                >
                  <span class="fontForMobileSize">Save Changes</span> 
                </VBtn>

                <VBtn
                  color="secondary"
                  variant="tonal"
                  type="reset"
                  @click.prevent="resetFormData"
                >
                  <span class="fontForMobileSize">Reset</span> 
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
