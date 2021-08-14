import axios from "axios";

Vue.component('channel-uploads', {

  props: {
    channel: {
      type: Object,
      required: true,
      default: () => ({})
    }
  },

  data: () => ({
      selected: false,
      videos: []
  }),


  methods: {
    upload() {
      this.selected = true
      this.videos = Array.from(this.$refs.videos.files);
      const uploaders = this.videos.map(video => {
        const formData = new FormData()
        formData.append('video', video);
        formData.append('title', video.name);
        axios.post(`/channels/${this.channel.id}/videos`, formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
        ).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });
      })  
    }
  }
}) 