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
      videos: [],
      progress: {}
  }),


  methods: {
    upload() {
      // When it is selected it doesn't show v-if, it only shows the v-else on the view page
      this.selected = true
      this.videos = Array.from(this.$refs.videos.files);
      const uploaders = this.videos.map(video => {
        const formData = new FormData()

        this.progress[video.name] = 0;

        formData.append('video', video);
        formData.append('title', video.name);
        return axios.post(`/channels/${this.channel.id}/videos`, formData,
        {
          // This function shows the progress of uploading the video
          onUploadProgress: (event) => {
            this.progress[video.name] = Math.ceil((event.loaded / event.total) * 100)

            // To force VueJs to update the progress as it goes on
            this.$forceUpdate();
          },
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