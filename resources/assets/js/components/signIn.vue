<template>
  <div>
    <form>
      <div class="form-group">
        <label for="email">Email</label>
        <input
              type="email"
              id="email"
              class="form-control"
              v-model="email"
              required
        />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
              type="password"
              id="password"
              class="form-control"
              v-model="password"
              required
        />
      </div>
      <button class="btn btn-primary" type="submit" @click.prevent="signin">SignIn</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },

  methods: {
    signin() {
      axios.post(
        "http://vue.app/api/user/signin",
        {
          email: this.email,
          password: this.password,
        },
        {
          headers:{'X-Requested-With' : 'XMLHttpRequest'}
        }
      )
      .then(
        response => {
          console.log(response);
          const token = response.data.token;
          const base64Url=token.split('.')[1];
          const base64 = base64Url.replace('-', '+').replace('_', '/');
          console.log(JSON.parse(window.atob(base64)));

          localStorage.setItem('token', token);
        })
      .catch(
        error => {
          console.log(typeof(error));
      });
    },
  },
}
</script>

<style scoped>
</style>
