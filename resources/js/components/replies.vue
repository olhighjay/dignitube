<template>
  <div>
    <div class="media mt-3" v-for="reply in replies.data" :key="reply.id">
      <a class="my-3" href="">
        <!-- <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200" alt=""> -->
         <!-- <avatar :username="reply.user.name" :size="30" class="mr-3"></avatar> -->
      </a>
      <div class="media-body" >
          <!-- <h6 class="mt-0">{{reply.user.name}}</h6> -->
        <small>
          {{reply.body}}
          
        </small>
        <votes :default_votes="reply.votes" :entity_id="reply.id " :entity_owner=" reply.user_id" ></votes> 
      </div>
    </div>
     <div v-if="comment.repliesCount > 0 && replies.next_page_url" class="text-center">
       <button @click="fetchReplies" class="btn btn-info btn-sm">Load Replies</button>
      </div>
  </div>

</template>

<script>
import Avatar from 'vue-avatar'

export default{
  props: ['comment'],
  components: {
     Avatar
   },
  data() {
    return {
      replies: {
        data: [],
        next_page_url: `/comments/${this.comment.id}/replies`
      }
    }
  },
   methods: {
    fetchReplies() {
      axios.get(this.replies.next_page_url).then(({ data }) => {
        // console.log(this.replies);
        this.replies = {
          ...data,
          data: [
            ...this.replies.data,
            ...data.data
          ]
        }
      })
    },

    addReply(reply) {
      this.replies = {
        ...this.replies,
        data: [
          reply,
          ...this.replies.data
        ]
      }
    }
  }
}
</script>
