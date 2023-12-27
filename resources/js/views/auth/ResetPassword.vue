<script setup>
import useAuth from '@/composables/auth'
import router from '@/router'
import authV1BottomShape from '@images/svg/auth-v1-bottom-shape.svg'
import authV1TopShape from '@images/svg/auth-v1-top-shape.svg'
import { themeConfig } from '@themeConfig'

import {
emailValidator,
requiredValidator,
} from '@validators'

const route = useRoute()
const { resetPassword, errors, respData, isBusy } = useAuth()
const isLight = themeConfig.app.theme.value === 'light'

onMounted(() => {
  if (!route.query.email || !route.query.token) {
    router.push({ name: 'login' })
  }
})

const form = ref({
  password: '',
  password_confirmation: '',
  email: route.query.email,
  token: route.query.token,
})

const refVForm = ref()

const onSubmit =  () => {
  refVForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid) {

      await resetPassword(form.value)
      if (respData.value.status === 200) {

        router.push({ name: 'login' })
      }

    }

  })
}

const isPasswordVisible = ref(false)
const isConfirmPasswordVisible = ref(false)
</script>

<template>
  <div class="layout-wrapper layout-blank">
    <div class="auth-wrapper d-flex align-center justify-center pa-4">
      <div class="position-relative my-sm-16">
        <!-- 👉 Top shape -->
        <VImg
          :src="authV1TopShape"
          class="auth-v1-top-shape d-none d-sm-block"
        />

        <!-- 👉 Bottom shape -->
        <VImg
          :src="authV1BottomShape"
          class="auth-v1-bottom-shape d-none d-sm-block"
        />

        <!-- 👉 Auth Card -->
        <VCard
          class="auth-card pa-4"
          max-width="448"
        >
          <VCardItem class="justify-center">
            <template #prepend>
              <div class="d-flex">
                <img
                  v-if="isLight"
                  :src="themeConfig.app.logo"
                  class="w-100 "
                  style="height:60px"
                >
                <img
                  v-else
                  :src="themeConfig.app.logoBlack"
                  class="w-100 "
                  style="height:60px"
                >
              </div>
            </template>
          </VCardItem>

          <VCardText class="pt-2">
            <h5 class="text-h5 font-weight-semibold mb-1">
              Reset Password 🔒
            </h5>
            <p class="mb-0">
              for <span class="font-weight-bold">{{ route.query.email }}</span>
            </p>
          </VCardText>

          <VCardText>
            <VForm
              ref="refVForm"
              @submit.prevent="onSubmit"
            >
              <VRow>
                <VCol cols="12">
                  <VTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    :rules="[requiredValidator, emailValidator]"
                    :error-messages="errors.email"
                  />
                </VCol>
                <!-- password -->
                <VCol cols="12">
                  <VTextField
                    v-model="form.password"
                    label="New Password"
                    :rules="[requiredValidator]"
                    :error-messages="errors.password"
                    :type="isPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                    @click:append-inner="isPasswordVisible = !isPasswordVisible"
                  />
                </VCol>

                <!-- Confirm Password -->
                <VCol cols="12">
                  <VTextField
                    v-model="form.password_confirmation"
                    label="Confirm Password"
                    :rules="[requiredValidator]"
                    :error-messages="errors.password_confirmation"
                    :type="isConfirmPasswordVisible ? 'text' : 'password'"
                    :append-inner-icon="isConfirmPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                    @click:append-inner="isConfirmPasswordVisible = !isConfirmPasswordVisible"
                  />
                </VCol>

                <!-- reset password -->
                <VCol cols="12">
                  <VBtn
                    block
                    type="submit"
                    :loading="isBusy"
                  >
                    Set New Password
                  </VBtn>
                </VCol>

                <!-- back to login -->
                <VCol cols="12">
                  <RouterLink
                    class="d-flex align-center justify-center"
                    :to="{ name: 'login' }"
                  >
                    <VIcon
                      icon="tabler-chevron-left"
                      class="flip-in-rtl"
                    />
                    <span>Back to login</span>
                  </RouterLink>
                </VCol>
              </VRow>
            </VForm>
          </VCardText>
        </VCard>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>

