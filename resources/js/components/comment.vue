<template>
  <div>
    <div class="media my-3">
      <!-- <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200" alt=""> -->
      <avatar :username="comment.user ? comment.user.name : 'Jane Doe'" :size="30" class="mr-3"></avatar>
         
      <div class="media-body">
        <h6 class="mt-0">{{ comment.user ? comment.user.name : '' }}</h6>
        <small>
          {{comment.body}}
        </small>

        <div class="d-flex">
          <votes :default_votes="comment.votes" :entity_id="comment.id " :entity_owner=" comment.user_id" ></votes>
          <button @click="addingReply = !addingReply" class="btn btn-sm" :class="{'btn-default' : !addingReply, 'btn-danger' : addingReply}">
            {{addingReply ? 'Cancel' : 'Add Reply'}}
          </button>
        </div>

        <div v-if="addingReply" class="form-inline my-4 w-full">
          <input v-model="body" class="form-control form-control-sm w-80" type="text" name="" id="">
          
          <button @click="addReply" class="btn btn-sm btn-info"  type="submit">
            <small> Add reply </small>
          </button>
        </div>
        
        <replies ref="replies" :comment="comment"></replies>

      </div>
    </div>
  </div>
</template>

<script>
import Replies from './replies.vue'
import Avatar from 'vue-avatar'
import axios from 'axios'
export default {
  components: {
    Replies,
    Avatar
  },
  data() {
    return{
      body: '',
      addingReply: false
    }
  },
  props: {
    comment: {
      required: true,
      default: () => ({})
    },
    video: {
      required: true,
      default: () => ({})
    }
  },
  methods: {
    addReply() {

      if(!this.body) return
      axios.post(`/comments/${this.video.id}`,{
        comment_id: this.comment.id,
        body: this.body
      }).then(({data}) => {
        console.log(data);
        this.body = ''
        this.addingReply = false
        this.$refs.replies.addReply(data)

      })
    }
    
  }

}
</script>

<style>

</style>