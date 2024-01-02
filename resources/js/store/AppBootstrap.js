export const AppBootstrap = defineStore("AppBootstrap", {
  state: () => ({
    companyCurrency: {},
  }),
  actions: {


    // async getTrialStatus() {
    //   try {

    //     if(!localStorage.getItem('userData')){
    //       return
    //     }

    //     const { trial_days_left, is_trial_active, subscription_ends_at, is_trial_consumed, is_trial_ended } =
    //       await $api("/is-trial-active", {
    //         method: "GET",
    //       })

    //     this.trialDaysLeft = trial_days_left
    //     this.trialActive = is_trial_active
    //     this.subscriptionEndsAt = subscription_ends_at
    //     this.isTrialConsumed = is_trial_consumed
    //     this.isTrialEnded = is_trial_ended
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },
  },
})
