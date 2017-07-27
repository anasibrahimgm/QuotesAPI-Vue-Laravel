<template>
  <div>
    <div class="alert alert-success" role="alert" v-show="registerSuccessMsg">
      <strong>Well done!</strong> {{ registerSuccessMsg }}
    </div>

    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input
              type="text"
              id="name"
              class="form-control"
              v-model="name"
              required
        />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input
              type="email"
              id="email"
              class="form-control"
              v-model="email"
              required
        />
        <span class="help-block has-error" v-show="emailError">
            <strong>{{ emailError }}</strong>
        </span>
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
        <span class="help-block" v-show="passwordError">
            <strong>{{ passwordError }}</strong>
        </span>
      </div>

      <button class="btn btn-primary" type="submit" @click.prevent="signup">SignUp</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      emailError: '',
      password: '',
      passwordError: '',
      registerSuccessMsg: '',
    }
  },

  methods: {
    signup() {
      axios.post(
        "http://vue.app/api/user",
        {
          name: this.name,
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
          this.name = '';
          this.email = '';
          this.emailError = '';
          this.password = '';
          this.passwordError = '';
          this.registerSuccessMsg = 'You Successfully Registered a New Account';
        })
      .catch(
        error => {
          console.log(error);
          if (error.response) {
            console.log("Error 1");
             // The request was made and the server responded with a status code
             // that falls out of the range of 2xx
             console.log(error.response.data);
             if (error.response.data.email)
             {
               console.log(error.response.data.email[0]);
               this.emailError = error.response.data.email[0];
             }

             if (error.response.data.password)
             {
               console.log(error.response.data.password[0]);
               this.passwordError = error.response.data.password[0];
             }

             console.log("Error 2");
             console.log(error.response.status);

             console.log("Error 3");
             console.log(error.response.headers);
           } else if (error.request) {
             // The request was made but no response was received
             // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
             // http.ClientRequest in node.js
             console.log("Error 4");
             console.log(error.request);
           } else {
             // Something happened in setting up the request that triggered an Error
             console.log("Error 5");
             console.log('Error', error.message);
           }
           console.log(error.config);
        }
      );
    },
  },
}
</script>

<style scoped>
</style>
