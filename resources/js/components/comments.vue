<template>

  <div class="card mt-5 p-5">
    <div v-if="auth" class="form-inline  my-4 w-full">
      <div class="form-inline my-4 w-full" >
        <input v-model="newComment" class="form-control form-control-sm w-80" type="text" name="" id="">
      </div>
      <button @click="addComment" class="btn btn-sm btn-info">
        <small> Add comment </small>
      </button>
      
    </div>

    <Comment v-for='comment in comments.data' :comment="comment"  :key="comment.id" :video="video" />

    <div class="text-center">
      <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-success"> load more</button>
    </div>


  </div>

                   
</template>


<script>
import axios from 'axios';
import Comment from './comment.vue'

  export default {
   
   props: ['video'],
   components: {
     Comment
   },
   
   mounted() {
     this.fetchComments();
   },

   data: () => ({
     comments: {
       data: []
     },
     newComment: ''
   }),

   methods: {
     fetchComments() {
       const url = this.comments.next_page_url ? this.comments.next_page_url : `/videos/${this.video.id}/comments`
       axios.get(url).then(({ data }) => {
         this.comments = {
           ...data,
           data: [
             ...this.comments.data,
             ...data.data
           ]
         }
       })
     },

     addComment() {
      //  if (!this.newComment) return
         
       axios.post(`/comments/${this.video.id}`, {
         body: this.newComment
       }).then((data)=> {
         this.comments = {
           ...this.comments,
           data: [
             data,
             ...this.comments.data,
           ]
         }
       })
     }
   }, 
   computed: {
     auth() {
       return __auth()
     }
   }



  }

</script>