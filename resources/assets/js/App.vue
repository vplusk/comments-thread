<template>
  <div class="container">
    <h1>Comments</h1>
    <h4>Test task</h4>

    <div class="comment" v-for="comment in comments">
      <h2>id: {{comment.id}}</h2>
      <p class="comment-head">username at {{comment.created_at}}</p>
      <p v-if="!comment.editing">
        {{comment.text}}
      </p>
    
      <p>
        <!--<textarea v-if="comment.editing">{{comment.text}}</textarea>-->
        <input v-if="comment.editing" v-model="comment.new_text" v-bind:placeholder="comment.text">
        <a v-if="comment.editing" v-on:click="saveComment(comment)">save</a>
      </p>
    
      <a v-on:click="deleteComment(comment.id)">x</a>
      <a v-on:click="comment.editing = true">edit</a>
      
    </div>
    
    
    <form v-on:submit.prevent="postComment">
        <div class="form-group">
          <textarea v-model="comment.text" id="form" placeholder="Type your comment...">
          </textarea>
        </div>
        <br />
        <div class="form-group">
          <button class="btn btn-primary">Add Item</button>
        </div>
    </form>
    
  </div>

</template>

<script>
    import Vue from 'vue'
    import axios from 'axios'
    
    export default {
      data() {
        return {
            comments: [],
            comment: []
        }
      },
      created() {
        this.fetchIndexData()
      },
      methods: {
        fetchIndexData() {       
          var vm = this

          axios.get(`comments`)
              .then((response) => {
                this.comments = response.data.model
                this.comments.forEach((comment) => {
                  comment.editing = false
                })
                console.log(this.comments)
              })
              .catch((response) => {
                  console.log(response)
              })
        },
        postComment() { 
          axios.post(`comments`, {
            'text': this.comment.text
          })
            .then((response) => {  
              this.comments.push(response.data)
            })
        },
        saveComment(comment) {
          axios.put(`comments/${comment.id}`, {
            'text': this.comment.new_text
          })
            .then((response) => {
              comment.editing = false
            })
        },
        
        deleteComment(id) {
          axios.delete(`comments/${id}`)
          this.comments = this.comments.filter(comment => comment.id != id)
        }
      }
    }
</script>