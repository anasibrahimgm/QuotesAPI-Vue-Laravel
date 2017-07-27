<template>
  <div class="panel panel-dafault">
    <div class="panel-body">
    </div>
    {{ qt.content }}
    <div class="panel-footer">
      <div v-show="editing">
        <input v-on:keyup.enter="onUpdate" type="text" v-model="editValue"/>
        <a @click="onCancel">Cancel</a>
      </div>

      <div>
        <a @click="onEdit">Edit</a>
        <a @click="onDelete">Delete</a>
      </div>

      <div class="alert alert-warning" role="alert" v-show="contentError">
        <strong>Warning!</strong> {{ contentError }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['qt'],
  data() {
    return {
      editing: false,
      editValue: this.qt.content,
      contentError: '',
    }
  },

  methods: {
    onEdit() {
      this.editing = true;
      //this.editValue = this.qt.content;
    },

    onCancel() {
      this.editing = false;
    },

    onDelete() {
      this.$emit('quoteDeleted', this.qt.id);
      const token = localStorage.getItem('token');
      axios.delete("http://vue.app/api/quote/" + this.qt.id +"?token=" + token)
      .then(
        response => console.log(response)
      )
      .catch(
        error => console.log(error)
      );
    },

    onUpdate() {
      const token = localStorage.getItem('token');
      axios.put("http://vue.app/api/quote/" + this.qt.id +"?token=" + token, {
        content: this.editValue
      })
      .then(
        response => {
          console.log(response);
          this.editing = false;
          this.qt.content = this.editValue;
          this.contentError = '';
        }
      )
      .catch(
        error => {
          console.log(error);
          if (error.response) {
            console.log("Error 1");
             // The request was made and the server responded with a status code
             // that falls out of the range of 2xx
             console.log(error.response.data);
             console.log(error.response.data.content);
             this.contentError = error.response.data.content[0];

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
a {
  cursor: pointer;
}
</style>
