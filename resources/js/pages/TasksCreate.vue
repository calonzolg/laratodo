<template>
  <div class="container mx-auto ">
    <div class="flex justify-center">
      <form :model="form" @submit.prevent="submit" ref="contactForm">
        <div>
          <label>Title</label>

          <input class="rounded border-gray-400 w-full border" v-model="form.title" required="">

        </div>
        <div class="form-group">
          <label>Description</label>
          <div>
            <textarea class="rounded border-gray-400 w-full border"  v-model="form.description" required=""></textarea>
          </div>
        </div>
        <div class="form-group row">
          <div class="">
            <vue-recaptcha
              ref="recaptcha"
              @verify="onVerify"
              @expired="onExpired"
              :sitekey="recaptchaSite">
            </vue-recaptcha>
          </div>
        </div>
        <button type="submit" class="mt-2 bg-green-500 hover:bg-green-700 p-2 rounded text-white">Send</button>
      </form>
    </div>
  </div>
</template>


<script>
import {VueRecaptcha} from 'vue-recaptcha';

export default {
  name: "TasksCreate",
  components: {
    'vue-recaptcha': VueRecaptcha
  },
  data() {
    return {
      recaptchaSite: window.recaptchaSite,
      form: {
        title: ``,
        description: ``,
        robot: false
      }
    }
  },
  methods: {
    submit() {
      axios.post('/api/tasks', this.form)
        .then(res => {
          this.onExpired();
          window.location.href = '/';
        })
        .catch(err => {
          console.log(err)
        })
    },
    onVerify(recaptchaToken) {
      this.form.recaptcha = recaptchaToken
    },
    onExpired() {
      this.$refs.recaptcha.reset();
    },
  }
}
</script>

<style scoped>

</style>
