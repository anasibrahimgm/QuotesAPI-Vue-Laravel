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
        }
      )
      .catch(
        error => console.log(error)
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
