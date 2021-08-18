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
      progress: {},
      uploads: [],
      intervals : {}
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
        ).then(({ data }) => {

          this.uploads = [
            ...this.uploads,
            data
          ]

        })
        .catch(function(){
          console.log('FAILURE!!');
        });
      }); 
      
      
      axios.all(uploaders)
      .then(() => {
        this.videos = this.uploads

        this.videos.forEach(video => {
          // At every 3 seconds interval, perform the function in the intrerval
          this.intervals[video.id] = setInterval(() => {
            // Send a request to this endpoint and get a data from it
            axios.get(`/videos/${video.id}`).then(({data}) => {
              // if the percentage of the data(video) is 100, stop the interval
              if(data.percentage == 100) {
                clearInterval(this.intervals[video.id])
              }
              // Else, replace the videos with the ones in the database as they are storing up for each of the videos
              this.videos = this.videos.map((v) => {
                // If the id of the video is the same thing as the id of the data (video gotten from the request, save the data in the videos variable)
                if(v.id == data.id) {
                  return data
                }

                return v;
              })
            })
          }, 3000)
        })
      })
    }
  }
}) 