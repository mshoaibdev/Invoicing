<script setup>
import useAuth from '@/composables/auth'
import authV1BottomShape from '@images/svg/auth-v1-bottom-shape.svg'
import authV1TopShape from '@images/svg/auth-v1-top-shape.svg'
import { themeConfig } from '@themeConfig'
import {
emailValidator,
requiredValidator,
} from '@validators'

const { forgotPassword, errors, respData, isLoading } = useAuth()
const form = ref({ email: '' })
const refVForm = ref()

const isLight = themeConfig.app.theme.value === 'light'

const onSubmit =  () => {
  refVForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid) {

      await forgotPassword(form.value)
      if (respData.value.status === 200) {

        // router.push(route.query.to ? String(route.query.to) : '/login')
      }

    }

  })
}
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

        <!-- 👉 Auth card -->
        <VCard
          class="auth-card pa-4"
          max-width="448"
        >
          <VCardItem class="justify-center">
            <!--
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
            -->
          </VCardItem>

          <VCardText class="pt-2">
            <h5 class="text-h5 font-weight-semibold mb-1">
              Forgot Password? 🔒
            </h5>
            <p class="mb-0">
              Enter your email and well send you instructions to reset your password
            </p>
          </VCardText>

          <VCardText>
            <VForm
              ref="refVForm"
              @submit.prevent="onSubmit"
            >
              <VRow>
                <!-- email -->
                <VCol cols="12">
                  <AppTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    :rules="[requiredValidator, emailValidator]"
                    :error-messages="errors.email"
                  />
                </VCol>

                <!-- reset password -->
                <VCol cols="12">
                  <VBtn
                    block
                    type="submit"
                    :loading="isLoading"
                  >
                    Send Reset Link
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

