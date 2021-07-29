Vue.component('subscribe-button', {
  props: {
    subscriptions: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  methods: {
    toggleSubscription() {
      console.log(__auth());
      if(!__auth()) {
          alert('Please login to subscribe')
      }
    }
  }
});
