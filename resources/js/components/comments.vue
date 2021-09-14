<template>

  <div class="card mt-5 p-5">
    <div class="form-inline  my-4 w-full">
      <div class="form-inline my-4 w-full" >
        <input class="form-control form-control-sm w-80" type="text" name="" id="">
      </div>
      <button class="btn btn-sm btn-info"  type="submit">
        <small> Add comment </small>
      </button>
      
    </div>

    <div class="media my-3" v-for="comment in comments.data" :key="comment.data">
      <!-- <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200" alt=""> -->
      <avatar :username="comment.user ? comment.user.name : 'Jane Doe'" :size="30" class="mr-3"></avatar>
         
      <div class="media-body">
        <h6 class="mt-0">{{ comment.user ? comment.user.name : '' }}</h6>
        <small>
          {{comment.body}}
        </small>

        
       <votes :default_votes="comment.votes" :entity_id="comment.id " :entity_owner=" comment.user_id" ></votes>
    
        

        <replies :comment="comment"></replies>

      </div>
</div>

    <div class="text-center">
      <buttton v-if="comments.next_page_url" @click="fetchComments" class="btn btn-success"> load more</buttton>
    </div>


  </div>

                   
</template>


<script>
import axios from 'axios';
import Replies from './replies.vue'
import Avatar from 'vue-avatar'

  export default {
   
   props: ['video'],
   components: {
     Avatar,
     Replies
   },
   
   mounted() {
     this.fetchComments();
   },

   data: () => ({
     comments: {
       data: []
     }
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
     }
   }



  }

</script>