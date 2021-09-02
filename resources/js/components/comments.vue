<template>

  <div class="card mt-5 p-5">
    <div class="media mt-5" v-for="comment in comments.data">
      <!-- <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200" alt=""> -->
      <avatar :username="comment.user ? comment.user.name : 'Jane Doe'" size="30" class="mr-3"></avatar>
         
      <div class="media-body">
        <h6 class="mt-0">{{ comment.user ? comment.user.name : '' }}</h6>
        <small>
          {{comment.body}}
        </small>

        <!-- <div class="d-flex align-items-center"> -->
          <div class="form-inline  my-4 w-full">
          <div class="form-inline my-4 w-full" >
            <input class="form-control form-control-sm w-80" type="text" name="" id="">
          </div>
          <button class="btn btn-sm btn-info"  type="submit">
            <small> Add comment </small>
          </button>
          
        </div>



        

        <!-- <div class="d-flex align-items-center"> -->
        <div class="media mt-3">
          <a class="mr-3" href="">
            <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200" alt="">
          </a>
          <div class="media-body" >
             <h6 class="mt-0">{{ comment.user ? comment.user.name : '' }}</h6>
            <small>
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
              when an unknown printer took a galley of type and scrambled it to make a type specimen book. It 
              has survived not only five centuries, but also the leap into electronic typesetting, 
              remaining essentially unchanged.
            </small>
            <div class="form-inline my-4 w-full">
              <input class="form-control form-control-sm w-80" type="text" name="" id="">
              
              <button class="btn btn-sm btn-info"  type="submit">
                <small> Add comment </small>
              </button>
            </div>
          </div>
           
        </div>
      </div>
    </div>

    <div class="text-center">
      <buttton class="btn btn-success"> load more</buttton>
    </div>


  </div>

                   
</template>


<script>
import axios from 'axios';

import Avatar from 'vue-avatar'

  export default {
   
   props: ['video'],
   components: {
     Avatar
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
       axios.get(`/videos/${this.video.id}/comments`).then(({ data }) => {
         this.comments = data
       })
     }
   }



  }

</script>