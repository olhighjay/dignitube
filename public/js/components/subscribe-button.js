Vue.component('subscribe-button', {
  methods: {
    toggleSubscription() {
      if(!__auth) {
        console.log('I am here');
        alert('Please login to subscribe')
      }
    }
  }
});