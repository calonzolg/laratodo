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
            <textarea class="rounded border-gray-400 w-full border" v-model="form.description" required=""></textarea>
          </div>
        </div>
        <div class="form-group row" v-if="!task">
          <div class="">
            <vue-recaptcha
              ref="recaptcha"
              @verify="onVerify"
              @expired="onExpired"
              :sitekey="recaptchaSite">
            </vue-recaptcha>
          </div>
        </div>
        <div class="bg-red-100 rounded my-1" v-if="errors.length !== 0">
          <ul class="p-2">
            <li class="list-disc list-inside text-red-500" v-for="(error, key) in errors">
              {{ error[0] }}
            </li>
          </ul>
        </div>
        <button type="submit" class="mt-2 bg-green-500 hover:bg-green-700 p-2 rounded text-white">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import {VueRecaptcha} from "vue-recaptcha";

export default {
  name: "TaskForm",
  props: {
    task: {type: Object, require: false}
  },
  components: {
    'vue-recaptcha': VueRecaptcha,
  },
  data() {
    return {
      recaptchaSite: window.recaptchaSite,
      form: {
        title: this.task ? this.task.title : ``,
        description: this.task ? this.task.description : ``,
      },
      errors: []
    }
  },
  methods: {
    submit() {
      if (this.$route.params.id) {
        axios.put(`/api/tasks/${this.task.id}`, this.form)
          .then(res => {
            console.log(res)
          })
      } else {
        axios.post('/api/tasks', this.form)
          .then(res => {
            this.onExpired();
            window.location.href = '/';
          })
          .catch(err => {
            this.errors = err.response.data.errors
          })
      }

    },
    onVerify(recaptchaToken) {
      this.form.recaptcha = recaptchaToken
    },
    onExpired() {
      this.$refs.recaptcha.reset();
    },
  },
  watch: {
    task() {
      this.form.title = this.task.title;
      this.form.description = this.task.description;
    }
  }
}
</script>

<style scoped>

</style>
