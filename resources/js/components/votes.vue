(`<template>
  <div>
    <span @click="vote('up')" :class="{ 'thumbs-up-active': upvoted }">
      <i  class="far fa-thumbs-up" ></i>
      {{ upvotes_count}} 
    </span>
    <span @click="vote('down')" :class="{ 'thumbs-down-active': downvoted }">
      <i  class="far fa-thumbs-down" ></i>   
      {{ downvotes_count}} 
    </span>
  </div>                 
</template>


<script>
  import numeral from 'numeral'
import axios from 'axios'


  export default {
    props: {
      default_votes: {
        type: Array,
        required: true,
        default: () => []
      },

      entity_owner: {
        required: true,
        default: ''
      },

      entity_id: {
        required: true,
        default: ''
      }

    },


    data: function() {
      return {
        votes: this.default_votes
      }
    },



    computed: {
      upvotes() {;
        return this.votes.filter( v => v.type == 'up')
      },

      downvotes() {
        return this.votes.filter( v => v.type == 'down')
      },

      upvotes_count() {
        return numeral(this.upvotes.length).format('0a')
      },

      downvotes_count() {
        return numeral(this.downvotes.length).format('0a')  
      },

      upvoted() {
        if(!__auth()) return false

        return !!this.upvotes.find(v => v.user_id == __auth().id)
      },

      downvoted() {
        if(!__auth()) return false

        return !!this.downvotes.find(v => v.user_id == __auth().id)
      }

    },



    methods: {

      vote(type) {

        if(!__auth()) {
          return alert('Please login to vote')
        }


        if( __auth().id == this.entity_owner) {
          return alert('You cannot vote your this item ')
        }


        if (type == 'up' && this.upvoted ) return 

        if (type == 'down' && this.downvoted ) return 


        axios.post(`/votes/${this.entity_id}/${type}`)
        .then(({data}) => {
          // console.log('I am here na');
          if(this.upvoted || this.downvoted) {

            this.votes = this.votes.map(v => {
              if(v.user_id == __auth().id) {

                return data 
              }

              return v
            })
          } else {

            this.votes = [
              ...this.votes,
              data
            ]

          }

        })

      }

    }




  }

</script>
`)