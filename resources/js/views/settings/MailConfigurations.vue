<script setup>
import useSettings from '@/composables/settings'

import { requiredValidator } from '@validators'

const { updateSettings, isLoading, fetchSettings, settings } = useSettings()


const formData = ref({
  mail_driver: '',
  mail_host: '',
  mail_port: '',
  mail_username: '',
  mail_password: '',
  mail_encryption: '',
  mail_from_address: '',
  mail_from_name: '',
})

const refForm = ref()

onMounted( async () => {
  await fetchSettings([
    'mail_driver',
    'mail_host',
    'mail_port',
    'mail_username',
    'mail_password',
    'mail_encryption',
    'mail_from_address',
    'mail_from_name',
  ])

  // check if settings is not empty
  if(Object.keys(settings.value).length > 0)
  
    formData.value = settings.value
})


const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){

      console.log(formData.value);
      await updateSettings({
        ...formData.value,
        group: 'mail',
      })
    }
  })
}
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Mail Configuration">
        <VCardText class="pt-2">
          <VForm
            ref="refForm"
            class="mt-6"
            on-submit="return false;"
            @submit.prevent="onSubmit"
          >
            <VRow>
              <!-- 👉 Driver -->

              <VCol
                cols="12"
                md="6"
              >
                <VSelect
                  v-model="formData.mail_driver"
                  label="Mail Driver"
                  :items="['smtp', 'sendmail', 'mailgun', 'ses', 'postmark', 'log', 'array']"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <!-- 👉 Host -->

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_host"
                  label="Mail Host"
                  :rules="[requiredValidator]"
                />  
              </VCol>

              <!-- 👉 Port -->

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_port"
                  label="Mail Port"
                  type="number"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <!-- 👉 Username -->

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_username"
                  label="Mail Username"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <!-- 👉 Password -->

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_password"
                  label="Password"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <!-- 👉 Encryption -->

              <VCol
                cols="12"
                md="6"
              >
                <VSelect
                  v-model="formData.mail_encryption"
                  label="Mail Encryption"
                  :items="['tls', 'ssl', 'null']"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <!-- 👉 From Address -->

              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_from_address"
                  label="From Mail Address"
                  :rules="[requiredValidator]"
                />
              </VCol>


              <VCol
                cols="12"
                md="6"
              >
                <VTextField
                  v-model="formData.mail_from_name"
                  label="From Mail Name"
                  :rules="[requiredValidator]"
                />
              </VCol>

              <VCol
                cols="12"
                class="d-flex flex-wrap gap-4"
              >
                <VBtn
                  type="submit"
                  :loading="isLoading"
                  :disabled="isLoading"
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
